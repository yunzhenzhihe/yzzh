<?php if (!defined('THINK_PATH')) exit();?>
<style>
	.page{height:18px;padding-top:20px;text-align:center;}
	DIV.page {PADDING-RIGHT: 5px; PADDING-LEFT: 3px; PADDING-BOTTOM: 3px; MARGIN: 3px; PADDING-TOP: 3px; TEXT-ALIGN: center;margin-top:20px;}
	DIV.page A {BORDER: #E66C16 1px solid; PADDING-RIGHT: 5px;PADDING-LEFT: 5px; PADDING-BOTTOM: 2px; MARGIN: 0px; COLOR: #333; PADDING-TOP: 2px; TEXT-DECORATION: none}
	DIV.page A:hover {BORDER: #E45A11 1px solid; COLOR: #000; background:#FCD3BE;}
	DIV.page A:active {BORDER-RIGHT: #000099 1px solid; BORDER-TOP: #000099 1px solid; BORDER-LEFT: #000099 1px solid; COLOR: #000; BORDER-BOTTOM: #000099 1px solid}
	DIV.page SPAN.current {BORDER: #E34F0F 1px solid; PADDING-RIGHT: 5px; PADDING-LEFT: 5px; FONT-WEIGHT: bold; PADDING-BOTTOM: 2px; MARGIN: 2px; COLOR: #333; PADDING-TOP: 2px;BACKGROUND-COLOR: #FCD3BE;}
	DIV.page SPAN.disabled {BORDER-RIGHT: #ccc 1px solid; PADDING-RIGHT: 5px; BORDER-TOP: #ccc 1px solid; PADDING-LEFT: 5px; PADDING-BOTTOM: 2px; MARGIN: 0px; BORDER-LEFT: #ccc 1px solid; COLOR: #aaa; PADDING-TOP: 2px; BORDER-BOTTOM: #ccc 1px solid; }
</style>
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


 
<script src="/yzzh/Public/js/dropzone.js"></script>
<div class="yt-head-row">
    <div class="row">
        <div class="col-md-12">
           <!-- BEGIN PAGE TITLE & BREADCRUMB-->
            <ul class="page-breadcrumb breadcrumb">
                <li>
                    <span>图片管理	</span>
                    <i class="icon-angle-right"></i>
                </li>
                <li>
                    <span>公司图片管理</span>
                </li>
            </ul>
           <!-- END PAGE TITLE & BREADCRUMB-->
        </div>
    </div>
</div>
         <!-- END PAGE HEADER-->

         <!-- BEGIN PAGE CONTENT-->
<div class="row">
    <div class="col-md-12">
<!-- BEGIN FILTER -->
<!--<div class="col-md-3 col-sm-4 mix category_1">-->
<!--<div class="mix-inner">-->
<!--<h4>&nbsp;&nbsp;无图片..</h4>-->
<!--</div>-->
<!--</div>-->
        <?php if(is_array($res)): foreach($res as $key=>$vo): ?><div class="col-md-1 col-sm-4 mix category_1 yt_margintop15 "    >
                <div class="mix-inner" >
                    <a class="fancybox-button" href="" title="" data-rel="fancybox-button" >
                        <img src="./<?php echo ($vo['image_url']); echo ($vo['image_name']); ?> " style="height: 120px;">
                    </a>
                    <button class="btn blue btn-sm tooltips" data-original-title="删除图片" img_id="<?php echo ($vo["id"]); ?>" style="margin-left: 50px;">
                        <i class="icon-remove"></i>
                    </button>
                </div>
            </div><?php endforeach; endif; ?>
        <div class="yt-head-row">
            <div class="row">
                <div class="col-md-12">
                    <ul class="page-breadcrumb breadcrumb">
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 yt_margintop-10 ">
                <div class="page">
                    <?php echo ($page); ?>
                </div>
            </div>
        </div>
        <div class="yt-head-row">
            <div class="row">
                <div class="col-md-12">
                    <ul class="page-breadcrumb breadcrumb"></ul>
                </div>
            </div>
        </div>
<!-- END FILTER -->
    </div>
</div>

<div class="row  " >
    <div class="col-md-12 yt_margintop-30 ">
        <h4 class="form-section">文件上传</h4>
            <div class="form-group">
                <div class="container" id="container">
                    <div id="actions" class="row">
                        <div class="col-lg-7">
                        <span class="btn btn-success fileinput-button dz-clickable" id="fileinput">
                            <i class="glyphicon glyphicon-plus"></i>
                            <span>添加文件</span>
                        </span>
                            <button type="submit" class="btn btn-primary start">
                                <i class="glyphicon glyphicon-upload"></i>
                                <span>开始上传</span>
                            </button>
                            <button type="reset" class="btn btn-warning cancel">
                                <i class="glyphicon glyphicon-ban-circle"></i>
                                <span>取消上传</span>
                            </button>
                        </div>
                        <div class="col-lg-5">
                        </div>
                    </div>
                    <div class="table table-striped files" id="previews">
                    </div>
                    <script>
                        //定制你想要的显示图片的界面
                        var previewTemplate1 = '<div class="dz-preview dz-file-preview test"><div class="dz-details"><div class="dz-filename"><span data-dz-name></span></div><div class="dz-size" data-dz-size></div><img data-dz-thumbnail /></div><div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div><div class="dz-error-message"><span data-dz-errormessage></span></div></div>';
                        var myDropzone = new Dropzone(document.body, {
                            //这是负责处理上传的路径
                            url:'/yzzh/ytsoft.php?s=/Home/Showimages/upload/type/1',
                            thumbnailWidth: 80,
                            thumbnailHeight: 80,
                            parallelUploads: 20,
                            addRemoveLinks:true,
                            previewTemplate: previewTemplate1,
                            //不自动提交图片，直到手动提交
                            autoQueue: false,
                            //预览图片的容器
                            previewsContainer: "#previews",
                            clickable: ".fileinput-button"
                        });
                        myDropzone.on("addedfile", function(file) {
                        });
                        // Update the total progress bar
                        myDropzone.on("totaluploadprogress", function(progress) {
                            document.querySelector("#total-progress .progress-bar").style.width = progress + "%";
                        });
                        myDropzone.on("sending", function(file) {
                        });
                        // Hide the total progress bar when nothing's uploading anymore
                        myDropzone.on("queuecomplete", function(progress) {
                            document.querySelector("#total-progress").style.opacity = "0";
                        });
                        document.querySelector("#actions .start").onclick = function() {
                            myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
                        };
                        document.querySelector("#actions .cancel").onclick = function() {
                            myDropzone.removeAllFiles(true);
                        };
                    </script>

                </div>
                <input type="file" multiple="multiple" class="dz-hidden-input" style="visibility: hidden; position: absolute; top: 0px; left: 0px; height: 0px; width: 0px;">
            </div>
            <div class="note note-info">
                <h4 class="block">上传图片注意事项</h4>
                <p>
                   1.只能上传 .jpg  .gif  .png  .jpeg 这4种格式图片文件
                </p>
                <p>
                  2.每张图片大小不超过&nbsp;<span class="yt_color_red" ><?php echo (cookie('images_maxsize_kb')); ?></span>
                </p>
            </div>
    </div>
</div>
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
	   YTaction='/yzzh/ytsoft.php?s=/Home/Showimages/index';  
   </script>   

   
   
   
   
   



<script>
jQuery(document).ready(function() {
    App.initnocheckboxes();
    $('#yt_left_menu_images').addClass("active");
    $('#yt_left_menu_images_companyimage').addClass("active");

    $('#yt_left_menu_images_arrow .arrow ').remove();
    $('#yt_left_menu_images_arrow ').append( '<span class="selected"></span> ');
    $('#yt_left_menu_images_arrow ').append( '<span class="arrow open"></span>	');

    showSelect('#NumberOfRows','<?php echo (cookie('NumberOfRows')); ?>');
  });


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
	<input id="url_url"  value="/yzzh/ytsoft.php?s=/Home/Showimages"  type="hidden" />
	<input id="url_public"  value="/yzzh/Public"  type="hidden" />
	<input id="url_app"  value="/yzzh/ytsoft.php?s="  type="hidden" />
</div>
 

</body>
</html>