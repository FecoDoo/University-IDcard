<?php
namespace app\api\controller;

use think\Db;

class User extends Common
{

    public $datas;

    /*------------------ 接口方法 -------------------*/

    /**
     * [用户登陆时接口请求的方法]
     * @return [null]
     */
    public function login()
    {
        $this->datas = $this->params;
        // 在数据库中查询数据 (用户名和密码匹配)
        $this->matchUserAndPwd();
    }

    /**
     * [用户修改密码接口请求的方法]
     * @return [null]
     */
    public function changePwd()
    {
        //1. 接受参数
        $this->datas = $this->params;
        //3. 确定该用户名是否已经存在数据库
        if (!empty($this->checkExist($this->datas['user_id']))) {
            //4. 同时匹配用户名和密码
            $res = Db::table('idcard_student')->where(['Sno' => $this->datas['user_id'], 'Spwd' => $this->datas['user_old_pd']])->find();
            //5. 匹配成功则将新密码加密后更新该用户密码
            if (!empty($res)) {
                //更新user_pwd字段
                $resu = Db::table('idcard_student')->where('Sno', $this->datas['user_id'])->update(['Spwd' => $this->datas['user_pwd']]);
                if (!empty($resu)) {
                    $this->returnMsg(200, 'Success');
                } else {
                    $this->returnMsg(400, 'Failed');
                }
            } else {
                $this->returnMsg(400, 'Old password incorrect');
            }
        } else {
            $this->returnMsg(400, 'Student number does not exist');
        }
    }

    
    
    /**
     * [用户查询个人信息]
     * @return [json] [个人信息数组]
     */
    public function getInfo()
    {
        $this->datas = $this->params;
        $res = Db::table('idcard_student')->where('Sno',$this->datas['user_id'])->find();
        unset($res['user_pwd']);
        $this->returnMsg(200,'Success',$res);
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

    /**
     * [登陆验证匹配]
     * @param  [array] $data [参数]
     * @return [json]       [登陆返回信息]
     */
    private function matchUserAndPwd()
    {
        $res = Db::table('idcard_student')->where('Sno', $this->datas['user_id'])->where('Spwd', $this->datas['user_pwd'])->find();

        if (!empty($res)) {
            unset($res['user_pwd']);
            $this->returnMsg(200, 'Success', $res);
        } else {
            $this->returnMsg(400, 'Failed', $res);
        }
    }
}
