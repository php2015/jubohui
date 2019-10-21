
<div class="side-menu">
	<dl>
        <dt><i class="square"></i><span><?php echo $this->_var['lang']['oreder_core']; ?></span></dt>
		<dd>
			<p<?php if ($this->_var['action'] == 'order_list' || $this->_var['action'] == 'order_detail' || $this->_var['action'] == 'order_recycle'): ?> class="current"<?php endif; ?>><a href="user.php?act=order_list" target="_self"><?php echo $this->_var['lang']['label_order']; ?></a></p>
			<p<?php if ($this->_var['action'] == 'address_list' || $this->_var['action'] == 'address'): ?> class="current"<?php endif; ?>><a href="user.php?act=address_list" target="_self"><?php echo $this->_var['lang']['label_address']; ?></a></p>
			<p<?php if ($this->_var['action'] == 'booking_list'): ?> class="current"<?php endif; ?>><a href="user.php?act=booking_list" target="_self"><?php echo $this->_var['lang']['label_booking']; ?></a></p>
			<p<?php if ($this->_var['action'] == 'return_list' || $this->_var['action'] == 'return_detail'): ?> class="current"<?php endif; ?>><a href="user.php?act=return_list" target="_self"><?php echo $this->_var['lang']['return_list']; ?></a></p>
		</dd>
    </dl>
    <dl>
        <dt><i class="square"></i><span><?php echo $this->_var['lang']['user_core']; ?></span></dt>
		<dd>
			<p<?php if ($this->_var['action'] == 'profile' || $this->_var['action'] == 'users_log'): ?> class="current"<?php endif; ?>><a href="user.php?act=profile" target="_self"><?php echo $this->_var['lang']['label_profile']; ?></a></p>
			<p<?php if ($this->_var['action'] == 'account_safe'): ?> class="current"<?php endif; ?>><a href="user.php?act=account_safe" target="_self"><?php echo $this->_var['lang']['account_safe']; ?></a></p>
			<p<?php if ($this->_var['action'] == 'account_bind'): ?> class="current"<?php endif; ?>><a href="user.php?act=account_bind" target="_self"><?php echo $this->_var['lang']['account_bind']; ?></a></p>
			<p<?php if ($this->_var['action'] == 'crowdfunding'): ?> class="current"<?php endif; ?>><a href="user.php?act=crowdfunding" target="_self"><?php echo $this->_var['lang']['crowdfunding']; ?></a></p>
			<p<?php if ($this->_var['action'] == 'collection_list' || $this->_var['action'] == 'store_list' || $this->_var['action'] == 'focus_brand'): ?> class="current"<?php endif; ?>><a href="user.php?act=collection_list" target="_self"><?php echo $this->_var['lang']['btn_collect']; ?>/<?php echo $this->_var['lang']['attention']; ?></a></p>
<!--        <p<?php if ($this->_var['action'] == 'focus_brand'): ?> class="current"<?php endif; ?>><a href="user.php?act=focus_brand" target="_self"><?php echo $this->_var['lang']['focus_brand']; ?></a></p>-->
			<p<?php if ($this->_var['action'] == 'message_list'): ?> class="current"<?php endif; ?>><a href="user.php?act=message_list" target="_self"><?php echo $this->_var['lang']['message_list']; ?></a></p>
			<?php if ($this->_var['affiliate']['on'] == 1): ?>
			<p<?php if ($this->_var['action'] == 'affiliate'): ?> class="current"<?php endif; ?>><a href="user.php?act=affiliate" target="_self"><?php echo $this->_var['lang']['affiliate']; ?></a></p>
			<?php endif; ?>
			<p<?php if ($this->_var['action'] == 'comment_list' || $this->_var['action'] == 'commented_view'): ?> class="current"<?php endif; ?>><a href="user.php?act=comment_list" target="_self"><?php echo $this->_var['lang']['comment_list']; ?></a></p>
			<p<?php if ($this->_var['action'] == 'take_list'): ?> class="current"<?php endif; ?>><a href="user.php?act=take_list"> <?php echo $this->_var['lang']['my_take_delivery']; ?></a></p>
			<p<?php if ($this->_var['action'] == 'complaint_list' || $this->_var['action'] == 'complaint_apply'): ?> class="current"<?php endif; ?>><a href="user.php?act=complaint_list"> <?php echo $this->_var['lang']['Trade_complaint']; ?></a></p>
			<p<?php if ($this->_var['action'] == 'invoice' || $this->_var['action'] == 'vat_invoice_info'): ?> class="current"<?php endif; ?>><a href="user.php?act=invoice"> <?php echo $this->_var['lang']['my_invoice']; ?></a></p>
			<?php if ($this->_var['is_illegal'] == 1): ?>
			<p<?php if ($this->_var['action'] == 'illegal_report' || $this->_var['action'] == 'goods_report'): ?> class="current"<?php endif; ?>><a href="user.php?act=illegal_report"> <?php echo $this->_var['lang']['illegal_report']; ?></a></p>
			<?php endif; ?>
        </dd>
	</dl>
    <dl>
        <dt><i class="square"></i><span><?php echo $this->_var['lang']['account_center']; ?></span></dt>
		<dd>
			<p<?php if ($this->_var['action'] == 'bonus'): ?> class="current"<?php endif; ?>><a href="user.php?act=bonus" target="_self"><?php echo $this->_var['lang']['label_bonus']; ?></a></p>
			<?php if ($this->_var['use_value_card'] == 1): ?>
			<p<?php if ($this->_var['action'] == 'value_card'): ?> class="current"<?php endif; ?>><a href="user.php?act=value_card" target="_self"><?php echo $this->_var['lang']['label_value_card']; ?></a></p>
			<?php endif; ?>
			<p<?php if ($this->_var['action'] == 'coupons'): ?> class="current"<?php endif; ?>><a href="user.php?act=coupons" target="_self"><?php echo $this->_var['lang']['label_coupons']; ?></a></p>
			<p<?php if ($this->_var['action'] == 'track_packages'): ?> class="current"<?php endif; ?>><a href="user.php?act=track_packages" target="_self"><?php echo $this->_var['lang']['label_track_packages']; ?></a></p>
			<p<?php if ($this->_var['action'] == 'account_log' || $this->_var['action'] == 'account_detail' || $this->_var['action'] == 'account_raply' || $this->_var['action'] == 'account_deposit' || $this->_var['action'] == 'act_account'): ?> class="current"<?php endif; ?>><a href="user.php?act=account_log" target="_self"><?php echo $this->_var['lang']['account_log']; ?></a></p>
			<p<?php if ($this->_var['action'] == 'baitiao' || $this->_var['action'] == 'repay_bt'): ?> class="current"<?php endif; ?>><a href="user.php?act=baitiao" target="_self"><?php echo $this->_var['lang']['baitiao']; ?></a></p>
        </dd>
    </dl>
	<dl>
        <dt><i class="square"></i><span><?php echo $this->_var['lang']['activity_center']; ?></span></dt>
		<dd>
			<p<?php if ($this->_var['action'] == 'auction_list' || $this->_var['action'] == 'auction' || $this->_var['action'] == 'auction_order_detail'): ?> class="current"<?php endif; ?>><a href="user.php?act=auction_list" target="_self"><?php echo $this->_var['lang']['label_auction']; ?></a></p>
			<p<?php if ($this->_var['action'] == 'snatch_list'): ?> class="current"<?php endif; ?>><a href="user.php?act=snatch_list" target="_self"><?php echo $this->_var['lang']['label_snatch']; ?></a></p>
        </dd>
    </dl>
    <?php if ($this->_var['is_merchants'] > 0): ?>
    <dl>
        <dt><i class="square"></i><span><?php echo $this->_var['lang']['Shop_management']; ?></span></dt>
		<dd>
			<p><a href="./seller" target="_blank"><?php echo $this->_var['lang']['Store_backstage']; ?></a></p>
			<p <?php if ($this->_var['action'] == 'merchants_upgrade' || $this->_var['action'] == 'application_grade'): ?> class="current"<?php endif; ?>><a href="user.php?act=merchants_upgrade" target="_self"><?php echo $this->_var['lang']['seller_Grade']; ?></a></p>
		</dd>
    </dl>
    <?php endif; ?>
	<dl>
        <dt><i class="square"></i><span><?php echo $this->_var['lang']['wholesale_centre']; ?></span></dt>
		<dd>
            <p<?php if ($this->_var['action'] == 'wholesale_buy'): ?> class="current"<?php endif; ?>><a href="user.php?act=wholesale_buy" target="_self"><?php echo $this->_var['lang']['my_purchase_order']; ?></a></p>
            <p<?php if ($this->_var['action'] == 'wholesale_purchase' || $this->_var['action'] == 'purchase_info'): ?> class="current"<?php endif; ?>><a href="user.php?act=wholesale_purchase" target="_self"><?php echo $this->_var['lang']['want_buy_order']; ?></a></p>
        </dd>
</div>