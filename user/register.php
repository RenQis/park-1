<?php
error_reporting(0);
$code=$_GET["code"];
$url='https://api.weixin.qq.com/sns/oauth2/access_token?appid=wxf5fb40fcb80f3a1f&secret=379e25efe3a7803dd6ab1eaad7d2ff3f&code='.$code.'&grant_type=authorization_code';
$data=file_get_contents($url);
$arr = json_decode($data,true);
$access_token=$arr['access_token'];
$openid=$arr['openid'];
$userinfo='https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$openid.'&lang=zh_CN';
$user=file_get_contents($userinfo);
$json = json_decode($user,true);
$nickname=$json['nickname'];
$city=$json['city'];
$headimgurl=$json['headimgurl'];
$headimgurl2=str_replace("/0", "/64",$headimgurl);
$ranknum=rand(100000,999999);
$regtime= date("Y-m-d H:i:s"); 
require_once("db.php");
$sql1 = "select * from user where openId='".$openid."'";
$result1 = mysql_query($sql1);
while($row1 = mysql_fetch_array($result1))
  {
   $arr1[]=$row1;
  } 

if(isset($arr1))
{
    
echo "<script language=javascript>;window.window.location.href='home.php?openid=$openid';</script>";
}

?>
<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <title>会员中心</title>
    <link rel="stylesheet" href="./css/weuix.css"/>
   
    <link rel="stylesheet" href="./css/weui2.css"/>
    <link rel="stylesheet" href="./css/weui3.css"/>    
    <script src="./js/zepto.min.js"></script>
    <script type="text/javascript" src="./js/swipe.js"></script>
    <script src="./js/picker.js"></script>
    <script src="./js/picker-city.js"></script>

  
    <style>
        img{
            width:100%;
            height: auto;
            max-width: 100%;
            display: block;
        }
        #_title{
            align-content: center;
        }
    </style>

</head>
<script language="javascript"> 

	function check() 	{  

		if (document.getElementById('tel').value.length == 0) {  
		alert("请输入您的手机号!"); 
		document.myform.tel.focus(); 
		return false; 
		}    
		if (document.myform.code.value !=<?php echo $ranknum;?> ) {  
		alert("验证码错误!"); 
		document.myform.code.focus(); 
		return false; 
		}    
		return true; 
	}
	function dogetcode() 
	{ 
	    if (document.getElementById('tel').value.length == 0) {  
		    alert("请输入您的手机号!"); 
		    document.myform.tel.focus();
		    return false;
	    }
	    var telphone = $("#tel").val();
	    $.ajax({
	        type: "POST",
	        url: "vercode.php",
	        dataType: "json",
	        async: false,
	        data: {"telphone":telphone,"ranknum":<?php echo $ranknum;?>}
	    });
	    alert("验证码已发送，请及时输入！");
	    document.getElementById("getcode").setAttribute("disabled", "true");
	}
</script> 
<body ontouchstart style="background-color: #f8f8f8;">

    <!-- 加载图片，并设置为自适应-->
    <div class="slide" id="slide2">
    <ul>
        <li>
            <a href="#">
                <img src="img/zsp1.png">
            </a>
           
        </li>
        <li>
            <a href="#">
                <img src="img/zsp2.png">
            </a>
            
        </li>
        <li>
            <a href="#">
                <img src="img/zsp3.png">
            </a>
            
        </li>
    </ul>
    <div class="dot">
        <span></span>
        <span></span>
        <span></span>
    </div>
    </div>
    <form id="myform" name="myform" action="apply.php?openid=<?php echo $openid;?>&vname=<?php echo $nickname;?>" method="post"  data-ajax="false" onsubmit = "return check();">
    <div class="weui_cells weui_cells_form">
            <div class="weui_cell">            
                 <div class="weui_cell_hd  weui_cell_primary">
                    <label for="tel" class="weui_label">手机号:</label>
                </div>
                <div class="weui_cell_bd weui_cell_primary">
                    <input class="weui_input" name="tel" id="tel" type="number" pattern="[0-9]*" placeholder="请输入号码"/>
                </div>
            </div>
    
        <!-- 请输入性别 -->
        <div class="weui_cell weui_cell_select weui_select_after">
                <div class="weui_cell_hd">
                    <label for="sex" class="weui_label">性别:</label>
                </div>
                <div class="weui_cell_bd weui_cell_primary">
                    <select class="weui_select" name="sex">
                        <option value="1">男</option>
                        <option value="2">女</option>
                        <option value="3">保密</option>
                    </select>
                </div>
        </div>
        <!-- 获取用户生日 -->
    
        <div class="weui_cell">
                <div class="weui_cell_hd"><label for="birthday" class="weui_label">生日:</label></div>
                <div class="weui_cell_bd weui_cell_primary">
                    <input class="weui_input" name="birthday" id="birthday" type="date" value=""/>
                </div>
        </div>
        
        <!-- 通过用户发送的验证码进行验证 -->
        <div class="weui_cell weui_vcode">
                <div class="weui_cell_hd"><label class="weui_label">验证码</label></div>
                <div class="weui_cell_bd weui_cell_primary">
                    <input class="weui_input" type="number" name="code" id="code" placeholder="请输入验证码"/>
                </div>
                <div class="weui_cell_ft">
                	<a href="javascript:dogetcode();" name="getcode" id="getcode" class="weui-vcode-btn">获取验证码</a>
                </div>
        </div>
    </div>
   
        <div class="weui_btn_area">
        	<input class="weui_btn weui_btn_primary" name="sub" id="sub" type="submit" value="会员登陆"> 
        </div> 
    </form>
   
   <script>
  $(function(){  	
		$('#slide1').swipeSlide({
		autoSwipe:true,//自动切换默认是
		speed:3000,//速度默认4000
		continuousScroll:true,//默认否
		transitionType:'cubic-bezier(0.22, 0.69, 0.72, 0.88)',//过渡动画linear/ease/ease-in/ease-out/ease-in-out/cubic-bezier
		lazyLoad:true,//懒加载默认否
		firstCallback : function(i,sum,me){
		            me.find('.dot').children().first().addClass('cur');
		        },
		        callback : function(i,sum,me){
		            me.find('.dot').children().eq(i).addClasns('cur').siblings().removeClass('cur');
		        }
		});

		$('#slide2').swipeSlide({
		autoSwipe:true,//自动切换默认是
		speed:3000,//速度默认4000
		continuousScroll:true,//默认否
		transitionType:'cubic-bezier(0.22, 0.69, 0.72, 0.88)',//过渡动画linear/ease/ease-in/ease-out/ease-in-out/cubic-bezier
		lazyLoad:true,//懒加载默认否
		firstCallback : function(i,sum,me){
		            me.find('.dot').children().first().addClass('cur');
		        },
		        callback : function(i,sum,me){
		            me.find('.dot').children().eq(i).addClass('cur').siblings().removeClass('cur');
		        }
		});
		$('#slide3').swipeSlide({
		autoSwipe:true,//自动切换默认是
		speed:3000,//速度默认4000
		continuousScroll:true,//默认否
		transitionType:'ease-in'
		});

			  
			  }); 
		$("#date").datetimePicker({title:"选择日期",m:1});
  
      </script>

</body>
</html>
