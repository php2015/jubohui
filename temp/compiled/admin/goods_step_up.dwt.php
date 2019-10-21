<!doctype html>
<html>
<head><?php echo $this->fetch('library/admin_html_head.lbi'); ?></head>
<body class="iframe_body">
	<div class="warpper">
    	<div class="title"><?php echo $this->_var['lang']['goods_alt']; ?> - <?php echo $this->_var['ur_here']; ?></div>
        <div class="content">
			<div class="tabs_info">
				<ul>
                    <?php $_from = $this->_var['group_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'group');$this->_foreach['bar_group'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['bar_group']['total'] > 0):
    foreach ($_from AS $this->_var['group']):
        $this->_foreach['bar_group']['iteration']++;
?>
                    <li class="<?php if (($this->_foreach['bar_group']['iteration'] <= 1)): ?>curr<?php endif; ?>"><a href="javascript:void(0);"><?php echo $this->_var['group']['name']; ?></a></li>
                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				</ul>
			</div>
        	<div class="explanation" id="explanation">
            	<div class="ex_tit"><i class="sc_icon"></i><h4><?php echo $this->_var['lang']['operating_hints']; ?></h4><span id="explanationZoom" title="<?php echo $this->_var['lang']['fold_tips']; ?>"></span></div>
                <ul>
                	<li><?php echo $this->_var['lang']['operation_prompt_content']['stepup']['0']; ?></li>
                    <li><?php echo $this->_var['lang']['operation_prompt_content']['stepup']['1']; ?></li>
                </ul>
            </div>		
            <div class="flexilist">
				<div class="mian-info">
					<form enctype="multipart/form-data" name="theForm" action="shop_config.php?act=post" method="post" id="shopConfigForm">
						<?php $_from = $this->_var['group_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'group');$this->_foreach['body_group'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['body_group']['total'] > 0):
    foreach ($_from AS $this->_var['group']):
        $this->_foreach['body_group']['iteration']++;
?>
						<div class="switch_info shopConfig_switch"<?php if ($this->_foreach['body_group']['iteration'] != 1): ?> style="display:none"<?php endif; ?>>
							<?php $_from = $this->_var['group']['vars']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'var');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['var']):
?>
								<?php echo $this->fetch('library/shop_config_form.lbi'); ?>
							<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
							<div class="item">
								<div class="label">&nbsp;</div>
								<div class="label_value info_btn">
									<input name="type" type="hidden" value="goods_setup">
									<input type="submit" value="<?php echo $this->_var['lang']['button_submit']; ?>" ectype="btnSubmit" class="button" >	
								</div>
							</div>
						</div>
						<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</form>
				</div>	
            </div>	
		</div>
	</div>
	<?php echo $this->fetch('library/pagefooter.lbi'); ?>
</body>
</html>
