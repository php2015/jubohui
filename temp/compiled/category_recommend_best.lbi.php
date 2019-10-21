<?php if ($this->_var['best_goods']): ?>
<div class="goods-spread">
    <a href="javascript:void(0);" class="g-stop" ectype="gstop"><i class="iconfont icon-right"></i></a>
    <div class="gs-warp">
        <div class="gs-tit"><?php echo $this->_var['lang']['tuiguang_goods']; ?></div>
        <ul class="gs-list">
            <?php $_from = $this->_var['best_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');$this->_foreach['best_goods'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['best_goods']['total'] > 0):
    foreach ($_from AS $this->_var['goods']):
        $this->_foreach['best_goods']['iteration']++;
?>
                <li class="opacity_img">
                <div class="">
                        <div class="p-img"><a href="<?php echo $this->_var['goods']['url']; ?>" target="_blank"><img src="<?php echo $this->_var['goods']['thumb']; ?>" width="190" height="190"></a></div>
                        <div class="p-price">
                        <?php if ($this->_var['goods']['promote_price'] != ''): ?>
                            <?php echo $this->_var['goods']['promote_price']; ?>
                        <?php else: ?>
                            <?php echo $this->_var['goods']['shop_price']; ?>
                        <?php endif; ?>
                        </div>
                    <div class="p-name"><a href="<?php echo $this->_var['goods']['url']; ?>" target="_blank" title="<?php echo htmlspecialchars($this->_var['goods']['short_style_name']); ?>"><?php echo $this->_var['goods']['short_style_name']; ?></a></div>
                    <div class="p-num"><?php echo $this->_var['lang']['Sold']; ?><em><?php echo $this->_var['goods']['sales_volume']; ?></em><?php echo $this->_var['lang']['jian']; ?></div>
                </div>
            </li>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </ul>
    </div>
</div>
<?php endif; ?>