
<div class="tit">
    <span><?php echo $this->_var['province_row']['region_name']; ?>&nbsp;<?php echo $this->_var['city_row']['region_name']; ?>&nbsp;<?php echo $this->_var['district_row']['region_name']; ?></span><i class="iconfont icon-down"></i>
</div>
<div class="area-warp" id="area_list" ectype="areaWarp">
	<?php if ($this->_var['consignee_list']): ?>
	<div class="stock-add-used">
    	<div class="stock-top"><strong><?php echo $this->_var['lang']['Common_address']; ?></strong></div>
        <div class="stock-con">
        	<ul class="area-list-used">
            	<?php $_from = $this->_var['consignee_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'consignee');$this->_foreach['noconsignee'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['noconsignee']['total'] > 0):
    foreach ($_from AS $this->_var['consignee']):
        $this->_foreach['noconsignee']['iteration']++;
?>
            	<li <?php if (($this->_foreach['noconsignee']['iteration'] == $this->_foreach['noconsignee']['total'])): ?>class="last"<?php endif; ?>><a href="javascript:;" onClick="get_region_change(<?php echo $this->_var['goods_id']; ?>, <?php echo $this->_var['consignee']['province_id']; ?>, <?php echo $this->_var['consignee']['city_id']; ?>, <?php echo $this->_var['consignee']['district_id']; ?>);" title="<?php echo $this->_var['consignee']['address']; ?>"><?php echo $this->_var['consignee']['consignee']; ?>&nbsp;&nbsp;<?php echo $this->_var['consignee']['city_name']; ?><?php if ($this->_var['consignee']['address_id'] == $this->_var['address_id']): ?>&nbsp;&nbsp;(<?php echo $this->_var['lang']['default']; ?>)<?php endif; ?></a></li>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            </ul>
        </div>
    </div>
    <?php endif; ?>
    <ul class="tab" id="select_area">
        <li onclick="region.selectArea(this, 1);" value="<?php echo $this->_var['province_row']['region_id']; ?>" id="province_li"><?php echo $this->_var['province_row']['region_name']; ?><i class="sc-icon-right"></i></li>
        <li onclick="region.selectArea(this, 2);" value="<?php echo $this->_var['city_row']['region_id']; ?>" id="city_li"><?php echo $this->_var['city_row']['region_name']; ?><i class="sc-icon-right"></i></li>
        <li class="curr" onclick="region.selectArea(this, 3);" value="<?php echo $this->_var['city_district']['region_id']; ?>" id="district_type"><?php echo $this->_var['district_row']['region_name']; ?><i class="sc-icon-right"></i></li>
    </ul>
    <div class="tab-content" id="house_list" style="display:none;">
        <ul id="province_list">
             
            <?php $_from = $this->_var['province_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'province');$this->_foreach['noprovince'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['noprovince']['total'] > 0):
    foreach ($_from AS $this->_var['province']):
        $this->_foreach['noprovince']['iteration']++;
?>
                <li>
                    <a v="<?php echo $this->_var['province']['region_id']; ?>" title="<?php echo $this->_var['province']['region_name']; ?>" <?php if ($this->_var['province']['choosable']): ?>onclick="region.getRegion(<?php echo $this->_var['province']['region_id']; ?>, 2, city_list, this,<?php echo $this->_var['user_id']; ?>,<?php echo empty($this->_var['merchant_id']) ? '0' : $this->_var['merchant_id']; ?>);"<?php else: ?>class="choosable"<?php endif; ?> href="javascript:void(0);"><?php echo $this->_var['province']['region_name']; ?></a>
                </li>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            
        </ul>   
    </div>
    <div style="<?php if ($this->_var['district_row']['region_name'] == ''): ?>display: block;<?php else: ?>display: none;<?php endif; ?>" class="tab-content" id="city_list_id">
        <ul id="city_list">    
                               	                             
            <?php $_from = $this->_var['city_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'city');$this->_foreach['nocity'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['nocity']['total'] > 0):
    foreach ($_from AS $this->_var['city']):
        $this->_foreach['nocity']['iteration']++;
?>                                     
                <li>
                    <a v="<?php echo $this->_var['city']['region_id']; ?>" title="<?php echo $this->_var['city']['region_name']; ?>" <?php if ($this->_var['city']['choosable']): ?>onclick="region.getRegion(<?php echo $this->_var['city']['region_id']; ?>, 3, district_list, '<?php echo $this->_var['city']['region_name']; ?>',<?php echo $this->_var['user_id']; ?>,<?php echo empty($this->_var['merchant_id']) ? '0' : $this->_var['merchant_id']; ?>);"<?php else: ?>class="choosable"<?php endif; ?> href="javascript:void(0);"><?php echo $this->_var['city']['region_name']; ?></a>  
                </li>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>   
                              
        </ul>
    </div>
    <div class="tab-content" id="district_list_id" style="<?php if ($this->_var['district_row']['region_name'] == ''): ?>display: none;<?php else: ?>display: block;<?php endif; ?>">
        <ul id="district_list">              
                
            <?php $_from = $this->_var['district_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'district');$this->_foreach['nodistrict'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['nodistrict']['total'] > 0):
    foreach ($_from AS $this->_var['district']):
        $this->_foreach['nodistrict']['iteration']++;
?>
                <li>                     
                    <a v="<?php echo $this->_var['county']['region_id']; ?>" title="<?php echo $this->_var['district']['region_name']; ?>" <?php if ($this->_var['district']['choosable']): ?>onclick="region.changedDis(<?php echo $this->_var['district']['region_id']; ?>,<?php echo $this->_var['user_id']; ?>);"<?php else: ?>class="choosable"<?php endif; ?> href="javascript:void(0);" id="district_<?php echo $this->_var['district']['region_id']; ?>"><?php echo $this->_var['district']['region_name']; ?></a>  
                </li>    
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>     
                   
        </ul>
    </div>
    <div class="mod_storage_state"><?php echo $this->_var['lang']['Distribution_limit']; ?></div>
    <input type="hidden" value="<?php echo empty($this->_var['province_row']['region_id']) ? '0' : $this->_var['province_row']['region_id']; ?>" id="province_id" name="province_region_id">
    <input type="hidden" value="<?php echo empty($this->_var['city_row']['region_id']) ? '0' : $this->_var['city_row']['region_id']; ?>" id="city_id" name="city_region_id">
    <input type="hidden" value="<?php echo empty($this->_var['district_row']['region_id']) ? '0' : $this->_var['district_row']['region_id']; ?>" id="district_id" name="district_region_id">         
    <input type="hidden" value="<?php echo empty($this->_var['merchant_id']) ? '0' : $this->_var['merchant_id']; ?>" id="merchantId" name="merchantId">
    <input type="hidden" value="<?php echo empty($this->_var['region_id']) ? '0' : $this->_var['region_id']; ?>" id="region_id" name="region_id" />
    <input type="hidden" value="<?php echo empty($this->_var['area_id']) ? '0' : $this->_var['area_id']; ?>" id="area_id" name="area_id" />
    <input type="hidden" value="<?php echo empty($this->_var['area_city']) ? '0' : $this->_var['area_city']; ?>" id="area_city" name="area_city" />
</div>
  