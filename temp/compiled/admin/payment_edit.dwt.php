<!doctype html>
<html>
<head><?php echo $this->fetch('library/admin_html_head.lbi'); ?></head>

<body class="iframe_body">
	<div class="warpper">
    	<div class="title"><a href="<?php echo $this->_var['action_link']['href']; ?>" class="s-back"></a><?php echo $this->_var['lang']['payment']; ?> - <?php echo $this->_var['ur_here']; ?></div>
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
                        <form action="payment.php" method="post" name="theForm" id="reg_form">
                    		<div class="switch_info">
                                <div class="items">
                                    <div class="item">
                                        <div class="label"><?php echo $this->_var['lang']['require_field']; ?>&nbsp;<?php echo $this->_var['lang']['payment_name']; ?>：</div>
                                        <div class="value">
                                            <input type="text" class="text" name="pay_name"  value="<?php echo htmlspecialchars($this->_var['pay']['pay_name']); ?>" id="pay_name" autocomplete="off" />
                                            <div class="form_prompt"></div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="label"><?php echo $this->_var['lang']['payment_desc']; ?>：</div>
                                        <div class="value">
                                            <textarea class="textarea" name="pay_desc" id="role_describe"><?php echo htmlspecialchars($this->_var['pay']['pay_desc']); ?></textarea>
                                            <div class="form_prompt"></div>
                                        </div>
                                    </div>
                                    <?php $_from = $this->_var['pay']['pay_config']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'config');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['config']):
?>
                                    <div class="item">
                                        <div class="label"><?php echo $this->_var['config']['label']; ?>：</div>
                                        <!-- <?php if ($this->_var['config']['type'] == "text"): ?> -->
                                        <div class="label_value"><input type="<?php echo $this->_var['config']['type']; ?>" name="cfg_value[]" class="text" value="<?php echo $this->_var['config']['value']; ?>" autocomplete="off"  /><?php if ($this->_var['config']['desc']): ?><div class="notic"><?php echo nl2br($this->_var['config']['desc']); ?></div><?php endif; ?></div>
                                         <!-- <?php elseif ($this->_var['config']['type'] == "textarea"): ?> -->
                                         <div class="label_value"><textarea class="textarea"  name="cfg_value[]" ><?php echo $this->_var['config']['value']; ?></textarea><?php if ($this->_var['config']['desc']): ?><div class="notic"><?php echo nl2br($this->_var['config']['desc']); ?></div><?php endif; ?></div>
                                         <!-- <?php elseif ($this->_var['config']['type'] == "select"): ?> -->
                                         <div class="label_value">
                                            <div class="imitate_select select_w320">
                                                <div class="cite"><?php echo $this->_var['lang']['please_select']; ?></div>
                                                <ul>
                                                   <?php $_from = $this->_var['config']['range']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('k', 'options');if (count($_from)):
    foreach ($_from AS $this->_var['k'] => $this->_var['options']):
?>
                                                   <li><a href="javascript:;" selectid="<?php echo $this->_var['k']; ?>" data-value="<?php echo $this->_var['k']; ?>" class="ftx-01"><?php echo $this->_var['options']; ?></a></li>
                                                   <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                                </ul>
                                                <input name="cfg_value[]" type="hidden" value="<?php echo $this->_var['config']['value']; ?>">
                                            </div>
                                             <?php if ($this->_var['config']['desc']): ?><div class="notic"><?php echo nl2br($this->_var['config']['desc']); ?></div><?php endif; ?>
                                        </div>
                                         <!--<?php endif; ?>-->
                                        <input name="cfg_name[]" type="hidden" value="<?php echo $this->_var['config']['name']; ?>" />
                                        <input name="cfg_type[]" type="hidden" value="<?php echo $this->_var['config']['type']; ?>" />
                                        <input name="cfg_lang[]" type="hidden" value="<?php echo $this->_var['config']['lang']; ?>" />
                                        <!--the tenpay code -->
                                    </div>
                                    <?php if ($this->_var['key'] == "0" && $_GET['code'] == "tenpay"): ?>
                                    <div class="item">
                                        <div class="label">&nbsp;</div>
                                        <div class="label_value">
                                            <input align=""type="button" value="<?php echo $this->_var['lang']['ctenpay']; ?>" onclick="javascript:window.open('<?php echo $this->_var['lang']['ctenpay_url']; ?>')"/>
                                        </div>
                                    </div>
                                    <?php elseif ($this->_var['key'] == "0" && $_GET['code'] == "tenpayc2c"): ?>
                                    <div class="item">
                                        <div class="label">&nbsp;</div>
                                        <div class="label_value">
                                            <input align=""type="button" value="<?php echo $this->_var['lang']['ctenpay']; ?>" onclick="javascript:window.open('<?php echo $this->_var['lang']['ctenpayc2c_url']; ?>')"/>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                    <?php if ($this->_var['pay']['pay_code'] != 'chunsejinrong' && $this->_var['pay']['pay_code'] != 'onlinepay'): ?>
                                    <div class="item">
                                        <div class="label"><?php echo $this->_var['lang']['pay_fee']; ?>：</div>
                                        <div class="label_value">
                                            <?php if ($this->_var['pay']['is_cod']): ?>
                                            <input name="pay_fee" type="hidden" value="<?php echo empty($this->_var['pay']['pay_fee']) ? '0' : $this->_var['pay']['pay_fee']; ?>" />
                                            <div class="notic"><?php echo $this->_var['lang']['decide_by_ship']; ?></div>
                                            <?php else: ?>
                                            <input name="pay_fee" type="text" value="<?php echo empty($this->_var['pay']['pay_fee']) ? '0' : $this->_var['pay']['pay_fee']; ?>" class="text" autocomplete="off" />
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <div class="item">
                                        <div class="label"><?php echo $this->_var['lang']['payment_is_cod']; ?>：</div>
                                        <div class="value">
                                            <?php if ($this->_var['pay']['is_cod'] == "1"): ?><?php echo $this->_var['lang']['yes']; ?><?php else: ?><?php echo $this->_var['lang']['no']; ?><?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="label"><?php echo $this->_var['lang']['payment_is_online']; ?>：</div>
                                        <div class="value">
                                            <?php if ($this->_var['pay']['is_online'] == "1"): ?><?php echo $this->_var['lang']['yes']; ?><?php else: ?><?php echo $this->_var['lang']['no']; ?><?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="label">&nbsp;</div>
                                        <div class="value info_btn">
                                            <input type="submit" class="button" value="<?php echo $this->_var['lang']['button_submit']; ?>" name="Submit"/>
                                            <input type="hidden" name="pay_id" value="<?php echo $this->_var['pay']['pay_id']; ?>" />
                                            <input type="hidden" name="pay_code" value="<?php echo $this->_var['pay']['pay_code']; ?>" />
                                            <input type="hidden" name="is_cod" value="<?php echo $this->_var['pay']['is_cod']; ?>" />
                                            <input type="hidden" name="is_online" value="<?php echo $this->_var['pay']['is_online']; ?>" />
                                        </div>
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
    <script language="javascript">
	$(function(){
		$("#submitBtn").click(function(){
			if($("#reg_form").valid()){
				$("#reg_form").submit();
			}
		});

		$('#reg_form').validate({
			errorPlacement:function(error, element){
				var error_div = element.parents('div.value').find('div.form_prompt');
				error_div.append(error);
			},
			rules:{
				pay_name:{
					required : true
				}
			},
			messages:{
				pay_name:{
					required:'<i class="icon icon-exclamation-sign"></i>'+pay_name_null
				}
			}
		});
	});
    </script>
</body>
</html>
