<div class="g-main g-store-info" ectype="gm-tabs">
	<div class="mt">
		<h3><?php echo $this->_var['goods']['rz_shopName']; ?></h3>
		<?php if ($this->_var['shop_information']['is_IM'] == 1 || $this->_var['shop_information']['is_dsc']): ?>
			<a id="IM" onclick="openWin(this)" href="javascript:;" ru_id="<?php echo $this->_var['goods']['user_id']; ?>" goods_id="<?php echo $this->_var['goods']['goods_id']; ?>" class="s-a-kefu"><i class="icon i-kefu"></i></a>
		<?php else: ?>
			<?php if ($this->_var['basic_info']['kf_type'] == 1): ?>
			<a href="http://www.taobao.com/webww/ww.php?ver=3&touid=<?php echo $this->_var['basic_info']['kf_ww']; ?>&siteid=cntaobao&status=1&charset=utf-8" class="s-a-kefu" target="_blank"><i class="icon i-kefu"></i></a>
			<?php else: ?>
			<a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $this->_var['basic_info']['kf_qq']; ?>&site=qq&menu=yes" class="s-a-kefu" target="_blank"><i class="icon i-kefu"></i></a>
			<?php endif; ?>
		<?php endif; ?>
	</div>
	<div class="mc">
		<div class="mc-warp">
			<div class="g-s-brand">
				<?php if ($this->_var['goods']['user_id']): ?>
					<?php if ($this->_var['goods']['shopinfo']['brand_thumb']): ?>
					<a href="<?php echo $this->_var['goods']['store_url']; ?>" target="_blank"><img src="<?php echo $this->_var['goods']['shopinfo']['brand_thumb']; ?>" /></a>
					<?php else: ?>
					<a href="<?php echo $this->_var['goods']['goods_brand_url']; ?>" target="_blank"><?php echo $this->_var['goods']['goods_brand']; ?></a>
					<?php endif; ?>
				<?php else: ?>
					<?php if ($this->_var['goods']['brand']['brand_logo']): ?>
					<a href="<?php echo $this->_var['goods']['brand']['url']; ?>" target="_blank"><img src="<?php echo $this->_var['goods']['brand']['brand_logo']; ?>" /></a>
					<?php else: ?>
					<a href="<?php echo $this->_var['goods']['goods_brand_url']; ?>" target="_blank"><?php echo $this->_var['goods']['goods_brand']; ?></a>
					<?php endif; ?>
				<?php endif; ?>
			</div>
		</div>
		<?php if ($this->_var['filename'] != 'group_buy' && $this->_var['filename'] != 'seckill'): ?>
		<?php if ($this->_var['goods']['user_id']): ?>
		<div class="mc-warp b-t-gary">
			<div class="s-search">
				<form action="merchants_store.php" method="get">
				<p class="sp-form-item1"><input type="text" name="keyword" class="text" id="sp-keyword" value="" placeholder="<?php echo $this->_var['lang']['keywords']; ?>"></p>
				<p class="sp-form-item2"><input type="text" id="sp-price" name="price_min" class="text" value="" placeholder="<?php echo $this->_var['lang']['price']; ?>"><span>~</span><input type="text" name="price_max" class="text" id="sp-price1" value="" placeholder="<?php echo $this->_var['lang']['price']; ?>"></p>
				<p class="sp-form-item3"><input type="submit" value="<?php echo $this->_var['lang']['seller_search']; ?>" class="search-btn" id="btnShopSearch"></p>
				<input type="hidden" name="merchant_id" value="<?php echo $this->_var['goods']['user_id']; ?>">
				</form>
			</div>
		</div>
		<?php endif; ?>
		<?php endif; ?>
	</div>
</div>

