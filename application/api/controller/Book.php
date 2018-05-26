<?php
namespace app\api\controller;

class Book extends Common
{
	public $datas; //获取参数
	
	/**
	 * [查询数据库中同名书籍]
	 */
    public function searchBook()
    {
        // parent::initialize('search_book');
        // $this->datas = $this->params;
        // $book_name = $this->datas['book_name'];
        // if (!empty($left = table('idcard_book')->where('book_name', $book_name)->value('left')))
        // {
        //     $this->returnMsg(200,'查询成功',$left);
        // } else {
        //     $this->returnMsg(400,'查无此书');
        // }
    }

    public function searchBorrow()
    {
        $this->datas = $this->params;
        $result = $this->datas['user_id'];
        var_dump($result);
    }
}
