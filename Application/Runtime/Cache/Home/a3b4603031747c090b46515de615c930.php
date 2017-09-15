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
   
 
 

   <div class="container">
      <!-- BEGIN CONTAINER -->  
      <div class="page-container">
	  	  
         <!-- BEGIN PAGE -->
         <div class="page-content">
		 
            <!-- BEGIN PAGE HEADER-->
            <div class="row">
               <div class="col-md-12">
                  <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                  <h3 class="page-title yt_floatleft">
                     打印销售单格式修改 				 
                  </h3>	

				 <button  class="btn green yt_marginbottom10 yt_floatright "  onClick=" YTgetdesign_programcodes() "  >
					   修改结束别忘了点这里，修改确认 <i class="icon-ok"></i>
				 </button>	

					 
                  <!-- END PAGE TITLE & BREADCRUMB-->
               </div>
            </div>
			
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
		 
         <div class="row">
            <div class="col-md-12">
				<object id="LODOP" classid="clsid:2105C259-1E0C-4534-8141-A753534CB4CA" width="100%" height="650"> 
				  <param name="Caption" value="内嵌显示区域">
				  <param name="Border" value="1">
				  <param name="Color" value="#C0C0C0">  
				  <embed id="LODOP_EM" TYPE="application/x-print-lodop" width=100% height=650 PLUGINSPAGE="install_lodop.exe">
				</object> 				
            </div>
         </div>		
		 
         <div class="row">
            <div class="col-md-12">
				 <button  class="btn dark yt_margintop10 yt_floatright btn-xs "  onClick=" YTgetsystemdesign_programcodes() "  >
					   恢复系统默认的模板 
				 </button>					
            </div>
         </div>		
		<div id="YTdiv"  class='yt_nodisplay' >
			  <table border=1 width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse" bordercolor="#000000"  >
					<thead>
							<tr>
								  <th>序号</th>										 
								  <th>商品名称/规格/编号</th>								  
								  <th>单位</th>
								  <th class="yt_text_right">数量</th>
								  <th class="yt_text_right">单价</th>
								  <th class="yt_text_right">金额</th>	
							</tr>
					</thead>
					<tbody>	
						  <tr>
							<TD >1</TD>
							<TD >名称1</TD>
							<TD >单位1</TD>
							<TD align="right">数量1</TD>
							<TD align="right">单价1</TD>
							<TD align="right">金额1</TD>
						  </tr> 
						  <tr>
							<TD >2</TD>
							<TD >名称2</TD>
							<TD >单位2</TD>
							<TD align="right">数量2</TD>
							<TD align="right">单价2</TD>
							<TD align="right">金额2</TD>
						  </tr> 
						  <tr>
							<TD >3</TD>
							<TD >名称3</TD>
							<TD >单位3</TD>
							<TD align="right">数量3</TD>
							<TD align="right">单价3</TD>
							<TD align="right">金额3</TD>
						  </tr> 
						  <tr>
							<TD >4</TD>
							<TD >名称4</TD>
							<TD >单位4</TD>
							<TD align="right">数量4</TD>
							<TD align="right">单价4</TD>
							<TD align="right">金额4</TD>
						  </tr> 
						  <tr>
							<TD >5</TD>
							<TD >名称5</TD>
							<TD >单位5</TD>
							<TD align="right">数量5</TD>
							<TD align="right">单价5</TD>
							<TD align="right">金额5</TD>
						  </tr> 											  
					</tbody>
		</table>
	</div>
		 <input id="report_programcodes"  type="hidden"   name="yt_input_data"  /> <!--销售报表 程序代码 --> 
		 <input id="flag"  type="hidden"  type="hidden" value="1" name="yt_input_data"  /> <!--销售报表--> 
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
	   YTaction='/yzzh/ytsoft.php?s=/Home/Utildesign/utildesign_salesrecord';  
   </script>   

   
   
   
   
   



   <script>
    jQuery(document).ready(function() {    
         App.init();
		 YTdisplaydesign();
		 
      });

	YTprinter_orient=<?php echo ($report_setup['orient1']); ?> ;
   </script>
   
<script language="javascript" type="text/javascript"> 
	var LODOP; 
	function CreatePage(){
	  LODOP=getLodop(document.getElementById('LODOP'),document.getElementById('LODOP_EM')); 
	   <?php echo ($report_programcodes); ?>	;
 
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
	<input id="url_url"  value="/yzzh/ytsoft.php?s=/Home/Utildesign"  type="hidden" />
	<input id="url_public"  value="/yzzh/Public"  type="hidden" />
	<input id="url_app"  value="/yzzh/ytsoft.php?s="  type="hidden" />
</div>
 
 
</body>
</html>