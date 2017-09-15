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
   
 
 

   <div class="container">
      <!-- BEGIN CONTAINER -->  
      <div class="page-container">	  	  
         <!-- BEGIN PAGE -->
         <div class="page-content">
	 		 
		 <h3 class="yt_margintop5 yt_marginbottom15 ">我的账户信息</h3>		 
		 <table class="table  table-bordered " >  
			<tbody>	
					<TR >
						<TD width="30%" align="right"  style="vertical-align:middle;"  >登录用户名：</TD>						
						<TD width="70%" ><?php echo ($userinfo["username"]); ?></TD>	
					 </TR>	
					<TR >
						<TD width="30%" align="right"  style="vertical-align:middle;"  >真实姓名：</TD>						
						<TD width="70%" ><?php echo ($userinfo["realname"]); ?></TD>	
					 </TR>							 
					<TR >
						<TD width="30%" align="right"  style="vertical-align:middle;"  >状态：</TD>						
						<TD width="70%" ><?php echo ($userinfo["status"]); ?>	</TD>	
					 </TR>	
					<TR >
						<TD width="30%" align="right"  style="vertical-align:middle;"  >是否售后人员：</TD>						
						<TD width="70%" ><?php echo ($userinfo["servicestaff"]); ?>	</TD>	
					 </TR>	
					<TR >
						<TD width="30%" align="right"  style="vertical-align:middle;"  >注册E_mail（找回和修改密码使用）：</TD>						
						<TD width="70%" ><?php echo ($userinfo["mail"]); ?>	</TD>	
					 </TR>						 
			 </tbody>		
		 </table>	
		 <h3 class="yt_margintop15 yt_marginbottom15 ">我的工作权限</h3>		
		<?php if($data==null) : ?>	
			 <table class="table  table-bordered " >  
				<tbody>					
						<TD width="30%" align="right"  style="vertical-align:middle;"  >权限：</TD>						
						<TD width="70%" >系统管理员，拥有软件的全部权限</TD>							
						
				 </tbody>		
			 </table>							   	  
		<?php else : ?>			 
		 <table class="table  table-bordered " >  
			<tbody>			
					<TR >
						<TD width="20%" align="right"  style="vertical-align:middle;"  >组（角色）：</TD>						
						<TD width="80%" ><?php echo ($reuslt["title"]); ?>	</TD>	
					 </TR>				
					<TR >
						<TD  align="right"  rowspan="2"  >权限： </TD>
						<TD>  
						      <a class="btn blue btn-xs " href="/yzzh/ytsoft.php?s=/Setcompany/user_info/flag/2">显示没有的权限 <i class="icon-edit"></i> </a>&nbsp;&nbsp;
						      <a class="btn blue btn-xs " href="/yzzh/ytsoft.php?s=/Setcompany/user_info/flag/1">隐藏没有的权限 <i class="icon-edit"></i> </a>
						</TD>	 
					</TR>	
					<TR >
					
					   <?php if(($flag == "1" )): ?><td class="yt_news-blocks ">
										<?php if(is_array($data)): foreach($data as $key=>$vo): if( strpos($reuslt['rules'],','.$vo['id'].',') > -1 ): ?><div class="news-blocks ">	
												        <label for="chk<?php echo ($vo["id"]); ?>" >  <input  type="checkbox" class="checkbox01" name="rules[]"  id="chk<?php echo ($vo["id"]); ?>" onclick="YTauth_checkbox( $('#chk<?php echo ($vo["id"]); ?>'),<?php echo ($vo["id"]); ?>)" value="<?php echo ($vo["id"]); ?>" checked="true" />&nbsp;<?php echo ($vo["title"]); ?> </label> 
														    <br/>		
							
													<?php if(is_array($vo['sub'])): foreach($vo['sub'] as $key=>$sub): if( strpos($reuslt['rules'],','.$sub['id'].',') > -1 ): ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;┠─&nbsp;<label for="chk<?php echo ($sub["id"]); ?>" >  <input  type="checkbox" class="checkbox<?php echo ($vo["id"]); ?>" name="rules[]"  id="chk<?php echo ($sub["id"]); ?>" onclick="YTauth_checkbox_sub($('#chk<?php echo ($sub["id"]); ?>'),<?php echo ($sub["id"]); ?>,$('#chk<?php echo ($vo["id"]); ?>'))" value="<?php echo ($sub["id"]); ?>" checked="true" />&nbsp;<?php echo ($sub["title"]); ?> </label> 
																	
																<?php if(is_array($sub['sub1'])): foreach($sub['sub1'] as $key=>$sub1): if( strpos($reuslt['rules'],','.$sub1['id'].',') > -1 ): ?><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
																	    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;┠─&nbsp;<label for="chk<?php echo ($sub1["id"]); ?>" >  <input  type="checkbox" class="checkbox<?php echo ($sub["id"]); ?>" name="rules[]"  id="chk<?php echo ($sub1["id"]); ?>"  onclick="YTauth_checkbox_sub1($('#chk<?php echo ($sub1["id"]); ?>'),$('#chk<?php echo ($sub["id"]); ?>'),$('#chk<?php echo ($vo["id"]); ?>'))" value="<?php echo ($sub1["id"]); ?>" checked="true" />&nbsp;<?php echo ($sub1["title"]); ?> </label><?php endif; endforeach; endif; ?>
														      <br/><?php endif; endforeach; endif; ?>
											</div><?php endif; endforeach; endif; ?>
								</td>
						 <?php else: ?>	
								<td class="yt_news-blocks ">
										<?php if(is_array($data)): foreach($data as $key=>$vo): ?><div class="news-blocks ">	
												<label for="chk<?php echo ($vo["id"]); ?>" >  <input  type="checkbox" class="checkbox01" name="rules[]"  id="chk<?php echo ($vo["id"]); ?>" onclick="YTauth_checkbox( $('#chk<?php echo ($vo["id"]); ?>'),<?php echo ($vo["id"]); ?>)" value="<?php echo ($vo["id"]); ?>" <?php if( strpos($reuslt['rules'],','.$vo['id'].',') > -1 ): ?>checked="true"<?php endif; ?>  />&nbsp;<?php echo ($vo["title"]); ?> </label> 
														 <br/>										
													<?php if(is_array($vo['sub'])): foreach($vo['sub'] as $key=>$sub): ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;┠─&nbsp;<label for="chk<?php echo ($sub["id"]); ?>" >  <input  type="checkbox" class="checkbox<?php echo ($vo["id"]); ?>" name="rules[]"  id="chk<?php echo ($sub["id"]); ?>" onclick="YTauth_checkbox_sub($('#chk<?php echo ($sub["id"]); ?>'),<?php echo ($sub["id"]); ?>,$('#chk<?php echo ($vo["id"]); ?>'))" value="<?php echo ($sub["id"]); ?>" <?php if( strpos($reuslt['rules'],','.$sub['id'].',') > -1 ): ?>checked="true"<?php endif; ?> />&nbsp;<?php echo ($sub["title"]); ?> </label> 

																<?php if(is_array($sub['sub1'])): foreach($sub['sub1'] as $key=>$sub1): ?><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
																	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;┠─&nbsp;<label for="chk<?php echo ($sub1["id"]); ?>" >  <input  type="checkbox" class="checkbox<?php echo ($sub["id"]); ?>" name="rules[]"  id="chk<?php echo ($sub1["id"]); ?>"  onclick="YTauth_checkbox_sub1($('#chk<?php echo ($sub1["id"]); ?>'),$('#chk<?php echo ($sub["id"]); ?>'),$('#chk<?php echo ($vo["id"]); ?>'))" value="<?php echo ($sub1["id"]); ?>" <?php if( strpos($reuslt['rules'],','.$sub1['id'].',') > -1 ): ?>checked="true"<?php endif; ?>  />&nbsp;<?php echo ($sub1["title"]); ?> </label><?php endforeach; endif; ?>

														<br/><?php endforeach; endif; ?>
											</div><?php endforeach; endif; ?>
								</td><?php endif; ?>  						
				    </TR>
			 </tbody>		
		 </table>	
     <?php endif ?>	
            <!-- END PAGE CONTENT-->		 
		 
		 
		 
	 
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
	   YTaction='/yzzh/ytsoft.php?s=/Home/Setcompany/user_info';  
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