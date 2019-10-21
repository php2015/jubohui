<?php if ($this->_var['attr_spec']): ?>
<div class="step_title">
	<i class="ui-step"></i>
    <h3 class="fl"><?php echo $this->_var['lang']['attr_pic']; ?></h3>
    <?php if ($this->_var['goods_attr_price'] == 0): ?>
        <?php if ($this->_var['goods_model'] == 1): ?>
        	<a href="goods_warehouse_attr_batch.php?act=add&goods_id=<?php echo $this->_var['goods_id']; ?>" class="btn btn35 red_btn ml30" target="_blank"><?php echo $this->_var['lang']['batch_upload_csv']; ?></a>
        <?php elseif ($this->_var['goods_model'] == 2): ?>
        	<a href="goods_area_attr_batch.php?act=add&goods_id=<?php echo $this->_var['goods_id']; ?>" class="btn btn35 red_btn ml30" target="_blank"><?php echo $this->_var['lang']['batch_upload_csv']; ?></a>
        <?php endif; ?>
    <?php endif; ?>
</div>
<div class="attr_gallerys">
<?php $_from = $this->_var['attr_spec']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'spec');$this->_foreach['onspec'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['onspec']['total'] > 0):
    foreach ($_from AS $this->_var['spec']):
        $this->_foreach['onspec']['iteration']++;
?>
<div class="step_content attr_gallery">
	<div class="attr_tit"><?php echo $this->_var['spec']['attr_name']; ?>：</div>
	<?php $_from = $this->_var['spec']['attr_values_arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'val');$this->_foreach['attr_values'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['attr_values']['total'] > 0):
    foreach ($_from AS $this->_var['key'] => $this->_var['val']):
        $this->_foreach['attr_values']['iteration']++;
?>
	<!--处理属性图片 start-->
    <div class="attr_item" style="width:<?php if ($this->_var['goods_attr_price'] == 0): ?>580<?php else: ?><?php if ($this->_var['val']['attr_type'] == 1): ?>465<?php else: ?>580<?php endif; ?><?php endif; ?>px;">
        <div class="txt" title="<?php echo $this->_var['val']['attr_value']; ?>" data-toggle="tooltip"><?php echo $this->_var['val']['attr_value']; ?></div>
        <div class="info <?php if ($this->_var['goods_attr_price'] != 0): ?><?php if ($this->_var['val']['attr_type'] == 1): ?>hide<?php endif; ?><?php endif; ?>">
            <?php if ($this->_var['goods_model'] == 1): ?>
            <input name="warehouse_butt" class="button fl mr10 <?php if ($this->_var['goods_attr_price'] != 0): ?><?php if ($this->_var['val']['attr_type'] == 1): ?>hide<?php endif; ?><?php endif; ?>" value="<?php echo $this->_var['lang']['warehouse_price']; ?>" type="button" data-goodsattrid="<?php echo $this->_var['val']['goods_attr_id']; ?>">  
            <?php elseif ($this->_var['goods_model'] == 2): ?>
            <input name="area_butt" class="button fl mr10 <?php if ($this->_var['goods_attr_price'] != 0): ?><?php if ($this->_var['val']['attr_type'] == 1): ?>hide<?php endif; ?><?php endif; ?>" value="<?php echo $this->_var['lang']['area_price']; ?>" type="button" data-goodsattrid="<?php echo $this->_var['val']['goods_attr_id']; ?>">
            <?php else: ?>
            <label class="fl mr10 <?php if ($this->_var['goods_attr_price'] != 0): ?><?php if ($this->_var['val']['attr_type'] == 1): ?>hide<?php endif; ?><?php endif; ?>"><?php echo $this->_var['lang']['price']; ?></label>
            <input type="text" class="text w80 <?php if ($this->_var['goods_attr_price'] != 0): ?><?php if ($this->_var['val']['attr_type'] == 1): ?>hide<?php endif; ?><?php endif; ?>" name="gallery_attr_price[]" onBlur="listTable.editInput(this, 'edit_attr_price', <?php echo empty($this->_var['val']['goods_attr_id']) ? '0' : $this->_var['val']['goods_attr_id']; ?>);" size="10" value="<?php echo empty($this->_var['val']['attr_price']) ? '0.00' : $this->_var['val']['attr_price']; ?>" />
            <?php endif; ?>
        </div>
        <div class="info">
            <label><?php echo $this->_var['lang']['label_sort']; ?></label>
            <input type="text" class="text w80" name="gallery_attr_sort[]" onBlur="listTable.editInput(this, 'edit_attr_sort', <?php echo empty($this->_var['val']['goods_attr_id']) ? '0' : $this->_var['val']['goods_attr_id']; ?>);" size="10" value="<?php echo $this->_var['val']['attr_sort']; ?>" />
        </div>
        
        <?php if (($this->_foreach['onspec']['iteration'] <= 1) && $this->_var['val']['goods_attr_id']): ?>
        <a href="javascript:;" ectype="add_attr_img" class="up_img" class="button" data-goodsattrid="<?php echo empty($this->_var['val']['goods_attr_id']) ? '0' : $this->_var['val']['goods_attr_id']; ?>" data-attrid="<?php echo empty($this->_var['val']['attr_id']) ? '0' : $this->_var['val']['attr_id']; ?>"><?php echo $this->_var['lang']['upload_image']; ?></a>
		<?php endif; ?>
        
        <?php if ($this->_var['val']['attr_gallery_flie']): ?>
        <a href="../<?php echo $this->_var['val']['attr_gallery_flie']; ?>" class="nyroModal"><i class="icon icon-picture"></i></a>
        <?php endif; ?>
        
        <?php if ($this->_var['val']['attr_checked']): ?>
        <div class="img" data-type="img"><img src="images/yes.png" /></div>
        <?php endif; ?>
        
        <input name="attr_id" type="hidden" value="<?php echo $this->_var['spec']['attr_id']; ?>" id="attrId" autocomplete="off"/>
        <input name="attr_value" type="hidden" value="<?php echo $this->_var['val']['attr_value']; ?>" id="goodsAttrValue_<?php echo $this->_var['val']['goods_attr_id']; ?>" autocomplete="off"/>
        <input type="hidden" class="text w80" name="gallery_attr_value[]" size="10" value="<?php echo $this->_var['val']['attr_value']; ?>" />
        <input type="hidden" class="text w80" name="gallery_attr_id[]" size="10" value="<?php echo $this->_var['spec']['attr_id']; ?>" />
    </div>
	<!--处理属性图片 end-->
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
</div>
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
</div>
<?php endif; ?>
<script type="text/javascript">
$(function(){
	$(".nyroModal").nyroModal();
	$(".attr_gallerys").hover(function(){
		$(".attr_gallerys").perfectScrollbar("destroy");
		$(".attr_gallerys").perfectScrollbar();
	});
});
</script>
