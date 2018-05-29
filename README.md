# Use ThinkPHP 5.0 create restful api

---
## API编写前的相关配置(参数过滤)
* 在config/route.php中配置路由：实现api二级域名访问指定模块; 配置域名参数简写风格
* 在api模块的Common.php中配置公共方法：
    1. 初始化获取参数 
    2. 验证参数是否合理

* 在调用的控制器方法内(例如：User)，继承Common类
* 涉及具体url参数的定义，可以查阅config目录下route.php文件

---
## Admin模块

### 用户注册接口API

* url请求(POST) : localhost/admin/register
* post参数
    
    | user_id | user_pwd | user_dept| user_name| user_birth | user_sex |
    | :-: | :-: | :-: | :-: | :-: | :-: |
    | int | string| string | string | datetime | string |
    | 学号 | 密码 | 学院 | 姓名 | 生日 | 性别 |

* 返回数据参考:
```json
{
    "code": 200,
    "msg": "Success",
    "data": []
}
```

### 管理员找回用户密码接口API

* url请求(POST) : localhost/admin/findPwd
* post参数：

    | user_id |
    | :-: |
    | int |
    | 学号 |

* 返回数据参考:

```json
{
    "code": 200,
    "msg": "Success",
    "password": [123456]
}
``` 

### 管理员补卡接口API

* url请求(POST) : localhost/admin/replaceCard
* post参数：

    | card_id |
    | :-: |
    | int |
    | 卡号 |

* 返回数据参考:

```json
{
    "code": 200,
    "msg": "Success",
    "data":[]
}
``` 

---
## User模块

### 用户登陆接口API

* url请求(POST) : localhost/user/login
* post参数

    | user_id | user_pwd |
    | :-: | :-: |
    | int | string|
    | 学号 | 密码 |

* 返回数据参考:

```json
{
    "code": 200,
    "msg": "Success",
    "data": {
        "user_id": 201619630301,
    }
}
```

### 用户修改密码接口API

* url请求(POST) : localhost/user/changePwd
* post参数：


    | user_id | user_old_pwd | user_pwd |
    | :-: | :-: | :-: |
    | int | string | string |
    | 学号 | 旧密码 | 新密码 |

* 返回数据参考:

```json
{
    "code": 200,
    "msg": "Success",
    "data": []
}
``` 

### 用户查询个人信息接口API

* url请求(POST):localhost/user/getInfo
* POST参数:

    | user_id |
    | :-: |
    | int |
    | 学号 |

* 返回数据参考
```json
{
    "code": 200,
    "msg": "Success",
    "data": {
        "stuName":"吴鑫康",
        "stuNo":"201619630322",
        "stuDept":"国际学院",
        "stuSex":"男",
        "stuBirth":"1022",
        "stuPwd":"12345"
    }
}
```

* url请求(POST) : localhost/user/reportLoss
* post参数

    | card_id |
    | :-: |
    | int |
    | 卡号 |

* 返回数据参考:

```json
{
    "code": 200,
    "msg": "Success",
    "data": []
}
```

### 用户挂失接口API

* url请求(POST) : localhost/user/reportLoss
* post参数

    | card_id |
    | :-: |
    | int |
    | 卡号 |

* 返回数据参考:

```json
{
    "code": 200,
    "msg": "Success",
    "data": []
}
```

---
## 饭卡消费充值模块

### 查询卡内余额接口API

* URL请求(POST):localhost/card/getInfo
* POST参数

    | card_id |
    | :-: |
    | int |
    | 饭卡号 |

```json
{
    "code":200,
    "msg":"Success",
    "data":
        {
            "Charge":250
        },
```

### 查询消费记录信息接口API

* URL请求(POST):localhost/card/getRecord
* POST参数

    | card_id |
    | :-: |
    | int |
    | 饭卡号 |

```json
{
    "code":200,
    "msg":"Success",
    "data":[
        {
            "recordAdd":"200",
            "time":"2018-05-27 18:57:13",
            "recordMinus":0
        },
        {
            "recordAdd":0,
            "time":"2018-05-27 18:58:13",
            "recordMinus":"450"
        },
]
```

### 饭卡充值接口API

* URL请求(POST):localhost/card/charge
* POST参数

    | card_id | charge_number |
    | :-: | :-: |
    | int | int |
    | 饭卡号 | 充值金额 |


```json
{
    "code":200,
    "msg":"Success",
    "data":[]
}
```

### 饭卡消费接口API

* URL请求(POST):localhost/card/consume
* POST参数

    | card_id | consume_number | type |
    | :-: | :-: | :-: |
    | int | int | char |
    | 饭卡号 | 消费金额 | 消费类型 |


```json
{
    "code":200,
    "msg":"Success",
    "data":[]
}
```

---
## 图书管理模块

### 查询图书状态API

* url请求(POST):localhost/book/searchBook
* POST参数:
* 返回参数 1在馆 0借出
    
    | book_name |
    | :-: |
    | string |
    | 书名 |

* 返回数据参考
```json
{
    "code": 200,
    "msg": "Success",
    "data": {
        "status": 1,
    }
}
```

## 查询个人借书情况

* url请求(POST):localhost/book/searchBorrow
* POST参数:
    
    | user_id |
    | :-: |
    | string |
    | 学号 |

* 返回数据参考
```json
{
    "code":200,
    "msg":"Success",
    "data":[
        "数据库原理",
        "2018-05-27 00:00:00"
    ]
}
```