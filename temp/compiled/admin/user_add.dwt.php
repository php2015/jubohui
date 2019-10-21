<!doctype html>
<html>
<head><?php echo $this->fetch('library/admin_html_head.lbi'); ?></head>

<body class="iframe_body">
	<div class="warpper">
    	<div class="title"><a href="<?php echo $this->_var['action_link2']['href']; ?>" class="s-back"><?php echo $this->_var['lang']['back']; ?></a><?php echo $this->_var['lang']['08_members']; ?> - <?php echo $this->_var['ur_here']; ?></div>
        <div class="content">
        	<div class="tabs_info">
            	<ul>
                  <li class="curr"><a href="javascript:;"><?php echo $this->_var['lang']['04_users_add']; ?></a></li>
                  <li ><a href="<?php echo $this->_var['action_link']['href']; ?>"><?php echo $this->_var['action_link']['text']; ?></a></li>
				      </ul>
            </div>	
        	<div class="explanation" id="explanation">
            	<div class="ex_tit"><i class="sc_icon"></i><h4><?php echo $this->_var['lang']['operating_hints']; ?></h4><span id="explanationZoom" title="<?php echo $this->_var['lang']['fold_tips']; ?>"></span></div>
                <ul>
                    <li><?php echo $this->_var['lang']['operation_prompt_content']['info']['0']; ?></li>
                    <li><?php echo $this->_var['lang']['operation_prompt_content']['info']['1']; ?></li>
                    <li><?php echo $this->_var['lang']['operation_prompt_content_common']; ?></li>
                </ul>
            </div>
            <div class="flexilist">
                <div class="common-content">
                    <div class="mian-info">
                        <form method="post" action="users.php" name="theForm" id="user_form" >
                            <div class="switch_info">
                                <div class="item">
                                    <div class="label"><?php echo $this->_var['lang']['require_field']; ?>&nbsp;<?php echo $this->_var['lang']['username']; ?>：</div>
                                    <div class="label_value">
                                        <input type="text" id="username" name="username" class="text" value="" autocomplete="off" />
                                        <div class="form_prompt"></div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="label"><?php echo $this->_var['lang']['require_field']; ?>&nbsp;<?php echo $this->_var['lang']['email']; ?>：</div>
                                    <div class="label_value">
                                        <input type="text" name="email" class="text" value="" id="email" autocomplete="off" />
                                        <div class="form_prompt"></div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="label"><?php echo $this->_var['lang']['require_field']; ?>&nbsp;<?php echo $this->_var['lang']['password']; ?>：</div>
                                    <div class="label_value">
                                        <input type="password"   style="display:none"/>
                                        <input type="password" name="password" class="text" value="" id="password"/>
                                        <div class="form_prompt"></div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="label"><?php echo $this->_var['lang']['require_field']; ?>&nbsp;<?php echo $this->_var['lang']['confirm_password']; ?>：</div>
                                    <div class="label_value">
                                        <input type="password"   style="display:none"/>
                                        <input type="password" name="confirm_password" class="text" value="" id="confirm_password"/>
                                        <div class="form_prompt"></div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="label"><?php echo $this->_var['lang']['user_rank']; ?>：</div>
                                    <div class="label_value">
                                        <div id="user_grade" class="imitate_select select_w320">
                                          <div class="cite"><?php echo $this->_var['lang']['not_special_rank']; ?></div>
                                          <ul>
                                             <li><a href="javascript:;" data-value="0" class="ftx-01"><?php echo $this->_var['lang']['not_special_rank']; ?></a></li>
                                             <?php $_from = $this->_var['special_ranks']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('k', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['k'] => $this->_var['item']):
?>
                                             <li><a href="javascript:;" data-value="<?php echo $this->_var['k']; ?>" class="ftx-01"><?php echo $this->_var['item']; ?></a></li>
                                             <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                          </ul>
                                          <input name="user_rank" type="hidden" value="0" id="user_grade_val">
                                        </div>
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
                                                <input type="radio" class="ui-radio" name="sex" id="sex_<?php echo $this->_var['k']; ?>" value="<?php echo $this->_var['k']; ?>" checked />
                                                <label for="sex_<?php echo $this->_var['k']; ?>" class="ui-radio-label"><?php echo $this->_var['sex']; ?></label>
                                            </div>
                                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="label"><?php echo $this->_var['lang']['birthday']; ?>：</div>
                                    <div class="label_value">
                                        <div class="date-item year">
                                            <div id="user_year" class="imitate_select select_w120">
                                              <div class="cite"><?php echo $this->_var['lang']['please_select']; ?></div>
                                              <ul>
                                                 <?php $_from = $this->_var['select_date']['year']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'year');if (count($_from)):
    foreach ($_from AS $this->_var['year']):
?>
                                                 <li><a href="javascript:;" data-value="<?php echo $this->_var['year']; ?>" class="ftx-01"><?php echo $this->_var['year']; ?></a></li>
                                                 <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                              </ul>
                                              <input name="birthdayYear" type="hidden" value="" id="year_val">
                                            </div>
                                        </div>
                                        <div class="date-item month">
                                            <div id="user_month" class="imitate_select select_w75">
                                              <div class="cite"><?php echo $this->_var['lang']['please_select']; ?></div>
                                              <ul>
                                                 <?php $_from = $this->_var['select_date']['month']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'month');if (count($_from)):
    foreach ($_from AS $this->_var['month']):
?>
                                                 <li><a href="javascript:;" data-value="<?php echo $this->_var['month']; ?>" class="ftx-01"><?php echo $this->_var['month']; ?></a></li>
                                                 <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                              </ul>
                                              <input name="birthdayMonth" type="hidden" value="" id="month_val">
                                            </div>
                                        </div>
                                        <div class="date-item day">
                                            <div id="user_day" class="imitate_select select_w75">
                                              <div class="cite"><?php echo $this->_var['lang']['please_select']; ?></div>
                                              <ul>
                                                  <?php $_from = $this->_var['select_date']['day']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'day');if (count($_from)):
    foreach ($_from AS $this->_var['day']):
?>
                                                 <li><a href="javascript:;" data-value="<?php echo $this->_var['day']; ?>" class="ftx-01"><?php echo $this->_var['day']; ?></a></li>
                                                 <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                              </ul>
                                              <input name="birthdayDay" type="hidden" value="" id="day_val">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="item">
                                    <div class="label"><?php echo $this->_var['lang']['credit_line']; ?>：</div>
                                    <div class="label_value"><input type="text" name="credit_line" id="credit_line" class="text" autocomplete="off" /></div>
                                </div>
                                
                                <?php $_from = $this->_var['extend_info_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'field');if (count($_from)):
    foreach ($_from AS $this->_var['field']):
?>
                                <!-- <?php if ($this->_var['field']['id'] == 6): ?> -->
                                  <div class="item">
                                    <div class="label"><?php echo $this->_var['lang']['passwd_question']; ?>：</div>
                                    <div class="label_value">
                                        <div id="user_sel_question" class="imitate_select select_w320">
                                          <div class="cite"><?php echo $this->_var['lang']['sel_question']; ?></div>
                                          <ul>
                                             <?php $_from = $this->_var['passwd_questions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('k', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['k'] => $this->_var['item']):
?>
                                             <li><a href="javascript:;" data-value="<?php echo $this->_var['k']; ?>" class="ftx-01"><?php echo $this->_var['item']; ?></a></li>
                                             <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                          </ul>
                                          <input name="sel_question" type="hidden" value="0" id="sel_question">
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="label" <?php if ($this->_var['field']['is_need']): ?>id="passwd_quesetion"<?php endif; ?>><?php echo $this->_var['lang']['passwd_answer']; ?>：</div>
                                    <div class="label_value"><input type="text" name="passwd_answer" class="text" value="" autocomplete="off" />&nbsp;<?php if ($this->_var['field']['is_need']): ?><?php echo $this->_var['lang']['require_field']; ?><?php endif; ?></div>
                                </div>
                                <!-- <?php else: ?> -->
                                <div class="item">
                                    <div class="label"><?php echo $this->_var['field']['reg_field_name']; ?>：</div>
                                    <div class="label_value"><input type="text" name="extend_field<?php echo $this->_var['field']['id']; ?>" class="text" value="" autocomplete="off" /></div>
                                </div>
                                <!--<?php endif; ?>-->
                                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                
                                <div class="item">
                                    <div class="label">&nbsp;</div>
                                    <div class="label_value info_btn">
                                        <a href="javascript:;" class="button" id="submitBtn"><?php echo $this->_var['lang']['button_submit']; ?></a>
                                        <input type="hidden" name="act" value="<?php echo $this->_var['form_action']; ?>" />
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
		</div>
    </div>
 <?php echo $this->fetch('library/pagefooter.lbi'); ?>
    <script type="text/javascript">
		//表单验证
		$(function(){
			$("#submitBtn").click(function(){
				if($("#user_form").valid()){
						$("#user_form").submit();
				}
			});
		
			$('#user_form').validate({
				errorPlacement:function(error, element){
					var error_div = element.parents('div.label_value').find('div.form_prompt');
					element.parents('div.label_value').find(".notic").hide();
					error_div.append(error);
				},
				rules : {
					username : {
							required : true
					},
					email : {
							required : true,
							email : true
					},
					password : {
							required : true,
							minlength:6
					},
					confirm_password : {
							required : true,
							equalTo:"#password"
					}
						
				},
				messages : {
					username : {
							required : '<i class="icon icon-exclamation-sign"></i>'+no_username
					},
					email : {
							required : '<i class="icon icon-exclamation-sign"></i>'+email_null,
							email : '<i class="icon icon-exclamation-sign"></i>'+invalid_email
					},
					password : {
							required : '<i class="icon icon-exclamation-sign"></i>'+no_password,
							minlength : '<i class="icon icon-exclamation-sign"></i>'+less_password
					},
					confirm_password : {
							required : '<i class="icon icon-exclamation-sign"></i>'+no_confirm_password,
							equalTo:'<i class="icon icon-exclamation-sign"></i>'+password_not_same
					}
				}
			});
		});
    </script>     
</body>
</html>
