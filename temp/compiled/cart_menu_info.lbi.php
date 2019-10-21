<div class="ecsc-icon">
    <i class="ecsc-left"></i>
    <i class="ecsc-right">></i>
    <i class="ecsc-count cart_num"><?php echo $this->_var['str']; ?></i>
    <a target="_blank" href="flow.php"><?php echo $this->_var['lang']['cat_list']; ?></a>
</div>
<?php if ($this->_var['goods']): ?>
<div class="ecscup-content">
    <div class="ecscmc">
        <ul>
        	<?php $_from = $this->_var['goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods_0_91688700_1569574603');$this->_foreach['goods'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['goods']['total'] > 0):
    foreach ($_from AS $this->_var['goods_0_91688700_1569574603']):
        $this->_foreach['goods']['iteration']++;
?>
            <li>
                <div class="ecsc-img"><a href="<?php echo $this->_var['goods_0_91688700_1569574603']['url']; ?>" target="_blank"><img src="<?php echo $this->_var['goods_0_91688700_1569574603']['goods_thumb']; ?>" /></a></div>
                <div class="ecsc-way">
                    <a href="<?php echo $this->_var['goods_0_91688700_1569574603']['url']; ?>" target="_blank" class="title"><?php echo $this->_var['goods_0_91688700_1569574603']['short_name']; ?></a>
                    <div class="deal">
                        <div class="count">
                            <a href="javascript:void(0);" class="count-subtract ecsc-minusOff"><s></s></a><span class="num"><?php echo empty($this->_var['goods_0_91688700_1569574603']['goods_number']) ? '1' : $this->_var['goods_0_91688700_1569574603']['goods_number']; ?></span><a href="javascript:void(0);" class="count-add"><s></s><b></b></a>
                        </div>
                        <div class="price"><?php echo $this->_var['goods_0_91688700_1569574603']['goods_price']; ?></div>
                        <a href="javascript:void(0);" onClick="deleteCartGoods(<?php echo $this->_var['goods_0_91688700_1569574603']['rec_id']; ?>)" class="close"><?php echo $this->_var['lang']['drop']; ?></a>
                    </div>
                </div>
            </li>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </ul>
    </div>
    <div class="ecscmb">
        <div class="total"><span class="total-num cart_num"><?php echo $this->_var['str']; ?></span><?php echo $this->_var['lang']['piece_total']; ?>：<span class="total-price"><?php echo $this->_var['cart_info']['amount']; ?></span></div>
        <a href="flow.php" target="_blank" class="ecsc-cart"><?php echo $this->_var['lang']['go_to_cart']; ?> <i class="ecsc-right">></i></a>
    </div>
</div>
<?php endif; ?>

<script type="text/javascript">
function deleteCartGoods(rec_id)
{
Ajax.call('delete_cart_goods.php', 'id='+rec_id, deleteCartGoodsResponse, 'POST', 'JSON');
}

/**
 * 接收返回的信息
 */
function deleteCartGoodsResponse(res)
{
  if (res.error)
  {
    alert(res.err_msg);
  }
  else
  {
	  $("#ECS_CARTINFO").html(res.content);
	  $(".cart_num").html(res.cart_num);
  }
}
</script>