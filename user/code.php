<?php
    require_once("db.php");
    $openid=$_GET["openid"]; 
    $sql1 = "select * from user  where openId='".$openid."'";
    $result1= mysql_query($sql1);
    $row1 = mysql_fetch_array($result1);
    $userId=$row1['userId'];
    $userName=$row1['userName'];
    $tel = $row1['tel'];
    $trans_date = date('Y-m-d');
    $trans_time = time();

    /*
    * henry生成订单号并创建订单，设置订单状态为待支付
    *
    */
    //1.生成订单号
    $yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
    $orderSn = $yCode[intval(date('Y')) - 2011] . strtoupper(dechex(date('m'))) . date('d') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf('%02d', rand(0, 99));
    //2.写sql语句在订单库中插入一条数据
    $sql_order = "insert into orders(orderId, transDate, transTime, transAmt, userId, userName, tel, orderType, channel, serviceId, orderStatus) values
            ('".$orderSn."','".$trans_date."' ,'".$trans_time."' ,'0','".$userId."','".$userName."', '".$tel."', '0', '0','0','0')";

    $result_create_order = mysql_query($sql_order);
    //echo $sql_order;
    if (!$result_create_order) {
        # code...
        echo "error!";
    }
    //3.监听二维码是否被扫描，如果是则产生两笔流水，如果未被扫码则删除订单

    //4.如果二维码被扫描成功，交易完成，产生两笔流水，一笔给用户扣款，另一笔给系统虚拟账号加钱




?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
        <title>扫码支付</title>
        <link rel="stylesheet" href="./css/weui.css"/>
        <link rel="stylesheet" href="./css/weuix.css"/>
        <link rel="stylesheet" href="./css/weui2.css"/>
        <link rel="stylesheet" href="./css/weui3.css"/>
        
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <!-- <script src="./js/zepto.min.js"></script> -->
        
       
        <style>
            img{
                width: 80%;
                margin: auto;
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
            <div class="weui-panel weui-panel_access" >
                    <div style="margin-top: 5px;">     
                    <a href="home.php??openid=<?php echo $openid; ?>" style="margin-left: 20px;"><i class="icon icon-27" data-ajax = "false" ></i></a>
                        
                    <label style="margin-left: 140px;">刷卡消费</label>
                    <a href="##" class = "weui_cell_ft" style="margin-left: 140px;"><i class="icon icon-126"></i></a>
                    </div>                    	
            </div>
                <br/>
            
            <!-- 会员卡支付-->
    
            <div class="panel">
               
               <div id="qrcodeimg" class='tcenter' style="width:90%; margin:auto;"></div>
            </div>

            <div class="weui_panel weui-footer weui-footer-fixed-bottom">
                <p>温馨提示：为了您的支付安全，支付码每三分钟自动更新</p>
            </div>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
        <script src="./js/bootstrap.min.js"></script>
        <script src="./js/zepto.min.js"></script>
        <script type="text/javascript" src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
        <script src="https://res.wx.qq.com/open/libs/weuijs/1.0.0/weui.min.js"></script>
        <script src="./js/example.js"></script>
        <script type="text/javascript" src="./js/qrcode.js"></script>
        <script type="text/javascript">
            var txt="{\"orderSn\":<?php echo $orderSn ?>,\"userId\":<?php echo $userId ?>}" ;
            // $("#qr").click(function(){
                // $("#qrcodeimg").empty().qrcode({render:"image",ecLevel:"L",size:300,background:"#fff",fill:"#000",text:txt});
                $("#qrcodeimg").empty();
                new QRCode(document.getElementById("qrcodeimg"), {
                    text: txt,
                    width: 128,
                    height: 128,
                    colorDark : "#000000",
                    colorLight : "#ffffff",
                    correctLevel : QRCode.CorrectLevel.H
                });
            // });
        </script>
    </body>
</html>