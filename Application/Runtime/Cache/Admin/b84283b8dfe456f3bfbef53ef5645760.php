<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html>
<head>
    <title>门店惊喜--金银猫CSmall</title>
    <meta name="keywords" content="<?php echo ($metaKeywords); ?>" />
    <meta name="description" content="<?php echo ($metaDesc); ?>" />
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <link href="http://www.jq22.com/jquery/bootstrap-3.3.4.css" rel="stylesheet">
    <link rel="Bookmark" href="favicon.ico">
    <link rel="Shortcut Icon" href="favicon.ico">


    <script src="./Public/Admin/laydate/laydate.js"></script>
    <script src="http://js.spcrm.com/jQuery-1.7.1.min.js" type="text/javascript"></script>
    <script charset="utf-8" src="http://js.spcrm.com/jquery.qrcode.min.js" type="text/javascript"></script>

    <script charset="utf-8" src="./Public/Admin/js1/jquery.smallslider.js" type="text/javascript"></script>
    <script src="http://www.jq22.com/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://www.jq22.com/jquery/bootstrap-3.3.4.js"></script>
    <script src="./Public/Admin/dist/js/distpicker.data.js"></script>
    <script src="./Public/Admin/dist/js/distpicker.js"></script>
    <script src="./Public/Admin/dist/js/main.js"></script>


    <link type="text/css" rel="stylesheet" href="./Public/Admin/css1/common.css">
    <link type="text/css" rel="stylesheet" href="./Public/Admin/css1/design.css">
    <link type="text/css" rel="stylesheet" href="./Public/Admin/css1/smallslider.css">


</head>
<body>
<div class="topbar">
    <div class="wrap iconlist">
        <div class="memberbox width-6">嗨！欢迎来到金猫银猫 <a href="#">请登录</a>  <a href="#">免费注册</a> </div>
        <div class="width-6">
            <a href="#"><i class="icon_heart icon_topbar"></i>我关注的品牌</a>
            <a href="#">金猫银猫会员</a>
            <a href="#"><i class="icon_shopcart icon_topbar"></i>购物车<span id="shopcart_count">0</span>件</a>
            <span class="fav">收藏夹<i class="icon icon_dropdown"></i></span> |
            <span><i class="icon_phone icon_topbar"></i>手机版</span>
            <span class="fav">商家支持<i class="icon icon_dropdown"></i></span>
            <span class="fav"><i class="icon_shopcart icon_topbar"></i>网站导航<i class="icon icon_dropdown"></i></span>
        </div>

    </div>
</div>




<div   id="header">
    <div class="wrap">

        <div class="logobar width-3">
            <a  href="../" title="返回首页" class="logo_design "></a>
        </div>

        <div id="searchbar" class="width-6">
            <form method="get" action="/product/">
                <input type="text" name="keywords" class="txt" value="" placeholder="站内搜索"/>
                <input type="submit" class="bt" value="搜索"/>
                <div class="clear"></div>
            </form>
        </div>


    </div>
</div>

<div style="clear:both"></div>
<div id="mainer">
    <div class="wrap2">
        <div class="box">
            <div class="t">选择定制设计师：</div>
            <div class="facelist">
                <div class="big">
                    <a><img src="./Public/Admin/pic/desing (50).jpg"></a>
                    <span>徐龙</span><br>
                    广东省 / 深圳市
                </div>
                <a href=""><img src="./Public/Admin/pic/desing (52).jpg"></a>
                <a href=""><img src="./Public/Admin/pic/desing (51).jpg"></a>
            </div>
            <div class="desc">
                <div class="jiao"></div>
                <div class="jiao2"></div>
                <h2>设计师简介 <span>在线</span></h2>
                几何线条造型、素银饰品 徐龙 设计风格回旋曲，多条旋律线的交错出现，形成若隐若现的状态。
                <a class="contact graybtn">在线沟通</a>
            </div>
            <div class="worklist">
                <h2>设计师作品</h2>
                <a><img src="./Public/Admin/pic/design (11).jpg"></a>
                <a><img src="./Public/Admin/pic/design (15).jpg"></a>
                <a><img src="./Public/Admin/pic/design (16).jpg"></a>
                <a><img src="./Public/Admin/pic/design (17).jpg"></a>
                <a><img src="./Public/Admin/pic/design (18).jpg"></a>
                <a><img src="./Public/Admin/pic/design (19).jpg"></a>
            </div>
            <div class="clear"></div>
        </div>

        <form action="<?php echo U('Order/add');?>" method="post">
            <div class="box ">
                <div class="t">设计需求</div>
                <div class="model_box_content">
                    <!--生日：<input placeholder="请输入日期" name="bir" class="laydate-icon"  id="dat" onclick="laydate()">-->

                    <?php if(is_array($goodsAttr)): $i = 0; $__LIST__ = $goodsAttr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$attr): $mod = ($i % 2 );++$i; if($attr["check"] == 5): ?><div>
                                <span class="designDescSpan blockBox"><?php echo ($attr["attr"]); ?>：</span>
                                <select id="designType" class="blockBox" name="<?php echo ($attr["attr"]); ?>">
                                    <?php if(is_array($attr["value"])): foreach($attr["value"] as $key=>$att): ?><option value=""><?php echo ($att); ?></option><?php endforeach; endif; ?>
                                </select>
                            </div>

                            <?php elseif($attr["check"] == 3): ?>
                            <div class="hasCheckBoxDiv">

                                <span class="designDescSpan"><?php echo ($attr["attr"]); ?>：</span>
                                <?php if(is_array($attr["value"])): foreach($attr["value"] as $key=>$att): ?><input type="radio" name="<?php echo ($attr["attr"]); ?>" id="des14" value=""><label for="des14"><?php echo ($att); ?></label><?php endforeach; endif; ?>
                            </div>

                            <?php elseif($attr["check"] == 4): ?>
                            <div class="hasCheckBoxDiv">
                                <span class="designDescSpan"><?php echo ($attr["attr"]); ?>：</span>
                                <?php if(is_array($attr["value"])): foreach($attr["value"] as $key=>$att): ?><input type="checkbox" name="<?php echo ($attr["attr"]); ?>[]" value=""><label><?php echo ($att); ?></label><?php endforeach; endif; ?>
                            </div>

                            <?php elseif($attr["check"] == 2): ?>
                            <div class="specLine"></div>
                            <div>
                                <span class="designDescSpan"><?php echo ($attr["attr"]); ?>：</span>
                                <input placeholder="请输入日期" name="<?php echo ($attr["attr"]); ?>" class="laydate-icon"  id="dat" onclick="laydate()">
                            </div>

                            <?php elseif($attr["check"] == 1): ?>
                            <div class="specLine"></div>
                            <div>
                                <span class="designDescSpan"><?php echo ($attr["attr"]); ?>：</span>
                                <textarea class="designerDesc4" type="text" name="<?php echo ($attr["attr"]); ?>" alt="" value=""></textarea>
                            </div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                </div>
            </div>

            <div class="box ">
                <div class="t">收货人信息：</div>
                <div class="model_box_content">
                    <div class="specLine"></div>
                    <div id="pleaseTitle">
                        请留下您的联系方式：
                    </div>
                    <div class="model_box_line">
                        <div class="designerBox">
                            <span class="designerDescTitle">&nbsp;&nbsp;&nbsp;&nbsp;&emsp;&emsp;姓名：</span>
                            <input class="designerDesc4" type="text" name="user_name" alt="" value="">
                        </div>
                    </div>
                    <div class="model_box_line">
                        <div class="designerBox">
                            <span class="redWord">*</span>
                            <span class="designerDescTitle">联系电话：</span>
                            <input class="designerDesc4" type="text" name="user_telephone" alt="" value="">
                        </div>
                    </div>


                    <div class="form-inline">
                        <div data-toggle="distpicker">
                            <div class="form-group">
                                <span class="designerDescTitle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;联系地址：</span>
                                <label class="sr-only" for="province1">Province</label>
                                <select class="form-control" name="province1" id="province1"></select>
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="city1">City</label>
                                <select class="form-control" name="city1" id="city1"></select>
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="district1">District</label>
                                <select class="form-control" name="district1" id="district1"></select>
                            </div>
                        </div>
                    </div>


                    <div class="model_box_line">
                        <div class="designerBox4">
                            <span class="designerDescTitle">详细地址：</span>
                            <input class="designerDesc4" type="text" name="user_address" alt="" value="">
                        </div>
                    </div>
                    <div class="model_box_line">
                        <div class="designerBox">
                            <span class="designerDescTitle">&emsp;购买数量：</span>
                            <input class="designerDesc4" type="text" name="amount" alt="" value="1">
                        </div>

                    </div>
                    <div class="hasCheckBoxDiv">
                        <span class="designDescSpan">支付方式：</span>

                        <input checked="checked" type="radio" name="user_pay" id="used1" value="1"><label for="used1">支付宝</label>

                        <input type="radio" name="user_pay" id="used2" value="2"><label for="used2">微信</label>

                        <input type="radio" name="user_pay" id="used3" value="3"><label for="used3">银联</label>

                    </div>
                    <input type="submit" value="提交订单">
                </div>
            </div>
        </form>
    </div>

</div>
<div id="footer" >
    <div class="wrap">
        <div class="line"></div>
        <div class="help">
            <dl class="width-2">
                <dt>购物指南</dt>
                <dd><a href="<?php echo ($prefix); ?>article/?id=<?php echo ($v["id"]); ?>">购买流程</a></dd>
                <dd><a href="<?php echo ($prefix); ?>article/?id=<?php echo ($v["id"]); ?>">支付方式</a></dd>
            </dl>
            <dl class="width-2">
                <dt>购物保障</dt>
                <dd><a href="<?php echo ($prefix); ?>article/?id=<?php echo ($v["id"]); ?>">购买流程</a></dd>
                <dd><a href="<?php echo ($prefix); ?>article/?id=<?php echo ($v["id"]); ?>">支付方式</a></dd>
            </dl>
            <dl class="width-2">
                <dt>售后服务</dt>
                <dd><a href="<?php echo ($prefix); ?>article/?id=<?php echo ($v["id"]); ?>">购买流程</a></dd>
                <dd><a href="<?php echo ($prefix); ?>article/?id=<?php echo ($v["id"]); ?>">支付方式</a></dd>
            </dl>
            <dl class="width-2">
                <dt>关于我们</dt>
                <dd><a href="<?php echo ($prefix); ?>article/?id=<?php echo ($v["id"]); ?>">购买流程</a></dd>
                <dd><a href="<?php echo ($prefix); ?>article/?id=<?php echo ($v["id"]); ?>">支付方式</a></dd>
            </dl>
            <dl class="width-4">
                <dt>手机上金猫银猫</dt>
                <dd><a href="<?php echo ($prefix); ?>article/?id=<?php echo ($v["id"]); ?>">购买流程</a></dd>
                <dd><a href="<?php echo ($prefix); ?>article/?id=<?php echo ($v["id"]); ?>">支付方式</a></dd>
            </dl>


            <div style="clear:both"></div>
        </div>
        <!-- help -->
    </div>
    <!-- copyright -->
    <div class="copyright">
        <p class="copy wrap">
            <a href="#">关于金猫银猫</a>
            <a href="#">帮助中心</a>
            <a href="#">诚聘英才</a>
            <a href="#">联系我们</a>
            <a href="#">网站合作</a>
            <a href="#">法律声明</a>
            <a href="#">廉政举报</a><br>
            <a href="#">京东商城</a> |
            <a href="#">中国白银网</a> |
            <a href="#">央视网</a> |
            <a href="#">1号店</a> |
            <a href="#">京东商城</a> |
            <a href="#">中国白银网</a> |
            <a href="#">央视网</a> |
            <a href="#">1号店</a> <br>

            <a href="http://www.csmall.com/help.do?page=help_help_icp" target="_blank"  >中国增值电信业务经营许可证 B2-20140169号</a>
            <span style="line-height:1.5;"> | ©2014深圳银瑞吉文化发展有限公司 All Rights Reserved | 国家信息产业部粤ICP备14018586号</span>
            <span class="powerby">技术支持：<a href="http://www.jentian.com/" target="_blank" title="广东井田云科技有限公司">井田云</a>
                            <br>
                            <a href="http://si.trustutn.org/info?sn=131141223010513021410" target="_blank"><img src="http://v.trustutn.org/images/cert/bottom_small_img.png" alt="实名认证" title="实名认证"></a>
                        </span>
        </p>
    </div>

    <div class="clear"></div>
</div>
<script>
    (function () {
        $('.nav_list dl:odd').addClass("odd");
        $('#flashbox').smallslider();

    })();
</script>

</body>
</html>