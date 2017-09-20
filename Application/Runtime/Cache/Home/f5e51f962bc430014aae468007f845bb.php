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


 

<!-- BEGIN PAGE HEADER-->
<div class="yt-head-row">
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN PAGE TITLE & BREADCRUMB-->

            <ul class="page-breadcrumb breadcrumb">


                <li>
                    <span><?php echo (L("_SETUP_")); ?><!--参数设置--></span>
                    <i class="icon-angle-right"></i>
                </li>
                <li>
                    <span><?php echo ($goods_name["name"]); ?><!--参数设置--></span>
                    <i class="icon-angle-right"></i>
                </li>
                <li>
                    <span><?php echo ($name["cate"]); ?><!--参数设置--></span>
                    <i class="icon-angle-right"></i>
                </li>
                <li><span><?php echo (L("_DEFAULTFIELDS_")); ?><!--自定义字段设置--></span></li>
            </ul>


            <!-- END PAGE TITLE & BREADCRUMB-->
        </div>
    </div>
</div>
<!-- END PAGE HEADER-->

<!-- BEGIN PAGE CONTENT-->


<div class="row">
    <div class="col-md-12">
        <div class="table-toolbar">
            <!--	<div class="clearfix">
                   <a class="btn blue" href="JavaScript:window.open('/yzzh/ytsoft.php?s=/Setdefaultfields/defaultfields_add');">添加新字段 <i class="icon-plus"></i>	</a>
                </div>	-->

            <div class="btn-group">
                <button id="yt_btn_add" class="btn green">
                    添加新字段 <i class="icon-plus"></i>
                </button>
            </div>


        </div>

        <div class="table-responsive">
            <table class="table   table-hover table-bordered " id="yt_table">
                <thead>
                <tr>
                    <th>序号</th>
                    <th>字段名称</th>
                    <th>字段类型</th>
                    <th>字段值</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if($recordlist==null) : ?>
                <TR>
                    <TD>无数据</TD>
                    <TD></TD>
                    <TD></TD>
                    <TD></TD>
                    <TD></TD>
                </TR>
                <?php else : ?>
                <?php if(is_array($recordlist)): $k = 0; $__LIST__ = $recordlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><TR>
                        <TD><?php echo ($k); ?></TD>
                        <TD><?php echo ($vo["attr"]); ?></TD>
                        <TD>
                            <?php if($vo["check"] == 1): ?>文本<?php endif; ?>
                            <?php if($vo["check"] == 2): ?>日期<?php endif; ?>
                            <?php if($vo["check"] == 3): ?>单选<?php endif; ?>
                            <?php if($vo["check"] == 4): ?>多选<?php endif; ?>
                        </TD>
                        <TD><?php echo ($vo["value"]); ?></TD>
                        <TD>
                            <button id="yt_btn_edit" class="btn blue btn-xs " onClick="edit_record('<?php echo ($vo['id']); ?>')">
                                修改 <i class="icon-edit"></i>
                            </button>
                            <button id="yt_btn_del" class="btn red btn-xs   yt_marginleft5 "
                                    onClick=" del_record('<?php echo ($vo['id']); ?>')  ">
                                删除 <i class="icon-remove"></i>
                            </button>
                            <button class="btn dark btn-xs yz_up" onClick=" up_record('<?php echo ($vo['id']); ?>','<?php echo ($vo['sort']); ?>')  ">
                                排序上移 <i class="icon-arrow-up"></i>
                            </button>
                            <button class="btn dark btn-xs   yt_marginleft5 yz_down"
                                    onClick=" down_record('<?php echo ($vo['id']); ?>','<?php echo ($vo['sort']); ?>')  ">
                                排序下移 <i class="icon-arrow-down"></i>
                            </button>
                        </TD>
                    </TR><?php endforeach; endif; else: echo "" ;endif; ?>
                <?php endif ?>

                </tbody>
            </table>
        </div>


    </div>
</div>


<!-- BEGIN DIALOG_FORM  -->
<div id="yt_dialog_form" class="modal fade" tabindex="-1" aria-hidden="true" data-width="750">
    <div class="modal-header" id="yt_modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title" id="yt_dialog_title">添加</h4>
    </div>
    <div class="modal-body ">
        <form class="form-horizontal" role="form">
            <div class="form-group">
                <label for="attr" class="col-sm-3 control-label">字段名称<span class="required">*</span></label>
                <div class="col-sm-8 ">
                    <input type="text" class="form-control" id="attr" name="inputdatabox">
                </div>
            </div>
            <div class="form-group" style="display:none">
                <label for="cate_id" class="col-sm-3 control-label">分类ID<span class="required">*</span></label>
                <div class="col-sm-8 ">
                    <input type="text" class="form-control" id="cate_id" name="inputdatabox" value="<?php echo ($cate_id); ?>">
                </div>
            </div>
            <div class="form-group" style="display:none">
                <label for="gid" class="col-sm-3 control-label">分类ID<span class="required">*</span></label>
                <div class="col-sm-8 ">
                    <input type="text" class="form-control" id="gid" name="inputdatabox" value="<?php echo ($goods_name["id"]); ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">字段类型<span class="required">*</span></label>
                <div class="col-sm-8">
                    <div class="radio-list yt_marginleft15 ">
                        <label class="radio-inline">
                            <input type="radio" name="check" value="1" data-title="文本" checked/> 文本
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="check" value="2" data-title="日期"/> 日期
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="check" value="3" data-title="单选"/> 单选
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="check" value="4" data-title="多选"/> 多选
                        </label>
                        <span class="help-block">这将决定顾客定制时的选择方式
									</span>
                    </div>
                </div>
            </div>

            <div class="form-group" id="value_disp">
                <label for="value" class="control-label col-md-3">字段值<span class="required"></span></label>
                <div class="col-md-8">
                    <input type="text" id="value" class="form-control select2" required data-placeholder="请输入..."
                           name="inputdatabox">
                </div>
            </div>


            <div class="form-group" id="yt_dialog_addchecktext">
                <div class="col-sm-offset-3 col-sm-8">
                    <div class="checkbox yt_marginleft15 ">
                        <label>
                            <input type="checkbox" id="yt_dialog_addcheck" checked="true"> 连续添加
                        </label>
                    </div>
                </div>
                <input id="edit_record_id" type="hidden"/>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn default" id="yt_dialog_btn_cancel">取消</button>
        <button type="button" class="btn green" id="yt_dialog_btn_ok">确认</button>
    </div>
</div>
<!-- END DIALOG_FORM  -->


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
	   YTaction='/yzzh/ytsoft.php?s=/Home/Setdefaultfields/defaultfields_list';  
   </script>   

   
   
   
   
   




<script>

    jQuery(document).ready(function () {
        App.initnocheckboxes();
        UIExtendedModals.init();
        checkRadio();

        $('#yt_left_menu_setup').addClass("active");
        $('#yt_left_menu_setup_defaultfields').addClass("active");

        $('#yt_left_menu_setup_arrow .arrow ').remove();
        $('#yt_left_menu_setup_arrow ').append('<span class="selected"></span> ');
        $('#yt_left_menu_setup_arrow ').append('<span class="arrow open"></span>	');


    });


    YTapp = '/yzzh/ytsoft.php?s=';

    $('#form_wizard_1 .button-submit').click(function () {
        var url = '/yzzh/ytsoft.php?s=/Home/Setdefaultfields/' + 'ajaxinsert';
        yt_ajaxsubmit(url, 0, 1);
    }).hide();


    $("#value").select2({
        tags: []
    });

    $('.yz_up').first().css('display', 'none');
    $('.yz_down').last().css('display', 'none');


    $(function () {
        $(":radio").click(function () {
            checkRadio();
        });
    });


    function checkRadio() {   // 关闭或者打开字段值
        var item = '1';
        $("input:radio").each(function () {
            if (this.checked) {
                item = $(this).val();
            }
        });
        if (item == '1' || item == '2') {
            $("#value_disp").hide();
        } else {
            $("#value_disp").show();
        }
    }

    function up_record(id, sort) {   //排序上移
        if (confirm("确认要排序上移？")) {
            var url = '/yzzh/ytsoft.php?s=/Home/Setdefaultfields/' + 'sortup';
            ajax_submit(url, {id: id, sort: sort})   //ajax 提交数据
        }
    }

    function down_record(id, sort) {   //排序下移
        if (confirm("确认要排序下移？")) {
            var url = '/yzzh/ytsoft.php?s=/Home/Setdefaultfields/' + 'sortdown';
            ajax_submit(url, {id: id, sort: sort})   //ajax 提交数据
        }
    }


</script>

<script type="text/javascript">
    function dialogcheckdata() {
        var checkvalid = true;
        checkvalid = checkvalid && checkLength($("#attr"), "字段名称", StringLength001, StringLength100);
        return checkvalid;
    };

    function dialogclearinputbox() {
        dialog_clear_allbox();
        $("#attr").focus();
    };

    function dialog_clear_allbox() {
        var a = document.getElementsByName("inputdatabox");
        for (var i = 0; i < a.length; i++)
            if (i != 1 && i != 2) {
                a[i].value = '';
            }

        $("#value").select2({
            tags: []
        });

        checkRadio();
    };

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
	<input id="url_url"  value="/yzzh/ytsoft.php?s=/Home/Setdefaultfields"  type="hidden" />
	<input id="url_public"  value="/yzzh/Public"  type="hidden" />
	<input id="url_app"  value="/yzzh/ytsoft.php?s="  type="hidden" />
</div>
 

</body>
</html>