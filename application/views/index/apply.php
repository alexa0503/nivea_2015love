<?php $this->parser->parse('index/header', $this->app_parse);?>
<body class="page2">
<div class="head">
<img src="img/tophead-apply.jpg" class="logo">
<a href="<?php echo site_url('index/index');?>"><img src="img/tophead-back.png" class="headback layer10"/></a>
</div>

<div class="kv page2">
    <img src="img/kv2.jpg" /> 
</div>
	
	<div class="applyform">
		 <input name="name" type="text" id="name" >
		 <input name="phone" type="text" id="phone" >
		 <input name="email" type="text" id="email" >
	</div>

	<div class="papply">
	<a href="javascript:;" id="apply"><img src="img/apply.png" class="papp"/></a>
	</div>
<script type="text/javascript">
	$().ready(function(){
		$('#apply').click(function(){
			var url = '<?php echo site_url("index/post");?>';
			var name = $('#name').val();
			var phone = $('#phone').val();
			var email = $('#email').val();
			var phoneRegExp = /^1\d{10}$/ ;
			var emailRegExp =  /^(?:\w+\.?)*\w+@(?:\w+)*\.\w+$/;
			if(name == "" || name.length <2 || name.length > 10){
				alert("请填写正确的名字");
			}
			else if( !phoneRegExp.test(phone)){
				alert('请填写正确的手机号');
			}
			else if( !emailRegExp.test(email)){
				alert('请填写正确的EMAIL地址');
			}
			else{
				$.ajax({
					url:url,
					data:{
						name:name,
						phone:phone,
						email:email
					},
					type:'POST',
					cache:'false',
					dataType:'json',
					 success:function(data) {
					 	if(data.ret == 0)
					 		location.href=data.url;
					 	else
					 		alert(data.msg);
					 },
					 error:function(){
					 	alert('您的网络异常，请稍后重试');
					 }
				});
			}
			return false;
		})
	})
</script>
<?php $this->load->view('index/footer');?>
