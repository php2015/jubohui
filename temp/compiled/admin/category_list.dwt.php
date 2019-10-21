<!doctype html>
<html>
<head><?php echo $this->fetch('library/admin_html_head.lbi'); ?></head>

<body class="iframe_body">
	<div class="warpper">
    	<div class="title">
            <?php echo $this->_var['lang']['goods_alt']; ?> - <?php echo $this->_var['ur_here']; ?>
        </div>
        <div class="content">
        	<div class="tabs_info">
            	<ul>
                    <li <?php if ($this->_var['menu_select']['current'] == '03_category_list'): ?>class="curr"<?php endif; ?>><a href="category.php?act=list"><?php echo $this->_var['lang']['03_category_list']; ?></a></li>
                    <li <?php if ($this->_var['menu_select']['current'] == '03_store_category_list'): ?>class="curr"<?php endif; ?>><a href="category_store.php?act=list"><?php echo $this->_var['lang']['03_store_category_list']; ?></a></li>
                </ul>
            </div>		
        	<div class="explanation" id="explanation">
            	<div class="ex_tit"><i class="sc_icon"></i><h4><?php echo $this->_var['lang']['operating_hints']; ?></h4><span id="explanationZoom" title="<?php echo $this->_var['lang']['fold_tips']; ?>"></span></div>
                <ul>
                	<li><?php echo $this->_var['lang']['operation_prompt_content']['list']['0']; ?></li>
                    <li><?php echo $this->_var['lang']['operation_prompt_content']['list']['1']; ?></li>
                    <li><?php echo $this->_var['lang']['operation_prompt_content']['list']['2']; ?></li>
                    <li><?php echo $this->_var['lang']['operation_prompt_content']['list']['3']; ?></li>
                    <li><?php echo $this->_var['lang']['operation_prompt_content']['list']['4']; ?></li>
                </ul>
            </div>
            <div class="flexilist">
                <div class="common-head">
                    <div class="fl">
					<?php if ($this->_var['parent_id'] > 0): ?>
                    	<a href="category.php?act=list&parent_id=<?php echo $this->_var['parent_id']; ?>&back_level=<?php echo $this->_var['level']; ?>"><div class="fbutton"><div class="add" title="<?php echo $this->_var['lang']['go_back_level']; ?>"><span><i class="icon icon-reply"></i><?php echo $this->_var['lang']['go_back_level']; ?></span></div></div></a>
					<?php endif; ?>
					<a href="category.php?act=add<?php if ($this->_var['parent_id']): ?>&parent_id=<?php echo $this->_var['parent_id']; ?><?php endif; ?>"><div class="fbutton"><div class="add" title="<?php echo $this->_var['lang']['04_category_add']; ?>"><span><i class="icon icon-plus"></i><?php echo $this->_var['lang']['04_category_add']; ?></span></div></div></a>
                    </div>
                </div>
                <div class="common-content">
                	<div class="list-div">
                    	<table cellpadding="0" cellspacing="0" border="0">
                        	<thead>
                            	<tr>
                                	<th width="8%"><div class="tDiv"><?php echo $this->_var['lang']['level_alt']; ?>(<?php echo $this->_var['cat_level']; ?><?php echo $this->_var['lang']['level']; ?>)</div></th>
                                	<th width="20%"><div class="tDiv"><?php echo $this->_var['lang']['cat_name']; ?></div></th>
									<th width="10%"><div class="tDiv"><?php echo $this->_var['lang']['commission_rate']; ?>(%)</div></th>
                                    <th width="10%"><div class="tDiv"><?php echo $this->_var['lang']['goods_number']; ?></div></th>
                                    <th width="10%"><div class="tDiv"><?php echo $this->_var['lang']['measure_unit']; ?></div></th>
                                    <!-- <th width="10%"><div class="tDiv"><?php echo $this->_var['lang']['nav']; ?></div></th> -->
                                    <th width="10%"><div class="tDiv"><?php echo $this->_var['lang']['is_show']; ?></div></th>
                                    <th width="10%"><div class="tDiv"><?php echo $this->_var['lang']['short_grade']; ?></div></th>
                                    <th width="10%"><div class="tDiv"><?php echo $this->_var['lang']['sort_order']; ?></div></th>
                                    <th width="12%" class="handle"><?php echo $this->_var['lang']['handler']; ?></th>
                                </tr>
                            </thead>
                            <tbody>
								<?php $_from = $this->_var['cat_info']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cat');if (count($_from)):
    foreach ($_from AS $this->_var['cat']):
?>
                            	<tr>
                                	<td>
                                    	<div class="tDiv first_setup">
                                        	<div class="setup_span">
                                            	<em><i class="icon icon-cog"></i><?php echo $this->_var['lang']['setup']; ?><i class="arrow"></i></em>
                                                <ul>
                                                	<?php if ($this->_var['level'] < 2): ?>
                                                	<li><a href="category.php?act=add&parent_id=<?php echo $this->_var['cat']['cat_id']; ?>"><?php echo $this->_var['lang']['add_next_level']; ?></a></li>
                                                    <li><a href="category.php?act=list&parent_id=<?php echo $this->_var['cat']['cat_id']; ?>&level=<?php echo $this->_var['level']; ?>"><?php echo $this->_var['lang']['view_next_level']; ?></a></li>
                                                    <?php endif; ?>
                                                    <li><a href="javascript:void(0);" ectype="transfer_goods" data-cid="<?php echo $this->_var['cat']['cat_id']; ?>"><?php echo $this->_var['lang']['move_goods']; ?></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                    <td><div class="tDiv"><a href="goods.php?act=list&cat_id=<?php echo $this->_var['cat']['cat_id']; ?>" class="ftx-01"><?php echo $this->_var['cat']['cat_name']; ?></a></div></td>
                                    <td><div class="tDiv"><input type="text" name="commission_rate" class="text w40" value="<?php echo $this->_var['cat']['commission_rate']; ?>" onkeyup="listTable.editInput(this, 'edit_commission_rate', <?php echo $this->_var['cat']['cat_id']; ?>)"/></div></td>
                                    <td><div class="tDiv"><?php echo $this->_var['cat']['goods_num']; ?></div></td>
                                    <td><div class="tDiv"><input type="text" name="measure_unit" class="text w40" value="<?php echo $this->_var['cat']['measure_unit']; ?>" onkeyup="listTable.editInput(this, 'edit_measure_unit', <?php echo $this->_var['cat']['cat_id']; ?>)"/></div></td>
                                    <!-- <td>
                                    	<div class="tDiv">
                                        	<div class="switch <?php if ($this->_var['cat']['show_in_nav']): ?>active<?php endif; ?>" title="<?php if ($this->_var['cat']['show_in_nav']): ?><?php echo $this->_var['lang']['yes']; ?><?php else: ?><?php echo $this->_var['lang']['no']; ?><?php endif; ?>" onclick="listTable.switchBt(this, 'toggle_show_in_nav', <?php echo $this->_var['cat']['cat_id']; ?>)">
                                            	<div class="circle"></div>
                                            </div>
                                            <input type="hidden" value="0" name="">
                                        </div>
                                    </td> -->
                                    <td>
                                    	<div class="tDiv">
                                        	<div class="switch <?php if ($this->_var['cat']['is_show']): ?>active<?php endif; ?>" title="<?php if ($this->_var['cat']['is_show']): ?><?php echo $this->_var['lang']['yes']; ?><?php else: ?><?php echo $this->_var['lang']['no']; ?><?php endif; ?>" onclick="listTable.switchBt(this, 'toggle_is_show', <?php echo $this->_var['cat']['cat_id']; ?>)">
                                            	<div class="circle"></div>
                                            </div>
                                            <input type="hidden" value="0" name="">
                                        </div>
                                    </td>
                                    <td><div class="tDiv"><input type="text" name="grade" class="text w40" value="<?php echo $this->_var['cat']['grade']; ?>" onkeyup="listTable.editInput(this, 'edit_grade', <?php echo $this->_var['cat']['cat_id']; ?>)"/></div></td>
                                    <td><div class="tDiv"><input type="text" name="sort_order" class="text w40" value="<?php echo $this->_var['cat']['sort_order']; ?>" onkeyup="listTable.editInput(this, 'edit_sort_order', <?php echo $this->_var['cat']['cat_id']; ?>)"/></div></td>
                                    <td class="handle">
                                        <div class="tDiv a2">
                                            <a href="category.php?act=edit&amp;cat_id=<?php echo $this->_var['cat']['cat_id']; ?>" class="btn_edit"><i class="icon icon-edit"></i><?php echo $this->_var['lang']['edit']; ?></a>
                                            <a href="javascript:remove_cat(<?php echo $this->_var['cat']['cat_id']; ?>,<?php echo $this->_var['cat']['level']; ?>);" class="btn_trash"><i class="icon icon-trash"></i><?php echo $this->_var['lang']['drop']; ?></a>
                                        </div>
                                    </td>
                                </tr>
								<?php endforeach; else: ?>
								<tr><td class="no-records" colspan="10"><?php echo $this->_var['lang']['no_records']; ?></td></tr>
								<?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
                            </tbody>                         
                        </table>        
                    </div>
                </div>
            </div>
		</div>
	</div>
	<?php echo $this->fetch('library/pagefooter.lbi'); ?>
    <script type="text/javascript">
		//转移分类
		$(document).on('click',"*[ectype='transfer_goods']",function(){
       		if(confirm(catename_level_transfer_yes)){
			var cat_id = $(this).data("cid");
			$.jqueryAjax("category.php", "act=move&cat_id="+cat_id, function(data){
				var content = data.content;
				if(data.error == 1){
					alert(data.message);
					return false;
				}
				pb({
					id:"transfer_dialog",
					title:"<?php echo $this->_var['lang']['move_goods']; ?>",
					width:732,
					content:content,
					ok_title:"<?php echo $this->_var['lang']['start_move_cat']; ?>",
					cl_title:"<?php echo $this->_var['lang']['button_reset_alt']; ?>",
					drag:false,
					foot:true,
					onOk:function(){
						$("#moveCategory").submit();
					}
				});
				$.category();  //分类选择
				$(".select-list").hover(function(){
					$(".select-list").perfectScrollbar("destroy");
					$(".select-list").perfectScrollbar();
				});
			});
                    }
		});
		
		function remove_cat(cat_id,level){
			if (confirm(is_delete_info)) {
			   Ajax.call('category.php?is_ajax=1&act=remove', "cat_id="+cat_id+"&level="+level, remove_catResponse, "GET", "JSON");
			}
		}
	
		function remove_catResponse(result){
			if(result.error == 2){
				alert(result.massege);
			}
			else if(result.error == 1){
				alert(result.message);
			}
			else{
				window.location.reload();
			}
		}	
    </script>
</body>
</html>
