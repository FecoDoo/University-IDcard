# Use ThinkPHP 5.0 create restful api

---
## Doc Menu

[TOC]

---
## API编写前的相关配置(参数过滤)
* 在config/route.php中配置路由：实现api二级域名访问指定模块; 配置域名参数简写风格
* 在api模块的Common.php中配置公共方法：
    1. 初始化获取参数 
    2. 验证参数是否合理

* 在调用的控制器方法内(例如：User)，继承Common类
* 涉及具体url参数的定义，可以查阅config目录下route.php文件

---
## Stucture

```tree
├─application         
│  ├─api              
│  │  └─controller    
│  └─index            
│      └─controller   
├─config              
├─extend              
├─images              
│  ├─admin            
│  ├─login            
│  └─user             
├─public                       
├─route               
├─runtime             
│  └─log              
│      └─201805       
├─thinkphp            
│  ├─lang             
│  ├─library          
│  │  ├─think         
│  │  │  ├─cache      
│  │  │  │  └─driver  
│  │  │  ├─config     
│  │  │  │  └─driver  
│  │  │  ├─console    
│  │  │  │  ├─bin     
│  │  │  │  ├─command 
│  │  │  │  │  ├─make 
│  │  │  │  │  │  └─st
│  │  │  │  │  └─optim
│  │  │  │  ├─input   
│  │  │  │  └─output  
│  │  │  │      ├─desc
│  │  │  │      ├─driv
│  │  │  │      ├─form
│  │  │  │      └─ques
│  │  │  ├─db         
│  │  │  │  ├─builder 
│  │  │  │  ├─connecto
│  │  │  │  └─exceptio
│  │  │  ├─debug      
│  │  │  ├─exception  
│  │  │  ├─facade     
│  │  │  ├─log        
│  │  │  │  └─driver  
│  │  │  ├─model      
│  │  │  │  ├─concern 
│  │  │  │  └─relation
│  │  │  ├─paginator  
│  │  │  │  └─driver  
│  │  │  ├─process    
│  │  │  │  ├─exceptio
│  │  │  │  └─pipes   
│  │  │  ├─response   
│  │  │  ├─route      
│  │  │  │  └─dispatch
│  │  │  ├─session    
│  │  │  │  └─driver  
│  │  │  ├─template   
│  │  │  │  ├─driver  
│  │  │  │  └─taglib  
│  │  │  ├─validate   
│  │  │  └─view       
│  │  │      └─driver 
│  │  └─traits        
│  │      └─controller
│  └─tpl
└─vendor
```

---
## Admin模块

### 管理员登录模块

* url请求(POST) : localhost/admin/login
* post参数
    
    | user_id | user_pwd |
    | :-: | :-: |
    | int | string|
    | 管理员账号 | 密码 |

* 返回数据参考:
```json
{
    "code": 200,
    "msg": "Success",
    "data": []
}
```

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
    "data": {
        "Spwd": "12345"
    }
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
    "data": []
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
        "Sname": "吴鑫康",
        "Sdpt": "国际学院",
        "Ssex": "男",
        "Sbirth":"1998-01-01",
        "Spwd": "12345",
        "Sno":1,
        "Srtime": "2018-05-27 17:45:24"
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

* URL请求(POST):localhost/card/getCharge
* POST参数

    | card_id |
    | :-: |
    | int |
    | 饭卡号 |

```json
{
    "code":200,
    "msg":"Success",
    "data":{
            "Charge":250
        },
}
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
            "recordMinus":0,
            "type": "Charge"
        },
        {
            "recordAdd":0,
            "time":"2018-05-27 18:58:13",
            "recordMinus":"450",
            "type": "食堂消费"
        },
    ]
}
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

### 查询图书信息API

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
    "data": [
        {
            "Bno": 1,
            "Bname": "数据库原理",
            "Status": 1,
            "Publisher": "机械工业出版社",
            "Version": "18年第一版",
            "Type": "软件工程"
        }
    ]
}
```

## 查询个人借书情况

* url请求(POST):localhost/book/searchBorrow
* POST参数:
    
    | user_id |
    | :-: |
    | int |
    | 学号 |

* 返回数据参考
```json
{
    "code":200,
    "msg":"Success",
    "data": [
        {
            "Book": "计算机网络",
            "Time": "2018-05-29 20:44:39"
        },
        {
            "Book": "计算机网络",
            "Time": "2018-05-29 20:43:17"
        }
    ]
}
```

## 借阅书籍API

* url请求(POST):localhost/book/borrow
* POST参数:
    
    | book_id | user_id |
    | :-: | :-: |
    | int | int |
    | 书号 | 学号 |

* 返回数据参考
```json
{
    "code":200,
    "msg":"Success",
    "data": []
}
```