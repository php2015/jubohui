<?php if ($this->_var['model'] == 1): ?>
<div class="step_top_btn">	
	<a href="javascript:void(0);" class="btn red_btn" ectype="addWarehouse" data-userid="<?php echo $this->_var['user_id']; ?>"><i class="sc_icon sc_icon_warehouse"></i><?php echo $this->_var['lang']['add_warehouse']; ?></a>
	<a href="goods_warehouse_batch.php?act=add&goods_id=<?php echo $this->_var['goods_id']; ?>" class="btn red_btn" target="_blank"><?php echo $this->_var['lang']['batch_upload_csv']; ?></a>	
</div>
<div class="list-div">
	<table cellpadding="0" cellspacing="0" border="0">
		<thead>
			<tr>
				<th width="5%"><div class="tDiv"><?php echo $this->_var['lang']['record_id']; ?><div></th>
				<th width="9%"><div class="tDiv"><?php echo $this->_var['lang']['warehouse_name']; ?></div></th>
                <th width="10%"><div class="tDiv"><?php echo $this->_var['lang']['warehouse_goods_code']; ?></div></th>
				<th width="11%"><div class="tDiv"><?php echo $this->_var['lang']['warehouse_stock']; ?></div></th>
				<th width="11%"><div class="tDiv"><?php echo $this->_var['lang']['warehouse_price']; ?></div></th>
				<th width="11%"><div class="tDiv"><?php echo $this->_var['lang']['warehouse_promotion_price']; ?></div></th>
				<th width="11%"><div class="tDiv"><?php echo $this->_var['lang']['give_spand_integral']; ?></div></th>
				<th width="11%"><div class="tDiv"><?php echo $this->_var['lang']['give_level_integral']; ?></div></th>
				<th width="11%"><div class="tDiv"><?php echo $this->_var['lang']['integral_purchase_amount']; ?></div></th>
				<th width="10%" class="handle"><?php echo $this->_var['lang']['handler']; ?></th>
			</tr>
		</thead>
		<tbody>
			<?php $_from = $this->_var['warehouse_goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('i', 'warehouse');if (count($_from)):
    foreach ($_from AS $this->_var['i'] => $this->_var['warehouse']):
?>
			<tr id="warehouse_<?php echo $this->_var['warehouse']['w_id']; ?>">
				<td><div class="tDiv"><?php echo $this->_var['warehouse']['w_id']; ?></div></td>
				<td><div class="tDiv"><?php echo $this->_var['warehouse']['region_name']; ?></div></td>
				<td><div class="tDiv"><span onclick="listTable.edit(this, 'edit_warehouse_sn', <?php echo $this->_var['warehouse']['w_id']; ?>)"><?php echo empty($this->_var['warehouse']['region_sn']) ? $this->_var['lang']['n_a'] : $this->_var['warehouse']['region_sn']; ?></span><i class="edit_icon"></i></div></td>
                <td><div class="tDiv"><span onclick="listTable.edit(this, 'edit_warehouse_number', <?php echo $this->_var['warehouse']['w_id']; ?>)"><?php echo $this->_var['warehouse']['region_number']; ?></span><i class="edit_icon"></i></div></td>
				<td><div class="tDiv"><span onclick="listTable.edit(this, 'edit_warehouse_price', <?php echo $this->_var['warehouse']['w_id']; ?>)"><?php echo $this->_var['warehouse']['warehouse_price']; ?></span><i class="edit_icon"></i></div></td>
				<td><div class="tDiv"><span onclick="listTable.edit(this, 'edit_warehouse_promote_price', <?php echo $this->_var['warehouse']['w_id']; ?>)"><?php echo $this->_var['warehouse']['warehouse_promote_price']; ?></span><i class="edit_icon"></i></div></td>
				<td><div class="tDiv"><span onclick="listTable.edit(this, 'edit_warehouse_give_integral', <?php echo $this->_var['warehouse']['w_id']; ?>)"><?php echo $this->_var['warehouse']['give_integral']; ?></span><i class="edit_icon"></i></div></td>
				<td><div class="tDiv"><span onclick="listTable.edit(this, 'edit_warehouse_rank_integral', <?php echo $this->_var['warehouse']['w_id']; ?>)"><?php echo $this->_var['warehouse']['rank_integral']; ?></span><i class="edit_icon"></i></div></td>
				<td><div class="tDiv"><span onclick="listTable.edit(this, 'edit_warehouse_pay_integral', <?php echo $this->_var['warehouse']['w_id']; ?>)"><?php echo $this->_var['warehouse']['pay_integral']; ?></span><i class="edit_icon"></i></div></td>
				<td class="handle">
                	<div class="tDiv a1 pl0">
                    <a href="javascript:void(0);" class="btn_trash" ectype="dropWarehouse" data-wid="<?php echo $this->_var['warehouse']['w_id']; ?>"><i class="icon icon-trash"></i><?php echo $this->_var['lang']['drop']; ?></a>
                    </div>
                    <input name="warehouse_id[]" value="<?php echo $this->_var['warehouse']['w_id']; ?>" type="hidden">
               	</td>
			</tr>
			<?php endforeach; else: ?>
			<tr>
				<td colspan="10" align="center" class="no_record"><div class="tDiv"><?php echo $this->_var['lang']['no_record']; ?></div></td>
			</tr>
			<?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="12"></td>
			</tr>
		</tfoot>
	</table>        
</div>
<?php endif; ?>
<?php if ($this->_var['model'] == 2): ?>
<div class="step_top_btn">	
	<a href="javascript:void(0);" class="btn red_btn" ectype="addRegion" data-userid="<?php echo $this->_var['user_id']; ?>" data-goodsid="<?php echo $this->_var['goods_id']; ?>"><i class="sc_icon sc_icon_warehouse"></i><?php echo $this->_var['lang']['add_areaRegion']; ?></a>
	<a href="goods_area_batch.php?act=add&goods_id=<?php echo $this->_var['goods_id']; ?>" class="btn red_btn" target="_blank"><?php echo $this->_var['lang']['add_batch_areaRegion']; ?></a>	
</div>
<div class="list-div">
	<table cellpadding="0" cellspacing="0" border="0">
		<thead>
			<tr>
				<th width="5%"><div class="tDiv"><?php echo $this->_var['lang']['record_id']; ?><div></th>
				<th width="5%"><div class="tDiv"><?php echo $this->_var['lang']['warehouse']; ?></div></th>
				<th width="5%"><div class="tDiv"><?php echo $this->_var['lang']['area']; ?></div></th>
                <?php if ($this->_var['area_pricetype'] == 1): ?>
                <th width="4%"><div class="tDiv"><?php echo $this->_var['lang']['the_city']; ?></div></th>
                <?php endif; ?>
                <th width="9%"><div class="tDiv"><?php echo $this->_var['lang']['product_code']; ?></div></th>
				<th width="9%"><div class="tDiv"><?php echo $this->_var['lang']['storage']; ?></div></th>
				<th width="9%"><div class="tDiv"><?php echo $this->_var['lang']['price']; ?></div></th>
				<th width="9%"><div class="tDiv"><?php echo $this->_var['lang']['promotion_price']; ?></div></th>
				<th width="9%"><div class="tDiv"><?php echo $this->_var['lang']['give_spand_integral']; ?></div></th>
				<th width="9%"><div class="tDiv"><?php echo $this->_var['lang']['give_level_integral']; ?></div></th>
				<th width="9%"><div class="tDiv"><?php echo $this->_var['lang']['integral_purchase_amount']; ?></div></th>
				<th width="6%"><div class="tDiv"><?php echo $this->_var['lang']['sort_order']; ?></div></th>
				<th width="6%" class="handle"><?php echo $this->_var['lang']['handler']; ?></th>
			</tr>
		</thead>
		<tbody>
			<?php $_from = $this->_var['warehouse_area_goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('i', 'area');if (count($_from)):
    foreach ($_from AS $this->_var['i'] => $this->_var['area']):
?>
			<tr>
				<td><div class="tDiv"><?php echo $this->_var['area']['a_id']; ?></div></td>
				<td><div class="tDiv"><?php echo $this->_var['area']['warehouse_name']; ?></div></td>
				<td><div class="tDiv"><?php echo $this->_var['area']['region_name']; ?></div></td>
                <?php if ($this->_var['area_pricetype'] == 1): ?>
                <td><div class="tDiv"><?php echo $this->_var['area']['city_name']; ?></div></td>
                <?php endif; ?>
                <td><div class="tDiv"><span onclick="listTable.edit(this, 'edit_region_sn', <?php echo $this->_var['area']['a_id']; ?>)"><?php echo empty($this->_var['area']['region_sn']) ? $this->_var['lang']['n_a'] : $this->_var['area']['region_sn']; ?></span><i class="edit_icon"></i></div></td>
				<td><div class="tDiv"><span onclick="listTable.edit(this, 'edit_region_number', <?php echo $this->_var['area']['a_id']; ?>)"><?php echo $this->_var['area']['region_number']; ?></span><i class="edit_icon"></i></div></td>
				<td><div class="tDiv"><span onclick="listTable.edit(this, 'edit_region_price', <?php echo $this->_var['area']['a_id']; ?>)"><?php echo $this->_var['area']['region_price']; ?></span><i class="edit_icon"></i></div></td>
				<td><div class="tDiv"><span onclick="listTable.edit(this, 'edit_region_promote_price', <?php echo $this->_var['area']['a_id']; ?>)"><?php echo $this->_var['area']['region_promote_price']; ?></span><i class="edit_icon"></i></div></td>
				<td><div class="tDiv"><span onclick="listTable.edit(this, 'edit_region_give_integral', <?php echo $this->_var['area']['a_id']; ?>)"><?php echo $this->_var['area']['give_integral']; ?></span><i class="edit_icon"></i></div></td>
				<td><div class="tDiv"><span onclick="listTable.edit(this, 'edit_region_rank_integral', <?php echo $this->_var['area']['a_id']; ?>)"><?php echo $this->_var['area']['rank_integral']; ?></span><i class="edit_icon"></i></div></td>
				<td><div class="tDiv"><span onclick="listTable.edit(this, 'edit_region_pay_integral', <?php echo $this->_var['area']['a_id']; ?>)"><?php echo $this->_var['area']['pay_integral']; ?></span><i class="edit_icon"></i></div></td>
				<td><div class="tDiv"><span onclick="listTable.edit(this, 'edit_region_sort', <?php echo $this->_var['area']['a_id']; ?>)"><?php echo $this->_var['area']['region_sort']; ?></span><i class="edit_icon"></i></div></td>
				<td class="handle">
                    <div class="tDiv a1 pl0">
                    <a href="javascript:void(0);" class="btn_trash" ectype="dropWarehouseArea" data-aid="<?php echo $this->_var['area']['a_id']; ?>"><i class="icon icon-trash"></i><?php echo $this->_var['lang']['drop']; ?></a>
                    </div>
                    <input name="warehouse_area_id[]" value="<?php echo $this->_var['area']['a_id']; ?>" type="hidden">
                </td>
			</tr>
			<?php endforeach; else: ?>
			<tr>
				<td colspan="13" align="center" class="no_record"><div class="tDiv"><?php echo $this->_var['lang']['no_record']; ?></div></td>
			</tr>			
			<?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="13"></td>
			</tr>
		</tfoot>
	</table>        
</div>
<?php endif; ?>