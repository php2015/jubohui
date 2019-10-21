<?php if ($this->_var['full_page']): ?>
<!doctype html>
<html>
<head><?php echo $this->fetch('library/admin_html_head.lbi'); ?></head>

<body class="iframe_body">
	<div class="warpper">
    	<div class="title"><?php echo $this->_var['lang']['goods_alt']; ?> - <?php echo $this->_var['ur_here']; ?></div>
        <div class="content">
            <?php echo $this->fetch('library/common_tabs_info.lbi'); ?>
        	<div class="explanation mb10" id="explanation">
            	<div class="ex_tit"><i class="sc_icon"></i><h4><?php echo $this->_var['lang']['operating_hints']; ?></h4><span id="explanationZoom" title="<?php echo $this->_var['lang']['fold_tips']; ?>"></span></div>
                <ul>
                	<li><?php echo $this->_var['lang']['operation_prompt_content']['trash']['0']; ?></li>
                    <li><?php echo $this->_var['lang']['operation_prompt_content']['trash']['1']; ?></li>
                </ul>
            </div>            
        	<div class="tabs_info">
            	<ul>
                    <li <?php if ($this->_var['menu_select']['current'] == '01_goods_list'): ?>class="curr"<?php endif; ?>>
                    	<a href="goods.php?act=list<?php echo $this->_var['seller_list']; ?>"><?php echo $this->_var['lang']['ordinary_goods']; ?> <?php if ($this->_var['menu_select']['current'] != '01_goods_list'): ?><?php if ($this->_var['goods_list_type']): ?><em class="li_color">(<?php echo empty($this->_var['goods_list_type']['ordinary']) ? '0' : $this->_var['goods_list_type']['ordinary']; ?>)</em><?php endif; ?><?php endif; ?></a>
                    </li>
                    <li <?php if ($this->_var['menu_select']['current'] == '50_virtual_card_list'): ?>class="curr"<?php endif; ?>>
                    	<a href="goods.php?act=list&extension_code=virtual_card<?php echo $this->_var['seller_list']; ?>"><?php echo $this->_var['lang']['virtual_goods']; ?> <?php if ($this->_var['menu_select']['current'] != '50_virtual_card_list'): ?><?php if ($this->_var['goods_list_type']): ?><em class="li_color">(<?php echo empty($this->_var['goods_list_type']['virtual_card']) ? '0' : $this->_var['goods_list_type']['virtual_card']; ?>)</em><?php endif; ?><?php endif; ?></a>
                    </li>
                    <?php if ($this->_var['cfg']['review_goods'] && $this->_var['filter']['seller_list'] == 1): ?>
                	<li <?php if ($this->_var['menu_select']['current'] == '01_review_status'): ?>class="curr"<?php endif; ?>>
                    	<a href="goods.php?act=review_status<?php echo $this->_var['seller_list']; ?>"><?php echo $this->_var['lang']['01_review_status']; ?> <?php if ($this->_var['menu_select']['current'] != '01_review_status'): ?><?php if ($this->_var['goods_list_type']): ?><em class="li_color">(<?php echo empty($this->_var['goods_list_type']['review_status']) ? '0' : $this->_var['goods_list_type']['review_status']; ?>)</em><?php endif; ?><?php endif; ?></a>
                    </li>
                    <?php endif; ?>
					<li <?php if ($this->_var['menu_select']['current'] == '11_goods_trash'): ?>class="curr"<?php endif; ?>>
                    	<a href="goods.php?act=trash<?php echo $this->_var['seller_list']; ?>"><?php echo $this->_var['lang']['11_goods_trash']; ?> <?php if ($this->_var['menu_select']['current'] != '11_goods_trash'): ?><?php if ($this->_var['goods_list_type']): ?><em class="li_color">(<?php echo empty($this->_var['goods_list_type']['delete']) ? '0' : $this->_var['goods_list_type']['delete']; ?>)</em><?php endif; ?><?php endif; ?></a>
                    </li>
                    <li <?php if ($this->_var['menu_select']['current'] == '19_is_sale'): ?>class="curr"<?php endif; ?>>
                    	<a href="goods.php?act=is_sale<?php echo $this->_var['seller_list']; ?>"><?php echo $this->_var['lang']['shelves_goods']; ?> <?php if ($this->_var['menu_select']['current'] != '19_is_sale'): ?><?php if ($this->_var['goods_list_type']): ?><em class="li_color">(<?php echo empty($this->_var['goods_list_type']['is_sale']) ? '0' : $this->_var['goods_list_type']['is_sale']; ?>)</em><?php endif; ?><?php endif; ?></a>
                    </li>
                    
                    <li <?php if ($this->_var['menu_select']['current'] == '20_is_sale'): ?>class="curr"<?php endif; ?>>
                    	<a href="goods.php?act=on_sale<?php echo $this->_var['seller_list']; ?>"><?php echo $this->_var['lang']['off_the_shelf_goods']; ?> <?php if ($this->_var['menu_select']['current'] != '20_is_sale'): ?><?php if ($this->_var['goods_list_type']): ?><em class="li_color">(<?php echo empty($this->_var['goods_list_type']['on_sale']) ? '0' : $this->_var['goods_list_type']['on_sale']; ?>)</em><?php endif; ?><?php endif; ?></a>
                    </li>
                </ul>
            </div>			
            <div class="flexilist">
            	<!--商品列表-->
                <div class="common-head">
                    <div class="refresh ml0">
                    	<div class="refresh_tit" title="<?php echo $this->_var['lang']['refresh_data']; ?>"><i class="icon icon-refresh"></i></div>
                    	<div class="refresh_span"><?php echo $this->_var['lang']['refresh_common']; ?><?php echo $this->_var['record_count']; ?><?php echo $this->_var['lang']['record']; ?></div>
                    </div>
					<div class="search">
                    	<form action="javascript:;" name="searchForm" onSubmit="searchGoodsname(this);">
                    	<div class="input">
                        	<input type="text" name="keyword" class="text nofocus" placeholder="<?php echo $this->_var['lang']['goods_name']; ?>" autocomplete="off">
							<input type="submit" class="btn" name="secrch_btn" ectype="secrch_btn" value="" />
                        </div>
                        </form>
                    </div>						
                </div>
                <div class="common-content">
					<form method="post" action="" name="listForm">
                	<div class="list-div" id="listDiv">
						<?php endif; ?>
                    	<table cellpadding="0" cellspacing="0" border="0">
                        	<thead>
                            	<tr>
                                	<th width="3%" class="sign"><div class="tDiv"><input type="checkbox" name="all_list" class="checkbox" id="all_list" /><label for="all_list" class="checkbox_stars"></label></div></th>
                                	<th width="5%"><div class="tDiv"><?php echo $this->_var['lang']['record_id']; ?></div></th>
                                    <th width="35%"><div class="tDiv"><?php echo $this->_var['lang']['goods_name']; ?></div></th>
									<th width="15%"><div class="tDiv"><?php echo $this->_var['lang']['goods_steps_name']; ?></div></th>
                                    <th width="10%"><div class="tDiv"><?php echo $this->_var['lang']['goods_type']; ?></div></th>
                                    <th width="10%"><div class="tDiv"><?php echo $this->_var['lang']['goods_sn']; ?></div></th>
                                    <th width="10%"><div class="tDiv"><?php echo $this->_var['lang']['shop_price']; ?></div></th>
                                    <th width="12%" class="handle"><?php echo $this->_var['lang']['handler']; ?></th>
                                </tr>
                            </thead>
                            <tbody>
								<?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
                            	<tr>
                                    <td class="sign">
                                        <div class="tDiv">
                                            <input type="checkbox" name="checkboxes[]" value="<?php echo $this->_var['goods']['goods_id']; ?>" class="checkbox" id="checkbox_<?php echo $this->_var['goods']['goods_id']; ?>" />
                                            <label for="checkbox_<?php echo $this->_var['goods']['goods_id']; ?>" class="checkbox_stars"></label>
                                        </div>
                                    </td>
                                    <td><div class="tDiv"><?php echo $this->_var['goods']['goods_id']; ?></div></td>
									<td>
                                        <div class="tDiv goods_list_info">
											<div class="img"><a href="../goods.php?id=<?php echo $this->_var['goods']['goods_id']; ?>" target="_blank" title="<?php echo htmlspecialchars($this->_var['goods']['goods_name']); ?>"><img src="<?php echo $this->_var['goods']['goods_thumb']; ?>" width="68" height="68" /></a></div>
                                            <div class="desc">
                                        	<div class="name">
                                                	<span onclick="listTable.edit(this, 'edit_goods_name', <?php echo $this->_var['goods']['goods_id']; ?>)" title="<?php echo htmlspecialchars($this->_var['goods']['goods_name']); ?>" data-toggle="tooltip" class="span"><?php echo htmlspecialchars($this->_var['goods']['goods_name']); ?></span>
                                                </div>
                                            	<?php if ($this->_var['goods']['brand_name']): ?><p class="brand"><?php echo $this->_var['lang']['brand']; ?>：<em><?php echo $this->_var['goods']['brand_name']; ?></em></p><?php endif; ?>
                                                <p class="activity"> 
                                                    <?php if ($this->_var['goods']['is_shipping']): ?>
                                                    <em class="free"><?php echo $this->_var['alng']['free_shipping_alt']; ?></em>
                                                    <?php endif; ?>
    
                                                    <?php if ($this->_var['goods']['stages']): ?>
                                                    <em class="byStage"><?php echo $this->_var['lang']['by_stages']; ?></em>
                                                    <?php endif; ?>
                                                    <?php if (! $this->_var['goods']['is_alone_sale']): ?>
                                                    <em class="parts"><?php echo $this->_var['lang']['tab_groupgoods']; ?></em>
                                                    <?php endif; ?>
                                                    
                                                    <?php if ($this->_var['goods']['is_promote']): ?>
                                                        <?php if ($this->_var['nowTime'] >= $this->_var['goods']['promote_end_date']): ?>
                                                    <em class="saleEnd"><?php echo $this->_var['lang']['promote_end_date']; ?></em>
                                                        <?php else: ?>
                                                    <em class="sale"><?php echo $this->_var['lang']['promote_date']; ?></em>    
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                    
                                                    <?php if ($this->_var['goods']['is_xiangou']): ?>
                                                        <?php if ($this->_var['nowTime'] >= $this->_var['goods']['xiangou_end_date']): ?>
                                                    <em class="purchaseEnd"><?php echo $this->_var['lang']['xiangou_end']; ?></em>
                                                        <?php else: ?>
                                                    <em class="purchase"><?php echo $this->_var['lang']['xiangou']; ?></em>    
                                                        <?php endif; ?>
                                                    <?php endif; ?>
													
                                                    <?php if ($this->_var['goods']['is_distribution']): ?>
                                                    <em class="distribution"><?php echo $this->_var['lang']['distribution']; ?></em>
                                                    <?php endif; ?>													
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td><div class="tDiv"><?php if ($this->_var['goods']['user_name']): ?><font class="red"><?php echo $this->_var['goods']['user_name']; ?></font><?php else: ?><font class="blue3"><?php echo $this->_var['lang']['self']; ?></font><?php endif; ?></div></td>                           
                                    <td><div class="tDiv"><?php if ($this->_var['goods']['is_real']): ?><?php echo $this->_var['lang']['material_object']; ?><?php else: ?><?php echo $this->_var['lang']['virtual_card']; ?><?php endif; ?></div></td>
                                    <td><div class="tDiv"><?php echo $this->_var['goods']['goods_sn']; ?></div></td>
                                    <td><div class="tDiv"><?php echo $this->_var['goods']['shop_price']; ?></div></td>                               
                                    <td class="handle">
                                        <div class="tDiv a2">
                                            <a href="javascript:;" onclick="listTable.remove(<?php echo $this->_var['goods']['goods_id']; ?>, '<?php echo $this->_var['lang']['restore_goods_confirm']; ?>', 'restore_goods')" class="btn_see"><i class="sc_icon sc_icon_see"></i><?php echo $this->_var['lang']['reduction']; ?></a>
                                            <a href="javascript:;" onclick="listTable.remove(<?php echo $this->_var['goods']['goods_id']; ?>, '<?php echo $this->_var['lang']['drop_goods_confirm']; ?>', 'drop_goods')" class="btn_trash"><i class="icon icon-trash"></i><?php echo $this->_var['lang']['drop']; ?></a>									
                                        </div>
                                    </td>
                                </tr>
								<?php endforeach; else: ?>
								<tr><td class="no-records" colspan="20"><?php echo $this->_var['lang']['no_records']; ?></td></tr>								
								<?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
                            </tbody>
                            <tfoot>
                            	<tr>
                                	<td colspan="12">
                                        <div class="tDiv">
                                            <div class="tfoot_btninfo">
                                                <div class="shenhe">
                                                    <div class="checkbox_item fl font12 mt5 mr5">
                                                	<input type="checkbox" name="all_list" class="ui-checkbox" id="all_list"><label for="all_list" class="ui-label"><?php echo $this->_var['lang']['check_all']; ?></label>
                                                </div>
                                                  <input type="hidden" name="act" value="batch" />
                                                    <div id="" class="imitate_select select_w120">
                                                        <div class="cite"><?php echo $this->_var['lang']['please_select']; ?></div>
                                                        <ul>
                                                            <li><a href="javascript:;" data-value="" class="ftx-01"><?php echo $this->_var['lang']['select_please']; ?></a></li>
                                                            <li><a href="javascript:;" data-value="restore" class="ftx-01"><?php echo $this->_var['lang']['restore']; ?></a></li>
                                                            <li><a href="javascript:;" data-value="drop" class="ftx-01"><?php echo $this->_var['lang']['drop']; ?></a></li>
                                                        </ul>
                                                        <input name="type" type="hidden" value="" id="">
                                                    </div>											  
                                                  <select name="target_cat" style="display:none" onchange="checkIsLeaf(this)" class="select mr10">
                                                    <option value="0"><?php echo $this->_var['lang']['select_please']; ?></option>
                                                    <?php echo $this->_var['cat_list']; ?>
                                                  </select>
                                                  <input type="submit" value="<?php echo $this->_var['lang']['button_submit']; ?>" id="btnSubmit" name="btnSubmit" class="btn btn_disabled" disabled="true" onclick="changeAction();" ectype="btnSubmit" />
                                                </div> 										
                                            </div>
                                            <div class="list-page">
                                               <?php echo $this->fetch('library/page.lbi'); ?>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
						<?php if ($this->_var['full_page']): ?>
                    </div>
					</form>
                </div>
                <!--商品列表end-->
            </div>
		</div>
	</div>
	<!--高级搜索 start-->
	<?php echo $this->fetch('library/goods_search.lbi'); ?>
	<!--高级搜索 end-->
	<?php echo $this->fetch('library/pagefooter.lbi'); ?>
	<script type="text/javascript">
	  listTable.recordCount = <?php echo empty($this->_var['record_count']) ? '0' : $this->_var['record_count']; ?>;
	  listTable.pageCount = <?php echo empty($this->_var['page_count']) ? '1' : $this->_var['page_count']; ?>;

	  <?php $_from = $this->_var['filter']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
	  listTable.filter.<?php echo $this->_var['key']; ?> = '<?php echo $this->_var['item']; ?>';
	  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

	  
	  
	  function confirmSubmit(frm, ext)
	  {
		if (frm.elements['type'].value == 'restore')
		{
		  
		  return confirm("<?php echo $this->_var['lang']['restore_goods_confirm']; ?>");
		  
		}
		else if (frm.elements['type'].value == 'drop')
		{
		  
		  return confirm("<?php echo $this->_var['lang']['batch_drop_confirm']; ?>");
		  
		}
		else if (frm.elements['type'].value == '')
		{
			return false;
		}
		else
		{
			return true;
		}
	  }

	  function changeAction()
	  {
		  var frm = document.forms['listForm'];

		  if (!document.getElementById('btnSubmit').disabled &&
			  confirmSubmit(frm, false))
		  {
			  frm.submit();
		  }
	  }
	  
	</script>
</body>
</html>
<?php endif; ?>
