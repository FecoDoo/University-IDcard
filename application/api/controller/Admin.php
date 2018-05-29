<?php
namespace app\api\controller;

use think\Db;

class Admin extends Common
{
    public $datas;

    /**
     * [注册学生时接口请求的方法]
     * @return [null]
     */
    public function register()
    {
        $this->datas = $this->params;
        //检测学号是否存在
        $this->checkRegisterUser();
        //将信息写入数据库
        $this->insertDataToDb();
    }

    /**
     * [找回密码接口请求的方法]
     * @return [json] [找回的密码string]
     */
    public function findPwd()
    {
        // 1. 接收参数
        $this->datas = $this->params;
        // 2. 确定该用户名是否已经存在数据库
        if ($this->checkExist($this->datas['user_id'])) {
            // 3. 同时匹配用户名和密码
            $res = Db::table('idcard_student')->where(['Sno' => $this->datas['user_id'], 'Spwd' => $this->datas['user_old_pd']])->find();
            if (!empty($res)) {
                // 4. 提取密码字段
                $res = Db::table('idcard_student')->where('Sno', $this->datas['user_id'])->value('Spwd');
                // 5. 返回执行结果
                if (!empty($res)) {
                    $this->returnMsg(200, 'Password finded', $res['Spwd']);
                } else {
                    $this->returnMsg(400, 'Old password did not match');
                }
            } else {
                $this->returnMsg(400, 'Password incorrect');
            }
        } else {
            $this->returnMsg(400, 'Student number does not exits');
        }
    }

    /**
     * [管理员补卡接口API]
     */
    public function replaceCard()
    {
        $this->datas = $this->params;
        // 判断卡号是否存在
        $this->findcard();
        
        // 判断卡的状态
        if (Db::table('idcard_card')->where('Cno', $this->datas['card_id'])->value('Status'))
        {
            $this->returnMsg(400, 'This card has already been replaced');
        }

        // 更改卡状态
        $res = Db::table('idcard_card')->where('Cno', $this->datas['card_id'])->setInc('Status');

        if (empty($res)) {
            $this->returnMsg(400, 'Failed');
        } else {
            $this->returnMsg(200, 'Success');
        }
    }
    /* ---------------- 执行方法  ---------------- */
    
    /**
     * [判断学生卡号是否存在]
     */
    public function findcard()
    {
        $res = Db::table('idcard_card')->where('Cno', $this->datas['card_id'])->find();
        if (empty($res)) {
            $this->returnMsg(400, 'Card not found');
        } else {
            return;
        }
    }

    /**
     * [插入数据至数据库]
     */
    private function insertDataToDb()
    {
        // 用户数据规范化
        $student = [
            'Srtime' => date("Y-m-d H:i:s"),
            'Sno' => $this->datas['user_id'],
            'Sname' => $this->datas['user_name'],
            'Spwd' => $this->datas['user_pwd'],
            'Sdpt' => $this->datas['user_dept'],
            'Sbirth' => $this->datas['user_birth'],
            'Ssex' => $this->datas['user_sex'],
        ];

        //往idcard_student表中插入用户数据
        $res = Db::table('idcard_student')->insert($student);

        //返回执行结果
        if (!empty($res)) {
            // 初始化校园卡
            $card = [
                'Sno' => $this->datas['user_id'],
                'Cno' => $this->datas['user_id'],
                'Charge' => 0,
            ];
            $res = Db::table('idcard_card')->insert($card);
            if (!empty($res)) {
                $this->returnMsg(200, 'Success');
            }
        } else {
            $this->returnMsg(400, 'Failed');
        }
    }

    /**
     * [检测用户名类型]
     * @return [null]
     */
    private function checkRegisterUser()
    {
        //检测是否已经存在于数据库
        if (empty($this->checkExist($this->datas['user_id']))) {
            return;
        } else {
            $this->returnMsg(400, 'Student id already exists');
        }
    }

}
