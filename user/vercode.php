<?php
session_start();
require 'vcode/app_config.php';

require_once('vcode/SUBMAILAutoload.php');
$telnum=$_POST['telphone'];
$ranknum=$_POST['ranknum'];
$submail=new MESSAGEXsend($message_configs);
$submail->SetTo($telnum);
$submail->SetProject("MXFmp3");
$submail->AddVar('code',$ranknum);
/*
     |调用 send 方法发送短信
     |--------------------------------------------------------------------------
     */
$result = $submail->xsend();
/*
     |打印服务器返回值
     |--------------------------------------------------------------------------
     */
print_r($result);


?>