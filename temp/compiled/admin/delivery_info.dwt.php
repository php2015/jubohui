<!doctype html>
<html>
<head><?php echo $this->fetch('library/admin_html_head.lbi'); ?></head>

<body class="iframe_body">
	<div class="warpper">
    	<div class="title"><a href="order.php?act=delivery_list" class="s-back"><?php echo $this->_var['lang']['back']; ?></a><?php echo $this->_var['lang']['order_word']; ?> - <?php echo $this->_var['ur_here']; ?></div>
        <div class="content">
        	<div class="flexilist order_info">
			<form method="post" action="order.php?act=operate" name="listForm" onsubmit="return check()">
                <div class="common-content">
                	<!--订单基本信息-->
                    <div class="step">
                    	<div class="step_title"><i class="ui-step"></i><h3><?php echo $this->_var['lang']['base_info']; ?></h3></div>
                      	<div class="section">
                        	<dl>
								<dt><?php echo $this->_var['lang']['delivery_sn_number']; ?></dt>
                                <dd><?php echo $this->_var['delivery_order']['delivery_sn']; ?></dd>
                                <dt><?php echo $this->_var['lang']['label_order_sn']; ?></dt>
                                <dd><?php echo $this->_var['delivery_order']['order_sn']; ?><?php if ($this->_var['delivery_order']['extension_code'] == "group_buy"): ?><a href="group_buy.php?act=edit&id=<?php echo $this->_var['delivery_order']['extension_id']; ?>"><?php echo $this->_var['lang']['group_buy']; ?></a><?php elseif ($this->_var['delivery_order']['extension_code'] == "exchange_goods"): ?><a href="exchange_goods.php?act=edit&id=<?php echo $this->_var['delivery_order']['extension_id']; ?>"><?php echo $this->_var['lang']['exchange_goods']; ?></a><?php endif; ?></dd>
                            </dl>
                            <dl>
                            	<dt><?php echo $this->_var['lang']['label_order_time']; ?></dt>
                                <dd><?php echo $this->_var['delivery_order']['formated_add_time']; ?></dd>
                                <dt><?php echo $this->_var['lang']['label_user_name']; ?></dt>
                                <dd><?php echo empty($this->_var['delivery_order']['user_name']) ? $this->_var['lang']['anonymous'] : $this->_var['delivery_order']['user_name']; ?></dd>
                            </dl>
                            <dl>
                            	<dt><?php echo $this->_var['lang']['label_shipping_time']; ?></dt>
                                <dd><?php echo $this->_var['delivery_order']['formated_update_time']; ?></dd>
                                <dt><?php echo $this->_var['lang']['label_shipping']; ?></dt>
                                <dd><?php if ($this->_var['exist_real_goods']): ?><?php if ($this->_var['delivery_order']['shipping_id'] > 0): ?><?php echo $this->_var['delivery_order']['shipping_name']; ?><?php else: ?><?php echo $this->_var['lang']['require_field']; ?><?php endif; ?> <?php if ($this->_var['delivery_order']['insure_fee'] > 0): ?>（<?php echo $this->_var['lang']['label_insure_fee']; ?><?php echo $this->_var['delivery_order']['formated_insure_fee']; ?>）<?php endif; ?><?php endif; ?></dd>
                            </dl>
                            <dl>
                            	<dt><?php echo $this->_var['lang']['label_how_oos']; ?></dt>
                                <dd><?php echo $this->_var['delivery_order']['how_oos']; ?></dd>
                                <dt><?php echo $this->_var['lang']['label_insure_yn']; ?></dt>
                                <dd><?php if ($this->_var['insure_yn']): ?><?php echo $this->_var['lang']['yes']; ?><?php else: ?><?php echo $this->_var['lang']['no']; ?><?php endif; ?></dd>
                            </dl>
                            <dl>
                            	<dt><?php echo $this->_var['lang']['label_shipping_fee']; ?></dt>
                                <dd><?php echo $this->_var['delivery_order']['shipping_fee']; ?></dd>
                                <dt><?php echo $this->_var['lang']['label_invoice_no']; ?></dt>
                                <dd><?php if ($this->_var['delivery_order']['status'] != 1): ?><input name="invoice_no" type="text" class="text w120 mt2 <?php if ($this->_var['delivery_order']['status'] == 0): ?> text_readonly<?php endif; ?>" value="<?php echo $this->_var['delivery_order']['invoice_no']; ?>" <?php if ($this->_var['delivery_order']['status'] == 0): ?> readonly <?php endif; ?> autocomplete="off" /><?php else: ?><?php echo $this->_var['delivery_order']['invoice_no']; ?><?php endif; ?></dd>
                            </dl>
                            <dl>
                            	<dt><?php echo $this->_var['lang']['label_insure_fee']; ?></dt>
                                <dd><?php echo empty($this->_var['delivery_order']['insure_fee']) ? '0.00' : $this->_var['delivery_order']['insure_fee']; ?></dd>
                            </dl>
                        </div>
                    </div>
                    
                    <!--收货人信息-->
                    <div class="step">
                    	<div class="step_title"><i class="ui-step"></i><h3><?php echo $this->_var['lang']['consignee_info']; ?></h3></div>
                      	<div class="section">
                        	<dl>
                            	<dt><?php echo $this->_var['lang']['label_consignee']; ?></dt>
                                <dd><?php echo htmlspecialchars($this->_var['delivery_order']['consignee']); ?></dd>
                                <dt><?php echo $this->_var['lang']['label_email']; ?></dt>
                                <dd><?php echo $this->_var['delivery_order']['email']; ?></dd>
                            </dl>
                            <dl>
                            	<dt><?php echo $this->_var['lang']['label_tel']; ?></dt>
                                <dd><?php echo $this->_var['delivery_order']['tel']; ?></dd>
                                <dt><?php echo $this->_var['lang']['label_mobile']; ?></dt>
                                <dd><?php echo htmlspecialchars($this->_var['delivery_order']['mobile']); ?></dd>
                            </dl>
                            <dl>
                            	<dt><?php echo $this->_var['lang']['label_best_time']; ?></dt>
                                <dd><?php echo htmlspecialchars($this->_var['delivery_order']['best_time']); ?></dd>
                                <dt><?php echo $this->_var['lang']['label_sign_building']; ?></dt>
                                <dd><?php echo htmlspecialchars($this->_var['delivery_order']['sign_building']); ?></dd>
                            </dl>
                            <dl style="width:25%">
                            	<dt><?php echo $this->_var['lang']['label_address']; ?></dt>
                                <dd>[<?php echo $this->_var['delivery_order']['region']; ?>] <?php echo htmlspecialchars($this->_var['delivery_order']['address']); ?></dd>
                                <dt><?php echo $this->_var['lang']['label_zipcode']; ?></dt>
                                <dd><?php echo htmlspecialchars($this->_var['delivery_order']['zipcode']); ?></dd>
                            </dl>
                            <dl style="width:25%">
                            	<dt><?php echo $this->_var['lang']['label_postscript']; ?></dt>
                                <dd><?php echo $this->_var['delivery_order']['postscript']; ?></dd>
                                <dt>&nbsp;</dt>
                                <dd>&nbsp;</dd>
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
                                        <tr>
											<th width="30%" class="first"><?php echo $this->_var['lang']['goods_name_brand']; ?></th>
                                            <th width="15%"><?php echo $this->_var['lang']['goods_sn']; ?></th>
											<th width="15%"><?php echo $this->_var['lang']['product_sn']; ?></th>
                                            <th width="20%"><?php echo $this->_var['lang']['goods_attr']; ?></th>
                                            <th width="10%"><?php echo $this->_var['lang']['label_send_number']; ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
                                        <tr>
                                        	<td>
                                            	<div class="order_goods_div">
                                                    <div class="img"><a href="../goods.php?id=<?php echo $this->_var['goods']['goods_id']; ?>" target="_blank"><img src="<?php echo $this->_var['goods']['goods_thumb']; ?>" width="72" height="72" /></a></div>
                                                    <div class="name ml10"><a href="../goods.php?id=<?php echo $this->_var['goods']['goods_id']; ?>" target="_blank"><?php echo $this->_var['goods']['goods_name']; ?> <?php if ($this->_var['goods']['brand_name']): ?>[ <?php echo $this->_var['goods']['brand_name']; ?> ]<?php endif; ?></a></div>
                                                </div>
                                            </td>
											<td><?php echo $this->_var['goods']['goods_sn']; ?></td>
											<td><?php echo $this->_var['goods']['product_sn']; ?></td>
											<td><?php echo nl2br($this->_var['goods']['goods_attr']); ?></td>
											<td><?php echo $this->_var['goods']['send_number']; ?></td>
                                        </tr>
                                    	<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                    </div>
                    
                    <!--操作信息-->
                    <div class="step order_total">
                    	<div class="step_title"><i class="ui-step"></i><h3><?php echo $this->_var['lang']['op_ship']; ?><?php echo $this->_var['lang']['action_info']; ?></h3></div>
                        <div class="step_info">
                        	<div class="order_operation order_operation100">
                            	<div class="item">
                                	<div class="label"><?php echo $this->_var['lang']['action_user']; ?>：</div>
                                    <div class="value"><?php echo $this->_var['delivery_order']['action_user']; ?></div>
                                </div>
                                <div class="item">
                                	<div class="label"><?php echo $this->_var['lang']['label_agency']; ?></div>
                                    <div class="value"><?php echo $this->_var['delivery_order']['agency_name']; ?></div>
                                </div>
                                <div class="item">
                                	<div class="label"><?php echo $this->_var['lang']['label_action_note']; ?></div>
                                    <div class="value"><textarea name="action_note" cols="80" rows="3" class="textarea"></textarea></div>
                                </div>
                                <?php if ($this->_var['delivery_order']['status'] != 1): ?>
                                <div class="item">
                                	<div class="label"><?php echo $this->_var['lang']['label_operable_act']; ?></div>
                                    <div class="value">
                                    	<?php if ($this->_var['delivery_order']['status'] == 2): ?><input name="delivery_confirmed" type="submit" value="<?php echo $this->_var['lang']['op_ship']; ?>" class="btn btn25 red_btn"/><?php else: ?><input name="unship" type="submit" value="<?php echo $this->_var['lang']['op_cancel_ship']; ?>" class="btn btn25 red_btn" /><?php endif; ?>
                                        <input name="order_id" type="hidden" value="<?php echo $this->_var['delivery_order']['order_id']; ?>">
                                        <input name="delivery_id" type="hidden" value="<?php echo $this->_var['delivery_order']['delivery_id']; ?>">
                                        <input name="act" type="hidden" value="<?php echo $this->_var['action_act']; ?>">
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
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
                                        <td width="5%">&nbsp;</td>
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
				</form>
            </div>
		</div>
	</div>
 <?php echo $this->fetch('library/pagefooter.lbi'); ?>
</body>
</html>
