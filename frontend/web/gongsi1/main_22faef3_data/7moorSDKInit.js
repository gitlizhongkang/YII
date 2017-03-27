/**
 * Created by yaxi on 2015-12-22.
 */
(function($){
    $.getScript = function(url, callback, cache) {
        $.ajax({type: 'GET', url: url, success: callback, dataType: 'script', cache: cache});
    };
})(jQuery);

var config = {
    version:'20151222',
    serverUrl:'//webchat.7moor.com',
    proxyMsgUrl:'//webchat.7moor.com',
    socketUrl:'//webchat.7moor.com'
};
if(window.location.href.substr(0,4)!="http"){
    config.serverUrl = "http://webchat.7moor.com";
    config.proxyMsgUrl = "http://webchat.7moor.com";
    config.socketUrl = "http://webchat.7moor.com";
}
var configData = undefined;
var loadQimoSDK = function(accessId, callback){
    // $(document.body).append("<iframe id='qimo_upload' src='http://webchat.7moor.com/view/upload.html' style='display:none;'></iframe>");
    $.getScript(config.serverUrl + "/javascripts/socket.io.js", function(){
        $.getJSON(config.serverUrl+ "/online?action=getAbilityVersion&accessId=" + accessId+"&callback=?", function(data){
            config.version = data.version || config.version;
            configData = data;
            $.getScript(config.serverUrl + "/javascripts/7moorSDK.source.js?v="+ config.version, callback,true);
        });
    },true);
}





