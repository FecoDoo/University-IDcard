# API Server Developing Document

---
## Overview
This is a RESTful API for simple university ID card management system. Based on ThinkPHP 5.1

---
## Design

---
## Items

### Admin Module

## register()
* get student ID and check if it already exits, if not, then insert the imformation into database
* url Request(POST) : localhost/admin/register
* post parametersm
    
    | user_id | user_pwd | user_dept| user_name| user_birth | user_sex |
    | :-: | :-: | :-: | :-: | :-: | :-: |
    | int | string| string | string | datetime | string |
    | 学号 | 密码 | 学院 | 姓名 | 生日 | 性别 |

* Return data references:
```json
{
    "code": 200,
    "msg": "Success",
    "data": []
}
```

### User Module

### Card Module

### Book Module