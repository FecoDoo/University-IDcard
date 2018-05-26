<?php

namespace app\api\controller;

use app\api\controller\Validater;
use think\Controller;
use think\Request;

class Common extends Controller
{
    protected $req; //用来处理客户端传递过来的参数
    protected $validater; //用来验证数据/参数
    protected $params; //过滤后符合要求的参数

    /**
     * [构造方法]
     * @return [null] [null]
     */
    protected function initialize()
    {
        $this->req = new Request;
        // 验证参数,返回成功过滤后的参数数组
        $this->params = $this->checkParams($this->req->param());
    }

    public function checkTime($arr)
    {
        //$this->returnMsg(400, '请求超时!');
        if (!isset($arr['time']) || intval($arr['time']) <= 1) {
            $this->returnMsg(400, '时间戳不存在!');
        }
        if (time() - intval($arr['time']) > 10) {
            $this->returnMsg(400, '请求超时!');
        }
    }

    //检测客户端传递过来的其他参数
    /*
    param: $arr [除了time,token以外的其他参数]
    return:     [合格的参数数组]
     */
    protected function checkParams($arr)
    {
        //1. 验证参数并且返回错误
        $this->validater = new Validater();
        $scene = $this->req->pathinfo();
        if (!$this->validater->scene($scene)->check($arr)) {
            $this->returnMsg(400, $this->validater->getError());
        }

        //2. 如果正常，就通过验证
        return $arr;
    }

    /**
     * [检测学号是否已经存在数据库中]
     * @param  [char] $value [学号]
     * @return [bool]    $id_res    [1存在/0不存在]
     */
    protected function checkExist($value)
    {
        $id_res = table('Student')->where('StuNo', $value)->find();
        return $id_res;
    }

    //返回信息
    protected function returnMsg($code, $msg = '', $data = [])
    {
        $return_data['code'] = $code;
        $return_data['msg'] = $msg;
        $return_data['data'] = $data;

        echo json_encode($return_data);die;
    }
}
