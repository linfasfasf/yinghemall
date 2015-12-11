<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh" lang="zh">
<head>
    <title>购物车 | 八马茶业官方商城</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="description" content="八马茶业的官方商城，品质保证！八马网上商城提供八马铁观音，普洱，红茶，龙井，绿茶，花茶，大红袍，茶食品，茶具等全线产品的线上销售服务。" />
    <meta name="keywords" content="八马，网上商城，八马网上商城，铁观音，普洱，红茶，大红袍，绿茶，龙井，碧螺春，花茶，茉莉花茶，茶业礼盒，茶业直销，八马商城，八马茶叶，八马茶业" />
    <meta name="robots" content="INDEX,FOLLOW" />
    <link rel="icon" href="http://www.8ma.net/skin/frontend/default/bamatea/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="http://www.8ma.net/skin/frontend/default/bamatea/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="/Public/css/bama/basic.css" media="all" />
    <link rel="stylesheet" type="text/css" href="/Public/css/bama/style.css" media="all" />
    <link rel="stylesheet" type="text/css" href="/Public/css/bama/lightness.custom.css" media="all" />
    <link rel="stylesheet" type="text/css" href="/Public/css/bama/print.css" media="print" />
    <script type="text/javascript" src="/Public/js/bama/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="/Public/js/bama/jquery.tools.min.js"></script>
    <script type="text/javascript" src="/Public/js/bama/cookies.js"></script>
    <script type="text/javascript" src="/Public/js/bama/js.js"></script>
    <script type="text/javascript" src="/Public/js/bama/product.js"></script>
    <script type="text/javascript" src="/Public/js/bama/hover.js"></script>
    <script type="text/javascript" src="/Public/js/bama/slider.js"></script>
    <script type="text/javascript" src="/Public/js/bama/form.js"></script>
    <script type="text/javascript" src="/Public/js/bama/jquery-ui-1.8.15.custom.min.js"></script>
    <!--[if lt IE 8]>
    <link rel="stylesheet" type="text/css" href="http://www.8ma.net/skin/frontend/base/default/css/styles-ie.css" media="all" />
    <![endif]-->
</head>
<body class=" checkout-cart-index">

<script type="text/javascript">

    $.ajax({
        type:"get",
        url:"<?php echo U('Home/message/get_cart_info_ajax');?>",
        dataType:"json",
        success:function(res){
            $.each(res,function(key,value){
                $("#div1").text(value['total_num']).css({"color":"red"});
                $("#div2").text(value['title']+' * '+value['product_num']).css({"color":"red"});

            });
        }
    });


</script>
<div id="header">
    <div class="container">
        <div style="position:absolute; left:50px; top:0"></div>
        <h1><a href="<?php echo U('Home/Index/index');?>" title="颖和官方商城" class="logo">颖和官方商城</a></h1>
        <div class="topnav">
            <div class="headcart" id="minicart">

                <span class="bnt"><a href="http://www.8ma.net/checkout/cart/"><div id="div1">购物车</div></a></span>

                <div class="cart-content">

                    <div class="empty"id ='div2'>您的购物车中暂无商品，赶快选择心爱的商品吧！</div>
                    <div class="empty"id="div3"></div>




                </div>
            </div>


            <ul class="links">
                <li class="first" ><a href="http://www.8ma.net/customer/account/create/" title="注册" class='reg'><span>注册</span></a></li>
                <li ><a href="http://www.8ma.net/customer/account/login/referer/aHR0cDovL3d3dy44bWEubmV0L2NoZWNrb3V0L2NhcnQvaW5kZXgvP19fX1NJRD1V/" title="登录" class='login'><span>登录</span></a></li>
                <li class=" last" ><a href="http://www.8ma.net/upcard/query/" title="礼节卡查询" target='_blank'><span>礼节卡查询</span></a></li>
            </ul>

            <div class="tel400"></div>
        </div>
        <div class="mainnav">
            <ul class="lefta">
                <li><a href="http://www.8ma.net/">首页</a></li>
                <li><a class="link10" href="http://www.8ma.net/tea/tieguanyin.html"><span> 铁观音</span></a></li>

            </ul>
            <ul class="righta">
                <li><a href="http://www.8ma.net/rewardpoints/exchange/"><img src="http://www.8ma.net/skin/frontend/default/bamatea/images/mn_bamavip.png" alt="" width="93" height="36" /></a></li>
            </ul>

        </div>

        <div class="topnews"> <a class="bfL bnt" href="http://www.8ma.net/news" title="商城公告">商城公告</a>
            <ul class="newstoplist bfL">
            </ul>	</ul>
            <script type="text/javascript">
                function AutoScroll(obj){
                    $(obj).find("ul:first").animate({
                        marginTop:"-21px"
                    },500,function(){
                        $(this).css({marginTop:"0px"}).find("li:first").appendTo(this);
                    });
                }
                $(document).ready(function(){
                    setInterval('AutoScroll(".topnews")',4000)
                });
            </script>
        </div>

    </div>
</div>
<div id="main">
    <div class="container">
        <div class="clearfix">
            <ul class="shopcar_guid">
                <li class="stp1"><span>1.我的购物车</span></li>
                <li class="stp2"><span>2.填写核对订单信息</span></li>
                <li class="stp3"><span>3.成功提交订单</span></li>
            </ul>
        </div>
        <div id="cart-container">
            <div class="cartpage clearfix">
                <h2 class="step-title">购物车</h2>
                <form id="cart-form" action="javascript:void(0);" method="post">
                    <table id="shopping-cart-table" class="cart-table">
                        <col width="80"/>
                        <col/>
                        <col width="80"/>
                        <col width="100"/>
                        <col width="80"/>
                        <col width="60"/>
                        <thead>
                        <tr>
                            <th><span class="table_first">图片</span></th>
                            <th><span class="nobr">商品名称</span></th>
                            <th>单价(元)</th>
                            <th>数量</th>
                            <th>小计(元)</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(is_array($product_info)): foreach($product_info as $key=>$info): ?><tr>
                                <td><a href="<?php echo U('Home/Message/show_msg');?>?product_id=<?php echo ($info['product_id']); ?>" title="<?php echo ($info['title']); ?>">
                            <span class="table_first img"><img src="/Public/tea/<?php echo ($info['product_id']); ?>/mini.jpg" alt="<?php echo ($info['title']); ?>" />
                            </span></a></td>
                                <td><dl class="product_row">
                                    <dt class="product-name">
                                        <a href="<?php echo U('Home/Message/show_msg');?>?product_id=<?php echo ($info['product_id']); ?>"><?php echo ($info['title']); ?></a>
                                        <input type="hidden" value="0" name="cart[49974][wishlist]" />
                                    </dt>

                                </td>
                                <td>
            <span class="cart-price2">
            <span class="price">￥<?php echo ($info['new_price']); ?></span>		</span>
                                </td>

                                <td class="s-amount">
                                    <a class="minus" href="javascript:void(0);">-</a>
                                    <input type="text" name="cart[49974][qty]" id="car_num" value="<?php echo ($session_info[$info['product_id']]['product_num']); ?>" size="1000" title="数量" class="input-text qty" maxlength="12" />
                                    <a class="plus" href="javascript:void(0);">+</a>
                                </td>
                                <td>
            <span class="cart-price1">
            <span class="price"><div id="num_<?php echo ($info['product_id']); ?>">￥<?php echo ($pay_num); ?></div></span>		</span>
                                </td>
                                <td>
                                    <a href="http://www.8ma.net/checkout/cart/delete/id/49974/uenc/aHR0cDovL3d3dy44bWEubmV0L2NoZWNrb3V0L2NhcnQv/" title="删除记录" class="btn-remove2">
                                        删除商品		</a>
                                </td>
                            </tr><?php endforeach; endif; ?>
                        </tbody>
                        <tfoot></tfoot>
                    </table>
                </form>
                <div class="cart-table clearfix" style="border: none; margin: 0 0 15px; ">
                    <div class="clear">
                        <b class="icon icon_clear"></b>
                        <a class="btn-continue" href="#" onclick="location.href='http://www.8ma.net/checkout/cart/clear/'">清空购物车</a>
                    </div>
                    <div class="totals">
                        <dl>
                            <table id="shopping-cart-totals-table">
                                <col />
                                <col width="1" />
                                <tfoot>
                                <dd class="totle">
                                    总额 (不含运费):
                                    <strong>
                                        <span><span class="price"><div id="total_num">￥<?php echo ($pay_num); ?></div></span></span>
                                    </strong>
                                </dd>    </tfoot>
                            </table>             </dl>
                        <div class="checkout-types">
                            <a href="#" class="btn_common" onclick="setLocation('http://www.8ma.net/')">继续购物</a>
                            <input class="btn-checkout" onclick="javascript:checkoutLinkDialog();" value="结 帐" />
                        </div>
                        <p class="gre">如果您有优惠券/礼品卡，请在下一步结账过程中使用</p>
                    </div>
                    <script type="text/javascript">decorateTable('shopping-cart-table')</script>
                </div>
                <div class="cart-collaterals"></div>
            </div>
        </div>

        <div id="loading" style="display:none"><div class="item">&nbsp;</div></div>
        <script type="text/javascript">
            //<![CDATA[

            (function($){

                var product_num = <?php echo ($session_info[$info['product_id']]['product_num']); ?>;
                var product_id  = <?php echo ($info['product_id']); ?>;
                $("#loading").ajaxStart(function(){
                    $(this).dialog({modal: true, closeOnEscape: false,stack: false, dialogClass: 'alert'});
                    $("#send_order").attr("disabled","disabled");

                }).ajaxStop(function(){
                    $(this).dialog('close');
                    $("#send_order").removeAttr("disabled");
                });

                $("#cart-form .minus").live('click', function(){
                    var qty = $(this).siblings('.qty');
                    var amount = parseInt(qty.val()) - 1;
                    if (amount > 0) {
                        qty.val(amount).trigger('change');
                    }
                    return false;
                });

                $("#cart-form .plus").live('click', function(){
                    var qty = $(this).siblings('.qty');
                    qty.val(parseInt(qty.val()) + 1);
//                    product_num++;
                    alert(product_num);
                    $.ajax({
                        type:"get",
                        url:"<?php echo U('Home/Message/modify_ajax');?>",
                        data:"product_id="+product_id+"&product_num="+product_num,
                        dataType:"json",
                        success:function(res){
                            $.each(res,function(n,value){
                                alert(value);
                                $("#num_<?php echo ($info['product_id']); ?>").text(value);
                            });
                        }
                    });

                    return false;
                });



                $('#shopping-cart-table tbody tr .s-amount .qty').live('change', function(){
                    var formEl = $("#cart-form");
                    if (formEl.size()) {
                        $.post("http://www.8ma.net/checkout/cart/modify/", formEl.serialize(), function(json){
                            if(json){json = $.parseJSON(json);}else{json = {};}
                            if (json.error) {
                                alertDialog(json.error);
                                return ;
                            }
                            if (json.html) {
                                $("#cart-container").html(json.html);
                            }
                        });
                    }
                });
            })(jQuery);
            //]]>
        </script>	</div>
</div>
<div id="footer">
    <div class="container clearfix">
        <div class="bamatea_links"><a  href="http://www.bamatea.com/" target="_blank">官方网站</a> | <a rel="nofollow" href="http://e.weibo.com/bmtea" target="_blank" >八马官方微博</a> | <a href="http://www.bamatea.com/tea.php" target="_blank">八马茶学堂</a></div>		<div class="newbie clearfix">
        <div class="newbie_left ">
            <dl class="help0">
                <dt>新手帮助</dt>
                <dd><a href="http://www.8ma.net/help/zhinan#Q1" title="注册新用户">注册新用户</a></dd>
                <dd><a href="http://www.8ma.net/help/zhinan#Q3" title="网站订购流程">网站订购流程</a></dd>
                <dd><a href="http://www.8ma.net/help/coupon_code#Q2" title="网站订购流程">使用优惠券</a></dd>
            </dl>
            <dl class="help1">
                <dt>如何付款/退款</dt>
                <dd><a href="http://www.8ma.net/help/pay#Q1" title="支付方式">支付方式</a></dd>
                <dd><a href="http://www.8ma.net/help/pay#Q2" title="发票制度说明">发票制度说明</a></dd>
            </dl>
            <dl class="help2">
                <dt>配送方式</dt>
                <dd><a href="http://www.8ma.net/help/shipping#Q1" title="配送方式及费用">配送方式及费用</a></dd>
                <dd><a href="http://www.8ma.net/help/shipping#Q2" title="发货时间">发货时间</a></dd>
            </dl>
            <dl class="help3">
                <dt>售后服务</dt>
                <dd><a href="http://www.8ma.net/help/service#Q1" title="退换货政策">退换货政策</a></dd>
                <dd><a href="http://www.8ma.net/help/service#Q3" title="如何办理退换货">如何办理退换货</a></dd>
            </dl>
            <dl class="help4">
                <dt>帮助中心</dt>
                <dd><a href="http://www.8ma.net/club" title="八马会员">八马会员</a></dd>
                <dd><a href="http://www.bamatea.com" title="八马官网" target="_blank">八马官网</a></dd>
            </dl>
            <div class="del_float"></div>
        </div>
        <div class="newbie_right">
            <dl>
                <dt>服务热线（24小时）</dt>
                <dd>4008-828-528</dd>
            </dl>
            <div class="del_float"></div>
        </div>
        <div class="del_float"></div>
    </div>
        <img src="http://www.8ma.net/skin/frontend/default/bamatea/images/baozhang.gif" alt="">
        <div class="yq_link clearfix"><strong>友情链接：</strong> <div><p><a rel="nofollow" href="http://bama.yhd.com/" target="_blank">八马茶业1号店</a>&nbsp;&nbsp;&nbsp; <a rel="nofollow" href="http://d6.yihaodianimg.com/N02/M05/78/65/CgQCsFMZXfuAfAJVAAomVPgEKq830200.jpg" target="_blank">ICP证粤B2-20130146</a></p>
            <script src="https://cert.ebs.org.cn/icon/ce9f593b-093c-4602-bda4-35e53cb86ddd-140-50.html" type="text/javascript"></script>
            &nbsp;
            <script id="ebsgovicon" src="https://cert.ebs.gov.cn/govicon.js?id=CE9F593B-093C-4602-BDA4-35E53CB86DDD&amp;width=100&amp;height=137&amp;type=1" type="text/javascript"></script></div> </div>
        <div class="copyright" style="position:relative; text-align: center"  >


            <div class="copyright_a"><a href="http://www.8ma.net/help/salenet" title="八马全国销售网点">八马全国销售网点</a> | <a href="http://www.8ma.net/help/about">关于我们</a> | <a href="http://www.8ma.net/help/privacy-policy">法律声明</a> | <a href="http://www.8ma.net/help/service#Q1ccn">服务条款</a> | <a href="http://www.8ma.net/contacts/">意见反馈</a> | <a href="http://www.8ma.net/help/contact">联系我们</a> </div>

            <div class="copyright_b" style="margin-bottom: 10px">Copyright 2008-2011 8ma.net Incoporated, All rights reserved<br>
                八马茶业连锁有限公司版权所有 &nbsp;- <a href="http://www.miitbeian.gov.cn">粤ICP备10089578号-1</a>  <span style="color: #999">Powered by <a href="http://www.makingware.com" target="_blank"  style="color: #999">Makingware</a></span> </div>
            <div> <script src="http://www.ebs.gov.cn/Validate/IconProcess.aspx?domainid=CE9F593B-093C-4602-BDA4-35E53CB86DDD&show=pic&width=140&height=50" type="text/javascript"></script>
                <img src="http://www.8ma.net/skin/frontend/default/bamatea/images/ico_cmb.jpg" height="53" style="margin: 0  10px">
                <script type="text/javascript" language="javascript" src="http://cert.ebs.org.cn/icon/CE9F593B-093C-4602-BDA4-35E53CB86DDD-140-50.html"></script></div>

        </div>

    </div>
</div>
<div id="customer">
    <div class="customerbox">
        <h2>在线客服</h2>
        <p>TEL:15394416200</p>
        <p>营业时间:9:00&mdash;1:00&nbsp;&nbsp;</p>
        <p><a href="http://wpa.qq.com/msgrd?v=3&amp;uin=785015650&amp;site=qq&amp;menu=yes" target="_blank"><img title="测试" src="http://wpa.qq.com/pa?p=2:785015650:4" border="0" alt="QQ客服1" />测试</a> <br />
            <a href="http://wpa.qq.com/msgrd?v=3&amp;uin=254430304&amp;site=qq&amp;menu=yes" target="_blank"><img title="测试" src="http://wpa.qq.com/pa?p=2:254430304:4" border="0" alt="QQ客服1" />测试</a>
    </div>
    <div class="btn"></div>
</div>
<script language='javascript' src='http://www.8ma.net/skin/frontend/default/bamatea/js/scrolltopcontrol.js' type='text/javascript' charset='utf-8'></script>
<script type="text/javascript">
    var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
    document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F08d7f06ae730b27439f71885b41a5ecb' type='text/javascript'%3E%3C/script%3E"));
</script>

<div id="errorblock" style="display:none; overflow:hidden;">
    <b class="icon icon_msg4 icon_msg4_warn"></b>
    <h4 class="layer_global_tit"></h4>
    <div class="wrap_btn">
        <a class="btn_strong closeerror" href="javascript:void(0);" role="button">确定</a>
    </div>
</div>
<div id="global_dialog" style="display:none; overflow:hidden;"></div>
<script type="text/javascript">
    //<![CDATA[
    (function($){
        $(function(){
            $("#global_dialog").dialog({
                autoOpen: false,
                draggable: false,
                modal: true
            });

            $("#errorblock").dialog({
                autoOpen: false,
                modal: true,
                width: 450,
                dialogClass: 'erroralert',
                title: '提醒'
            }).find(".closeerror").click(function(){
                $(this).parent().parent().dialog('close');
            });

            window.alertDialog = function(msg){
                $("#errorblock .layer_global_tit").html(msg);
                $("#errorblock").dialog('open');
            };

            window.loginDialog = function(){
                var $dialog = $("#global_dialog").dialog('option', {width:450, height:260, title:'登陆'});
                var html = $dialog.data('login_data');
                if (html) {
                    $dialog.html(html).dialog('open');
                }else {
                    $dialog.load("http://www.8ma.net/customer/account/loginmini/", function(html){
                        $dialog.data('login_data', html).dialog('open');
                    });
                }
            };

            window.checkoutLinkDialog = function(){
                var $dialog = $("#global_dialog").dialog('option', {width: 580, height: 280,title: '登陆'});
                var html = $dialog.data('checkout_link_data');
                if (html) {
                    $dialog.html(html).dialog('open');
                }else {
                    $dialog.load("http://www.8ma.net/checkout/cart/link/", function(html){
                        $dialog.data('checkout_link_data', html).dialog('open');
                    });
                }
            };
        });
    })(jQuery);
    //]]>
</script></body>
</html>