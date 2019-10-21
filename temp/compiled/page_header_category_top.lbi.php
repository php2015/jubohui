<div class="site-nav" id="site-nav">
    <div class="w w1200">
        <div class="fl">	
            <?php 
$k = array (
  'name' => 'header_region',
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?>
            <div class="txt-info" id="ECS_MEMBERZONE">
                <?php 
$k = array (
  'name' => 'member_info',
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?>	
            </div>
        </div>
        <ul class="quick-menu fr">
            <?php if ($this->_var['navigator_list']['top']): ?>
            <?php $_from = $this->_var['navigator_list']['top']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'nav');$this->_foreach['nav_top_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['nav_top_list']['total'] > 0):
    foreach ($_from AS $this->_var['key'] => $this->_var['nav']):
        $this->_foreach['nav_top_list']['iteration']++;
?>
            <?php if (($this->_foreach['nav_top_list']['iteration'] - 1) < 4): ?>
            <li>
            	<div class="dt"><a href="<?php echo $this->_var['nav']['url']; ?>" <?php if ($this->_var['nav']['opennew']): ?>target="_blank"<?php endif; ?>><?php echo $this->_var['nav']['name']; ?></a></div>
            </li>
            <li class="spacer"></li>
            <?php endif; ?>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            <?php endif; ?>
            <?php if ($this->_var['navigator_list']['top']): ?>
            <li class="li_dorpdown" data-ectype="dorpdown">
                <div class="dt dsc-cm"><?php echo $this->_var['lang']['Site_navigation']; ?><i class="iconfont icon-down"></i></div>
                <div class="dd dorpdown-layer">
                    <dl class="fore1">
                        <dt><?php echo $this->_var['lang']['characteristic_theme']; ?></dt>
                        <dd>
                            <?php $_from = $this->_var['top_cat_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'topc_cats');$this->_foreach['nav_top_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['nav_top_list']['total'] > 0):
    foreach ($_from AS $this->_var['key'] => $this->_var['topc_cats']):
        $this->_foreach['nav_top_list']['iteration']++;
?>
                                <?php if (($this->_foreach['nav_top_list']['iteration'] - 1) < 3): ?>
                                    <div class="item"><a href="<?php echo $this->_var['topc_cats']['url']; ?>" target="_blank"><?php echo $this->_var['topc_cats']['cat_alias_name']; ?></a></div>
                                <?php endif; ?>
                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                        </dd>
                    </dl>
                    <dl class="fore2">
                        <dt><?php echo $this->_var['lang']['modules_txt_promo']; ?></dt>
                        <dd>
                            <?php $_from = $this->_var['navigator_list']['top']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'nav');$this->_foreach['nav_top_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['nav_top_list']['total'] > 0):
    foreach ($_from AS $this->_var['key'] => $this->_var['nav']):
        $this->_foreach['nav_top_list']['iteration']++;
?>
                                <?php if (($this->_foreach['nav_top_list']['iteration'] - 1) >= 4): ?>
                                    <div class="item"><a href="<?php echo $this->_var['nav']['url']; ?>"<?php if ($this->_var['nav']['opennew']): ?> target="_blank"<?php endif; ?>><?php echo $this->_var['nav']['name']; ?></a></div>
                                <?php endif; ?>
                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                        </dd>
                    </dl>
                </div>
            </li>
            <?php endif; ?>
        </ul>
    </div>
</div>
<div class="header">
    <div class="w w1200">
        <div class="logo">
            <div class="logoImg"><a href="<?php echo $this->_var['url_index']; ?>"><img src="themes/ecmoban_dsc2017/images/logo.gif" /></a></div>
            <div class="logoAdv"><a href="<?php echo $this->_var['url_merchants']; ?>"><img src="themes/ecmoban_dsc2017/images/ecsc-join.gif" /></a></div>
        </div>
        <div class="dsc-search">
            <div class="form">
                <form id="searchForm" name="searchForm" method="get" action="search.php" onSubmit="return checkSearchForm(this)" class="search-form">
                    <input autocomplete="off" onKeyUp="lookup(this.value);" name="keywords" type="text" id="keyword" value="<?php if ($this->_var['search_keywords']): ?><?php echo $this->_var['search_keywords']; ?><?php else: ?><?php 
$k = array (
  'name' => 'rand_keyword',
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?><?php endif; ?>" class="search-text"/>
                    <input type="hidden" name="store_search_cmt" value="<?php echo empty($this->_var['search_type']) ? '0' : $this->_var['search_type']; ?>">
                    <button type="submit" class="button button-goods" onclick="checkstore_search_cmt(0)"><?php echo $this->_var['lang']['serch_goods']; ?></button>
                    <button type="submit" class="button button-store" onclick="checkstore_search_cmt(1)"><?php echo $this->_var['lang']['serch_shop']; ?></button>
                </form>
                <?php if ($this->_var['searchkeywords']): ?>
                <ul class="keyword">
                <?php $_from = $this->_var['searchkeywords']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'val');if (count($_from)):
    foreach ($_from AS $this->_var['val']):
?>
                <li><a href="search.php?keywords=<?php echo urlencode($this->_var['val']); ?>" target="_blank"><?php echo $this->_var['val']; ?></a></li>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                </ul>
                <?php endif; ?>
                
                <div class="suggestions_box" id="suggestions" style="display:none;">
                    <div class="suggestions_list" id="auto_suggestions_list">
                        &nbsp;
                    </div>
                </div>
                
            </div>
        </div>
        <div class="shopCart" data-ectype="dorpdown" id="ECS_CARTINFO" data-carteveval="0">
            <?php 
$k = array (
  'name' => 'cart_info',
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?>
        </div>
    </div>
</div>
<?php if ($this->_var['cate_info']['top_style_tpl'] == 1): ?>
<div class="nav dsc-zoom">
	<div class="w w1200">
		<div class="categorys">
			<div class="categorys-type"><a href="javascript:;"><?php echo $this->_var['cate_info']['cat_name']; ?></a></div>
			<div class="categorys-tab-content">
				<div class="categorys-items" ectype="items">
					<?php $_from = $this->_var['categories_child']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cat');$this->_foreach['child'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['child']['total'] > 0):
    foreach ($_from AS $this->_var['cat']):
        $this->_foreach['child']['iteration']++;
?>
                    <?php if (($this->_foreach['child']['iteration'] - 1) < 5): ?>
					<div class="categorys-item" ectype="item" data-catid="<?php echo $this->_var['cat']['id']; ?>" data-eveval="0">
						<div class="item-content">
							<i class="iconfont icon-right"></i>
							<div class="categorys-title">
								<strong><a href="<?php echo $this->_var['cat']['url']; ?>" target="_blank"><?php echo htmlspecialchars($this->_var['cat']['name']); ?></a></strong>
								<span>
                                    <?php $_from = $this->_var['cat']['cat_id']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'child');$this->_foreach['no'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['no']['total'] > 0):
    foreach ($_from AS $this->_var['child']):
        $this->_foreach['no']['iteration']++;
?>
                                    <?php if (($this->_foreach['no']['iteration'] - 1) < 6): ?>
                                    <a href="<?php echo $this->_var['child']['url']; ?>" target="_blank"><?php echo htmlspecialchars($this->_var['child']['name']); ?></a>
                                    <?php endif; ?>
                                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
								</span>
							</div>
						</div>
						<div class="categorys-items-layer" ectype="cateLayer">
							<div class="catetop-layer-con clearfix">
								<h3><a href="javascript:;"><?php echo htmlspecialchars($this->_var['cat']['name']); ?></a></h3>
								<ul class="cate-list">
									<?php $_from = $this->_var['cat']['cat_id']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'child');$this->_foreach['no'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['no']['total'] > 0):
    foreach ($_from AS $this->_var['child']):
        $this->_foreach['no']['iteration']++;
?>
									<li><a href="<?php echo $this->_var['child']['url']; ?>"><?php echo htmlspecialchars($this->_var['child']['name']); ?></a></li>
									<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
								</ul>
								<ul class="cate-logo" ectype="subitems_<?php echo $this->_var['cat']['id']; ?>">
								</ul>
							</div>
						</div>
					</div>
                    <?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				</div>
			</div>
		</div>
		<div class="nav-main">
			<ul class="navitems">
                <li><a href="index.php" <?php if ($this->_var['navigator_list']['config']['index'] == 1): ?>class="curr"<?php endif; ?>><?php echo $this->_var['lang']['home']; ?></a></li>
                <?php $_from = $this->_var['navigator_list']['middle']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'nav');$this->_foreach['nav_middle_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['nav_middle_list']['total'] > 0):
    foreach ($_from AS $this->_var['nav']):
        $this->_foreach['nav_middle_list']['iteration']++;
?>
                <li><a href="<?php echo $this->_var['nav']['url']; ?>" <?php if ($this->_var['nav']['active'] == 1): ?>class="curr"<?php endif; ?> <?php if ($this->_var['nav']['opennew']): ?>target="_blank"<?php endif; ?>><?php echo $this->_var['nav']['name']; ?></a></li>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</ul>
		</div>
	</div>
</div>
<?php elseif ($this->_var['cate_info']['top_style_tpl'] == 2): ?>
<div class="nav dsc-zoom">
    <div class="w w1200">
        <div class="categorys">
            <div class="categorys-type"><a href="javascript:;"><?php echo $this->_var['cate_info']['cat_name']; ?></a></div>
            <div class="categorys-tab-content">
                <div class="categorys-items" ectype="items">
                    <?php $_from = $this->_var['categories_child']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cat');$this->_foreach['child'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['child']['total'] > 0):
    foreach ($_from AS $this->_var['cat']):
        $this->_foreach['child']['iteration']++;
?>
                    <?php if (($this->_foreach['child']['iteration'] - 1) < 5): ?>
                    <div class="categorys-item" ectype="item" data-catid="<?php echo $this->_var['cat']['id']; ?>">
                        <div class="item-content">
                            <div class="categorys-title">
                                <strong><a href="<?php echo $this->_var['cat']['url']; ?>" target="_blank"><?php echo htmlspecialchars($this->_var['cat']['name']); ?></a></strong>
                                <span>
                                    <?php $_from = $this->_var['cat']['cat_id']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'child');$this->_foreach['no'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['no']['total'] > 0):
    foreach ($_from AS $this->_var['child']):
        $this->_foreach['no']['iteration']++;
?>
                                    <?php if (($this->_foreach['no']['iteration'] - 1) < 3): ?>
                                    <a href="<?php echo $this->_var['child']['url']; ?>" target="_blank"><?php echo htmlspecialchars($this->_var['child']['name']); ?></a>
                                    <?php endif; ?>
                                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                </span>
                            </div>
                        </div>
                        <div class="categorys-items-layer">
                            <div class="catetop-layer-con clearfix">
                                <h3><?php echo htmlspecialchars($this->_var['cat']['name']); ?></h3>
                                <ul class="cate-list">
                                    <?php $_from = $this->_var['cat']['cat_id']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'child');$this->_foreach['no'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['no']['total'] > 0):
    foreach ($_from AS $this->_var['child']):
        $this->_foreach['no']['iteration']++;
?>
                                    <li><a href="<?php echo $this->_var['child']['url']; ?>" target="_blank"><?php echo htmlspecialchars($this->_var['child']['name']); ?></a></li>
                                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                </ul>
                            </div>
                            <?php 
$k = array (
  'name' => 'get_adv_child',
  'ad_arr' => $this->_var['cat']['cate_layer_elec_row'],
  'id' => $this->_var['cat']['id'],
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                </div>
            </div>
        </div>
        <div class="nav-main" id="nav">
            <ul class="navitems">
                <li><a href="index.php"<?php if ($this->_var['navigator_list']['config']['index'] == 1): ?> class="curr"<?php endif; ?>><?php echo $this->_var['lang']['home']; ?></a></li>
                <?php $_from = $this->_var['navigator_list']['middle']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'nav');$this->_foreach['nav_middle_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['nav_middle_list']['total'] > 0):
    foreach ($_from AS $this->_var['nav']):
        $this->_foreach['nav_middle_list']['iteration']++;
?>
                <li><a href="<?php echo $this->_var['nav']['url']; ?>"<?php if ($this->_var['nav']['active'] == 1): ?> class="curr"<?php endif; ?> <?php if ($this->_var['nav']['opennew']): ?>target="_blank"<?php endif; ?>><?php echo $this->_var['nav']['name']; ?></a></li>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            </ul>
        </div>
    </div>
</div>  
<?php elseif ($this->_var['cate_info']['top_style_tpl'] == 3): ?>
<div class="nav dsc-zoom">
	<div class="w w1200">
		<div class="categorys">
			<div class="categorys-type"><a href="javascript:;"><?php echo $this->_var['cate_info']['cat_name']; ?></a></div>
			<div class="categorys-tab-content">
				<div class="categorys-items" ectype="items">
				<?php $_from = $this->_var['categories_child']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cat');$this->_foreach['child'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['child']['total'] > 0):
    foreach ($_from AS $this->_var['cat']):
        $this->_foreach['child']['iteration']++;
?>
                	<?php if (($this->_foreach['child']['iteration'] - 1) < 7): ?>
					<div class="categorys-item" ectype="item" data-catid="<?php echo $this->_var['cat']['id']; ?>">
						<div class="item-content">
							<?php if ($this->_var['cat']['style_icon'] == 'other'): ?>
                            <?php if ($this->_var['cat']['cat_icon']): ?><div class="icon-other"><img src="<?php echo $this->_var['cat']['cat_icon']; ?>" alt="分类图标"></div><?php endif; ?>
							<?php else: ?>
                            <i class="iconfont icon-<?php echo $this->_var['cat']['style_icon']; ?>"></i>
							<?php endif; ?>							
							<div class="categorys-title">
								<strong><a href="<?php echo $this->_var['cat']['url']; ?>" target="_blank"><?php echo htmlspecialchars($this->_var['cat']['name']); ?></a></strong>
								<span>
                                    <?php $_from = $this->_var['cat']['cat_id']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'child');$this->_foreach['no'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['no']['total'] > 0):
    foreach ($_from AS $this->_var['child']):
        $this->_foreach['no']['iteration']++;
?>
                                    <?php if (($this->_foreach['no']['iteration'] - 1) < 3): ?>
                                    <a href="<?php echo $this->_var['child']['url']; ?>" target="_blank"><?php echo htmlspecialchars($this->_var['child']['name']); ?></a>
                                    <?php endif; ?>
                                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
								</span>
							</div>
						</div>
						<div class="categorys-items-layer">
							<div class="catetop-layer-con clearfix">
								<ul class="cate-list">
                                    <?php $_from = $this->_var['cat']['cat_id']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'child');$this->_foreach['no'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['no']['total'] > 0):
    foreach ($_from AS $this->_var['child']):
        $this->_foreach['no']['iteration']++;
?>
                                    <li><a href="<?php echo $this->_var['child']['url']; ?>" target="_blank"><?php echo htmlspecialchars($this->_var['child']['name']); ?></a></li>
                                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
								</ul>
								<?php 
$k = array (
  'name' => 'get_adv_child',
  'ad_arr' => $this->_var['cat']['cate_layer_elec_row'],
  'id' => $this->_var['cat']['id'],
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?>
							</div>
						</div>
					</div>
                    <?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				</div>			
			</div>
		</div>
		<div class="nav-main" id="nav">
			<ul class="navitems">
                <li><a href="index.php" <?php if ($this->_var['navigator_list']['config']['index'] == 1): ?>class="curr"<?php endif; ?>><?php echo $this->_var['lang']['home']; ?></a></li>
                <?php $_from = $this->_var['navigator_list']['middle']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'nav');$this->_foreach['nav_middle_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['nav_middle_list']['total'] > 0):
    foreach ($_from AS $this->_var['nav']):
        $this->_foreach['nav_middle_list']['iteration']++;
?>
                <li><a href="<?php echo $this->_var['nav']['url']; ?>" <?php if ($this->_var['nav']['active'] == 1): ?>class="curr"<?php endif; ?> <?php if ($this->_var['nav']['opennew']): ?>target="_blank"<?php endif; ?>><?php echo $this->_var['nav']['name']; ?></a></li>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</ul>
		</div>
	</div>
</div>
<?php else: ?>
<div class="nav dsc-zoom">
	<div class="w w1200">
		<div class="categorys">
			<div class="categorys-type"><a href="javascript:;" target="_blank"><i class="iconfont icon-liebiao"></i><?php echo $this->_var['cate_info']['cat_name']; ?></a></div>
			<div class="categorys-tab-content">
				<div class="categorys-items" ectype="items">
					<?php $_from = $this->_var['categories_child']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cat');$this->_foreach['child'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['child']['total'] > 0):
    foreach ($_from AS $this->_var['cat']):
        $this->_foreach['child']['iteration']++;
?>
					<div class="categorys-item" ectype="item" data-defa="1" data-catid="<?php echo $this->_var['cat']['id']; ?>" data-eveval="0">
						<div class="item-content">
							<div class="categorys-title">
								<strong><a href="<?php echo $this->_var['cat']['url']; ?>" target="_blank"><?php echo htmlspecialchars($this->_var['cat']['name']); ?></a></strong>
							</div>
						</div>
						<div class="categorys-items-layer" ectype="cateLayer">
							<div class="catetop-layer-con clearfix">
                            	<div class="tit"><?php echo htmlspecialchars($this->_var['cat']['name']); ?></div>
								<ul class="cate-list">
                                    <?php $_from = $this->_var['cat']['cat_id']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'child');$this->_foreach['no'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['no']['total'] > 0):
    foreach ($_from AS $this->_var['child']):
        $this->_foreach['no']['iteration']++;
?>
                                    <li><a href="<?php echo $this->_var['child']['url']; ?>" target="_blank"><?php echo htmlspecialchars($this->_var['child']['name']); ?></a></li>
                                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
								</ul>
                                <div class="brand-list" ectype="subitems_<?php echo $this->_var['cat']['id']; ?>">
                                </div>
							</div>
						</div>
					</div>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				</div>
			</div>
		</div>
		<div class="nav-main">
			<ul class="navitems">
                <li><a href="index.php"<?php if ($this->_var['navigator_list']['config']['index'] == 1): ?> class="curr"<?php endif; ?>><?php echo $this->_var['lang']['home']; ?></a></li>
                <?php $_from = $this->_var['navigator_list']['middle']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'nav');$this->_foreach['nav_middle_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['nav_middle_list']['total'] > 0):
    foreach ($_from AS $this->_var['nav']):
        $this->_foreach['nav_middle_list']['iteration']++;
?>
                <li><a href="<?php echo $this->_var['nav']['url']; ?>"<?php if ($this->_var['nav']['active'] == 1): ?> class="curr"<?php endif; ?><?php if ($this->_var['nav']['opennew']): ?> target="_blank"<?php endif; ?>><?php echo $this->_var['nav']['name']; ?></a></li>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</ul>
		</div>
	</div>
</div>
<?php endif; ?>
