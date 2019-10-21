<style>    
.mian-info .item .label{width:20%;}  
</style>
<form action="order.php?act=operate_post" method="post" name="part_ship">
<div class="mian-info">
	<div class="switch_info" id="conent_area">
		<div class="item">
			<div class="label"><?php echo $this->_var['lang']['label_goods_name']; ?></div>
			<div class="label_value">
				<?php echo $this->_var['order_goods']['goods_name']; ?>
			</div>
		</div>
		<?php if ($this->_var['order_goods']['goods_attr']): ?>
		<div class="item">
			<div class="label"><?php echo $this->_var['lang']['label_goods_attr']; ?></div>
			<div class="label_value">
				<?php echo $this->_var['order_goods']['goods_attr']; ?>
			</div>
		</div>	
		<?php endif; ?>
		<div class="item">
			<div class="label"><?php echo $this->_var['lang']['label_goods_stock']; ?></div>
			<div class="label_value">
				<?php echo $this->_var['order_goods']['storage']; ?>
			</div>
		</div>		
		<div class="item">
			<div class="label"><?php echo $this->_var['lang']['label_deliver_count']; ?></div>
			<div class="label_value">
				<input type="text" name="send_number[<?php echo $this->_var['order_goods']['rec_id']; ?>]" class="text" value="<?php echo empty($this->_var['order_goods']['left_number']) ? '0' : $this->_var['order_goods']['left_number']; ?>" autocomplete="off" /><div class="notic m20"></div>
			</div>
		</div>
		<!--<div class="item">
			<div class="label">发货单号：</div>
			<div class="label_value">
				<input type="text" name="invoice_no" class="text" value="" autocomplete="off" /><div class="notic m20"></div>
			</div>
		</div>-->
		<div class="item">
			<div class="label"><?php echo $this->_var['lang']['label_operat_remark']; ?></div>
			<div class="label_value">
				<textarea name="action_note" class="textarea"></textarea><div class="notic m20"></div>
			</div>
		</div>
		<!--<input type="hidden" name="act" value="part_ship_operate">
		<input type="hidden" name="rec_id" value="<?php echo $this->_var['order_goods']['rec_id']; ?>">-->
		<input name="suppliers_id" type="hidden" value="0" id="suppliers_id_val">
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
</form>
                             