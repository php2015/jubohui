<?php if ($this->_var['script_name'] == 0): ?>
<div class="title">
    <h3><?php echo $this->_var['lang']['Prompt']; ?></h3>
	<a onclick="$('.ecsc-cart-popup').css({'display':'none'});" title="关闭" class="loading-x">X</a>
</div>
<div class="center_pop_p">
	<div class="ts"><?php echo $this->_var['lang']['successfully_added_shoping']; ?></div>
    <div class="desc">
        <span><?php echo $this->_var['lang']['cart_count']; ?></span>
        <strong>(<?php echo $this->_var['goods_number']; ?><?php echo $this->_var['lang']['jain']; ?>)</strong>
        <span><?php echo $this->_var['lang']['Baby_total_amount']; ?>：</span>
        <em class="saleP">￥<?php echo $this->_var['goods_amount']; ?></em>
    </div>
</div>
<?php elseif ($this->_var['script_name'] == 1): ?>
<a class="success_close" href="javascript:void(0);" onClick="close_div(<?php echo $this->_var['goods_id']; ?>,'<?php echo $this->_var['goods_recommend']; ?>')"></a><p class="addSucess_tip"><?php echo $this->_var['lang']['cart_baby_success']; ?></p><p class="cart_num"><?php echo $this->_var['lang']['cart_count']; ?><?php echo $this->_var['real_goods_count']; ?><?php echo $this->_var['lang']['zhong_boby']; ?>(<?php echo $this->_var['goods_number']; ?><?php echo $this->_var['lang']['jian']; ?>)</p><p class="cart_price"><?php echo $this->_var['lang']['total_cart']; ?>：<span class="cart_priceNum">￥<?php echo $this->_var['goods_amount']; ?><?php echo $this->_var['lang']['yuan']; ?></span></p><a class="cart_account" href="./flow.php"><?php echo $this->_var['lang']['pay_to_cart']; ?></a>
<?php endif; ?>