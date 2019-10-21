<!doctype html>
<html>
<head><?php echo $this->fetch('library/admin_html_head.lbi'); ?></head>

<body class="iframe_body">
	<div class="warpper">
    	<div class="title"><a href="order.php?act=list" class="s-back"><?php echo $this->_var['lang']['back']; ?></a><?php echo $this->_var['lang']['order_word']; ?> - <?php echo $this->_var['ur_here']; ?></div>
        <div class="content">
            <div class="flexilist order_info">
                <div class="stepflex">
                	<dl class="first cur">
                    	<dt></dt>
                        <dd class="s-text"><?php echo $this->_var['lang']['submit_order']; ?><br><em class="ftx-03"><?php echo $this->_var['order']['formated_add_time']; ?></em></dd>
                    </dl>
                    <dl <?php if ($this->_var['order']['pay_status'] == '2'): ?>class="cur"<?php endif; ?>>
                    	<dt></dt>
                        <dd class="s-text"><?php echo $this->_var['lang']['payment_order']; ?><br><em class="ftx-03"><?php echo $this->_var['order']['pay_time']; ?></em></dd>
                    </dl>
                    <dl <?php if ($this->_var['order']['shipping_status'] == '1' || $this->_var['order']['shipping_status'] == '2'): ?>class="cur"<?php endif; ?> >
                    	<dt></dt>
                        <dd class="s-text"><?php echo $this->_var['lang']['seller_shipping']; ?><br><em class="ftx-03"><?php if ($this->_var['order']['shipping_status'] == '1' || $this->_var['order']['shipping_status'] == '2'): ?><?php echo $this->_var['order']['shipping_time']; ?><?php endif; ?></em></dd>
                    </dl>
                    <dl <?php if ($this->_var['order']['shipping_status'] == '2'): ?>class="cur"<?php endif; ?>>
                    	<dt></dt>
                        <dd class="s-text"><?php echo $this->_var['lang']['confirm_shipping']; ?><br><em class="ftx-03"><?php if ($this->_var['order']['shipping_status'] == '2'): ?><?php echo $this->_var['order']['confirm_take_time']; ?><?php endif; ?></em></dd>
                    </dl>
                    <dl class="last <?php if ($this->_var['order']['is_commented']): ?>cur<?php endif; ?>">
                    	<dt></dt>
                        <dd class="s-text"><?php echo $this->_var['lang']['evaluate']; ?><br><em class="ftx-03"></em></dd>
                    </dl>
                </div>
                <form action="order.php?act=operate" method="post" name="theForm">
                    <div class="common-content">
                        <!--订单基本信息-->
                        <div class="step">
                            <div class="step_title"><i class="ui-step"></i><h3><?php echo $this->_var['lang']['base_info']; ?></h3></div>
                            <div class="section">
                                <dl>
                                    <dt><?php echo $this->_var['lang']['label_order_sn']; ?></dt>
                                    <dd><?php echo $this->_var['order']['order_sn']; ?><?php if ($this->_var['order']['extension_code'] == "group_buy"): ?><a href="group_buy.php?act=edit&id=<?php echo $this->_var['order']['extension_id']; ?>"><?php echo $this->_var['lang']['group_buy']; ?></a><?php elseif ($this->_var['order']['extension_code'] == "exchange_goods"): ?><a href="exchange_goods.php?act=edit&id=<?php echo $this->_var['order']['extension_id']; ?>"><?php echo $this->_var['lang']['exchange_goods']; ?></a><?php endif; ?></dd>
                                    <dt><?php echo $this->_var['lang']['from_order']; ?>：</dt>
                                    <dd><?php if ($this->_var['order']['referer'] == 'mobile'): ?>APP<?php elseif ($this->_var['order']['referer'] == 'touch'): ?><?php echo $this->_var['lang']['touch']; ?><?php elseif ($this->_var['order']['referer'] == 'wxapp'): ?>小程序<?php elseif ($this->_var['order']['referer'] == 'ecjia-cashdesk'): ?><?php echo $this->_var['lang']['cashdesk']; ?><?php else: ?>PC<?php endif; ?></dd>
                                </dl>
                                <dl>
                                    <dt><?php echo $this->_var['lang']['label_user_name']; ?> <div class="div_a"><?php if ($this->_var['order']['user_id'] > 0): ?><a href="javascript:;" ectype="orderDialog" data-dialog="userinfo"><?php echo $this->_var['lang']['info']; ?></a><i class="shu"></i><a href="user_msg.php?act=add&order_id=<?php echo $this->_var['order']['order_id']; ?>&user_id=<?php echo $this->_var['order']['user_id']; ?>"><?php echo $this->_var['lang']['leaving_message']; ?></a><?php endif; ?></div></dt>
                                    <dd><?php echo empty($this->_var['order']['user_name']) ? $this->_var['lang']['anonymous'] : $this->_var['order']['user_name']; ?></dd>
                                    <dt><?php echo $this->_var['lang']['label_order_status']; ?></dt>
                                    <dd><?php echo $this->_var['order']['status']; ?></dd>
                                </dl>
                                <dl>
                                    <dt><?php echo $this->_var['lang']['label_payment']; ?><?php if ($this->_var['order']['order_amount'] != 0): ?><?php if (! $this->_var['order']['child_order']): ?><a href="order.php?act=edit&order_id=<?php echo $this->_var['order']['order_id']; ?>&step=payment"><i class="icon icon-edit"></i></a><?php endif; ?><?php endif; ?></dt>
                                    <dd><?php if ($this->_var['order']['pay_id'] > 0): ?><?php echo $this->_var['order']['pay_name']; ?><?php else: ?><?php echo $this->_var['lang']['wu']; ?><?php endif; ?></dd>
                                    <dt><?php echo $this->_var['lang']['label_shipping']; ?><?php if (! $this->_var['order']['child_order'] && $this->_var['order']['invoice_no'] == ''): ?><a href="order.php?act=edit&order_id=<?php echo $this->_var['order']['order_id']; ?>&step=shipping"><i class="icon icon-edit"></i></a><?php endif; ?></dt>
                                    <dd>
                                        <?php if ($this->_var['exist_real_goods']): ?>
                                        <?php if ($this->_var['order']['shipping_id'] > 0): ?><font id="shipping_name"><?php echo $this->_var['order']['shipping_name']; ?></font><?php endif; ?>
                                        <a href="order.php?act=info&order_id=<?php echo $this->_var['order']['order_id']; ?>&shipping_print=1" target="_blank"><?php echo $this->_var['lang']['print_shipping']; ?></a>
                                        <?php if ($this->_var['order']['insure_fee'] > 0): ?><span>（<?php echo $this->_var['lang']['label_insure_fee']; ?><?php echo $this->_var['order']['formated_insure_fee']; ?>）</span><?php endif; ?>
                                        <?php endif; ?>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt><?php echo $this->_var['lang']['label_order_time']; ?></dt>
                                    <dd><?php echo $this->_var['order']['formated_add_time']; ?></dd>
                                    <dt><?php echo $this->_var['lang']['label_pay_time']; ?></dt>
                                    <dd><?php echo $this->_var['order']['pay_time']; ?></dd>
                                </dl>
                                <dl>
                                    <dt><?php echo $this->_var['lang']['label_shipping_time']; ?></dt>
                                    <dd><?php echo $this->_var['order']['shipping_time']; ?></dd>
                                    <dt><?php echo $this->_var['lang']['label_invoice_no']; ?><?php if (! $this->_var['order']['child_order']): ?><?php if ($this->_var['order']['shipping_id'] > 0 && $this->_var['order']['invoice_no'] == ''): ?><a href="order.php?act=edit&order_id=<?php echo $this->_var['order']['order_id']; ?>&step=shipping"><i class="icon icon-edit"></i></a><?php endif; ?><?php endif; ?></dt>
                                    <dd>
                                    <?php if ($this->_var['order']['shipping_id'] > 0 && $this->_var['order']['shipping_status'] > 0): ?>
                                    <?php if ($this->_var['order']['invoice_no']): ?>
                                    	<div class="editSpanInput" ectype="editSpanInput">
                                            <span onclick="listTable.edit(this, 'edit_invoice_no', <?php echo $this->_var['order']['order_id']; ?>)" id="invoice_no"><?php echo $this->_var['order']['invoice_no']; ?></span>
                                            <i class="icon icon-edit"></i>
                                        </div>
                                    <?php else: ?>
                                    	<?php echo $this->_var['lang']['wu']; ?>
                                    <?php endif; ?>
                                    <?php else: ?>
                                    <?php echo $this->_var['lang']['op_unship']; ?>
                                    <?php endif; ?>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt><?php echo $this->_var['lang']['auto_delivery_time']; ?></dt>
                                    <dd>
                                    	<div class="editSpanInput" ectype="editSpanInput">
                                            <span onclick="listTable.edit(this, 'edit_auto_delivery_time', <?php echo $this->_var['order']['order_id']; ?>)"><?php echo $this->_var['order']['auto_delivery_time']; ?></span>
                                            <span><?php echo $this->_var['lang']['dateType']['0']; ?></span>
                                            <i class="icon icon-edit"></i>
                                        </div>
                                    </dd>
                                    <?php if ($this->_var['order']['is_stages']): ?>
                                    <dt><?php echo $this->_var['lang']['total_stage']; ?>：<?php echo $this->_var['order']['stages_total']; ?>&nbsp;<?php echo $this->_var['lang']['stage']; ?></dt>
                                    <dd><?php echo $this->_var['lang']['by_stage']; ?>：<?php echo $this->_var['order']['stages_one_price']; ?><?php echo $this->_var['lang']['yuan_stage']; ?></dd>
                                    <?php else: ?>
                                    <dt>&nbsp;</dt>
                                    <dd>&nbsp;</dd>
                                    <?php endif; ?>
                                </dl>
                            </div>
                        </div>
                        
                        <!--收货人信息-->
                        <div class="step">
                            <div class="step_title"><i class="ui-step"></i><h3><?php echo $this->_var['lang']['consignee_info']; ?><?php if (! $this->_var['order']['child_order']): ?><a href="order.php?act=edit&order_id=<?php echo $this->_var['order']['order_id']; ?>&step=consignee"><i class="icon icon-edit"></i></a><?php endif; ?></h3></div>
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
                        <!-- 门店信息 -->
                        <?php if ($this->_var['offline_store']): ?>
                        <div class="step">
                            <div class="step_title"><i class="ui-step"></i><h3><?php echo $this->_var['lang']['stores_info']; ?></h3></div>
                            <div class="section">
                                <dl>
                                    <dt><?php echo $this->_var['lang']['stores_name']; ?></dt>
                                    <dd><?php echo htmlspecialchars($this->_var['offline_store']['stores_name']); ?></dd>
                                    <dt><?php echo $this->_var['lang']['stores_tel']; ?></dt>
                                    <dd><?php echo $this->_var['order']['stores_tel']; ?></dd>
                                </dl>
                                <dl>
                                    <dt><?php echo $this->_var['lang']['stores_address']; ?></dt>
                                    <dd><?php echo $this->_var['offline_store']['province']; ?>&nbsp;<?php echo $this->_var['offline_store']['city']; ?>&nbsp;<?php echo $this->_var['offline_store']['district']; ?>&nbsp;<?php echo $this->_var['offline_store']['stores_address']; ?></dd>
                                    <dt><?php echo $this->_var['lang']['stores_opening_hours']; ?></dt>
                                    <dd><?php echo $this->_var['order']['stores_opening_hours']; ?></dd>
                                </dl>
                                <dl>
                                    <dt><?php echo $this->_var['lang']['stores_traffic_line']; ?></dt>
                                    <dd><?php echo htmlspecialchars($this->_var['order']['stores_traffic_line']); ?></dd>
                                    <dt><?php echo $this->_var['lang']['stores_img']; ?></dt>
                                    <dd><?php if ($this->_var['offline_store']['stores_img']): ?><a href="../<?php echo $this->_var['offline_store']['stores_img']; ?>" class="nyroModal"><i class="icon icon-picture" data-tooltipimg="../<?php echo $this->_var['offline_store']['stores_img']; ?>" ectype="tooltip" title="tooltip"></i></a><?php endif; ?></dd>
                                </dl>
                                <dl style="width:50%">
                                    <dt><?php echo $this->_var['lang']['tpnd_time']; ?>:</dt>
                                    <dd><?php echo $this->_var['offline_store']['take_time']; ?></dd>
                                    <dt><?php echo $this->_var['lang']['pick_code']; ?></dt>
                                    <dd><?php echo $this->_var['offline_store']['pick_code']; ?></dd>
                                </dl>
                            </div>
                        </div>
                        <?php endif; ?>
                        <!--订单其他信息-->
                        <div class="step">
                            <div class="step_title"><i class="ui-step"></i><h3><?php echo $this->_var['lang']['other_info']; ?><?php if (! $this->_var['order']['child_order']): ?><a href="order.php?act=edit&order_id=<?php echo $this->_var['order']['order_id']; ?>&step=other"><i class="icon icon-edit"></i></a><?php endif; ?></h3></div>
                            <div class="section">
                                <dl>
									<?php if ($this->_var['order']['invoice_type'] == 0): ?>
                                    <dt><?php echo $this->_var['lang']['label_inv_payee']; ?>(<?php if ($this->_var['order']['invoice_id'] == 0): ?><?php echo $this->_var['lang']['personal_general_invoice']; ?><?php else: ?><?php echo $this->_var['lang']['enterprise_general_invoice']; ?><?php endif; ?>)</dt>
                                    <dd><?php if ($this->_var['order']['extension_code'] != 'exchange_goods'): ?><?php echo $this->_var['order']['inv_payee']; ?><?php else: ?><?php echo $this->_var['lang']['wu']; ?><?php endif; ?></dd>
                                    <dt><?php echo $this->_var['lang']['label_inv_content']; ?></dt>
                                    <dd><?php if ($this->_var['order']['extension_code'] != 'exchange_goods'): ?><?php echo $this->_var['order']['inv_content']; ?><?php else: ?><?php echo $this->_var['lang']['wu']; ?><?php endif; ?></dd>
									<?php else: ?>
									<dt><?php echo $this->_var['lang']['label_inv_payee']; ?>(<?php echo $this->_var['lang']['VAT_invoice']; ?>)</dt>
                                    <dd><?php echo $this->_var['vat_info']['company_name']; ?><a href="javascript:;" ectype="orderDialog" data-dialog="vat"><?php echo $this->_var['lang']['view']; ?></a></dd>
									<dt><?php echo $this->_var['lang']['adopt_status']; ?></dt>
                                    <dd><?php if ($this->_var['vat_info']['audit_status'] == 0): ?><?php echo $this->_var['lang']['not_audited']; ?><?php elseif ($this->_var['vat_info']['audit_status'] == 1): ?><?php echo $this->_var['lang']['audited_adopt']; ?><?php elseif ($this->_var['vat_info']['audit_status'] == 2): ?><?php echo $this->_var['lang']['audited_not_adopt']; ?><?php endif; ?></dd>
									<?php endif; ?>
                                </dl>
                                <dl>
                                    <dt><?php echo $this->_var['lang']['label_how_oos']; ?></dt>
                                    <dd><?php if ($this->_var['order']['how_oos']): ?><?php echo $this->_var['order']['how_oos']; ?><?php else: ?><?php echo $this->_var['lang']['wu']; ?><?php endif; ?></dd>
                                    <dt><?php echo $this->_var['lang']['id_code']; ?>：</dt>
                                    <dd><?php if ($this->_var['order']['invoice_type'] == 0): ?><?php echo empty($this->_var['order']['tax_id']) ? $this->_var['lang']['wu'] : $this->_var['order']['tax_id']; ?><?php else: ?><?php echo empty($this->_var['vat_info']['tax_id']) ? $this->_var['lang']['wu'] : $this->_var['vat_info']['tax_id']; ?><?php endif; ?></dd>
                                </dl>
                                
                                <dl style="width:66.6%">
                                    <dt><?php echo $this->_var['lang']['seller_message']; ?>：</dt>
                                    <dd><?php if ($this->_var['order']['to_buyer']): ?><?php echo $this->_var['order']['to_buyer']; ?><?php else: ?><?php echo $this->_var['lang']['wu']; ?><?php endif; ?></dd>
                                    <dt><?php echo $this->_var['lang']['buyer_message']; ?>：</dt>
                                    <dd><?php if ($this->_var['order']['postscript']): ?><?php echo $this->_var['order']['postscript']; ?><?php else: ?><?php echo $this->_var['lang']['wu']; ?><?php endif; ?></dd>
                                </dl>
                            </div>
                        </div>
                        
                        <!--商品信息-->
                        <?php if ($this->_var['order']['is_zc_order'] == 1): ?>
                        <div class="step">
                            <div class="step_title"><i class="ui-step"></i><h3><?php echo $this->_var['lang']['zc_goods_info']; ?></h3></div>
                            <div class="step_info">
                                <div class="order_goods_fr">
                                    <table class="table" border="0" cellpadding="0" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th width="20%" class="first"><?php echo $this->_var['lang']['zc_project_name']; ?></th>
                                                <th width="8%"><?php echo $this->_var['lang']['start_time']; ?></th>
                                                <th width="7%"><?php echo $this->_var['lang']['end_time']; ?></th>
                                                <th width="7%"><?php echo $this->_var['lang']['zc_project_raise_money']; ?></th>
                                                <th width="7%"><?php echo $this->_var['lang']['zc_goods_price']; ?></th>									
                                                <th width="5%"><?php echo $this->_var['lang']['zc_shipping_fee']; ?></th>
                                                <th width="6%"><?php echo $this->_var['lang']['zc_return_time']; ?></th>
                                                <th width="25%"><?php echo $this->_var['lang']['zc_return_content']; ?></th>
                                                <th width="5%"><?php echo $this->_var['lang']['subtotal']; ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td align="center"><a href="../crowdfunding.php?act=detail&id=<?php echo $this->_var['zc_goods_info']['pid']; ?>" target="_blank"><?php echo $this->_var['zc_goods_info']['title']; ?></a></td>
                                                <td align="center"><?php echo $this->_var['zc_goods_info']['start_time']; ?></td>
                                                <td align="center"><?php echo $this->_var['zc_goods_info']['end_time']; ?></td>
                                                <td align="center"><?php echo $this->_var['zc_goods_info']['formated_amount']; ?></td>
                                                <td align="center"><?php echo $this->_var['zc_goods_info']['formated_price']; ?></td>					
                                                <td align="center"><?php echo $this->_var['zc_goods_info']['formated_shipping_fee']; ?></td>
                                                <td align="center"><?php echo $this->_var['zc_goods_info']['return_time']; ?></td>
                                                <td align="center" style="padding:10px;"><?php echo $this->_var['zc_goods_info']['content']; ?></td>
                                                <td align="center"><?php echo $this->_var['zc_goods_info']['formated_price']; ?></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td align="right"><strong><?php echo $this->_var['lang']['label_total']; ?></strong></td>
                                                <td align="center"><?php echo $this->_var['order']['formated_goods_amount']; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <?php else: ?>
                        <div class="step">
                            <div class="step_title"><i class="ui-step"></i><h3><?php echo $this->_var['lang']['goods_info']; ?><?php if (! $this->_var['order']['child_order']): ?><a href="order.php?act=edit&order_id=<?php echo $this->_var['order']['order_id']; ?>&step=goods"><i class="icon icon-edit"></i></a><?php endif; ?></h3></div>
                            <div class="step_info">
                                <div class="order_goods_fr">
                                    <table class="table" border="0" cellpadding="0" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th width="25%" class="first"><?php echo $this->_var['lang']['goods_name_brand']; ?></th>
                                                <th width="8%"><?php echo $this->_var['lang']['warehouse_name']; ?></th>
                                                <th width="7%"><?php echo $this->_var['lang']['goods_sn']; ?></th>
                                                <th width="7%"><?php echo $this->_var['lang']['bar_code']; ?></th>
                                                <th width="7%"><?php echo $this->_var['lang']['product_sn']; ?></th>
                                                <th width="6%"><?php echo $this->_var['lang']['goods_price']; ?></th>
												<th width="5%"><?php echo $this->_var['lang']['give_integral']; ?></th>
                                                <th width="5%"><?php echo $this->_var['lang']['goods_number']; ?></th>
                                                <th width="8%"><?php echo $this->_var['lang']['goods_attr']; ?></th>
                                                <th width="5%"><?php echo $this->_var['lang']['storage']; ?></th>
                                                <th width="8%"><?php echo $this->_var['lang']['subtotal']; ?></th>
												<th width="7%"><?php echo $this->_var['lang']['handler']; ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
                                            <tr>
                                                <td>
                                                    <div class="order_goods_div">
                                                        <div class="img">
															<?php if ($this->_var['order']['extension_code'] == "presale"): ?>
															<a href="../presale.php?act=view&id=<?php echo $this->_var['goods']['act_id']; ?>" target="_blank"><img src="<?php echo $this->_var['goods']['goods_thumb']; ?>" width="72" height="72" /></a>
															<?php elseif ($this->_var['order']['extension_code'] == "group_buy"): ?>
															<a href="../group_buy.php?act=view&id=<?php echo $this->_var['goods']['extension_id']; ?>" target="_blank"><img src="<?php echo $this->_var['goods']['goods_thumb']; ?>" width="72" height="72" /></a>
															<?php elseif ($this->_var['order']['extension_code'] == "snatch"): ?>
															<a href="../snatch.php?act=view&id=<?php echo $this->_var['goods']['extension_id']; ?>" target="_blank"><img src="<?php echo $this->_var['goods']['goods_thumb']; ?>" width="72" height="72" /></a>
															<?php elseif ($this->_var['order']['extension_code'] == "seckill"): ?>
															<a href="../seckill.php?act=view&id=<?php echo $this->_var['goods']['extension_id']; ?>" target="_blank"><img src="<?php echo $this->_var['goods']['goods_thumb']; ?>" width="72" height="72" /></a>
															<?php elseif ($this->_var['order']['extension_code'] == "auction"): ?>
															<a href="../auction.php?act=view&id=<?php echo $this->_var['goods']['extension_id']; ?>" target="_blank"><img src="<?php echo $this->_var['goods']['goods_thumb']; ?>" width="72" height="72" /></a>
															<?php elseif ($this->_var['order']['extension_code'] == "exchange_goods"): ?>
															<a href="../exchange_goods.php?act=view&id=<?php echo $this->_var['goods']['extension_id']; ?>" target="_blank"><img src="<?php echo $this->_var['goods']['goods_thumb']; ?>" width="72" height="72" /></a>
															<?php elseif ($this->_var['order']['extension_code'] == "presale"): ?>
															<a href="../presale.php?act=view&id=<?php echo $this->_var['goods']['extension_id']; ?>" target="_blank"><img src="<?php echo $this->_var['goods']['goods_thumb']; ?>" width="72" height="72" /></a>
															<?php elseif ($this->_var['goods']['extension_code'] == "package_buy"): ?>
															<a href="../package.php" target="_blank"><img src="<?php echo $this->_var['goods']['goods_thumb']; ?>" width="72" height="72" /></a>
															<?php else: ?>
															<a href="../goods.php?id=<?php echo $this->_var['goods']['goods_id']; ?>" target="_blank"><img src="<?php echo $this->_var['goods']['goods_thumb']; ?>" width="72" height="72" /></a>
															<?php endif; ?>
														</div>
                                                        <div class="name ml10">
                                                            <?php if ($this->_var['goods']['goods_id'] > 0 && $this->_var['goods']['extension_code'] != 'package_buy'): ?>
																<?php if ($this->_var['order']['extension_code'] == "presale"): ?>
																<a href="../presale.php?act=view&id=<?php echo $this->_var['goods']['act_id']; ?>" target="_blank"><?php echo $this->_var['goods']['goods_name']; ?></a>
																<?php elseif ($this->_var['order']['extension_code'] == "group_buy"): ?>
																<a href="../group_buy.php?act=view&id=<?php echo $this->_var['goods']['extension_id']; ?>" target="_blank"><?php echo $this->_var['goods']['goods_name']; ?></a>
																<?php elseif ($this->_var['order']['extension_code'] == "snatch"): ?>
																<a href="../snatch.php?id=<?php echo $this->_var['goods']['extension_id']; ?>" target="_blank"><?php echo $this->_var['goods']['goods_name']; ?></a>
																<?php elseif ($this->_var['order']['extension_code'] == "seckill"): ?>
																<a href="../seckill.php?id=<?php echo $this->_var['goods']['extension_id']; ?>&act=view" target="_blank"><?php echo $this->_var['goods']['goods_name']; ?></a>
																<?php elseif ($this->_var['order']['extension_code'] == "auction"): ?>
																<a href="../auction.php?id=<?php echo $this->_var['goods']['extension_id']; ?>&act=view" target="_blank"><?php echo $this->_var['goods']['goods_name']; ?></a>
																<?php elseif ($this->_var['order']['extension_code'] == "exchange_goods"): ?>
																<a href="../exchange.php?id=<?php echo $this->_var['goods']['extension_id']; ?>&act=view" target="_blank"><?php echo $this->_var['goods']['goods_name']; ?></a>
																<?php elseif ($this->_var['order']['extension_code'] == "presale"): ?>
																<a href="../presale.php?id=<?php echo $this->_var['goods']['extension_id']; ?>&act=view" target="_blank"><?php echo $this->_var['goods']['goods_name']; ?></a>
																<?php else: ?>
																<a href="../goods.php?id=<?php echo $this->_var['goods']['goods_id']; ?>" target="_blank"><?php echo $this->_var['goods']['goods_name']; ?> <?php if ($this->_var['goods']['brand_name']): ?>[ <?php echo $this->_var['goods']['brand_name']; ?> ]<?php endif; ?>
																<?php endif; ?>
															<?php if ($this->_var['goods']['is_gift']): ?><?php if ($this->_var['goods']['goods_price'] > 0): ?><?php echo $this->_var['lang']['remark_favourable']; ?><?php else: ?><?php echo $this->_var['lang']['remark_gift']; ?><?php endif; ?><?php endif; ?>
                                                            <?php if ($this->_var['goods']['parent_id'] > 0): ?><?php echo $this->_var['lang']['remark_fittings']; ?><?php endif; ?></a>
                                                            <?php elseif ($this->_var['goods']['goods_id'] > 0 && $this->_var['goods']['extension_code'] == 'package_buy'): ?>
                                                            <a href="javascript:void(0)" onclick="setSuitShow(<?php echo $this->_var['goods']['goods_id']; ?>)"><?php echo $this->_var['goods']['goods_name']; ?><span class="red"><?php echo $this->_var['lang']['remark_package']; ?></span></a>
                                                            <div id="suit_<?php echo $this->_var['goods']['goods_id']; ?>" class="package_goods">
                                                                <div class="tit"><?php echo $this->_var['lang']['contain_content']; ?>：</div>
                                                                <ul>
                                                                <?php $_from = $this->_var['goods']['package_goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'package_goods_list');if (count($_from)):
    foreach ($_from AS $this->_var['package_goods_list']):
?>
                                                                <li><a href="../goods.php?id=<?php echo $this->_var['package_goods_list']['goods_id']; ?>" target="_blank" title="<?php echo $this->_var['package_goods_list']['goods_name']; ?>"><?php echo $this->_var['package_goods_list']['goods_name']; ?></a></li>
                                                                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                                                </ul>
                                                            </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><?php echo $this->_var['goods']['warehouse_name']; ?></td>
                                                <td><?php echo $this->_var['goods']['goods_sn']; ?></td>
                                                <td><?php echo $this->_var['goods']['bar_code']; ?></td>
                                                <td><?php echo $this->_var['goods']['product_sn']; ?></td>
                                                <td><?php echo $this->_var['goods']['formated_goods_price']; ?></td>
												<td ><?php echo empty($this->_var['goods']['give_integral']) ? '0' : $this->_var['goods']['give_integral']; ?></td>
                                                <td><?php echo $this->_var['goods']['goods_number']; ?></td>
                                                <td><?php echo nl2br($this->_var['goods']['goods_attr']); ?></td>
                                                <td><?php echo $this->_var['goods']['storage']; ?></td>
                                                <td>
                                                    <?php echo $this->_var['goods']['formated_subtotal']; ?>
                                                    <?php if ($this->_var['goods']['dis_amount'] > 0): ?>
                                                    <br/>
                                                    <font class="org">(<?php echo $this->_var['lang']['ciscount']; ?>：<?php echo $this->_var['goods']['discount_amount']; ?>)</font>
                                                    <?php endif; ?>
                                                </td>
												<td>
												<?php if ($this->_var['goods']['extension_code'] != 'package_buy'): ?>	
                                                    <?php if (! $this->_var['goods']['ret_id'] || ( $this->_var['goods']['return_status'] && $this->_var['goods']['return_status'] == 6 )): ?>
                                                        <!--生成发货单-->
                                                        <?php if ($this->_var['order']['shipping_status'] != 1 && $this->_var['order']['order_child'] == 0): ?>
                                                            <?php if ($this->_var['goods']['goods_number'] > $this->_var['goods']['send_number'] && $this->_var['goods']['is_cloud_order'] == 0): ?>
                                                            <input name="part_ship" type="button" value="<?php echo $this->_var['lang']['op_split']; ?>" class="btn btn25 blue_btn" data-rec_id="<?php echo $this->_var['goods']['rec_id']; ?>" />
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                        
                                                        <?php if ($this->_var['goods']['delivery']): ?>
                                                        	<?php if ($this->_var['goods']['delivery']['status'] == 2): ?>
                                                                <!--发货-->
                                                                <?php if ($this->_var['operable_list']['to_delivery']): ?>
                                                                <input name="part_to_delivery" type="button" value="<?php echo $this->_var['lang']['op_to_delivery']; ?>" class="btn btn25 blue_btn" data-order_sn="<?php echo $this->_var['order']['order_sn']; ?>" data-goods_id="<?php echo $this->_var['goods']['goods_id']; ?>" /><br/>
                                                                <?php endif; ?>
                                                            <?php elseif ($this->_var['goods']['delivery']['status'] == 0): ?> 
                                                            	<a href="order.php?act=delivery_info&delivery_id=<?php echo $this->_var['goods']['delivery']['delivery_id']; ?>" target="_blank" class="btn btn25 blue_btn"><?php echo $this->_var['lang']['view']; ?></a>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                        <!--发货状态-->
                                                        <?php if ($this->_var['goods']['goods_number'] > $this->_var['goods']['send_number']): ?>
                                                        <p class="red"><?php echo $this->_var['lang']['has_been_issued']; ?><?php echo empty($this->_var['goods']['send_number']) ? '0' : $this->_var['goods']['send_number']; ?><?php echo $this->_var['lang']['jian']; ?></p>
                                                        <?php endif; ?>													
                                                        <?php if ($this->_var['goods']['goods_number'] == $this->_var['goods']['send_number']): ?>	
                                                        <p class="red"><?php echo $this->_var['lang']['invoice_generated']; ?></p>
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        <?php if ($this->_var['goods']['refound_status']): ?><?php echo $this->_var['lang']['has_benn_refund']; ?><?php else: ?><input name="refound" type="button" value="<?php echo $this->_var['lang']['refound']; ?>" class="btn btn25 blue_btn" data-ret_id="<?php echo $this->_var['goods']['ret_id']; ?>" data-rec_id="<?php echo $this->_var['goods']['rec_id']; ?>" /><?php endif; ?>
                                                    <?php endif; ?>
												<?php else: ?>
													N/A
												<?php endif; ?>
												</td>
                                            </tr>
                                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                            <tr>
                                                <td colspan="12">
                                                    <div class="order_total_fr">
                                                        <?php if ($this->_var['order']['total_weight']): ?>
                                                        <strong><?php echo $this->_var['lang']['label_total_weight']; ?></strong>
                                                        <span class="red"><?php echo $this->_var['order']['total_weight']; ?></span>
                                                        <?php endif; ?>
                                                        <strong><?php echo $this->_var['lang']['label_total']; ?></strong>
                                                        <span class="red"><?php echo $this->_var['order']['formated_goods_amount']; ?></span>
														<?php if ($this->_var['order']['formated_cost_amount']): ?>
                                                        <strong><?php echo $this->_var['lang']['label_total_cost']; ?></strong>
                                                        <span class="red"><?php echo $this->_var['order']['formated_cost_amount']; ?></span>
														<?php endif; ?>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        
                        <!--费用信息-->
                        <div class="step order_total">
                            <div class="step_title"><i class="ui-step"></i><h3><?php echo $this->_var['lang']['fee_info']; ?><?php if (! $this->_var['order']['child_order'] && $this->_var['order']['pay_status'] == '0'): ?><a href="order.php?act=edit&order_id=<?php echo $this->_var['order']['order_id']; ?>&step=money"><i class="icon icon-edit"></i></a><?php endif; ?></h3></div>
                            <div class="section">
                                <dl>
                                    <dt><?php echo $this->_var['lang']['label_goods_amount']; ?></dt>
                                    <dd><?php echo $this->_var['order']['formated_goods_amount']; ?></dd>
                                    <dt><?php echo $this->_var['lang']['label_surplus']; ?></dt>
                                    <dd>- <?php echo $this->_var['order']['formated_surplus']; ?></dd>
                                </dl>
                                <dl>
                                    <dt><?php echo $this->_var['lang']['label_tax']; ?></dt>
                                    <dd>+ <?php echo $this->_var['order']['formated_tax']; ?></dd>
                                    <dt><?php echo $this->_var['lang']['label_integral']; ?></dt>
                                    <dd>- <?php echo $this->_var['order']['formated_integral_money']; ?></dd>
                                </dl>
                                <dl>
                                    <dt><?php echo $this->_var['lang']['label_shipping_fee']; ?></dt>
                                    <dd>+ <?php echo $this->_var['order']['formated_shipping_fee']; ?></dd>
                                    <dt><?php echo $this->_var['lang']['label_bonus']; ?></dt>
                                    <dd>- <?php echo $this->_var['order']['formated_bonus']; ?></dd>
                                </dl>
                                <dl>
                                    <dt><?php echo $this->_var['lang']['label_pay_fee']; ?></dt>
                                    <dd>+ <?php echo $this->_var['order']['formated_pay_fee']; ?></dd>
                                    <dt><?php echo $this->_var['lang']['label_coupons']; ?></dt>
                                    <dd><?php if ($this->_var['cou_type'] == 5): ?><?php echo $this->_var['lang']['stamp_free_voucher']; ?><?php else: ?>- <?php echo $this->_var['order']['formated_coupons']; ?><?php endif; ?></dd>
                                </dl>
                                <dl>
                                    <dt><?php echo $this->_var['lang']['label_discount']; ?></dt>
                                    <dd>- <?php echo $this->_var['order']['formated_discount']; ?></dd>
                                    <dt><?php echo $this->_var['lang']['label_value_card']; ?></dt>
                                    <dd>- <?php echo $this->_var['order']['formated_value_card']; ?></dd>
                                </dl>
                                <dl>
                                    <dt></dt>
                                    <dd></dd>
                                    
                                    <dt><?php echo $this->_var['lang']['label_money_paid']; ?></dt>
                                    <dd>- <?php echo $this->_var['order']['formated_money_paid']; ?></dd>
                                </dl>
                                <dl>
                                	<dt><?php echo $this->_var['lang']['label_order_amount']; ?></dt>
                                    <dd class="red"><?php echo $this->_var['order']['formated_total_fee']; ?></dd>
                                    <?php if ($this->_var['order']['order_amount'] >= 0): ?>
                                        <dt><?php echo $this->_var['lang']['label_money_dues']; ?></dt>
                                        <dd class="red"><?php echo $this->_var['order']['formated_order_amount']; ?><?php if ($this->_var['order']['formated_cost_amount']): ?>（<?php echo $this->_var['lang']['net_profit']; ?>：<?php echo $this->_var['order']['formated_profit_amount']; ?>）<?php endif; ?></dd>
                                    <?php else: ?>
                                        <dt><?php echo $this->_var['lang']['label_money_refund']; ?></dt>
                                        <dd class="red">
                                        	<?php echo $this->_var['order']['formated_money_refund']; ?>
                                        	<input name="refund" type="button" class="button" value="<?php echo $this->_var['lang']['refund']; ?>" onclick="location.href='order.php?act=process&func=load_refund&anonymous=<?php if ($this->_var['order']['user_id'] <= 0): ?>1<?php else: ?>0<?php endif; ?>&order_id=<?php echo $this->_var['order']['order_id']; ?>&refund_amount=<?php echo $this->_var['order']['money_refund']; ?>'" />
                                        </dd>
                                    <?php endif; ?>
                                    <?php if ($this->_var['order']['extension_code'] == "group_buy"): ?>
                                    	<br /><?php echo $this->_var['lang']['notice_gb_order_amount']; ?>
                                    <?php endif; ?>
                                </dl>
                            </div>
                        </div>
                        
                        <!--操作信息-->
						<?php if ($this->_var['order']['order_child'] == 0): ?>
                        <div class="step order_total">
                            <div class="step_title"><i class="ui-step"></i><h3><?php echo $this->_var['lang']['action_info']; ?></h3></div>
                            <div class="step_info">
                                <div class="order_operation order_operation100">
                                    <div class="item">
                                        <div class="label"><?php echo $this->_var['lang']['operation_notes']; ?>：</div>
                                        <div class="value">
                                            <div class="bf100 fl"><textarea name="action_note" class="textarea"></textarea></div>
                                            <div class="order_operation_btn">							
                                                <?php if ($this->_var['operable_list']['confirm'] && $this->_var['order']['order_status'] != 4 && $this->_var['order']['order_status'] != 7): ?>
                                                <input name="confirm" type="submit" value="<?php echo $this->_var['lang']['op_confirm']; ?>" class="btn btn25 red_btn" />
                                                <?php endif; ?>
												
												<?php if ($this->_var['operable_list']['pay']): ?>
                                                <input name="pay" type="submit" value="<?php echo $this->_var['lang']['op_pay']; ?>" class="btn btn25 red_btn" />
                                                <?php endif; ?> 
												
												<?php if ($this->_var['operable_list']['unpay'] && $this->_var['is_cloud_order'] != 1): ?>
                                                <input name="unpay" type="submit" class="btn btn25 red_btn" value="<?php echo $this->_var['lang']['op_unpay']; ?>" />
                                                <?php endif; ?> 
												
												<?php if ($this->_var['operable_list']['prepare'] && $this->_var['is_cloud_order'] != 1): ?>
                                                <input name="prepare" type="submit" value="<?php echo $this->_var['lang']['op_prepare']; ?>" class="btn btn25 red_btn" />
                                                <?php endif; ?> 
												
												<?php if ($this->_var['operable_list']['split'] && $this->_var['order']['order_child'] == 0 && $this->_var['is_cloud_order'] != 1): ?>
                                                <input name="ship" type="submit" value="<?php echo $this->_var['lang']['op_split']; ?>" class="btn btn25 red_btn" />
                                                <?php endif; ?> 
												
												<?php if ($this->_var['operable_list']['unship'] && $this->_var['is_cloud_order'] != 1): ?>
                                                <input name="unship" type="submit" value="<?php echo $this->_var['lang']['op_unship']; ?>" class="btn btn25 red_btn" />
                                                <?php endif; ?>
												
												<?php if ($this->_var['operable_list']['receive']): ?>
                                                <input name="receive" type="submit" value="<?php echo $this->_var['lang']['op_receive']; ?>" class="btn btn25 red_btn" />
                                                <?php endif; ?> 
												
												<?php if ($this->_var['operable_list']['cancel']): ?>
                                                <input name="cancel" type="submit" value="<?php echo $this->_var['lang']['op_cancel']; ?>" class="btn btn25 red_btn" />
                                                <?php endif; ?> 
												
												<?php if ($this->_var['operable_list']['invalid']): ?>
                                                <input name="invalid" type="submit" value="<?php echo $this->_var['lang']['op_invalid']; ?>" class="btn btn25 red_btn" />
                                                <?php endif; ?> 
                                                
                                        		<?php if ($this->_var['is_cloud_order'] != 1): ?>
                                                	<?php if ($this->_var['order']['shipping_status'] != 3 && $this->_var['order']['shipping_status'] != 5): ?>
                                                        <?php if ($this->_var['operable_list']['return'] && $this->_var['order_back_apply'] || $this->_var['order']['pay_status'] == 2): ?>
                                                        <input name="return" type="submit" value="<?php echo $this->_var['lang']['op_return']; ?>" class="btn btn25 red_btn" />
                                                        <?php endif; ?> 
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                
                                                <?php if ($this->_var['operable_list']['to_delivery'] && $this->_var['is_cloud_order'] != 1): ?>
                                                <input name="to_delivery" type="submit" value="<?php echo $this->_var['lang']['op_to_delivery']; ?>" class="btn btn25 red_btn"/>
                                                <input name="order_sn" type="hidden" value="<?php echo $this->_var['order']['order_sn']; ?>" />
                                                <?php endif; ?> <input name="after_service" type="submit" value="<?php echo $this->_var['lang']['op_after_service']; ?>" class="btn btn25 red_btn" /><?php if ($this->_var['operable_list']['remove'] && $this->_var['order_os_remove']): ?>
                                                <input name="remove" type="submit" value="<?php echo $this->_var['lang']['remove']; ?>" class="btn btn25 red_btn" onClick="return window.confirm('<?php echo $this->_var['lang']['js_languages']['remove_confirm']; ?>');" />
                                                <?php endif; ?>
                                                <?php if ($this->_var['order']['extension_code'] == "group_buy"): ?><?php echo $this->_var['lang']['notice_gb_ship']; ?><?php endif; ?>
                                                <?php if ($this->_var['agency_list']): ?>
                                                <input name="assign" type="submit" value="<?php echo $this->_var['lang']['op_assign']; ?>" class="btn btn25 red_btn" onclick="return assignTo(document.forms['theForm'].elements['agency_id'].value)" />
                                                <div class="imitate_select select_w120" style="margin-top:-2px;">
                                                    <div class="cite"><?php echo $this->_var['lang']['select_please']; ?></div>
                                                    <ul>
                                                       <?php $_from = $this->_var['agency_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'agency');if (count($_from)):
    foreach ($_from AS $this->_var['agency']):
?>
                                                       <li><a href="javascript:;" data-value="<?php echo $this->_var['agency']['agency_id']; ?>" class="ftx-01"><?php echo $this->_var['agency']['agency_name']; ?></a></li>
                                                       <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                                    </ul>
                                                    <input name="agency_id" type="hidden" value="0">
                                                </div>
                                                <?php endif; ?>
                                                <input name="order_id" type="hidden" value="<?php echo $_REQUEST['order_id']; ?>">
                                                <?php if ($this->_var['operable_list']['split'] && $this->_var['order']['order_child'] == 0 && $this->_var['is_cloud_order'] != 1 && ! $this->_var['operable_list']['receive'] && ! $this->_var['order']['delivery_id'] && ( $this->_var['order']['pay_status'] == 2 || $this->_var['order']['pay_code'] == 'cod' || $this->_var['order']['pay_code'] == 'pay_cod' || $this->_var['order']['pay_code'] == 'bank' ) && $this->_var['order']['shipping_status'] != 1 && $this->_var['order']['shipping_status'] != 2): ?>
                                               	<div class="fr relative" id="key_delivery">
                                                    <a href="javascript:;" class="btn btn25 btn_blue one_delivery"><?php echo $this->_var['lang']['one_key_delivery']; ?></a>
                                                </div>
                                                <?php endif; ?>
                                                <!--门店列表 start-->
												<?php if ($this->_var['can_set_grab_order'] && $this->_var['is_cloud_order'] != 1): ?>
												<input type="button" value="<?php echo $this->_var['lang']['set_grab_order']; ?>" class="btn btn25 red_btn" onclick="set_grab_order(<?php echo $this->_var['order']['order_id']; ?>)"/>
												<?php endif; ?>
												<!--门店列表 end-->	
												<input type="button" value="<?php echo $this->_var['lang']['print_order']; ?>" class="btn btn25 blue_btn" onclick="javascript:window.open('tp_api.php?act=order_print&order_id=<?php echo $this->_var['order']['order_id']; ?>')"/>
                                            </div>
                                        </div>
                                    </div>
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
                                    
                                    <?php if ($this->_var['order']['invoice_no']): ?>
                                    <table cellpadding="0" cellspacing="0" class="order_js_table">
                                        <tr>
                                            <td id="retData" style="padding:10px 0;"></td>
                                        </tr>
                                    </table>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
						<?php endif; ?>
                    </div>
                </form>
            </div>
		</div>
	</div>
    <?php if (! $this->_var['operable_list']['receive']): ?>
    <form action="order.php?act=operate" method="post" name="theForm" id="operate_form">
    <?php echo $this->fetch('library/order_delivery.lbi'); ?>
    </form>
    <?php endif; ?>
    <?php if ($this->_var['user']): ?>
    <div id="topbar" class="hide">
    	<div class="topbar_info">
        	<div class="ul">
          <table width="100%" border="0">
            <caption><strong><?php echo $this->_var['lang']['buyer_info']; ?></strong></caption>
            <tr>
              <td class="label"><?php echo $this->_var['lang']['email']; ?>：</td>
              <td><a href="mailto:<?php echo $this->_var['user']['email']; ?>"><?php echo $this->_var['user']['email']; ?></a></td>
            </tr>
            <tr>
              <td class="label"><?php echo $this->_var['lang']['user_money']; ?>：</td>
              <td><?php echo $this->_var['user']['formated_user_money']; ?></td>
            </tr>
            <tr>
              <td class="label"><?php echo $this->_var['lang']['pay_points']; ?>：</td>
              <td><?php echo $this->_var['user']['pay_points']; ?></td>
            </tr>
            <tr>
              <td class="label"><?php echo $this->_var['lang']['rank_points']; ?>：</td>
              <td><?php echo $this->_var['user']['rank_points']; ?></td>
            </tr>
            <tr>
              <td class="label"><?php echo $this->_var['lang']['rank_name']; ?>：</td>
              <td><?php echo $this->_var['user']['rank_name']; ?></td>
            </tr>
            <tr>
              <td class="label"><?php echo $this->_var['lang']['bonus_count']; ?>：</td>
              <td><?php echo $this->_var['user']['bonus_count']; ?></td>
            </tr>
          </table>
        
          <?php $_from = $this->_var['address_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'address');if (count($_from)):
    foreach ($_from AS $this->_var['address']):
?>
          <table width="100%" border="0">
            <caption><strong><?php echo $this->_var['lang']['consignee']; ?>:<?php echo htmlspecialchars($this->_var['address']['consignee']); ?></strong></caption>
            <tr>
              <td class="label"><?php echo $this->_var['lang']['email']; ?>：</td>
              <td><a href="mailto:<?php echo htmlspecialchars($this->_var['address']['email']); ?>"><?php echo htmlspecialchars($this->_var['address']['email']); ?></a></td>
            </tr>
            <tr>
              <td class="label"><?php echo $this->_var['lang']['address']; ?>：</td>
              <td><?php echo htmlspecialchars($this->_var['address']['address']); ?></td>
            </tr>
            <tr>
              <td class="label"><?php echo $this->_var['lang']['zipcode']; ?>：</td>
              <td><?php echo htmlspecialchars($this->_var['address']['zipcode']); ?></td>
            </tr>
            <tr>
              <td class="label"><?php echo $this->_var['lang']['tel']; ?>：</td>
              <td><?php echo htmlspecialchars($this->_var['address']['tel']); ?></td>
            </tr>
            <tr>
              <td class="label"><?php echo $this->_var['lang']['mobile']; ?>：</td>
              <td><?php echo htmlspecialchars($this->_var['address']['mobile']); ?></td>
            </tr>
          </table>
          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
          </div>
      </div>
    </div>
    <?php endif; ?>
    
   	<div id="vat" class="hide">
    	<table width="100%" border="0">
            <caption><strong><?php echo $this->_var['lang']['vat_info']; ?></strong></caption>
            <tr>
              <td class="label"><?php echo $this->_var['lang']['vat_name']; ?>：</td>
              <td><?php echo $this->_var['vat_info']['company_name']; ?></td>
            </tr>
            <tr>
              <td class="label"><?php echo $this->_var['lang']['vat_taxid']; ?>：</td>
              <td><?php echo $this->_var['vat_info']['tax_id']; ?></td>
            </tr>
            <tr>
              <td class="label"><?php echo $this->_var['lang']['vat_company_address']; ?>：</td>
              <td><?php echo $this->_var['vat_info']['company_address']; ?></td>
            </tr>
            <tr>
              <td class="label"><?php echo $this->_var['lang']['vat_company_telephone']; ?>：</td>
              <td><?php echo $this->_var['vat_info']['company_telephone']; ?></td>
            </tr>
            <tr>
              <td class="label"><?php echo $this->_var['lang']['vat_bank_of_deposit']; ?>：</td>
              <td><?php echo $this->_var['vat_info']['bank_of_deposit']; ?></td>
            </tr>
            <tr>
              <td class="label"><?php echo $this->_var['lang']['vat_bank_account']; ?>：</td>
              <td><?php echo $this->_var['vat_info']['bank_account']; ?></td>
            </tr>
      	</table>
    </div>

 	<?php echo $this->fetch('library/pagefooter.lbi'); ?>
	<?php echo $this->smarty_insert_scripts(array('files'=>'jquery.purebox.js')); ?>
    
    <?php if ($this->_var['order']['invoice_no']): ?>
	<script type="text/javascript">
        if(document.getElementById("shipping_name")){
            document.getElementById("retData").innerHTML="<center><?php echo $this->_var['lang']['search_logistics_info']; ?></center>";
            var expressid = document.getElementById("shipping_name").innerHTML;
            var expressno = document.getElementById("invoice_no").innerHTML;
            if(expressno != ''){
                expressno = expressno.trim();
                expressno_arr = expressno.split(',');
                expressno = expressno_arr[0];
            }
            Ajax.call('../plugins/kuaidi100/kuaidi100_post.php?com='+ expressid+'&nu=' + expressno,'showtest=showtest', function(data){document.getElementById("retData").innerHTML=data;}, 'GET', 'TEXT');	
        }
    </script>
    <?php endif; ?>

	<script type="text/javascript">
	  /* 门店设置抢单 */
	  function set_grab_order(order_id)
	  {
		$.ajax({
			type:'get',
			url:'order.php',
			data:'is_ajax=1&act=set_grab_order&order_id='+order_id,
			dataType:'json',
			success:function(data){
				pb({
				 id:'goods_dialog',
				 title:'<?php echo $this->_var['lang']['set_grab_order']; ?>',
				 content:data.content,
				 drag:false,
				 foot:false
			  });
			}
		})
	  }
	  //移动到一键发货悬浮展示详情方法调用
	  if($(".step").width() < 1380){
		var left = -420; 
	  }
	  
	  if(document.getElementById('key_delivery')){
		  orderLevitate("one_delivery","order_goods_layer",12.5,left);
	  }
	  
	  $(function(){
		$(document).on("click","#invoice_btn",function(){
			var val = $(this).prev().val();
			if(val != ""){
				$("#operate_form").submit();
			}else{
				$(this).prev().addClass("error");
				return false;
			}
		});
		
		$("*[ectype='orderDialog']").click(function(){
			var content = "",
				title = "",
				type = $(this).data("dialog");
				
			if(type == "userinfo"){
				content = $("#topbar").html();
				title = "<?php echo $this->_var['lang']['consignee_info']; ?>";
			}else{
				content = $("#vat").html();
				title = "<?php echo $this->_var['lang']['vat_info']; ?>";
			}
			
			pb({
				id:"userInfo",
				title:title,
				content:content,
				width:450,
				foot:false
			});
			
			$("#userInfo .topbar_info").perfectScrollbar();
		});
	  });
	  
	  //部分发货 by wu
	  $(document).on('click', "input[name='part_ship']", function(){
		var rec_id = $(this).data('rec_id');
		$.jqueryAjax('order.php', 'act=part_ship&rec_id='+rec_id, function(data){
			pb({
				id:"part_ship_dialog",
				title:"<?php echo $this->_var['lang']['goods_delivery']; ?>",
				width:600,
				content:data.content,
				ok_title:"<?php echo $this->_var['lang']['op_confirm']; ?>",
				cl_title:"<?php echo $this->_var['lang']['cancel']; ?>",
				drag:false,
				foot:true,
				onOk:function(){
					$("form[name='part_ship']").submit();
				}
			});		
		});
	  })
	  //发货
	  $(document).on('click', "input[name='part_to_delivery']", function(){
		var order_sn = $(this).data('order_sn');
		var goods_id = $(this).data('goods_id');
		location.href = 'order.php?act=delivery_list&order_sn='+order_sn+'&goods_id='+goods_id+'&status=2';
	  })
      
      //去退款
      $(document).on('click', "input[name='refound']", function(){
        var ret_id = $(this).data('ret_id');
        var rec_id = $(this).data('rec_id');
        location.href = "order.php?act=return_info&ret_id="+ret_id+"&rec_id="+rec_id;
      })
	  
	  //超值礼包
	  $(".package_goods ul").perfectScrollbar("destroy");
	  $(".package_goods ul").perfectScrollbar();
	</script>
</body>
</html>
