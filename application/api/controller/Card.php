<?php
namespace app\api\controller;

use think\Db;

class Card extends Common
{
    public $datas;

    //充值
    public function charge()
    {
        $this->datas = $this->params;
        $this->findcard($this->datas['card_id']);
        Db::table('idcard_card')->where('Cno', $this->datas['card_id'])->setInc('Charge', $this->datas['charge_number']);
        $this->recordAdd();
    }

    // 消费
    public function consume()
    {
        $this->datas = $this->params;
        $this->findcard($this->datas['card_id']);
        Db::table('idcard_card')->setDec('Charge', $this->datas['charge_number']);
        $this->recordMinus();
    }

    // 获取流水账
    public function getInfo()
    {
        $this->datas = $this->params;
        $this->findcard($this->datas['card_id']);
        $res = Db::table('idcard_card')->where('Cno', $this->datas['card_id'])->select();
        if (empty($res)) {
            $this->returnMsg(400, 'No record of this card');
        } else {
            $this->returnMsg(200, 'Success', $res);
        }
    }
    
    // 查询卡内余额
    public function getRecord()
    {
        $this->datas = $this->params;
        $this->findcard($this->datas['card_id']);
        $res = Db::table('idcard_card')->where('Cno', $this->datas['card_id'])->select();
        if (empty($res)) {
            $this->returnMsg(400, 'No record of this card');
        } else {
            $this->returnMsg(200, 'Success', $res);
        }
    }

    // 判断学生卡号是否存在
    public function findcard($arr)
    {
        $res = Db::table('idcard_card')->where('Cno', $arr)->find();
        if (empty($res)) {
            $this->returnMsg(400, 'Card not found');
        } else {
            return;
        }
    }

    // 增加充值条目
    public function recordAdd()
    {
        $record = [
            'Cno' => $this->datas['card_id'],
            'recordAdd' => $this->datas['charge_number'],
            'time' => date('Y-m-d H-i-s'),
        ];
        $res = Db::table('idcard_record')->insert($record);
        if (!empty($res)) {
            $this->returnMsg(200, 'Success');
        } else {
            $thsi->returnMsg(400, 'Failed');
        }
    }

    // 增加消费条目
    public function recordMinus()
    {
        $record = [
            'Cno' => $this->datas['card_id'],
            'recordMinus' => $this->$datas['minus_number'],
            'time' => date('Y-m-d H-i-s'),
        ];
        $res = Db::table('idcard_record')->insert($record);
        if (!empty($res)) {
            $this->returnMsg(200, 'Success');
        } else {
            $thsi->returnMsg(400, 'Failed');
        }
    }
}
