<?php if ($this->_var['shippingFee']['is_shipping'] == 1): ?>
<?php if ($this->_var['shippingFee']['shipping_fee'] > 0): ?>
<span class="gary" ectype="freight_info_span">[ <?php echo $this->_var['lang']['express']; ?>：<?php echo $this->_var['shippingFee']['shipping_fee_formated']; ?> ]&nbsp;&nbsp;<?php if ($this->_var['shippingFee']['shipping_title']): ?><?php echo $this->_var['shippingFee']['shipping_title']; ?><?php endif; ?></span>
<?php else: ?>
	<?php if ($this->_var['is_shipping'] == 1): ?>
    <span class="gary" ectype="freight_info_span">[ <?php echo $this->_var['lang']['Free_shipping']; ?> ]</span>
    <?php else: ?>
    	<?php if ($this->_var['shippingFee']['shipping_code'] == 'fpd'): ?>
            <?php if ($this->_var['shippingFee']['shipping_title']): ?><?php echo $this->_var['shippingFee']['shipping_title']; ?><?php endif; ?>
        <?php else: ?>
            <span class="gary" ectype="freight_info_span">[ <?php echo $this->_var['lang']['free_freight']; ?> ]</span>
        <?php endif; ?>
	<?php endif; ?>
<?php endif; ?>
<?php endif; ?>
<input name="is_shipping" id="is_shipping" type="hidden" value="<?php echo empty($this->_var['shippingFee']['is_shipping']) ? '0' : $this->_var['shippingFee']['is_shipping']; ?>">