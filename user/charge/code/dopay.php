<?php   
  	header("Content-type:text/html;charset=utf-8");
  	$money=$_POST["money"];
	$inmoney=$_POST["inmoney"];
	$openid=$_POST["openid"];
  	$yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
    $orderSn = $yCode[intval(date('Y')) - 2011] . strtoupper(dechex(date('m'))) . date('d') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf('%02d', rand(0, 99));
    $trans_date = date('Y-m-d');
    $trans_time = time();
    $addmoney=($inmoney-$money)/100;
    require_once("db.php"); 
    $sql1 = "select * from user  where openId='".$openid."'";
    $result1= mysql_query($sql1);
    $row1 = mysql_fetch_array($result1);
    $leftmoney=$row1['balance'];
    $userId=$row1['userId'];
    $userName=$row1['userName'];
    $tel = $row1['tel'];   
    $nowmoney=$leftmoney+$inmoney/100;
    $remoney=$money/100;
	$sql2 = "update user set balance = '".$nowmoney."' where openId='".$openid."'"; 
    $result2= mysql_query($sql2);
    $sql_order1 = "insert into orders(orderId, transDate, transTime, transAmt, userId, userName, tel, orderType, channel, serviceId, orderStatus, addmoney) values
                            ('".$orderSn."','".$trans_date."' ,'".$trans_time."' ,'".$remoney."' ,'".$userId."','".$userName."', '".$tel."', '0', '1','0','2','".$addmoney."')";
    $result_create_order1 = mysql_query($sql_order1);
    return "success";
?>