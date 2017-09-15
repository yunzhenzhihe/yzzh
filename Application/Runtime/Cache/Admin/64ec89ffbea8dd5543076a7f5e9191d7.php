<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script type="text/javascript" src="./Public/Admin/js/jquery-1.8.3.min.js"></script>
    <title>Document</title>
</head>
<body>
<form action="" method="post">


        <h1><?php echo (L("Order details")); ?></h1>
    <?php if(is_array($data["goods_attr"])): foreach($data["goods_attr"] as $key=>$vol): echo ($key); ?>:<?php echo ($vol); ?><br/><?php endforeach; endif; ?>

    <!--<?php echo (L("Order number")); ?>：<strong><?php echo ($data["order_number"]); ?></strong><br/>-->
    <!--<?php echo (L("Commodity name")); ?>：<strong><?php echo ($data["goods_name"]); ?></strong><br/>-->
    <!--<?php echo (L("Commodity price")); ?>：<strong>￥<?php echo ($data["goods_price"]); ?></strong><br/>-->
    <!--<?php echo (L("Commodity quantity")); ?>：<strong><?php echo ($data["goods_number"]); ?></strong><br/>-->
    数量：<strong><?php echo ($data["goods_number"]); ?></strong><br/>
    收货人姓名：<strong><?php echo ($data["user_name"]); ?></strong><br/>
    收货人地址：<strong><?php echo ($data["user_address"]); ?></strong><br/>
    收货人电话：<strong><?php echo ($data["user_telephone"]); ?></strong><br/>
    支付方式：<?php if($data["user_pay"] == 1): ?><strong>支付宝</strong><br/>

    <?php elseif($data["user_pay"] == 2): ?>
    <strong>微信</strong><br/>
    <?php elseif($attr["check"] == 3): ?>
    <strong>微信</strong><br/><?php endif; ?><br/>

    <a href="<?php echo U('del',array('order_number' => $data['order_number']));?>">删除订单</a><br/>
    <input type="submit" id="send" value="<?php echo (L("payment")); ?>">
</form>

</body>
<script>
    $("#send").click(function(){
        alert('支付成功');
    })
</script>

</html>