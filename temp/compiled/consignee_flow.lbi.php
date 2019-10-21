<div class="consignee-warp">
    <?php if ($this->_var['user_address']): ?>
        <?php $_from = $this->_var['user_address']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'address');if (count($_from)):
    foreach ($_from AS $this->_var['address']):
?>
        <div class="cs-w-item<?php if ($this->_var['consignee']['address_id'] == $this->_var['address']['address_id']): ?> cs-selected<?php endif; ?>" data-addressid="<?php echo $this->_var['address']['address_id']; ?>" ectype="cs-w-item">
            <div class="item-tit">
                <h3 class="username"><?php echo $this->_var['address']['consignee']; ?></h3>
                <span class="remark"><?php echo $this->_var['address']['sign_building']; ?></span>
            </div>
            <div class="item-tel">
                <span class="contact"><?php echo $this->_var['address']['mobile']; ?></span>
            </div>
            <div class="item-address"><?php echo $this->_var['address']['region']; ?> &nbsp; <?php echo $this->_var['address']['address']; ?></div>
            <i class="icon"></i>
            <a href="javascript:void(0);" class="edit" ectype="dialog_checkout" data-value='{"divId":"edit_address","id":<?php echo $this->_var['address']['address_id']; ?>,"url":"flow.php?step=edit_Consignee","width":900,"title":"<?php echo $this->_var['lang']['edit_consignee_address']; ?>"}'><?php echo $this->_var['lang']['modify']; ?></a>
            <a href="javascript:void(0);" class="delete" ectype="dialog_checkout" data-value='{"divId":"del_address","id":<?php echo $this->_var['address']['address_id']; ?>,"url":"flow.php?step=delete_Consignee","width":450,"height":50,"title":"<?php echo $this->_var['lang']['remove_consignee_address']; ?>"}'><?php echo $this->_var['lang']['drop']; ?></a>
            <input type="radio" <?php if ($this->_var['consignee']['address_id'] == $this->_var['address']['address_id']): ?>checked="checked"<?php endif; ?> class="ui-radio" name="consignee_radio" value="<?php echo $this->_var['address']['address_id']; ?>" id="radio_<?php echo $this->_var['address']['address_id']; ?>" class="hookbox" />
        </div>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        <div class="cs-w-item">
            <a href="javascript:void(0);" class="add-new-address" ectype="dialog_checkout" data-value='{"divId":"new_address","id":0,"url":"flow.php?step=edit_Consignee","width":900,"height":450,"title":"<?php echo $this->_var['lang']['add_consignee_address']; ?>"}'>
                <i class="iconfont icon-add-quer"></i><span><?php echo $this->_var['lang']['add_new_address']; ?></span>
            </a>
        </div>
    <?php else: ?>
        <div class="cs-w-item">
            <a href="javascript:void(0);" class="add-new-address" ectype="dialog_checkout" data-value='{"divId":"new_address","id":0,"url":"flow.php?step=edit_Consignee","width":900,"height":450,"title":"<?php echo $this->_var['lang']['add_consignee_address']; ?>"}'>
                <i class="iconfont icon-add-quer"></i><span><?php echo $this->_var['lang']['add_new_address']; ?></span>
            </a>
        </div>
    <?php endif; ?>
    <div class="clear"></div>
</div>
