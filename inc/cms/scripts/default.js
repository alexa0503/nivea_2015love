$(document).ready(function(){
	$('#login_form').submit(function(){
		var url = $(this).attr('action');
		var data = $(this).serializeArray();
		$.post(url,data,function(j){
			var json = eval("(" + j + ")");
			if(json.ret == 0)
				location.reload();
			else{
				$('#login_notification').removeClass('information').addClass('error').find('div').html(json.msg);
			}
		});
		return false;
	});
	$('.delete').click(function(){
		var url = $(this).attr('href');
		if(confirm('此操作不可返回，是否继续？')){
			$.getJSON(url,function(data){
				if(data.ret == 0){
					location.reload();
				}
				else{
					alert(data.msg);
				}
			});
		}
		return false;
	});
	$('#form_delete').submit(function(){
		var url = $(this).attr('action');
		var data = $(this).serializeArray();
		if(data == ''){
			alert('请选择删除的留言');
		}
		else{
			$.post(url,data,function(j){
				var json = eval("(" + j + ")");
				if(json.ret == 0)
					location.reload();
				else{
					alert(json.msg);
				}
			});
		}
		return false;
	});
});