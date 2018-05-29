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
        if (!empty($left = Db::table('idcard_book')->where('Bname', $book_name)->select())) {
            $this->returnMsg(200, 'Success', $left);
        } else {
            $this->returnMsg(400, 'No such a book');
        }
    }
    
    /**
     * [查询个人借书记录]
     */
    public function searchBorrow()
    {
        $this->datas = $this->params;
        if (!empty($temp = Db::table('idcard_borrow')->where('Sno', $this->datas['user_id'])->select())) {
            $result = array();
            foreach ($temp as $tp) {
                $res = [
                    "Book" => Db::table('idcard_book')->where('Bno', $tp['Bno'])->value('Bname'),
                    "Time" => $tp['Time']
                ];
                $result[] = $res;
            }
            $this->returnMsg(200, 'Success', $result);
        } else {
            $this->returnMsg(400, 'Nothing');
        }
    }
}
