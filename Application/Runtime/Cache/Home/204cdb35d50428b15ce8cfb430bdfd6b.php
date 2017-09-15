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
		 
            <!-- BEGIN PAGE HEADER-->
            <div class="row">
               <div class="col-md-12">
                  <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                  <h3 class="page-title">
                     新客户销售订单 <small>录入新客户销售订单</small>
                  </h3>
                  <!-- END PAGE TITLE & BREADCRUMB-->
               </div>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
			
			
         <div class="row">
            <div class="col-md-12">
               <div class="portlet box blue" id="form_wizard_1">
                  <div class="portlet-title">
                     <div class="caption">
                        <i class="icon-reorder"></i>步骤  <span class="step-title">1/3</span>
                     </div>
                     <div class="tools hidden-xs">
                        <a href="javascript:;" class="collapse"></a>
                     </div>
                  </div>
                  <div class="portlet-body form">
                     <form action="#" class="form-horizontal" id="submit_form">
                        <div class="form-wizard">
                           <div class="form-body">
                              <ul class="nav nav-pills nav-justified steps" id="yt_tab_title">
                                 <li>
                                    <a href="#tab1" data-toggle="tab" class="step">
                                    <span class="number">1</span>
                                    <span class="desc"><i class="icon-ok"></i> 销售订单</span>   
                                    </a>
                                 </li>					 
                                   <li>
                                    <a href="#tab2" data-toggle="tab" class="step">
                                    <span class="number">2</span>
                                    <span class="desc"><i class="icon-ok"></i> 客户资料</span>   
                                    </a>
                                 </li>   	
                                 <li>
                                    <a href="#tab3" data-toggle="tab" class="step active">
                                    <span class="number">3</span>
                                    <span class="desc"><i class="icon-ok"></i> 确认</span>   
                                    </a>
                                 </li>
                              </ul>
                              <div id="bar" class="progress progress-striped" role="progressbar">
                                 <div class="progress-bar progress-bar-success"></div>
                              </div>
                              <div class="tab-content">
                                 <div class="alert alert-danger display-none">
                                    <button class="close" data-dismiss="alert"></button>
                                    有些输入项错误,请检查.
                                 </div>
                                 <div class="alert alert-success display-none">
                                    <button class="close" data-dismiss="alert"></button>
                                    输入成功!
                                 </div>
								 
								
                         <div class="tab-pane" id="tab1">						 
								<h4 class="form-section" id="yt_table_name" >销售商品明细</h4>									
									<div class="col-md-12">																
										  <table class="table table-striped table-bordered table-hover table-full-width  row-border order-column      " id="yt_table">  
											<thead >
											   <tr>
												  <th>商品名称</th>
												  <th class="yt_nodisplay" >名称id</th> 
												  <th>商品分类</th>
												  <th class="yt_nodisplay" >分类id</th>
												  <th>单位</th>
												  <th class="yt_text_right">数量</th>
												  <th class="yt_text_right">单价</th>
												  <th class="yt_text_right">金额</th>
												  <th>编号</th>	
												  <th>规格</th>	
												  <th>商品描述</th>	
												  <th class="yt_nodisplay" >定期维护</th>	
												  <th class="yt_nodisplay" >定期回访</th>	
												  <th class="yt_nodisplay" >质保截至</th>	
												  <th class="yt_nodisplay" >质保截至文字</th>	
												  <th class="yt_nodisplay" >商品属性</th>	
												  <th>操作</th>			
											   </tr>
											</thead>				
											<tbody>									  
											</tbody>
										 </table>
										<div class="col-md-12 " >
											  <div class="col-md-6 yt_text_center yt_margintop10  ">	
												<a class="btn blue" href="javascript:open_addgoods_dialog() ;">添加商品 <i class="icon-plus"></i>	</a> 
											  </div>	
											  <div class="col-md-6  yt_text_right   ">	
												 <h4 >		
														   <div class="yt_float_right"> 
															   <input id="salegoods_money" class="yt_input-small100" readonly   value="0"  name="yt_input_data"   />	  
														   </div>										 
														   <span  class="yt_float_right yt_margintop5" >数量合计：<span id="total_salequantity" >0</span>&nbsp;&nbsp;&nbsp;&nbsp;商品金额合计：</span>
											 
												 </h4>	 										 
											 </div>		
										</div> 										
										<div class="col-md-12 yt_margintop-10 " >
											  <div class="col-md-6 yt_text_center  ">	
											
											  </div>	
											  <div class="col-md-6  yt_text_right   ">	
												 <h4 >		
														   <div class="yt_float_right"> 
															  <input id="discount_money" class="yt_input-small100"    value="0"  name="yt_input_data"   />
														   </div>										 
														   <span  class="yt_float_right yt_margintop5" > <strong>－</strong>&nbsp;折扣金额：</span>
											 
												 </h4>	     
											 </div>		
										</div> 
										<div class="col-md-12  yt_margintop10" >
											  <div class="col-md-6 yt_text_center   ">	
											
											  </div>	
											  <div class="col-md-6  yt_text_right ">	
												 <h4 >		
														   <div class="yt_float_right"> 
															  <input id="sale_money" class="yt_input-small100"   readonly  value="0"     name="yt_input_data"   /> <!--销售记录的金额值--> 													  
														   </div>	
														   <span  class="yt_float_right yt_margintop5" > <strong>＝</strong>&nbsp;销售金额：</span>
											 
												 </h4>	 											 
											 </div>		
										</div> 												
										
										
										
										
									</div>			
								<div class="clearfix"> </div>								 
						 
								<h4 class="form-section">销售订单信息</h4>	
								<div class="col-md-6">	
								<div class="yt_form_group_left_70 ">		       									
                                     <div class="form-group"  >
                                       <label class="control-label col-md-3">销售单号</label>
                                       <div class="col-md-9">
                                          <input type="text" class="form-control" name="order_number"  placeholder="软件自动生成销售单号" />
                                          <span class="help-block"></span>
                                       </div>
                                    </div>								

                                    <div class="form-group">
                                       <label class="control-label col-md-3">销售日期<span class="required" >*</span></label>
                                       <div class="col-md-4">
											<div class="input-group date date-picker">
												<input type="text"  class="form-control" readonly required name="date_sale" id="date_sale" >
												<span class="input-group-btn">
												<button class="btn default" type="button"><i class="icon-calendar"></i></button>
												</span> 
											 </div>
                                       </div>	
                                       <div class="col-md-5">										                                             								   
                                       </div>									   
                                    </div>
									
                                    <div class="form-group">
                                       <label class="control-label col-md-3">交货日期<span class="required" >*</span></label>
                                       <div class="col-md-4">
											<div class="input-group  date date-picker">
												<input type="text"  class="form-control" readonly required name="date_delivery" id="date_delivery" >
												<span class="input-group-btn">
												<button class="btn default" type="button"><i class="icon-calendar"></i></button>
												</span> 
											 </div>
                                       </div>	
                                       <div class="col-md-5">										   
                                           <input type="text" id="time_delivery" class="form-control select2" data-placeholder="请选择..." name="time_delivery" >								   
                                       </div>									   
                                    </div>		
																				
                                    <div class="form-group yt_margintop5 ">
                                       <label class="control-label col-md-3">销售备注</label>
                                       <div class="col-md-9">
                                          <textarea class="form-control" rows="3" name="sales_memo" ></textarea>
                                          <span class="help-block"></span>
                                       </div>									   									   
								    </div>										
							
									
									</div>								 
									</div>	 

								<div class="col-md-6  ">
                                    <div class="form-group">
                                       <label class="control-label col-md-3">销售单位</label>
                                       <div class="col-md-9">										   
										   <select  class="form-control select2me"  data-placeholder="请选择..." name="sales_unit" >	
										            <option value=""></option>
													<?php if(is_array($salesunit_list)): $i = 0; $__LIST__ = $salesunit_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['name']); ?>" ><?php echo ($vo['name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>				
										   </select>											   
										   <span class="help-block">  </span>
                                       </div>
                                    </div>	
									


                                    <div class="form-group">
                                       <label class="control-label col-md-3">技术人员</label>
                                       <div class="col-md-9">										   
										   <select  class="form-control select2me" data-placeholder="请选择..." name="technician" >	
										            <option value=""></option>
													<?php if(is_array($technician_list)): $i = 0; $__LIST__ = $technician_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['name']); ?>" ><?php echo ($vo['name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>					
										   </select>											   
										   <span class="help-block">  </span>
                                       </div>
                                    </div>	


                                    <div class="form-group">
                                       <label class="control-label col-md-3">销售人员</label>
                                       <div class="col-md-9">										   
										   <select  class="form-control select2me"   data-placeholder="请选择..." name="salesman" >	
										            <option value=""></option>
													<?php if(is_array($salesman_list)): $i = 0; $__LIST__ = $salesman_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['name']); ?>" ><?php echo ($vo['name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>					
										   </select>											   
										   <span class="help-block">  </span>
                                       </div>
                                    </div>		

									
                                   <div class="form-group  <?php echo (session('sales_field1_style')); ?>  ">
                                       <label class="control-label col-md-3"><?php echo (session('sales_field1_text')); ?></label>
                                       <div class="col-md-9">
										   <select  class="form-control select2me" name="sales_field1" data-placeholder="请选择..." >
                                                    <option value=""></option>										   
													<?php if(is_array($customsalesfields1_list)): $i = 0; $__LIST__ = $customsalesfields1_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['name']); ?>" ><?php echo ($vo['name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>					
										   </select>
										   <span class="help-block"></span>
                                       </div>
                                    </div>		

                                     <div class="form-group  <?php echo (session('sales_field2_style')); ?> ">
                                       <label class="control-label col-md-3"><?php echo (session('sales_field2_text')); ?></label>
                                       <div class="col-md-9">
										   <select  class="form-control select2me" name="sales_field2" data-placeholder="请选择..." >	
										            <option value=""></option>
													<?php if(is_array($customsalesfields2_list)): $i = 0; $__LIST__ = $customsalesfields2_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['name']); ?>" ><?php echo ($vo['name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>					
										   </select>
										   <span class="help-block"></span>
                                       </div>
                                    </div>	
																		
                                     <div class="form-group   <?php echo (session('sales_field3_style')); ?>  ">
                                       <label class="control-label col-md-3"><?php echo (session('sales_field3_text')); ?></label>
                                       <div class="col-md-9">
										   <select  class="form-control select2me" name="sales_field3" data-placeholder="请选择..." >	
										            <option value=""></option>
													<?php if(is_array($customsalesfields3_list)): $i = 0; $__LIST__ = $customsalesfields3_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['name']); ?>" ><?php echo ($vo['name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>					
										   </select>
                                          <span class="help-block"></span>
                                       </div>
                                    </div>
									
                                     <div class="form-group  <?php echo (session('sales_field4_style')); ?> ">
                                       <label class="control-label col-md-3"><?php echo (session('sales_field4_text')); ?></label>
                                       <div class="col-md-9">
                                           <select  class="form-control select2me" name="sales_field4" data-placeholder="请选择..." >	
										            <option value=""></option>
													<?php if(is_array($customsalesfields4_list)): $i = 0; $__LIST__ = $customsalesfields4_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['name']); ?>" ><?php echo ($vo['name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>					
										   </select>
                                          <span class="help-block"></span>
                                       </div>
                                    </div>									
									
                                    <div class="form-group  <?php echo (session('sales_field5_style')); ?> "  >
                                       <label class="control-label col-md-3"><?php echo (session('sales_field5_text')); ?></label>
                                       <div class="col-md-9">
                                          <input type="text" class="form-control" name="sales_field5"/>
                                          <span class="help-block"></span>
                                       </div>
								    </div>	

                                    <div class="form-group <?php echo (session('sales_field6_style')); ?>"  >
                                       <label class="control-label col-md-3"><?php echo (session('sales_field6_text')); ?></label>
                                       <div class="col-md-9">
                                          <input type="text" class="form-control" name="sales_field6"/>
                                          <span class="help-block"></span>
                                       </div>
								    </div>
									
                                    <div class="form-group  <?php echo (session('sales_field7_style')); ?> "  >
                                       <label class="control-label col-md-3"><?php echo (session('sales_field7_text')); ?></label>
                                       <div class="col-md-9">
                                          <input type="text" class="form-control" name="sales_field7"/>
                                          <span class="help-block"></span>
                                       </div>
								    </div>	

                                    <div class="form-group <?php echo (session('sales_field8_style')); ?>"  >
                                       <label class="control-label col-md-3"><?php echo (session('sales_field8_text')); ?></label>
                                       <div class="col-md-9">
                                          <input type="text" class="form-control" name="sales_field8"/>
                                          <span class="help-block"></span>
                                       </div>
								    </div>	
                                    <div class="form-group  <?php echo (session('sales_field9_style')); ?> "  >
                                       <label class="control-label col-md-3"><?php echo (session('sales_field9_text')); ?></label>
                                       <div class="col-md-9">
                                          <input type="text" class="form-control" name="sales_field9"/>
                                          <span class="help-block"></span>
                                       </div>
								    </div>	

                                    <div class="form-group <?php echo (session('sales_field10_style')); ?>"  >
                                       <label class="control-label col-md-3"><?php echo (session('sales_field10_text')); ?></label>
                                       <div class="col-md-9">
                                          <input type="text" class="form-control" name="sales_field10"/>
                                          <span class="help-block"></span>
                                       </div>
								    </div>	
											
	
									
									</div>	  


									<div class="clearfix"> </div>
                                 </div>
								 
                        <div class="tab-pane active" id="tab2">								 
								  <h4 class="form-section">客户资料</h4>	
								<div class="col-md-6">	
								<div class="yt_form_group_left_70 ">		  
                                    <div class="form-group">
                                       <label class="control-label col-md-3">姓名<span class="required" >*</span></label>
                                       <div class="col-md-9">
                                          <input type="text" class="form-control  " name="name" required  />
                                          <span class="help-block"></span>
                                       </div>
                                    </div>
																																	
                                    <div class="form-group">
                                       <label class="control-label col-md-3">性别<span class="required">*</span></label>
                                       <div class="col-md-9">
                                          <div class="radio-list"  >
										     <label   class="radio-inline" >
                                                  <input type="radio" name="gender" value="男" data-title="男" checked /> 男
											 </label>
											 <label  class="radio-inline" >
                                                  <input type="radio" name="gender" value="女" data-title="女" /> 女
                                             </label>
										  </div>
                                          <div id="form_gender_error"></div>
                                       </div>
                                    </div>
							
                                    <div class="form-group">
                                       <label class="control-label col-md-3">电话<span class="required" >*</span></label>
                                       <div class="col-md-9">
                                          <input type="text" class="form-control  required " name="phone_number"  >
                                            <span class="help-block">区号和号码之间不要加分隔符，比如是010123456，不能是010-123456 																	
											</span>
                                       </div>
                                    </div>
									
                                    <div class="form-group">
                                       <label class="control-label col-md-3">地址<span class="required" >*</span></label>
                                       <div class="col-md-9">
                                          <input type="text" class="form-control" name="address" id="address" required />
                                          <span class="help-block"></span>
                                       </div>
                                    </div>	
									
                                    <div class="form-group">
                                       <label class="control-label col-md-3">注册日期<span class="required" >*</span></label>
                                       <div class="col-md-9">
											<div class="input-group input-medium date date-picker">
												<input type="text"  class="form-control" readonly required id="date_registration" name="date_registration" >
												<span class="input-group-btn">
												<button class="btn default" type="button"><i class="icon-calendar"></i></button>
												</span> 
											 </div>
                                       </div>									  
                                    </div>
									
                                    <div class="form-group">
                                       <label class="control-label col-md-3">客户组<span class="required" >*</span></label>
                                       <div class="col-md-9">
										   <select  class="form-control select2me" required  data-placeholder="请选择..." name="cat_id" >	
										            <option value=""></option>
													<?php if(is_array($group_list)): $i = 0; $__LIST__ = $group_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['cat_id']); ?>" ><?php echo ($vo['cat_name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>					
										   </select>
		
										   <span class="help-block"></span>
                                       </div>
                                    </div>			
									
                                   <div class="form-group  <?php echo (session('custom_field1_style')); ?> ">
                                       <label class="control-label col-md-3"><?php echo (session('custom_field1_text')); ?></label>
                                       <div class="col-md-9">
										   <select  class="form-control select2me" name="custom_field1" data-placeholder="请选择..." >
                                                    <option value=""></option>										   
													<?php if(is_array($custom_field1_list)): $i = 0; $__LIST__ = $custom_field1_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['name']); ?>" ><?php echo ($vo['name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>					
										   </select>
										   <span class="help-block"></span>
                                       </div>
                                    </div>		

                                     <div class="form-group  <?php echo (session('custom_field2_style')); ?> ">
                                       <label class="control-label col-md-3"><?php echo (session('custom_field2_text')); ?></label>
                                       <div class="col-md-9">
										   <select  class="form-control select2me" name="custom_field2" data-placeholder="请选择..." >	
										            <option value=""></option>
													<?php if(is_array($custom_field2_list)): $i = 0; $__LIST__ = $custom_field2_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['name']); ?>" ><?php echo ($vo['name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>					
										   </select>
										   <span class="help-block"></span>
                                       </div>
                                    </div>	
																		
                                     <div class="form-group  <?php echo (session('custom_field3_style')); ?>  ">
                                       <label class="control-label col-md-3"><?php echo (session('custom_field3_text')); ?></label>
                                       <div class="col-md-9">
										   <select  class="form-control select2me" name="custom_field3" data-placeholder="请选择..." >	
										            <option value=""></option>
													<?php if(is_array($custom_field3_list)): $i = 0; $__LIST__ = $custom_field3_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['name']); ?>" ><?php echo ($vo['name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>					
										   </select>
                                          <span class="help-block"></span>
                                       </div>
                                    </div>
									
                                     <div class="form-group  <?php echo (session('custom_field4_style')); ?> ">
                                       <label class="control-label col-md-3"><?php echo (session('custom_field4_text')); ?></label>
                                       <div class="col-md-9">
										   <select  class="form-control select2me" name="custom_field4" data-placeholder="请选择..." >	
										            <option value=""></option>
													<?php if(is_array($custom_field4_list)): $i = 0; $__LIST__ = $custom_field4_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['name']); ?>" ><?php echo ($vo['name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>					
										   </select>
                                          <span class="help-block"></span>
                                       </div>
                                    </div>									
									
                                    <div class="form-group  <?php echo (session('custom_field5_style')); ?>  ">
                                       <label class="control-label col-md-3"><?php echo (session('custom_field5_text')); ?></label>
                                       <div class="col-md-9">
                                          <input type="text" class="form-control" name="custom_field5"/>
                                          <span class="help-block"></span>
                                       </div>
								    </div>	

                                    <div class="form-group  <?php echo (session('custom_field6_style')); ?>  ">
                                       <label class="control-label col-md-3"><?php echo (session('custom_field6_text')); ?></label>
                                       <div class="col-md-9">
                                          <input type="text" class="form-control" name="custom_field6"/>
                                          <span class="help-block"></span>
                                       </div>
								    </div>
                                     <div class="form-group  <?php echo (session('custom_field7_style')); ?>  ">
                                       <label class="control-label col-md-3"><?php echo (session('custom_field7_text')); ?></label>
                                       <div class="col-md-9">
                                          <input type="text" class="form-control" name="custom_field7"  />
                                          <span class="help-block"></span>
                                       </div>
                                    </div>
									
                                     <div class="form-group  <?php echo (session('custom_field8_style')); ?> ">
                                       <label class="control-label col-md-3"><?php echo (session('custom_field8_text')); ?></label>
                                       <div class="col-md-9">
                                          <input type="text" class="form-control" name="custom_field8"  />
                                          <span class="help-block"></span>
                                       </div>
                                    </div>									
									
                                    <div class="form-group  <?php echo (session('custom_field9_style')); ?>  ">
                                       <label class="control-label col-md-3"><?php echo (session('custom_field9_text')); ?></label>
                                       <div class="col-md-9">
                                          <input type="text" class="form-control" name="custom_field9"/>
                                          <span class="help-block"></span>
                                       </div>
								    </div>	

                                    <div class="form-group  <?php echo (session('custom_field10_style')); ?>  ">
                                       <label class="control-label col-md-3"><?php echo (session('custom_field10_text')); ?></label>
                                       <div class="col-md-9">
                                          <input type="text" class="form-control" name="custom_field10"/>
                                          <span class="help-block"></span>
                                       </div>
								    </div>		
									
                                    <div class="form-group">
                                       <label class="control-label col-md-3">备注</label>
                                       <div class="col-md-9">
                                          <textarea class="form-control" rows="3" name="customer_memo" ></textarea>
                                          <span class="help-block"></span>
                                       </div>
								    </div>									
									

									
								</div>								 
								</div>	 

								<div class="col-md-6  ">
												<div id="map" style="width:auto; height:650px"></div>  <!--开始地图应用部分 552-->	
												<label class="control-label col-md-11">注：鼠标右键在地图上标注客户的位置，可实现图形化管理客户和订单</label>   

												<div>
														<input id="customer_marker_lng" name="customer_marker_lng"   type="text" style="display:none;"/>
														<input id="customer_marker_lat" name="customer_marker_lat"  type="text"  style="display:none;"/>
																											
												</div>	  
								</div>	

								<div class="clearfix"> </div>
 					 
                                 </div>	 
				 								 
								 

                           <div class="tab-pane" id="tab3">
                                <h4 class="form-section">客户资料</h4>

									
								<div class="col-md-12">											
								<div class="col-md-6">							
                                    <div class="form-group">
                                       <label class="control-label col-md-3">姓名：</label>
                                       <div class="col-md-9">
										  <p class="form-control-static" data-display="name"></p>
                                       </div>
                                    </div>		
									
                                    <div class="form-group">
                                       <label class="control-label col-md-3">性别：</label>
                                       <div class="col-md-9">
									       <p class="form-control-static" data-display="gender"></p>
                                       </div>
                                    </div>										
                                    <div class="form-group">
                                       <label class="control-label col-md-3">电话：</label>
                                       <div class="col-md-9">
									      <p class="form-control-static" data-display="phone_number"></p>
                                       </div>
                                    </div>	
                                    <div class="form-group">
                                       <label class="control-label col-md-3">地址：</label>
                                       <div class="col-md-9">
									       <p class="form-control-static" data-display="address"></p>
                                       </div>
                                    </div>										
                                    <div class="form-group">
                                       <label class="control-label col-md-3">注册日期：</label>
                                       <div class="col-md-9">
									         <p class="form-control-static" data-display="date_registration"></p>
                                       </div>									  
                                    </div>									
                                    <div class="form-group">
                                       <label class="control-label col-md-3">客户组：</label>
                                       <div class="col-md-9">
									        <p class="form-control-static" data-display="cat_id"></p>
                                       </div>
                                    </div>	
                                    <div class="form-group">
                                       <label class="control-label col-md-3">备注：</label>
                                       <div class="col-md-9">
									    <p class="form-control-static" data-display="customer_memo"></p>
                                       </div>
								    </div>											
								</div>	 

								<div class="col-md-6  "> 
								    <div class="form-group">
                                       <label class="control-label col-md-3">地图标注经度：</label>
                                       <div class="col-md-9">
									    <p class="form-control-static" data-display="customer_marker_lng"></p>
                                       </div>
								    </div>	

								    <div class="form-group">
                                       <label class="control-label col-md-3">地图标注维度：</label>
                                       <div class="col-md-9">
									    <p class="form-control-static" data-display="customer_marker_lat"></p>
                                       </div>
								    </div>	
                                    <div class="form-group  <?php echo (session('custom_field1_style')); ?> ">
                                       <label class="control-label col-md-3"><?php echo (session('custom_field1_text')); ?>：</label>
                                       <div class="col-md-9">
									        <p class="form-control-static" data-display="custom_field1"></p>
                                       </div>
                                    </div>		
                                     <div class="form-group  <?php echo (session('custom_field2_style')); ?> ">
                                       <label class="control-label col-md-3"><?php echo (session('custom_field2_text')); ?>：</label>
                                       <div class="col-md-9">
									        <p class="form-control-static" data-display="custom_field2"></p>
                                       </div>
                                    </div>																			
                                     <div class="form-group <?php echo (session('custom_field3_style')); ?> " >
                                       <label class="control-label col-md-3"><?php echo (session('custom_field3_text')); ?>：</label>
                                       <div class="col-md-9">
									      <p class="form-control-static" data-display="custom_field3"></p>
                                       </div>
                                    </div>									
                                     <div class="form-group  <?php echo (session('custom_field4_style')); ?> ">
                                       <label class="control-label col-md-3"><?php echo (session('custom_field4_text')); ?>：</label>
                                       <div class="col-md-9">
									       <p class="form-control-static" data-display="custom_field4"></p>
                                       </div>
                                     </div>																		
                                    <div class="form-group  <?php echo (session('custom_field5_style')); ?> ">
                                       <label class="control-label col-md-3"><?php echo (session('custom_field5_text')); ?>：</label>
                                       <div class="col-md-9">
									    <p class="form-control-static" data-display="custom_field5"></p>
                                       </div>
								    </div>	
                                    <div class="form-group  <?php echo (session('custom_field6_style')); ?> ">
                                       <label class="control-label col-md-3"><?php echo (session('custom_field6_text')); ?>：</label>
                                       <div class="col-md-9">
									    <p class="form-control-static" data-display="custom_field6"></p>
                                       </div>
								    </div>	
                                     <div class="form-group <?php echo (session('custom_field7_style')); ?> " >
                                       <label class="control-label col-md-3"><?php echo (session('custom_field7_text')); ?>：</label>
                                       <div class="col-md-9">
									      <p class="form-control-static" data-display="custom_field7"></p>
                                       </div>
                                    </div>									
                                     <div class="form-group  <?php echo (session('custom_field8_style')); ?> ">
                                       <label class="control-label col-md-3"><?php echo (session('custom_field8_text')); ?>：</label>
                                       <div class="col-md-9">
									       <p class="form-control-static" data-display="custom_field8"></p>
                                       </div>
                                     </div>																		
                                    <div class="form-group  <?php echo (session('custom_field9_style')); ?> ">
                                       <label class="control-label col-md-3"><?php echo (session('custom_field9_text')); ?>：</label>
                                       <div class="col-md-9">
									    <p class="form-control-static" data-display="custom_field9"></p>
                                       </div>
								    </div>	
                                    <div class="form-group  <?php echo (session('custom_field10_style')); ?> ">
                                       <label class="control-label col-md-3"><?php echo (session('custom_field10_text')); ?>：</label>
                                       <div class="col-md-9">
									    <p class="form-control-static" data-display="custom_field10"></p>
                                       </div>
								    </div>										

								</div>										
							</div>			
								<div class="clearfix"> </div>	
								
								<h4 class="form-section" id="yt_table_name" >销售商品明细</h4>									
									<div class="col-md-12">																
										  <table class="table table-striped table-bordered table-hover table-full-width  row-border order-column      " id="yt_table_bak">  
											<thead >
											   <tr>
												  <th>商品名称</th>
												  <th class="yt_nodisplay" >名称id</th> 
												  <th>商品分类</th>
												  <th class="yt_nodisplay" >分类id</th>
												  <th>单位</th>
												  <th class="yt_text_right">数量</th>
												  <th class="yt_text_right">单价</th>
												  <th class="yt_text_right">金额</th>
												  <th>编号</th>	
												  <th>规格</th>													  
												  <th>商品描述</th>	
											   </tr>
											</thead>				
											<tbody>									  
											</tbody>
										 </table>

										  <div class="col-md-12 " >
												  <div class="col-md-6 yt_text_center yt_margintop10  ">	
												  
												  </div>	
												  <div class="col-md-6  yt_text_right   ">	
													 <h4 >		
															   <div class="yt_float_right"> 
																  <input id="total_salemoney_bak" class="yt_input-small100"   readonly  value="0"    /> 
															   </div>										 
															   <span  class="yt_float_right yt_margintop5" >数量合计：<span id="total_salequantity_bak" >0</span>&nbsp;&nbsp;&nbsp;&nbsp;商品金额合计：</span>
												 
													 </h4>	 										 
												 </div>		
											</div> 										
											<div class="col-md-12 yt_margintop-10 " >
												  <div class="col-md-6 yt_text_center  ">	
												
												  </div>	
												  <div class="col-md-6  yt_text_right   ">	
													 <h4 >		
															   <div class="yt_float_right"> 
																  <input id="discount_money_bak" class="yt_input-small100" readonly   value="0"     /> 
															   </div>										 
															   <span  class="yt_float_right yt_margintop5" > <strong>－</strong>&nbsp;折扣金额：</span>
												 
													 </h4>	     
												 </div>		
											</div> 
											<div class="col-md-12 yt_margintop10" >
												  <div class="col-md-6 yt_text_center   ">	
												
												  </div>	
												  <div class="col-md-6  yt_text_right  ">	
													 <h4 >		
															   <div class="yt_float_right"> 
																  <input id="total_salemoney1_bak" class="yt_input-small100"   readonly  value="0"    /> <!--折扣金额 yt_input-small70--> 	
															   </div>	
															   <span  class="yt_float_right yt_margintop5" > <strong>＝</strong>&nbsp;销售金额：</span>
												 
													 </h4>	 											 
												 </div>		
											</div> 											
																				
										
										
										
										
										
										
										
										
										
										
										
										
										
										
										
										
										
										
										
									</div>			
								<div class="clearfix"> </div>										
								
								
								
								<h4 class="form-section">销售订单信息</h4>
								<div class="col-md-12">											
								<div class="col-md-6">																
                                   <div class="form-group"  >
                                       <label class="control-label col-md-3">销售单号：</label>
                                       <div class="col-md-9">
										  <p class="form-control-static" data-display="order_number"></p>									   
                                       </div>
                                    </div>		
																																
                                    <div class="form-group">
                                       <label class="control-label col-md-3">销售日期：</label>
                                       <div class="col-md-9">
										  <p class="form-control-static" data-display="date_sale"></p>									   
                                       </div>									  
                                    </div> 
									
                                    <div class="form-group">
                                       <label class="control-label col-md-3">交货日期：</label>
                                       <div class="col-md-3">
										  <p class="form-control-static" data-display="date_delivery"></p>									   
                                       </div>	
                                       <div class="col-md-6">
										  <p class="form-control-static" data-display="time_delivery"></p>									   
                                       </div>									   
                                    </div> 
									
                                    <div class="form-group">
                                       <label class="control-label col-md-3">销售备注：</label>
                                       <div class="col-md-9">
									    <p class="form-control-static" data-display="sales_memo"></p>									   
                                       </div>									   									   
								    </div>											
							
								</div>	 

								<div class="col-md-6  "> 
                                    <div class="form-group">
                                       <label class="control-label col-md-3">销售单位：</label>
                                       <div class="col-md-9">	
									    <p class="form-control-static" data-display="sales_unit"></p>									   
                                       </div>
                                    </div>										

                                    <div class="form-group">
                                       <label class="control-label col-md-3">技术负责：</label>
                                       <div class="col-md-9">	
									    <p class="form-control-static" data-display="technician"></p>									   
                                       </div>
                                    </div>	
                                    <div class="form-group">
                                       <label class="control-label col-md-3">销售负责：</label>
                                       <div class="col-md-9">										   
									    <p class="form-control-static" data-display="salesman"></p>									   
                                       </div>
                                    </div>											
                                    <div class="form-group  <?php echo (session('sales_field1_style')); ?> ">
                                       <label class="control-label col-md-3"><?php echo (session('sales_field1_text')); ?>：</label>
                                       <div class="col-md-9">
									    <p class="form-control-static" data-display="sales_field1"></p>									   
                                       </div>
                                    </div>		
                                     <div class="form-group  <?php echo (session('sales_field2_style')); ?> ">
                                       <label class="control-label col-md-3"><?php echo (session('sales_field2_text')); ?>：</label>
                                       <div class="col-md-9">
									    <p class="form-control-static" data-display="sales_field2"></p>									   
                                       </div>
                                    </div>																			
                                     <div class="form-group  <?php echo (session('sales_field3_style')); ?> ">
                                       <label class="control-label col-md-3"><?php echo (session('sales_field3_text')); ?>：</label>
                                       <div class="col-md-9">
									    <p class="form-control-static" data-display="sales_field3"></p>									   
                                       </div>
                                    </div>									
                                     <div class="form-group  <?php echo (session('sales_field4_style')); ?> ">
                                       <label class="control-label col-md-3"><?php echo (session('sales_field4_text')); ?>：</label>
                                       <div class="col-md-9">
									    <p class="form-control-static" data-display="sales_field4"></p>									   
                                       </div>
									   </div>																		
                                    <div class="form-group <?php echo (session('sales_field5_style')); ?> " >
                                       <label class="control-label col-md-3"><?php echo (session('sales_field5_text')); ?>：</label>
                                       <div class="col-md-9">
										 <p class="form-control-static" data-display="sales_field5"></p>
                                       </div>
								    </div>	
                                    <div class="form-group  <?php echo (session('sales_field6_style')); ?> " >
                                       <label class="control-label col-md-3"><?php echo (session('sales_field6_text')); ?>：</label>
                                       <div class="col-md-9">
									    <p class="form-control-static" data-display="sales_field6"></p>									   
                                       </div>
									   </div>	
                                     <div class="form-group  <?php echo (session('sales_field7_style')); ?> ">
                                       <label class="control-label col-md-3"><?php echo (session('sales_field7_text')); ?>：</label>
                                       <div class="col-md-9">
									    <p class="form-control-static" data-display="sales_field7"></p>									   
                                       </div>
                                    </div>									
                                     <div class="form-group  <?php echo (session('sales_field8_style')); ?> ">
                                       <label class="control-label col-md-3"><?php echo (session('sales_field8_text')); ?>：</label>
                                       <div class="col-md-9">
									    <p class="form-control-static" data-display="sales_field8"></p>									   
                                       </div>
									   </div>																		
                                    <div class="form-group <?php echo (session('sales_field9_style')); ?> " >
                                       <label class="control-label col-md-3"><?php echo (session('sales_field9_text')); ?>：</label>
                                       <div class="col-md-9">
										 <p class="form-control-static" data-display="sales_field9"></p>
                                       </div>
								    </div>	
                                    <div class="form-group  <?php echo (session('sales_field10_style')); ?> " >
                                       <label class="control-label col-md-3"><?php echo (session('sales_field10_text')); ?>：</label>
                                       <div class="col-md-9">
									    <p class="form-control-static" data-display="sales_field10"></p>									   
                                       </div>
									   </div>													
								</div>	 									
							</div>	
                                <div class="clearfix"> </div>
																	
									
                                 </div>
                              </div>
                           </div>
                           <div class="form-actions fluid">
                              <div class="row">
                                 <div class="col-md-12">
                                    <div class="col-md-offset-3 col-md-9">
                                       <a href="javascript:;" class="btn default button-previous">
                                       <i class="m-icon-swapleft"></i> 上一步 
                                       </a>
                                       <a href="javascript:;" class="btn blue button-next">
                                       下一步 <i class="m-icon-swapright m-icon-white"></i>
                                       </a>
                                       <a href="javascript:;" class="btn green button-submit">
                                       确认提交 <i class="m-icon-swapright m-icon-white"></i>
                                       </a>                            
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>			
			
			
		 <!-- BEGIN DIALOG_FORM  -->
		 <div id="yt_dialog_form" class="modal fade" tabindex="-1" aria-hidden="true" data-width="550" >
				  <div class="modal-header" id="yt_modal-header" >
					 <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					 <h4 class="modal-title" id="yt_dialog_title">添加</h4>
				  </div>
				  <div class="modal-body " >
						<form class="form-horizontal" role="form">
                                    <div class="form-group">
                                       <label for="goods_type"  class="control-label col-md-3">商品分类<span class="required" >*</span></label>
                                       <div class="col-md-8">
										   <select  class="form-control select2me" required  data-placeholder="请选择商品分类（大类）..."  id="goods_type"  name="order_goods_type">	
										            <option value=""></option>
													<?php if(is_array($goodstype_list)): $i = 0; $__LIST__ = $goodstype_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['cat_id']); ?>" ><?php echo ($vo['cat_name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>					
										   </select>									   
										   <span class="help-block">  </span>
                                       </div>
                                    </div>	

                                    <div class="form-group">
                                       <label for="goods_name" class="control-label col-md-3">商品名称<span class="required" >*</span></label>
                                       <div class="col-md-8">										   
										   <select  class="form-control select2me" required  data-placeholder="请选择商品名称（明细）..."  id="goods_name" name="order_goods_name"  onchange="find_goods_memo(this.value)" >	
										            <option value=""></option>			
										   </select>											   
										   <span class="help-block">  </span>
                                       </div>
                                    </div>	
									
								  <div class="form-group">
									<label  class="col-sm-3 control-label">单位<span class="required" >*</span></label>
									<div class="col-sm-4 " >
									  <input type="text" class="form-control  " id="goods_unit" readonly="readonly"   >
									</div>
								  </div>									
						  
								 
								  <div class="form-group">
									<label for="goods_quantity" class="col-sm-3 control-label">数量<span class="required" >*</span></label>
									<div class="col-sm-4 " >
									  <input type="text" class="form-control  " id="goods_quantity" name="inputdatabox" value="0" placeholder="必须是有效的数字" >
									</div>
								  </div>
								  
								  <div class="form-group">
									<label for="goods_unitprice" class="col-sm-3 control-label">单价<span class="required" >*</span></label>
									<div class="col-sm-4 " >
									  <input type="text" class="form-control  " id="goods_unitprice" name="inputdatabox" value="0" placeholder="必须是有效的数字" >
									</div>
								  </div>

								  <div class="form-group">
									<label for="goods_money" class="col-sm-3 control-label">金额<span class="required" >*</span></label>
									<div class="col-sm-4 " >
									  <input type="text" class="form-control  " id="goods_money" name="inputdatabox" value="0" placeholder="必须是有效的数字" >
									</div>
								  </div>						  

								  
								<div class="form-group">
								   <label for="goods_memo" class="control-label col-md-3">商品描述</label>
								   <div class="col-md-8">
									  <textarea class="form-control" rows="3" name="goods_memo" id="goods_memo" ></textarea>
									  <span class="help-block"></span>
								   </div>									   									   
								</div>	
						</form>								
				  </div>
				  <div class="modal-footer">
					 <button type="button" data-dismiss="modal" class="btn default" id="yt_dialog_btn_cancel">取消</button>
					 <button type="button" class="btn green"  onClick="btn_submit_addgoods()" >确认</button>  
				  </div>
		 </div>

		<input id="sales_json"  type="hidden"   name="yt_input_data"  /> <!--销售明细记录的json值  sales_json --> 
		<input id="sale_quantity" type="hidden"   name="yt_input_data"  /> <!--销售记录的数量值--> 
		<input id="goods_number"  type="hidden"     />
		<input id="goods_specs"  type="hidden"     /> 
		<input id="regular_maintenance"  type="hidden"     />
		<input id="regular_visits"  type="hidden"     /> 
		<input id="warranty_period"  type="hidden"   /> 
		<input id="warranty_period_txt"  type="hidden"    />
		<input id="property"  type="hidden"    />	

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
	   YTaction='/yzzh/ytsoft.php?s=/Home/Customer/customer_sale';  
   </script>   

   
   
   
   
   



  
<input id="url_public"  value="/yzzh/Public"  type="hidden" />	 
<input id="city_lng"  value="<?php echo (session('city_lng')); ?>"  type="hidden" />
<input id="city_lat"  value="<?php echo (session('city_lat')); ?>"  type="hidden" />
<input id="city_zoomLevel"  value="<?php echo (session('city_zoomLevel')); ?>"  type="hidden" />
<script charset="utf-8" src="http://map.qq.com/api/js?v=1"></script> 
<script src="/yzzh/Public/Minify/index.php?g=web_mapjs" type="text/javascript"></script>  


  
   <script>
    jQuery(document).ready(function() {    
         App.init();		 
		 FormWizard.init();  
		 UIExtendedModals.init();  
		 map_init(); 
		 FormComponents.init();	  
      });
	  
	$('#form_wizard_1 .button-submit').click(function () { 
	    var url=$("#url_url").val()+'/'+'ajaxinsert2';
		yt_ajaxsubmit(url,0,0) ;
	}).hide();	
	

     $("#date_registration").val(new Date().Format("yyyy-MM-dd")); 
	 $("#date_sale").val(new Date().Format("yyyy-MM-dd"));

	   $("#time_delivery").select2({
            tags: [ 
					<?php if(is_array($timedelivery_list)): $i = 0; $__LIST__ = $timedelivery_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>"<?php echo ($vo['name']); ?>"	 ,<?php endforeach; endif; else: echo "" ;endif; ?>					
			      ]		
        });		 

   </script>
   
  <script src="/yzzh/Public/Minify/index.php?g=web_customer_sale_js" type="text/javascript"></script>  

  
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