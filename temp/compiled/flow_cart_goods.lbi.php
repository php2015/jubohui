
<div class="ck-goods-list">
    <?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goodsRu');if (count($_from)):
    foreach ($_from AS $this->_var['goodsRu']):
?>
    <div class="ck-goods-item" ectype="shoppingList">
        <div class="ck-goods-tit">
            <div class="ck-store">
            	<?php if ($this->_var['goodsRu']['ru_id'] == 0): ?>
                <a href="javascript:;" class="shop-name"><?php echo $this->_var['goodsRu']['ru_name']; ?></a>
                <?php else: ?>
                <a href="<?php echo $this->_var['goodsRu']['url']; ?>" target="_blank" class="shop-name"><?php echo $this->_var['goodsRu']['ru_name']; ?></a>
                <?php endif; ?>
                
                <?php if ($this->_var['goodsRu']['is_IM'] == 1 || $this->_var['goodsRu']['is_dsc']): ?>
                <a href="javascript:;" id="IM" onclick="openWin(this)" ru_id="<?php echo $this->_var['goodsRu']['ru_id']; ?>" class="p-kefu <?php if ($this->_var['goodsRu']['ru_id'] == 0): ?> p-c-violet<?php endif; ?>" target="_blank"><i class="iconfont icon-kefu"></i></a>
                <?php else: ?>
                <?php if ($this->_var['goodsRu']['kf_type'] == 1): ?>
                <a href="http://www.taobao.com/webww/ww.php?ver=3&touid=<?php echo $this->_var['goodsRu']['kf_ww']; ?>&siteid=cntaobao&status=1&charset=utf-8" class="p-kefu" target="_blank"><i class="iconfont icon-kefu"></i></a>
                <?php else: ?>
                <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $this->_var['goodsRu']['kf_qq']; ?>&site=qq&menu=yes" class="p-kefu" target="_blank"><i class="iconfont icon-kefu"></i></a>
                <?php endif; ?>
                <?php endif; ?>
                
            </div>
            <?php if ($this->_var['goods_flow_type'] == 101): ?>
                <?php if ($this->_var['store_id'] > 0 || $this->_var['store_seller'] == 'store_seller'): ?>
                <div class="ck-dis-modes">
                    <div class="ck-dis-text"><i class="iconfont icon-store-alt"></i><span><?php echo $this->_var['lang']['offline_store_information']; ?></span></div>
                    <div class="ck-dis-warp">
                        <i class="i-box"></i>
                        <?php if ($this->_var['goodsRu']['offline_store'] != ""): ?>
                            <div class="items">
                                <div class="item">
                                    <div class="tit"><?php echo $this->_var['lang']['store_name']; ?>：</div>
                                    <div class="value"><?php echo $this->_var['goodsRu']['offline_store']['stores_name']; ?>(<?php echo $this->_var['goodsRu']['offline_store']['stores_tel']; ?>)</div>
                                </div>
                                <div class="item">
                                    <div class="tit"><?php echo $this->_var['lang']['store_address']; ?>：</div>
                                    <div class="value">
                                        <span class="tipTitle" title="[<?php echo $this->_var['goodsRu']['offline_store']['province']; ?>&nbsp;<?php echo $this->_var['goodsRu']['offline_store']['city']; ?>&nbsp;<?php echo $this->_var['goodsRu']['offline_store']['district']; ?>]&nbsp;<?php echo $this->_var['goodsRu']['offline_store']['stores_address']; ?>">[<?php echo $this->_var['goodsRu']['offline_store']['province']; ?>&nbsp;<?php echo $this->_var['goodsRu']['offline_store']['city']; ?>&nbsp;<?php echo $this->_var['goodsRu']['offline_store']['district']; ?>]&nbsp;<?php echo $this->_var['goodsRu']['offline_store']['stores_address']; ?></span>
                                    </div>
                                </div>
                                <?php if ($this->_var['goodsRu']['offline_store']['stores_img']): ?>
                                <div class="item">
                                    <div class="tit"><?php echo $this->_var['lang']['store_pic']; ?>：</div>
                                    <div class="value"><?php if ($this->_var['goodsRu']['offline_store']['stores_img']): ?><a href="<?php echo $this->_var['goodsRu']['offline_store']['stores_img']; ?>" class="nyroModal ftx-05"><?php echo $this->_var['lang']['view']; ?></a><?php endif; ?></div>
                                </div>
                                <?php endif; ?>
                                <div class="item">
                                    <div class="tit"><?php echo $this->_var['lang']['stores_opening_hours']; ?>：</div>
                                    <div class="value"><?php echo $this->_var['goodsRu']['offline_store']['stores_opening_hours']; ?></div>
                                </div>
                                <div class="item">
                                    <div class="tit"><?php echo $this->_var['lang']['stores_traffic_line']; ?>：</div>
                                    <div class="value">
                                        <span class="tipTitle" title="<?php echo $this->_var['goodsRu']['offline_store']['stores_traffic_line']; ?>"><?php echo $this->_var['goodsRu']['offline_store']['stores_traffic_line']; ?></span>
                                    </div>
                                </div>
                                <input type="hidden" name="ru_id[]" value="<?php echo $this->_var['goodsRu']['ru_id']; ?>" />
                                <input type="hidden" name="ru_name[]" value="<?php echo $this->_var['goodsRu']['ru_name']; ?>" />
                            </div>
                        <?php else: ?>
                            <?php echo $this->_var['lang']['Please_store']; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <?php else: ?>
                <div class="ck-dis-modes">
                	<div class="ck-dis-tit"><?php echo $this->_var['lang']['shipping_method']; ?>：</div>
                    <?php if ($this->_var['goodsRu']['shipping']): ?>
                    <div class="ck-dis-info" ectype="disInfo">
                        <ul class="ck-sp-type">
                        	<?php if ($this->_var['goodsRu']['shipping']): ?>
                            <?php $_from = $this->_var['goodsRu']['shipping']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'shipping');if (count($_from)):
    foreach ($_from AS $this->_var['shipping']):
?>
                            <?php if ($this->_var['shipping']['shipping_code'] != 'cac' && $this->_var['goodsRu']['tmp_shipping_id'] == $this->_var['shipping']['shipping_id']): ?>
                            <li class="mode-tab-item mode-tab-log shopping-list-checked <?php if ($this->_var['goodsRu']['shipping_type'] == 0 && $this->_var['shipping']['default'] == 1): ?>item-selected<?php endif; ?>" ectype="tabLog" data-ruid="<?php echo $this->_var['goodsRu']['ru_id']; ?>" data-type="0" data-shipping="<?php echo $this->_var['shipping']['shipping_id']; ?>" data-shippingcode="<?php echo $this->_var['shipping']['shipping_code']; ?>">
                            <span><?php if ($this->_var['shipping']['shipping_name']): ?><?php echo $this->_var['shipping']['shipping_name']; ?><?php else: ?><?php echo $this->_var['lang']['not_set_shipping']; ?><?php endif; ?></span>
                            </li>
                            <?php endif; ?>
                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                            <?php endif; ?>
                            
                            <?php if ($this->_var['goodsRu']['ru_id'] == 0 && $this->_var['goodsRu']['self_point'] != ""): ?>
                            <li class="mode-tab-item shopping-list-checked <?php if ($this->_var['goodsRu']['shipping_type'] == 1): ?>item-selected<?php endif; ?>" ectype="tabCac" data-ruid="<?php echo $this->_var['goodsRu']['ru_id']; ?>" data-type="1" data-shipping="<?php echo $this->_var['goodsRu']['self_point']['shipping_id']; ?>" data-shippingcode="<?php echo $this->_var['goodsRu']['self_point']['shipping_code']; ?>">
                                <span><?php echo $this->_var['goodsRu']['self_point']['shipping_name']; ?></span>
                            </li>
                            <?php endif; ?>
                        </ul>

                        <div class="mwapper mwapper-logistics" ectype="logistics">
                            <i class="i-box"></i>
                            <div class="mwapper-content">
                                <ul>
                                    <?php if ($this->_var['goodsRu']['shipping']): ?>
                                    <?php $_from = $this->_var['goodsRu']['shipping']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'shipping');if (count($_from)):
    foreach ($_from AS $this->_var['shipping']):
?> 
                                    <?php if ($this->_var['shipping']['shipping_code'] != 'cac'): ?>
                                    <li class="logistics_li <?php if ($this->_var['goodsRu']['tmp_shipping_id'] == $this->_var['shipping']['shipping_id']): ?>item-selected<?php endif; ?>" data-ruid="<?php echo $this->_var['goodsRu']['ru_id']; ?>" data-type="0" data-shipping="<?php echo $this->_var['shipping']['shipping_id']; ?>" data-shippingcode="<?php echo $this->_var['shipping']['shipping_code']; ?>" data-text="<?php echo $this->_var['shipping']['shipping_name']; ?>">
                                        <span><?php if ($this->_var['shipping']['shipping_name']): ?><?php echo $this->_var['shipping']['shipping_name']; ?><?php else: ?><?php echo $this->_var['lang']['not_set_shipping']; ?><?php endif; ?></span>
                                        <?php if ($this->_var['shipping']['shipping_name'] && $this->_var['shipping']['shipping_code'] != 'fpd'): ?><em>（<?php if ($this->_var['shipping']['shipping_fee']): ?><?php echo $this->_var['shipping']['format_shipping_fee']; ?><?php else: ?><?php echo $this->_var['lang']['Free_shipping']; ?><?php endif; ?>）</em><?php endif; ?>
                                    </li>
                                    <?php endif; ?>
                                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>

                        <div class="mwapper mwapper-since" ectype="since">
                            <i class="i-box"></i>
                            <div class="mwapper-content">
                                <?php if ($this->_var['goodsRu']['self_point'] != ""): ?>
                                <div class="mode-list shipping_<?php echo $this->_var['goodsRu']['self_point']['shipping_id']; ?>">
                                    <div class="mode-list-item">
                                        <label class="tit"><?php echo $this->_var['lang']['Place_reference']; ?>：</label>
                                        <span class="value"><?php echo $this->_var['goodsRu']['self_point']['name']; ?></span>
                                        <a href="javascript:void(0);" class="ftx-05" ectype="flow_dialog" data-value='{"mark":0,"width":700,"height":350,"divid":"picksite_box","title":"<?php echo $this->_var['lang']['select_Place_reference']; ?>","url":"flow.php?step=pickSite"}'><?php echo $this->_var['lang']['modify']; ?></a>
                                    </div>
                                    <div class="mode-list-item">
                                      <label class="tit"><?php echo $this->_var['lang']['Self_mentioning_date']; ?>：</label>
                                        <span class="value"><?php echo $this->_var['goodsRu']['self_point']['shipping_dateStr']; ?></span>
                                        <a href="javascript:void(0);" class="ftx-05" ectype="flow_dialog" data-value='{"mark":1,"width":600,"height":250,"divid":"take_their_time","title":"<?php echo $this->_var['lang']['Self_mentioning_date']; ?>","url":"flow.php?step=pickSite&mark=1"}'><?php echo $this->_var['lang']['modify']; ?></a>
                                    </div>
                                    <input type="hidden" name="point_id" value="<?php echo $this->_var['goodsRu']['self_point']['point_id']; ?>">
                                    <input type="hidden" name="shipping_dateStr" value="<?php echo $this->_var['goodsRu']['self_point']['shipping_dateStr']; ?>">
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                    	<?php if (! $this->_var['user_address']): ?>
                        <span class="ftx-01"><?php echo $this->_var['lang']['address_prompt_two']; ?></span>	
                        <?php else: ?>
                        <span class="ftx-01"><?php echo $this->_var['lang']['shiping_prompt']; ?></span>
                        <?php endif; ?>
                    <?php endif; ?>
                    
                    <input type="hidden" name="ru_id[]" value="<?php echo $this->_var['goodsRu']['ru_id']; ?>" />
                    <input type="hidden" name="ru_name[]" value="<?php echo $this->_var['goodsRu']['ru_name']; ?>" />
                    <?php if ($this->_var['goodsRu']['shipping'] && $this->_var['goodsRu']['shipping_type'] == 0): ?>
                    <?php $_from = $this->_var['goodsRu']['shipping']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'shipping');if (count($_from)):
    foreach ($_from AS $this->_var['shipping']):
?>
                    <?php if ($this->_var['goodsRu']['tmp_shipping_id'] == $this->_var['shipping']['shipping_id']): ?>
                    <input type="hidden" name="shipping[]" class="shipping_<?php echo $this->_var['goodsRu']['ru_id']; ?>" data-sellerid="<?php echo $this->_var['goodsRu']['ru_id']; ?>" value="<?php echo empty($this->_var['shipping']['shipping_id']) ? '0' : $this->_var['shipping']['shipping_id']; ?>" autocomplete="off"/>
                    <input type="hidden" name="shipping_code[]" class="shipping_code_<?php echo $this->_var['goodsRu']['ru_id']; ?>" value="<?php echo $this->_var['shipping']['shipping_code']; ?>" autocomplete="off"/>
                    <?php endif; ?>
                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    <?php else: ?>
                    <input type="hidden" name="shipping[]" class="shipping_<?php echo $this->_var['goodsRu']['ru_id']; ?>" data-sellerid="<?php echo $this->_var['goodsRu']['ru_id']; ?>" value="<?php echo empty($this->_var['goodsRu']['self_point']['shipping_id']) ? '0' : $this->_var['goodsRu']['self_point']['shipping_id']; ?>" autocomplete="off"/>
                    <input type="hidden" name="shipping_code[]" class="shipping_code_<?php echo $this->_var['goodsRu']['ru_id']; ?>" value="<?php echo $this->_var['shipping']['shipping_code']; ?>" autocomplete="off"/>
                    <?php endif; ?>
                    <input type="hidden" name="shipping_type[]" class="shipping_type_<?php echo $this->_var['goodsRu']['ru_id']; ?>" value="0" autocomplete="off" />
                </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        <div class="ck-goods-cont">
        <?php $_from = $this->_var['goodsRu']['new_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'activity');$this->_foreach['nogoods'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['nogoods']['total'] > 0):
    foreach ($_from AS $this->_var['key'] => $this->_var['activity']):
        $this->_foreach['nogoods']['iteration']++;
?>
            <?php if ($this->_var['activity']['act_id'] > 0): ?>
            <div class="ck-prom<?php if (($this->_foreach['nogoods']['iteration'] <= 1)): ?> ck-prom-first<?php endif; ?>">
                <div class="ck-prom-header">
                    <div class="f-txt">
                        <span class="full-icon"><i class="i-left"></i><?php echo $this->_var['activity']['act_type_txt']; ?><i class="i-right"></i></span>
                        <?php if ($this->_var['activity']['act_type'] == 0): ?>
                            <?php if ($this->_var['activity']['act_type_ext'] == 0): ?>
                                <?php if ($this->_var['activity']['available']): ?>
                                    <span class="ftx-01"><?php echo $this->_var['lang']['activity_notes_one']; ?><?php echo $this->_var['activity']['min_amount']; ?><?php echo $this->_var['lang']['yuan']; ?> ，<?php echo $this->_var['lang']['receive_gifts']; ?><?php if ($this->_var['activity']['cart_favourable_gift_num'] > 0): ?>，<?php echo $this->_var['lang']['Already_receive']; ?><?php echo $this->_var['activity']['cart_favourable_gift_num']; ?><?php echo $this->_var['lang']['jian']; ?><?php endif; ?></span>
                                <?php else: ?>
                                    <span class="ftx-01"><?php echo $this->_var['lang']['activity_notes_three']; ?><?php echo $this->_var['activity']['min_amount']; ?><?php echo $this->_var['lang']['cart_goods_one']; ?> </span>
                                <?php endif; ?>
                            <?php else: ?>
                                <?php if ($this->_var['activity']['available']): ?>
                                        <span class="ftx-01">
                                            <?php echo $this->_var['lang']['activity_notes_one']; ?><?php echo $this->_var['activity']['min_amount']; ?><?php echo $this->_var['lang']['yuan']; ?>，<?php if ($this->_var['activity']['cart_favourable_gift_num'] > 0): ?><?php echo $this->_var['lang']['cart_goods_two']; ?><?php else: ?><?php echo $this->_var['lang']['cart_goods_three']; ?><?php endif; ?>
                                        </span>
                                <?php else: ?>
                                    <span class="ftx-01"><?php echo $this->_var['lang']['activity_notes_three']; ?><?php echo $this->_var['activity']['min_amount']; ?><?php echo $this->_var['lang']['cart_goods_one']; ?></span>
                                <?php endif; ?>
                            <?php endif; ?>

                        <?php elseif ($this->_var['activity']['act_type'] == 1): ?>

                            <?php if ($this->_var['activity']['available']): ?>
                                <span class="ftx-01"><?php echo $this->_var['lang']['activity_notes_one']; ?><?php echo $this->_var['activity']['min_amount']; ?><?php echo $this->_var['lang']['yuan']; ?> ,<?php echo $this->_var['lang']['been_reduced']; ?><?php echo $this->_var['activity']['act_type_ext_format']; ?><?php echo $this->_var['lang']['cart_goods_four']; ?></span>
                            <?php else: ?>
                                <span class="ftx-01"><?php echo $this->_var['lang']['activity_notes_three']; ?><?php echo $this->_var['activity']['min_amount']; ?><?php echo $this->_var['lang']['cart_goods_five']; ?></span>
                            <?php endif; ?>

                        <?php elseif ($this->_var['activity']['act_type'] == 2): ?>
                            <?php if ($this->_var['activity']['available']): ?>
                                <span class="ftx-01"><?php echo $this->_var['lang']['activity_notes_one']; ?><?php echo $this->_var['activity']['min_amount']; ?><?php echo $this->_var['lang']['yuan']; ?> ，<?php echo $this->_var['lang']['Already_enjoy']; ?><?php echo $this->_var['activity']['act_type_ext_format']; ?><?php echo $this->_var['lang']['percent_off_Discount']; ?></span>
                            <?php else: ?>
                                <span class="ftx-01"><?php echo $this->_var['lang']['activity_notes_three']; ?><?php echo $this->_var['activity']['min_amount']; ?><?php echo $this->_var['lang']['zhekouxianzhi']; ?></span>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
                
                <?php $_from = $this->_var['activity']['act_goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');$this->_foreach['act_goods'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['act_goods']['total'] > 0):
    foreach ($_from AS $this->_var['goods']):
        $this->_foreach['act_goods']['iteration']++;
?>
                <div class="cg-item<?php if (($this->_foreach['act_goods']['iteration'] <= 1)): ?> first<?php endif; ?>">
                    <div class="c-col cg-name">
                    	<?php if ($this->_var['goods']['extension_code'] == ''): ?>
                    	<input name="cart_info[]" type="hidden" value="<?php echo $this->_var['goods']['ru_id']; ?>|<?php echo $this->_var['goods']['rec_id']; ?>_<?php echo $this->_var['goods']['goods_id']; ?>_<?php echo $this->_var['goods']['freight']; ?>_<?php echo $this->_var['goods']['tid']; ?>">
                        <?php endif; ?>
                        <a href="<?php echo $this->_var['goods']['url']; ?>" target="_blank">
                            <div class="p-img"><img src="<?php echo $this->_var['goods']['goods_thumb']; ?>" width="48" height="48"></div>
                            <div class="p-info">
                                <div class="p-name"><?php echo $this->_var['goods']['goods_name']; ?></div>
                                <div class="p-attr"><?php echo nl2br($this->_var['goods']['goods_attr_text']); ?></div>
                            </div>
                        </a>
                    </div>
                    
                    <div class="c-col cg-price">
                        <span class="fr cl"><?php if ($this->_var['goods']['rec_type'] == 5): ?><?php echo $this->_var['lang']['Deposit_flow']; ?>：<?php echo $this->_var['goods']['formated_presale_deposit']; ?><?php else: ?><?php echo $this->_var['goods']['formated_goods_price']; ?><?php endif; ?></span>
                        <?php if ($this->_var['goods']['dis_amount'] > 0): ?>
                        <span class="original-price fr cl"><?php echo $this->_var['lang']['Original_price']; ?>:￥<?php echo $this->_var['goods']['original_price']; ?></span>
                        <span class="ftx-01 fr cl fs12">(<?php echo $this->_var['lang']['Discount_flow']; ?>：<?php echo $this->_var['goods']['discount_amount']; ?>)</span>
                        <?php endif; ?>
                    </div>
                    <div class="c-col cg-number">x<?php echo $this->_var['goods']['goods_number']; ?></div>
                    <div class="c-col cg-state">
                        <span class="">
                            <?php if ($this->_var['goods']['attr_number']): ?>
                                <?php echo $this->_var['lang']['Have_goods']; ?>
                                <input name="rec_number" type="hidden" data-id="<?php echo $this->_var['goods']['rec_id']; ?>" value="0">
                            <?php else: ?>
                                <font style="color:#e4393c"><?php echo $this->_var['lang']['No_goods']; ?></font>
                                <input name="rec_number" type="hidden" data-id="<?php echo $this->_var['goods']['rec_id']; ?>" value="1">
                            <?php endif; ?>
                            
                            
                            <input name="shipping_prompt" type="hidden" data-id="<?php echo $this->_var['goods']['rec_id']; ?>" value="<?php if ($this->_var['goodsRu']['shipping'] || ! $this->_var['goods']['is_real']): ?><?php if ($this->_var['goods']['rec_shipping'] == 1): ?>0<?php else: ?>1<?php endif; ?><?php else: ?>1<?php endif; ?>">
                        </span>
                    </div>
                    <div class="c-col cg-sum"><?php echo $this->_var['goods']['formated_subtotal']; ?></div>
                    <?php if ($this->_var['activity']['act_goods_list_num'] > 1): ?><div class="kuan"></div><?php endif; ?>
                </div>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                
                <?php $_from = $this->_var['activity']['act_cart_gift']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
                <div class="cg-item">
                    <div class="c-col cg-name">
                        <a href="<?php echo $this->_var['goods']['url']; ?>" target="_blank">
                            <div class="p-img"><img src="<?php echo $this->_var['goods']['goods_thumb']; ?>" width="48" height="48"></div>
                            <div class="p-info">
                                <div class="p-name"><i class="i-zp"><?php echo $this->_var['lang']['largess']; ?></i><?php echo $this->_var['goods']['goods_name']; ?></div>
                                <div class="p-attr"><?php echo nl2br($this->_var['goods']['goods_attr_text']); ?></div>
                            </div>
                        </a>
                    </div>
                    <div class="c-col cg-price">
                        <span class="fr cl"><?php if ($this->_var['goods']['rec_type'] == 5): ?><?php echo $this->_var['lang']['Deposit_flow']; ?>：<?php echo $this->_var['goods']['formated_presale_deposit']; ?><?php else: ?><?php echo $this->_var['goods']['formated_goods_price']; ?><?php endif; ?></span>
                        <?php if ($this->_var['goods']['dis_amount'] > 0): ?>
                        <span class="original-price fr cl"><?php echo $this->_var['lang']['Original_price']; ?>:￥<?php echo $this->_var['goods']['original_price']; ?></span>
                        <span class="ftx-01 fr cl fs12">(<?php echo $this->_var['lang']['Discount_flow']; ?>：<?php echo $this->_var['goods']['discount_amount']; ?>)</span>
                        <?php endif; ?>
                    </div>
                    <div class="c-col cg-number">x<?php echo $this->_var['goods']['goods_number']; ?></div>
                    <div class="c-col cg-state">
                        <span>
                            <?php if ($this->_var['goods']['attr_number']): ?>
                                <?php echo $this->_var['lang']['Have_goods']; ?>
                                <input name="rec_number" type="hidden" data-id="<?php echo $this->_var['goods']['rec_id']; ?>" value="0">
                            <?php else: ?>
                                <font style="color:#e4393c"><?php echo $this->_var['lang']['No_goods']; ?></font>
                                <input name="rec_number" type="hidden" data-id="<?php echo $this->_var['goods']['rec_id']; ?>" value="1">
                            <?php endif; ?>
                            
							
                            <input name="shipping_prompt" type="hidden" data-id="<?php echo $this->_var['goods']['rec_id']; ?>" value="<?php if ($this->_var['goodsRu']['shipping'] || ! $this->_var['goods']['is_real']): ?><?php if ($this->_var['goods']['rec_shipping'] == 1): ?>0<?php else: ?>1<?php endif; ?><?php else: ?>1<?php endif; ?>">
                        </span>
                    </div>
                    <div class="c-col cg-sum"><?php echo $this->_var['goods']['formated_subtotal']; ?></div>
                    <?php if ($this->_var['activity']['act_goods_list_num'] > 2): ?><div class="kuan"></div><?php endif; ?>
                </div> 
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            </div>    
            <?php else: ?>
            <?php $_from = $this->_var['activity']['act_goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');$this->_foreach['goods_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['goods_list']['total'] > 0):
    foreach ($_from AS $this->_var['goods']):
        $this->_foreach['goods_list']['iteration']++;
?>
            <div class="cg-item<?php if (($this->_foreach['goods_list']['iteration'] == $this->_foreach['goods_list']['total'])): ?> last<?php endif; ?>">
                <div class="c-col cg-name">
                	<?php if ($this->_var['goods']['extension_code'] == ''): ?>
                    	<input name="cart_info[]" type="hidden" value="<?php echo $this->_var['goods']['ru_id']; ?>|<?php echo $this->_var['goods']['rec_id']; ?>_<?php echo $this->_var['goods']['goods_id']; ?>_<?php echo $this->_var['goods']['freight']; ?>_<?php echo $this->_var['goods']['tid']; ?>">
                    <?php endif; ?>
                	<?php if ($this->_var['goods']['goods_id'] > 0 && $this->_var['goods']['extension_code'] == 'package_buy'): ?>
                    <div class="p-img"><img src="themes/ecmoban_dsc2017/images/17184624079016pa.jpg" width="48" height="48"></div>
                    <div class="p-info">
                        <div class="p-name package-name"><?php echo $this->_var['goods']['goods_name']; ?><span class="red">（<?php echo $this->_var['lang']['remark_package']; ?>）</span></div>
                        <div class="package_goods" id="suit_<?php echo $this->_var['goods']['goods_id']; ?>">
                            <div class="title"><?php echo $this->_var['lang']['contain_content']; ?>：</div>
                            <ul>
                                <?php $_from = $this->_var['goods']['package_goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'package_goods_list');$this->_foreach['nopackage'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['nopackage']['total'] > 0):
    foreach ($_from AS $this->_var['package_goods_list']):
        $this->_foreach['nopackage']['iteration']++;
?>
                                <li>
                                    <div class="goodsName"><a href="goods.php?id=<?php echo $this->_var['package_goods_list']['goods_id']; ?>" target="_blank"><?php echo $this->_var['package_goods_list']['goods_name']; ?></a></div>
                                    <div class="goodsNumber">x<?php echo $this->_var['package_goods_list']['goods_number']; ?></div>
                                </li>
                                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                            </ul>
                        </div>
                    </div>
                    <?php else: ?>
                    <a href="<?php if ($this->_var['order']['extension_code'] == 'seckill'): ?>seckill.php?id=<?php echo $this->_var['seckill_id']; ?>&act=view<?php else: ?><?php echo $this->_var['goods']['url']; ?><?php endif; ?>" target="_blank">
                        <div class="p-img"><img src="<?php echo $this->_var['goods']['goods_thumb']; ?>" width="48" height="48"></div>
                        <div class="p-info">
                            <div class="p-name"><?php echo $this->_var['goods']['goods_name']; ?></div>
                            <div class="p-attr"><?php echo nl2br($this->_var['goods']['goods_attr']); ?></div>
                        </div>
                    </a>
                    <?php endif; ?>
                </div>
                <div class="c-col cg-price">
                    <span class="fr cl"><?php if ($this->_var['goods']['rec_type'] == 5): ?><?php echo $this->_var['lang']['Deposit_flow']; ?>：<?php echo $this->_var['goods']['formated_presale_deposit']; ?><?php else: ?><?php echo $this->_var['goods']['formated_goods_price']; ?><?php endif; ?></span>
                    <?php if ($this->_var['goods']['dis_amount'] > 0): ?>
                    <span class="ftx-01 fr cl fs12">(<?php echo $this->_var['lang']['Discount_flow']; ?>：<?php echo $this->_var['goods']['discount_amount']; ?>)</span>
                    <?php endif; ?>
                </div>
                <div class="c-col cg-number">x<?php echo $this->_var['goods']['goods_number']; ?></div>
                <div class="c-col cg-state">
                    <span>
                        <?php if ($this->_var['goods']['attr_number']): ?>
                            <?php echo $this->_var['lang']['Have_goods']; ?>
                            <input name="rec_number" type="hidden" data-id="<?php echo $this->_var['goods']['rec_id']; ?>" value="0">
                        <?php else: ?>
                            <font style="color:#e4393c"><?php echo $this->_var['lang']['No_goods']; ?></font>
                            <input name="rec_number" type="hidden" data-id="<?php echo $this->_var['goods']['rec_id']; ?>" value="1">
                        <?php endif; ?>

                        
                        <input name="shipping_prompt" type="hidden" data-id="<?php echo $this->_var['goods']['rec_id']; ?>" value="<?php if ($this->_var['goodsRu']['shipping'] || ! $this->_var['goods']['is_real']): ?><?php if ($this->_var['goods']['rec_shipping'] == 1): ?>0<?php else: ?>1<?php endif; ?><?php else: ?>1<?php endif; ?>">
                    </span>
                </div>
                <div class="c-col cg-sum"><?php echo $this->_var['goods']['formated_subtotal']; ?></div>
                <div class="cg-item-line"></div>
                <i class="dian"></i>
            </div>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            <?php endif; ?>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </div>
    </div>
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
</div>
    