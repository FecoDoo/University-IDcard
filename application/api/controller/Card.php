<?php
namespace app\api\controller;

use think\Db;

class Card extends Common
{
    public $datas;

    // 充值饭卡
    public function charge()
    {
        $this->datas = $this->params;

        $this->checkCardStatus();
        Db::table('idcard_card')->where('Cno', $this->datas['card_id'])->setInc('Charge', $this->datas['charge_number']);
        $this->recordAdd();
    }

    // 消费饭卡
    public function consume()
    {
        $this->datas = $this->params;

        $this->checkCardStatus();

        Db::table('idcard_card')->where('Cno', $this->datas['card_id'])->setDec('Charge', $this->datas['consume_number']);
        $this->recordMinus();
    }

    // 获取流水账
    public function getRecord()
    {
        $this->datas = $this->params;
        $this->findcard();
        $res = Db::table('idcard_card')->where('Cno', $this->datas['card_id'])->select();
        if (empty($res)) {
            $this->returnMsg(400, 'No record of this card');
        } else {
            $this->returnMsg(200, 'Success', $res);
        }
    }
    
    // 查询卡内余额
    public function getCharge()
    {
        $this->datas = $this->params;
        
        $this->findcard();
        
        $res = Db::table('idcard_card')->where('Cno', $this->datas['card_id'])->value('Charge');
        
        if (empty($res)) {
            $this->returnMsg(400, 'No record of this card');
        } else {
            $this->returnMsg(200, 'Success', $res);
        }
    }

    // 增加充值条目
    public function recordAdd()
    {
        $this->checkCardStatus();

        $record = [
            'Cno' => $this->datas['card_id'],
            'recordAdd' => $this->datas['charge_number'],
            'recordMinus' => 0,
            'time' => date('Y-m-d H-i-s'),
            'type' => 'Charge',
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
        $this->checkCardStatus();

        $record = [
            'Cno' => $this->datas['card_id'],
            'recordMinus' => $this->datas['consume_number'],
            'recordAdd' => 0,
            'time' => date('Y-m-d H-i-s'),
            'type' => $this->datas['type'],
        ];

        $res = Db::table('idcard_record')->insert($record);
        if (!empty($res)) {
            $this->returnMsg(200, 'Success');
        } else {
            $thsi->returnMsg(400, 'Failed');
        }
    }

    
    /* ------------------- 判断函数 --------------------------*/

    // 判断学生卡号是否存在
    public function findcard()
    {
        $res = Db::table('idcard_card')->where('Cno', $this->datas['card_id'])->find();
        if (empty($res)) {
            $this->returnMsg(400, 'Card not found');
        } else {
            return;
        }
    }

    // 查看卡的挂失状态
    private function checkCardStatus()
    {
        $this->findcard();

        $res = Db::table('idcard_card')->where('Cno', $this->datas['card_id'])->value('Status');

        if ($res == 0)
        {
            $this->returnMsg(400, 'This card has been freezed', $res);
        } else {
            return;
        }
    }
}
