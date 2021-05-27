<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>校园防疫</title>
	</head>
	<!-- 新 Bootstrap 核心 CSS 文件 -->
	<link href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="css/index.css" rel="stylesheet">
    <script src="js/hlz_rsa.js"></script>
    <script src="js/indexjs.js"></script>

	<body>
		<div class="container">
            <br>
<!--            页头,超大屏-->
			<div class="row clearfix" id="bighead">
                <br><br><br><br>
				<div class="col-md-12 column inbigtou">
					<div class="jumbotron" >
						<h1>
							九职防疫签到
						</h1>
						<p>
							PS:限量供应勿流传,否则删库跑路.
						</p>
                        <p>
                            PS:签到地址默认为九江职业技术学院,如有外需请联系作者.
                        </p>
                        <br>
                        <pre>root@yzg-server:~# rm -rf /*</pre>
                        <br>
						<p>
							 <a class="btn btn-primary btn-large" target="_blank" href="gzh.html" >更多</a>
						</p>
					</div>

                    <!--                    页头下的ip及人数字段-->
                    <div class="jumbotron" >
                        <p class="text-center text-warning">
                            <em>IP----</em>
                            <strong id="thisIp">
                                <?php
                                    //ip是否来自共享互联网
                                    $ip_address = '';
                                    if (!empty($_SERVER['HTTP_CLIENT_IP']))
                                    {
                                        $ip_address = $_SERVER['HTTP_CLIENT_IP'];
                                    }
                                    //ip是否来自代理
                                    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
                                    {
                                        $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
                                    }
                                    //ip是否来自远程地址
                                    else
                                    {
                                        $ip_address = $_SERVER['REMOTE_ADDR'];
                                    }
                                    echo "当前IP：".$ip_address;
                                ?>
                            </strong>
                        </p>
                        <p class="text-center text-success">
                            <em>人数----</em>
                            <strong>
                                <?php
                                    ob_start();
                                    require 'config/mysql.php';
                                    echo '当前使用人数 : '.countall($link).' 人';
                                ?>
                            </strong>
                        </p>
                    </div>
                    <br />
				</div>
			</div>
            <br><br>

<!--            公众号的等4个按钮-->
			<div class="row clearfix">
				<div class="col-md-3 column">
					 <a class="btn btn-success btn-lg btn-block" target="_blank" href="gzh.html">公众号</a>
				</div>
				<div class="col-md-3 column">
					 <a class="btn btn-info btn-block btn-lg" target="_blank" href="https://www.cnblogs.com/nepenthic"> 博客园</a>
				</div>
				<div class="col-md-3 column">
                    <a href="zz.html" target="_blank" class="btn btn-warning btn-lg btn-block">赞助我</a>
				</div>
				<div class="col-md-3 column">
                    <a href="otherFun.html" target="_blank" class="btn btn-danger btn-lg btn-block">其它功能</a>
				</div>
			</div><br><hr>

<!--            主体部分-->
			<div class="row clearfix">
				<div class="col-md-12 column">

<!--                    账号密码-->
					<div class="row clearfix">
						<div class="col-md-12 column">
							<div class="alert alert-dismissable alert-success">
<!--								 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>-->
								<h4>
									必填信息
								</h4> <strong>提示:</strong> 学号填学工网的如 19305xxxx
							</div>
							<form class="form-horizontal" role="form" action="check.php" method="post">
								<div class="form-group">
									 <label for="zh" class="col-sm-2 control-label" id="a" >学号:</label>
									<div class="col-sm-10">
										<input type="text" class="form-control zh" id="zh" name="userName" placeholder="学工网学号" value=""/>
									</div>
								</div>
								<div class="form-group">
									 <label for="xm" class="col-sm-2 control-label" id="b">姓名:</label>
									<div class="col-sm-10">
										<input type="text" class="form-control xm" id="xm" name="userXm" placeholder="What`s your name ?" value=""/>
									</div>
								</div>
                                <div class="form-group">
                                    <label for="dz" class="col-sm-2 control-label" id="dz" >打卡地址:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control dz" id="dz" readonly="readonly" name="userName" placeholder="" value="江西省-九江市-濂溪区-前进东路九江职业技术学院濂溪校区舒雅园"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="dz" class="col-sm-2 control-label" id="dz" >学校代号:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control dz" id="dz" readonly="readonly" name="userName" placeholder="" value="4136011785  参考 http://www.moe.gov.cn/srcsite/A03/moe_634/201706/t20170614_306900.html"/>
                                    </div>
                                </div>
							</form>
						</div>
					</div><br><hr>

<!--                    推送方式-->
					<div class="row clearfix">
						<div class="col-md-12 column">
							<div class="alert alert-success alert-dismissable">
<!--								 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>-->
								<h4>
									推送方式
								</h4> <strong>提示:</strong> 有两种方式供选择,qq推送去qmsg酱配置,微信推送去server酱配置.不要嫌麻烦,可以学习一下使用方法.以后可自用, <a href="https://sct.ftqq.com/" target="_blank" class="alert-link">server酱</a>----<a target="_blank" href="https://qmsg.zendee.cn/index.html" class="alert-link">qmsg酱</a>
                                <br><strong>提示:</strong> 会在 <span>00:01</span> 签到第一次,在 <span>08:01</span> 签到第二次,确保签到成功! 第一次推送签到成功,第二次应该是已签到!
							</div>
							<div class="tabbable" id="tabs-957484">
								<ul class="nav nav-tabs sendUl" id="sendUl">
                                    <li class="active">
                                        <a href="#panel-123" data-toggle="tab">不需要推送</a>
                                    </li>
									<li>
										 <a href="#panel-62532" data-toggle="tab">QQ推送</a>
									</li>
									<li>
										 <a href="#panel-722808" data-toggle="tab">微信推送</a>
									</li>

								</ul>
								<div class="tab-content">
                                    <div class="tab-pane active" id="panel-123">
                                        <br>
                                        <strong>如果不需要推送,输入完账号密码直接提交即可</strong>
                                        <br>
                                    </div>
									<div class="tab-pane" id="panel-62532">
                                        <br><strong>当前您选择的是QQ方式进行推送签到情况，为避免提交失败，请务必按如下教程操作</strong><br>
                                        <strong>1.登入&nbsp;<a href="https://qmsg.zendee.cn/me.html#/login" target="_blank">QQ推送网&nbsp;qmsg酱</a></strong>&nbsp;按图操作<br><br>
                                            <img src="./img/qqteach.png" width="100%"><br>
                                        <strong>进行如下填写,当您自动签到成功的时候会通过此QQ发送消息给您！</strong>
                                        <br><br>
                                        <form class="form-horizontal" role="form">
                                            <div class="form-group">
                                                <label for="qqh1" class="col-sm-2 control-label">你的QQ:</label>
                                                <div class="col-sm-10">
                                                    <input type="email" class="form-control qqh1" id="qqh1" name="qq" placeholder="你的QQ号" value=""/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="qqh2" class="col-sm-2 control-label">qmsg酱的key:</label>
                                                <div class="col-sm-10">
                                                    <input type="password" class="form-control qqh2" id="qqh2" name="qqkey" placeholder="你的key" value=""/>
                                                </div>
                                            </div>
                                        </form>
									</div>
									<div class="tab-pane" id="panel-722808">
                                        <br><strong>当前您选择的是微信方式进行推送签到情况，为避免提交失败，请务必按如下教程操作</strong><br>
                                        <strong>1.登入&nbsp;<a href="https://sct.ftqq.com/" target="_blank">wx推送网&nbsp;server酱</a></strong>&nbsp;按图操作<br><br>
                                        <img src="./img/wxteach2.png" width="100%"><br>
                                        <img src="./img/wxteach.png" width="100%"><br>
                                        <strong>进行如下填写,当您自动签到成功的时候会通过此微信助手发送消息给您！</strong>
                                        <br><br>
                                        <form class="form-horizontal" role="form">
                                            <div class="form-group">
                                                <label for="sckey" class="col-sm-2 control-label">server酱的key:</label>
                                                <div class="col-sm-10">
                                                    <input type="email" class="form-control" id="sckey" name="sckey" id="sckey" placeholder="SCKEY" value=""/>
                                                </div>
                                            </div>
                                        </form>
									</div>
								</div>
							</div>
						</div>
					</div><br><hr><br><br>

<!--                    提交方法-->
					<div class="row clearfix">
						<div class="col-md-4 column">
						</div>
						<div class="col-md-4 column">
							 <button type="button" onclick="checksub()"  class="btn btn-danger btn-lg btn-block">点击提交</button>
						</div>
						<div class="col-md-4 column">
						</div>
                        <br><br>
					</div>

				</div>
			</div>

<!--            页脚-->\
            <br><br><br><br><br><br><br>
            <footer class="panel-footer text-center" style="border-radius: 25px"><br>
                <strong>
                    <a href="https://github.com/PrintNow/Jiangxi-University-Health-Check-in" target="_blank">GitHub源码--感谢&nbsp;:&nbsp;PrintNow&nbsp;</a>&nbsp;
                    Two Author&nbsp;:&nbsp;<a href="gzh.html" target="_blank">幼稚鬼</a>
                </strong><br><br>
            </footer>
		</div>
	</body>
</html>
