<?php
include "config/mysql.php";
include "key/public.php";
$openid='YouZhiGui';
$addCheck='3';
$first=$_POST['first'];//是否第一次绑定
$qqkey=$_POST['qqkey'];//qq推送
$userName=$_POST['userName'];//学号
$userXm=$_POST['userXm'];//姓名
$sckey=$_POST['sckey'];//wechat
$qq=$_POST['qq'];//qq

if(isset($userName)&&isset($userXm)){
    $addCheck=checklife($userName,$userXm,$qq,$qqkey,$sckey,$link);
    echo $addCheck;
    if ($addCheck=='1'){
        myQqSend("$userXm 支付宝签到添加失败");
    }elseif ($addCheck=='0'){
        if ($qqkey!=''){
            qqSend($qq,"支付宝签到平台\n{$userName}  {$userXm} 入库创建成功!",$qqkey);
        }elseif ($sckey!=''){
            wxSend($sckey,"支付宝签到平台","{$userName}  {$userXm} 入库创建成功!");
        }
        myQqSend("支付宝签到平台\n$userName  $userXm 创建成功!");
    }elseif ($addCheck=='2'){
        if ($qqkey!=''){
            qqSend($qq,"支付宝签到平台\n{$userName}  {$userXm} 入库修改成功!",$qqkey);
        }elseif ($sckey!=''){
            wxSend($sckey,"支付宝签到平台","{$userName}  {$userXm} 入库修改成功!");
        }
        myQqSend("支付宝签到平台\n$userName  $userXm 修改成功!");
    }
}else{
    return 0;
}
?>