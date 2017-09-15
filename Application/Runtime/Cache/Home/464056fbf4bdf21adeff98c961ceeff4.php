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


  

   <h3 class="form-section yt_margintop-5  yt_floatleft "><?php echo (cookie('think_language')); ?>首页<?php echo (L("_TEST_")); ?></h3>
         <div class="row">
            <div class="col-md-12 ">		
			
			                <h5 class="form-section yt_floatleft yt_margintop45 ">&nbsp;&nbsp;售后模块&nbsp;&nbsp;</h5>		
							
							<div class="yt_icon-btn  yt_floatleft ">
									&nbsp;&nbsp;<?php echo ($index_service1); ?>&nbsp;&nbsp;<p></p>
									&nbsp;&nbsp;<?php echo ($index_service2); ?>&nbsp;&nbsp;<p></p>
									&nbsp;&nbsp;<?php echo ($index_service3); ?>&nbsp;&nbsp;<p></p>
							</div>	
							
                            <div class="yt_margintop55  yt_floatleft  "><i class="icon-arrow-right "></i>						
								<div class="yt_icon-btn ">
										&nbsp;&nbsp;<?php echo ($index_service4); ?><p></p>
										<span class="badge badge-important yt_position-absolute"><?php echo ($count_serviceprocessdispatch); ?></span>
								</div>	 
							</div>				
						
                            <div class="yt_margintop55  yt_floatleft  "><i class="icon-arrow-right "></i>							
								<div class="yt_icon-btn ">
										&nbsp;&nbsp;<?php echo ($index_service5); ?><p></p>
										<span class="badge badge-important yt_position-absolute"><?php echo ($count_serviceprocesscompleted); ?></span>
								</div>	 
							</div>	
						
                            <div class="yt_margintop55  yt_floatleft  "><i class="icon-arrow-right "></i>							
								<div class="yt_icon-btn ">
										&nbsp;&nbsp;<?php echo ($index_service6); ?><p></p>
										<span class="badge badge-important yt_position-absolute"><?php echo ($count_serviceprocessconfirm); ?></span>
								</div>	 
							</div>	
							
							<span class="yt_marginright5 yt_margintop73 yt_floatleft " ><i class="icon-arrow-right "></i></span> 							
                            <div class="yt_margintop55  yt_floatleft  ">								
								<div class="yt_icon-btn">
										&nbsp;&nbsp;<?php echo ($index_service7); ?>
										&nbsp;<?php echo ($index_service8); ?>&nbsp;&nbsp;	<p></p>	
								</div>	
							</div>	
														
	                        <div class=" yt_floatleft yt_marginleft-450">&nbsp;&nbsp;&nbsp;<i class="icon-arrow-right "></i>					
								<div class="yt_icon-btn ">
								        &nbsp;&nbsp;<?php echo ($index_service9); ?>&nbsp;
										<?php echo ($index_service10); ?>&nbsp;
										<?php echo ($index_service11); ?>&nbsp;
										<?php echo ($index_service12); ?>&nbsp;&nbsp;<p></p>		
								</div>	 
							</div>							
							
																	
			
			</div>		
        </div>			

         <div class="row">
            <div class="col-md-12 yt_margintop20">		
			                <h5 class="form-section yt_floatleft yt_margintop45 ">&nbsp;&nbsp;销售模块&nbsp;&nbsp;</h5>		
							
                            <div class="yt_icon-btn yt_floatleft   ">
									&nbsp;&nbsp;<?php echo ($index_sales1); ?>&nbsp;&nbsp;<p></p>
									&nbsp;&nbsp;<?php echo ($index_sales2); ?>&nbsp;&nbsp;<p></p>	
									&nbsp;&nbsp;<?php echo ($index_sales3); ?>&nbsp;&nbsp;<p></p>	
                            </div>	

                            <div class="yt_margintop25  yt_floatleft  ">	 <i class="icon-arrow-right "></i>						
								<div class="yt_icon-btn ">
										&nbsp;&nbsp;<?php echo ($index_sales4); ?><p></p>
										<span class="badge badge-important yt_position-absolute"><?php echo ($count_salesprocessconfirm); ?></span>
								</div>	 
							</div>	
														
                            <span class="yt_marginright5 yt_margintop45 yt_floatleft " > <i class="icon-arrow-right "></i></span> 	
                            <div class="yt_floatleft ">	 										
								<div class="yt_icon-btn">
								        &nbsp;&nbsp;<?php echo ($index_sales5); ?>&nbsp;&nbsp;<p></p>
										&nbsp;&nbsp;<?php echo ($index_sales6); ?>&nbsp;&nbsp; <?php echo ($index_sales7); ?> <p></p>							        
										&nbsp;&nbsp;<?php echo ($index_sales8); ?>&nbsp;&nbsp; <?php echo ($index_sales9); ?>	<p></p>
										<p></p>	
								</div>	
							</div>	

                             <span class="yt_floatleft yt_marginleft-230 yt_margintop73 " > <i class="icon-arrow-down "></i> </span>  																					
										
			
			</div>		
        </div>		
		
         <div class="row">
            <div class="col-md-12 yt_margintop30">	
			
			                <h5 class="form-section yt_floatleft yt_margintop15 ">&nbsp;&nbsp;库存管理&nbsp;&nbsp;</h5>					
			
                            <div class="yt_icon-btn yt_floatleft   ">
										&nbsp;&nbsp;<?php echo ($index_stock1); ?>&nbsp;&nbsp;<?php echo ($index_stock2); ?>&nbsp;&nbsp;<p></p>							
										<p></p>	
                            </div>	

                            <div class="yt_floatleft  ">	 <i class="icon-arrow-right "></i>						
								<div class="yt_icon-btn ">
										&nbsp;&nbsp;<?php echo ($index_stock3); ?> 	<p></p>
								</div>	 
							</div>	
							
                            <div class="yt_floatleft  ">	 <i class="icon-arrow-left "></i>						
								<div class="yt_icon-btn ">
										&nbsp;&nbsp;<?php echo ($index_stock4); ?>&nbsp;<?php echo ($index_stock5); ?>&nbsp;&nbsp;<p></p>
								</div>	 
							</div>	

                           <span class="yt_floatleft yt_marginleft-248 yt_margintop-15 " > <i class="icon-arrow-down "></i> </span> 
						   <span class="yt_floatleft yt_marginleft-270 yt_margintop-35 " >自动减库存</span>  		
			</div>		
        </div>		
		
         <div class="row">
            <div class="col-md-12 yt_margintop20">		
                            <h5 class="form-section yt_floatleft yt_margintop30 ">&nbsp;&nbsp;客户管理&nbsp;&nbsp;</h5>					
                            <div class="yt_icon-btn yt_floatleft   ">
									&nbsp;&nbsp;<?php echo ($index_customer1); ?>&nbsp;&nbsp;<p></p>
									&nbsp;&nbsp;<?php echo ($index_customer2); ?>&nbsp;&nbsp;<p></p>
                            </div>	
							
                            <span class="yt_marginright5 yt_margintop30 yt_floatleft " > <i class="icon-arrow-right "></i></span> 								
							
                            <div class="yt_floatleft yt_margintop-15 ">						
								<div class="yt_icon-btn ">
										&nbsp;&nbsp;客户详细资料里面可以查询和添加：<p></p>
										&nbsp;&nbsp;销售记录，售后记录，投诉记录，客户图片&nbsp;&nbsp;<p></p>
										&nbsp;&nbsp;客户提醒日设置（按日或按年间隔提醒）&nbsp;<p></p>
								</div>	 
							</div>	
								
			</div>		
        </div>	

		<div class="row">
            <div class="col-md-12 yt_margintop20">		
                            <h5 class="form-section yt_floatleft yt_margintop45 ">&nbsp;&nbsp;定期提醒&nbsp;&nbsp;</h5>					
                            <div class="yt_icon-btn yt_floatleft   ">
									&nbsp;&nbsp;<?php echo ($index_regularday1); ?>&nbsp;<span class="badge badge-important"><?php echo ($count_regularmaintenance); ?></span>&nbsp;<p></p>
									
									&nbsp;&nbsp;<?php echo ($index_regularday2); ?>&nbsp;<span class="badge badge-important "><?php echo ($count_regularday); ?></span>&nbsp;<p></p>
									&nbsp;&nbsp;<?php echo ($index_regularday3); ?>&nbsp;<span class="badge badge-important "><?php echo ($count_regularyear); ?></span>&nbsp;<p></p>
                            </div>	
							
                            <span class="yt_marginright5 yt_margintop45 yt_floatleft " > <i class="icon-arrow-right "></i></span> 								
							
                            <div class="yt_floatleft">						
								<div class="yt_icon-btn ">
										&nbsp;&nbsp;定期维护查询：<?php echo ($index_regularday4); ?>里面如果设置&nbsp;&nbsp;<p></p>
										&nbsp;&nbsp;了商品的定期维护时间间隔，那录入销售记&nbsp;&nbsp;<p></p>
										&nbsp;&nbsp;录后，就会自动按这个时间间隔提醒&nbsp;&nbsp;<p></p>
								</div>	 
							</div>								
			
			</div>		
        </div>	

         <div class="row">
            <div class="col-md-12 yt_margintop30">	
                            <h5 class="form-section yt_floatleft yt_margintop45 ">&nbsp;&nbsp;投诉管理&nbsp;&nbsp;</h5>					
			
                            <div class="yt_icon-btn yt_floatleft   ">
									&nbsp;&nbsp;<?php echo ($index_complain1); ?>&nbsp;&nbsp;<p></p>
									&nbsp;&nbsp;<?php echo ($index_complain2); ?>&nbsp;&nbsp;<p></p>
									&nbsp;&nbsp;<?php echo ($index_complain3); ?>&nbsp;&nbsp;<p></p>
                            </div>	
							
                            <div class="yt_margintop25  yt_floatleft  ">	 <i class="icon-arrow-right "></i>						
								<div class="yt_icon-btn ">
										&nbsp;&nbsp;<?php echo ($index_complain4); ?>&nbsp;&nbsp;<p></p>
										<span class="badge badge-important yt_position-absolute "><?php echo ($count_complain); ?></span>
								</div>	 
							</div>								
			
			</div>		
        </div>		
		
  <a  href="/yzzh/ytsoft.php?s=/Index/index_menu/flag/1" class="btn btn-xs  Default  yt_floatright "  >刷新&nbsp;<i class=" icon-refresh "  ></i></a>  

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
	   YTaction='/yzzh/ytsoft.php?s=/Home/Index/index_menu';  
   </script>   

   
   
   
   
   



<script>

    jQuery(document).ready(function() {       
         App.init();
        $('#yt_left_menu_index').addClass("active");  
    });
</script>
</body>
</html>