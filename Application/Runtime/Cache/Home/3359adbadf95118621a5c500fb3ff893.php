<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.0
Version: 1.5.2
Author: KeenThemes
Website: http://www.keenthemes.com/
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8" />
	<title>云天售后服务软件</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<meta name="MobileOptimized" content="320">
   <link rel="stylesheet" type="text/css" href="/yzzh/Public/assets/plugins/font-awesome/css/font-awesome.min.css" /> 
   <link rel="stylesheet" type="text/css" href="/yzzh/Public/assets/plugins/bootstrap/css/bootstrap.min.css" />  	
	<link type="text/css" rel="stylesheet" href="/yzzh/Public/Minify/index.php?g=web_css" />
	
	<!-- END THEME STYLES -->
	
    <link rel="shortcut icon" href="/yzzh/Public/assets/img/yt.ico" />  
</head>

<!-- BEGIN BODY -->
<body class="login yt_margintop73">
	<!-- BEGIN LOGO -->
	<div class="logo yt_margintop73 ">
		<img src="/yzzh/Public/assets/img/logo-big.png" alt="" /> 
	</div>
	<!-- END LOGO -->
	<!-- BEGIN LOGIN -->
	
	
	<div class="content yt_input-large500 ">
		<!-- BEGIN LOGIN FORM -->
		<form class="login-form" action="JavaScript:YTlogin_doregister('/yzzh/ytsoft.php?s=/Home/User/doregister');" method="post">
			<h3 class="form-title">新公司注册</h3>
			<div class="form-group">
				<label class="control-label  visible-ie8 visible-ie9">联系人姓名</label>
				<div class="input-icon">
					<i class="icon-user"></i>
					<input class="form-control placeholder-no-fix" type="text"  autocomplete="off" placeholder="联系人姓名" name="name"  />
				</div>
			</div>	
			<div class="form-group">
				<label class="control-label  visible-ie8 visible-ie9">联系人电话</label>
				<div class="input-icon">
					<i class=" icon-headphones"></i>
					<input class="form-control placeholder-no-fix" type="text"  autocomplete="off" placeholder="联系人电话" name="phone"  />
				</div>
			</div>	
			<div class="form-group">
				<label class="control-label  visible-ie8 visible-ie9">注册邮箱</label>
				<div class="input-icon">
					<i class="icon-envelope"></i>
					<input class="form-control placeholder-no-fix" type="text"  autocomplete="off" id="register_email" placeholder="注册邮箱" name="email"  />
				</div>		
			</div>	
			<div class="form-group">
				<label class="control-label  visible-ie8 visible-ie9">再输一次注册邮箱</label>
				<div class="input-icon">
					<i class="icon-envelope"></i>
					<input class="form-control placeholder-no-fix" type="text"  autocomplete="off" placeholder="再输一次注册邮箱" name="remail"  />
				</div>
				<span class="help-block">注册信息会发到这个邮箱，请勿输错 		
			</div>				
			<div class="form-group">
				<label class="control-label  visible-ie8 visible-ie9">公司名称</label>
				<div class="input-icon">
					<i class="icon-sitemap"></i>
					<input class="form-control placeholder-no-fix" type="text"  autocomplete="off" placeholder="公司名称" name="company_name"  />
				</div>
			</div>
			<div class="form-group">
				<label class="control-label  visible-ie8 visible-ie9">公司地址</label>
				<div class="input-group yt_input-large420 input-daterange   "  >
						<select  class="form-control  select2me    "  id="s_province" name="s_province" >													    
						</select>										   
						<select  class="form-control  select2me  "  id="s_city" name="s_city"  >	
						</select>
						<select  class="form-control  select2me  "  id="s_county" name="s_county"  >	
						</select>												
				</div>			
			</div>				
			<div class="form-group">
				<label class="control-label  visible-ie8 visible-ie9">公司详细地址</label>
				<div class="input-icon">
					<i class=" icon-pushpin"></i>
					<input class="form-control placeholder-no-fix" type="text"  autocomplete="off" placeholder="公司详细地址" name="company_address"  />
				</div>
			</div>	
			<div class="form-group">
				<label class="control-label  visible-ie8 visible-ie9">验证码</label>
				<div class="input-icon input-group">
					<i class="icon-reorder  "></i>
					<input class="form-control placeholder-no-fix yt_input-small220" type="text" autocomplete="off" placeholder="验证码" name="authcode"  /></input>
				    <img src="/yzzh/ytsoft.php?s=/Home/User/verify" width="78" height="33" onclick="JavaScript:YTlogin_resetVerifyCode();" class="checkcode"  title="点击刷新验证码" id="verifyImage"/>

				</div>
			</div>	

			<div class="form-group">
				<label>
				<input type="checkbox" name="tnc"/>我同意<a href="http://www.ytsoft.cn/yt800/protocol.php" target="_blank" >软件使用协议</a>
				</label>  
				<div id="register_tnc_error"></div>
			</div>	

			<div class="form-actions">
				<button id="register-back-btn" type="button" class="btn" onclick="location='/yzzh/ytsoft.php?s=/Home/User/login'" >
				<i class="m-icon-swapleft"></i>  登陆
				</button>			
				<button type="submit" class="btn green pull-right" >
				提交 <i class="m-icon-swapright m-icon-white"></i>
				</button>            
			</div>

			<div class="forget-password">
				<p>
				    <a href="javascript:;"  id="forget-password">注册事项</a>	
				</p>				
			</div>			

		</form>
		
		<!-- BEGIN FORGOT PASSWORD FORM -->
		<form class="forget-form" action="JavaScript:YTlogin_doforget('/yzzh/ytsoft.php?s=/Home/User/doforget');" method="post">
			<h3 class="form-title" >注册事项</h3>
			<div class="form-group">
			    <label class="control-label">1.请务必填写真实信息，以便为您提供服务。虚假的资料将会被拒绝服务</label>
			</div>
			<div class="form-group">
			    <label class="control-label">2.注册邮箱很重要，涉及以后找回密码，系统管理员的一些权限的认证等，请使用安全，能长期使用的邮箱</label>
			</div>	
			<div class="form-group">
			    <label class="control-label">3.提交资料，注册成功后，系统会自动把随机生成的机构ID,用户名和密码发送到注册邮箱</label>
			</div>	
			<div class="form-group">
			    <label class="control-label">3.登录密码可以在正常进入软件以后，自行修改</label>
			</div>				
			<div class="form-group">
			    <label class="control-label">4.如果没有收到邮件，请耐心等待一会，或者到邮箱的收件箱，垃圾箱检查是否有被阻止的邮件</label>
			</div>				

			<div class="form-actions">
				<button type="button" id="back-btn" class="btn">
				<i class="m-icon-swapleft"></i> 上一步
				</button>   
			</div>
		</form>
		<!-- END FORGOT PASSWORD FORM -->		
		
		
		<!-- END LOGIN FORM -->    
		<input id="lng"  name="inputdatabox" type="hidden"   /> 	
		<input id="lat"  name="inputdatabox" type="hidden"    /> 		
	</div>
	<!-- END LOGIN -->
	<!-- BEGIN COPYRIGHT -->
	<div class="copyright">
        <?php echo (session('soft_footer')); ?>
	</div>
	<!-- END COPYRIGHT -->
	<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
	<!-- BEGIN CORE PLUGINS -->   
	<!--[if lt IE 9]>
	<script src="assets/plugins/respond.min.js"></script>
	<script src="assets/plugins/excanvas.min.js"></script> 
	<![endif]-->   
   <script src="/yzzh/Public/assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>  
   <script src="/yzzh/Public/assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>    
   <script src="/yzzh/Public/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>	
    <script src="/yzzh/Public/Minify/index.php?g=web_js" type="text/javascript"></script>  

	<script charset="utf-8" src="http://map.qq.com/api/js?v=1"></script>
	<script src="/yzzh/Public/js/area.js" type="text/javascript"></script>  
	<script type="text/javascript">_init_area();</script>		
	
	<!-- END PAGE LEVEL SCRIPTS --> 
	
	<script>
		jQuery(document).ready(function() {     
		  App.init();
		  Login.init();
		});		
		YTurl = '/yzzh/ytsoft.php?s=/Home/User';	
		YTapp='/yzzh/ytsoft.php?s=';   		
		var s=["s_province","s_city","s_county"];//三个select的name
		var opt0 = ["省份","地级市","市、县"];//初始值
	</script>
	<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->

 
 <div id="yt_loading" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
		  <div class="modal-body">
				   <br>
					<div align=center >   
						<IMG height=32 width=32 src=/yzzh/Public/images/lightbox_loading.gif >
					</div>   
					<br>										
					<h3 align=center>数据处理中,请耐心等待... </h3>																		
		  </div>
 </div>

 <div>
	<input id="parent_id" type="hidden" />
	<input id="record_id" type="hidden" />
	<input id="url_url"  value="/yzzh/ytsoft.php?s=/Home/User"  type="hidden" />
	<input id="url_public"  value="/yzzh/Public"  type="hidden" />	
	<input id="url_app"  value="/yzzh/ytsoft.php?s="  type="hidden" />				
</div>	
 
 
 
</html>