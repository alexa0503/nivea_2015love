<!doctype html>
<html>
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" /> 
	<meta name="HandheldFriendly" content="True">
  	<meta name="viewport" servergenerated="true" content="width=640, user-scalable=no,target-densitydpi=device-dpi">
    <!-- <meta name='viewport' content=' user-scalable=0;' />
    <meta name="viewport" content="width=device-width"> -->
<link rel="stylesheet" type="text/css" href="inc/main.css">
<link rel="stylesheet" href="inc/animate.css">
<script src="inc/jquery-1.11.1.min.js"></script>
<script src="inc/main.js"></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
        wx.config({
            debug: false,
            appId: '<?php echo $wxSignPackage["appId"];?>',
            timestamp: <?php echo $wxSignPackage["timestamp"];?>,
            nonceStr: '<?php echo $wxSignPackage["nonceStr"];?>',
            signature: '<?php echo $wxSignPackage["signature"];?>',
            jsApiList: [
                // 所有要调用的 API 都要加到这个列表中
                'onMenuShareTimeline',
                'onMenuShareAppMessage'
            ]
        });
        var server_path = window.location.href.replace("#","");
        wx.ready(function () {
            wx.onMenuShareAppMessage({
                title: '<?php echo $wxShare["title"]?>',
                desc: '<?php echo $wxShare["desc"]?>',
                link: '<?php echo $wxShare["link"]?>',
                imgUrl: '<?php echo $wxShare["imgUrl"]?>',
                trigger: function (res) {
                    // 不要尝试在trigger中使用ajax异步请求修改本次分享的内容，因为客户端分享操作是一个同步操作，这时候使用ajax的回包会还没有返回
                    //alert('用户点击发送给朋友');
                },
                success: function (res) {
                    //alert('已分享');
                },
                cancel: function (res) {
                    //alert('已取消');
                },
                fail: function (res) {
                    //alert(JSON.stringify(res));
                }
            });
            wx.onMenuShareTimeline({
                title: '<?php echo $wxShare["timeLineTitle"]?>',
                link: '<?php echo $wxShare["link"]?>',
                imgUrl: '<?php echo $wxShare["imgUrl"]?>',
                trigger: function (res) {
                    // 不要尝试在trigger中使用ajax异步请求修改本次分享的内容，因为客户端分享操作是一个同步操作，这时候使用ajax的回包会还没有返回
                    //alert('用户点击发送给朋友');
                },
                success: function (res) {
                    //alert('已分享');
                },
                cancel: function (res) {
                    //alert('已取消');
                },
                fail: function (res) {
                    //alert(JSON.stringify(res));
                }
            });
        });
    </script>
<title><?php echo $app_title;?></title>

</head>