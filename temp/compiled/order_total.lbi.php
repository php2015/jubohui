
<div class="order-summary">
    <div class="statistic">
        <div class="list">
            <span><em><?php echo $this->_var['cart_goods_number']; ?></em> <?php echo $this->_var['lang']['cart_goods_number']; ?>：</span>
            <em class="price" id="warePriceId"><?php echo $this->_var['total']['goods_price_formated']; ?></em>
        </div>
        <?php if ($this->_var['total']['dis_amount'] > 0): ?>
        <div class="list">
            <span><?php echo $this->_var['lang']['dis_amount']; ?>：</span>
            <em class="price" id="cachBackId"> -<?php echo $this->_var['total']['dis_amount_formated']; ?></em>
        </div>
        <?php endif; ?>
        <?php if ($this->_var['total']['discount'] > 0): ?>
        <div class="list">
            <span><?php echo $this->_var['lang']['discount']; ?>：</span>
            <em class="price" id="cachBackId"> -<?php echo $this->_var['total']['discount_formated']; ?></em>
        </div>
        <?php endif; ?>
        <?php if ($this->_var['total']['tax'] > 0): ?>
        <div class="list">
            <span><?php echo $this->_var['lang']['tax']; ?>：</span>
            <em class="price" id="cachBackId"> +<?php echo $this->_var['total']['tax_formated']; ?></em>
        </div>
        <?php endif; ?>
        <?php if ($this->_var['total']['shipping_fee'] > 0): ?>
        <div class="list">
            <span><?php echo $this->_var['lang']['shipping_fee']; ?>：</span>
            <em class="price" id="freightPriceId">+<?php echo $this->_var['total']['shipping_fee_formated']; ?></em>
        </div>
        <?php endif; ?>
        <?php if ($this->_var['total']['shipping_insure'] > 0): ?>
        <div class="list">
            <span><?php echo $this->_var['lang']['insure_fee']; ?>：</span>
            <em class="price" id="cachBackId"> +<?php echo $this->_var['total']['shipping_insure_formated']; ?></em>
        </div>
        <?php endif; ?>
        <?php if ($this->_var['total']['pay_fee'] > 0): ?>
        <div class="list">
            <span><?php echo $this->_var['lang']['pay_fee']; ?>：</span>
            <em class="price" id="cachBackId"> +<?php echo $this->_var['total']['pay_fee_formated']; ?></em>
        </div>
        <?php endif; ?>
        <?php if ($this->_var['total']['surplus'] > 0 || $this->_var['total']['integral'] > 0 || $this->_var['total']['bonus'] > 0 || $this->_var['total']['coupons'] > 0 || $this->_var['total']['value_card'] > 0): ?>
            <?php if ($this->_var['total']['surplus'] > 0): ?>
            <div class="list">
                <span><?php echo $this->_var['lang']['use_surplus']; ?>：</span>
                <em class="price" id="cachBackId"> -<?php echo $this->_var['total']['surplus_formated']; ?></em>
            </div>
            <?php endif; ?>
            <?php if ($this->_var['total']['integral'] > 0): ?>
            <div class="list">
                <span><?php echo $this->_var['lang']['use_integral']; ?>：</span>
                <em class="price" id="cachBackId"> -<?php echo $this->_var['total']['integral_formated']; ?></em>
            </div>
            <?php endif; ?>
            <?php if ($this->_var['total']['bonus'] > 0): ?>
            <div class="list">
                <span><?php echo $this->_var['lang']['use_bonus']; ?>：</span>
                <em class="price" id="cachBackId"> -<?php echo $this->_var['total']['bonus_formated']; ?></em>
            </div>
            <?php endif; ?>
            <?php if ($this->_var['total']['coupons'] > 0): ?>
            <div class="list">
                <span><?php echo $this->_var['lang']['label_coupons']; ?>：</span>
                <em class="price" id="cachBackId"> -<?php echo $this->_var['total']['coupons_formated']; ?></em>
            </div>
            <?php endif; ?>
            <?php if ($this->_var['total']['value_card'] > 0): ?>
			<?php if ($this->_var['total']['card_dis'] != ''): ?>
            <div class="list">
                <span><?php echo $this->_var['lang']['value_card_dis']; ?>：</span>
                <em class="price" id="cachBackId"> <?php echo $this->_var['total']['card_dis']; ?>折</em>
            </div>
			<?php endif; ?>
            <div class="list">
                <span><?php echo $this->_var['lang']['use_value_card']; ?>：</span>
                <em class="price" id="cachBackId"> -<?php echo $this->_var['total']['value_card_formated']; ?></em>
            </div>
            <?php endif; ?>
        <?php endif; ?>
        <div class="list">
            <span><?php echo $this->_var['lang']['total_amount_payable']; ?>：</span>
            <em class="price-total"><?php echo $this->_var['total']['amount_formated']; ?></em>
        </div>
        <?php if ($this->_var['total']['exchange_integral']): ?>
            <div class="list">
                <span class="txt flow_exchange_goods"><?php echo $this->_var['lang']['notice_eg_integral']; ?></span>
                <em class="price" id="payPriceId" class="flow_exchange_goods"><?php echo $this->_var['total']['exchange_integral']; ?></em>
            </div>
        <?php endif; ?>
        <?php if ($this->_var['is_group_buy']): ?><div class="amount-sum"><strong><?php echo $this->_var['lang']['notice_gb_order_amount']; ?></strong></div><?php endif; ?>
    </div>
</div>   

<div class="checkout-foot" ectype="tfoot-toolbar">
    <div class="w w1200">
        <div class="btn-area"><input type="button" id="submit-done" class="submit-btn" value="<?php echo $this->_var['lang']['submit_order']; ?>"></div>
        <?php if ($this->_var['seller_store'] != 'store_seller'): ?>
        <div class="d-address">
            <span id="sendAddr"><?php echo $this->_var['lang']['Send_to']; ?>：<?php echo $this->_var['consignee']['consignee_address']; ?></span>
            <span id="sendMobile"><?php echo $this->_var['lang']['Consignee']; ?>：<?php echo $this->_var['consignee']['consignee']; ?>&nbsp;&nbsp;<?php echo $this->_var['consignee']['mobile']; ?></span>
        </div>
        <?php endif; ?>
    </div>
    <input name="goods_flow_type" value="<?php echo $this->_var['goods_flow_type']; ?>" type="hidden">
    <input name="rec_number_str" value="" type="hidden">
	<input name="shipping_prompt_str" value="" type="hidden">
    <input type="hidden" id="store_id" name='store_id' value="<?php echo empty($this->_var['store_id']) ? '0' : $this->_var['store_id']; ?>"/>
    <input type="hidden" id="store_seller" value="<?php echo $this->_var['seller_store']; ?>" name="store_seller">
    <input type="hidden" value="<?php echo empty($this->_var['warehouse_id']) ? '0' : $this->_var['warehouse_id']; ?>" name="warehouse_id">
    <input type="hidden" value="<?php echo empty($this->_var['area_id']) ? '0' : $this->_var['area_id']; ?>" name="area_id">
    <input name="sc_guid" value="<?php echo empty($this->_var['sc_guid']) ? '0' : $this->_var['sc_guid']; ?>" type="hidden" autocomplete="off">
	<input name="sc_rand" value="<?php echo empty($this->_var['sc_rand']) ? '0' : $this->_var['sc_rand']; ?>" type="hidden" autocomplete="off">
    <input name="submit_erorr" value="1" type="hidden" autocomplete="off">
</div>
<script type="text/javascript">
$(function(){
	$(":input[name='order_bonus_sn']").val('');
	
	$("input[name='rec_number']").each(function(index, element) {
        if($(element).val() == 1){
			var store_id = document.getElementById('store_id').value;
			var warehouse_id = $(":input[name='warehouse_id']").val();
			var area_id = $(":input[name='area_id']").val();
			var seller_store = <?php echo empty($this->_var['seller_store']) ? '0' : $this->_var['seller_store']; ?>;
			
			(store_id > 0) ? store_id : 0;
			$(".checkout-foot .btn-area").removeClass('no_shipping');
			$(".checkout-foot .btn-area").addClass('no_goods');
			$(".checkout-foot .btn-area").attr('data-url', 'ajax_dialog.php?act=goods_stock_exhausted&warehouse_id=' + warehouse_id + '&area_id=' + area_id + '&store_id=' + store_id + '&store_seller=' + seller_store);
			$(".checkout-foot .btn-area").html('<input type="button" class="submit-btn" id="submit-done" value="'+json_languages.submit_order+'"/>');
			return false;
		}
    });
	
	var rec_number = new Array();
	$("input[name='rec_number']").each(function(index, element) {	
		if($(element).val() == 1){
			
			var num_recid = $(element).data("id");
			
			rec_number.push(num_recid);
		}
    });
	
	$("input[name='rec_number_str']").val(rec_number);
	
	$("input[name='shipping_prompt']").each(function(index, element) {
		
		var store_id = Number($(".checkout-foot :input[name='store_id']").val());
		var seller_store = <?php echo empty($this->_var['seller_store']) ? '0' : $this->_var['seller_store']; ?>;
		
        if($(element).val() == 1 && store_id == 0){
			var store_id = document.getElementById('store_id').value;
			var warehouse_id = $(":input[name='warehouse_id']").val();
			var area_id = $(":input[name='area_id']").val();
			
			(store_id > 0) ? store_id : 0;
			$(".checkout-foot .btn-area").removeClass('no_goods');
			$(".checkout-foot .btn-area").addClass('no_shipping');
			
			$(".checkout-foot .btn-area").attr('data-url', 'ajax_dialog.php?act=shipping_prompt&warehouse_id=' + warehouse_id + '&area_id=' + area_id + '&store_id=' + store_id + '&store_seller=' + seller_store);
			
			$(".checkout-foot .btn-area").html('<input type="button" class="submit-btn" id="submit-done" value="'+json_languages.submit_order+'"/>');
			return false;			
		}
    });
	
	var shipping_prompt = new Array();
	$("input[name='shipping_prompt']").each(function(index, element) {	

		if($(element).val() == 1){
			var shipping_recid = $(element).data("id");
			shipping_prompt.push(shipping_recid);
		}
    });

	$("input[name='shipping_prompt_str']").val(shipping_prompt);
	
	<?php if ($this->_var['is_exchange_goods'] == 1 || $this->_var['total']['real_goods_count'] == 0): ?>
	$('.flow_exchange_goods').show();
	<?php endif; ?>
	
	$(document).on("click","#submit-done",function(){
		var value = new Array();
		var rec_id = new Array();
		var shipping_list = $(":input[name='shipping[]']");
		var cart_list = $(":input[name='cart_info[]']");
		var store_id = Number($(".checkout-foot :input[name='store_id']").val());
		var cart_value = $(":input[name='done_cart_value']").val();
		var warehouse_id = $(":input[name='warehouse_id']").val();
		var area_id = $(":input[name='area_id']").val();
		var number_erorr = 0;
		
		var parents = $(this).parents(".btn-area");
		if(parents.hasClass("no_goods")){
		  var rec_number = $("input[name='rec_number_str']").val();
		  var url = parents.data('url');
		  if(rec_number != ''){
			url = url + "&rec_number=" + rec_number;
		  }
		  
		  Ajax.call(url,'',noGoods, 'POST', 'JSON');
		  function noGoods(result){
			if(result.error == 1){
			  pb({
				id:'noGoods',
				title:json_languages.No_goods,
				width:670,
				ok_title:json_languages.go_up,  //按钮名称
				cl_title:json_languages.back_cart,  //按钮名称
				content:result.content,   //调取内容
				drag:false,
				foot:true,
				onOk:function(){
				  $("form[name='stockFormCart']").submit();
				},
				onCancel:function(){
				  location.href = "flow.php";
				}
			  });
			  $('.pb-ok').addClass('color_df3134');
			  
			  $(".checkout-foot :input[name='submit_erorr']").val(0);
			}else{
			  $("form[name='doneTheForm']").submit();
			}
		  }
		  
		  return false;
		}
		
		if(parents.hasClass("no_shipping")){
		  var shipping_prompt = $("input[name='shipping_prompt_str']").val();
		  var url = parents.data('url');
		  
		  if(shipping_prompt != ''){
			url = url + "&shipping_prompt=" + shipping_prompt;
		  }
		  
		  Ajax.call(url,'',noShipping, 'POST', 'JSON');
		  function noShipping(result){
			if(result.error == 1){
			  pb({
				id:'noGoods',
				title:json_languages.No_shipping,
				width:670,
				ok_title:json_languages.go_up,  //按钮名称
				cl_title:json_languages.back_cart,  //按钮名称
				content:result.content,   //调取内容
				drag:false,
				foot:true,
				onOk:function(){
				  $("form[name='stockFormCart']").submit();
				},
				onCancel:function(){
				  location.href = "flow.php";
				}
			  });
			  $('.pb-ok').addClass('color_df3134');
			  
			  $(".checkout-foot :input[name='submit_erorr']").val(0);
			}else{
			  $("form[name='doneTheForm']").submit();
			}
		  }
		  
		  return false;
		}
		
		var submit_erorr = Number($(".checkout-foot :input[name='submit_erorr']").val());
		
		if(submit_erorr == 1){
			if(checkOrderForm("form[name='doneTheForm']") == false){
				return false;
			}else{
				if(store_id > 0){
					//防止表单重复提交
					if(checkSubmit() == true){
						$("form[name='doneTheForm']").submit();
					}else{
						return false;
					}
				}else{
					shipping_list.each(function(index, element) {
						
						var val = $(this).data("sellerid") + "-" + $(this).val();
						
						value.push(val);
					});
					
					cart_list.each(function(index, element) {
						rec_id.push($(this).val());
					});
					
					var where = '&warehouse_id=' + warehouse_id + '&area_id=' + area_id + '&store_id=' + store_id + '&store_seller=<?php echo $this->_var['seller_store']; ?>';
					Ajax.call('ajax_dialog.php', 'act=flow_shipping&shipping_list=' + value + '&rec_id=' + rec_id + where, notShippingResponse, 'POST', 'JSON');
				}
				return true;
			}
		}else{
			return false;
		}
	});
	
	function notShippingResponse(result){
		if(result.error == 1){
			pb({
				id:'noGoods',
				title:json_languages.No_shipping,
				width:670,
				ok_title:json_languages.go_up, 	//按钮名称
				cl_title:json_languages.back_cart, 	//按钮名称
				content:result.content, 	//调取内容
				drag:false,
				foot:true,
				onOk:function(){
					$("form[name='stockFormCart']").submit();
				},
				onCancel:function(){
					location.href = "flow.php";
				}
			});
			$('.pb-ok').addClass('color_df3134');
		}else{
			//加载中
			ajaxLoadFunc();
			
			//防止表单重复提交
			if(checkSubmit() == true){
				$("form[name='doneTheForm']").submit();
			}else{
				return false;
			}
		}
	}
});
</script>