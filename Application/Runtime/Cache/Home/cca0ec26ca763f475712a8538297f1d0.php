<?php if (!defined('THINK_PATH')) exit();?>    
 
<!DOCTYPE html>
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
   <title>云镇智合定制平台</title>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta content="width=device-width, initial-scale=1.0" name="viewport" />
   <meta content="" name="description" />
   <meta content="" name="author" />
   <meta name="MobileOptimized" content="320">

   <link rel="stylesheet" type="text/css" href="/yzzh/Public/assets/plugins/font-awesome/css/font-awesome.min.css" />
   <link rel="stylesheet" type="text/css" href="/yzzh/Public/assets/plugins/bootstrap/css/bootstrap.min.css" />

   <link type="text/css" rel="stylesheet" href="/yzzh/Public/Minify/index.php?g=web_css" />
   <link href="/yzzh/Public/css/animate.min.css" rel="stylesheet"/>
   <!--<link href="/yzzh/Public/css/light-bootstrap-dashboard.css" rel="stylesheet"/>-->
   <link href="/yzzh/Public/css/demo.css" rel="stylesheet" />
   <link href="/yzzh/Public/css/pe-icon-7-stroke.css" rel="stylesheet" />
  <!--
   <link rel="stylesheet" type="text/css" href="/yzzh/Public/assets/plugins/data-tables/jquery.dataTables.css" /> 
   <link rel="stylesheet" type="text/css" href="/yzzh/Public/assets/plugins/data-tables/DT_bootstrap.css" />
   <link rel="stylesheet" type="text/css" href="/yzzh/Public/assets/plugins/select2/select2-bootstrap.css" />  -->


   <link rel="shortcut icon" href="/yzzh/Public/assets/img/yt.ico" />
   <style>
      body, h1, h2, h3, h4, h5, h6, p, a, td, button {
         -moz-osx-font-smoothing: grayscale;
         -webkit-font-smoothing: antialiased;
         font-family: "Roboto","Helvetica Neue",Arial,sans-serif;
         font-weight: 400;
      }
   </style>

</head>
<!-- END HEAD -->
<!-- BEGIN BODY  --> 
<body class="page-header-fixed"> 
   <!-- BEGIN HEADER -->   
   <div class="header navbar navbar-inverse navbar-fixed-top">
      <!-- BEGIN TOP NAVIGATION BAR -->
      <div class="header-inner">
         <!-- BEGIN LOGO -->  

         <a class="navbar-brand " href="/yzzh/ytsoft.php?s=/Index/index_menu">
         <img src="/yzzh/Public/assets/img/logo.png" alt="logo" class="img-responsive yt_margintop-5 " />
         </a>
         <!-- END LOGO -->
         <!-- BEGIN RESPONSIVE MENU TOGGLER --> 
         <a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
         <img src="/yzzh/Public/assets/img/menu-toggler.png" alt="" />
         </a> 
         <!-- END RESPONSIVE MENU TOGGLER -->
         <!-- BEGIN TOP NAVIGATION MENU -->
         <ul class="nav navbar-nav pull-right">
            <!-- BEGIN USER LOGIN DROPDOWN -->
            <li class="dropdown user">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
               <span class="username"><?php echo (session('username')); ?>&nbsp;&nbsp;<?php echo (session('company_name')); ?></span>
			   <?php if(($_SESSION['count_notice']!= "" )): ?><span class="badge  badge-important  yt_position-absolute"><?php echo (session('count_notice')); ?></span><?php endif; ?>  		
               <i class="icon-angle-down"></i><!--<span class="badge">6</span>	  -->
               </a> 
               <ul class="dropdown-menu ">
			      <li><a href="/yzzh/ytsoft.php?s=/Setcompany/user_info/flag/1" target="_blank" >我的信息</a>
                  </li>
			      <li><a href="/yzzh/ytsoft.php?s=/Setcompany/company_info" target="_blank"  >公司信息</a>
                  </li>		
			      <li><a href="/yzzh/ytsoft.php?s=/Setcompany/money_info" target="_blank"   >软件付费</a>
                  </li>
			      <li><a href="/yzzh/ytsoft.php?s=/Setcompany/questions_list" target="_blank"   >我的答疑、建议</a>
                  </li>					  
				  <li class="divider"></li>
			      <li>
					  <a href="/yzzh/ytsoft.php?s=/Setcompany/notice_list" target="_blank"   >系统消息					  
						<?php if(($_SESSION['count_notice']!= "" )): ?><span class="badge  badge-important  yt_position-absolute"><?php echo (session('count_notice')); ?></span><?php endif; ?>  						  
					  </a>
                  </li>	
			      <li><a href="/yzzh/ytsoft.php?s=/Index/index_menu" target="_blank" >软件主页</a>
                  </li>			  
                  <li><a href="/yzzh/ytsoft.php?s=/User/logout">退出登录</a>
                  </li>
               </ul>
            </li>
            <!-- END USER LOGIN DROPDOWN -->
         </ul>
         <!-- END TOP NAVIGATION MENU -->
      </div>
      <!-- END TOP NAVIGATION BAR -->
   </div>
   <!-- END HEADER -->
   <div class="clearfix"></div>
   
 

   <!-- BEGIN CONTAINER -->
   <div class="page-container">
      <!-- BEGIN SIDEBAR -->
      <div class="page-sidebar navbar-collapse collapse">
         <!-- BEGIN SIDEBAR MENU -->        
         <ul class="page-sidebar-menu">
            <li>
               <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
               <div class="sidebar-toggler hidden-phone"></div>
               <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
            </li>
            <li>
               <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                 <br>
               <!-- END RESPONSIVE QUICK SEARCH FORM -->
            </li>
            <li class="start " id="yt_left_menu_index">
               <a href="/yzzh/ytsoft.php?s=/Index/index_menu">
               <i class="icon-home"></i> 
               <span class="title">&nbsp;<?php echo (L("_INDEXMENU_")); ?><!--首页--></span>
               </a>
            </li>
			
	<!--	<?php echo (session('yt_left_menu')); ?>-->


            <li id="yt_left_menu_setup" >
               <a href="javascript:;" id="yt_left_menu_setup_arrow" >
				   <i class="icon-cogs"></i> 
				   <span class="title"><?php echo (L("_SETUP_")); ?><!--参数设置--></span>
				    <span class="arrow "></span>  			   
               </a>
               <ul class="sub-menu">
			   
                  <li id="yt_left_menu_setup_defaultfields" >
                     <a href="/yzzh/ytsoft.php?s=/Setgoods/goods_list">
                    商品设置</a>
                  </li>
                  <li id="yt_left_menu_setup_softinfo" >
                     <a href="/yzzh/ytsoft.php?s=/Setsoftinfo/softinfo">  
                     页面风格</a>
                  </li>
               </ul>
            </li>
            <li id="yt_left_menu_3D" >
               <a href="javascript:;" id="yt_left_menu_3D_arrow" >
                  <i class="icon-picture"></i>
                  <span class="title">虚拟与现实</span>
                  <span class="arrow "></span>
               </a>
               <ul class="sub-menu">
                  <li id="yt_left_menu_3Dset" >
                     <a href="/yzzh/ytsoft.php?s=/Virtuality/index">
                        模型贴图上传</a>
                  </li>
                  <li id="yt_left_menu_images_imageslist">
                     <a href="/yzzh/ytsoft.php?s=/Showimages/group">
                        图片分组管理</a>
                  </li>
               </ul>
            </li>
            <li id="yt_left_menu_images" >
               <a href="javascript:;" id="yt_left_menu_images_arrow" >
				   <i class="icon-picture"></i> 
				   <span class="title">图片管理</span>
				    <span class="arrow "></span>  			   
               </a>
               <ul class="sub-menu">
                  <li id="yt_left_menu_images_companyimage" >
                     <a href="/yzzh/ytsoft.php?s=/Showimages/index">
                     公司图片管理</a>
                  </li>		
                  <li id="yt_left_menu_images_imageslist">
                     <a href="/yzzh/ytsoft.php?s=/Showimages/group">
                     图片分组管理</a>
                  </li>					  
               </ul>	   
            </li>				

            <li id="yt_left_menu_sale" >
               <a href="javascript:;" id="yt_left_menu_sale_arrow" >
				   <i class=" icon-shopping-cart"></i> 
				   <span class="title">销售订单管理</span>
				    <span class="arrow "></span>  			   
               </a>
               <ul class="sub-menu">
                  <li>
                     <a href="  JavaScript:window.open('/yzzh/ytsoft.php?s=/Customer/customer_sale');   ">
                     新客户销售订单录入</a>
                  </li>	
                  <li id="yt_left_menu_sale_customer_list">
                     <a href="/yzzh/ytsoft.php?s=/Sales/customer_list">
                     老客户销售订单录入</a>
                  </li>		
                  <li id="yt_left_menu_sale_sale_list">
                     <a href="/yzzh/ytsoft.php?s=/Sales/sales_list">
                     销售订单查询\修改\删除</a>
                  </li>						  
                  <li id="yt_left_menu_manage_sales_process_confirm">
                     <a href="/yzzh/ytsoft.php?s=/Salesprocess/salesprocess_confirm">
                     销售订单审核出库</a>					  
                  </li>					  
               </ul>	   
            </li>
         </ul>
         <!-- END SIDEBAR MENU -->
      </div>
      <!-- END SIDEBAR -->
      <!-- BEGIN PAGE -->
      <div class="page-content">


 
<!-- BEGIN PAGE HEADER-->
	<div class="yt-head-row">
		<div class="row">
			<div class="col-md-12">
			   <!-- BEGIN PAGE TITLE & BREADCRUMB-->
			   	<ul class="page-breadcrumb breadcrumb">
					<li>
						<span>页面风格</span>
						<i class="icon-angle-right"></i>
					</li>
				  <li><span>页面风格设置</span></li>
			   </ul>
			   <!-- END PAGE TITLE & BREADCRUMB-->
			</div>
		 </div>
	</div>
         <!-- END PAGE HEADER-->
         <!-- BEGIN PAGE CONTENT-->
	<div class="row">
	<div class="col-md-12">
	  <table class="table table-striped table-bordered table-hover table-full-width  row-border order-column      " >
		   <thead>
				<TR >
					<TD>项目</TD>
					<TD>常量</TD>
				</TR>
		   </thead>
			<tbody>
					<TR >
						 <TD  >网页风格</TD>
						 <TD>
							 <div class="input-group-btn">
								 <select  class="form-control "  id="select_interval_days" name="inputdatabox" >
									 <option value="1" <?php if($style['web_style'] == 1 ): ?>selected="selected"<?php endif; ?>>风格1</option>
									 <option value="2"<?php if($style['web_style'] == 2 ): ?>selected="selected"<?php endif; ?>>风格2</option>
									 <option value="3"<?php if($style['web_style'] == 3 ): ?>selected="selected"<?php endif; ?>>风格3</option>
								 </select>
							 </div>
							 <span class="input-group-btn">
            					<button class="btn btn-info" id="preview" type="submit" style="margin-left:22px;">预览</button>
							 </span>
						 </TD>
					</TR>
			 </tbody>
		 </table>
	</div>
			<div class="col-md-12 yt_marginbottom5 yt_margintop10">
				<button type="button" class="btn green yt_float_right yt_marginright50 " id="yt_dialog_btn_ok">确认修改 <i class="icon-ok"  ></i></button>
		    </div>
         </div>

      </div>
    <!--   END PAGE -->
   </div>


  

   <!-- END CONTAINER -->
   <!-- BEGIN FOOTER -->
   <div class="footer " >
      <div class="footer-inner yt_marginleft230 ">
         <?php echo (session('soft_footer')); ?>
      </div>
      <div class="footer-tools">
         <span class="go-top">
         <i class="icon-angle-up"></i>
         </span>
      </div>
   </div>
   <!-- END FOOTER --> 
   <script src="/yzzh/Public/assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>  
   <script src="/yzzh/Public/assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
   <script src="/yzzh/Public/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
   <script src="/yzzh/Public/Minify/index.php?g=web_js" type="text/javascript"></script>
   <script>
	   YTapp='/yzzh/ytsoft.php?s=';  
	   YTaction='/yzzh/ytsoft.php?s=/Home/Setsoftinfo/softinfo';  
   </script>   

   
   
   
   
   




   <script>
    jQuery(document).ready(function() {
		App.initnocheckboxes();
        $('#yt_left_menu_setup').addClass("active");
		$('#yt_left_menu_setup_softinfo').addClass("active");

		$('#yt_left_menu_setup_arrow .arrow ').remove();
		$('#yt_left_menu_setup_arrow ').append( '<span class="selected"></span> ');
		$('#yt_left_menu_setup_arrow ').append( '<span class="arrow open"></span>	');

        $('#select_interval_days').select2("val","<?php echo (session('select_interval_days')); ?>");
		$('#regular_interval_days').select2("val","<?php echo (session('regular_interval_days')); ?>");
		$('#map_serviceinterval_days').select2("val","<?php echo (session('map_serviceinterval_days')); ?>");

      });
   </script>
   
  <script type="text/javascript">
     $("#preview").click(function () {
		  var i = $('#select_interval_days').children('option:selected').val();
		 var url = "ytsoft.php?s=/Admin/Index/detail/company_id/400700/web_style/"+i+".html";
         window.open(url);
     });
     function dialogcheckdata() {
         var checkvalid = true;
         return checkvalid;
     };
  </script>

 
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
	<input id="url_url"  value="/yzzh/ytsoft.php?s=/Home/Setsoftinfo"  type="hidden" />
	<input id="url_public"  value="/yzzh/Public"  type="hidden" />
	<input id="url_app"  value="/yzzh/ytsoft.php?s="  type="hidden" />
</div>
 


</body>
</html>