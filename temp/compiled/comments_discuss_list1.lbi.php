    <div class="thead">
        <div class="th td1"><?php echo $this->_var['lang']['message_title']; ?></div>
        <div class="th td2"><?php echo $this->_var['lang']['reply_comment']; ?></div>
        <div class="th td3"><?php echo $this->_var['lang']['browse']; ?></div>
        <div class="th td4"><?php echo $this->_var['lang']['article_author']; ?></div> 
        <div class="th td5"><?php echo $this->_var['lang']['time']; ?></div>
    </div>
    <div class="tbody">
    	<?php if ($this->_var['discuss_list']['list']): ?>
        <?php $_from = $this->_var['discuss_list']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'list');if (count($_from)):
    foreach ($_from AS $this->_var['list']):
?>
        <div class="tr">
            <div class="td td1">
                <?php if ($this->_var['list']['dis_type'] == 1): ?>
                <i class="icon icon-tie icon-tao"></i>
                <?php elseif ($this->_var['list']['dis_type'] == 2): ?>
                <i class="icon icon-tie icon-wen"></i>
                <?php elseif ($this->_var['list']['dis_type'] == 3): ?>
                <i class="icon icon-tie icon-quan"></i>
                <?php elseif ($this->_var['list']['dis_type'] == 4): ?>
                <i class="icon icon-tie icon-shai"></i>
                <?php endif; ?>
                <?php if ($this->_var['list']['dis_type'] == 4): ?>
                <a href="single_sun.php?act=discuss_show&did=<?php echo $this->_var['list']['dis_id']; ?>&dis_type=4" target="_blank"><?php echo $this->_var['list']['dis_title']; ?></a>
                <img src="themes/ecmoban_dsc2017/images/image_s.jpg">
                <?php else: ?>
                <a href="single_sun.php?act=discuss_show&did=<?php echo $this->_var['list']['dis_id']; ?>" target="_blank"><?php echo $this->_var['list']['dis_title']; ?></a>
                <?php endif; ?>
            </div>
            <div class="td td2"><?php echo $this->_var['list']['reply_num']; ?></div>
            <div class="td td3"><?php echo $this->_var['list']['dis_browse_num']; ?></div>
            <div class="td td4"><?php echo $this->_var['list']['user_name']; ?></div>
            <div class="td td5"><?php echo $this->_var['list']['add_time']; ?></div>
        </div>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        <?php else: ?>
        <div class="no_records no_comments_qt">
            <i class="no_icon no_icon_three"></i>
            <span class="block"><?php echo $this->_var['lang']['not_discussion']; ?></span>
        </div>
        <?php endif; ?>
    </div>
    <div class="clear"></div>
    <div class="s-more">
        <a href="category_discuss.php?id=<?php echo $this->_var['goods_id']; ?>" target="_blank"><span class="sm-wrap"><?php echo $this->_var['lang']['click_browse_all']; ?><i class="iconfont icon-right"></i></span></a>
    </div>