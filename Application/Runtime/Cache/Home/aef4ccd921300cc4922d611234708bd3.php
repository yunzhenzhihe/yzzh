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
   <title>云天售后服务软件</title>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta content="width=device-width, initial-scale=1.0" name="viewport" />
   <meta content="" name="description" />
   <meta content="" name="author" />
   <meta name="MobileOptimized" content="320">
   
   <link rel="stylesheet" type="text/css" href="/yzzh/Public/assets/plugins/font-awesome/css/font-awesome.min.css" /> 
   <link rel="stylesheet" type="text/css" href="/yzzh/Public/assets/plugins/bootstrap/css/bootstrap.min.css" />   
   
   <link type="text/css" rel="stylesheet" href="/yzzh/Public/Minify/index.php?g=web_css" />
   
  <!-- 
   <link rel="stylesheet" type="text/css" href="/yzzh/Public/assets/plugins/data-tables/jquery.dataTables.css" /> 
   <link rel="stylesheet" type="text/css" href="/yzzh/Public/assets/plugins/data-tables/DT_bootstrap.css" />
   <link rel="stylesheet" type="text/css" href="/yzzh/Public/assets/plugins/select2/select2-bootstrap.css" />  -->


   <link rel="shortcut icon" href="/yzzh/Public/assets/img/yt.ico" />  

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
			      <li><a href="http://www.ytsoft.cn/yt800/" target="_blank" >软件主页</a>
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
                     <a href="/yzzh/ytsoft.php?s=/Setdefaultfields/defaultfields_list">  
                    <?php echo (L("_DEFAULTFIELDS_")); ?><!--自定义字段设置--></a>
                  </li>		
                  <li id="yt_left_menu_setup_softinfo" >
                     <a href="/yzzh/ytsoft.php?s=/Setsoftinfo/softinfo">  
                     页面风格</a>
                  </li>						  
	
				  
               </ul>
            </li>
			
            <li id="yt_left_menu_customer" >
               <a href="javascript:;" id="yt_left_menu_custome_arrow" >
				   <i class="icon-user"></i> 
				   <span class="title">客户管理</span>
				    <span class="arrow "></span>  			   
               </a>
               <ul class="sub-menu">
                  <li>
                     <a href="  JavaScript:window.open('/yzzh/ytsoft.php?s=/Customer/customer_add');   ">
                     新客户资料录入</a>
                  </li>	
                  <li id="yt_left_menu_customer_info">
                     <a href="/yzzh/ytsoft.php?s=/Customer/customer_list">
                     客户查询\修改\删除</a>
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
                     <a href="/yzzh/ytsoft.php?s=/Showimages/show_companyimage">  
                     公司图片管理</a>
                  </li>		
                  <li id="yt_left_menu_images_imageslist">
                     <a href="/yzzh/ytsoft.php?s=/Showimages/images_list">
                     图片查询</a>
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
			
            <li id="yt_left_menu_sale_return" >
               <a href="javascript:;" id="yt_left_menu_sale_return_arrow" >
				   <i class="icon-undo"></i> 
				   <span class="title">销售订单退货管理</span>
				    <span class="arrow "></span>  			   
               </a>
               <ul class="sub-menu">
                  <li id="yt_left_menu_manage_sales_return_saleslist">
                     <a href="/yzzh/ytsoft.php?s=/Salesreturn/return_saleslist">
                     销售订单退货处理</a>
				   </li>	
                   <li id="yt_left_menu_manage_sales_return_returnlist">
                     <a href="/yzzh/ytsoft.php?s=/Salesreturn/return_returnlist">
                     退货订单查询\删除\审核</a>
                  </li>			                				  
               </ul>	   
            </li>		
			
            <li id="yt_left_menu_sale_statistics" >
               <a href="javascript:;" id="yt_left_menu_sale_statistics_arrow" >
				   <i class="icon-user"></i> 
				   <span class="title">销售统计</span>
				    <span class="arrow "></span>  			   
               </a>
               <ul class="sub-menu">
                  <li id="yt_left_menu_manage_sales_statistics_salesrecord">
                     <a href="/yzzh/ytsoft.php?s=/Salesstatistics/statistics_salesrecord">
                     销售订单统计</a>
				  </li>		
                  <li id="yt_left_menu_manage_sales_statistics_salesgoods">
                     <a href="/yzzh/ytsoft.php?s=/Salesstatistics/statistics_salesgoods">
                     按销售商品统计</a>
				   </li>					  
                  <li id="yt_left_menu_manage_sales_statistics_salesman">
                     <a href="/yzzh/ytsoft.php?s=/Salesstatistics/statistics_salesman">
                     按销售人员统计</a>
				   </li>	
                  <li id="yt_left_menu_manage_sales_statistics_salesunit">
                     <a href="/yzzh/ytsoft.php?s=/Salesstatistics/statistics_salesunit">
                     按销售单位统计</a>
				  </li>		
				  
               </ul>	   
            </li>

            <li id="yt_left_menu_manage_sales_process" >
               <a href="javascript:;" id="yt_left_menu_manage_sales_process_arrow" >
				   <i class="icon-user"></i> 
				   <span class="title">销售发货出库</span>
				    <span class="arrow "></span>  			   
               </a>
               <ul class="sub-menu">
                  <li id="yt_left_menu_manage_sales_process_flowchart">
                     <a href="/yzzh/ytsoft.php?s=/Salesprocess/salesprocess_menu">
                     销售发货出库流程图</a>
                  </li>							  
                  <li id="yt_left_menu_manage_sales_process_dispatch">
                     <a href="/yzzh/ytsoft.php?s=/Salesprocess/salesprocess_dispatch">
                     销售订单打包配送</a>
                  </li>		
                  <li id="yt_left_menu_manage_sales_process_completed">
                     <a href="/yzzh/ytsoft.php?s=/Salesprocess/salesprocess_completed">
                     销售订单完成确认</a>
                  </li>					  
				  
               </ul>	   			   
            </li>		
			

	

           <li id="yt_left_menu_complain" >
               <a href="javascript:;" id="yt_left_menu_complain_arrow" >
				   <i class="icon-thumbs-down"></i> 
				   <span class="title">投诉管理</span>
				    <span class="arrow "></span>  			   
               </a>
               <ul class="sub-menu">
                  <li>
                     <a href="  JavaScript:window.open('/yzzh/ytsoft.php?s=/Customer/customer_complain');   ">
                     新客户投诉记录录入</a>
                  </li>		
                  <li id="yt_left_menu_complain_customer_list">
                     <a href="/yzzh/ytsoft.php?s=/Complain/customer_list">
                     老客户投诉记录录入</a>
                  </li>
                  <li id="yt_left_menu_complain_complain_list">
                     <a href="/yzzh/ytsoft.php?s=/Complain/complain_list">
                     投诉记录修改\删除</a>
                  </li>					  
                  <li id="yt_left_menu_complain_complain_completed">
                     <a href="/yzzh/ytsoft.php?s=/Complain/complain_completed_list">
                     投诉记录处理\审核</a>
                  </li>						  
               </ul>	   
            </li>

 


			
			
           <li id="yt_left_menu_receivables" >
               <a href="javascript:;" id="yt_left_menu_receivables_arrow" >
				   <i class=" icon-jpy"></i> 
				   <span class="title">应收应付账款管理</span>
				    <span class="arrow "></span>  			   
               </a>
               <ul class="sub-menu">	
                  <li id="yt_left_menu_receivables_sales_list">
                     <a href="/yzzh/ytsoft.php?s=/Receivables/receivablessales_list">
                     销售应收账款录入</a>
                  </li>
                  <li id="yt_left_menu_receivables_salesreturn_list">
                     <a href="/yzzh/ytsoft.php?s=/Receivables/paysalesreturn_list">
                     销售退货应付退款录入</a>
                  </li>				  
			  
               </ul>	   
            </li>
			
           <li id="yt_left_menu_receivables_statistics" >
               <a href="javascript:;" id="yt_left_menu_receivables_statistics_arrow" >
				   <i class="icon-user"></i> 
				   <span class="title">收\付款统计</span>
				    <span class="arrow "></span>  			   
               </a>
               <ul class="sub-menu">	
                  <li id="yt_left_menu_receivables_salesstatistics">
                     <a href="/yzzh/ytsoft.php?s=/Receivablesstatistics/salesstatistics">
                     销售收款统计</a>
                  </li>
                  <li id="yt_left_menu_receivables_servicestatistics">
                     <a href="/yzzh/ytsoft.php?s=/Receivablesstatistics/servicestatistics">
                     售后收款统计</a>
                  </li>	
                  <li id="yt_left_menu_receivables_salesreturnstatistics">
                     <a href="/yzzh/ytsoft.php?s=/Receivablesstatistics/salesreturnstatistics">
                     销售退货付款统计</a>
                  </li>				  
			  
               </ul>	   
            </li>			
			

			
           <li id="yt_left_menu_utildesign" >
               <a href="javascript:;" id="yt_left_menu_utildesign_arrow" >
				   <i class=" icon-print"></i> 
				   <span class="title">打印报表格式修改</span>
				    <span class="arrow "></span>  			   
               </a>
               <ul class="sub-menu">			   
                  <li id="yt_left_menu_utildesign_salesrecord">
				    <a href="  JavaScript:window.open('/yzzh/ytsoft.php?s=/Utildesign/utildesign_salesrecord');   ">
                     打印销售单格式修改</a>
                  </li>
               </ul>	   
            </li>				
	
			

         <li id="yt_left_menu_others" >
               <a href="javascript:;" id="yt_left_menu_others_arrow" >
				   <i class=" icon-cogs"></i> 
				   <span class="title">&nbsp;其它操作</span>
				    <span class="arrow "></span>  			   
               </a>
			    <ul class="sub-menu">	
                  <li id="yt_left_menu_others_reportdriver" >
                     <a href="/yzzh/ytsoft.php?s=/Setreportsetup/reportdriver">  
                     打印控件安装\卸载</a>
                  </li>	
				  
               </ul>	   
           </li>						
			
			

         </ul>
         <!-- END SIDEBAR MENU -->
      </div>
      <!-- END SIDEBAR -->
      <!-- BEGIN PAGE -->
      <div class="page-content">


 
<link rel="stylesheet" type="text/css" href="/yzzh/Public/webuploader/0.1.5/webuploader.css" />
<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
<script type="text/javascript" src="/yzzh/Public/webuploader/0.1.5/webuploader.min.js"></script>
         <!-- BEGIN PAGE HEADER-->
		<div class="yt-head-row">
			 <div class="row">
				<div class="col-md-12">
				   <!-- BEGIN PAGE TITLE & BREADCRUMB-->

				   <ul class="page-breadcrumb breadcrumb">


					  <li>
						 <span>图片管理	</span>
						 <i class="icon-angle-right"></i>
					  </li>
					  <li><span>公司图片管理</span></li>
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
					  <div class="col-md-3 col-sm-4 mix category_1">
						 <div class="mix-inner">
								<h4>&nbsp;&nbsp;无图片..</h4>
						 </div>
					  </div>
						  <div class="col-md-3 col-sm-4 mix category_1 yt_margintop15 "    >
							  <?php if(is_array($res)): foreach($res as $key=>$vo): ?><div class="mix-inner " >
										   <a class="fancybox-button" href="" title="" data-rel="fancybox-button" >
											   <img class="img-responsive yt_img-responsive" src="./<?php echo ($vo['image_url']); echo ($vo['image_name']); ?> "  alt="">
										   </a>
											<a class="btn blue btn-sm tooltips " href="JavaScript:del_image('<?php echo ($vo['id']); ?>','<?php echo ($vo['image_name']); ?>','<?php echo ($parent_id); ?>')" data-original-title="删除图片" >
												<i class="icon-remove"></i></a>
									 </div><?php endforeach; endif; ?>
						  </div>

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
								 <span class="col-md-4 " >
									  <select  class="input-sm   " id="NumberOfRows" onchange="YTnumberofrows(this.options[this.selectedIndex].value)" >
											<?php if(is_array($selectrowslist)): $i = 0; $__LIST__ = $selectrowslist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option  value="<?php echo ($vo); ?>" >每页显示&nbsp;<?php echo ($vo); ?>&nbsp;条</option><?php endforeach; endif; else: echo "" ;endif; ?>
									  </select>
								 </span>
								 <span class="pagelink col-md-6 yt_margintop5 "  >
									 <?php echo ($page); ?>
								 </span>
					  </div>
				   </div>

					<div class="yt-head-row">
						 <div class="row">
							<div class="col-md-12">
								<ul class="page-breadcrumb breadcrumb">
							   </ul>
							</div>
						 </div>
					</div>


										<!-- END FILTER -->
            </div>
         </div>

				<div class="row  " >
				   	<div class="col-md-12 yt_margintop-30 ">
                        <h4 class="form-section">上传图片</h4>
									<div class="form-group">
										<div class="uploader-list-container">
											<div class="queueList">
												<div id="dndArea" class="placeholder">
													<div id="filePicker-2"></div>
													<p>或将照片拖到这里，单次最多可选300张</p>
												</div>
											</div>
											<div class="statusBar" style="display:none;">
												<div class="progress"> <span class="text">0%</span> <span class="percentage"></span> </div>
												<div class="info"></div>
												<div class="btns">
													<div id="filePicker2"></div>
													<div class="uploadBtn">开始上传</div>
												</div>
											</div>
										</div>
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
    <!--   END PAGE -->
		 <!-- BEGIN DIALOG_FORM  -->
		 <div id="yt_dialog_form" class="modal fade" tabindex="-1" aria-hidden="true" data-width="720" >
				  <div class="modal-header" id="yt_modal-header" >
					 <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					 <h4 class="modal-title" id="yt_dialog_title">修改图片描述</h4>
				  </div>
				  <div class="modal-body " >
						<form class="form-horizontal" role="form">
						  <div class="form-group">
							<label for="image_desc" class="col-sm-3 control-label">图片描述<span class="required" >*</span></label>
							<div class="col-sm-8 " >
							  <input type="text" class="form-control" id="image_desc" name="inputdatabox" >
							</div>
						  </div>
							<input id="edit_record_id" type="hidden" />
						</form>
				  </div>
				  <div class="modal-footer">
					 <button type="button" data-dismiss="modal" class="btn default" id="yt_dialog_btn_cancel">取消</button>
					 <button type="button" class="btn green" id="yt_dialog_btn_ok">确认</button>
				  </div>
		 </div>
		 <!-- END DIALOG_FORM  -->



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
	   YTaction='/yzzh/ytsoft.php?s=/Home/Showimages/show_companyimage';  
   </script>   

   
   
   
   
   



<script type="text/javascript" >
    (function( $ ){
        // 当domReady的时候开始初始化
        $(function() {
            var $wrap = $('.uploader-list-container'),

                // 图片容器
                $queue = $( '<ul class="filelist"></ul>' )
                    .appendTo( $wrap.find( '.queueList' ) ),

                // 状态栏，包括进度和控制按钮
                $statusBar = $wrap.find( '.statusBar' ),

                // 文件总体选择信息。
                $info = $statusBar.find( '.info' ),

                // 上传按钮
                $upload = $wrap.find( '.uploadBtn' ),

                // 没选择文件之前的内容。
                $placeHolder = $wrap.find( '.placeholder' ),

                $progress = $statusBar.find( '.progress' ).hide(),

                // 添加的文件数量
                fileCount = 0,

                // 添加的文件总大小
                fileSize = 0,

                // 优化retina, 在retina下这个值是2
                ratio = window.devicePixelRatio || 1,

                // 缩略图大小
                thumbnailWidth = 110 * ratio,
                thumbnailHeight = 110 * ratio,

                // 可能有pedding, ready, uploading, confirm, done.
                state = 'pedding',

                // 所有文件的进度信息，key为file id
                percentages = {},
                // 判断浏览器是否支持图片的base64
                isSupportBase64 = ( function() {
                    var data = new Image();
                    var support = true;
                    data.onload = data.onerror = function() {
                        if( this.width != 1 || this.height != 1 ) {
                            support = false;
                        }
                    }
                    data.src = "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";
                    return support;
                } )(),

                // 检测是否已经安装flash，检测flash的版本
                flashVersion = ( function() {
                    var version;

                    try {
                        version = navigator.plugins[ 'Shockwave Flash' ];
                        version = version.description;
                    } catch ( ex ) {
                        try {
                            version = new ActiveXObject('ShockwaveFlash.ShockwaveFlash')
                                .GetVariable('$version');
                        } catch ( ex2 ) {
                            version = '0.0';
                        }
                    }
                    version = version.match( /\d+/g );
                    return parseFloat( version[ 0 ] + '.' + version[ 1 ], 10 );
                } )(),

                supportTransition = (function(){
                    var s = document.createElement('p').style,
                        r = 'transition' in s ||
                            'WebkitTransition' in s ||
                            'MozTransition' in s ||
                            'msTransition' in s ||
                            'OTransition' in s;
                    s = null;
                    return r;
                })(),

                // WebUploader实例
                uploader;



            // 实例化
            uploader = WebUploader.create({
                pick: {
                    id: '#filePicker-2',
                    label: '点击选择图片'
                },
                formData: {
                    uid: 123
                },
                dnd: '#dndArea',
                paste: '#uploader',
                swf: '../Uploader.swf',
                chunked: false,
                chunkSize: 512 * 1024,
                server: '<?php echo U("webup");?>',
                // 禁掉全局的拖拽功能。这样不会出现图片拖进页面的时候，把图片打开。
                disableGlobalDnd: true,
                fileNumLimit: 300,
                fileSizeLimit: 200 * 1024 * 1024,    // 200 M
                fileSingleSizeLimit: 50 * 1024 * 1024    // 50 M
            });

            // 拖拽时不接受 js, txt 文件。
            uploader.on( 'dndAccept', function( items ) {
                var denied = false,
                    len = items.length,
                    i = 0,
                    // 修改js类型
                    unAllowed = 'text/plain;application/javascript ';

                for ( ; i < len; i++ ) {
                    // 如果在列表里面
                    if ( ~unAllowed.indexOf( items[ i ].type ) ) {
                        denied = true;
                        break;
                    }
                }

                return !denied;
            });

            uploader.on('dialogOpen', function() {
                console.log('here');
            });

            // 添加“添加文件”的按钮，
            uploader.addButton({
                id: '#filePicker2',
                label: '继续添加'
            });

            uploader.on('ready', function() {
                window.uploader = uploader;
            });

            // 当有文件添加进来时执行，负责view的创建
            function addFile( file ) {
                var $li = $( '<li id="' + file.id + '">' +
                    '<p class="title">' + file.name + '</p>' +
                    '<p class="imgWrap"></p>'+
                    '<p class="progress"><span></span></p>' +
                    '</li>' ),

                    $btns = $('<div class="file-panel">' +
                        '<span class="cancel">删除</span>' +
                        '<span class="rotateRight">向右旋转</span>' +
                        '<span class="rotateLeft">向左旋转</span></div>').appendTo( $li ),
                    $prgress = $li.find('p.progress span'),
                    $wrap = $li.find( 'p.imgWrap' ),
                    $info = $('<p class="error"></p>'),

                    showError = function( code ) {
                        switch( code ) {
                            case 'exceed_size':
                                text = '文件大小超出';
                                break;

                            case 'interrupt':
                                text = '上传暂停';
                                break;

                            default:
                                text = '上传失败，请重试';
                                break;
                        }

                        $info.text( text ).appendTo( $li );
                    };

                if ( file.getStatus() === 'invalid' ) {
                    showError( file.statusText );
                } else {
                    // @todo lazyload
                    $wrap.text( '预览中' );
                    uploader.makeThumb( file, function( error, src ) {
                        var img;

                        if ( error ) {
                            $wrap.text( '不能预览' );
                            return;
                        }

                        if( isSupportBase64 ) {
                            img = $('<img src="'+src+'">');
                            $wrap.empty().append( img );
                        } else {
                            $.ajax('../server/preview.php', {
                                method: 'POST',
                                data: src,
                                dataType:'json'
                            }).done(function( response ) {
                                if (response.result) {
                                    img = $('<img src="'+response.result+'">');
                                    $wrap.empty().append( img );
                                } else {
                                    $wrap.text("预览出错");
                                }
                            });
                        }
                    }, thumbnailWidth, thumbnailHeight );

                    percentages[ file.id ] = [ file.size, 0 ];
                    file.rotation = 0;
                }

                file.on('statuschange', function( cur, prev ) {
                    if ( prev === 'progress' ) {
                        $prgress.hide().width(0);
                    } else if ( prev === 'queued' ) {
                        $li.off( 'mouseenter mouseleave' );
                        $btns.remove();
                    }

                    // 成功
                    if ( cur === 'error' || cur === 'invalid' ) {
                        console.log( file.statusText );
                        showError( file.statusText );
                        percentages[ file.id ][ 1 ] = 1;
                    } else if ( cur === 'interrupt' ) {
                        showError( 'interrupt' );
                    } else if ( cur === 'queued' ) {
                        percentages[ file.id ][ 1 ] = 0;
                    } else if ( cur === 'progress' ) {
                        $info.remove();
                        $prgress.css('display', 'block');
                    } else if ( cur === 'complete' ) {
                        $li.append( '<span class="success"></span>' );
                    }

                    $li.removeClass( 'state-' + prev ).addClass( 'state-' + cur );
                });

                $li.on( 'mouseenter', function() {
                    $btns.stop().animate({height: 30});
                });

                $li.on( 'mouseleave', function() {
                    $btns.stop().animate({height: 0});
                });

                $btns.on( 'click', 'span', function() {
                    var index = $(this).index(),
                        deg;

                    switch ( index ) {
                        case 0:
                            uploader.removeFile( file );
                            return;

                        case 1:
                            file.rotation += 90;
                            break;

                        case 2:
                            file.rotation -= 90;
                            break;
                    }

                    if ( supportTransition ) {
                        deg = 'rotate(' + file.rotation + 'deg)';
                        $wrap.css({
                            '-webkit-transform': deg,
                            '-mos-transform': deg,
                            '-o-transform': deg,
                            'transform': deg
                        });
                    } else {
                        $wrap.css( 'filter', 'progid:DXImageTransform.Microsoft.BasicImage(rotation='+ (~~((file.rotation/90)%4 + 4)%4) +')');
                    }


                });

                $li.appendTo( $queue );
            }

            // 负责view的销毁
            function removeFile( file ) {
                var $li = $('#'+file.id);

                delete percentages[ file.id ];
                updateTotalProgress();
                $li.off().find('.file-panel').off().end().remove();
            }

            function updateTotalProgress() {
                var loaded = 0,
                    total = 0,
                    spans = $progress.children(),
                    percent;

                $.each( percentages, function( k, v ) {
                    total += v[ 0 ];
                    loaded += v[ 0 ] * v[ 1 ];
                } );

                percent = total ? loaded / total : 0;


                spans.eq( 0 ).text( Math.round( percent * 100 ) + '%' );
                spans.eq( 1 ).css( 'width', Math.round( percent * 100 ) + '%' );
                updateStatus();
            }

            function updateStatus() {
                var text = '', stats;

                if ( state === 'ready' ) {
                    text = '选中' + fileCount + '张图片，共' +
                        WebUploader.formatSize( fileSize ) + '。';
                } else if ( state === 'confirm' ) {
                    stats = uploader.getStats();
                    if ( stats.uploadFailNum ) {
                        text = '已成功上传' + stats.successNum+ '张照片至XX相册，'+
                            stats.uploadFailNum + '张照片上传失败，<a class="retry" href="#">重新上传</a>失败图片或<a class="ignore" href="#">忽略</a>'
                    }

                } else {
                    stats = uploader.getStats();
                    text = '共' + fileCount + '张（' +
                        WebUploader.formatSize( fileSize )  +
                        '），已上传' + stats.successNum + '张';

                    if ( stats.uploadFailNum ) {
                        text += '，失败' + stats.uploadFailNum + '张';
                    }
                }

                $info.html( text );
            }

            function setState( val ) {
                var file, stats;

                if ( val === state ) {
                    return;
                }

                $upload.removeClass( 'state-' + state );
                $upload.addClass( 'state-' + val );
                state = val;

                switch ( state ) {
                    case 'pedding':
                        $placeHolder.removeClass( 'element-invisible' );
                        $queue.hide();
                        $statusBar.addClass( 'element-invisible' );
                        uploader.refresh();
                        break;

                    case 'ready':
                        $placeHolder.addClass( 'element-invisible' );
                        $( '#filePicker2' ).removeClass( 'element-invisible');
                        $queue.show();
                        $statusBar.removeClass('element-invisible');
                        uploader.refresh();
                        break;

                    case 'uploading':
                        $( '#filePicker2' ).addClass( 'element-invisible' );
                        $progress.show();
                        $upload.text( '暂停上传' );
                        break;

                    case 'paused':
                        $progress.show();
                        $upload.text( '继续上传' );
                        break;

                    case 'confirm':
                        $progress.hide();
                        $( '#filePicker2' ).removeClass( 'element-invisible' );
                        $upload.text( '开始上传' );

                        stats = uploader.getStats();
                        if ( stats.successNum && !stats.uploadFailNum ) {
                            setState( 'finish' );
                            return;
                        }
                        break;
                    case 'finish':
                        stats = uploader.getStats();
                        if ( stats.successNum ) {
                            alert( '上传成功' );
                        } else {
                            // 没有成功的图片，重设
                            state = 'done';
                            location.reload();
                        }
                        break;
                }

                updateStatus();
            }

            uploader.onUploadProgress = function( file, percentage ) {
                var $li = $('#'+file.id),
                    $percent = $li.find('.progress span');

                $percent.css( 'width', percentage * 100 + '%' );
                percentages[ file.id ][ 1 ] = percentage;
                updateTotalProgress();
            };

            uploader.onFileQueued = function( file ) {
                fileCount++;
                fileSize += file.size;

                if ( fileCount === 1 ) {
                    $placeHolder.addClass( 'element-invisible' );
                    $statusBar.show();
                }

                addFile( file );
                setState( 'ready' );
                updateTotalProgress();
            };

            uploader.onFileDequeued = function( file ) {
                fileCount--;
                fileSize -= file.size;

                if ( !fileCount ) {
                    setState( 'pedding' );
                }

                removeFile( file );
                updateTotalProgress();

            };

            uploader.on( 'all', function( type ) {
                var stats;
                switch( type ) {
                    case 'uploadFinished':
                        setState( 'confirm' );
                        break;

                    case 'startUpload':
                        setState( 'uploading' );
                        break;

                    case 'stopUpload':
                        setState( 'paused' );
                        break;

                }
            });

            uploader.onError = function( code ) {
                alert( 'Eroor: ' + code );
            };

            $upload.on('click', function() {
                if ( $(this).hasClass( 'disabled' ) ) {
                    return false;
                }

                if ( state === 'ready' ) {
                    uploader.upload();
                } else if ( state === 'paused' ) {
                    uploader.upload();
                } else if ( state === 'uploading' ) {
                    uploader.stop();
                }
            });

            $info.on( 'click', '.retry', function() {
                uploader.retry();
            } );

            $info.on( 'click', '.ignore', function() {
                alert( 'todo' );
            } );

            $upload.addClass( 'state-' + state );
            updateTotalProgress();
        });

    })( jQuery );
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
  <script type="text/javascript">

	function ZYTshowimagesurl(title,url) {    //打开显示链接对话框
    	prompt(title,url);
	}

     function dialogcheckdata() {
         var checkvalid = true;
	       checkvalid = checkvalid && checkLength( $( "#image_desc" ), "图片描述", StringLength000, StringLength100 );
	     return checkvalid;
	  }	;
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