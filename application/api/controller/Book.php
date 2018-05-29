<?php
namespace app\api\controller;

use think\Db;

class Book extends Common
{
    public $datas; //获取参数

    /**
     * [查询数据库中同名书籍]
     */
    public function searchBook()
    {
        $this->datas = $this->params;
        $book_name = $this->datas['book_name'];
        if (!empty($left = Db::table('idcard_book')->where('Bname', $book_name)->find())) {
            $this->returnMsg(200, 'Success', $left);
        } else {
            $this->returnMsg(400, 'No such a book');
        }
    }
    
    // 搜索某本书的信息
    public function searchBorrow()
    {
        $this->datas = $this->params;
        if (!empty($temp = Db::table('idcard_borrow')->where('Sno', $this->datas['user_id'])->find())) {
            $result = array();
            array_push($result, Db::table('idcard_book')->where('Bno', $temp['Bno'])->value('Bname'));
            array_push($result, $temp['Time']);
            $this->returnMsg(200, 'Success', $result);
        } else {
            $this->returnMsg(400, 'Nothing');
        }
    }
}
