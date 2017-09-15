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
   
  <!-- 
   <link rel="stylesheet" type="text/css" href="/yzzh/Public/assets/plugins/data-tables/jquery.dataTables.css" /> 
   <link rel="stylesheet" type="text/css" href="/yzzh/Public/assets/plugins/data-tables/DT_bootstrap.css" />
   <link rel="stylesheet" type="text/css" href="/yzzh/Public/assets/plugins/select2/select2-bootstrap.css" />  -->


   <link rel="shortcut icon" href="/yzzh/Public/assets/img/yt.ico" />  

</head>
<!-- END HEAD -->
<!-- BEGIN BODY  --> 
<body class="page-header-fixed page-full-width"> 
   <div class="header navbar navbar-inverse navbar-fixed-top">   
   
      <!-- BEGIN TOP NAVIGATION BAR -->
      <div class="header-inner container">
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
			      <li><a href="/yzzh/ytsoft.php?s=//Index/index_menu" target="_blank" >软件主页</a>
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
   
 
 

   <div class="container">
      <!-- BEGIN CONTAINER -->  
      <div class="page-container">	  	  
         <!-- BEGIN PAGE -->
         <div class="page-content">
	 		 
        <h3 class="yt_margintop15 yt_marginbottom15 ">软件付费模式</h3>		 		 
		 <table class="table  table-bordered " >  
			<tbody>	
					<TR >
						<TD width="30%" align="right"  style="vertical-align:middle;"  >套餐名称：</TD>						
						<TD width="70%" ><?php echo (session('plan_name')); ?></TD>	
					 </TR>	
					<TR >
						<TD width="30%" align="right"  style="vertical-align:middle;"  >套餐截止日：</TD>						
						<TD width="70%" ><?php echo (session('plan_date')); ?></TD>	
					 </TR>							 
					<TR >
						<TD width="30%" align="right"  style="vertical-align:middle;"  >套餐容量：</TD>						
						<TD width="70%" >（客户数量+销售记录数量+售后记录数量+图片数量）〈<?php echo (session('plan_count')); ?>条	</TD>	
					 </TR>	
					<TR >
						<TD width="30%" align="right"  style="vertical-align:middle;"  >实际使用量：</TD>						
						<TD width="70%" ><?php echo (session('count_total')); ?>（其中：客户数量<?php echo (session('count_customer')); ?>条，销售记录<?php echo (session('count_sales')); ?>条，售后记录<?php echo (session('count_service')); ?>条，图片数量<?php echo (session('count_images')); ?>条）	</TD>	
					 </TR>					 
			 </tbody>		
		 </table>		
         <h3 class="yt_margintop15 yt_marginbottom15 ">软件付费记录</h3>	
					 <?php if($recordlist==null) : ?>	
							 <div class="news-blocks yt_margintop15 ">
								<h4>无数据...</h4>
							 </div>	
					<?php else : ?>  				
                      <table class="table table-striped table-bordered table-hover table-full-width  row-border order-column      " id="yt_table">   
                        <thead >
                           <tr>
							  <?php if(is_array($table_head)): $i = 0; $__LIST__ = $table_head;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><th><?php echo ($vo['value']); ?></th><?php endforeach; endif; else: echo "" ;endif; ?>	
							     
                           </tr>
                        </thead>					
                        <tbody>
						<?php if(is_array($recordlist)): $i = 0; $__LIST__ = $recordlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="">
							  <?php if(is_array($table_head)): $i = 0; $__LIST__ = $table_head;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?><td>									  
										<?php echo ($vo[$vo1['key']]); ?>	
								   </td><?php endforeach; endif; else: echo "" ;endif; ?>	
					  
						   </tr><?php endforeach; endif; else: echo "" ;endif; ?>	
						  
                        </tbody>
                     </table>
					  <?php endif ?>	

        <h3 class="yt_margintop15 yt_marginbottom15 ">操作</h3>
					<div class="col-md-12 " >
						  <div class="col-md-6   ">	
								
						  </div>	 										  
						  <div class="col-md-6  yt_text_center   ">	
							   <a class="btn blue" target="_blank" href="<?php echo (session('url_planadd')); ?>">充值 <i class="icon-plus"></i>	</a> 
						 </div>									 																 
					</div> 	
		 
            <!-- END PAGE CONTENT-->
 			
         </div>

		 
            <!-- END PAGE CONTENT-->
 			
         </div>
         <!-- END PAGE -->
      </div>
   </div>
  
   
   <!-- END CONTAINER -->
   

     <!-- END CONTAINER -->
   <!-- BEGIN FOOTER -->
   <div class="footer">
      <div class="container">
         <div class="footer-inner">
            <?php echo (session('soft_footer')); ?>
         </div>
         <div class="footer-tools">
            <span class="go-top">
            <i class="icon-angle-up"></i>
            </span>
         </div>
      </div>
   </div>
   <!-- END FOOTER -->
   <script src="/yzzh/Public/assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>  
   <script src="/yzzh/Public/assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
   <script src="/yzzh/Public/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
   <script src="/yzzh/Public/Minify/index.php?g=web_js" type="text/javascript"></script>
   <script>
	   YTapp='/yzzh/ytsoft.php?s=';  
	   YTaction='/yzzh/ytsoft.php?s=/Home/Setcompany/money_info';  
   </script>   

   
   
   
   
   




   
   <script>
    jQuery(document).ready(function() {    
       //  App.init();
		// Portfolio.init();
		$('input[type="checkbox"]').attr('disabled', 'disabled');		
      });

   </script>

</body>
</html>