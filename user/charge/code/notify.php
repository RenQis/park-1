<?php
ini_set('date.timezone','Asia/Shanghai');
error_reporting(E_ERROR);

require_once "../lib/WxPay.Api.php";
require_once '../lib/WxPay.Notify.php';
require_once 'log.php';

//初始化日志
$logHandler= new CLogFileHandler("../logs/".date('Y-m-d').'.log');
$log = Log::Init($logHandler, 15);

class PayNotifyCallBack extends WxPayNotify
{
	//查询订单
	public function Queryorder($transaction_id)
	{
		$input = new WxPayOrderQuery();
		$input->SetTransaction_id($transaction_id);
		$result = WxPayApi::orderQuery($input);
		Log::DEBUG("query:" . json_encode($result));
		if(array_key_exists("return_code", $result)
			&& array_key_exists("result_code", $result)
			&& $result["return_code"] == "SUCCESS"
			&& $result["result_code"] == "SUCCESS")
		{
			return true;
		}
		return false;
	}
	
	//重写回调处理函数
	public function NotifyProcess($data, &$msg)
	{
		Log::DEBUG("call back:" . json_encode($data));
		$notfiyOutput = array();
		
		if(!array_key_exists("transaction_id", $data)){
			$msg = "输入参数不正确";
			return false;
		}
		//查询订单，判断订单真实性
		if(!$this->Queryorder($data["transaction_id"])){
			$msg = "订单查询失败";
			return false;
		}
		if ($data['return_code'] == 'SUCCESS'&&$data['result_code'] == 'SUCCESS') {
		$out_trade_no = $data['out_trade_no']; 
		$transaction_id = $data['transaction_id'];
		$amount = $data['total_fee']; 
		$openid = $data['openid'];
		require_once("db.php"); 
    	$sql1 = "select * from user  where openId='".$openid."'";
    	$result1= mysql_query($sql1);
    	$row1 = mysql_fetch_array($result1);
    	$leftmoney=$row1['balance'];
    	$userId=$row1['userId'];
    	$userName=$row1['userName'];
    	$tel = $row1['tel'];
    	$remoney=$amount/100;
    	if($remoney==100)
    		$addmoney=20;
    	else if($remoney==200)
    		$addmoney=50;
    	else if($remoney==400)
    		$addmoney=100;
    	else if($remoney==700)
    		$addmoney=300;
    	else if($remoney==1000)
    		$addmoney=500;
    	else
    		$addmoney=0;
    	$nowmoney=$leftmoney+$remoney+$addmoney;
    	$sql2 = "update user set balance = '".$nowmoney."' where openId='".$openid."'"; 
    	$result2= mysql_query($sql2);
    	$yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
    	$orderSn = $yCode[intval(date('Y')) - 2011] . strtoupper(dechex(date('m'))) . date('d') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf('%02d', rand(0, 99));
    	$serialSn2wx ="T" . strtoupper(dechex(date('m'))) . date('d') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf('%02d', rand(0, 99));
    	$serialSn2user ="T" . strtoupper(dechex(date('m'))) . date('d') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf('%02d', rand(0, 99));
    	$trans_date = date('Y-m-d');
    	$trans_time = time();

    	$sql_order1 = "insert into orders(orderId, transDate, transTime, transAmt, userId, userName, tel, orderType, channel, serviceId, orderStatus, addmoney, transid, tradeno) values
                            ('".$orderSn."','".$trans_date."' ,'".$trans_time."' ,'".$remoney."' ,'".$userId."','".$userName."', '".$tel."', '0', '1','0','2','".$addmoney."', '".$transaction_id."', '".$out_trade_no."')";
    	$result_create_order1 = mysql_query($sql_order1);
    	$sql_order2 = "insert into transSerial(serialId, transDate, transTime, transType, transStatus, openId, accountNo, serivceId, orderNo,transid, tradeno) values
                            ('".$serialSn2wx."','".$trans_date."' ,'".$trans_time."' ,'1' ,'2','".$openid."', '".$nowmoney."', '0', '".$orderSn."', '".$transaction_id."', '".$out_trade_no."')";
    	$result_create_order2 = mysql_query($sql_order2);
    	$sql_order3 = "insert into transSerial(serialId, transDate, transTime, transType, transStatus, openId, accountNo, serivceId, orderNo,transid, tradeno) values
                            ('".$serialSn2user."','".$trans_date."' ,'".$trans_time."' ,'1' ,'2','".$openid."', '".$nowmoney."', '0', '".$orderSn."', '".$transaction_id."', '".$out_trade_no."')";
    $result_create_order3 = mysql_query($sql_order3);
		}
		else{
			$yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
    		$orderSn = $yCode[intval(date('Y')) - 2011] . strtoupper(dechex(date('m'))) . date('d') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf('%02d', rand(0, 99));
			$openid = $data['openid'];
			$trans_date = date('Y-m-d');
    		$trans_time = time();
			require_once("db.php"); 
    		$sql = "select * from user  where openId='".$openid."'";
    		$result= mysql_query($sql);
    		$row = mysql_fetch_array($result);
    		$userId=$row['userId'];
    		$userName=$row['userName'];
    		$tel = $row['tel'];
			$sql_order4 = "insert into orders(orderId, transDate, transTime, transAmt, userId, userName, tel, orderType, channel, serviceId, orderStatus, addmoney) values
                            ('".$orderSn."','".$trans_date."' ,'".$trans_time."' ,'0' ,'".$userId."','".$userName."', '".$tel."', '0', '1','0','3','0')";
            $result_create_order4 = mysql_query($sql_order4);
		}
		return true;
	}
}

Log::DEBUG("begin notify");
$notify = new PayNotifyCallBack();
$notify->Handle(false);