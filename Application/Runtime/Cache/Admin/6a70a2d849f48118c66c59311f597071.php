<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>商品页面</title>
	<link rel="stylesheet" href="./Public/Admin/style/base.css" type="text/css">
	<link rel="stylesheet" href="./Public/Admin/style/global.css" type="text/css">
	<link rel="stylesheet" href="./Public/Admin/style/header.css" type="text/css">
	<link rel="stylesheet" href="./Public/Admin/style/goods.css" type="text/css">
	<link rel="stylesheet" href="./Public/Admin/style/common.css" type="text/css">
	<link rel="stylesheet" href="./Public/Admin/style/bottomnav.css" type="text/css">
	<link rel="stylesheet" href="./Public/Admin/style/footer.css" type="text/css">
	
	<!--引入jqzoom css -->
	<link rel="stylesheet" href="./Public/Admin/style/jqzoom.css" type="text/css">

	<script type="text/javascript" src="./Public/Admin/js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="./Public/Admin/js/header.js"></script>
	<script type="text/javascript" src="./Public/Admin/js/goods.js"></script>
	<script type="text/javascript" src="./Public/Admin/js/jqzoom-core.js"></script>
	<script src="./Public/Admin/laydate/laydate.js"></script>

	<!-- jqzoom 效果 -->
	<script type="text/javascript">
		$(function(){
			$('.jqzoom').jqzoom({
	            zoomType: 'standard',
	            lens:true,
	            preloadImages: false,
	            alwaysOn:false,
	            title:false,
	            zoomWidth:400,
	            zoomHeight:400
	        });
		})
	</script>
</head>
<body>
	<div style="clear:both;"></div>
	<!-- 商品页面主体 start -->
	<div class="main w1210 mt10 bc">
		<!-- 商品信息内容 start -->
		<div class="goods_content fl mt10 ml10">
			<!-- 商品概要信息 start -->
			<div class="summary">
				<div class="preview fl">
					<div class="midpic">
						<a href="./Public/Admin/images/preview_l1.jpg" class="jqzoom" rel="gal1">   <!-- 第一幅图片的大图 class 和 rel属性不能更改 -->
							<img src="./Public/Admin/images/preview_m1.jpg" alt="" />               <!-- 第一幅图片的中图 -->
						</a>
					</div>

					<!--使用说明：此处的预览图效果有三种类型的图片，大图，中图，和小图，取得图片之后，分配到模板的时候，把第一幅图片分配到 上面的midpic 中，其中大图分配到 a 标签的href属性，中图分配到 img 的src上。 下面的smallpic 则表示小图区域，格式固定，在 a 标签的 rel属性中，分别指定了中图（smallimage）和大图（largeimage），img标签则显示小图，按此格式循环生成即可，但在第一个li上，要加上cur类，同时在第一个li 的a标签中，添加类 zoomThumbActive  -->

					<div class="smallpic">
						<a href="javascript:;" id="backward" class="off"></a>
						<a href="javascript:;" id="forward" class="on"></a>
						<div class="smallpic_wrap">
							<ul>
								<li class="cur">
									<a class="zoomThumbActive" href="javascript:void(0);" rel="{gallery: 'gal1', smallimage: 'images/preview_m1.jpg',largeimage: 'images/preview_l1.jpg'}"><img src="./Public/Admin/images/preview_s1.jpg"></a>
								</li>
								<li>
									<a href="javascript:void(0);" rel="{gallery: 'gal1', smallimage: 'images/preview_m2.jpg',largeimage: 'images/preview_l2.jpg'}"><img src="./Public/Admin/images/preview_s2.jpg"></a>
								</li>
								<li>
									<a href="javascript:void(0);"
									rel="{gallery: 'gal1', smallimage: 'images/preview_m3.jpg',largeimage: 'images/preview_l3.jpg'}">
	    							<img src="./Public/Admin/images/preview_s3.jpg"></a>
								</li>
								<li>
									<a href="javascript:void(0);"
									rel="{gallery: 'gal1', smallimage: 'images/preview_m4.jpg',largeimage: 'images/preview_l4.jpg'}">
	    							<img src="./Public/Admin/images/preview_s4.jpg"></a>
								</li>
								<li>
									<a href="javascript:void(0);"
									rel="{gallery: 'gal1', smallimage: 'images/preview_m5.jpg',largeimage: 'images/preview_l5.jpg'}">
	    							<img src="./Public/Admin/images/preview_s5.jpg"></a>
								</li>
								<li>
									<a href="javascript:void(0);"
									rel="{gallery: 'gal1', smallimage: 'images/preview_m6.jpg',largeimage: 'images/preview_l6.jpg'}">
	    							<img src="./Public/Admin/images/preview_s6.jpg"></a>
								</li>
								<li>
									<a href="javascript:void(0);"
									rel="{gallery: 'gal1', smallimage: 'images/preview_m7.jpg',largeimage: 'images/preview_l7.jpg'}">
	    							<img src="./Public/Admin/images/preview_s7.jpg"></a>
								</li>
								<li>
									<a href="javascript:void(0);"
									rel="{gallery: 'gal1', smallimage: 'images/preview_m8.jpg',largeimage: 'images/preview_l8.jpg'}">
	    							<img src="./Public/Admin/images/preview_s8.jpg"></a>
								</li>
								<li>
									<a href="javascript:void(0);"
									rel="{gallery: 'gal1', smallimage: 'images/preview_m9.jpg',largeimage: 'images/preview_l9.jpg'}">
	    							<img src="./Public/Admin/images/preview_s9.jpg"></a>
								</li>
							</ul>
						</div>

					</div>
				</div>
				<!-- 图片预览区域 end -->

				<!-- 商品基本信息区域 start -->
				<div class="goodsinfo fl ml10">
					<ul>
						<h3><strong>&nbsp;<?php echo (L("Commodity name")); ?>:<?php echo ($goodsInfo["goods_name"]); ?></strong></h3>
						<li class="shop_price"><span><?php echo (L("Commodity price")); ?>：</span> <strong>￥<?php echo ($goodsInfo["goods_price"]); ?></strong></em></li>
					</ul>
					<form action="<?php echo U('Order/add');?>" method="post">
						<ul>
							<?php if(is_array($goodsAttr)): foreach($goodsAttr as $key=>$attr): if($attr["check"] == 1): ?><li>
								<dl>
									<dd>
										<?php echo ($attr["attr"]); ?>: <input type="text" name="<?php echo ($attr["attr"]); ?>" value="" />
									</dd>

								</dl>
							</li>

							<?php elseif($attr["check"] == 3): ?>
							<li class="product">
								<dl>
									<dt><?php echo ($attr["attr"]); ?>：</dt>
									<dd>
										<?php if(is_array($attr["value"])): foreach($attr["value"] as $key=>$att): echo ($att); ?> <input type="radio" name="<?php echo ($attr["attr"]); ?>" value="<?php echo ($att); ?>" />
										<input type="hidden" name="" value="" /><?php endforeach; endif; ?>
									</dd>
								</dl>
							</li>

									<?php elseif($attr["check"] == 4): ?>
									<li class="product">
										<dl>
											<dt><?php echo ($attr["attr"]); ?>：</dt>
											<dd>
												<?php if(is_array($attr["value"])): foreach($attr["value"] as $key=>$att): echo ($att); ?> <input type="checkbox" name="<?php echo ($attr["attr"]); ?>[]" value="<?php echo ($att); ?>" />
													<input type="hidden" name="" value="" /><?php endforeach; endif; ?>
											</dd>
										</dl>
									</li>
									<?php elseif($attr["check"] == 5): ?>
									<li class="product">
										<dl>
											<dt><?php echo ($attr["attr"]); ?>：</dt>
											<dd>
												<select id="designType" class="blockBox" name="<?php echo ($attr["attr"]); ?>">
													<?php if(is_array($attr["value"])): foreach($attr["value"] as $key=>$att): ?><option value="<?php echo ($att); ?>"><?php echo ($att); ?></option><?php endforeach; endif; ?>
												</select>
											</dd>
										</dl>
									</li>
									<?php elseif($attr["check"] == 2): ?>
									<li class="product">
										<dl>
											<span><?php echo ($attr["attr"]); ?>：</span>
											<div style="width:500px; margin:0px auto;">
												<input placeholder="请输入日期" name="<?php echo ($attr["attr"]); ?>" class="laydate-icon" onclick="laydate()">
											</div>
										</dl>
									</li><?php endif; endforeach; endif; ?>

							<li>
								<dl>
									<dt>购买数量：</dt>
									<dd>
										<a href="javascript:;" id="reduce_num"></a>
										<input type="text" name="amount" value="1" class="amount"/>
										<a href="javascript:;" id="add_num"></a>
									</dd>
								</dl>
							</li>

							<h1><?php echo (L("Consignee")); ?>：</h1>
							<li>
								<dl>
									<dd><?php echo (L("Consignee Name")); ?>：<input type="text" name="user_name" value="" onblur="bind(this,'text')" ></dd>
								</dl>
							</li>
							<li>
								<dl>
									<dd><?php echo (L("Delivery address")); ?><input type="text" name="user_address" value="" onblur="bind(this,'text')"></dd>
								</dl>
							</li>
							<li>
								<dl>

									<dd><?php echo (L("Phone")); ?>:<input type="text" name="user_telephone" onblur="bind(this,'text')"></dd>
								</dl>
							</li>

							<li>
								<dl>

									<dd><?php echo (L("Payment method")); ?>：
										支付宝：<input type="radio" checked="checked" name="user_pay" value="1" onclick="bind(this,'radio')">
										微信：<input type="radio" name="user_pay" value="2" onclick="bind(this,'radio')">
										银联：<input type="radio" name="user_pay" value="3" onclick="bind(this,'radio')"></dd>
								</dl>
							</li>

						</ul>

						<input type="submit" value="立即支付">
					</form>
				</div>
				<!-- 商品基本信息区域 end -->
			</div>
			<!-- 商品概要信息 end -->

			<div style="clear:both;"></div>

			<!-- 商品详情 start -->
			<div class="detail">
						<span>商品介绍</span>
				</div>
				<div class="detail_bd">
					<!-- 商品介绍 start -->
					<div class="introduce detail_div ">
						<div class="attr mt15">
							<ul>
								<li><span>商品名称：</span>ThinkPadX230(2306 3T4）</li>
								<li><span>商品编号：</span>979631</li>
								<li><span>品牌：</span>联想（Thinkpad）</li>
								<li><span>上架时间：</span>2013-09-18 17:58:12</li>
								<li><span>商品毛重：</span>2.47kg</li>
								<li><span>商品产地：</span>中国大陆</li>
								<li><span>显卡：</span>集成显卡</li>
								<li><span>触控：</span>非触控</li>
								<li><span>厚度：</span>正常厚度（>25mm）</li>
								<li><span>处理器：</span>Intel i5</li>
								<li><span>尺寸：</span>12英寸</li>
							</ul>
						</div>


					</div>
				</div>
			</div>
		</div>
	</div>
	<div style="clear:both;"></div>
	<script type="text/javascript">
		document.execCommand("BackgroundImageCache", false, true);
	</script>
</body>
</html>