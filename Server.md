# API Server Developing Document

---
## Doc Menu
[TOC]

---
## Overview
This is a RESTful API which is specially developed for Simple University ID Card Management System. Based on ThinkPHP 5.1 MVC Architecture

---
## Design
* Parameter filtering : Configure the route at the **config/route.php**; implement the Api second-level domain name access module; configure domain name parameter abbreviated style.
* Configure public methods in the **Common.php** of the api module:
    1. Initialize access parameters
    2. Check the parameters are reasonable or not

* Inherit the **Common** class within the calling controller method (eg **User**)
* For definitions of specific url parameters, consult the **route.php** file in the **config** directory.

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
## Admin Module

### Administrator login API

* url Request(POST) : localhost/admin/login
* post parameter
    
    | user_id | user_pwd |
    | :-: | :-: |
    | int | string|
    | Admin account | password |

* Return data references:
```json
{
    "code": 200,
    "msg": "Success",
    "data": []
}
```

### register()
* get student ID and check if it already exits, if not, then insert the imformation into database
* url Request(POST):*localhost/admin/register*
* post parameter：
    
    | user_id | user_pwd | user_dept| user_name| user_birth | user_sex |
    | :-: | :-: | :-: | :-: | :-: | :-: |
    | int | string| string | string | datetime | string |
    | Student number | Password | Department | Name | Birth | Sex |

* Return data references:
```json
{
    "code": 200,
    "msg": "Success",
    "data": []
}
```

### Administrator find password
* url request(POST):*localhost/admin/findPwd*
* post parameter：

    | user_id |
    | :-: |
    | int |
    | Student number |

* Return data reference:

```json
{
    "code": 200,
    "msg": "Success",
    "data": {
        "Spwd": [12345]
    }
}
```

### Administrator patch card

* url request(POST):*localhost/admin/replaceCard*
* post parameter：

    | card_id |
    | :-: |
    | int |
    | Card number |

* Return data reference:

```json
{
    "code": 200,
    "msg": "Success",
    "data":[]
}
``` 

---

## User Module

### User login

* url request(POST):*localhost/user/login*
* post parameter：

    | user_id | user_pwd |
    | :-: | :-: |
    | int | string|
    | Student number | Password |

* Return data reference:

```json
{
    "code": 200,
    "msg": "Success",
    "data": []
}
```

### User change password

* url request(POST):*localhost/user/changePwd*
* post parameter：

    | user_id | user_old_pwd | user_pwd |
    | :-: | :-: | :-: |
    | int | string | string |
    | Student number | Old Password | New Password |

* Return data reference:

```json
{
    "code": 200,
    "msg": "Success",
    "data": []
}
``` 

### User get information

* url request(POST):*localhost/user/getInfo*
* POST parameter:

    | user_id |
    | :-: |
    | int |
    | Student number |

* Return data reference:
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

### User report loss

* url request(POST):*localhost/user/reportLoss*
* post parameter：

    | card_id |
    | :-: |
    | int |
    | Card number |

* Return data reference:

```json
{
    "code": 200,
    "msg": "Success",
    "data": []
}
```

---

## Card Module

### Select charge

* URL request(POST):*localhost/card/getCharge*
* POST parameter：

    | card_id |
    | :-: |
    | int |
    | Card number |

```json
{
    "code":200,
    "msg":"Success",
    "data":
        {
            "Charge":250
        },
```

### Select expenses record

* URL request(POST):*localhost/card/getRecord*
* POST parameter：

    | card_id |
    | :-: |
    | int |
    | Card number |

* Return data reference:

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
```

### Recharge card

* URL request(POST):*localhost/card/charge*
* POST parameter：

    | card_id | charge_number |
    | :-: | :-: |
    | int | int |
    | Card number | Charge number |

* Return data reference:

```json
{
    "code":200,
    "msg":"Success",
    "data":[]
}
```

### Card consume

* URL request(POST):*localhost/card/consume*
* POST parameter：

    | card_id | consume_number | type |
    | :-: | :-: | :-: |
    | int | int | char |
    | Card number | Consume number | Consume type |

* Return data reference:
```json
{
    "code":200,
    "msg":"Success",
    "data":[]
}
```

---

## Book Module

### Search book

* url request(POST):*localhost/book/searchBook*
* POST parameter:
* return parameter: 1-at library, 0-lent out
    
    | book_name |
    | :-: |
    | string |
    | Book name |

* Return data reference:
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

### Search user borrow book

* url request(POST):*localhost/book/searchBorrow*
* POST parameter:
    
    | user_id |
    | :-: |
    | int |
    | Student number |

* Return data reference:
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

## Borrow book API

* url Request(POST):*localhost/book/borrow*
* POST parameters:
    
    | book_id | user_id |
    | :-: | :-: |
    | int | int |
    | Book number | Student number |

* Return data reference:
```json
{
    "code":200,
    "msg":"Success",
    "data": []
}
```