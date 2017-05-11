<?php 
ini_set('date.timezone','Asia/Shanghai');
//error_reporting(E_ERROR);
require_once "../lib/WxPay.Api.php";
require_once "WxPay.JsApiPay.php";
require_once 'log.php';

//初始化日志
$logHandler= new CLogFileHandler("../logs/".date('Y-m-d').'.log');
$log = Log::Init($logHandler, 15);

//打印输出数组信息
function printf_info($data)
{
    foreach($data as $key=>$value){
        echo "<font color='#00ff55;'>$key</font> : $value <br/>";
    }
}
$money=$_GET["moneynum"];
$inmoney=$_GET["inputmoney"];
$openid=$_GET["openid"];
//①、获取用户openid
	$tools = new JsApiPay();
	//②、统一下单
	$input = new WxPayUnifiedOrder();
	$input->SetBody("中山公园");
	$input->SetAttach("中山公园");
	$input->SetOut_trade_no(WxPayConfig::MCHID.date("YmdHis"));
	$input->SetTotal_fee($money);
	$input->SetTime_start(date("YmdHis"));
	$input->SetTime_expire(date("YmdHis", time() + 600));
	$input->SetGoods_tag("中山公园");
	$input->SetNotify_url("http://zhongshanpark.com.cn/user/charge/code/notify.php");
	$input->SetTrade_type("JSAPI");
	$input->SetOpenid($openid);
	$order = WxPayApi::unifiedOrder($input);
	$jsApiParameters = $tools->GetJsApiParameters($order);
//③、在支持成功回调通知中处理成功之后的事宜，见 notify.php
/**
 * 注意：
 * 1、当你的回调地址不可访问的时候，回调通知会失败，可以通过查询订单来确认支付是否成功
 * 2、jsapi支付时需要填入用户openid，WxPay.JsApiPay.php中有获取openid流程 （文档可以参考微信公众平台“网页授权接口”，
 * 参考http://mp.weixin.qq.com/wiki/17/c0f37d5704f0b64713d5d2c37b468d75.html）
 */
      
?>
    <script type="text/javascript">
	//调用微信JS api 支付
	function jsApiCall()
	{
		WeixinJSBridge.invoke(
			'getBrandWCPayRequest',
			<?php echo $jsApiParameters; ?>,
			function(res){
				WeixinJSBridge.log(res.err_msg);
				if(res.err_msg == "get_brand_wcpay_request:ok"){
                       window.location.href="re_sucess.php?openid=<?php echo $openid;?>";
                   }else{
                 
                       alert(支付失败);
                       window.location.href="re_fail.php?openid=<?php echo $openid;?>";
			     }
            }
		);
	}

	function callpay()
	{
		if (typeof WeixinJSBridge == "undefined"){
		    if( document.addEventListener ){
		        document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
		    }else if (document.attachEvent){
		        document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
		        document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
		    }
		}else{
		    jsApiCall();
		}
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
                <h4>您充值的金额为</h4>
                <h2><?php echo $money/100;?>元</h2>
                <h4>您得到的金额为</h4>
                <h2><?php echo $inmoney/100;?>元</h2>
                <br>
            </div>
        </div> 
    
    </div>
        <!-- 确认支付 -->
        <br>
            <div class="page__bd page__bd_spacing">
                <a href="javascript:callpay();" class="weui-btn weui-btn_primary">确认支付</a>
                
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