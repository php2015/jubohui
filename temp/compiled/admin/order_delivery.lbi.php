<div id="order_goods_layer" style="display:none;">
    <div class="brank_s"></div>
    <div class="delivery_content">
        <div class="items">
            <div class="item">
                <div class="label"><?php echo $this->_var['lang']['label_consignee']; ?></div>
                <div class="value"><?php echo htmlspecialchars($this->_var['order']['consignee']); ?></div>
            </div>
            <div class="item">
                <div class="label"><?php echo $this->_var['lang']['label_mobile']; ?></div>
                <div class="value"><?php if ($this->_var['order']['mobile']): ?><?php echo htmlspecialchars($this->_var['order']['mobile']); ?><?php else: ?><?php echo $this->_var['lang']['wu']; ?><?php endif; ?></div>
            </div>
            <div class="item">
                <div class="label"><?php echo $this->_var['lang']['label_address']; ?></div>
                <div class="value">[<?php echo $this->_var['order']['region']; ?>] <?php echo htmlspecialchars($this->_var['order']['address']); ?></div>
            </div>
            <div class="item">
                <div class="label ftx-02"><em class="require-field">*</em><?php echo $this->_var['lang']['label_post_form_id']; ?></div>
                <div class="value">
                	<input type="text" name="invoice_no" id="invoice_no" class="text mr0" autocomplete="off" />
                    <input type="submit" name="to_shipping" value="<?php echo $this->_var['lang']['deliver_goods']; ?>" class="btn btn25 blue_btn w60 tc" id="invoice_btn">
                </div>
            </div>
        </div>
    </div>
</div>