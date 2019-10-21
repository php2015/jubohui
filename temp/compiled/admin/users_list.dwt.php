<!doctype html>
<?php if ($this->_var['full_page']): ?>
<html>
<head><?php echo $this->fetch('library/admin_html_head.lbi'); ?></head>

<body class="iframe_body">
	<div class="warpper">
    	<div class="title"><?php echo $this->_var['lang']['08_members']; ?> - <?php echo $this->_var['ur_here']; ?></div>
        <div class="content">
        	<?php echo $this->fetch('library/users_tab.lbi'); ?>
        	<div class="explanation" id="explanation">
                <div class="ex_tit"><i class="sc_icon"></i><h4><?php echo $this->_var['lang']['operating_hints']; ?></h4><span id="explanationZoom" title="<?php echo $this->_var['lang']['fold_tips']; ?>"></span></div>
                <ul>
                    <li><?php echo $this->_var['lang']['operation_prompt_content']['list']['0']; ?></li>
                    <li><?php echo $this->_var['lang']['operation_prompt_content']['list']['1']; ?></li>
                    <li><?php echo $this->_var['lang']['operation_prompt_content']['list']['2']; ?></li>
                </ul>
            </div>
            <div class="flexilist">
            	<div class="common-head">
                    <div class="fl">
                        <a href="<?php echo $this->_var['action_link2']['href']; ?>"><div class="fbutton"><div class="csv" title="<?php echo $this->_var['action_link2']['text']; ?>"><span><i class="icon icon-download-alt"></i><?php echo $this->_var['action_link2']['text']; ?></span></div></div></a>
                        <a href="<?php echo $this->_var['action_link']['href']; ?>"><div class="fbutton"><div class="add" title="<?php echo $this->_var['action_link']['text']; ?>"><span><i class="icon icon-plus"></i><?php echo $this->_var['action_link']['text']; ?></span></div></div></a>
                    </div>
                    
                   	<div class="refresh">
                    	<div class="refresh_tit" title="<?php echo $this->_var['lang']['refresh_data']; ?>"><i class="icon icon-refresh"></i></div>
                    	<div class="refresh_span"><?php echo $this->_var['lang']['refresh_common']; ?><?php echo $this->_var['record_count']; ?><?php echo $this->_var['lang']['record']; ?></div>
                    </div>
                    
                    <div class="search">
                    	<form action="javascript:;" name="searchForm" onSubmit="searchGoodsname(this);">
                        <div class="input">
                            <input type="text" name="keywords" class="text nofocus" placeholder="<?php echo $this->_var['lang']['label_user_name']; ?>" autocomplete="off" />
                            <input type="submit" class="btn" name="secrch_btn" ectype="secrch_btn" value="" />
                        </div>
                        </form>
                    </div>
                    
                </div>
                <div class="common-content">
                    <form method="POST" action="" name="listForm">
                	<div class="list-div"  id="listDiv">
                        <?php endif; ?>
                    	<table cellpadding="0" cellspacing="0" border="0">
                        	<thead>
                            	<tr>
                                    <th width="3%" class="sign"><div class="tDiv"><input type="checkbox" name="all_list" class="checkbox" id="all_list" /><label for="all_list" class="checkbox_stars"></label></div></th>
                                    <th width="5%"><div class="tDiv"><a href="javascript:listTable.sort('user_id'); "><?php echo $this->_var['lang']['record_id']; ?></a><?php echo $this->_var['sort_user_id']; ?></div></th>
                                    <th width="10%"><div class="tDiv"><a href="javascript:listTable.sort('user_name'); "><?php echo $this->_var['lang']['username']; ?></a><?php echo $this->_var['sort_user_name']; ?></div></th>
                                    <th width="10%"><div class="tDiv"><?php echo $this->_var['lang']['nick_name']; ?></div></th>
                                    <th width="8%"><div class="tDiv"><?php echo $this->_var['lang']['goods_steps_name']; ?></div></th>
                                    <th width="8%"><div class="tDiv"><?php echo $this->_var['lang']['email_phone']; ?></div></th>
                                    <th width="8%"><div class="tDiv"><?php echo $this->_var['lang']['reg_date']; ?></div></th>
                                    <th width="8%"><div class="tDiv">账户</div></th>
                                    <th width="6%"><div class="tDiv"><?php echo $this->_var['lang']['rank_points']; ?></div></th>
                                    <th width="6%"><div class="tDiv"><?php echo $this->_var['lang']['is_validated']; ?></div></th>
                                    <th width="12%" class="handle"><?php echo $this->_var['lang']['handler']; ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $_from = $this->_var['user_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'list');if (count($_from)):
    foreach ($_from AS $this->_var['list']):
?>
                            	<tr>
                                	<td class="sign"><div class="tDiv"><input type="checkbox" name="checkboxes[]" value="<?php echo $this->_var['list']['user_id']; ?>" class="checkbox" id="checkbox_<?php echo $this->_var['list']['user_id']; ?>" /><label for="checkbox_<?php echo $this->_var['list']['user_id']; ?>" class="checkbox_stars"></label></div></td>
                                    <td><div class="tDiv"><?php echo $this->_var['list']['user_id']; ?></div></td>
                                	<td><div class="tDiv"><?php echo $this->_var['list']['user_name']; ?></div></td>
                                    <td><div class="tDiv"><?php echo $this->_var['list']['nick_name']; ?></div></td>
                                    <td><div class="tDiv"><?php if ($this->_var['list']['ru_name']): ?><font class="red"><?php echo $this->_var['list']['ru_name']; ?></font><?php else: ?><font class="blue3"><?php echo $this->_var['lang']['mall_user']; ?></font><?php endif; ?></div></td>
                                    <td><div class="tDiv"><?php if ($this->_var['list']['mobile_phone']): ?><?php echo $this->_var['list']['mobile_phone']; ?><?php else: ?><?php echo $this->_var['lang']['not_phone']; ?><?php endif; ?><br><?php if ($this->_var['list']['email']): ?><?php echo $this->_var['list']['email']; ?><?php else: ?><?php echo $this->_var['lang']['not_email']; ?><?php endif; ?></div></td>
                                    <td><div class="tDiv"><?php echo $this->_var['list']['reg_time']; ?></div></td>
                                    <td>
                                        <div class="tDiv">
                                            <p><?php echo $this->_var['lang']['user_money']; ?>：<?php echo $this->_var['list']['user_money']; ?></p>
                                            <p><?php echo $this->_var['lang']['pay_points']; ?>：<?php echo $this->_var['list']['pay_points']; ?></p>
                                        </div>
                                    </td>
                                    <td><div class="tDiv"><?php echo $this->_var['list']['rank_points']; ?><br /><?php if ($this->_var['list']['rank_name']): ?><?php echo $this->_var['list']['rank_name']; ?><?php echo $this->_var['lang']['user']; ?><?php else: ?><span class="red"><?php echo $this->_var['lang']['not_rank']; ?></span><?php endif; ?></div></td>
                                    <td>
                                    	<div class="tDiv">
                                    		<div class="switch <?php if ($this->_var['list']['is_validated']): ?>active<?php endif; ?>" title="<?php if ($this->_var['list']['is_validated']): ?><?php echo $this->_var['lang']['yes']; ?><?php else: ?><?php echo $this->_var['lang']['no']; ?><?php endif; ?>" onclick="listTable.switchBt(this, 'toggle_is_validated', <?php echo $this->_var['list']['user_id']; ?>)">
                                            	<div class="circle"></div>
                                    		</div>
                                            <input type="hidden" value="0" name="">
                                        </div>
                                    </td>
                                    <td class="handle">
                                    	<div class="tDiv a2">
                                            <a href="users.php?act=edit&id=<?php echo $this->_var['list']['user_id']; ?>" class="btn_see"><i class="sc_icon sc_icon_see"></i><?php echo $this->_var['lang']['view']; ?></a>
                                            <a href="users.php?act=users_log&id=<?php echo $this->_var['list']['user_id']; ?>" class="btn_see"><i class="sc_icon sc_icon_see"></i><?php echo $this->_var['lang']['log']; ?></a>
                                            <a href="javascript:confirm_redirect('<?php if ($this->_var['user']['user_money'] != 0): ?><?php echo $this->_var['lang']['still_accounts']; ?><?php endif; ?><?php echo $this->_var['lang']['remove_confirm']; ?>', 'users.php?act=remove&id=<?php echo $this->_var['list']['user_id']; ?>')" title="<?php echo $this->_var['lang']['remove']; ?>" class="btn_trash"><i class="icon icon-trash"></i><?php echo $this->_var['lang']['drop']; ?></a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; else: ?>
                                    <tr><td class="no-records" colspan="12"><?php echo $this->_var['lang']['no_records']; ?></td></tr>
                                <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
                            </tbody>
                            <tfoot>
                            	<tr>
                                    <td colspan="12">
                                        <div class="tDiv">
                                            <div class="tfoot_btninfo">
                                                <input type="hidden" name="act" value="batch_remove" />
                                                <input type="button" value="<?php echo $this->_var['lang']['drop']; ?>" name="remove" ectype="btnSubmit" class="btn btn_disabled" disabled="">
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
                    <form method="get" name="formSearch_senior" action="javascript:searchUser()">
                        <div class="searchContent">
                            <div class="layout-box">
                                <dl>
                                    <dt><?php echo $this->_var['lang']['user_and_nick']; ?></dt>
                                    <dd><input type="text" value="" name="keyword" class="s-input-txt" autocomplete="off" /></dd>
                                </dl>
                                <dl>
                                    <dt><?php echo $this->_var['lang']['label_pay_point']; ?></dt>
                                    <dd><input type="text" value="" name="pay_points_lt"  class="s-input-txt-2" autocomplete="off" /><div class="bool">&nbsp;&nbsp;~&nbsp;&nbsp;</div><input type="text" value="" name="pay_points_gt"  class="s-input-txt-2"></dd>
                                </dl>
                                <dl>
                                    <dt><?php echo $this->_var['lang']['mobile_phone']; ?></dt>
                                    <dd><input type="text" value="" name="mobile_phone" class="s-input-txt" autocomplete="off" /></dd>
                                </dl>
                                <dl>
                                    <dt><?php echo $this->_var['lang']['email']; ?></dt>
                                    <dd><input type="text" value="" name="email" class="s-input-txt" autocomplete="off" /></dd>
                                </dl>
                                <dl>
                                    <dt><?php echo $this->_var['lang']['label_rank_name']; ?></dt>
                                    <dd>
                                        <div  class="select_w145 imitate_select">
                                            <div class="cite"><?php echo $this->_var['lang']['please_select']; ?></div>
                                            <ul>
                                               <li><a href="javascript:;" data-value="0"><?php echo $this->_var['lang']['all_option']; ?></a></li>
                                               <?php $_from = $this->_var['user_ranks']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('k', 'user_ranks_0_94856900_1568701055');if (count($_from)):
    foreach ($_from AS $this->_var['k'] => $this->_var['user_ranks_0_94856900_1568701055']):
?>
                                               <li><a href="javascript:;" data-value="<?php echo $this->_var['k']; ?>"><?php echo $this->_var['user_ranks_0_94856900_1568701055']; ?></a></li>
                                               <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                            </ul>
                                            <input name="user_rank" type="hidden" value="0">
                                        </div>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt><?php echo $this->_var['lang']['steps_shop_name']; ?></dt>
                                    <dd>
                                        <div id="shop_name_select" class="select_w145 imitate_select">
                                            <div class="cite"><?php echo $this->_var['lang']['please_select']; ?></div>
                                            <ul>
                                               <li><a href="javascript:;" data-value="0"><?php echo $this->_var['lang']['select_please']; ?></a></li>
                                               <li><a href="javascript:;" data-value="1"><?php echo $this->_var['lang']['s_shop_name']; ?></a></li>
                                               <li><a href="javascript:;" data-value="2"><?php echo $this->_var['lang']['s_qw_shop_name']; ?></a></li>
                                               <li><a href="javascript:;" data-value="3"><?php echo $this->_var['lang']['s_brand_type']; ?></a></li>
                                            </ul>
                                            <input name="store_search" type="hidden" value="0" id="shop_name_val">
                                        </div>
                                    </dd>
                                </dl>
                                <dl style="display:none" id="merchant_box">
                                    <dd>
                                        <div class="select_w145 imitate_select">
                                            <div class="cite"><?php echo $this->_var['lang']['please_select']; ?></div>
                                            <ul>
                                               <li><a href="javascript:;" data-value="0"><?php echo $this->_var['lang']['please_select']; ?></a></li>
                                               <?php $_from = $this->_var['store_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'store');if (count($_from)):
    foreach ($_from AS $this->_var['store']):
?>
                                               <li><a href="javascript:;" data-value="<?php echo $this->_var['store']['ru_id']; ?>"><?php echo $this->_var['store']['store_name']; ?></a></li>
                                               <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                            </ul>
                                            <input name="merchant_id" type="hidden" value="0" >
                                        </div>
                                    </dd>
                                </dl>
                                <dl id="store_keyword" style="display:none">
                                    <dd><input type="text" value="" name="store_keyword" class="s-input-txt" autocomplete="off" /></dd>
                                </dl>
                                <dl style="display:none" id="store_type">
                                    <dd>
                                        <div class="select_w145 imitate_select">
                                            <div class="cite"><?php echo $this->_var['lang']['please_select']; ?></div>
                                            <ul>
                                               <li><a href="javascript:;" data-value="0"><?php echo $this->_var['lang']['steps_shop_type']; ?></a></li>
                                               <li><a href="javascript:;" data-value="<?php echo $this->_var['lang']['flagship_store']; ?>"><?php echo $this->_var['lang']['flagship_store']; ?></a></li>
                                               <li><a href="javascript:;" data-value="<?php echo $this->_var['lang']['exclusive_shop']; ?>"><?php echo $this->_var['lang']['exclusive_shop']; ?></a></li>
                                               <li><a href="javascript:;" data-value="<?php echo $this->_var['lang']['franchised_store']; ?>"><?php echo $this->_var['lang']['franchised_store']; ?></a></li>
                                               <li><a href="javascript:;" data-value="<?php echo $this->_var['lang']['shop_store']; ?>"><?php echo $this->_var['lang']['shop_store']; ?></a></li>
                                            </ul>
                                            <input name="store_type" type="hidden" value="0" >
                                        </div>
                                    </dd>
                                </dl>
                                <dl class="bot_btn">
                                    <dd>
                                       <input type="submit" class="btn red_btn" name="tj_search" value="<?php echo $this->_var['lang']['button_inquire']; ?>" /><input type="reset" class="btn btn_reset" name="reset" value="<?php echo $this->_var['lang']['button_reset_alt']; ?>" />
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
    <?php echo $this->fetch('library/pagefooter.lbi'); ?>
	<script type="text/javascript">
    listTable.recordCount = <?php echo empty($this->_var['record_count']) ? '0' : $this->_var['record_count']; ?>;
    listTable.pageCount = <?php echo empty($this->_var['page_count']) ? '1' : $this->_var['page_count']; ?>;
    
    <?php $_from = $this->_var['filter']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
    listTable.filter.<?php echo $this->_var['key']; ?> = '<?php echo $this->_var['item']; ?>';
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    
    //列表导航栏设置下路选项
    $(".ps-container").perfectScrollbar();
    
    //高级搜索
    $.divselect("#divselect","#quesetion");
    
    $.divselect("#shop_name_select","#shop_name_val",function(obj){
        var val = obj.attr("data-value");
        get_store_search(val);
    });
	
    function get_store_search(val){
        if(val == 1){
			$("#merchant_box").css("display",'');
			$("#store_keyword").css("display",'none');
			$("#store_type").css("display",'none');
        }else if(val == 2){
			$("#merchant_box").css("display",'none');
			$("#store_keyword").css("display",'');
			$("#store_type").css("display",'none');
        }else if(val == 3){
			$("#merchant_box").css("display",'none');
			$("#store_keyword").css("display",'');
			$("#store_type").css("display",'');
        }else{
			$("#merchant_box").css("display",'none');
			$("#store_keyword").css("display",'none');
			$("#store_type").css("display",'none');
        }
    }
	
    //导出会员
    function download_userlist()
    {
		var args = '';
        var length = $(".list-div").find("input[name='checkboxes[]']:checked").length;
        
		for (var i in listTable.filter)
		{
			if(typeof(listTable.filter[i]) != "function" && typeof(listTable.filter[i]) != "undefined"){
				args += "&" + i + "=" + encodeURIComponent(listTable.filter[i]);
			}
		}
        
        if(length > 0){
            confirm_bath(1);
        }else{
            args += "&export=1";
            location.href = "users.php?act=export" + args;            
        }
    }
    
    function confirm_bath(type){
		if(type == 0){
            var userItems = $("input[name='checkboxes[]']");
            $("input[name='act']").val('batch_remove');
            cfm = '<?php echo $this->_var['lang']['list_remove_confirm']; ?>';
            
            for (i=0; userItems[i]; i++){
                if (userItems[i].checked && userItems[i].notice == 1){
                    cfm = '<?php echo $this->_var['lang']['list_still_accounts']; ?>' + '<?php echo $this->_var['lang']['list_remove_confirm']; ?>';
                    break;
                }
            }
            
            return confirm(cfm);
        }

        if(type == 1){
            $("input[name='act']").val('export');
            $("form[name='listForm']").submit();
        }
    }

    $("*[ectype='btnSubmit']").on('click',function(){
        if(confirm_bath(0) == true){
            $("form[name='listForm']").submit();
        }
    })
    
    /**
     * 搜索用户
     */
    function searchUser(){
        var frm = $("form[name='formSearch_senior']");
        listTable.filter['store_search'] = Utils.trim(frm.find("input[name='store_search']").val());
        listTable.filter['merchant_id'] = Utils.trim(frm.find("input[name='merchant_id']").val());
        listTable.filter['store_keyword'] = Utils.trim(frm.find("input[name='store_keyword']").val());
        listTable.filter['store_type'] = Utils.trim(frm.find("input[name='store_type']").val());
    
        listTable.filter['keywords'] = Utils.trim(frm.find("input[name='keyword']").val());
        listTable.filter['mobile_phone'] = Utils.trim(frm.find("input[name='mobile_phone']").val());
        listTable.filter['email'] = Utils.trim(frm.find("input[name='email']").val());
        listTable.filter['rank'] = frm.find("input[name='user_rank']").val();
        listTable.filter['pay_points_gt'] = Utils.trim(frm.find("input[name='pay_points_gt']").val());
        listTable.filter['pay_points_lt'] = Utils.trim(frm.find("input[name='pay_points_lt']").val());
        listTable.filter['page'] = 1;
        listTable.loadList();
    }
    
    $.gjSearch("-240px");  //高级搜索
	</script>
<?php endif; ?>
</body>
</html>
