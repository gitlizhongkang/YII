/**
Vertigo Tip by www.vertigo-project.com
Requires jQuery
*/
var hash={
'qq.com': 'http://mail.qq.com',
'gmail.com': 'http://mail.google.com',
'sina.com': 'http://mail.sina.com.cn',
'163.com': 'http://mail.163.com',
'126.com': 'http://mail.126.com',
'yeah.net': 'http://www.yeah.net/',
'sohu.com': 'http://mail.sohu.com/',
'tom.com': 'http://mail.tom.com/',
'sogou.com': 'http://mail.sogou.com/',
'139.com': 'http://mail.10086.cn/',
'hotmail.com': 'http://www.hotmail.com',
'live.com': 'http://login.live.com/',
'live.cn': 'http://login.live.cn/',
'live.com.cn': 'http://login.live.com.cn',
'189.com': 'http://webmail16.189.cn/webmail/',
'yahoo.com.cn': 'http://mail.cn.yahoo.com/',
'yahoo.cn': 'http://mail.cn.yahoo.com/',
'eyou.com': 'http://www.eyou.com/',
'21cn.com': 'http://mail.21cn.com/',
'188.com': 'http://www.188.com/',
'foxmail.coom': 'http://www.foxmail.com'
};
// <a href="#" id="gotoemail" email="{#$usinfo.email#}" class="btn btn-lg blue span2">
function gotoemail(goto_email)
{
    $(goto_email).each(function() {
        var url = $(this).attr("email").split('@')[1];
        for (var j in hash){
        $(this).attr("href", hash[url]);
        }
    });
}