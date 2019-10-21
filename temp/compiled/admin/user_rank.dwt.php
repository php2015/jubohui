<?php if ($this->_var['full_page']): ?>
<!doctype html>
<head><?php echo $this->fetch('library/admin_html_head.lbi'); ?></head>

<body class="iframe_body">
	<div class="warpper">
    	<div class="title"><?php echo $this->_var['lang']['08_members']; ?> - <?php echo $this->_var['ur_here']; ?></div>
        <div class="content">
        	<?php echo $this->fetch('library/users_tab.lbi'); ?>
        	<div class="explanation" id="explanation">
                <div class="ex_tit"><i class="sc_icon"></i><h4><?php echo $this->_var['lang']['operating_hints']; ?></h4><span id="explanationZoom" title="<?php echo $this->_var['lang']['fold_tips']; ?>"></span></div>
                <ul>
                    <li><?php echo $this->_var['lang']['operation_prompt_content']['list']['0']; ?></li>
                    <li><?php echo $this->_var['lang']['operation_prompt_content']['list']['1']; ?></li>
                </ul>
            </div>
            <div class="flexilist">
            	<!--等级列表-->
            	<div class="common-head">
                	<div class="fl">
                    	<a href="<?php echo $this->_var['action_link']['href']; ?>"/><div class="fbutton"><div class="add" title="<?php echo $this->_var['action_link']['text']; ?>"><span><i class="icon icon-plus"></i><?php echo $this->_var['action_link']['text']; ?></span></div></div></a>
                    </div>
                </div>
                <div class="common-content">
                	<div class="list-div" id="listDiv">
                        <?php endif; ?>
                    	<table cellpadding="0" cellspacing="0" border="0">
                        	<thead>
                            	<tr>
                                    <th width="15%"><div class="tDiv"><?php echo $this->_var['lang']['rank_name']; ?></div></th>
                                    <th width="13%"><div class="tDiv"><?php echo $this->_var['lang']['integral_min']; ?></div></th>
                                    <th width="13%"><div class="tDiv"><?php echo $this->_var['lang']['integral_max']; ?></div></th>
                                    <th width="13%"><div class="tDiv"><?php echo $this->_var['lang']['discount']; ?>(%)</div></th>
                                    <th width="12%"><div class="tDiv"><?php echo $this->_var['lang']['special_rank']; ?></div></th>
                                    <th width="12%"><div class="tDiv"><?php echo $this->_var['lang']['show_price_short']; ?></div></th>
                                    <th width="13%" class="handle"><?php echo $this->_var['lang']['handler']; ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $_from = $this->_var['user_ranks']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'rank');if (count($_from)):
    foreach ($_from AS $this->_var['rank']):
?>
                            	<tr>
                                    <td><div class="tDiv"><?php echo $this->_var['rank']['rank_name']; ?></div></td>
                                    <td><div class="tDiv"><?php echo $this->_var['rank']['min_points']; ?></div></td>
                                    <td><div class="tDiv"><?php echo $this->_var['rank']['max_points']; ?></div></td>
                                    <td><div class="tDiv"><?php echo $this->_var['rank']['discount']; ?></div></td>
                                    <td>
										<div class="tDiv"><img src="images/<?php if ($this->_var['rank']['special_rank']): ?>yes<?php else: ?>no<?php endif; ?>.png" class="pl3" /></div>
                                    </td>
                                    <td>
                                    	<div class="tDiv">
                                            <div class="switch <?php if ($this->_var['rank']['show_price']): ?>active<?php endif; ?>" title="<?php if ($this->_var['rank']['show_price']): ?>是<?php else: ?>否<?php endif; ?>" onclick="listTable.switchBt(this, 'toggle_showprice', <?php echo $this->_var['rank']['rank_id']; ?>)">
                                            	<div class="circle"></div>
                                            </div>
                                            <input type="hidden" value="0" name="">
                                        </div>
                                    </td>
                                    <td class="handle">
                                        <div class="tDiv a2">
                                            <a href="user_rank.php?act=edit&id=<?php echo $this->_var['rank']['rank_id']; ?>" title="<?php echo $this->_var['lang']['edit']; ?>" class="btn_edit"><i class="icon icon-edit"></i><?php echo $this->_var['lang']['edit']; ?></a>
                                            <a href="javascript:;" onclick="listTable.remove(<?php echo $this->_var['rank']['rank_id']; ?>, '<?php echo $this->_var['lang']['drop_confirm']; ?>')" title="<?php echo $this->_var['lang']['remove']; ?>" class="btn_trash"><i class="icon icon-trash"></i><?php echo $this->_var['lang']['drop']; ?></a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; else: ?>
								<tr><td class="no-records" colspan="10"><?php echo $this->_var['lang']['no_records']; ?></td></tr>
								<?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
                            </tbody>
                        </table>  
                            <?php if ($this->_var['full_page']): ?>
                    </div>
                </div>
                <!--等级列表end-->
            </div>
		</div>
	</div>
    <?php echo $this->fetch('library/pagefooter.lbi'); ?>
    <script type="text/javascript">
    	//分页传值
    	listTable.recordCount = <?php echo $this->_var['rank_count']; ?>;

    	<?php $_from = $this->_var['filter']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
    	listTable.filter.<?php echo $this->_var['key']; ?> = '<?php echo $this->_var['item']; ?>';
    	<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </script>
</body>
</html>
<?php endif; ?>
