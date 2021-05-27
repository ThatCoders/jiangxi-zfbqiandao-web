<?php
function myQqSend($msg){  //这是预留给我的推送,在网站,数据库存入等失败时,报错给我的QQ,如果你要则填入你的 qmsg酱key和你的QQ 调用方法是传入字符串即可
    $msg=urlencode($msg);
    $url = "https://qmsg.zendee.cn/send/ 你的qmsg酱key ?qq= 你的QQ &msg={$msg}";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  // 对认证证书来源的检查
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);  // 从证书中检查SSL加密算法是否存在
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  // 获取的信息以文件流的形式返回
    curl_exec($ch);
}
function wxSend($sckey,$title,$desp){    //微信推送
    $title=urlencode($title);
    $desp=urlencode($desp);
    $wxurl="https://sctapi.ftqq.com/{$sckey}.send?title={$title}&desp={$desp}";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$wxurl);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  // 对认证证书来源的检查
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);  // 从证书中检查SSL加密算法是否存在
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  // 获取的信息以文件流的形式返回
    curl_exec($ch);

}
function qqSend($qq,$msg,$qqkey){    //qmsg酱发送
    $msg=urlencode($msg);
    $url = "https://qmsg.zendee.cn/send/{$qqkey}?qq={$qq}&msg={$msg}";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  // 对认证证书来源的检查
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);  // 从证书中检查SSL加密算法是否存在
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  // 获取的信息以文件流的形式返回
    curl_exec($ch);
}
?>
