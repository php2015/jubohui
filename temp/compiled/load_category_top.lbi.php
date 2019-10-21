
<?php if ($this->_var['tpl'] == 1): ?>
<?php if ($this->_var['one_cate_child']): ?>
<div class="catetop-floor" id="floor_<?php echo $this->_var['rome_number']; ?>" ectype="floorItem">
	<div class="f-hd">
		<h2><?php echo $this->_var['one_cate_child']['name']; ?></h2>
		<h3><?php echo $this->_var['rome_number']; ?>F</h3>
		<div class="extra">
			<div class="fgoods-hd">
				<ul>
					<?php $_from = $this->_var['one_cate_child']['cat_id']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'child_0_30751100_1569574632');$this->_foreach['no'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['no']['total'] > 0):
    foreach ($_from AS $this->_var['child_0_30751100_1569574632']):
        $this->_foreach['no']['iteration']++;
?>
					<?php if ($this->_foreach['no']['iteration'] < 6): ?>
					<li <?php if ($this->_foreach['no']['iteration'] == 1): ?> class="on"<?php endif; ?>><?php echo htmlspecialchars($this->_var['child_0_30751100_1569574632']['name']); ?></li>
					<?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>				
				</ul>
			</div>
		</div>
	</div>
	<div class="f-bd clearfix">
		<div class="bd-left">
			<div class="l-ad"><ul><?php echo $this->_var['cat_top_floor_ad']; ?></ul></div>
		</div>
		<div class="bd-right">
			<div class="right-top clearfix">
				<?php echo $this->_var['cat_top_floor_ad_right']; ?>
			</div>
			<div class="right-bottom">
				<?php $_from = $this->_var['one_cate_child']['cat_id']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'child_0_30751100_1569574632');$this->_foreach['no'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['no']['total'] > 0):
    foreach ($_from AS $this->_var['child_0_30751100_1569574632']):
        $this->_foreach['no']['iteration']++;
?>
				<?php if ($this->_foreach['no']['iteration'] < 6): ?>
				<ul class="fgoods-list">
					<?php $_from = $this->_var['child_0_30751100_1569574632']['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
					<li>
						<div class="p-img"><a href="<?php echo $this->_var['goods']['url']; ?>" target="_blank"><img src="<?php echo $this->_var['goods']['thumb']; ?>" alt=""></a></div>
						<div class="p-name"><a href="<?php echo $this->_var['goods']['url']; ?>" target="_blank" title="<?php echo htmlspecialchars($this->_var['goods']['name']); ?>"><?php echo htmlspecialchars($this->_var['goods']['name']); ?></a></div>
						<div class="p-price"><?php echo $this->_var['goods']['shop_price']; ?></div>
					</li>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				</ul>
				<?php endif; ?>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</div>
		</div>
		<div class="clear"></div>
		<?php if ($this->_var['one_cate_child']['brands']): ?>
		<ul class="brands">
			<?php $_from = $this->_var['one_cate_child']['brands']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'brand');$this->_foreach['b'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['b']['total'] > 0):
    foreach ($_from AS $this->_var['brand']):
        $this->_foreach['b']['iteration']++;
?>
			<?php if ($this->_foreach['b']['iteration'] < 11): ?>
			<li><a href="<?php echo $this->_var['brand']['url']; ?>" target="_blank"><img src="<?php echo $this->_var['brand']['brand_logo']; ?>" alt="<?php echo $this->_var['brand']['brand_name']; ?>"></a></li>
			<?php endif; ?>
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		</ul>
		<?php endif; ?>
	</div>
</div>
<?php endif; ?>
<?php endif; ?>


<?php if ($this->_var['tpl'] == 2): ?>
<?php if ($this->_var['one_cate_child']): ?>
<div class="catetop-floor" id="floor_<?php echo $this->_var['rome_number']; ?>" ectype="floorItem">
    <div class="f-hd">
        <h2><?php echo $this->_var['one_cate_child']['name']; ?></h2>
        <div class="extra">
            <div class="fgoods-hd">
                <ul>
                    <?php $_from = $this->_var['one_cate_child']['cat_id']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'child_0_30951100_1569574632');$this->_foreach['child'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['child']['total'] > 0):
    foreach ($_from AS $this->_var['child_0_30951100_1569574632']):
        $this->_foreach['child']['iteration']++;
?>
                    <?php if (($this->_foreach['child']['iteration'] - 1) < 5): ?>
                    <li<?php if ($this->_foreach['child']['iteration'] == 1): ?> class="on"<?php endif; ?>><?php echo $this->_var['child_0_30951100_1569574632']['name']; ?></li>
                    <?php endif; ?>
                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="f-bd">
        <div class="bd-left">
            <div class="l-ad"><ul><?php echo $this->_var['top_style_elec_left']; ?></ul></div>
            <div class="l-menu">
                <?php $_from = $this->_var['one_cate_child']['cat_id']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'child_0_30951100_1569574632');$this->_foreach['child'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['child']['total'] > 0):
    foreach ($_from AS $this->_var['child_0_30951100_1569574632']):
        $this->_foreach['child']['iteration']++;
?>
                    <?php if (($this->_foreach['child']['iteration'] - 1) < 6): ?>
                    <a href="<?php echo $this->_var['child_0_30951100_1569574632']['url']; ?>" target="_blank"><?php echo $this->_var['child_0_30951100_1569574632']['name']; ?></a>
                    <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            </div>
        </div>
        <div class="bd-right">
            <?php $_from = $this->_var['one_cate_child']['cat_id']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'child_0_31051100_1569574632');$this->_foreach['child'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['child']['total'] > 0):
    foreach ($_from AS $this->_var['child_0_31051100_1569574632']):
        $this->_foreach['child']['iteration']++;
?>
            <?php if (($this->_foreach['child']['iteration'] - 1) < 5): ?>
            <ul class="fgoods-list"<?php if (($this->_foreach['child']['iteration'] <= 1)): ?> style="display:block;"<?php else: ?> style="display:none;"<?php endif; ?>>
                <?php $_from = $this->_var['child_0_31051100_1569574632']['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');$this->_foreach['goods'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['goods']['total'] > 0):
    foreach ($_from AS $this->_var['goods']):
        $this->_foreach['goods']['iteration']++;
?>
                    <?php if ($this->_foreach['goods']['iteration'] == 1): ?>
                        <li class="first">
                            <div class="p-img"><a href="<?php echo $this->_var['goods']['url']; ?>" target="_blank"><img src="<?php echo $this->_var['goods']['thumb']; ?>" alt=""></a></div>
                            <div class="p-info">
                                <div class="info-name"><a href="<?php echo $this->_var['goods']['url']; ?>" target="_blank" title="<?php echo htmlspecialchars($this->_var['goods']['name']); ?>"><?php echo $this->_var['goods']['name']; ?></a></div>
                                <div class="info-handle">
                                    <div class="info-price">
                                        <?php if ($this->_var['goods']['promote_price'] != 0 && $this->_var['goods']['promote_price'] != ''): ?>
                                        <?php echo $this->_var['goods']['promote_price']; ?>
                                        <?php else: ?>
                                        <?php echo $this->_var['goods']['shop_price']; ?>
                                        <?php endif; ?>
                                    </div>
                                    <a href="<?php echo $this->_var['goods']['url']; ?>" class="info-btn" target="_blank"><?php echo $this->_var['lang']['View_details']; ?></a>
                                </div>
                            </div>
                        </li>
                    <?php elseif ($this->_foreach['goods']['iteration'] > 1 && $this->_foreach['goods']['iteration'] < 8): ?>
                        <li <?php if ($this->_foreach['goods']['iteration'] == 1): ?>class="first"<?php endif; ?>>
                            <div class="p-img"><a href="<?php echo $this->_var['goods']['url']; ?>" target="_blank"><img src="<?php echo $this->_var['goods']['thumb']; ?>" alt=""></a></div>
                            <div class="p-name"><a href="<?php echo $this->_var['goods']['url']; ?>" target="_blank" title="<?php echo htmlspecialchars($this->_var['goods']['name']); ?>"><?php echo htmlspecialchars($this->_var['goods']['name']); ?></a></div>
                            <div class="p-price">
                                <?php if ($this->_var['goods']['promote_price'] != 0 && $this->_var['goods']['promote_price'] != ''): ?>
                                <?php echo $this->_var['goods']['promote_price']; ?>
                                <?php else: ?>
                                <?php echo $this->_var['goods']['shop_price']; ?>
                                <?php endif; ?>
                            </div>
                        </li>
                    <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            </ul>
            <?php endif; ?>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>   
        </div>
        <div class="clear"></div>
        <ul class="brands">
            <?php $_from = $this->_var['one_cate_child']['brands']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('kid', 'brand');$this->_foreach['brand'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['brand']['total'] > 0):
    foreach ($_from AS $this->_var['kid'] => $this->_var['brand']):
        $this->_foreach['brand']['iteration']++;
?>
            <?php if (($this->_foreach['brand']['iteration'] - 1) < 8): ?>
                <li><a href="<?php echo $this->_var['brand']['url']; ?>" target="_blank" title="<?php echo $this->_var['brand']['brand_name']; ?>"><img src="<?php echo $this->_var['brand']['brand_logo']; ?>" alt=""></a></li>
            <?php endif; ?>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </ul>
        <div class="f-banner"><?php echo $this->_var['top_style_elec_row']; ?></div>
    </div>
</div>
<?php endif; ?>
<?php endif; ?>


<?php if ($this->_var['tpl'] == 3): ?>
<?php if ($this->_var['one_cate_child']): ?>
<div class="catetop-floor" id="floor_<?php echo $this->_var['rome_number']; ?>" ectype="floorItem">
    <div class="f-hd">
        <h2><?php echo $this->_var['one_cate_child']['name']; ?></h2>
        <div class="extra">
            <div class="fgoods-hd">
                <ul>
                <?php $_from = $this->_var['one_cate_child']['cat_id']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'child_0_31351100_1569574632');$this->_foreach['child'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['child']['total'] > 0):
    foreach ($_from AS $this->_var['child_0_31351100_1569574632']):
        $this->_foreach['child']['iteration']++;
?>
                    <?php if (($this->_foreach['child']['iteration'] - 1) < 5): ?>
                    <li><?php echo $this->_var['child_0_31351100_1569574632']['name']; ?></li>
                    <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="f-bd">
        <div class="bd-left">
            <div class="l-slide">
                <div class="l-bd">
                    <ul>
                        <?php echo $this->_var['top_style_food_left']; ?>
                    </ul>
                </div>
                <div class="l-hd"><ul></ul></div>
            </div>
        </div>
        <div class="bd-right">
        <?php $_from = $this->_var['one_cate_child']['cat_id']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'child_0_31351100_1569574632');$this->_foreach['child'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['child']['total'] > 0):
    foreach ($_from AS $this->_var['child_0_31351100_1569574632']):
        $this->_foreach['child']['iteration']++;
?>
        <?php if (($this->_foreach['child']['iteration'] - 1) < 5): ?>
            <ul class="fgoods-list" <?php if ($this->_foreach['child']['iteration'] > 1): ?> style="display:none;" <?php endif; ?>>
                <?php $_from = $this->_var['child_0_31351100_1569574632']['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');$this->_foreach['goods'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['goods']['total'] > 0):
    foreach ($_from AS $this->_var['goods']):
        $this->_foreach['goods']['iteration']++;
?>
                <?php if ($this->_foreach['goods']['iteration'] > 0 && $this->_foreach['goods']['iteration'] < 7): ?>
                <li>
                    <div class="p-img"><a href="<?php echo $this->_var['goods']['url']; ?>" title="<?php echo htmlspecialchars($this->_var['goods']['name']); ?>" target="_blank"><img src="<?php echo $this->_var['goods']['thumb']; ?>" alt="<?php echo htmlspecialchars($this->_var['goods']['name']); ?>"></a></div>
                    <div class="p-name"><a href="<?php echo $this->_var['goods']['url']; ?>" title="<?php echo htmlspecialchars($this->_var['goods']['name']); ?>" target="_blank"><?php echo htmlspecialchars($this->_var['goods']['name']); ?></a></div>
                    <div class="p-price">
                        <?php if ($this->_var['goods']['promote_price'] != 0 && $this->_var['goods']['promote_price'] != ''): ?>
                        <?php echo $this->_var['goods']['promote_price']; ?>
                        <?php else: ?>
                        <?php echo $this->_var['goods']['shop_price']; ?>
                        <?php endif; ?>
                    </div>
                    <a href="<?php echo $this->_var['goods']['url']; ?>" class="p-btn" target="_blank"><i class="iconfont icon-cart"></i><?php echo $this->_var['lang']['button_buy']; ?></a>
                </li>
                <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            </ul>
        <?php endif; ?>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>  

        </div>
        <div class="clear"></div>
        <ul class="brands">
            <?php $_from = $this->_var['one_cate_child']['brands']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('kid', 'brand');$this->_foreach['brand'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['brand']['total'] > 0):
    foreach ($_from AS $this->_var['kid'] => $this->_var['brand']):
        $this->_foreach['brand']['iteration']++;
?>
            <?php if ($this->_foreach['brand']['iteration'] < 10): ?>
                <li><a href="<?php echo $this->_var['brand']['url']; ?>" target="_blank"><img src="<?php echo $this->_var['brand']['brand_logo']; ?>" alt=""/></a></li>
            <?php endif; ?>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </ul>
        <div class="f-banner"><?php echo $this->_var['top_style_food_row']; ?></div>
    </div>
</div>
<?php endif; ?>
<?php endif; ?>