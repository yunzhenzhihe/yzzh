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
                  <h3 class="page-title">
                     新客户投诉记录 <small>录入新客户投诉记录</small>
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
                                    <span class="desc"><i class="icon-ok"></i> 投诉记录</span>   
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
								 
								 
                        <div class="tab-pane  active" id="tab1">
							  <h3 class="form-section">投诉记录</h3>	
								<div class="col-md-6">	
								<div class="yt_form_group_left_70 ">		       									
                                     <div class="form-group"  >
                                       <label class="control-label col-md-3">单号</label>
                                       <div class="col-md-9">
                                          <input type="text" class="form-control" name="order_number"  placeholder="软件自动生成单号" />
                                          <span class="help-block"></span>
                                       </div>
                                    </div>		
									
                                    <div class="form-group">
                                       <label class="control-label col-md-3">投诉类型<span class="required" >*</span></label>
                                       <div class="col-md-9">										   
										   <select  class="form-control  select2me" required  data-placeholder="请选择..." id="complain_type" name="complain_type" >	
										            <option value=""></option>
													<?php if(is_array($type_list)): $i = 0; $__LIST__ = $type_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['name']); ?>" ><?php echo ($vo['name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>					
										   </select>											   
										   <span class="help-block">  </span>
                                       </div>
                                    </div>		
	
                                    <div class="form-group">
                                       <label class="control-label col-md-3">投诉日期<span class="required" >*</span></label>
                                       <div class="col-md-9">
											<div class="input-group input-medium date form_advance_datetime">
												<input type="text"  class="form-control" readonly required name="complain_date" id="complain_date" >
												<span class="input-group-btn">
												<button class="btn default date-set" type="button"><i class="icon-calendar"></i></button>
												</span> 
											 </div>
											 <span class="help-block">客户打电话或者通过其它途径投诉的的日期</span>
                                       </div>									  
                                    </div>
									</div>								 
									</div>	 

									<div class="col-md-6  ">
									
                                    <div class="form-group">
                                       <label class="control-label col-md-3">投诉内容<span class="required" >*</span></label>
                                       <div class="col-md-9">
                                          <textarea class="form-control" rows="7" name="complain_memo" required id="complain_memo" ></textarea>
                                          <span class="help-block"></span>
                                       </div>
									   									   
								    </div>	

									</div>	  

									<div class="clearfix"> </div>
                                 </div>
								 
                        <div class="tab-pane" id="tab2">								 
								  <h3 class="form-section">客户资料</h3>	
								<div class="col-md-6">	
								<div class="yt_form_group_left_70 ">		  
                                    <div class="form-group">
                                       <label class="control-label col-md-3">姓名<span class="required" >*</span></label>
                                       <div class="col-md-9">
                                          <input type="text" class="form-control  " name="name" required   />
                                          <span class="help-block"></span>
                                       </div>
                                    </div>
																																	
                                    <div class="form-group">
                                       <label class="control-label col-md-3">性别<span class="required">*</span></label>
                                       <div class="col-md-9">
                                          <div class="radio-list"  >
										     <label   class="radio-inline" >
                                                  <input type="radio" name="gender" value="男" data-title="男"  checked  /> 男
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
                                          <input type="text" class="form-control" name="address" id="address" required  />
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
								 <h3 class="form-section">确认</h3>	
                                 <!--   <h3 class="block">确认</h3>   -->
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
								<h4 class="form-section">投诉记录</h4>
								<div class="col-md-12">											
								<div class="col-md-6">																
                                   <div class="form-group"  >
                                       <label class="control-label col-md-3">单号：</label>
                                       <div class="col-md-9">
										  <p class="form-control-static" data-display="order_number"></p>									   
                                       </div>
                                    </div>		

                                    <div class="form-group">
                                       <label class="control-label col-md-3">投诉类型：</label>
                                       <div class="col-md-9">
										  <p class="form-control-static" data-display="complain_type"></p>									   
                                       </div>
                                    </div>	
								
									
                                    <div class="form-group">
                                       <label class="control-label col-md-3">投诉日期：</label>
                                       <div class="col-md-9">
										  <p class="form-control-static" data-display="complain_date"></p>									   
                                       </div>									  
                                    </div> 

															
								</div>	
							

								<div class="col-md-6  "> 					
                                    <div class="form-group">
                                       <label class="control-label col-md-3">投诉内容：</label>
                                       <div class="col-md-9">
									    <p class="form-control-static" data-display="complain_memo"></p>									   
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
	   YTaction='/yzzh/ytsoft.php?s=/Home/Customer/customer_complain';  
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
	    var url=$("#url_url").val()+'/'+'ajaxinsert4';
		yt_ajaxsubmit(url,0,0) 
	}).hide();	
	
    $("#date_registration").val(new Date().Format("yyyy-MM-dd"));  
    $("#complain_date").val(new Date().Format("yyyy-MM-dd hh:mm"));  
	 
	 
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