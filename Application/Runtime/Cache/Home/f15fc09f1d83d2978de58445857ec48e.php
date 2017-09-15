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
                     <a href="/yzzh/ytsoft.php?s=/Setgoods/goods_list">
                    商品设置</a>
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


  
		 
        <!-- BEGIN PAGE CONTENT-->
         <div class="row">
            <div class="col-md-12">

               <!-- END EXAMPLE TABLE PORTLET-->
               <div class="portlet box blue">
                  <div class="portlet-title">
                     <div class="caption">客户查询\修改\删除</div>
					 <div class="tools hidden-xs">
							<a href="javascript:;" class="collapse"></a>
					 </div>		
                     <div class="actions">					
						 <li class="btn-group">					
						    <button type="button" id="btn_exporttoexcel" class="btn  blue yt_marginright20 "  onClick=" YTtabletoexcel( $('#yt_table'),[0,1] ,3,'客户资料','')"  > 导出Excel </button>
						</li>			
                     </div>
                  </div>
                  <div class="portlet-body">				  				  
                     <div class="table-toolbar yt_margintop5 yt_marginbottom60 ">
						 <span class="col-md-12"  >												 
                              <div class="input-group  yt_float_right">
										   <select  class="form-control select2me yt_input-small140 "  id="search_key"  >	
											    <?php if(is_array($table_head)): $i = 0; $__LIST__ = $table_head;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(($vo["search"] == true )): ?><option value="<?php echo ($vo['key']); ?>">按<?php echo ($vo['value']); ?>搜索</option><?php endif; endforeach; endif; else: echo "" ;endif; ?>															
										   </select>										   										   
	                                <input type="text" class="form-control yt_input-small140 "  placeholder="请输入关键词" id="search_txt" value="<?php echo ($search_txt); ?>" onkeypress="YTsearch_customer1(event)" >							   									
									<button  class="btn  <?php echo ($btn_flag1); ?>  tooltips "  data-placement="bottom" data-original-title="按关键词模糊查询" onClick="YTsearch_customer()"  >
									   <i class=" icon-search"  ></i>
								    </button>										   

                                 <!-- /btn-group -->
                              </div>	
						 </span>		
						 <span class="col-md-12"  >
								   <div class="input-group yt_input-large380 input-daterange yt_float_left yt_margintop-10"  >
										<span class="input-group-addon">起始日期</span>
										<input type="text" class="form-control date-picker " name="from" readonly id="date_begin" value="<?php echo ($date_begin); ?>" >
										<span class=" btn input-group-addon dropdown-toggle  " data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">截至日期&nbsp;<i class="icon-angle-down"></i></span>
										<input type="text" class="form-control date-picker " name="to" readonly id="date_end" value="<?php echo ($date_end); ?>">
											 <ul class="dropdown-menu pull-right" role="menu">	
											        <li >&nbsp;&nbsp;</li>
											        <li >&nbsp;&nbsp;录入日期</li>
											        <li class="divider"></li>
													<li><a href="JavaScript:showDateBeginEnd(0);">当天</a></li>
													<li><a href="JavaScript:showDateBeginEnd(7);">最近7天</a></li>
													<li><a href="JavaScript:showDateBeginEnd(10);">最近10天</a></li>
													<li><a href="JavaScript:showDateBeginEnd(15);">最近15天</a></li>
													<li><a href="JavaScript:showDateBeginEnd(30);">最近30天</a></li>
													<li><a href="JavaScript:showDateBeginEnd(60);">最近60天</a></li>
													<li >&nbsp;&nbsp;</li>
											 </ul>		 
								   </div>	
                                   <button  class="btn <?php echo ($btn_flag2); ?>   yt_float_left  yt_margintop-10 "  onClick=" YTselect_timeinterval() "  > 查询 </button>

	                          <div class="input-group yt_float_right yt_margintop15 ">				  	
										   <select  class="form-control select2me yt_input-large320  "  data-placeholder="按客户组查询客户" id="searchcustomer_group" onchange="YTsearch_customergroup(this.options[this.selectedIndex].value)" >	
										            <option value=""></option>
													<option value="1"  >全部客户组(<?php echo ($totalcount); ?>/<?php echo ($totalcount); ?>)</option>
													<?php if(is_array($group_list)): $i = 0; $__LIST__ = $group_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['cat_id']); ?>" ><?php echo ($vo['cat_name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>					
										   </select>		
                                 <!-- /btn-group -->
                              </div>							  
						 </span>							 
                     </div>	

					 
				  
					 <?php if($customerlist==null) : ?>	
                             </br>	</br>	
							 
							 <div class="news-blocks yt_margintop15 ">
								<h4>无数据...</h4>
							 </div>	
					<?php else : ?>		  
                   <table class="table table-striped table-bordered table-hover table-full-width  row-border order-column   " id="yt_table"> 
                        <thead>
                           <tr>
                              <th>操作</th>
							  <?php if(is_array($table_head)): $i = 0; $__LIST__ = $table_head;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><th><?php echo ($vo['value']); ?></th><?php endforeach; endif; else: echo "" ;endif; ?>	
                           </tr>
                        </thead>					
                        <tbody>
						<?php if(is_array($customerlist)): $i = 0; $__LIST__ = $customerlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="">
						  <td>
											   <button  class="btn  purple btn-xs tooltips "  data-placement="bottom" data-original-title="客户详情" onClick="YTcustomer_info('<?php echo ($vo['guid']); ?>')"  >
											   <i class="icon-info-sign"  ></i>
											   </button>												   												   
											   <button id="yt_btn_edit" class="btn blue btn-xs  yt_marginleft5  "  onClick=" YTcustomer_edit('<?php echo ($vo['id']); ?>') " >
											   修改 <i class="icon-edit"></i>
											   </button>
											   <button id="yt_btn_del" class="btn red btn-xs  yt_marginleft5  "   onClick=" del_guid('<?php echo ($vo['id']); ?>','<?php echo ($vo['guid']); ?>') "  >
											   删除 <i class="icon-remove"></i>
											   </button>												   
											   

							   
						  </td>
							  <?php if(is_array($table_head)): $i = 0; $__LIST__ = $table_head;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?><td>		
										  <?php if(($vo1["key"] != "address" )): echo ($vo[$vo1['key']]); ?>	
										  <?php else: ?>	 
												<?php if(($vo["customer_marker_lng"] != "" )): ?><a class="tooltips" data-original-title="客户地图"  href= "JavaScript:YTcustomer_map('<?php echo ($vo['customer_marker_lat']); ?>','<?php echo ($vo['customer_marker_lng']); ?>','姓名：<?php echo ($vo['name']); ?>，电话：<?php echo ($vo['phone_number']); ?>，地址：<?php echo ($vo['address']); ?>') "><?php echo ($vo[$vo1['key']]); ?></a>	
											   <?php else: ?>	 
												   <?php echo ($vo[$vo1['key']]); endif; endif; ?>  									   			   																	 
								   </td><?php endforeach; endif; else: echo "" ;endif; ?>								 
						   </tr><?php endforeach; endif; else: echo "" ;endif; ?>	
						  
                        </tbody>
                     </table>
					  <?php endif ?>	
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
                  </div>
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
	   YTaction='/yzzh/ytsoft.php?s=/Home/Customer/customer_list';  
   </script>   

   
   
   
   
   



    
<script>
    jQuery(document).ready(function() {       			
			 App.initnocheckboxes();	

			if ( $("#date_begin").val() =='' ) { 
			  showDateBeginEnd($("#select_interval_days").val()*1);   
			}   else {
			   FormComponents.yt_handleDatePickers();	
			} ;			 

			$('#yt_left_menu_customer').addClass("active");  
			$('#yt_left_menu_customer_info').addClass("active");

			$('#yt_left_menu_custome_arrow .arrow ').remove();
			$('#yt_left_menu_custome_arrow ').append( '<span class="selected"></span> ');
			$('#yt_left_menu_custome_arrow ').append( '<span class="arrow open"></span>	');	 
			
			showSelect('#NumberOfRows','<?php echo (cookie('NumberOfRows')); ?>');				
			$('#searchcustomer_group').select2("val","<?php echo ($group_value); ?>");
			$('#search_key').select2("val","<?php echo ($search_key); ?>");	

			YTself=getYTself1() ; 
			YtUiScripts.initTable1();
      });
   	YTself='/yzzh/ytsoft.php?s=/Home/Customer/customer_list';  
	
	$('#search_txt').focus();      	
</script>

<script> 
  var YTsorter_number='<?php echo (cookie('customersorter_number')); ?>'; 
  var  YTsorter_ascordesc='<?php echo (cookie('customersorter_ascordesc')); ?>';  
  var YTtable_head_startnumber=<?php echo ($table_head_startnumber); ?>; 
  var YTtable_head_endnumber=<?php echo ($table_head_endnumber); ?>;  
		   
   function fnFormatDetails ( oTable, nTr )  
	{
	   var aData = oTable.fnGetData( nTr );
	   var sOut = ' <div class="note yt_note-info yt_marginbottom-1 "> <p> ';
		  <?php if(is_array($table_head)): $i = 0; $__LIST__ = $table_head;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(((($key+1)%3) == 0)): ?>sOut += ' <span class="yt_width250 ">  <?php echo ($vo["value"]); ?>：'+aData[<?php echo ($vo["number"]); ?>]+'</span> </p><p>' ;
				<?php else: ?>  sOut += ' <span class="yt_width250 ">  <?php echo ($vo["value"]); ?>：'+aData[<?php echo ($vo["number"]); ?>]+'</span>';<?php endif; endforeach; endif; else: echo "" ;endif; ?>				  
		  sOut += '</p></div> ';		
		  return sOut;
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
	<input id="url_url"  value="/yzzh/ytsoft.php?s=/Home/Customer"  type="hidden" />
	<input id="url_public"  value="/yzzh/Public"  type="hidden" />
	<input id="url_app"  value="/yzzh/ytsoft.php?s="  type="hidden" />
</div>
 
 
  
</body>
</html>