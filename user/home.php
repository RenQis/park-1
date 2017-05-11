<?php
require_once("db.php");
$openid=$_GET["openid"]; 
$sql1 = "select * from user  where openId='".$openid."'";
$result1= mysql_query($sql1);
$row1 = mysql_fetch_array($result1);
$tel=$row1['tel'];
$leftmoney=$row1['balance'];
         
?> 
<!DOCTYPE html>
<html>
    <head>
        <title>中山公园会员中心</title>
    	<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv='content-type' content="text/html;charset=utf-8"/>
    	<link rel="stylesheet" href="http://lib.sinaapp.com/js/jquery-mobile/1.3.1/jquery.mobile-1.3.1.min.css" /> 
        <link rel="stylesheet" href="./css/weui.css"/>
        <link rel="stylesheet" href="./css/weuix.css"/>
       	<link rel="stylesheet" href="./css/weui2.css"/>
        <link rel="stylesheet" href="./css/weui3.css"/>
      
        <script src="./js/zepto.min.js"></script>
        <style>

            img{
                width:80%;
                height: auto;
                max-width: 100%;
                display: block;
                margin-right: 10%;
                margin-left: 10%
            }
        </style>
    	<script src="http://lib.sinaapp.com/js/jquery/1.9.1/jquery-1.9.1.min.js"> </script> 
    	<script src="http://lib.sinaapp.com/js/jquery-mobile/1.3.1/jquery.mobile-1.3.1.min.js"> </script> 
    </head>


<body>
    <!-- 加载图片，并设置为自适应-->
        <div class="weui-panel">
            <img src="img/vip.JPG">
        </div>

        <!-- 设置会员首部-->
        <div class="weui-panel weui-panel_access"">
            <a href="javascript:void(0);" class="weui-media-box weui-media-box_appmsg">
               <!--  <div class="weui-media-box__hd" >
                    <img class="weui-media-box__thumb" src="./img/logo_park.png" alt="">
                </div> -->
                <div class="weui-media-box__bd">
                    <h5 class="weui-media-box__title">尊敬的会员: <?php echo $tel;?> 您好！</h5>

                </div>
            </a>
        </div>

        <!-- 添加卡余额和电子券按钮-->
        <div class="weui_panel">
            <div class="weui_panel_bd">
                <div class="weui_media_box weui_media_small_appmsg">
                    <div class="weui_cells weui_cells_access">
                        <a class="weui_cell" a href="<?php echo "./charge/code/recharge.php?openid=".$openid; ?>" name="card" id="card" data-ajax="false">
                            <div class="weui_cell_hd"><i class="icon icon-43" style="width:25px;margin-right:10px;display:block"></i></div>
                            <div class="weui_cell_bd weui_cell_primary">
                                <p> 我的余额</p>
                            </div>
                            <span class="weui_cell_ft"><?php echo $leftmoney;?>元</span>
                        </a>
                        <a class="weui_cell" href="card.php?openid=<?php echo $openid; ?>" name="recharge" id="recharge" data-ajax="false">
                            <div class="weui_cell_hd"><i class="icon icon-106" style="width:25px;margin-right:10px;display:block"></i></div>
                            <div class="weui_cell_bd weui_cell_primary">
                                <p> 我的卡券</p>
                            </div>
                            <span class="weui_cell_ft">3张</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- 使用电子券 -->
        <!-- 在线充值 -->

 <div class="weui_panel">
            <div class="weui_panel_hd">支付功能</div>
            <div class="weui_panel_bd">
                <div class="weui_media_box weui_media_small_appmsg">
                    <div class="weui_cells weui_cells_access">
                        <a class="weui_cell" a href="code.php?openid=<?php echo $openid; ?> " name="card" id="card" data-ajax="false">
                            <div class="weui_cell_hd"><i class="icon icon-25" style="width:25px;margin-right:10px;display:block"></i></div>
                            <div class="weui_cell_bd weui_cell_primary">
                                <p> 扫码支付 </p>
                            </div>
                            <span class="weui_cell_ft"></span>
                        </a>
                        <a class="weui_cell" href="<?php echo "./charge/code/recharge.php?openid=".$openid; ?>" name="recharge" id="recharge" data-ajax="false">
                            <div class="weui_cell_hd"><i class="icon icon-2" style="width:25px;margin-right:10px;display:block"></i></div>
                            <div class="weui_cell_bd weui_cell_primary">
                                <p> 在线充值</p>
                            </div>
                            <span class="weui_cell_ft"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- 查询： 消费明细查询和充值记录查询 -->
         <div class="weui_panel">
            <div class="weui_panel_hd">查询中心</div>
            <div class="weui_panel_bd">
                <div class="weui_media_box weui_media_small_appmsg">
                    <div class="weui_cells weui_cells_access">
                        <a class="weui_cell" href="custom_query.php?openid=<?php echo $openid; ?>" name="consumeinfo" id="consumeinfo" data-ajax="false">
                            <div class="weui_cell_hd"><i class="icon icon-67" style="width:25px;margin-right:10px;display:block"></i></div>
                            <div class="weui_cell_bd weui_cell_primary">
                                <p>消费明细查询</p>
                            </div>
                            <span class="weui_cell_ft"></span>
                        </a>
                        <a class="weui_cell" href="recharge_query.php?openid=<?php echo $openid; ?>" name="recharge" id="recharge" data-ajax="false">
                            <div class="weui_cell_hd"><i class="icon icon-81" style="width:25px;margin-right:10px;display:block"></i></div>
                            <div class="weui_cell_bd weui_cell_primary">
                                <p>充值记录查询</p>
                            </div>
                            <span class="weui_cell_ft"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="weui-footer">
            <p class="weui-footer-links">
                <a href="javascript:;" class="weui-footer-link">武汉市中山公园 </a>
            </p>
            <p class="weui-footer__text">Copyright &copy; 2017 Wuhan ZhongShan Park</p>
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