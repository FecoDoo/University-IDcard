# Front-end doc

---
## Doc Menu

[TOC]

---
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
## Import css/js framework and library

### css framework:
* Bootstrap.css

### js library:
* jQuery.js

### other css/js files:
* font-awesome.css

* morris.js

---
## Custom css/js file
* custom-styles.css

* custom-scripts.js

---
## Login

> A login page for both user and administrator<br>

By reading the restful api from back-end, make sure the json format and use different ajax to request logining depending on the login type. According to the returned message, show diffenent messages below. If login successfully, jump to the relevant homepage. This or other pages' format of ajax just like below:

```js
<script type="text/javascript">
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
</script>
```

---
## User

### balance


