
<?php if ($this->_var['hot_goods']): ?>
<div class="hot-sales">
    <div class="hotsale w1390 w">
        <div class="hatsale-mt"><?php echo $this->_var['lang']['Popular_recommendation']; ?></div>
        <div class="bd">
            <ul>
            	<?php $_from = $this->_var['hot_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');$this->_foreach['hot_goods'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['hot_goods']['total'] > 0):
    foreach ($_from AS $this->_var['goods']):
        $this->_foreach['hot_goods']['iteration']++;
?>
                <?php if ($this->_foreach['hot_goods']['iteration'] < 5): ?>
                <li<?php if ($this->_foreach['hot_goods']['iteration'] == 4): ?> class="last"<?php endif; ?>>
                    <div class="item">
                        <div class="p-img"><a href="<?php echo $this->_var['goods']['url']; ?>" target="_blank"><img src="<?php echo $this->_var['goods']['thumb']; ?>" /></a></div>
                        <div class="p-name"><a href="<?php echo $this->_var['goods']['url']; ?>" title="<?php echo htmlspecialchars($this->_var['goods']['short_style_name']); ?>" target="_blank"><?php echo $this->_var['goods']['short_style_name']; ?></a></div>
                        <div class="p-price">
                        	<?php if ($this->_var['goods']['promote_price'] != ''): ?>
                                <?php echo $this->_var['goods']['promote_price']; ?>
                            <?php else: ?>
                                <?php echo $this->_var['goods']['shop_price']; ?>
                            <?php endif; ?>
                        </div>
                        <div class="p-btn"><a class="btn sc-redBg-btn" href="<?php echo $this->_var['goods']['url']; ?>"><?php echo $this->_var['lang']['button_buy']; ?></a></div>
                    </div>
                </li>
                <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            </ul>
            <a href="javascript:void(0);" class="prev"></a>
            <a href="javascript:void(0);" class="next"></a>
        </div>
    </div>
</div>
<?php endif; ?>