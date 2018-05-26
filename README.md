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
* post参数：user_id 、 user_pwd
    
    | user_id | user_pwd |
    | :-: | :-: |
    | string | string|
    | 用户名 | 用户密码 |

* 返回数据参考:
```json
{
    "code": 200,
    "msg": "Success",
    "data": []
}
```

### 用户找回密码接口API

* url请求(POST) : localhost/user/findPwd
* post参数：


    | user_id |
    | :-: |
    |string |
    | 用户名 |

* 返回数据参考:

```json
{
    "code": 200,
    "msg": "Success",
    "password": [123141223]
}
``` 

---
## User登陆模块

### 用户登陆接口API

* url请求(POST) : localhost/user/login
* post参数：user_id 、 user_pwd

    | user_id | user_pwd |
    | :-: | :-: |
    | string | string|
    | 用户名 | 用户密码 |

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
    | string | string | string |
    | 用户名 | 旧密码 | 新密码 |

* 返回数据参考:

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

### 用户查询个人信息接口API

* url请求(POST):localhost/user/getInfo
* POST参数:

    | user_id |
    | :-: |
    | string |
    | 学号 |

* 返回数据参考
```json
{
    "code": 200,
    "msg": "Success",
    "data": []
}
```
---
## 饭卡消费充值模块

---
## 图书管理模块

### 新增文章接口API

* 接口路由：Route::post('article', 'article/addArticle')
* url请求(POST) : localhost/article
* post参数： * 表示必须字段

    | time | token | article_uid | article_title | artcle_ctime | article_content |
    | :-: | :-: | :-: | :-: | :-: | :-: |
    | int | int | int |  string | int | string |
    | 时间戳 | 验证身份 | 用户ID | 文章标题 | 发布时间 | 文章内容 |

* 返回数据参考: (data为文章的id)

```json
{
    "code": 200,
    "msg": "新增文章成功！",
    "data": "5" 
}
``` 

### 文章列表接口API

* 接口路由：Route::get('articles/:time/:token/:user_id/[:num]/[:page]', 'article/getArticles')
* url请求(GET) : localhost/articles/1/1/2/2/1
* post参数： * 表示必须字段

    | time | token | user_id | num | page |
    | :-: | :-: | :-: | :-: | :-: |
    | int | int | int |  int | int |
    | 时间戳 | 验证身份 | 用户ID | 查询条数 | 查询页数 |

* 返回数据参考: 

```json
{
    "code": 200,
    "msg": "查询成功！",
    "data": {
        "articles": [
            {
                "article_id": 1,
                "article_ctime": 1523030209,
                "article_title": "太平洋战争",
                "user_nickname": "cici"
            },
            {
                "article_id": 2,
                "article_ctime": 1523030405,
                "article_title": "太平洋战争",
                "user_nickname": "cici"
            }
        ],
        "page_num": 4
    }
}
``` 

### 获取文章详情接口API

* 接口路由：Route::get('article/:time/:token/:article_id', 'article/articleDetail')
* url请求(GET) : localhost/article/1/1/8
* post参数： * 表示必须字段


    | time | token | article_id |
    | :-: | :-: | :-: |
    | int | int | int |
    | *时间戳 | *验证身份 | *文章ID |

* 返回数据参考: 

```json
{
    "code": 200,
    "msg": "查询成功！",
    "data": {
        "article_id": 8,
        "article_ctime": 1523159078,
        "article_title": "那年那月",
        "article_content": "<script>console.log('风华雪月，大漠孤烟直!')</script>",
        "user_nickname": "cici"
    }
}
``` 

### 修改文章接口API

* 接口路由：Route::put('article', 'article/updateArticle')
* url请求(PUT) : localhost/article
* put参数： * 表示必须字段  * x-www-form-urlencoded


    | time | token | article_id | article_title | article_content |
    | :-: | :-: | :-: | :-: | :-: |
    | int | int | int | string | string |
    | *时间戳 | *验证身份 | *文章ID | 文章标题 | 文章内容 |

* 返回数据参考: 

```json
{
    "code": 200,
    "msg": "修改文章成功!",
    "data": []
}
``` 

### 删除文章接口API

* 接口路由：Route::delete('article', 'article/deleteArticle')
* url请求(PUT) : localhost/article
* put参数： * 表示必须字段  * x-www-form-urlencoded


    | time | token | article_id | 
    | :-: | :-: | :-: |
    | int | int | int |
    | *时间戳 | *验证身份 | *文章ID |

* 返回数据参考: 

```json
{
    "code": 200,
    "msg": "删除文章成功!",
    "data": []
}
``` 