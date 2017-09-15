<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <a href="?l=zh-cn" >简体中文</a> | <a href="?l=en-us" >English</a><br/>
    <a href="<?php echo U('detail',array('company_id' => 400700));?>"><?php echo (L("welcome")); ?></a>
</body>
</html>