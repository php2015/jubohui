<?php if ($this->_var['attr_group']): ?>
<!--<?php if ($this->_var['full_page']): ?>-->
<a href="goods_attr_price.php?act=add&goods_id=<?php echo $this->_var['goods_id']; ?>&goods_type=<?php echo $this->_var['goods_type']; ?>" class="btn btn25 blue_btn ga_price" target="_blank" style="display:none"><?php echo $this->_var['lang']['select_batch_file']; ?></a>
<table class="table_head" width="100%">
    <thead>
        <tr>
            <th <?php if ($this->_var['add_shop_price'] == 1): ?>width="20%"<?php endif; ?>>
                <?php $_from = $this->_var['attribute_array']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'attribute');$this->_foreach['attribute'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['attribute']['total'] > 0):
    foreach ($_from AS $this->_var['attribute']):
        $this->_foreach['attribute']['iteration']++;
?>
                    <?php echo $this->_var['attribute']['attr_name']; ?><?php if (! ($this->_foreach['attribute']['iteration'] == $this->_foreach['attribute']['total'])): ?>，<?php endif; ?>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            </th>
            <th width="5%" <?php if ($this->_var['model_name'] == ''): ?>class="hide"<?php endif; ?>><?php echo $this->_var['model_name']; ?></th>
            <th width="8%" <?php if ($this->_var['goods_attr_price'] == 0 || $this->_var['add_shop_price'] == 1): ?>class="hide"<?php endif; ?>><em class="require-field">*</em><?php echo $this->_var['lang']['price_market']; ?><i class="sc_icon sc_icon_edit pointer pro_market"></i></th>
            <th width="8%" <?php if ($this->_var['goods_attr_price'] == 0): ?>class="hide"<?php endif; ?>><em class="require-field">*</em><?php echo $this->_var['lang']['price_shop']; ?><i class="sc_icon sc_icon_edit pointer pro_shop"></i></th>
            <th width="8%" <?php if ($this->_var['goods_attr_price'] == 0 || $this->_var['add_shop_price'] == 1): ?>class="hide"<?php endif; ?>><em class="require-field">*</em><?php echo $this->_var['lang']['price_promotion']; ?><i class="sc_icon sc_icon_edit pointer pro_promote"></i></th>
            <th width="10%"><em class="require-field">*</em><?php echo $this->_var['lang']['storage']; ?><i class="sc_icon sc_icon_edit pointer pro_number"></i></th>
            <th width="10%"><em class="require-field">*</em><?php echo $this->_var['lang']['warning_value']; ?><i class="sc_icon sc_icon_edit pointer pro_warning"></i></th>
            <th width="12%"><?php echo $this->_var['lang']['product_code']; ?></th>
            <th width="12%"><?php echo $this->_var['lang']['product_bar_code']; ?></th>
            <th width="5%"><?php echo $this->_var['lang']['handler']; ?></th>
        </tr>
    </thead>
</table>
<!--<?php endif; ?>-->
<div id="listDiv">     
    <div class="step_item_table2">
        <table class="table_attr" width="100%">
            <tbody>
                <?php $_from = $this->_var['attr_group']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'group');if (count($_from)):
    foreach ($_from AS $this->_var['group']):
?>
                <?php if ($this->_var['group']['attr_info']): ?>
                <tr data-changelog="<?php echo $this->_var['group']['changelog']; ?>">
                    <td class="td_bg_blue" <?php if ($this->_var['add_shop_price'] == 1): ?>width="20%"<?php endif; ?>>
                        <?php $_from = $this->_var['group']['attr_info']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'one');$this->_foreach['one'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['one']['total'] > 0):
    foreach ($_from AS $this->_var['one']):
        $this->_foreach['one']['iteration']++;
?>
                            <?php echo $this->_var['one']['attr_value']; ?>
                            <input type="hidden" name="attr[<?php echo $this->_var['one']['attr_id']; ?>][]" value="<?php echo $this->_var['one']['attr_value']; ?>" />
                            <input type="hidden" name="goods_attr_id[<?php echo $this->_var['one']['goods_attr_id']; ?>][]" value="<?php echo $this->_var['one']['goods_attr_id']; ?>" />
                            <?php if (! ($this->_foreach['one']['iteration'] == $this->_foreach['one']['total'])): ?>，<?php endif; ?>
                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    </td>		
                    <td width="5%" <?php if ($this->_var['region_name'] == ''): ?>class="hide"<?php endif; ?>><?php echo $this->_var['region_name']; ?></td>
                    <td width="8%" <?php if ($this->_var['goods_attr_price'] == 0 || $this->_var['add_shop_price'] == 1): ?>class="hide"<?php endif; ?>><input type="text" name="product_market_price[]" onBlur="listTable.editInput(this, 'edit_product_market_price', <?php echo empty($this->_var['group']['product_id']) ? '0' : $this->_var['group']['product_id']; ?>, $('#goods_model').val(), 'goods_model');" class="text w60" autocomplete="off" value="<?php echo empty($this->_var['group']['product_market_price']) ? '0.00' : $this->_var['group']['product_market_price']; ?>" /></td>
                    <td width="8%" <?php if ($this->_var['goods_attr_price'] == 0): ?>class="hide"<?php endif; ?>><input type="text" name="product_price[]" onBlur="listTable.editInput(this, 'edit_product_price', <?php echo empty($this->_var['group']['product_id']) ? '0' : $this->_var['group']['product_id']; ?>, $('#goods_model').val(), 'goods_model');" class="text w60" autocomplete="off" value="<?php echo empty($this->_var['group']['product_price']) ? '0.00' : $this->_var['group']['product_price']; ?>" /></td>
                    <td width="8%" <?php if ($this->_var['goods_attr_price'] == 0 || $this->_var['add_shop_price'] == 1): ?>class="hide"<?php endif; ?>><input type="text" name="product_promote_price[]" onBlur="listTable.editInput(this, 'edit_product_promote_price', <?php echo empty($this->_var['group']['product_id']) ? '0' : $this->_var['group']['product_id']; ?>, $('#goods_model').val(), 'goods_model');" class="text w60" autocomplete="off" value="<?php echo empty($this->_var['group']['product_promote_price']) ? '0.00' : $this->_var['group']['product_promote_price']; ?>" /></td>
                    <td width="10%"><input type="text" name="product_number[]" onBlur="listTable.editInput(this, 'edit_product_number', <?php echo empty($this->_var['group']['product_id']) ? '0' : $this->_var['group']['product_id']; ?>, $('#goods_model').val(), 'goods_model');" class="text w60" autocomplete="off" value="<?php echo empty($this->_var['group']['product_number']) ? '0' : $this->_var['group']['product_number']; ?>" /></td>
                    <td width="10%"><input type="text" name="product_warn_number[]" onBlur="listTable.editInput(this, 'edit_product_warn_number', <?php echo empty($this->_var['group']['product_id']) ? '0' : $this->_var['group']['product_id']; ?>, $('#goods_model').val(), 'goods_model');" class="text w60" autocomplete="off" value="<?php echo empty($this->_var['group']['product_warn_number']) ? '1' : $this->_var['group']['product_warn_number']; ?>" /></td>
                    <td width="12%"><input type="text" name="product_sn[]" onBlur="listTable.editInput(this, 'edit_product_sn', <?php echo empty($this->_var['group']['product_id']) ? '0' : $this->_var['group']['product_id']; ?>, $('#goods_model').val(), 'goods_model');" class="text w120" autocomplete="off" value="<?php echo $this->_var['group']['product_sn']; ?>" /></td>
                    <td width="12%"><input type="text" name="product_bar_code[]" onBlur="listTable.editInput(this, 'edit_product_bar_code', <?php echo empty($this->_var['group']['product_id']) ? '0' : $this->_var['group']['product_id']; ?>, $('#goods_model').val(), 'goods_model');" class="text w120" autocomplete="off" value="<?php echo $this->_var['group']['bar_code']; ?>" /></td>
                    <td class="handle" width="5%">
                        <?php if ($this->_var['group']['product_id'] && $this->_var['group']['changelog'] == 0): ?>
                            <div class="tDiv pl0 a1">
                            <a href="javascript:void(0);" class="btn_trash" onclick="if (confirm('<?php echo $this->_var['lang']['trash_product_confirm']; ?>')) dropProduct('<?php echo $this->_var['group']['product_id']; ?>')"><i class="icon icon-trash"></i><?php echo $this->_var['lang']['drop']; ?></a>
                            </div>
                        <?php else: ?>
                            <?php echo $this->_var['lang']['n_a']; ?>
                        <?php endif; ?>
                        <input type="hidden" name="product_id[]" value="<?php if ($this->_var['group']['changelog'] == 1): ?>0<?php else: ?><?php echo empty($this->_var['group']['product_id']) ? '0' : $this->_var['group']['product_id']; ?><?php endif; ?>" />
                        <input type="hidden" name="changelog_product_id[]" value="<?php if ($this->_var['group']['changelog'] == 1): ?><?php echo empty($this->_var['group']['product_id']) ? '0' : $this->_var['group']['product_id']; ?><?php else: ?>0<?php endif; ?>" />
                    </td>
                </tr>
                <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            </tbody>
        </table>
        <input name="group_attr" type="hidden" value='<?php echo $this->_var['group_attr']; ?>'>
    </div>
    
    <!--<?php if ($this->_var['filter']['page_count'] > 1): ?>-->
    <div id="turn-page" class="attr-turn-page">
        <div class="pagination">
            <ul>
                <li><?php if ($this->_var['filter']['page'] != 1): ?><a href="javascript:listTable.gotoPageFirst()"><?php endif; ?><span><?php echo $this->_var['lang']['page_first']; ?></span><?php if ($this->_var['filter']['page'] != 1): ?></a><?php endif; ?></li>
                <li<?php if ($this->_var['filter']['page'] == 1): ?> class="curr"<?php endif; ?>><?php if ($this->_var['filter']['page'] != 1): ?><a href="javascript:listTable.gotoPagePrev()"><?php endif; ?><span class="prev"><?php echo $this->_var['lang']['page_prev']; ?></span><?php if ($this->_var['filter']['page'] != 1): ?></a><?php endif; ?></li>
                <?php $_from = $this->_var['page_count_arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'page_count');$this->_foreach['pageCount'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['pageCount']['total'] > 0):
    foreach ($_from AS $this->_var['page_count']):
        $this->_foreach['pageCount']['iteration']++;
?>
                <?php if ($this->_var['page_count'] == $this->_var['filter']['page']): ?>
                    <li><span class="currentpage"><?php echo $this->_var['page_count']; ?></span></li>
                <?php else: ?>
                    <li><a href="javascript:listTable.gotoPage(<?php echo $this->_var['page_count']; ?>)"><span><?php echo $this->_var['page_count']; ?></span></a></li>
                <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                <li<?php if ($this->_var['filter']['page'] == $this->_var['filter']['page_count']): ?> class="curr"<?php endif; ?>><?php if ($this->_var['filter']['page'] != $this->_var['filter']['page_count']): ?><a href="javascript:listTable.gotoPageNext()"><?php endif; ?><span class="next"><?php echo $this->_var['lang']['page_next']; ?></span><?php if ($this->_var['filter']['page'] != $this->_var['filter']['page_count']): ?></a><?php endif; ?></li>
                <li><?php if ($this->_var['filter']['page'] != $this->_var['filter']['page_count']): ?><a href="javascript:listTable.gotoPageLast()" class="last"><?php endif; ?><span><?php echo $this->_var['lang']['page_last']; ?></span><?php if ($this->_var['filter']['page'] != $this->_var['filter']['page_count']): ?></a><?php endif; ?></li>
            </ul>
        </div>    
    </div>
    <!--<?php endif; ?>-->
	<?php if ($this->_var['cloud_count'] == 0): ?>
    <span class="goods_attr_04_explain"><?php echo $this->_var['lang']['over2page_batch_upload']; ?></span>
    <div class="goods_attr_04_batch">
        <?php if ($this->_var['goods_model'] == 1): ?>
            <a href="javascript:;" class="btn btn35 red_btn" id="produts_warehouse_batch"><?php echo $this->_var['lang']['batch_upload_csv']; ?></a>
        <?php elseif ($this->_var['goods_model'] == 2): ?>
            <a href="javascript:;" class="btn btn35 red_btn" id="produts_area_batch"><?php echo $this->_var['lang']['batch_upload_csv']; ?></a>
        <?php else: ?>
            <a href="javascript:;" class="btn btn35 red_btn" id="produts_batch"><?php echo $this->_var['lang']['batch_upload_csv']; ?></a>
        <?php endif; ?>
        <a href="javascript:;" class="btn btn35 red_btn ml20" id="attr_refresh"><?php echo $this->_var['lang']['refresh']; ?></a>
    </div> 
	<?php endif; ?>
    <input name="arrt_page_count" type="hidden" value='<?php echo $this->_var['filter']['page_count']; ?>'>
</div>

<!--<?php if ($this->_var['full_page']): ?>-->
	<script type="text/javascript">
	<!--<?php if ($this->_var['filter']['page_count'] > 1): ?>-->
    listTable.recordCount = <?php echo $this->_var['filter']['record_count']; ?>;
    listTable.pageCount = <?php echo $this->_var['filter']['page_count']; ?>;
    listTable.query = "goods_attribute_query";
    
    <?php $_from = $this->_var['filter']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
    listTable.filter.<?php echo $this->_var['key']; ?> = '<?php echo $this->_var['item']; ?>';
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    <!--<?php endif; ?>-->
	
    $(function(){
        /**
        *货品市场价
        */
        $(".pro_market").click(function(){
            var val = $("form[name='theForm'] :input[name='product_market_price[]']").get(0).value;
            var field = 'product_market_price';
            synchronization_attr(field,val);
        });
        function synchronization_attr(field,val){
            var goods_id = $("input[name='goods_id']").val();
            var model = $(":input[name='goods_model']").val();//商品模式
            var warehouse_id = $("#attribute_model").find("input[type=radio][data-type=warehouse_id]:checked").val();
            var region_id = $("#attribute_model").find("input[type=radio][data-type=region_id]:checked").val();
            var changelog = $(".table_attr tr:eq(0)").data('changelog');
            var extension = '';
            if(model == 1){
                        extension += "&region_id="+warehouse_id;
                }else if(model == 2){
                        extension += "&region_id="+region_id;
                }
            extension += "&field="+field;
            extension += "&changelog="+changelog;
            extension += "&val="+val;
            $.jqueryAjax('goods.php', 'act=synchronization_attr' + '&goods_id=' + goods_id + "&model=" + model + extension, function(data){
                    getAttrList(goods_id);
            });
        }
        /**
        *货品本店价
        */
        $(".pro_shop").click(function(){
            
            var val = $("form[name='theForm'] :input[name='product_price[]']").get(0).value;
            var field = 'product_price';
            synchronization_attr(field,val);
            
        });
		
		/**
        *货品本店价
        */
        $(".pro_promote").click(function(){
            var val = $("form[name='theForm'] :input[name='product_promote_price[]']").get(0).value;
            var field = 'product_promote_price';
            synchronization_attr(field,val);
        });
        
        /**
        *货品库存
        */
        $(".pro_number").click(function(){
            var val = $("form[name='theForm'] :input[name='product_number[]']").get(0).value;
            var field = 'product_number';
            synchronization_attr(field,val);
        });
        
        /**
        *货品库存预警值
        */
        $(".pro_warning").click(function(){
            var val = $("form[name='theForm'] :input[name='product_warn_number[]']").get(0).value;
            var field = 'product_warn_number';
            synchronization_attr(field,val);
        });
    });
    </script>
<!--<?php endif; ?>-->
<?php endif; ?>