<!doctype html>
<html>
<head><?php echo $this->fetch('library/admin_html_head.lbi'); ?></head>

<body class="iframe_body">
	<div class="warpper">
    	<div class="title"><?php echo $this->_var['lang']['11_system']; ?> - <?php echo $this->_var['ur_here']; ?></div>
        <div class="content">
        	<div class="explanation" id="explanation">
            	<div class="ex_tit">
					<i class="sc_icon"></i><h4><?php echo $this->_var['lang']['operating_hints']; ?></h4><span id="explanationZoom" title="<?php echo $this->_var['lang']['fold_tips']; ?>"></span>
                    <?php if ($this->_var['open'] == 1): ?>
                    <div class="view-case">
                    	<div class="view-case-tit"><i></i><?php echo $this->_var['lang']['view_tutorials']; ?></div>
                        <div class="view-case-info">
                        	<a href="http://help.ecmoban.com/article-6873.html" target="_blank"><?php echo $this->_var['lang']['tutorials_bonus_list_one']; ?></a>
                        </div>
                    </div>			
                    <?php endif; ?>	
				</div>
                <ul>
                	<li><?php echo $this->_var['lang']['operation_prompt_content']['list']['0']; ?></li>
                    <li><?php echo $this->_var['lang']['operation_prompt_content']['list']['1']; ?></li>
                    <li><?php echo $this->_var['lang']['operation_prompt_content']['list']['2']; ?></li>
                </ul>
            </div>
            <div class="flexilist">
                <div class="common-content">
                	<div class="list-div" id="listDiv">
                    	<table class="table_layout">
                            <thead>
                            	<tr>
                                    <th width="10%"><div class="tDiv"><?php echo $this->_var['lang']['payment_name']; ?></div></th>
                                    <th width="40%"><div class="tDiv"><?php echo $this->_var['lang']['payment_desc']; ?></div></th>
                                    <th width="5%"><div class="tDiv">&nbsp;</div></th>
                                    <th width="5%"><div class="tDiv">&nbsp;</div></th>
                                    <th width="15%"><div class="tDiv"><?php echo $this->_var['lang']['short_pay_fee']; ?></div></th>
                                    <th width="10%"><div class="tDiv tc"><?php echo $this->_var['lang']['sort_order']; ?></div></th>
                                    <th width="15%" class="handle"><?php echo $this->_var['lang']['handler']; ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $_from = $this->_var['modules']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'module');if (count($_from)):
    foreach ($_from AS $this->_var['module']):
?>
                                 <?php if ($this->_var['module']['code'] != "tenpayc2c" && $this->_var['module']['code'] != "epay"): ?>
                            	<tr>
                                    <td><div class="tDiv"><?php echo $this->_var['module']['name']; ?></div></td>
                                    <td><div class="tDiv"><?php echo nl2br($this->_var['module']['desc']); ?></div></td>
                                    <td><div class="tDiv">&nbsp;</div></td>
                                    <td><div class="tDiv">&nbsp;</div></td>
                                    <td><div class="tDiv"><?php if ($this->_var['module']['is_cod']): ?><?php echo $this->_var['lang']['decide_by_ship']; ?><?php else: ?><?php echo $this->_var['module']['pay_fee']; ?><?php endif; ?></div></td>
                                    <td><div class="tDiv tc"><?php if ($this->_var['module']['install'] == 1): ?> <input class="text w50 tc fn" style="margin-right:0px;" onblur="listTable.editInput(this, 'edit_pay_order', '<?php echo $this->_var['module']['code']; ?>' );" autocomplete="off" value="<?php echo $this->_var['module']['pay_order']; ?>" type="text"> <?php else: ?> &nbsp; <?php endif; ?> </div></td>
                                    <td class="handle">
                                        <div class="tDiv a3">
                                            <?php if ($this->_var['module']['install'] == "1"): ?>
                                                <?php if ($this->_var['module']['code'] == "tenpay"): ?>
                                                    <a href="javascript:confirm_redirect(lang_removeconfirm, 'payment.php?act=uninstall&code=<?php echo $this->_var['module']['code']; ?>')" class="btn_see"><i class="sc_icon sc_icon_see"></i><?php echo $this->_var['lang']['uninstall']; ?><?php echo $this->_var['lang']['tenpay']; ?></a>
                                                    <a href="payment.php?act=edit&code=<?php echo $this->_var['module']['code']; ?>" class="btn_edit"><i class="icon icon-edit"></i><?php echo $this->_var['lang']['edit']; ?></a><br />
                                                    <?php if ($this->_var['tenpayc2c']['install'] == "1"): ?><a href="javascript:confirm_redirect(lang_removeconfirm, 'payment.php?act=uninstall&code=tenpayc2c')" class="btn_see"><i class="sc_icon sc_icon_see"></i><?php echo $this->_var['lang']['uninstall']; ?><?php echo $this->_var['lang']['tenpayc2c']; ?></a>
                                                        <a href="payment.php?act=edit&code=tenpayc2c" class="btn_edit"><i class="icon icon-edit"></i><?php echo $this->_var['lang']['edit']; ?></a>
                                                    <?php else: ?>
                                                        <a href="payment.php?act=install&code=tenpayc2c" class="btn_inst"><i class="sc_icon sc_icon_inst"></i><?php echo $this->_var['lang']['install']; ?><?php echo $this->_var['lang']['tenpayc2c']; ?></a>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <a href="javascript:confirm_redirect(lang_removeconfirm, 'payment.php?act=uninstall&code=<?php echo $this->_var['module']['code']; ?>')" class="btn_trash"><i class="icon icon-trash"></i><?php echo $this->_var['lang']['uninstall']; ?></a>
                                                    <a href="payment.php?act=edit&code=<?php echo $this->_var['module']['code']; ?>"class="btn_edit"><i class="icon icon-edit"></i><?php echo $this->_var['lang']['edit']; ?></a>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <?php if ($this->_var['module']['code'] == "tenpay"): ?>
                                                    <a href="payment.php?act=install&code=<?php echo $this->_var['module']['code']; ?>" class="btn_inst"><i class="sc_icon sc_icon_inst"></i><?php echo $this->_var['lang']['install']; ?><?php echo $this->_var['lang']['tenpay']; ?></a>
                                                    <?php if ($this->_var['tenpayc2c']['install'] == "1"): ?>
                                                        <a href="javascript:confirm_redirect(lang_removeconfirm, 'payment.php?act=uninstall&code=tenpayc2c')" class="btn_trash"><i class="icon icon-trash"></i><?php echo $this->_var['lang']['uninstall']; ?><?php echo $this->_var['lang']['tenpayc2c']; ?></a>
                                                        <a href="payment.php?act=edit&code=tenpayc2c"class="btn_edit"><i class="icon icon-edit"></i><?php echo $this->_var['lang']['edit']; ?></a>
                                                    <?php else: ?>
                                                        <a href="payment.php?act=install&code=tenpayc2c" class="btn_inst"><i class="sc_icon sc_icon_inst"></i><?php echo $this->_var['lang']['install']; ?><?php echo $this->_var['lang']['tenpayc2c']; ?></a>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                <a href="payment.php?act=install&code=<?php echo $this->_var['module']['code']; ?>" class="btn_inst"><i class="sc_icon sc_icon_inst"></i><?php echo $this->_var['lang']['install']; ?></a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php endif; ?>
                                <?php endforeach; else: ?>
                                    <tr><td class="no-records" colspan="12"><?php echo $this->_var['lang']['no_records']; ?></td></tr>
                                <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
		</div>
	</div>
 	<?php echo $this->fetch('library/pagefooter.lbi'); ?>
    <script type="text/javascript">
		//列表导航栏设置下路选项
    	$(".ps-container").perfectScrollbar();
    </script>     
</body>
</html>
