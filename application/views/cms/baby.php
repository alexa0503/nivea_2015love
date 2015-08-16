
			<div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-header">
					
					<h3 style="cursor: s-resize;">{app_sub_title} </h3>
					<!--
					<form action="{current_url}" method="get" id="form_search" style="padding:10px 0;">
						<input type="hidden" name="c" value="index" />
						<input type="hidden" name="m" value="user" />
						<input type="text" placeholder="输入手机号或者用户名" name="keywords" value="<?php //echo urldecode($_GET["keywords"]);?>" />
						<button type="submit">搜索</button>
 					</form>-->
				</div> <!-- End .content-box-header -->
				<div class="content-box-content">
						<table>
							<thead>
								<tr>
								<?php foreach ($theads as $value) {
									echo '<th>'.$value.'</th>';
								}
								?>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<td colspan="<?php echo count($theads);?>">
										<div class="bulk-actions align-left">
											<!--
											<select name="dropdown">
												<option value="option1">Choose an action...</option>
												<option value="option2">Edit</option>
												<option value="option3">Delete</option>
											</select>
											<button type="submit" class="button">删除所选项</button>
											-->
										</div>
										
										<div class="pagination">
											{page}
										</div> <!-- End .pagination -->
										<div class="clear"></div>
									</td>
								</tr>
							</tfoot>
						 
							<tbody>
							<?php if($list == NULL):?>
								<tr>
									<td colspan="<?php echo count($theads);?>">没有需要显示的数据</td>
								</tr>
							<?php else:?>
								<?php foreach ($list as $row) {
									echo '<tr>';
									foreach ($theads as $key => $value) {
										echo '<td>'.$row[$key].'</td>';
									}
									echo '</tr>';
								}?>
							<?php endif;?>
							</tbody>
							
						</table>
				</div> <!-- End .content-box-content -->
				
			</div>