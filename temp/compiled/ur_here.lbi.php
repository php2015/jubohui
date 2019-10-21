<?php if ($this->_var['filename'] == 'category' || $this->_var['filename'] == 'goods' || $this->_var['filename'] == 'category_discuss' || $this->_var['filename'] == 'single_sun' || $this->_var['filename'] == 'exchange' || $this->_var['filename'] == 'presale' || $this->_var['filename'] == 'seckill'): ?>
<div class="crumbs-nav">
	<div class="crumbs-nav-main clearfix">
		<?php $_from = $this->_var['data']['body']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cat');$this->_foreach['cat'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['cat']['total'] > 0):
    foreach ($_from AS $this->_var['cat']):
        $this->_foreach['cat']['iteration']++;
?>
		<div class="crumbs-nav-item">
			<div class="menu-drop">
				<div class="trigger<?php if (! $this->_var['cat']['cat_tree']): ?> bottom<?php endif; ?>">
					<a href="<?php echo $this->_var['cat']['url']; ?>"><span><?php echo $this->_var['cat']['cat_name']; ?></span></a>
					<i class="iconfont icon-down"></i>
				</div>
                <?php if ($this->_var['cat']['cat_tree']): ?>
				<div class="menu-drop-main">
					<ul>
						<?php $_from = $this->_var['cat']['cat_tree']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'tree');if (count($_from)):
    foreach ($_from AS $this->_var['tree']):
?>
						<li><a href="<?php echo $this->_var['tree']['url']; ?>"><?php echo $this->_var['tree']['cat_name']; ?></a></li>
						<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</ul>
				</div>
                <?php endif; ?>
			</div>
			<?php if (! ($this->_foreach['cat']['iteration'] == $this->_foreach['cat']['total']) || $this->_var['data']['foot']): ?><i class="iconfont icon-right"></i><?php endif; ?>
		</div>
		<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		<?php if ($this->_var['data']['foot']): ?>
		<span class="cn-goodsName"><?php echo $this->_var['data']['foot']; ?></span>
		<?php endif; ?>
	</div>
</div>
<?php elseif ($this->_var['filename'] == 'article' || $this->_var['filename'] == 'article_cat'): ?>
<div class="extra">
	<?php $_from = $this->_var['data']['body']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cat');$this->_foreach['cat'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['cat']['total'] > 0):
    foreach ($_from AS $this->_var['cat']):
        $this->_foreach['cat']['iteration']++;
?>
    <a href="<?php echo $this->_var['cat']['url']; ?>"><?php echo $this->_var['cat']['cat_name']; ?></a>
    <i>&gt;</i>
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    <?php if ($this->_var['data']['foot']): ?>
    <span><?php echo $this->_var['data']['foot']; ?></span>
    <?php endif; ?>
</div>
<?php elseif ($this->_var['filename'] == 'group_buy' || $this->_var['filename'] == 'snatch' || $this->_var['filename'] == 'category_compare' || $this->_var['filename'] == 'package'): ?>
<div class="crumbs-nav">
	<div class="crumbs-nav-main clearfix">
		<div class="crumbs-nav-item">
			<a href="index.php"><?php echo $this->_var['lang']['home']; ?></a>
			<i class="iconfont icon-right"></i>
        </div>    
        <?php if ($this->_var['filename'] == 'snatch'): ?>
        <div class="crumbs-nav-item">
        <?php echo $this->_var['lang']['snatch']; ?>
        <i class="iconfont icon-right"></i>
        </div>
        <?php else: ?>
        <?php $_from = $this->_var['data']['body']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cat');$this->_foreach['cat'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['cat']['total'] > 0):
    foreach ($_from AS $this->_var['cat']):
        $this->_foreach['cat']['iteration']++;
?>
        <div class="crumbs-nav-item">
            <a href="<?php echo $this->_var['cat']['url']; ?>"><?php echo $this->_var['cat']['cat_name']; ?></a>
            <i class="iconfont icon-right"></i>
        </div>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        <?php endif; ?>
        <?php if ($this->_var['data']['foot']): ?>
        <span><?php echo $this->_var['data']['foot']; ?></span>
        <?php endif; ?>
	</div>
</div>
<?php else: ?>
<?php echo $this->_var['ur_here']; ?>
<?php endif; ?>
