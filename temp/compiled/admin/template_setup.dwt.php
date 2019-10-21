<!doctype html>
<html>
<head><?php echo $this->fetch('library/admin_html_head.lbi'); ?></head>

<body class="iframe_body">
	<div class="warpper">
		<div class="title"><?php echo $this->_var['lang']['12_template']; ?> - <?php echo $this->_var['lang']['03_template_setup']; ?></div>
        <div class="content">
        	<div class="explanation" id="explanation">
                <div class="ex_tit"><i class="sc_icon"></i><h4><?php echo $this->_var['lang']['operating_hints']; ?></h4><span id="explanationZoom" title="<?php echo $this->_var['lang']['fold_tips']; ?>"></span></div>
                <ul>
                    <li><?php echo $this->_var['lang']['operation_prompt_content']['setup']['0']; ?></li>
                    <li><?php echo $this->_var['lang']['operation_prompt_content']['setup']['1']; ?></li>
                </ul>
            </div>
        	<div class="flexilist">
                <div class="common-content">
                    <div class="form-div">
                        <form method="post" action="template.php?act=setup">
                        <label class="fl"><?php echo $this->_var['lang']['select_template']; ?></label>
                        <div id="selLib" class="imitate_select select_w320" rank="1">
                            <div class="cite"><?php echo $this->_var['lang']['select_temp']; ?></div>
                            <ul>
                                <?php $_from = $this->_var['lang']['template_files']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'vo');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['vo']):
?>
                                <li><a href="javascript:;" data-value="<?php echo $this->_var['key']; ?>" class="ftx-01"><?php echo $this->_var['vo']; ?></a></li>
                                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                            </ul>
                            <input name="template_file" type="hidden" value="<?php echo $this->_var['curr_template']; ?>" id="selLib_val">
                        </div>
                        <input type="submit" value="<?php echo $this->_var['lang']['button_submit']; ?>" class="btn btn30 red_btn mr10" />
                        <?php if ($this->_var['curr_template'] == 'index' && $this->_var['cate_goods']): ?>
                        <a href="set_floor_brand.php?filename=<?php echo $this->_var['curr_template']; ?>" class="btn btn30 red_btn"><?php echo $this->_var['lang']['floor_brand_setup']; ?></a>
                        <?php endif; ?>
                        </form>
                    </div>
                    <div class="list-div mt20">
                        <form name="theForm" action="template.php" method="post">
                          <table width="100%" cellpadding="1" cellspacing="1">
                          <tr>
                            <th width="15%"><div class="tDiv"><?php echo $this->_var['lang']['library_name']; ?></div></th>
                            <th width="20%"><div class="tDiv"><?php echo $this->_var['lang']['region_name']; ?></div></th>
                            <th width="8%"><div class="tDiv"><?php echo $this->_var['lang']['sort_order']; ?></div></th>
                            <th width="32%"><div class="tDiv"><?php echo $this->_var['lang']['contents']; ?></div></th>
                            <th width="10%"><div class="tDiv"><?php echo $this->_var['lang']['number']; ?></div></th>
                            <th width="15%"><div class="tDiv"><?php echo $this->_var['lang']['display']; ?></div></th>
                          </tr>
                          <?php $_from = $this->_var['temp_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('lib_name', 'library');if (count($_from)):
    foreach ($_from AS $this->_var['lib_name'] => $this->_var['library']):
?>
                          <tr>
                            <td class="first-cell"><div class="tDiv"><?php echo $this->_var['library']['desc']; ?></div></td>
                            <td>
                            	<div class="tDiv">
                                    <div class="imitate_select select_w320" >
                                      <div class="cite"><?php if ($this->_var['library']['editable'] == 1): ?><?php echo $this->_var['lang']['not_editable']; ?><?php else: ?><?php echo $this->_var['lang']['select_plz']; ?><?php endif; ?></div>
                                      <ul>
                                          <?php if ($this->_var['library']['editable'] == 1): ?>
                                          <li><a href="javascript:;" data-value="" class="ftx-01"><?php echo $this->_var['lang']['not_editable']; ?></a></li>
                                          <?php else: ?>
                                          <li><a href="javascript:;" data-value="" class="ftx-01"><?php echo $this->_var['lang']['select_plz']; ?></a></li>
                                          <?php $_from = $this->_var['temp_regions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
                                          <li><a href="javascript:;" data-value="<?php echo $this->_var['item']; ?>" class="ftx-01"><?php echo $this->_var['item']; ?></a></li>
                                          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                          <?php endif; ?>
                                      </ul>
                                      <input name="regions[<?php echo $this->_var['lib_name']; ?>]" type="hidden" value="<?php echo $this->_var['library']['region']; ?>">
                                    </div>
                                </div>
                            </td>
                            <td><div class="tDiv"><input type="text" name="sort_order[<?php echo $this->_var['lib_name']; ?>]" class="text w40" value="<?php echo $this->_var['library']['sort_order']; ?>" size="4" <?php if ($this->_var['library']['editable'] == 1): ?> disabled <?php endif; ?>/></div></td>
                            <td><div class="tDiv"><input type="hidden" name="map[<?php echo $this->_var['lib_name']; ?>]" value="<?php echo $this->_var['library']['library']; ?>" /></div></td>
                            <td><div class="tDiv"><?php if ($this->_var['library']['number_enabled']): ?><input type="text" name="number[<?php echo $this->_var['lib_name']; ?>]" value="<?php echo $this->_var['library']['number']; ?>" class="text w40" size="4" /><?php else: ?>&nbsp;<?php endif; ?></div></td>
                            <td>
                            	<div class="tDiv">
                                    <div class="checkbox_items">
                                        <div class="checkbox_item">
                                            <input type="checkbox" value="1" name="display[<?php echo $this->_var['lib_name']; ?>]" class="ui-checkbox" id="display[<?php echo $this->_var['lib_name']; ?>]" <?php if ($this->_var['library']['editable'] == 1): ?> disabled <?php endif; ?><?php if ($this->_var['library']['display'] == 1): ?> checked="true" <?php endif; ?> />
                                            <label for="display[<?php echo $this->_var['lib_name']; ?>]" class="ui-label"></label>
                                        </div>
                                    </div>
                                </div>
                          	</td>
                          </tr>
                          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                        
                          <!-- cateogry goods list -->
                          <tr>
                            <td colspan="6" class="light_blue"><a href="javascript:;" onclick="addCatGoods(this)">[+]</a><?php echo $this->_var['lang']['template_libs']['cat_goods']; ?></div></td>
                          </tr>
                          <?php $_from = $this->_var['cate_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('lib_name', 'library');if (count($_from)):
    foreach ($_from AS $this->_var['lib_name'] => $this->_var['library']):
?>
                          <tr>
                            <td class="first-cell" align="right"><a href="javascript:;" onclick="removeRow(this)">[-]</a></td>
                            <td>
                            	<div class="tDiv">
                                    <div class="imitate_select select_w320" >
                                        <div class="cite"><?php echo $this->_var['lang']['select_plz']; ?></div>
                                        <ul>
                                            <li><a href="javascript:;" data-value="" class="ftx-01"><?php echo $this->_var['lang']['select_plz']; ?></a></li>
                                            <?php $_from = $this->_var['temp_regions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
                                            <li><a href="javascript:;" data-value="<?php echo $this->_var['item']; ?>" class="ftx-01"><?php echo $this->_var['item']; ?></a></li>
                                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                        </ul>
                                        <input  name="regions[cat_goods][]" type="hidden" value="<?php echo $this->_var['library']['region']; ?>">
                                    </div>
                                </div>
                            </td>
                            <td><div class="tDiv"><input type="text" name="sort_order[cat_goods][]" value="<?php echo $this->_var['library']['sort_order']; ?>" size="4" class="text w40" /></div></td>
                            <td>
                            	<div class="tDiv">
                                <div class="imitate_select select_w320" >
                                    <div class="cite">
                                    	<?php if ($this->_var['library']['cats']['cat_info']['cat_name']): ?>
                                    		<?php echo $this->_var['library']['cats']['cat_info']; ?>
                                        <?php else: ?>
                                        	<?php echo $this->_var['lang']['select_plz']; ?>  
                                        <?php endif; ?>
                                    </div>
                                    <ul class="category_level">
                                        <li><a href="javascript:;" data-value="" class="ftx-01"><?php echo $this->_var['lang']['select_plz']; ?></a></li>
                                        <?php $_from = $this->_var['library']['cats']['cat_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cats');if (count($_from)):
    foreach ($_from AS $this->_var['cats']):
?>
                                        <li>
                                        	<i class="xds_up" data-type="xds"></i>
                                        	<a href="javascript:;" data-value="<?php echo $this->_var['cats']['cat_id']; ?>" class="ftx-01"><?php echo $this->_var['cats']['select']; ?><?php echo $this->_var['cats']['cat_name']; ?></a>
                                            <dl class="level_two">
                                        	<?php if ($this->_var['cats']['child_tree']): ?>
                                            	<?php $_from = $this->_var['cats']['child_tree']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cats_child');if (count($_from)):
    foreach ($_from AS $this->_var['cats_child']):
?>
                                                	<dd>
                                                        <i class="xds_up" data-type="xds"></i>
                                                        <a href="javascript:;" data-value="<?php echo $this->_var['cats_child']['id']; ?>" class="ftx-01"><?php echo $this->_var['cats_child']['name']; ?></a>
                                                        <?php if ($this->_var['cats_child']['cat_id']): ?>
                                                        <dl class="level_three">
                                                            <?php $_from = $this->_var['cats_child']['cat_id']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cat');if (count($_from)):
    foreach ($_from AS $this->_var['cat']):
?>
                                                                <dd><a href="javascript:;" data-value="<?php echo $this->_var['cat']['id']; ?>" class="ftx-01"><?php echo $this->_var['cat']['name']; ?></a></dd>
                                                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                                        </dl>
                                                        <?php endif; ?>
                                                    </dd>
                                                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                            <?php endif; ?>
                                            </dl>
                                        </li>    
                                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                    </ul>
                                    <input name="categories[cat_goods][]" type="hidden" value="<?php echo $this->_var['library']['cats']['cat_info']['cat_id']; ?>">
                                </div>
								</div>
                            </td>
                            <td><div class="tDiv"><input type="text" name="number[cat_goods][]" value="<?php echo $this->_var['library']['number']; ?>" size="4" class="text w40" /></div></td>
                            
                            <td>
                            	<?php if ($this->_var['template_type']): ?>
                            	<div class="tDiv tpl-label">
                                <div class="imitate_select select_w120" ectype="tplSelect">
                                    <div class="cite"><?php echo $this->_var['lang']['default_floor_template']; ?></div>
                                    <ul class="category_template">
                                        <li><a href="javascript:;" data-value="0" class="ftx-01"><?php echo $this->_var['lang']['default_floor_template']; ?></a></li>
										<li><a href="javascript:;" data-value="1" class="ftx-01"><?php echo $this->_var['lang']['floor_template_1']; ?></a></li>
										<li><a href="javascript:;" data-value="2" class="ftx-01"><?php echo $this->_var['lang']['floor_template_2']; ?></a></li>
										<li><a href="javascript:;" data-value="3" class="ftx-01"><?php echo $this->_var['lang']['floor_template_3']; ?></a></li>
                                    </ul>
                                    <input name="categories[floor_tpl][]" type="hidden" value="<?php echo empty($this->_var['library']['floor_tpl']) ? '0' : $this->_var['library']['floor_tpl']; ?>">
                                </div>
								<span class="show fl mr10 mt5">
									<a href="images/floor-tpl-<?php echo empty($this->_var['library']['floor_tpl']) ? '0' : $this->_var['library']['floor_tpl']; ?>.png" class="nyroModal"><i class="icon icon-picture" onmouseover="toolTip('<img src=images/floor-tpl-<?php echo empty($this->_var['library']['floor_tpl']) ? '0' : $this->_var['library']['floor_tpl']; ?>.png>')" onmouseout="toolTip()"></i></a>
								</span>
								</div>
                                <?php else: ?>
                                &nbsp;
                                <?php endif; ?>
                            </td>
                          </tr>
                          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                        
                          <tr>
                            <td colspan="6" class="light_blue" align="left"><a href="javascript:;" onclick="addBrandGoods(this)">[+]</a> <?php echo $this->_var['lang']['template_libs']['brand_goods']; ?> </td>
                          </tr>
                          <?php $_from = $this->_var['brand_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('lib_name', 'library');if (count($_from)):
    foreach ($_from AS $this->_var['lib_name'] => $this->_var['library']):
?>
                          <tr>
                            <td class="first-cell" align="right"><a href="javascript:;" onclick="removeRow(this)">[-]</a></td>
                            <td>
                            	<div class="tDiv">
                                    <div class="imitate_select select_w320" >
                                    	<div class="cite"><?php echo $this->_var['lang']['select_plz']; ?></div>
                                        <ul>
                                            <li><a href="javascript:;" data-value="" class="ftx-01"><?php echo $this->_var['lang']['select_plz']; ?></a></li>
                                            <?php $_from = $this->_var['temp_regions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
                                            <li><a href="javascript:;" data-value="<?php echo $this->_var['item']; ?>" class="ftx-01"><?php echo $this->_var['item']; ?></a></li>
                                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                        </ul>
                                        <input name="regions[brand_goods][]" type="hidden" value="<?php echo $this->_var['library']['region']; ?>">
                                    </div>
                                </div>
                            </td>
                            <td><div class="tDiv"><input type="text" name="sort_order[brand_goods][]" value="<?php echo $this->_var['library']['sort_order']; ?>" size="4" class="text w40" /></div></td>
                            <td>
                            	<div class="tDiv">
                                <div class="imitate_select select_w320" >
                                    <div class="cite"><?php echo $this->_var['lang']['select_plz']; ?></div>
                                    <ul>
                                        <li><a href="javascript:;" data-value="" class="ftx-01"><?php echo $this->_var['lang']['select_plz']; ?></a></li>
                                        <?php $_from = $this->_var['temp_regions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
                                        <li><a href="javascript:;" data-value="<?php echo $this->_var['key']; ?>" class="ftx-01"><?php echo $this->_var['item']; ?></a></li>
                                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                    </ul>
                                    <input  name="brands[brand_goods][]" type="hidden" value="<?php echo $this->_var['library']['brand']; ?>">
                                </div>
                                </div>
                            </td>
                            <td><div class="tDiv"><input type="text" name="number[brand_goods][]" value="<?php echo $this->_var['library']['number']; ?>" size="4" class="text w40" /></div></td>
                            <td></td>
                          </tr>
                          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                        
                          <tr>
                            <td colspan="6" class="light_blue" align="left"><a href="javascript:;" onclick="addArticles(this)">[+]</a> <?php echo $this->_var['lang']['template_libs']['articles']; ?> </td>
                          </tr>
                          <?php $_from = $this->_var['cat_articles']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('lib_name', 'library');if (count($_from)):
    foreach ($_from AS $this->_var['lib_name'] => $this->_var['library']):
?>
                          <tr>
                            <td class="first-cell" align="right"><a href="javascript:;" onclick="removeRow(this)">[-]</a></td>
                            <td>
                            	<div class="tDiv">
                                <div class="imitate_select select_w320" >
                                    <div class="cite"><?php echo $this->_var['lang']['select_plz']; ?></div>
                                    <ul>
                                        <li><a href="javascript:;" data-value="" class="ftx-01"><?php echo $this->_var['lang']['select_plz']; ?></a></li>
                                        <?php $_from = $this->_var['temp_regions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
                                        <li><a href="javascript:;" data-value="<?php echo $this->_var['item']; ?>" class="ftx-01"><?php echo $this->_var['item']; ?></a></li>
                                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                    </ul>
                                    <input  name="regions[cat_articles][]" type="hidden" value="<?php echo $this->_var['library']['region']; ?>">
                                </div>
                                </div>
                            </td>
                            <td><div class="tDiv"><input type="text" name="sort_order[cat_articles][]" value="<?php echo $this->_var['library']['sort_order']; ?>" size="4"  class="text w40" /></div></td>
                            <td>
                            	<div class="tDiv">
                                <div class="imitate_select select_w320" >
                                    <div class="cite"><?php echo $this->_var['lang']['select_plz']; ?></div>
                                    <ul>
                                        <li><a href="javascript:;" data-value="0" class="ftx-01"><?php echo $this->_var['lang']['select_plz']; ?></a></li>
                                        <?php echo $this->_var['library']['cat']; ?>
                                    </ul>
                                    <input  name="article_cat[cat_articles][]" type="hidden" value="<?php echo $this->_var['library']['cat_articles_id']; ?>">
                                </div>
                                </div>
                            </td>
                            <td><div class="tDiv"><input type="text" name="number[cat_articles][]" value="<?php echo $this->_var['library']['number']; ?>" size="4"  class="text w40" /></div></td>
                            <td></td>
                          </tr>
                          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                        
                          <tr>
                            <td colspan="6" class="light_blue" align="left"><a href="javascript:;" onclick="addAdPosition(this)">[+]</a> <?php echo $this->_var['lang']['template_libs']['ad_position']; ?> </td>
                          </tr>
                          <?php $_from = $this->_var['ad_positions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('lib_name', 'ad_position');if (count($_from)):
    foreach ($_from AS $this->_var['lib_name'] => $this->_var['ad_position']):
?>
                          <tr>
                            <td class="first-cell" align="right"><a href="javascript:;" onclick="removeRow(this)">[-]</a></td>
                            <td>
                            	<div class="tDiv">
                                <div class="imitate_select select_w320" >
                                    <div class="cite"><?php echo $this->_var['lang']['select_plz']; ?></div>
                                    <ul>
                                        <li><a href="javascript:;" data-value="" class="ftx-01"><?php echo $this->_var['lang']['select_plz']; ?></a></li>
                                        <?php $_from = $this->_var['temp_regions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
                                        <li><a href="javascript:;" data-value="<?php echo $this->_var['item']; ?>" class="ftx-01"><?php echo $this->_var['item']; ?></a></li>
                                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                    </ul>
                                    <input  name="regions[ad_position][]" type="hidden" value="<?php echo $this->_var['ad_position']['region']; ?>">
                                </div>
                                </div>
                            </td>
                            <td><div class="tDiv"><input type="text" name="sort_order[ad_position][]" value="<?php echo $this->_var['ad_position']['sort_order']; ?>" size="4"  class="text w40" /></div></td>
                            <td>
                            	<div class="tDiv">
                                <div class="imitate_select select_w320" >
                                    <div class="cite"><?php echo $this->_var['lang']['select_plz']; ?></div>
                                    <ul>
                                        <li><a href="javascript:;" data-value="0" class="ftx-01"><?php echo $this->_var['lang']['select_plz']; ?></a></li>
                                        <?php $_from = $this->_var['arr_ad_positions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
                                        <li><a href="javascript:;" data-value="<?php echo $this->_var['key']; ?>" class="ftx-01"><?php echo $this->_var['item']; ?></a></li>
                                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                    </ul>
                                    <input  name="ad_position[]" type="hidden" value="<?php echo $this->_var['ad_position']['ad_pos']; ?>">
                                </div>
                                </div>
                            </td>
                            <td><div class="tDiv"><input type="text" name="number[ad_position][]" value="<?php echo $this->_var['ad_position']['number']; ?>" size="4" class="text w40" /></div></td>
                            <td></td>
                          </tr>
                          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                          <tr>
                            <td colspan="6">
                                <div class="info_btn tc pt20 pb20">
                                    <input type="submit" value="<?php echo $this->_var['lang']['button_submit']; ?>" class="button fn" />
                                    <input type="reset" value="<?php echo $this->_var['lang']['button_reset']; ?>" class="button button_reset fn" />
                                    <input type="hidden" name="act" value="setting" />
                                    <input type="hidden" name="template_file" value="<?php echo $this->_var['curr_template_file']; ?>" />
                                </div>
                            </td>
                          </tr>
                          </table>
                        </form>
                    </div>
                </div>
        	</div>
        </div>
	</div>
	<?php echo $this->fetch('library/pagefooter.lbi'); ?>
	
	<script type="text/javascript">
    <!--
	$(document).on("click","*[ectype='tplSelect'] li a",function(){
		var _this = $(this);
		var val = _this.data('value');
		var text = _this.html();
		
		$('#selLib_val').val(val);
		_this.parents(".tpl-label").find("span").html('<a href="images/floor-tpl-'+ val +'.png" class="nyroModal"><i class="icon icon-picture" onmouseover="toolTip(' + "'" + '<img src=' + 'images/floor-tpl-'+ val +'.png' + '>' + "'" + ')' + '" onmouseout="toolTip()"></i></a>');
	
		$('.nyroModal').nyroModal();
	});

    var currTemplateFile = '<?php echo $this->_var['curr_template_file']; ?>';
    var selRegions       = new Array();
    var selBrands        = new Array();
    var selArticleCats   = new Array();
    var selAdPositions   = new Array();
    
    <?php $_from = $this->_var['temp_regions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('id', 'region');if (count($_from)):
    foreach ($_from AS $this->_var['id'] => $this->_var['region']):
?>
    selRegions[<?php echo $this->_var['id']; ?>] = '<?php echo addslashes($this->_var['region']); ?>';
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    
    <?php $_from = $this->_var['arr_brands']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('id', 'brand');if (count($_from)):
    foreach ($_from AS $this->_var['id'] => $this->_var['brand']):
?>
    selBrands[<?php echo $this->_var['brand']['brand_id']; ?>] = '<?php echo addslashes($this->_var['brand']['brand_name']); ?>';
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    
    <?php $_from = $this->_var['arr_article_cats']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('id', 'cat');if (count($_from)):
    foreach ($_from AS $this->_var['id'] => $this->_var['cat']):
?>
    selArticleCats[<?php echo $this->_var['id']; ?>] = '<?php echo $this->_var['cat']; ?>';
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    
    <?php $_from = $this->_var['arr_ad_positions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('id', 'ad_position');if (count($_from)):
    foreach ($_from AS $this->_var['id'] => $this->_var['ad_position']):
?>
    selAdPositions[<?php echo $this->_var['id']; ?>] = '<?php echo htmlspecialchars($this->_var['ad_position']); ?>';
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    
    
    
    /**
     * 创建区域选择的下拉列表
     */
    function buildRegionSelect(selName)
    {
        var sel = '<div class="tDiv"><div class="imitate_select select_w320" ><div class="cite">' + selectPlease + '</div><ul>';
        
        sel += '<li><a href="javascript:;" data-value="" class="ftx-01">' + selectPlease + '</a></li>';
    
         for (i=0; i < selRegions.length; i++)
        {
              sel += '<li><a href="javascript:;" data-value="' + selRegions[i] + '" class="ftx-01">' + selRegions[i] + '</a></li>';
        }
    
        sel += '</ul><input  name="' + selName + '" type="hidden" value=""></div></div>';
        return sel;
    }
    
    /**
     * 创建选择品牌的下拉列表
     */
    function buildBrandSelect(selName)
    {
        
        var sel = '<div class="tDiv"><div class="imitate_select select_w320" ><div class="cite">' + selectPlease + '</div><ul>';
        
        sel += '<li><a href="javascript:;" data-value="" class="ftx-01">' + selectPlease + '</a></li>';
    
        for (brand in selBrands)
        {
            if (brand != "______array" && brand != "toJSONString")
            {
              sel += '<li><a href="javascript:;" data-value="' + brand + '" class="ftx-01">' + selBrands[brand] + '</a></li>';
            }
        }
    
        sel += '</ul><input  name="' + selName + '" type="hidden" value=""></div></div>';
        return sel;
    }
    
    /**
     * 创建选择文章分类的下拉列表
     */
    function buildArticleCatSelect(selName)
    {
        var sel = '<div class="tDiv"><div class="imitate_select select_w320" ><div class="cite">' + selectPlease + '</div><ul>';
        
        sel += '<li><a href="javascript:;" data-value="" class="ftx-01">' + selectPlease + '</a></li>';
    
        for (cat in selArticleCats)
        {
            if (cat != "______array" && cat != "toJSONString")
            {
               sel += '<li><a href="javascript:;" data-value="' + cat + '" class="ftx-01">' + selArticleCats[cat] + '</a></li>';
            }
        }
        sel += '</ul><input  name="' + selName + '" type="hidden" value=""></div></div>';
    
        return sel;
    }
    
    /**
     * 创建选择广告位置的列表
     */
    function buildAdPositionsSelect(selName)
    {
        var sel = '<div class="tDiv"><div class="imitate_select select_w320" ><div class="cite">' + selectPlease + '</div><ul>';
        
        sel += '<li><a href="javascript:;" data-value="" class="ftx-01">' + selectPlease + '</a></li>';
    
        for (ap in selAdPositions)
        {
            if (ap != "______array" && ap != "toJSONString")
            {
              sel += '<li><a href="javascript:;" data-value="' + ap + '" class="ftx-01">' + selAdPositions[ap] + '</a></li>';
            }
        }
        sel += '</ul><input  name="' + selName + '" type="hidden" value=""></div></div>';
        return sel;
    }
    
    /**
     * 增加一个分类的商品
     */
    function addCatGoods(obj)
    {
        var rowId = rowindex(obj.parentNode.parentNode);

        var table = obj.parentNode.parentNode.parentNode.parentNode;
    
        var row  = table.insertRow(rowId + 1);
        var cell = row.insertCell(-1);
        cell.innerHTML = '<a href="javascript:;" onclick="removeRow(this)">[-]</a>';
        cell.className = 'first-cell';
        cell.align     = 'right';
    
        cell           = row.insertCell(-1);
        cell.innerHTML = buildRegionSelect('regions[cat_goods][]');
    
        cell           = row.insertCell(-1);
		
        cell.innerHTML = '<div class="tDiv"><input type="text" name="sort_order[cat_goods][]" class="text w40" value="0" size="4" /></div>';
    
        cell           = row.insertCell(-1);
        cell.innerHTML = '<div class="tDiv"><div class="imitate_select select_w320" ><div class="cite">' + 
		
						selectPlease + 
						
						'</div><ul class="category_level"><li><a href="javascript:;" data-value="" class="ftx-01">' + 
						
						selectPlease + 
						
						'</a></li>' + 
						
						<?php if ($this->_var['arr_cates']): ?>
							<?php $_from = $this->_var['arr_cates']['cat_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cats');if (count($_from)):
    foreach ($_from AS $this->_var['cats']):
?>
							'<li><i class="xds_up" data-type="xds"></i><a href="javascript:;" data-value="<?php echo $this->_var['cats']['cat_id']; ?>" class="ftx-01"><?php echo $this->_var['cats']['select']; ?><?php echo $this->_var['cats']['cat_name']; ?></a>' + 
								<?php if ($this->_var['cats']['child_tree']): ?>
								'<dl class="level_two">'+
								<?php $_from = $this->_var['cats']['child_tree']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cats_child');if (count($_from)):
    foreach ($_from AS $this->_var['cats_child']):
?>
								'<dd><i class="xds_up" data-type="xds"></i><a href="javascript:;" data-value="<?php echo $this->_var['cats_child']['id']; ?>" class="ftx-01"><?php echo $this->_var['cats_child']['name']; ?></a>' + 
									<?php if ($this->_var['cats_child']['cat_id']): ?>
									'<dl class="level_three">' +
									<?php $_from = $this->_var['cats_child']['cat_id']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cat');if (count($_from)):
    foreach ($_from AS $this->_var['cat']):
?>
									'<dd><a href="javascript:;" data-value="<?php echo $this->_var['cat']['id']; ?>" class="ftx-01"><?php echo $this->_var['cat']['name']; ?></a></dd>' + 
									<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
									'</dl>'+
									<?php endif; ?>
								'</dd>' +	
								<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
								'</dl>' +
								<?php endif; ?>
							<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
						<?php endif; ?>
						
						'</li></ul><input  name="categories[cat_goods][]" type="hidden" value=""></div></div>';
    
        cell           = row.insertCell(-1);
        cell.innerHTML = '<div class="tDiv"><input type="text" name="number[cat_goods][]" value="5" class="text w40" size="4" /></div>';
    
        cell           = row.insertCell(-1);
        cell.innerHTML = '<div class="tDiv tpl-label"><div class="imitate_select select_w120" ectype="tplSelect"><div class="cite"><?php echo $this->_var['lang']['default_floor_template']; ?></div>' +
                         '<ul class="category_template"><li><a href="javascript:;" data-value="0" class="ftx-01"><?php echo $this->_var['lang']['default_floor_template']; ?></a></li><li><a href="javascript:;" data-value="1" class="ftx-01"><?php echo $this->_var['lang']['floor_template_1']; ?></a></li>' +
						 '<li><a href="javascript:;" data-value="2" class="ftx-01"><?php echo $this->_var['lang']['floor_template_2']; ?></a></li><li><a href="javascript:;" data-value="3" class="ftx-01"><?php echo $this->_var['lang']['floor_template_3']; ?></a></li></ul>' +
                         '<input name="categories[floor_tpl][]" type="hidden" value="<?php echo empty($this->_var['library']['floor_tpl']) ? '0' : $this->_var['library']['floor_tpl']; ?>"></div>' +
						 '<span class="show fl mr10 mt5">' +
						 '<a href="images/floor-tpl-<?php echo empty($this->_var['library']['floor_tpl']) ? '0' : $this->_var['library']['floor_tpl']; ?>.png" class="nyroModal"><i class="icon icon-picture" onmouseover="toolTip(' + "'" + '<img src=images/floor-tpl-<?php echo empty($this->_var['library']['floor_tpl']) ? '0' : $this->_var['library']['floor_tpl']; ?>.png>' + "'" + ')" onmouseout="toolTip()"></i></a>' +
						 '</span></div>';							
        cell           = row.insertCell(-1);
    }
    
    /**
     * 增加一个品牌的商品
     */
    function addBrandGoods(obj)
    {
        var rowId = rowindex(obj.parentNode.parentNode);
    
        var table = obj.parentNode.parentNode.parentNode.parentNode;
    
        var row  = table.insertRow(rowId + 1);
        var cell = row.insertCell(-1);
        cell.innerHTML = '<a href="javascript:;" onclick="removeRow(this)">[-]</a>';
        cell.className = 'first-cell';
        cell.align     = 'right';
    
        cell           = row.insertCell(-1);
        cell.innerHTML = buildRegionSelect('regions[brand_goods][]');
    
        cell           = row.insertCell(-1);
        cell.innerHTML = '<div class="tDiv"><input type="text" name="sort_order[brand_goods][]" value="0" size="4" class="text w40" /></div>';
    
        cell           = row.insertCell(-1);
        cell.innerHTML = buildBrandSelect('brands[brand_goods][]');
    
        cell           = row.insertCell(-1);
        cell.innerHTML = '<div class="tDiv"><input type="text" name="number[brand_goods][]" value="5" size="4" class="text w40" /></div>';
    
        cell           = row.insertCell(-1);
    }
    
    /**
     * 增加一个文章列表
     */
    function addArticles(obj)
    {
        var rowId = rowindex(obj.parentNode.parentNode);
    
        var table = obj.parentNode.parentNode.parentNode.parentNode;
    
        var row  = table.insertRow(rowId + 1);
        var cell = row.insertCell(-1);
        cell.innerHTML = '<a href="javascript:;" onclick="removeRow(this)">[-]</a>';
        cell.className = 'first-cell';
        cell.align     = 'right';
    
        cell           = row.insertCell(-1);
        cell.innerHTML = buildRegionSelect('regions[cat_articles][]');
    
        cell           = row.insertCell(-1);
        cell.innerHTML = '<div class="tDiv"><input type="text" name="sort_order[cat_articles][]" value="0" size="4" class="text w40" /></div>';
    
        cell           = row.insertCell(-1);
        cell.innerHTML = buildArticleCatSelect('article_cat[cat_articles][]');
    
        cell           = row.insertCell(-1);
        cell.innerHTML = '<div class="tDiv"><input type="text" name="number[cat_articles][]" value="5" size="4" class="text w40" /></div>';
    
        cell           = row.insertCell(-1);
    }
    
    /**
     * 增加一个广告位
     */
    function addAdPosition(obj)
    {
        var rowId = rowindex(obj.parentNode.parentNode);
    
        var table = obj.parentNode.parentNode.parentNode.parentNode;
    
        var row  = table.insertRow(rowId + 1);
        var cell = row.insertCell(-1);
        cell.innerHTML = '<a href="javascript:;" onclick="removeRow(this)">[-]</a>';
        cell.className = 'first-cell';
        cell.align     = 'right';
    
        cell           = row.insertCell(-1);
        cell.innerHTML = buildRegionSelect('regions[ad_position][]');
    
        cell           = row.insertCell(-1);
        cell.innerHTML = '<div class="tDiv"><input type="text" name="sort_order[ad_position][]" value="0" size="4" class="text w40" /></div>';
    
        cell           = row.insertCell(-1);
        cell.innerHTML = buildAdPositionsSelect('ad_position[]');
    
        cell           = row.insertCell(-1);
        cell.innerHTML = '<div class="tDiv"><input type="text" name="number[ad_position][]" value="1" size="4" class="text w40" /></div>';
    
        cell           = row.insertCell(-1);
    }
    
    /**
     * 删除一行
     */
    function removeRow(obj)
    {
        if (confirm(removeConfirm))
        {
            var table = obj.parentNode.parentNode.parentNode;
            var row   = obj.parentNode.parentNode;
    
            for (i = 0; i < table.childNodes.length; i++)
            {
                if (table.childNodes[i] == row)
                {
                    table.removeChild(table.childNodes[i]);
                }
            }
        }
    }
    
    //--> 
	
	function setup(){
		var obj = $(".category_level");
		$(document).on("click","[data-type='xds']",function(){
			var _this = $(this);
			if(_this.hasClass("xds_up")){
				_this.removeClass("xds_up").addClass("xds_down");
				_this.siblings("dl").show();
			}else{
				_this.removeClass("xds_down").addClass("xds_up");
				_this.siblings("dl").hide();
				_this.siblings("dl").find("dl").hide();
				_this.siblings("dl").find("[data-type='xds']").removeClass("xds_down").addClass("xds_up");
			}
		});
	}

	$(function(){
		$('.nyroModal').nyroModal();
	});
	
	setup();
	</script>
</body>
</html>