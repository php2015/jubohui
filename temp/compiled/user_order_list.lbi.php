<div class="user-order-list user-order-list-special">
<?php $_from = $this->_var['orders']['order_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'order');if (count($_from)):
    foreach ($_from AS $this->_var['order']):
?>
<?php if ($this->_var['order']['order_over'] == 1): ?>
<input name="order_id[]" value="<?php echo $this->_var['order']['order_id']; ?>" type="hidden">
<?php endif; ?>
<dl class="item">
	<dt class="item-t item-t-qb">
		<div class="t-statu">
        	<div class="t-statu-name" id="ss_received_<?php echo $this->_var['order']['order_id']; ?>"><?php if ($this->_var['order']['order_over'] != 1): ?><?php echo $this->_var['order']['order_status']; ?><?php endif; ?></div>
            <?php if ($this->_var['order']['invoice_no']): ?>
            <div class="logistics">
                <div class="logistics-track">
                    <div class="logistics-t">
                        <i class="logistics-icon"></i>
                    </div>
                    <div class="logistics-c">
                    	<div class="logistics-items" id="retData_<?php echo $this->_var['order']['order_id']; ?>"></div>
                	</div>
                </div>
                <span id="invoice_no_<?php echo $this->_var['order']['order_id']; ?>" style="display:none"><?php echo $this->_var['order']['invoice_no']; ?></span>
                <span id="shipping_name_<?php echo $this->_var['order']['order_id']; ?>" style="display:none"><?php echo $this->_var['order']['shipping_name']; ?></span>
            </div>    
            <?php endif; ?>
            <?php if ($this->_var['order']['allow_order_delay'] && $this->_var['order']['allow_order_delay_handler']): ?>
            <div class="fr">
                <div class="time fl" ectype="time" data-time="<?php echo $this->_var['order']['auto_delivery_time']; ?>">
                    <span></span><span class="days">00</span><em>:</em><span class="hours">00</span><em>:</em><span class="minutes">00</span><em>:</em><span class="seconds">00</span>					   
                </div>
            </div>
            <?php endif; ?>
        </div>
		<div class="t-info">
			<span class="info-item"><?php echo $this->_var['lang']['order_number']; ?>：<?php echo $this->_var['order']['order_sn']; ?></span>
			<span class="info-item"><?php echo $this->_var['order']['order_time']; ?></span>
			<span class="info-item"><?php echo $this->_var['order']['consignee']; ?></span>	
		</div>
		<div class="t-price"><?php echo $this->_var['order']['total_fee']; ?></div>
	</dt>
	<dd class="item-c">
		<div class="c-left">
			<?php $_from = $this->_var['order']['order_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from AS $this->_var['goods']):
        $this->_foreach['foo']['iteration']++;
?>
			<div class="c-goods" ectype="c-goods" <?php if (($this->_foreach['foo']['iteration'] - 1) > 2): ?> style="display:none;"<?php endif; ?>>
				<?php if ($this->_var['goods']['og_extension_code'] != 'package_buy'): ?>
					<div class="c-img"><a href="<?php echo $this->_var['goods']['url']; ?>"><img src="<?php if ($this->_var['goods']['goods_thumb']): ?><?php echo $this->_var['goods']['goods_thumb']; ?><?php else: ?><?php echo $this->_var['order']['no_picture']; ?><?php endif; ?>" alt=""></a></div> 
				<?php else: ?>
				<div class="c-img"><a href="./package.php"><img src="<?php if ($this->_var['goods']['goods_thumb']): ?>./data/gallery_album/package_goods_default.jpg<?php else: ?><?php echo $this->_var['order']['no_picture']; ?><?php endif; ?>" alt=""></a></div> 
				<?php endif; ?>
				<div class="c-info">
					<div class="o-info-lm">
                        <?php if ($this->_var['goods']['og_extension_code'] == 'package_buy'): ?>
                        <?php echo sub_str($this->_var['goods']['goods_name'],30); ?>
                        <span class="red"><?php echo $this->_var['lang']['remark_package']; ?></span>
                        <?php else: ?>
                        <a href="<?php echo $this->_var['goods']['url']; ?>" class="info-name" target="_blank" title="<?php echo $this->_var['goods']['goods_name']; ?>"><?php echo $this->_var['goods']['goods_name']; ?></a>
                        <?php endif; ?>
                    </div>
                    <div class="fl">
					<div class="info-price mr10" style="width: auto;"><b><?php echo $this->_var['goods']['goods_price']; ?></b><i>×</i><span><?php echo $this->_var['goods']['goods_number']; ?></span></div>
					<?php if ($this->_var['goods']['trade_id'] && $this->_var['goods']['og_extension_code'] != 'package_buy'): ?><a href="user.php?act=trade&tradeId=<?php echo $this->_var['goods']['trade_id']; ?>&snapshot=true" class="ftx-05 trade_snapshot" target="_blank"><?php echo $this->_var['lang']['trade_snapshot']; ?></a><?php endif; ?>
					</div>
                    <?php if ($this->_var['goods']['goods_attr']): ?><div class="info-attr"><?php echo $this->_var['goods']['goods_attr']; ?></div><?php endif; ?>
				</div>
			</div>
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            <?php if ($this->_var['order']['order_goods_count'] > 3): ?>
            <span class="ellipsis">......</span>
            <a href="javascript:void(0);" class="order-prolist-more" ectype="opm"><?php echo $this->_var['lang']['see_more']; ?>︾</a>
            <?php endif; ?>
		</div>
        <div class="c-outhr">
            <span class="info-item"><a href="<?php echo $this->_var['order']['shop_url']; ?>" class="user-shop-link"><?php echo $this->_var['order']['shop_name']; ?></a>
                <?php if ($this->_var['order']['is_IM'] == 1 || $this->_var['order']['is_dsc']): ?>
                <a id="IM" onclick="openWin(this)" href="javascript:;" ru_id="<?php echo $this->_var['order']['ru_id']; ?>" class="iconfont icon-kefu user-shop-kefu"></a>
                <?php else: ?>
                <?php if ($this->_var['order']['kf_type'] == 1): ?>
                <a href="http://www.taobao.com/webww/ww.php?ver=3&touid=<?php echo $this->_var['order']['kf_ww']; ?>&siteid=cntaobao&status=1&charset=utf-8" class="iconfont icon-kefu user-shop-kefu" target="_blank"></a>
                <?php else: ?>
                <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $this->_var['order']['kf_qq']; ?>&site=qq&menu=yes" class="iconfont icon-kefu user-shop-kefu" target="_blank"></a>
                <?php endif; ?>
                <?php endif; ?>
            </span>
            <?php if ($this->_var['order']['return_url']): ?><span class="info-item"><a href="<?php echo $this->_var['order']['return_url']; ?>"class="ftx-05"><?php echo $this->_var['lang']['return_apply']; ?></a></span><?php endif; ?>	
        </div>
		<div class="c-handle" id="ss_msg_<?php echo $this->_var['order']['order_id']; ?>">
            <?php if ($this->_var['order']['order_over'] != 1): ?>
				<?php if ($this->_var['goods']['og_extension_code'] == 'package_buy' && ! $this->_var['order']['is_package']): ?>
					<span style="color:red"><?php echo $this->_var['lang']['package_already']; ?></span>
				<?php else: ?>
					<?php if ($this->_var['order']['allow_order_delay'] && $this->_var['order']['allow_order_delay_handler']): ?>
					<a href="javascript:void(0);" class="sc-btn" data-id="<?php echo $this->_var['order']['order_id']; ?>" id="sbumit_order_delay"><?php echo $this->_var['order']['allow_order_delay_handler']; ?></a>
					<?php endif; ?>
					<?php if ($this->_var['action'] == 'auction'): ?>
					<a href="user.php?act=auction_order_detail&order_id=<?php echo $this->_var['order']['order_id']; ?>"  class="sc-btn"><?php echo $this->_var['lang']['order_detail']; ?></a>
					<?php else: ?>
					<a href="user.php?act=order_detail&order_id=<?php echo $this->_var['order']['order_id']; ?>"  class="sc-btn"><?php echo $this->_var['lang']['order_detail']; ?></a>
					<?php endif; ?>
					<?php if ($this->_var['order']['delete_yes'] != 1): ?>
						<?php if ($this->_var['action'] == 'order_list' || $this->_var['action'] == 'auction'): ?>
							<a href="javascript:get_order_delete_restore('delete', <?php echo $this->_var['order']['order_id']; ?>);" class="sc-btn"><?php echo $this->_var['lang']['delete_order']; ?></a>
						<?php else: ?>
							<a href="javascript:get_order_delete_restore('restore', <?php echo $this->_var['order']['order_id']; ?>);" class="sc-btn"><?php echo $this->_var['lang']['reduction']; ?></a>
							<a href="javascript:get_order_delete_restore('thorough', <?php echo $this->_var['order']['order_id']; ?>);" class="sc-btn"><?php echo $this->_var['lang']['delete_order']; ?></a>
						<?php endif; ?>
					<?php endif; ?>
					<?php if ($this->_var['order']['handler_order_status']): ?>
						<span style="color:red"><?php echo $this->_var['order']['original_handler']; ?></span>
					<?php elseif ($this->_var['order']['handler_act'] && $this->_var['order']['original_handler']): ?>
						<?php if ($this->_var['order']['is_my_shop'] != 'my_shop'): ?>
						<a href="user.php?act=<?php echo $this->_var['order']['handler_act']; ?>&order_id=<?php echo $this->_var['order']['order_id']; ?><?php if ($this->_var['order']['sign'] != 0): ?><?php echo $this->_var['order']['sign_url']; ?><?php endif; ?><?php if ($this->_var['action'] == 'auction'): ?>&action=auction<?php endif; ?>" <?php if ($this->_var['order']['remind']): ?> onclick="if (!confirm('<?php echo $this->_var['order']['remind']; ?>')) return false;"<?php endif; ?> class="sc-btn"><?php if ($this->_var['order']['is_comment_again']): ?><?php echo $this->_var['lang']['review_comments']; ?><?php else: ?><?php echo $this->_var['order']['original_handler']; ?><?php endif; ?></a>
						<?php endif; ?>
					<?php endif; ?>
				<?php endif; ?>
            <?php endif; ?> 
		</div>
	</dd>
</dl>
<?php endforeach; else: ?>
<div class="no_records">
	<i class="no_icon"></i>
    <div class="no_info">
    	<h3>
        	<?php if ($this->_var['no_records']): ?>
            	<?php echo $this->_var['no_records']; ?>
            <?php else: ?>
        		<?php 
$k = array (
  'name' => 'get_page_no_records',
  'filename' => $this->_var['filename'],
  'act' => $this->_var['action'],
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?>
            <?php endif; ?>
        </h3>
    </div>
</div>
<?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
</div>

<?php if ($this->_var['orders']['order_list']): ?>
<div class="pages pages_warp"><?php echo $this->_var['orders']['pager']; ?></div>
<?php endif; ?>

<?php if ($this->_var['orders']['order_list']): ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'jquery.yomi.js')); ?>
<script type="text/javascript">
$(function(){
	$("*[ectype='time']").each(function(){
		$(this).yomi();
	});
	
	<?php $_from = $this->_var['orders']['order_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'order');if (count($_from)):
    foreach ($_from AS $this->_var['order']):
?>           
		<?php if ($this->_var['order']['invoice_no']): ?>
			$('#retData_' + <?php echo $this->_var['order']['order_id']; ?>).html("<center>" + json_languages.logistics_tracking_in + "</center>");
			var expressid = $('#shipping_name_'+<?php echo $this->_var['order']['order_id']; ?>).html();
			var expressno = $('#invoice_no_'+<?php echo $this->_var['order']['order_id']; ?>).html();
			$.ajax({
				url: "plugins/kuaidi/express.php",
				type: "post",
				data:'com=' + expressid + '&nu=' + expressno,
				success: function(data,textStatus){
					$('#retData_'+<?php echo $this->_var['order']['order_id']; ?>).html(data);
				},
				error: function(o){
				}
			});
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
	
	//用户中心 物流跟踪
	$(".logistics-track").hover(function(){
		$(this).addClass("hover");
		$(this).parents("tr").css({"z-index":99,"position":"relative"});
	},function(){
		$(this).removeClass("hover");
		$(this).parents("tr").css({"z-index":"auto","position":"static"});
	});
	
	//自动确认收货
	<?php if ($this->_var['open_delivery_time'] == 1): ?>
	$(":input[name='order_id[]']").each(function(index, element) {
		var order_id = $(this).val();
        $.ajax({
			url: "user.php",
			type: "get",
			data:'act=return_order_status' + '&order_id=' + order_id,
			dataType: 'json',
			success:function(result){
				if(result.error == 1){
					$('#ss_received_' + order_id).html(result.ss_received);
					$('#ss_msg_' + order_id).html(result.msg);
				}
			}
		});
    });
	<?php endif; ?> 
});
</script>
<?php endif; ?>
