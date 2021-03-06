<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh" lang="zh">
<head>
    <title><?php echo ($product_info['title']); ?>| 颖和茶业官方商城</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="description" content="&lt;div style=&quot;width: 790.0px; padding-bottom: 40.0px;&quot;&gt;
&lt;div style=&quot;text-align: center; padding-bottom: 40.0px; border-bottom-color: #ffffff; border-bottom-width: 1.0px; border-bottom-style: solid; background-color: #fbfbfb;&quot;&gt;&lt;img src=&quot;http://img04.taobaoc" />
    <meta name="keywords" content="<?php echo ($product_info['title']); ?>" />
    <meta name="robots" content="INDEX,FOLLOW" />
    <link rel="icon" href="http://www.8ma.net/skin/frontend/default/bamatea/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="http://www.8ma.net/skin/frontend/default/bamatea/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="/Public/css/bama/calendar-win2k-1.css" />
    <link rel="stylesheet" type="text/css" href="/Public/css/bama/basic.css" media="all" />
    <link rel="stylesheet" type="text/css" href="/Public/css/bama/style.css" media="all" />
    <link rel="stylesheet" type="text/css" href="/Public/css/bama/lightness.custom.css" media="all" />
    <link rel="stylesheet" type="text/css" href="/Public/css/bama/cloud.zoom.css" media="all" />
    <link rel="stylesheet" type="text/css" href="/Public/css/bama/buyrecords.css" media="all" />
    <link rel="stylesheet" type="text/css" href="/Public/css/bama/print.css" media="print" />
    <script type="text/javascript" src="/Public/js/bama/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="/Public/js/bama/jquery.tools.min.js"></script>
    <script type="text/javascript" src="/Public/js/bama/cookies.js"></script>
    <script type="text/javascript" src="/Public/js/bama/js.js"></script>
    <script type="text/javascript" src="/Public/js/bama/product.js"></script>
    <script type="text/javascript" src="/Public/js/bama/calendar.js"></script>
    <script type="text/javascript" src="/Public/js/bama/calendar-setup.js"></script>
    <script type="text/javascript" src="/Public/js/bama/hover.js"></script>
    <script type="text/javascript" src="/Public/js/bama/slider.js"></script>
    <script type="text/javascript" src="/Public/js/bama/form.js"></script>
    <script type="text/javascript" src="/Public/js/bama/jquery-ui-1.8.15.custom.min.js"></script>
    <script type="text/javascript" src="/Public/js/bama/rew_box.js"></script>
    <script type="text/javascript" src="/Public/js/bama/cloud.zoom.js"></script>
    <!--[if lt IE 8]>
    <link rel="stylesheet" type="text/css" href="http://www.8ma.net/skin/frontend/base/default/css/styles-ie.css" media="all" />
    <![endif]-->
</head>
<body class=" catalog-product-view catalog-product-view product-ab037 categorypath-tea-dahongpao-html category-dahongpao">

<div id="header">
    <div class="container">
        <div style="position:absolute; left:50px; top:0"></div>
        <h1><a href="#" title="颖和官方商城" class="logo">颖和官方商城</a></h1>
        <div class="topnav">
            <div class="headcart" id="minicart">

                <span class="bnt"><a href="http://www.8ma.net/checkout/cart/"><div id="div1">购物车</div></a></span>

                <div class="cart-content">
                    <div class="empty"id ='div2'>您的购物车中暂无商品，赶快选择心爱的商品吧！</div>
                    <div class="empty"id="div3"></div>

                </div>
            </div>

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

                function addToCart(obj){
                    var product_num = $('#qty').val();
                    var product_id = "<?php echo ($product_info['product_id']); ?>";
                    $.ajax({
                        type:"post",
                        url:"<?php echo U('Home/message/ajax_add_cart');?>",
                        data:"product_id="+product_id+"&product_num="+product_num,
                        dataType:"json",
                        success:function(res){
                            $.each(res,function(n,value){
                                $("#div1").text(value['total_num']).css({"color":"red"});
                                $("#div2").text(value['title']+' * '+value['product_num']).css({"color":"red"});
                            });


                        }
                    });
                }

                function Buy_now(obj){
                    var product_num = $('#qty').val();

                    var product_id  = "<?php echo ($product_info['product_id']); ?>";
                    var url = "<?php echo U('Home/Message/buy_now');?>?product_id="+product_id+'&product_num='+product_num;
                    window.location =url;
                }

            </script>




            <ul class="links">
                <li class="first" ><a href="http://www.8ma.net/customer/account/create/" title="注册" class='reg'><span>注册</span></a></li>
                <li ><a href="http://www.8ma.net/customer/account/login/referer/aHR0cDovL3d3dy44bWEubmV0L2NhdGFsb2cvcHJvZHVjdC92aWV3L2lkLzY2MTgvY2F0ZWdvcnkvMTIvP19fX1NJRD1V/" title="登录" class='login'><span>登录</span></a></li>
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
                <li><a href="http://www.8ma.net/rewardpoints/exchange/"><img src="/Public/css/bama/images/mn_bamavip.png" alt="" width="93" height="36" /></a></li>
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
        <div class="breadcrumbs">
            <ul>

                <li class="product">
                    <strong><?php echo ($product_info['title']); ?></strong>
                </li>
            </ul>
        </div>
        <script type="text/javascript">
            var optionsPrice = new Product.OptionsPrice([]);
        </script>

        <div id="messages_product_view"></div>
        <div class="product-view">
            <div class="product-essential clearfix">
                <form action="#" method="post"
                      id="product_addtocart_form">
                    <div class="no-display">
                        <input type="hidden" name="product" value="6618"/>
                        <input type="hidden" name="related_product" id="related-products-field" value=""/>
                    </div>
                    <div class="product-shop">
                        <h1 class="clearfix"><?php echo ($product_info['title']); ?>                    <em><?php echo ($product_info['subhead']); ?></em><br/>
                            <span>品牌：颖和</span><span>商品编号：AB037					</span></h1>
                        <ul class="pro_v_list">
                            <li>

                            <li class="Pricesss clearfix">

                                <div class="price-box">
                                    <p class="old-price"><span class="price-label">原价：</span><span class="price" id="old-price-6618">￥<?php echo ($product_info['old_price']); ?></span></p>
                                    <p class="special-price"><span class="price-label">特价：</span><span class="price" id="product-price-6618">￥<?php echo ($product_info['new_price']); ?></span></p>
                                </div>

                            </li>

                            <li class="availability in-stock">库存: <span>现货</span></li>
                            </li>
                            <li class="clearfix"></li>
                            <li class="item">重量：<?php echo ($product_info['weight']); ?>克</li>

                            <li class="item">  <div class="ratings clearfix">
                                <span class="bfL">商品评分：</span>
                                <p class="no-rating"><a href="#comment" onclick="javascript:$('#comment').trigger('click');">第一个评论该商品</a></p>
                            </div></li>

                            <li class="item add-to-box">

                                <div class="add-to-cart">
                                    <label for="qty">我要买:</label>
                                    <input type="text" name="qty" id="qty" maxlength="12" value="1" title="数量：" class="input-text qty" /> 件
                                </div>
                                <div class="item add-to-cart" id="error_msg"></div>
                                <div class="cart_Bnt_buy"><input type="button"  value="立即购买" title="立即购买" class="btn-cart"  onclick="Buy_now()"/> </div>
                                <div class="cart_Bnt"><input type="button"  value="加入购物车" title="加入购物车" class="btn-cart" onclick="addToCart()" /></div>



                                <ul class="add-to-links">
                                    <li><a href="http://www.8ma.net/wishlist/index/add/product/6618/" class="link-wishlist">加入收藏</a></li>
                                    <li class="compare"> <a href="http://www.8ma.net/catalog/product_compare/add/product/6618/uenc/aHR0cDovL3d3dy44bWEubmV0L3RlYS9kYWhvbmdwYW8vYWIwMzcuaHRtbA,,/" class="link-compare">加入比较</a></li>
                                </ul>
                            </li>
                            <li class="item pay">支付方式：礼节卡/支付宝/网银/转账汇款</li>
                        </ul>
                    </div>
                    <div class="product-img-box"> <script type="text/javascript">
                        //<![CDATA[
                        function jSelectImage(id) {
                            $("#zoom img").attr("src", $("#thumb"+id).attr("rel")).attr("title", $("#thumb"+id+" img").attr("title"));
                            if ($("#zoom").data("zoom")) {
                                $("#zoom").data("zoom").destroy();
                            };
                            $("#zoom").attr("href", $("#thumb"+id).attr("href")).CloudZoom();
                        }
                        //]]>
                    </script>
                        <div id="imageDiv" style="width:410px;">
                            <a href='/Public/tea/001.jpg' class='cloud-zoom' id='zoom' rel="'zoomWidth':'auto','zoomHeight':'auto','position':'right','adjustX':'0','adjustY':'0','lensOpacity':'0.5','smoothMove':'3','showTitle':'true','titleOpacity':'0.5'">
                                <img id="image" src="/Public/tea/001.jpg" alt='八马茶业 大红袍 乌龙茶一级武夷岩茶大红袍茶叶 新茶圆罐散装80g' style="both:410px" title="" />
                            </a>
                        </div>

                        <div class="more-views" style="display:block">
                            <span class="next" id="btn_prev"></span>
                            <span class="next" id="btn_next"></span>
                            <div class="product_s_images">
                                <ul>
                                    <li>
                                        <a href="/Public/tea/10001/big.jpg" class="" rel="/Public/tea/10001/midle.jpg" id="thumb0" onclick="jSelectImage('0'); return false;">
                                            <img src="/Public/tea/10001/001.jpg" alt="" title="" />
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/Public/tea/10001/big.jpg" class="" rel="/Public/tea/10001/midle.jpg" id="thumb1" onclick="jSelectImage('1'); return false;">
                                            <img src="/Public/tea/10001/001.jpg" alt="" title="" />
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/Public/tea/10001/big.jpg" class="" rel="/Public/tea/10001/midle.jpg" id="thumb2" onclick="jSelectImage('2'); return false;">
                                            <img src="/Public/tea/10001/001.jpg" alt="" title="" />
                                        </a>
                                    </li>
                                    <!--<li>-->
                                        <!--<a href="http://www.8ma.net/media/catalog/product/i/m/img_6052.jpg" class="" rel="http://www.8ma.net/media/catalog/product/cache/1/image/410x410/9df78eab33525d08d6e5fb8d27136e95/i/m/img_6052.jpg" id="thumb3" onclick="jSelectImage('3'); return false;">-->
                                            <!--<img src="http://www.8ma.net/media/catalog/product/cache/1/thumbnail/80x/9df78eab33525d08d6e5fb8d27136e95/i/m/img_6052.jpg" alt="" title="" />-->
                                        <!--</a>-->
                                    <!--</li>-->
                                    <!--<li>-->
                                        <!--<a href="http://www.8ma.net/media/catalog/product/i/m/img_6053.jpg" class="" rel="http://www.8ma.net/media/catalog/product/cache/1/image/410x410/9df78eab33525d08d6e5fb8d27136e95/i/m/img_6053.jpg" id="thumb4" onclick="jSelectImage('4'); return false;">-->
                                            <!--<img src="http://www.8ma.net/media/catalog/product/cache/1/thumbnail/80x/9df78eab33525d08d6e5fb8d27136e95/i/m/img_6053.jpg" alt="" title="" />-->
                                        <!--</a>-->
                                    <!--</li>-->
                                    <!--<li>-->
                                        <!--<a href="http://www.8ma.net/media/catalog/product/i/m/img_6054.jpg" class="" rel="http://www.8ma.net/media/catalog/product/cache/1/image/410x410/9df78eab33525d08d6e5fb8d27136e95/i/m/img_6054.jpg" id="thumb5" onclick="jSelectImage('5'); return false;">-->
                                            <!--<img src="http://www.8ma.net/media/catalog/product/cache/1/thumbnail/80x/9df78eab33525d08d6e5fb8d27136e95/i/m/img_6054.jpg" alt="" title="" />-->
                                        <!--</a>-->
                                    <!--</li>-->
                                    <!--<li>-->
                                        <!--<a href="http://www.8ma.net/media/catalog/product/i/m/img_6051.jpg" class="" rel="http://www.8ma.net/media/catalog/product/cache/1/image/410x410/9df78eab33525d08d6e5fb8d27136e95/i/m/img_6051.jpg" id="thumb6" onclick="jSelectImage('6'); return false;">-->
                                            <!--<img src="http://www.8ma.net/media/catalog/product/cache/1/thumbnail/80x/9df78eab33525d08d6e5fb8d27136e95/i/m/img_6051.jpg" alt="" title="" />-->
                                        <!--</a>-->
                                    <!--</li>-->
                                </ul>
                            </div>
                        </div>
                        <script type="text/javascript">
                            //<![CDATA[

                            (function(){

                                var btn_next = $('#btn_next');

                                var btn_prev = $('#btn_prev')

                                var ul = btn_next.next().find('ul');


                                ul.find('li').bind({
                                    click: function() {
                                        $(this).parent().find('li').removeClass('on');
                                        $(this).parent().data('index', $(this).index());
                                        $(this).addClass('on');
                                        jSelectImage($(this).index());
                                    },
                                    mouseover: function () {
                                        $(this).parent().find('li').removeClass('on');
                                        $(this).addClass('on');
                                        if ($(this).index() != $(this).parent().data('index'))
                                            $(this).parent().find('li').eq($(this).parent().data('index')).addClass('on');
                                    },
                                    mouseout: function () {
                                        if ($(this).index() != $(this).parent().data('index'))
                                            $(this).removeClass('on');
                                    }
                                });
                                ul.find('li:first').trigger('click');

                                var len = ul.find('li').length;
                                if(len <5){
                                    $("span.next").hide();
                                }

                                var i = 0 ;

                                if (len > 4) {



                                    ul.css("width", 88 * len)

                                    btn_next.click(function(e) {

                                        if(i>=len-4){return;}

                                        i++;

                                        moveS(i);

                                        e.preventDefault();

                                        $(this).removeClass("on");

                                    }).mouseover(function(e) {

                                        //if (!this.enab)  return;

                                        $(this).addClass("on");

                                    }).mouseout(function(e) {

                                        //if (!this.enab)  return;

                                        $(this).removeClass("on");

                                    });



                                    btn_prev.click(function(e) {

                                        if(i<=0){return;}

                                        i--;

                                        moveS(i);

                                        e.preventDefault();

                                        $(this).removeClass("on");

                                    }).mouseover(function(e) {
                                        //if (!this.enab)  return;

                                        $(this).addClass("on");


                                    }).mouseout(function(e) {

                                        //if (!this.enab)  return;

                                        $(this).removeClass("on");

                                    });

                                }

                                function moveS(i) {

                                    ul.animate({marginLeft:-88 * i}, 500)

                                }

                            })();


                            //]]>
                        </script>



                    </div>
                </form>
                <script type="text/javascript">
                    //<![CDATA[
                    var productAddToCartForm = $('#product_addtocart_form').validator();
                    productAddToCartForm.submit = function () {
                        if (productAddToCartForm.data("validator").checkValidity()) {
                            $('#product_addtocart_form')[0].submit();
                        }
                    }
                    //]]>
                </script>
            </div>
            <div class="product-collateral clearfix">
                <div class="col-sub" style="float: left; margin-right: 10px;">

                    <div class="box-collateral box-up-sell">
                        <h2>您也许会喜欢下面的商品</h2>
                        <div class="upsell mini_prolist" id="upsell-product-table">

                            <?php if(is_array($product_suggest)): foreach($product_suggest as $key=>$vo): ?><dl>
                                <dt><a href="<?php echo U('Home/message/show_msg');?>?product_id=<?php echo ($vo["product_id"]); ?>" title="<?php echo ($vo["title"]); ?>" class="product-image"><img src="/Public/tea/<?php echo ($vo["product_id"]); ?>/mini.jpg" alt="八马 历炼系列 大红袍老茶 450克" /></a></dt>
                                <dd class="product-name"><a href="<?php echo U('Home/message/show_msg');?>?product_id=<?php echo ($vo["product_id"]); ?>" title="<?php echo ($vo["title"]); ?>"><?php echo ($vo["title"]); ?></a></h3></dd>
                                <dd>
                                    <div class="price-box">

                                        <p class="orede-rprice"><span class="price-label">价格：</span><span class="price" id="product-price-6441-upsell"><?php echo ($vo["new_price"]); ?></span></p>

                                    </div>
                                </dd>

                            </dl><?php endforeach; endif; ?>



                        </div>
                        <script type="text/javascript">decorateTable('upsell-product-table')</script>
                    </div>
                    <div class="widget widget-static-block"></div>
                </div>

                <div class="col-main">
                    <div class="detail-tabs ">
                        <ul class="title idtabs">
                            <li id="description"><span>产品描述</span></li>
                            <li id="baozhang"><span>品质保障</span></li>
                            <li id="comment"><span>客户评论</span></li>
                            <li id="leave-message"><span>客户咨询</span></li>

                        </ul>
                        <dl class="detail-cont">
                            <dd class="description item" style="display: block;">
                                <div class="des">
                                    <div style="width: 790.0px; padding-bottom: 40.0px;">
                                        <div style="text-align: center; padding-bottom: 40.0px; border-bottom-color: #ffffff; border-bottom-width: 1.0px; border-bottom-style: solid; background-color: #fbfbfb;"><img src="http://img04.taobaocdn.com/imgextra/i4/688187172/TB2NWmsXVXXXXXVXpXXXXXXXXXX-688187172.jpg" alt="八马 赛珍珠 铁观音 乌龙 安溪铁观音" /><br /> <br />
                                            <div style="padding: 50.0px; text-align: center; color: #000000; line-height: 32.0px; font-family: microsoft yahei; font-size: 32.0px;">八马&bull;大红袍<br />
                                                <div style="text-align: center; color: #000000; line-height: 22.0px; padding-top: 15.0px; font-family: microsoft yahei; font-size: 16.0px;">大红袍属于半发酵茶类乌龙茶，是闽北乌龙的一种，大红袍具有&ldquo;岩韵&rdquo;，浓厚醇和，耐泡持久，采用传统的乌龙茶加工工艺，汤色清澈味甘爽，兼有红茶的甘醇、绿茶的清香。茶性和而不寒，久藏不坏，香高味醇。</div>
                                                <br /> <span style="color: #990000; font-size: 24.0px;">&mdash;&mdash;高性价比，自饮首选！&mdash;&mdash;</span><br /> <br /> &nbsp;</div>
                                            <div style="padding-bottom: 45.0px;"><img src="http://img04.taobaocdn.com/imgextra/i4/688187172/TB2r6WWXVXXXXaXXXXXXXXXXXXX-688187172.jpg" alt="" width="790" height="527" /></div>
                                            <table border="0" cellspacing="0" cellpadding="0" width="100%">
                                                <tbody>
                                                <tr>
                                                    <td style="width: 42.0%; text-align: left; color: #333333; line-height: 25.0px; padding-left: 45.0px; font-size: 14.0px;" align="left" valign="top">【品名】八马&middot;大红袍<br /> 【等级】一级<br /> 【产地】福建省南平市武夷山<br /> 【外形】条索粗壮紧结，乌褐油润有光泽<br /> 【口感】滋味醇厚，有岩韵<br /> 【尺寸】10*10*7.5cm<br /> 【产品标准号】GB/T18745-2006</td>
                                                    <td style="text-align: left; color: #333333; line-height: 25.0px; padding-right: 40.0px; padding-left: 20.0px; font-size: 14.0px;" align="left" valign="top">【编码】AB037<br /> 【包装】罐装<br /> 【香味】浓郁烘焙香，和淡淡兰花香<br /> 【汤色】橙红清澈<br /> 【净含量】80g<br /> 【保质期】36个月<br /> 【生产许可证号】QS350714010222</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <img src="http://img02.taobaocdn.com/imgextra/i2/688187172/TB2Qa5WXVXXXXcYXXXXXXXXXXXX-688187172.jpg" alt="" width="790" height="490" />
                                        <table border="0" cellspacing="0" cellpadding="0" width="100%" background="http://img04.taobaocdn.com/imgextra/i4/688187172/TB2pTKVXVXXXXamXpXXXXXXXXXX-688187172.jpg">
                                            <tbody>
                                            <tr>
                                                <td style="width: 100.0%; height: 493.0px;" width="100%" valign="top">
                                                    <div style="text-align: left; line-height: 43.0px; padding-top: 55.0px; padding-left: 30.0px; font-family: microsoft yahei; font-size: 43.0px;">干茶</div>
                                                    <div style="text-align: left; line-height: 22.0px; padding-top: 10.0px; padding-left: 33.0px; font-family: microsoft yahei; font-size: 16.0px;">条形完整，青绿偏墨绿色，<br /> 部分转为褐色，白色芽头显现</div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <table border="0" cellspacing="0" cellpadding="0" width="100%" background="http://img03.taobaocdn.com/imgextra/i3/688187172/TB2ZyeWXVXXXXaJXXXXXXXXXXXX-688187172.jpg">
                                            <tbody>
                                            <tr>
                                                <td style="width: 100.0%; height: 525.0px; border-top-color: #ffffff; border-bottom-color: #ffffff; border-top-width: 1.0px; border-bottom-width: 1.0px; border-top-style: solid; border-bottom-style: solid;" width="100%" valign="top">
                                                    <div style="text-align: right; color: #ffffff; line-height: 43.0px; padding-top: 100.0px; padding-right: 30.0px; font-family: microsoft yahei; font-size: 43.0px;">汤色&amp;滋味</div>
                                                    <div style="text-align: right; color: #ffffff; line-height: 22.0px; padding-top: 10.0px; padding-right: 33.0px; font-family: microsoft yahei; font-size: 16.0px;">清新黄绿色，透亮明澈<br /> 入口香醇浓郁，捎有轻微普洱之苦涩，回甘生津</div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <table border="0" cellspacing="0" cellpadding="0" width="100%" background="http://img03.taobaocdn.com/imgextra/i3/688187172/TB2e7eWXVXXXXX_XXXXXXXXXXXX-688187172.jpg">
                                            <tbody>
                                            <tr>
                                                <td style="width: 100.0%; height: 493.0px;" width="100%" valign="top">
                                                    <div style="text-align: left; color: #ffffff; line-height: 43.0px; padding-top: 280.0px; padding-left: 30.0px; font-family: microsoft yahei; font-size: 43.0px;">叶底<span style="text-align: right; line-height: 22.0px; padding-right: 15.0px; font-family: microsoft yahei; font-size: 16.0px;">黄绿偏暗，成条形，柔韧有弹性</span></div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <table border="0" cellspacing="0" cellpadding="0" width="100%" background="http://img04.taobaocdn.com/imgextra/i4/688187172/TB2xzGWXVXXXXaeXXXXXXXXXXXX-688187172.jpg">
                                            <tbody>
                                            <tr>
                                                <td style="width: 100.0%; height: 975.0px;" width="100%" valign="top">
                                                    <div style="text-align: left; color: #000000; line-height: 43.0px; padding-top: 40.0px; padding-left: 30.0px; font-family: microsoft yahei; font-size: 43.0px;">包装</div>
                                                    <div style="text-align: left; color: #000000; line-height: 22.0px; padding-top: 10.0px; padding-left: 30.0px; font-family: microsoft yahei; font-size: 16.0px;">10*10*7.5cm<br /> 经典马口铁盒罐装，密封性极佳，紧锁茶叶醇香。</div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>    </div>
                            </dd>
                            <dd class="baozhang item"></dd>
                            <dd class="comment item gray"><div class="box-collateral box-reviews box-views" id="customer-reviews">
                                只有登录用户允许发表评论. <br/>

                            </div>
                            </dd>
                            <dd class="leave-message item gray"><div class="box-collateral box-leavemessages" id="customer-leavemessages">
                                <div id="rew_box_messages">
                                    <form action="http://www.8ma.net/leavemessage/product/post/id/6618/" method="post" id="leavemessage-form">
                                        <div class="form-add clearfix">             <h3>您正在咨询:                <span>八马茶业 大红袍 乌龙茶一级武夷岩茶大红袍茶叶 新茶圆罐散装80g</span></h3>
                                            <ul class="form-list">
                                                <li>
                                                    <label for="nickname_field">昵称</label>

                                                    <div class="input-box">
                                                        <input type="text" name="nickname" id="nickname_field" class="input-text required-entry"
                                                               value="" validata="required:true"/>
                                                        <span class="prompt-msg" message=""></span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <label for="summary_field">标题</label>

                                                    <div class="input-box">
                                                        <input type="text" name="title" id="summary_field" class="input-text required-entry"
                                                               value="" validata="required:true">
                                                        <span class="prompt-msg" message=""></span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <label for="review_field">内容</label>

                                                    <div class="input-box">
                        <textarea name="content" id="review_field" cols="5" rows="3" class="required-entry"
                                  validata="required:true"></textarea>
                                                        <span class="prompt-msg" message=""></span>
                                                    </div>

                                                </li>
                                                <li>
                                                    <label for="nickname_field">验证码</label>

                                                    <div class="input-box">
                                                        <input type="text" name="secure_code" id="securecode_field" class="input-text required-entry"
                                                               validata="required:true" style="width: 80px" />
                                                        <a tabindex="-1" style="border-style: none" href="#" title="Refresh Image"
                                                           onclick="document.getElementById('secure_image').src = 'http://www.8ma.net/leavemessage/product/generalImage/'+'sid='+ Math.random();return false;">
                                                            <img id="secure_image" style=" margin-bottom: -8px"
                                                                 src="http://www.8ma.net/leavemessage/product/generalImage/sid/a9d5bc2667825d73aa783ebd41ed5518/"/>
                                                        </a>
                                                        <span class="prompt-msg" message=""></span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <button type="submit" title="提交咨询" class="button">
                                                        <span><span>提交咨询</span></span></button>
                                                </li>
                                            </ul>
                                        </div>
                                    </form>
                                </div>
                                <script type="text/javascript">
                                    //<![CDATA[
                                    makingware.form.getInstance('#leavemessage-form', {
                                        error: {
                                            required: '必填'
                                        }
                                    }).submit(function() {
                                        return $(this).data('this').isValidata();
                                    });


                                    //]]>
                                </script>
                            </div>
                            </dd>
                            <dd class="buy-records item gray"><div class="box-collateral box-buyrecords" id="customer-buyrecords">
                                没有购买记录！
                            </div>
                            </dd>
                        </dl>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        Mage.Cookies.set('external_no_cache', 1);
    </script>
</div>
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