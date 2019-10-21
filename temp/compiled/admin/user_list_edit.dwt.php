<?php if ($this->_var['full_page']): ?>
<!doctype html>
<html>
<head><?php echo $this->fetch('library/admin_html_head.lbi'); ?></head>
<body class="iframe_body">
	<div class="warpper">
    	<div class="title"><a href="<?php echo $this->_var['action_link2']['href']; ?>" class="s-back"><?php echo $this->_var['lang']['back']; ?></a><?php echo $this->_var['lang']['08_members']; ?> - <?php echo $this->_var['ur_here']; ?></div>
            <div class="content">
        	<div class="tabs_info">
            	<ul>
                    <li <?php if ($this->_var['form_action'] == 'update'): ?>class="curr"<?php endif; ?>><a href="users.php?act=edit&id=<?php echo $this->_var['user_id']; ?>"><?php echo $this->_var['lang']['users_note']; ?></a></li>
                    <li <?php if ($this->_var['form_action'] == 'address_list'): ?>class="curr"<?php endif; ?>><a href="users.php?act=address_list&id=<?php echo $this->_var['user_id']; ?>"><?php echo $this->_var['lang']['address_list']; ?></a></li>
                    <li><a href="order.php?act=list&user_id=<?php echo $this->_var['user_id']; ?>"><?php echo $this->_var['lang']['view_order']; ?></a></li>
                    <li <?php if ($this->_var['form_action'] == 'bt_edit'): ?>class="curr"<?php endif; ?>><a href="user_baitiao_log.php?act=bt_add_tp&user_id=<?php echo $this->_var['user_id']; ?>"><?php echo $this->_var['lang']['set_baitiao']; ?></a></li>
                    <li <?php if ($this->_var['form_action'] == 'account_log'): ?>class="curr"<?php endif; ?>><a href="account_log.php?act=list&user_id=<?php echo $this->_var['user_id']; ?>"><?php echo $this->_var['lang']['account_log']; ?></a></li>
                </ul>
            </div>
            <div class="explanation" id="explanation">
            	<div class="ex_tit"><i class="sc_icon"></i><h4><?php echo $this->_var['lang']['operating_hints']; ?></h4><span id="explanationZoom" title="<?php echo $this->_var['lang']['fold_tips']; ?>"></span></div>
                <ul>
                    <li><?php echo $this->_var['lang']['operation_prompt_content']['edit']['0']; ?></li>
                    <li><?php echo $this->_var['lang']['operation_prompt_content_common']; ?></li>
                </ul>
            </div>
            <div class="flexilist">
                <div class="mian-info">
				<?php endif; ?>
                    <?php if ($this->_var['form_action'] == 'update'): ?>
                        <div class="switch_info user_basic" style="display:block;">
                            <form method="post" action="users.php" name="theForm" id="user_update">
                                <div class="item">
                                    <div class="label"><?php echo $this->_var['lang']['require_field']; ?>&nbsp;<?php echo $this->_var['lang']['username']; ?>：</div>
                                    <div class="label_value font14"><?php echo $this->_var['user']['user_name']; ?></div>
                                </div>
                                <div class="item">
                                    <div class="label"><?php echo $this->_var['lang']['user_money']; ?>：</div>
                                    <div class="label_value">
                                        <div class="b-price blue font14 mr20"><?php echo $this->_var['user']['formated_user_money']; ?></div>
                                        <div class="label_label"><?php echo $this->_var['lang']['rank_points']; ?>：</div>
                                        <div class="b-price blue font14 mr20 pl10"><?php echo $this->_var['user']['rank_points']; ?></div>
                                        <div class="notic"><?php echo $this->_var['lang']['notice_rank_points']; ?></div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="label"><?php echo $this->_var['lang']['frozen_money']; ?>：</div>
                                    <div class="label_value">
                                        <div class="b-price blue font14 mr20"><?php echo $this->_var['user']['formated_frozen_money']; ?></div>
                                        <div class="label_label"><?php echo $this->_var['lang']['pay_points']; ?>：</div>
                                        <div class="b-price blue font14 mr20 pl10"><?php echo $this->_var['user']['pay_points']; ?></div>
                                        <div class="notic"><?php echo $this->_var['lang']['notice_pay_points']; ?></div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="label"><?php echo $this->_var['lang']['email']; ?>：</div>
                                    <div class="label_value">
                                        <input type="text" name="email" class="text" autocomplete="off" value="<?php echo $this->_var['user']['email']; ?>" id="email"/>
                                        <input type="hidden" name="old_email" value="<?php echo $this->_var['user']['email']; ?>"/>
                                        <div class="form_prompt"></div>
                                        <div class="notic"><?php echo $this->_var['lang']['notice_user_email']; ?></div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="label"><?php echo $this->_var['lang']['newpass']; ?>：</div>
                                    <div class="label_value"><input type="text" name="password" class="text" autocomplete="off" id="password" /></div>
                                </div>
                                <div class="item">
                                    <div class="label"><?php echo $this->_var['lang']['confirm_password']; ?>：</div>
                                    <div class="label_value">
                                        <input type="text" name="confirm_password" class="text" autocomplete="off" id="confirm_password"/>
                                        <div class="form_prompt"></div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="label"><?php echo $this->_var['lang']['user_rank']; ?>：</div>
                                    <div class="label_value">
                                        <div id="user_grade" class="imitate_select select_w320">
                                          <div class="cite">
                                              <?php if ($this->_var['user']['user_rank'] > 0): ?>
                                                <?php if ($this->_var['special_ranks'][$this->_var['user']['user_rank']]): ?>
                                                <?php echo $this->_var['special_ranks'][$this->_var['user']['user_rank']]; ?>
                                                <?php else: ?>
                                                <?php echo $this->_var['lang']['not_special_rank']; ?>
                                                <?php endif; ?>
                                              <?php else: ?>
                                                <?php echo $this->_var['lang']['not_special_rank']; ?>
                                              <?php endif; ?>
                                          </div>
                                          <ul>
                                             <li><a href="javascript:;" data-value="0" class="ftx-01"><?php echo $this->_var['lang']['not_special_rank']; ?></a></li>
                                             <?php $_from = $this->_var['special_ranks']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('k', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['k'] => $this->_var['item']):
?>
                                             <li><a href="javascript:;" data-value="<?php echo $this->_var['k']; ?>" class="ftx-01"><?php echo $this->_var['item']; ?></a></li>
                                             <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                          </ul>
                                          <input name="user_rank" type="hidden" value="<?php echo $this->_var['user']['user_rank']; ?>" id="user_grade_val">
                                        </div>
                                        <input type="hidden" name="old_user_rank" value="<?php echo $this->_var['user']['user_rank']; ?>"/>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="label"><?php echo $this->_var['lang']['gender']; ?>：</div>
                                    <div class="label_value">
                                        <div class="checkbox_items">
                                            <?php $_from = $this->_var['lang']['sex']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('k', 'sex');if (count($_from)):
    foreach ($_from AS $this->_var['k'] => $this->_var['sex']):
?>
                                            <div class="checkbox_item">
                                                <input type="radio" class="ui-radio" name="sex" id="sex_<?php echo $this->_var['k']; ?>" value="<?php echo $this->_var['k']; ?>" <?php if ($this->_var['user']['sex'] == $this->_var['k']): ?> checked <?php endif; ?>/>
                                                <label for="sex_<?php echo $this->_var['k']; ?>" class="ui-radio-label"><?php echo $this->_var['sex']; ?></label>
                                            </div>
                                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                        </div>
                                        <input type="hidden" name="old_sex" value="<?php echo $this->_var['user']['sex']; ?>"/>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="label"><?php echo $this->_var['lang']['birthday']; ?>：</div>
                                    <div class="label_value">
                                        <div class="date-item year">
                                            <div id="user_year" class="imitate_select select_w120">
                                              <div class="cite"><?php if ($this->_var['user']['year']): ?><?php echo $this->_var['user']['year']; ?><?php else: ?><?php echo $this->_var['lang']['please_select']; ?><?php endif; ?></div>
                                              <ul>
                                                 <?php $_from = $this->_var['select_date']['year']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'year');if (count($_from)):
    foreach ($_from AS $this->_var['year']):
?>
                                                 <li><a href="javascript:;" data-value="<?php echo $this->_var['year']; ?>" class="ftx-01"><?php echo $this->_var['year']; ?></a></li>
                                                 <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                              </ul>
                                              <input name="birthdayYear" type="hidden" value="<?php echo $this->_var['user']['year']; ?>" id="year_val">
                                            </div>
                                        </div>
                                        <div class="date-item month">
                                            <div id="user_month" class="imitate_select select_w85">
                                                <div class="cite"><?php if ($this->_var['user']['month']): ?><?php echo $this->_var['user']['month']; ?><?php else: ?><?php echo $this->_var['lang']['please_select']; ?><?php endif; ?></div>
                                                <ul>
                                                    <?php $_from = $this->_var['select_date']['month']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'month');if (count($_from)):
    foreach ($_from AS $this->_var['month']):
?>
                                                        <li><a href="javascript:;" data-value="<?php echo $this->_var['month']; ?>" class="ftx-01"><?php echo $this->_var['month']; ?></a></li>
                                                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                                </ul>
                                                <input name="birthdayMonth" type="hidden" value="<?php echo $this->_var['user']['month']; ?>" id="month_val">
                                            </div>
                                        </div>
                                        <div class="date-item day">
                                            <div id="user_day" class="imitate_select select_w85">
                                                <div class="cite"><?php if ($this->_var['user']['day']): ?><?php echo $this->_var['user']['day']; ?><?php else: ?><?php echo $this->_var['lang']['please_select']; ?><?php endif; ?></div>
                                                <ul>
                                                    <?php $_from = $this->_var['select_date']['day']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'day');if (count($_from)):
    foreach ($_from AS $this->_var['day']):
?>
                                                    <li><a href="javascript:;" data-value="<?php echo $this->_var['day']; ?>" class="ftx-01"><?php echo $this->_var['day']; ?></a></li>
                                                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                                </ul>
                                                <input name="birthdayDay" type="hidden" value="<?php echo $this->_var['user']['day']; ?>" id="day_val">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="old_birthday" value="<?php echo $this->_var['user']['birthday']; ?>"/>
                                <div class="item">
                                    <div class="label"><?php echo $this->_var['lang']['credit_line']; ?>：</div>
                                    <div class="label_value">
                                        <input type="text" name="credit_line" id="credit_line" value="<?php echo $this->_var['user']['credit_line']; ?>" class="text" autocomplete="off" />
                                        <input type="hidden" name="old_credit_line" value="<?php echo $this->_var['user']['credit_line']; ?>"/>
                                    </div>
                                </div>

                                <?php if ($this->_var['user']['real_id']): ?>
                                <div class="item">
                                    <div class="label"><?php echo $this->_var['lang']['idcard_info']; ?>：</div>
                                    <div class="label_value">
										<div class="type-file-box">
                                            <span class="show"><?php echo $this->_var['lang']['frontage']; ?>：
                                            	<a href="<?php echo $this->_var['user']['front_of_id_card']; ?>" target="_blank" class="nyroModal"><i class="icon icon-picture" data-tooltipimg="<?php echo $this->_var['user']['front_of_id_card']; ?>" ectype="tooltip" title="tooltip"></i></a>
                                            </span>
                                            <span class="show"><?php echo $this->_var['lang']['opposite']; ?>：
                                            	<a href="<?php echo $this->_var['user']['reverse_of_id_card']; ?>" target="_blank" class="nyroModal"><i class="icon icon-picture" data-tooltipimg="<?php echo $this->_var['user']['reverse_of_id_card']; ?>" ectype="tooltip" title="tooltip"></i></a>
                                            </span>
                                        </div>								
									</div>
								</div>
                                <?php endif; ?>
                                <?php $_from = $this->_var['extend_info_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'field');if (count($_from)):
    foreach ($_from AS $this->_var['field']):
?>
                                <!-- <?php if ($this->_var['field']['id'] == 6): ?> -->
                                  <div class="item">
                                    <div class="label"><?php echo $this->_var['lang']['passwd_question']; ?>：</div>
                                    <div class="label_value">
                                        <div id="user_sel_question" class="imitate_select select_w320">
                                          <div class="cite">
                                              <?php if ($this->_var['user']['passwd_question']): ?>
                                                <?php if ($this->_var['passwd_questions'][$this->_var['user']['passwd_question']]): ?>
                                                    <?php echo $this->_var['passwd_questions'][$this->_var['user']['passwd_question']]; ?>
                                                <?php else: ?>
                                                    <?php echo $this->_var['lang']['sel_question']; ?>
                                                <?php endif; ?>
                                              <?php else: ?>
                                                <?php echo $this->_var['lang']['sel_question']; ?>
                                              <?php endif; ?>
                                          </div>
                                          <ul>
                                             <?php $_from = $this->_var['passwd_questions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('k', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['k'] => $this->_var['item']):
?>
                                             <li><a href="javascript:;" data-value="<?php echo $this->_var['k']; ?>" class="ftx-01"><?php echo $this->_var['item']; ?></a></li>
                                             <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                          </ul>
                                          <input name="sel_question" type="hidden" value="<?php echo $this->_var['user']['passwd_question']; ?>" id="sel_question">
                                        </div>
                                        <input type="hidden" name="old_sel_question" value="<?php echo $this->_var['user']['passwd_question']; ?>"/>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="label" <?php if ($this->_var['field']['is_need']): ?>id="passwd_quesetion"<?php endif; ?>><?php echo $this->_var['lang']['passwd_answer']; ?>：</div>
                                    <div class="label_value"><input type="text" name="passwd_answer" class="text" value="<?php echo $this->_var['user']['passwd_answer']; ?>" autocomplete="off" /><input type="hidden" name="old_passwd_answer" value="<?php echo $this->_var['user']['passwd_answer']; ?>"/>&nbsp;<?php if ($this->_var['field']['is_need']): ?><?php echo $this->_var['lang']['require_field']; ?><?php endif; ?></div>
                                </div>
                                <!-- <?php else: ?> -->
                                <div class="item">
                                    <div class="label"><?php echo $this->_var['field']['reg_field_name']; ?>：</div>
                                    <div class="label_value">
                                        <input type="text" name="extend_field<?php echo $this->_var['field']['id']; ?>" class="text" value="<?php echo $this->_var['field']['content']; ?>" autocomplete="off" />
                                        <input type="hidden" name="old_extend_field<?php echo $this->_var['field']['id']; ?>" value="<?php echo $this->_var['field']['content']; ?>"/>
                                    </div>
                                </div>
                                <!--<?php endif; ?>-->
                                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                <?php if ($this->_var['user']['parent_id']): ?>
                                <div class="item">
                                    <div class="label"><?php echo $this->_var['lang']['parent_user']; ?>：</div>
                                    <div class="label_value font14"><a href="users.php?act=edit&id=<?php echo $this->_var['user']['parent_id']; ?>"/><?php echo $this->_var['user']['parent_username']; ?></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="users.php?act=remove_parent&id=<?php echo $this->_var['user']['user_id']; ?>"><?php echo $this->_var['lang']['parent_remove']; ?></a></div>
                                </div>
                                <?php endif; ?>
                                <?php if ($this->_var['affiliate']['on'] == 1 && $this->_var['affdb']): ?>
                                <div class="item">
                                    <div class="label"><?php echo $this->_var['lang']['affiliate_user']; ?>：</div>
                                    <div class="label_value font14">[<a href="users.php?act=aff_list&auid=<?php echo $this->_var['user']['user_id']; ?>"><?php echo $this->_var['lang']['show_affiliate_users']; ?></a>][<a href="affiliate_ck.php?act=list&auid=<?php echo $this->_var['user']['user_id']; ?>"><?php echo $this->_var['lang']['show_affiliate_orders']; ?></a>]</div>
                                </div>
                                <div class="item">
                                    <div class="label">&nbsp;</div>
                                    <div class="label_value tj_user font14">
                                        <table class="table_div table_heng">
                                            <tbody>
                                                <tr class="first_tr">
                                                    <td class="first_td"><?php echo $this->_var['lang']['affiliate_lever']; ?></td>
                                                    <?php $_from = $this->_var['affdb']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('level', 'val0');if (count($_from)):
    foreach ($_from AS $this->_var['level'] => $this->_var['val0']):
?>
                                                    <td><?php echo $this->_var['level']; ?></td>
                                                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                                </tr>
                                                <tr>
                                                    <td class="first_td"><?php echo $this->_var['lang']['affiliate_num']; ?></td>
                                                    <?php $_from = $this->_var['affdb']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'val');if (count($_from)):
    foreach ($_from AS $this->_var['val']):
?>
                                                    <td><?php echo $this->_var['val']['num']; ?></td>
                                                	<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                                </tr>
                                        	</tbody>
                                        </table>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <div class="item">
                                    <div class="label">&nbsp;</div>
                                    <div class="label_value info_btn">
                                        <a href="javascript:;" class="button" id="submitBtn"><?php echo $this->_var['lang']['button_submit']; ?></a>
                                        <input type="hidden" name="act" value="<?php echo $this->_var['form_action']; ?>" />
                                        <input type="hidden" name="id" value="<?php echo $this->_var['user']['user_id']; ?>" />
                                        <input type="hidden" name="username" value="<?php echo $this->_var['user']['user_name']; ?>" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    <?php endif; ?>
                    <?php if ($this->_var['form_action'] == 'address_list'): ?>
                    <div class="switch_info user_address">
                        <div class="common-content">
                            <div class="list-div" id="listDiv">
                                <table cellpadding="0" cellspacing="0" border="0">
                                    <thead>
                                        <tr>
                                            <th width="8%"><div class="tDiv"><?php echo $this->_var['lang']['consignee']; ?></div></th>
                                            <th width="23%"><div class="tDiv"><?php echo $this->_var['lang']['address']; ?></div></th>
                                            <th width="10%"><div class="tDiv"><?php echo $this->_var['lang']['mobile']; ?></div></th>
                                            <th width="10%"><div class="tDiv"><?php echo $this->_var['lang']['email']; ?></div></th>
                                            <th width="10%"><div class="tDiv"><?php echo $this->_var['lang']['tel']; ?></div></th>
                                            <th width="8%"><div class="tDiv"><?php echo $this->_var['lang']['zipcode']; ?></div></th>
                                            <th width="8%"><div class="tDiv"><?php echo $this->_var['lang']['sign_building']; ?></div></th>
                                            <th width="10%"><div class="tDiv"><?php echo $this->_var['lang']['best_time']; ?></div></th>
                                            <th width="10%" class="handle"><?php echo $this->_var['lang']['handler']; ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $_from = $this->_var['address']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('Key', 'val');$this->_foreach['address'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['address']['total'] > 0):
    foreach ($_from AS $this->_var['Key'] => $this->_var['val']):
        $this->_foreach['address']['iteration']++;
?>
                                        <tr>
                                            <td><div class="tDiv"><?php echo htmlspecialchars($this->_var['val']['consignee']); ?></div></td>
                                            <td><div class="tDiv">[<?php echo $this->_var['val']['country_name']; ?>&nbsp;<?php echo $this->_var['val']['province_name']; ?>&nbsp;<?php echo $this->_var['val']['city_name']; ?>&nbsp;<?php echo $this->_var['val']['district_name']; ?>] <?php echo htmlspecialchars($this->_var['val']['address']); ?><?php if ($this->_var['val']['zipcode']): ?>[<?php echo htmlspecialchars($this->_var['val']['zipcode']); ?>]<?php endif; ?></div></td>
                                            <td><div class="tDiv"><?php echo $this->_var['val']['mobile']; ?></div></td>
                                            <td><div class="tDiv"><?php echo $this->_var['val']['email']; ?></div></td>
                                            <td><div class="tDiv"><?php echo $this->_var['val']['tel']; ?></div></td>
                                            <td><div class="tDiv"><?php echo htmlspecialchars($this->_var['val']['zipcode']); ?></div></td>
                                            <td><div class="tDiv"><?php echo htmlspecialchars($this->_var['val']['sign_building']); ?></div></td>
                                            <td><div class="tDiv"><?php echo htmlspecialchars($this->_var['val']['best_time']); ?></div></td>
                                            <td class="handle">
                                                <div class="tDiv a2">
                                                    <a href="user_address_log.php?act=edit&address_id=<?php echo $this->_var['val']['address_id']; ?>&user_id=<?php echo $this->_var['val']['user_id']; ?>" title="<?php echo $this->_var['lang']['edit']; ?>" class="btn_edit"><i class="icon icon-edit"></i><?php echo $this->_var['lang']['edit']; ?></a>
                                                    <a href="javascript:confirm_redirect('<?php echo $this->_var['lang']['remove_confirm_address']; ?>', 'user_address_log.php?act=remove&id=<?php echo $this->_var['val']['address_id']; ?>')" title="<?php echo $this->_var['lang']['remove']; ?>" class="btn_trash"><i class="icon icon-trash"></i><?php echo $this->_var['lang']['drop']; ?></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach; else: ?>
                                        <tr><td class="no-records" colspan="12"><?php echo $this->_var['lang']['no_records']; ?></td></tr>
                                        <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if ($this->_var['form_action'] == 'order_list'): ?>
                        <div class="switch_info user_order">
                        </div>
                    <?php endif; ?>
                    <?php if ($this->_var['form_action'] == 'bt_edit'): ?>
                    	<div class="common-head">
                            <div class="fl">
                                <a href="<?php echo $this->_var['action_link']['href']; ?>"><div class="fbutton"><div class="add" title="<?php echo $this->_var['action_link']['text']; ?>"><span><i class="icon icon-plus"></i><?php echo $this->_var['action_link']['text']; ?></span></div></div></a>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="switch_info user_set_baitiao">
                            <form method="post" action="user_baitiao_log.php" name="theForm" id="user_baitiao_log">
                                <div class="common-content">
                                    <div class="item">
                                        <div class="label"><?php echo $this->_var['lang']['require_field']; ?>&nbsp;<?php echo $this->_var['lang']['user_name']; ?>：</div>
                                        <div class="label_value font14"><?php echo $this->_var['user_info']['user_name']; ?><input type="hidden" name="user_id" value="<?php echo $this->_var['user_info']['user_id']; ?>" /></div>
                                    </div>
                                    <div class="item">
                                        <div class="label"><?php echo $this->_var['lang']['require_field']; ?>&nbsp;<?php echo $this->_var['lang']['financial_credit']; ?>：</div>
                                        <div class="label_value">
                                            <input type="text" name="amount" class="text" autocomplete="off" value="<?php echo $this->_var['bt_info']['amount']; ?>"  id="amount"/>
                                            <div class="form_prompt"></div>
                                            <div class="notic"><?php echo $this->_var['lang']['notice_financial_credit']; ?></div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="label"><?php echo $this->_var['lang']['require_field']; ?>&nbsp;<?php echo $this->_var['lang']['Credit_payment_days']; ?>：</div>
                                        <div class="label_value">
                                            <input type="text" name="repay_term" class="text" autocomplete="off" value="<?php echo $this->_var['bt_info']['repay_term']; ?>" id="repay_term"/>
                                            <div class="form_prompt"></div>
                                            <div class="notic"><?php echo $this->_var['lang']['notice_Credit_payment_days']; ?></div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="label"><?php echo $this->_var['lang']['require_field']; ?>&nbsp;<?php echo $this->_var['lang']['Suspended_term']; ?>：</div>
                                        <div class="label_value">
                                            <input type="text" name="over_repay_trem" class="text" autocomplete="off" value="<?php echo $this->_var['bt_info']['over_repay_trem']; ?>" id="over_repay_trem"/>
                                            <div class="form_prompt"></div>
                                            <div class="notic"><?php echo $this->_var['lang']['notice_Suspended_term']; ?></div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="label">&nbsp;</div>
                                        <div class="label_value info_btn">
                                            <a href="javascript:;" class="button" id="submitBtn_bt"><?php echo $this->_var['lang']['button_submit']; ?></a>
                                            <input type="hidden" name="act" value="<?php echo $this->_var['form_action']; ?>" />
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    <?php endif; ?>
                    <?php if ($this->_var['form_action'] == 'account_log'): ?>
						<?php if ($this->_var['full_page']): ?>
                        <div class="switch_info user_account_details">
                            <div class="account-left">
                            	<p><strong><?php echo $this->_var['lang']['label_user_name']; ?></strong><strong class="red"><?php echo $this->_var['user']['user_name']; ?></strong></p>
                                <p><strong><?php echo $this->_var['lang']['label_user_money']; ?></strong><strong class="red"><?php echo $this->_var['user']['formated_user_money']; ?></strong></p>
                                <p><strong><?php echo $this->_var['lang']['label_frozen_money']; ?></strong><strong class="red"><?php echo $this->_var['user']['formated_frozen_money']; ?></strong></p>
                                <p><strong><?php echo $this->_var['lang']['label_rank_points']; ?></strong><strong class="red"><?php echo $this->_var['user']['rank_points']; ?></strong></p>
                                <p><strong><?php echo $this->_var['lang']['label_pay_points']; ?></strong><strong class="red"><?php echo $this->_var['user']['pay_points']; ?></strong></p>
                                <a href="<?php echo $this->_var['action_link']['href']; ?>" class="btn btn35 red_btn_2"><?php echo $this->_var['action_link']['text']; ?></a>
                            </div>
                            <div class="account-right">
                            	<div class="common-head">
                                    <div class="refresh ml20">
                                        <div class="refresh_tit" title="<?php echo $this->_var['lang']['refresh_data']; ?>"><i class="icon icon-refresh"></i></div>
                                        <div class="refresh_span"><?php echo $this->_var['lang']['refresh']; ?> - <?php echo $this->_var['lang']['total_data']; ?><?php echo $this->_var['record_count']; ?><?php echo $this->_var['lang']['data']; ?></div>
                                    </div>
                                    <form action="account_log.php" id="account_logForm">
                                        <div class="search">
                                                <div id="account_log_select" class="imitate_select select_w140">
                                                    <div class="cite"><?php echo $this->_var['lang']['all_account']; ?></div>
                                                    <ul>
                                                       <li><a href="javascript:;" data-value=""><?php echo $this->_var['lang']['all_account']; ?></a></li>
                                                       <li><a href="javascript:;" data-value="user_money"><?php echo $this->_var['lang']['user_money']; ?></a></li>
                                                       <li><a href="javascript:;" data-value="frozen_money"><?php echo $this->_var['lang']['frozen_money']; ?></a></li>
                                                       <li><a href="javascript:;" data-value="rank_points"><?php echo $this->_var['lang']['rank_points']; ?></a></li>
                                                       <li><a href="javascript:;" data-value="pay_points"><?php echo $this->_var['lang']['pay_points']; ?></a></li>
                                                    </ul>
                                                    <input name="account_type" type="hidden" value="<?php echo $this->_var['account_type']; ?>" id="account_log_val">
                                                </div>
                                        </div>
                                        <input type="hidden" name="act" value="list"/>
                                        <input type="hidden" name="user_id" value="<?php echo $_GET['user_id']; ?>"/>
                                    </form>
                                </div>
                                <div class="common-content">
                                    <div class="list-div"  id="listDiv">
                                   <?php endif; ?>
                                        <table cellpadding="0" cellspacing="0" border="0">
                                            <thead>
                                                <tr>
                                                    <th width="12%"><div class="tDiv pl30"><?php echo $this->_var['lang']['change_time']; ?></div></th>
                                                    <th width="40%"><div class="tDiv"><?php echo $this->_var['lang']['change_desc']; ?></div></th>
                                                    <th width="12%"><div class="tDiv"><?php echo $this->_var['lang']['user_money']; ?></div></th>
                                                    <th width="12%"><div class="tDiv"><?php echo $this->_var['lang']['frozen_money']; ?></div></th>
                                                    <th width="12%"><div class="tDiv"><?php echo $this->_var['lang']['rank_points']; ?></div></th>
                                                    <th width="12%"><div class="tDiv"><?php echo $this->_var['lang']['pay_points']; ?></div></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $_from = $this->_var['account_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'account');if (count($_from)):
    foreach ($_from AS $this->_var['account']):
?>
                                                <tr>
                                                    <td><div class="tDiv pl30"><?php echo $this->_var['account']['change_time']; ?></div></td>
                                                    <td><div class="tDiv"><?php echo htmlspecialchars($this->_var['account']['change_desc']); ?></div></td>
                                                    <td>
                                                        <div class="tDiv">
                                                            <?php if ($this->_var['account']['user_money'] > 0): ?>
                                                                <span style="color:#0000FF">+<?php echo $this->_var['account']['user_money']; ?></span>
                                                            <?php elseif ($this->_var['account']['user_money'] < 0): ?>
                                                                <span style="color:#FF0000"><?php echo $this->_var['account']['user_money']; ?><?php if ($this->_var['account']['deposit_fee'] != 0): ?>(<?php echo $this->_var['lang']['poundage']; ?>：<?php echo $this->_var['account']['deposit_fee']; ?>)<?php endif; ?></span>
                                                            <?php else: ?>
                                                                <?php echo $this->_var['account']['user_money']; ?>
                                                            <?php endif; ?>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="tDiv">
                                                            <?php if ($this->_var['account']['frozen_money'] > 0): ?>
                                                                <span style="color:#0000FF">+<?php echo $this->_var['account']['frozen_money']; ?></span>
                                                            <?php elseif ($this->_var['account']['frozen_money'] < 0): ?>
                                                                <span style="color:#FF0000"><?php echo $this->_var['account']['frozen_money']; ?></span>
                                                            <?php else: ?>
                                                                <?php echo $this->_var['account']['frozen_money']; ?>
                                                            <?php endif; ?>
                                                        </div>
                                                    </td>
                                                    <td>
                                                       <div class="tDiv">
                                                            <?php if ($this->_var['account']['rank_points'] > 0): ?>
                                                             <span style="color:#0000FF">+<?php echo $this->_var['account']['rank_points']; ?></span>
                                                           <?php elseif ($this->_var['account']['rank_points'] < 0): ?>
                                                             <span style="color:#FF0000"><?php echo $this->_var['account']['rank_points']; ?></span>
                                                           <?php else: ?>
                                                             <?php echo $this->_var['account']['rank_points']; ?>
                                                           <?php endif; ?>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="tDiv">
                                                            <?php if ($this->_var['account']['pay_points'] > 0): ?>
                                                                <span style="color:#0000FF">+<?php echo $this->_var['account']['pay_points']; ?></span>
                                                            <?php elseif ($this->_var['account']['pay_points'] < 0): ?>
                                                                <span style="color:#FF0000"><?php echo $this->_var['account']['pay_points']; ?></span>
                                                            <?php else: ?>
                                                                <?php echo $this->_var['account']['pay_points']; ?>
                                                            <?php endif; ?>
                                                        </div>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                                <?php endforeach; else: ?>
                                                <tr><td colspan="12" class="no_record"><?php echo $this->_var['lang']['no_records']; ?></td></tr>
                                                <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="12">
                                                        <div class="list-page">
                                                            <?php echo $this->fetch('library/page.lbi'); ?>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                       <?php if ($this->_var['full_page']): ?>
                                    </div>
                                </div>
                            </div>
                        </div>
						<?php endif; ?>
                        <?php endif; ?>
					<?php if ($this->_var['full_page']): ?>
                </div>
            </div>
        </div>
    </div>
    <?php echo $this->fetch('library/pagefooter.lbi'); ?>
	
    <script type="text/javascript">
		<?php if ($this->_var['form_action'] == 'account_log'): ?>
			listTable.recordCount = <?php echo empty($this->_var['record_count']) ? '0' : $this->_var['record_count']; ?>;
			listTable.pageCount = <?php echo empty($this->_var['page_count']) ? '1' : $this->_var['page_count']; ?>;
			
			<?php $_from = $this->_var['filter']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
			listTable.filter.<?php echo $this->_var['key']; ?> = '<?php echo $this->_var['item']; ?>';
		<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		<?php endif; ?>
		
		$(function(){
			$('.nyroModal').nyroModal();
		});
		
		$(function(){
			//设置编辑会员验证
			<?php if ($this->_var['form_action'] == 'update'): ?>
			$("#submitBtn").click(function(){
				if($("#user_update").valid()){
					$("#user_update").submit();
				}
			});
			$('#user_update').validate({
				errorPlacement:function(error, element){
					var error_div = element.parents('div.label_value').find('div.form_prompt');
					element.parents('div.label_value').find(".notic").hide();
					error_div.append(error);
				},
				rules:{
					/*email:{
						required:true,
						email:true
					},*/
					confirm_password:{
						equalTo:"#password"
					}
				},
				messages:{
					/*email:{
						required : '<i class="icon icon-exclamation-sign"></i>'+invalid_email,
						email : '<i class="icon icon-exclamation-sign"></i>'+invalid_email
					},*/
					confirm_password : {
						equalTo:'<i class="icon icon-exclamation-sign"></i>'+password_not_same
					}
				}
			});
			<?php endif; ?>
			
			//设置白条验证
			<?php if ($this->_var['form_action'] == 'bt_edit'): ?>
			$("#submitBtn_bt").click(function(){
				if($("#user_baitiao_log").valid()){
					$("#user_baitiao_log").submit();
				}
			});
			$('#user_baitiao_log').validate({
				errorPlacement:function(error, element){
					var error_div = element.parents('div.label_value').find('div.form_prompt');
					element.parents('div.label_value').find(".notic").hide();
					error_div.append(error);
				},
				rules:{
					amount:{
						required:true
					},
					repay_term:{
						required:true
					},
					over_repay_trem:{
						required:true
					}
				},
				messages:{
					amount:{
						required:'<i class="icon icon-exclamation-sign"></i>'+amount_not_null
					},
					repay_term:{
						required:'<i class="icon icon-exclamation-sign"></i>'+repay_term_not_null
					},
					over_repay_trem:{
						required:'<i class="icon icon-exclamation-sign"></i>'+over_repay_trem_not_null
					}
				}	
			});
			<?php endif; ?>
		});
        $.divselect("#account_log_select","#account_log_val",function(obj){
            $("#account_logForm").submit();
        });
		
		
		$(window).load(function(){
			var height = $(".user_account_details").height();
			$(".account-left").css({"height":height});
		});
    </script>
</body>
</html>
<?php endif; ?>
