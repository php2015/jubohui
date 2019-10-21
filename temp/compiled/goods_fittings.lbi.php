

<?php if ($this->_var['fittings']): ?>
<div class="combo-inner">
	<ul class="tab-nav">
    	<?php $_from = $this->_var['fittings_tab_index']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'tab_item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['tab_item']):
?> 
        <?php if ($this->_var['key'] == 1): ?>
        <li class="curr"><?php echo $this->_var['comboTab'][$this->_var['key']]; ?></li>
        <?php else: ?>
        <li><?php echo $this->_var['comboTab'][$this->_var['key']]; ?></li>
        <?php endif; ?> 
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
	</ul>
	<div class="tab-content">
		<?php $_from = $this->_var['fittings_tab_index']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'tab_item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['tab_item']):
?>
		<form name="m_goods_<?php echo $this->_var['key']; ?>" method="post" action="" onSubmit="return false;"<?php if ($this->_var['key'] > 1): ?> style="display:none;"<?php endif; ?>>
            <div class="tab-content-warp">
                <div class="master">
                    <div class="p-img"><img src="<?php echo $this->_var['goods']['goods_thumb']; ?>" width="160" height="160"></div>
                    <div class="p-name"><?php echo $this->_var['goods']['goods_name']; ?></div>
                    <div class="p-oper">
                        <div class="dsc-enable">
                            <input type="hidden" name="stock" value="<?php echo $this->_var['goods']['group_number']; ?>" />
                            <input type="checkbox" class="ui-all-checkbox" id="primary_goods" checked="checked" disabled="disabled" />
                            <label class="ui-all-label" for="primary_goods"></label>
                        </div>
                        <div class="p-price ECS_fittings_interval"></div>
                    </div>
                </div>
                <div class="combo-spliter"><i class="iconfont icon-plus"></i></div>
                <div class="combo-items">
                    <div class="combo-items-warp">
                        <ul>
                            <?php $_from = $this->_var['fittings']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('k', 'goods_list');$this->_foreach['no'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['no']['total'] > 0):
    foreach ($_from AS $this->_var['k'] => $this->_var['goods_list']):
        $this->_foreach['no']['iteration']++;
?>
                            <?php if ($this->_var['goods_list']['group_id'] == $this->_var['key']): ?>
                            <li class="combo-item" id="<?php echo $this->_var['goods_list']['goods_id']; ?>_<?php echo $this->_var['key']; ?>">
                                <div class="p-img"><a href="<?php echo $this->_var['goods_list']['url']; ?>" target="_blank"><img src="<?php echo $this->_var['goods_list']['goods_thumb']; ?>" width="160" height="160"></a></div>
                                <div class="p-name"><a href="<?php echo $this->_var['goods_list']['url']; ?>" target="_blank" title="<?php echo htmlspecialchars($this->_var['goods_list']['goods_name']); ?>"><?php echo sub_str($this->_var['goods_list']['goods_name'],12); ?></a></div>
                                <div class="p-oper">
                                    <div class="dsc-enable" ectype="enable">
                                        <input type="checkbox" item="m_goods_<?php echo $this->_var['key']; ?>" class="ui-all-checkbox m_goods_list m_goods_<?php echo $this->_var['key']; ?> m_goods_list_m_goods_<?php echo $this->_var['key']; ?>_<?php echo $this->_var['goods_list']['goods_id']; ?>" ectype="checkbox" id="goods_<?php echo $this->_var['k']; ?>" value="<?php echo $this->_var['goods_list']['goods_id']; ?>" item="m_goods_<?php echo $this->_var['key']; ?>" data="<?php echo $this->_var['goods_list']['fittings_price_ori']; ?>" spare="<?php echo $this->_var['goods_list']['spare_price_ori']; ?>" stock="<?php echo $this->_var['goods']['group_number']; ?>" name="goods_list_<?php echo $this->_var['goods_list']['goods_id']; ?>_<?php echo $this->_var['key']; ?>" />
                                        <label class="ui-all-label" for="goods_<?php echo $this->_var['k']; ?>" rev="<?php echo $this->_var['goods_list']['goods_id']; ?>"></label>
                                    </div>
                                    <div class="p-price">￥<?php echo $this->_var['goods_list']['fittings_price_ori']; ?></div>
                                </div>
                            </li>						
                            <?php endif; ?>
                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                        </ul>
                    </div>
                    <div class="oper">
                        <a href="javascript:void(0);" class="o-prev"><i class="iconfont icon-left"></i></a>
                        <a href="javascript:void(0);" class="o-next"><i class="iconfont icon-right"></i></a>
                    </div>
                </div>
                <div class="combo-action">
                    <div class="combo-action-info">
                        <div class="combo-price"><span><?php echo $this->_var['lang']['Set_price']; ?>：</span><strong id="m_goods_<?php echo $this->_var['key']; ?>" name="combo_shopPrice[]"></strong></div>
                        <div class="combo-o-price"><span><?php echo $this->_var['lang']['combo_markPrice']; ?>：</span><span class="original-price" name="combo_markPrice[]" id="m_goods_reference_<?php echo $this->_var['key']; ?>"></span></div>
                        <div class="save-price"><?php echo $this->_var['lang']['collocation_shen']; ?> <span id="m_goods_save_<?php echo $this->_var['key']; ?>" name="combo_savePrice[]"></span></div>
                    </div>
                    <div class="input_combo_stock">
                        <?php if ($this->_var['goods']['group_number'] > 0): ?><div id="combo_stock_number" class="gns_item"><?php echo $this->_var['lang']['limit_shop']; ?>：<font id="stock_number"><?php echo $this->_var['goods']['group_number']; ?></font> <?php echo $this->_var['lang']['tao']; ?></div><?php endif; ?>
                        <div class="gns_item">
                            <span><?php echo $this->_var['lang']['btn_buy']; ?>：</span>
                            <input type="text" class="combo_stock" name="m_goods_<?php echo $this->_var['key']; ?>_number" id="mGoods_number" value="1" size="1" />
                            <span><?php echo $this->_var['lang']['tao']; ?></span>
                        </div>
                    </div>
                    <div class="combo-btn">
                        <a href="javascript:void(0);" rev='m_goods_<?php echo $this->_var['key']; ?>_<?php echo $this->_var['goods_id']; ?>_<?php echo $this->_var['region_id']; ?>_<?php echo $this->_var['area_id']; ?>' class="combo-btn-buynow ncs_buy" ectype="comboBuy"><?php echo $this->_var['lang']['button_buy']; ?></a>
                    </div>
                </div>
            </div>
		</form>
		<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
	</div>
</div>
<?php endif; ?> 
