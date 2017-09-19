<?php if (!defined('THINK_PATH')) exit();?>
<style>
    .page {
        height: 18px;
        padding-top: 20px;
        text-align: center;
    }

    DIV.page {
        PADDING-RIGHT: 5px;
        PADDING-LEFT: 3px;
        PADDING-BOTTOM: 3px;
        MARGIN: 3px;
        PADDING-TOP: 3px;
        TEXT-ALIGN: center;
        margin-top: 20px;
    }

    DIV.page A {
        BORDER: #E66C16 1px solid;
        PADDING-RIGHT: 5px;
        PADDING-LEFT: 5px;
        PADDING-BOTTOM: 2px;
        MARGIN: 0px;
        COLOR: #333;
        PADDING-TOP: 2px;
        TEXT-DECORATION: none
    }

    DIV.page A:hover {
        BORDER: #E45A11 1px solid;
        COLOR: #000;
        background: #FCD3BE;
    }

    DIV.page A:active {
        BORDER-RIGHT: #000099 1px solid;
        BORDER-TOP: #000099 1px solid;
        BORDER-LEFT: #000099 1px solid;
        COLOR: #000;
        BORDER-BOTTOM: #000099 1px solid
    }

    DIV.page SPAN.current {
        BORDER: #E34F0F 1px solid;
        PADDING-RIGHT: 5px;
        PADDING-LEFT: 5px;
        FONT-WEIGHT: bold;
        PADDING-BOTTOM: 2px;
        MARGIN: 2px;
        COLOR: #333;
        PADDING-TOP: 2px;
        BACKGROUND-COLOR: #FCD3BE;
    }

    DIV.page SPAN.disabled {
        BORDER-RIGHT: #ccc 1px solid;
        PADDING-RIGHT: 5px;
        BORDER-TOP: #ccc 1px solid;
        PADDING-LEFT: 5px;
        PADDING-BOTTOM: 2px;
        MARGIN: 0px;
        BORDER-LEFT: #ccc 1px solid;
        COLOR: #aaa;
        PADDING-TOP: 2px;
        BORDER-BOTTOM: #ccc 1px solid;
    }
</style>
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
   <link href="/yzzh/Public/css/animate.min.css" rel="stylesheet"/>
   <!--<link href="/yzzh/Public/css/light-bootstrap-dashboard.css" rel="stylesheet"/>-->
   <link href="/yzzh/Public/css/demo.css" rel="stylesheet" />
   <link href="/yzzh/Public/css/pe-icon-7-stroke.css" rel="stylesheet" />
  <!--
   <link rel="stylesheet" type="text/css" href="/yzzh/Public/assets/plugins/data-tables/jquery.dataTables.css" /> 
   <link rel="stylesheet" type="text/css" href="/yzzh/Public/assets/plugins/data-tables/DT_bootstrap.css" />
   <link rel="stylesheet" type="text/css" href="/yzzh/Public/assets/plugins/select2/select2-bootstrap.css" />  -->


   <link rel="shortcut icon" href="/yzzh/Public/assets/img/yt.ico" />
   <style>
      body, h1, h2, h3, h4, h5, h6, p, a, td, button {
         -moz-osx-font-smoothing: grayscale;
         -webkit-font-smoothing: antialiased;
         font-family: "Roboto","Helvetica Neue",Arial,sans-serif;
         font-weight: 400;
      }
   </style>

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
            <li id="yt_left_menu_3D" >
               <a href="javascript:;" id="yt_left_menu_3D_arrow" >
                  <i class="icon-picture"></i>
                  <span class="title">虚拟与现实</span>
                  <span class="arrow "></span>
               </a>
               <ul class="sub-menu">
                  <li id="yt_left_menu_3Dset" >
                     <a href="/yzzh/ytsoft.php?s=/Virtuality/index">
                        模型贴图上传</a>
                  </li>
                  <li id="yt_left_menu_images_imageslist">
                     <a href="/yzzh/ytsoft.php?s=/Showimages/group">
                        图片分组管理</a>
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
         </ul>
         <!-- END SIDEBAR MENU -->
      </div>
      <!-- END SIDEBAR -->
      <!-- BEGIN PAGE -->
      <div class="page-content">


 
<link rel="stylesheet" type="text/css" href="/yzzh/Public/css/style.css">
<link rel="stylesheet" href="/yzzh/Public/css/ssi-uploader.css"/>
<div class="yt-head-row">
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN PAGE TITLE & BREADCRUMB-->
            <ul class="page-breadcrumb breadcrumb">
                <li>
                    <span>虚拟与现实	</span>
                    <i class="icon-angle-right"></i>
                </li>
                <li id="li2">
                    <span id="model_img">模型贴图上传</span>
                </li>
            </ul>
            <!-- END PAGE TITLE & BREADCRUMB-->
        </div>
    </div>
</div>
<!-- END PAGE HEADER-->

<!-- BEGIN PAGE CONTENT-->
<div class="row">
    <div class="row">
        <div class="col-md-3">
            <div class="post-grids">
                <div class="col-md-12 ">
                    <h4 class="form-section">模型预览</h4>
                    <p class="yt_date">
                    <div id="d">
                        <div id="buttons_materials" class="bwrap"></div>
                    </div>
                    <div id="canvas-frame" style="width: 100%; height: 450px; cursor: auto;">
                    </div>
                    <div class="fd-btn"></div>
                    </p>
                    <button class="btn btn-primary start" onclick="start()">开始</button>
                    <button class="btn btn-warning cancel" onclick="stop()">停止</button>
                </div>

                <div class="clearfix"></div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card">
                <h4 class="form-section">商品模型上传</h4>
                <li class="btn-group yt_float_left">
                    <button type="button" class="btn <?php echo ($btn_flag1); ?> dropdown-toggle" data-toggle="dropdown"
                            data-hover="dropdown" data-delay="1000" data-close-others="true">
                        <span><b>&nbsp; &nbsp;请选择商品&nbsp; &nbsp;</b></span> <i class="icon-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu pull-right" role="menu">
                        <strong>
                            <?php if(is_array($goods_name)): foreach($goods_name as $key=>$name): ?><li><a href="javascript:void(0);" class="goodscate" gid="<?php echo ($name["id"]); ?>"><?php echo ($name["name"]); ?></a>
                                </li><?php endforeach; endif; ?>
                        </strong>
                    </ul>
                </li>
                <div class="content table-responsive table-full-width">
                    <table class="table table-hover table-condensed table-striped" id="table">
                        <thead id="12348">
                        <tr>
                            <th>序号</th>
                            <th>商品名称</th>
                            <th>模型文件上传</th>
                            <th>属性管理</th>
                            <th>贴图</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<div class="modal-content modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h5 class="modal-title" id="myModalLabel">贴图上传</h5>
    </div>
    <div class="modal-body">
        <table class="table table-hover table-condensed table-striped table-bordered" id="table1">
            <thead>
            <tr>
                <th>序号</th>
                <th>字段</th>
                <th>字段值</th>
                <th>贴图上传</th>
            </tr>
            </thead>
        </table>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
    </div>
</div>


<div class="modal-content modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModal1Label"
     aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h5 class="modal-title" id="myModalLabel">属性关联</h5>
    </div>
    <div class="modal-body" id="selectimg">
        <table class="table table-hover table-condensed table-striped" id="table2">
            <thead>
            <tr>
                <th>序号</th>
                <th>属性</th>
                <th>MTL标题</th>
            </tr>
            </thead>
        </table>
    </div>
    <div class="modal-footer">
        <!--<button type="button" class="btn btn-primary" id="Submit_Association">提交关联</button>-->
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
    </div>
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
	   YTaction='/yzzh/ytsoft.php?s=/Home/Virtuality/index';  
   </script>   

   
   
   
   
   



<script src="/yzzh/Public/js/three.js"></script>
<script src="/yzzh/Public/js/controls/OrbitControls.js"></script>
<script src="/yzzh/Public/js/loaders/DDSLoader.js"></script>
<script src="/yzzh/Public/js/loaders/MTLLoader.js"></script>
<script src="/yzzh/Public/js/loaders/OBJLoader.js"></script>
<script src="/yzzh/Public/js/ssi-uploader.js"></script>

<script>
    $('.goodscate').each(function () {
        $(this).click(function () {
            var g = $(this).html();
            var gid = $(this).attr('gid');
            $.post('/yzzh/ytsoft.php?s=/Home/Virtuality/goodscatelist', {gid: gid}, function (data) {
                if (data) {
                    var list = "<tbody id='obj' info='objmtl'>";
                    for (var i = 0; i < data.length; i++) {
                        var cate = data[i];
                        if (cate.cate != null) {
                            var num = i + 1;
                            list += "<tr class='list' style='font-weight: lighter;'><th>" + num + "</th>";
                            list += "<th style='display: none' id='cateid'>" + cate.id + "</th>";
                            list += "<th id='cate'>" + cate.cate + "</th>";
                            list += "<th>" + "<div>" +
                                "<div>" +
                                "<input type='file' multiple class='ssi-upload1'/>" +
                                "</div>" +
                                "</div>" + "</th>";
                            list += "<th>" + "<button class='btn btn-warning' data-toggle='modal' data-target='myModal1'>管理</button>" + "</th>";
                            list += "<th>" + '<a class="btn btn-primary upimgbtn">' + "贴图上传" + "</a>" + "</th>";
                        }
                        list += "</tr>";
                    }
                    list += "</tbody>";
                    var jtou = '<i class="icon-angle-right" id="jtou2"></i>';
                    if ($('.icon-angle-right').length <= 1) {
                        $('#model_img').append(jtou);
                    }
                    var goods = "<li id='li3' style='font-size: 14px;'>" + g + "</li>";
                    $('#li3').empty();
                    $('#li2').after(goods);
                    $('.list').empty();
                    $('#table').append(list);
                    $('.ssi-upload1').ssi_uploader({
                        url: '/yzzh/ytsoft.php?s=/Home/Virtuality/upload',
                        dropZone: false,
                        maxFileSize: 100,
                        allowed: ['obj','mtl']
                    });
                    $('.btn-warning').each(function () {
                        $(this).click(function () {
                            $('#attrlist1').empty();
                            var cate_id = $(this).parents('th').prev().prev().prev().html();
                            $.ajax({
                                url: '/yzzh/ytsoft.php?s=/Home/Virtuality/mtlinfo',
                                data: {cate_id: cate_id},
                                type: "post",
                                cache: false,
                                async: false,
                                success: function (mes) {
                                    if (mes.info == "none") {
                                        alert('请先上传模型相关文件！');
                                        return false;
                                    }
                                    attrlist = "<tbody id='attrlist1'>";
                                    if (mes.status) {
                                        //拼接select框
                                        opt = "<select class='form-control border-radius mtl_select'>" + "<option style='display: none;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-----------&nbsp;请&nbsp;选&nbsp;择&nbsp;-----------</option>"
                                        for (var a = 0; a < mes.info.length; a++) {
                                            var mtl = mes.info[a];

                                            if (mtl.mtl_title != null) {
                                                opt += '<option value=' + '"' + mtl.id + '"' + '>' + mtl.mtl_title + "</option>";
                                            }
                                        }

                                        opt += "</select>";
                                        //拼接table表格
                                        for (var i = 0; i < mes.data.length; i++) {
                                            var attr = mes.data[i];

                                            if (attr.attr != null) {
                                                var num = i + 1;
                                                attrlist += "<tr class='list2'><th>" + num + "</th>";
                                                attrlist += "<th style='display: none'>" + attr.id + "</th>";
                                                attrlist += "<th id='cate'>" + attr.attr + "</th>";
                                                attrlist += "<th>" + opt + "</th>";
                                            }
                                            attrlist += "</tr>";
                                        }
                                        attrlist += "</tbody>";
                                    }
                                    $('.list2').empty();
                                    $('#table2').append(attrlist);
                                    $('#myModal1').modal('toggle');
                                    $('.mtl_select').each(function () {
                                        $(this).change(function () {
                                            var mtl_id = $(this).children('option:selected').val();
                                            var val = $(this).children('option:selected').html();
                                            var cate = $(this).parent().prev().html();
                                            var attr_id = $(this).parent().prev().prev().html();
                                            var message = "确认要将" + " " + val + " " + "与" + " " + cate + " " + "关联吗？";
                                            var bol = confirm(message);
                                            if (bol) {
                                                $.ajax({
                                                    data: {mtl_id: mtl_id, attr_id: attr_id},
                                                    type: "post",
                                                    url: "/yzzh/ytsoft.php?s=/Home/Virtuality/related",
                                                    cache: false,
                                                    async: false,
                                                    success: function (mes) {
                                                        alert(mes);
                                                    }
                                                });
                                            }
                                        });
                                    });
                                }
                            });
                        });
                    });
                    $('.upimgbtn').each(function () {
                        $(this).click(function () {
                            var cate_id = $(this).parent().prev().prev().prev().prev().html();
                            var cate = $(this).parent().prev().prev().prev().html();
                            $.post('/yzzh/ytsoft.php?s=/Home/Virtuality/modelmap', {cate_id: cate_id, cate: cate}, function (mes) {
                                if (mes) {
                                    var list1 = "<tbody>";
                                    var s = 0;
                                        for (var i = 0; i < mes.length; i++) {
                                            var me = mes[i];
                                            if (me != null) {
                                                s++;
                                                list1 += "<tr class='list1'><th>" + s + "</th>";
                                                list1 += "<th>" + me.attr + "</th>";
                                                list1 += "<th>" + me.value + "</th>";
                                                list1 += "<th style='display: none'>" + me.id + "</th>"
                                                list1 += "<th style='display: none'>" + me.cate_id + "</th>";
                                                list1 += "<th>" + "<div>" +
                                                    "<div>" +
                                                    "<input type='file' multiple class='ssi-upload'/>" +
                                                    "</div>" +
                                                    "</div>" + "</th>";
                                            }
                                            list1 += "</tr>";
                                        }
                                    list1 += "</tbody>";
                                    $('.list1').empty();
                                    $('#table1').append(list1);
                                    $('#myModal').modal('toggle');
                                    $('.ssi-upload').ssi_uploader({
                                        url: '/yzzh/ytsoft.php?s=/Home/Virtuality/upload',
                                        maxFileSize: 60,
                                        dropZone: false,
                                        allowed: ['jpg', 'gif', 'png', 'jpeg'],
                                        data:{id:id}
                                    });
                                } else {
                                    alert('请先在该商品下添加字段和值！');
                                }
                            });
                        });
                    });
                }
            });
        });
    });
</script>
<script>

    var container = document.getElementById('canvas-frame');
    var width = document.getElementById('canvas-frame').clientWidth;
    var height = document.getElementById('canvas-frame').clientHeight;
    var camera, scene, renderer;
    var STATS_ENABLED = false;
    var directionalLight, pointLight;
    var mouse = new THREE.Vector2();
    var windowHalfX = window.innerWidth / 2;
    var windowHalfY = window.innerHeight / 2;
    var model;
    var mtlLoader;

    init();

    function init() {

        camera = new THREE.PerspectiveCamera(70, width / height, 1, 100000);
        camera.position.z = 200;
        camera.position.y = 100;
        camera.target = new THREE.Vector3();

        //场景
        var textureCube = new THREE.CubeTextureLoader()
            .setPath('public/textures/cube/Bridge2/')
            .load(['posx.jpg', 'negx.jpg', 'posy.jpg', 'negy.jpg', 'posz.jpg', 'negz.jpg']);
        scene = new THREE.Scene();
        scene.background = textureCube;

        if (STATS_ENABLED) {

            stats = new Stats();
            container.appendChild(stats.dom);

        }
        //model
        THREE.Loader.Handlers.add(/\.dds$/i, new THREE.DDSLoader());

        mtlLoader = new THREE.MTLLoader();
        loadObj();

        // 渲染器
        renderer = new THREE.WebGLRenderer();
        renderer.setPixelRatio(window.devicePixelRatio);
        renderer.setSize(width, height);
        renderer.setFaceCulling(THREE.CullFaceNone);
        container.appendChild(renderer.domElement);

        window.addEventListener('resize', onWindowResize, false);

        //鼠标
        controls = new THREE.OrbitControls(camera, renderer.domElement);
        controls.minDistance = 50;
        controls.maxDistance = 200;

        mouseHelper = new THREE.Geometry(new THREE.BoxGeometry(1, 1, 10), new THREE.MeshNormalMaterial());

        mouseHelper.visible = false;

        scene.add(mouseHelper);

        window.addEventListener('resize', onWindowResize, false);

        var moved = false;

        controls.addEventListener('change', function () {
            moved = true;
        });

        window.addEventListener('mousemove', onTouchMove);
        window.addEventListener('touchmove', onTouchMove);


    }

    function loadObj(obj, mtl) {
        if (mtl) {
            mtlLoader.load(mtl, function (materials) {

                var ambient = new THREE.AmbientLight(0x050505);
                scene.add(ambient);

                //平行光
                directionalLight = new THREE.DirectionalLight(0xffffff, 2);
                directionalLight.position.set(2, 1.2, 10).normalize();
                scene.add(directionalLight);

                directionalLight = new THREE.DirectionalLight(0xffffff, 1);
                directionalLight.position.set(-2, 1.2, -10).normalize();
                scene.add(directionalLight);
                //点光
                pointLight = new THREE.PointLight(0xffaa00, 2);
                pointLight.position.set(2000, 1200, 10000);
                scene.add(pointLight);
                materials.preload();

                var objLoader = new THREE.OBJLoader();
                objLoader.setMaterials(materials);
                if (obj) {
                    objLoader.load(obj, function (object) {

                        object.position.y = -70;
                        object.scale.x = 0.1;
                        object.scale.y = 0.1;
                        object.scale.z = 0.1;
                        scene.add(object);
                        model = object;
                        animate();
                        object.preload();
                    }, onProgress, onError);
                }
            });


            var onProgress = function (xhr) {
                if (xhr.lengthComputable) {
                    var percentComplete = xhr.loaded / xhr.total * 100;
                    console.log(Math.round(percentComplete, 2) + '% downloaded');
                }
            };

            var onError = function (xhr) {
            };
        }
    }


    function onTouchMove(event) {

        if (event.changedTouches) {

            x = event.changedTouches[0].pageX;
            y = event.changedTouches[0].pageY;

        } else {

            x = event.clientX;
            y = event.clientY;

        }

        mouse.x = ( x / width ) * 2 - 1;
        mouse.y = -( y / height ) * 2 + 1;
    }

    function onWindowResize() {

        windowHalfX = width / 2;
        windowHalfY = height / 2;

        camera.aspect = width / height;
        camera.updateProjectionMatrix();

        renderer.setSize(width, height);

    }

    var id;

    function animate() {
        model.rotateY(0.01);
        renderer.render(scene, camera);
        id = requestAnimationFrame(animate);

    }


    function stop() {
        if (id !== null) {
            cancelAnimationFrame(id);
            id = null;
        }
    }

    function start() {
        if (id == null) {
            id = requestAnimationFrame(animate);
        }
    }
</script>

<script>
    jQuery(document).ready(function () {
        App.initnocheckboxes();
        $('#yt_left_menu_3D').addClass("active");
        $('#yt_left_menu_3Dset').addClass("active");

        $('#yt_left_menu_3D_arrow .arrow ').remove();
        $('#yt_left_menu_3D_arrow ').append('<span class="selected"></span> ');
        $('#yt_left_menu_3D_arrow ').append('<span class="arrow open"></span>	');

        showSelect('#NumberOfRows', '<?php echo (cookie('NumberOfRows')); ?>');
    });
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
	<input id="url_url"  value="/yzzh/ytsoft.php?s=/Home/Virtuality"  type="hidden" />
	<input id="url_public"  value="/yzzh/Public"  type="hidden" />
	<input id="url_app"  value="/yzzh/ytsoft.php?s="  type="hidden" />
</div>
 

</body>
</html>