<?php if ($this->_var['full_page']): ?>
<!doctype html>
<html>
<head><?php echo $this->fetch('library/admin_html_head.lbi'); ?></head>

<body class="iframe_body">
	<div class="warpper">
    	<div class="title"><?php echo $this->_var['lang']['goods_alt']; ?> - <?php echo $this->_var['ur_here']; ?></div>
        <div class="content">
        	<div class="tabs_info">
            	<ul>
                    <li <?php if ($this->_var['menu_select']['current'] == '06_goods_brand_list'): ?>class="curr"<?php endif; ?>><a href="brand.php?act=list"><?php echo $this->_var['lang']['06_goods_brand_list']; ?></a></li>
                    <li <?php if ($this->_var['menu_select']['current'] == '07_merchants_brand'): ?>class="curr"<?php endif; ?>><a href="merchants_brand.php?act=list"><?php echo $this->_var['lang']['07_merchants_brand']; ?></a></li>
                </ul>
            </div>			
        	<div class="explanation" id="explanation">
            	<div class="ex_tit"><i class="sc_icon"></i><h4><?php echo $this->_var['lang']['operating_hints']; ?></h4><span id="explanationZoom" title="<?php echo $this->_var['lang']['fold_tips']; ?>"></span></div>
                <ul>
                	<li><?php echo $this->_var['lang']['operation_prompt_content']['list']['0']; ?></li>
                    <li><?php echo $this->_var['lang']['operation_prompt_content']['list']['1']; ?></li>
                </ul>
            </div>
            <div class="flexilist">
                <div class="common-head">
                    <div class="refresh">
                    	<div class="refresh_tit" title="<?php echo $this->_var['lang']['refresh_data']; ?>"><i class="icon icon-refresh"></i></div>
                    	<div class="refresh_span"><?php echo $this->_var['lang']['refresh_common']; ?><?php echo $this->_var['record_count']; ?><?php echo $this->_var['lang']['record']; ?></div>
                    </div>
					<div class="search">
                    	<form action="javascript:;" name="searchForm" onSubmit="searchGoodsname(this);">
                    	<div class="input">
                        	<input type="text" name="brand_name" class="text nofocus" placeholder="<?php echo $this->_var['lang']['brand_name']; ?>" autocomplete="off">
							<input type="submit" class="btn" name="secrch_btn" ectype="secrch_btn" value="" />
                        </div>
                        </form>
                    </div>
                </div>
                <div class="common-content">
                	<div class="list-div" id="listDiv">
						<?php endif; ?>
                    	<table cellpadding="0" cellspacing="0" border="0">
                        	<thead>
                            	<tr>
                                	<th width="5%"><div class="tDiv"><?php echo $this->_var['lang']['record_id']; ?></div></th>
                                    <th width="10%"><div class="tDiv"><?php echo $this->_var['lang']['brand_name_cn']; ?></div></th>
                                    <th width="9%"><div class="tDiv"><?php echo $this->_var['lang']['brand_name_en']; ?></div></th>
                                    <th width="6%"><div class="tDiv"><?php echo $this->_var['lang']['brand_image']; ?></div></th>
									<th width="9%"><div class="tDiv"><?php echo $this->_var['lang']['associated_platform_brands']; ?></div></th>
									<th width="12%"><div class="tDiv"><?php echo $this->_var['lang']['goods_steps_name']; ?></div></th>
                                    <!--<th width="12%"><div class="tDiv"><?php echo $this->_var['lang']['site_url']; ?></div></th>-->
                                    <th width="12%"><div class="tDiv"><?php echo $this->_var['lang']['brand_desc']; ?></div></th>
                                    <th width="4%"><div class="tDiv"><?php echo $this->_var['lang']['sort_order']; ?></div></th>
                                    <th width="5%"><div class="tDiv"><?php echo $this->_var['lang']['display']; ?></div></th>
									<th width="7%"><div class="tDiv"><?php echo $this->_var['lang']['adopt_status']; ?></div></th>
                                    <th width="7%" class="handle"><?php echo $this->_var['lang']['handler']; ?></th>
                                </tr>
                            </thead>
                            <tbody>
								<?php $_from = $this->_var['brand_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'brand');if (count($_from)):
    foreach ($_from AS $this->_var['brand']):
?>
                            	<tr>
                                    <td><div class="tDiv"><?php echo $this->_var['brand']['brand_id']; ?></div></td>
									<td>
                                        <div class="tDiv">
                                            <span onclick="javascript:listTable.edit(this, 'edit_brand_name', <?php echo $this->_var['brand']['brand_id']; ?>)"><?php echo htmlspecialchars($this->_var['brand']['brand_name']); ?></span>
                                        </div>
                                    </td>
									<td><div class="tDiv"><?php echo htmlspecialchars($this->_var['brand']['brand_letter']); ?></div></td>
									<td>
                                    <div class="tDiv">
                                    	<span class="show">
                                            <a href="<?php if ($this->_var['brand']['brand_logo']): ?><?php echo $this->_var['brand']['brand_logo']; ?><?php else: ?>images/default/brand_logo_default.jpg<?php endif; ?>" class="nyroModal"><i class="icon icon-picture" data-tooltipimg="<?php if ($this->_var['brand']['brand_logo']): ?><?php echo $this->_var['brand']['brand_logo']; ?><?php else: ?>images/default/brand_logo_default.jpg<?php endif; ?>" ectype="tooltip" title="tooltip"></i></a>
                                        </span>                                    
                                    </div>
                                    </td>
                                    <td><div class="tDiv"><?php echo $this->_var['brand']['link_brand']['brand_name']; ?></div></td>
									<td><div class="tDiv"><?php if ($this->_var['brand']['user_name']): ?><font class="red"><?php echo $this->_var['brand']['user_name']; ?></font><?php else: ?><font class="navy2"><?php echo $this->_var['lang']['is_application']; ?></font><?php endif; ?></div></td>
									<!--<td><div class="tDiv"><p class="ellipsis w200"><?php echo $this->_var['brand']['site_url']; ?></p></div></td>-->
									<td><div class="tDiv"><?php echo sub_str($this->_var['brand']['brand_desc'],36); ?></div></td>
                                    <td><div class="tDiv"><input name="sort_order" class="text w40" value="<?php echo $this->_var['brand']['sort_order']; ?>" onkeyup="listTable.editInput(this, 'edit_sort_order',<?php echo $this->_var['brand']['brand_id']; ?> )" type="text"></div></td>
                                    <td>
                                        <div class="tDiv">
                                            <div class="switch <?php if ($this->_var['brand']['is_show']): ?>active<?php endif; ?>" title="<?php if ($this->_var['brand']['is_show']): ?><?php echo $this->_var['lang']['yes']; ?><?php else: ?><?php echo $this->_var['lang']['no']; ?><?php endif; ?>" onclick="listTable.switchBt(this, 'toggle_show', <?php echo $this->_var['brand']['brand_id']; ?>)">
                                                <div class="circle"></div>
                                            </div>
                                            <input type="hidden" value="0" name="">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="tDiv">
                                            <?php if ($this->_var['brand']['audit_status'] == 1): ?>
                                                <font class="blue"><?php echo $this->_var['lang']['have_audited']; ?></font>    
                                            <?php elseif ($this->_var['brand']['audit_status'] == 2): ?>
                                                <font class="red"><?php echo $this->_var['lang']['audited_not_adopt']; ?></font>    
                                            <?php else: ?>
                                                <font class="org"><?php echo $this->_var['lang']['not_audited']; ?></font>    
                                            <?php endif; ?>
                                        </div>
                                    </td>                               
                                    <td class="handle">
                                        <div class="tDiv a2">
                                            <a href="merchants_brand.php?act=edit&id=<?php echo $this->_var['brand']['brand_id']; ?>" class="btn_edit"><i class="icon icon-edit"></i><?php echo $this->_var['lang']['edit']; ?></a>
                                            <a href="javascript:;" onclick="listTable.remove(<?php echo $this->_var['brand']['brand_id']; ?>, '<?php echo $this->_var['lang']['drop_confirm']; ?>')" class="btn_trash"><i class="icon icon-trash"></i><?php echo $this->_var['lang']['drop']; ?></a>
                                        </div>
                                    </td>
                                </tr>
								<?php endforeach; else: ?>
								<tr><td class="no-records"  colspan="20"><?php echo $this->_var['lang']['no_records']; ?></td></tr>								
								<?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
                            </tbody>
                            <tfoot>
                            	<tr>
                                	<td colspan="11">
                                        <div class="list-page">
                                           <?php echo $this->fetch('library/page.lbi'); ?>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
						<?php if ($this->_var['full_page']): ?>
                    </div>
                </div>
            </div>
		</div>
	</div>
 	<?php echo $this->fetch('library/pagefooter.lbi'); ?>
	<script type="text/javascript" language="javascript">
	listTable.recordCount = <?php echo empty($this->_var['record_count']) ? '0' : $this->_var['record_count']; ?>;
	listTable.pageCount = <?php echo empty($this->_var['page_count']) ? '1' : $this->_var['page_count']; ?>;
	
	<?php $_from = $this->_var['filter']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
	listTable.filter.<?php echo $this->_var['key']; ?> = '<?php echo $this->_var['item']; ?>';
	<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
	
	$(function(){
		$('.nyroModal').nyroModal();
	});
	</script>
</body>
</html>
<?php endif; ?>
