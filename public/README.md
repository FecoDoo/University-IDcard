# Front-end doc

Bootstrap/jQuery/Ajax University-IDCard system for user and administrator

<br>

## Doc Menu

[TOC]

---
<br>

## Project Structure

~~~
├─admin						admin html files
├─assets					css/js/fonts for admin and user page
│  ├─css					css files including bootstrap, font-awesome and custom-style
│  ├─font-awesome			fonts form font-awesome
│  │  └─fonts
│  ├─fonts					fonts from glyphicons
│  └─js						js files including dataTables, morris, bootstrap, custom-style
│      ├─dataTables			js files for creating data table
│      └─morris				js files for creating morris charts
├─css						css files for index page
├─sass						sass files for style
├─static					css/js/fonts for index page
└─user						user html files
~~~

---
<br>

## Import css/js framework and library

### css framework:
* Bootstrap.css

### js library:
* jQuery.js

### other css/js files:
* font-awesome.css

* morris.js

---
<br>

## Custom css/js file
* custom-styles.css

* custom-scripts.js

---
<br>

### JSON format got from back-end
* "code" : status code

* "msg" : message need to be show

* "data" : data need to be show

```json
{
	"code" : 200,
	"msg" : "xxx",
	"data" : {
		"xxx"
	}
}
```

---
<br>

## Login


> By reading the restful api from back-end, make sure the json format and use different ajax to request logining depending on the login type. According to the returned message, show diffenent messages below. If login successfully, jump to the relevant homepage. This or other pages' format of ajax just like below:

```js
  $(document).ready(function(){
    $("#login").click(function(){
      // ajax判断用户名密码是否正确
      if ($("#type").val() == "用户") {
        $.ajax({
          type: "POST",
          url: "/user/login",
          data: {
            user_id: $("#number").val(),
            user_pwd: $("#password").val()
          },
          dataType: "json",
          success: function(data){
            if (data.code == 200) {
              $("#warning").removeClass();
              $("#warning").addClass("alert alert-success");
              $("#warning").html(data.msg);
              window.location.href = "/user/homepage.html";
            }else{
              $("#warning").removeClass();
              $("#warning").addClass("alert alert-danger");
              $("#warning").html(data.msg);
            }
          },
          error: function(jqXHR){
            $("#warning").removeClass();
            $("#warning").addClass("alert alert-danger");
            $("#warning").html("发生错误：" + jqXHR.status);
          }
        });
      }else if ($("#type").val() == "管理员") {
        $.ajax({
          type: "POST",
          url: "/admin/login",
          data: {
            admin_id: $("#number").val(),
            admin_pwd: $("#password").val()
          },
          dataType: "json",
          success: function(data){
            if (data.code == 200) {
              $("#warning").removeClass();
              $("#warning").addClass("alert alert-success");
              $("#warning").html(data.msg);
              window.location.href = "/admin/homepage.html";
            }else{
              $("#warning").removeClass();
              $("#warning").addClass("alert alert-danger");
              $("#warning").html(data.msg);
            }
          },
          error: function(jqXHR){
            $("#warning").removeClass();
            $("#warning").addClass("alert alert-danger");
            $("#warning").html("发生错误：" + jqXHR.status);
          }
        });
      }
    });
  });
```

---
<br>

## User

### homepage
Welcome page.
<br>
<br>
![image](http://github.com/Fecodoo/University-IDcard/raw/master/images/user/5.png)

### balance
Show the balance and transaction table of the user.
<br>
<br>
![image](http://github.com/Fecodoo/University-IDcard/raw/master/images/user/6.png)

The implementation of the transaction table or other tables just like below:

```html
<table class="table table-striped table-bordered table-hover" id="transaction-table">
    <thead>
        <tr>
            <th>交易时间</th>
            <th>交易类型</th>
            <th>交易金额</th>
        </tr>
    </thead>
    <tbody>
        <tr id="cloneTr">
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </tbody>
</table>
```


```js
$.ajax({
    type: "POST",
    url: "/card/getRecord",
    data: {
      card_id: 654321,
    },
    dataType: "json",
    success: function(data){
        var tr = $("#cloneTr");
        $.each(data.data, function(index, item){
            //克隆tr，每次遍历可以产生新的tr
            var clonedTr = tr.clone();
            var _index = index;

            //循环遍历cloneTr的每一个td元素，并赋值
            clonedTr.children("td").each(function(inner_index){

                //根据索引为每一个td赋值
                switch(inner_index){
                    case(0):
                        $(this).html(item.time);
                        break;
                    case(1):
                        $(this).html(item.type);
                        break;
                    case(2):
                        if (item.recordAdd == 0) {
                            $(this).html("-" + item.recordMinus);
                        }else{
                            $(this).html(item.recordAdd);
                        }
                        break;
                } //end switch
            }); //end children.each
            //把克隆好的tr追加到原来的tr后面
            clonedTr.insertAfter(tr);
        }); //end $each
        $("#cloneTr").hide(); //隐藏id=clone的tr，因为该tr中的td没有数据
        $("#transaction-table").show();
    },
    error: function(jqXHR){
      alert("发生错误：" + jqXHR.status);
    }
});
```

### recharge
Input student number and recharge amount to recharge.
<br>
<br>
![image](http://github.com/Fecodoo/University-IDcard/raw/master/images/user/10.png)

### consume
Input student number and consume amount for a simulation consumption.
<br>
<br>
![image](http://github.com/Fecodoo/University-IDcard/raw/master/images/user/14.png)

### report_lose
Input student number to report lose.
<br>
<br>
![image](http://github.com/Fecodoo/University-IDcard/raw/master/images/user/15.png)

### schedule
Show the schedule of the user.
<br>
<br>
![image](http://github.com/Fecodoo/University-IDcard/raw/master/images/user/16.png)

### research_book
Input book name to research book or input book number to borrow book.
<br>
<br>
![image](http://github.com/Fecodoo/University-IDcard/raw/master/images/user/19.png)

### borrowed_book
Show the amount of the borrowed book of the user and borrow-table for details.
<br>
<br>
![image](http://github.com/Fecodoo/University-IDcard/raw/master/images/user/20.png)

### profile
Show the information of the user.
<br>
<br>
![image](http://github.com/Fecodoo/University-IDcard/raw/master/images/user/1.png)
![image](http://github.com/Fecodoo/University-IDcard/raw/master/images/user/2.png)

### password_change
Input uesr number, old password and new password to change password.
<br>
<br>
![image](http://github.com/Fecodoo/University-IDcard/raw/master/images/user/3.png)

---
<br>

## Admin

### homepage
Welcome page.
<br>
<br>
![image](http://github.com/Fecodoo/University-IDcard/raw/master/images/admin/5.png)

### create_card
Input user information to create card.
<br>
<br>
![image](http://github.com/Fecodoo/University-IDcard/raw/master/images/admin/26.png)

### patch_card
Input card id to patch_card
<br>
<br>
![image](http://github.com/Fecodoo/University-IDcard/raw/master/images/admin/28.png)

### recharge
Input student number and recharge amount to recharge for students.
<br>
<br>
![image](http://github.com/Fecodoo/University-IDcard/raw/master/images/admin/32.png)

## consume
Select consume type, consume number and consume amount to consume for students.
<br>
<br>
![image](http://github.com/Fecodoo/University-IDcard/raw/master/images/admin/36.png)

## statistics
Input student number to search information of the student.
<br>
<br>
![image](http://github.com/Fecodoo/University-IDcard/raw/master/images/admin/39.png)

## password_find
Input student number to find his password.
<br>
<br>
![image](http://github.com/Fecodoo/University-IDcard/raw/master/images/admin/40.png)
