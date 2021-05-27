<h1>基于README3里的老哥写的 挂服务器网页版支付宝签到</h1>
<h3>使用语言 JS html bootstrap PHP8</h3>
<h3>挪用请必须修改如下地方</h3>
<ol>
    <li>在服务器创建 数据库 zfb ,表 user,字段 : 
        <ol>
            <li>user_id--int--主键自增</li>
            <li>user_name--varchar---主键</li>
            <li>user_xm---varchar</li>
            <li>user_qq---varchar</li>
            <li>user_qqkey---varchar</li>
            <li>user_sckey---varchar</li>
        </ol>
    </li>
    <li>修改config目录mysql.php文件7,8行为自己的mysql数据库用户名和密码</li>
    <li>修改config目录mysql.php文件102行网站为自己的域名地址</li>
    <li>修改go.php文件10行为自己学校的代号,21行为自己学校的地址及经纬度</li>
</ol>
<h3>基本已经修改完成,其它乱七八糟的位置如公众号什么的换成自己的内容即可</h3>