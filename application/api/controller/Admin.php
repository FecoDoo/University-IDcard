<?php
namespace app\api\controller;

class Admin extends Common
{
    public $datas;

    /**
     * [用户注册时接口请求的方法]
     * @return [null]
     */
    public function register()
    {
        $this->datas = $this->params;

        //检测验证码
        $this->checkCode($this->datas['user_id'], $this->datas['code']);

        //检测用户名
        $this->checkRegisterUser();

        //将信息写入数据库
        $this->insertDataToDB();
    }
    
    /**
     * [用户找回密码接口请求的方法]
     * @return [type] [description]
     */
    public function findPwd()
    {
        //1. 接收参数
        $this->datas = $this->params;
        //2. 确定该用户名是否已经存在数据库
        if ($this->checkExist($this->datas['user_id'])) {
            //3. 同时匹配用户名和密码
            $res = Db::table('Student')->where(['stuNo' => $this->datas['user_id'], 'stuPwd' => $this->datas['user_old_pd']])->find();
            if (!empty($res)) {
                //4. 更新密码字段
                $res = Db::table('Student')->where('stuNo', $this->datas['user_id'])->find(['stuPwd' => $this->datas['user_pwd']]);
                //5. 返回执行结果
                if (!empty($res)) {
                    $this->returnMsg(200, '密码成功找到', $res['stuPwd']);
                } else {
                    $this->returnMsg(400, '密码未找到!');
                }
            } else {
                $this->returnMsg(400, '密码错误!');
            }
        } else {
            $this->returnMsg(400, '学号不存在');
        }
    }
    /**
     * [插入数据至数据库]
     * @return [json] [注册行为产生的结果]
     */
    private function insertDataToDb()
    {
        //删除user_id字段
        unset($this->datas['user_id']);
        $this->datas['user_rtime'] = time();
        $this->datas['user_pwd'] = $this->datas['user_pwd'];

        //往api_user表中插入用户数据
        $res = table('user')->insert($this->datas);

        //返回执行结果
        if (!empty($res)) {
            $this->returnMsg(200, '用户注册成功！');
        } else {
            $this->returnMsg(400, '用户注册失败！');
        }
    }

    /* ---------------- 执行方法  ---------------- */

    /**
     * [检测用户名类型]
     * @return [null]
     */
    private function checkRegisterUser()
    {

        //检测是否已经存在于数据库
        $this->checkExist($this->datas['user_id']);

        //将数据存入数组对象 ( 为了给数据库添加用户信息 )
        $this->datas['user_id'] = $this->datas['user_id'];

    }

}
