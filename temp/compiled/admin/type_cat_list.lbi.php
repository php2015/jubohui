<div id="parent_id1" class="imitate_select select_w145" ectype="typeCatSelect">
    <div class="cite"><?php echo $this->_var['lang']['please_select']; ?></div>
    <ul>
        <li><a href="javascript:;" data-value="0" data-level='1' class="ftx-01"><?php echo $this->_var['lang']['please_select']; ?></a></li>
        <?php $_from = $this->_var['type_level']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cat');if (count($_from)):
    foreach ($_from AS $this->_var['cat']):
?>
        <li><a href="javascript:;" data-value="<?php echo $this->_var['cat']['cat_id']; ?>" data-level="<?php echo $this->_var['cat']['level']; ?>" class="ftx-01"><?php echo $this->_var['cat']['cat_name']; ?></a></li>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </ul>
    <input type="hidden" value="<?php echo empty($this->_var['cat_tree1']['checked_id']) ? '0' : $this->_var['cat_tree1']['checked_id']; ?>" id="parent_id_val1" ectype="typeCatVal">
</div>
<?php if ($this->_var['cat_tree1']['arr']): ?>
<div id="parent_id2" class="imitate_select select_w145" ectype="typeCatSelect">
    <div class="cite"><?php echo $this->_var['lang']['please_select']; ?></div>
    <ul>
        <li><a href="javascript:;" data-value="0" data-level='2' class="ftx-01"><?php echo $this->_var['lang']['please_select']; ?></a></li>
        <?php $_from = $this->_var['cat_tree1']['arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cat');if (count($_from)):
    foreach ($_from AS $this->_var['cat']):
?>
        <li><a href="javascript:;" data-value="<?php echo $this->_var['cat']['cat_id']; ?>" data-level="<?php echo $this->_var['cat']['level']; ?>" class="ftx-01"><?php echo $this->_var['cat']['cat_name']; ?></a></li>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </ul>
    <input type="hidden" value="<?php echo empty($this->_var['cat_tree']['checked_id']) ? '0' : $this->_var['cat_tree']['checked_id']; ?>" id="parent_id_val2" ectype="typeCatVal">
</div>
<?php endif; ?>
<?php if ($this->_var['cat_tree']['arr']): ?>
<div id="parent_id<?php if ($this->_var['cat_tree1']['arr']): ?>3<?php else: ?>2<?php endif; ?>" class="imitate_select select_w145" ectype="typeCatSelect">
    <div class="cite"><?php echo $this->_var['lang']['please_select']; ?></div>
    <ul>
        <li><a href="javascript:;" data-value="0" data-level='<?php if ($this->_var['cat_tree1']['arr']): ?>3<?php else: ?>2<?php endif; ?>' class="ftx-01"><?php echo $this->_var['lang']['please_select']; ?></a></li>
        <?php $_from = $this->_var['cat_tree']['arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cat');if (count($_from)):
    foreach ($_from AS $this->_var['cat']):
?>
        <li><a href="javascript:;" data-value="<?php echo $this->_var['cat']['cat_id']; ?>" data-level="<?php echo $this->_var['cat']['level']; ?>" class="ftx-01"><?php echo $this->_var['cat']['cat_name']; ?></a></li>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </ul>
    <input type="hidden" value="<?php echo empty($this->_var['type_c_id']) ? '0' : $this->_var['type_c_id']; ?>" id="parent_id_val<?php if ($this->_var['cat_tree1']['arr']): ?>3<?php else: ?>2<?php endif; ?>" ectype="typeCatVal">
</div>
<?php endif; ?>
<input name="attr_parent_id" type="hidden" value="<?php echo empty($this->_var['type_c_id']) ? '0' : $this->_var['type_c_id']; ?>">