
<div class="ftit"><h3><?php echo $this->_var['lang']['guess_love']; ?></h3></div>
<ul>
    <?php $_from = $this->_var['guess_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');$this->_foreach['guess_goods'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['guess_goods']['total'] > 0):
    foreach ($_from AS $this->_var['goods']):
        $this->_foreach['guess_goods']['iteration']++;
?>
    <?php if ($this->_foreach['guess_goods']['iteration'] < 6): ?>
    <li>
        <div class="p-img"><a href="<?php echo $this->_var['goods']['url']; ?>" target="_blank"><img src="<?php echo $this->_var['goods']['goods_thumb']; ?>" width="134" height="134"></a></div>
        <div class="p-name"><a href="<?php echo $this->_var['goods']['url']; ?>" target="_blank" title="<?php echo htmlspecialchars($this->_var['goods']['short_name']); ?>"><?php echo $this->_var['goods']['short_name']; ?></a></div>
        <div class="p-price"><?php echo $this->_var['goods']['shop_price']; ?></div>
    </li>
    <?php endif; ?>
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
</ul>