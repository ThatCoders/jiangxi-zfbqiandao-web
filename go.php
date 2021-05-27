<?php
include "config/threeSend.php";
include "key/public.php";

@$qqkey=$_POST['qqkey'];//qq推送
@$sid=$_POST['userName'];//学号
@$userName=$_POST['userXm'];//姓名
@$sckey=$_POST['sckey'];//wechat
@$qq=$_POST['qq'];//qq
$school_id = "4136011785";//学校代码

$cookie_jar = __DIR__ . "/cookies/{$sid}.cookie";
file_put_contents($cookie_jar, "");

//执行登录，并将 cookie 文件存放至 $cookie_jar
curlGet("https://fxgl.jx.edu.cn/{$school_id}/public/homeQd?loginName={$sid}&loginType=0", $cookie_jar);

//执行签到
$res = curlPost("https://fxgl.jx.edu.cn/{$school_id}/studentQd/saveStu", $cookie_jar,
    build_sign_data(
        "江西省", "九江市", "濂溪区", "前进东路916九江职业技术学院濂溪校区舒雅园", 1, 116.01532822586441, 29.673093790563584
    ));

//将 json 解析成数组(Array)
$de_res = json_decode($res, true);

//解析失败返回 API 结果
if (!isset($de_res)) {
    echo "解析 json 失败，API 返回结果：";
    die($res);
}

if ($de_res['code'] === 1001) {
    $TEXT = "支付宝签到平台\n{$userName} 签到成功";
    echo 'yes1';
} else if ($de_res['code'] === 1002) {
    $TEXT = "支付宝签到平台\n{$userName} 今日已经签过啦";
    echo 'yes2';
} else {
    $TEXT = "UNknown Code: {$de_res['code']}, reason: {$de_res['msg']}";
    die('no failed , I`dont know !');
}
if ($first=='first'){
    $TEXT="支付宝签到平台\n{$userName} 绑定成功!\n正在数据入库......";
}
if ($qq!=''&&$qqkey!=''){
    qqSend($qq,$TEXT,$qqkey);
}elseif ($sckey!=''){
    wxSend($sckey,"支付宝签到平台",$TEXT);
}

########################################################################################################

//返回签到数据
//$sfby是否已毕业,1,否
function build_sign_data($province, $city, $district, $street, $sfby, $lng,$lat): array
{
    return [
        "province" => $province,//省
        "city" => $city,//市
        "district" => $district,//区/县
        "street" => $street,//街道
        "xszt" => 0,

        "jkzk" => 0,//健康状况  0:健康   1:异常
        "jkzkxq" => "",//异常原因
        "sfgl" => 1,//是否隔离  0:隔离   1:没有隔离

        "gldd" => "",
        "mqtw" => 0,
        "mqtwxq" => "",

        //还需要将 $street 拼接，否则“签到记录中缺失具体的街道信息”
        //参考：https://github.com/PrintNow/Jiangxi-University-Health-Check-in/issues/2#issuecomment-672447041
        "zddlwz" => $province . $city . $district . $street,//省市县(区)街道 拼接结果
        "sddlwz" => "",
        "bprovince" => $province,
        "bcity" => $city,
        "bdistrict" => $district,
        "bstreet" => $street,
        "sprovince" => $province,
        "scity" => $city,
        "sdistrict" => $district,

        "lng" => $lng,//经度
        "lat" => $lat,//维度
        "sfby" => $sfby,//是否为毕业班的学生   0:是毕业班的学生    1:不是毕业班的学生
    ];
}

function curlGet($API, $cookie_jar, $header = [], $timout = 5)
{
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $API,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => $timout,
        CURLOPT_FOLLOWLOCATION => true,

        CURLOPT_COOKIEJAR => $cookie_jar,
        CURLOPT_COOKIEFILE => $cookie_jar,

        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => $header,  //需要发送的 header
    ));

    $response = curl_exec($curl);
    $info = curl_getinfo($curl);
    curl_close($curl);

    if ($info['http_code'] !== 200) {
        myQqSend("支付宝签到-主方法-curlGet-114行-statusCode!=200");
    }

    return $response;
}

function curlPost($API = "", $cookie_jar = "", $data = [], $header = [], $timeout = 5)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $API, //需要请求的 URL
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => $timeout,  //请求超时时间
        CURLOPT_FOLLOWLOCATION => false,
        CURLOPT_COOKIEFILE => $cookie_jar,  //存放 cookie 文件路径
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => http_build_query($data),  //需要发送的POST数据
        CURLOPT_HTTPHEADER => $header,
    ));

    $response = curl_exec($curl);
    $info = curl_getinfo($curl);
    curl_close($curl);

    if ($info['http_code'] !== 200) {
        myQqSend("支付宝签到-主方法-curlPost-121行-statusCode!=200");
    }
    return $response;
}

?>