<!doctype html>
<html>
<head><?php echo $this->fetch('library/admin_html_head.lbi'); ?></head>

<body class="iframe_body">
	<div class="warpper">
    	<div class="title"><?php echo $this->_var['ur_here']; ?></div>
        <div class="content">
            <div class="flexilist">
			<form name="theForm" method="get" action="order.php" onsubmit="return check()">
                <div class="common-content">
                    <div class="mian-info">
						<div class="switch_info">
                            <div class="items">
								<?php if (! $this->_var['show_shipping_sn']): ?>
								<div class="item">
									<div class="label"><?php if ($this->_var['require_note']): ?><?php echo $this->_var['lang']['require_field']; ?><?php endif; ?>&nbsp;<?php echo $this->_var['lang']['label_action_note']; ?></div>
									<div class="label_value">
										<textarea name="action_note" cols="60" rows="3" class="textarea"><?php echo $this->_var['action_note']; ?></textarea>
									</div>
								</div>
                                <?php endif; ?>
                                <?php if ($this->_var['show_cancel_note']): ?>
								<div class="item">
									<div class="label"><?php echo $this->_var['lang']['require_field']; ?>&nbsp;<?php echo $this->_var['lang']['label_cancel_note']; ?></div>
									<div class="label_value">
										<textarea name="cancel_note" cols="60" rows="3" id="cancel_note" class="textarea fl"><?php echo $this->_var['cancel_note']; ?></textarea>
                                        <label class="blue_label fl" style="margin-top:92px; line-height:normal;"><?php echo $this->_var['lang']['notice_cancel_note']; ?></label>
									</div>
								</div>
								<?php endif; ?>
								<?php if ($this->_var['show_invoice_no']): ?>
								<div class="item">
									<div class="label"><?php echo $this->_var['lang']['label_invoice_no']; ?></div>
									<div class="label_value">
										<input name="invoice_no" type="text" class="text" size="30" autocomplete="off" />
									</div>
								</div>
                                <?php endif; ?>
                                
                                <?php if ($this->_var['show_refund'] || $this->_var['show_refund1']): ?>
                                    <?php if (! $this->_var['is_baitiao']): ?>
                                    <div class="item">
                                        <div class="label"><?php echo $this->_var['lang']['refund_money']; ?>：</div>
                                        <div class="label_value">
                                            <!--<?php if ($this->_var['refound_pay_points'] > 0): ?>-->
                                            <span class="fl"><?php echo $this->_var['lang']['pay_points']; ?>：</span>
                                            <input name="refound_pay_points" id="refound_pay_points" type="text" class="text text_2" size="10" value="<?php echo $this->_var['refound_pay_points']; ?>" autocomplete="off" onchange="refound_points(this.value)" />
                                            <!--<?php endif; ?>-->
                                            <span class="fl"><?php echo $this->_var['lang']['money']; ?>：</span>
                                            <input name="refound_amount" id="refoundAmount" type="text" class="text text_2" size="10" value="<?php echo $this->_var['refound_amount']; ?>" autocomplete="off" onchange="get_refound_amount(this.value, 1)" />
                                            <span class="fl"><?php echo $this->_var['lang']['shipping_money']; ?>：</span>
                                            <input type="text" name="shipping" value="<?php echo empty($this->_var['shipping_fee']) ? '0' : $this->_var['shipping_fee']; ?>" id="shippingFee" size="6" class="text text_2" onchange="get_refound_amount(this.value, 2)" autocomplete="off" />
                                            <div class="checkbox-items fl">
                                                <div class="checkbox-item fl mr10">
                                                    <input type="radio" name="is_shipping" class="ui-radio" id="is_shipping_0" autocomplete="off" value="0" <?php if ($this->_var['operation'] != 'return'): ?>checked<?php endif; ?> />
                                                    <label for="is_shipping_0" class="ui-radio-label"><?php echo $this->_var['lang']['no_shipping_money']; ?></label>
                                                </div>
                                                <div class="checkbox-item fl">
                                                    <input type="radio" name="is_shipping" class="ui-radio" value="1" autocomplete="off" id="is_shipping_1" <?php if ($this->_var['operation'] == 'return'): ?>checked<?php endif; ?> />
                                                    <label for="is_shipping_1" class="ui-radio-label"><?php echo $this->_var['lang']['is_shipping_money']; ?></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if ($this->_var['value_card'] && $this->_var['is_whole'] != 1): ?>
                                    <div class="item">
                                        <div class="label"><?php echo $this->_var['lang']['18_value_card']; ?>：</div>
                                        <div class="label_value">
                                            <span class="fl"><?php echo $this->_var['lang']['money']; ?>：</span>
                                            <input name="refound_vcard" id="refound_vcard" type="text" class="text text_2" size="10" value="<?php echo $this->_var['value_card']['use_val']; ?>" autocomplete="off" onchange="get_refound_value_card(this.value, <?php echo empty($this->_var['value_card']['vc_id']) ? '0' : $this->_var['value_card']['vc_id']; ?>)" />
                                            <input type="hidden" name="vc_id" value="<?php echo empty($this->_var['value_card']['vc_id']) ? '0' : $this->_var['value_card']['vc_id']; ?>" />
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <?php if ($this->_var['show_refund1']): ?>
                                    <div class="item">
                                        <div class="label"><?php echo $this->_var['lang']['label_handle_refund']; ?></div>
                                        <div class="label_value">
                                        	<?php if ($this->_var['is_baitiao']): ?><!--当前退款订单如果是白条订单 只显示"退回白条额度"-->
                                            	<div class="checkbox-items">
                                                	<div class="chekbox-item">
                                                    	<input type="radio" checked="checked" name="refund" value="5" id="refund_radio_5" class="ui-radio" />
                                                        <label for="refund_radio_5" class="ui-radio-label"><?php echo $this->_var['lang']['return_baitiao']; ?></label>
                                                    </div>
                                                </div>
                                        	<?php else: ?>
                                            	<div class="checkbox-items">
                                                	<?php if (! $this->_var['anonymous']): ?>
                                                	<div class="chekbox-item">
                                                    	<input type="radio" name="refund" value="1" id="refund_radio_1" autocomplete="off" class="ui-radio" checked />
                                                        <label for="refund_radio_1" class="ui-radio-label"><?php echo $this->_var['lang']['return_user_money']; ?></label>
                                                    </div>
                                                    <?php endif; ?>
                                                    <div class="chekbox-item">
                                                    	<input type="radio" name="refund" value="2" id="refund_radio_2" autocomplete="off" class="ui-radio" />
                                                        <label for="refund_radio_2" class="ui-radio-label"><?php echo $this->_var['lang']['return_user_line']; ?></label>
                                                    </div>
                                                </div>
                                        	<?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="label"><?php echo $this->_var['lang']['label_refund_note']; ?></div>
                                        <div class="label_value">
                                            <textarea name="refund_note" cols="60" rows="3" id="refund_note" class="textarea"><?php echo $this->_var['refund_note']; ?></textarea>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if ($this->_var['show_refund']): ?>
                                    <div class="item">
                                        <div class="label"><?php echo $this->_var['lang']['label_handle_refund']; ?></div>
                                        <div class="label_value">
                                        	<div class="checkbox-items">
                                                <?php if (! $this->_var['anonymous']): ?>
                                                <div class="chekbox-item">
                                                    <input type="radio" name="refund" value="1" id="refund_radio_1" class="ui-radio" checked autocomplete="off" />
                                                    <label for="refund_radio_1" class="ui-radio-label"><?php echo $this->_var['lang']['return_user_money']; ?></label>
                                                </div>
                                                <?php endif; ?>
                                                <div class="chekbox-item">
                                                    <input type="radio" name="refund" value="2" id="refund_radio_2" class="ui-radio" <?php if ($this->_var['anonymous']): ?>checked="checked"<?php endif; ?> autocomplete="off" />
                                                    <label for="refund_radio_2" class="ui-radio-label"><?php echo $this->_var['lang']['create_user_account']; ?></label>
                                                </div>
                                                <div class="chekbox-item">
                                                    <input type="radio" name="refund" value="3" id="refund_radio_3" class="ui-radio" autocomplete="off" />
                                                    <label for="refund_radio_3" class="ui-radio-label"><?php echo $this->_var['lang']['not_handle']; ?></label>
                                                </div>
											</div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="label"><?php echo $this->_var['lang']['label_refund_note']; ?></div>
                                        <div class="label_value">
                                            <textarea name="refund_note" cols="60" rows="3" id="refund_note" class="textarea"><?php echo $this->_var['refund_note']; ?></textarea>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if ($this->_var['show_shipping_sn']): ?>
                                    <?php $_from = $this->_var['oid_array']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'oid');if (count($_from)):
    foreach ($_from AS $this->_var['oid']):
?>
                                        <div class="item">
                                            <div class="label"><?php echo $this->_var['lang']['order_sn']; ?>：<?php echo $this->_var['oid']; ?></div>
                                            <div class="label_value">
                                                <span style="float:left;"><?php echo $this->_var['lang']['courier_sz']; ?>：</span><input type="text" class="text" value="" name="ino_<?php echo $this->_var['oid']; ?>" autocomplete="off" />
                                            </div>
                                        </div>
                                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                <?php endif; ?>
								<div class="item">
									<div class="label">&nbsp;</div>
									<div class="label_value info_btn">
										<input type="submit" name="submit" value="<?php echo $this->_var['lang']['button_submit']; ?>" class="button" />
										<input type="button" name="back" value="<?php echo $this->_var['lang']['back']; ?>" class="button" onclick="history.back()" />
										<input type="hidden" id="orderId" name="order_id" value="<?php echo empty($this->_var['order_id']) ? '0' : $this->_var['order_id']; ?>" />
										<input type="hidden" id="recId" name="rec_id" value="<?php echo empty($this->_var['rec_id']) ? '0' : $this->_var['rec_id']; ?>"/>
										<input type="hidden" id="retId" name="ret_id" value="<?php echo empty($this->_var['ret_id']) ? '0' : $this->_var['ret_id']; ?>"/>
										<input type="hidden" name="operation" value="<?php echo $this->_var['operation']; ?>" />
										<input type="hidden" name="act" value="<?php if ($this->_var['batch']): ?>batch_operate_post<?php else: ?>operate_post<?php endif; ?>" />
									</div>
								</div>
							</div>
						</div>
                    </div>
                </div>
			</form>
            </div>
		</div>
	</div>
 <?php echo $this->fetch('library/pagefooter.lbi'); ?>
<script type="text/javascript">
  var require_note = '<?php echo $this->_var['require_note']; ?>';
  var show_refund  = '<?php echo $this->_var['show_refund']; ?>';
  var show_cancel = '<?php echo $this->_var['show_cancel_note']; ?>';

  function check()
  {
    if (require_note && document.forms['theForm'].elements['action_note'].value == '')
    {
      alert(pls_input_note);
      return false;
    }
	if (show_cancel && document.forms['theForm'].elements['cancel_note'].value == '')
	{
	  alert(pls_input_cancel);
	  return false;
	}
    if (show_refund)
    {
      var selected = false;
      for (var i = 0; i < document.forms['theForm'].elements.length; i++)
      {
        ele = document.forms['theForm'].elements[i];
        if (ele.tagName == 'INPUT' && ele.name == 'refund' && ele.checked)
        {
          selected = true;
          break;
        }
      }
      if (!selected)
      {
        alert(pls_select_refund);
        return false;
      }
    }
    return true;
  }
  
  function get_refound_amount(t, type){
	  var orderId = document.getElementById('orderId').value;
	  var recId = document.getElementById('recId').value;
	  var retId = document.getElementById('retId').value;
	  
	  Ajax.call('order.php?is_ajax=1&act=edit_refound_amount', "refound_amount="+ t + "&type=" + type + "&order_id=" + orderId + "&rec_id=" + recId + "&ret_d=" + retId, refound_amountResponse, "GET", "JSON");
  }
  
  function refound_amountResponse(result){
	  if(result.content.type == 1){
		  if(result.content.refound_amount > result.content.should_return){
			  document.getElementById('refoundAmount').value = result.content.should_return;
		  }
	  }else{
		  document.getElementById('shippingFee').value = result.content.shipping_fee;
	  }
	  
  }
  
  function get_refound_value_card(refound_vcard, vc_id){
	  
	  var order_id = document.getElementById('orderId').value;
	  var retId = document.getElementById('retId').value;
	  
	  Ajax.call('order.php?is_ajax=1&act=edit_refound_value_card', "vc_id="+ vc_id + "&order_id=" + order_id + "&refound_vcard=" + refound_vcard + "&ret_id=" + retId, refoundValueCardResponse, "GET", "JSON");
  }
  
  function refoundValueCardResponse(result){
	  $("#refound_vcard").val(result.content.refound_vcard);
  }
  /*判断返回积分的值   BY kong*/
  function refound_points(refound_pay_points){
      var old_refound_pay_points = parseInt(Number("<?php echo $this->_var['refound_pay_points']; ?>"));
      var refound_points = parseInt(refound_pay_points);
      if(refound_points  > old_refound_pay_points  || refound_points < 0 ){
          $("#refound_pay_points").val(old_refound_pay_points);
      }else{
          $("#refound_pay_points").val(refound_points);
      }
  }

</script> 
</body>
</html>
