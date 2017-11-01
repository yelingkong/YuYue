<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>登录</title>
    <link href="/Public/css/login.css" rel="stylesheet" type="text/css" media="all" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <script src="http://apps.bdimg.com/libs/jquery/1.9.0/jquery.min.js"></script>
</head>

<body>
    <div class="login-form">
        <div class="top-login">
            <span><img src="/Public/images/group.png" alt=""/></span>
        </div>
        <h1>登录</h1>
        <div class="login-top">
            <form>
                <div class="login-ic">
                    <i></i>
                    <input name="username" type="text" value="" />
                    <div class="clear"> </div>
                </div>
                <div class="login-ic">
                    <i class="icon"></i>
                    <input name="password" type="password" value="" />
                    <div class="clear"> </div>
                </div>
                <div class="log-bwn">
                    <input type="button" onclick="login.check()" value="登录">
                </div>
            </form>
        </div>
        <p class="copy">预约留言管理系统</p>
    </div>
    <script>
    $(document).keyup(function(event) {
        if (event.keyCode == 13) {
            login.check();
        }
    });
    </script>
    <script src="/Public/js/jquery.js"></script>
    <script src="/Public/js/layer/layer.js"></script>
    <script src="/Public/js/dialog.js"></script>
    <script src="/Public/js/admin/login.js"></script>
</body>

</html>