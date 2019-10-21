<?php if ($this->_var['ad_child']): ?>
<div class="cate-ad">
<?php $_from = $this->_var['ad_child']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'ad');$this->_foreach['noad'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['noad']['total'] > 0):
    foreach ($_from AS $this->_var['ad']):
        $this->_foreach['noad']['iteration']++;
?>
    <a href="<?php echo $this->_var['ad']['ad_link']; ?>" target="_blank"><img src="<?php echo $this->_var['ad']['ad_code']; ?>" alt=""></a>
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
</div>
<?php endif; ?>
