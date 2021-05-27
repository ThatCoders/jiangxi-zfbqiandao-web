var notStatus=false;
var qqStatus=false;
var wxStatus=false;
var thissend='';
var a=document.getElementById('a');
var b=document.getElementById('b');

$(function () {  //给选择的推送绑定类,并赋值thissend的值
    $('.sendUl li a').click(function (){
        $('.sendUl li').removeClass('thisSend');
        $(this).parent().addClass('thisSend');
        thissend=$('.thisSend a').text();
    });
});

function checksub(){
    if (thissend==='不需要推送'){
        notStatus=true;
    }else if (thissend==='QQ推送'){
        qqStatus=true;
    }else if (thissend==='微信推送'){
        wxStatus=true;
    }
    if(zh.value===''||xm.value===''){
        alert("学号姓名不能为空");
        return 0;
    }else{
        if(wxStatus && sckey.value===''){
            wxStatus=false;
            alert("SCKEY不能为空，或者取消微信推送选项！");
            return 0;
        }else if(qqStatus && qqh1.value===''){
            qqStatus=false;
            alert("QQ与key不能为空，或者取消QQ推送选项！");
            return 0;
        }else if (qqStatus && qqh2.value===''){
            qqStatus=false;
            alert("QQ与key不能为空，或者取消QQ推送选项！");
            return 0;
        }else if (notStatus){
            notStatus=false;
            return 0;
        }else {
        }
    }
    /* ajax请求 */
    var row="&userName="+zh.value+"&userXm="+xm.value+"&sckey="+sckey.value+"&qq="+qqh1.value+"&qqkey="+qqh2.value+"&first=first";
    function aaa(a,b){
        if(a==='yes1'||a==='yes2'){
            alert("登录成功");
            Ajax.post("useradd.php",row,bbb);
        }else{
            alert("提交失败，可能是学号姓名错误");
        }
    }
    function bbb(a,b){
        if(a==='0'){
            alert("创建成功! ");
        }else if(a==='1'){
            alert("添加或修改失败,请联系管理员! ");
        }else if (a==='2'){
            alert("修改成功! ")
        }else{
            alert("提交失败,未知错误!");
        }
    }
    var Ajax={
        // datat应为'a=a1&b=b1'这种字符串格式，在jq里如果data为对象会自动将对象转成这种字符串格式
        post: function (url, data, fn) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", url, true);
            // 添加http头，发送信息至服务器时内容编码类型
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && (xhr.status === 200 || xhr.status === 304)) {
                    fn.call(this, xhr.responseText);
                }
            };
            xhr.send(data);
        }
    }
    Ajax.post("go.php",row,aaa);
    /*********/
}