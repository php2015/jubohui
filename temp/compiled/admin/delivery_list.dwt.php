<?php if ($this->_var['full_page']): ?>
<!doctype html>
<html>
<head><?php echo $this->fetch('library/admin_html_head.lbi'); ?></head>

<body class="iframe_body">
	<div class="warpper">
    	<div class="title"><?php echo $this->_var['lang']['order_word']; ?> - <?php echo $this->_var['ur_here']; ?></div>
        <div class="content">
            <?php echo $this->fetch('library/common_tabs_info.lbi'); ?>
        	<div class="explanation" id="explanation">
                <div class="ex_tit"><i class="sc_icon"></i><h4><?php echo $this->_var['lang']['operating_hints']; ?></h4><span id="explanationZoom" title="<?php echo $this->_var['lang']['fold_tips']; ?>"></span></div>
                <ul>
                    <li><?php echo $this->_var['lang']['operation_prompt_content']['delivery_list']['0']; ?></li>
                    <li><?php echo $this->_var['lang']['operation_prompt_content']['delivery_list']['1']; ?></li>
                    <li><?php echo $this->_var['lang']['operation_prompt_content']['delivery_list']['2']; ?></li>
                </ul>
            </div>
            <div class="flexilist">
            	<div class="common-head">
                    <div class="search">
                    	<form action="javascript:;" name="searchForm" onSubmit="searchGoodsname(this);">
                        <div class="input">
                            <input type="text" name="order_sn" class="text nofocus" placeholder="<?php echo $this->_var['lang']['order_sn']; ?>" autocomplete="off" />
                            <input type="submit" class="btn" name="secrch_btn" ectype="secrch_btn" value="" />
                        </div>
                        </form>
                    </div>
                </div>
                <div class="common-content">
				<form method="post" action="order.php?act=operate" name="listForm" onsubmit="return check()">
                	<div class="list-div" id="listDiv" >
						<?php endif; ?>
                    	<table cellpadding="0" cellspacing="0" border="0">
                        	<thead>
                            	<tr>
                                	<th width="3%" class="sign"><div class="tDiv"><input type="checkbox" name="all_list" class="checkbox" id="all_list" /><label for="all_list" class="checkbox_stars"></label></div></th>
									<th width="10%"><div class="tDiv"><?php echo $this->_var['lang']['label_delivery_sn']; ?></div></th>
                                	<th width="12%"><div class="tDiv"><?php echo $this->_var['lang']['order_sn']; ?></div></th>
                                    <th width="10%"><div class="tDiv"><?php echo $this->_var['lang']['goods_steps_name']; ?></div></th>
                                    <th width="12%"><div class="tDiv"><?php echo $this->_var['lang']['label_add_time']; ?></div></th>
                                    <th width="12%"><div class="tDiv"><?php echo $this->_var['lang']['consignee']; ?></div></th>
                                    <th width="12%"><div class="tDiv"><?php echo $this->_var['lang']['label_update_time']; ?></div></th>
                                    <th width="8%"><div class="tDiv"><?php echo $this->_var['lang']['label_delivery_status']; ?></div></th>
									<th width="8%"><div class="tDiv"><?php echo $this->_var['lang']['operator']; ?></div></th>
                                    <th width="10%" class="handle"><?php echo $this->_var['lang']['handler']; ?></th>
                                </tr>
                            </thead>
                            <tbody>
								<?php $_from = $this->_var['delivery_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('dkey', 'delivery');if (count($_from)):
    foreach ($_from AS $this->_var['dkey'] => $this->_var['delivery']):
?>
								<tr>
                                	<td class="sign"><div class="tDiv"><input type="checkbox" value="<?php echo $this->_var['delivery']['delivery_id']; ?>" name="checkboxes[]" class="checkbox" id="checkbox_<?php echo $this->_var['delivery']['delivery_id']; ?>" /><label for="checkbox_<?php echo $this->_var['delivery']['delivery_id']; ?>" class="checkbox_stars"></label></div></td>
									<td><div class="tDiv"><?php echo $this->_var['delivery']['delivery_sn']; ?></div></td>
									<td><div class="tDiv"><?php echo $this->_var['delivery']['order_sn']; ?></div></td>
									<td><div class="tDiv"><?php if ($this->_var['delivery']['ru_name']): ?><font style="color:#F00;"><?php echo $this->_var['delivery']['ru_name']; ?></font><?php else: ?><font class="blue"><?php echo $this->_var['lang']['19_self_support']; ?></font><?php endif; ?></div></td>
									<td><div class="tDiv"><?php echo $this->_var['delivery']['add_time']; ?></div></td>
									<td><div class="tDiv"><a href="mailto:<?php echo $this->_var['delivery']['email']; ?>"> <?php echo htmlspecialchars($this->_var['delivery']['consignee']); ?></a></div></td>
									<td><div class="tDiv"><?php echo $this->_var['delivery']['update_time']; ?></div></td>
									<td><div class="tDiv"><?php echo $this->_var['delivery']['status_name']; ?></div></td>
									<td><div class="tDiv"><?php echo $this->_var['delivery']['action_user']; ?></div></td>
									<td class="handle">
										<div class="tDiv a2">
											<a href="order.php?act=delivery_info&delivery_id=<?php echo $this->_var['delivery']['delivery_id']; ?>" class="btn_see"><i class="sc_icon sc_icon_see"></i><?php echo $this->_var['lang']['view']; ?></a>
											<a onclick="{if(confirm('<?php echo $this->_var['lang']['confirm_delete']; ?>')){return true;}return false;}" href="order.php?act=operate&remove_invoice=1&delivery_id=<?php echo $this->_var['delivery']['delivery_id']; ?>" class="btn_trash"><i class="icon icon-trash"></i><?php echo $this->_var['lang']['drop']; ?></a>
										</div>
									</td>
								</tr>
								<?php endforeach; else: ?>
								<tr><td class="no-records" align="center" colspan="10"><?php echo $this->_var['lang']['no_records']; ?></td></tr>
								<?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
                            </tbody>
                            <tfoot>
                            	<tr>
                                    <td colspan="12">
                                        <div class="tDiv">
                                            <div class="tfoot_btninfo">
                                                <input type="submit" value="<?php echo $this->_var['lang']['drop']; ?>" name="remove_invoice" ectype="btnSubmit" class="btn btn_disabled" disabled="" onclick="{if(confirm('<?php echo $this->_var['lang']['confirm_delete']; ?>')){return true;}return false;}">
												<input type="submit" value="<?php echo $this->_var['lang']['batch_delivery']; ?>" name="batch_delivery" ectype="btnSubmit" class="btn btn_disabled" disabled="" style="display:none">
												<input type="button" value="<?php echo $this->_var['lang']['batch_delivery']; ?>" name="batch_button" ectype="btnSubmit" class="btn btn_disabled" disabled="">
												<div class="hide" ectype="daDialog"></div>
                                            </div>
                                            <div class="list-page">
                                                <?php echo $this->fetch('library/page.lbi'); ?>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
						<?php if ($this->_var['full_page']): ?>
                    </div>
				</form>
                </div>
            </div>
            <div class="gj_search">
                <div class="search-gao-list" id="searchBarOpen">
                    <i class="icon icon-zoom-in"></i><?php echo $this->_var['lang']['advanced_search']; ?>
                </div>
                <div class="search-gao-bar">
                    <div class="handle-btn" id="searchBarClose"><i class="icon icon-zoom-out"></i><?php echo $this->_var['lang']['pack_up']; ?></div>
                    <div class="title"><h3><?php echo $this->_var['lang']['advanced_search']; ?></h3></div>
                    <form method="get" name="formSearch_senior" action="javascript:searchOrder()">
                        <div class="searchContent">
                            <div class="layout-box">
                                <dl>
                                    <dt><?php echo $this->_var['lang']['order_sn']; ?></dt>
                                    <dd><input type="text" value="" name="order_sn" class="s-input-txt" autocomplete="off" /></dd>
                                </dl>
                                <dl>
                                    <dt><?php echo $this->_var['lang']['label_delivery_sn']; ?></dt>
                                    <dd><input type="text" value="" name="delivery_sn" class="s-input-txt" autocomplete="off" /></dd>
                                </dl>
                                <dl>
                                    <dt><?php echo htmlspecialchars($this->_var['lang']['consignee']); ?></dt>
                                    <dd><input type="text" value="" name="consignee" class="s-input-txt" autocomplete="off" /></dd>
                                </dl>
                                <dl>
                                    <dt><?php echo $this->_var['lang']['delivery_status_dt']; ?></dt>
                                    <dd>
                                        <div class="imitate_select select_w145">
                                            <div class="cite"><?php echo $this->_var['lang']['please_select']; ?></div>
                                            <ul>
                                               <li><a href="javascript:;" data-value="-1"><?php echo $this->_var['lang']['select_please']; ?></a></li>
                                               <?php $_from = $this->_var['lang']['delivery_status']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('k', 'list');if (count($_from)):
    foreach ($_from AS $this->_var['k'] => $this->_var['list']):
?>
                                               <li><a href="javascript:;" data-value="<?php echo $this->_var['k']; ?>"><?php echo $this->_var['list']; ?></a></li>
                                               <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                            </ul>
                                            <input name="status" type="hidden" value="-1">
                                        </div>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt><?php echo $this->_var['lang']['from_order']; ?></dt>
                                    <dd>
                                        <div id="order_referer" class="imitate_select select_w145">
                                          <div class="cite"><?php echo $this->_var['lang']['select_please']; ?></div>
                                          <ul>
                                             <li><a href="javascript:;" data-value=""><?php echo $this->_var['lang']['select_please']; ?></a></li>
                                             <li><a href="javascript:;" data-value="pc">PC</a></li>
                                             <li><a href="javascript:;" data-value="touch">WAP</a></li>
                                             <li><a href="javascript:;" data-value="mobile">APP</a></li>
                                             <li><a href="javascript:;" data-value="ecjia-cashdesk"><?php echo $this->_var['lang']['cashdesk']; ?></a></li>
                                          </ul>
                                        <input name="order_referer" type="hidden" value="" id="order_referer_val">
                                        </div>
                                    </dd>
                                </dl>                                 
                            </div>
                        </div>
                        <div class="bot_btn">
                            <input type="submit" class="btn red_btn" name="tj_search" value="<?php echo $this->_var['lang']['button_inquire']; ?>" /><input type="reset" class="btn btn_reset" name="reset" value="<?php echo $this->_var['lang']['button_reset_alt']; ?>" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
	<?php echo $this->fetch('library/pagefooter.lbi'); ?>
	<script type="text/javascript" src="js/jquery.purebox.js"></script>
    <script type="text/javascript">
	//列表导航栏设置下路选项
	$(".ps-container").perfectScrollbar();
	
	//分页传值
	listTable.recordCount = <?php echo empty($this->_var['record_count']) ? '0' : $this->_var['record_count']; ?>;
	listTable.pageCount = <?php echo empty($this->_var['page_count']) ? '1' : $this->_var['page_count']; ?>;
	listTable.query = "delivery_query";
		
	<?php $_from = $this->_var['filter']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
	listTable.filter.<?php echo $this->_var['key']; ?> = '<?php echo $this->_var['item']; ?>';
	<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

	$.gjSearch("-240px");  //高级搜索

 	/* 搜索订单 */
	function searchOrder()
	{
		var frm = $("form[name='formSearch_senior']");
		listTable.filter['order_sn'] = Utils.trim(($("form[name='searchForm']").find("input[name='order_sn']").val() != '') ? $("form[name='searchForm']").find("input[name='order_sn']").val() :  frm.find("input[name='order_sn']").val());
		listTable.filter['consignee'] = Utils.trim(frm.find("input[name='consignee']").val());
		listTable.filter['status'] = frm.find("input[name='status']").val();
		listTable.filter['delivery_sn'] = frm.find("input[name='delivery_sn']").val();
        listTable.filter['order_referer'] = frm.find("input[name='order_referer']").val();
		listTable.filter['page'] = 1;
		listTable.query = "delivery_query";
		listTable.loadList();
	}

	function check()
    {
		var snArray = new Array();
		var eles = document.forms['listForm'].elements;
		for (var i=0; i<eles.length; i++){
			if (eles[i].tagName == 'INPUT' && eles[i].type == 'checkbox' && eles[i].checked && eles[i].value != 'on'){
				snArray.push(eles[i].value);
			}
		}
		
		if (snArray.length == 0){
			return false;
		}else{
			eles['order_id'].value = snArray.toString();
			return true;
		}
    }
	
	//批量发货弹窗
	$(document).on('click', "input[name='batch_button']", function(){
		//移除数据
		$("*[ectype='daDialog']").find(".deliveryInfo").remove();
		//选中记录
		var delivery_ids = new Array();
		$("form[name='listForm']").find("input[name='checkboxes[]']:checked").each(function(){
			delivery_ids.push($(this).val());
		})
		//异步获取数据
		$.jqueryAjax('order.php', 'act=batch_ship&delivery_ids='+delivery_ids, function(data){
			pb({
				id:"delivery_dialog",
				title:'<?php echo $this->_var['lang']['batch_delivery']; ?>',
				width:1000,
				ok_title:'<?php echo $this->_var['lang']['button_submit_alt']; ?>', 	//按钮名称
				cl_title:'<?php echo $this->_var['lang']['cancel']; ?>', 	//按钮名称
				content:data.content, 	//调取内容
				drag:false,
				foot:true,
				onOk:function(){
					var div = $("#delivery_dialog").find(".deliveryInfo").clone();
					$("*[ectype='daDialog']").append(div);
					$("input[name='batch_delivery']").trigger("click");
				},
				onCancel:function(){},
				onClose:function(){}
			});			
		})
	});
	</script>
</body>
</html>
<?php endif; ?>