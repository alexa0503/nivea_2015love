//找到url中匹配的字符串
function findInUrl(str){
	url = location.href;
	return url.indexOf(str) == -1 ? false : true;
}
//获取url参数
function queryString(key){
	return (document.location.search.match(new RegExp("(?:^\\?|&)"+key+"=(.*?)(?=&|$)"))||['',null])[1];
}

//产生指定范围的随机数
function randomNumb(minNumb,maxNumb){
	var rn=Math.round(Math.random()*(maxNumb-minNumb)+minNumb);
	return rn;
}

var wHeight;
$(document).ready(function(){
	wHeight=$(window).height();
	if(wHeight<832){
		wHeight=832;
	}
	$('.page').height(wHeight);
	$('.h832').css('padding-top',(wHeight-832)/2+'px');
	
	$('.page1').css('background-position','0px -'+(1139-wHeight)/2+'px');
	$('.page2').css('background-position','-640px -'+(1139-wHeight)/2+'px');
	$('.page3').css('background-position','-1280px -'+(1139-wHeight)/2+'px');
	$('.page4').css('background-position','-1920px -'+(1139-wHeight)/2+'px');
	$('.page5').css('background-position','-2560px -'+(1139-wHeight)/2+'px');
	
});

function showPop(obj){
	$('.popBg').show();
	$('.pop').hide();
	$('.pop'+obj).show();
}

function closePop(){
	$('.popBg').hide();
	$('.pop').hide();
}

function wxShare(data){
	wx.config({
		debug: false,
		appId: data.wx_app_id,
		timestamp: data.wx_timestamp,
		nonceStr: data.wx_nonce_str,
		signature: data.wx_signature,
		jsApiList: [
			// 所有要调用的 API 都要加到这个列表中
			'onMenuShareTimeline',
			'onMenuShareAppMessage'
			]
		});
	wx.ready(function () {
		wx.onMenuShareAppMessage({
			title: data.wx_title,
			desc: data.wx_desc,
			link: data.wx_share_url,
			imgUrl: data.wx_img_url,
			trigger: function (res) {
				// 不要尝试在trigger中使用ajax异步请求修改本次分享的内容，因为客户端分享操作是一个同步操作，这时候使用ajax的回包会还没有返回
				//alert('用户点击发送给朋友');
			},
			success: function (res) {
				if( data.isTest == true )
					location.href="info.html";
			},
			cancel: function (res) {
				//alert('已取消');
			},
			fail: function (res) {
				//alert(JSON.stringify(res));
			}
		});
		wx.onMenuShareTimeline({
			title: data.wx_title,
			desc: data.wx_desc,
			link: data.wx_share_url,
			imgUrl: data.wx_img_url,
			trigger: function (res) {
				// 不要尝试在trigger中使用ajax异步请求修改本次分享的内容，因为客户端分享操作是一个同步操作，这时候使用ajax的回包会还没有返回
				//alert('用户点击发送给朋友');
			},
			success: function (res) {
				if( data.isTest == true )
					location.href="info.html";
			},
			cancel: function (res) {
				//alert('已取消');
			},
			fail: function (res) {
				//alert(JSON.stringify(res));
			}
		});
	});
}