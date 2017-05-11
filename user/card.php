<!DOCTYPE html>
<html lang="zh-cmn-Hans" xmlns="http://www.w3.org/1999/html">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
        <title>WeUI</title>
        <link rel="stylesheet" href="./css/weui.css"/>
        <link rel="stylesheet" href="./css/weuix.css"/>
        <link rel="stylesheet" href="./css/weui2.css"/>
        <link rel="stylesheet" href="./css/weui3.css"/>
        
        <link rel="stylesheet" href="css/bootstrap.min.css">
        	<script src="./js/zepto.min.js"></script>
        <style>
            img{
                width:100%;
                height: auto;
                max-width: 100%;
                display: block;
            }

        </style>

    </head>
    <body ontouchstart style="background-color: #f8f8f8;">


            <!-- 加载图片，并设置为自适应-->
            <div class="weui-panel">
                <img src="img/vip.JPG">
            </div>
            <div class="weui-panel weui-panel_access" style="height:34px;">
                    <div style="margin-top: 5px;">     
                    <a href="home.php??openid=<?php echo $openid; ?>" style="margin-left: 10px;"><i class="icon icon-27"></i></a>
                        
                    <label style="margin-left: 120px;">刷卡消费</label>
                    <a href="##" style="margin-left: 120px;"><i class="icon icon-126"></i></a>
                    </div>
                    	

            </div>
                
            
            <!-- 会员卡支付-->
            <div class="panel">
                <div class="page-header" style="text-align: center; background-color: #1AAD19;">
                    <br>
                    <p><h3>中山公园微信电子会员卡</h3></p>
                </div>
                <div class="panel-body" style="text-align: center;">
                    <p><h4>动态支付码</h4></p>
                    <!-- 动态一维码-->

                    <div>
                        <img src="./img/code/2323141512.png" alt="">

                    </div>
                  

                </div>
                <br/>

                <div class="weui_panel weui-footer weui-footer-fixed-bottom">
                    <p>温馨提示：为了您的支付安全，支付码每三分钟自动更新</p>
                </div>
            </div>

        <div class="weui-footer">
            <p class="weui-footer-links">
                <a href="javascript:;" class="weui-footer-link">武汉市中山公园 </a>
            </p>
            <p class="weui-footer__text">Copyright &copy; 2017 Wuhan University</p>
        </div>


        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
        <script src="./js/bootstrap.min.js"></script>
        <script src="./js/zepto.min.js"></script>
        <script type="text/javascript" src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
        <script src="https://res.wx.qq.com/open/libs/weuijs/1.0.0/weui.min.js"></script>
        <script src="./js/example.js"></script>
    </body>
</html>