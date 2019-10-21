<!doctype html>
<html>
<head><?php echo $this->fetch('library/admin_html_head.lbi'); ?></head>

<body class="iframe_body">
	<div class="warpper">
    	<div class="title"><a href="order.php?act=info&order_id=<?php echo $this->_var['order']['order_id']; ?>" class="s-back"><?php echo $this->_var['lang']['back']; ?></a><?php echo $this->_var['ur_here']; ?></div>
        <div class="content">
			<form action="order.php?act=operate_post" method="post" name="theForm">
                <div class="common-content">
                	<!--订单基本信息-->
                    <div class="step">
                    	<div class="step_title"><i class="ui-step"></i><h3><?php echo $this->_var['lang']['base_info']; ?></h3></div>
                      	<div class="section">
                        	<dl>
                            	<dt><?php echo $this->_var['lang']['label_order_sn']; ?></dt>
                                <dd><?php echo $this->_var['order']['order_sn']; ?><?php if ($this->_var['order']['extension_code'] == "group_buy"): ?><a href="group_buy.php?act=edit&id=<?php echo $this->_var['order']['extension_id']; ?>"><?php echo $this->_var['lang']['group_buy']; ?></a><?php elseif ($this->_var['order']['extension_code'] == "exchange_goods"): ?><a href="exchange_goods.php?act=edit&id=<?php echo $this->_var['order']['extension_id']; ?>"><?php echo $this->_var['lang']['exchange_goods']; ?></a><?php endif; ?></dd>
								<dt><?php echo $this->_var['lang']['label_order_time']; ?></dt>
                                <dd><?php echo $this->_var['order']['formated_add_time']; ?></dd>
                            </dl>
                            <dl>
                            	<dt><?php echo $this->_var['lang']['label_user_name']; ?></dt>
                                <dd><?php echo empty($this->_var['order']['user_name']) ? $this->_var['lang']['anonymous'] : $this->_var['order']['user_name']; ?></dd>
                                <dt><?php echo $this->_var['lang']['label_how_oos']; ?></dt>
                                <dd><?php echo $this->_var['order']['how_oos']; ?></dd>
                            </dl>
                            <dl>
                            	<dt><?php echo $this->_var['lang']['label_shipping']; ?></dt>
                                <dd><?php if ($this->_var['exist_real_goods']): ?><?php if ($this->_var['order']['shipping_id'] > 0): ?><?php echo $this->_var['order']['shipping_name']; ?><?php else: ?><?php echo $this->_var['lang']['require_field']; ?><?php endif; ?> <?php if ($this->_var['order']['insure_fee'] > 0): ?>（<?php echo $this->_var['lang']['label_insure_fee']; ?><?php echo $this->_var['order']['formated_insure_fee']; ?>）<?php endif; ?><?php endif; ?></dd>
                                <dt><?php echo $this->_var['lang']['label_shipping_fee']; ?></dt>
                                <dd><?php echo $this->_var['order']['shipping_fee']; ?></dd>
                            </dl>
                            <dl style=" width:50%;">
                            	<dt><?php echo $this->_var['lang']['label_insure_yn']; ?></dt>
                                <dd><?php if ($this->_var['insure_yn']): ?><?php echo $this->_var['lang']['yes']; ?><?php else: ?><?php echo $this->_var['lang']['no']; ?><?php endif; ?></dd>
                                <dt><?php echo $this->_var['lang']['label_insure_fee']; ?></dt>
                                <dd><?php echo empty($this->_var['order']['insure_fee']) ? '0.00' : $this->_var['order']['insure_fee']; ?></dd>
                            </dl>
                        </div>
                    </div>
					<!--收货人信息-->
                    <div class="step">
                    	<div class="step_title"><i class="ui-step"></i><h3><?php echo $this->_var['lang']['consignee_info']; ?></h3></div>
                      	<div class="section">
                        	<dl>
                            	<dt><?php echo $this->_var['lang']['label_consignee']; ?></dt>
                                <dd><?php echo htmlspecialchars($this->_var['order']['consignee']); ?></dd>
                                <dt><?php echo $this->_var['lang']['label_email']; ?></dt>
                                <dd><?php if ($this->_var['order']['email']): ?><?php echo $this->_var['order']['email']; ?><?php else: ?><?php echo $this->_var['lang']['wu']; ?><?php endif; ?></dd>
                            </dl>
                            <dl>
                            	<dt><?php echo $this->_var['lang']['label_mobile']; ?></dt>
                                <dd><?php if ($this->_var['order']['mobile']): ?><?php echo htmlspecialchars($this->_var['order']['mobile']); ?><?php else: ?><?php echo $this->_var['lang']['wu']; ?><?php endif; ?></dd>
                            	<dt><?php echo $this->_var['lang']['label_tel']; ?></dt>
                                <dd><?php if ($this->_var['order']['tel']): ?><?php echo $this->_var['order']['tel']; ?><?php else: ?><?php echo $this->_var['lang']['wu']; ?><?php endif; ?></dd>
                            </dl>
                            <dl>
                            	<dt><?php echo $this->_var['lang']['label_best_time']; ?></dt>
                                <dd><?php if ($this->_var['order']['best_time']): ?><?php echo htmlspecialchars($this->_var['order']['best_time']); ?><?php else: ?><?php echo $this->_var['lang']['wu']; ?><?php endif; ?></dd>
                                <dt><?php echo $this->_var['lang']['label_sign_building']; ?></dt>
                                <dd><?php if ($this->_var['order']['sign_building']): ?><?php echo htmlspecialchars($this->_var['order']['sign_building']); ?><?php else: ?><?php echo $this->_var['lang']['wu']; ?><?php endif; ?></dd>
                            </dl>
                            <dl style="width:50%">
                            	<dt><?php echo $this->_var['lang']['label_address']; ?></dt>
                                <dd>[<?php echo $this->_var['order']['region']; ?>] <?php echo htmlspecialchars($this->_var['order']['address']); ?></dd>
                                <dt><?php echo $this->_var['lang']['label_zipcode']; ?></dt>
                                <dd><?php if ($this->_var['order']['zipcode']): ?><?php echo htmlspecialchars($this->_var['order']['zipcode']); ?><?php else: ?><?php echo $this->_var['lang']['wu']; ?><?php endif; ?></dd>
                            </dl>										
                        </div>
                    </div>
                    
                    <!--商品信息-->
                    <div class="step">
                    	<div class="step_title"><i class="ui-step"></i><h3><?php echo $this->_var['lang']['goods_info']; ?></h3></div>
                      	<div class="step_info">
                            <div class="order_goods_fr">
                            	<table class="table" border="0" cellpadding="0" cellspacing="0">
                                    <thead>
                                        <tr class="tr">
                                            <th width="38%" class="first"><?php echo $this->_var['lang']['goods_name_brand']; ?></th>
                                            <th width="7%"><?php echo $this->_var['lang']['warehouse_name']; ?></th>
											<th width="7%"><?php echo $this->_var['lang']['goods_sn']; ?></th>
                                            <th width="7%"><?php echo $this->_var['lang']['bar_code']; ?></th>
											<th width="8%"><?php echo $this->_var['lang']['product_sn']; ?></th>
                                            <th width="6%"><?php echo $this->_var['lang']['goods_price']; ?></th>
                                            <th width="5%"><?php echo $this->_var['lang']['goods_number']; ?></th>
											<th width="5%"><?php echo $this->_var['lang']['goods_delivery_curr']; ?></th>
                                            <th width="10%"><?php echo $this->_var['lang']['goods_attr']; ?></th>
                                            <th width="5%"><?php echo $this->_var['lang']['storage']; ?></th>
                                            <th width="5%"><?php echo $this->_var['lang']['subtotal']; ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
                                        <tr class="tr">
                                            <td>
											<div class="order_goods_div">
											<div class="img mr10"><img src="<?php echo $this->_var['goods']['goods_thumb']; ?>" width="72" /></div>
											<div class="name">
											<?php if ($this->_var['goods']['goods_id'] > 0 && $this->_var['goods']['extension_code'] != 'package_buy'): ?>
											<a href="../goods.php?id=<?php echo $this->_var['goods']['goods_id']; ?>" target="_blank"><?php echo $this->_var['goods']['goods_name']; ?> <?php if ($this->_var['goods']['brand_name']): ?>[ <?php echo $this->_var['goods']['brand_name']; ?> ]<?php endif; ?>
											<?php if ($this->_var['goods']['is_gift']): ?><?php if ($this->_var['goods']['goods_price'] > 0): ?><?php echo $this->_var['lang']['remark_favourable']; ?><?php else: ?><?php echo $this->_var['lang']['remark_gift']; ?><?php endif; ?><?php endif; ?>
											<?php if ($this->_var['goods']['parent_id'] > 0): ?><?php echo $this->_var['lang']['remark_fittings']; ?><?php endif; ?></a>
											<?php elseif ($this->_var['goods']['goods_id'] > 0 && $this->_var['goods']['extension_code'] == 'package_buy'): ?>
											<a href="javascript:void(0)"><?php echo $this->_var['goods']['goods_name']; ?><span style="color:#FF0000;"><?php echo $this->_var['lang']['remark_package']; ?></span></a>
											<div id="suit_<?php echo $this->_var['goods']['goods_id']; ?>" class="package_goods">
                                            	<div class="tit"><?php echo $this->_var['lang']['contain_content']; ?>：</div>
                                                <ul>
												<?php $_from = $this->_var['goods']['package_goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'package_goods_list');if (count($_from)):
    foreach ($_from AS $this->_var['package_goods_list']):
?>
												<li><a href="../goods.php?id=<?php echo $this->_var['package_goods_list']['goods_id']; ?>" target="_blank"><?php echo $this->_var['package_goods_list']['goods_name']; ?></a></li>
												<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                                </ul>
											</div>
											</div>
											</div>
											<?php endif; ?>
											</td>
											<td><?php echo $this->_var['goods']['warehouse_name']; ?></td>
                                            <td><?php echo $this->_var['goods']['goods_sn']; ?></td>
                                            <td><?php echo $this->_var['goods']['bar_code']; ?></td>
											<td><?php echo $this->_var['goods']['product_sn']; ?></td>
                                            <td><?php echo $this->_var['goods']['formated_goods_price']; ?></td>
                                            <td><?php echo $this->_var['goods']['goods_number']; ?></td>
											<td>
												<?php if ($this->_var['goods']['extension_code'] == 'package_buy'): ?>
												<?php $_from = $this->_var['goods']['package_goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'package_goods_list');if (count($_from)):
    foreach ($_from AS $this->_var['package_goods_list']):
?>
												<input name="send_number[<?php echo $this->_var['goods']['rec_id']; ?>][<?php echo $this->_var['package_goods_list']['g_p']; ?>]" type="text" id="send_number_<?php echo $this->_var['goods']['rec_id']; ?>_<?php echo $this->_var['package_goods_list']['goods_id']; ?>" class="text mb5" value="<?php echo $this->_var['package_goods_list']['send']; ?>" size="10" maxlength="11" <?php echo $this->_var['package_goods_list']['readonly']; ?>/>
												<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
												<?php else: ?>
                                                    <?php if (! $this->_var['goods']['ret_id'] || ( $this->_var['goods']['return_status'] && $this->_var['goods']['return_status'] == 6 )): ?>
                                                    <input name="send_number[<?php echo $this->_var['goods']['rec_id']; ?>]" type="text" id="send_number_<?php echo $this->_var['goods']['rec_id']; ?>" class="text" value="<?php echo $this->_var['goods']['send']; ?>" size="10" maxlength="11" <?php echo $this->_var['goods']['readonly']; ?>/>
                                                    <?php else: ?>
                                                    <span class="red"><?php echo $this->_var['lang']['application_refund']; ?></span>
                                                    <?php endif; ?>
												<?php endif; ?>
											</td>
                                            <td><?php echo nl2br($this->_var['goods']['goods_attr']); ?></td>
                                            <td><?php echo $this->_var['goods']['storage']; ?></td>
											<td>
												<?php echo $this->_var['goods']['formated_subtotal']; ?>
												<?php if ($this->_var['goods']['dis_amount'] > 0): ?>
												<br/>
												<font class="org">(<?php echo $this->_var['lang']['ciscount']; ?>：<?php echo $this->_var['goods']['discount_amount']; ?>)</font>
												<?php endif; ?>
											</td>
                                        </tr>
									<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
										<tr>
                                        	<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td><?php if ($this->_var['order']['total_weight']): ?><div align="right"><strong><?php echo $this->_var['lang']['label_total_weight']; ?></strong></div><?php endif; ?></td>
											<td><?php if ($this->_var['order']['total_weight']): ?><div align="right"><?php echo $this->_var['order']['total_weight']; ?></div><?php endif; ?></td>
											<td></td>
											<td align="right"><strong><?php echo $this->_var['lang']['label_total']; ?></strong></td>
											<td align="center"><?php echo $this->_var['order']['formated_goods_amount']; ?></td>
										</tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
					
                    <!--操作信息-->
                    <div class="step order_total">
                    	<div class="step_title"><i class="ui-step"></i><h3><?php echo $this->_var['lang']['action_info']; ?></h3></div>
                        <div class="step_info">
                        	<div class="order_operation">
								<?php if ($this->_var['suppliers_list'] != 0): ?>
								<div class="item">
									<div class="label"><?php echo $this->_var['lang']['label_suppliers']; ?></div>
									<div class="label_value">
										<div id="suppliers_id" class="imitate_select select_w320">
										  <div class="cite"><?php echo $this->_var['lang']['suppliers_no']; ?></div>
										  <ul>
											 <li><a href="javascript:;" data-value="0" class="ftx-01"><?php echo $this->_var['lang']['suppliers_no']; ?></a></li>
										  <?php $_from = $this->_var['suppliers_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'suppliers');if (count($_from)):
    foreach ($_from AS $this->_var['suppliers']):
?>
											 <li><a href="javascript:;" data-value="<?php echo $this->_var['suppliers']['suppliers_id']; ?>" class="ftx-01"><?php echo $this->_var['suppliers']['suppliers_name']; ?></a></li>
										  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
										  </ul>
										  <input name="suppliers_id" type="hidden" value="0" id="suppliers_id_val">
										</div>
										<div class="form_prompt"></div>
									</div>
								</div>
								<?php endif; ?>
                            	<div class="item">
                                	<div class="label"><?php echo $this->_var['lang']['label_action_note']; ?></div>
                                    <div class="value">
                                    	<div class="textarea_div"><textarea name="action_note" class="textarea"></textarea></div>
                                    </div>
                                </div>
                            </div>
							<div class="item mt10">
								<strong>&nbsp;</strong>
								<div class="r" style="padding-left:85px;">
									<input name="delivery_confirmed" type="submit" value="<?php echo $this->_var['lang']['op_confirm']; ?><?php echo $this->_var['lang']['op_split']; ?>" class="btn btn25 red_btn"/>&nbsp;&nbsp;<input type="button" value="<?php echo $this->_var['lang']['cancel']; ?>" class="btn btn25 red_btn" onclick="location.href='order.php?act=info&order_id=<?php echo $this->_var['order_id']; ?>'" />
									<input name="order_id" type="hidden" value="<?php echo $this->_var['order']['order_id']; ?>">
									<input name="delivery[order_sn]" type="hidden" value="<?php echo $this->_var['order']['order_sn']; ?>">
									<input name="delivery[add_time]" type="hidden" value="<?php echo $this->_var['order']['order_time']; ?>">
									<input name="delivery[user_id]" type="hidden" value="<?php echo $this->_var['order']['user_id']; ?>">
									<input name="delivery[how_oos]" type="hidden" value="<?php echo $this->_var['order']['how_oos']; ?>">
									<input name="delivery[shipping_id]" type="hidden" value="<?php echo $this->_var['order']['shipping_id']; ?>">
									<input name="delivery[shipping_fee]" type="hidden" value="<?php echo $this->_var['order']['shipping_fee']; ?>">
									<input name="delivery[consignee]" type="hidden" value="<?php echo $this->_var['order']['consignee']; ?>">
									<input name="delivery[address]" type="hidden" value="<?php echo $this->_var['order']['address']; ?>">
									<input name="delivery[country]" type="hidden" value="<?php echo $this->_var['order']['country']; ?>">
									<input name="delivery[province]" type="hidden" value="<?php echo $this->_var['order']['province']; ?>">
									<input name="delivery[city]" type="hidden" value="<?php echo $this->_var['order']['city']; ?>">
									<input name="delivery[district]" type="hidden" value="<?php echo $this->_var['order']['district']; ?>">
									<input name="delivery[sign_building]" type="hidden" value="<?php echo $this->_var['order']['sign_building']; ?>">
									<input name="delivery[email]" type="hidden" value="<?php echo $this->_var['order']['email']; ?>">
									<input name="delivery[zipcode]" type="hidden" value="<?php echo $this->_var['order']['zipcode']; ?>">
									<input name="delivery[tel]" type="hidden" value="<?php echo $this->_var['order']['tel']; ?>">
									<input name="delivery[mobile]" type="hidden" value="<?php echo $this->_var['order']['mobile']; ?>">
									<input name="delivery[best_time]" type="hidden" value="<?php echo $this->_var['order']['best_time']; ?>">
									<input name="delivery[postscript]" type="hidden" value="<?php echo $this->_var['order']['postscript']; ?>">
									<input name="delivery[how_oos]" type="hidden" value="<?php echo $this->_var['order']['how_oos']; ?>">
									<input name="delivery[insure_fee]" type="hidden" value="<?php echo $this->_var['order']['insure_fee']; ?>">
									<input name="delivery[shipping_fee]" type="hidden" value="<?php echo $this->_var['order']['shipping_fee']; ?>">
									<input name="delivery[agency_id]" type="hidden" value="<?php echo $this->_var['order']['agency_id']; ?>">
									<input name="delivery[shipping_name]" type="hidden" value="<?php echo $this->_var['order']['shipping_name']; ?>">
									<input name="operation" type="hidden" value="<?php echo $this->_var['operation']; ?>">
								</div>
							</div>
                        </div>
                    </div>
                    <div class="step order_total">
                        <div class="step_info">
                            <div class="operation_record">
                                <table cellpadding="0" cellspacing="0">
                                    <thead>
                                        <th width="5%">&nbsp;</th>
                                        <th width="15%"><?php echo $this->_var['lang']['action_user']; ?></th>
                                        <th width="15%"><?php echo $this->_var['lang']['action_time']; ?></th>
                                        <th width="15%"><?php echo $this->_var['lang']['order_status']; ?></th>
                                        <th width="15%"><?php echo $this->_var['lang']['pay_status']; ?></th>
                                        <th width="15%"><?php echo $this->_var['lang']['shipping_status']; ?></th>
                                        <th width="20%"><?php echo $this->_var['lang']['action_note']; ?></th>
                                    </thead>
                                    <tbody>
                                    <?php $_from = $this->_var['action_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'action');if (count($_from)):
    foreach ($_from AS $this->_var['action']):
?>
                                        <tr>
                                        <td>&nbsp;</td>
                                        <td><?php echo $this->_var['action']['action_user']; ?></td>
                                        <td><?php echo $this->_var['action']['action_time']; ?></td>
                                        <td><?php echo $this->_var['action']['order_status']; ?></td>
                                        <td><?php echo $this->_var['action']['pay_status']; ?></td>
                                        <td><?php echo $this->_var['action']['shipping_status']; ?></td>
                                        <td><?php echo nl2br($this->_var['action']['action_note']); ?></td>
                                        </tr>
                                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
			</form>
            </div>
		</div>
	</div> 
	<?php echo $this->fetch('library/pagefooter.lbi'); ?>
    <script type="text/javascript">
	//超值礼包
	$(".package_goods ul").perfectScrollbar("destroy");
	$(".package_goods ul").perfectScrollbar();
    </script>     
</body>
</html>
