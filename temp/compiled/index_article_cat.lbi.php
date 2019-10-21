
    <div class="tit">
        <?php $_from = $this->_var['index_article_cat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'cat');$this->_foreach['cat'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['cat']['total'] > 0):
    foreach ($_from AS $this->_var['key'] => $this->_var['cat']):
        $this->_foreach['cat']['iteration']++;
?>
        <a href="javascript:void(0);" class="tab_head_item<?php if (! ($this->_foreach['cat']['iteration'] <= 1)): ?> <?php endif; ?>"><?php echo $this->_var['cat']['cat']['name']; ?></a>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </div>
    <div class="con">
        <?php $_from = $this->_var['index_article_cat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cat');$this->_foreach['cat'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['cat']['total'] > 0):
    foreach ($_from AS $this->_var['cat']):
        $this->_foreach['cat']['iteration']++;
?>
        <ul <?php if (! ($this->_foreach['cat']['iteration'] <= 1)): ?>style="display:none;"<?php endif; ?>>
            <?php $_from = $this->_var['cat']['arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'article');$this->_foreach['article'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['article']['total'] > 0):
    foreach ($_from AS $this->_var['article']):
        $this->_foreach['article']['iteration']++;
?>
            <li><a href="<?php echo $this->_var['article']['url']; ?>" target="_blank"><?php echo $this->_var['article']['title']; ?></a></li>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </ul>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </div>