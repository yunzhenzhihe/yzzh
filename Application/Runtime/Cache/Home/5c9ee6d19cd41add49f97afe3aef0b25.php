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
<body class="login ">
	<!-- BEGIN LOGO -->
	<div class="logo">
		<img src="/yzzh/Public/assets/img/logo-big.png" alt="" /> 
	</div>
	<!-- END LOGO -->
	<!-- BEGIN LOGIN -->
	
	
	<div class="content yt_input-large500 ">
		<!-- BEGIN LOGIN FORM -->
		<form class="login-form" action="JavaScript:YTlogin_dologin('/yzzh/ytsoft.php?s=/Home/User/dologin');" method="post">
			<h3 class="form-title">输入您的账号</h3>
			<div class="alert alert-error hide">
				<button class="close" data-dismiss="alert"></button>
				<span>请输入正确的用户名和密码和公司ID.</span>
			</div>

			<div class="form-group">
				<label class="control-label  visible-ie8 visible-ie9">用户名</label>
				<div class="input-icon">
					<i class="icon-user"></i>
					<input class="form-control placeholder-no-fix" type="text"  autocomplete="off" placeholder="用户名" name="username" value="<?php echo (cookie('username')); ?>" />
				</div>
			</div>					
			<div class="form-group">
				<label class="control-label  visible-ie8 visible-ie9">密码</label>
				<div class="input-icon">
					<i class="icon-lock"></i>
					<input class="form-control placeholder-no-fix" type="password"  autocomplete="off" placeholder="密码" name="password"  value="<?php echo (cookie('password')); ?>"  />
					<input class="yt_nodisplay"  type="password"    />
				</div>
			</div>	
			<div class="form-group">
				<label class="control-label  visible-ie8 visible-ie9">公司ID</label>
				<div class="input-icon">
					<i class="icon-sitemap"></i>
					<input class="form-control placeholder-no-fix" type="text" autocomplete="off"  placeholder="公司ID" name="companyid" value="<?php echo (cookie('company_id')); ?>" />
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
			
			<div class="form-actions">
				<label class="checkbox">
				<input type="checkbox" name="remember" value="1" <?php echo (cookie('RememberPassword')); ?> /> 记住密码
				</label>
				<button type="submit" class="btn green pull-right" >
				登录 <i class="m-icon-swapright m-icon-white"></i>
				</button>            
			</div>

			<div class="forget-password">
				<p>
				<!--    <a href="javascript:;"  id="forget-password">忘了密码\修改密码？</a>	 -->
				 
					 <?php if($login_flag == null) : ?>	
					       <a  href="/yzzh/ytsoft.php?s=/Home/User/forget"  >忘了密码\修改密码？</a> 
					       <a class="yt_float_right" href="/yzzh/ytsoft.php?s=/Home/User/register"  >新公司注册</a> 
					  <?php endif ?>						
				</p>
			</div>
			<?php if($login_flag == null) : ?>				
					<div class="forget-password">
						<p>
							<a href="http://www.ytsoft.cn/yt800/" target="_blank" >如果想获取文字、图片、视频等更多信息，请访问软件主页</a>					
						</p>
					</div>	
             <?php else : ?>  
					<div class="forget-password">
						<p>
							<a href="JavaScript:alert('http://www.ytsoft.cn/yt800/');	   " >如果想获取文字、图片、视频等更多信息，请访问软件主页</a>					
						</p>
					</div>				 	
			<?php endif ?>				
		</form>
		<!-- END LOGIN FORM -->        

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
	
	<input id="login_flag" name="login_flag"   value="<?php echo ($login_flag); ?>"  type="hidden"   /> <!--当来自pcclent登录的时候 会设置这个值 web登录 则没有这个值 --> 
    <script src="/yzzh/Public/assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>  
    <script src="/yzzh/Public/assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>    
    <script src="/yzzh/Public/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="/yzzh/Public/Minify/index.php?g=web_js" type="text/javascript"></script>  
	
	<script>
		jQuery(document).ready(function() {     
		  App.init();
		  Login.init();
		});		
		YTurl = '/yzzh/ytsoft.php?s=/Home/User';
		YTapp='/yzzh/ytsoft.php?s=';  
	//	YTlogin_resetVerifyCode();
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