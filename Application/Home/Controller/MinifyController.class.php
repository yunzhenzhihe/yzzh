<?php
namespace Home\Controller;
use Think\Controller;

//公司后台管理模块
class MinifyController extends PublicadminController {

public function index(){
 //(1) 设置/min/config.php文件 ，$min_cachePath 有3个设置方式。
 //$min_cachePath = ‘c://WINDOWS//Temp’;
 //$min_cachePath = ‘/tmp’;
 //$min_cachePath = preg_replace(‘/^//d+;/’, ”, session_save_path());
 // 选择第2个，去除// .设置tmp属性777

 //(2) 要压缩的条件请在/ThinkPHP/Library/Vendor/Minify/groupsConfig.php配置

 //(3) 调试模式 
 // 在调试模式下，Minify不压缩文件，而是发送合并后的带有行号的文件。要启用该模式，
 // 在config.php中设置为$min_allowDebugFlag为true，并增加"&debug=1"到你的URIs. 
 // 例如：/min/?f=script1.js,script2.js&debug=1 
 // 注：对于该模式，注释风格的字符串正则表达式可能会导致问题。

 //(4) 页面中使用 不是本地环境时候加载压缩合并的资源文件
 // <if condition="!$Think.const.IS_WIN">
 // <script src="{:U('/Min/index?g=js')}"></script>
 // <link rel="stylesheet"href="{:U('/Min/index?g=css')}">
 // </if>

 //(5) 安装完毕后删除min/builder/index.php 文件。防止其他人登陆！后期如需编辑再次上传！

//引入压缩类库
Vendor('Minify.index');
}
	



}