<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>详细页面</title>
	<meta name="keywords" content="[!--pagekey--]" />
	<meta name="description" content="[!--pagedes--]" />
	<link href="./Public/Admin/images3/all.css" type="text/css" rel="stylesheet" />
	<script type="text/javascript" src="/Public/Admin/js3/jquery.js"></script>
	<script type="text/javascript" src="./Public/Admin/js3/myfocus-2.0.1.min.js"></script>
	<script type="text/javascript" src="./Public/Admin/js3/SuperSlide.js"></script>
	<script src="./Public/Admin/laydate/laydate.js"></script>
</head>

<body>
<header>

</header>

<div class="xiangqing">


	<div class="sj-wrapper">


		<div class="game163 fl">
			<ul class="bigImg">
				<li>
					<a href="" target="_blank"><img src="./Public/Admin/images3/pic1.jpg" /></a>
					<h4><a href="" target="_blank">美女玩家猎魔人 Cosplay</a></h4>
				</li>
				<li>
					<a href="" target="_blank"><img src="./Public/Admin/images3/pic2.jpg" /></a>
					<h4><a href="#">《第2次机战OG》魔装机神系机体情报</a></h4></li>
				<li>
					<a href="" target="_blank"><img src="./Public/Admin/images3/pic3.jpg" /></a>
					<h4><a href="#">Dreamhack冬季赛：Hero夺冠 香槟狂欢</a></h4>
				</li>
				<li>
					<a href="" target="_blank"><img src="./Public/Admin/images3/pic4.jpg" /></a>
					<h4><a href="#">妹子战丧尸！Bioware王牌画师插画赏</a></h4>
				</li>
				<li>
					<a href="" target="_blank"><img src="./Public/Admin/images3/pic5.jpg" /></a>
					<h4><a href="#">《刺客信条3》简体中文版已送审</a></h4>
				</li>
				<li>
					<a href="" target="_blank"><img src="./Public/Admin/images3/list1.jpg" /></a>
					<h4><a href="#">《上古世纪》 中文版截图独家曝光</a></h4>
				</li>
				<li>
					<a href="" target="_blank"><img src="./Public/Admin/images3/list2.jpg" /></a>
					<h4><a href="#">本周精选大湿级Cos欣赏 佐助亲吻小樱</a></h4>
				</li>
				<li>
					<a href="" target="_blank"><img src="./Public/Admin/images3/list3.jpg" /></a>
					<h4><a href="#">《斗仙》11月29日封测 试玩截图首曝</a></h4>
				</li>
			</ul>

			<div class="smallScroll">
				<a class="sPrev" href="javascript:void(0)">←</a>
				<div class="smallImg">
					<ul>
						<li><a><img src="./Public/Admin/images3/pic1.jpg" /></a></li>
						<li><a><img src="./Public/Admin/images3/pic2.jpg" /></a></li>
						<li><a><img src="./Public/Admin/images3/pic3.jpg" /></a></li>
						<li><a><img src="./Public/Admin/images3/pic4.jpg" /></a></li>
						<li><a><img src="./Public/Admin/images3/pic5.jpg" /></a></li>
						<li><a><img src="./Public/Admin/images3/list1.jpg" /></a></li>
						<li><a><img src="./Public/Admin/images3/list2.jpg" /></a></li>
						<li><a><img src="./Public/Admin/images3/list3.jpg" /></a></li>
					</ul>
				</div>
				<a class="sNext" href="javascript:void(0)">→</a>
			</div>

			<div class="pageState"></div>

		</div>
		<div class="jieshao fr">
			<div class="title"><?php echo ($goodsInfo["goods_name"]); ?></div>
			<div class="jg clearfix">
				<form action="<?php echo U('Order/add');?>" method="post">
					<ul>
						<li><span class="short">价 格</span><span class="price red">¥<?php echo ($goodsInfo["goods_price"]); ?></span></li>
						<?php if(is_array($goodsAttr)): $i = 0; $__LIST__ = $goodsAttr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$attr): $mod = ($i % 2 );++$i; if($attr["check"] == 3): ?><li><span class="short" name="<?php echo ($attr["attr"]); ?>"><?php echo ($attr["attr"]); ?></span>
									<?php if(is_array($attr["value"])): foreach($attr["value"] as $key=>$att): ?><span><input type="radio" name="<?php echo ($attr["attr"]); ?>" value="<?php echo ($att); ?>" /><?php echo ($att); ?>&nbsp;&nbsp;</span><?php endforeach; endif; ?>
								</li>
								<?php elseif($attr["check"] == 4): ?>
								<li><span class="short" name="<?php echo ($attr["attr"]); ?>"><?php echo ($attr["attr"]); ?></span>
									<?php if(is_array($attr["value"])): foreach($attr["value"] as $key=>$att): ?><span><input type="checkbox" name="<?php echo ($attr["attr"]); ?>[]" value="<?php echo ($att); ?>" /><?php echo ($att); ?>&nbsp;&nbsp;</span><?php endforeach; endif; ?>
								</li>
								<?php elseif($attr["check"] == 1): ?>
								<li><span class="short" name="<?php echo ($attr["attr"]); ?>"><?php echo ($attr["attr"]); ?></span>
									<span><input type="text" name="<?php echo ($attr["attr"]); ?>"/></span>
								</li>
								<?php elseif($attr["check"] == 5): ?>
								<li><span class="short" name="<?php echo ($attr["attr"]); ?>"><?php echo ($attr["attr"]); ?></span>
										<select id="designType" class="blockBox" name="<?php echo ($attr["attr"]); ?>">
											<?php if(is_array($attr["value"])): foreach($attr["value"] as $key=>$att): ?><option value="<?php echo ($att); ?>"><?php echo ($att); ?></option><?php endforeach; endif; ?>
										</select>
								</li>
								<?php elseif($attr["check"] == 2): ?>
								<li class="product">
									<span class="short" name="<?php echo ($attr["attr"]); ?>"><?php echo ($attr["attr"]); ?></span>
										<div style="width:500px; margin:0px auto;">
											<input placeholder="请输入日期" name="<?php echo ($attr["attr"]); ?>" class="laydate-icon" onclick="laydate()">
										</div>
								</li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
						<li><span class="short">数 量</span><span class="jian"></span><span><input type="text" name="amount" class="num" value="1" /></span><span class="jia"></span></li>
						<li><span class="short">收货人姓名</span><input type="text" name="user_name"/></li>
						<li><span class="short">收货人地址</span><input type="text" name="user_address"/></li>
						<li><span class="short">收货人电话</span><input type="text" name="user_telephone"/></li>
						<li><span><?php echo (L("Payment method")); ?>：</span>
						<span>支付宝<input type="radio" checked="checked" name="user_pay" value="1" onclick="bind(this,'radio')">&nbsp;&nbsp;
							微信<input type="radio" name="user_pay" value="2" onclick="bind(this,'radio')">&nbsp;&nbsp;
							银联<input type="radio" name="user_pay" value="3" onclick="bind(this,'radio')"></span></li><br/><br/>
					</ul>
					<input type="submit" value="立即购买">
				</form>
			</div>

		</div>
		<div class="clearfix"></div>
	</div>

	<div class="sj-center sj-wrapper clearfix">
		<ul>
			<li><a href=""><img src="./Public/Admin/images3/pc_bao_new.png" /></a><p class="da"><a href="">全场免运费</a></p><p><a href="">无最低消费限制</a></p></li>
			<li><a href=""><img src="./Public/Admin/images3/pc_seven_new.png" /></a><p class="da"><a href="">七天无理由退款</a></p><p><a href="">轻松购物有保障</a></p></li>
			<li><a href=""><img src="./Public/Admin/images3/pc_pei_new.png" /></a><p class="da"><a href="">退货补贴运费</a></p><p><a href="">轻松购物有保障</a></p></li>
			<li><a href=""><img src="./Public/Admin/images3/pc_fan_new.png" /></a><p class="da"><a href="">先行赔付</a></p><p><a href="">轻松购物有保障</a></p></li>
		</ul>
	</div>



	<div class="slideTxtBox sj-wrapper">
		<div class="hd">
			<ul>
				<li><a href="javascript:void()">商品详情</a></li>
				<li><a href="javascript:void()">购买评价(908)</a></li>
				<li><a href="javascript:void()">购物晒单(44)</a></li>
				<li><a href="javascript:void()">成交记录(4650)</a></li>
				<li><a href="javascript:void()">咨询(153)</a></li>
				<li class="car"><a href="">加入购物车</a></li>
			</ul>
		</div>
		<div class="bd">
			<ul>
				<div class="sp">
					<dl>
						<dd>货号： 1220</dd>
						<dd>提拎部件： 软把</dd>
						<dd>背包方式： 单肩斜挎手提</dd>
						<dd>PU特征： 软面</dd>
						<dd>包袋大小： 小（最长边20-30cm）</dd>
						<dd>箱包开袋方式： 包盖式</dd>
						<dd>性别： 女</dd>
						<dd>有无夹层： 有</dd>
						<dd>颜色分类： 100%质量保证支持</dd>
						<dd>箱包场合： 休闲/街头</dd>
						<dd>里料质地： 棉</dd>
						<dd>可否折叠： 否</dd>
						<dd>适用人群： 青年</dd>
						<dd>内部结构： 拉链暗袋 手机袋 证件袋</dd>
						<dd>款式： 单肩包</dd>
						<dd>箱包图案： 纯色无图案</dd>
						<dd>成色： 全新</dd>
						<dd>质地： PU</dd>
						<dd>箱包肩带样式： 单根</dd>
						<dd>价格区间： 100元以下</dd>
					</dl>
				</div>
			</ul>

		</div>
	</div>
</div>
<script src="./Public/Admin/js3/all.js" type="text/javascript">

</script>
</body>
</html>