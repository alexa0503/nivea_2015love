<?php $this->parser->parse('index/header', $this->app_parse);?>
<body class="page1">
<div class="head">
<img src="img/tophead.jpg" class="logo">
<img src="img/tophead-back.png" class="headback layer10"/>
</div>

<div class="kv page1">
    <img src="img/kv1.jpg" /> 
</div>

<div class="productselect">
	<div class="pshead">
    	<img src="img/p1t.png" width="600" height="70"  alt=""/>
    </div>
    <div class="pscontent">
    	<!--<img src="img/arrowleft.png" class="arrowl"/>
        <img src="img/arrowright.png"  class="arrowr"/>
        <img src="img/ps-sep.png"  class="ps-sep"/>-->
    	<div class="prod">
        
       		<ul >
            <li>
            	<a href="http://www.jd.com/suit/show.html?suitId=1984509&skuIds=882282,1041017"><img src="img/product1.png" width="144" height="223" class="pimg"  alt=""/><br />
                <img src="img/apply-product.png" width="107" height="32" class="pbuy"  alt=""/></a>
           	</li>
            <li>
            	<a href="http://wq.jd.com/mshop/gethomepage?venderid=1000003747"><img src="img/product2.png" width="144" height="223" class="pimg"  alt=""/><br />
                <img src="img/apply-product.png" width="107" height="32" class="pbuy"   alt=""/></a>

           	</li>
            
            </ul>
        
        </div>
        
    </div>

</div><!--/productselect-->

<div class="papply">
  <!--<a href="<?php echo site_url('index/apply');?>">-->
    <img src="img/apply.png" class="papp"/>
  <!--</a>-->
</div>
<script>
    $().ready(function(){
      $('.papp').bind('touchstart click', function(){
        window.location.href = '<?php echo site_url('index/apply');?>'
      });
    });
</script>
<?php $this->load->view('index/footer');?>
