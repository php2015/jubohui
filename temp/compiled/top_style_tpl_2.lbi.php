
<div class="banner catetop-banner">
    <div class="banner-ad">
        <div class="w w1200">
            <?php 
$k = array (
  'name' => 'get_adv_child',
  'ad_arr' => $this->_var['top_style_right_banne'],
  'id' => $this->_var['cate_info']['cat_id'],
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?>
        </div>
    </div>
    <div class="bd"><?php 
$k = array (
  'name' => 'get_adv_child',
  'ad_arr' => $this->_var['top_style_elec_banner'],
  'id' => $this->_var['cate_info']['cat_id'],
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?></div>
    <div class="hd"><ul></ul></div>
</div>
<div class="catetop-main w w1200" ectype="catetopWarp">
    
    <div class="hotrecommend" id="hotrecommend">
        <div class="hd">
            <h2><?php echo $this->_var['lang']['Popular_recommendation']; ?></h2>
            <div class="extra">
                <div class="hr-slide-hd">
                    <ul>
                        <li><?php echo $this->_var['lang']['new_first_start']; ?></li>
                        <li><?php echo $this->_var['lang']['hot_rankings']; ?></li>
                        <li><?php echo $this->_var['lang']['best_goods']; ?></li>
                        <li><?php echo $this->_var['lang']['today_deal']; ?></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="bd">
            <ul class="clearfix">
                <?php $_from = $this->_var['cate_top_new_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from AS $this->_var['goods']):
        $this->_foreach['name']['iteration']++;
?>
                <?php if ($this->_foreach['name']['iteration'] < 7): ?>
                <li>
                    <div class="p-img"><a href="<?php echo $this->_var['goods']['url']; ?>"><img src="<?php echo $this->_var['goods']['thumb']; ?>" alt=""></a></div>
                    <div class="p-price">
                    	<?php if ($this->_var['goods']['promote_price'] != 0 && $this->_var['goods']['promote_price'] != ''): ?>
                    		<?php echo $this->_var['goods']['promote_price']; ?>
                       	<?php else: ?>
                        	<?php echo $this->_var['goods']['shop_price']; ?>
                       	<?php endif; ?>
                    </div>
                    <div class="p-name"><a href="<?php echo $this->_var['goods']['url']; ?>" title="<?php echo htmlspecialchars($this->_var['goods']['name']); ?>"><?php echo $this->_var['goods']['name']; ?></a></div>
                    <a href="<?php echo $this->_var['goods']['url']; ?>" class="p-btn"><?php echo $this->_var['lang']['View_details']; ?></a>
                </li>
                <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            </ul>
            <ul class="clearfix">
                <?php $_from = $this->_var['cate_top_hot_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from AS $this->_var['goods']):
        $this->_foreach['name']['iteration']++;
?>
                <?php if ($this->_foreach['name']['iteration'] < 7): ?>
                <li>
                    <div class="p-img"><a href="<?php echo $this->_var['goods']['url']; ?>"><img src="<?php echo $this->_var['goods']['thumb']; ?>" alt=""></a></div>
                    <div class="p-price">
                    	<?php if ($this->_var['goods']['promote_price'] != 0 && $this->_var['goods']['promote_price'] != ''): ?>
                        	<?php echo $this->_var['goods']['promote_price']; ?>
                    	<?php else: ?>
                        	<?php echo $this->_var['goods']['shop_price']; ?>
                    	<?php endif; ?>
                    </div>
                    <div class="p-name"><a href="<?php echo $this->_var['goods']['url']; ?>" title="<?php echo htmlspecialchars($this->_var['goods']['name']); ?>"><?php echo $this->_var['goods']['name']; ?></a></div>
                    <a href="<?php echo $this->_var['goods']['url']; ?>" class="p-btn"><?php echo $this->_var['lang']['View_details']; ?></a>
                </li>
                <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            </ul>
            <ul class="clearfix">
                <?php $_from = $this->_var['cate_top_best_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from AS $this->_var['goods']):
        $this->_foreach['name']['iteration']++;
?>
                <?php if ($this->_foreach['name']['iteration'] < 7): ?>
                <li>
                    <div class="p-img"><a href="<?php echo $this->_var['goods']['url']; ?>"><img src="<?php echo $this->_var['goods']['thumb']; ?>" alt=""></a></div>
                    <div class="p-price">
                        <?php if ($this->_var['goods']['promote_price'] != 0 && $this->_var['goods']['promote_price'] != ''): ?>
                        	<?php echo $this->_var['goods']['promote_price']; ?>
                        <?php else: ?>
                        	<?php echo $this->_var['goods']['shop_price']; ?>
                        <?php endif; ?>
                    </div>
                    <div class="p-name"><a href="<?php echo $this->_var['goods']['url']; ?>" title="<?php echo htmlspecialchars($this->_var['goods']['name']); ?>"><?php echo $this->_var['goods']['name']; ?></a></div>
                    <a href="<?php echo $this->_var['goods']['url']; ?>" class="p-btn"><?php echo $this->_var['lang']['View_details']; ?></a>
                </li>
                <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            </ul>
            <ul class="clearfix">
                <?php $_from = $this->_var['cate_top_promote_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from AS $this->_var['goods']):
        $this->_foreach['name']['iteration']++;
?>
                <?php if ($this->_foreach['name']['iteration'] < 7): ?>
                <li>
                    <div class="p-img"><a href="<?php echo $this->_var['goods']['url']; ?>"><img src="<?php echo $this->_var['goods']['thumb']; ?>" alt=""></a></div>
                    <div class="p-price">
                        <?php if ($this->_var['goods']['promote_price'] != 0 && $this->_var['goods']['promote_price'] != ''): ?>
                        	<?php echo $this->_var['goods']['promote_price']; ?>
                       	<?php else: ?>
                        	<?php echo $this->_var['goods']['shop_price']; ?>
                       	<?php endif; ?>
                    </div>
                    <div class="p-name"><a href="<?php echo $this->_var['goods']['url']; ?>" title="<?php echo htmlspecialchars($this->_var['goods']['name']); ?>"><?php echo $this->_var['goods']['name']; ?></a></div>
                    <a href="<?php echo $this->_var['goods']['url']; ?>" class="p-btn"><?php echo $this->_var['lang']['View_details']; ?></a>
                </li>
                <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            </ul>
        </div>
    </div>
    
    <div class="catetop-brand clearfix" id="catBrand">
        <div class="hd"><h2><?php echo $this->_var['lang']['brand_flagship']; ?></h2></div>
        <div class="bd">
            <div class="cb-l"><?php 
$k = array (
  'name' => 'get_adv_child',
  'ad_arr' => $this->_var['top_style_elec_brand_left'],
  'id' => $this->_var['cate_info']['cat_id'],
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?></div>
            <div class="cb-m">
                <?php 
$k = array (
  'name' => 'get_adv_child',
  'ad_arr' => $this->_var['top_style_elec_brand'],
  'id' => $this->_var['cate_info']['cat_id'],
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?>
            </div>
            <div class="cb-r">
                <ul>
                <?php $_from = $this->_var['cat_brand']['brands']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'brand');$this->_foreach['cat_brand'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['cat_brand']['total'] > 0):
    foreach ($_from AS $this->_var['brand']):
        $this->_foreach['cat_brand']['iteration']++;
?>
                <?php if ($this->_foreach['cat_brand']['iteration'] < 13): ?>
                <li><a href="<?php echo $this->_var['brand']['url']; ?>" target="_blank" title="<?php echo $this->_var['brand']['brand_name']; ?>"><img src="<?php echo $this->_var['brand']['brand_logo']; ?>" alt=""></a></li>
                <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                </ul>
            </div>
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
                            <div class="p-name"><a href="<?php echo $this->_var['look']['url']; ?>" target="_blank" title="<?php echo htmlspecialchars($this->_var['look']['name']); ?>"><?php echo $this->_var['look']['name']; ?></a></div>
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
        	<div class="catetop-lift-item lift-item-current" ectype="liftItem" data-target="#hotrecommend"><span><?php echo $this->_var['lang']['Popular_recommendation']; ?></span></div>
            <div class="catetop-lift-item" ectype="liftItem" data-target="#catBrand"><span><?php echo $this->_var['lang']['brand_flagship']; ?></span></div>
        	<?php $_from = $this->_var['categories_child']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cat_0_55296700_1568705678');$this->_foreach['child'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['child']['total'] > 0):
    foreach ($_from AS $this->_var['cat_0_55296700_1568705678']):
        $this->_foreach['child']['iteration']++;
?>
            <div class="catetop-lift-item lift-floor-item" ectype="liftItem"><span><?php echo $this->_var['cat_0_55296700_1568705678']['name']; ?></span></div>
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
			Floor.slide({mainCell:".bd-right",titCell:".fgoods-hd ul li"});
		}
	</script>
</div>