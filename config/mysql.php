<?php
include "threeSend.php";
$type = "mysql";
$host="localhost";
$dbname="zfb";
$charset="utf8";
$username = "数据库账号";
$password = "数据库密码";
$dsn=$type.':host='.$host.';dbname='.$dbname.';charset='.$charset;
try {
    $link=new PDO($dsn,$username,$password);
//    echo '数据库连接成功';
}catch (PDOException $e){
//    exit('数据库连接失败 : '.$e->getMessage());
}

function checklife($userName,$userXm,$qq,$qqkey,$sckey,$sqlBot)    //验证是否存在用户
{
    $checksql = "SELECT * FROM user WHERE user_name='{$userName}' ";
    $checkstmt = $sqlBot->prepare($checksql);
    $checkstmt->setFetchMode(PDO::FETCH_NUM);

    if ($checkstmt->execute()) {
        $rows = $checkstmt->fetchAll();
    } else {
        echo '1';
        print_r($checkstmt->errorInfo());
        return '1';
    }

    if (count($rows) == 0) {
        //echo '<hr>用户不存在,正在创建...';
        $modifysql="INSERT INTO user (user_name,user_xm,user_qq,user_qqkey,user_sckey) VALUES ('{$userName}','{$userXm}','{$qq}','{$qqkey}','{$sckey}') ";
        return modify($modifysql, $sqlBot,true);
    }else{
        //echo '<hr>用户存在,修改中...';
        $userarray=array($userName,$userXm,$qq,$qqkey,$sckey);
        $modifysql='UPDATE user SET ';
        $rows[0][2]==$userarray[1] ? null : $modifysql .= "user_xm='".$userarray[1]."', ";
        $rows[0][3]==$userarray[2] ? null : $modifysql .= "user_qq='".$userarray[2]."', ";
        $rows[0][4]==$userarray[3] ? null : $modifysql .= "user_qqkey='".$userarray[3]."', ";
        $rows[0][5]==$userarray[4] ? null : $modifysql .= "user_sckey='".$userarray[4]."', ";
        $modifysql .= "user_name='".$userName."' WHERE user_name='".$userName."'";
        return modify($modifysql, $sqlBot,false);
    }
}

function modify($modifysql, $sqlBot ,$new){
    $checkstmt = $sqlBot->prepare($modifysql);
    $checkstmt->setFetchMode(PDO::FETCH_NUM);

    if ($checkstmt->execute()) {
        if ($new){
            echo '0';
            return '0';     //echo '创建-成功';
        }else{
            echo '2';
            return '2';     //echo '修改-成功';
        }

    } else {
        echo '1';
        print_r($checkstmt->errorInfo());
        return '1';   //创建失败
    }
}

function countall($sqlBot): int
{
    $allsql='SELECT * FROM user';
    $checkstmt = $sqlBot->prepare($allsql);
    $checkstmt->setFetchMode(PDO::FETCH_NUM);

    if ($checkstmt->execute()) {
        $rows = $checkstmt->fetchAll();
    } else {
        print_r($checkstmt->errorInfo());
    }
    return count($rows);
}

function selectAll($sqlBot){
    $checksql = "SELECT * FROM user";
    $checkstmt = $sqlBot->prepare($checksql);
    $checkstmt->setFetchMode(PDO::FETCH_NUM);

    if ($checkstmt->execute()) {
        $rows = $checkstmt->fetchAll();
    } else {
        myQqSend("支付宝run-selectAll-失败");
        print_r($checkstmt->errorInfo());
        return '';
    }
    foreach ($rows as $index) {
        $post_data = array(
            'userName' => $index[1],
            'userXm' => $index[2],
            'qq' => $index[3],
            'qqkey' => $index[4],
            'sckey' => $index[5]
        );
        echo send_post('http://你的域名地址/go.php', $post_data)."<br/>";  //
    }
}
?>
