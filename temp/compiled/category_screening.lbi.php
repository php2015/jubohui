
<?php if ($this->_var['brands']['1'] || $this->_var['price_grade']['1'] || $this->_var['filter_attr_list'] || $this->_var['color_search'] || $this->_var['get_bd'] || $this->_var['g_price'] || $this->_var['g_array'] || $this->_var['c_array'] || $this->_var['parray']): ?>
<div class="right-extra" rewrite=<?php echo $this->_var['rewrite']; ?>>
    <div class="u_cloose">
        <dl>
            <dt><?php echo $this->_var['lang']['Selected_condition']; ?>：</dt>
            <dd>
                <?php if (! $this->_var['get_bd']['bd'] && ! $this->_var['g_price'] && ! $this->_var['parray'] && ! $this->_var['c_array']['attr_value'] && ! $this->_var['g_array']): ?>
                &nbsp;
                <?php endif; ?>
            
                <?php if ($this->_var['get_bd']['bd']): ?>
                <div class="get_item" title="<?php echo $this->_var['get_bd']['bd']; ?>">
                    <b><?php echo $this->_var['lang']['brand']; ?>：</b>
                    <em><?php echo $this->_var['get_bd']['bd']; ?></em>
                    <a href="<?php echo $this->_var['get_bd']['br_url']; ?>"></a>
                </div>
                <?php endif; ?>
            
                <?php if ($this->_var['g_price']): ?>
                <?php $_from = $this->_var['g_price']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'price');if (count($_from)):
    foreach ($_from AS $this->_var['price']):
?>
                <div class="get_item" title="<?php echo $this->_var['price']['price_range']; ?>">
                    <b><?php echo $this->_var['lang']['price']; ?>：</b>
                    <em><?php echo $this->_var['price']['price_range']; ?></em>
                    <a href="<?php echo $this->_var['price']['url']; ?>"></a>
                </div>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                <?php endif; ?>
            
                <?php if ($this->_var['parray']): ?>
                <div class="get_item" title="{$parray.min_max">
                    <b><?php echo $this->_var['lang']['price']; ?>：</b>
                    <em><?php echo $this->_var['parray']['min_max']; ?></em>
                    <a href="<?php echo $this->_var['parray']['purl']; ?>"></a>
                </div>
                <?php endif; ?>
            
                <?php if ($this->_var['c_array']['attr_value']): ?>
                <div class="get_item" title="<?php echo $this->_var['c_array']['attr_value']; ?>">
                    <b><?php echo $this->_var['c_array']['filter_attr_name']; ?>：</b>
                    <em><?php echo $this->_var['c_array']['attr_value']; ?></em>
                    <a href="<?php echo $this->_var['c_array']['url']; ?>"></a>
                </div>
                <?php endif; ?>
            
                
            
                <?php if ($this->_var['g_array']): ?>  
                <?php $_from = $this->_var['g_array']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'garray');if (count($_from)):
    foreach ($_from AS $this->_var['garray']):
?>
                <div class="get_item" title="<?php echo $this->_var['garray']['g_name']; ?>">
                    <span class="brand_t"><?php echo $this->_var['garray']['filter_attr_name']; ?>：</span>
                    <em><?php echo $this->_var['garray']['g_name']; ?></em>
                    <a href="<?php echo $this->_var['garray']['g_url']; ?>"></a>
                </div>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                <?php endif; ?>
            </dd>
            <dd class="give_up_all"><a href="<?php if ($this->_var['script_name'] == 'search'): ?>search.php?<?php if ($this->_var['cou_id']): ?>&cou_id=<?php echo $this->_var['cou_id']; ?><?php endif; ?>&keywords=<?php echo $this->_var['pager']['search']['keywords']; ?><?php else: ?>category.php?id=<?php echo $this->_var['category']; ?><?php endif; ?>" class="ftx-05"><?php echo $this->_var['lang']['All_undo']; ?></a></dd>
        </dl>
    </div>
	<div class="goods_list">
		<ul class="attr_father">
			
            <?php if ($this->_var['brands']): ?>
            <li class="s-line">
                <div class="s-l-wrap brand_img attr_list">
                    <div class="s-l-tit brand_name_l"><?php echo $this->_var['lang']['brand']; ?>：</div>
                    <div class="s-l-value brand_select_more">
                        <div class="all_a_z">
                            <ul class="a_z">
                                <li class="all_brand curr"><?php echo $this->_var['lang']['all_brand']; ?></li>
                                <?php $_from = $this->_var['letter']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'letter_0_42934400_1569574594');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['letter_0_42934400_1569574594']):
?>
                                <li data-key="<?php echo $this->_var['letter_0_42934400_1569574594']; ?>"><?php echo $this->_var['letter_0_42934400_1569574594']; ?></li>
                                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                <li class="other_brand"><?php echo $this->_var['lang']['Other']; ?></li>
                            </ul>
                        </div>
                        <div class="wrap_brand">  
                            <div class="brand_div">
                                <?php $_from = $this->_var['brands']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'brand');if (count($_from)):
    foreach ($_from AS $this->_var['brand']):
?>
                                <div class="brand_img_word" brand ="<?php echo $this->_var['brand']['brand_letters']; ?>">
                                    <?php if ($this->_var['brand']['brand_logo']): ?>
                                        <a href="<?php echo $this->_var['brand']['url']; ?>">
                                        	<img src="<?php echo $this->_var['brand']['brand_logo']; ?>" alt="<?php echo $this->_var['brand']['brand_name']; ?>" title="<?php echo $this->_var['brand']['brand_name']; ?>"> 
                                        	<span><?php echo $this->_var['brand']['brand_name']; ?></span>
                                        </a>
                                    <?php else: ?>
                                        <a href="<?php echo $this->_var['brand']['url']; ?>"><b><?php echo $this->_var['brand']['brand_name']; ?></b></a> 
                                    <?php endif; ?>
                                </div>
                                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                            </div>
                        </div>
                        <div class="zimu_list">
                            <ul class="get_more" >
                                <?php $_from = $this->_var['brands']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'brand');if (count($_from)):
    foreach ($_from AS $this->_var['brand']):
?>
                                <li class="is_no" brand ="<?php echo $this->_var['brand']['brand_letters']; ?>" url_id="<?php echo $this->_var['brand']['brand_id']; ?>"><span class="choose_ico"></span><a class="goods_brand_name" data-url="<?php echo $this->_var['brand']['url']; ?>"><?php echo $this->_var['brand']['brand_name']; ?></a></li>
                                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                            </ul>
                        </div>
                        <div class="enter_yes_no">
                            <div class="ct_auto">
                                <span class="yes_bt botton disabled"><?php echo $this->_var['lang']['assign']; ?></span>
                                <span class="no_bt botton"><?php echo $this->_var['lang']['close']; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="s-l-opt sl-ext">
                        <div class="choose_open s-l-more"><i class="iconfont icon-down"></i></div>
                        <div class="choose_more s-l-multiple"><i class="iconfont icon-plus"></i><?php echo $this->_var['lang']['multi_select']; ?></div>
                    </div>
                </div>
            </li>
            <?php endif; ?>
            
            
            <?php if ($this->_var['price_grade']['1']): ?>
            <li class="s-line">
                <dl class="s-l-wrap">
                    <div class="s-l-tit filter_attr_name"><?php echo $this->_var['lang']['price']; ?>：</div>
                    <div class="s-l-value attr_son">
                        <div class="price_auto fl">
                            <?php $_from = $this->_var['price_grade']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'grade');if (count($_from)):
    foreach ($_from AS $this->_var['grade']):
?>
                            <?php if ($this->_var['grade']['price_range']): ?>
                            <div class="price_range"><a href="<?php echo $this->_var['grade']['url']; ?>"><?php echo $this->_var['grade']['price_range']; ?></a></div>
                            <?php endif; ?>
                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                        </div>
                        <div class="price_auto price_bottom fl">
                            <input type="text" title="<?php echo $this->_var['lang']['Min_price']; ?>" name="price_min" class="price_class price_min">
                            <span class="price_class span_price_class">-</span>
                            <input type="text" title="<?php echo $this->_var['lang']['Max_price']; ?>" name="price_max" class="price_class price_max">
                            <button class="price_ok price_class"><?php echo $this->_var['lang']['assign']; ?></button>
                        </div>
                    </div>
                </dl>
            </li>
            <?php endif; ?> 

            
            <?php if ($this->_var['color_search']): ?>
            <li class="s-line">
				<dl class="s-l-wrap attr_list">
                  	<div class="s-l-tit filter_attr_name"><?php echo $this->_var['color_search']['filter_attr_name']; ?>：</div>
                    <div class="s-l-value attr_son attr_color">
                        <div class="item_list color_list_color">
                            <?php $_from = $this->_var['color_search']['attr_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'color_se');if (count($_from)):
    foreach ($_from AS $this->_var['color_se']):
?>
                            <?php if ($this->_var['color_se']['selected']): ?>
                            <span class="u_get"></span>
                            <?php else: ?>
                            <div class="color_divdd">
                                <dd url_id="<?php echo $this->_var['color_se']['goods_id']; ?>">
                                    <a title="<?php echo $this->_var['color_se']['attr_value']['c_value']; ?>" href="<?php echo $this->_var['color_se']['url']; ?>" data-url="<?php echo $this->_var['color_se']['url']; ?>">
                                        <span style="background:<?php echo $this->_var['color_se']['attr_value']['c_url']; ?>"></span>
                                        <b></b>
                                    </a>
                                </dd>
                            </div>
                            <?php endif; ?>
                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                        </div>
                        <div class="tw_buttom">
                            <span class="sure sure_color disabled"><?php echo $this->_var['lang']['assign']; ?></span>
                            <span class="no_btn"><?php echo $this->_var['lang']['is_cancel']; ?></span>
                        </div>
                    </div>
                    <div class="s-l-opt sl-ext">
                  		<div class="choose_more s-l-multiple"><i class="iconfont icon-plus"></i><?php echo $this->_var['lang']['multi_select']; ?></div>
					</div>
                </dl>
            </li>
            <?php endif; ?> 
            

            <?php $_from = $this->_var['filter_attr_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'filter_attr_0_43434400_1569574594');if (count($_from)):
    foreach ($_from AS $this->_var['filter_attr_0_43434400_1569574594']):
?>
            <li class="s-line same_li">
            	<dl class="s-l-wrap attr_list">
                    <div class="s-l-tit filter_attr_name"><?php echo htmlspecialchars($this->_var['filter_attr_0_43434400_1569574594']['filter_attr_name']); ?>：</div>
                    <div class="s-l-value attr_son">
                        <div class="item_list">
                            <?php $_from = $this->_var['filter_attr_0_43434400_1569574594']['attr_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'attr');if (count($_from)):
    foreach ($_from AS $this->_var['attr']):
?>
                            <?php if ($this->_var['attr']['selected']): ?>
                            <span class="u_get"><?php echo $this->_var['attr']['attr_value']; ?></span>
                            <?php else: ?>
                            <dd url_id="<?php echo $this->_var['attr']['goods_id']; ?>"><a href="<?php echo $this->_var['attr']['url']; ?>" data-url="<?php echo $this->_var['attr']['url']; ?>"><span></span><strong><?php echo $this->_var['attr']['attr_value']; ?></strong></a></dd>
                            <?php endif; ?>
                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                        </div>
                        <div class="tw_buttom">
                            <span class="sure sure_I disabled"><?php echo $this->_var['lang']['assign']; ?></span>
                            <span class="no_btn"><?php echo $this->_var['lang']['is_cancel']; ?></span>
                        </div>
                    </div>
                    <div class="s-l-opt sl-ext">
                        <div class="choose_open s-l-more"><i class="iconfont icon-down"></i></div>                
                        <div class="choose_more s-l-multiple"><i class="iconfont icon-plus"></i><?php echo $this->_var['lang']['multi_select']; ?></div>
                    </div>
				</dl>
            </li>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		</ul>
    </div>
	<div class="click_more s-more"><span class="sm-wrap"><strong><?php echo $this->_var['lang']['More_options']; ?></strong><i class="iconfont icon-down"></i></span></div>
</div>
<?php endif; ?>
