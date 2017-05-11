<!DOCTYPE html>
<html lang="zh-cmn-Hans" xmlns="http://www.w3.org/1999/html">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
        <title>充值记录查询</title>
        <link rel="stylesheet" href="./css/weui.css"/>
        <link rel="stylesheet" href="./css/example.css"/>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <style>
            img{
                width:100%;
                height: auto;
                max-width: 100%;
                display: block;
            }

        </style>
<?php
    
    require_once("db.php");
    $openid=$_GET["openid"];
    $sql1 = "select * from user  where openId='".$openid."'";
    $result1= mysql_query($sql1);
    $row1 = mysql_fetch_array($result1);
    $userid=$row1['userId'];
    $sql2 = "select * from orders where userId='".$userid."' and orderType='0' order by transDate desc ";
    $result2 = mysql_query($sql2);
    while($row2 = mysql_fetch_array($result2))
         {
        $arr2[]=$row2;
          } 
?> 
    </head>
    <body>
    <!-- 加载图片，并设置为自适应-->
    <div class="weui-panel">
        <img src="img/vip.JPG">
    </div>
    <!-- 查询结果 -->
    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">充值记录查询</div>
 <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <td>时间</td>
                    <td>充值金额</td>
                    <td>赠送金额</td>
                    <td>充值状态</td>
                </tr>
            </thead>
 <tbody>       
<?php if( is_array( $arr2 ) ): ?> 
<?php foreach(  $arr2 as $item ): ?>
<?php
    if($item['orderStatus']==2)
        $instatus="成功";
    else if($item['orderStatus']==3)
        $instatus="失败";
?>
<tr>      
    <td><?php echo $item['transDate'];?></td> 
    <td><?php echo $item['transAmt'];?></td>
    <td><?php echo $item['addmoney'];?></td>
    <td><?php echo $instatus;?></td>
</tr>
<?php endforeach; ?>
<?php endif; ?>  
</ul>
</tbody>
</table>
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