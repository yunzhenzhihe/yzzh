<?php
return array(
	//'配置项' =>'配置值'
	'MODULE_ALLOW_LIST' =>    array('Admin','Admin',),
	'DEFAULT_MODULE'    =>    'Admin',  // 默认模块
	'SHOW_PAGE_TRACE'   =>  true, 
//	'LOAD_EXT_CONFIG'   => 'db,wechat,oauth', 
	'URL_CASE_INSENSITIVE'  =>  true,  //url不区分大小写

	'URL_MODEL'             => 3,       // URL访问模式,可选参数0、1、2、3,代表以下四种模式：
    // 0 (普通模式); 1 (PATHINFO 模式); 2 (REWRITE  模式); 3 (兼容模式)  默认为PATHINFO 模式，提供最好的用户体验和SEO支持

	'URL_HTML_SUFFIX'  =>'html',
	
	'DB_FIELDTYPE_CHECK'=>true,  // 开启字段类型验证  安全
	'VAR_FILTERS'=>'htmlspecialchars,stripslashes,strip_tags',//对GET POST系统变量会进行过滤，
	'REQUEST_VARS_FILTER'=>true,   // 开启全局安全过滤	
	
	
	'LOG_RECORD' => false, // 开启日志记录
	
//	'TMPL_CACHE_ON'         =>  false,        // 是否开启模板编译缓存,设为false则每次都会重新编译
//	'DB_FIELDS_CACHE'       =>  false,        // true 启用字段缓存 false关闭
	
	
	
	'LANG_SWITCH_ON' => true,   // 开启语言包功能
    'LANG_AUTO_DETECT' => true, // 自动侦测语言 开启多语言功能后有效
    'LANG_LIST'        => 'zh-cn,en-us', // 允许切换的语言列表 用逗号分隔
    'VAR_LANGUAGE'     => 'l', // 默认语言切换变量
    TMPL_PARSE_STRING	=> array(
        '__HOME__' => '/Public/Admin',
        '__ADMIN__' => './Public/Admin'
    ),
	

	// 本机的mysql参数
    'DB_TYPE'               => 'mysql',     // 数据库类型
	'DB_HOST'               => '127.0.0.1', // 服务器地址
	'DB_NAME'               => 'yzzh01',          // 数据库名  2016.6.24修改成自己的数据库 'daijia'
	'DB_USER'               => 'root',      // 用户名
	'DB_PWD'                => '',          // 密码
	'DB_PORT'               => '3306',        // 端口   2012.6.10修改成自己的数据库
	'DB_PREFIX'             => 'yt_',    // 数据库表前缀  2012.6.10修改成自己的数据库		
	
	
);