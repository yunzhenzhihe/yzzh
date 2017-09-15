<?php
/**
 * Groups configuration for default Minify implementation
 * @package Minify
 */

/** 
 * You may wish to use the Minify URI Builder app to suggest
 * changes. http://yourdomain/min/builder/
 *
 * See http://code.google.com/p/minify/wiki/CustomSource for other ideas
 **/
session_start();
define('YT_PUBLIC', '/'.$_SESSION['YT_ROOT'].'/Public/');  //root 跟路径 用于 Minify 来做css和js压缩  登录的时候设置 session
//die(ROOT_URL);

return array(
	 'web_css' => array(
						//  BEGIN GLOBAL MANDATORY STYLES
						//	YT_PUBLIC.'assets/plugins/font-awesome/css/font-awesome.min.css', // 这两个单独独立出来了
						//	YT_PUBLIC.'assets/plugins/bootstrap/css/bootstrap.min.css',   // 这两个单独独立出来了
							YT_PUBLIC.'assets/plugins/uniform/css/uniform.default.css',
						//	END GLOBAL MANDATORY STYLES									
						// BEGIN PAGE LEVEL STYLES  
							YT_PUBLIC.'assets/plugins/select2/select2_metro.css',
							YT_PUBLIC.'assets/plugins/data-tables/jquery.dataTables.css',
							YT_PUBLIC.'assets/plugins/data-tables/DT_bootstrap.css',
							
							YT_PUBLIC.'assets/plugins/bootstrap-datepicker/css/datepicker.css',
							YT_PUBLIC.'assets/plugins/bootstrap-timepicker/compiled/timepicker.css',
							YT_PUBLIC.'assets/plugins/bootstrap-colorpicker/css/colorpicker.css',
							YT_PUBLIC.'assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css',
							YT_PUBLIC.'assets/plugins/bootstrap-datetimepicker/css/datetimepicker.css',
							   // BEGIN PLUGINS USED BY X-EDITABLE 
							//	YT_PUBLIC.'assets/plugins/bootstrap-editable/bootstrap-editable/css/bootstrap-editable.css',
							//	YT_PUBLIC.'assets/plugins/bootstrap-editable/inputs-ext/searchcustomersort/searchcustomersort.css',						   
							   // END PLUGINS USED BY X-EDITABLE  						
							YT_PUBLIC.'assets/plugins/fancybox/source/jquery.fancybox.css',  // 图片处理 
							YT_PUBLIC.'assets/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css',
							YT_PUBLIC.'assets/plugins/bootstrap-modal/css/bootstrap-modal.css',
						// END PAGE LEVEL STYLES 	
						 //BEGIN THEME STYLES
							YT_PUBLIC.'assets/css/style-metronic.css',
							YT_PUBLIC.'assets/css/style.css',
							YT_PUBLIC.'assets/css/style-responsive.css',						
							YT_PUBLIC.'assets/css/plugins.css',
							YT_PUBLIC.'assets/css/pages/portfolio.css',
							YT_PUBLIC.'assets/css/pages/news.css',
							YT_PUBLIC.'assets/css/pages/login.css',
							YT_PUBLIC.'assets/css/themes/default.css',
							YT_PUBLIC.'assets/css/custom.css',
						//END THEME STYLES 
							YT_PUBLIC.'css/jtip.css',   //jquery 帮助提示插件 				
		),		
	 'web_js' => array(
						// BEGIN CORE PLUGINS
						//   YT_PUBLIC.'assets/plugins/jquery-1.10.2.min.js',  // 这三个单独独立出来了
						//   YT_PUBLIC.'assets/plugins/jquery-migrate-1.2.1.min.js',  // 这三个单独独立出来了
						 //  YT_PUBLIC.'assets/plugins/bootstrap/js/bootstrap.min.js',  // 这三个单独独立出来了
						   YT_PUBLIC.'assets/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js',
						   YT_PUBLIC.'assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js',
						   YT_PUBLIC.'assets/plugins/jquery.blockui.min.js',
						   YT_PUBLIC.'assets/plugins/jquery.cookie.min.js',
						   YT_PUBLIC.'assets/plugins/uniform/jquery.uniform.min.js',
						 // END CORE PLUGINS	   
						 //BEGIN PAGE LEVEL PLUGINS 
						   YT_PUBLIC.'assets/plugins/jquery-validation/dist/jquery.validate.min.js',
						   YT_PUBLIC.'assets/plugins/jquery-validation/localization/messages_zh.js',
						   YT_PUBLIC.'assets/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js',
						 // END PAGE LEVEL SCRIPTS   
						   YT_PUBLIC.'assets/plugins/select2/select2.min.js',
						 //  YT_PUBLIC.'assets/plugins/data-tables/jquery.dataTables.js',
						   YT_PUBLIC.'assets/plugins/data-tables/jquery.dataTables.min.js',
						   YT_PUBLIC.'assets/plugins/data-tables/DT_bootstrap.js',
						   YT_PUBLIC.'assets/plugins/bootstrap-modal/js/bootstrap-modalmanager.js',
						   YT_PUBLIC.'assets/plugins/bootstrap-modal/js/bootstrap-modal.js',   
						// 时间选择器相关  
						   YT_PUBLIC.'assets/plugins/fuelux/js/spinner.min.js',
						   YT_PUBLIC.'assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',
						   YT_PUBLIC.'assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js',
						//   YT_PUBLIC.'assets/plugins/bootstrap-daterangepicker/moment.min.js',
						//   YT_PUBLIC.'assets/plugins/bootstrap-daterangepicker/daterangepicker.js',
						//   YT_PUBLIC.'assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.js',
						//   YT_PUBLIC.'assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js',
						// 时间选择器相关  
						// BEGIN PLUGINS USED BY X-EDITABLE 在线修改数据 
						  YT_PUBLIC.'assets/plugins/jquery.mockjax.js',
						//   YT_PUBLIC.'assets/plugins/bootstrap-editable/bootstrap-editable/js/bootstrap-editable.min.js',
						//   YT_PUBLIC.'assets/plugins/bootstrap-editable/inputs-ext/searchcustomersort/searchcustomersort.js',
						// END X-EDITABLE PLUGIN   
						// 表格排序 
						 //  YT_PUBLIC.'assets/plugins/data-tables/jquery.dataTables.js',
						 //  YT_PUBLIC.'assets/plugins/data-tables/DT_bootstrap.js',
						// 表格排序 
						   YT_PUBLIC.'assets/scripts/app.js',
						   YT_PUBLIC.'assets/scripts/login.js',
						   YT_PUBLIC.'assets/scripts/ui-extended-modals.js',
						   YT_PUBLIC.'assets/scripts/form-components.js',
						   YT_PUBLIC.'assets/scripts/form-wizard.js',
						   YT_PUBLIC.'assets/scripts/form-editable.js',
						   YT_PUBLIC.'assets/scripts/table-managed.js',   
						   YT_PUBLIC.'assets/scripts/yt_ui_scripts.js',   //自定义js 插件中使用						   
						   YT_PUBLIC.'js/yt_main.js',   //自定义js
						   YT_PUBLIC.'js/yt_dialog_data.js',   //自定义js							   
						   YT_PUBLIC.'js/jtip.js',  //jquery 帮助提示插件
					//	   YT_PUBLIC.'layer/layer.js',  //自定义的一些 alter  skin文件夹在Minify文件夹里面 这个是layer 的一个bug
					//	   YT_PUBLIC.'layer/extend/layer.ext.js',  //自定义的一些 alter 扩展   skin文件夹在Minify文件夹里面 这个是layer 的一个bug
						   YT_PUBLIC.'js/LodopFuncs.js',     //打印单据
						   YT_PUBLIC.'js/tableExport.js',    //表格导出到excel 
						   YT_PUBLIC.'js/jquery.base64.js',  
		),			
	 'web_mapjs' => array(
						   YT_PUBLIC.'js/yt_map.js',  
		),	
	 'web_customer_sale_js' => array(
						   YT_PUBLIC.'js/yt_customer_sale.js',  
		),	
	 'web_customer_sale_edit_js' => array(
						   YT_PUBLIC.'js/yt_customer_sale_edit.js',  
		),	
	 'web_sales2return_add_js' => array(
						   YT_PUBLIC.'js/yt_sales2return_add.js',  
		),		
	 'web_serviceprocess_completedinfo_js' => array(
						   YT_PUBLIC.'js/yt_serviceprocess_completedinfo.js',  
		),	
	 'web_stockservicestaffout_addinfo_js' => array(
						   YT_PUBLIC.'js/yt_stockservicestaffout_addinfo.js',  
		),	
	 'web_stockservicestaffout_editinfo_js' => array(
						   YT_PUBLIC.'js/yt_stockservicestaffout_editinfo.js',  
		),			
	 'web_stockservicestaffin_addinfo_js' => array(
						   YT_PUBLIC.'js/yt_stockservicestaffin_addinfo.js',  
		),	
	 'web_stockservicestaffin_editinfo_js' => array(
						   YT_PUBLIC.'js/yt_stockservicestaffin_editinfo.js',  
		),		
	 'web_stockloss_addinfo_js' => array(
						   YT_PUBLIC.'js/yt_stockloss_addinfo.js',  
		),	
	 'web_stockloss_editinfo_js' => array(
						   YT_PUBLIC.'js/yt_stockloss_editinfo.js',  
		),	
	 'web_stockin_addinfo_js' => array(
						   YT_PUBLIC.'js/yt_stockin_addinfo.js',  
		),	
	 'web_stockin_editinfo_js' => array(
						   YT_PUBLIC.'js/yt_stockin_editinfo.js',  
		),

		
);


