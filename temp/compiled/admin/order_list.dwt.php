<?php if ($this->_var['full_page']): ?>
<!doctype html>
<html>
<head><?php echo $this->fetch('library/admin_html_head.lbi'); ?></head>

<body class="iframe_body">
	<div class="warpper">
    	<div class="title"><?php if ($this->_var['action_link2']): ?><a href="<?php echo $this->_var['action_link2']['href']; ?>" class="s-back"><?php echo $this->_var['lang']['back']; ?></a><?php endif; ?><?php echo $this->_var['lang']['order_word']; ?> - <?php echo $this->_var['lang']['02_order_list']; ?></div>
		<div class="content">
			<?php if ($this->_var['is_zc'] != 1): ?>
            <?php if (! $this->_var['from_store']): ?>
        	<?php echo $this->fetch('library/common_tabs_info.lbi'); ?>
			<?php endif; ?>
            <?php endif; ?>
           	<?php if ($this->_var['user_id'] > 0): ?>
            <div class="tabs_info">
            	<ul>
                    <li <?php if ($this->_var['form_action'] == 'update'): ?>class="curr"<?php endif; ?>><a href="users.php?act=edit&id=<?php echo $this->_var['user_id']; ?>"><?php echo $this->_var['lang']['base_info']; ?></a></li>
                    <li <?php if ($this->_var['form_action'] == 'address_list'): ?>class="curr"<?php endif; ?>><a href="users.php?act=address_list&id=<?php echo $this->_var['user_id']; ?>"><?php echo $this->_var['lang']['consignee_address']; ?></a></li>
                    <li class="curr"><a href="order.php?act=list&user_id=<?php echo $this->_var['user_id']; ?>"><?php echo $this->_var['lang']['view_order']; ?></a></li>
                    <li <?php if ($this->_var['form_action'] == 'bt_edit'): ?>class="curr"<?php endif; ?>><a href="user_baitiao_log.php?act=bt_add_tp&user_id=<?php echo $this->_var['user_id']; ?>"><?php echo $this->_var['lang']['set_baitiao']; ?></a></li>
                    <li <?php if ($this->_var['form_action'] == 'account_log'): ?>class="curr"<?php endif; ?>><a href="account_log.php?act=list&user_id=<?php echo $this->_var['user_id']; ?>"><?php echo $this->_var['lang']['account_details']; ?></a></li>
                </ul>
            </div>
            <?php endif; ?>
            <div class="explanation" id="explanation">
                <div class="ex_tit"><i class="sc_icon"></i><h4><?php echo $this->_var['lang']['operating_hints']; ?></h4><span id="explanationZoom" title="<?php echo $this->_var['lang']['fold_tips']; ?>"></span></div>
                <ul>
                    <li><?php echo $this->_var['lang']['operation_prompt_content']['list']['0']; ?></li>
                	<li><?php echo $this->_var['lang']['operation_prompt_content']['list']['1']; ?></li>
                    <li><?php echo $this->_var['lang']['operation_prompt_content']['list']['2']; ?></li>
                </ul>
            </div>
            <div class="flexilist mt30"  id="listDiv">
				<?php endif; ?>
                <div class="common-head order-coomon-head">
                	<div class="order_state_tab">
                        <a href="order.php?act=list<?php echo $this->_var['seller_list']; ?>&serch_type=-1<?php if ($this->_var['user_id']): ?>&user_id=<?php echo $this->_var['user_id']; ?><?php endif; ?>" <?php if ($this->_var['serch_type'] == '-1'): ?>class="current"<?php endif; ?>><?php echo $this->_var['lang']['all_order']; ?><?php if ($this->_var['serch_type'] == '-1'): ?><em>(<?php echo $this->_var['filter']['record_count']; ?>)</em><?php endif; ?></a>
                        <a href="order.php?act=list<?php echo $this->_var['seller_list']; ?>&serch_type=0<?php if ($this->_var['user_id']): ?>&user_id=<?php echo $this->_var['user_id']; ?><?php endif; ?>" <?php if ($this->_var['serch_type'] == '0'): ?>class="current"<?php endif; ?>><?php echo $this->_var['lang']['order_status_01']; ?><?php if ($this->_var['serch_type'] == '0'): ?><em>(<?php echo $this->_var['filter']['record_count']; ?>)</em><?php endif; ?></a>
                        <a href="order.php?act=list<?php echo $this->_var['seller_list']; ?>&serch_type=1<?php if ($this->_var['user_id']): ?>&user_id=<?php echo $this->_var['user_id']; ?><?php endif; ?>" <?php if ($this->_var['serch_type'] == '1'): ?>class="current"<?php endif; ?>><?php echo $this->_var['lang']['order_status_02']; ?><?php if ($this->_var['serch_type'] == '1'): ?><em>(<?php echo $this->_var['filter']['record_count']; ?>)</em><?php endif; ?></a>
                        <a href="order.php?act=list<?php echo $this->_var['seller_list']; ?>&serch_type=8<?php if ($this->_var['user_id']): ?>&user_id=<?php echo $this->_var['user_id']; ?><?php endif; ?>" <?php if ($this->_var['serch_type'] == '8'): ?>class="current"<?php endif; ?>><?php echo $this->_var['lang']['order_status_03']; ?><?php if ($this->_var['serch_type'] == '8'): ?><em>(<?php echo $this->_var['filter']['record_count']; ?>)</em><?php endif; ?></a>
                        <a href="order.php?act=list<?php echo $this->_var['seller_list']; ?>&serch_type=2<?php if ($this->_var['user_id']): ?>&user_id=<?php echo $this->_var['user_id']; ?><?php endif; ?>" <?php if ($this->_var['serch_type'] == '2'): ?>class="current"<?php endif; ?>>待收货<?php if ($this->_var['serch_type'] == '2'): ?><em>(<?php echo $this->_var['filter']['record_count']; ?>)</em><?php endif; ?></a>
                        <a href="order.php?act=list<?php echo $this->_var['seller_list']; ?>&serch_type=3<?php if ($this->_var['user_id']): ?>&user_id=<?php echo $this->_var['user_id']; ?><?php endif; ?>" <?php if ($this->_var['serch_type'] == '3'): ?>class="current"<?php endif; ?>><?php echo $this->_var['lang']['order_status_04']; ?><?php if ($this->_var['serch_type'] == '3'): ?><em>(<?php echo $this->_var['filter']['record_count']; ?>)</em><?php endif; ?></a>
                        <a href="order.php?act=list<?php echo $this->_var['seller_list']; ?>&serch_type=4<?php if ($this->_var['user_id']): ?>&user_id=<?php echo $this->_var['user_id']; ?><?php endif; ?>" <?php if ($this->_var['serch_type'] == '4'): ?>class="current"<?php endif; ?>>付款中<?php if ($this->_var['serch_type'] == '4'): ?><em>(<?php echo $this->_var['filter']['record_count']; ?>)</em><?php endif; ?></a>
                        <a href="order.php?act=list<?php echo $this->_var['seller_list']; ?>&serch_type=5<?php if ($this->_var['user_id']): ?>&user_id=<?php echo $this->_var['user_id']; ?><?php endif; ?>" <?php if ($this->_var['serch_type'] == '5'): ?>class="current"<?php endif; ?>>取消<?php if ($this->_var['serch_type'] == '5'): ?><em>(<?php echo $this->_var['filter']['record_count']; ?>)</em><?php endif; ?></a>
                        <a href="order.php?act=list<?php echo $this->_var['seller_list']; ?>&serch_type=6<?php if ($this->_var['user_id']): ?>&user_id=<?php echo $this->_var['user_id']; ?><?php endif; ?>" <?php if ($this->_var['serch_type'] == '6'): ?>class="current"<?php endif; ?>>无效<?php if ($this->_var['serch_type'] == '6'): ?><em>(<?php echo $this->_var['filter']['record_count']; ?>)</em><?php endif; ?></a>
                        <a href="order.php?act=list<?php echo $this->_var['seller_list']; ?>&serch_type=7<?php if ($this->_var['user_id']): ?>&user_id=<?php echo $this->_var['user_id']; ?><?php endif; ?>" <?php if ($this->_var['serch_type'] == '7'): ?>class="current"<?php endif; ?>>退货<?php if ($this->_var['serch_type'] == '7'): ?><em>(<?php echo $this->_var['filter']['record_count']; ?>)</em><?php endif; ?></a>
                    </div>
                    <div class="refresh">
                        <div class="refresh_tit" title="<?php echo $this->_var['lang']['refresh_data']; ?>" onclick="javascript:history.go(0)" ><i class="icon icon-refresh"></i></div>
                        <div class="refresh_span"><?php echo $this->_var['lang']['refresh_common']; ?><?php echo $this->_var['record_count']; ?><?php echo $this->_var['lang']['record']; ?></div>
                    </div>
                    
                    <div class="search">
                    	<form action="javascript:;" name="searchForm" onSubmit="searchGoodsname(this);">
                        <div class="input">
                            <input type="text" name="keywords" value="<?php echo $this->_var['filter']['keywords']; ?>" class="text nofocus w180" placeholder="<?php echo $this->_var['lang']['search_keywords_placeholder']; ?>" autocomplete="off">
                            <input type="submit" class="btn" name="secrch_btn" ectype="secrch_btn" value="" />
                        </div>
                        </form>
                    </div>
                        
                    <div class="common-head-right">
                        <div class="fbutton"><a href="<?php echo $this->_var['action_link']['href']; ?><?php echo $this->_var['seller_list']; ?>"><div title="<?php echo $this->_var['action_link']['text']; ?>"><span><i class="icon icon-search"></i><?php echo $this->_var['action_link']['text']; ?></span></div></a></div>
						<div class="fbutton"><div class="merge" title="<?php echo $this->_var['lang']['merge_order']; ?>"><span><i class="icon icon-copy"></i><?php echo $this->_var['lang']['merge_order']; ?></span></div></div>
						<div class="fbutton"><a href="javascript:download_orderlist();"><div class="csv" title="<?php echo $this->_var['lang']['11_order_export']; ?>"><span><i class="icon icon-download-alt"></i><?php echo $this->_var['lang']['11_order_export']; ?></span></div></a></div>
                    </div>
                </div>
                <div class="common-content">
                <form method="post" action="order.php?act=operate" name="listForm" onsubmit="return check()">
                    <div class="list-div list-tb-div" >
                        <table cellpadding="0" cellspacing="0" border="0">
                            <thead>
                                <tr>
                                    <th width="3%" class="sign"><div class="tDiv"><input type="checkbox" name="all_list" class="checkbox" id="all_list" /><label for="all_list" class="checkbox_stars"></label></div></th>
                                    <th width="25%"><div class="tDiv"><?php echo $this->_var['lang']['order_sn']; ?></div></th>
                                    <th width="6%"><div class="tDiv"><?php echo $this->_var['lang']['goods_price']; ?></div></th>
                                    <th width="3%"><div class="tDiv"><?php echo $this->_var['lang']['goods_number']; ?></div></th>
                                    <th width="7%"><div class="tDiv"><?php echo $this->_var['lang']['op_after_service']; ?></div></th>
                                    <th width="6%"><div class="tDiv"><?php echo $this->_var['lang']['goods_steps_name']; ?></div></th>
                                    <th width="7%"><div class="tDiv"><?php echo $this->_var['lang']['user_name']; ?></div></th>
                                    <th width="16%"><div class="tDiv"><?php echo $this->_var['lang']['consignee']; ?></div></th>
                                    <th width="12%"><div class="tDiv"><?php echo $this->_var['lang']['amount_label']; ?></div></th>
                                    <th width="6%"><div class="tDiv"><?php echo $this->_var['lang']['all_status']; ?></div></th>
                                    <th width="7%"><div class="tDiv"><?php echo $this->_var['lang']['handler']; ?></div></th>
                                </tr>
                            </thead>
                        </table>
					    <?php $_from = $this->_var['order_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('okey', 'order');if (count($_from)):
    foreach ($_from AS $this->_var['okey'] => $this->_var['order']):
?>
                        <table cellpadding="0" cellspacing="0" border="0">
                            <colgroup>
                                <col width="28%">
                                <col width="6%">
                                <col width="3%">
                                <col width="7%">
                                <col width="6%">
                                <col width="7%">
                                <col width="16%">
                                <col width="12%">
                                <col width="6%">
                                <col width="7%">
                            </colgroup>
                            <tbody>
                                <tr class="tr-order-sn">
                                    <td colspan="10">
                                        <div class="tDiv ml10">
                                            <span class="sign<?php if ($this->_var['order']['chargeoff_status'] == 1 || $this->_var['order']['chargeoff_status'] == 2): ?> sign_bdl<?php endif; ?>" <?php if ($this->_var['order']['chargeoff_status'] == 1 || $this->_var['order']['chargeoff_status'] == 2): ?>rowspan="2"<?php endif; ?>>
                                                <input type="checkbox" name="checkboxes[]" value="<?php echo $this->_var['order']['order_sn']; ?>" class="checkbox" id="checkbox_<?php echo $this->_var['order']['order_id']; ?>" /><label for="checkbox_<?php echo $this->_var['order']['order_id']; ?>" class="checkbox_stars"></label>
                                            </span>
                                            <span class="words"><?php echo $this->_var['lang']['order_sn']; ?>：<?php echo $this->_var['order']['order_sn']; ?></span>
                                            <span class="words"><?php echo $this->_var['lang']['order_time']; ?>：<?php echo $this->_var['order']['short_order_time']; ?></span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="td-product">
                                    <?php $_from = $this->_var['order']['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'list');$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from AS $this->_var['list']):
        $this->_foreach['foo']['iteration']++;
?>
										<div class="tDiv relative tpinfo <?php if (($this->_foreach['foo']['iteration'] == $this->_foreach['foo']['total'])): ?>last<?php endif; ?>">
                                            <div class="img"><img width="80" src="<?php echo $this->_var['list']['goods_thumb']; ?>" alt="" onmouseover="toolTip('<img src=<?php echo $this->_var['list']['goods_img']; ?>>')" onmouseout="toolTip()"></div>
                                            <div class="product-info">
                                                <div class="name mb5">
                                                    <?php if ($this->_var['order']['oi_extension_code'] == "group_buy"): ?>
                                                    <a href="../group_buy.php?act=view&id=<?php echo $this->_var['order']['extension_id']; ?>" target="_blank">
                                                    <?php elseif ($this->_var['order']['oi_extension_code'] == "snatch"): ?>
                                                    <a href="../snatch.php?id=<?php echo $this->_var['order']['extension_id']; ?>" target="_blank">
                                                    <?php elseif ($this->_var['order']['oi_extension_code'] == "seckill"): ?>
                                                    <a href="../seckill.php?id=<?php echo $this->_var['order']['extension_id']; ?>&act=view" target="_blank">
                                                    <?php elseif ($this->_var['order']['oi_extension_code'] == "auction"): ?>
                                                    <a href="../auction.php?id=<?php echo $this->_var['order']['extension_id']; ?>&act=view" target="_blank"> 
                                                    <?php elseif ($this->_var['order']['oi_extension_code'] == "exchange_goods"): ?>
                                                    <a href="../exchange.php?id=<?php echo $this->_var['order']['extension_id']; ?>&act=view" target="_blank">
                                                    <?php elseif ($this->_var['order']['oi_extension_code'] == "presale"): ?>
                                                    <a href="../presale.php?id=<?php echo $this->_var['order']['extension_id']; ?>&act=view" target="_blank">
                                                    <?php elseif ($this->_var['order']['o_extension_code'] == "package_buy"): ?>
                                                    <a href="../package.php" target="_blank">
                                                    <?php else: ?>
                                                        <a href="../goods.php?id=<?php echo $this->_var['list']['goods_id']; ?>" target="_blank">
                                                    <?php endif; ?>
                                                    <?php echo $this->_var['list']['goods_name']; ?>
                                                    <?php if ($this->_var['list']['brand_name']): ?><span class="org">[ <?php echo $this->_var['list']['brand_name']; ?> ]</span><?php endif; ?>
                                                    <?php if ($this->_var['list']['is_gift']): ?>
                                                    <span class="red">
                                                        <?php if ($this->_var['list']['goods_price'] > 0): ?>
                                                            <?php echo $this->_var['lang']['remark_favourable']; ?>
                                                        <?php else: ?>
                                                            <?php echo $this->_var['lang']['remark_gift']; ?>
                                                        <?php endif; ?>
                                                    </span>
                                                    <?php endif; ?>
                                                    <?php if ($this->_var['list']['parent_id'] > 0): ?><span class="red"><?php echo $this->_var['lang']['remark_fittings']; ?></span><?php endif; ?>
                                                    </a>
                                                    
                                                </div>
                                                <?php if ($this->_var['list']['goods_attr']): ?><div class="attr"><span><?php echo $this->_var['list']['goods_attr']; ?></span></div><?php endif; ?>
                                                <div><?php echo $this->_var['lang']['goods_sku']; ?>：<?php if ($this->_var['list']['product_sn']): ?><?php echo $this->_var['list']['product_sn']; ?><?php else: ?><?php echo $this->_var['list']['goods_sn']; ?><?php endif; ?><?php if ($this->_var['list']['trade_url']): ?><a href="<?php echo $this->_var['list']['trade_url']; ?>" target="_blank" class="ml5"><span class="org">[<?php echo $this->_var['lang']['trade_snapshot']; ?>]</span></a><?php endif; ?></div>
                                                <div class="order_icon_items">
                                                    <?php if ($this->_var['order']['is_stages'] == 1): ?><div class="order_icon order_icon_bt" title="<?php echo $this->_var['lang']['baitiao_order']; ?>"><?php echo $this->_var['lang']['baitiao_order']; ?></div><?php endif; ?>
                                                    <?php if ($this->_var['order']['is_zc_order'] == 1): ?><div class="order_icon order_icon_zc" title="<?php echo $this->_var['lang']['zc_order']; ?>"><?php echo $this->_var['lang']['zc_order']; ?></div><?php endif; ?>
                                                    <?php if ($this->_var['order']['is_store_order'] == 1): ?><div class="order_icon order_icon_so" title="<?php echo $this->_var['lang']['so_order']; ?>"><?php echo $this->_var['lang']['so_order']; ?></div><?php endif; ?>
        											<?php if ($this->_var['order']['is_drp_order'] == 1): ?><div class="order_icon order_icon_fx" title="<?php echo $this->_var['lang']['fx_order']; ?>"><?php echo $this->_var['lang']['fx_order']; ?></div><?php endif; ?>
                                                    <?php if ($this->_var['order']['o_extension_code'] == "group_buy"): ?>
                                                        <div class="order_icon order_icon_tg" title="<?php echo $this->_var['lang']['group_buy']; ?>"><?php echo $this->_var['lang']['group_buy']; ?></div>
                                                    <?php elseif ($this->_var['order']['o_extension_code'] == "exchange_goods"): ?>
                                                        <div class="order_icon order_icon_jf" title="<?php echo $this->_var['lang']['exchange_goods']; ?>"><?php echo $this->_var['lang']['exchange_goods']; ?></div>
                                                    <?php elseif ($this->_var['order']['o_extension_code'] == "auction"): ?>
                                                        <div class="order_icon order_icon_pm" title="<?php echo $this->_var['lang']['auction']; ?>"><?php echo $this->_var['lang']['auction']; ?></div>
                                                    <?php elseif ($this->_var['order']['o_extension_code'] == "snatch"): ?>
                                                        <div class="order_icon order_icon_db" title="<?php echo $this->_var['lang']['snatch']; ?>"><?php echo $this->_var['lang']['snatch']; ?></div>
                                                    <?php elseif ($this->_var['order']['o_extension_code'] == "presale"): ?>
                                                        <div class="order_icon order_icon_ys" title="<?php echo $this->_var['lang']['presale']; ?>"><?php echo $this->_var['lang']['presale']; ?></div>  
                                                    <?php elseif ($this->_var['order']['o_extension_code'] == "seckill"): ?>
                                                        <div class="order_icon order_icon_ms" title="<?php echo $this->_var['lang']['seckill']; ?>"><?php echo $this->_var['lang']['seckill']; ?></div> 
                                                    <?php elseif ($this->_var['order']['o_extension_code'] == "team_buy"): ?>
                                                        <div class="order_icon order_icon_team" title="<?php echo $this->_var['lang']['team_order']; ?>"><?php echo $this->_var['lang']['team_order']; ?></div>
                                                    <?php elseif ($this->_var['order']['o_extension_code'] == "bargain_buy"): ?>
                                                        <div class="order_icon order_icon_bargain" title="<?php echo $this->_var['lang']['bargain_order']; ?>"><?php echo $this->_var['lang']['bargain_order']; ?></div>
                                                    <?php elseif ($this->_var['order']['o_extension_code'] == "wholesale"): ?>    
                                                    	<div class="order_icon order_icon_wholesale" title="<?php echo $this->_var['lang']['wholesale_order']; ?>"><?php echo $this->_var['lang']['bargain_order']; ?></div>
                                                    <?php endif; ?>
        											<?php if ($this->_var['order']['iog_extension_code'] == "package_buy"): ?>
                                                        <div class="order_icon order_icon_package" title="<?php echo $this->_var['lang']['package_order']; ?>"><?php echo $this->_var['lang']['package_order']; ?></div>
                                                    <?php elseif ($this->_var['order']['iog_extension_code'] == 'virtual_card'): ?>
                                                        <div class="order_icon order_icon_xn" title="<?php echo $this->_var['lang']['xn_order']; ?>"><?php echo $this->_var['lang']['xn_order']; ?></div>
                                                    <?php endif; ?>
                                                    <?php if ($this->_var['order']['is_stages'] == 0 && $this->_var['order']['is_zc_order'] == 0 && $this->_var['order']['is_store_order'] == 0 && $this->_var['order']['o_extension_code'] == '' && $this->_var['order']['iog_extension_code'] == ''): ?>
                                                        <?php if ($this->_var['order']['iog_extension_codes']): ?>
                                                        <?php $_from = $this->_var['order']['iog_extension_codes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'extension_code');if (count($_from)):
    foreach ($_from AS $this->_var['extension_code']):
?>
                                                            <?php if ($this->_var['extension_code'] == ''): ?>
                                                            <div class="order_icon order_icon_pt" title="<?php echo $this->_var['lang']['pt_order']; ?>"><?php echo $this->_var['lang']['pt_order']; ?></div>
                                                            <?php elseif ($this->_var['extension_code'] == 'virtual_card'): ?>
                                                            <div class="order_icon order_icon_xn" title="<?php echo $this->_var['lang']['xn_order']; ?>"><?php echo $this->_var['lang']['xn_order']; ?></div>
                                                            <?php endif; ?>
                                                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                                        <?php else: ?>
                                                        <div class="order_icon order_icon_pt" title="<?php echo $this->_var['lang']['pt_order']; ?>"><?php echo $this->_var['lang']['pt_order']; ?></div>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                    <?php if ($this->_var['order']['order_child'] != 0): ?>
                                                        <div class="order_icon" title="<?php echo $this->_var['lang']['to_order_sn']; ?>"><?php echo $this->_var['lang']['to_order_sn']; ?></div>
                                                    <?php endif; ?>
                                                    <?php if (! $this->_var['order']['order_child'] > 0): ?>											
                                                        <?php if ($this->_var['order']['main_order_id'] > 0): ?>
                                                        <div class="order_icon order_icon_zdd"><?php echo $this->_var['lang']['sub_order_sn2']; ?></div>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                    <?php if ($this->_var['list']['ret_id']): ?>
                                                    	<div class="order_icon order_icon_return" title="<?php echo $this->_var['lang']['return_order']; ?>"><?php echo $this->_var['lang']['return_order']; ?></div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
										</div>
                                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
									</td>
                                    <td class="td-price" style="vertical-align: top;">
                                    <?php $_from = $this->_var['order']['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'list');$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from AS $this->_var['list']):
        $this->_foreach['foo']['iteration']++;
?>
                                        <div class="tDiv tpinfo <?php if (($this->_foreach['foo']['iteration'] == $this->_foreach['foo']['total'])): ?>last<?php endif; ?>"><?php echo $this->_var['list']['goods_price']; ?></div>
                                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                    </td>
                                    <td class="td-number">
                                    <?php $_from = $this->_var['order']['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'list');$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from AS $this->_var['list']):
        $this->_foreach['foo']['iteration']++;
?>
                                        <div class="tDiv tpinfo <?php if (($this->_foreach['foo']['iteration'] == $this->_foreach['foo']['total'])): ?>last<?php endif; ?>"><?php echo $this->_var['list']['goods_number']; ?></div>
                                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                    </td>
                                    <td>      
                                    <?php $_from = $this->_var['order']['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'list');$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from AS $this->_var['list']):
        $this->_foreach['foo']['iteration']++;
?>
                                    <div class="tDiv tpinfo <?php if (($this->_foreach['foo']['iteration'] == $this->_foreach['foo']['total'])): ?>last<?php endif; ?>">
                                    	<?php if ($this->_var['list']['ret_id']): ?>
                                        	<div class="btn-wrap">
                                                <a href="order.php?act=return_info&ret_id=<?php echo $this->_var['list']['ret_id']; ?>&rec_id=<?php echo $this->_var['list']['rec_id']; ?>" target="_blank" class="btn-tb btn-tb-blue">
                                                <?php echo $this->_var['list']['back_order']['return_status']; ?>
                                                </a>
                                            </div>
                                        <?php else: ?>
                                        	<div><?php if ($this->_var['list']['is_reality'] == 1): ?><?php echo $this->_var['lang']['is_reality']; ?><br /><?php endif; ?><?php if ($this->_var['list']['is_return'] == 1): ?><?php echo $this->_var['lang']['is_return']; ?><br /><?php endif; ?><?php if ($this->_var['list']['is_fast'] == 1): ?><?php echo $this->_var['lang']['is_fast']; ?><?php endif; ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
									</td>
                                    <td>
										<div class="tDiv" style="height: 100px;">
											<?php if ($this->_var['order']['order_child'] == 0): ?>
											<?php if ($this->_var['order']['user_name']): ?>
												<font><?php echo $this->_var['order']['user_name']; ?><?php if ($this->_var['order']['self_run']): ?>（<?php echo $this->_var['lang']['self_run']; ?>）<?php endif; ?></font>
											<?php else: ?>
												<font><?php echo $this->_var['lang']['self']; ?></font>
											<?php endif; ?>
											<?php else: ?>
                                            <div class="exh">
                                            	<span class="blue3"><?php echo $this->_var['lang']['to_order_sn2']; ?></span>
                                                <div class="exh_info">
                                                	<i class="jt_r"></i>
                                                    <?php if ($this->_var['order']['order_child'] > 0): ?>
                                                        <font class="to_order_sn red">
                                                        	<?php echo $this->_var['lang']['to_order_sn3']; ?>
                                                            <div id="div_order_<?php echo $this->_var['order']['order_id']; ?>" class="div_order_id">
                                                            <?php $_from = $this->_var['order']['child_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'list');if (count($_from)):
    foreach ($_from AS $this->_var['list']):
?>
                                                            <?php echo $this->_var['lang']['sub_order_sn']; ?>：<?php echo $this->_var['list']['order_sn']; ?>
                                                            <br/> 
                                                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                                            </div>
                                                        </font>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
											<?php endif; ?>
										</div>
									</td>
                                    <td>
                                    <div class="tDiv" style="height: 100px;">
                                    	<a href="users.php?act=edit&id=<?php echo $this->_var['order']['user_id']; ?>"><?php echo htmlspecialchars($this->_var['order']['buyer']); ?></a>
                                    </div>
                                    </td>
                                    <td><div class="tDiv" style="height: 100px;text-align: left;"><?php echo htmlspecialchars($this->_var['order']['consignee']); ?><br><?php if ($this->_var['order']['mobile']): ?> TEL: <?php echo htmlspecialchars($this->_var['order']['mobile']); ?><?php endif; ?><br><?php echo $this->_var['order']['region']; ?> <?php echo htmlspecialchars($this->_var['order']['address']); ?></div></td>
                                    <td>
                                    	<div class="tDiv" style="height: 100px;">
                                            <span class="order-price"><?php echo $this->_var['order']['formated_total_fee_order']; ?></span>
                                            <div class="price-shipping">(<?php if ($this->_var['order']['shipping_name']): ?><?php echo $this->_var['order']['shipping_name']; ?><?php else: ?><?php echo $this->_var['lang']['wu']; ?><?php endif; ?>：<?php echo $this->_var['order']['shipping_fee']; ?>)</div>
                                            <div class="price-shipping">
                                                <p><?php echo $this->_var['lang']['pay_name']; ?>：<?php if ($this->_var['order']['pay_name']): ?><?php echo $this->_var['order']['pay_name']; ?><?php else: ?><?php echo $this->_var['lang']['wu']; ?><?php endif; ?></p>
                                                <p><?php echo $this->_var['lang']['referer']; ?>：<?php if ($this->_var['order']['referer'] == 'mobile'): ?>APP<?php elseif ($this->_var['order']['referer'] == 'touch'): ?><?php echo $this->_var['lang']['touch']; ?><?php elseif ($this->_var['order']['referer'] == 'wxapp'): ?>小程序<?php elseif ($this->_var['order']['referer'] == 'ecjia-cashdesk'): ?><?php echo $this->_var['lang']['cashdesk']; ?><?php else: ?>PC<?php endif; ?></p>
                                            </div>        
                                        </div>    
                                    </td>
									<!-- 订单状态 -->
                                    <td>
                                        <div class="tDiv" style="height: 100px;">
                                            <div><?php echo $this->_var['lang']['os'][$this->_var['order']['order_status']]; ?><br /><?php echo $this->_var['lang']['ps'][$this->_var['order']['pay_status']]; ?><br /><?php echo $this->_var['lang']['ss'][$this->_var['order']['shipping_status']]; ?></div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="tDiv" style="height: 100px;">
                                            <div class="btn-wrap">
                                                <p><a href="order.php?act=info&order_id=<?php echo $this->_var['order']['order_id']; ?>" class="btn-tb btn-tb-blue"><?php echo $this->_var['lang']['detail']; ?></a></p>
                                                <?php if ($this->_var['order']['can_remove'] && $this->_var['order_os_remove']): ?>
                                                <p class="mt10"><a href="javascript:;" onclick="listTable.remove(<?php echo $this->_var['order']['order_id']; ?>, remove_confirm, 'remove_order')" class="btn-tb btn-tb-default"><?php echo $this->_var['lang']['drop']; ?></a></p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <?php if ($this->_var['order']['bill_sn']): ?>
                        <table cellpadding="0" cellspacing="0" border="0">
                            <tbody>
                                <tr class="tr_thead">
                                	<td colspan="8" class="tr_thead_con">
                                    	<div class="order_sku">
                                        	<div class="item">
                                                <?php if ($this->_var['order']['chargeoff_status'] == 1): ?>
                                                <em class="red">【<?php echo $this->_var['lang']['have_commission_bill']; ?>：<?php echo $this->_var['order']['bill_sn']; ?>】</em>
                                                <?php else: ?>
                                                <em class="red">【<?php echo $this->_var['lang']['knot_commission_bill']; ?>：<?php echo $this->_var['order']['bill_sn']; ?>】</em>
                                                <?php endif; ?>
                                                <a href="merchants_commission.php?act=bill_detail&bill_id=<?php echo $this->_var['order']['bill_id']; ?>&seller_id=<?php echo $this->_var['order']['seller_id']; ?>&proportion=<?php echo $this->_var['order']['proportion']; ?>&commission_model=<?php echo $this->_var['order']['commission_model']; ?>" target="_blank">【<?php echo $this->_var['lang']['view_commission_bill']; ?>】</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <?php endif; ?>    
						<?php endforeach; else: ?>
                        <table cellpadding="0" cellspacing="0" border="0">
                            <tbody>
								<tr><td class="no-records" colspan="12"><?php echo $this->_var['lang']['no_records']; ?></td></tr>
                            </tbody>
                        </table>
						<?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
                        <table cellpadding="0" cellspacing="0" border="0">
                            <tfoot>
                                <tr>
                                    <td colspan="10">
                                        <div class="tDiv">
                                            <div class="tfoot_btninfo">
                                                <input type="submit" value="<?php echo $this->_var['lang']['op_confirm']; ?>" name="confirm" ectype="btnSubmit" class="btn btn_disabled" disabled="" onclick="this.form.target = '_self'">
                                                <input type="submit" value="<?php echo $this->_var['lang']['op_invalid']; ?>" name="invalid" ectype="btnSubmit" class="btn btn_disabled" disabled="" onclick="this.form.target = '_self'">
                                                <input type="submit" value="<?php echo $this->_var['lang']['op_cancel']; ?>" name="cancel" ectype="btnSubmit" class="btn btn_disabled" disabled="" onclick="this.form.target = '_self'">
                                                <?php if ($this->_var['order_os_remove']): ?>
                                                <input type="submit" value="<?php echo $this->_var['lang']['remove']; ?>" name="remove" ectype="btnSubmit" class="btn btn_disabled" disabled="" onclick="this.form.target = '_self'">
                                                <?php endif; ?>
                                                <input type="submit" value="<?php echo $this->_var['lang']['print_order']; ?>" name="print" ectype="btnSubmit" class="btn btn_disabled" disabled="" onclick="this.form.target = '_blank'">
                                                <input type="button" value="<?php echo $this->_var['lang']['print_shipping']; ?>" ectype="btnSubmit" class="btn btn_disabled" disabled="" print-data="print_shipping">
                                                <input name="batch" type="hidden" value="1" />
                                                <input name="order_id" type="hidden" value="" />
                                            </div>
                                            <div class="list-page">
                                                <?php echo $this->fetch('library/page.lbi'); ?>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>     
                    </div>
                    </form>
                </div>
            </div>
			<?php if ($this->_var['full_page']): ?>	
        </div>
    </div>
    <div class="gj_search">
        <div class="search-gao-list" id="searchBarOpen">
            <i class="icon icon-zoom-in"></i><?php echo $this->_var['lang']['advanced_search']; ?>
        </div>
        <div class="search-gao-bar">
            <div class="handle-btn" id="searchBarClose"><i class="icon icon-zoom-out"></i><?php echo $this->_var['lang']['pack_up']; ?></div>
            <div class="title"><h3><?php echo $this->_var['lang']['advanced_search']; ?></h3></div>
            <form action="javascript:searchOrder()" name="searchHighForm">
                <div class="searchContent">
                    <div class="layout-box">
                        <dl>
                            <dt><?php echo $this->_var['lang']['order_sn']; ?></dt>
                            <dd><input type="text" value="" name="order_sn" id="order_sn" class="s-input-txt" autocomplete="off" /></dd>
                        </dl>
                        <dl>
                            <dt><?php echo htmlspecialchars($this->_var['lang']['consignee']); ?></dt>
                            <dd><input type="text" value="" name="consignee" id="consignee" class="s-input-txt" autocomplete="off" /></dd>
                        </dl>
                        <dl>
                            <dt><?php echo $this->_var['lang']['all_status']; ?></dt>
                            <dd>
                                <div id="status" class="imitate_select select_w145">
                                  <div class="cite"><?php echo $this->_var['lang']['select_please']; ?></div>
                                  <ul>
                                  	 <li><a href="javascript:;" data-value="-1"><?php echo $this->_var['lang']['select_please']; ?></a></li>
								  <?php $_from = $this->_var['status_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('k', 'i');if (count($_from)):
    foreach ($_from AS $this->_var['k'] => $this->_var['i']):
?>
                                     <li><a href="javascript:;" data-value="<?php echo $this->_var['k']; ?>"><?php echo $this->_var['i']; ?></a></li>
								  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                  </ul>
								<input name="status" type="hidden" value="-1" id="status_val">
                                </div>
                            </dd>
                        </dl>
                        <dl>
                            <dt><?php echo $this->_var['lang']['order_category']; ?></dt>
                            <dd>
                                <div id="order_cat" class="imitate_select select_w145">
                                  <div class="cite"><?php echo $this->_var['lang']['select_please']; ?></div>
                                  <ul>
                                  	 <li><a href="javascript:;" data-value=""><?php echo $this->_var['lang']['select_please']; ?></a></li>
									 <li><a href="javascript:;" data-value="stages"><?php echo $this->_var['lang']['baitiao_order']; ?></a></li>
									 <li><a href="javascript:;" data-value="zc"><?php echo $this->_var['lang']['zc_order']; ?></a></li>
									 <li><a href="javascript:;" data-value="store"><?php echo $this->_var['lang']['so_order']; ?></a></li>
									 <li><a href="javascript:;" data-value="other"><?php echo $this->_var['lang']['other_order']; ?></a></li>
									 <li><a href="javascript:;" data-value="dbdd"><?php echo $this->_var['lang']['db_order']; ?></a></li>
									 <li><a href="javascript:;" data-value="msdd"><?php echo $this->_var['lang']['ms_order']; ?></a></li>
									 <li><a href="javascript:;" data-value="tgdd"><?php echo $this->_var['lang']['tg_order']; ?></a></li>
									 <li><a href="javascript:;" data-value="pmdd"><?php echo $this->_var['lang']['pm_order']; ?></a></li>
									 <li><a href="javascript:;" data-value="jfdd"><?php echo $this->_var['lang']['jf_order']; ?></a></li>
									 <li><a href="javascript:;" data-value="ysdd"><?php echo $this->_var['lang']['ys_order']; ?></a></li>
                                  </ul>
								<input name="order_cat" type="hidden" value="" id="order_cat_val">
                                </div>
                            </dd>
                        </dl>
                        <dl>
                            <dt><?php echo $this->_var['lang']['from_order']; ?></dt>
                            <dd>
                                <div id="order_referer" class="imitate_select select_w145">
                                  <div class="cite"><?php echo $this->_var['lang']['select_please']; ?></div>
                                  <ul>
                                  	 <li><a href="javascript:;" data-value=""><?php echo $this->_var['lang']['select_please']; ?></a></li>
									 <li><a href="javascript:;" data-value="pc">PC</a></li>
									 <li><a href="javascript:;" data-value="touch">WAP</a></li>
									 <li><a href="javascript:;" data-value="mobile">APP</a></li>
									 <li><a href="javascript:;" data-value="ecjia-cashdesk"><?php echo $this->_var['lang']['cashdesk']; ?></a></li>
                                  </ul>
								<input name="order_referer" type="hidden" value="" id="order_referer_val">
                                </div>
                            </dd>
                        </dl>                        
                        <?php if ($this->_var['common_tabs']['info']): ?>
                        <!--卖场 start-->
                        <?php if ($this->_var['rs_enabled'] && ! $this->_var['rs_id']): ?>
                        <dl>
                            <dt><?php echo $this->_var['lang']['rs_name']; ?></dt>
                            <dd>
                                <div id="" class="imitate_select select_w145">
                                    <div class="cite"><?php echo $this->_var['lang']['please_select']; ?></div>
                                    <ul>
                                        <li><a href="javascript:;" data-value="0" class="ftx-01"><?php echo $this->_var['lang']['please_select']; ?></a></li>
                                        <?php $_from = $this->_var['region_store_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'data');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['data']):
?>
                                        <li><a href="javascript:;" data-value="<?php echo $this->_var['data']['rs_id']; ?>" class="ftx-01"><?php echo $this->_var['data']['rs_name']; ?></a></li>
                                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                    </ul>
                                    <input name="rs_id" type="hidden" value="<?php echo empty($_GET['rs_id']) ? '0' : $_GET['rs_id']; ?>" autocomplete="off">
                                </div>
                            </dd>
                        </dl>
                        <?php endif; ?>
                        <!--卖场 end-->
                        <dl>
                            <dt><?php echo $this->_var['lang']['steps_shop_name']; ?></dt>
                            <dd>
                                <div id="store_search" class="imitate_select select_w145">
                                  <div class="cite"><?php echo $this->_var['lang']['select_please']; ?></div>
                                  <ul>
                                  	 <li><a href="javascript:;" data-value="-1"><?php echo $this->_var['lang']['select_please']; ?></a></li>
                                     <!--<li><a href="javascript:;" data-value="0"><?php echo $this->_var['lang']['platform_self']; ?></a></li>-->
									 <li><a href="javascript:;" data-value="1"><?php echo $this->_var['lang']['s_shop_name']; ?></a></li>
									 <li><a href="javascript:;" data-value="2"><?php echo $this->_var['lang']['s_qw_shop_name']; ?></a></li>
									 <li><a href="javascript:;" data-value="3"><?php echo $this->_var['lang']['s_brand_type']; ?></a></li>
                                  </ul>
								<input name="store_search" type="hidden" value="-1" id="store_search_val">
                                </div>
                            </dd>
                        </dl>
                        <?php endif; ?>
                        <dl id="merchant_id_dl" style="display:none">
                            <dd>
                                <div id="merchant_id" class="imitate_select select_w145">
                                  <div class="cite"><?php echo $this->_var['lang']['select_please']; ?></div>
                                  <ul>
								  <?php $_from = $this->_var['store_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'store');if (count($_from)):
    foreach ($_from AS $this->_var['store']):
?>
									 <li><a href="javascript:;" data-value="<?php echo $this->_var['store']['ru_id']; ?>"><?php echo $this->_var['store']['store_name']; ?></a></li>
								  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                  </ul>
								<input name="merchant_id" type="hidden" value="" id="merchant_id_val">
                                </div>
                            </dd>
                        </dl>
						<dl id="store_keyword_dl" style="display:none;">
							<input name="store_keyword" type="text"  class="text text_2 mr10"/>
						</dl>
                        <dl id="store_type_dl" style="display:none">
                            <dd>
                                <div id="store_type" class="imitate_select select_w145">
                                  <div class="cite"><?php echo $this->_var['lang']['steps_shop_type']; ?></div>
                                  <ul>
									 <li><a href="javascript:;" data-value="<?php echo $this->_var['lang']['flagship_store']; ?>"><?php echo $this->_var['lang']['flagship_store']; ?></a></li>
									 <li><a href="javascript:;" data-value="<?php echo $this->_var['lang']['exclusive_shop']; ?>"><?php echo $this->_var['lang']['exclusive_shop']; ?></a></li>
									 <li><a href="javascript:;" data-value="<?php echo $this->_var['lang']['franchised_store']; ?>"><?php echo $this->_var['lang']['franchised_store']; ?></a></li>
									 <li><a href="javascript:;" data-value="<?php echo $this->_var['lang']['flagship_store']; ?>"><?php echo $this->_var['lang']['flagship_store']; ?></a></li>
								  </ul>
								<input name="store_type" type="hidden" value="0" id="store_type_val">
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>
                <div class="bot_btn">
                    <input type="submit" class="btn red_btn" name="tj_search" value="<?php echo $this->_var['lang']['button_inquire']; ?>" /><input type="reset" class="btn btn_reset" name="reset" value="<?php echo $this->_var['lang']['button_reset_alt']; ?>" />
                </div>
            </form>
        </div>
    </div>
	<!-- 显示订单商品页面 -->
    <div id="order_goods_layer"></div>
 	<?php echo $this->fetch('library/pagefooter.lbi'); ?>
	<script type="text/javascript">
    	//分页传值
        listTable.recordCount = <?php echo empty($this->_var['record_count']) ? '0' : $this->_var['record_count']; ?>;
        listTable.pageCount = <?php echo empty($this->_var['page_count']) ? '1' : $this->_var['page_count']; ?>;
    
        <?php $_from = $this->_var['filter']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
        listTable.filter.<?php echo $this->_var['key']; ?> = '<?php echo $this->_var['item']; ?>';
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        
        if($("a").hasClass('order_number')){
            var hoverTimer, outTimer,hoverTimer2;
            
            var left = $('.order_number').position().left + $('.order_number').outerWidth() + 30;
            var goods_hash_table = new Object;
            var show_goods_layer = 'order_goods_layer';
            
            $(document).on('mouseenter','.order_number',function(){
                var orderId = $(this).attr('data-orderId');
                Ajax.call('order.php?is_ajax=1&act=get_goods_info&order_id='+ orderId, '', response_goods_info , 'POST', 'JSON');
            });
            
            $(document).on('mouseleave','.order_number',function(){
                clearTimeout(hoverTimer);
                outTimer = setTimeout(function(){
                    $('.order_goods_layer').remove();
                },100);	
            });
            
            $(document).on('mouseenter','.order_goods_layer',function(){
                clearTimeout(outTimer);
            });
            
            $(document).on('mouseleave','.order_goods_layer',function(){
                $(this).remove();
            });
            
            function response_goods_info(result)
            {
                if (result.error > 0)
                {
                    alert(result.message);
                    hide_order_goods(show_goods_layer);
                    return;
                }
                if (typeof(goods_hash_table[result.content[0].order_id]) == 'undefined')
                {
                    goods_hash_table[result.content[0].order_id] = result;
                }
                //Utils.$(show_goods_layer).innerHTML = result.content[0].str;
                
                var content = result.content[0].str;
                var order_goods_layer = $(document.createElement('div')).addClass('order_goods_layer');
                var $this = $("#order_"+result.content[0].order_id);
                clearTimeout(outTimer);
                hoverTimer = setTimeout(function(){
                    $(".order_goods_layer").remove();
                    $this.parent().css("position","relative");
                    order_goods_layer.html(content);
                    order_goods_layer.css({"left":left,"top":-top});
                    $this.after(order_goods_layer);
                },200);
            }
        }
        //合并订单弹出框
        $(document).on('click',".fbutton .merge",function(){
             $.jqueryAjax("order.php", "act=merge_order_list", function(data){
                pb({
                    id:"merge_dialog",
                    title:"<?php echo $this->_var['lang']['merge_order']; ?>",
                    width:635,
                    content:data.content,
                    ok_title:"<?php echo $this->_var['lang']['merge']; ?>",
                    cl_title:"<?php echo $this->_var['lang']['button_reset_alt']; ?>",
                    drag:false,
                    foot:true,
                    onOk:function(){merge()}
                });
                $.divselect("#store_name","#store_name_val",function(){
                    $("#merge_merchant_id").hide();
                    var value = $("#store_name_val").val();
                    if(value == 1){
                        $("#merge_merchant_id").show();
                    }
                });
             });
        });
    
        $(document).on('click','a[ectype=search]',function(){
             var store_search = $("#store_name_val").val();
             var merchant_id = $("input[ name='merge_merchant_id']").val();
             $.jqueryAjax("order.php", "act=ajax_merge_order_list&store_search="+ store_search +"&merchant_id="+merchant_id, function(data){
                $("#to_order_merge").html(data.content);
                $("#from_order_merge").html(data.content);
             });	
             $.divselect("#main_order","#main_order_val");
        });
        
        /**
         * 合并
         */
        function merge()
        {
            var fromOrderSn = $('#main_order_val').val();
            var toOrderSn = $('#from_order_val').val();
            
            Ajax.call('order.php?is_ajax=1&act=ajax_merge_order','from_order_sn=o' + fromOrderSn + '&to_order_sn=o' + toOrderSn, mergeResponse, 'POST', 'JSON');
        }
    
        function mergeResponse(result)
        {
          if (result.message.length > 0)
          {
            alert(result.message);
          }
          if (result.error == 0)
          {
            //成功则清除用户填写信息
            $("#to_order_merge").find("li").remove();
            $("#from_order_merge").find("li").remove();
            location.reload();
          }
        }
    
        $.gjSearch("-240px"); //高级搜索
        
        $.divselect("#store_search","#store_search_val",function(){
            val = $("#store_search_val").val();
            $("#merchant_id_dl").hide();
            $("#store_keyword_dl").hide();
            $("#store_type_dl").hide();
            if(val == 1){
                $("#merchant_id_dl").show();
            }else if(val == 2){
                $("#store_keyword_dl").show();
            }else if(val == 3){
                $("#store_keyword_dl").show();
                $("#store_type_dl").show();
            }
        })
        
    
        function check()
        {
          var snArray = new Array();
          var eles = document.forms['listForm'].elements;
          for (var i=0; i<eles.length; i++)
          {
            if (eles[i].tagName == 'INPUT' && eles[i].type == 'checkbox' && eles[i].checked && eles[i].value != 'on')
            {
              snArray.push(eles[i].value);
            }
          }
          if (snArray.length == 0)
          {
            return false;
          }
          else
          {
            eles['order_id'].value = snArray.toString();
            return true;
          }
        }
        /**
         * 搜索订单
         */
         
        /*$(document).on("click",".order_state_tab a",function(){	
            var val = $(this).data("value");
            $(this).addClass("current").siblings().removeClass("current");
            searchOrder(val);
        })*/	 
         
        function searchOrder(val)
        {		
            <?php if ($this->_var['seller_order'] == 1): ?>
            listTable.filter['store_search'] = Utils.trim(document.forms['searchHighForm'].elements['store_search'].value);
            listTable.filter['merchant_id'] = Utils.trim(document.forms['searchHighForm'].elements['merchant_id'].value);
            listTable.filter['store_keyword'] = Utils.trim(document.forms['searchHighForm'].elements['store_keyword'].value);
            listTable.filter['store_type'] = Utils.trim(document.forms['searchHighForm'].elements['store_type'].value);
            listTable.filter['order_sn'] = Utils.trim(document.forms['searchHighForm'].elements['order_sn'].value);
            <?php endif; ?>
            
            listTable.filter['consignee'] = Utils.trim(document.forms['searchHighForm'].elements['consignee'].value);
            listTable.filter['order_cat'] = Utils.trim(document.forms['searchHighForm'].elements['order_cat'].value);
            listTable.filter['order_referer'] = Utils.trim(document.forms['searchHighForm'].elements['order_referer'].value);
            if(val>-2){
                listTable.filter['composite_status'] = val;
            }else{
                listTable.filter['composite_status'] = document.forms['searchHighForm'].elements['status'].value;
            }
            //卖场 start
            <?php if ($this->_var['rs_enabled'] && ! $this->_var['rs_id']): ?>
            listTable.filter['rs_id'] = Utils.trim(document.forms['searchHighForm'].elements['rs_id'].value);
            <?php endif; ?>
            //卖场 end
    
            listTable.filter['page'] = 1;
            listTable.loadList();
        }
        
        //导出订单列表
        function download_orderlist()
        {
            page_downloadList("<?php echo $this->_var['page_count']; ?>",'order','ajax_download','order','order_download','<?php echo $this->_var['lang']['order_export_dialog']; ?>');
        }
        
        $(document).on('click',"*[print-data='print_shipping']",function(){
            var frm = $("form[name='listForm']");
            var checkboxes = [];
            frm.find("input[name='checkboxes[]']:checkbox:checked").each(function(){
                var val = $(this).val();
                if(val){
                    checkboxes.push(val);
                }
            });
            if(checkboxes){
                window.open("print_batch.php?act=print_batch&checkboxes="+checkboxes);
            }
        });
		
		$(document).on('click',"*[id='all_list']",function(){
            var frm = $("form[name='listForm']");
            var checkboxes = [];
            frm.find("input[name='checkboxes[]']").each(function(){
                var val = $(this).val();
                if(val){
                    checkboxes.push(val);
                }
            });
            if(checkboxes){
                $(":input[name='order_id']").val(checkboxes);
            }
        });
    </script>
</body>
</html>
<?php endif; ?>