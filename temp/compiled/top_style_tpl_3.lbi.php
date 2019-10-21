<div class="banner catetop-banner">
	<div class="banner-ad">
		<div class="w w1200">
			<ul class="list">
				<?php 
$k = array (
  'name' => 'get_adv_child',
  'ad_arr' => $this->_var['top_style_right_banne'],
  'id' => $this->_var['cate_info']['cat_id'],
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?>
			</ul>
		</div>
	</div>
	<div class="bd">
		<?php 
$k = array (
  'name' => 'get_adv_child',
  'ad_arr' => $this->_var['top_style_food_banner'],
  'id' => $this->_var['cate_info']['cat_id'],
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?>
	</div>
    <div class="food-hd"><ul></ul></div>
</div>

<div class="catetop-main w w1200" ectype="catetopWarp">
	
	<div class="bestad" id="bestad">
		<div class="hd"><h2><?php echo $this->_var['lang']['best_goods']; ?></h2></div>
		<div class="bd clearfix">
        	<?php 
$k = array (
  'name' => 'get_adv_child',
  'ad_arr' => $this->_var['top_style_food_hot'],
  'id' => $this->_var['cate_info']['cat_id'],
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?>
		</div>
	</div>
	
	
	<div class="catetop-floor-wp" ectype="goods_cat_level"></div>
    <div class="floor-loading" ectype="floor-loading"><div class="floor-loading-warp"><img src="themes/<?php echo $GLOBALS['_CFG']['template']; ?>/images/load/loading.gif"></div></div>

	
	<div class="atwillgo" id="atwillgo">
		<div class="awg-hd">
			<h2><?php echo $this->_var['lang']['purchase_hand']; ?></h2>
		</div>
		<div class="awg-bd">
			<div class="atwillgo-slide">
				<a href="javascript:;" class="prev"><i class="iconfont icon-left"></i></a>
				<a href="javascript:;" class="next"><i class="iconfont icon-right"></i></a>
				<div class="hd">
					<ul></ul>
				</div>
				<div class="bd">
					<ul>
                        <?php $_from = $this->_var['havealook']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'look');if (count($_from)):
    foreach ($_from AS $this->_var['look']):
?>
                        <li>
                            <div class="p-img"><a href="<?php echo $this->_var['look']['url']; ?>" target="_blank"><img src="<?php echo $this->_var['look']['thumb']; ?>" alt=""></a></div>
                            <div class="p-price">
                                <?php if ($this->_var['look']['promote_price'] != ''): ?>
                                <?php echo $this->_var['look']['promote_price']; ?>
                                <?php else: ?>
                                <?php echo $this->_var['look']['shop_price']; ?>
                                <?php endif; ?>
                            </div>
                            <div class="p-name"><a href="<?php echo $this->_var['look']['url']; ?>" target="_blank" title="<?php echo $this->_var['look']['name']; ?>"><?php echo $this->_var['look']['name']; ?></a></div>
                            <div class="p-btn"><a href="<?php echo $this->_var['look']['url']; ?>" target="_blank"><?php echo $this->_var['lang']['View_details']; ?></a></div>
                        </li>
                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    </ul>
				</div>
			</div>
		</div>
	</div>
	
    <div class="catetop-lift lift-hide" ectype="lift">
    	<div class="lift-list" ectype="liftList">
        	<div class="catetop-lift-item lift-item-current" ectype="liftItem" data-target="#bestad"><span><?php echo $this->_var['lang']['best_goods']; ?></span></div>
        	<?php $_from = $this->_var['categories_child']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cat_0_86148500_1569574631');$this->_foreach['child'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['child']['total'] > 0):
    foreach ($_from AS $this->_var['cat_0_86148500_1569574631']):
        $this->_foreach['child']['iteration']++;
?>
            <div class="catetop-lift-item lift-floor-item" ectype="liftItem"><span><?php echo $this->_var['cat_0_86148500_1569574631']['name']; ?></span></div>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        	<div class="catetop-lift-item lift-item-top" ectype="liftItem"><span><i class="iconfont icon-up"></i></span></div>
        </div>
    </div>
    <input name="region_id" value="<?php echo $this->_var['region_id']; ?>" type="hidden">
    <input name="area_id" value="<?php echo $this->_var['area_id']; ?>" type="hidden">
    <input name="area_city" value="<?php echo $this->_var['area_city']; ?>" type="hidden">
    <input name="cat_id" value="<?php echo $this->_var['cate_info']['cat_id']; ?>" type="hidden">
    <input name="tpl" value="<?php echo $this->_var['cate_info']['top_style_tpl']; ?>" type="hidden">
    <script type="text/javascript">
		//楼层以后加载后使用js
		function loadCategoryTop(key){
			var Floor = $("#floor_"+key);
			var length = Floor.find(".l-bd li").length;
			Floor.slide({titCell:".fgoods-hd ul li",mainCell:".bd-right"});
			if(length>1){
				Floor.slide(".catetop-floor .l-slide").slide({mainCell: '.l-bd ul',titCell: '.l-hd ul',effect: 'left',autoPage: '<li></li>',autoPlay: 3000});
			}
		}
	</script>
</div>