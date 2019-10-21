<?php if ($this->_var['filter']['page_count'] > 1): ?>
<div class="pagination">
    <ul>
        <li><?php if ($this->_var['filter']['page'] != 1): ?><a class="demo" href="javascript:;" onclick="gallery_album_list_pb(this,'1')"><span><?php echo $this->_var['lang']['00_home']; ?></span></a><?php else: ?><span><?php echo $this->_var['lang']['00_home']; ?></span><?php endif; ?></li>
        <li><?php if ($this->_var['filter']['page'] != 1): ?><a class="demo" href="javascript:;" onclick="gallery_album_list_pb(this,'<?php echo $this->_var['filter']['page']; ?>','prev')" ><span><?php echo $this->_var['lang']['page_prev']; ?></span></a><?php else: ?><span><?php echo $this->_var['lang']['page_prev']; ?></span><?php endif; ?></li>
        <?php $_from = $this->_var['filter']['page_arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'arr');if (count($_from)):
    foreach ($_from AS $this->_var['arr']):
?>
        <li><?php if ($this->_var['filter']['page'] == $this->_var['arr']): ?><span class="currentpage"><?php echo $this->_var['arr']; ?></span><?php else: ?><a class="demo" href="javascript:;" onclick="gallery_album_list_pb(this,'<?php echo $this->_var['arr']; ?>')" ><span><?php echo $this->_var['arr']; ?></span></a><?php endif; ?></li>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        <li><?php if ($this->_var['filter']['page'] != $this->_var['filter']['page_count']): ?><a class="demo" href="javascript:;" onclick="gallery_album_list_pb(this,'<?php echo $this->_var['filter']['page']; ?>','next')" ><span><?php echo $this->_var['lang']['page_next']; ?></span></a><?php else: ?><span><?php echo $this->_var['lang']['page_next']; ?></span><?php endif; ?></li>
        <li><?php if ($this->_var['filter']['page'] != $this->_var['filter']['page_count']): ?><a class="demo" href="javascript:;" onclick="gallery_album_list_pb(this,'<?php echo $this->_var['filter']['page_count']; ?>')"><span><?php echo $this->_var['lang']['page_last']; ?></span></a><?php else: ?><span><?php echo $this->_var['lang']['page_last']; ?></span><?php endif; ?></li>
    </ul>
</div>
<?php endif; ?>