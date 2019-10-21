
<?php if ($this->_var['see_more_goods']['goods_list']): ?>
<div class="track_warp">
    <div class="track-tit"><h3>看了又看</h3><span></span></div>
    <div class="track-con">
        <ul>
            <?php $_from = $this->_var['see_more_goods']['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');$this->_foreach['goods'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['goods']['total'] > 0):
    foreach ($_from AS $this->_var['goods']):
        $this->_foreach['goods']['iteration']++;
?>
            <li>
                <div class="p-img"><a href="<?php echo $this->_var['goods']['url']; ?>" target="_blank" title="<?php echo htmlspecialchars($this->_var['goods']['goods_name']); ?>"><img src="<?php echo $this->_var['goods']['goods_thumb']; ?>" width="140" height="140"></a></div>
                <div class="p-name"><a href="<?php echo $this->_var['goods']['url']; ?>" target="_blank" title="<?php echo htmlspecialchars($this->_var['goods']['goods_name']); ?>"><?php echo $this->_var['goods']['goods_name']; ?></a></div>
                <div class="price">
                    <?php if ($this->_var['goods']['promote_price'] != ''): ?>
                        <?php echo $this->_var['goods']['promote_price']; ?>
                    <?php else: ?>
                        <?php echo $this->_var['goods']['shop_price']; ?>
                    <?php endif; ?>										
                </div>
            </li>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </ul>
    </div>
    <div class="track-more">
        <a href="javascript:void(0);" class="sprite-up"><i class="iconfont icon-up"></i></a>
        <a href="javascript:void(0);" class="sprite-down"><i class="iconfont icon-down"></i></a>
    </div>
</div>
<?php endif; ?>