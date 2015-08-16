<?php $this->parser->parse('index/header', $this->app_parse);?>
<body class="page3">
<div class="head">
<img src="img/tophead-apply.jpg" class="logo">
<a href="<?php echo site_url('index/apply');?>"><img src="img/tophead-back.png" class="headback layer10"/></a>
</div>
<div class="content-success">
	<!--<p><img src="img/code.png" width="600" height="600" /></p>
	<p><img src="img/txt-01.png" width="600" height="120" /></p>-->
	<img src="img/bkg-01.png" width="600" height="720">
</div>
<div class="footer-success">
	<a href="javascript:;" id="btn-share"><img src="img/btn-share.png" width="285" height="70" /></a>
</div>
<div class="share-div">
	<img src="img/icon-arrow.png" style="position:absolute;top:-400px;right:0;" /><!--<img src="img/txt-02.png" width="371" height="149" />--></div>
<div class="mask-div"></div>
<script type="text/javascript">
	$().ready(function(){
		$('.mask-div').not('.share-div').click(function(){
			$('.mask-div,.share-div').hide();
		});
		$('#btn-share').click(function(){
			$('.mask-div,.share-div').show();
		})
	})
</script>
<?php $this->load->view('index/footer');?>
