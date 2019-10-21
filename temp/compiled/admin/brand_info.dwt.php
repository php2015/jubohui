<!doctype html>
<html>
<head><?php echo $this->fetch('library/admin_html_head.lbi'); ?></head>

<body class="iframe_body">
	<div class="warpper">
    	<div class="title"><a href="<?php echo $this->_var['action_link']['href']; ?>" class="s-back"><?php echo $this->_var['lang']['back']; ?></a><?php echo $this->_var['lang']['goods_alt']; ?> - <?php echo $this->_var['ur_here']; ?></div>
        <div class="content">
        	<div class="explanation" id="explanation">
            	<div class="ex_tit"><i class="sc_icon"></i><h4><?php echo $this->_var['lang']['operating_hints']; ?></h4><span id="explanationZoom" title="<?php echo $this->_var['lang']['fold_tips']; ?>"></span></div>
                <ul>
                	<li><?php echo $this->_var['lang']['operation_prompt_content_common']; ?></li>
                    <li><?php echo $this->_var['lang']['operation_prompt_content']['info']['0']; ?></li>
                </ul>
            </div>
            <div class="flexilist">
                <div class="common-content">
                    <div class="mian-info">
                        <form action="brand.php" method="post" name="theForm" enctype="multipart/form-data" id="brandForm">
                            <div class="switch_info">
                                <div class="item">
                                    <div class="label"><?php echo $this->_var['lang']['require_field']; ?><?php echo $this->_var['lang']['brand_name_cn']; ?>：</div>
                                    <div class="label_value">
										<input type="text" name="brand_name" maxlength="60" value="<?php echo $this->_var['brand']['brand_name']; ?>" class="text" autocomplete="off" />
                                    	<div class="form_prompt"></div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="label"><?php echo $this->_var['lang']['brand_name_en']; ?>：</div>
                                    <div class="label_value">
										<input type="text" name="brand_letter" maxlength="60" value="<?php echo $this->_var['brand']['brand_letter']; ?>" class="text" autocomplete="off" />
                                    	<div class="form_prompt"></div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="label"><?php echo $this->_var['lang']['brand_first_char']; ?>：</div>
                                    <div class="label_value">
										<input type="text" name="brand_first_char" maxlength="60" value="<?php echo $this->_var['brand']['brand_first_char']; ?>" class="text" autocomplete="off" />
                                    	<div class="form_prompt"></div>
										<div class="notic"><?php echo $this->_var['lang']['brand_first_char_desc']; ?></div>
                                    </div>
                                </div>								
                                <div class="item">
                                    <div class="label"><?php echo $this->_var['lang']['site_url']; ?>：</div>
                                    <div class="label_value">
										<input type="text" name="site_url" size="40" value="<?php echo $this->_var['brand']['site_url']; ?>" class="text" autocomplete="off" />
                                    </div>
                                </div>									
                                <div class="item">
                                    <div class="label"><?php echo $this->_var['lang']['require_field']; ?><?php echo $this->_var['lang']['brand_logo']; ?>：</div>
                                    <div class="label_value">
                                        <div class="type-file-box">
                                            <input type="button" name="button" id="button" class="type-file-button" value="">
                                            <input type="file" class="type-file-file" id="logo" name="brand_logo" size="30" data-state="imgfile" hidefocus="true" value="">
                                            <?php if ($this->_var['brand']['brand_logo'] != ""): ?>
                                            <span class="show">
                                            	<a href="<?php echo $this->_var['brand']['brand_logo']; ?>" target="_blank" class="nyroModal"><i class="icon icon-picture" data-tooltipimg="<?php echo $this->_var['brand']['brand_logo']; ?>" ectype="tooltip" title="tooltip"></i></a>
                                            </span>
                                            <?php endif; ?>
											<input type="text" name="textfile" class="type-file-text" id="textfield" value="<?php echo $this->_var['brand']['brand_logo']; ?>" autocomplete="off" readonly>
                                        </div>
                                        <div class="form_prompt"></div>
										<div class="notic" id="warn_brandlogo">
										<?php if ($this->_var['brand']['brand_logo'] == ''): ?>
											<?php echo $this->_var['lang']['up_brandlogo']; ?>
										<?php else: ?>
											<?php echo $this->_var['lang']['warn_brandlogo']; ?>
										<?php endif; ?>
                                        </div>
                                    </div>
                                </div>
								<!-- <?php if ($this->_var['is_need']): ?> 品牌专区大图 by wu start-->
                                <div class="item">
                                    <div class="label"><?php echo $this->_var['lang']['index_img']; ?>：</div>
                                    <div class="label_value">
                                        <div class="type-file-box">
                                            <input type="button" name="button" id="button" class="type-file-button" value="">
                                            <input type="file" class="type-file-file" id="logo" name="index_img" size="30" data-state="imgfile" hidefocus="true" value="">
                                            <?php if ($this->_var['brand']['index_img'] != ""): ?>
                                            <span class="show">
                                            	<a href="<?php echo $this->_var['brand']['index_img']; ?>" target="_blank" class="nyroModal"><i class="icon icon-picture" data-tooltipimg="<?php echo $this->_var['brand']['index_img']; ?>" ectype="tooltip" title="tooltip"></i></a>
                                            </span>
                                            <?php endif; ?>
                                        	<input type="text" name="textfile" class="type-file-text" id="textfield" value="<?php echo $this->_var['brand']['index_img']; ?>" autocomplete="off" readonly>
                                        </div>
                                        <div class="form_prompt"></div>
										<div class="notic"><?php echo $this->_var['lang']['index_img_desc']; ?></div>
                                    </div>
                                </div>		
								<!-- <?php endif; ?> end-->
								<!-- 品牌背景图 start -->
								<div class="item">
                                    <div class="label"><?php echo $this->_var['lang']['brand_bg']; ?>：</div>
                                    <div class="label_value">
                                        <div class="type-file-box">
                                            <input type="button" name="button" id="button" class="type-file-button" value="">
                                            <input type="file" class="type-file-file" id="logo" name="brand_bg" size="30" data-state="imgfile" hidefocus="true" value="">
                                            <?php if ($this->_var['brand']['brand_bg'] != ""): ?>
                                            <span class="show">
                                            	<a href="<?php echo $this->_var['brand']['brand_bg']; ?>" target="_blank" class="nyroModal"><i class="icon icon-picture" data-tooltipimg="<?php echo $this->_var['brand']['brand_bg']; ?>" ectype="tooltip" title="tooltip"></i></a>
                                            </span>
                                            <?php endif; ?>
                                        	<input type="text" name="textfile" class="type-file-text" id="textfield" value="<?php echo $this->_var['brand']['brand_bg']; ?>" autocomplete="off" readonly>
                                        </div>
                                        <div class="form_prompt"></div>
										<div class="notic"><?php echo $this->_var['lang']['brand_bg_desc']; ?></div>
                                    </div>
                                </div>
								<!-- 品牌背景图 end -->
                                <div class="item">
                                    <div class="label"><?php echo $this->_var['lang']['brand_desc']; ?>：</div>
                                    <div class="label_value">
										<textarea name="brand_desc" cols="60" rows="4" class="textarea"><?php echo $this->_var['brand']['brand_desc']; ?></textarea>
                                    </div>
                                </div>								
                                <div class="item">
                                    <div class="label"><?php echo $this->_var['lang']['sort_order']; ?>：</div>
                                    <div class="label_value">
										<input type="text" name="sort_order" maxlength="40" size="15" value="<?php echo $this->_var['brand']['sort_order']; ?>" class="text text_5" autocomplete="off" />
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="label"><?php echo $this->_var['lang']['is_show']; ?>：</div>
                                    <div class="label_value">
                                        <div class="checkbox_items" style="width:auto;">
                                            <div class="checkbox_item">
                                                <input type="radio" class="ui-radio" name="is_show" id="is_show_1" value="1" <?php if ($this->_var['brand']['is_show'] == 1): ?> checked="true" <?php endif; ?>  />
                                                <label for="is_show_1" class="ui-radio-label"><?php echo $this->_var['lang']['yes']; ?></label>
                                            </div>
                                            <div class="checkbox_item">
                                                <input type="radio" class="ui-radio" name="is_show" id="is_show_0" value="0" <?php if ($this->_var['brand']['is_show'] == 0): ?> checked="true" <?php endif; ?>  />
                                                <label for="is_show_0" class="ui-radio-label"><?php echo $this->_var['lang']['no']; ?></label>
                                            </div>
                                        </div>
										<div class="notic">(<?php echo $this->_var['lang']['visibility_notes']; ?>)</div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="label"><?php echo $this->_var['lang']['lab_intro']; ?>：</div>
                                    <div class="label_value">
                                        <div class="checkbox_items">
                                            <div class="checkbox_item">
                                                <input type="radio" class="ui-radio" name="is_recommend" id="is_recommend_1" value="1" <?php if ($this->_var['brand']['is_recommend'] == 1): ?> checked="true" <?php endif; ?>  />
                                                <label for="is_recommend_1" class="ui-radio-label"><?php echo $this->_var['lang']['yes']; ?></label>
                                            </div>
                                            <div class="checkbox_item">
                                                <input type="radio" class="ui-radio" name="is_recommend" id="is_recommend_0" value="0" <?php if ($this->_var['brand']['is_recommend'] == 0): ?> checked="true" <?php endif; ?>  />
                                                <label for="is_recommend_0" class="ui-radio-label"><?php echo $this->_var['lang']['no']; ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>								
                                <div class="item">
                                    <div class="label">&nbsp;</div>
                                    <div class="label_value info_btn">
										<input type="button" class="button" value="<?php echo $this->_var['lang']['button_submit']; ?>" id="submitBtn" />
										<input type="reset" class="button button_reset" value="<?php echo $this->_var['lang']['button_reset']; ?>" />
										<input type="hidden" name="act" value="<?php echo $this->_var['form_action']; ?>" />
										<input type="hidden" name="old_brandname" value="<?php echo $this->_var['brand']['brand_name']; ?>" />
										<input type="hidden" name="id" value="<?php echo $this->_var['brand']['brand_id']; ?>" />
										<input type="hidden" name="old_brandlogo" value="<?php echo $this->_var['brand']['brand_logo']; ?>">
                                    </div>
                                </div>								
                            </div>
                        </form>
                    </div>
                </div>
            </div>
		</div>
    </div>
    <?php echo $this->fetch('library/pagefooter.lbi'); ?>
	
	<script type="text/javascript">
	$(function(){
		//表单验证
		$("#submitBtn").click(function(){
			if($("#brandForm").valid()){
				$("#brandForm").submit();
			}
		});
		
		$(function(){
			$('.nyroModal').nyroModal();
		});
		
		$('#brandForm').validate({
			errorPlacement:function(error, element){
				var error_div = element.parents('div.label_value').find('div.form_prompt');
				element.parents('div.label_value').find(".notic").hide();
				error_div.append(error);
			},
			rules:{
				brand_name :{
					required : true
				},
				textfile:{
					required : true
				}
			},
			messages:{
				brand_name:{
					required : '<i class="icon icon-exclamation-sign"></i>' + brand_zh_name_null
				},
				textfile:{
					required : '<i class="icon icon-exclamation-sign"></i>' + brand_logo_null
				}
			}			
		});
	});
	</script>
	
</body>
</html>
