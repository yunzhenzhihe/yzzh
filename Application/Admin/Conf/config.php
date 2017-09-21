<?php
return array(
	//'配置项'=>'配置值'
//	'SHOW_PAGE_TRACE'=>true,
//	'URL_HTML_SUFFIX'=>'.html',
  //  'TMPL_ACTION_ERROR'     => THINK_PATH.'Tpl/error.tpl', // 默认错误跳转对应的模板文件
 //   'TMPL_EXCEPTION_FILE'   => THINK_PATH.'Tpl/error.tpl',// 异常页面的模板文件

//    'TMPL_ACTION_ERROR'     => THINK_PATH.'Tpl/error.html', // 默认错误跳转对应的模板文件
//    'TMPL_ACTION_SUCCESS'   => THINK_PATH.'Tpl/success.html', // 默认成功跳转对应的模板文件

    'TMPL_ACTION_ERROR' => THINK_PATH . 'Tpl/dispatch_jump.tpl',
//默认成功跳转对应的模板文件
    'TMPL_ACTION_SUCCESS' => THINK_PATH . 'Tpl/dispatch_jump.tpl',
	
	'SHOW_PAGE_TRACE' =>true, // 显示页面Trace信息
//	'SHOW_PAGE_TRACE' =>false, // 显示页面Trace信息  'LOG_RECORD' => true, // 开启日志记录   2017-6-26

//	'DB_FIELDTYPE_CHECK'=>true,  // 开启字段类型验证  安全
//	'VAR_FILTERS'=>'htmlspecialchars,stripslashes,strip_tags',//对GET POST系统变量会进行过滤，
//	'REQUEST_VARS_FILTER'=>true,   // 开启全局安全过滤

 //   'TMPL_STRIP_SPACE'      => false,       // 是否去除模板文件里面的html空格与换行   这个设置很奇怪 如果去掉在手机移动端就会出错

// 'LOG_RECORD' => false, // 开启日志记录   2017-6-26

 'LOG_RECORD' => true, // 开启日志记录   2017-6-26
 
//	'MINIFY'=>true,  //压缩 设置   2017-6-26
 'MINIFY'=>false,  //压缩 设置 

//	'URL_MODEL'             => 3,       // URL访问模式,可选参数0、1、2、3,代表以下四种模式：
    // 0 (普通模式); 1 (PATHINFO 模式); 2 (REWRITE  模式); 3 (兼容模式)  默认为PATHINFO 模式，提供最好的用户体验和SEO支持
	
//    'TMPL_CONTENT_TYPE'     => 'php', // 默认模板输出类型  2012.6.8 修改前是 text/html  2013.5.30 新加 非默认
//    'TMPL_TEMPLATE_SUFFIX'  => '.php',     // 默认模板文件后缀  2012.6.8 修改前是 .html  2013.5.30  新加 非默认	

//开启多语言支持
'LANG_SWITCH_ON' => true,   // 开启语言包功能
'LANG_AUTO_DETECT' => true, // 自动侦测语言 开启多语言功能后有效
'LANG_LIST'        => 'en-us,en-us', // 允许切换的语言列表 用逗号分隔
'VAR_LANGUAGE'     => 'l', // 默认语言切换变量
//结束多语言支持


);
?>
