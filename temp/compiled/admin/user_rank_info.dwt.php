<!doctype html>
<html>
<head><?php echo $this->fetch('library/admin_html_head.lbi'); ?></head>

<body class="iframe_body">
	<div class="warpper">
    	<div class="title"><a href="<?php echo $this->_var['action_link']['href']; ?>" class="s-back"><?php echo $this->_var['lang']['back']; ?></a><?php echo $this->_var['lang']['08_members']; ?> - <?php echo $this->_var['ur_here']; ?></div>
        <div class="content">
        	<div class="explanation" id="explanation">
                <div class="ex_tit"><i class="sc_icon"></i><h4><?php echo $this->_var['lang']['operating_hints']; ?></h4><span id="explanationZoom" title="<?php echo $this->_var['lang']['fold_tips']; ?>"></span></div>
                <ul>
                    <li><?php echo $this->_var['lang']['operation_prompt_content_common']; ?></li>
                </ul>
            </div>
            <div class="flexilist">
                <div class="common-content">
                    <div class="mian-info">
                        <form action="user_rank.php" method="post" name="theForm" id="user_rank_form"> 
                        	<div class="switch_info">
                                <div class="item">
                                    <div class="label"><?php echo $this->_var['lang']['require_field']; ?>&nbsp;<?php echo $this->_var['lang']['rank_name']; ?>：</div>
                                    <div class="label_value">
                                        <input type="text" name="rank_name" value="<?php echo $this->_var['rank']['rank_name']; ?>" class="text" id="rank_name" autocomplete="off" />
                                        <div class="form_prompt"></div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="label"><?php echo $this->_var['lang']['require_field']; ?>&nbsp;<?php echo $this->_var['lang']['integral_min']; ?>：</div>
                                    <div class="label_value">
                                        <div class="lie">
                                            <input type="text" name="min_points" value="<?php echo $this->_var['rank']['min_points']; ?>" class="text text_2" <?php if ($this->_var['rank']['special_rank']): ?>disabled<?php endif; ?> id="min_points" autocomplete="off" />
                                            <div class="label_label"><?php echo $this->_var['lang']['require_field']; ?>&nbsp;<?php echo $this->_var['lang']['integral_max']; ?>：</div>
                                            <input type="text" name="max_points" value="<?php echo $this->_var['rank']['max_points']; ?>" class="text text_2" <?php if ($this->_var['rank']['special_rank']): ?>disabled<?php endif; ?> id="max_points" autocomplete="off" />
                                            <div class="form_prompt"></div>
                                        </div>
                                        <div class="lie mt15">
                                            <input type="checkbox" class="ui-checkbox" value='1' name="show_price" <?php if ($this->_var['rank']['show_price'] == 1): ?>checked<?php endif; ?>  id="checkbox_001"/>
                                            <label for="checkbox_001" class="ui-label"><?php echo $this->_var['lang']['show_price']; ?></label>
                                        </div>
                                        <div class="lie mt5">
                                            <input type="checkbox" class="ui-checkbox" value='1' name="special_rank" <?php if ($this->_var['rank']['special_rank'] == 1): ?>checked<?php endif; ?>  id="checkbox_002" />
                                            <label for="checkbox_002" class="ui-label"><?php echo $this->_var['lang']['special_rank']; ?><em class="require-field"><?php echo $this->_var['lang']['notice_special']; ?></em></label>
                                        </div>
                                    </div>
                                </div>
                               <div class="item">
                                    <div class="label"><?php echo $this->_var['lang']['require_field']; ?>&nbsp;<?php echo $this->_var['lang']['discount']; ?>：</div>
                                    <div class="label_value">
                                        <input type="text" name="discount" value="<?php echo $this->_var['rank']['discount']; ?>" class="text" id="discount" autocomplete="off" />
                                        <div class="form_prompt"></div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="label">&nbsp;</div>
                                    <div class="label_value info_btn">
                                        <a href="javascript:;" class="button" id="submitBtn"><?php echo $this->_var['lang']['button_submit']; ?></a>
                                        <input type="hidden" name="act" value="<?php echo $this->_var['form_action']; ?>" />
                                        <input type="hidden" name="id" value="<?php echo $this->_var['rank']['rank_id']; ?>" />
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
		//列表导航栏设置下路选项
    	$(".ps-container").perfectScrollbar();

		$("#checkbox_002").click(function(){
			if($("#checkbox_002").is(":checked")==true){
				$("#min_points").attr("disabled","disabled");
				$("#max_points").attr("disabled","disabled");
			}else{
				$("#min_points").removeAttr("disabled");
				$("#max_points").removeAttr("disabled");
			}
		})

		$(function(){
			$("#submitBtn").click(function(){
				var minval = Number($.trim($("#min_points").val()));
				var maxval = Number($.trim($("#max_points").val()));
				
				if($("#user_rank_form").valid()){
					if(minval > maxval){
						alert(integral_max_small);
					}else{
						$("#user_rank_form").submit();
					}
				}
			});
		
			$('#user_rank_form').validate({
				errorPlacement:function(error, element){
					var error_div = element.parents('div.label_value').find('div.form_prompt');
					element.parents('div.label_value').find(".notic").hide();
					error_div.append(error);
				},
				rules : {
					rank_name : {
						required : true
					},
					discount : {
						required : true,
						min : 0,
						max : 100
					},
					min_points : {
						digits : true
					},
					max_points : {
						digits : true
					}
						
				},
				messages : {
					rank_name : {
						required : '<i class="icon icon-exclamation-sign"></i>'+rank_name_empty
					},
					discount : {
						required : '<i class="icon icon-exclamation-sign"></i>'+discount_invalid,
						min : '<i class="icon icon-exclamation-sign"></i>'+discount_invalid,
						max : '<i class="icon icon-exclamation-sign"></i>'+discount_invalid
					},
					min_points : {
						digits : '<i class="icon icon-exclamation-sign"></i>'+integral_min_invalid
					},
					max_points : {
						digits : '<i class="icon icon-exclamation-sign"></i>'+integral_max_invalid
					}
				}
			});
		});
	</script>     
</body>
</html>
