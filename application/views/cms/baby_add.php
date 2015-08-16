
			<div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-header">
					<h3 style="cursor: s-resize;">{app_sub_title} </h3>
				</div> <!-- End .content-box-header -->
				<div class="content-box-content">
						<form method="post" action="" enctype="multipart/form-data">
							<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
								
							<table>
									<tbody>

									<tr>
										<th width="160">排序</th>
										<td><input type="text" name="baby[order_by]" id="order_by" class="text-input small-input" value="<?php echo $baby['order_by']?>">  *<!-- <span class="input-notification attention png_bg"></span> Classes for input-notification: success, error, information, attention --></td>
									</tr>

									<tr>
										<th width="160">名称</th>
										<td><input type="text" name="baby[baby_name]" id="baby_name" class="text-input medium-input" value="<?php echo $baby['baby_name']?>">  *</td>
									</tr>

									<tr>
										<th width="160">年龄</th>
										<td><input type="text" name="baby[age]" id="age" class="text-input small-input" value="<?php echo $baby['age']?>">  *</td>
									</tr>

									<tr>
										<th width="160">介绍</th>
										<td><textarea name="baby[intro]" id="intro" class="text-input medium-input"><?php echo $baby['intro']?></textarea>  *</td>
									</tr>

									<?php if( !empty($baby['img_url_value'])):?>
									<tr>
										<th width="160">图片(小)预览</th>
										<td><?php echo $baby['img_url']?><input type="hidden" name="baby[img_url]" id="img_url" class="text-input medium-input" value="<?php echo $baby['img_url_value']?>"></td>
									</tr>
									<?php endif;?>
									<tr>
										<th width="160">上传图片(小)</th>
										<td><input type="file" name="image" id="img_url" class="text-input medium-input">  *</td>
									</tr>

									<?php if( !empty($baby['pic_url_value'])):?>
									<tr>
										<th width="160">图片(大)1预览</th>
										<td><?php echo $baby['pic_url']?><input type="hidden" name="baby[pic_url]" id="pic_url" class="text-input medium-input" value="<?php echo $baby['pic_url_value']?>"></td>
									</tr>
									<?php endif;?>
									<tr>
										<th width="160">上传图片(大)1</th>
										<td><input type="file" name="pic" id="pic_url" class="text-input medium-input">  *</td>
									</tr>


									<?php if( !empty($baby['pic_url_value'])):?>
									<tr>
										<th width="160">图片(大)2预览</th>
										<td><?php echo $baby['pic_url_1']?><input type="hidden" name="baby[pic_url_1]" id="pic_url_1" class="text-input medium-input" value="<?php echo $baby['pic_url_1_value']?>"></td>
									</tr>
									<?php endif;?>
									<tr>
										<th width="160">上传图片(大)2</th>
										<td><input type="file" name="pic1" id="pic_url_1" class="text-input medium-input">  *</td>
									</tr>


									<?php if( !empty($baby['wx_img'])):?>
									<tr>
										<th width="160">微信分享图片预览</th>
										<td><?php echo $baby['wx_img']?><input type="hidden" name="baby[wx_img]" id="wx_img" class="text-input medium-input" value="<?php echo $baby['wx_img_value']?>"></td>
									</tr>
									<?php endif;?>
									<tr>
										<th width="160">微信分享图片</th>
										<td><input type="file" name="wx_img" id="wx_img" class="text-input medium-input">  *</td>
									</tr>



								</tbody>
							</table>
								<?php if(isset($form_result)) echo '<h3 class="input-notification error png_bg" style="margin:20px 0;color:red;">'.$form_result['msg'].'</h3>'?>
								<p>
									<input type="submit" value="提 交" class="button">
								</p>
								
							</fieldset>
							
							<div class="clear"></div><!-- End .clear -->
							
						</form>
				</div> <!-- End .content-box-content -->
				
			</div>