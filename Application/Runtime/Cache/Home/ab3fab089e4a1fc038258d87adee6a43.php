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
	 		 
        <h3 class="yt_margintop15 yt_marginbottom25 ">答疑、建议、反馈</h3>	
			 <div class="table-toolbar">
				<div class="btn-group">
				   <button id="yt_btn_add" class="btn green"   >
				   添加 <i class="icon-plus"></i>
				   </button>
				</div>
			 </div>		
			 <div class="table-responsive"> 
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
										  <?php if(($vo1["key"] != "memo" )): echo ($vo[$vo1['key']]); ?>	
										  <?php else: ?>	 
													<a class="tooltips" data-original-title="详情"  href= "JavaScript:YTquestions_info('<?php echo ($vo['id']); ?>') " ><?php echo ($vo[$vo1['key']]); ?></a><?php endif; ?>  	
								   </td><?php endforeach; endif; else: echo "" ;endif; ?>	
					  
						   </tr><?php endforeach; endif; else: echo "" ;endif; ?>	
						  
                        </tbody>
                     </table>
					 <div class="row">
						<div class="col-md-12 yt_margintop15 ">

									 <span class="col-md-4 " >
										  <select  class="input-sm   " id="NumberOfRows" onchange="YTnumberofrows(this.options[this.selectedIndex].value)" >
												<?php if(is_array($selectrowslist)): $i = 0; $__LIST__ = $selectrowslist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option  value="<?php echo ($vo); ?>" >每页显示&nbsp;<?php echo ($vo); ?>&nbsp;条</option><?php endforeach; endif; else: echo "" ;endif; ?>		
										  </select>				  
									 </span>										 																	 
									 <span class="pagelink col-md-6 yt_margintop-0 "  >
										 <?php echo ($page); ?> 	
										 <input id="select_interval_days"  value="<?php echo (session('select_interval_days')); ?>"  type="hidden"   /> <!--查询间隔天数天 --> 
									 </span>						 						 
						  </div>
					   </div>						 
					  <?php endif ?>	
					  
					  
                    </div>
            <!-- END PAGE CONTENT-->
 			
         </div>

		 
            <!-- END PAGE CONTENT-->
			
		 <!-- BEGIN DIALOG_FORM  -->
		 <div id="yt_dialog_form" class="modal fade" tabindex="-1" aria-hidden="true" data-width="650" >
				  <div class="modal-header" id="yt_modal-header" >
					 <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					 <h4 class="modal-title" id="yt_dialog_title">添加</h4>
				  </div>
				  <div class="modal-body " >
						<form class="form-horizontal" role="form">
						
							<div class="form-group">
							   <label for="unit" class="control-label col-md-3">类型<span class="required" >*</span></label>
							   <div class="col-md-8">	
                                          <div class="radio-list yt_marginleft20"  >
										     <label   class="radio-inline" >
                                                  <input type="radio" name="question_type" value="答疑"  />答疑
											 </label>
											 <label  class="radio-inline" >
                                                  <input type="radio" name="question_type" value="建议" />建议
                                             </label>
											 <label  class="radio-inline" >
                                                  <input type="radio" name="question_type" value="反馈" />反馈
                                             </label>											 
										  </div>

							   </div>						   
							</div>							
						
						  <div class="form-group yt_margintop20 ">
							<label for="name" class="col-sm-3 control-label">答疑、建议、反馈<span class="required" >*</span></label>
							<div class="col-sm-8 " >
							   <textarea class="form-control" rows="5"   id="memo" ></textarea>
							</div>
						  </div>                                         
						</form>								
				  </div>
				  <div class="modal-footer">
					 <button type="button" data-dismiss="modal" class="btn default" id="yt_dialog_btn_cancel">取消</button>
					 <button type="button" class="btn green" onClick=" YTquestions_add()	 " >确认</button>  
				  </div>
		 </div>
		 <!-- END DIALOG_FORM  -->				
			
			
 			
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
	   YTaction='/yzzh/ytsoft.php?s=/Home/Setcompany/questions_list';  
   </script>   

   
   
   
   
   




   
   <script>
    jQuery(document).ready(function() {    
		showSelect('#NumberOfRows','<?php echo (cookie('NumberOfRows')); ?>');	
      });

   </script>
  <script type="text/javascript">  
     function dialogcheckdata() {  
         var checkvalid = true;
	       checkvalid = checkvalid &&  checkEmpty( $( "#memo" ) , "答疑、建议、反馈内容" ) ;
	     return checkvalid;
	  };
	
    function dialogclearinputbox() {   
        dialog_clear_allbox();
		$("#memo").focus();  
	  }	;
	  
	 function dialog_clear_allbox() {  
		var a=document.getElementsByName( "inputdatabox" ) ; 
		for(var   i=0;i <a.length;i++) 
		   a[i].value='';	  				
} ;
	  	  		  	  	
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
	<input id="url_url"  value="/yzzh/ytsoft.php?s=/Home/Setcompany"  type="hidden" />
	<input id="url_public"  value="/yzzh/Public"  type="hidden" />
	<input id="url_app"  value="/yzzh/ytsoft.php?s="  type="hidden" />
</div>
 
 
</body>
</html>