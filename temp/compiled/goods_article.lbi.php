<?php if ($this->_var['goods_article_list']): ?>
<div class="g-main">
	<div class="mt">
		<h3><?php echo $this->_var['lang']['article_releate']; ?></h3>
	</div>
	<div class="mc">
		<div class="mc-warp">
			<div class="items">
				<?php $_from = $this->_var['goods_article_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'article');if (count($_from)):
    foreach ($_from AS $this->_var['article']):
?>
				<div class="item"><a href="<?php echo $this->_var['article']['url']; ?>" title="<?php echo htmlspecialchars($this->_var['article']['title']); ?>"><?php echo htmlspecialchars($this->_var['article']['short_title']); ?></a></div>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>