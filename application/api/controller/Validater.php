<?php
namespace app\api\controller;

use think\Validate;

class Validater extends Validate
{
    protected $rule = [
        'user_id' => ['require', 'length' => 12],
        'user_pwd' => ['require', 'max' => 16],
        'book_name' => ['require', 'max' => 16],
    ];

    protected $message = [
        'user_id.require' => 'Student id is required',
        'user_id.length' => 'Student id length is 12',
        'user_pwd.require' => 'Password iss required',
        'user_pwd.max' => 'Password is too long',
        'book_name.require' => 'Book name is required',
        'book_name.max' => 'Max length of the book name is 16',
    ];

    protected $scene = [
        'user/login' => ['user_id', 'user_pwd'],
        'user/changePwd' => ['user_id', 'user_old_pwd', 'user_pwd'],
        'user/getInfo' => ['user_id'],
        'admin/findPwd' => ['user_id'],
        'book/searchbook' => ['user_id', 'book_name'],
        'book/searchborrow' => ['user_id'],
    ];

    protected function initialize()
    {
        parent::initialize($this->rule, $this->message);
    }
}
