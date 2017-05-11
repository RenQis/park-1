<?php
$openid=$_GET["openid"];
require_once("db.php"); 
$sql1 = "select * from user  where openId='".$openid."'";
$result1= mysql_query($sql1);
$row1 = mysql_fetch_array($result1);
$leftmoney=$row1['balance'];
?>
<script type="text/javascript">
function changemoney(money){
	document.getElementById('moneynum').value=money;
}
function call(){
    var moneyn = $("#moneynum").val();
    var inmoney;
    if(moneyn==10000)
    	inmoney=12000;
    else if(moneyn==20000)
    	inmoney=25000;
    else if(moneyn==40000)
    	inmoney=50000;
    else if(moneyn==70000)
    	inmoney=100000;
    else if(moneyn==100000)
    	inmoney=150000;
    else
    	inmoney=moneyn;
	window.location.href="jsapi.php?moneynum="+moneyn+"&openid=<?php echo $openid;?>&inputmoney="+inmoney; 
}
</script>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
        <title>在线充值</title>
        <link rel="stylesheet" href="./css/weuix.css"/>
        <link rel="stylesheet" href="./css/weui.css"/>
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
    </head>
    <body ontouchstart style="background-color: #f8f8f8;">
   
        <div class="weui_cells">
        <!-- 我的余额 -->
        
            <div  style="text-align: center;">
            	<br>
                <h4>我的余额</h4>
                <h2><?php echo $leftmoney;?></h2>
                <br>
            </div>
        </div>

        <!-- 充值金额 -->
        <input type="text" id="moneynum" name="moneynum" hidden="true" value="10000" />
        <div class="page-header">
            <h4>请选择充值金额</h4>
        </div>
        
    	<div class="weui-grids weui_cells" style="margin-left: 5%;margin-right:5%;" id="tab6">
            <a href="javascript:changemoney(10000);" class="weui-grid">
                <p class="weui-grid__label">100元</p>
                <p class="weui-grid__label">赠送20元</p>
            <a href="javascript:changemoney(20000);" class="weui-grid">
                <p class="weui-grid__label">200元</p>
                <p class="weui-grid__label">赠送50元</p>
            </a>
            <a href="javascript:changemoney(40000);" class="weui-grid">
                <p class="weui-grid__label">400元</p>
                <p class="weui-grid__label">赠送100元</p>
            </a>
            <a href="javascript:changemoney(70000);" class="weui-grid">
                <p class="weui-grid__label">700元</p>
                <p class="weui-grid__label">赠送300元</p>
            </a>
            <a href="javascript:changemoney(100000);" class="weui-grid">
                <p class="weui-grid__label">1000元</p>
                <p class="weui-grid__label">赠送500元</p>
            </a>
            <!-- <a href="javascript:changemoney(500000);" class="weui-grid">
                <p class="weui-grid__label">5000元</p>
                <p class="weui-grid__label">赠送2500元</p>
            </a> -->
        </div>      
    </div>
        <!-- 确认支付 -->
        <br>
            <div class="page__bd page__bd_spacing">
                <a href="javascript:call();" class="weui-btn weui-btn_primary">立即充值</a>
            </div>
            <div class="page__bd page__bd_spacing">
                <span class="weui-agree__text " style="text-align:center;">
                                   点击立即充值，即表示您已同意<a href="javascript:void(0);">《充值协议》</a>
            </span>
                
            </div>
            
        <script type="text/html" id="tpl_msg_success">

                <div class="weui-msg">
                    <div class="weui-msg__icon-area"><i class="weui-icon-success weui-icon_msg"></i></div>
                    <div class="weui-msg__text-area">
                        <h2 class="weui-msg__title">操作成功</h2>
                        <p class="weui-msg__desc">内容详情，可根据实际需要安排，如果换行则不超过规定长度，居中展现<a href="javascript:void(0);">文字链接</a></p>
                    </div>
                    <div class="weui-msg__opr-area">
                        <p class="weui-btn-area">
                            <a href="./home.html" class="weui-btn weui-btn_primary">推荐操作</a>
                            <a href="javascript:history.back();" class="weui-btn weui-btn_default">辅助操作</a>
                        </p>
                    </div>
                    <div class="weui-msg__extra-area">
                        <div class="weui-footer">
                            <p class="weui-footer__links">
                                <a href="javascript:void(0);" class="weui-footer__link">武汉市中山公园</a>
                            </p>
                            <p class="weui-footer__text">Copyright &copy; 2017 Wuhan University</p>
                        </div>
                    </div>
                </div>

        </script>
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