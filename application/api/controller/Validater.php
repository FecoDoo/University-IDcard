<?php
namespace app\api\controller;

use think\Validate;

class Validater extends Validate
{
    protected $rule = [
        'user_id' => ['require', 'max' => 10],
        'user_pwd' => ['require', 'max' => 20],
        'user_name' => ['require', 'max' => 30],
        'user_birth' => ['require', 'date'],
        'user_dept' => ['require', 'max' => 30],
        'user_sex' => ['require', 'max' => 3],
        
        'book_name' => ['require', 'max' => 16],

        'card_id' => ['require', 'max'=> 10],
        'charge_number' => ['require', 'max' => 5],
        'consume_number' => ['require', 'max' => 5],

    ];

    protected $message = [
        'user_id.require' => 'Student id is required',
        'user_id.length' => 'Student id max length is 10',
        'user_pwd.require' => 'Password is required',
        'user_pwd.max' => 'Password is max length 20',
        'user_name.require' => 'Student name is required',
        'user_name.length' => 'Student name max length is 10',
        'user_birth.require' => 'Student birth is required',
        'user_birth.date' => 'Student birth must be datetime',
        'user_dept.require' => 'Student department is required',
        'user_dept.length' => 'Student department max length is 10',
        'user_sex.require' => 'Student sex is required',
        'user_sex.max' => 'Student sex attribute is too long',

        'book_name.require' => 'Book name is required',
        'book_name.max' => 'Max length of the book name is 16',

        'card_id.require' => 'Card id is required',
        'card_id.max' => 'Card id max length is 10',
        'charge_number.require' => 'Charge number is required',
        'charge_number.max' => 'Charge number max is 99999',
        'consume_number.require' => 'Consume number is required',
        'consume_number.max' => 'Consume number max is 99999',
    ];

    protected $scene = [
        'user/login' => ['user_id', 'user_pwd'],
        'user/changePwd' => ['user_id', 'user_old_pwd', 'user_pwd'],
        'user/getInfo' => ['user_id'],

        'admin/findPwd' => ['user_id'],
        'admin/register' => ['user_id','user_pwd','user_name', 'user_dept','user_birth','user_sex'],

        'book/searchBook' => ['book_name'],
        'book/searchBorrow' => ['user_id'],

        'card/charge' => ['card_id','charge_number'],
        'card/getInfo' => ['card_id'],
        'card/getRecord' => ['card_id'],
        'card/consume' => ['card_id','consume_number'],
    ];

    protected function initialize()
    {
        parent::initialize($this->rule, $this->message);
    }
}
