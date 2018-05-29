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
        $this->checkBookExist($book_name);
        
        $left = Db::table('idcard_book')->where('Bname', $book_name)->select();
        if (empty($left))
        {
            $this->returnMsg(400, 'Failed');
        } else {
            $this->returnMsg(200, 'Success', $left);
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

    /**
     * [借阅书籍函数]
     */
    public function borrow()
    {
        $this->datas = $this->params;
        $book_id = $this->datas['book_id'];
        
        $res = Db::table('idcard_book')->where('Bno', $book_id)->update(['Status' => 0]);
        if (empty($res))
        {
            $this->returnMsg(400, 'Operation failed');
        } else {
            $data = [
                'Sno' => $this->datas['user_id'],
                'Bno' => $this->datas['book_id'],
                'Time' => date('Y-m-d H:i:s')
            ];
            $res = Db::table('idcard_borrow')->insert($data);
            if (!empty($res))
            {
                $this->returnMsg(200, 'Success');
            } else {
                $this->returnMsg(400, 'Failed');
            }
        }

    }

    /* ------------- 工具函数 ------------------*/

    protected function checkBookExist($name)
    {
        $res = Db::table('idcard_book')->where('Bname', $name)->find();

        if (empty($res))
        {
            $this->returnMsg(400, 'Book does not exist');
        } else {
            return true;
        }
    }
}
