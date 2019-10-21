<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Keywords" content="<?php echo $this->_var['keywords']; ?>" />
<meta name="Description" content="<?php echo $this->_var['description']; ?>" />

<title><?php echo $this->_var['page_title']; ?></title>



<link rel="shortcut icon" href="favicon.ico" />
<?php echo $this->fetch('library/js_languages_new.lbi'); ?>
<link rel="stylesheet" type="text/css" href="themes/<?php echo $GLOBALS['_CFG']['template']; ?>/css/user.css">
<link rel="stylesheet" type="text/css" href="js/perfect-scrollbar/perfect-scrollbar.min.css" />
<link rel="stylesheet" type="text/css" href="js/calendar/calendar.min.css" />
<?php if ($this->_var['action'] == 'profile'): ?>
<link rel="stylesheet" type="text/css" href="js/amazeui/amazeui.min.css" />
<link rel="stylesheet" type="text/css" href="js/cropper/cropper.css" />
<?php endif; ?>
</head>

<body>
<?php echo $this->fetch('library/page_header_common.lbi'); ?>
<div class="user-content clearfix">
    <div class="user-side" ectype="userSide">
        <div class="user-perinfo-ny">
            <div class="profile clearfix">
                <div class="avatar">
                    <a href="user.php" class="u-pic">
                        <img src="<?php if ($this->_var['user_default_info']['user_picture']): ?><?php echo $this->_var['user_default_info']['user_picture']; ?><?php else: ?>themes/<?php echo $GLOBALS['_CFG']['template']; ?>/images/touxiang.jpg<?php endif; ?>" alt="">
                    </a>
                </div>
                <div class="name">
                    <h2><?php echo $this->_var['user_default_info']['nick_name']; ?></h2>
					<?php if ($this->_var['user_default_info']['special_rank']): ?>
                    <div class=""><?php echo $this->_var['user_default_info']['rank_name']; ?></div>
					<?php else: ?>
					<div class="user-rank user-rank-<?php echo empty($this->_var['user_default_info']['rank_sort']) ? '1' : $this->_var['user_default_info']['rank_sort']; ?>"><?php echo $this->_var['user_default_info']['rank_name']; ?></div>
					<?php endif; ?>
                </div>
            </div>
        </div>
        <div class="user-mod">
            <?php echo $this->fetch('library/user_menu.lbi'); ?>
        </div>
    </div>
    <div class="user-main" ectype="userMain" data-action="noDefault">
        <div class="user-crumbs hide">
            <?php echo $this->fetch('library/ur_here.lbi'); ?>
        </div>
        
        <?php if ($this->_var['action'] == 'users_log'): ?>
        <div class="user-mod">
            <div class="user-account-warp">
                <div class="user-title">
                    <h2><?php echo $this->_var['lang']['users_log']; ?></h2>
					<ul class="tabs">
                        <li><a href="user.php?act=profile"><?php echo $this->_var['lang']['profile']; ?></a></li>
                        <li class="active"><a href="user.php?act=users_log"><?php echo $this->_var['lang']['users_log']; ?></a></li>
                    </ul>
                </div>
                <div class="account-main account-not">
					<div class="account-open-list">
                        <table class="user-table user-table-account">
                            <colgroup>
                                <col width="140">
                                <col width="120">
                                <col width="120">
                                <col width="140">
                                <col width="140">
                                <col width="100">
                                <col>
                            </colgroup>
                            <thead>
                                <tr>
                                    <th><?php echo $this->_var['lang']['lab_card_id']; ?></th>
                                    <th class="tl"><?php echo $this->_var['lang']['process_time']; ?></th>
                                    <th class="tl"><?php echo $this->_var['lang']['change_type']; ?></th>
                                    <th class="tl"><?php echo $this->_var['lang']['ip_address']; ?></th>
                                    <th class="tl"><?php echo $this->_var['lang']['change_city']; ?></th>
                                    <th><?php echo $this->_var['lang']['logon_service']; ?></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $_from = $this->_var['user_log']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
                                <tr>
                                    <td><?php echo $this->_var['item']['log_id']; ?></td>
                                    <td>
									<p><?php echo $this->_var['item']['change_time']; ?></p>
									<?php if ($this->_var['item']['admin_name']): ?><p><?php echo $this->_var['item']['admin_name']; ?></p><?php endif; ?>
									</td>
                                    <td><?php echo $this->_var['lang']['change_type_user'][$this->_var['item']['change_type']]; ?></td>
                                    <td><?php echo $this->_var['item']['ip_address']; ?></td>
                                    <td><?php echo $this->_var['item']['change_city']; ?></td>
                                    <td>
                                        <?php echo $this->_var['item']['logon_service']; ?>
                                    </td>
                                </tr>
                            <?php endforeach; else: ?>
                                <tr>
                                    <td colspan="6"><?php echo $this->_var['lang']['account_log_empty']; ?></td>
                                </tr>
                            <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
                            </tbody>
                        </table>
						<?php echo $this->fetch('library/pages.lbi'); ?>
                    </div>
                    
                </div>
            </div>
        </div>
        <?php endif; ?>
        
        <?php if ($this->_var['action'] == 'profile'): ?>
        <div class="user-mod user-profile">
            <div class="user-title">
                <h2><?php echo $this->_var['lang']['profile']; ?></h2>
				<ul class="tabs">
                    <li class="active"><a href="user.php?act=profile"><?php echo $this->_var['lang']['profile']; ?></a></li>
                    <li><a href="user.php?act=users_log"><?php echo $this->_var['lang']['users_log']; ?></a></li>
                </ul>
            </div>
            <div class="user-profile-info">
                <div class="user-items">
                    <form name="formEdit" action="user.php" method="post">
                        <div class="item">
                            <div class="label"><?php echo $this->_var['lang']['username']; ?>：</div>
                            <div class="value"><span class="txt-lh2"><?php echo $this->_var['profile']['user_name']; ?></span></div>
                        </div>
                        <div class="item">
                            <div class="label"><?php echo $this->_var['lang']['nick_name']; ?>：</div>
                            <div class="value">
                                <input name="nick_name" type="text" value="<?php echo $this->_var['profile']['nick_name']; ?>" class="text text-1" />
                                <div class="notic"></div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="label"><?php echo $this->_var['lang']['Birthday_user']; ?>：</div>
                            <div class="value">
                                <div id="birthdayYear" class="imitate_select w90 mr10">
                                    <div class="cite"><span><?php if ($this->_var['profile']['year']): ?><?php echo $this->_var['profile']['year']; ?><?php else: ?><?php echo $this->_var['lang']['please_select']; ?><?php endif; ?></span><i class="iconfont icon-down"></i></div>
                                    <ul>
                                        <?php $_from = $this->_var['select_date']['year']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'year');if (count($_from)):
    foreach ($_from AS $this->_var['year']):
?>
                                        <li><a href="javascript:void(0);" data-value="<?php echo $this->_var['year']; ?>"><?php echo $this->_var['year']; ?></a></li>
                                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                    </ul>
                                    <input type="hidden" name="birthdayYear" value="<?php echo $this->_var['profile']['year']; ?>" id="birthdayYear_val"/>
                                </div>
                                <div class="imitate_select w90 mr10">
                                    <div class="cite"><span><?php if ($this->_var['profile']['month']): ?><?php echo $this->_var['profile']['month']; ?><?php else: ?><?php echo $this->_var['lang']['please_select']; ?><?php endif; ?></span><i class="iconfont icon-down"></i></div>
                                    <ul>
                                        <?php $_from = $this->_var['select_date']['month']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'month');if (count($_from)):
    foreach ($_from AS $this->_var['month']):
?>
                                        <li><a href="javascript:void(0);" data-value="<?php echo $this->_var['month']; ?>"><?php echo $this->_var['month']; ?></a></li>
                                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                    </ul>
                                    <input type="hidden" name="birthdayMonth" value="<?php echo $this->_var['profile']['month']; ?>"/>
                                </div>
                                <div class="imitate_select w90">
                                    <div class="cite"><span><?php if ($this->_var['profile']['day']): ?><?php echo $this->_var['profile']['day']; ?><?php else: ?><?php echo $this->_var['lang']['please_select']; ?><?php endif; ?></span><i class="iconfont icon-down"></i></div>
                                    <ul>
                                        <?php $_from = $this->_var['select_date']['day']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'data_0_05738700_1568788891');if (count($_from)):
    foreach ($_from AS $this->_var['data_0_05738700_1568788891']):
?>
                                        <li><a href="javascript:void(0);" data-value="<?php echo $this->_var['data_0_05738700_1568788891']; ?>"><?php echo $this->_var['data_0_05738700_1568788891']; ?></a></li>
                                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                    </ul>
                                    <input type="hidden" name="birthdayDay" value="<?php echo $this->_var['profile']['day']; ?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="label"><?php echo $this->_var['lang']['sex_user']; ?>：</div>
                            <div class="value">
                                <div class="radio-item">
                                    <input type="radio" <?php if ($this->_var['profile']['sex'] == 1): ?> checked="checked" <?php endif; ?> id="sex-1" name="sex" value="1"class="ui-radio" >
                                    <label for="sex-1" class="ui-radio-label"><?php echo $this->_var['lang']['male']; ?></label>
                                </div>
                                <div class="radio-item">
                                    <input type="radio" <?php if ($this->_var['profile']['sex'] == 2): ?> checked="checked" <?php endif; ?>id="sex-2" name="sex" value="2"class="ui-radio" >
                                    <label for="sex-2" class="ui-radio-label"><?php echo $this->_var['lang']['female']; ?></label>
                                </div>
                                <div class="radio-item">
                                    <input type="radio" <?php if ($this->_var['profile']['sex'] == 0): ?> checked="checked" <?php endif; ?> id="sex-3" name="sex" value="0" class="ui-radio">
                                    <label for="sex-3" class="ui-radio-label"><?php echo $this->_var['lang']['secrecy']; ?></label>
                                </div>
                            </div>
                        </div>
                        <?php if ($this->_var['profile']['email'] != ""): ?>
                        <div class="item">
                            <div class="label"><?php echo $this->_var['lang']['email_user']; ?>：</div>
                            <div class="value">
                                <span class="txt-lh2 fl" id="profile_email"><?php echo $this->_var['profile']['email']; ?></span>
                                <?php if ($this->_var['profile']['is_validate'] == 0): ?>
                                <span class="txt-lh2 ml10"><a href="user.php?act=account_safe&type=change_email" class="ftx-05"><?php echo $this->_var['lang']['Immediately_verify']; ?></a></span>
                                <?php else: ?>
                                <span class="succeed"><i></i></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if ($this->_var['sms_register']): ?>
                        <div class="item">
                            <div class="label"><?php echo $this->_var['lang']['mobile']; ?>：</div>
                            <div class="value">
                                <?php if ($this->_var['profile']['mobile_phone'] != ""): ?>
                                <span class="txt-lh2"><?php echo $this->_var['profile']['mobile_phone']; ?></span>
                                <?php else: ?>
                                <span class="txt-lh2">
                                    <a id="zphone" class="zphone ftx-05 ml5" <?php if ($this->_var['profile']['mobile_phone'] == ''): ?>href="user.php?act=account_safe&type=change_phone"<?php else: ?>style="cursor:default;"<?php endif; ?>><?php echo $this->_var['lang']['Immediately_verify']; ?></a>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                        
                        <?php $_from = $this->_var['extend_info_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'field');if (count($_from)):
    foreach ($_from AS $this->_var['field']):
?>
                        <?php if ($this->_var['field']['id'] == 6): ?>
                        <div class="item">
                            <div class="label"><?php echo $this->_var['lang']['passwd_question']; ?>：</div>
                            <div class="value">
                                <div class="imitate_select w200">
                                    <div class="cite"><span><?php if ($this->_var['profile']['passwd_question']): ?><?php echo $this->_var['profile']['passwd_question']; ?><?php else: ?><?php echo $this->_var['lang']['please_select']; ?><?php endif; ?></span><i class="iconfont icon-down"></i></div>
                                    <ul>
                                        <li><a href="javascript:void(0);" data-value="0"><?php echo $this->_var['lang']['sel_question']; ?></a></li>
                                        <?php $_from = $this->_var['passwd_questions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'data_0_05938700_1568788891');if (count($_from)):
    foreach ($_from AS $this->_var['data_0_05938700_1568788891']):
?>
                                        <li><a href="javascript:void(0);" data-value="<?php echo $this->_var['data_0_05938700_1568788891']; ?>"><?php echo $this->_var['data_0_05938700_1568788891']; ?></a></li>
                                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                    </ul>
                                    <input type="hidden" name="sel_question" value="<?php echo $this->_var['profile']['passwd_question']; ?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="label" <?php if ($this->_var['field']['is_need']): ?>id="passwd_quesetion"<?php endif; ?>><?php echo $this->_var['lang']['passwd_answer']; ?>：</div>
                            <div class="value">
                                <input name="passwd_answer" type="text" size="25" class="text text-1" maxlengt='20' value="<?php echo $this->_var['profile']['passwd_answer']; ?>"/>
                            </div>
                        </div>
                        <?php else: ?>
                        <?php if ($this->_var['field']['reg_field_name'] != $this->_var['lang']['mobile']): ?>
                        <div class="item mr10">
                            <div class="label" <?php if ($this->_var['field']['is_need']): ?> id="extend_field<?php echo $this->_var['field']['id']; ?>i"<?php endif; ?> ><?php echo $this->_var['field']['reg_field_name']; ?>：</div>
                            <div class="value">
                                <input name="extend_field<?php echo $this->_var['field']['id']; ?>" id="extend_field<?php echo $this->_var['field']['id']; ?>" type="text" class="text text-1" value="<?php echo $this->_var['field']['content']; ?>"/>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                        <div class="item item-button">
                            <div class="label">&nbsp;</div>
                            <div class="value">
                                <input type="hidden" name="seccode" id="seccode" value="<?php echo $this->_var['sms_security_code']; ?>" />
                                <input id="flag" type="hidden" value="register" />
                                <input name="act" type="hidden" value="act_edit_profile" />
                                <a href="javascript:void(0);" class="sc-btn sc-redBg-btn" ectype="submit"><?php echo $this->_var['lang']['confirm_edit']; ?></a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="avatar_change" ectype="upImgTouch">
                    <?php if ($this->_var['profile']['user_picture']): ?>
                    <img class="am-circle" src="<?php echo $this->_var['profile']['user_picture']; ?>?&'+Math.random();" width="120" height="120">
                    <?php else: ?>
                    <img class="am-circle" src="themes/<?php echo $GLOBALS['_CFG']['template']; ?>/images/touxiang.jpg" width="120" height="120">
                    <?php endif; ?>
                    <a href="javascript:void(0);" class="changeavatar"><div class="shadeDiv"></div><span><?php echo $this->_var['lang']['Modify_Avatar']; ?></span></a>
                </div>
            </div>
        </div>
        
        
        <div class="am-modal" ectype="docMdal">
            <div class="am-modal-dialog">
                <div class="am-modal-hd">
                    <label><?php echo $this->_var['lang']['Modify_Avatar']; ?></label>
                    <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
                </div>
                <div class="am-modal-bd">
                    <div class="am-g am-fl">
                        <div class="am-form-group am-form-file">
                            <div class="am-fl">
                                <button type="button" class="am-btn am-btn-default"><i class="iconfont icon-cloud-upload-alt"></i> <?php echo $this->_var['lang']['select_upload_file']; ?></button>
                            </div>
                            <input type="file" ectype="fileImage" id="inputImage">
                        </div>
                    </div>
                    <div class="am-g am-fl" >
                        <div class="up-pre-before" ectype="up-pre-before"><img alt="" src="" id="image" ectype="image"></div>
                        <div class="up-pre-after"></div>
                    </div>
                    <div class="am-g am-fl">
                        <div class="up-control-btns">
                            <span class="iconfont icon-rotate-left" ectype="rotate" data-type="left"></span>
                            <span class="iconfont icon-rotate-right" ectype="rotate" data-type="right"></span>
                            <span class="iconfont icon-gou" ectype="upBtnOk" id="up-btn-ok" url="ajax_user.php?act=upload_user_picture"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
        <div class="am-modal am-modal-alert" ectype="modalAlert">
            <div class="am-modal-dialog">
                <div class="am-modal-bd" ectype="alertContent"></div>
                <div class="am-modal-footer"><span class="am-modal-btn"><?php echo $this->_var['lang']['assign']; ?></span></div>
            </div>
        </div>
        <?php endif; ?>
        
        
        
        <?php if ($this->_var['action'] == 'account_safe'): ?>
        <div class="user-mod">
            <?php if ($this->_var['type'] == 'default'): ?>
            <div class="user-title">
                <h2><?php echo $this->_var['lang']['account_safe']; ?></h2>
                <div class="user-safe-level level-<?php echo $this->_var['security_rating']['count']; ?>">
                    <div class="level-word"><?php echo $this->_var['security_rating']['count_info']; ?></div>
                    <div class="level-progress"></div>
                    <div class="level-tip" id="promptInfo"><?php echo $this->_var['lang']['Security_level_desc']; ?></div>
                </div>
            </div>
            <div class="user-safe-list">
                <div class="item">
                    <div class="item-icon"><i class="iconfont icon-password-alt"></i></div>
                    <div class="item-info">
                        <div class="info-name"><?php echo $this->_var['lang']['password_user']; ?></div>
                        <p><span class="ftx-01"><?php echo $this->_var['lang']['password_user_desc']; ?></span></p>
                    </div>
                    <div class="item-handle"><a href="user.php?act=account_safe&type=change_password" class="handle-btn"><?php echo $this->_var['lang']['modify']; ?></a></div>
                </div>
                <div class="item">
                    <div class="item-icon<?php if ($this->_var['validate']['email_validate']): ?> item-icon-green<?php else: ?> item-icon-red<?php endif; ?>"><i class="iconfont icon-email"></i></div>
                    <?php if ($this->_var['validate']['email_validate']): ?>
                    <div class="item-info">
                        <div class="info-name"><?php echo $this->_var['lang']['email_yanzheng']; ?></div>
                        <p>
                            <span class="ftx-03"><?php echo $this->_var['lang']['email_yanzheng_you']; ?>：</span>
                            <strong class="ftx-06" id="email"><?php echo $this->_var['validate']['email']; ?></strong>
                        </p>
                    </div>
                    <div class="item-handle"><a href="user.php?act=account_safe&type=change_email" class="handle-btn"><?php echo $this->_var['lang']['modify']; ?></a></div>
                    <?php else: ?>
                    <div class="item-info">
                        <div class="info-name"><?php echo $this->_var['lang']['email_yanzheng']; ?></div>
                        <p><?php echo $this->_var['lang']['Email_authent_desc']; ?></p>
                    </div>
                    <div class="item-handle"><a href="user.php?act=account_safe&type=change_email" class="handle-btn handle-btn-red"><?php echo $this->_var['lang']['Immediately_verify']; ?></a></div>
                    <?php endif; ?>
                </div>
                <div class="item">
                    <div class="item-icon<?php if ($this->_var['validate']['mobile_phone']): ?> item-icon-green<?php else: ?> item-icon-red<?php endif; ?>"><i class="iconfont icon-mobile-phone"></i></div>
                    <?php if ($this->_var['validate']['mobile_phone']): ?>
                        <div class="item-info">
                            <div class="info-name"><?php echo $this->_var['lang']['phone_yanzheng']; ?></div>
                            <p><?php echo $this->_var['lang']['phone_authent_desc']; ?></p>
                        </div>
                        <div class="item-handle"><a href="user.php?act=account_safe&type=change_phone" class="handle-btn"><?php echo $this->_var['lang']['modify']; ?></a></div>
                    <?php else: ?>
                        <div class="item-info">
                            <div class="info-name"><?php echo $this->_var['lang']['phone_yanzheng']; ?></div>
                            <p><?php echo $this->_var['lang']['phone_authent_desc_one']; ?></p>
                        </div>
                        <div class="item-handle"><a href="user.php?act=account_safe&type=change_phone" class="handle-btn handle-btn-red"><?php echo $this->_var['lang']['Immediately_verify']; ?></a></div>
                    <?php endif; ?>
                </div>
                <div class="item">
                    <div class="item-icon<?php if ($this->_var['validate']['paypwd_id']): ?> item-icon-green<?php else: ?> item-icon-red<?php endif; ?>"><i class="iconfont icon-password-alt"></i></div>
                    <?php if ($this->_var['validate']['paypwd_id']): ?>
                    <div class="item-info">
                        <div class="info-name"><?php echo $this->_var['lang']['pay_password']; ?></div>
                        <p>
                        <span><?php echo $this->_var['lang']['Degree_of_safety']; ?>：</span>
                            <i id="cla" class="safe-rank04"></i>
                            <span class="ftx-03"><?php echo $this->_var['lang']['Degree_of_safety_desc']; ?></span>
                        </p>
                    </div>
                    <div class="item-handle"><a href="user.php?act=account_safe&type=payment_password&step=zero" class="handle-btn"><?php echo $this->_var['lang']['pay_password_manage']; ?></a></div>
                    <?php else: ?>
                    <div class="item-info">
                        <div class="info-name"><?php echo $this->_var['lang']['pay_password']; ?></div>
                        <p><?php echo $this->_var['lang']['Safety_renzheng_desc']; ?></p>
                    </div>
                    <div class="item-handle"><a href="user.php?act=account_safe&type=payment_password" class="handle-btn handle-btn-red"><?php echo $this->_var['lang']['Enable_now']; ?></a></div>
                    <?php endif; ?>
                </div>
                <div class="item">
                    <div class="item-icon<?php if ($this->_var['validate']['real_id']): ?> item-icon-green<?php else: ?> item-icon-red<?php endif; ?>"><i class="iconfont icon-identity"></i></div>
                    <?php if ($this->_var['validate']['real_id']): ?>
                    <div class="item-info">
                        <div class="info-name"><?php echo $this->_var['lang']['16_users_real']; ?></div>
                        <p>
                            <span class="ftx-03"><?php echo $this->_var['lang']['16_users_real_info']; ?>：</span>
                            <strong class="ftx-06"><?php echo $this->_var['validate']['real_name']; ?></strong>
                            <strong class="ftx-06"><?php echo $this->_var['validate']['bank_card']; ?></strong>
                        </p>
                    </div>
                    <div class="item-handle"><a href="user.php?act=account_safe&type=real_name" class="handle-btn"><?php echo $this->_var['lang']['view']; ?></a></div>
                    <?php else: ?>
                    <div class="item-info">
                        <div class="info-name"><?php echo $this->_var['lang']['16_users_real']; ?></div>
                        <p><?php echo $this->_var['lang']['16_users_real_desc']; ?></p>
                    </div>
                    <div class="item-handle"><a href="user.php?act=account_safe&type=real_name" class="handle-btn handle-btn-red"><?php echo $this->_var['lang']['Safety_now']; ?></a></div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
            
            <?php if ($this->_var['type'] == 'change_password'): ?>
            <div class="type">
                <div class="user-title">
                    <h2><?php echo $this->_var['lang']['edit_password_login']; ?></h2>
                </div>
                
                <div class="stepflex">
                    <dl class="first<?php if ($this->_var['step'] == 'first'): ?> doing<?php elseif ($this->_var['step'] == 'second' || $this->_var['step'] == 'last'): ?> done<?php endif; ?>">
                        <dt class="s-num">1</dt>
                        <dd class="s-text"><?php echo $this->_var['lang']['Verify_identity']; ?><s></s><b></b></dd>
                        <dd></dd>
                    </dl>
                    <dl class="normal<?php if ($this->_var['step'] == 'second'): ?> doing<?php elseif ($this->_var['step'] == 'last'): ?> done<?php endif; ?>">
                        <dt class="s-num">2</dt>
                        <dd class="s-text"><?php echo $this->_var['lang']['edit_password_login']; ?><s></s><b></b></dd>
                    </dl>
                    <dl class="last<?php if ($this->_var['step'] == 'last'): ?> doing<?php endif; ?>">
                        <?php if ($this->_var['step'] == 'last'): ?>
                        <dt class="s-num">3</dt>
                        <?php else: ?>
                        <dt class="s-num">&nbsp;</dt>
                        <?php endif; ?>
                        <dd class="s-text"><?php echo $this->_var['lang']['complete']; ?><s></s><b></b></dd>
                    </dl>
                </div>
                <?php if ($this->_var['step'] == 'first'): ?>
                <div class="form">
                    <div class="security-warp">
                        <?php if ($this->_var['sign'] == 'mobile'): ?>
                        <form name="formUser" method="post" action="user.php" class="user-form user-form-safe" ectype="user_security_from">
                            <div class="form-row">
                                <div class="form-label"><?php echo $this->_var['lang']['Verify_phone_in']; ?>：</div>
                                <div class="form-value">
                                    <span><?php echo $this->_var['user_info']['mobile_phone']; ?></span>
                                    <input id="mobile_phone" name="mobile_phone" type="hidden" value="<?php echo $this->_var['user_info']['mobile_phone']; ?>" />
                                    <?php if ($this->_var['validate_info']['is_validated'] && $this->_var['validate_info']['email']): ?>
                                    <b><a href="user.php?act=account_safe&type=change_password&sign=email" class="ftx-14"><?php echo $this->_var['lang']['Verify_email_in']; ?></a></b>
                                    <?php endif; ?>
                                    
                                    <?php if ($this->_var['validate_info']['pay_password']): ?>
                                    <b><a href="user.php?act=account_safe&type=change_password&sign=paypwd" class="ftx-14"><?php echo $this->_var['lang']['Verify_password_in']; ?></a></b>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-label"><?php echo $this->_var['lang']['bindMobile_code']; ?>：</div>
                                <div class="form-value">
                                    <input class="itxt" name="mobile_phone" id="mobile_phone" value="<?php echo $this->_var['user_info']['mobile_phone']; ?>" type="hidden">
                                    <input name="sms_value" id="sms_value" type="hidden" value="sms_code" class="text text-2" />
                                    <input class="form-input" type="text" name="mobile_code" tabindex="1" id="mobile_code" disabled="disabled">
                                    <a href="javascript:sendSms()" id="zphone" class="sms-btn"><?php echo $this->_var['lang']['getMobile_code']; ?></a>
                                    <div class="form_prompt" id="phone_captcha"></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-label"><?php echo $this->_var['lang']['comment_captcha']; ?>：</div>
                                <div class="form-value">
                                    <input class="form-input authCode txt-4" name="authCode" id="authCode" type="text" value="">
                                    <img src="captcha_verify.php?captcha=change_password_f&<?php echo $this->_var['rand']; ?>" alt="captcha" id="captcha_img" class="fl mr10" onClick="this.src='captcha_verify.php?captcha=change_password_f&'+Math.random()" width="100" height="40" />
                                    <div class="form_prompt" id="code_notice"></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-label">&nbsp;</div>
                                <div class="form-value form-value-btn">
                                    <input id="flag" type="hidden" value="change_password_f" name="flag">
                                    <input id="seccode" type="hidden" value="<?php echo $this->_var['sms_security_code']; ?>" name="seccode">
                                    <input type="hidden" value="account_safe" name="act">
                                    <input type="hidden" value="change_password" name="type">
                                    <input type="hidden" value="second" name="step">
                                    
                                    <input type="submit" class="form-btn form-btn-line" value="<?php echo $this->_var['lang']['button_submit']; ?>" id="submitMobile" ectype="submitBtn">
                                </div>
                            </div>
                        </form>
                        <?php elseif ($this->_var['sign'] == 'email'): ?>
                        <form name="change_email_s" method="post" action="user.php" class="user-form user-form-safe" ectype="user_security_from">
                            <div class="form-row">
                                <div class="form-label"><?php echo $this->_var['lang']['Verified_mailbox']; ?>：</div>
                                <div class="form-value">
                                    <span><?php echo $this->_var['user_info']['email']; ?></span>
                                    <input type="hidden" name="change_email" id="change_email" value="<?php echo $this->_var['user_info']['email']; ?>" />
                                    <input type="hidden" name="mobile_phone" id="mobile_phone" value="<?php echo $this->_var['user_info']['mobile_phone']; ?>" />
                                    <?php if ($this->_var['validate_info']['mobile_phone']): ?>
                                    <b><a href="user.php?act=account_safe&type=change_password&sign=mobile" class="ftx-14"><?php echo $this->_var['lang']['Verify_phone_user']; ?></a></b>
                                    <?php endif; ?>
                                    
                                    <?php if ($this->_var['validate_info']['pay_password']): ?>
                                    <b><a href="user.php?act=account_safe&type=change_password&sign=paypwd" class="ftx-14"><?php echo $this->_var['lang']['Verify_password_in']; ?></a></b>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-label"><?php echo $this->_var['lang']['comment_captcha']; ?>：</div>
                                <div class="form-value">
                                    <input class="form-input authCode txt-4" name="authCode" id="authCode" type="text" value="">
                                    <img src="captcha_verify.php?captcha=change_password_f&<?php echo $this->_var['rand']; ?>" alt="captcha" id="captcha_img" class="fl mr10" onClick="this.src='captcha_verify.php?captcha=change_password_f&'+Math.random()" width="100" height="40" />
                                    <div class="form_prompt" id="code_notice"></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-label">&nbsp;</div>
                                <div class="form-value form-value-btn">
                                    <a id="sendMail" href="javascript:;" data-type="change_pwd" ectype="submitBtn" class="form-btn form-btn-line"><?php echo $this->_var['lang']['send_verify_email']; ?></a>
                                </div>
                            </div>
                        </form>
                        <?php elseif ($this->_var['sign'] == 'paypwd'): ?>
                        <form name="formUserPwd" method="post" action="user.php" class="user-form user-form-safe" ectype="user_security_from">
                            <div class="form-row">
                                <div class="form-label"><?php echo $this->_var['lang']['input_pay_password']; ?>：</div>
                                <div class="form-value">
                                    <input type="password" style="display:none"/>
                                    <input class="form-input" type="password" name="pay_password" tabindex="1" id="pay_password">
                                    
                                    <?php if ($this->_var['validate_info']['is_validated'] && $this->_var['validate_info']['email']): ?>
                                    <b><a href="user.php?act=account_safe&type=change_password&sign=email" class="ftx-14"><?php echo $this->_var['lang']['Verify_email_in']; ?></a></b>
                                    <?php endif; ?>
                                    
                                    <?php if ($this->_var['validate_info']['mobile_phone']): ?>
                                    <b><a href="user.php?act=account_safe&type=change_password&sign=mobile" class="ftx-14"><?php echo $this->_var['lang']['Verify_phone_user']; ?></a></b>
                                    <?php endif; ?>
                                    
                                    <div class="form_prompt" id="pay_password_notice"></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-label"><?php echo $this->_var['lang']['comment_captcha']; ?>：</div>
                                <div class="form-value">
                                    <input class="form-input authCode txt-4" name="authCode" id="authCode" type="text" value="">
                                    <img src="captcha_verify.php?captcha=change_password_f&<?php echo $this->_var['rand']; ?>" alt="captcha" id="captcha_img" class="fl mr10" onClick="this.src='captcha_verify.php?captcha=change_password_f&'+Math.random()" width="100" height="40" />
                                    <div class="form_prompt" id="code_notice"></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-label">&nbsp;</div>
                                <div class="form-value form-value-btn">
                                    <input id="flag" type="hidden" value="change_password_f" name="flag">
                                    <input id="seccode" type="hidden" value="<?php echo $this->_var['sms_security_code']; ?>" name="seccode">
                                    <input type="hidden" value="paypwd" name="sign">
        
                                    <input type="hidden" value="account_safe" name="act">
                                    <input type="hidden" value="change_password" name="type">
                                    <input type="hidden" value="second" name="step">
        
                                    <input type="submit" class="form-btn form-btn-line" value="<?php echo $this->_var['lang']['submit_goods']; ?>" id="submitCode" ectype="submitBtn">
                                </div>
                            </div>
                        </form>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if ($this->_var['sign'] == 'validate_mail_ok'): ?>
                <div class="user-pwd-prompt user-prompt-ok">
                    <div class="fore">
                        <h3><span class="ftx-02"><?php echo $this->_var['lang']['send_email_in']; ?>：</span><?php echo $this->_var['user_info']['email']; ?>&nbsp;&nbsp;</h3>
                        <div class="ftx-03"><?php echo $this->_var['lang']['send_email_desc_one']; ?></div>
                        <div class="tc mt20"><a class="sc-btn btn35" href="javascript:history.back();"><?php echo $this->_var['lang']['send_email_desc_two']; ?></a></div>
                    </div>
                </div>
                <?php endif; ?>
                <?php elseif ($this->_var['step'] == 'second'): ?>
                <div class="form">
                	<div class="security-warp">
                        <form class="user-form user-form-safe" action="user.php" name="change_password_s" method="POST" ectype="user_security_from">
                            <div class="form-row">
                                <div class="form-label"><?php echo $this->_var['lang']['new_login_password']; ?>：</div>
                                <div class="form-value">
                                	<input type="password" style="display:none"/>
                                	<input type="password"  name="new_password" id="password" class="form-input">
                                    <div class="form_prompt" id="new_password_error"></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-label"><?php echo $this->_var['lang']['input_password_again']; ?>：</div>
                                <div class="form-value">
                                	<input type="password" style="display:none"/>
                                	<input class="form-input" type="password" name="re_new_password" id="re_new_password">
                                    <div class="form_prompt" id="rePassword_error"></div>
                                </div>
                            </div>
    
                            <div class="form-row">
                                <div class="form-label"><?php echo $this->_var['lang']['comment_captcha']; ?>：</div>
                                <div class="form-value">
                                    <input class="form-input authCode txt-4" name="authCode" id="authCode" type="text" value="">
                                    <img src="captcha_verify.php?captcha=change_password_f&<?php echo $this->_var['rand']; ?>" alt="captcha" id="captcha_img" class="fl mr10" onClick="this.src='captcha_verify.php?captcha=change_password_f&'+Math.random()" width="100" height="40" />
                                    <div class="form_prompt" id="code_notice"></div>
                                </div>
                            </div>
    
                            <div class="form-row">
                                <div class="form-label">&nbsp;</div>
                                <div class="form-value form-value-btn">
                                    <input type="hidden" name="act" value="account_safe" />
                                    <input type="hidden" name="type" value="change_password" />
                                    <input type="hidden" name="step" value="last" />
        
                                    <input type="submit" class="form-btn form-btn-line" value="<?php echo $this->_var['lang']['button_submit']; ?>" id="submitSecond" ectype="submitBtn">
                                </div>
                            </div>
                        </form>
                	</div>
                </div>
                <?php elseif ($this->_var['step'] == 'last'): ?>
                <div class="user-pwd-prompt user-prompt-ok">
                    <div class="fore">
                        <h3><i class="ok"></i><?php echo $this->_var['lang']['security_rating']; ?></h3>
                        <div class="u-safe"><?php echo $this->_var['lang']['security_rating_one']; ?>：<strong class="rank-text ftx-04"><?php echo $this->_var['security_rating']['count_info']; ?></strong></div>
                        <div class="ftx-03"><?php echo $this->_var['lang']['security_rating_two']; ?>&nbsp;<a href="user.php?act=account_safe" class="ftx-05"><?php echo $this->_var['lang']['Security_Center']; ?></a>&nbsp;<?php echo $this->_var['lang']['security_rating_three']; ?></div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            
            <?php elseif ($this->_var['type'] == 'change_email'): ?>
            <div class="type">
                <div class="user-title">
                    <h2><?php echo $this->_var['lang']['Mailbox_Management']; ?></h2>
                </div>
                
                <div class="stepflex">
                    <dl class="first <?php if ($this->_var['step'] == 'first'): ?>doing<?php elseif ($this->_var['step'] == 'second' || $this->_var['step'] == 'last' || $this->_var['step'] == 'second_email_verify'): ?>done<?php endif; ?>">
                        <dt class="s-num">1</dt>
                        <dd class="s-text"><?php echo $this->_var['lang']['Verify_identity']; ?><s></s><b></b></dd>
                        <dd></dd>
                    </dl>
                    <dl class="normal <?php if ($this->_var['step'] == 'second' || $this->_var['step'] == 'second_email_verify'): ?>doing<?php elseif ($this->_var['step'] == 'last'): ?>done<?php endif; ?>">
                        <dt class="s-num">2</dt>
                        <?php if ($this->_var['validate_info']['is_validated']): ?>
                        <dd class="s-text"><?php echo $this->_var['lang']['edit_email']; ?><s></s><b></b></dd>
                        <?php else: ?>
                        <dd class="s-text"><?php echo $this->_var['lang']['Verify_mailbox']; ?><s></s><b></b></dd>
                        <?php endif; ?>
                    </dl>
                    <dl class="last <?php if ($this->_var['step'] == 'last'): ?>doing<?php endif; ?>">
                       <?php if ($this->_var['step'] == 'last'): ?>
                        <dt class="s-num">3</dt>
                        <?php else: ?>
                        <dt class="s-num">&nbsp;</dt>
                        <?php endif; ?>
                        <dd class="s-text"><?php echo $this->_var['lang']['complete']; ?><s></s><b></b></dd>
                    </dl>
                </div>

                <?php if ($this->_var['step'] == 'first'): ?>
                <div class="form">
                    <div class="security-warp">
                        <?php if ($this->_var['sign'] == 'mobile'): ?>
                        <form name="formUser" method="post" action="user.php" class="user-form user-form-safe" ectype="user_security_from">
                            <div class="form-row">
                                <div class="form-label"><?php echo $this->_var['lang']['Verify_phone_in']; ?>：</div>
                                <div class="form-value">
                                    <span class="fl mr10"><?php echo $this->_var['user_info']['mobile_phone']; ?></span>
                                    <input id="mobile_phone" name="mobile_phone" type="hidden" value="<?php echo $this->_var['user_info']['mobile_phone']; ?>" />
                                    <?php if ($this->_var['validate_info']['is_validated'] && $this->_var['validate_info']['email']): ?>
                                    <b><a href="user.php?act=account_safe&type=change_email&sign=email" class="ftx-14"><?php echo $this->_var['lang']['Verify_email_in']; ?></a></b>
                                    <?php endif; ?>
                                    <?php if ($this->_var['validate_info']['pay_password']): ?>
                                    <b><a href="user.php?act=account_safe&type=change_email&sign=paypwd" class="ftx-14"><?php echo $this->_var['lang']['Verify_password_in']; ?></a></b>
                                    <?php endif; ?>
                                    
                                    <div class="form_prompt" id="phone_notice"></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-label"><?php echo $this->_var['lang']['bindMobile_code']; ?>：</div>
                                <div class="form-value">
                                    <input class="itxt" name="mobile_phone" id="mobile_phone" value="<?php echo $this->_var['user_info']['mobile_phone']; ?>" type="hidden">
                                    <input name="sms_value" id="sms_value" type="hidden" value="sms_code" class="text text-2" />
                                    <input class="form-input" type="text" name="mobile_code" tabindex="1" id="mobile_code" disabled="disabled"><a href="javascript:sendSms()" id="zphone" class="sms-btn"><?php echo $this->_var['lang']['getMobile_code']; ?></a>
                                    <div class="form_prompt" id="phone_captcha"></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-label"><?php echo $this->_var['lang']['comment_captcha']; ?>：</div>
                                <div class="form-value">
                                    <input class="form-input authCode txt-4" name="authCode" id="authCode" type="text" value="">
                                    <img src="captcha_verify.php?captcha=change_password_f&<?php echo $this->_var['rand']; ?>" alt="captcha" id="captcha_img" class="fl mr10" onClick="this.src='captcha_verify.php?captcha=change_password_f&'+Math.random()" width="100" height="40" />
                                    <div class="form_prompt" id="code_notice"></div>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-label">&nbsp;</div>
                                <div class="form-value form-value-btn">
                                    <input id="flag" type="hidden" value="change_password_f" name="flag">
                                    <input id="seccode" type="hidden" value="<?php echo $this->_var['sms_security_code']; ?>" name="seccode">
                                    <input type="hidden" value="mobile" name="sign">
    
                                    <input type="hidden" value="account_safe" name="act">
                                    <input type="hidden" value="change_email" name="type">
                                    <input type="hidden" value="second" name="step">
    
                                    <input type="submit" class="form-btn form-btn-line" value="<?php echo $this->_var['lang']['button_submit']; ?>" id="submitMobile" ectype="submitBtn">
                                </div>
                            </div>
                        </form>
                        <?php elseif ($this->_var['sign'] == 'email'): ?>
                        <form name="change_email_s" method="post" action="user.php" class="user-form user-form-safe" ectype="user_security_from">
                            <div class="form-row">
                                <div class="form-label"><?php echo $this->_var['lang']['Verified_mailbox']; ?>：</div>
                                <div class="form-value">
                                    <span class="fl mr10"><?php echo $this->_var['user_info']['email']; ?></span>
                                    <input type="hidden" name="change_email" id="change_email" value="<?php echo $this->_var['user_info']['email']; ?>" />
                                    <input type="hidden" name="mobile_phone" id="mobile_phone" value="<?php echo $this->_var['user_info']['mobile_phone']; ?>" />
                                    <?php if ($this->_var['validate_info']['mobile_phone']): ?>
                                    <b><a href="user.php?act=account_safe&type=change_email&sign=mobile" class="ftx-14"><?php echo $this->_var['lang']['Verify_phone_user']; ?></a></b>
                                    <?php endif; ?>
                                    <?php if ($this->_var['validate_info']['pay_password']): ?>
                                    <b><a href="user.php?act=account_safe&type=change_email&sign=paypwd" class="ftx-14"><?php echo $this->_var['lang']['Verify_password_in']; ?></a></b>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-label"><?php echo $this->_var['lang']['comment_captcha']; ?>：</div>
                                <div class="form-value">
                                    <input class="form-input authCode txt-4" name="authCode" id="authCode" type="text" value="">
                                    <img src="captcha_verify.php?captcha=change_password_f&<?php echo $this->_var['rand']; ?>" alt="captcha" id="captcha_img" class="fl mr10" onClick="this.src='captcha_verify.php?captcha=change_password_f&'+Math.random()" width="100" height="40" />
                                    <div class="form_prompt" id="code_notice"></div>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-label">&nbsp;</div>
                                <div class="form-value form-value-btn">
                                <?php if ($this->_var['is_validated']): ?>
                                    <a id="sendMail" href="javascript:;" data-type="change_mail" ectype="submitBtn" class="form-btn form-btn-line"><?php echo $this->_var['lang']['send_verify_email']; ?></a>
                                <?php else: ?>
                                    <input name="is_validated" value="<?php echo empty($this->_var['is_validated']) ? '0' : $this->_var['is_validated']; ?>" type="hidden">
                                    <a id="sendMail" href="javascript:;" data-type="edit_mail" ectype="submitBtn" class="form-btn form-btn-line"><?php echo $this->_var['lang']['send_verify_email']; ?></a>
                                <?php endif; ?>
                                </div>
                            </div>
                        </form>
                        <?php elseif ($this->_var['sign'] == 'paypwd'): ?>
                        <form name="formUserPwd" method="post" action="user.php" class="user-form user-form-safe" ectype="user_security_from">
                            <div class="form-row">
                                <div class="form-label"><?php echo $this->_var['lang']['input_pay_password']; ?>：</div>
                                <div class="form-value">
                                    <input type="password" style="display:none"/>
                                    <input class="form-input" type="password" name="pay_password" tabindex="1" id="pay_password">
                                    <?php if ($this->_var['validate_info']['is_validated'] && $this->_var['validate_info']['email']): ?>
                                    <b><a href="user.php?act=account_safe&type=change_email&sign=email" class="ftx-14"><?php echo $this->_var['lang']['Verify_email_in']; ?></a></b>
                                    <?php endif; ?>
                                    <?php if ($this->_var['validate_info']['pay_password']): ?>
                                    <b><a href="user.php?act=account_safe&type=change_email&sign=mobile" class="ftx-14"><?php echo $this->_var['lang']['Verify_phone_user']; ?></a></b>
                                    <?php endif; ?>
                                    <div class="form_prompt" id="pay_password_notice"></div>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-label"><?php echo $this->_var['lang']['comment_captcha']; ?>：</div>
                                <div class="form-value">
                                    <input class="form-input authCode txt-4" name="authCode" id="authCode" type="text" value="">
                                    <img src="captcha_verify.php?captcha=change_password_f&<?php echo $this->_var['rand']; ?>" alt="captcha" id="captcha_img" class="fl mr10" onClick="this.src='captcha_verify.php?captcha=change_password_f&'+Math.random()" width="100" height="40" />
                                    <div class="form_prompt" id="code_notice"></div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-label">&nbsp;</div>
                                <div class="form-value form-value-btn">
                                    <input id="flag" type="hidden" value="change_password_f" name="flag">
                                    <input id="seccode" type="hidden" value="<?php echo $this->_var['sms_security_code']; ?>" name="seccode">
                                    <input type="hidden" value="paypwd" name="sign">
    
                                    <input type="hidden" value="account_safe" name="act">
                                    <input type="hidden" value="change_email" name="type">
                                    <input type="hidden" value="second" name="step">
    
                                    <input type="submit" class="form-btn form-btn-line" value="<?php echo $this->_var['lang']['submit_goods']; ?>" id="submitCode" ectype="submitBtn">
                            	</div>
                            </div>
                        </form>
                        <?php endif; ?>
                    </div>
                    <?php if ($this->_var['sign'] == 'validate_mail_ok'): ?>
                    <div class="user-pwd-prompt user-prompt-ok">
                        <div class="fore">
                            <h3><span class="ftx-02"><?php echo $this->_var['lang']['send_email_in']; ?>：</span><?php echo $this->_var['user_info']['email']; ?>&nbsp;&nbsp;</h3>
                            <div class="ftx-03"><?php echo $this->_var['lang']['send_email_desc_one']; ?></div>
                            <a class="sc-btn btn35 mt30" href="javascript:history.back();"><?php echo $this->_var['lang']['send_email_desc_two']; ?></a>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <?php elseif ($this->_var['step'] == 'second'): ?>
                <div class="form">
                    <?php if ($this->_var['sign'] == 'edit_email_ok'): ?>
                    <div class="user-pwd-prompt user-prompt-ok">
                        <div class="fore">
                            <h3><?php echo $this->_var['lang']['send_email_in']; ?>：<span class="txt"><?php echo $this->_var['validate_new_mail']; ?>&nbsp;&nbsp;</span></h3>
                            <div class="ftx-01"><?php echo $this->_var['lang']['send_email_desc_three']; ?></div>
                            <div class="ftx-03"><?php echo $this->_var['lang']['send_email_desc_one']; ?></div>
                            <a class="sc-btn btn35 mt30" href="javascript:history.back();"><?php echo $this->_var['lang']['send_email_desc_two']; ?></a>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="security-warp">
                        <form name="change_email_s" method="post" action="user.php" class="user-form user-form-safe" ectype="user_security_from">
                            <div class="form-row">
                                <div class="form-label"><?php echo $this->_var['lang']['website_email']; ?>：</div>
                                <div class="form-value">
                                	<input class="form-input" type="text" name="change_email" id="change_email" value="<?php echo $this->_var['user_email']; ?>">
                                  	<div class="form_prompt"></div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-label"><?php echo $this->_var['lang']['comment_captcha']; ?>：</div>
                                <div class="form-value">
                                    <input class="form-input authCode txt-4" name="authCode" id="authCode" type="text" value="">
                                    <img src="captcha_verify.php?captcha=change_password_f&<?php echo $this->_var['rand']; ?>" alt="captcha" id="captcha_img" class="fl mr10" onClick="this.src='captcha_verify.php?captcha=change_password_f&'+Math.random()" width="100" height="40" />
                                    <div class="form_prompt" id="code_notice"></div>
                                </div>
                            </div>

                            <div class="form-row">
                        		<div class="form-label">&nbsp;</div>
                            	<div class="form-value form-value-btn">
                                	<a id="sendMail" href="javascript:;" data-type="edit_mail" ectype="submitBtn" class="form-btn form-btn-line"><?php echo $this->_var['lang']['send_verify_email']; ?></a>
                            	</div>
                            </div>
                        </form>
                    </div>
                    <?php endif; ?>
                </div>
                <?php elseif ($this->_var['step'] == 'last'): ?>
                <div class="user-pwd-prompt user-prompt-ok">
                    <div class="fore">
                        <?php if ($this->_var['sign'] == 'editmail_ok'): ?>
                        <?php if ($this->_var['validated'] == 1): ?>
                        <h3 class="ftx-02"><i class="ok"></i><?php echo $this->_var['lang']['edit_email_desc_two']; ?></h3>
                        <?php else: ?>
                        <h3 class="ftx-02"><i class="ok"></i><?php echo $this->_var['lang']['edit_email_desc_one']; ?></h3>
                        <?php endif; ?>
                        <?php else: ?>
                        <h3 class="ftx-02"><i class="ok"></i><?php echo $this->_var['lang']['edit_email_desc_two']; ?></h3>
                        <?php endif; ?>
                        <div class="u-safe"><?php echo $this->_var['lang']['security_rating_one']; ?>：<strong class="rank-text ftx-04"><?php echo $this->_var['security_rating']['count_info']; ?></strong></div>
                        <div class="ftx-03"><?php echo $this->_var['lang']['security_rating_two']; ?>&nbsp;<a href="user.php?act=account_safe" class="ftx-05"><?php echo $this->_var['lang']['Security_Center']; ?></a>&nbsp;<?php echo $this->_var['lang']['security_rating_three']; ?></div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            
            <?php elseif ($this->_var['type'] == 'change_phone'): ?>
            <div class="type">
                <div class="user-title">
                    <h2><?php echo $this->_var['lang']['phone_Management']; ?></h2>
                </div>
                
                <div class="stepflex">
                    <dl class="first <?php if ($this->_var['step'] == 'first'): ?>doing<?php elseif ($this->_var['step'] == 'second' || $this->_var['step'] == 'last'): ?>done<?php endif; ?>">
                        <dt class="s-num">1</dt>
                        <dd class="s-text"><?php echo $this->_var['lang']['Verify_identity']; ?><s></s><b></b></dd>
                        <dd></dd>
                    </dl>
                    <dl class="normal <?php if ($this->_var['step'] == 'second'): ?>doing<?php elseif ($this->_var['step'] == 'last'): ?>done<?php endif; ?>">
                        <dt class="s-num">2</dt>
                        <?php if ($this->_var['validate_info']['mobile_phone']): ?>
                        <dd class="s-text"><?php echo $this->_var['lang']['phone_edit']; ?><s></s><b></b></dd>
                        <?php else: ?>
                        <dd class="s-text"><?php echo $this->_var['lang']['Verify_phone']; ?><s></s><b></b></dd>
                        <?php endif; ?>
                    </dl>
                    <dl class="last <?php if ($this->_var['step'] == 'last'): ?>doing<?php endif; ?>">
                        <?php if ($this->_var['step'] == 'last'): ?>
                        <dt class="s-num">3</dt>
                        <?php else: ?>
                        <dt class="s-num">&nbsp;</dt>
                        <?php endif; ?>
                        
                        <dd class="s-text"><?php echo $this->_var['lang']['complete']; ?><s></s><b></b></dd>
                    </dl>
                </div>
                
                <?php if ($this->_var['step'] == 'first'): ?>
                <div class="form">
                    <div class="security-warp">
                        <?php if ($this->_var['sign'] == 'mobile'): ?>
                        <form name="formUser" method="post" action="user.php" class="user-form user-form-safe" ectype="user_security_from">
                            <div class="form-row">
                                <div class="form-label"><?php echo $this->_var['lang']['Verify_phone_in']; ?>：</div>
                                <div class="form-value">
                                    <?php echo $this->_var['user_info']['mobile_phone']; ?>
                                    <?php if ($this->_var['validate_info']['mobile_phone']): ?>
                                    <input id="mobile_phone" name="mobile_phone"  type="hidden" value="<?php echo $this->_var['user_info']['mobile_phone']; ?>" />
                                    <?php else: ?>
                                    <input class="form-input" id="mobile_phone" name="mobile_phone" type="text" value="<?php echo $this->_var['user_info']['mobile_phone']; ?>" />
                                    <?php endif; ?>
                                    <?php if ($this->_var['validate_info']['is_validated'] && $this->_var['validate_info']['email']): ?>
                                    <b><a href="user.php?act=account_safe&type=change_phone&sign=email" class="ftx-14"><?php echo $this->_var['lang']['Verify_email_in']; ?></a></b>
                                    <?php endif; ?>
                                    <?php if ($this->_var['validate_info']['pay_password']): ?>
                                    <b><a href="user.php?act=account_safe&type=change_phone&sign=paypwd" class="ftx-14"><?php echo $this->_var['lang']['Verify_password_in']; ?></a></b>
                                    <?php endif; ?>
                                    
                                    <?php if (! $this->_var['validate_info']['mobile_phone']): ?>
                                    <div class="form_prompt" id="phone_notice"></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-label"><?php echo $this->_var['lang']['bindMobile_code']; ?>：</div>
                                <div class="form-value">
                                    <?php if ($this->_var['validate_info']['mobile_phone']): ?>
                                    <input class="itxt" name="mobile_phone" id="mobile_phone" value="<?php echo $this->_var['user_info']['mobile_phone']; ?>" type="hidden">
                                    <?php endif; ?>
                                    <input name="sms_value" id="sms_value" type="hidden" value="sms_code" class="text text-2" />
                                    <input class="form-input" type="text" name="mobile_code" tabindex="1" id="mobile_code" disabled="disabled"><a href="javascript:sendSms()" id="zphone" class="sms-btn"><?php echo $this->_var['lang']['getMobile_code']; ?></a>
                                    <div class="form_prompt" id="phone_captcha"></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-label"><?php echo $this->_var['lang']['comment_captcha']; ?>：</div>
                                <div class="form-value">
                                    <input class="form-input authCode txt-4" name="authCode" id="authCode" type="text" value="">
                                    <img src="captcha_verify.php?captcha=change_password_f&<?php echo $this->_var['rand']; ?>" alt="captcha" id="captcha_img" class="fl mr10" onClick="this.src='captcha_verify.php?captcha=change_password_f&'+Math.random()" width="100" height="40" />
                                    <div class="form_prompt" id="code_notice"></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-label">&nbsp;</div>
                                <div class="form-value form-value-btn">
                                    <input id="flag" type="hidden" value="change_password_f" name="flag">
                                    <input id="seccode" type="hidden" value="<?php echo $this->_var['sms_security_code']; ?>" name="seccode">
                                    <input type="hidden" value="mobile" name="sign">
    
                                    <input type="hidden" value="account_safe" name="act">
                                    <input type="hidden" value="change_phone" name="type">
                                    <input type="hidden" value="second" name="step">
    
                                    <input type="submit" class="form-btn form-btn-line" value="<?php echo $this->_var['lang']['button_submit']; ?>" id="submitMobile" ectype="submitBtn">
                                </div>
                            </div>
                        </form>
                        <?php elseif ($this->_var['sign'] == 'email'): ?>
                        <form name="change_email_s" method="post" action="user.php" class="user-form user-form-safe" ectype="user_security_from">
                            <div class="form-row">
                                <div class="form-label"><?php echo $this->_var['lang']['Verified_mailbox']; ?>：</div>
                                <div class="form-value">
                                    <span class="fl mr10"><?php echo $this->_var['user_info']['email']; ?></span>
                                    <input type="hidden" name="change_email" id="change_email" value="<?php echo $this->_var['user_info']['email']; ?>" />
                                    <input type="hidden" name="mobile_phone" id="mobile_phone" value="<?php echo $this->_var['user_info']['mobile_phone']; ?>" />
                                    <?php if ($this->_var['validate_info']['mobile_phone']): ?>
                                    <b><a href="user.php?act=account_safe&type=change_phone&sign=mobile" class="ftx-14"><?php echo $this->_var['lang']['Verify_phone_user']; ?></a></b>
                                    <?php endif; ?>
                                    <?php if ($this->_var['validate_info']['pay_password']): ?>
                                    <b><a href="user.php?act=account_safe&type=change_phone&sign=paypwd" class="ftx-14"><?php echo $this->_var['lang']['Verify_password_in']; ?></a></b>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-label"><?php echo $this->_var['lang']['comment_captcha']; ?>：</div>
                                <div class="form-value">
                                    <input class="form-input authCode txt-4" name="authCode" id="authCode" type="text" value="">
                                    <img src="captcha_verify.php?captcha=change_password_f&<?php echo $this->_var['rand']; ?>" alt="captcha" id="captcha_img" class="fl mr10" onClick="this.src='captcha_verify.php?captcha=change_password_f&'+Math.random()" width="100" height="40" />
                                    <div class="form_prompt" id="code_notice"></div>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-label">&nbsp;</div>
                                <div class="form-value form-value-btn">
                                	<a id="sendMail" href="javascript:;" data-type="change_mobile" ectype="submitBtn" class="form-btn form-btn-line"><?php echo $this->_var['lang']['send_verify_email']; ?></a>
                                </div>
                            </div>
                        </form>
                        <?php elseif ($this->_var['sign'] == 'paypwd'): ?>
                        <form name="formUserPwd" method="post" action="user.php" class="user-form user-form-safe" ectype="user_security_from">
                            <div class="form-row">
                                <div class="form-label"><?php echo $this->_var['lang']['input_pay_password']; ?>：</div>
                                <div class="form-value">
                                    <input type="password"   style="display:none"/>
                                    <input class="form-input" type="password" name="pay_password" tabindex="1" id="pay_password">
                                    <?php if ($this->_var['validate_info']['is_validated'] && $this->_var['validate_info']['email']): ?>
                                    <b><a href="user.php?act=account_safe&type=change_phone&sign=email" class="ftx-14"><?php echo $this->_var['lang']['Verify_email_in']; ?></a></b>
                                    <?php endif; ?>
                                    
                                    <?php if ($this->_var['validate_info']['mobile_phone']): ?>
                                    <b><a href="user.php?act=account_safe&type=change_phone&sign=mobile" class="ftx-14"><?php echo $this->_var['lang']['Verify_phone_user']; ?></a></b>
                                    <?php endif; ?>
                                    <label class="error" id="pay_password_notice"><i></i></label>
                                    <div class="form_prompt"></div>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-label"><?php echo $this->_var['lang']['comment_captcha']; ?>：</div>
                                <div class="form-value">
                                    <input class="form-input authCode txt-4" name="authCode" id="authCode" type="text" value="">
                                    <img src="captcha_verify.php?captcha=change_password_f&<?php echo $this->_var['rand']; ?>" alt="captcha" id="captcha_img" class="fl mr10" onClick="this.src='captcha_verify.php?captcha=change_password_f&'+Math.random()" width="100" height="40" />
                                    <label class="error" id="code_notice"><i></i></label>
                                    <div class="form_prompt"></div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-label">&nbsp;</div>
                                <div class="form-value form-value-btn">
                                    <input id="flag" type="hidden" value="change_password_f" name="flag">
                                    <input id="seccode" type="hidden" value="<?php echo $this->_var['sms_security_code']; ?>" name="seccode">
                                    <input type="hidden" value="paypwd" name="sign">
    
                                    <input type="hidden" value="account_safe" name="act">
                                    <input type="hidden" value="change_phone" name="type">
                                    <input type="hidden" value="second" name="step">
    
                                    <input type="submit" class="form-btn form-btn-line" value="<?php echo $this->_var['lang']['submit_goods']; ?>" id="submitCode" ectype="submitBtn">
                            	</div>
                            </div>
                        </form>
                        <?php endif; ?>
                    </div>
                    
                    <?php if ($this->_var['sign'] == 'validate_mail_ok'): ?>
                    <div class="user-pwd-prompt user-prompt-ok">
                        <s class="icon-succ02 m-icon"></s>
                        <div class="fore">
                            <h3><span class="ftx-02"><?php echo $this->_var['lang']['send_email_in']; ?>：</span><?php echo $this->_var['user_info']['email']; ?>&nbsp;&nbsp;</h3>
                            <div class="ftx-03"><?php echo $this->_var['lang']['send_email_desc_one']; ?></div>
                            <a class="sc-btn btn35 mt30" href="javascript:history.back();"><?php echo $this->_var['lang']['send_email_desc_two']; ?></a>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <?php elseif ($this->_var['step'] == 'second'): ?>
                <div class="form">
                    <div class="security-warp">
                        <form name="formUser" method="post" action="user.php" class="user-form user-form-safe" ectype="user_security_from">
                            <div class="form-row">
                                <div class="form-label"><?php echo $this->_var['lang']['label_mobile']; ?>：</div>
                                <div class="form-value">
                                    <input class="form-input" type="text" name="mobile_phone" tabindex="1" id="mobile_phone" value="<?php if ($this->_var['mobile_phone']): ?><?php echo $this->_var['mobile_phone']; ?><?php endif; ?>">
                                    <div class="form_prompt" id="phone_notice"></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-label"><?php echo $this->_var['lang']['bindMobile_code']; ?>：</div>
                                <div class="form-value">
                                    <input name="sms_value" id="sms_value" type="hidden" value="sms_code" class="text text-2" />
                                    <input class="form-input" type="text" name="mobile_code" tabindex="1" id="mobile_code" disabled="disabled">
                                    <a href="javascript:sendSms()" id="zphone" class="sms-btn"><?php echo $this->_var['lang']['getMobile_code']; ?></a>
                                    <div class="form_prompt" id="phone_captcha"></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-label"><?php echo $this->_var['lang']['comment_captcha']; ?>：</div>
                                <div class="form-value">
                                    <input class="form-input authCode txt-4" name="authCode" id="authCode" type="text" value="">
                                    <img src="captcha_verify.php?captcha=change_password_f&<?php echo $this->_var['rand']; ?>" alt="captcha" id="captcha_img" class="fl mr10" onClick="this.src='captcha_verify.php?captcha=change_password_f&'+Math.random()" width="100" height="40" />
                                    <div class="form_prompt" id="code_notice"></div>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-label">&nbsp;</div>
                                <div class="form-value form-value-btn">
                                    <?php if ($this->_var['validate_info']['mobile_phone']): ?>
                                    <input id="carry" type="hidden" value="insert" name="carry">
                                    <?php else: ?>
                                    <input id="carry" type="hidden" value="update" name="carry">
                                    <?php endif; ?>
                                    <input id="flag" type="hidden" value="change_mobile" name="flag">
                                    <input id="seccode" type="hidden" value="<?php echo $this->_var['sms_security_code']; ?>" name="seccode">
    
                                    <input type="hidden" name="act" value="account_safe" />
                                    <input type="hidden" name="type" value="change_phone" />
                                    <input type="hidden" name="step" value="last" />
    
                                    <input type="submit" class="form-btn form-btn-line" value="<?php echo $this->_var['lang']['lang_crowd_next_step']; ?>" id="submitMobile" ectype="submitBtn">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <?php elseif ($this->_var['step'] == 'last'): ?>
                <div class="user-pwd-prompt user-prompt-ok">
                    <div class="fore">
                        <h3><i class="ok"></i><?php echo $this->_var['lang']['bind_phone_user']; ?></h3>
                        <div class="u-safe"><?php echo $this->_var['lang']['security_rating_one']; ?>：<strong class="rank-text ftx-02"><?php echo $this->_var['security_rating']['count_info']; ?></strong></div>
                        <div class="ftx-03"><?php echo $this->_var['lang']['security_rating_two']; ?>&nbsp;<a href="user.php?act=account_safe" class="ftx-05"><?php echo $this->_var['lang']['Security_Center']; ?></a>&nbsp;<?php echo $this->_var['lang']['security_rating_three']; ?></div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            
            <?php elseif ($this->_var['type'] == 'payment_password'): ?>
            <div class="type">
                <div class="user-title">
                    <h2><?php echo $this->_var['lang']['pay_password_Management']; ?></h2>
                </div>
                <?php if ($this->_var['step'] != 'zero'): ?>
                <div class="stepflex">
                    <dl class="first<?php if ($this->_var['step'] == 'first'): ?> doing<?php elseif ($this->_var['step'] == 'second' || $this->_var['step'] == 'last'): ?> done<?php endif; ?>">
                        <dt class="s-num">1</dt>
                        <dd class="s-text"><?php echo $this->_var['lang']['Verify_identity']; ?><s></s><b></b></dd>
                        <dd></dd>
                    </dl>
                    <dl class="normal<?php if ($this->_var['step'] == 'second'): ?> doing<?php elseif ($this->_var['step'] == 'last'): ?> done<?php endif; ?>">
                        <dt class="s-num">2</dt>
                        <?php if ($this->_var['validate_info']['pay_password']): ?>
                        <dd class="s-text"><?php echo $this->_var['lang']['edit_pay_password']; ?><s></s><b></b></dd>
                        <?php else: ?>
                        <dd class="s-text"><?php if ($this->_var['password_type'] == 1): ?><?php echo $this->_var['lang']['reset_pay_password']; ?><?php else: ?><?php echo $this->_var['lang']['Enable_pay_password']; ?><?php endif; ?><s></s><b></b></dd>
                        <?php endif; ?>
                    </dl>
                    
                    <dl class="last<?php if ($this->_var['step'] == 'last'): ?> doing<?php endif; ?>">
                        <?php if ($this->_var['step'] == 'last'): ?>
                        <dt class="s-num">3</dt>
                        <?php else: ?>
                        <dt class="s-num">&nbsp;</dt>
                        <?php endif; ?>
                        <dd class="s-text"><?php echo $this->_var['lang']['complete']; ?><s></s><b></b></dd>
                    </dl>
                </div>
                <?php endif; ?>
               
                <?php if ($this->_var['step'] == 'zero'): ?>
                <div class="user-pwd-prompt user-prompt-ok">
                    <div class="fore">
                        <h3 class="pt80 pb20"><i class="ok"></i><?php echo $this->_var['lang']['pay_password_Prompt']; ?></h3>
                        <div class="ftx-03">
                            <a href="user.php?act=account_safe&type=payment_password&sign=paypwd" class="sc-btn btn35"><?php echo $this->_var['lang']['edit_pay_password']; ?></a>
                            <a href="user.php?act=account_safe&type=payment_password&sign=mobile&password_type=1" class="sc-btn btn35"><?php echo $this->_var['lang']['forgot_paypassword']; ?></a>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ($this->_var['step'] == 'first'): ?>
                <div class="form">
                    <div class="security-warp">
                    <?php if ($this->_var['sign'] == 'mobile'): ?>
                    <form name="formUser" method="post" action="user.php" class="user-form user-form-safe" ectype="user_security_from">
                        <div class="form-row">
                            <div class="form-label"><?php echo $this->_var['lang']['Verify_phone_in']; ?>：</div>
                            <div class="form-value">
                                <span class="fl mr10"><?php echo $this->_var['user_info']['mobile_phone']; ?></span>
                                <input id="mobile_phone" name="mobile_phone" type="hidden" value="<?php echo $this->_var['user_info']['mobile_phone']; ?>" />
                                <?php if ($this->_var['validate_info']['is_validated'] && $this->_var['validate_info']['email']): ?>
                                <b><a href="user.php?act=account_safe&type=payment_password&sign=email" class="ftx-14"><?php echo $this->_var['lang']['Verify_email_in']; ?></a></b>
                                <?php endif; ?>
                                <?php if ($this->_var['validate_info']['pay_password']): ?>
                                <b><a href="user.php?act=account_safe&type=payment_password&sign=paypwd" class="ftx-14"><?php echo $this->_var['lang']['Verify_password_in']; ?></a></b>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-label"><?php echo $this->_var['lang']['bindMobile_code']; ?>：</div>
                            <div class="form-value">
                                <input class="itxt" name="mobile_phone" id="mobile_phone" value="<?php echo $this->_var['user_info']['mobile_phone']; ?>" type="hidden">
                                <input name="sms_value" id="sms_value" type="hidden" value="sms_code" class="text text-2" />
                                <input class="form-input" type="text" name="mobile_code" tabindex="1" id="mobile_code" disabled="disabled"><a href="javascript:sendSms()" id="zphone" class="sms-btn"><?php echo $this->_var['lang']['getMobile_code']; ?></a>
                                <div class="form_prompt" id="phone_captcha"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-label"><?php echo $this->_var['lang']['comment_captcha']; ?>：</div>
                            <div class="form-value">
                                <input class="form-input authCode txt-4" name="authCode" id="authCode" type="text" value="">
                                <img src="captcha_verify.php?captcha=change_password_f&<?php echo $this->_var['rand']; ?>" alt="captcha" id="captcha_img" class="fl mr10" onClick="this.src='captcha_verify.php?captcha=change_password_f&'+Math.random()" width="100" height="40" />
                                <div class="form_prompt" id="code_notice"></div>
                            </div>
                        </div>
                        
                        <div class="form-row">
                        	<div class="form-label">&nbsp;</div>
                            <div class="form-value form-value-btn">
                                <input id="flag" type="hidden" value="change_password_f" name="flag">
                                <input id="seccode" type="hidden" value="<?php echo $this->_var['sms_security_code']; ?>" name="seccode">
                                <input type="hidden" value="account_safe" name="act">
                                <input type="hidden" value="payment_password" name="type">
                                <input type="hidden" value="second" name="step">
                                <input type="hidden" value="<?php echo empty($this->_var['password_type']) ? '0' : $this->_var['password_type']; ?>" name="password_type">
                                <input type="submit" class="form-btn form-btn-line" value="<?php echo $this->_var['lang']['button_submit']; ?>" id="submitMobile" ectype="submitBtn">
                        	</div>
                        </div>
                    </form>
                    <?php elseif ($this->_var['sign'] == 'email'): ?>
                    <form name="change_email_s" method="post" action="user.php" class="user-form user-form-safe" ectype="user_security_from">
                        <div class="form-row">
                            <div class="form-label"><?php echo $this->_var['lang']['Verified_mailbox']; ?>：</div>
                            <div class="form-value">
                                <span class="fl mr10"><?php echo $this->_var['user_info']['email']; ?></span>
                                <input type="hidden" name="change_email" id="change_email" value="<?php echo $this->_var['user_info']['email']; ?>" />
                                <input type="hidden" name="mobile_phone" id="mobile_phone" value="<?php echo $this->_var['user_info']['mobile_phone']; ?>" />
                                <?php if ($this->_var['validate_info']['mobile_phone']): ?>
                                <b><a href="user.php?act=account_safe&type=payment_password&sign=mobile" class="ftx-14"><?php echo $this->_var['lang']['Verify_phone_user']; ?></a></b>
                                <?php endif; ?>
                                <?php if ($this->_var['validate_info']['pay_password']): ?>
                                <b><a href="user.php?act=account_safe&type=payment_password&sign=paypwd" class="ftx-14"><?php echo $this->_var['lang']['Verify_password_in']; ?></a></b>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-label"><?php echo $this->_var['lang']['comment_captcha']; ?>：</div>
                            <div class="form-value">
                                <input class="form-input authCode txt-4" name="authCode" id="authCode" type="text" value="">
                                <img src="captcha_verify.php?captcha=change_password_f&<?php echo $this->_var['rand']; ?>" alt="captcha" id="captcha_img" class="fl mr10" onClick="this.src='captcha_verify.php?captcha=change_password_f&'+Math.random()" width="100" height="40" />
                                <div class="form_prompt" id="code_notice"></div>
                            </div>
                        </div>
                        
                        <div class="form-row">
                        	<div class="form-label">&nbsp;</div>
                            <div class="form-value form-value-btn">
                            	<a id="sendMail" href="javascript:;" data-type="change_paypwd" ectype="submitBtn" class="form-btn form-btn-line"><?php echo $this->_var['lang']['send_verify_email']; ?></a>
                            </div>
                        </div>
                    </form>
                    <?php elseif ($this->_var['sign'] == 'paypwd'): ?>
                    <form name="formUserPwd" method="post" action="user.php" class="user-form user-form-safe" ectype="user_security_from">
                        <div class="form-row">
                            <div class="form-label"><?php echo $this->_var['lang']['input_pay_password']; ?>：</div>
                            <div class="form-value">
                                <input type="password" style="display:none"/>
                                <input class="form-input" type="password" name="pay_password" tabindex="1" id="pay_password">
                                <?php if ($this->_var['validate_info']['is_validated'] && $this->_var['validate_info']['email']): ?>
                                <b><a href="user.php?act=account_safe&type=payment_password&sign=email" class="ftx-14"><?php echo $this->_var['lang']['Verify_email_in']; ?></a></b>
                                <?php endif; ?>
                                <?php if ($this->_var['validate_info']['pay_password']): ?>
                                <b><a href="user.php?act=account_safe&type=payment_password&sign=mobile" class="ftx-14"><?php echo $this->_var['lang']['Verify_phone_user']; ?></a></b>
                                <?php endif; ?>
                                <div class="form_prompt" id="pay_password_notice"></div>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-label"><?php echo $this->_var['lang']['comment_captcha']; ?>：</div>
                            <div class="form-value">
                                <input class="form-input authCode txt-4" name="authCode" id="authCode" type="text" value="">
                                <img src="captcha_verify.php?captcha=change_password_f&<?php echo $this->_var['rand']; ?>" alt="captcha" id="captcha_img" class="fl mr10" onClick="this.src='captcha_verify.php?captcha=change_password_f&'+Math.random()" width="100" height="40" />
                                <div class="form_prompt" id="code_notice"></div>
                            </div>
                        </div>

                        <div class="form-row">
                        	<div class="form-label">&nbsp;</div>
                            <div class="form-value form-value-btn">
                                <input id="flag" type="hidden" value="change_password_f" name="flag">
                                <input id="seccode" type="hidden" value="<?php echo $this->_var['sms_security_code']; ?>" name="seccode">
                                <input type="hidden" value="paypwd" name="sign">
    
                                <input type="hidden" value="account_safe" name="act">
                                <input type="hidden" value="payment_password" name="type">
                                <input type="hidden" value="second" name="step">
    
                                <input type="submit" class="form-btn form-btn-line" value="<?php echo $this->_var['lang']['submit_goods']; ?>" id="submitCode" ectype="submitBtn">
                            </div>
                        </div>
                    </form>
                    <?php endif; ?>
                    </div>
                    
                    <?php if ($this->_var['sign'] == 'validate_mail_ok'): ?>
                    <div class="user-pwd-prompt user-prompt-ok">
                        <s class="icon-succ02 m-icon"></s>
                        <div class="fore">
                            <h3><span class="ftx-02"><?php echo $this->_var['lang']['send_email_in']; ?>：</span><?php echo $this->_var['user_info']['email']; ?>&nbsp;&nbsp;</h3>
                            <div class="ftx-03"><?php echo $this->_var['lang']['send_email_desc_one']; ?></div>
                            <a class="sc-btn btn35 mt30" href="javascript:history.back();"><?php echo $this->_var['lang']['send_email_desc_two']; ?></a>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <?php elseif ($this->_var['step'] == 'second'): ?>
                <div class="form">
                	<div class="security-warp">
                        <form class="user-form user-form-safe" action="user.php" name="payment_password" method="POST" ectype="user_security_from">
                            <div class="form-row">
                                <div class="form-label"><?php echo $this->_var['lang']['pay_password']; ?>：</div>
                                <div class="form-value">
                                    <input type="password" style="display:none"/>
                                    <input class="form-input" type="password" name="new_password" id="password">
                                    <div class="form_prompt" id="new_password_error"></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-label"><?php echo $this->_var['lang']['confirm_pay_password']; ?>：</div>
                                <div class="form-value">
                                	<input type="password" style="display:none"/>
                                	<input type="password" name="re_new_password" id="re_new_password" class="form-input">
                                    <div class="form_prompt"></div>
                                </div>
                            </div>
                            <div class="form-row ftx-04 mb0">
                                <div class="form-label">&nbsp;</div>
                                <div class="form-value"><div class="lh25"><?php echo $this->_var['lang']['Enable_pay_password_desc']; ?></div></div>
                            </div>
                            <div class="form-rowm mt0">
                                <div class="form-label">&nbsp;</div>
                                <div class="form-value">
                                    <div class="fl">
                                        <input type="checkbox" <?php if ($this->_var['user_paypwd']['user_surplus']): ?> checked="checked" <?php endif; ?> name="user_surplus" id="user_surplus" value="1" class="ui-checkbox">
                                        <label class="ui-label" for="user_surplus"><?php echo $this->_var['lang']['balance_pay']; ?></label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-label">&nbsp;</div>
                                <div class="form-value form-value-btn">
                                    <input type="hidden" value="account_safe" name="act">
                                    <input type="hidden" value="payment_password" name="type">
                                    <input type="hidden" value="last" name="step">
                                    <input type="hidden" value="<?php echo empty($this->_var['password_type']) ? '0' : $this->_var['password_type']; ?>" name="password_type">
                                    <input type="submit" value="<?php echo $this->_var['lang']['submit_goods']; ?>" class="form-btn form-btn-line" id="submitSecond" ectype="submitBtn">
                                </div>
                            </div>
                        </form>
                	</div>
                </div>
                <?php elseif ($this->_var['step'] == 'last'): ?>
                <div class="user-pwd-prompt user-prompt-ok">
                    <div class="fore">
                        <h3><i class="ok"></i><?php echo $this->_var['lang']['Enable_pay_password_notice']; ?></h3>
                        <div class="u-safe"><?php echo $this->_var['lang']['security_rating_one']; ?>：<strong class="rank-text ftx-04"><?php echo $this->_var['security_rating']['count_info']; ?></strong></div>
                        <div class="ftx-03"><?php echo $this->_var['lang']['security_rating_two']; ?>&nbsp;<a href="user.php?act=account_safe" class="ftx-05"><?php echo $this->_var['lang']['Security_Center']; ?></a>&nbsp;<?php echo $this->_var['lang']['security_rating_three']; ?></div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            
            <?php elseif ($this->_var['type'] == 'real_name'): ?>
            <div class="type">
                <div class="user-title">
                    <h2><?php echo $this->_var['lang']['16_users_real']; ?></h2>
                </div>
                <?php if ($this->_var['step'] == 'first'): ?>
                <div class="account-main account-bind">
                    <div class="user-items">
                        <form name="real_name" method="post" action="user.php" enctype="multipart/form-data" class="user-form user-form-safe">
                            <div class="item">
                                <div class="label"><em class="red">*</em><?php echo $this->_var['lang']['Real_name']; ?>：</div>
                                <div class="value">
                                    <input class="text text-1" type="text" id="real_name" name="real_name" value="<?php echo $this->_var['real_user']['real_name']; ?>">
                                    <div id="span-notify-holderName" class="notic"><?php echo $this->_var['lang']['Real_name_notice']; ?></div>
                                    <div class="form_prompt"></div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="label"><em class="red">*</em><?php echo $this->_var['lang']['number_ID']; ?>：</div>
                                <div class="value">
                                    <input class="text text-5" type="text" id="self_num" name="self_num" value="<?php echo $this->_var['real_user']['self_num']; ?>">
                                    <div class="form_prompt"></div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="label"><em class="red">*</em><?php echo $this->_var['lang']['bank']; ?>：</div>
                                <div class="value">
                                    <input class="text text-1" type="text" id="bank_name" name="bank_name" value="<?php echo $this->_var['real_user']['bank_name']; ?>">
                                    <div class="notic"><?php echo $this->_var['lang']['bank_name_notic']; ?></div>
                                  	<div class="form_prompt"></div>
                                </div>
                            </div>
                            
                            <div class="item">
                                <div class="label"><em class="red">*</em><?php echo $this->_var['lang']['bank_card']; ?>：</div>
                                <div class="value">
                                    <input class="text text-5" type="text" id="bank_card" value="<?php echo $this->_var['real_user']['bank_card']; ?>" name="bank_card" ectype="bank_card">
                                    <div class="form_prompt"></div>
                                </div>
                            </div>
                            
                            <div class="item">
                                <div class="label"><em class="red">*</em><?php echo $this->_var['lang']['front_of_id_card']; ?>：</div>
                                <div class="value">
                                	<div class="type-file-box">
                                        <input type="button" name="button" id="button" class="type-file-button">
                                        <input type="file" name="front_of_id_card" class="type-file-file" size="30" data-state="imgfile" hidefocus="true" value="">
                                        <?php if ($this->_var['real_user']['front_of_id_card']): ?><span class="show"><a href="<?php echo $this->_var['real_user']['front_of_id_card']; ?>" class="nyroModal"><i class="iconfont icon-picture" onmouseover="toolTip('<img src=<?php echo $this->_var['real_user']['front_of_id_card']; ?>>')" onmouseout="toolTip()"></i></a></span><?php endif; ?>
                                        <input type="text" name="textfile_zheng" class="type-file-text" id="textfile_zheng" value="<?php echo $this->_var['real_user']['front_of_id_card']; ?>" readonly>
                                    </div>
                                    <div class="form_prompt"></div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="label"><em class="red">*</em><?php echo $this->_var['lang']['reverse_of_id_card']; ?>：</div>
                                <div class="value">
                                	<div class="type-file-box">
                                        <input type="button" name="button" id="button" class="type-file-button">
                                        <input type="file" name="reverse_of_id_card" class="type-file-file" size="30" data-state="imgfile" hidefocus="true" value="">
                                        <?php if ($this->_var['real_user']['reverse_of_id_card']): ?><span class="show"><a href="<?php echo $this->_var['real_user']['reverse_of_id_card']; ?>" class="nyroModal"><i class="iconfont icon-picture" onmouseover="toolTip('<img src=<?php echo $this->_var['real_user']['reverse_of_id_card']; ?>>')" onmouseout="toolTip()"></i></a></span><?php endif; ?>
                                        <input type="text" name="textfile_fan" class="type-file-text" id="textfile_fan" value="<?php echo $this->_var['real_user']['reverse_of_id_card']; ?>" readonly>
                                    </div>
                                    <div class="form_prompt"></div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="label"><em class="red">*</em><?php echo $this->_var['lang']['label_mobile']; ?>：</div>
                                <div class="value">
                                    <input class="text text-1" type="text" id="mobile_phone" name="mobile_phone" value="<?php echo $this->_var['real_user']['bank_mobile']; ?>">
                                    <div class="form_prompt"></div>
                                </div>
                            </div>
                            <?php if ($this->_var['enabled_sms_signin']): ?>
                            <div class="item">
                                <div class="label"><?php echo $this->_var['lang']['bindMobile_code']; ?>：</div>
                                <div class="value">
                                    <div class="sm-input">
                                        <input name="sms_value" id="sms_value" type="hidden" value="sms_code" />
                                        <input type="text" name="mobile_code" tabindex="1" id="mobile_code" disabled="disabled">
                                        <a href="javascript:sendSms()" id="zphone" class="sms-btn"><?php echo $this->_var['lang']['getMobile_code']; ?></a>
                                    </div>
                                    <div class="form_prompt"id="phone_captcha"></div>
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="item item-button">
                                <div class="label">&nbsp;</div>
                                <div class="value">
                                    <input id="flag" type="hidden" value="change_password_f" name="flag">
                                    <input id="seccode" type="hidden" value="<?php echo $this->_var['sms_security_code']; ?>" name="seccode">
                                    <input type="hidden" value="account_safe" name="act">
                                    <input type="hidden" value="real_name" name="type">
                                    <input type="hidden" value="second" name="step">
                                    <input type="hidden" value="<?php echo $this->_var['operate']; ?>" name="operate">
                                    <input type="submit" id="authSubmit" class="sc-btn sc-redBg-btn" value="<?php echo $this->_var['lang']['submit_goods']; ?>">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <?php endif; ?>
                
                <?php if ($this->_var['step'] == 'realname_ok'): ?>
                <div class="account-main account-bind">
                    <div class="user-items">
                        <div class="item">
                            <div class="label"><?php echo $this->_var['lang']['Real_name']; ?>：</div>
                            <div class="value"><span class="txt-lh"><?php echo $this->_var['real_user']['real_name']; ?></span></div>
                        </div>
                        <div class="item">
                            <div class="label"><?php echo $this->_var['lang']['number_ID']; ?>：</div>
                            <div class="value"><span class="txt-lh"><?php echo $this->_var['real_user']['self_num']; ?></span></div>
                        </div>
                        <div class="item">
                            <div class="label"><?php echo $this->_var['lang']['bank']; ?>：</div>
                            <div class="value"><span class="txt-lh"><?php echo $this->_var['real_user']['bank_name']; ?></span></div>
                        </div>
                        <div class="item">
                            <div class="label"><?php echo $this->_var['lang']['bank_card']; ?>：</div>
                            <div class="value"><span class="txt-lh"><?php echo $this->_var['real_user']['bank_card']; ?></span></div>
                        </div>
                        <div class="item">
                            <div class="label"><?php echo $this->_var['lang']['label_mobile']; ?>：</div>
                            <div class="value">
                                <span class="txt-lh"><?php echo $this->_var['real_user']['bank_mobile']; ?></span>
                                <a href="user.php?act=account_safe&type=change_phone" class="ftx-05 ml10"><?php echo $this->_var['lang']['modify']; ?></a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="label"><?php echo $this->_var['lang']['front_of_id_card']; ?>：</div>
                            <div class="value">
                                <a href="<?php echo $this->_var['real_user']['front_of_id_card']; ?>" target="_blank" class="nyroModal fl mt5">
                                	<i class="iconfont icon-picture" onmouseover="toolTip('<img src=<?php echo $this->_var['real_user']['front_of_id_card']; ?>>')" onmouseout="toolTip()"></i>
                                </a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="label"><?php echo $this->_var['lang']['reverse_of_id_card']; ?>：</div>
                            <div class="value">
                                <a href="<?php echo $this->_var['real_user']['reverse_of_id_card']; ?>" target="_blank" class="nyroModal fl mt5">
                                	<i class="iconfont icon-picture" onmouseover="toolTip('<img src=<?php echo $this->_var['real_user']['reverse_of_id_card']; ?>>')" onmouseout="toolTip()"></i>
                                </a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="label"><?php echo $this->_var['lang']['Verify_time']; ?>：</div>
                            <div class="value">
                                <span class="txt-lh"><?php echo $this->_var['real_user']['validate_time']; ?></span>
                            </div>
                        </div>
                        <div class="item">
                            <div class="label"><?php echo $this->_var['lang']['adopt_status']; ?>：</div>
                            <div class="value">
                                <span class="txt-lh red"><?php if ($this->_var['real_user']['review_status'] == 1): ?><?php echo $this->_var['lang']['is_confirm']['1']; ?><?php elseif ($this->_var['real_user']['review_status'] == 2): ?><?php echo $this->_var['lang']['is_confirm']['2']; ?><?php else: ?><?php echo $this->_var['lang']['is_confirm']['0']; ?><?php endif; ?></span>
                            </div>
                        </div>
                        
                        <?php if ($this->_var['real_user']['review_content'] && $this->_var['real_user']['review_status'] == 2): ?>
                        <div class="item">
                            <div class="label"><?php echo $this->_var['lang']['audit_statement']; ?>：</div>
                            <div class="value">
                                <span class="txt-lh red"><?php echo $this->_var['real_user']['review_content']; ?></span>
                            </div>
                        </div>
                        <?php endif; ?>

                        <div class="item item-button">
                            <div class="label">&nbsp;</div>
                            <div class="value">
                                <a href="<?php echo $this->_var['edit_user']; ?>" class="sc-btn sc-redBg-btn"><?php echo $this->_var['lang']['edit_real_complete']; ?></a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        
        
        
        <?php if ($this->_var['action'] == 'order_list' || $this->_var['action'] == 'order_recycle'): ?>
        <div class="user-mod">
            <div class="user-title">
                <h2><?php echo $this->_var['lang']['order_list']; ?></h2>
                <ul class="tabs">
                    <li <?php if ($this->_var['order_type'] != toBe_confirmed && $this->_var['order_type'] != toBe_pay && $this->_var['order_type'] != toBe_confirmed && $this->_var['order_type'] != toBe_finished): ?>class="active"<?php endif; ?>><a href="user.php?act=order_list"><?php echo $this->_var['lang']['all_order']; ?>(<?php echo $this->_var['allorders']; ?>)</a></li>
                    <li class="user-count3 <?php if ($this->_var['order_type'] == to_unconfirmed): ?>active<?php endif; ?>" onclick="get_OrderSearch('to_unconfirmed', '<?php echo $this->_var['action']; ?>', 'toBe_unconfirmed','','.user-count3')">
                    <a href="javascript:void(0);"><?php echo $this->_var['lang']['cs']['0']; ?>(<?php echo $this->_var['unconfirmed']; ?>)</a>
                    <input name="to_unconfirmed" id="to_unconfirmed" type="hidden" value="0" />
                    </li>
                    <li class="user-count1 <?php if ($this->_var['order_type'] == toBe_pay): ?>active<?php endif; ?>" onclick="get_OrderSearch('payId', '<?php echo $this->_var['action']; ?>', 'toBe_pay','','.user-count1')">
                    <a href="javascript:void(0);"><?php echo $this->_var['lang']['cs']['100']; ?>(<?php echo $this->_var['pay_count']; ?>)</a>
                    <input name="toBe_pay" id="payId" type="hidden" value="100" />
                    </li>
                    <li class="user-count2 <?php if ($this->_var['order_type'] == toBe_confirmed): ?>active<?php endif; ?>" onclick="get_OrderSearch('to_confirm_order', '<?php echo $this->_var['action']; ?>', 'toBe_confirmed','','.user-count2')">
                    <a href="javascript:void(0);"><?php echo $this->_var['lang']['receipt_not']; ?>(<?php echo $this->_var['to_confirm_order']; ?>)</a>
                    <input name="to_confirm_order" id="to_confirm_order" type="hidden" value="103" />
                    </li>
                    <li class="user-count4 <?php if ($this->_var['order_type'] == toBe_finished): ?>active<?php endif; ?>" onclick="get_OrderSearch('to_finished', '<?php echo $this->_var['action']; ?>', 'toBe_finished','','.user-count4')">
                    <a href="javascript:void(0);"><?php echo $this->_var['lang']['cs']['102']; ?>(<?php echo $this->_var['to_finished']; ?>)</a>
                    <input name="to_finished" id="to_finished" type="hidden" value="102" />
                    </li>
                </ul>
                <?php if ($this->_var['action'] == 'order_list'): ?>
                <a href="user.php?act=order_recycle" class="more"><?php echo $this->_var['lang']['Order_recycling_station']; ?></a>
                <?php else: ?>
                <a href="user.php?act=order_list" class="more"><?php echo $this->_var['lang']['order_list']; ?></a>
                <?php endif; ?>
            </div>
            <div class="user-list-title clearfix">
                <div class="user-list-filter">
                    <div id="order_status" class="imitate_select w120 mr10">
                        <div class="cite"><span><?php echo $this->_var['lang']['all_status']; ?></span><i class="iconfont icon-down"></i></div>
                        <ul>
                            <li id="order_status_-1"><a href="javascript:void(0);" data-idtxt="status_list" data-action="<?php echo $this->_var['action']; ?>" data-type="order_status" data-id="-1" data-value='-1'><?php echo $this->_var['lang']['all_status']; ?></a></li>
                            <?php $_from = $this->_var['status_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'list');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['list']):
?>
                            <li id="order_status_<?php echo $this->_var['key']; ?>"><a href="javascript:void(0);" data-idtxt="status_list" data-action="<?php echo $this->_var['action']; ?>" data-type="order_status" data-id="<?php echo $this->_var['key']; ?>" data-value='<?php echo $this->_var['key']; ?>'><?php echo $this->_var['list']; ?></a></li>
                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                        </ul>
                        <input name="order_status_list" type="hidden" value="-1" id="order_status_val">
                    </div>
                    <div id="dateTime" class="imitate_select w120">
                        <div class="cite"><span><?php echo $this->_var['lang']['all_time']; ?></span><i class="iconfont icon-down"></i></div>
                        <ul>
                            <li id="time_allDate"><a href="javascript:void(0);" data-idtxt="submitDate" data-action="<?php echo $this->_var['action']; ?>" data-type="dateTime" data-id="allDate" data-value="allDate"><?php echo $this->_var['lang']['all_time']; ?></a></li>
                            <li id="time_today"><a href="javascript:void(0);" data-idtxt="submitDate" data-action="<?php echo $this->_var['action']; ?>" data-type="dateTime" data-id="today" data-value="today"><?php echo $this->_var['lang']['Today']; ?></a></li>
                            <li id="time_three_today"><a href="javascript:void(0);" data-idtxt="submitDate" data-action="<?php echo $this->_var['action']; ?>" data-type="dateTime" data-id="three_today" data-value="three_today"><?php echo $this->_var['lang']['three_today']; ?></a></li>
                            <li id="time_aweek"><a href="javascript:void(0);" data-idtxt="submitDate" data-action="<?php echo $this->_var['action']; ?>" data-type="dateTime" data-id="aweek" data-value="aweek"><?php echo $this->_var['lang']['aweek']; ?></a></li>
                            <li id="time_thismonth"><a href="javascript:void(0);" data-idtxt="submitDate" data-action="<?php echo $this->_var['action']; ?>" data-type="dateTime" data-id="thismonth" data-value="thismonth"><?php echo $this->_var['lang']['thismonth']; ?></a></li>
                        </ul>
                        <input name="order_submitDate" type="hidden" value="allDate" id="dateTime_val">
                    </div>
                </div>
                <div class="user-list-search">
                    <input type="text" id="ip_keyword" class="text" onkeydown="javascript:if(event.keyCode==13) get_OrderSearch('ip_keyword');" onblur="if (this.value=='') this.value=this.defaultValue; this.style.color='#999'" onfocus="if (this.value==this.defaultValue)this.value='';this.style.color='#666'" placeholder="<?php echo $this->_var['lang']['search_oreder_user']; ?>" name="" style="color:#999;"/>
                    <button type="button" onclick="get_OrderSearch('ip_keyword', '<?php echo $this->_var['action']; ?>', 'text')"><i class="iconfont icon-search"></i></button>
                </div>
            </div>
            <div id="user_order_list">
            <?php if (! $this->_var['order_type']): ?>
            <?php echo $this->fetch('library/user_order_list.lbi'); ?>
            <?php endif; ?>
            </div>
        </div>
        <?php endif; ?> 
        

        
        <?php if ($this->_var['action'] == 'order_detail' || $this->_var['action'] == 'auction_order_detail'): ?>
        <div class="user-mod user-order-detail">
            <div class="user-title">
                <h2><?php echo $this->_var['lang']['order_detail']; ?></h2>
                <a href="user.php?act=message_list&is_order=1&order_id=<?php echo $this->_var['order']['order_id']; ?>" class="more"><?php echo $this->_var['lang']['type']['0']; ?><em>&nbsp;&nbsp;(&nbsp;<?php echo $this->_var['feedback_num']; ?>&nbsp;)</em></a>
            </div>
            <div class="order-detail-statu">
                <div class="statu-left">
                    <p><?php echo $this->_var['order']['pay_status_desc']; ?><?php echo $this->_var['lang']['your_order']; ?> <span style="color: deepskyblue;"><?php if ($this->_var['is_baitiao']): ?><?php if ($this->_var['stages_info']['is_stages']): ?>【<?php echo $this->_var['lang']['Ious_staging']; ?>】<?php else: ?>【<?php echo $this->_var['lang']['baitiao_order']; ?>】<?php endif; ?><?php endif; ?></span></p>
                    <p><?php echo $this->_var['lang']['order_number']; ?>：<?php echo $this->_var['order']['order_sn']; ?>
                    <?php if ($this->_var['order']['extension_code'] == "group_buy"): ?>
                        <a href="./group_buy.php?act=view&id=<?php echo $this->_var['order']['extension_id']; ?>" class="f6"><strong><?php echo $this->_var['lang']['order_is_group_buy']; ?></strong></a>
                    <?php elseif ($this->_var['order']['extension_code'] == "exchange_goods"): ?>
                        <a href="./exchange.php?act=view&id=<?php echo $this->_var['order']['extension_id']; ?>" class="f6"><strong><?php echo $this->_var['lang']['order_is_exchange']; ?></strong></a>
                    <?php elseif ($this->_var['order']['extension_code'] == "presale"): ?>
                        <a href="./presale.php?act=view&id=<?php echo $this->_var['order']['extension_id']; ?>" class="f6"><strong><?php echo $this->_var['lang']['order_is_presale']; ?></strong></a>
					<?php elseif ($this->_var['order']['extension_code'] == "auction"): ?>
                        <a href="./auction.php?act=view&id=<?php echo $this->_var['order']['extension_id']; ?>" class="f6"><strong><?php echo $this->_var['lang']['order_is_auction']; ?></strong></a>
					<?php elseif ($this->_var['order']['extension_code'] == "seckill"): ?>
                        <a href="./seckill.php?act=view&id=<?php echo $this->_var['order']['extension_id']; ?>" class="f6"><strong><?php echo $this->_var['lang']['order_is_seckill']; ?></strong></a>
					<?php elseif ($this->_var['order']['extension_code'] == "snatch"): ?>
                        <a href="./snatch.php?act=view&id=<?php echo $this->_var['order']['extension_id']; ?>" class="f6"><strong><?php echo $this->_var['lang']['order_is_snatch']; ?></strong></a>
                    <?php endif; ?>  
                    </p>
                </div>
                <div class="statu-right mt10">
                    <?php if ($this->_var['order']['affirm_received']): ?>
                    <a href="<?php echo $this->_var['order']['affirm_received']; ?>" onclick="if (!confirm('<?php echo $this->_var['lang']['confirm_received']; ?>')) return false;" class="sc-btn sc-blue-btn"><?php echo $this->_var['lang']['received']; ?></a>
                    <?php endif; ?>
                </div>
            </div>
            
            <ul class="order-detail-progress progress-<?php echo $this->_var['order']['order_tracking']; ?>">
                <li><?php echo $this->_var['lang']['order_addtime']; ?><div class="tip"><?php echo $this->_var['order']['add_time']; ?></div></li>
                <li><?php echo $this->_var['lang']['pay']; ?><div class="tip"><?php echo $this->_var['order']['pay_time']; ?></div></li>
                <li><?php echo $this->_var['lang']['deliver_goods']; ?><div class="tip"><?php echo $this->_var['order']['shipping_time']; ?></div></li>
                <li><?php echo $this->_var['lang']['collect_goods']; ?><div class="tip"><?php echo $this->_var['order']['confirm_take_time']; ?></div></li>
                <li><?php echo $this->_var['lang']['complete']; ?><div class="tip"></div></li>
            </ul>
            <div class="user-info-list">
                <div class="info-title"><h2><?php echo $this->_var['lang']['consignee_info']; ?></h2></div>
                <div class="info-content">
                    <div class="info-item">
                        <div class="item-label"><?php echo $this->_var['lang']['consignee']; ?>：</div>
                        <div class="item-value"><?php echo $this->_var['order']['consignee']; ?></div>
                    </div>
                    <div class="info-item">
                        <div class="item-label"><?php echo $this->_var['lang']['label_mobile']; ?>：</div>
                        <div class="item-value"><?php echo $this->_var['order']['mobile']; ?></div>
                    </div>
                    <div class="info-item">
                        <div class="item-label"><?php echo $this->_var['lang']['label_address']; ?>：</div>
                        <div class="item-value"><?php echo $this->_var['order']['region']; ?>&nbsp;<?php echo $this->_var['order']['address']; ?></div>
                    </div>
                </div>
            </div>
            
            <?php if ($this->_var['order']['store_id']): ?>
            <div class="user-info-list">
                <div class="info-title"><h2><?php echo $this->_var['lang']['offline_store_information']; ?></h2></div>
                <div class="info-content">
                    <?php if ($this->_var['order']['pick_code'] && $this->_var['order']['pay_status'] == 2): ?>
                    <div class="info-item">
                        <div class="item-label"><?php echo $this->_var['lang']['pick_code']; ?>：</div>
                        <div class="item-value red"><?php echo $this->_var['order']['pick_code']; ?></div>
                    </div>
                    <div class="info-item">
                        <div class="item-label"><?php echo $this->_var['lang']['tpnd_time']; ?>：</div>
                        <div class="item-value"><?php echo $this->_var['order']['take_time']; ?></div>
                    </div>
                    <?php endif; ?>
                    
                    <?php if ($this->_var['offline_store']): ?>
                    <div class="info-item">
                        <div class="item-label"><?php echo $this->_var['lang']['stores_name']; ?>：</div>
                        <div class="item-value"><?php echo $this->_var['offline_store']['stores_name']; ?></div>
                    </div>
                    <div class="info-item">
                        <div class="item-label"><?php echo $this->_var['lang']['contact_phone']; ?>：</div>
                        <div class="item-value"><?php echo $this->_var['offline_store']['stores_tel']; ?></div>
                    </div>
                    <div class="info-item">
                        <div class="item-label"><?php echo $this->_var['lang']['user_address']; ?>：</div>
                        <div class="item-value"><?php echo $this->_var['offline_store']['province']; ?>&nbsp;<?php echo $this->_var['offline_store']['city']; ?>&nbsp;<?php echo $this->_var['offline_store']['district']; ?>&nbsp;<?php echo $this->_var['offline_store']['stores_address']; ?></div>
                    </div>
                    <div class="info-item">
                        <div class="item-label"><?php echo $this->_var['lang']['stores_opening_hours']; ?>：</div>
                        <div class="item-value"><?php echo $this->_var['offline_store']['stores_opening_hours']; ?></div>
                    </div>
                    <div class="info-item">
                        <div class="item-label"><?php echo $this->_var['lang']['stores_traffic_line']; ?>：</div>
                        <div class="item-value"><?php echo $this->_var['offline_store']['stores_traffic_line']; ?></div>
                    </div>
                    <?php if ($this->_var['offline_store']['stores_img']): ?>
                    <div class="info-item">
                        <div class="item-label"><?php echo $this->_var['lang']['stores_img']; ?>：</div>
                        <div class="item-value"><a href="<?php echo $this->_var['offline_store']['stores_img']; ?>" class="nyroModal ftx-05"><?php echo $this->_var['lang']['view_image']; ?></a></div>
                    </div>
                    <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
            
            <?php if ($this->_var['order']['extension_code'] != 'wholesale'): ?>
            <div class="user-info-list">
                <div class="info-title"><h2><?php echo $this->_var['lang']['pay_info']; ?></h2></div>
				<?php if (! $this->_var['seckill_status'] || $this->_var['order']['pay_time']): ?>
                <div class="info-content">
                    <div class="info-item">
                        <div class="item-label"><?php echo $this->_var['lang']['payment_method']; ?>：</div>
                        <div class="item-value"><?php echo $this->_var['order']['pay_name']; ?></div>
                        <?php if ($this->_var['order']['pay_code'] == 'bank'): ?>
                        <div class="item-value mt5 ftx-08"><?php echo $this->_var['order']['pay_desc']; ?></div>
                        <?php endif; ?>
                        </div>
                    <?php if ($this->_var['is_presale']): ?>
                        <?php if ($this->_var['settle_status'] > 0): ?>
                            <?php if ($this->_var['is_onlinepay']): ?>
                                <?php if ($this->_var['payment_list']): ?>
                                <div class="info-item">
                                    <div class="item-label lh30"><?php echo $this->_var['lang']['pay_noline']; ?>：</div>
                                    <div class="item-value">
                                        <form name="payment" method="post" action="user.php">
                                        <select name="pay_id">
                                          <?php $_from = $this->_var['payment_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'payment');if (count($_from)):
    foreach ($_from AS $this->_var['payment']):
?>
                                          <option value="<?php echo $this->_var['payment']['pay_id']; ?>">
                                          <?php echo $this->_var['payment']['pay_name']; ?>(<?php echo $this->_var['lang']['pay_fee']; ?>:<?php echo $this->_var['payment']['format_pay_fee']; ?>)
                                          </option>
                                          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                        </select>
                                        <input type="hidden" name="act" value="act_edit_payment" />
                                        <input type="hidden" name="order_id" value="<?php echo $this->_var['order']['order_id']; ?>" />
                                        <input type="submit" name="Submit" class="btn sc-redBg-btn btn30 ml5" value="<?php echo $this->_var['lang']['button_submit']; ?>" />
                                        </form>
                                    </div>
                  				</div>
                                <?php endif; ?> 
                                
                                <?php if ($this->_var['allow_edit_surplus']): ?>
                                <div class="info-item"> 
                                    <div class="item-label lh30"><?php echo $this->_var['lang']['use_surplus']; ?>：</div>
                                    <div class="item-value">
                                    <form action="user.php" method="post" name="formFee" id="formFee" class="formfee" onsubmit="return paymentForm(this)">
                                        <?php if ($this->_var['open_pay_password']): ?>
                                        <label><?php echo $this->_var['lang']['pay_password']; ?>：</label>
                                        <input type="password"   style="display:none"/>
                                        <input name="pay_pwd" id="pay_pwd_val" type="password" class="text text-2" size="20" />
                                        <?php endif; ?>
                                        <input name="surplus" id='ECS_SURPLUS' type="text" size="8" value="<?php echo empty($this->_var['order']['order_amount']) ? '0' : $this->_var['order']['order_amount']; ?>" class="text text-4 mr5"/>
                                        <input type="submit" name="Submit" class="btn sc-redBg-btn btn30 ml5" value="<?php echo $this->_var['lang']['button_submit']; ?>" class="btn sc-redBg-btn btn30" />
                                        <span><?php echo $this->_var['max_surplus']; ?></span>
                                        <input type="hidden" name="act" value="act_edit_surplus" />
                                        <input type="hidden" name="pay_status" value="<?php echo $this->_var['order']['extension_code']; ?>" />
                                        <input type="hidden" name="order_id" value="<?php echo $_GET['order_id']; ?>" />
                                    </form>
                                    <script type="text/javascript">
                                    function paymentForm(frm){
                                        <?php if ($this->_var['open_pay_password']): ?>
                                        var pwd_erorr = 0;
                                        var pay_pwd = $("#pay_pwd_val").val();
                                        $.ajax({
                                            type:"post",
                                            url:"user.php?act=pay_pwd",
                                            data:'pay_pwd=' + pay_pwd,
                                            dataType: 'json',
                                            async : false, //设置为同步操作就可以给全局变量赋值成功
                                            success:function(result){
                                                pwd_erorr = result.error;
                                            }
                                        }); 
    
                                        if(pwd_erorr == 1 || pay_pwd == '' || pay_pwd == 0){
                                            pbDialog(json_languages.pay_password_packup_null,"",0);
                                            return false;
                                        }else if(pwd_erorr == 2){
                                            pbDialog(json_languages.pay_password_packup_error,"",0);
                                            return false;
                                        }
                                        <?php endif; ?>
                                        
                                        var surplus = $("#ECS_SURPLUS").val();
                                        if(surplus == '' || surplus == 0){
                                            pbDialog(json_languages.surplus_null,"",0);
                                            return false;
                                        }else{
											if(!/^[0-9]+\.?[0-9]*$/.test(surplus)){
												pbDialog(json_languages.surplus_isnumber,"",0);
                                                return false;
											}
                                        }
                                    }
                                    </script>
                                    </div>
                                </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php elseif ($this->_var['settle_status'] < 0): ?>
                        <div class="info-item">
                            <div class="item-label"><?php echo $this->_var['lang']['pay_prompt']; ?>：</div>
                            <div class="item-value"><?php echo $this->_var['lang']['end_pay_time']; ?>：<span class="ftx-01"><?php echo $this->_var['pay_end_time']; ?></span>！</div>
                        </div>                           
                        <?php endif; ?>
                        <div class="info-item">
                            <div class="item-label"><?php echo $this->_var['lang']['pay_prompt']; ?>：</div>
                            <div class="item-value"><?php echo $this->_var['lang']['pay_end_one']; ?><span style='color:red'><?php echo $this->_var['pay_start_time']; ?></span ><?php echo $this->_var['lang']['zhi']; ?><span style='color:red'><?php echo $this->_var['pay_end_time']; ?></span><?php echo $this->_var['lang']['pay_end_two']; ?></div>
                        </div>
                    <?php else: ?>
                        <?php if ($this->_var['is_onlinepay']): ?>
                            <?php if ($this->_var['payment_list']): ?>
                                <div class="info-item">
                                    <div class="item-label lh30"><?php echo $this->_var['lang']['pay_noline']; ?>：</div>
                                    <div class="item-value">
                                        <form name="payment" method="post" action="user.php">
                                            <select name="pay_id" class="select">
                                              <?php $_from = $this->_var['payment_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'payment');if (count($_from)):
    foreach ($_from AS $this->_var['payment']):
?>
                                              <option value="<?php echo $this->_var['payment']['pay_id']; ?>">
                                              <?php echo $this->_var['payment']['pay_name']; ?>(<?php echo $this->_var['lang']['pay_fee']; ?>:<?php echo $this->_var['payment']['format_pay_fee']; ?>)
                                              </option>
                                              <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                            </select>
                                            <input type="hidden" name="act" value="act_edit_payment" />
                                            <input type="hidden" name="order_id" value="<?php echo $this->_var['order']['order_id']; ?>" />
                                            <input type="submit" name="Submit" class="btn sc-redBg-btn btn30 ml5" value="<?php echo $this->_var['lang']['button_submit']; ?>" />
                                        </form>
                                    </div>
                                </div>
                                <?php if ($this->_var['allow_edit_surplus']): ?>
                                <div class="info-item">
                                    <div class="item-label lh30"><?php echo $this->_var['lang']['use_surplus']; ?>：</div>
                                    <div class="item-value">
                                        <form action="user.php" method="post" name="formFee" id="formFee" class="formfee" onsubmit="return paymentForm(this)">
                                            <?php if ($this->_var['open_pay_password']): ?>
                                            <label><?php echo $this->_var['lang']['pay_password']; ?>：</label>
                                            <input type="password"   style="display:none"/>
                                            <input name="pay_pwd" id="pay_pwd_val" type="password" class="text text-2" size="20" />
                                            <?php endif; ?>
                                            <input name="surplus" id='ECS_SURPLUS' type="text" size="8" value="<?php echo empty($this->_var['order']['order_amount']) ? '0' : $this->_var['order']['order_amount']; ?>" class="text text-4 mr5" />
                                            <input type="submit" name="Submit" class="btn sc-redBg-btn btn30" value="<?php echo $this->_var['lang']['button_submit']; ?>" />
                                            <span><?php echo $this->_var['max_surplus']; ?></span>
                                            <input type="hidden" name="act" value="act_edit_surplus" />
                                            <input type="hidden" name="pay_status" value="<?php echo $this->_var['order']['extension_code']; ?>" />
                                            <input type="hidden" name="order_id" value="<?php echo $_GET['order_id']; ?>" />
                                        </form>
                                    </div>    
                                  <script type="text/javascript">
                                    function paymentForm(frm){
                                        <?php if ($this->_var['open_pay_password']): ?>
                                        var pwd_erorr = 0;
                                        var pay_pwd = $("#pay_pwd_val").val();
                                        $.ajax({
                                            type:"post",
                                            url:"user.php?act=pay_pwd",
                                            data:'pay_pwd=' + pay_pwd,
                                            dataType: 'json',
                                            async : false, //设置为同步操作就可以给全局变量赋值成功
                                            success:function(result){
                                                pwd_erorr = result.error;
                                            }
                                        }); 
    
                                        if(pwd_erorr == 1 || pay_pwd == '' || pay_pwd == 0){
                                            pbDialog(json_languages.pay_password_packup_null,"",0);
                                            return false;
                                        }else if(pwd_erorr == 2){
                                            pbDialog(json_languages.pay_password_packup_error,"",0);
                                            return false;
                                        }
                                        <?php endif; ?>
                                        
                                        var surplus = $("#ECS_SURPLUS").val();
                                        if(surplus == '' || surplus == 0){
                                            pbDialog(json_languages.surplus_null,"",0);
                                            return false;
                                        }else{
											if(!/^[0-9]+\.?[0-9]*$/.test(surplus)){
												pbDialog(json_languages.surplus_isnumber,"",0);
                                                return false;
											}
                                        }
                                    }
                                    </script>
                                </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                    
                    <div class="info-item">
                        <div class="item-label lh30"><?php echo $this->_var['lang']['detail_pay_status']; ?>：</div>
                        <div class="item-value lh30">
                            <?php echo $this->_var['order']['pay_status_desc']; ?><?php if ($this->_var['order']['order_amount'] > 0 && $this->_var['order']['pay_online']): ?>
                            <div class="or-btn"><?php echo $this->_var['order']['pay_online']; ?></div>
                            <?php else: ?>
                                
                                <?php if ($this->_var['order']['pay_code'] == 'chunsejinrong' && $this->_var['order']['pay_status'] == 0): ?>
                                    <div class="or-btn">
                                        <div class="alipay" style="text-align:center">
                                        <input onclick="get_user_chunsejinrong();" value="<?php echo $this->_var['lang']['ious_pay']; ?>" type="button">
                                        </div>
                                    </div>
                          			<script type="text/javascript">
                                        function get_user_chunsejinrong(){
                                            location.href = "flow.php?step=done&act=chunsejinrong&order_sn=<?php echo $this->_var['order']['order_sn']; ?>";
                                        }
                                    </script>
                                <?php endif; ?>
                                
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php if ($this->_var['order']['pay_time']): ?>
                    <div class="info-item">
                        <div class="item-label"><?php echo $this->_var['lang']['pay_time_alt']; ?>：</div>
                        <div class="item-value"><?php echo $this->_var['order']['pay_time']; ?></div>
                    </div>
                    <?php endif; ?>
                </div>
				<?php else: ?>
                <div class="statu-left">
                    <p class="red"><?php echo $this->_var['lang']['order_prompt_notic']; ?></p>
                </div>
				<?php endif; ?>
            </div>
            <?php endif; ?>
            <div class="user-info-list">
                <div class="info-title">
                    <h2><?php echo $this->_var['lang']['shipping_info']; ?></h2>
                    <?php if ($this->_var['order']['dsc_shipping_status'] == 1 && $this->_var['open_order_delay'] == 1 && $this->_var['order']['allow_order_delay'] == 1): ?><a href="javascript:void(0);" class="sc-btn sc-blue-btn ml10" data-id="<?php echo $this->_var['order']['order_id']; ?>" id="sbumit_order_delay"><?php echo $this->_var['lang']['order_delayed']; ?></a><?php endif; ?>
                </div>
                <div class="info-content">
                    <div class="info-item">
                        <div class="item-label"><?php echo $this->_var['lang']['shipping']; ?>：</div>
						<?php if ($this->_var['order']['store_id']): ?>
						<div class="item-value" id="shipping_name_<?php echo $this->_var['order']['order_id']; ?>"><?php echo $this->_var['lang']['self_lift']; ?></div>
						<?php else: ?>
						<div class="item-value" id="shipping_name_<?php echo $this->_var['order']['order_id']; ?>"><?php echo $this->_var['order']['shipping_name']; ?><?php if ($this->_var['order']['point']): ?><a class="ml10" href="javascript:;" ectype="btn-selfPoint"><?php echo $this->_var['lang']['view_self_lift']; ?></a><?php endif; ?></div>
						<?php endif; ?>
                        
                    </div>
                    <?php if ($this->_var['order']['invoice_no']): ?>
                    <div class="info-item">
                        <div class="item-label"><?php echo $this->_var['lang']['Waybill_number']; ?>：</div>
                        <div class="item-value" id="invoice_no_<?php echo $this->_var['order']['order_id']; ?>">
							<ul ectype="invoice_no_list">
								<?php $_from = $this->_var['order']['invoice_no_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'invoice_no_item');if (count($_from)):
    foreach ($_from AS $this->_var['invoice_no_item']):
?>
								<li data-invoice_no="<?php echo $this->_var['invoice_no_item']; ?>">
									<span><?php echo $this->_var['invoice_no_item']; ?></span>
									<?php if ($this->_var['order']['invoice_no_count'] > 1): ?><a href="javascript:view_logistics_info('<?php echo $this->_var['order']['order_id']; ?>', '<?php echo $this->_var['invoice_no_item']; ?>');" class="ml10"><?php echo $this->_var['lang']['view_logistics']; ?></a><?php endif; ?>
								</li>
								<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
							</ul>
						</div>
                    </div>
                    <?php endif; ?>
                    <div class="info-item">
                        <div class="item-label"><?php echo $this->_var['lang']['detail_shipping_status']; ?>：</div>
                        <div class="item-value"><?php echo $this->_var['order']['shipping_status']; ?></div>
                    </div>
                    <?php if ($this->_var['order']['shipping_time']): ?>
                    <div class="info-item">
                        <div class="item-label"><?php echo $this->_var['lang']['shipping_date']; ?>：</div>
                        <div class="item-value"><?php echo $this->_var['order']['shipping_time']; ?></div>
                    </div>
                    <?php endif; ?>

					<?php if ($this->_var['order']['dsc_shipping_status'] == 1): ?>
					<div class="info-item">
						<div class="item-label"><?php echo $this->_var['lang']['received']; ?>：</div>
						<div class="item-value">
							<div class="time" ectype="time" data-time="<?php echo $this->_var['order']['auto_delivery_time']; ?>">
								<span></span>
								<span class="days red">00</span>
								<em>:</em>
								<span class="hours red">00</span>
								<em>:</em>
								<span class="minutes red">00</span>
								<em>:</em>
								<span class="seconds red">00</span>					   
							</div>
						</div>
					</div>
					<?php echo $this->smarty_insert_scripts(array('files'=>'jquery.SuperSlide.2.1.1.js,jquery.yomi.js')); ?>
					<script type="text/javascript">
					$("*[ectype='time']").each(function(){
						$(this).yomi();
					});
					</script>
                    <?php endif; ?>
                    <?php if ($this->_var['order']['best_time']): ?>
                    <div class="info-item">
                        <div class="item-label"><?php echo $this->_var['lang']['deliver_time']; ?>：</div>
                        <div class="item-value"><?php echo $this->_var['order']['best_time']; ?></div>
                    </div>
                    <?php endif; ?>
					<?php if ($this->_var['order']['point']): ?>
					<div id="selfPoint" style="display:none;">
						<div class="user-info-list">
							<div class="info-content">
								<div class="info-item">
									<div class="item-label"><?php echo $this->_var['lang']['pay_name']; ?>：</div>
									<div class="item-value"><?php echo $this->_var['order']['point']['name']; ?></div>
								</div>
								<div class="info-item">
									<div class="item-label"><?php echo $this->_var['lang']['contact_username']; ?>：</div>
									<div class="item-value"><?php echo $this->_var['order']['point']['user_name']; ?></div>
								</div>
								<div class="info-item">
									<div class="item-label"><?php echo $this->_var['lang']['contact_phone']; ?>：</div>
									<div class="item-value"><?php echo $this->_var['order']['point']['mobile']; ?></div>
								</div>
								<div class="info-item">
									<div class="item-label"><?php echo $this->_var['lang']['user_address']; ?>：</div>
									<div class="item-value"><?php echo $this->_var['order']['point']['address']; ?></div>
								</div>
								<div class="info-item">
									<div class="item-label"><?php echo $this->_var['lang']['line_of_arrival']; ?>：</div>
									<div class="item-value"><?php echo $this->_var['order']['point']['line']; ?></div>
								</div>
								<div class="info-item">
									<div class="item-label"><?php echo $this->_var['lang']['self_lift_time']; ?>：</div>
									<div class="item-value"><?php echo $this->_var['order']['point']['pickDate']; ?></div>
								</div>
							</div>
						</div>
					</div>
				    <script type="text/javascript">
						//点击自提信息弹出框
						$(document).on('click', "a[ectype='btn-selfPoint']", function(){
							var content = $("#selfPoint").html();
							pb({
								id:divId,
								title:'<?php echo $this->_var['lang']['since_some_info']; ?>',
								width:400,
								height:250,
								content:content,
								drag:false,
								foot:false,
							});
						});
					</script>
					<?php endif; ?>
                </div>
            </div>
            <?php if ($this->_var['order']['invoice_no']): ?>
            <div class="user-info-list">
                <div class="info-title"><h2><?php echo $this->_var['lang']['logistics_tracking']; ?></h2></div>
                <div class="info-content">
                    <div class="logistics-items" id="retData_<?php echo $this->_var['order']['order_id']; ?>"></div>
                </div>
            </div>
          	<script type="text/javascript">
                $(function(){
                    var expressid = $("#shipping_name_" + <?php echo $this->_var['order']['order_id']; ?>).html();
                    //var expressno = $("#invoice_no_" + <?php echo $this->_var['order']['order_id']; ?>).html();
                    var expressno = $("[ectype='invoice_no_list']").find("li:first").data("invoice_no");
                
                    $("#retData_" + <?php echo $this->_var['order']['order_id']; ?>).html("<center>"+json_languages.logistics_tracking_in+"</center>");
                    
                    $.ajax({
                        url: "plugins/kuaidi/express.php",
                        type: "post",
                        data:'com=' + expressid + '&nu=' + expressno,
                        success: function(data,textStatus){
                            $("#retData_" + <?php echo $this->_var['order']['order_id']; ?>).html(data);
                        },
                         error: function(o){
                        }
                    });
                });

				//查看物流
				function view_logistics_info(order_id, invoice_no){
					$.jqueryAjax('get_ajax_content.php', 'act=view_logistics_info&order_id='+order_id+'&invoice_no='+invoice_no, function(result){
						pb({
							id:'logistics_info_dialog',
							title:'<?php echo $this->_var['lang']['search_logistics']; ?>',
							width:500,
							height:60,
							content:'',
							drag:false,
							foot:false,
						});	
						//插入物流信息
						$.ajax({
							url: "plugins/kuaidi/express.php",
							type: "post",
							data:'com=' + result.expressid + '&nu=' + result.expressno,
							success: function(data,textStatus){
								$("#logistics_info_dialog .pb-ct").html(data);
							},
							 error: function(o){
							}
						});						
					})
				}
            </script>
            <?php endif; ?>
            <?php if ($this->_var['can_invoice']): ?>
            <div class="user-info-list">
                <div class="info-title"><h2><?php echo $this->_var['lang']['Invoice_information']; ?></h2></div>
				<?php if ($this->_var['order']['invoice_type'] == 0): ?>
                <div class="info-content">
                    <div class="info-item">
                        <div class="item-label"><?php echo $this->_var['lang']['invoice_type']; ?>：</div>
                        <div class="item-value"><?php if ($this->_var['order']['extension_code'] != exchange_goods): ?><?php echo $this->_var['lang']['need_invoice'][$this->_var['order']['invoice_type']]; ?><?php else: ?><?php echo $this->_var['lang']['wu']; ?><?php endif; ?></div>
                    </div>
                    <div class="info-item">
                        <div class="item-label"><?php echo $this->_var['lang']['invoice_content']; ?>：</div>
                        <div class="item-value"><?php if ($this->_var['order']['extension_code'] != exchange_goods): ?><?php echo $this->_var['order']['inv_content']; ?><?php else: ?><?php echo $this->_var['lang']['wu']; ?><?php endif; ?></div>
                    </div>
                    <div class="info-item">
                        <div class="item-label"><?php echo $this->_var['lang']['invoice_title']; ?>：</div>
                        <div class="item-value"><?php if ($this->_var['order']['extension_code'] != exchange_goods): ?><?php echo $this->_var['order']['inv_payee']; ?><?php else: ?><?php echo $this->_var['lang']['wu']; ?><?php endif; ?></div>
                    </div>
					<?php if ($this->_var['order']['tax_id']): ?>
					<div class="info-item">
                        <div class="item-label"><?php echo $this->_var['lang']['tax_id']; ?>：</div>
                        <div class="item-value"><?php echo $this->_var['order']['tax_id']; ?></div>
                    </div>
					<?php endif; ?>
                </div>
				<?php else: ?>
				<div class="info-content">
                    <div class="info-item">
                        <div class="item-label"><?php echo $this->_var['lang']['invoice_type']; ?>：</div>
                        <div class="item-value"><?php echo $this->_var['lang']['need_invoice'][$this->_var['order']['invoice_type']]; ?></div>
                    </div>
					<div class="info-item">
                        <div class="item-label"><?php echo $this->_var['lang']['adopt_status']; ?>：</div>
                        <div class="item-value">
							<?php if ($this->_var['vat_info']['audit_status'] == 0): ?>
								<?php echo $this->_var['lang']['not_audited']; ?>
							<?php elseif ($this->_var['vat_info']['audit_status'] == 1): ?>
								<?php echo $this->_var['lang']['audited_adopt']; ?>
							<?php elseif ($this->_var['vat_info']['audit_status'] == 2): ?>
								<?php echo $this->_var['lang']['audited_not_adopt']; ?>
							<?php endif; ?>
						</div>
                    </div>
                    <div class="info-item">
                        <div class="item-label"><?php echo $this->_var['lang']['label_company_name']; ?>：</div>
                        <div class="item-value"><?php echo $this->_var['vat_info']['company_name']; ?></div>
                    </div>
                    <div class="info-item">
                        <div class="item-label"><?php echo $this->_var['lang']['tax_id']; ?>：</div>
                        <div class="item-value"><?php echo $this->_var['vat_info']['tax_id']; ?></div>
                    </div>
                </div>
				<?php endif; ?>
            </div>
            <?php endif; ?>
            <?php if ($this->_var['order']['postscript']): ?>
             <div class="user-info-list">
                <div class="info-title"><h2><?php echo $this->_var['lang']['Order_note_user']; ?></h2></div>
                <div class="info-content">
                    <div class="info-item">
                        <div class="item-label"><?php echo $this->_var['lang']['Order_note_user']; ?>：</div>
                        <div class="item-value"><?php echo $this->_var['order']['postscript']; ?></div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <div class="pt10 pb10">
                <a href="<?php echo $this->_var['order']['shop_url']; ?>" class="user-shop-link"><?php echo $this->_var['order']['shop_name']; ?></a>
                <?php if ($this->_var['order']['is_IM'] == 1 || $this->_var['order']['is_dsc']): ?>
                <a id="IM" onclick="openWin(this)" href="javascript:;" ru_id="<?php echo $this->_var['order']['ru_id']; ?>" goods_id="<?php echo $this->_var['goods']['goods_id']; ?>" class="iconfont icon-kefu user-shop-kefu"></a>
                <?php else: ?>
                <?php if ($this->_var['order']['kf_type'] == 1): ?>
                <a href="http://www.taobao.com/webww/ww.php?ver=3&touid=<?php echo $this->_var['order']['kf_ww']; ?>&siteid=cntaobao&status=1&charset=utf-8" class="iconfont icon-kefu user-shop-kefu" target="_blank"></a>
                <?php else: ?>
                <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $this->_var['order']['kf_qq']; ?>&site=qq&menu=yes" class="iconfont icon-kefu user-shop-kefu" target="_blank"></a>
                <?php endif; ?>
                <?php endif; ?>
                <?php if ($this->_var['order']['return_url']): ?><a href="<?php echo $this->_var['order']['return_url']; ?>" class="more"><?php echo $this->_var['lang']['return_apply']; ?></a><?php endif; ?>
            </div>
            <?php if ($this->_var['order']['is_zc_order'] == 1): ?>
            <table class="user-table user-table-detail-goods">
                <colgroup>
                    <col width="320">
                    <col width="110">
                    <col width="120">
                    <col width="95">
                    <col width="90">
                    <col>
                </colgroup>
                <thead>
                    <tr>
                        <th><?php echo $this->_var['lang']['zc_project_name']; ?></th>
                        <th class="tl"><?php echo $this->_var['lang']['start_time']; ?></th>
                        <th class="tl"><?php echo $this->_var['lang']['end_time']; ?></th>
                        <th class="tl"><?php echo $this->_var['lang']['zc_project_raise_money']; ?></th>
                        <th class="tl"><?php echo $this->_var['lang']['zc_goods_price']; ?></th>
                        <th class="tl"><?php echo $this->_var['lang']['freight']; ?></th>
                        <th><?php echo $this->_var['lang']['ws_subtotal']; ?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="product-item first">
                                <div class="p-img fl"><a href="crowdfunding.php?act=detail&id=<?php echo $this->_var['zc_goods_info']['pid']; ?>" target="_blank"><img src="<?php echo $this->_var['zc_goods_info']['title_img']; ?>" width="55" height="55"></a></div>                                                                 
                                <div class="p-name fl ml10">
                                <a href="crowdfunding.php?act=detail&id=<?php echo $this->_var['zc_goods_info']['pid']; ?>" class="ftx-07" target="_blank"><?php echo $this->_var['zc_goods_info']['title']; ?></a>
                                </div>
                            </div> 							
                        </td>
                        <td><?php echo $this->_var['zc_goods_info']['start_time']; ?></td>
                        <td><?php echo $this->_var['zc_goods_info']['end_time']; ?></td>
                        <td><?php echo $this->_var['zc_goods_info']['formated_amount']; ?></td>
                        <td><?php echo $this->_var['zc_goods_info']['formated_price']; ?></td>
                        <td><?php echo $this->_var['zc_goods_info']['formated_shipping_fee']; ?></td>
                        <td><?php echo $this->_var['zc_goods_info']['formated_price']; ?></td>
                    </tr>
                </tbody>
            </table>
            <?php else: ?>
            <table class="user-table user-table-detail-goods">
                <colgroup>
                    <col width="210">
                    <col width="110">
                    <col width="120">
                    <col width="95">
                    <col width="90">
                    <col>
					<col width="110">
                </colgroup>
                <thead>
                    <tr>
                        <th width="40%"><?php echo $this->_var['lang']['goods']; ?></th>
                        <th width="20%" class="tl"><?php echo $this->_var['lang']['goods_attr']; ?></th>
                        <th width="10%" class="tl"><?php echo $this->_var['lang']['user_goods_sn']; ?></th>
                        <th width="10%" class="tl"><?php echo $this->_var['lang']['delivery_warehouse']; ?></th>
                        <th width="10%" class="tl"><?php echo $this->_var['lang']['unit_price_user']; ?></th>
                        <th width="10%"><?php echo $this->_var['lang']['ws_subtotal']; ?></th>
                    </tr>
                </thead>
                <tbody>
                <?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
                    <tr>
                        <td>
                        <?php if ($this->_var['goods']['goods_id'] > 0 && $this->_var['goods']['extension_code'] != 'package_buy'): ?>
                            <a href="<?php echo $this->_var['goods']['url']; ?>" class="img"><img src="<?php echo $this->_var['goods']['goods_thumb']; ?>" alt=""></a>
                        <?php endif; ?>
                        <?php if ($this->_var['goods']['goods_id'] > 0 && $this->_var['goods']['extension_code'] != 'package_buy'): ?>							
                            <a href="<?php echo $this->_var['goods']['url']; ?>" class="name"<?php if ($this->_var['goods']['is_real'] == 0 && $this->_var['goods']['virtual_info']): ?> style="margin-top:7px;"<?php endif; ?>><?php echo $this->_var['goods']['goods_name']; ?></a>
                            <p class="fl ftx-05"><?php echo $this->_var['lang']['give_integral']; ?>：<?php echo $this->_var['goods']['give_integral']; ?></p>
                            <?php if ($this->_var['goods']['parent_id'] > 0): ?>
                            <p class="fl ftx-01">（<?php echo $this->_var['lang']['accessories']; ?>）</p>
                            <?php elseif ($this->_var['goods']['is_gift']): ?>
                            <p class="fl ftx-01">（<?php echo $this->_var['lang']['largess']; ?>）</p>
                            <?php endif; ?>
                        <?php elseif ($this->_var['goods']['goods_id'] > 0 && $this->_var['goods']['extension_code'] == 'package_buy'): ?>
                        <a href="javascript:void(0)" onclick="setSuitShow(<?php echo $this->_var['goods']['goods_id']; ?>)" class="name"<?php if ($this->_var['goods']['is_real'] == 0 && $this->_var['goods']['virtual_info']): ?> style="margin-top:7px;"<?php endif; ?>><?php echo $this->_var['goods']['goods_name']; ?><span class="red"><?php echo $this->_var['lang']['remark_package']; ?><i class="iconfont icon-down"></i></span></a>
                            <div class="suit" id="suit_<?php echo $this->_var['goods']['goods_id']; ?>">
                                <?php $_from = $this->_var['goods']['package_goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'package_goods_list');if (count($_from)):
    foreach ($_from AS $this->_var['package_goods_list']):
?>
                                  <a href="goods.php?id=<?php echo $this->_var['package_goods_list']['goods_id']; ?>" target="_blank">
                                    <img src="<?php echo $this->_var['package_goods_list']['goods_thumb']; ?>" />
                                  </a>
                                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                            </div>
                        <?php endif; ?> 
                            <?php if ($this->_var['goods']['is_real'] == 0 && $this->_var['goods']['virtual_info']): ?>
                            <div id="virtual_div_<?php echo $this->_var['goods']['goods_id']; ?>" class="virtual_div">
								
                                <div id="show_virtual_info_<?php echo $this->_var['goods']['goods_id']; ?>" class="virtual_title"><?php echo $this->_var['lang']['virtual_goods_info']; ?></div>
								
                                <div id="virtual_info_<?php echo $this->_var['goods']['goods_id']; ?>" class="virtual_info">
									<?php $_from = $this->_var['goods']['virtual_info']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'virtual');if (count($_from)):
    foreach ($_from AS $this->_var['virtual']):
?>
                                    <div class="virtual_info_item">
                                        <div class="v_arrow"><em></em><span></span></div>
                                        <p><?php echo $this->_var['lang']['card_sn']; ?>：<?php echo $this->_var['virtual']['card_sn']; ?></p>
                                        <p><?php echo $this->_var['lang']['card_password']; ?>：<?php echo $this->_var['virtual']['card_password']; ?></p>
                                        <p><?php echo $this->_var['lang']['end_date']; ?>：<?php echo $this->_var['virtual']['end_date']; ?></p>
                                    </div>
									<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                </div>
								
                            </div>                                      
                            <?php endif; ?> 
                        </td>
                        <td><?php echo nl2br($this->_var['goods']['goods_attr']); ?></td>
                        <td><?php echo $this->_var['goods']['goods_sn']; ?></td>
                        <td><?php echo $this->_var['goods']['warehouse_name']; ?></td>
                        <td><p><?php echo $this->_var['goods']['goods_price']; ?></p><p>×<?php echo $this->_var['goods']['goods_number']; ?></p></td>
                        <td>
                            <p class="ftx-01"><?php echo $this->_var['goods']['subtotal']; ?></p>
                            <?php if ($this->_var['goods']['dis_amount'] > 0): ?>
                            <p class="ftx-05">(<?php echo $this->_var['lang']['Discount_user']; ?>：<?php echo $this->_var['goods']['discount_amount']; ?>)</p>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                </tbody>
            </table>
            <?php endif; ?>
            <div class="user-order-detail-total">
                <?php if ($this->_var['goods_list_count'] > 0): ?>
                <dl class="total-row">
                    <dt class="total-label">商品件数：</dt>
                    <dd class="total-value"><?php echo $this->_var['goods_list_count']; ?><?php echo $this->_var['lang']['jian']; ?></dd>
                </dl>
                <?php endif; ?>
                <dl class="total-row">
                    <dt class="total-label"><?php echo $this->_var['lang']['shopping_money']; ?>：</dt>
                    <dd class="total-value"><?php if ($this->_var['order']['extension_code'] == "group_buy"): ?><?php echo $this->_var['lang']['gb_deposit']; ?><?php endif; ?><?php echo $this->_var['order']['formated_goods_amount']; ?></dd>
                </dl>
                <?php if ($this->_var['order']['discount'] > 0): ?>
                <dl class="total-row">
                    <dt class="total-label"><?php echo $this->_var['lang']['discount']; ?>：</dt>
                    <dd class="total-value">-  <?php echo $this->_var['order']['formated_discount']; ?></dd>
                </dl>
                <?php endif; ?>
                <?php if ($this->_var['order']['tax'] > 0): ?>
                <dl class="total-row">
                    <dt class="total-label"><?php echo $this->_var['lang']['tax']; ?>：</dt>
                    <dd class="total-value">+  <?php echo $this->_var['order']['formated_tax']; ?></dd>
                </dl>
                <?php endif; ?>
                <?php if ($this->_var['order']['insure_fee'] > 0): ?>
                <dl class="total-row">
                    <dt class="total-label"><?php echo $this->_var['lang']['insure_fee']; ?>：</dt>
                    <dd class="total-value">+  <?php echo $this->_var['order']['formated_insure_fee']; ?></dd>
                </dl>
                <?php endif; ?>
                <?php if ($this->_var['order']['pay_fee'] > 0): ?>
                <dl class="total-row">
                    <dt class="total-label"><?php echo $this->_var['lang']['pay_fee']; ?>：</dt>
                    <dd class="total-value">+  <?php echo $this->_var['order']['formated_pay_fee']; ?></dd>
                </dl>
                <?php endif; ?>
                <?php if ($this->_var['order']['pack_fee'] > 0): ?>
                <dl class="total-row">
                    <dt class="total-label"><?php echo $this->_var['lang']['pack_fee']; ?>：</dt>
                    <dd class="total-value">+  <?php echo $this->_var['order']['formated_pack_fee']; ?></dd>
                </dl>
                <?php endif; ?>				
                <?php if ($this->_var['order']['card_fee'] > 0): ?>
                <dl class="total-row">
                    <dt class="total-label"><?php echo $this->_var['lang']['card_fee']; ?>：</dt>
                    <dd class="total-value">+ <?php echo $this->_var['order']['formated_card_fee']; ?></dd>
                </dl>
                <?php endif; ?>
                <?php if ($this->_var['order']['shipping_fee'] > 0): ?>
                <dl class="total-row">
                    <dt class="total-label"><?php echo $this->_var['lang']['shipping_fee']; ?>：</dt>
                    <dd class="total-value">+ <?php echo $this->_var['order']['formated_shipping_fee']; ?></dd>
                </dl>
                <?php endif; ?>
                <?php if ($this->_var['order']['use_val'] > 0): ?>
                <dl class="total-row">
                    <dt class="total-label"><?php echo $this->_var['lang']['use_value_card']; ?>：</dt>
                    <dd class="total-value">- <?php echo $this->_var['order']['formated_value_card']; ?></dd>
                </dl>
                <?php if ($this->_var['order']['formated_vc_dis'] < 10): ?>
                <dl class="total-row">
                    <dt class="total-label"><?php echo $this->_var['lang']['value_card_dis']; ?>：</dt>
                    <dd class="total-value"><?php echo $this->_var['order']['formated_vc_dis']; ?>折</dd>
                </dl>    
                <?php endif; ?>                
                <?php endif; ?>
                <?php if ($this->_var['order']['surplus'] > 0): ?>
                <dl class="total-row">
                    <dt class="total-label"><?php echo $this->_var['lang']['use_surplus']; ?>：</dt>
                    <dd class="total-value">- <?php echo $this->_var['order']['formated_surplus']; ?></dd>
                </dl>
                <?php endif; ?>
                <?php if ($this->_var['order']['integral_money'] > 0): ?>
                <dl class="total-row">
                    <dt class="total-label"><?php echo $this->_var['lang']['integral_offset']; ?>：</dt>
                    <dd class="total-value">- <?php echo $this->_var['order']['formated_integral_money']; ?></dd>
                </dl>
                <?php endif; ?>
                <?php if ($this->_var['order']['bonus'] > 0): ?>
                <dl class="total-row">
                    <dt class="total-label"><?php echo $this->_var['lang']['use_bonus']; ?>：</dt>
                    <dd class="total-value">- <?php echo $this->_var['order']['formated_bonus']; ?></dd>
                </dl>
                <?php endif; ?>
                <?php if ($this->_var['order']['coupons'] > 0): ?>
                <dl class="total-row">
                    <dt class="total-label"><?php echo $this->_var['lang']['preferential']; ?>：</dt>
                    <dd class="total-value">- <?php echo $this->_var['order']['formated_coupons']; ?></dd>
                </dl>
                <?php endif; ?>
                <dl class="total-row">
                    <dt class="total-label">
                    <?php if ($this->_var['order']['order_amount'] > 0 && $this->_var['order']['extension_code'] == 'presale' && $this->_var['order']['pay_status'] == 0): ?>
                    	<?php echo $this->_var['lang']['Deposit_user']; ?>：
                    <?php else: ?>
                        <?php if ($this->_var['order']['pay_status'] == 2): ?>
                            <?php if ($this->_var['order']['order_amount'] < 0): ?><?php echo $this->_var['lang']['should_back_amount']; ?>：<?php else: ?><?php echo $this->_var['lang']['Deposit_user_one']; ?>：<?php endif; ?>
                        <?php else: ?>
                            <?php echo $this->_var['lang']['Deposit_user_one']; ?>：
                        <?php endif; ?>
                    <?php endif; ?>
                    </dt>
                    <dd class="total-value"><?php if ($this->_var['order']['pay_status'] == 2): ?><?php echo $this->_var['order']['formated_realpay_amount']; ?><?php else: ?><?php echo $this->_var['order']['formated_order_amount']; ?><?php endif; ?></dd>
                </dl>
            </div>
        </div>
        <script type="text/javascript">
        var timer;
        function checkOrder(){
            var log_id = '<?php echo empty($this->_var['order']['log_id']) ? '0' : $this->_var['order']['log_id']; ?>';
            var pay_code = '<?php echo empty($this->_var['order']['pay_code']) ? '0' : $this->_var['order']['pay_code']; ?>';
            
            if(pay_code == 'wxpay'){
                var url = "user.php?act=checkorder&log_id=" + log_id+ "&pay_code=" + pay_code;
                $.get(url, {}, function(data){
                    //已付款
                    if(data.code == 1){
                        clearTimeout(timer);
                        location.href = "user.php?act=order_detail&order_id="+<?php echo $this->_var['order']['order_id']; ?>;
                    }
                },'json');
                timer = setTimeout("checkOrder()", 5000);
            }
        }
        checkOrder();  
        </script>
        <?php endif; ?>
        	

        
        <?php if ($this->_var['action'] == 'return_detail'): ?>		
        <form id="returnInfo" name="returnInfo" method="post" action="user.php" onsubmit="return shipping_sub(this)">
        <div class="user-mod user-order-detail">
            <div class="user-title mb0">
                <h2><?php echo $this->_var['lang']['detailed_info']; ?></h2>
            </div>
            <div class="user-info-list b-t-0">
                <div class="info-title"><h2><?php echo $this->_var['lang']['detailed_info']; ?></h2></div>
                <div class="info-content">
                	<div class="info-item">
                        <div class="item-label"><em style="padding-left:14px;"><?php echo $this->_var['lang']['order_number']; ?>：</em></div>
                        <div class="item-value"><?php echo $this->_var['goods']['order_sn']; ?></div>
                    </div>
                    <div class="info-item">
                        <div class="item-label"><?php echo $this->_var['lang']['return_sn']; ?>：</div>
                        <div class="item-value"><?php echo $this->_var['goods']['return_sn']; ?></div>
                    </div>
                    <div class="info-item">
                        <div class="item-label"><?php echo $this->_var['lang']['apply_time']; ?>：</div>
                        <div class="item-value"><?php echo $this->_var['goods']['apply_time']; ?></div>
                    </div>
                    <div class="info-item">
                        <div class="item-label"><?php echo $this->_var['lang']['return_type_user']; ?>：</div>
                        <div class="item-value"><?php if ($this->_var['goods']['return_type'] == 0): ?><?php echo $this->_var['lang']['order_return_type']['0']; ?><?php elseif ($this->_var['goods']['return_type'] == 1): ?><?php echo $this->_var['lang']['order_return_type']['1']; ?><?php elseif ($this->_var['goods']['return_type'] == 2): ?><?php echo $this->_var['lang']['order_return_type']['2']; ?><?php elseif ($this->_var['goods']['return_type'] == 3): ?><?php echo $this->_var['lang']['order_return_type']['3']; ?><?php endif; ?></div>
                    </div>
                </div>
            </div>
            <div class="user-info-list">
                <div class="info-title"><h2><?php echo $this->_var['lang']['order_status']; ?></h2></div>
                <div class="info-content">
                    <div class="info-item">
                        <div class="item-label"><?php echo $this->_var['lang']['order_status']; ?>：</div>
                        <div class="item-value"><?php echo $this->_var['goods']['return_status']; ?></div>
                    </div>
                    <div class="info-item">
                        <div class="item-label"><?php echo $this->_var['lang']['back_cause']; ?>：</div>
                        <div class="item-value"><?php echo $this->_var['goods']['return_brief']; ?></div>
                    </div>
                    <div class="info-item">
                        <div class="item-label"><?php echo $this->_var['lang']['order_status']; ?>：</div>
                        <div class="item-value ftx-01"><?php if ($this->_var['goods']['return_status1'] < 0): ?><?php echo $this->_var['lang']['only_return_money']; ?><?php else: ?><?php echo $this->_var['lang']['rf'][$this->_var['goods']['return_status1']]; ?><?php endif; ?>-<?php echo $this->_var['lang']['ff'][$this->_var['goods']['refound_status1']]; ?></div>
                    </div>
                    <?php if ($this->_var['goods']['action_note']): ?>
                    <div class="info-item">
                        <div class="item-label"><?php echo $this->_var['lang']['after_service_desc']; ?>：</div>
                        <div class="item-value"><?php echo $this->_var['goods']['action_note']; ?></div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="user-info-list">
                <div class="info-title"><h2><?php echo $this->_var['lang']['contact_username']; ?></h2></div>
                <div class="info-content">
                    <div class="info-item">
                        <div class="item-label"><?php echo $this->_var['lang']['contact_username']; ?>：</div>
                        <div class="item-value"><?php echo $this->_var['goods']['addressee']; ?></div>
                    </div>
                    <div class="info-item">
                        <div class="item-label"><?php echo $this->_var['lang']['Contact_address']; ?>：</div>
                        <div class="item-value"><?php echo $this->_var['goods']['address_detail']; ?></div>
                    </div>
                    <div class="info-item">
                        <div class="item-label"><?php echo $this->_var['lang']['contact_phone']; ?>：</div>
                        <div class="item-value"><?php echo $this->_var['goods']['phone']; ?></div>
                    </div>
                </div>
            </div>
            <?php if ($this->_var['goods']['return_type'] == 2): ?>
            <div class="user-info-list">
                <div class="info-title"><h2><?php echo $this->_var['lang']['progress_return']; ?></h2></div>
                <div class="user-order-list">
                    <dl class="item relative">
                        <dt class="item-t b-b-0">
                            <div class="t-statu"><?php if ($this->_var['goods']['return_status1'] == 4): ?><?php echo $this->_var['lang']['is_confirmed']; ?><?php else: ?><?php echo $this->_var['lang']['zc_ss']; ?><?php endif; ?></div>
                            <div class="t-info">
                                <span class="info-item"><?php echo $this->_var['lang']['order_number']; ?>：<?php echo $this->_var['goods']['order_sn']; ?></span>
                                <span class="info-item"><?php echo $this->_var['lang']['Waybill']; ?>：<?php if ($this->_var['goods']['out_invoice_no'] != ""): ?><?php echo $this->_var['goods']['out_invoice_no']; ?><?php else: ?>&nbsp;<?php endif; ?></span>
                                <span class="info-item"><?php echo $this->_var['lang']['Logistics_company']; ?>：<?php if ($this->_var['goods']['out_invoice_no'] != ""): ?><?php echo $this->_var['goods']['out_shipp_shipping']; ?><?php else: ?>&nbsp;<?php endif; ?></span>
                            </div>
                            <div class="t-right" ectype="track-packages-btn">
                                <a href="javascript:void(0)" class="sc-btn"><i class="iconfont icon-truck"></i><?php echo $this->_var['lang']['track']; ?></a>
                                <div class="comment-box" ectype="track-packages-info">
                                    <i class="box-i"></i>
                                    <div class="conmment-box-content">
                                        <div class="cont" id="seller_deliveryInfo">
                                            
                                        </div>
                                    </div>
                                </div>
                                <span id="invoice_no_<?php echo $this->_var['goods']['order_id']; ?>" style="display:none"><?php echo $this->_var['goods']['out_invoice_no']; ?></span>
                                <span id="shipping_name_<?php echo $this->_var['goods']['order_id']; ?>" style="display:none"><?php echo $this->_var['goods']['out_shipp_shipping']; ?></span>
                            </div>
                        </dt>
                    </dl>
                </div>
            </div>
            <?php if ($this->_var['goods']['out_invoice_no']): ?>          
            <script language="javascript">
                $("#seller_deliveryInfo").html("<center>"+json_languages.logistics_tracking_in+"</center>");
                if(document.getElementById("shipping_name_<?php echo $this->_var['goods']['order_id']; ?>"))
                {
                    var expressid = document.getElementById("shipping_name_<?php echo $this->_var['goods']['order_id']; ?>").innerHTML;
                    var expressno = document.getElementById("invoice_no_<?php echo $this->_var['goods']['order_id']; ?>").innerHTML;
                }
                $.ajax({
                    url: "plugins/kuaidi/express.php",
                    type: "post",
                    data:'com=' + expressid + '&nu=' + expressno,
                    success: function(data,textStatus){
                        $("#seller_deliveryInfo").html(data);
                    },
                     error: function(o){
                    }
                });
            </script> 
            <?php endif; ?>
            <?php endif; ?>
	    <?php if ($this->_var['return_info']): ?>
			<div class="user-info-list">
                <div class="info-title"><h2><?php echo $this->_var['lang']['seller_custome_info']; ?></h2></div>
                <div class="info-content">
                    <div class="info-item">
                        <div class="item-label"><?php echo $this->_var['lang']['contact_username']; ?>：</div>
                        <div class="item-value"><?php echo $this->_var['return_info']['linkMan']; ?></div>
                    </div>
                    <div class="info-item">
                        <div class="item-label"><?php echo $this->_var['lang']['contact_phone']; ?>：</div>
                        <div class="item-value"><?php echo $this->_var['return_info']['mobile']; ?></div>
                    </div>
                    <div class="info-item">
                        <div class="item-label"><?php echo $this->_var['lang']['Contact_address']; ?>：</div>
                        <div class="item-value"><?php echo $this->_var['return_info']['province']; ?><?php echo $this->_var['return_info']['city']; ?><?php echo $this->_var['return_info']['area']; ?><?php echo $this->_var['return_info']['address']; ?></div>
                    </div>
                </div>
            </div>
			<?php endif; ?>
            <?php if ($this->_var['goods']['agree_apply'] && $this->_var['goods']['return_type'] != 3): ?>
            
            <div class="user-info-list">
                <div class="info-title">
                    <h2><?php echo $this->_var['lang']['Express_info']; ?></h2>
                </div>
                <?php if ($this->_var['goods']['back_shipp_shipping']): ?>
                <div class="express_list">
                    <div class="ex_tit"><?php echo $this->_var['lang']['User_sent']; ?></div>
                    <div class="ex_con">
                        <div class="ex_item">
                            <span><?php echo $this->_var['lang']['Express_company']; ?>：</span>
                            <span class="blue"><?php echo $this->_var['goods']['back_shipp_shipping']; ?></span>
                        </div>
                        <div class="ex_item">
                            <span><?php echo $this->_var['lang']['courier_sz']; ?>：</span>
                            <span class="blue"><?php echo $this->_var['goods']['back_invoice_no']; ?></span>
                        </div>
                    </div>
                </div>  
                <div class="blank"></div>
                <?php else: ?>
                <div class="express_list">
                    <div class="ex_tit lh26"><?php echo $this->_var['lang']['Express_info_two']; ?></div>
                    <div class="ex_con">
                        <div class="ex_item">
                            <span><?php echo $this->_var['lang']['Express_company']; ?>：</span>
                            <select name="express_name" onchange="select_express(this)" class="select">
                                <option value="0"><?php echo $this->_var['lang']['select_Express_company']; ?></option>
								<?php $_from = $this->_var['shipping_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'shipping');if (count($_from)):
    foreach ($_from AS $this->_var['shipping']):
?>
                                <option value="<?php echo $this->_var['shipping']['shipping_id']; ?>"><?php echo $this->_var['shipping']['shipping_name']; ?></option>
								<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                <option value="999"><?php echo $this->_var['lang']['Other']; ?></option>
                            </select>
                            <input type="text" name="other_express" id="other_express" class="ml10"  style="display:none"/>
                        </div>
                        <div class="ex_item">
                            <span><?php echo $this->_var['lang']['courier_sz']; ?>：</span>
                            <input type="text" name="express_sn" class="text text-2"/>
                        </div>
                        <input type="submit" class="btn sc-redBg-btn btn30 ml75" value="<?php echo $this->_var['lang']['button_submit']; ?>"/>
                        <input type="hidden" name="act" value="edit_express">
                        <input type="hidden" name="order_id" value="<?php echo $this->_var['goods']['order_id']; ?>" />
                        <input type="hidden" name="ret_id" value="<?php echo $this->_var['goods']['ret_id']; ?>" />
                    </div>
                </div> 
                <?php endif; ?>
                <?php if ($this->_var['goods']['out_shipp_shipping']): ?>
                <div class="express_list">
                    <div class="ex_tit"><?php echo $this->_var['lang']['seller_shipping']; ?></div>
                    <div class="ex_con">
                        <div class="ex_item">
                            <span><?php echo $this->_var['lang']['Express_company']; ?>：</span>
                            <span class="blue"><?php echo $this->_var['goods']['out_shipp_shipping']; ?></span>
                        </div>
                        <div class="ex_item">
                            <span><?php echo $this->_var['lang']['courier_sz']; ?>：</span>
                            <span class="blue"><?php echo $this->_var['goods']['out_invoice_no']; ?></span>
                        </div>
                    </div>        
                </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            <?php if ($this->_var['goods']['img_list']): ?>
            <div class="user-info-list">
                <div class="info-title"><h2><?php echo $this->_var['lang']['pic_voucher']; ?></h2></div>
                <div class="info-content">
                    <div class="info-item">
                        <?php $_from = $this->_var['goods']['img_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'img');if (count($_from)):
    foreach ($_from AS $this->_var['img']):
?>
                        <a href="<?php echo $this->_var['img']['img_file']; ?>" class="" target="_blank"><img src="<?php echo $this->_var['img']['img_file']; ?>" width="100" height="100" style="border:1px #ccc solid; padding:2px;" /></a>
                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <div class="user-table-list">
                <div class="pt10 pb10">
                <a href="<?php echo $this->_var['goods']['shop_url']; ?>" class="user-shop-link"><?php echo $this->_var['goods']['shop_name']; ?></a>
                    <?php if ($this->_var['goods']['is_IM'] == 1 || $this->_var['goods']['is_dsc']): ?>
                    <a id="IM" onclick="openWin(this)" href="javascript:;" ru_id="<?php echo $this->_var['goods']['ru_id']; ?>"  class="iconfont icon-kefu user-shop-kefu"></a>
                    <?php else: ?>
                    <?php if ($this->_var['goods']['kf_type'] == 1): ?>
                    <a href="http://www.taobao.com/webww/ww.php?ver=3&touid=<?php echo $this->_var['goods']['kf_ww']; ?>&siteid=cntaobao&status=1&charset=utf-8" class="iconfont icon-kefu user-shop-kefu" target="_blank"></a>
                    <?php else: ?>
                    <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $this->_var['goods']['kf_qq']; ?>&site=qq&menu=yes" class="iconfont icon-kefu user-shop-kefu" target="_blank"></a>
                    <?php endif; ?>
                    <?php endif; ?>					
                </div>
                <table class="user-table user-table-detail-goods">
                    <colgroup>
                        <col width="320">
                        <col width="110">
                        <col width="120">
                        <col width="95">
                        <col width="90">
                        <col>
                    </colgroup>
                    <thead>
                        <tr>
                            <th><?php echo $this->_var['lang']['goods']; ?></th>
                            <th class="tl"><?php echo $this->_var['lang']['goods_attr']; ?></th>
                            <th class="tl"><?php echo $this->_var['lang']['unit_price_user']; ?></th>
                            <th class="tl"><?php echo $this->_var['lang']['number_to']; ?></th>
                            <th><?php echo $this->_var['lang']['ws_subtotal']; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <a href="<?php echo $this->_var['goods']['url']; ?>" class="img"><img src="<?php echo $this->_var['goods']['goods_thumb']; ?>" alt=""></a>						
                                <a href="<?php echo $this->_var['goods']['url']; ?>" class="name"><?php echo sub_str($this->_var['goods']['goods_name'],25); ?></a>
                            </td>
                            <td><?php echo nl2br($this->_var['goods']['goods_attr']); ?></td>
                            <td><?php echo $this->_var['goods']['goods_price']; ?></td>
                            <td>x<?php echo $this->_var['goods']['return_number']; ?></td>
                            <td><?php echo $this->_var['goods']['should_return']; ?></td>
                        </tr>
                    </tbody>
                </table>
                <?php if ($this->_var['goods']['return_type'] == 1 || $this->_var['goods']['return_type'] == 3): ?>
                    <?php if ($this->_var['goods']['return_shipping_fee'] && $this->_var['goods']['refound_status1'] == 1): ?>
                    <div class="user-order-detail-total">
                        <dl class="total-row" style="margin-bottom:0px;">
                            <dt class="total-label"><?php echo $this->_var['lang']['return_shipping']; ?>：</dt>
                            <dd class="total-value" style="font-size:14px; font-weight:normal; color:#999"> + <?php echo $this->_var['goods']['formated_return_shipping_fee']; ?></dd>
                        </dl>
                    </div>
                    <div class="user-order-detail-total" style=" margin-top:0px;">
                        <dl class="total-row" style="margin-top:0px; margin-bottom:0px;">
                            <dt class="total-label"><?php echo $this->_var['lang']['amount_return']; ?>：</dt>
                            <dd class="total-value" style="font-size:14px; font-weight:normal; color:#999"> + <?php echo $this->_var['goods']['formated_should_return']; ?></dd>
                        </dl>
                    </div>
                    <div class="user-order-detail-total" style=" margin-top:0px;">
                        <dl class="total-row" style="margin-top:0px;">
                            <dt class="total-label"><?php echo $this->_var['lang']['return_total']; ?>：</dt>
                            <dd class="total-value" style="font-size:18px; font-weight:normal"><?php echo $this->_var['goods']['formated_return_amount']; ?></dd>
                        </dl>
                    </div>
                    <?php else: ?>
                    <div class="user-order-detail-total">
                        <dl class="total-row">
                            <dt class="total-label"><?php echo $this->_var['lang']['amount_return']; ?>：</dt>
                            <dd class="total-value"><?php echo $this->_var['goods']['should_return']; ?></dd>
                        </dl>
                    </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
        </form>
        <?php endif; ?> 
        		
        
        
        <?php if ($this->_var['action'] == 'address_list'): ?>
        <div class="user-mod">
            <div class="user-title">
                <h2><?php echo $this->_var['lang']['label_address']; ?></h2>
                <h3><?php echo $this->_var['lang']['add_consignee_one']; ?><span class="red"><?php echo $this->_var['count_consignee']; ?></span><?php echo $this->_var['lang']['add_consignee_two']; ?><span class="red">10</span>个</h3>
            </div>
            <ul class="cosignee-list">
                <?php if ($this->_var['count_consignee'] < 11): ?>
                <li>
                    <div class="consignee-inner">
                        <a href="user.php?act=address" class="consignee-add"  data-dialog="dialog" data-divid="newAddress" data-id="" data-name="<?php echo $this->_var['lang']['consignee_new']; ?>">
                            <i class="iconfont icon-add-quer"></i>
                            <p><?php echo $this->_var['lang']['consignee_new']; ?></p>
                        </a>
                    </div>
                </li>				
                <?php endif; ?>
                <?php if ($this->_var['new_consignee_list']): ?>
                <?php $_from = $this->_var['new_consignee_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('sn', 'consignee');if (count($_from)):
    foreach ($_from AS $this->_var['sn'] => $this->_var['consignee']):
?>
                <li class="consignee_list_<?php echo $this->_var['consignee']['address_id']; ?>">
                    <div class="consignee-inner">
                        <div class="head">
                            <div class="handle">
                            <?php if ($this->_var['consignee']['address_id'] == $this->_var['address'] && $this->_var['address'] > 0): ?><?php else: ?><a href="javascript:makeAddressAllDefault(<?php echo $this->_var['consignee']['address_id']; ?>);"><?php echo $this->_var['lang']['default_consignee_to']; ?></a><?php endif; ?>
                                <a href="user.php?act=address&aid=<?php echo $this->_var['consignee']['address_id']; ?>"><?php echo $this->_var['lang']['modify']; ?></a>
                                <a href="javascript:alertDelAddressDiag(<?php echo $this->_var['consignee']['address_id']; ?>);"><?php echo $this->_var['lang']['drop']; ?></a>
                            </div>
                            <div class="title">
                                <span class="name"><?php echo $this->_var['consignee']['consignee']; ?></span>
                                <span class="province">
                                <?php if ($this->_var['consignee']['district_name']): ?>
                                    <?php echo $this->_var['consignee']['district_name']; ?>
                                    <?php if ($this->_var['consignee']['street_name']): ?>
                                    &nbsp;<?php echo $this->_var['consignee']['street_name']; ?>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <?php echo $this->_var['consignee']['city_name']; ?>
                                <?php endif; ?>
                                </span>
                                <?php if ($this->_var['consignee']['address_id'] == $this->_var['address'] && $this->_var['address'] > 0): ?><span class="tag"><?php echo $this->_var['lang']['default_address']; ?></span><?php endif; ?>
                            </div>
                        </div>
                        <div class="body">
                            <p><?php echo $this->_var['consignee']['mobile']; ?></p>
                            <p><?php echo $this->_var['consignee']['region']; ?>&nbsp;<?php echo $this->_var['consignee']['address']; ?></p>
                        </div>
                    </div>
                </li>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                <?php endif; ?>
            </ul>
        </div>
        <?php endif; ?> 
        	
        
        
        <?php if ($this->_var['action'] == 'address'): ?>
        <div class="user-mod">
            <div class="user-title">
                <h2><?php if ($this->_var['address_id'] == 0): ?><?php echo $this->_var['lang']['Newly']; ?><?php else: ?><?php echo $this->_var['lang']['edit']; ?><?php endif; ?><?php echo $this->_var['lang']['consignee_info']; ?></h2>
            </div>
            <div class="user-form">
                <form action="user.php" method="post" class="user-address-form" name="theForm">
                    <div class="form-row">
                        <div class="form-label"><span class="red">*</span><?php echo $this->_var['lang']['consignee']; ?>：</div>
                        <div class="form-value"><input type="text" name="consignee" value="<?php echo $this->_var['consignee']['consignee']; ?>" class="form-input"><div class="form_prompt"></div></div>
                    </div>
                    <div class="form-row">
                        <div class="form-label"><span class="red">*</span><?php echo $this->_var['lang']['label_mobile']; ?>：</div>
                        <div class="form-value">
                            <input type="text" name="mobile" value="<?php echo $this->_var['consignee']['mobile']; ?>" class="form-input">
                            <span class="fl"><?php echo $this->_var['lang']['label_tel']; ?>：</span>
                            <input type="text" name="tel" value="<?php echo $this->_var['consignee']['tel']; ?>" class="form-input">
                            <div class="form_prompt"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-label form-label-lh"><span class="red">*</span><?php echo $this->_var['lang']['Local_area']; ?>：</div>
                        <div class="form-value" ectype="regionLinkage">
                            <dl class="mod-select mod-select-small fl" ectype="smartdropdown">
                                <dt>
                                    <span class="txt" ectype="txt"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['0']; ?></span>
                                    <input type="hidden" value="<?php echo $this->_var['consignee']['country']; ?>" name="country">
                                </dt>
                                <dd ectype="layer">
                                    <?php $_from = $this->_var['country_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'country');if (count($_from)):
    foreach ($_from AS $this->_var['country']):
?>
                                    <div class="option" data-value="<?php echo $this->_var['country']['region_id']; ?>" data-text="<?php echo $this->_var['country']['region_name']; ?>" ectype="ragionItem" data-type="1"><?php echo $this->_var['country']['region_name']; ?></div>
                                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                </dd>
                            </dl>
                            <dl class="mod-select mod-select-small fl" ectype="smartdropdown">
                                <dt><span class="txt" ectype="txt"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['1']; ?></span><input type="hidden" value="<?php echo $this->_var['consignee']['province']; ?>" ectype="ragionItem" name="province"></dt>
                                <dd ectype="layer">
                                    <div class="option" data-value="0"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['1']; ?></div>
                                    <?php $_from = $this->_var['province_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'province_0_12039000_1568788891');if (count($_from)):
    foreach ($_from AS $this->_var['province_0_12039000_1568788891']):
?>
                                    <div class="option" data-value="<?php echo $this->_var['province_0_12039000_1568788891']['region_id']; ?>" data-text="<?php echo $this->_var['province_0_12039000_1568788891']['region_name']; ?>" data-type="2" ectype="ragionItem"><?php echo $this->_var['province_0_12039000_1568788891']['region_name']; ?></div>
                                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                </dd>
                            </dl>
                            <dl class="mod-select mod-select-small fl" ectype="smartdropdown">
                                <dt><span class="txt" ectype="txt"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['2']; ?></span><input type="hidden" value="<?php echo $this->_var['consignee']['city']; ?>" name="city" ></dt>
                                <dd ectype="layer">
                                    <div class="option" data-value="0"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['2']; ?></div>
                                    <?php $_from = $this->_var['city_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'city');if (count($_from)):
    foreach ($_from AS $this->_var['city']):
?>
                                    <div class="option" data-value="<?php echo $this->_var['city']['region_id']; ?>" data-type="3" data-text="<?php echo $this->_var['city']['region_name']; ?>" ectype="ragionItem"><?php echo $this->_var['city']['region_name']; ?></div>
                                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                </dd>
                            </dl>
                            <dl class="mod-select mod-select-small fl" ectype="smartdropdown" style="display:none">
                                <dt><span class="txt" ectype="txt"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['3']; ?></span><input type="hidden" value="<?php echo $this->_var['consignee']['district']; ?>" name="district"></dt>
                                <dd ectype="layer">
                                    <div class="option" data-value="0"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['3']; ?></div>
                                    <?php $_from = $this->_var['district_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'district');if (count($_from)):
    foreach ($_from AS $this->_var['district']):
?>
                                    <div class="option" data-value="<?php echo $this->_var['district']['region_id']; ?>" data-type="4" data-text="<?php echo $this->_var['district']['region_name']; ?>" ectype="ragionItem"><?php echo $this->_var['district']['region_name']; ?></div>
                                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                </dd>
                            </dl>
                            <dl class="mod-select mod-select-small fl" ectype="smartdropdown" style="display:none">
                                <dt><span class="txt" ectype="txt"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['3']; ?></span><input type="hidden" value="<?php echo $this->_var['consignee']['street']; ?>" name="street" class="ignore"></dt>
                                <dd ectype="layer">
                                    <div class="option" data-value="0"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['3']; ?></div>
                                    <?php $_from = $this->_var['street_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'street');if (count($_from)):
    foreach ($_from AS $this->_var['street']):
?>
                                    <div class="option" data-value="<?php echo $this->_var['street']['region_id']; ?>" data-type="5" data-text="<?php echo $this->_var['street']['region_name']; ?>" ectype="ragionItem"><?php echo $this->_var['street']['region_name']; ?></div>
                                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                </dd>
                            </dl>
                            <div class="form_prompt"></div>
                        </div>
                        <span id="consigneeEreaNote" class="status error hide"></span>
                    </div>
                    <div class="form-row">
                        <div class="form-label"><span class="red">*</span><?php echo $this->_var['lang']['detailed_address']; ?>：</div>
                        <div class="form-value"><input type="text" name="address" value="<?php echo $this->_var['consignee']['address']; ?>" class="form-input form-input-long"><div class="form_prompt"></div></div>
                    </div>
                    <div class="form-row">
                        <div class="form-label"><span class="red">&nbsp;&nbsp;</span><?php echo $this->_var['lang']['email_reset']; ?>：</div>
                        <div class="form-value"><input type="text" name="email" value="<?php echo $this->_var['consignee']['email']; ?>" class="form-input"><div class="form_prompt"></div></div>
                    </div>
                    <div class="form-row">
                        <div class="form-label"><span class="red">&nbsp;&nbsp;</span><?php echo $this->_var['lang']['postalcode']; ?>：</div>
                        <div class="form-value"><input type="text" name="zipcode" value="<?php echo $this->_var['consignee']['zipcode']; ?>" class="form-input"></div>
                    </div>
                    <div class="form-row">
                        <div class="form-label"><span class="red">&nbsp;&nbsp;</span><?php echo $this->_var['lang']['sign_building']; ?>：</div>
                        <div class="form-value"><input type="text"  name="sign_building" value="<?php echo $this->_var['consignee']['sign_building']; ?>" class="form-input"></div>
                    </div>
                    <div class="form-btn-wp">
                        <input type="button" name="button" class="form-btn" value="<?php echo $this->_var['lang']['submit_address']; ?>" id="submitAddress"/>
                        <input type="reset" name="reset" class="form-btn form-btn-gray" value="<?php echo $this->_var['lang']['reset']; ?>">
                        <input type="hidden" name="address_id" value="<?php echo $this->_var['consignee']['address_id']; ?>" />
                        <input type="hidden" name="act" value="act_edit_address" />
                        <input type="hidden" name="count_consignee" value="<?php echo $this->_var['count_consignee']; ?>" />
                    </div>
                </form>
            </div>
        </div>	
        <?php endif; ?> 
        	

        
        <?php if ($this->_var['action'] == 'return_list'): ?>
        <div class="user-mod">
            <div class="user-title">
                <h2><?php echo $this->_var['lang']['label_return']; ?></h2>
                <h3><?php echo $this->_var['lang']['youhave']; ?><span class="red"><?php echo $this->_var['pager']['record_count']; ?></span><?php echo $this->_var['lang']['return_goods_user']; ?></h3>
            </div>
            <div id="return_list">
                <?php echo $this->fetch('library/user_return_order_list.lbi'); ?>
            </div>
			<?php if ($this->_var['orders']): ?>
				<?php echo $this->fetch('library/pages.lbi'); ?>
			<?php endif; ?>
        </div>
        <?php endif; ?> 
        
        
         
        <?php if ($this->_var['action'] == 'goods_order'): ?>
        <div class="user-mod">
            <div class="user-title">
                <h2><?php echo $this->_var['lang']['return_policy_apply']; ?></h2>
            </div>
			<form method="post" action="user.php" name="theFrom" id="theFrom">
				<div class="uaer-return-app clearfix">
					<?php if ($this->_var['package_buy']): ?>
					<div class="no_records">
						<i class="no_icon_two"></i>
						<div class="no_info"><h3><?php echo $this->_var['lang']['package_buy_notic']; ?></h3></div>
					</div>				
					<?php else: ?>			
					<?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
					<div class="tl-item">
						<div class="item-t">
							<div class="t-goods">
								<div class="t-img">
									<?php if ($this->_var['goods']['goods_id'] > 0 && $this->_var['goods']['extension_code'] != 'package_buy'): ?> 
										<a href="<?php echo $this->_var['goods']['url']; ?>" target="_blank" class="f6"><img width="55" height="55" src="<?php echo $this->_var['goods']['goods_thumb']; ?>" title="<?php echo $this->_var['goods']['goods_name']; ?>"></a> 
									<?php if ($this->_var['goods']['parent_id'] > 0): ?> 
										<span style="color:#FF0000">（<?php echo $this->_var['lang']['accessories']; ?>）</span> 
									<?php elseif ($this->_var['goods']['is_gift']): ?> 
										<span style="color:#FF0000">（<?php echo $this->_var['lang']['largess']; ?>）</span> 
									<?php endif; ?> 
									<?php elseif ($this->_var['goods']['goods_id'] > 0 && $this->_var['goods']['extension_code'] == 'package_buy'): ?> 
										<a href="javascript:void(0)" onclick="setSuitShow(<?php echo $this->_var['goods']['goods_id']; ?>)" class="f6"><img width="55" height="55" src="<?php echo $this->_var['goods']['goods_thumb']; ?>" title="<?php echo $this->_var['goods']['goods_name']; ?>"><span style="color:#FF0000;"><?php echo $this->_var['lang']['remark_package']; ?></span></a>
										<div id="suit_<?php echo $this->_var['goods']['goods_id']; ?>" style="display:none"> 
											<?php $_from = $this->_var['goods']['package_goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'package_goods_list');if (count($_from)):
    foreach ($_from AS $this->_var['package_goods_list']):
?> 
											<a href="<?php echo $this->_var['package_goods_list']['url']; ?>" target="_blank" class="f6"><img width="55" height="55" src="<?php echo $this->_var['goods']['goods_thumb']; ?>" title="<?php echo $this->_var['goods']['goods_name']; ?>"></a><br />
											<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
										</div>
									<?php endif; ?>
								</div>
								<div class="t-info">
									<div class="info-name"><a href="<?php echo $this->_var['goods']['url']; ?>" class="ftx-03" target="_blank"><?php echo $this->_var['goods']['goods_name']; ?></a></div>
									<div class="info-price"><b><?php echo $this->_var['goods']['goods_price']; ?></b><i>×</i><span><?php echo $this->_var['goods']['goods_number']; ?></span></div>
									<div class="info-attr"><?php if ($this->_var['goods']['goods_attr']): ?><?php echo $this->_var['goods']['goods_attr']; ?><?php else: ?><?php echo $this->_var['lang']['nothing']; ?><?php endif; ?></div>
								</div>
							</div>
							<div class="t-statu">
                            <?php if ($this->_var['goods']['goods_cause']): ?>
							<?php if ($this->_var['goods']['is_refound'] > 0): ?>
								<span class="ftx-01 fs14"><?php echo $this->_var['lang']['Have_applied']; ?></span> 
							<?php else: ?> 
                                <?php if ($this->_var['goods']['extension_code'] == 'virtual_card'): ?>
                                <span class="ftx-01 fs14"><?php echo $this->_var['lang']['virtual_card_notic']; ?></span> 
                                <?php else: ?>
                                <a href="user.php?act=apply_return&rec_id=<?php echo $this->_var['goods']['rec_id']; ?>&order_id=<?php echo $this->_var['order_id']; ?>" class="sc-btn"><?php echo $this->_var['lang']['applied']; ?></a>
                                <?php endif; ?>
								 
							<?php endif; ?>
                            <?php endif; ?>
							</div>
						</div>
						<div class="item-f">
                            <?php if ($this->_var['goods']['is_refound'] == 0): ?>
							<div class="f-left">
								<div class="checkbox">
									<input type="checkbox" name="checkboxes[]" value="<?php echo $this->_var['goods']['rec_id']; ?>" class="ui-checkbox" id="checkbox_<?php echo $this->_var['goods']['rec_id']; ?>" />
									<label for="checkbox_<?php echo $this->_var['goods']['rec_id']; ?>" class="ui-label"></label>
								</div>
							</div>
                            <?php endif; ?>
							<div class="f-right">
                            	<span class="red mr50"><?php if ($this->_var['goods']['goods_cause']): ?><?php echo $this->_var['lang']['only_support']; ?>：<?php $_from = $this->_var['goods']['goods_cause']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cause');$this->_foreach['goods_cause'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['goods_cause']['total'] > 0):
    foreach ($_from AS $this->_var['cause']):
        $this->_foreach['goods_cause']['iteration']++;
?><?php if (! ($this->_foreach['goods_cause']['iteration'] == $this->_foreach['goods_cause']['total'])): ?><?php echo $this->_var['cause']['lang']; ?>、<?php else: ?><?php echo $this->_var['cause']['lang']; ?><?php endif; ?><?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?><?php else: ?><?php echo $this->_var['lang']['no_support_return']; ?><?php endif; ?></span>
                            	<span><?php echo $this->_var['lang']['shopping_money']; ?><?php if ($this->_var['order']['extension_code'] == "group_buy"): ?><?php echo $this->_var['lang']['gb_deposit']; ?><?php endif; ?>：<?php echo $this->_var['goods']['subtotal']; ?></span>
                            </div>
						</div>
					</div>
					<?php endforeach; else: ?>
					<div class="no_records">
						<i class="no_icon_two"></i>
						<div class="no_info"><h3><?php echo $this->_var['lang']['order_not_notic']; ?></h3></div>
					</div>
					<?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    <?php if ($this->_var['goods']['goods_cause']): ?>
                    <div class="tl-tfoor">
                        <div class="checkbox">
                            <input type="checkbox" name="all_list" class="ui-checkbox" id="checkbox_stars" />
                            <label for="checkbox_stars" class="ui-label"><?php echo $this->_var['lang']['check_all']; ?></label>
                        </div>
                        <a href="javascript:;" class="sc-btn" ectype="submitBtn" ><?php echo $this->_var['lang']['batch_applied']; ?></a>
                        <input type="hidden" name="act" value="batch_applied">
                        <input type="hidden" name="order_id" value="<?php echo $this->_var['order_id']; ?>">
                    </div>
                    <?php endif; ?>
					<?php endif; ?>
				</div>
			</form>
        </div>
        <?php endif; ?>
        
        
         
        <?php if ($this->_var['action'] == 'service_detail'): ?>
        <div class="user-mod">
            <div class="user-title">
                <h2><?php echo $this->_var['lang']['service_note']; ?></h2>
                <a href="javascript:history.go(-1);" class="more"><?php echo $this->_var['lang']['back']; ?></a>
            </div>
            <table class="user-table user-table-detail-goods">
                <colgroup>
                    <col width="170">
                    <col width="350">
                    <col width="110">
                    <col width="110">
                    <col>
                </colgroup>
                <thead>
                    <tr>
                        <th class="tl"><?php echo $this->_var['lang']['Return_type']; ?></th>
                        <th class="tl"><?php echo $this->_var['lang']['Return_reason']; ?></th>
                        <th><?php echo $this->_var['lang']['Return_one']; ?></th>
                        <th><?php echo $this->_var['lang']['Return_two']; ?></th>
                        <th><?php echo $this->_var['lang']['Return_three']; ?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $this->_var['lang']['Performance_fault']; ?></td>
                        <td><?php echo $this->_var['lang']['Performance_fault_one']; ?></td>
                        <td class="tc"><?php echo $this->_var['lang']['yes']; ?></td>
                        <td class="tc"><?php echo $this->_var['lang']['yes']; ?></td>
                        <td class="tc"><?php echo $this->_var['lang']['yes']; ?></td>
                    </tr>
                    <tr>
                        <td><?php echo $this->_var['lang']['Missing_parts']; ?></td>
                        <td><?php echo $this->_var['lang']['Missing_parts_one']; ?></td>
                        <td class="tc"><?php echo $this->_var['lang']['yes']; ?></td>
                        <td class="tc"><?php echo $this->_var['lang']['yes']; ?></td>
                        <td class="tc"><?php echo $this->_var['lang']['no']; ?></td>
                    </tr>
                    <tr>
                        <td><?php echo $this->_var['lang']['Logistics_loss']; ?></td>
                        <td><?php echo $this->_var['lang']['Logistics_loss_one']; ?></td>
                        <td class="tc"><?php echo $this->_var['lang']['yes']; ?></td>
                        <td class="tc"><?php echo $this->_var['lang']['yes']; ?></td>
                        <td class="tc"><?php echo $this->_var['lang']['no']; ?></td>
                    </tr>
                    <tr>
                        <td><?php echo $this->_var['lang']['Inconsistent_goods']; ?></td>
                        <td><?php echo $this->_var['lang']['Inconsistent_goods_one']; ?></td>
                        <td class="tc"><?php echo $this->_var['lang']['yes']; ?></td>
                        <td class="tc"><?php echo $this->_var['lang']['yes']; ?></td>
                        <td class="tc"><?php echo $this->_var['lang']['no']; ?></td>
                    </tr>
                    <tr>
                        <td><?php echo $this->_var['lang']['Buy_wrong']; ?></td>
                        <td><?php echo $this->_var['lang']['Buy_wrong_one']; ?></td>
                        <td class="tc"><?php echo $this->_var['lang']['Buy_wrong_two']; ?></td>
                        <td class="tc"><?php echo $this->_var['lang']['no']; ?></td>
                        <td class="tc"><?php echo $this->_var['lang']['no']; ?></td>
                    </tr>
                </tbody>
            </table>
            <div class="user-prompt mt20">
                <div class="info">
                    <?php echo $this->_var['lang']['Return_Explain']; ?>
                </div>
            </div>
        </div>    
        <?php endif; ?>
         
        
         
        <?php if ($this->_var['action'] == 'apply_return'): ?>
        <div class="user-mod user_apply_return">
            <div class="user-title">
                <h2><?php echo $this->_var['lang']['return_list']; ?></h2>
                <a href="user.php?act=service_detail" class="more"><?php echo $this->_var['lang']['service_note']; ?></a>
            </div>
            <div class="uaer-return-app clearfix">
                <div class="tl-item">
                    <div class="item-t b-b-0">
                        <div class="t-goods">
                            <div class="t-img">
                                <?php if ($this->_var['goods_return']['goods_id'] > 0 && $this->_var['goods_return']['extension_code'] != 'package_buy'): ?> 
                                    <a href="<?php echo $this->_var['goods_return']['url']; ?>" target="_blank" class="f6">
                                        <img width="55" height="55" src="<?php echo $this->_var['goods_return']['goods_thumb']; ?>" title="<?php echo $this->_var['goods_return']['goods_name']; ?>">
                                    </a> 
                                    <?php if ($this->_var['goods_return']['parent_id'] > 0): ?> 
                                    <span class="red">（<?php echo $this->_var['lang']['accessories']; ?>）</span> 
                                    <?php elseif ($this->_var['goods_return']['is_gift']): ?> 
                                    <span class="red">（<?php echo $this->_var['lang']['largess']; ?>）</span> 
                                    <?php endif; ?> 
                                <?php elseif ($this->_var['goods_return']['goods_id'] > 0 && $this->_var['goods_return']['extension_code'] == 'package_buy'): ?> 
                                    <a href="javascript:void(0)" onclick="setSuitShow(<?php echo $this->_var['goods_return']['goods_id']; ?>)" class="f6">
                                        <img width="55" height="55" src="<?php echo $this->_var['goods_return']['goods_thumb']; ?>" title="<?php echo $this->_var['goods_return']['goods_name']; ?>"><span style="color:#FF0000;"><?php echo $this->_var['lang']['remark_package']; ?></span>
                                    </a>
                                    <div id="suit_<?php echo $this->_var['goods_return']['goods_id']; ?>" style="display:none"> 
                                        <?php $_from = $this->_var['goods_return']['package_goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'package_goods_list');if (count($_from)):
    foreach ($_from AS $this->_var['package_goods_list']):
?> 
                                            <a href="<?php echo $this->_var['package_goods_list']['url']; ?>" target="_blank" class="f6">
                                                <img width="55" height="55" src="<?php echo $this->_var['package_goods_list']['goods_thumb']; ?>" title="<?php echo $this->_var['package_goods_list']['goods_name']; ?>">
                                            </a>
                                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="t-info">
                                <div class="info-name"><a href="goods.php?id=<?php echo $this->_var['goods_return']['goods_id']; ?>" class="ftx-03" target="_blank"><?php echo $this->_var['goods_return']['goods_name']; ?></a></div>
                                <div class="info-price"><b><?php echo $this->_var['goods_return']['goods_price']; ?></b><i>×</i><span><?php echo $this->_var['goods_return']['goods_number']; ?></span></div>
                                <div class="info-attr"><?php if ($this->_var['goods_return']['goods_attr']): ?><?php echo $this->_var['goods_return']['goods_attr']; ?><?php else: ?><?php echo $this->_var['lang']['nothing']; ?><?php endif; ?></div>
                            </div>
                        </div>
                        <div class="t-statu"><?php echo $this->_var['goods_return']['subtotal']; ?></div>
                    </div>
                </div>
            </div>
            <div class="applyReturnForm">
                <form id="formReturn" name="formReturn" method="post" action="user.php" onsubmit="return check_sub()">
                    <div class="return_ts">
                        <em class="fl">* <?php echo $this->_var['lang']['reminder']; ?>：</em>
                        <div class="fl"><?php echo $this->_var['lang']['reminder_one']; ?>&nbsp;<em><?php echo $this->_var['goods_return']['user_name']; ?></em>&nbsp;<?php echo $this->_var['lang']['reminder_two']; ?></div>
                    </div>
                    <div class="form">
                        <?php if ($this->_var['goods_cause']): ?>
                        <div class="item item1 first">
                            <div class="label"><em>*</em><?php echo $this->_var['lang']['Service_type']; ?>：</div>
                            <div class="value value-checkbox">
                            	
                                <?php $_from = $this->_var['goods_cause']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
                                	<div class="value-item <?php if ($this->_var['goods']['is_checked'] == 1): ?>selected<?php endif; ?>">
                                        <input type="radio" id="service-<?php echo $this->_var['goods']['cause']; ?>" name="return_type" value="<?php echo $this->_var['goods']['cause']; ?>" class="ui-radio" autocomplete="off" <?php if ($this->_var['goods']['is_checked'] == 1): ?>checked<?php endif; ?> />
                                        <label for="service-<?php echo $this->_var['goods']['cause']; ?>" class="ui-radio-label"><?php echo $this->_var['goods']['lang']; ?></label>
                                    </div>
                            	<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                
                                <input name="return_rec_id" value="<?php echo $this->_var['goods_return']['rec_id']; ?>" type="hidden" />
                                <input name="return_g_id" value="<?php echo $this->_var['goods_return']['goods_id']; ?>" type="hidden" />
                                <input name="return_g_number" value="<?php echo $this->_var['goods_return']['goods_number']; ?>" type="hidden" />
                            </div>
                            <div class="lists" ectype="return_lists">
                                <div class="return_div" ectype="return_div">
                                    <div class="type_box1" name="type_maintain" id="maintain_<?php echo $this->_var['goods_return']['rec_id']; ?>">
                                        <div class="type_item"><?php echo $this->_var['lang']['Repair_number']; ?>：</div>
                                        <div class="type_con">
                                            <a onclick="buyNumber.minus(this, 1)" href="javascript:;" id="decrease" class="plus_minus"><i class="iconfont icon-reduce"></i></a>
                                            <input type="text" class="return_num" defaultnumber="1" value="1" id="maintain_<?php echo $this->_var['goods_return']['rec_id']; ?>" name="maintain_number" onblur="check_return_num(this,<?php echo $this->_var['goods_return']['goods_number']; ?> ,<?php echo $this->_var['goods_return']['rec_id']; ?>, 1)"/>
                                            <a onclick="buyNumber.plus(this, 1)" href="javascript:;" id="increase" class="plus_minus"><i class="iconfont icon-plus"></i></a>
                                            <div class="return_sm">(<?php echo $this->_var['lang']['Repair_one']; ?><span><?php echo $this->_var['goods_return']['goods_number']; ?></span><?php echo $this->_var['lang']['Repair_two']; ?><span id="maintain_span_<?php echo $this->_var['goods_return']['rec_id']; ?>" name="maintain">1</span><?php echo $this->_var['lang']['jian']; ?>)</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="return_div" ectype="return_div" style="display:none;">
                                    <div class="type_box1" name="type_box1" id="returnid_<?php echo $this->_var['goods_return']['rec_id']; ?>">
                                        <div class="type_item"><?php echo $this->_var['lang']['return_number']; ?>：</div>
                                        <div class="type_con">
                                            <a onclick="buyNumber.minus(this, 1)" href="javascript:;" id="decrease" class="plus_minus"><i class="iconfont icon-reduce"></i></a>
                                            <input type="text" class="return_num" defaultnumber="1" value="1" id="returnid_<?php echo $this->_var['goods_return']['rec_id']; ?>" name="attr_num" onblur="check_return_num(this,<?php echo $this->_var['goods_return']['goods_number']; ?> ,<?php echo $this->_var['goods_return']['rec_id']; ?>, 2)" />
                                            <a onclick="buyNumber.plus(this, 1)" href="javascript:;" id="increase" class="plus_minus"><i class="iconfont icon-plus"></i></a>
                                            <div class="return_sm">(<?php echo $this->_var['lang']['return_one']; ?><span><?php echo $this->_var['goods_return']['goods_number']; ?></span><?php echo $this->_var['lang']['return_two']; ?><span id="retired_<?php echo $this->_var['goods_return']['rec_id']; ?>" name="retired">1</span><?php echo $this->_var['lang']['jian']; ?>)</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="return_div" ectype="return_div" style="display:none;">
                                    <div class="type_box1" name="type_box1" id="changeid_<?php echo $this->_var['goods_return']['rec_id']; ?>">
                                        <div class="type_item"><?php echo $this->_var['lang']['return_one']; ?>：</div>
                                        <div class="type_con">
                                            <a onclick="buyNumber.minus(this, 1)" href="javascript:;" id="decrease" class="plus_minus"><i class="iconfont icon-reduce"></i></a>
                                            <input type="text" class="return_num" defaultnumber="1" value="1" id="returnid_<?php echo $this->_var['goods_return']['rec_id']; ?>" name="return_num" onblur="check_return_num(this,<?php echo $this->_var['goods_return']['goods_number']; ?> ,<?php echo $this->_var['goods_return']['rec_id']; ?>, 2)" />
                                            <a onclick="buyNumber.plus(this, 1)" href="javascript:;" id="increase" class="plus_minus"><i class="iconfont icon-plus"></i></a>
                                            <div class="return_sm">(<?php echo $this->_var['lang']['return_one']; ?><span><?php echo $this->_var['goods_return']['goods_number']; ?></span><?php echo $this->_var['lang']['return_two']; ?><span id="retired_<?php echo $this->_var['goods_return']['rec_id']; ?>" name="retired">1</span><?php echo $this->_var['lang']['jian']; ?>)</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="return_div" ectype="return_div" style="display:none;">
                                    <div class="type_box1" name="type_box1" id="changeid_<?php echo $this->_var['goods_return']['rec_id']; ?>">
                                        <div class="type_item"><?php echo $this->_var['lang']['return_g_number']; ?>：</div>
                                        <div class="type_con">
                                            <a onclick="buyNumber.minus(this, 1)" href="javascript:;" id="decrease" class="plus_minus"><i class="iconfont icon-reduce"></i></a>
                                            <input type="text" class="return_num" defaultnumber="1" value="1" id="returnid_<?php echo $this->_var['goods_return']['rec_id']; ?>" name="only_return_number" onblur="check_return_num(this,<?php echo $this->_var['goods_return']['goods_number']; ?> ,<?php echo $this->_var['goods_return']['rec_id']; ?>, 2)" />
                                            <a onclick="buyNumber.plus(this, 1)" href="javascript:;" id="increase" class="plus_minus"><i class="iconfont icon-plus"></i></a>
                                            <div class="return_sm">(<?php echo $this->_var['lang']['return_one']; ?><span><?php echo $this->_var['goods_return']['goods_number']; ?></span><?php echo $this->_var['lang']['return_two']; ?><span id="retired_<?php echo $this->_var['goods_return']['rec_id']; ?>" name="retired">1</span><?php echo $this->_var['lang']['jian']; ?>)</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item item1">
                            <div class="label"><?php echo $this->_var['lang']['Application_credentials']; ?>：</div>
                            <div class="value">
                                 <input name="credentials" type="checkbox" value="" class="ui-checkbox" id="credentials"/>
                                 <label for="credentials" class="ui-label"><?php echo $this->_var['lang']['has_Test_Report']; ?></label>
                            </div>
                        </div>
                        <div class="item">
                            <div class="label"><em>*</em><?php echo $this->_var['lang']['return_reason']; ?>：</div>
                            <div class="value">
                                <span class="cause_select">
                                <select name="parent_id" id="cause_<?php echo $this->_var['goods_return']['rec_id']; ?>" onchange="selectCause(this.value ,<?php echo $this->_var['goods_return']['rec_id']; ?>)">
                                <option value="0"><?php echo $this->_var['lang']['please_select']; ?></option>
                                <?php echo $this->_var['cause_list']; ?>
                                </select>
                                </span>
                                <span id="children_<?php echo $this->_var['goods_return']['rec_id']; ?>" class="cause_select"></span>
                            </div>
                        </div>
                        <div class="item">
                            <div class="label"><em>*</em><?php echo $this->_var['lang']['problem_desc']; ?>：</div>
                            <div class="value"><textarea cols="40" class="text_desc" rows="4" name="return_brief"></textarea></div>
                        </div>
                        <div class="item">
                            <div class="label"><?php echo $this->_var['lang']['pic_info']; ?>：</div>
                            <div class="value">
                                <div class="upload_img">
                                    <div class="SWFUpload"><input type="button" id="uploadbutton" class="button" value="" data-upload_type="goods"/></div>
                                    <?php echo $this->_var['lang']['pic_info_one']; ?>
                                    <div class="up_img return_images"<?php if (! $this->_var['img_list']): ?> style="display:none;"<?php endif; ?>>
                                        <div class="mscoll">
                                            <a id="scollUp" class="mleft prev"><i class="iconfont icon-left"></i></a>
                                            <div class="mslist">
                                                <ul class="img-list-li">
                                                    <?php $_from = $this->_var['img_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'img');$this->_foreach['return'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['return']['total'] > 0):
    foreach ($_from AS $this->_var['img']):
        $this->_foreach['return']['iteration']++;
?>
                                                    <li>
                                                        <a href="<?php echo $this->_var['img']['img_file']; ?>" target="_blank"><img class="err-product" width="60" height="60" src="<?php echo $this->_var['img']['img_file']; ?>" /></a>
                                                    </li>
                                                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                                </ul>
                                            </div>
                                            <a id="scollDown" class="mright next"><i class="iconfont icon-right"></i></a>
                                        </div>
                                        <a class="apply_goods_return clear_pictures" href="javascript:void(0);"><?php echo $this->_var['lang']['Empty_picture']; ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div ectype="return-type">
                            <div class="item">
                                <div class="label"><em>*</em><?php echo $this->_var['lang']['label_address']; ?>：</div>
                                <div class="value">
                                    <div class="address" ectype="regionLinkage">
                                        <dl class="mod-select mod-select-small" ectype="smartdropdown">
                                            <dt>
                                                <span class="txt" ectype="txt"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['0']; ?></span>
                                                <input type="hidden" value="<?php echo $this->_var['consignee']['country']; ?>" name="country">
                                            </dt>
                                            <dd ectype="layer">
                                                <?php $_from = $this->_var['country_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'country');if (count($_from)):
    foreach ($_from AS $this->_var['country']):
?>
                                                <div class="option" data-value="<?php echo $this->_var['country']['region_id']; ?>" data-text="<?php echo $this->_var['country']['region_name']; ?>" ectype="ragionItem" data-type="1"><?php echo $this->_var['country']['region_name']; ?></div>
                                                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                            </dd>
                                        </dl>
                                        <dl class="mod-select mod-select-small" ectype="smartdropdown">
                                            <dt><span class="txt" ectype="txt"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['1']; ?></span><input type="hidden" value="<?php echo $this->_var['consignee']['province']; ?>" ectype="ragionItem"name="province"></dt>
                                            <dd ectype="layer">
                                                <div class="option" data-value="0"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['1']; ?></div>
                                                <?php $_from = $this->_var['province_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'province_0_13439100_1568788891');if (count($_from)):
    foreach ($_from AS $this->_var['province_0_13439100_1568788891']):
?>
                                                <div class="option" data-value="<?php echo $this->_var['province_0_13439100_1568788891']['region_id']; ?>" data-text="<?php echo $this->_var['province_0_13439100_1568788891']['region_name']; ?>" data-type="2" ectype="ragionItem"><?php echo $this->_var['province_0_13439100_1568788891']['region_name']; ?></div>
                                                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                            </dd>
                                        </dl>
                                        <dl class="mod-select mod-select-small" ectype="smartdropdown">
                                            <dt><span class="txt" ectype="txt"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['2']; ?></span><input type="hidden" value="<?php echo $this->_var['consignee']['city']; ?>" name="city" ></dt>
                                            <dd ectype="layer">
                                                <div class="option" data-value="0"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['2']; ?></div>
                                                <?php $_from = $this->_var['city_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'city');if (count($_from)):
    foreach ($_from AS $this->_var['city']):
?>
                                                <div class="option" data-value="<?php echo $this->_var['city']['region_id']; ?>" data-type="3" data-text="<?php echo $this->_var['city']['region_name']; ?>" ectype="ragionItem"><?php echo $this->_var['city']['region_name']; ?></div>
                                                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                            </dd>
                                        </dl>
                                        <dl class="mod-select mod-select-small" ectype="smartdropdown" style="display:none">
                                            <dt><span class="txt" ectype="txt"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['3']; ?></span><input type="hidden" value="<?php echo $this->_var['consignee']['district']; ?>" name="district"></dt>
                                            <dd ectype="layer">
                                                <div class="option" data-value="0"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['3']; ?></div>
                                                <?php $_from = $this->_var['district_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'district');if (count($_from)):
    foreach ($_from AS $this->_var['district']):
?>
                                                <div class="option" data-value="<?php echo $this->_var['district']['region_id']; ?>" data-type="4" data-text="<?php echo $this->_var['district']['region_name']; ?>" ectype="ragionItem"><?php echo $this->_var['district']['region_name']; ?></div>
                                                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                            </dd>
                                        </dl>
                                        <dl class="mod-select mod-select-small" ectype="smartdropdown" style="display:none">
                                            <dt><span class="txt" ectype="txt"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['3']; ?></span><input type="hidden" value="<?php echo $this->_var['consignee']['street']; ?>" name="street"></dt>
                                            <dd ectype="layer">
                                                <div class="option" data-value="0"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['3']; ?></div>
                                                <?php $_from = $this->_var['street_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'street');if (count($_from)):
    foreach ($_from AS $this->_var['street']):
?>
                                                <div class="option" data-value="<?php echo $this->_var['street']['region_id']; ?>" data-type="5" data-text="<?php echo $this->_var['street']['region_name']; ?>" ectype="ragionItem"><?php echo $this->_var['street']['region_name']; ?></div>
                                                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                            </dd>
                                        </dl>
                                    </div>
                                    <div class="address_xq">
                                        <input type="text" class="text_item"  name="return_address" value="<?php echo $this->_var['consignee']['address']; ?>" size="42"/>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="label"><em>*</em><?php echo $this->_var['lang']['Contact_name']; ?>：</div>
                                <div class="value">
                                    <input type="text" class="text_item"  name="addressee" value="<?php echo $this->_var['consignee']['consignee']; ?>" size="42"/>
                                    <input type="hidden" name="hid1" value="<?php echo $this->_var['consignee']['consignee']; ?>"/>
                                </div>
                            </div>
                            <div class="item">
                                <div class="label"><em>*</em><?php echo $this->_var['lang']['label_mobile']; ?>：</div>
                                <div class="value">
                                    <input type="text" class="text_item"  name="mobile" value="<?php echo $this->_var['consignee']['mobile']; ?>" size="42"/>
                                </div>
                            </div>
                            <div class="item">
                                <div class="label"><?php echo $this->_var['lang']['email_user']; ?>：</div>
                                <div class="value">
                                    <input type="text" class="text_item" name="code" value="<?php echo $this->_var['consignee']['zipcode']; ?>" size="42"/>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="label"><?php echo $this->_var['lang']['type']['0']; ?>：</div>
                            <div class="value">
                                <textarea cols="40" class="text_area" rows="4" name="return_remark"></textarea>
                            </div>
                        </div>
                        <div class="item">
                            <div class="label">&nbsp;</div>
                            <div class="value">
                            	<input type="hidden" name="chargeoff_status" value="<?php echo $this->_var['order']['chargeoff_status']; ?>" />
                                <input type="submit" value="<?php echo $this->_var['lang']['submit_goods']; ?>" class="sc-btn btn30 sc-redBg-btn" />
                                <input type="hidden" name="act" value="submit_return" />
                                <input type="hidden" name="rec_id" value="<?php echo $this->_var['goods_return']['rec_id']; ?>" />
                            </div>
                        </div>
                        <?php else: ?>
                        <div class="no_records">
                            <i class="no_icon_two"></i>
                            <div class="no_info"><h3><?php echo $this->_var['lang']['no_support_return']; ?></h3></div>
                        </div>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>  
        <?php endif; ?>
          
	
         
        <?php if ($this->_var['action'] == 'batch_applied'): ?>
        <div class="user-mod user_apply_return">
            <form id="formReturn" name="formReturn" method="post" action="user.php" onsubmit="return check_sub()">		
            <div class="user-title">
                <h2><?php echo $this->_var['lang']['return_list']; ?></h2>
                <a href="user.php?act=service_detail" class="more"><?php echo $this->_var['lang']['service_note']; ?></a>
            </div>
            <div class="uaer-return-app clearfix">
			<?php $_from = $this->_var['goods_return']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
                <div class="tl-item">
                    <div class="item-t b-b-0">
                        <div class="t-goods">
                            <div class="t-img">
                                <?php if ($this->_var['goods']['goods_id'] > 0 && $this->_var['goods']['extension_code'] != 'package_buy'): ?>
                                    <a href="<?php echo $this->_var['goods']['url']; ?>" target="_blank" class="f6">
                                        <img width="55" height="55" src="<?php echo $this->_var['goods']['goods_thumb']; ?>" title="<?php echo $this->_var['goods']['goods_name']; ?>">
                                    </a> 
                                    <?php if ($this->_var['goods']['parent_id'] > 0): ?> 
                                    <span class="red">（<?php echo $this->_var['lang']['accessories']; ?>）</span> 
                                    <?php elseif ($this->_var['goods']['is_gift']): ?> 
                                    <span class="red">（<?php echo $this->_var['lang']['largess']; ?>）</span> 
                                    <?php endif; ?> 
                                <?php elseif ($this->_var['goods']['goods_id'] > 0 && $this->_var['goods']['extension_code'] == 'package_buy'): ?> 
                                    <a href="javascript:void(0)" onclick="setSuitShow(<?php echo $this->_var['goods']['goods_id']; ?>)" class="f6">
                                        <img width="55" height="55" src="<?php echo $this->_var['goods']['goods_thumb']; ?>" title="<?php echo $this->_var['goods']['goods_name']; ?>"><span style="color:#FF0000;"><?php echo $this->_var['lang']['remark_package']; ?></span>
                                    </a>
                                    <div id="suit_<?php echo $this->_var['goods']['goods_id']; ?>" style="display:none"> 
                                        <?php $_from = $this->_var['goods']['package_goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'package_goods_list');if (count($_from)):
    foreach ($_from AS $this->_var['package_goods_list']):
?> 
                                            <a href="<?php echo $this->_var['package_goods_list']['url']; ?>" target="_blank" class="f6">
                                                <img width="55" height="55" src="<?php echo $this->_var['package_goods_list']['goods_thumb']; ?>" title="<?php echo $this->_var['package_goods_list']['goods_name']; ?>">
                                            </a>
                                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="t-info">
                                <div class="info-name"><a href="goods.php?id=<?php echo $this->_var['goods']['goods_id']; ?>" class="ftx-03" target="_blank"><?php echo $this->_var['goods']['goods_name']; ?></a></div>
                                <div class="info-price"><b><?php echo $this->_var['goods']['goods_price']; ?></b><i>×</i><span><?php echo $this->_var['goods']['goods_number']; ?></span></div>
                                <div class="info-attr"><?php if ($this->_var['goods']['goods_attr']): ?><?php echo $this->_var['goods']['goods_attr']; ?><?php else: ?><?php echo $this->_var['lang']['nothing']; ?><?php endif; ?></div>
                            </div>
                        </div>
                        <div class="t-statu"><?php echo $this->_var['goods']['subtotal']; ?></div>
						<input name="return_rec_id[<?php echo $this->_var['goods']['rec_id']; ?>]" value="<?php echo $this->_var['goods']['rec_id']; ?>" type="hidden" />
						<input name="return_g_id[<?php echo $this->_var['goods']['rec_id']; ?>]" value="<?php echo $this->_var['goods']['goods_id']; ?>" type="hidden" />
						<input name="return_g_number[<?php echo $this->_var['goods']['rec_id']; ?>]" value="<?php echo $this->_var['goods']['goods_number']; ?>" type="hidden" />
                    </div>
                </div>
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            </div>
            <div class="applyReturnForm">
				<div class="return_ts">
					<em class="fl">* <?php echo $this->_var['lang']['reminder']; ?>：</em>
					<div class="fl"><?php echo $this->_var['lang']['reminder_one']; ?>&nbsp;<em><?php echo $this->_var['shop_name']; ?></em>&nbsp;<?php echo $this->_var['lang']['reminder_two']; ?></div>
				</div>
				<div class="form">
				<?php if ($this->_var['goods_cause']): ?>
				<div class="item item1 first">
					<div class="label"><em>*</em><?php echo $this->_var['lang']['Service_type']; ?>：</div>
					<div class="value value-checkbox">
						<?php $_from = $this->_var['goods_cause']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
						<div class="value-item <?php if ($this->_var['goods']['is_checked'] == 1): ?>selected<?php endif; ?>">
							<input type="radio" id="service-<?php echo $this->_var['goods']['cause']; ?>" name="return_type" value="<?php echo $this->_var['goods']['cause']; ?>" class="ui-radio" autocomplete="off" <?php if ($this->_var['goods']['is_checked'] == 1): ?>checked<?php endif; ?> />
							<label for="service-<?php echo $this->_var['goods']['cause']; ?>" class="ui-radio-label"><?php echo $this->_var['goods']['lang']; ?></label>
						</div>
						<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</div>
				</div>
				<div class="item item1">
					<div class="label"><?php echo $this->_var['lang']['Application_credentials']; ?>：</div>
					<div class="value">
						 <input name="credentials" type="checkbox" value="" class="ui-checkbox" id="credentials"/>
						 <label for="credentials" class="ui-label"><?php echo $this->_var['lang']['has_Test_Report']; ?></label>
					</div>
				</div>
				<div class="item">
					<div class="label"><em>*</em><?php echo $this->_var['lang']['problem_desc']; ?>：</div>
					<div class="value"><textarea cols="40" class="text_desc" rows="4" name="return_brief"></textarea></div>
				</div>
				<div class="item">
					<div class="label"><?php echo $this->_var['lang']['pic_info']; ?>：</div>
					<div class="value">
						<div class="upload_img">
							<div class="SWFUpload"><input type="button" id="uploadbutton" class="button" value="" data-upload_type="goods"/></div>
							<?php echo $this->_var['lang']['pic_info_one']; ?>
							<div class="up_img return_images"<?php if (! $this->_var['img_list']): ?> style="display:none;"<?php endif; ?>>
								<div class="mscoll">
									<a id="scollUp" class="mleft prev"><i class="iconfont icon-left"></i></a>
									<div class="mslist">
										<ul class="img-list-li">
											<?php $_from = $this->_var['img_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'img');$this->_foreach['return'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['return']['total'] > 0):
    foreach ($_from AS $this->_var['img']):
        $this->_foreach['return']['iteration']++;
?>
											<li>
												<a href="<?php echo $this->_var['img']['img_file']; ?>" target="_blank"><img class="err-product" width="60" height="60" src="<?php echo $this->_var['img']['img_file']; ?>" /></a>
											</li>
											<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
										</ul>
									</div>
									<a id="scollDown" class="mright next"><i class="iconfont icon-right"></i></a>
								</div>
								<a class="apply_goods_return clear_pictures" href="javascript:void(0);"><?php echo $this->_var['lang']['Empty_picture']; ?></a>
							</div>
						</div>
					</div>
				</div>
				<div ectype="return-type">
					<div class="item">
						<div class="label"><em>*</em><?php echo $this->_var['lang']['label_address']; ?>：</div>
						<div class="value">
							<div class="address" ectype="regionLinkage">
								<dl class="mod-select mod-select-small" ectype="smartdropdown">
									<dt>
										<span class="txt" ectype="txt"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['0']; ?></span>
										<input type="hidden" value="<?php echo $this->_var['consignee']['country']; ?>" name="country">
									</dt>
									<dd ectype="layer">
										<?php $_from = $this->_var['country_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'country');if (count($_from)):
    foreach ($_from AS $this->_var['country']):
?>
										<div class="option" data-value="<?php echo $this->_var['country']['region_id']; ?>" data-text="<?php echo $this->_var['country']['region_name']; ?>" ectype="ragionItem" data-type="1"><?php echo $this->_var['country']['region_name']; ?></div>
										<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
									</dd>
								</dl>
								<dl class="mod-select mod-select-small" ectype="smartdropdown">
									<dt><span class="txt" ectype="txt"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['1']; ?></span><input type="hidden" value="<?php echo $this->_var['consignee']['province']; ?>" ectype="ragionItem"name="province"></dt>
									<dd ectype="layer">
										<div class="option" data-value="0"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['1']; ?></div>
										<?php $_from = $this->_var['province_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'province_0_14139100_1568788891');if (count($_from)):
    foreach ($_from AS $this->_var['province_0_14139100_1568788891']):
?>
										<div class="option" data-value="<?php echo $this->_var['province_0_14139100_1568788891']['region_id']; ?>" data-text="<?php echo $this->_var['province_0_14139100_1568788891']['region_name']; ?>" data-type="2" ectype="ragionItem"><?php echo $this->_var['province_0_14139100_1568788891']['region_name']; ?></div>
										<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
									</dd>
								</dl>
								<dl class="mod-select mod-select-small" ectype="smartdropdown">
									<dt><span class="txt" ectype="txt"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['2']; ?></span><input type="hidden" value="<?php echo $this->_var['consignee']['city']; ?>" name="city" ></dt>
									<dd ectype="layer">
										<div class="option" data-value="0"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['2']; ?></div>
										<?php $_from = $this->_var['city_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'city');if (count($_from)):
    foreach ($_from AS $this->_var['city']):
?>
										<div class="option" data-value="<?php echo $this->_var['city']['region_id']; ?>" data-type="3" data-text="<?php echo $this->_var['city']['region_name']; ?>" ectype="ragionItem"><?php echo $this->_var['city']['region_name']; ?></div>
										<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
									</dd>
								</dl>
								<dl class="mod-select mod-select-small" ectype="smartdropdown" style="display:none">
									<dt><span class="txt" ectype="txt"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['3']; ?></span><input type="hidden" value="<?php echo $this->_var['consignee']['district']; ?>" name="district"></dt>
									<dd ectype="layer">
										<div class="option" data-value="0"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['3']; ?></div>
										<?php $_from = $this->_var['district_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'district');if (count($_from)):
    foreach ($_from AS $this->_var['district']):
?>
										<div class="option" data-value="<?php echo $this->_var['district']['region_id']; ?>" data-type="4" data-text="<?php echo $this->_var['district']['region_name']; ?>" ectype="ragionItem"><?php echo $this->_var['district']['region_name']; ?></div>
										<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
									</dd>
								</dl>
								<dl class="mod-select mod-select-small" ectype="smartdropdown" style="display:none">
									<dt><span class="txt" ectype="txt"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['3']; ?></span><input type="hidden" value="<?php echo $this->_var['consignee']['street']; ?>" name="street"></dt>
									<dd ectype="layer">
										<div class="option" data-value="0"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['3']; ?></div>
										<?php $_from = $this->_var['street_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'street');if (count($_from)):
    foreach ($_from AS $this->_var['street']):
?>
										<div class="option" data-value="<?php echo $this->_var['street']['region_id']; ?>" data-type="5" data-text="<?php echo $this->_var['street']['region_name']; ?>" ectype="ragionItem"><?php echo $this->_var['street']['region_name']; ?></div>
										<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
									</dd>
								</dl>
							</div>
							<div class="address_xq">
								<input type="text" class="text_item"  name="return_address" value="<?php echo $this->_var['consignee']['address']; ?>" size="42"/>
							</div>
						</div>
					</div>
					<div class="item">
						<div class="label"><em>*</em><?php echo $this->_var['lang']['Contact_name']; ?>：</div>
						<div class="value">
							<input type="text" class="text_item"  name="addressee" value="<?php echo $this->_var['consignee']['consignee']; ?>" size="42"/>
							<input type="hidden" name="hid1" value="<?php echo $this->_var['consignee']['consignee']; ?>"/>
						</div>
					</div>
					<div class="item">
						<div class="label"><em>*</em><?php echo $this->_var['lang']['label_mobile']; ?>：</div>
						<div class="value">
							<input type="text" class="text_item"  name="mobile" value="<?php echo $this->_var['consignee']['mobile']; ?>" size="42"/>
						</div>
					</div>
					<div class="item">
						<div class="label"><?php echo $this->_var['lang']['email_user']; ?>：</div>
						<div class="value">
							<input type="text" class="text_item" name="code" value="<?php echo $this->_var['consignee']['zipcode']; ?>" size="42"/>
						</div>
					</div>
				</div>
				<div class="item">
					<div class="label"><?php echo $this->_var['lang']['type']['0']; ?>：</div>
					<div class="value">
						<textarea cols="40" class="text_area" rows="4" name="return_remark"></textarea>
					</div>
				</div>
				<div class="item">
					<div class="label">&nbsp;</div>
					<div class="value">
						<input type="hidden" name="chargeoff_status" value="<?php echo $this->_var['order']['chargeoff_status']; ?>" />
						<input type="submit" value="<?php echo $this->_var['lang']['submit_goods']; ?>" class="sc-btn btn30 sc-redBg-btn" />
						<input type="hidden" name="act" value="submit_batch_return" />
					</div>
				</div>
				<?php else: ?>
				<div class="no_records">
					<i class="no_icon_two"></i>
					<div class="no_info"><h3><?php echo $this->_var['lang']['no_support_return']; ?></h3></div>
				</div>
				<?php endif; ?>
				</div>
			</div>
		</form>			
        </div>  
        <?php endif; ?>
         
		
		
		
		<?php if ($this->_var['action'] == 'auction_list'): ?>
		<div class="user-mod">
			<div class="user-title">
                <h2><?php echo $this->_var['lang']['my_auction']; ?></h2>
                <ul class="tabs">
					<li <?php if ($this->_var['action'] == 'auction_list'): ?>class="active"<?php endif; ?>><a href="user.php?act=auction_list"><?php echo $this->_var['lang']['auction_list']; ?></a></li>
                    <li <?php if ($this->_var['action'] == 'auction'): ?>class="active"<?php endif; ?>><a href="user.php?act=auction"><?php echo $this->_var['lang']['auction_order']; ?></a></li>
                </ul>
            </div>
			<div class="user-title">
                <ul class="tabs">
                    <li class="active"><a href=""><?php echo $this->_var['lang']['auction_all']; ?>(<?php echo $this->_var['all_auction']; ?>)</a></li>
                    <li class="user-count3" onclick="get_AuctionSearch('is_going', '<?php echo $this->_var['action']; ?>', 'is_going','','.user-count3')">
						<a href="javascript:void(0);"><?php echo $this->_var['lang']['auction_staues']['1']; ?>(<?php echo $this->_var['is_going']; ?>)</a>
						<input name="is_going" id="is_going" type="hidden" value="1" />
                    </li>
                    <li class="user-count1" onclick="get_AuctionSearch('is_finished', '<?php echo $this->_var['action']; ?>', 'is_finished','','.user-count1')">
						<a href="javascript:void(0);"><?php echo $this->_var['lang']['auction_staues']['3']; ?>(<?php echo $this->_var['is_finished']; ?>)</a>
						<input name="is_finished" id="is_finished" type="hidden" value="3" />
                    </li>
                </ul>
            </div>
			<div class="comment-list-warp clearfix">
                <div class="user-order-list" id="user-auction-list">
					<?php echo $this->fetch('library/user_auction_list.lbi'); ?>
                </div>
            </div>
		</div>
		<?php endif; ?>
		

		
        <?php if ($this->_var['action'] == 'auction' || $this->_var['action'] == 'auction_order_recycle'): ?>
        <div class="user-mod">
			<div class="user-title">
                <h2><?php echo $this->_var['lang']['my_auction']; ?></h2>
                <ul class="tabs">
					<li <?php if ($this->_var['action'] == 'auction_list'): ?>class="active"<?php endif; ?>><a href="user.php?act=auction_list"><?php echo $this->_var['lang']['auction_list']; ?></a></li>
                    <li <?php if ($this->_var['action'] == 'auction'): ?>class="active"<?php endif; ?>><a href="user.php?act=auction"><?php echo $this->_var['lang']['auction_order']; ?></a></li>
                </ul>
            </div>
            <div class="user-title">
                <ul class="tabs">
                    <li class="active"><a href=""><?php echo $this->_var['lang']['all_order']; ?>(<?php echo $this->_var['allorders']; ?>)</a></li>
                    <li class="user-count3" onclick="get_OrderSearch('to_unconfirmed', '<?php echo $this->_var['action']; ?>', 'toBe_unconfirmed','','.user-count3')">
                    <a href="javascript:void(0);"><?php echo $this->_var['lang']['cs']['0']; ?>(<?php echo $this->_var['unconfirmed']; ?>)</a>
                    <input name="to_unconfirmed" id="to_unconfirmed" type="hidden" value="0" />
                    </li>
                    <li class="user-count1" onclick="get_OrderSearch('payId', '<?php echo $this->_var['action']; ?>', 'toBe_pay','','.user-count1')">
                    <a href="javascript:void(0);"><?php echo $this->_var['lang']['cs']['100']; ?>(<?php echo $this->_var['pay_count']; ?>)</a>
                    <input name="toBe_pay" id="payId" type="hidden" value="100" />
                    </li>
                    <li class="user-count2" onclick="get_OrderSearch('to_confirm_order', '<?php echo $this->_var['action']; ?>', 'toBe_confirmed','','.user-count2')">
                    <a href="javascript:void(0);"><?php echo $this->_var['lang']['receipt_not']; ?>(<?php echo $this->_var['to_confirm_order']; ?>)</a>
                    <input name="to_confirm_order" id="to_confirm_order" type="hidden" value="103" />
                    </li>
                    <li class="user-count4" onclick="get_OrderSearch('to_finished', '<?php echo $this->_var['action']; ?>', 'toBe_finished','','.user-count4')">
                    <a href="javascript:void(0);"><?php echo $this->_var['lang']['cs']['102']; ?>(<?php echo $this->_var['to_finished']; ?>)</a>
                    <input name="to_finished" id="to_finished" type="hidden" value="102" />
                    </li>
                </ul>
            </div>
            <div class="user-list-title clearfix">
                <div class="user-list-filter">
                    <div id="order_status" class="imitate_select w120 mr10">
                        <div class="cite"><span><?php echo $this->_var['lang']['all_status']; ?></span><i class="iconfont icon-down"></i></div>
                        <ul>
                            <li id="order_status_-1"><a href="javascript:void(0);" data-idtxt="status_list" data-action="<?php echo $this->_var['action']; ?>" data-type="order_status" data-id="-1" data-value='-1'><?php echo $this->_var['lang']['all_status']; ?></a></li>
                            <?php $_from = $this->_var['status_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'list');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['list']):
?>
                            <li id="order_status_<?php echo $this->_var['key']; ?>"><a href="javascript:void(0);" data-idtxt="status_list" data-action="<?php echo $this->_var['action']; ?>" data-type="order_status" data-id="<?php echo $this->_var['key']; ?>" data-value='<?php echo $this->_var['key']; ?>'><?php echo $this->_var['list']; ?></a></li>
                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                        </ul>
                        <input name="order_status_list" type="hidden" value="-1" id="order_status_val">
                    </div>
                    <div id="dateTime" class="imitate_select w120">
                        <div class="cite"><span><?php echo $this->_var['lang']['all_time']; ?></span><i class="iconfont icon-down"></i></div>
                        <ul>
                            <li id="time_allDate"><a href="javascript:void(0);" data-idtxt="submitDate" data-action="<?php echo $this->_var['action']; ?>" data-type="dateTime" data-id="allDate" data-value="allDate"><?php echo $this->_var['lang']['all_time']; ?></a></li>
                            <li id="time_today"><a href="javascript:void(0);" data-idtxt="submitDate" data-action="<?php echo $this->_var['action']; ?>" data-type="dateTime" data-id="today" data-value="today"><?php echo $this->_var['lang']['Today']; ?></a></li>
                            <li id="time_three_today"><a href="javascript:void(0);" data-idtxt="submitDate" data-action="<?php echo $this->_var['action']; ?>" data-type="dateTime" data-id="three_today" data-value="three_today"><?php echo $this->_var['lang']['three_today']; ?></a></li>
                            <li id="time_aweek"><a href="javascript:void(0);" data-idtxt="submitDate" data-action="<?php echo $this->_var['action']; ?>" data-type="dateTime" data-id="aweek" data-value="aweek"><?php echo $this->_var['lang']['aweek']; ?></a></li>
                            <li id="time_thismonth"><a href="javascript:void(0);" data-idtxt="submitDate" data-action="<?php echo $this->_var['action']; ?>" data-type="dateTime" data-id="thismonth" data-value="thismonth"><?php echo $this->_var['lang']['thismonth']; ?></a></li>
                        </ul>
                        <input name="order_submitDate" type="hidden" value="allDate" id="dateTime_val">
                    </div>
                </div>
                <div class="user-list-search">
                    <input type="text" id="ip_keyword" class="text" onkeydown="javascript:if(event.keyCode==13) get_OrderSearch('ip_keyword');" onblur="if (this.value=='') this.value=this.defaultValue; this.style.color='#999'" onfocus="if (this.value==this.defaultValue)this.value='';this.style.color='#666'" placeholder="<?php echo $this->_var['lang']['search_oreder_user']; ?>" name="" style="color:#999;"/>
                    <button type="button" onclick="get_OrderSearch('ip_keyword', '<?php echo $this->_var['action']; ?>', 'text')"><i class="iconfont icon-search"></i></button>
                </div>
            </div>
            <div id="user_order_list">
            <?php if (! $this->_var['order_type']): ?>
            <?php echo $this->fetch('library/user_order_list.lbi'); ?>
            <?php endif; ?>
            </div>
        </div>
        <?php endif; ?> 
        

		
		<?php if ($this->_var['action'] == 'snatch_list'): ?>
		<div class="user-mod">
			<div class="user-title">
				<h2><?php echo $this->_var['lang']['my_snatch']; ?></h2>
                <ul class="tabs">
                    <li class="active"><a href=""><?php echo $this->_var['lang']['snatch_all']; ?>(<?php echo empty($this->_var['all_snatch']) ? '0' : $this->_var['all_snatch']; ?>)</a></li>
                    <li class="user-count3" onclick="get_SnatchSearch('is_going', '<?php echo $this->_var['action']; ?>', 'is_going','','.user-count3')">
						<a href="javascript:void(0);"><?php echo $this->_var['lang']['auction_staues']['1']; ?>(<?php echo $this->_var['is_going']; ?>)</a>
						<input name="is_going" id="is_going" type="hidden" value="1" />
                    </li>
                    <li class="user-count1" onclick="get_SnatchSearch('is_finished', '<?php echo $this->_var['action']; ?>', 'is_finished','','.user-count1')">
						<a href="javascript:void(0);"><?php echo $this->_var['lang']['auction_staues']['3']; ?>(<?php echo $this->_var['is_finished']; ?>)</a>
						<input name="is_finished" id="is_finished" type="hidden" value="3" />
                    </li>
                </ul>
            </div>
			<div class="comment-list-warp clearfix">
                <div class="user-order-list" id="user-snatch-list">
					<?php echo $this->fetch('library/user_snatch_list.lbi'); ?>
                </div>
            </div>
		</div>
		<?php endif; ?>
		
		
        
        <?php if ($this->_var['action'] == 'coupons'): ?>
        <div class="user-mod" ectype="tabSection">
            <div class="user-title">
                <h2><?php echo $this->_var['lang']['Coupon_list']; ?></h2>
                <ul class="tabs" ectype="tabs">
                    <li class="active"><a href="javascript:void(0);"><?php echo $this->_var['lang']['not_use']; ?>(<?php echo $this->_var['no_use_count']; ?>)</a></li>
                    <li><a href="javascript:void(0);"><?php echo $this->_var['lang']['had_use']; ?>(<?php echo $this->_var['yes_use_count']; ?>)</a></li>
                    <li><a href="javascript:void(0);"><?php echo $this->_var['lang']['overdue']; ?>(<?php echo $this->_var['yes_time_count']; ?>)</a></li>
                    <li><a href="javascript:void(0);"><?php echo $this->_var['lang']['About_expire']; ?>(<?php echo $this->_var['no_time_count']; ?>)</a></li>
                </ul>
            </div>
            <div class="user-coupons-warp" ectype="tabContent">
                <div id="coupons_list0" class="coupons_content_list">
                    <div class="coupons-items">
                        <?php if ($this->_var['no_use']): ?>
                        <?php $_from = $this->_var['no_use']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'vo');$this->_foreach['cou'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['cou']['total'] > 0):
    foreach ($_from AS $this->_var['vo']):
        $this->_foreach['cou']['iteration']++;
?>
                        <div class="coupons-item <?php if ($this->_foreach['cou']['iteration'] % 2 == 0): ?>coupons-item-double<?php endif; ?>" >
                            <div class="c-type">
                                <i class="i-left"></i>
                                <div class="c-t-cont">
                                    <div class="c-t-c-top">
                                        <?php if ($this->_var['vo']['cou_type'] != 5): ?><strong><em>￥</em><?php if ($this->_var['vo']['order_sn'] != ''): ?><?php echo $this->_var['vo']['order_coupons']; ?><?php else: ?><?php if ($this->_var['vo']['uc_money'] != 0): ?><?php echo $this->_var['vo']['uc_money']; ?><?php else: ?><?php echo $this->_var['vo']['cou_money']; ?><?php endif; ?><?php endif; ?></strong><?php else: ?><i class="icon-my"></i><?php endif; ?>
                                        <span><?php echo $this->_var['lang']['Consumption_full']; ?><?php echo $this->_var['vo']['cou_man']; ?><?php echo $this->_var['lang']['yuan']; ?>&nbsp;<?php echo $this->_var['lang']['keyong']; ?></span>
                                    </div>
                                    <div class="c-t-c-bot">
                                        <p><?php echo $this->_var['lang']['Platform_limit']; ?>：<?php if ($this->_var['vo']['store_name']): ?><?php echo $this->_var['vo']['store_name']; ?><?php else: ?><?php echo $this->_var['lang']['whole_platform']; ?><?php endif; ?></p>
                                        <p><?php echo $this->_var['lang']['range_bonus']; ?>：[<?php echo $this->_var['vo']['cou_type_name']; ?>][<?php echo $this->_var['vo']['cou_goods_name']; ?>]</p>
                                        <p><?php echo $this->_var['vo']['cou_start_time_date']; ?> ~ <?php echo $this->_var['vo']['cou_end_time_date']; ?></p>
                                    </div>
                                </div>
                                <?php if ($this->_var['will_passed']): ?>
                                <i class="i-right"></i>
                                <i class="i-soon"><?php echo $this->_var['lang']['About_expire']; ?></i>
                                <?php endif; ?>
                            </div>
                            <?php if ($this->_var['is_used']): ?>
                            <div class="c-msg">
                                <span class="not"><?php echo $this->_var['lang']['had_use']; ?></span>
                            </div>
                            <?php else: ?>
                            <div class="c-msg">
                                <a href="search.php?cou_id=<?php echo $this->_var['vo']['cou_id']; ?>&user_cou=1">
                                    <span class="lj"><?php echo $this->_var['lang']['Immediate_use']; ?></span>
                                    <i class="iconfont icon-down"></i>
                                </a>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                        <?php else: ?>
                        <div class="no_records">
                            <i class="no_icon_two"></i>
                            <div class="no_info"><h3><?php echo $this->_var['lang']['no_coupons_keyong']; ?></h3></div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div id="coupons_list1" style="display: none;" class="coupons_content_list">
                    <div class="coupons-items coupons-item-disabled">
                        <?php if ($this->_var['yes_use']): ?>
                        <?php $_from = $this->_var['yes_use']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'vo');$this->_foreach['cou'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['cou']['total'] > 0):
    foreach ($_from AS $this->_var['vo']):
        $this->_foreach['cou']['iteration']++;
?>
                        <div class="coupons-item">
                            <div class="c-type">
                                <i class="i-left"></i>
                                <div class="c-t-cont">
                                    <div class="c-t-c-top">
                                        <?php if ($this->_var['vo']['cou_type'] != 5): ?><strong><em>￥</em><?php if ($this->_var['vo']['order_sn'] != ''): ?><?php echo $this->_var['vo']['order_coupons']; ?><?php else: ?><?php if ($this->_var['vo']['uc_money'] != 0): ?><?php echo $this->_var['vo']['uc_money']; ?><?php else: ?><?php echo $this->_var['vo']['cou_money']; ?><?php endif; ?><?php endif; ?></strong><?php else: ?><i class="icon-my"></i><?php endif; ?>
                                        <span><?php echo $this->_var['lang']['Consumption_full']; ?><?php echo $this->_var['vo']['cou_man']; ?><?php echo $this->_var['lang']['yuan']; ?>&nbsp;<?php echo $this->_var['lang']['keyong']; ?></span>
                                    </div>
                                    <div class="c-t-c-bot">
                                        <p><?php echo $this->_var['lang']['Platform_limit']; ?>：<?php if ($this->_var['vo']['store_name']): ?><?php echo $this->_var['lang']['xian']; ?><?php echo $this->_var['vo']['store_name']; ?><?php else: ?><?php echo $this->_var['lang']['whole_platform']; ?><?php endif; ?></p>
                                        <p><?php echo $this->_var['lang']['range_bonus']; ?>：[<?php echo $this->_var['vo']['cou_type_name']; ?>][<?php echo $this->_var['vo']['cou_goods_name']; ?>]</p>
                                        <p><?php echo $this->_var['vo']['cou_start_time_date']; ?> ~ <?php echo $this->_var['vo']['cou_end_time_date']; ?></p>
                                    </div>
                                </div>
                                <?php if ($this->_var['will_passed']): ?>
                                <i class="i-right"></i>
                                <i class="i-soon"><?php echo $this->_var['lang']['About_expire']; ?></i>
                                <?php endif; ?>
                            </div>
                            <?php if ($this->_var['is_used']): ?>
                            <div class="c-msg">
                                <span class="not"><?php echo $this->_var['lang']['had_use']; ?></span>
                            </div>
                            <?php else: ?>
                            <div class="c-msg">
                                <span class="not"><?php echo $this->_var['lang']['had_use']; ?></span>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                        <?php else: ?>
                        <div class="no_records">
                            <i class="no_icon_two"></i>
                            <div class="no_info"><h3><?php echo $this->_var['lang']['no_coupons_use']; ?></h3></div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div id="coupons_list2" style="display: none;" class="coupons_content_list">
                    <div class="coupons-items">
                        <?php if ($this->_var['yes_time']): ?>
                        <?php $_from = $this->_var['yes_time']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'vo');$this->_foreach['cou'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['cou']['total'] > 0):
    foreach ($_from AS $this->_var['vo']):
        $this->_foreach['cou']['iteration']++;
?>
                        <div class="coupons-item coupons-item-disabled" >
                            <div class="c-type">
                                <i class="i-left"></i>
                                <div class="c-t-cont">
                                    <div class="c-t-c-top">
                                        <?php if ($this->_var['vo']['cou_type'] != 5): ?><strong><em>￥</em><?php if ($this->_var['vo']['order_sn'] != ''): ?><?php echo $this->_var['vo']['order_coupons']; ?><?php else: ?><?php if ($this->_var['vo']['uc_money'] != 0): ?><?php echo $this->_var['vo']['uc_money']; ?><?php else: ?><?php echo $this->_var['vo']['cou_money']; ?><?php endif; ?><?php endif; ?></strong><?php else: ?><i class="icon-my"></i><?php endif; ?>
                                        <span><?php echo $this->_var['lang']['Consumption_full']; ?><?php echo $this->_var['vo']['cou_man']; ?><?php echo $this->_var['lang']['yuan']; ?>&nbsp;<?php echo $this->_var['lang']['keyong']; ?></span>
                                    </div>
                                    <div class="c-t-c-bot">
                                        <p><?php echo $this->_var['lang']['Platform_limit']; ?>：<?php if ($this->_var['vo']['store_name']): ?><?php echo $this->_var['lang']['xian']; ?><?php echo $this->_var['vo']['store_name']; ?><?php else: ?><?php echo $this->_var['lang']['whole_platform']; ?><?php endif; ?></p>
                                        <p><?php echo $this->_var['lang']['range_bonus']; ?>：[<?php echo $this->_var['vo']['cou_type_name']; ?>][<?php echo $this->_var['vo']['cou_goods_name']; ?>]</p>
                                        <p><?php echo $this->_var['vo']['cou_start_time_date']; ?> ~ <?php echo $this->_var['vo']['cou_end_time_date']; ?></p>
                                    </div>
                                </div>
                                <?php if ($this->_var['will_passed']): ?>
                                <i class="i-right"></i>
                                <i class="i-soon"><?php echo $this->_var['lang']['About_expire']; ?></i>
                                <?php endif; ?>
                            </div>
                            <?php if ($this->_var['is_used']): ?>
                            <div class="c-msg">
                                <span class="not"><?php echo $this->_var['lang']['had_use']; ?></span>
                            </div>
                            <?php else: ?>
                            <div class="c-msg">
                                <span class="not"><?php echo $this->_var['lang']['overdue']; ?></span>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                        <?php else: ?>
                        <div class="no_records">
                            <i class="no_icon_two"></i>
                            <div class="no_info"><h3><?php echo $this->_var['lang']['no_coupons_over']; ?></h3></div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div id="coupons_list3" style="display: none;" class="coupons_content_list">
                    <div class="coupons-items <?php if ($this->_foreach['cou']['iteration'] % 2 == 0): ?>coupons-item-double<?php endif; ?>">
                        <?php if ($this->_var['no_time']): ?>
                        <?php $_from = $this->_var['no_time']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'vo');$this->_foreach['cou'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['cou']['total'] > 0):
    foreach ($_from AS $this->_var['vo']):
        $this->_foreach['cou']['iteration']++;
?>
                        <div class="coupons-item <?php if ($this->_foreach['cou']['iteration'] % 2 == 0): ?>coupons-item-double<?php endif; ?>" >
                            <div class="c-type">
                                <i class="i-left"></i>
                                <div class="c-t-cont">
                                    <div class="c-t-c-top">
                                        <?php if ($this->_var['vo']['cou_type'] != 5): ?><strong><em>￥</em><?php if ($this->_var['vo']['order_sn'] != ''): ?><?php echo $this->_var['vo']['order_coupons']; ?><?php else: ?><?php if ($this->_var['vo']['uc_money'] != 0): ?><?php echo $this->_var['vo']['uc_money']; ?><?php else: ?><?php echo $this->_var['vo']['cou_money']; ?><?php endif; ?><?php endif; ?></strong><?php else: ?><i class="icon-my"></i><?php endif; ?>
                                        <span><?php echo $this->_var['lang']['Consumption_full']; ?><?php echo $this->_var['vo']['cou_man']; ?><?php echo $this->_var['lang']['yuan']; ?>&nbsp;<?php echo $this->_var['lang']['keyong']; ?></span>
                                    </div>
                                    <div class="c-t-c-bot">
                                        <p><?php echo $this->_var['lang']['Platform_limit']; ?>：<?php if ($this->_var['vo']['store_name']): ?><?php echo $this->_var['lang']['xian']; ?><?php echo $this->_var['vo']['store_name']; ?><?php else: ?><?php echo $this->_var['lang']['whole_platform']; ?><?php endif; ?></p>
                                        <p><?php echo $this->_var['lang']['range_bonus']; ?>：[<?php echo $this->_var['vo']['cou_type_name']; ?>][<?php echo $this->_var['vo']['cou_goods_name']; ?>]</p>
                                        <p><?php echo $this->_var['vo']['cou_start_time_date']; ?> ~ <?php echo $this->_var['vo']['cou_end_time_date']; ?></p>
                                    </div>
                                </div>
                                <?php if ($this->_var['will_passed']): ?>
                                <i class="i-right"></i>
                                <i class="i-soon"><?php echo $this->_var['lang']['About_expire']; ?></i>
                                <?php endif; ?>
                            </div>
                            <?php if ($this->_var['is_used']): ?>
                            <div class="c-msg">
                                <span class="not"><?php echo $this->_var['lang']['had_use']; ?></span>
                            </div>
                            <?php else: ?>
                            <div class="c-msg">
                                <a href="search.php?cou_id=<?php echo $this->_var['vo']['cou_id']; ?>&user_cou=1">
                                    <span class="lj"><?php echo $this->_var['lang']['Immediate_use']; ?></span>
                                    <i class="iconfont icon-down"></i>
                                </a>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                        <?php else: ?>
                        <div class="no_records">
                            <i class="no_icon_two"></i>
                            <div class="no_info"><h3><?php echo $this->_var['lang']['no_coupons_soon_over']; ?></h3></div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>				
            </div>
        </div>
        <?php endif; ?>
        

        
        <?php if ($this->_var['action'] == 'track_packages'): ?>
        <div class="user-mod">
            <div class="user-title">
                <h2><?php echo $this->_var['lang']['label_track_packages']; ?></h2>
            </div>
            <div class="user-order-list user-trackpack">
            <?php $_from = $this->_var['orders']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
                <dl class="item" data-orderId='<?php echo $this->_var['item']['order_id']; ?>'>
                    <dt class="item-t">
                        <div class="t-statu"><?php if ($this->_var['item']['shipping_status'] != ""): ?><?php echo $this->_var['item']['shipping_status']; ?><?php else: ?>&nbsp;<?php endif; ?></div>
                        <div class="t-info">
                            <span class="info-item"><?php echo $this->_var['lang']['order_number']; ?>：<?php echo $this->_var['item']['order_sn']; ?></span>
                            <span class="info-item"><?php echo $this->_var['lang']['Waybill_number']; ?>：<?php if ($this->_var['item']['invoice_no'] != ""): ?><?php echo $this->_var['item']['invoice_no']; ?><?php else: ?>&nbsp;<?php endif; ?></span>
                            <span class="info-item"><?php if ($this->_var['item']['shipping_name'] != ""): ?><?php echo $this->_var['item']['shipping_name']; ?><?php else: ?>&nbsp;<?php endif; ?></span>
                        </div>
                        <div class="t-right"><?php echo $this->_var['item']['formated_shipping_time']; ?></div>
                    </dt>
                    <dd class="item-c relative">
                        <div class="c-left">
                            <?php $_from = $this->_var['item']['goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');$this->_foreach['goods'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['goods']['total'] > 0):
    foreach ($_from AS $this->_var['goods']):
        $this->_foreach['goods']['iteration']++;
?>
                            <div class="c-goods" ectype="c-goods" <?php if (($this->_foreach['goods']['iteration'] - 1) > 2): ?> style="display:none;"<?php endif; ?>>
                                <div class="c-img"><a href="<?php echo $this->_var['goods']['url']; ?>"><img src="<?php echo $this->_var['goods']['goods_thumb']; ?>" alt=""></a></div>
                                <div class="c-info">
                                    <div class="info-name"><a href="<?php echo $this->_var['goods']['url']; ?>"><?php echo $this->_var['goods']['goods_name']; ?></a></div>
                                    <div class="info-price"><b><?php echo $this->_var['goods']['goods_price']; ?></b><i>×</i><span><?php echo $this->_var['goods']['goods_number']; ?></span></div>
                                </div>
                            </div>
                            <?php $this->assign('goods_count',$this->_foreach['goods']['iteration']); ?>
                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                            <?php if ($this->_var['goods_count'] > 3): ?>
                            <span class="ellipsis">......</span>
                            <a href="javascript:void(0);" class="order-prolist-more" ectype="opm"><?php echo $this->_var['lang']['see_more']; ?>︾</a>
                            <?php endif; ?>
                        </div>
                        <div class="c-handle" ectype="track-packages-btn">
                            <a href="javascript:void(0)" class="sc-btn"><i class="iconfont icon-truck"></i><?php echo $this->_var['lang']['Track']; ?></a>
                            <div class="comment-box" ectype="track-packages-info">
                                <i class="box-i"></i>
                                <?php if ($this->_var['item']['invoice_no']): ?>
                                <div class="conmment-box-content">
                                    <div class="cont" id="retData_<?php echo $this->_var['item']['order_id']; ?>">
                                        
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <span id="invoice_no_<?php echo $this->_var['item']['order_id']; ?>" style="display:none"><?php echo $this->_var['item']['invoice_no']; ?></span>
                        <span id="shipping_name_<?php echo $this->_var['item']['order_id']; ?>" style="display:none"><?php echo $this->_var['item']['shipping_name']; ?></span>
                    </dd>
                </dl>
            <?php endforeach; else: ?>
                <div class="no_records">
                    <i class="no_icon_two"></i>
                    <div class="no_info"><h3><?php 
$k = array (
  'name' => 'get_page_no_records',
  'filename' => $this->_var['filename'],
  'act' => $this->_var['action'],
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?></h3></div>
                </div>
            <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
            </div>
        </div>
        <?php endif; ?>
        
        
        
        <?php if ($this->_var['action'] == 'account_log' || $this->_var['action'] == 'account_detail' || $this->_var['action'] == 'account_paypoints' || $this->_var['action'] == 'account_rankpoints'): ?>
        <div class="user-mod">
            <div class="user-account-warp">
                
                <div class="user-title">
                    <h2><?php echo $this->_var['lang']['account_log']; ?></h2>
                </div>
                <div class="account-main account-not">
                    <div class="account-price"><strong><?php echo $this->_var['lang']['account_balance']; ?>：</strong><span class="a-price"><?php echo $this->_var['info']['surplus']; ?></span></div>
                    <div class="account-btn">
                        <a href="user.php?act=account_deposit" class="sc-btn sc-redBg-btn"><?php echo $this->_var['lang']['online_recharge']; ?></a>
                        <a href="user.php?act=<?php if ($this->_var['validate_info']['real_name']): ?>account_raply<?php else: ?>account_safe&type=real_name&step=first<?php endif; ?>" class="sc-btn"><?php echo $this->_var['lang']['Application_withdrawal']; ?></a>
                    </div>

                    <div class="a-m-bot">
                        <div class="user-frame-items">
                            <div class="item">
								<a href="user.php?act=bonus">
									<span><?php echo $this->_var['lang']['label_bonus']; ?></span>
									<span class="b-price"><?php echo $this->_var['info']['bonus_count']; ?></span>
								</a>
                            </div>
                            <div class="item">
								<a href="user.php?act=coupons">
									<span><?php echo $this->_var['lang']['label_coupons']; ?></span>
									<span class="b-price"><?php echo $this->_var['coupons']['num']; ?></span>
								</a>
                            </div>
                            <div class="item">
								<a href="user.php?act=value_card">
									<span><?php echo $this->_var['lang']['label_value_card']; ?></span>
									<span class="b-price"><?php echo $this->_var['value_card']['num']; ?></span>
								</a>
                            </div>
                            <div class="item">
								<span><?php echo $this->_var['lang']['consume_integral']; ?></span>
								<span class="b-price"><?php echo $this->_var['info']['integral']; ?></span>
                            </div>
                        </div>
                    </div>
                    <?php if ($this->_var['action'] == 'account_log'): ?>
                    <div class="user-prompt mt50">
                        <div class="tit"><span><?php echo $this->_var['lang']['account_log_notic_title']; ?></span><i class="iconfont icon-down"></i></div>
                        <div class="info">
                            <?php echo $this->_var['lang']['account_log_notic']; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="user-title mt30">
                        <ul class="tabs">
                            <li <?php if ($this->_var['action'] == 'account_log'): ?>class="active"<?php endif; ?>><a href="user.php?act=account_log"><?php echo $this->_var['lang']['05_seller_account_log']; ?></a></li>
                            <li <?php if ($this->_var['action'] == 'account_detail'): ?>class="active"<?php endif; ?>><a href="user.php?act=account_detail"><?php echo $this->_var['lang']['account_detail']; ?></a></li>
                            <li <?php if ($this->_var['action'] == 'account_paypoints'): ?>class="active"<?php endif; ?>><a href="user.php?act=account_paypoints"><?php echo $this->_var['lang']['consume_integral']; ?></a></li>
                            <li <?php if ($this->_var['action'] == 'account_rankpoints'): ?>class="active"<?php endif; ?>><a href="user.php?act=account_rankpoints"><?php echo $this->_var['lang']['rank_integral']; ?></a></li>
                        </ul>
                    </div>
                    <?php if ($this->_var['action'] == 'account_log'): ?>
                    <div class="account-open-list">
                        <table class="user-table user-table-account">
                            <colgroup>
                                <col width="140">
                                <col width="120">
                                <col width="120">
                                <col width="140">
                                <col width="140">
                                <col width="100">
                                <col>
                            </colgroup>
                            <thead>
                                <tr>
                                    <th><?php echo $this->_var['lang']['info']; ?></th>
                                    <th class="tl"><?php echo $this->_var['lang']['money']; ?></th>
                                    <th class="tl"><?php echo $this->_var['lang']['payment_method']; ?></th>
                                    <th class="tl"><?php echo $this->_var['lang']['process_notic']; ?></th>
                                    <th class="tl"><?php echo $this->_var['lang']['admin_notic']; ?></th>
                                    <th><?php echo $this->_var['lang']['is_paid']; ?></th>
                                    <th><?php echo $this->_var['lang']['handle']; ?></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $_from = $this->_var['account_log']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
                                <tr>
                                    <td><?php echo $this->_var['item']['add_time']; ?><br><div class="ftx-01"><?php echo $this->_var['item']['type']; ?></div></td>
                                    <td><?php echo $this->_var['item']['amount']; ?><?php if ($this->_var['item']['deposit_fee'] != 0): ?><br/><span class='red'>(<?php echo $this->_var['lang']['pay_fee']; ?>：<?php echo $this->_var['item']['deposit_fee']; ?>)</span><?php endif; ?></td>
                                    <td><?php echo empty($this->_var['item']['payment']) ? 'N/A' : $this->_var['item']['payment']; ?></td>
                                    <td><?php echo $this->_var['item']['short_user_note']; ?></td>
                                    <td><?php echo $this->_var['item']['short_admin_note']; ?></td>
                                    <td class="tc account_pay">
                                        <?php echo $this->_var['item']['pay_status']; ?>
                                    </td>
                                    <td>
                                    	<?php if ($this->_var['item']['handle']): ?>
                                        	<p>
                                            <a class="sc_btnt_ype" href="user.php?act=account_complaint&id=<?php echo $this->_var['item']['id']; ?>">
                                            	<?php if ($this->_var['item']['complaint_imges']): ?>
                                                <?php echo $this->_var['lang']['is_complaint']; ?>
                                                <?php else: ?>
                                                <?php echo $this->_var['lang']['complaint']; ?>
                                                <?php endif; ?>
                                            </a>
                                            </p>
                                        	<p>
                                            <?php echo $this->_var['item']['handle']; ?>
                                            <?php if (( $this->_var['item']['is_paid'] == 0 && $this->_var['item']['process_type'] == 1 ) || $this->_var['item']['handle']): ?>
                                            <a href="user.php?act=cancel&id=<?php echo $this->_var['item']['id']; ?>" onclick="if (!confirm('<?php echo $this->_var['lang']['confirm_remove_account']; ?>')) return false;"><?php echo $this->_var['lang']['is_cancel']; ?></a>
                                            <?php endif; ?>
                                            </p>
                                        <?php else: ?>
                                        	<?php echo $this->_var['lang']['null_handle']; ?>    
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; else: ?>
                                <tr>
                                    <td colspan="7"><?php echo $this->_var['lang']['account_log_empty']; ?></td>
                                </tr>
                            <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php echo $this->fetch('library/pages.lbi'); ?>
                    <?php endif; ?>
                    
                    <?php if ($this->_var['action'] == 'account_detail'): ?>
                    <div class="account-open-list">
                        <table class="user-table user-table-account">
                            <colgroup>
                                <col width="140">
                                <col width="120">
                                <col width="120">
                                <col width="160">
                                <col>
                            </colgroup>
                            <thead>
                                <tr>
                                    <th><?php echo $this->_var['lang']['process_time']; ?></th>
                                    <th class="tl"><?php echo $this->_var['lang']['surplus_pro_type']; ?></th>
                                    <th class="tl"><?php echo $this->_var['lang']['money']; ?></th>
                                    <th class="tl tc"><?php echo $this->_var['lang']['change_desc']; ?></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $_from = $this->_var['account_log']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
                                <tr>
                                    <td><?php echo $this->_var['item']['change_time']; ?></td>
                                    <td><?php echo $this->_var['item']['type']; ?></td>
                                    <td><?php echo $this->_var['item']['amount']; ?><?php if ($this->_var['item']['deposit_fee'] != 0): ?><br/><span class='red'>(<?php echo $this->_var['lang']['pay_fee']; ?>：<?php echo $this->_var['item']['deposit_fee']; ?>)</span><?php endif; ?></td>
                                    <td><?php echo $this->_var['item']['short_change_desc']; ?></td>
                                </tr>
                            <?php endforeach; else: ?>
                                <tr>
                                    <td colspan="6"><?php echo $this->_var['lang']['account_log_empty']; ?></td>
                                </tr>
                            <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php echo $this->fetch('library/pages.lbi'); ?>
                    <?php endif; ?>
                    
                    <?php if ($this->_var['action'] == 'account_paypoints'): ?>
                    <div class="account-open-list">
                        <table class="user-table user-table-account">
                            <colgroup>
                                <col width="140">
                                <col width="120">
                                <col width="120">
                                <col width="160">
                                <col>
                            </colgroup>
                            <thead>
                                <tr>
                                    <th><?php echo $this->_var['lang']['process_time']; ?></th>
                                    <th class="tl"><?php echo $this->_var['lang']['surplus_pro_type']; ?></th>
                                    <th class="tl"><?php echo $this->_var['lang']['points']; ?></th>
                                    <th class="tl tc"><?php echo $this->_var['lang']['change_desc']; ?></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $_from = $this->_var['account_log']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
                                <tr>
                                    <td><?php echo $this->_var['item']['change_time']; ?></td>
                                    <td><?php echo $this->_var['item']['type']; ?></td>
                                    <td><?php echo $this->_var['item']['pay_points']; ?></td>
                                    <td><?php echo $this->_var['item']['short_change_desc']; ?></td>
                                </tr>
                            <?php endforeach; else: ?>
                                <tr>
                                    <td colspan="6"><?php echo $this->_var['lang']['account_log_empty']; ?></td>
                                </tr>
                            <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php echo $this->fetch('library/pages.lbi'); ?>
                    <?php endif; ?>
                </div>
                
                <?php if ($this->_var['action'] == 'account_rankpoints'): ?>
                <div class="account-open-list">
                    <table class="user-table user-table-account">
                        <colgroup>
                            <col width="140">
                            <col width="120">
                            <col width="120">
                            <col width="160">
                            <col>
                        </colgroup>
                        <thead>
                            <tr>
                                <th><?php echo $this->_var['lang']['process_time']; ?></th>
                                <th class="tl"><?php echo $this->_var['lang']['surplus_pro_type']; ?></th>
                                <th class="tl"><?php echo $this->_var['lang']['points']; ?></th>
                                <th class="tl tc"><?php echo $this->_var['lang']['change_desc']; ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $_from = $this->_var['account_log']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
                            <tr>
                                <td><?php echo $this->_var['item']['change_time']; ?></td>
                                <td><?php echo $this->_var['item']['type']; ?></td>
                                <td><?php echo $this->_var['item']['rank_points']; ?></td>
                                <td><?php echo $this->_var['item']['short_change_desc']; ?></td>
                            </tr>
                        <?php endforeach; else: ?>
                            <tr>
                                <td colspan="6"><?php echo $this->_var['lang']['account_log_empty']; ?></td>
                            </tr>
                        <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
                        </tbody>
                    </table>
                </div>
				<?php echo $this->fetch('library/pages.lbi'); ?>
                <?php endif; ?>
          </div>
		</div>
        <?php endif; ?>
        
        <?php if ($this->_var['action'] == "account_complaint"): ?>
        <div class="user-mod">
        	<div class="type">
                <div class="user-title">
                    <h2><?php echo $this->_var['lang']['account_appeal']; ?></h2>
                </div>
                <div class="account-main account-bind">
                    <div class="user-items">
                        <form name="account_complaint" method="post" action="user.php" enctype="multipart/form-data" class="user-form user-form-safe">
                            <div class="item">
                                <div class="label"><?php echo $this->_var['lang']['account_time']; ?>：</div>
                                <div class="value">
                                	<span class="txt-lh"><?php echo $this->_var['user_account']['add_time']; ?></span>
                                </div>
                            </div>
                            <div class="item">
                                <div class="label"><?php echo $this->_var['lang']['deposit_money']; ?>：</div>
                                <div class="value">
                                	<span class="txt-lh"><?php echo $this->_var['user_account']['amount']; ?></span>
                                </div>
                            </div>
                            
                            <div class="item">
                                <div class="label"><?php echo $this->_var['lang']['payment']; ?>：</div>
                                <div class="value">
                                	<span class="txt-lh"><?php echo $this->_var['user_account']['payment']; ?></span>
                                </div>
                            </div>
                            
                            <div class="item">
                                <div class="label"><em class="red">*</em><?php echo $this->_var['lang']['appeal_credential']; ?>：</div>
                                <div class="value">
                                	<div class="type-file-box">
                                        <?php if ($this->_var['user_account']['complaint_imges']): ?>
                                        <span class="show"><a href="<?php echo $this->_var['user_account']['complaint_imges']; ?>" class="nyroModal"><i class="iconfont icon-picture" onmouseover="toolTip('<img src=<?php echo $this->_var['user_account']['complaint_imges']; ?>>')" onmouseout="toolTip()"></i></a></span>
                                        <?php else: ?>
                                        <input type="button" name="button" id="button" class="type-file-button">
                                        <input type="file" name="complaint_imges" class="type-file-file" size="30" data-state="imgfile" hidefocus="true" value="">
                                        <input type="text" name="textfile_zheng" class="type-file-text" id="textfile_zheng" value="" readonly>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form_prompt"></div>
                                </div>
                            </div>
                            
                            <div class="item">
                                <div class="label"><?php echo $this->_var['lang']['appeal_explain']; ?>：</div>
                                <div class="value">
                                	<span class="txt-lh">
										<textarea name="complaint_details" class="text text-2" style="height:100px; line-height:20px; padding-top:3px; padding-bottom:3px; font-size:12px;"><?php echo $this->_var['user_account']['complaint_details']; ?></textarea>
                                    </span>
                                </div>
                            </div>
                            
                            <?php if (! $this->_var['user_account']['complaint_imges']): ?>
                                <div class="item item-button">
                                    <div class="label">&nbsp;</div>
                                    <div class="value">
                                        <input type="hidden" value="<?php echo $this->_var['id']; ?>" name="id">
                                        <input type="hidden" value="<?php echo $this->_var['operate']; ?>" name="act">
                                        <input type="submit" id="authSubmit" class="sc-btn sc-redBg-btn" value="提交">
                                    </div>
                                </div>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>    
        <?php endif; ?>
        
        <?php if ($this->_var['action'] == "account_deposit"): ?>
        <div class="user-mod">
            <div class="user-account-warp">
                <div class="user-title">
                    <h2><?php echo $this->_var['lang']['online_recharge']; ?></h2>
                </div>
                <form name="formSurplus" method="post" action="user.php" id="formSurplus">
                <div class="account-main account-deposit">
                    <div class="user-items">
                        <div class="item">
                            <div class="label"><?php echo $this->_var['lang']['account_balance']; ?>：</div>
                            <div class="value"><span class="txt-lh ftx-01"><?php echo $this->_var['user_info']['surplus']; ?></span></div>
                        </div>
                        <div class="item">
                            <div class="label"><?php echo $this->_var['lang']['surplus_type_0']; ?>：</div>
                            <div class="value">
                                <input type="text" name="amount" class="text text-1" />
                                <span class="ts"><?php echo $this->_var['lang']['yuan']; ?><?php if ($this->_var['buyer_recharge'] > 0): ?>充值金额最低为<?php echo $this->_var['buyer_recharge']; ?>元<?php endif; ?></span>
                                <div class="form_prompt"></div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="label"><?php echo $this->_var['lang']['payment']; ?>：</div>
                            <div class="value">
                                <?php $_from = $this->_var['payment']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'list');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['list']):
?>
                                <div class="radio-item">
                                    <input type="radio" name="payment_id" class="ui-radio" value="<?php echo $this->_var['list']['pay_id']; ?>" id="payment-remittance_<?php echo $this->_var['list']['pay_id']; ?>" <?php if ($this->_var['key'] == 0): ?>checked<?php endif; ?> />
                                    <label for="payment-remittance_<?php echo $this->_var['list']['pay_id']; ?>" class="ui-radio-label"><?php echo $this->_var['list']['pay_name']; ?></label>
                                </div>
                                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                            </div>
                        </div>
                        <div class="item">
                            <div class="label"><?php echo $this->_var['lang']['process_notic']; ?>：</div>
                            <div class="value"><textarea name="user_note" class="textarea"></textarea></div>
                        </div>
                        <div class="item item-button">
                            <div class="label">&nbsp;</div>
                            <div class="value">
                                <input type="hidden" name="surplus_type" value="0" />
                                <input type="hidden" name="rec_id" value="<?php echo empty($this->_var['order']['id']) ? '0' : $this->_var['order']['id']; ?>" />
                                <input type="hidden" name="act" value="act_account" />
                                <input type="submit" class="sc-btn sc-redBg-btn" name="submit" id="submitBtn" value="<?php echo $this->_var['lang']['Determine_Recharge']; ?>" />
                                <input type="button" id="goback_account_log" class="sc-btn sc-redBg-btn" value="<?php echo $this->_var['lang']['back_up_page']; ?>">
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <?php endif; ?>
        
        <?php if ($this->_var['action'] == "account_raply"): ?>		
        <div class="user-mod">
            <div class="user-account-warp">
                <div class="user-title">
                    <h2><?php echo $this->_var['lang']['Application_withdrawal']; ?></h2>
                </div>
                <form name="formSurplus" method="post" action="user.php" id="formSurplus">
                    <div class="user-items">
                        <div class="item">
                            <div class="label"><?php echo $this->_var['lang']['Real_name']; ?>：</div>
                            <div class="value"><span class="txt-lh"><?php echo $this->_var['validate_info']['real_name']; ?></span></div>
                        </div>
                        <div class="item">
                            <div class="label"><?php echo $this->_var['lang']['Current_balance_label']; ?>：</div>
                            <div class="value"><span class="txt-lh ftx-01"><?php echo $this->_var['user_info']['surplus']; ?><?php echo $this->_var['lang']['renmingni']; ?></span></div>
                        </div>
                        <div class="item">
                            <div class="label"><?php echo $this->_var['lang']['bank']; ?>：</div>
                            <div class="value"><span class="txt-lh"><?php echo $this->_var['validate_info']['bank_name']; ?></span></div>
                        </div>
                        <div class="item">
                            <div class="label"><?php echo $this->_var['lang']['bank_card']; ?>：</div>
                            <div class="value"><span class="txt-lh"><?php echo $this->_var['validate_info']['bank_card']; ?></span></div>
                        </div>
                        <div class="item">
                            <div class="label"><em class="red">*</em><?php echo $this->_var['lang']['repay_money']; ?>：</div>
                            <div class="value">
                                <input type="text" name="amount" class="text text-2" ectype="deposit_amout"/>
                                <span class="ts"><?php echo $this->_var['lang']['yuan']; ?><?php echo $this->_var['lang']['renmingni']; ?><?php if ($this->_var['buyer_cash'] > 0): ?><?php echo $this->_var['lang']['forward_total_lowest']; ?><?php echo $this->_var['buyer_cash']; ?><?php echo $this->_var['lang']['yuan']; ?><?php endif; ?></span>
                                <div class="form_prompt"></div>
                            </div>
                        </div>
						 <div class="item hide" ectype="deposit_fee">
                            <div class="label"><?php echo $this->_var['lang']['forward_pay_fee']; ?>：</div>
                            <div class="value"><span class="txt-lh" ectype="deposit_fee_value"></span><input type="hidden" value="" name="deposit_money" /></div>
                        </div>
                        <div class="item">
                            <div class="label"><?php echo $this->_var['lang']['process_notic']; ?>：</div>
                            <div class="value">
                                <textarea name="user_note" class="text text-2" style="height:100px; line-height:20px; padding-top:3px; padding-bottom:3px;"></textarea>
                            </div>
                        </div>
                        
                        <?php if ($this->_var['enabled_sms_signin']): ?>
                        <div class="item">
                            <div class="label"><em class="red">*</em><?php echo $this->_var['lang']['label_mobile']; ?>：</div>
                            <div class="value">
                                <span class="txt-lh ftx-01"><?php echo $this->_var['validate_info']['bank_mobile']; ?></span>
                                <input class="text text-1" type="hidden" id="mobile_phone" name="mobile_phone" value="<?php echo $this->_var['validate_info']['bank_mobile']; ?>">
                                <span id="span-phone-modify" class="error-text" style="display: none;"><?php echo $this->_var['lang']['label_mobile_input']; ?></span>
                                <div class="form_prompt"></div>
                            </div>
                        </div>
                        
                        <div class="item">
                            <div class="label"><em class="red">*</em><?php echo $this->_var['lang']['bindMobile_code']; ?>：</div>
                            <div class="value">
                                <div class="sm-input">
                                    <input name="sms_value" id="sms_value" type="hidden" value="sms_code" />
                                    <input type="text" name="mobile_code" tabindex="1" id="mobile_code" />
                                    <a href="javascript:sendSms()" id="zphone" class="sms-btn"><?php echo $this->_var['lang']['getMobile_code']; ?></a>
                                </div>
                                <div class="form_prompt" id="phone_notice"></div>
                            </div>
                        </div>
                        <?php endif; ?>
                        
                        <div class="item item-button">
                            <div class="label">&nbsp;</div>
                            <div class="value">
                                <input id="flag" type="hidden" value="account_raply" name="flag">
                                <input id="seccode" type="hidden" value="<?php echo $this->_var['sms_security_code']; ?>" name="seccode">
                                <input type="hidden" name="surplus_type" value="1" />
                                <input type="hidden" name="act" value="act_account" />
                                <input type="hidden" name="sc_guid" value="<?php echo $this->_var['sc_guid']; ?>">
                                <input type="hidden" name="sc_rand" value="<?php echo $this->_var['sc_rand']; ?>">
								<input type="hidden" value="<?php echo $this->_var['deposit_fee']; ?>" name="deposit_fee" />
                                <input type="hidden" value="<?php echo $this->_var['buyer_cash']; ?>" name="buyer_cash" />
                                <input type="submit" class="sc-btn sc-redBg-btn" value="<?php echo $this->_var['lang']['Application_withdrawal']; ?>" id="submitBtn" />
                                <input type="reset" class="sc-btn sc-redBg-btn" value="<?php echo $this->_var['lang']['Reset_Form']; ?>" />
                                <div class="form_prompt"></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php endif; ?>
        
        <?php if ($this->_var['action'] == "act_account"): ?>
        <div class="user-mod">
            <div class="user-title">
                <h3><?php echo $this->_var['lang']['Recharge_info']; ?></h3>
            </div>
            <table class="user-table user-table-valueCard">
                <colgroup>
                    <col width="200">
                    <col width="150">
                    <col width="150">
                    <col width="120">
                    <col>
                </colgroup>
                <thead>
                    <tr>
                        <th class="tc"><?php echo $this->_var['lang']['deposit_money']; ?></th>
                        <th><?php echo $this->_var['lang']['payment']; ?></th>
                        <th><?php echo $this->_var['lang']['pay_fee']; ?></th>
                        <th><?php echo $this->_var['lang']['handle']; ?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="tc"><?php echo $this->_var['amount']; ?></td>
                        <td class="tc"><?php echo $this->_var['payment']['pay_name']; ?></td>
                        <td class="tc"><?php echo $this->_var['pay_fee']; ?></td>
                        <td class="tc"><div class="or-btn"><?php if ($this->_var['payment']['pay_button'] != ""): ?><?php echo $this->_var['payment']['pay_button']; ?><?php else: ?>&nbsp;<?php endif; ?></div></td>
                    </tr>
                    <tr>
                        <td colspan="4" class="td td_bf">
                            <h1><?php echo $this->_var['lang']['describe']; ?>：</h1>
                            <span><?php echo $this->_var['payment']['pay_desc']; ?></span>						
                        </td>
                    </tr>					
                </tbody>
            </table>
        </div> 
        <script type="text/javascript">
            var timer;
            function checkOrder(){
                var log_id = '<?php echo empty($this->_var['order']['log_id']) ? '0' : $this->_var['order']['log_id']; ?>';
                var pay_code = '<?php echo empty($this->_var['payment_info']['pay_code']) ? '0' : $this->_var['payment_info']['pay_code']; ?>';
                
                if(pay_code == 'wxpay'){
                    var url = "user.php?act=checkorder&log_id=" + log_id+ "&pay_code=" + pay_code;
                    $.get(url, {}, function(data){
                        //已付款
                        if(data.code == 1){
                            clearTimeout(timer);
                            location.href = "user.php?act=account_deposit";
                        }
                    },'json');
                    timer = setTimeout("checkOrder()", 5000);
                }
            }
            checkOrder();              
        </script> 
        <?php endif; ?>
        	

        
        <?php if ($this->_var['action'] == 'baitiao' || $this->_var['action'] == 'baitiao_pay_log'): ?>
        <div class="user-mod">
                <div class="user-title width_860 fl">
                    <h2><?php echo $this->_var['lang']['baitiao']; ?></h2>
                </div>
                <div class="user-baitiao-info width_860 fl">
                    <div>
                        <div class="u-b-top fl">
                            <strong class="u-b-t-tit"><?php echo $this->_var['lang']['Pending_payment']; ?>：</strong>
                            <span><em id="number"><?php echo $this->_var['repay_bt']['numbers']; ?></em><?php echo $this->_var['lang']['zhang']; ?></span>
                        </div>
                        <div class="u-b-top fl">
                            <strong class="u-b-t-tit"><?php echo $this->_var['lang']['already_amount']; ?>：</strong>
                            <span><em id="price"><?php echo empty($this->_var['repay_bt']['format_already_amount']) ? '0' : $this->_var['repay_bt']['format_already_amount']; ?></em></span>
                        </div>
                        <div class="u-b-top fl">
                            <strong class="u-b-t-tit"><?php echo $this->_var['lang']['stay_pay']; ?>：</strong>
                            <span><em id="price"><?php echo empty($this->_var['repay_bt']['format_stay_pay']) ? '0' : $this->_var['repay_bt']['format_stay_pay']; ?></em></span>
                        </div>
                    </div>
                    
                    <div class="u-b-bot fl">
                        <div class="user-frame-items">
                            <div class="item">
                                <span><?php echo $this->_var['lang']['bt_Total_amount']; ?></span>
                                <span class="b-price"><?php echo $this->_var['bt_info']['amount']; ?></span>
                            </div>
                            <div class="item">
                                <span><?php echo $this->_var['lang']['Surplus_baitiao']; ?></span>
                                <span class="b-price"><?php echo empty($this->_var['repay_bt']['balance']) ? '0' : $this->_var['repay_bt']['balance']; ?></span>
                            </div>
                            <div class="item">
                                <span><?php echo $this->_var['lang']['also_day']; ?><?php if ($this->_var['bt_info']['over_repay_trem']): ?>（<?php echo $this->_var['lang']['also_delay']; ?>）<?php endif; ?></span>
                                <span class="b-price"><?php echo $this->_var['bt_info']['repay_term']; ?>&nbsp;<?php echo $this->_var['lang']['day']; ?><?php if ($this->_var['bt_info']['over_repay_trem']): ?>（<?php echo $this->_var['bt_info']['over_repay_trem']; ?>&nbsp;<?php echo $this->_var['lang']['day']; ?>）<?php endif; ?></span>
                            </div>
                            <div class="item">
                                <span><?php echo $this->_var['lang']['amount_paid']; ?></span>
                                <span class="b-price"><?php echo empty($this->_var['repay_bt']['stay_pay']) ? '0' : $this->_var['repay_bt']['stay_pay']; ?></span>
                            </div>
                        </div>        
                    </div>
                </div>
            
                <div class="user-title mt30 width_860 fl">
                    <ul class="tabs">
                        <li <?php if ($this->_var['action'] == 'baitiao'): ?>class="active"<?php endif; ?>><a href="user.php?act=baitiao"><?php echo $this->_var['lang']['Transaction_detail']; ?></a></li>
                        <li <?php if ($this->_var['action'] == 'baitiao_pay_log'): ?>class="active"<?php endif; ?>><a href="user.php?act=baitiao_pay_log"><?php echo $this->_var['lang']['repayment_record']; ?></a></li>
                    </ul>
                </div>
            
                <?php if ($this->_var['action'] == 'baitiao'): ?>
                <div class="user-baitiao-list">
                    <table class="user-table user-table-baitiao">
                        <colgroup>
                            <col width="200">
                            <col width="140">
                            <col width="140">
                            <col width="140">
                            <col width="125">
                            <col>
                        </colgroup>
                        <thead>
                            <tr>
                                <th><?php echo $this->_var['lang']['baitiao_order']; ?></th>
                                <th><?php echo $this->_var['lang']['Consumer_account_day']; ?></th>
                                <th><?php echo $this->_var['lang']['label_bt_one']; ?></th>
                                <th><?php echo $this->_var['lang']['label_bt_two']; ?></th>
                                <th><?php echo $this->_var['lang']['also_amount']; ?></th>
                                <th><?php echo $this->_var['lang']['operation']; ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $_from = $this->_var['bt_logs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'bt_log');if (count($_from)):
    foreach ($_from AS $this->_var['bt_log']):
?>
                            <tr>
                                <td>
                                    <a href="user.php?act=order_detail&order_id=<?php echo $this->_var['bt_log']['order_id']; ?>" target="_blank" class="ftx-05">
                                    <?php echo $this->_var['bt_log']['order_sn']; ?>
                                    </a>
                                    
                                    <br/><a href="user.php?act=baitiao_pay_log&log_id=<?php echo $this->_var['bt_log']['log_id']; ?>" class="sc-btn"><?php echo $this->_var['lang']['view_repayment_record']; ?></a>
                                </td>
                                <td class="tc">
                                    <?php echo $this->_var['bt_log']['use_date']; ?>
                                    <?php if ($this->_var['bt_log']['is_stages']): ?>
                                        (<?php echo $this->_var['lang']['by_stages']; ?>)
                                    <?php endif; ?>
                                </td>
                                <td class="tc">
                                    <?php echo $this->_var['bt_log']['repay_date']; ?>
                                    <?php if ($this->_var['bt_log']['is_stages']): ?>
                                        <br/><?php echo $this->_var['bt_log']['yes_num']; ?><?php echo $this->_var['lang']['stage']; ?>/<?php echo $this->_var['bt_log']['stages_total']; ?><?php echo $this->_var['lang']['stage']; ?>
                                    <?php endif; ?>
                                </td>
                                <td class="tc"><?php if ($this->_var['bt_log']['repayed_date']): ?><?php echo $this->_var['bt_log']['repayed_date']; ?><?php endif; ?></td>
                                <td class="tc">
                                    <?php if ($this->_var['bt_log']['order_amount']): ?>
                                      <?php if ($this->_var['bt_log']['is_stages']): ?>
                                        <?php echo $this->_var['bt_log']['stages_one_price']; ?><?php echo $this->_var['lang']['element']; ?>/<?php echo $this->_var['lang']['stage']; ?>
                                    <?php else: ?>
                                        <?php echo $this->_var['bt_log']['order_amount']; ?>
                                      <?php endif; ?>
                                    <?php endif; ?>
                                </td>
                                <td class="tc">
                                    <?php if ($this->_var['bt_log']['is_refund'] == 1): ?>
                                        <span class="ftx-03"><?php echo $this->_var['lang']['refound']; ?></span>
                                    <?php elseif ($this->_var['bt_log']['is_repay'] == 1): ?>
                                        <span class="ftx-01"><?php echo $this->_var['lang']['Has_paid_off']; ?></span>
                                    <?php else: ?>
                                        <a href="user.php?act=repay_bt&order_id=<?php echo $this->_var['bt_log']['order_id']; ?>&pay_id=<?php echo $this->_var['bt_log']['pay_id']; ?>&stages_num=<?php echo empty($this->_var['bt_log']['stages_num']) ? '0' : $this->_var['bt_log']['stages_num']; ?>" class="sc-btn" target="_blank"><?php echo $this->_var['lang']['repayment']; ?></a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                        </tbody>
                    </table>
                </div>
                <?php echo $this->fetch('library/pages.lbi'); ?>
                <?php endif; ?>
                
                <?php if ($this->_var['action'] == 'baitiao_pay_log'): ?>
                <div class="user-baitiao-list">
                    <table class="user-table user-table-baitiao">
                        <colgroup>
                            <col width="100">
                            <col width="200">
                            <col width="140">
                            <col width="140">
                            <col width="165">
                            <col>
                        </colgroup>
                        <thead>
                            <tr>
                                <th><?php echo $this->_var['lang']['record_id']; ?></th>
                                <th><?php echo $this->_var['lang']['order_number']; ?></th>
                                <th><?php echo $this->_var['lang']['dijiqi']; ?></th>
                                <th><?php echo $this->_var['lang']['also_amount']; ?></th>
                                <th><?php echo $this->_var['lang']['also_state']; ?></th>
                                <th><?php echo $this->_var['lang']['also_time']; ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $_from = $this->_var['pay_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'list');if (count($_from)):
    foreach ($_from AS $this->_var['list']):
?>
                            <tr>
                                <td><?php echo $this->_var['list']['id']; ?></td>
                                <td class="tc">
                                    <?php echo $this->_var['list']['order_sn']; ?>
                                </td>
                                <td class="tc">
                                    <?php echo $this->_var['list']['stages_num']; ?>/<?php echo $this->_var['lang']['qi']; ?>
                                </td>
                                <td class="tc"><?php echo $this->_var['list']['stages_price']; ?></td>
                                <td class="tc">
                                	<?php if ($this->_var['list']['is_pay']): ?>
                                    	<?php echo $this->_var['lang']['also_pay']['is_pay']; ?>
                                    <?php else: ?>
                                    	<?php echo $this->_var['lang']['also_pay']['not_pay']; ?>
                                    <?php endif; ?>
                                </td>
                                <td class="tc">
                                <?php if ($this->_var['list']['pay_time']): ?>
                                <?php echo $this->_var['list']['pay_time']; ?>
                                <?php else: ?>
                                <a href="user.php?act=repay_bt&order_id=<?php echo $this->_var['list']['order_id']; ?>&pay_id=<?php echo $this->_var['list']['pay_id']; ?>&stages_num=<?php echo empty($this->_var['list']['stages_num']) ? '0' : $this->_var['list']['stages_num']; ?>" class="sc-btn" target="_blank"><?php echo $this->_var['lang']['repayment']; ?></a> 
                                <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                        </tbody>
                    </table>
                </div>
                <?php echo $this->fetch('library/pages.lbi'); ?>
                <?php endif; ?>
         </div>
        <?php endif; ?>
        	
        
        
        <?php if ($this->_var['action'] == 'repay_bt'): ?>
        <div class="user-mod">
            <div class="user-item-temp">
                <div class="user-title">
                    <h2><?php echo $this->_var['lang']['repay_bt']; ?></h2>
                </div>
                <div class="user-baitiao-hk">
                    <div class="user-items">
                    	<div class="item">
                            <div class="label"><?php echo $this->_var['lang']['order_number']; ?>：</div>
                            <div class="value"><span class="txt-lh"><?php echo $this->_var['order']['order_sn']; ?></span></div>
                        </div>
                        <div class="item">
                            <div class="label"><?php echo $this->_var['lang']['label_bt_one']; ?>：</div>
                            <div class="value"><span class="txt-lh"><?php echo $this->_var['stages_info']['repay_date']; ?></span></div>
                        </div>
                        <div class="item">
                            <div class="label"><?php echo $this->_var['lang']['dijiqi']; ?>：</div>
                            <div class="value"><span class="txt-lh"><?php echo empty($this->_var['stages_num']) ? '0' : $this->_var['stages_num']; ?>/<?php echo $this->_var['lang']['qi']; ?></span></div>
                        </div>
                        <?php if ($this->_var['stages_info']['is_stages'] == 1): ?>
                        <div class="item">
                            <div class="label"><?php echo $this->_var['lang']['Number_periods']; ?>：</div>
                            <div class="value"><span class="txt-lh"><?php echo $this->_var['stages_info']['yes_num']; ?><?php echo $this->_var['lang']['stage']; ?>/<?php echo $this->_var['stages_info']['stages_total']; ?><?php echo $this->_var['lang']['stage']; ?></span></div>
                        </div>
                        <?php endif; ?>
                        <?php if ($this->_var['stages_info']['is_stages'] == 1): ?>
                        <div class="item">
                            <div class="label"><?php echo $this->_var['lang']['rate']; ?>：</div>
                            <div class="value"><span class="txt-lh"><?php if ($this->_var['stages_info']['stages_total'] == 1): ?>0%<?php else: ?><?php echo $this->_var['stages_rate']; ?>%<?php endif; ?></span></div>
                        </div>
                        <?php endif; ?>
                        <div class="item">
                            <div class="label"><?php echo $this->_var['lang']['amount_payable']; ?>：</div>
                            <div class="value">
                                <?php if ($this->_var['stages_info']['is_stages'] == 1): ?>
                                <span class="ftx-01 txt-lh"><?php echo $this->_var['stages_info']['format_stages_one_price']; ?></span>
                                <?php else: ?>
                                <span class="ftx-01 txt-lh"><?php echo $this->_var['order']['order_amount']; ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php if ($this->_var['payment_list']): ?>
                        <form name="payment" method="post" action="user.php" >
                        <div class="item">
                            <div class="label"><?php echo $this->_var['lang']['payment']; ?>：</div>
                            <div class="value mt5">
                                <select name="pay_id" class="select fl">
                                    <?php $_from = $this->_var['payment_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'payment');if (count($_from)):
    foreach ($_from AS $this->_var['payment']):
?>
                                    <option value="<?php echo $this->_var['payment']['pay_id']; ?>">
                                        <?php echo $this->_var['payment']['pay_name']; ?>(<?php echo $this->_var['lang']['pay_fee']; ?>:<?php echo $this->_var['payment']['format_pay_fee']; ?>)
                                    </option>
                                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                </select>
                                <input type="hidden" name="act" value="repay_bt" />
                                <input type="hidden" name="order_id" value="<?php echo $this->_var['order']['order_id']; ?>" />
                                <input type="hidden" name="stages_num" value="<?php echo empty($this->_var['stages_num']) ? '0' : $this->_var['stages_num']; ?>" />
                                <input type="submit" name="Submit" class="btn sc-redBg-btn btn30 fl ml10" value="<?php echo $this->_var['lang']['button_submit']; ?>" />
                            </div>
                        </div>
                        <div class="item">
                            <div class="label">&nbsp;</div>
                            <div class="value"><div class="pay_btn"><?php echo $this->_var['order']['pay_online']; ?></div></div>
                        </div>
                        </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
		var timer;
		function checkOrder(){
			var baitiao_id = '<?php echo empty($this->_var['stages_info']['baitiao_id']) ? '0' : $this->_var['stages_info']['baitiao_id']; ?>';
			var log_id = '<?php echo empty($this->_var['stages_info']['log_id']) ? '0' : $this->_var['stages_info']['log_id']; ?>';
			var stages_num = '<?php echo empty($this->_var['stages_num']) ? '0' : $this->_var['stages_num']; ?>';
			var pay_code = '<?php echo empty($this->_var['payment_info']['pay_code']) ? '0' : $this->_var['payment_info']['pay_code']; ?>';
			
			if(pay_code == 'wxpay'){
				var url = "user.php?act=checkorder&baitiao_id=" +baitiao_id+ "&log_id=" + log_id+ "&stages_num=" + stages_num + "&pay_code=" + pay_code;
				$.get(url, {}, function(data){
					//已付款
					if(data.code == 1){
						clearTimeout(timer);
						location.href = "user.php?act=baitiao";
					}
				},'json');
				timer = setTimeout("checkOrder()", 5000);
			}
			
		}
        checkOrder();
        </script>
        <?php endif; ?>
        	
        
        
        <?php if ($this->_var['action'] == 'merchants_upgrade'): ?>
        <div class="user-mod">
            <div class="user-title">
                <h2><?php echo $this->_var['lang']['store_grade_list']; ?></h2>
				<ul class="tabs">
                    <li class="active"><a href="user.php?act=merchants_upgrade"><?php echo $this->_var['lang']['store_grade_list']; ?></a></li>
                    <li><a href="user.php?act=merchants_upgrade_log"><?php echo $this->_var['lang']['merchants_upgrade_log']; ?></a></li>
                </ul>
            </div>
            <div class="user-shop-warp">
                <table class="user-table user-table-shop">
                    <colgroup>
                        <col width="150">
                        <col width="80">
                        <col width="80">
                        <col width="150">
                        <col width="230">
                        <col width="80">
                        <col>
                    </colgroup>
                    <thead>
                        <tr>
                            <th><?php echo $this->_var['lang']['grade_name']; ?></th>
                            <th><?php echo $this->_var['lang']['good_number']; ?></th>
                            <th><?php echo $this->_var['lang']['temp_number']; ?></th>
                            <th><?php echo $this->_var['lang']['grade_introduce']; ?></th>
                            <th><?php echo $this->_var['lang']['entry_criteria']; ?></th>
                            <th><?php echo $this->_var['lang']['grade_img']; ?></th>
                            <th><?php echo $this->_var['lang']['handle']; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $_from = $this->_var['seller_grade']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from AS $this->_var['item']):
        $this->_foreach['name']['iteration']++;
?>
                         <tr>
                            <td><i class="user-rank user-rank-<?php echo $this->_foreach['name']['iteration']; ?>"></i><span class="user-rank-span"><?php echo $this->_var['item']['grade_name']; ?></span></td>
                            <td class="tc"><?php echo $this->_var['item']['goods_sun']; ?>个</td>
                            <td class="tc"><?php echo $this->_var['item']['seller_temp']; ?>个</td>
                            <td class="tc"><?php echo $this->_var['item']['grade_introduce']; ?></td>
                            <td class="tc"><?php echo $this->_var['item']['entry_criteria']; ?></td>
                            <td class="tc"><?php if ($this->_var['item']['grade_img']): ?><a href="<?php echo $this->_var['item']['grade_img']; ?>"  title="<?php echo $this->_var['lang']['grade_img']; ?>" target="_blank"><img src="<?php echo $this->_var['item']['grade_img']; ?>" width="30" height="30"></a><?php endif; ?></td>
                            <td class="tc">
                                <?php if ($this->_var['item']['id'] == $this->_var['grade_id']): ?>
                                    <a href="javascript:void(0);" class="sc-btn sc-btn-disabled"><?php echo $this->_var['lang']['now_grade']; ?></a>
                                <?php else: ?>        
                                    <?php if ($this->_var['is_expiry']): ?>   
                                    <a href="user.php?act=application_grade&grade_id=<?php echo $this->_var['item']['id']; ?>" class="sc-btn"><?php echo $this->_var['lang']['once']; ?></a>
                                    <?php else: ?>
                                    <span><?php echo $this->_var['lang']['not_to_apply']; ?></span>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <script type="text/javascript">
        $(function(){
			checkOrder();
		});
		
		var timer;
		function checkOrder(){
			var baitiao_id = '<?php echo empty($this->_var['stages_info']['baitiao_id']) ? '0' : $this->_var['stages_info']['baitiao_id']; ?>';
			var log_id = '<?php echo empty($this->_var['stages_info']['log_id']) ? '0' : $this->_var['stages_info']['log_id']; ?>';
			var stages_num = '<?php echo empty($this->_var['stages_num']) ? '0' : $this->_var['stages_num']; ?>';
			var pay_code = '<?php echo empty($this->_var['payment_info']['pay_code']) ? '0' : $this->_var['payment_info']['pay_code']; ?>';
			
			if(pay_code == 'wxpay'){
				var url = "user.php?act=checkorder&baitiao_id=" +baitiao_id+ "&log_id=" + log_id+ "&stages_num=" + stages_num + "&pay_code=" + pay_code;
				$.get(url, {}, function(data){
					//已付款
					if(data.code == 1){
						clearTimeout(timer);
						location.href = "user.php?act=baitiao";
					}
				},'json');
				timer = setTimeout("checkOrder()", 5000);
			}
			
		}
        </script>
        <?php endif; ?>
        
        
        
        <?php if ($this->_var['action'] == 'merchants_upgrade_log'): ?>
        <div class="user-mod">
            <div class="user-title">
                <h2><?php echo $this->_var['lang']['store_grade_list']; ?></h2>
				<ul class="tabs">
                    <li><a href="user.php?act=merchants_upgrade"><?php echo $this->_var['lang']['store_grade_list']; ?></a></li>
                    <li class="active"><a href="user.php?act=merchants_upgrade_log"><?php echo $this->_var['lang']['merchants_upgrade_log']; ?></a></li>
                </ul>
            </div>
            <div class="user-shop-warp">
                <table class="user-table user-table-shop">
                    <colgroup>
                        <col width="150">
                        <col width="90">
                        <col width="80">
                        <col width="120">
                        <col width="150">
						<col width="100">
                        <col width="80">
                        <col>
                    </colgroup>
                    <thead>
                        <tr>
                            <th><?php echo $this->_var['lang']['lab_card_id']; ?></th>
                            <th><?php echo $this->_var['lang']['affiliate_lever']; ?></th>
                            <th><?php echo $this->_var['lang']['money']; ?></th>
							<th><?php echo $this->_var['lang']['payment']; ?></th>
							<th><?php echo $this->_var['lang']['apply_time']; ?></th>
							<th><?php echo $this->_var['lang']['apply_status']; ?></th>
                            <th><?php echo $this->_var['lang']['handle']; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $_from = $this->_var['merchants_upgrade_log']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'list');$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from AS $this->_var['list']):
        $this->_foreach['name']['iteration']++;
?>
                         <tr>
                            <td><a href='merchants_upgrade.php?act=edit&apply_id=<?php echo $this->_var['list']['apply_id']; ?>&grade_id=<?php echo $this->_var['list']['grade_id']; ?>'><?php echo htmlspecialchars($this->_var['list']['apply_sn']); ?></a></td>
                            <td class="tc"><?php echo htmlspecialchars($this->_var['list']['grade_name']); ?></td>
                            <td class="tc"><?php echo htmlspecialchars($this->_var['list']['total_amount']); ?></td>
                            <td class="tc"><?php echo $this->_var['list']['pay_name']; ?></td>
                            <td class="tc"><?php echo $this->_var['list']['add_time']; ?></td>
                            <td class="tc"><?php echo $this->_var['list']['status_paid']; ?><br><?php echo $this->_var['list']['status_apply']; ?></td>
                            <td class="tc">
                                <a href="user.php?act=application_grade_edit&apply_id=<?php echo $this->_var['list']['apply_id']; ?>&grade_id=<?php echo $this->_var['list']['grade_id']; ?>" class="sc-btn<?php if ($this->_var['list']['apply_status'] == 3 || $this->_var['list']['pay_status'] == 0): ?> mr0<?php endif; ?>" title="<?php if ($this->_var['list']['apply_status'] == 0 && $this->_var['list']['pay_status'] == 0): ?><?php echo $this->_var['lang']['edit']; ?><?php else: ?><?php echo $this->_var['lang']['view']; ?><?php endif; ?>"><?php if ($this->_var['list']['apply_status'] == 0 && $this->_var['list']['pay_status'] == 0): ?><?php echo $this->_var['lang']['edit']; ?><?php else: ?><?php echo $this->_var['lang']['view']; ?><?php endif; ?></a>
                                <?php if ($this->_var['list']['apply_status'] == 3 || $this->_var['list']['pay_status'] == 0): ?>
                                <a href="user.php?act=remove_apply_info&id=<?php echo $this->_var['list']['apply_id']; ?>" title="<?php echo $this->_var['lang']['drop']; ?>" class="sc-btn mt10"><?php echo $this->_var['lang']['drop']; ?></a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php endif; ?>
               
		
        
        <?php if ($this->_var['action'] == 'application_grade' || $this->_var['action'] == 'application_grade_edit'): ?>
        <div class="user-mod user-profile">
            <form action="user.php" method="post" name="grade_theForm"  enctype="multipart/form-data">
                <div class="user-account-warp">
                	<?php if ($this->_var['seller_apply_info']['apply_status'] != 1): ?>
                    <div class="user-title">
                        <h2><?php echo $this->_var['lang']['examine_info']; ?></h2>
                        <a href="user.php?act=merchants_upgrade" class="more"><?php echo $this->_var['lang']['back']; ?></a>
                    </div>
                    <div class="user-grade-warp">
                        <div class="user-items">
                        	<div class="item">
                            	<div class="label"><?php echo $this->_var['lang']['apply_seller_Grade']; ?>：</div>
                                <div class="value"><span class="txt-lh"><?php echo $this->_var['grade_name']; ?></span></div>
                            </div>
                            <?php if ($this->_var['action'] == 'application_grade_edit'): ?>
                            <div class="item">
                                <div class="label"><?php echo $this->_var['lang']['adopt_status']; ?>：</div>
                                <div class="value">
                                	<?php if ($this->_var['seller_apply_info']['apply_status'] == 0): ?>
                                    <span class="txt-lh red"><?php echo $this->_var['lang']['not_audited']; ?></span>
                                    <?php elseif ($this->_var['seller_apply_info']['apply_status'] == 2): ?>
                                    <span class="txt-lh red"><?php echo $this->_var['lang']['audited_not_adopt']; ?></span>
                                    <?php elseif ($this->_var['seller_apply_info']['apply_status'] == 3): ?>
                                    <span class="txt-lh red"><?php echo $this->_var['lang']['invalid_input']; ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php if ($this->_var['seller_apply_info']['apply_status'] == 2 || $this->_var['seller_apply_info']['apply_status'] == 3): ?>
                            <div class="item">
                                <div class="label"><?php echo $this->_var['lang']['not_adopt_reason']; ?>：</div>
                                <div class="value"><span class="txt-lh"><?php echo $this->_var['seller_apply_info']['reply_seller']; ?></span></div>
                            </div>
							<div class="item">
                                <div class="label"><?php echo $this->_var['lang']['Prompt']; ?>：</div>
                                <div class="value">
                                	<?php if ($this->_var['seller_apply_info']['apply_status'] == 2): ?>
                                	<span class="txt-lh red"><?php echo $this->_var['lang']['not_adopt_reason_Prompt']['0']; ?></span>
                                    <?php elseif ($this->_var['seller_apply_info']['apply_status'] == 3): ?>
                                    <span class="txt-lh red"><?php echo $this->_var['lang']['not_adopt_reason_Prompt']['1']; ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
							<?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if ($this->_var['seller_grade']): ?>
                    <div class="user-title">
                        <h2><?php echo $this->_var['lang']['grade_info']; ?></h2>
                        <?php if ($this->_var['seller_apply_info']['apply_status'] == 1): ?><a href="user.php?act=merchants_upgrade" class="more"><?php echo $this->_var['lang']['back']; ?></a><?php endif; ?>
                    </div>
                    <div class="user-grade-warp">
                        <div class="user-items">
                            <div class="item">
                                <div class="label"><?php echo $this->_var['lang']['now_grade']; ?>：</div>
                                <div class="value"><span class="txt-lh"><?php echo $this->_var['seller_grade']['grade_name']; ?></span></div>
                            </div>
                            <div class="item">
                                <div class="label"><?php echo $this->_var['lang']['in_time']; ?>：</div>
                                <div class="value">
                                    <span class="txt-lh"><?php echo $this->_var['seller_grade']['addtime']; ?></span>
                                </div>
                            </div>
                            <div class="item">
                                <div class="label"><?php echo $this->_var['lang']['end_time']; ?>：</div>
                                <div class="value">
                                    <span class="txt-lh"><?php echo $this->_var['seller_grade']['end_time']; ?></span>
                                </div>
                            </div>
                            <?php if ($this->_var['seller_grade']['refund_price'] > 0 || $this->_var['seller_apply_info']['refund_price'] > 0): ?>
                            <div class="item">
                                <div class="label"><?php echo $this->_var['lang']['refund_grade']; ?>：</div>
                                <div class="value">
                                    <span class="txt-lh total">￥<em><?php if ($this->_var['seller_apply_info']['refund_price']): ?><?php echo $this->_var['seller_apply_info']['refund_price']; ?><?php else: ?><?php echo $this->_var['seller_grade']['refund_price']; ?><?php endif; ?></em></span>
                                    <input type="hidden" value="<?php if ($this->_var['seller_apply_info']['refund_price']): ?><?php echo $this->_var['seller_apply_info']['refund_price']; ?><?php else: ?><?php echo $this->_var['seller_grade']['refund_price']; ?><?php endif; ?>" name='refund_price'/>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
					</div>
                    <?php endif; ?>
                    
                    <?php $_from = $this->_var['entry_criteriat_info']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'info');if (count($_from)):
    foreach ($_from AS $this->_var['info']):
?>
                    <?php if ($this->_var['info']['child']): ?>
                    <div class="user-title">
                        <h2><?php echo $this->_var['info']['criteria_name']; ?></h2>
                    </div>
                    <div class="user-grade-warp">
                        <div class="user-items">
                            <?php $_from = $this->_var['info']['child']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'child');if (count($_from)):
    foreach ($_from AS $this->_var['child']):
?>
                            <div class="item">
                                <div class="label"><i class="red"><?php if ($this->_var['child']['is_mandatory'] == 1): ?>*&nbsp;<?php endif; ?></i><?php echo $this->_var['child']['criteria_name']; ?>：</div>
                                <?php if ($this->_var['child']['type'] == 'text'): ?>
                                <div class="value">
                                    <input type="text" name='value[<?php echo $this->_var['child']['id']; ?>]' class="text text-1" value="<?php echo $this->_var['apply_criteria'][$this->_var['child']['id']]; ?>"/>
                                    <div class="notic value[<?php echo $this->_var['child']['id']; ?>]"></div>
                                </div>
                                <?php elseif ($this->_var['child']['type'] == 'select'): ?>
                                <div class="value">
                                    <div class="imitate_select">
                                        <div class="cite"><span><?php echo $this->_var['lang']['please_select']; ?></span><i class="iconfont icon-down"></i></div>
                                        <ul>
                                            <li><a href="javascript:void(0);" data-value="0"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['0']; ?></a></li>
                                            <?php $_from = $this->_var['child']['option_value']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'value');if (count($_from)):
    foreach ($_from AS $this->_var['value']):
?>
                                            <li><a href="javascript:void(0);" data-value="<?php echo $this->_var['value']; ?>"><?php echo $this->_var['value']; ?></a></li>
                                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                        </ul>
                                        <input name='value[<?php echo $this->_var['child']['id']; ?>]' type="hidden" value="<?php echo $this->_var['apply_criteria'][$this->_var['child']['id']]; ?>">
                                    </div>
                                    <div class="notic value[<?php echo $this->_var['child']['id']; ?>]"></div>
                                </div>
                                <?php elseif ($this->_var['child']['type'] == 'textarea'): ?>
                                <div class="value">
                                    <textarea class="textarea textarea2" name='value[<?php echo $this->_var['child']['id']; ?>]'><?php echo $this->_var['apply_criteria'][$this->_var['child']['id']]; ?></textarea>
                                    <div class="notic value[<?php echo $this->_var['child']['id']; ?>]"></div>
                                </div>
                                <?php elseif ($this->_var['child']['type'] == 'file'): ?>
                                <div class="value">
                                    <div class="value-file">
                                        <input class="btn fl" value="<?php echo $this->_var['lang']['Select_file']; ?>" type="button">
                                        <?php if ($this->_var['apply_criteria'][$this->_var['child']['id']]): ?>
                                        <a href="<?php echo $this->_var['apply_criteria'][$this->_var['child']['id']]; ?>" class="nyroModal fl ml10 mt3"><i class="iconfont icon-picture" onmouseover="toolTip('<img src=<?php echo $this->_var['apply_criteria'][$this->_var['child']['id']]; ?>>')" onmouseout="toolTip()"></i></a>
                                        <?php endif; ?>
                                        <input name="" id="value[<?php echo $this->_var['child']['id']; ?>]" class="txt fl" type="text">
                                        <input name="value[<?php echo $this->_var['child']['id']; ?>]" class="file fl" id="fileField" size="28" onchange="document.getElementById('value[<?php echo $this->_var['child']['id']; ?>]').value=this.value" type="file" value="<?php echo $this->_var['apply_criteria'][$this->_var['child']['id']]; ?>">
                                        <input type="hidden" value="<?php echo $this->_var['child']['id']; ?>" name='file_id[]'>
										<input type="hidden" value="<?php echo $this->_var['apply_criteria'][$this->_var['child']['id']]; ?>" name='file_url[<?php echo $this->_var['child']['id']; ?>]'/>
                                        <div class="notic value[<?php echo $this->_var['child']['id']; ?>]"></div>
                                    </div>
                                </div>
                                <?php elseif ($this->_var['child']['type'] == 'charge' && $this->_var['child']['charge'] > 0): ?>
                                <div class="value">
                                    <span class="total txt-lh red">￥<?php echo $this->_var['child']['charge']; ?>/<?php echo $this->_var['lang']['year']; ?></span>
                                </div>
                                <?php endif; ?>
                            </div>
                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    
                    <?php if ($this->_var['entry_criteriat_info']['count_charge'] > 0): ?>
                    <div class="user-title">
                        <h2><?php echo $this->_var['lang']['information_count']; ?></h2>
                    </div>
                    <div class="user-grade-warp">
                        <div class="user-items">
                            <div class="item">
                                <div class="label"><?php echo $this->_var['lang']['settled_down']; ?>：</div>
                                <div class="value">
                                    <div class="amount-warp mt5">
                                        <input class="buy-num" id="quantity" value="<?php if ($this->_var['seller_apply_info']['fee_num']): ?><?php echo $this->_var['seller_apply_info']['fee_num']; ?><?php else: ?>1<?php endif; ?>" name="fee_num" defaultnumber="1" onkeyup="add_charge('keyup')">
                                        <div class="a-btn">
                                            <a href="javascript:void(0);" class="btn-add" onclick="add_charge('add')"><i class="iconfont icon-up"></i></a>
                                            <a href="javascript:void(0);" class="btn-reduce" onclick="add_charge('reduce')"><i class="iconfont icon-down"></i></a>
                                        </div>
                                        <input type="hidden" value="<?php echo $this->_var['entry_criteriat_info']['count_charge']; ?>" name='count_charge'>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="label"><?php echo $this->_var['lang']['payment']; ?>：</div>
                                <div class="value pay_id_erro">
                                    <?php $_from = $this->_var['pay']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'pay');$this->_foreach['payName'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['payName']['total'] > 0):
    foreach ($_from AS $this->_var['pay']):
        $this->_foreach['payName']['iteration']++;
?>
                                        <?php if ($this->_var['pay']['pay_id'] != 1): ?>
                                            <?php if ($this->_var['pay']['pay_code'] != 'chunsejinrong' && $this->_var['pay']['pay_code'] != 'alipay_bank' && $this->_var['pay']['pay_code'] != 'onlinepay'): ?>
                                            <div class="radio-item">
                                                <input type="radio" <?php if ($this->_var['seller_apply_info']['pay_id'] == $this->_var['pay']['pay_id']): ?>checked<?php else: ?><?php if (($this->_foreach['payName']['iteration'] - 1) == 1): ?>checked<?php endif; ?><?php endif; ?> name="pay_id" class="ui-radio" value="<?php echo $this->_var['pay']['pay_id']; ?>" id="payment_<?php echo $this->_var['pay']['pay_id']; ?>">
                                                <label for="payment_<?php echo $this->_var['pay']['pay_id']; ?>" class="ui-radio-label"><?php echo $this->_var['pay']['pay_name']; ?></label>
                                            </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                </div>
                            </div>
                            <div class="item">
                                <div class="label"><?php echo $this->_var['lang']['label_total_user']; ?>：</div>
                                <div class="value">
                                    <span class="total txt-lh red">￥<em id="count_charge"><?php echo $this->_var['entry_criteriat_info']['count_charge']; ?></em></span>
                                </div>
                            </div>
                            <?php if ($this->_var['seller_apply_info']['pay_online'] && $this->_var['seller_apply_info']['pay_status'] == 0 && $this->_var['seller_apply_info']['apply_status'] == 0): ?>
                            <div class="item">
                                <div class="label">&nbsp;</div>
                                <div class="value">
                                    <span class="or-btn"><?php echo $this->_var['seller_apply_info']['pay_online']; ?></span>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="user-grade-warp">
                        <div class="user-items">
                            <div class="item item-button">
                                <div class="label">&nbsp;</div>
                                <div class="value">
                                    <input type="hidden" name="all_count_charge"  value="<?php echo $this->_var['seller_apply_info']['total_amount']; ?>"/>
                                    <input type="hidden" name="apply_id"  value="<?php echo $this->_var['seller_apply_info']['apply_id']; ?>">
                                    <input type="hidden" name="apply_sn"  value="<?php echo $this->_var['seller_apply_info']['apply_sn']; ?>">
                                    <input type="hidden" name="grade_id" value="<?php echo $this->_var['grade_id']; ?>"/>
                                    <input type="hidden" name="act"  value="<?php echo $this->_var['act']; ?>"/>
                                    <input type="hidden" name="no_cumulative_price"  value="<?php echo $this->_var['entry_criteriat_info']['no_cumulative_price']; ?>">
                                    <?php if ($this->_var['seller_apply_info']['pay_status'] == 0 && $this->_var['seller_apply_info']['apply_status'] == 0): ?>
                                    <a href="javascript:void(0);" class="sc-btn sc-redBg-btn" ectype="submit"><?php echo $this->_var['lang']['submit_request']; ?></a>
									<?php else: ?>
									<a href="user.php?act=merchants_upgrade_log" class="sc-btn sc-redBg-btn"><?php echo $this->_var['lang']['back']; ?></a>
                                    <?php endif; ?>
									
									<input type="hidden" name="sc_guid"  value="<?php echo empty($this->_var['sc_guid']) ? '0' : $this->_var['sc_guid']; ?>"/>
									<input type="hidden" name="sc_rand"  value="<?php echo empty($this->_var['sc_rand']) ? '0' : $this->_var['sc_rand']; ?>"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <?php endif; ?>
		
		<?php if ($this->_var['action'] == 'confirm_inventory' || $this->_var['action'] == 'update_submit' || $this->_var['action'] == 'grade_load'): ?>
		<div class="user-mod">
			<div class="user-title">
                <h2><?php echo $this->_var['lang']['Settlement']; ?></h2>
            </div>
			<div class="invent-box">
				<div class="sku"><?php echo $this->_var['lang']['order_number']; ?>：<?php echo $this->_var['order']['order_sn']; ?></div>
				<div class="extra"><?php echo $this->_var['lang']['Select_payment']; ?>: <strong><?php echo $this->_var['payment']['pay_name']; ?><?php if ($this->_var['pay_fee'] > 0): ?>，<?php echo $this->_var['lang']['Fee_for_user']; ?>：<?php echo $this->_var['pay_fee']; ?><?php endif; ?></strong>，<?php echo $this->_var['lang']['payment_amount_user']; ?>：<strong><?php echo $this->_var['amount']; ?></strong></div>
				<?php if ($this->_var['payment']['pay_code'] != 'bank'): ?>
				<div class="or-btn"><?php echo $this->_var['payment']['pay_button']; ?></div>
				<?php endif; ?>
			</div>
		</div>
		<?php endif; ?>
        
                    
        
        <?php if ($this->_var['action'] == 'bonus'): ?>
        <div class="user-mod">
            <div class="user-title">
                <h2><?php echo $this->_var['lang']['bonus']; ?></h2>
            </div>
            <div class="user-bonus-warp">
                <form action="" method="post">
                <div class="user-items">
                    <div class="item">
                        <div class="label"><em>*</em><?php echo $this->_var['lang']['bonus_card_number']; ?>：</div>
                        <div class="value">
                            <input type="text" name="bonus_sn" class="text text-2 txt_input_cardnum">
                        </div>
                    </div>
                    <div class="item">
                        <div class="label"><em>*</em><?php echo $this->_var['lang']['bonus_pwd']; ?>：</div>
                        <div class="value">
                            <input type="text" name="bonus_password" class="text text-2 txt_input_cardpw">
                        </div>
                    </div> 
                    <div class="item">
                        <div class="label"><em>*</em><?php echo $this->_var['lang']['comment_captcha']; ?>：</div>
                        <div class="value">
                            <div class="sm-input">
                                <input type="text" size="4" name="captcha" class="captcha_input">
                                <img src="captcha_verify.php?captcha=is_bonus&width=100&height=32&font_size=14&<?php echo $this->_var['rand']; ?>" onClick="this.src='captcha_verify.php?captcha=is_bonus&width=100&height=28&font_size=14&'+Math.random()"  name="captcha" class="captcha_img">
                            </div>
                        </div>
                    </div>
                    <div class="item item-button">
                        <div class="label"></div>
                        <div class="value">
                            <a href="javascript:void(0);" class="sc-btn sc-redBg-btn"  id="bind_btn" onclick="new_addBonus();"><?php echo $this->_var['lang']['Bind_current_account']; ?></a>
                        </div>
                    </div>          
                </div>
                </form>
            </div>
            <div class="user-bonus-temp" ectype="tabSection">
                <div class="user-title">
                    <ul class="tabs" ectype="tabs">
                        <li id="bound_giftcard" class="active"><a href="javascript:void(0);"><?php echo $this->_var['lang']['keyong']; ?>(<?php echo $this->_var['bonus']['record_count']; ?>)</a></li>
                        <li id="upcoming_giftcard"><a href="javascript:void(0);"><?php echo $this->_var['lang']['About_expire']; ?>(<?php echo $this->_var['bonus1']['record_count']; ?>)</a></li>
                        <li id="over_giftcard"><a href="javascript:void(0);"><?php echo $this->_var['lang']['have_been_exhausted']; ?>(<?php echo $this->_var['bonus2']['record_count']; ?>)</a></li>
                    </ul>
                </div>
                <div class="user-bonus-info" ectype="tabContent">
                    <div id="gift_card_list_1">
                        <?php if ($this->_var['bonus']['available_list']): ?>
                        <div class="items">
                        <?php $_from = $this->_var['bonus']['available_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');$this->_foreach['available_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['available_list']['total'] > 0):
    foreach ($_from AS $this->_var['item']):
        $this->_foreach['available_list']['iteration']++;
?>
                            <div class="item<?php if ($this->_foreach['available_list']['iteration'] % 3 == 0): ?> item-last<?php endif; ?>">
                                <div class="b-price"><?php echo $this->_var['item']['type_money']; ?></div>
                                <div class="b-i-bot">
                                    <div class="storeName"><?php echo $this->_var['item']['shop_name']; ?></div>
                                    <p><?php echo $this->_var['lang']['card_number_label']; ?>：<?php echo empty($this->_var['item']['bonus_sn']) ? 'N/A' : $this->_var['item']['bonus_sn']; ?> - <?php echo $this->_var['lang']['order_limit']; ?>：<?php echo $this->_var['item']['min_goods_amount']; ?></p>
                                    <p><?php echo $this->_var['item']['use_startdate']; ?> ~ <?php echo $this->_var['item']['use_enddate']; ?></p>
                                </div>
                                <?php if ($this->_var['item']['usebonus_type']): ?><i class="i-soon"><?php echo $this->_var['lang']['general_audience']; ?></i><?php endif; ?>
                            </div>
                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                        </div>
                        <?php else: ?>
                        <div class="no_records">
                            <i class="no_icon_two"></i>
                            <div class="no_info">
                                <h3><?php echo $this->_var['lang']['no_bonus_keyong']; ?></h3>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if ($this->_var['bonus']['record_count'] > $this->_var['size']): ?><div class="pages"><div class="pages-it"><?php echo $this->_var['bonus']['paper']; ?></div></div><?php endif; ?>
                    </div>
                    <div id="gift_card_list_2" style=" display:none">
                    <?php if ($this->_var['bonus1']['expire_list']): ?>
                        <div class="items">
                        <?php $_from = $this->_var['bonus1']['expire_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');$this->_foreach['expire_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['expire_list']['total'] > 0):
    foreach ($_from AS $this->_var['item']):
        $this->_foreach['expire_list']['iteration']++;
?>
                        <div class="item<?php if ($this->_foreach['expire_list']['iteration'] % 3 == 0): ?> item-last<?php endif; ?>">
                            <div class="b-price"><?php echo $this->_var['item']['type_money']; ?></div>
                            <div class="b-i-bot">
                                <div class="storeName"><?php echo $this->_var['item']['shop_name']; ?></div>
                                <p><?php echo $this->_var['lang']['card_number_label']; ?>：<?php echo empty($this->_var['item']['bonus_sn']) ? 'N/A' : $this->_var['item']['bonus_sn']; ?> - <?php echo $this->_var['lang']['order_limit']; ?>：<?php echo $this->_var['item']['min_goods_amount']; ?></p>
                                <p><?php echo $this->_var['item']['use_startdate']; ?> ~ <?php echo $this->_var['item']['use_enddate']; ?></p>
                            </div>
                            <i class="i-soon"><?php echo $this->_var['lang']['About_expire']; ?></i>
                        </div>
                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                        </div>
                    <?php else: ?>
                    <div class="no_records">
                        <i class="no_icon_two"></i>
                        <div class="no_info">
                            <h3><?php echo $this->_var['lang']['no_bonus_daoqi']; ?></h3>
                        </div>
                    </div>
                    <?php endif; ?>
                    </div>
                    <div id="gift_card_list_3" style=" display:none">
                    <?php if ($this->_var['bonus2']['useup_list']): ?>
                        <div class="items">
                        <?php $_from = $this->_var['bonus2']['useup_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');$this->_foreach['useup_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['useup_list']['total'] > 0):
    foreach ($_from AS $this->_var['item']):
        $this->_foreach['useup_list']['iteration']++;
?>
                        <div class="item item-disabled<?php if ($this->_foreach['useup_list']['iteration'] % 3 == 0): ?> item-last<?php endif; ?>">
                            <div class="b-price"><?php echo $this->_var['item']['type_money']; ?></div>
                            <div class="b-i-bot">
                                <div class="storeName"><?php echo $this->_var['item']['shop_name']; ?></div>
                                <p><?php echo $this->_var['lang']['card_number_label']; ?>：<?php echo empty($this->_var['item']['bonus_sn']) ? 'N/A' : $this->_var['item']['bonus_sn']; ?> - <?php echo $this->_var['lang']['order_limit']; ?>：<?php echo $this->_var['item']['min_goods_amount']; ?></p>
                                <p><?php echo $this->_var['item']['use_startdate']; ?> ~ <?php echo $this->_var['item']['use_enddate']; ?></p>
                            </div>
                            <i class="i-soon"><?php echo $this->_var['lang']['had_use']; ?></i>
                        </div>
                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                        </div>
                    <?php else: ?>
                    <div class="no_records">
                        <i class="no_icon_two"></i>
                        <div class="no_info">
                            <h3><?php echo $this->_var['lang']['no_bonus_end']; ?></h3>
                        </div>
                    </div>
                    <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="user-prompt mt20">
                <div class="tit"><span><?php echo $this->_var['lang']['bonus']; ?><?php echo $this->_var['lang']['reminder']; ?></span><i class="iconfont icon-down"></i></div>
                <div class="info">
                    <?php echo $this->_var['lang']['bonus_info']; ?>
                </div>
            </div>
        </div>
        <?php endif; ?> 
        
        
        
        <?php if ($this->_var['action'] == 'value_card'): ?>
        <div class="user-mod">
            <div class="user-title">
                <h2><?php echo $this->_var['lang']['bound_stored_card']; ?></h2>
            </div>
            <div class="value-card-warp">
                <div class="user-items">
                    <div class="item">
                        <div class="label"><em>*</em><?php echo $this->_var['lang']['stored_card_sn']; ?>：</div>
                        <div class="value">
                            <input type="text" name="card_sn" class="text text-2 txt_input_cardnum">
                        </div>
                    </div>
                    <div class="item">
                        <div class="label"><em>*</em><?php echo $this->_var['lang']['stored_card_pwd']; ?>：</div>
                        <div class="value">
                            <input type="text" name="card_password" class="text text-2 txt_input_cardpw">
                        </div>
                    </div> 
                    <div class="item">
                        <div class="label"><em>*</em><?php echo $this->_var['lang']['comment_captcha']; ?>：</div>
                        <div class="value">
                            <div class="sm-input">
                                <input type="text" name="captcha" class="captcha_input" size="4">
                                <img src="captcha_verify.php?captcha=is_value_card&width=100&height=32&font_size=14&<?php echo $this->_var['rand']; ?>" onClick="this.src='captcha_verify.php?captcha=is_value_card&width=100&height=28&font_size=14&'+Math.random()" class="captcha_img">
                            </div>
                        </div>
                    </div>
                    <div class="item item-button">
                        <div class="label"></div>
                        <div class="value">
                            <a href="javascript:void(0);" id="bind_btn" class="sc-btn sc-redBg-btn" ectype="submitVC"><?php echo $this->_var['lang']['Bind_current_account']; ?></a>
							<input type="hidden" name="user_id" id="user_id" value="<?php echo $this->_var['user_id']; ?>" />
                        </div>
                    </div>          
                </div>
            </div>
            <div class="user-title">
                <h2><?php echo $this->_var['lang']['value_card_list']; ?></h2>
            </div>
            <div class="value-card-list">
                <?php if ($this->_var['bind_vc']): ?>
                <table class="user-table user-table-cardList">
                    <colgroup>
                        <col width="200">
                        <col width="140">
                        <col width="140">
                        <col width="120">
                        <col width="120">
                        <col>
                    </colgroup>
                    <thead>
                        <tr>
                            <th class="tc"><?php echo $this->_var['lang']['card_number_label']; ?></th>
                            <th><?php echo $this->_var['lang']['face_value_label']; ?></th>
                            <th><?php echo $this->_var['lang']['money']; ?></th>
                            <th><?php echo $this->_var['lang']['is_paid']; ?></th>
                            <th><?php echo $this->_var['lang']['Expiration_time']; ?></th>
                            <th><?php echo $this->_var['lang']['handle']; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $_from = $this->_var['bind_vc']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'vo');if (count($_from)):
    foreach ($_from AS $this->_var['vo']):
?>
                        <tr>
                            <td class="tc"><?php echo $this->_var['vo']['value_card_sn']; ?></td>
                            <td class="tc"><?php echo $this->_var['vo']['vc_value']; ?></td>
                            <td class="tc"><?php echo $this->_var['vo']['card_money']; ?></td>
                            <td class="tc"><?php echo $this->_var['lang']['had_activated']; ?></td>
                            <td class="tc"><?php echo $this->_var['vo']['end_time']; ?></td>
                            <td class="tc c-handle">
                                <a href="user.php?act=value_card_info&vid=<?php echo $this->_var['vo']['vid']; ?>" class="sc-btn"><?php echo $this->_var['lang']['View_details']; ?></a>
                                <?php if ($this->_var['vo']['is_rec']): ?><a href="user.php?act=to_paid&vid=<?php echo $this->_var['vo']['vid']; ?>" class="sc-btn"><?php echo $this->_var['lang']['to_paid']; ?></a><?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    </tbody>
                </table>
                <?php else: ?>
                <div class="no_records">
                    <i class="no_icon_two"></i>
                    <div class="no_info">
                        <h3><?php 
$k = array (
  'name' => 'get_page_no_records',
  'filename' => $this->_var['filename'],
  'act' => $this->_var['action'],
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?></h3>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            <div class="user-prompt mt50">
                <div class="tit"><span><?php echo $this->_var['lang']['value_card']; ?><?php echo $this->_var['lang']['reminder']; ?></span><i class="iconfont icon-down"></i></div>
                <div class="info">
                    <p>1、<?php echo $this->_var['lang']['card_desc']['one']; ?></p>
                    <p>2、<?php echo $this->_var['lang']['card_desc']['two']; ?></p>
                </div>
            </div>
        </div>
        <?php endif; ?>
        

        
        <?php if ($this->_var['action'] == 'to_paid'): ?>
        <div class="user-mod">
            <div class="user-title">
                <h2><?php echo $this->_var['lang']['value_card_filling']; ?></h2>
            </div>
            <div class="value-card-warp">
                <div class="user-items">
                    <div class="item">
                        <div class="label"><em>*</em><?php echo $this->_var['lang']['rechargeable_card_sn']; ?>：</div>
                        <div class="value">
                            <input type="text" name="pay_card_sn" class="text text-2 txt_input_cardnum2">
                        </div>
                    </div>
                    <div class="item">
                        <div class="label"><em>*</em><?php echo $this->_var['lang']['rechargeable_card_pwd']; ?>：</div>
                        <div class="value">
                            <input type="text" name="pay_card_password" class="text text-2 txt_input_cardpw2">
                        </div>
                    </div> 
                    <div class="item">
                        <div class="label"><em>*</em><?php echo $this->_var['lang']['comment_captcha']; ?>：</div>
                        <div class="value">
                            <div class="sm-input">
                                <input type="text" name="captcha" class="captcha_input captcha_error2" size="4">
                                <img src="captcha_verify.php?captcha=is_pay_card&width=100&height=32&font_size=14&<?php echo $this->_var['rand']; ?>" onClick="this.src='captcha_verify.php?captcha=is_pay_card&width=100&height=28&font_size=14&'+Math.random()" class="captcha_img">
                            </div>
                        </div>
                    </div>
                    <div class="item item-button">
                        <div class="label"></div>
                        <div class="value">
                            <a href="javascript:void(0);" class="sc-btn sc-redBg-btn" ectype="submitVC"><?php echo $this->_var['lang']['recharge']; ?></a>
                        </div>
                    </div>          
                </div>
            </div>
        </div>
        <?php endif; ?>
        
        
        
        <?php if ($this->_var['action'] == 'value_card_info'): ?>
        <div class="user-mod">
            <div class="user-title">
                <h2><?php echo $this->_var['lang']['value_card_info']; ?></h2>
                <h3 class="value_warp" ectype="vcard_warp">
                    <span class="fl mr5"><?php echo $this->_var['explain']; ?></span>
                    <?php if ($this->_var['rz_shopNames']): ?>
                    <div class="vcard_info" ectype='value_see'>
                        <span class="red">(<?php echo $this->_var['lang']['view']; ?>)</span>
                        <div class="value_shop" ectype='value_shop'>
                              <?php $_from = $this->_var['rz_shopNames']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'list');$this->_foreach['shop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['shop']['total'] > 0):
    foreach ($_from AS $this->_var['list']):
        $this->_foreach['shop']['iteration']++;
?>     
                              <a href="<?php echo $this->_var['list']['shop_url']; ?>" target="_blank"><?php echo $this->_var['list']['shop_name']; ?></a><?php if (! ($this->_foreach['shop']['iteration'] == $this->_foreach['shop']['total'])): ?>,<?php endif; ?>
                              <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </h3>
            </div>
            <table class="user-table user-table-valueCard">
                <colgroup>
                    <col width="200">
                    <col width="150">
                    <col width="150">
                    <col width="120">
                    <col>
                </colgroup>
                <thead>
                    <tr>
                        <th class="tc"><?php echo $this->_var['lang']['lab_card_id']; ?></th>
                        <th><?php echo $this->_var['lang']['order_number']; ?></th>
                        <th><?php echo $this->_var['lang']['Use_the_amount_of']; ?></th>
                        <th><?php echo $this->_var['lang']['deposit_money']; ?></th>
                        <th><?php echo $this->_var['lang']['use_time']; ?></th>
                    </tr>
                </thead>
                <tbody>
                <?php if ($this->_var['value_card_info']): ?>
                    <?php $_from = $this->_var['value_card_info']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
                    <tr>
                        <td class="tc"><?php echo $this->_var['item']['rid']; ?></td>
                        <td class="tc"><?php echo empty($this->_var['item']['order_sn']) ? 'N/A' : $this->_var['item']['order_sn']; ?></td>
                        <td class="tc"><?php echo empty($this->_var['item']['use_val']) ? 'N/A' : $this->_var['item']['use_val']; ?></td>
                        <td class="tc"><?php echo empty($this->_var['item']['add_val']) ? 'N/A' : $this->_var['item']['add_val']; ?></td>
                        <td class="tc"><p class="date"><?php echo $this->_var['item']['record_time']; ?></p></td>
                    </tr>
                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    <?php else: ?>                                
                    <tr><td colspan="5" class="td td_bf"><?php echo $this->_var['lang']['no_use_record']; ?></td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?> 
        
        
        
        <?php if ($this->_var['action'] == 'account_bind'): ?>
        <div class="user-mod">
            <div class="user-title">
                <h2><?php echo $this->_var['lang']['bind_login']; ?></h2>
            </div>
            <div class="account-bind-warp clearfix">
                <?php if ($this->_var['insert']['qq_install'] == 1): ?>
                <div class="account-bind-item">
                    <i class="ab-icon ab-icon-qq"></i>
                    <span><?php echo $this->_var['lang']['bind_qq']; ?></span>
                    <div class="b-btn">
                        <?php if ($this->_var['qq_info']): ?>
                            <a data-title="<?php echo $this->_var['lang']['Un_bind']; ?>" data-id="<?php echo $this->_var['qq_info']['id']; ?>" data-divid="qq_remove" data-dialog="oathdialog" href="javascript:void(0);" class="qq-remove sc-btn" data-username="<?php echo $this->_var['info']['username']; ?>"  data-identity="<?php echo $this->_var['info']['username']; ?>"><?php echo $this->_var['lang']['Un_bind']; ?></a>
                        <?php else: ?>
                            <a href="user.php?act=oath&type=qq" class="sc-btn"><?php echo $this->_var['lang']['add_bind']; ?></a>
                        <?php endif; ?>
                    </div>
                    <div class="b-type"><i class="iconfont<?php if ($this->_var['qq_info']): ?> icon-ok<?php else: ?> icon-info-sign<?php endif; ?>"></i><?php if ($this->_var['qq_info']): ?><?php echo $this->_var['lang']['Bound']; ?><?php else: ?><?php echo $this->_var['lang']['not_Bound']; ?><?php endif; ?></div>
                </div>
                <?php endif; ?>
                
                <?php if ($this->_var['insert']['weibo_install'] == 1): ?>
                <div class="account-bind-item">
                    <i class="ab-icon ab-icon-weibo"></i>
                    <span><?php echo $this->_var['lang']['weibo_one']; ?></span>
                    <div class="b-btn">
                    <?php if ($this->_var['weibo_info']): ?>
                    	<a data-title="<?php echo $this->_var['lang']['Un_bind']; ?>" data-id="<?php echo $this->_var['weibo_info']['id']; ?>" data-divid="weixin_remove" data-dialog="oathdialog" href="javascript:void(0);" class="weibo-remove sc-btn" data-username="<?php echo $this->_var['info']['username']; ?>"  data-identity="<?php echo $this->_var['info']['username']; ?>"><?php echo $this->_var['lang']['Un_bind']; ?></a>
                    <?php else: ?>
                    	<a href="user.php?act=oath&type=weibo" class="sc-btn"><?php echo $this->_var['lang']['add_bind']; ?></a>
                    <?php endif; ?>
                    </div>
                    <div class="b-type"><i class="iconfont<?php if ($this->_var['weibo_info']): ?> icon-ok<?php else: ?> icon-info-sign<?php endif; ?>"></i><?php if ($this->_var['weibo_info']): ?><?php echo $this->_var['lang']['Bound']; ?><?php else: ?><?php echo $this->_var['lang']['not_Bound']; ?><?php endif; ?></div>
                </div>
                <?php endif; ?>
                
                <?php if ($this->_var['insert']['wechat_install'] == 1): ?>
                <div class="account-bind-item">
                    <i class="ab-icon ab-icon-wechat"></i>
                    <span><?php echo $this->_var['lang']['weixin_one']; ?></span>
                    <div class="b-btn">
                    <?php if ($this->_var['weixin_info']): ?>
                    	<a data-title="<?php echo $this->_var['lang']['Un_bind']; ?>" data-id="<?php echo $this->_var['weixin_info']['id']; ?>" data-divid="weibo_remove" data-dialog="oathdialog" href="javascript:void(0);" class="weixin-remove sc-btn" data-username="<?php echo $this->_var['info']['username']; ?>"  data-identity="<?php echo $this->_var['info']['username']; ?>"><?php echo $this->_var['lang']['Un_bind']; ?></a>
                    <?php else: ?>
                    	<a href="wechat_oauth.php?act=login&user_id=<?php echo $this->_var['user_id']; ?>" class="sc-btn"><?php echo $this->_var['lang']['add_bind']; ?></a>
                    <?php endif; ?>
                    </div>
                    <div class="b-type"><i class="iconfont<?php if ($this->_var['weixin_info']): ?> icon-ok<?php else: ?> icon-info-sign<?php endif; ?>"></i><?php if ($this->_var['weixin_info']): ?><?php echo $this->_var['lang']['Bound']; ?><?php else: ?><?php echo $this->_var['lang']['not_Bound']; ?><?php endif; ?></div>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>
        	
        
        
        <?php if ($this->_var['action'] == 'crowdfunding'): ?>
        <div class="user-mod" ectype="tabSection">
            <div class="user-title">
                <h2><?php echo $this->_var['lang']['crowdfunding']; ?></h2>
                <ul class="tabs zc_btn" ectype="tabs">
                    <li class="active"><a href="javascript:void(0);"><?php echo $this->_var['lang']['I_support']; ?></a></li>
                    <li><a href="javascript:void(0);"><?php echo $this->_var['lang']['I_concerned']; ?></a></li>
                </ul>
            </div>
            <div class="crowdfunding-warp">
                <div class="crowdfunding-main zc_my_main" ectype="tabContent">
                    <div class="my_box">
                        <?php if ($this->_var['zc_support_list']): ?>
                        <div class="cdf-tab ui-tab">
                            <a href="javascript:void(0);" data-val="1" class="curr"><?php echo $this->_var['lang']['all_attribute']; ?></a>
                            <a href="javascript:void(0);" data-val="2"><?php echo $this->_var['lang']['Already_paid']; ?></a>
                            <a href="javascript:void(0);" data-val="3"><?php echo $this->_var['lang']['not_paid']; ?></a>
                        </div>
                        <?php endif; ?>
                        <div class="pay_item">
                            <?php if ($this->_var['zc_support_list']): ?>
                            <div class="crowdfunding-list">
                                <table class="user-table user-table-cdf">
                                    <colgroup>
                                        <col width="350">
                                        <col width="120">
                                        <col width="80">
                                        <col width="80">
                                        <col width="80">
                                        <col>
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <th><?php echo $this->_var['lang']['Project_info']; ?></th>
                                            <th><?php echo $this->_var['lang']['order_number']; ?></th>
                                            <th><?php echo $this->_var['lang']['is_confirmed']; ?></th>
                                            <th><?php echo $this->_var['lang']['zc_raise']; ?></th>
                                            <th><?php echo $this->_var['lang']['residual_time']; ?></th>
                                            <th><?php echo $this->_var['lang']['handle']; ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $_from = $this->_var['zc_support_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'vo');if (count($_from)):
    foreach ($_from AS $this->_var['vo']):
?>
                                        <tr>
                                            <td>
                                                <div class="cdf-goods">
                                                    <div class="cdf-img"><a href="crowdfunding.php?act=detail&id=<?php echo $this->_var['vo']['id']; ?>"><img src="<?php echo $this->_var['vo']['title_img']; ?>"></a></div>
                                                    <div class="cdf-info">
                                                        <div class="cdf-name"><a href="crowdfunding.php?act=detail&id=<?php echo $this->_var['vo']['id']; ?>"><?php echo $this->_var['vo']['title']; ?></a><?php if ($this->_var['vo']['surplus_time'] != 0): ?><span class="hand"><?php echo $this->_var['lang']['zc_in']; ?></span><?php else: ?><span><?php echo $this->_var['lang']['has_ended']; ?></span><?php endif; ?></div>
                                                        <div class="cdf-lie"><span class="p-price">￥<?php echo $this->_var['vo']['goods_amount']; ?></span> x 1</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="tc"><?php echo $this->_var['vo']['order_sn']; ?></td>
                                            <td class="tc"><?php echo $this->_var['vo']['complete']; ?>%</td>
                                            <td class="tc">￥<?php echo $this->_var['vo']['join_money']; ?></td>
                                            <td class="tc"><?php echo $this->_var['vo']['surplus_time']; ?> <?php echo $this->_var['lang']['day']; ?></td>
                                            <td class="tc">
                                                <?php if ($this->_var['vo']['surplus_time'] != 0 && $this->_var['vo']['pay_status'] == 0): ?>
                                                    <a target="_blank" href="user.php?act=order_detail&order_id=<?php echo $this->_var['vo']['order_id']; ?>" class="sc-btn"><?php echo $this->_var['lang']['go_pay']; ?></a>
                                                <?php elseif ($this->_var['vo']['surplus_time'] != 0 && $this->_var['vo']['pay_status'] == 1): ?>
                                                    <p><?php echo $this->_var['lang']['cs']['1']; ?></p>                                    
                                                <?php elseif ($this->_var['vo']['surplus_time'] != 0 && $this->_var['vo']['pay_status'] == 2): ?>
                                                    <p><?php echo $this->_var['lang']['ps']['2']; ?></p>
                                                <?php elseif ($this->_var['vo']['surplus_time'] == 0 && $this->_var['vo']['pay_status'] == 2): ?>
                                                    <p><?php echo $this->_var['lang']['ps']['2']; ?></p>
                                                    <p><?php echo $this->_var['lang']['has_ended']; ?></p>
                                                <?php else: ?>
                                                    <p><?php echo $this->_var['lang']['has_ended']; ?></p>
                                                <?php endif; ?>
                                                
                                                <?php if ($this->_var['vo']['shipping_status'] == 0): ?>
                                                <p><?php echo $this->_var['lang']['ss']['0']; ?></p>
                                                <?php elseif ($this->_var['vo']['shipping_status'] == 5): ?>
                                                <p><?php echo $this->_var['lang']['zc_ss']; ?></p>                                           
                                                <?php elseif ($this->_var['vo']['shipping_status'] == 1): ?>
                                                <p><?php echo $this->_var['lang']['ss']['1']; ?></p>
                                                <a target="_blank" class="sc-btn" href="user.php?act=affirm_received&order_id=<?php echo $this->_var['vo']['order_id']; ?>&action=crowdfunding" onclick="if (!confirm('<?php echo $this->_var['lang']['confirm_received']; ?>')) return false;"><?php echo $this->_var['lang']['received']; ?></a>
                                                <?php elseif ($this->_var['vo']['shipping_status'] == 2): ?>
                                                <p><?php echo $this->_var['lang']['Received_goods']; ?></p>
                                                <?php endif; ?> 
                                            </td>
                                        </tr>
                                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php else: ?>
                                <div class="no_records">
                                    <i class="no_icon_two"></i>
                                    <div class="no_info no_info_line">
                                        <h3><?php 
$k = array (
  'name' => 'get_page_no_records',
  'filename' => $this->_var['filename'],
  'act' => $this->_var['action'],
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?></h3>
                                        <div class="no_btn"><a href="crowdfunding.php" class="sc-btn"><?php echo $this->_var['lang']['zc_home']; ?></a></div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="pay_item" style="display: none;">
                            <?php if ($this->_var['zc_support_list_yes_pay']): ?>
                            <div class="crowdfunding-list">
                                <table class="user-table user-table-cdf">
                                    <colgroup>
                                        <col width="350">
                                        <col width="120">
                                        <col width="80">
                                        <col width="80">
                                        <col width="80">
                                        <col>
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <th><?php echo $this->_var['lang']['Project_info']; ?></th>
                                            <th><?php echo $this->_var['lang']['order_number']; ?></th>
                                            <th><?php echo $this->_var['lang']['is_confirmed']; ?></th>
                                            <th><?php echo $this->_var['lang']['zc_raise']; ?></th>
                                            <th><?php echo $this->_var['lang']['residual_time']; ?></th>
                                            <th><?php echo $this->_var['lang']['handle']; ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $_from = $this->_var['zc_support_list_yes_pay']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'vo');if (count($_from)):
    foreach ($_from AS $this->_var['vo']):
?>
                                        <tr>
                                            <td>
                                                <div class="cdf-goods">
                                                    <div class="cdf-img"><a href="crowdfunding.php?act=detail&id=<?php echo $this->_var['vo']['id']; ?>" target="_blank"><img src="<?php echo $this->_var['vo']['title_img']; ?>"></a></div>
                                                    <div class="cdf-info">
                                                        <div class="cdf-name"><a href="crowdfunding.php?act=detail&id=<?php echo $this->_var['vo']['id']; ?>" target="_blank"><?php echo $this->_var['vo']['title']; ?></a><?php if ($this->_var['vo']['surplus_time'] != 0): ?><span class="hand"><?php echo $this->_var['lang']['zc_in']; ?></span><?php else: ?><span><?php echo $this->_var['lang']['has_ended']; ?></span><?php endif; ?></div>
                                                        <div class="cdf-lie"><span class="p-price">￥<?php echo $this->_var['vo']['goods_amount']; ?></span> x 1</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="tc"><?php echo $this->_var['vo']['order_sn']; ?></td>
                                            <td class="tc"><?php echo $this->_var['vo']['complete']; ?>%</td>
                                            <td class="tc">￥<?php echo $this->_var['vo']['join_money']; ?></td>
                                            <td class="tc"><?php echo $this->_var['vo']['surplus_time']; ?> <?php echo $this->_var['lang']['day']; ?></td>
                                            <td class="tc">
                                                <?php if ($this->_var['vo']['surplus_time'] != 0 && $this->_var['vo']['pay_status'] == 0): ?>
                                                    <a target="_blank" href="user.php?act=order_detail&order_id=<?php echo $this->_var['vo']['order_id']; ?>" class="sc-btn"><?php echo $this->_var['lang']['go_pay']; ?></a>
                                                <?php elseif ($this->_var['vo']['surplus_time'] != 0 && $this->_var['vo']['pay_status'] == 1): ?>
                                                    <p><?php echo $this->_var['lang']['cs']['1']; ?></p>                                            
                                                <?php elseif ($this->_var['vo']['surplus_time'] != 0 && $this->_var['vo']['pay_status'] == 2): ?>
                                                    <p><?php echo $this->_var['lang']['ps']['2']; ?></p>
                                                <?php elseif ($this->_var['vo']['surplus_time'] == 0 && $this->_var['vo']['pay_status'] == 2): ?>
                                                    <p><?php echo $this->_var['lang']['ps']['2']; ?></p>
                                                    <p><?php echo $this->_var['lang']['has_ended']; ?></p>
                                                <?php else: ?>
                                                    <p><?php echo $this->_var['lang']['has_ended']; ?></p>
                                                <?php endif; ?>
                                                <?php if ($this->_var['vo']['shipping_status'] == 0): ?>
                                                <p><?php echo $this->_var['lang']['ss']['0']; ?></p>
                                                <?php elseif ($this->_var['vo']['shipping_status'] == 5): ?>
                                                <p><?php echo $this->_var['lang']['zc_ss']; ?></p>                                           
                                                <?php elseif ($this->_var['vo']['shipping_status'] == 1): ?>
                                                <p><?php echo $this->_var['lang']['ss']['1']; ?></p>
                                                <a target="_blank" class="sc-btn" href="user.php?act=affirm_received&order_id=<?php echo $this->_var['vo']['order_id']; ?>" onclick="if (!confirm('<?php echo $this->_var['lang']['confirm_received']; ?>')) return false;"><?php echo $this->_var['lang']['received']; ?></a>
                                                <?php elseif ($this->_var['vo']['shipping_status'] == 2): ?>
                                                <p><?php echo $this->_var['lang']['Received_goods']; ?></p>
                                                <?php endif; ?>   
                                            </td>
                                        </tr>
                                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php else: ?>
                                <div class="no_records">
                                    <i class="no_icon_two"></i>
                                    <div class="no_info no_info_line">
                                        <h3><?php 
$k = array (
  'name' => 'get_page_no_records',
  'filename' => $this->_var['filename'],
  'act' => $this->_var['action'],
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?></h3>
                                        <div class="no_btn"><a href="crowdfunding.php" class="sc-btn"><?php echo $this->_var['lang']['zc_home']; ?></a></div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="pay_item" style="display: none;">
                            <?php if ($this->_var['zc_support_list_no_pay']): ?>
                            <div class="crowdfunding-list">
                                <table class="user-table user-table-cdf">
                                    <colgroup>
                                        <col width="350">
                                        <col width="120">
                                        <col width="80">
                                        <col width="80">
                                        <col width="80">
                                        <col>
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <th><?php echo $this->_var['lang']['Project_info']; ?></th>
                                            <th><?php echo $this->_var['lang']['order_number']; ?></th>
                                            <th><?php echo $this->_var['lang']['is_confirmed']; ?></th>
                                            <th><?php echo $this->_var['lang']['zc_raise']; ?></th>
                                            <th><?php echo $this->_var['lang']['residual_time']; ?></th>
                                            <th><?php echo $this->_var['lang']['handle']; ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $_from = $this->_var['zc_support_list_no_pay']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'vo');if (count($_from)):
    foreach ($_from AS $this->_var['vo']):
?>
                                        <tr>
                                            <td>
                                                <div class="cdf-goods">
                                                    <div class="cdf-img"><a href="crowdfunding.php?act=detail&id=<?php echo $this->_var['vo']['id']; ?>" target="_blank"><img src="<?php echo $this->_var['vo']['title_img']; ?>"></a></div>
                                                    <div class="cdf-info">
                                                        <div class="cdf-name"><a href="crowdfunding.php?act=detail&id=<?php echo $this->_var['vo']['id']; ?>" target="_blank"><?php echo $this->_var['vo']['title']; ?></a><?php if ($this->_var['vo']['surplus_time'] != 0): ?><span class="hand"><?php echo $this->_var['lang']['zc_in']; ?></span><?php else: ?><span><?php echo $this->_var['lang']['has_ended']; ?></span><?php endif; ?></div>
                                                        <div class="cdf-lie"><span class="p-price">￥<?php echo $this->_var['vo']['goods_amount']; ?></span> x 1</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="tc"><?php echo $this->_var['vo']['order_sn']; ?></td>
                                            <td class="tc"><?php echo $this->_var['vo']['complete']; ?>%</td>
                                            <td class="tc">￥<?php echo $this->_var['vo']['join_money']; ?></td>
                                            <td class="tc"><?php echo $this->_var['vo']['surplus_time']; ?> <?php echo $this->_var['lang']['day']; ?></td>
                                            <td class="tc">
                                                <?php if ($this->_var['vo']['surplus_time'] != 0 && $this->_var['vo']['pay_status'] == 0): ?>
                                                    <a target="_blank" href="user.php?act=order_detail&order_id=<?php echo $this->_var['vo']['order_id']; ?>" class="sc-btn"><?php echo $this->_var['lang']['go_pay']; ?></a>
                                                <?php elseif ($this->_var['vo']['surplus_time'] != 0 && $this->_var['vo']['pay_status'] == 1): ?>
                                                    <span><?php echo $this->_var['lang']['cs']['1']; ?></span>                                            
                                                <?php elseif ($this->_var['vo']['surplus_time'] != 0 && $this->_var['vo']['pay_status'] == 2): ?>
                                                    <span><?php echo $this->_var['lang']['ps']['2']; ?></span>
                                                <?php elseif ($this->_var['vo']['surplus_time'] == 0 && $this->_var['vo']['pay_status'] == 2): ?>
                                                    <span><?php echo $this->_var['lang']['ps']['2']; ?></span><br/>
                                                    <span><?php echo $this->_var['lang']['has_ended']; ?></span>
                                                <?php else: ?>
                                                    <span><?php echo $this->_var['lang']['has_ended']; ?></span>
                                                <?php endif; ?>
                                                <?php if ($this->_var['vo']['shipping_status'] == 0): ?>
                                                <span><?php echo $this->_var['lang']['ss']['0']; ?></span>
                                                <?php elseif ($this->_var['vo']['shipping_status'] == 5): ?>
                                                <span><?php echo $this->_var['lang']['zc_ss']; ?></span>                                           
                                                <?php elseif ($this->_var['vo']['shipping_status'] == 1): ?>
                                                <span><?php echo $this->_var['lang']['ss']['1']; ?></span>
                                                <a target="_blank" class="sc-btn" href="user.php?act=affirm_received&order_id=<?php echo $this->_var['vo']['order_id']; ?>" onclick="if (!confirm('<?php echo $this->_var['lang']['confirm_received']; ?>')) return false;"><?php echo $this->_var['lang']['received']; ?></a>
                                                <?php elseif ($this->_var['vo']['shipping_status'] == 2): ?>
                                                <span><?php echo $this->_var['lang']['Received_goods']; ?></span>
                                                <?php endif; ?> 
                                            </td>
                                        </tr>
                                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php else: ?>
                            <div class="no_records">
                                <i class="no_icon_two"></i>
                                <div class="no_info no_info_line">
                                    <h3><?php 
$k = array (
  'name' => 'get_page_no_records',
  'filename' => $this->_var['filename'],
  'act' => $this->_var['action'],
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?></h3>
                                    <div class="no_btn"><a href="crowdfunding.php" class="sc-btn"><?php echo $this->_var['lang']['zc_home']; ?></a></div>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="my_box" style="display:none;">
                        <?php if (! empty ( $this->_var['zc_focus_list'] [ 0 ] )): ?>
                            <div class="crowdfunding-list">
                                <table class="user-table user-table-cdf">
                                    <colgroup>
                                        <col width="350">
                                        <col width="100">
                                        <col width="100">
                                        <col width="100">
                                        <col>
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <th><?php echo $this->_var['lang']['Project_info']; ?></th>
                                            <th><?php echo $this->_var['lang']['zc_number']; ?></th>
                                            <th><?php echo $this->_var['lang']['gz_number']; ?></th>
                                            <th><?php echo $this->_var['lang']['handle']; ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $_from = $this->_var['zc_focus_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'vo');if (count($_from)):
    foreach ($_from AS $this->_var['vo']):
?>
                                        <tr>
                                            <td>
                                                <div class="cdf-goods">
                                                    <div class="cdf-img"><a href="crowdfunding.php?act=detail&id=<?php echo $this->_var['vo']['id']; ?>" target="_blank"><img src="<?php echo $this->_var['vo']['title_img']; ?>"></a></div>
                                                    <div class="cdf-info">
                                                        <div class="cdf-name"><a href="crowdfunding.php?act=detail&id=<?php echo $this->_var['vo']['id']; ?>" target="_blank"><?php echo $this->_var['vo']['title']; ?></a><?php if ($this->_var['vo']['surplus_time'] != 0): ?><span class="hand"><?php echo $this->_var['lang']['zc_in']; ?></span><?php else: ?><span><?php echo $this->_var['lang']['has_ended']; ?></span><?php endif; ?></div>
                                                        <div class="cdf-lie"><span class="p-price">￥<?php echo $this->_var['vo']['join_money']; ?></span> x 1</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="tc"><?php echo empty($this->_var['vo']['zhichi_num']) ? '0' : $this->_var['vo']['zhichi_num']; ?></td>
                                            <td class="tc"><?php echo empty($this->_var['vo']['focus_num']) ? '0' : $this->_var['vo']['focus_num']; ?></td>
                                            <td class="tc">
                                               <?php if ($this->_var['vo']['surplus_time'] > 0): ?>
                                               <a target="_blank" class="sc-btn" href="crowdfunding.php?act=detail&id=<?php echo $this->_var['vo']['id']; ?>"><?php echo $this->_var['lang']['To_support']; ?></a>
                                               <br/>
                                               <a href="javascript:void(0);" class="sc-btn" data-dialog="zc_focus_dialog" data-divid="zc_focus_dialog" data-url="user.php?act=delete_zc_focus&rec_id=<?php echo $this->_var['vo']['id']; ?>"><?php echo $this->_var['lang']['no_attention']; ?></a>
                                               <?php else: ?>
                                               <span><?php echo $this->_var['lang']['has_ended']; ?></span>
                                               <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="no_records">
                                <i class="no_icon_two"></i>
                                <div class="no_info no_info_line">
                                    <h3><?php 
$k = array (
  'name' => 'get_page_no_records',
  'filename' => $this->_var['filename'],
  'act' => $this->_var['action'],
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?></h3>
                                    <div class="no_btn"><a href="crowdfunding.php" class="sc-btn"><?php echo $this->_var['lang']['zc_home']; ?></a></div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        
        
        
        <?php if ($this->_var['action'] == 'wholesale_buy'): ?>
        <div class="user-mod">
            <div class="user-title">
                <h2><?php echo $this->_var['lang']['my_purchase_order']; ?></h2>
            </div>
            <div class="user-list-title clearfix">
                <div class="user-list-filter">
                    <div class="imitate_select w120 mr10" id="wholesale_order_status">
                        <div class="cite"><span><?php echo $this->_var['lang']['all_status']; ?></span><i class="iconfont icon-down"></i></div>
                        <ul>
                            <li id="wholesale_order_status_-1"><a href="javascript:void(0);" data-idtxt="wholesale_status_list" data-action="<?php echo $this->_var['action']; ?>" data-type="order_status" data-id="-1" data-value='-1'><?php echo $this->_var['lang']['all_status']; ?></a></li>
                            <li id="wholesale_order_status_0"><a href="javascript:void(0);" data-idtxt="wholesale_status_list" data-action="<?php echo $this->_var['action']; ?>" data-type="order_status" data-id="0" data-value='0'><?php echo $this->_var['lang']['no_confirmed']; ?></a></li>
                            <li id="wholesale_order_status_1"><a href="javascript:void(0);" data-idtxt="wholesale_status_list" data-action="<?php echo $this->_var['action']; ?>" data-type="order_status" data-id="1" data-value='1'><?php echo $this->_var['lang']['is_confirmed']; ?></a></li>
                        </ul>
                        <input name="wholesale_order_status_list" type="hidden" value="-1" id="wholesale_order_status_val">
                    </div>
                    <div class="imitate_select w120" id="DateTime">
                        <div class="cite"><span><?php echo $this->_var['lang']['all_time']; ?></span><i class="iconfont icon-down"></i></div>
                        <ul>
                            <li id="time_allDate"><a href="javascript:void(0);" data-idtxt="wholesale_submitDate" data-action="<?php echo $this->_var['action']; ?>" data-type="dateTime" data-id="allDate" data-value="allDate"><?php echo $this->_var['lang']['all_time']; ?></a></li>
                            <li id="time_today"><a href="javascript:void(0);" data-idtxt="wholesale_submitDate" data-action="<?php echo $this->_var['action']; ?>" data-type="dateTime" data-id="today" data-value="today"><?php echo $this->_var['lang']['Today']; ?></a></li>
                            <li id="time_three_today"><a href="javascript:void(0);" data-idtxt="wholesale_submitDate" data-action="<?php echo $this->_var['action']; ?>" data-type="dateTime" data-id="three_today" data-value="three_today"><?php echo $this->_var['lang']['three_today']; ?></a></li>
                            <li id="time_aweek"><a href="javascript:void(0);" data-idtxt="wholesale_submitDate" data-action="<?php echo $this->_var['action']; ?>" data-type="dateTime" data-id="aweek" data-value="aweek"><?php echo $this->_var['lang']['aweek']; ?></a></li>
                            <li id="time_thismonth"><a href="javascript:void(0);" data-idtxt="wholesale_submitDate" data-action="<?php echo $this->_var['action']; ?>" data-type="dateTime" data-id="thismonth" data-value="thismonth"><?php echo $this->_var['lang']['thismonth']; ?></a></li>
                        </ul>
                        <input name="wholesale_order_submitDate" type="hidden" value="allDate" id="wholesale_dateTime_val">
                    </div>
                </div>
                <div class="user-list-search">
                    <input type="text" id="ip_keyword" class="text" onkeydown="javascript:if(event.keyCode==13) get_WholesaleOrderSearch('ip_keyword', 'order_list', 'text');" onblur="if (this.value=='') this.value=this.defaultValue; this.style.color='#999'" onfocus="if (this.value==this.defaultValue)this.value='';this.style.color='#666'" placeholder="<?php echo $this->_var['lang']['search_oreder_user']; ?>" name="" style="color: rgb(153, 153, 153);">
                    <button type="button" onclick="get_WholesaleOrderSearch('ip_keyword', 'order_list', 'text')"><i class="iconfont icon-search"></i></button>
                </div>
            </div>
            <div id="user_order_list">
            <?php echo $this->fetch('library/user_wholesale_order_list.lbi'); ?>
            </div>
        </div>
        <script type="text/javascript">
            //删除
            function delete_wholesale_order(order_id){
                var order = new Object();
                order.order_id   = order_id; 
				pbDialog("<?php echo $this->_var['lang']['is_confirmed_who_buy']; ?>","",0,"","","",true,function(){
					Ajax.call('user.php?act=delete_wholesale_order', 'order=' + $.toJSON(order), orderResponse, 'POST', 'JSON');
				});
            } 
            //查询
            function get_WholesaleOrderSearch(idTxt, action, type, t, c){
                    
                var keyword, status_keyword, date_keyword;  
                var order = new Object();
                if(t){
                    keyword = $(t).data('id');

                    if(idTxt == 'wholesale_status_list'){
                        $("input[name='wholesale_order_status_list']").val(keyword);
                    }else if(idTxt == 'wholesale_submitDate'){
                        $("input[name='wholesale_order_submitDate']").val(keyword);
                    }

                }else{
                    keyword = document.getElementById(idTxt).value;
                }
        
                //by sun
                if(c){
                    $(c).addClass("active").siblings().removeClass("active");
                }
                //by sun end
                    
                if(idTxt == 'submitDate'){
                    var status_keyword = $("input[name='wholesale_order_status_list']").val();
                    order.status_keyword   = status_keyword; 
                }else if(idTxt == 'status_list'){
                    var date_keyword = $("input[name='wholesale_order_submitDate']").val();
                    order.date_keyword   = date_keyword; 
                }
                    
                order.idTxt   = idTxt; 
                order.keyword   = keyword; 
                order.action   = action; 
                order.type   = type; 

                Ajax.call('user.php?act=wholesale_order_to_query', 'order=' + $.toJSON(order), orderResponse, 'POST', 'JSON');
            }
            
            function orderResponse(result){
                if(result.error == 0){
                    $("#user_order_list").html(result.content);
                }
				
				$(".user-purchase .item").each(function(){
					var height_l = $(this).find(".itemc-left").height();
					var height_r = $(this).find(".itemc-right").height();
					
					if(height_l < height_r){
						$(this).find(".itemc-right").addClass("borderLeft");
					}else if(height_l > height_r){
						$(this).find(".itemc-left").addClass("borderRight");
					}else{
						$(this).find(".itemc-left").addClass("borderRight");
					}
				});
            }
        </script>  
        <?php endif; ?>
            
        <?php if ($this->_var['action'] == 'wholesale_purchase'): ?>
        <div class="user-mod">
            <div class="user-title">
                <h2><?php echo $this->_var['lang']['want_buy_order']; ?></h2>
                <ul class="tabs" ectype="review_status">
                    <li <?php if ($_GET['review_status'] == ''): ?>class="active"<?php endif; ?> data-value=""><a href="javascript:void(0);"><?php echo $this->_var['lang']['all_status']; ?>(<?php echo $this->_var['review_status_array']['-1']; ?>)</a></li>
                    <li <?php if ($_GET['review_status'] == '1'): ?>class="active"<?php endif; ?> data-value="1"><a href="javascript:void(0);"><?php echo $this->_var['lang']['is_confirm']['1']; ?>(<?php echo $this->_var['review_status_array']['1']; ?>)</a></li>
                    <li <?php if ($_GET['review_status'] == '2'): ?>class="active"<?php endif; ?> data-value="2"><a href="javascript:void(0);"><?php echo $this->_var['lang']['is_confirm']['2']; ?>(<?php echo $this->_var['review_status_array']['2']; ?>)</a></li>
                    <li <?php if ($_GET['review_status'] == '0'): ?>class="active"<?php endif; ?> data-value="0"><a href="javascript:void(0);"><?php echo $this->_var['lang']['is_confirm']['0']; ?>(<?php echo $this->_var['review_status_array']['0']; ?>)</a></li>
                </ul>
            </div>
            <div class="user-list-title clearfix">
                <div class="user-list-filter user-wantbut-filter">
                    <div class="text_time" id="text_time1">
                        <input type="text" class="text mr0" name="start_date" id="start_date" value="<?php echo $_GET['start_date']; ?>" placeholder="<?php echo $this->_var['lang']['select_date']; ?>" autocomplete="off" readonly>
                    </div>
                    <span class="bolang">&nbsp;&nbsp;~&nbsp;&nbsp;</span>
                    <div class="text_time" id="text_time2">
                        <input type="text" class="text mr0" name="end_date" id="end_date" value="<?php echo $_GET['end_date']; ?>" placeholder="<?php echo $this->_var['lang']['select_date']; ?>" autocomplete="off" readonly>
                    </div>
                </div>
                <div class="user-list-search user-list-search-wantbut">
                    <input type="hidden" name="review_status" value="<?php echo $_GET['review_status']; ?>">
                    <input type="text" id="ip_keyword" class="text" placeholder="<?php echo $this->_var['lang']['wholesale_purchase_placeholder']; ?>" name="keyword" value="<?php echo $_GET['keyword']; ?>" onkeydown="javascript:if(event.keyCode==13) purchase_search();" style="color: rgb(153, 153, 153);">
                    <button type="button" onclick="purchase_search()"><?php echo $this->_var['lang']['search']; ?></button>
                </div>
            </div>
            <div class="user-wantbut-list">
                <table class="user-table">
                    <colgroup>
                        <col width="300">
                        <col width="300">
                        <col width="140">
                        <col>
                    </colgroup>
                    <thead>
                        <tr>
                            <th><?php echo $this->_var['lang']['want_to_buy_goods']; ?></th>
                            <th><?php echo $this->_var['lang']['want_to_buy_time']; ?></th>
                            <th><?php echo $this->_var['lang']['adopt_status']; ?></th>
                            <th><?php echo $this->_var['lang']['handle']; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $_from = $this->_var['purchase_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'purchase');if (count($_from)):
    foreach ($_from AS $this->_var['purchase']):
?>
                        <tr>
                            <td>
                                <div class="p-goods">
                                    <div class="p-img"><a href="wholesale_purchase.php?act=info&purchase_id=<?php echo $this->_var['purchase']['purchase_id']; ?>" target="_blank"><img src="<?php if ($this->_var['purchase']['img']): ?><?php echo $this->_var['purchase']['img']; ?><?php else: ?>themes/<?php echo $GLOBALS['_CFG']['template']; ?>/images/brand_defalut.jpg<?php endif; ?>"></a></div>
                                    <div class="p-info">
                                        <div class="p-name"><a href="wholesale_purchase.php?act=info&purchase_id=<?php echo $this->_var['purchase']['purchase_id']; ?>" title="<?php echo htmlspecialchars($this->_var['purchase']['subject']); ?>" target="_blank"><?php echo $this->_var['purchase']['subject']; ?></a></div>
                                        <div class="p-num"><?php echo $this->_var['lang']['want_to_buy_num']; ?>：<?php echo $this->_var['purchase']['goods_number']; ?><?php echo $this->_var['lang']['jian']; ?></div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="p-time">
                                    <p><?php echo $this->_var['purchase']['add_time_complete']; ?> 〜 <?php echo $this->_var['purchase']['end_time_complete']; ?></p>
                                    <p><?php echo $this->_var['lang']['residual']; ?><?php echo $this->_var['purchase']['left_day']; ?><?php echo $this->_var['lang']['day']; ?></p>
                                </div>
                            </td>
                            <td>
                                <div class="p-state">
                                    <h3 class="ftx-07"><?php echo $this->_var['lang']['review_status'][$this->_var['purchase']['review_status']]; ?></h3>
                                </div>
                            </td>
                            <td>
                                <a href="user.php?act=purchase_info&purchase_id=<?php echo $this->_var['purchase']['purchase_id']; ?>" class="sc-btn"><?php echo $this->_var['lang']['view']; ?></a>
                                <a href="user.php?act=purchase_delete&purchase_id=<?php echo $this->_var['purchase']['purchase_id']; ?>" class="sc-btn"><?php echo $this->_var['lang']['drop']; ?></a>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="4"><?php echo $this->_var['lang']['wholesale_purchase_null']; ?></td></tr>
                        <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    </tbody>
                </table>
                <?php echo $this->fetch('library/pages.lbi'); ?>
            </div>
        </div>
        <script type="text/javascript">
        $("[ectype='review_status'] li").click(function(){
			var review_status = $(this).data('value');
			$("input[name='review_status']").val(review_status);
			purchase_search();
        })

        function purchase_search(){
			query_string = "";
			var start_date = $("input[name='start_date']").val();
			var end_date = $("input[name='end_date']").val();
			var keyword = $("input[name='keyword']").val();
			var review_status = $("input[name='review_status']").val();
			if(start_date){query_string += "&start_date="+start_date}
			if(end_date){query_string += "&end_date="+end_date}
			if(keyword){query_string += "&keyword="+keyword}
			if(review_status){query_string += "&review_status="+review_status}
			location.href = 'user.php?act=wholesale_purchase'+query_string;
        }
        </script>
        <?php endif; ?>
        
        <?php if ($this->_var['action'] == 'purchase_info'): ?>
        <div class="user-mod">
            <form name="formEdit" action="user.php" method="post">
            	<div class="user-title">
                    <h2><?php echo $this->_var['lang']['want_buy_order_desc']; ?></h2>
                </div>
                <div class="user-wantbuy-content">
                    <div class="title">
                    	<h3><?php echo $this->_var['lang']['review_status'][$this->_var['purchase_info']['review_status']]; ?>－<?php echo $this->_var['lang']['purchase_status'][$this->_var['purchase_info']['status']]; ?></h3>
                        <span><?php echo $this->_var['lang']['wholesale_purchase_residual']; ?><em><?php echo $this->_var['purchase_info']['left_day']; ?></em><?php echo $this->_var['lang']['day']; ?></span>
                    </div>
                    <div class="user-wantbuy-table">
                    	<div class="tit"><?php echo $this->_var['purchase_info']['subject']; ?><em><?php echo $this->_var['lang']['purchase_type'][$this->_var['purchase_info']['type']]; ?></em></div>
                        <table class="user-table">
                            <colgroup>
                                <col width="180">
                                <col width="150">
                                <col width="100">
                                <col width="100">
                                <col>
                            </colgroup>
                            <thead>
                            	<tr>
                                    <th><?php echo $this->_var['lang']['purchase_name']; ?></th>
                                    <th><?php echo $this->_var['lang']['purchase_cat']; ?></th>
                                    <th><?php echo $this->_var['lang']['purchase_num']; ?></th>
                                    <th><?php echo $this->_var['lang']['purchase_price']; ?></th>
                                    <th><?php echo $this->_var['lang']['purchase_remarks']; ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $_from = $this->_var['purchase_info']['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');$this->_foreach['goods'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['goods']['total'] > 0):
    foreach ($_from AS $this->_var['goods']):
        $this->_foreach['goods']['iteration']++;
?>
                            	<tr>
                                    <td><?php echo $this->_var['goods']['goods_name']; ?></td>
                                    <td><div class="tDiv"><?php echo $this->_var['goods']['cat_name']; ?></div></td>
                                    <td><?php echo $this->_var['goods']['goods_number']; ?><?php echo $this->_var['lang']['jian']; ?></td>
                                    <td><?php echo $this->_var['goods']['goods_price']; ?><?php echo $this->_var['lang']['yuan']; ?></td>
                                    <td>
                                    	<div class="t-desc"><span><?php echo $this->_var['goods']['remarks']; ?></span></div>
                                        <div class="t-images">
                                            <div class="t-images-info">
                                                <ul>
                                                    <?php $_from = $this->_var['goods']['goods_img']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'img');if (count($_from)):
    foreach ($_from AS $this->_var['img']):
?>
                                                    <li><img src="<?php echo $this->_var['img']; ?>"><a href="<?php echo $this->_var['img']; ?>" class="nyroModal"><i class="iconfont icon-search"></i></a></li>
                                                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                                </ul>
                                            </div>
                                            <a href="javascript:void(0);" class="prev"><i class="iconfont icon-left"></i></a>
                                            <a href="javascript:void(0);" class="next"><i class="iconfont icon-right"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                            </tbody> 
                            <tfoot>
                            	<tr>
                                    <td colspan="5">
                                    	<div class="tfoot-left">
                                            <div class="lie">
                                            	<div class="label"><?php echo $this->_var['lang']['contact_username']; ?>：</div>
                                                <div class="value"><?php echo $this->_var['purchase_info']['contact_name']; ?> <?php echo $this->_var['lang']['contact_gender'][$this->_var['purchase_info']['contact_gender']]; ?></div>
                                            </div>
                                            <div class="lie">
                                            	<div class="label"><?php echo $this->_var['lang']['contact_phone']; ?>：</div>
                                                <div class="value"><?php echo $this->_var['purchase_info']['contact_phone']; ?></div>
                                            </div>
                                            <div class="lie">
                                            	<div class="label"><?php echo $this->_var['lang']['email_reset']; ?>：</div>
                                                <div class="value"><?php echo $this->_var['purchase_info']['contact_email']; ?></div>
                                            </div>
                                        </div>
                                        <div class="tfoot-right">
                                            <div class="lie">
                                            	<div class="label"><?php echo $this->_var['lang']['Invoice_information']; ?>：</div>
                                                <div class="value"><?php echo $this->_var['lang']['need_invoice'][$this->_var['purchase_info']['need_invoice']]; ?> <?php if ($this->_var['purchase_info']['invoice_tax_rate']): ?><?php echo $this->_var['lang']['tax_rate']; ?><?php echo $this->_var['purchase_info']['invoice_tax_rate']; ?><?php endif; ?></div>
                                            </div>
                                            <div class="lie">
                                            	<div class="label"><?php echo $this->_var['lang']['label_address']; ?>：</div>
                                                <div class="value"><?php echo $this->_var['purchase_info']['consignee_region']; ?> <?php echo $this->_var['purchase_info']['consignee_address']; ?></div>
                                            </div>											
                                            <div class="lie">
                                            	<div class="label"><?php echo $this->_var['lang']['label_supplement_explain']; ?>：</div>
                                                <div class="value"><?php echo $this->_var['purchase_info']['description']; ?></div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                
                <div class="user-title">
                    <h2><?php echo $this->_var['lang']['supplier_info']; ?></h2>
                </div>
                <div class="user-supplier-info">
                    <div class="user-items">
						<?php if ($this->_var['purchase_info']['status'] != 1): ?>
                    	<div class="item">
                            <div class="label"><?php echo $this->_var['lang']['corporate_name']; ?>：</div>
                            <div class="value"><input type="text" name="supplier_company_name" value="<?php echo $this->_var['purchase_info']['supplier_company_name']; ?>" class="text"></div>
                        </div>
                        <div class="item">
                            <div class="label"><?php echo $this->_var['lang']['contact_phone']; ?>：</div>
                            <div class="value"><input type="text" name="supplier_contact_phone" value="<?php echo $this->_var['purchase_info']['supplier_contact_phone']; ?>" class="text"></div>
                        </div>
						<?php else: ?>
						<div class="item">
                            <div class="label"><?php echo $this->_var['lang']['corporate_name']; ?>：</div>
                            <div class="value"><span class="lh30"><?php echo $this->_var['purchase_info']['supplier_company_name']; ?></span></div>
                        </div>
                        <div class="item">
                            <div class="label"><?php echo $this->_var['lang']['contact_phone']; ?>：</div>
                            <div class="value"><span class="lh30"><?php echo $this->_var['purchase_info']['supplier_contact_phone']; ?></span></div>
                        </div>
						<?php endif; ?>
                        <?php if ($this->_var['purchase_info']['status'] != 1): ?>
                        <div class="item item-button">
                            <div class="label">&nbsp;</div>
                            <div class="value">
                                <input type="hidden" name="purchase_id" value="<?php echo $this->_var['purchase_info']['purchase_id']; ?>">
                                <input type="hidden" name="act" value="purchase_edit">
                            	<input type="submit" class="sc-btn sc-redBg-btn" name="submit" value="<?php echo $this->_var['lang']['purchase_order']; ?>">
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </form>
        </div>
        <?php endif; ?>
        

        
        <?php if ($this->_var['action'] == 'apply_suppliers'): ?>
        <div class="user-mod">
            <div class="user-title">
                <h2><?php echo $this->_var['lang']['supplier_entry']; ?></h2>
            </div>
            <div class="account-main account-bind">
                <div class="user-items">
                    <?php if (! $this->_var['is_applied']): ?>
                    <form name="apply_suppliers" method="post" action="user.php" enctype="multipart/form-data" class="user-form user-form-safe">
                        <div class="item">
                            <div class="label"><em class="red">*</em><?php echo $this->_var['lang']['Real_name']; ?>：</div>
                            <div class="value">
                                <input class="text text-1" type="text" id="real_name" name="real_name" value="<?php echo $this->_var['supplier']['real_name']; ?>">
                                <div id="span-notify-holderName" class="notic"><?php echo $this->_var['lang']['Real_name_notice']; ?></div>
                                <div class="form_prompt"></div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="label"><em class="red">*</em><?php echo $this->_var['lang']['number_ID']; ?>：</div>
                            <div class="value">
                                <input class="text text-5" type="text" id="self_num" name="self_num" value="<?php echo $this->_var['supplier']['self_num']; ?>">
                                <div class="form_prompt"></div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="label"><em class="red">*</em><?php echo $this->_var['lang']['corporate_name']; ?>：</div>
                            <div class="value">
                                <input class="text text-1" type="text" id="company_name" name="company_name" value="<?php echo $this->_var['supplier']['company_name']; ?>">
                                <div class="notic"></div>
                                <div class="form_prompt"></div>
                            </div>
                        </div>
                        
                        <div class="item">
                            <div class="label"><em class="red">*</em><?php echo $this->_var['lang']['company_address']; ?>：</div>
                            <div class="value">
                                <input class="text text-5" type="text" id="company_address" value="<?php echo $this->_var['supplier']['company_address']; ?>" name="company_address" ectype="company_address">
                                <div class="form_prompt"></div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="label"><em class="red">*</em><?php echo $this->_var['lang']['select_region']; ?>：</div>
                            <div class="value">
                                <dl class="mod-select mod-select-small fl" ectype="smartdropdown">
                                    <dt>
                                        <span class="txt" ectype="txt"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['0']; ?></span>
                                        <input type="hidden" value="<?php echo $this->_var['consignee']['country']; ?>" name="country">
                                    </dt>
                                    <dd ectype="layer">
                                        <?php $_from = $this->_var['country_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'country');if (count($_from)):
    foreach ($_from AS $this->_var['country']):
?>
                                        <div class="option" data-value="<?php echo $this->_var['country']['region_id']; ?>" data-text="<?php echo $this->_var['country']['region_name']; ?>" ectype="ragionItem" data-type="1"><?php echo $this->_var['country']['region_name']; ?></div>
                                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                    </dd>
                                </dl>
                                <dl class="mod-select mod-select-small fl" ectype="smartdropdown">
                                    <dt><span class="txt" ectype="txt"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['1']; ?></span><input type="hidden" value="<?php echo $this->_var['consignee']['province']; ?>" ectype="ragionItem" name="province"></dt>
                                    <dd ectype="layer">
                                        <div class="option" data-value="0"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['1']; ?></div>
                                        <?php $_from = $this->_var['province_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'province_0_21439600_1568788891');if (count($_from)):
    foreach ($_from AS $this->_var['province_0_21439600_1568788891']):
?>
                                        <div class="option" data-value="<?php echo $this->_var['province_0_21439600_1568788891']['region_id']; ?>" data-text="<?php echo $this->_var['province_0_21439600_1568788891']['region_name']; ?>" data-type="2" ectype="ragionItem"><?php echo $this->_var['province_0_21439600_1568788891']['region_name']; ?></div>
                                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                    </dd>
                                </dl>
                                <dl class="mod-select mod-select-small fl" ectype="smartdropdown">
                                    <dt><span class="txt" ectype="txt"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['2']; ?></span><input type="hidden" value="<?php echo $this->_var['consignee']['city']; ?>" name="city" ></dt>
                                    <dd ectype="layer">
                                        <div class="option" data-value="0"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['2']; ?></div>
                                        <?php $_from = $this->_var['city_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'city');if (count($_from)):
    foreach ($_from AS $this->_var['city']):
?>
                                        <div class="option" data-value="<?php echo $this->_var['city']['region_id']; ?>" data-type="3" data-text="<?php echo $this->_var['city']['region_name']; ?>" ectype="ragionItem"><?php echo $this->_var['city']['region_name']; ?></div>
                                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                    </dd>
                                </dl>
                                <div class="form_prompt"></div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="label"><em class="red">*</em><?php echo $this->_var['lang']['cat_name']; ?>：</div>
                            <div class="value"> 
                                <div id="first_cate" class="imitate_select w200 mr10">
                                    <div class="cite"><span><?php echo $this->_var['lang']['please_select']; ?></span><i class="iconfont icon-down"></i></div>
                                    <ul>
                                        <?php $_from = $this->_var['first_cate']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cate');if (count($_from)):
    foreach ($_from AS $this->_var['cate']):
?>
                                        <li><a href="javascript:void(0);" data-value="<?php echo $this->_var['cate']['cat_id']; ?>"><?php echo $this->_var['cate']['cat_name']; ?></a></li>
                                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                    </ul>
                                    <input type="hidden" name="first_cate" value="0" id="first_cate_val"/>
                                </div>                                
                                <div class="category_checkbox_list">
                                    <div class="checkbox_items" id="steps_re_span">
                                    </div>
                                    <div class="m-category-handle">
                                        <div class="checkbox_item" style="width:auto;">
                                            <input type="checkbox" name="all_list" class="ui-checkbox" id="allList" />
                                            <label for="allList" class="ui-label"><?php echo $this->_var['lang']['check_all_back']; ?></label>
                                        </div>
                                        <a href="javascript:void(0);" class="btn btn30 btn_blue" onclick="selectChildCate_cheked()" ><?php echo $this->_var['lang']['add']; ?></a>
                                    </div>
                                </div>
                                <div class="list-div" id="detailCategoryTable">
                                    <table class="m-table mt20" >
                                        <thead>
                                            <tr>
                                                <th width="10%"><?php echo $this->_var['lang']['snumber']; ?></th>
                                                <th width="35%"><?php echo $this->_var['langone_level_directorysnumber']; ?></th>
                                                <th width="35%"><?php echo $this->_var['lang']['two_level_directory']; ?></th>
                                                <th width="20%"><?php echo $this->_var['lang']['handler']; ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $_from = $this->_var['category_info']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('k', 'category_0_21639600_1568788891');if (count($_from)):
    foreach ($_from AS $this->_var['k'] => $this->_var['category_0_21639600_1568788891']):
?>
                                            <tr>
                                                <td align="center">
                                                    <p>
                                                        <span class="index"><?php echo $this->_var['k']; ?></span>
                                                        <input type="hidden" value="<?php echo $this->_var['category_0_21639600_1568788891']['cat_id']; ?>" name="cat_id[]" class="cId">
                                                    </p>
                                                </td>
                                                <td align="center" >
                                                    <p>
                                                        <input type="hidden" value="<?php echo $this->_var['category_0_21639600_1568788891']['parent_name']; ?>" name="parent_name[]" class="cl1Name">
                                                        <?php echo $this->_var['category_0_21639600_1568788891']['parent_name']; ?>
                                                    </p>
                                                </td>
                                                <td align="center">
                                                    <p>
                                                        <input type="hidden" value="<?php echo $this->_var['category_0_21639600_1568788891']['cat_name']; ?>" name="cat_name[]" class="cl2Name">
                                                        <?php echo $this->_var['category_0_21639600_1568788891']['cat_name']; ?>
                                                    </p>
                                                </td>
                                                <td><div class="tDiv"><a class="btn_trash" href="javascript:void(0);" onClick="deleteChildCate(<?php echo $this->_var['category_0_21639600_1568788891']['ct_id']; ?>)"><i class="icon icon-trash"></i><?php echo $this->_var['lang']['drop']; ?></a></div></td>
                                            </tr>
                                        <?php endforeach; else: ?>
                                            <tr><td colspan='4'><?php echo $this->_var['lang']['temporary_not_cat']; ?></td></tr>
                                        <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>                       
                        <div class="item">
                            <div class="label"><em class="red">*</em><?php echo $this->_var['lang']['front_of_id_card']; ?>：</div>
                            <div class="value">
                                <div class="type-file-box">
                                    <input type="button" name="button" id="button" class="type-file-button">
                                    <input type="file" name="front_of_id_card" class="type-file-file" size="30" data-state="imgfile" hidefocus="true" value="">
                                    <?php if ($this->_var['supplier']['front_of_id_card']): ?><span class="show"><a href="<?php echo $this->_var['supplier']['front_of_id_card']; ?>" class="nyroModal"><i class="iconfont icon-picture" onmouseover="toolTip('<img src=<?php echo $this->_var['supplier']['front_of_id_card']; ?>>')" onmouseout="toolTip()"></i></a></span><?php endif; ?>
                                    <input type="text" name="textfile_zheng" class="type-file-text" id="textfile_zheng" value="<?php echo $this->_var['supplier']['front_of_id_card']; ?>" readonly>
                                </div>
                                <div class="form_prompt"></div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="label"><em class="red">*</em><?php echo $this->_var['lang']['reverse_of_id_card']; ?>：</div>
                            <div class="value">
                                <div class="type-file-box">
                                    <input type="button" name="button" id="button" class="type-file-button">
                                    <input type="file" name="reverse_of_id_card" class="type-file-file" size="30" data-state="imgfile" hidefocus="true" value="">
                                    <?php if ($this->_var['supplier']['reverse_of_id_card']): ?><span class="show"><a href="<?php echo $this->_var['supplier']['reverse_of_id_card']; ?>" class="nyroModal"><i class="iconfont icon-picture" onmouseover="toolTip('<img src=<?php echo $this->_var['supplier']['reverse_of_id_card']; ?>>')" onmouseout="toolTip()"></i></a></span><?php endif; ?>
                                    <input type="text" name="textfile_fan" class="type-file-text" id="textfile_fan" value="<?php echo $this->_var['supplier']['reverse_of_id_card']; ?>" readonly>
                                </div>
                                <div class="form_prompt"></div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="label"><?php echo $this->_var['lang']['business_license']; ?>：</div>
                            <div class="value">
                                <div class="type-file-box">
                                    <input type="button" name="button" id="button" class="type-file-button">
                                    <input type="file" name="license_fileImg" class="type-file-file" size="30" data-state="imgfile" hidefocus="true" value="">
                                    <?php if ($this->_var['supplier']['license_fileImg']): ?><span class="show"><a href="<?php echo $this->_var['supplier']['license_fileImg']; ?>" class="nyroModal"><i class="iconfont icon-picture" onmouseover="toolTip('<img src=<?php echo $this->_var['supplier']['license_fileImg']; ?>>')" onmouseout="toolTip()"></i></a></span><?php endif; ?>
                                    <input type="text" name="textfile_zheng" class="type-file-text" id="textfile_zheng" value="<?php echo $this->_var['supplier']['license_fileImg']; ?>" readonly>
                                </div>
                                <div class="form_prompt"></div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="label"><?php echo $this->_var['lang']['institutional_code_certificate']; ?>：</div>
                            <div class="value">
                                <div class="type-file-box">
                                    <input type="button" name="button" id="button" class="type-file-button">
                                    <input type="file" name="organization_fileImg" class="type-file-file" size="30" data-state="imgfile" hidefocus="true" value="">
                                    <?php if ($this->_var['supplier']['organization_fileImg']): ?><span class="show"><a href="<?php echo $this->_var['supplier']['organization_fileImg']; ?>" class="nyroModal"><i class="iconfont icon-picture" onmouseover="toolTip('<img src=<?php echo $this->_var['supplier']['organization_fileImg']; ?>>')" onmouseout="toolTip()"></i></a></span><?php endif; ?>
                                    <input type="text" name="textfile_zheng" class="type-file-text" id="textfile_zheng" value="<?php echo $this->_var['supplier']['organization_fileImg']; ?>" readonly>
                                </div>
                                <div class="form_prompt"></div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="label"><?php echo $this->_var['lang']['account_opening_permit']; ?>：</div>
                            <div class="value">
                                <div class="type-file-box">
                                    <input type="button" name="button" id="button" class="type-file-button">
                                    <input type="file" name="linked_bank_fileImg" class="type-file-file" size="30" data-state="imgfile" hidefocus="true" value="">
                                    <?php if ($this->_var['supplier']['linked_bank_fileImg']): ?><span class="show"><a href="<?php echo $this->_var['supplier']['linked_bank_fileImg']; ?>" class="nyroModal"><i class="iconfont icon-picture" onmouseover="toolTip('<img src=<?php echo $this->_var['supplier']['linked_bank_fileImg']; ?>>')" onmouseout="toolTip()"></i></a></span><?php endif; ?>
                                    <input type="text" name="textfile_zheng" class="type-file-text" id="textfile_zheng" value="<?php echo $this->_var['supplier']['linked_bank_fileImg']; ?>" readonly>
                                </div>
                                <div class="form_prompt"></div>
                            </div>
                        </div>                         
                        <div class="item">
                            <div class="label"><em class="red">*</em><?php echo $this->_var['lang']['label_mobile']; ?>：</div>
                            <div class="value">
                                <input class="text text-1" type="text" id="mobile_phone" name="mobile_phone" value="<?php echo $this->_var['supplier']['bank_mobile']; ?>">
                                <div class="form_prompt"></div>
                            </div>
                        </div>
                        <?php if ($this->_var['enabled_sms_signin']): ?>
                        <div class="item">
                            <div class="label"><?php echo $this->_var['lang']['bindMobile_code']; ?>：</div>
                            <div class="value">
                                <div class="sm-input">
                                    <input name="sms_value" id="sms_value" type="hidden" value="sms_code" />
                                    <input type="text" name="mobile_code" tabindex="1" id="mobile_code" disabled="disabled">
                                    <a href="javascript:sendSms()" id="zphone" class="sms-btn"><?php echo $this->_var['lang']['getMobile_code']; ?></a>
                                </div>
                                <div class="form_prompt"id="phone_captcha"></div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="item item-button">
                            <div class="label">&nbsp;</div>
                            <div class="value">
                                <input id="flag" type="hidden" value="change_password_f" name="flag">
                                <input type="hidden" value="supplier_info" name="act">
                                <input type="submit" id="authSubmit" class="sc-btn sc-redBg-btn" value="<?php echo $this->_var['lang']['submit_goods']; ?>">
                            </div>
                        </div>
                    </form>
                    <?php else: ?>
                    <?php echo $this->_var['lang']['submit_apply']; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
        
        
        
        
         
        <?php if ($this->_var['action'] == 'wholesale_batch_applied'): ?>
        <div class="user-mod user_apply_return">
            <form id="formReturn" name="formReturn" method="post" action="user.php" onsubmit="return check_sub()">      
            <div class="user-title">
                <h2><?php echo $this->_var['lang']['return_list']; ?></h2>
                <a href="user.php?act=service_detail" class="more"><?php echo $this->_var['lang']['service_note']; ?></a>
            </div>
            <div class="uaer-return-app clearfix">
            <?php $_from = $this->_var['goods_return']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
                <div class="tl-item">
                    <div class="item-t b-b-0">
                        <div class="t-goods">
                            <div class="t-img">
                                <?php if ($this->_var['goods']['goods_id'] > 0 && $this->_var['goods']['extension_code'] != 'package_buy'): ?>
                                    <a href="<?php echo $this->_var['goods']['url']; ?>" target="_blank" class="f6">
                                        <img width="55" height="55" src="<?php echo $this->_var['goods']['goods_thumb']; ?>" title="<?php echo $this->_var['goods']['goods_name']; ?>">
                                    </a> 
                                    <?php if ($this->_var['goods']['parent_id'] > 0): ?> 
                                    <span class="red">（<?php echo $this->_var['lang']['accessories']; ?>）</span> 
                                    <?php elseif ($this->_var['goods']['is_gift']): ?> 
                                    <span class="red">（<?php echo $this->_var['lang']['largess']; ?>）</span> 
                                    <?php endif; ?> 
                                <?php elseif ($this->_var['goods']['goods_id'] > 0 && $this->_var['goods']['extension_code'] == 'package_buy'): ?> 
                                    <a href="javascript:void(0)" onclick="setSuitShow(<?php echo $this->_var['goods']['goods_id']; ?>)" class="f6">
                                        <img width="55" height="55" src="<?php echo $this->_var['goods']['goods_thumb']; ?>" title="<?php echo $this->_var['goods']['goods_name']; ?>"><span style="color:#FF0000;"><?php echo $this->_var['lang']['remark_package']; ?></span>
                                    </a>
                                    <div id="suit_<?php echo $this->_var['goods']['goods_id']; ?>" style="display:none"> 
                                        <?php $_from = $this->_var['goods']['package_goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'package_goods_list');if (count($_from)):
    foreach ($_from AS $this->_var['package_goods_list']):
?> 
                                            <a href="<?php echo $this->_var['package_goods_list']['url']; ?>" target="_blank" class="f6">
                                                <img width="55" height="55" src="<?php echo $this->_var['package_goods_list']['goods_thumb']; ?>" title="<?php echo $this->_var['package_goods_list']['goods_name']; ?>">
                                            </a>
                                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="t-info">
                                <div class="info-name"><a href="wholesale_goods.php?id=<?php echo $this->_var['goods']['goods_id']; ?>" class="ftx-03" target="_blank"><?php echo $this->_var['goods']['goods_name']; ?></a></div>
                                <div class="info-price"><b><?php echo $this->_var['goods']['goods_price']; ?></b><i>×</i><span><?php echo $this->_var['goods']['goods_number']; ?></span></div>
                                <div class="info-attr"><?php if ($this->_var['goods']['goods_attr']): ?><?php echo $this->_var['goods']['goods_attr']; ?><?php else: ?><?php echo $this->_var['lang']['nothing']; ?><?php endif; ?></div>
                            </div>
                        </div>
                        <div class="t-statu"><?php echo $this->_var['goods']['subtotal']; ?></div>
                        <input name="return_rec_id[<?php echo $this->_var['goods']['rec_id']; ?>]" value="<?php echo $this->_var['goods']['rec_id']; ?>" type="hidden" />
                        <input name="return_g_id[<?php echo $this->_var['goods']['rec_id']; ?>]" value="<?php echo $this->_var['goods']['goods_id']; ?>" type="hidden" />
                        <input name="return_g_number[<?php echo $this->_var['goods']['rec_id']; ?>]" value="<?php echo $this->_var['goods']['goods_number']; ?>" type="hidden" />
                    </div>
                </div>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            </div>
            <div class="applyReturnForm">
                <div class="return_ts">
                    <em class="fl">* <?php echo $this->_var['lang']['reminder']; ?>：</em>
                    <div class="fl"><?php echo $this->_var['lang']['wholesale_reminder_one']; ?>&nbsp;<em><?php echo $this->_var['suppliers_name']; ?></em>&nbsp;<?php echo $this->_var['lang']['reminder_two']; ?></div>
                </div>
                <div class="form">
                <?php if ($this->_var['goods_cause']): ?>
                <div class="item item1 first">
                    <div class="label"><em>*</em><?php echo $this->_var['lang']['Service_type']; ?>：</div>
                    <div class="value value-checkbox">
                        <?php $_from = $this->_var['goods_cause']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
                        <div class="value-item <?php if ($this->_var['goods']['is_checked'] == 1): ?>selected<?php endif; ?>">
                            <input type="radio" id="service-<?php echo $this->_var['goods']['cause']; ?>" name="return_type" value="<?php echo $this->_var['goods']['cause']; ?>" class="ui-radio" autocomplete="off" <?php if ($this->_var['goods']['is_checked'] == 1): ?>checked<?php endif; ?> />
                            <label for="service-<?php echo $this->_var['goods']['cause']; ?>" class="ui-radio-label"><?php echo $this->_var['goods']['lang']; ?></label>
                        </div>
                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    </div>
                </div>
                <div class="item item1">
                    <div class="label"><?php echo $this->_var['lang']['Application_credentials']; ?>：</div>
                    <div class="value">
                         <input name="credentials" type="checkbox" value="" class="ui-checkbox" id="credentials"/>
                         <label for="credentials" class="ui-label"><?php echo $this->_var['lang']['has_Test_Report']; ?></label>
                    </div>
                </div>
                <div class="item">
                    <div class="label"><em>*</em><?php echo $this->_var['lang']['problem_desc']; ?>：</div>
                    <div class="value"><textarea cols="40" class="text_desc" rows="4" name="return_brief"></textarea></div>
                </div>
                <div class="item">
                    <div class="label"><?php echo $this->_var['lang']['pic_info']; ?>：</div>
                    <div class="value">
                        <div class="upload_img">
                            <div class="SWFUpload"><input type="button" id="uploadbutton" class="button" value="" data-upload_type="wholesale_goods"/></div>
                            <?php echo $this->_var['lang']['pic_info_one']; ?>
                            <div class="up_img return_images"<?php if (! $this->_var['img_list']): ?> style="display:none;"<?php endif; ?>>
                                <div class="mscoll">
                                    <a id="scollUp" class="mleft prev"><i class="iconfont icon-left"></i></a>
                                    <div class="mslist">
                                        <ul class="img-list-li">
                                            <?php $_from = $this->_var['img_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'img');$this->_foreach['return'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['return']['total'] > 0):
    foreach ($_from AS $this->_var['img']):
        $this->_foreach['return']['iteration']++;
?>
                                            <li>
                                                <a href="<?php echo $this->_var['img']['img_file']; ?>" target="_blank"><img class="err-product" width="60" height="60" src="<?php echo $this->_var['img']['img_file']; ?>" /></a>
                                            </li>
                                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                        </ul>
                                    </div>
                                    <a id="scollDown" class="mright next"><i class="iconfont icon-right"></i></a>
                                </div>
                                <a class="apply_goods_return clear_pictures" href="javascript:void(0);"><?php echo $this->_var['lang']['Empty_picture']; ?></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div ectype="return-type">
                    <div class="item">
                        <div class="label"><em>*</em><?php echo $this->_var['lang']['label_address']; ?>：</div>
                        <div class="value">
                            <div class="address" ectype="regionLinkage">
                                <dl class="mod-select mod-select-small" ectype="smartdropdown">
                                    <dt>
                                        <span class="txt" ectype="txt"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['0']; ?></span>
                                        <input type="hidden" value="<?php echo $this->_var['consignee']['country']; ?>" name="country">
                                    </dt>
                                    <dd ectype="layer">
                                        <?php $_from = $this->_var['country_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'country');if (count($_from)):
    foreach ($_from AS $this->_var['country']):
?>
                                        <div class="option" data-value="<?php echo $this->_var['country']['region_id']; ?>" data-text="<?php echo $this->_var['country']['region_name']; ?>" ectype="ragionItem" data-type="1"><?php echo $this->_var['country']['region_name']; ?></div>
                                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                    </dd>
                                </dl>
                                <dl class="mod-select mod-select-small" ectype="smartdropdown">
                                    <dt><span class="txt" ectype="txt"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['1']; ?></span><input type="hidden" value="<?php echo $this->_var['consignee']['province']; ?>" ectype="ragionItem"name="province"></dt>
                                    <dd ectype="layer">
                                        <div class="option" data-value="0"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['1']; ?></div>
                                        <?php $_from = $this->_var['province_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'province_0_22239600_1568788891');if (count($_from)):
    foreach ($_from AS $this->_var['province_0_22239600_1568788891']):
?>
                                        <div class="option" data-value="<?php echo $this->_var['province_0_22239600_1568788891']['region_id']; ?>" data-text="<?php echo $this->_var['province_0_22239600_1568788891']['region_name']; ?>" data-type="2" ectype="ragionItem"><?php echo $this->_var['province_0_22239600_1568788891']['region_name']; ?></div>
                                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                    </dd>
                                </dl>
                                <dl class="mod-select mod-select-small" ectype="smartdropdown">
                                    <dt><span class="txt" ectype="txt"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['2']; ?></span><input type="hidden" value="<?php echo $this->_var['consignee']['city']; ?>" name="city" ></dt>
                                    <dd ectype="layer">
                                        <div class="option" data-value="0"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['2']; ?></div>
                                        <?php $_from = $this->_var['city_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'city');if (count($_from)):
    foreach ($_from AS $this->_var['city']):
?>
                                        <div class="option" data-value="<?php echo $this->_var['city']['region_id']; ?>" data-type="3" data-text="<?php echo $this->_var['city']['region_name']; ?>" ectype="ragionItem"><?php echo $this->_var['city']['region_name']; ?></div>
                                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                    </dd>
                                </dl>
                                <dl class="mod-select mod-select-small" ectype="smartdropdown" style="display:none">
                                    <dt><span class="txt" ectype="txt"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['3']; ?></span><input type="hidden" value="<?php echo $this->_var['consignee']['district']; ?>" name="district"></dt>
                                    <dd ectype="layer">
                                        <div class="option" data-value="0"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['3']; ?></div>
                                        <?php $_from = $this->_var['district_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'district');if (count($_from)):
    foreach ($_from AS $this->_var['district']):
?>
                                        <div class="option" data-value="<?php echo $this->_var['district']['region_id']; ?>" data-type="4" data-text="<?php echo $this->_var['district']['region_name']; ?>" ectype="ragionItem"><?php echo $this->_var['district']['region_name']; ?></div>
                                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                    </dd>
                                </dl>
                                <dl class="mod-select mod-select-small" ectype="smartdropdown" style="display:none">
                                    <dt><span class="txt" ectype="txt"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['3']; ?></span><input type="hidden" value="<?php echo $this->_var['consignee']['street']; ?>" name="street"></dt>
                                    <dd ectype="layer">
                                        <div class="option" data-value="0"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['3']; ?></div>
                                        <?php $_from = $this->_var['street_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'street');if (count($_from)):
    foreach ($_from AS $this->_var['street']):
?>
                                        <div class="option" data-value="<?php echo $this->_var['street']['region_id']; ?>" data-type="5" data-text="<?php echo $this->_var['street']['region_name']; ?>" ectype="ragionItem"><?php echo $this->_var['street']['region_name']; ?></div>
                                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                    </dd>
                                </dl>
                            </div>
                            <div class="address_xq">
                                <input type="text" class="text_item"  name="return_address" value="<?php echo $this->_var['consignee']['address']; ?>" size="42"/>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="label"><em>*</em><?php echo $this->_var['lang']['Contact_name']; ?>：</div>
                        <div class="value">
                            <input type="text" class="text_item"  name="addressee" value="<?php echo $this->_var['consignee']['consignee']; ?>" size="42"/>
                            <input type="hidden" name="hid1" value="<?php echo $this->_var['consignee']['consignee']; ?>"/>
                        </div>
                    </div>
                    <div class="item">
                        <div class="label"><em>*</em><?php echo $this->_var['lang']['label_mobile']; ?>：</div>
                        <div class="value">
                            <input type="text" class="text_item"  name="mobile" value="<?php echo $this->_var['consignee']['mobile']; ?>" size="42"/>
                        </div>
                    </div>
                    <div class="item">
                        <div class="label"><?php echo $this->_var['lang']['email_user']; ?>：</div>
                        <div class="value">
                            <input type="text" class="text_item" name="code" value="<?php echo $this->_var['consignee']['zipcode']; ?>" size="42"/>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="label"><?php echo $this->_var['lang']['type']['0']; ?>：</div>
                    <div class="value">
                        <textarea cols="40" class="text_area" rows="4" name="return_remark"></textarea>
                    </div>
                </div>
                <div class="item">
                    <div class="label">&nbsp;</div>
                    <div class="value">
                        <input type="hidden" name="chargeoff_status" value="<?php echo $this->_var['order']['chargeoff_status']; ?>" />
                        <input type="submit" value="<?php echo $this->_var['lang']['submit_goods']; ?>" class="sc-btn btn30 sc-redBg-btn" />
                        <input type="hidden" name="act" value="wholesale_submit_batch_return" />
                    </div>
                </div>
                <?php else: ?>
                <div class="no_records">
                    <i class="no_icon_two"></i>
                    <div class="no_info"><h3><?php echo $this->_var['lang']['no_support_return']; ?></h3></div>
                </div>
                <?php endif; ?>
                </div>
            </div>
        </form>         
        </div>  
        <?php endif; ?>
         
        
        
        <?php if ($this->_var['action'] == 'wholesale_return_list'): ?>
        <div class="user-mod">
            <div class="user-title">
                <h2><?php echo $this->_var['lang']['label_return']; ?></h2>
                <h3><?php echo $this->_var['lang']['youhave']; ?><span class="red"><?php echo $this->_var['pager']['record_count']; ?></span><?php echo $this->_var['lang']['return_goods_user']; ?></h3>
            </div>
            <div id="return_list">
                <?php echo $this->fetch('library/user_wholesale_return_order_list.lbi'); ?>
            </div>
            <?php if ($this->_var['orders']): ?>
                <?php echo $this->fetch('library/pages.lbi'); ?>
            <?php endif; ?>
        </div>
        <?php endif; ?> 
        
        
        
        <?php if ($this->_var['action'] == 'wholesale_return_detail'): ?>       
        <form id="returnInfo" name="returnInfo" method="post" action="user.php" onsubmit="return shipping_sub(this)">
        <div class="user-mod user-order-detail">
            <div class="user-title mb0">
                <h2><?php echo $this->_var['lang']['detailed_info']; ?></h2>
            </div>
            <div class="user-info-list b-t-0">
                <div class="info-title"><h2><?php echo $this->_var['lang']['detailed_info']; ?></h2></div>
                <div class="info-content">
                    <div class="info-item">
                        <div class="item-label"><?php echo $this->_var['lang']['return_sn']; ?>：</div>
                        <div class="item-value"><?php echo $this->_var['goods']['return_sn']; ?></div>
                    </div>
                    <div class="info-item">
                        <div class="item-label"><?php echo $this->_var['lang']['apply_time']; ?>：</div>
                        <div class="item-value"><?php echo $this->_var['goods']['apply_time']; ?></div>
                    </div>
                    <div class="info-item">
                        <div class="item-label"><?php echo $this->_var['lang']['return_type_user']; ?>：</div>
                        <div class="item-value"><?php if ($this->_var['goods']['return_type'] == 0): ?><?php echo $this->_var['lang']['order_return_type']['0']; ?><?php elseif ($this->_var['goods']['return_type'] == 1): ?><?php echo $this->_var['lang']['order_return_type']['1']; ?><?php elseif ($this->_var['goods']['return_type'] == 2): ?><?php echo $this->_var['lang']['order_return_type']['2']; ?><?php elseif ($this->_var['goods']['return_type'] == 3): ?><?php echo $this->_var['lang']['order_return_type']['3']; ?><?php endif; ?></div>
                    </div>
                </div>
            </div>
            <div class="user-info-list">
                <div class="info-title"><h2><?php echo $this->_var['lang']['order_status']; ?></h2></div>
                <div class="info-content">
                    <div class="info-item">
                        <div class="item-label"><?php echo $this->_var['lang']['order_status']; ?>：</div>
                        <div class="item-value"><?php echo $this->_var['goods']['return_status']; ?></div>
                    </div>
                    <div class="info-item">
                        <div class="item-label"><?php echo $this->_var['lang']['back_cause']; ?>：</div>
                        <div class="item-value"><?php echo $this->_var['goods']['return_brief']; ?></div>
                    </div>
                    <div class="info-item">
                        <div class="item-label"><?php echo $this->_var['lang']['order_status']; ?>：</div>
                        <div class="item-value ftx-01"><?php if ($this->_var['goods']['return_status1'] < 0): ?><?php echo $this->_var['lang']['only_return_money']; ?><?php else: ?><?php echo $this->_var['lang']['rf'][$this->_var['goods']['return_status1']]; ?><?php endif; ?>-<?php echo $this->_var['lang']['ff'][$this->_var['goods']['refound_status1']]; ?></div>
                    </div>
                    <?php if ($this->_var['goods']['action_note']): ?>
                    <div class="info-item">
                        <div class="item-label"><?php echo $this->_var['lang']['after_service_desc']; ?>：</div>
                        <div class="item-value"><?php echo $this->_var['goods']['action_note']; ?></div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="user-info-list">
                <div class="info-title"><h2><?php echo $this->_var['lang']['contact_username']; ?></h2></div>
                <div class="info-content">
                    <div class="info-item">
                        <div class="item-label"><?php echo $this->_var['lang']['contact_username']; ?>：</div>
                        <div class="item-value"><?php echo $this->_var['goods']['addressee']; ?></div>
                    </div>
                    <div class="info-item">
                        <div class="item-label"><?php echo $this->_var['lang']['Contact_address']; ?>：</div>
                        <div class="item-value"><?php echo $this->_var['goods']['address_detail']; ?></div>
                    </div>
                    <div class="info-item">
                        <div class="item-label"><?php echo $this->_var['lang']['contact_phone']; ?>：</div>
                        <div class="item-value"><?php echo $this->_var['goods']['phone']; ?></div>
                    </div>
                </div>
            </div>
            <?php if ($this->_var['goods']['return_type'] == 2): ?>
            <div class="user-info-list">
                <div class="info-title"><h2><?php echo $this->_var['lang']['progress_return']; ?></h2></div>
                <div class="user-order-list">
                    <dl class="item relative">
                        <dt class="item-t b-b-0">
                            <div class="t-statu"><?php if ($this->_var['goods']['return_status1'] == 4): ?><?php echo $this->_var['lang']['is_confirmed']; ?><?php else: ?><?php echo $this->_var['lang']['zc_ss']; ?><?php endif; ?></div>
                            <div class="t-info">
                                <span class="info-item"><?php echo $this->_var['lang']['order_number']; ?>：<?php echo $this->_var['goods']['order_sn']; ?></span>
                                <span class="info-item"><?php echo $this->_var['lang']['Waybill']; ?>：<?php if ($this->_var['goods']['out_invoice_no'] != ""): ?><?php echo $this->_var['goods']['out_invoice_no']; ?><?php else: ?>&nbsp;<?php endif; ?></span>
                                <span class="info-item"><?php echo $this->_var['lang']['Logistics_company']; ?>：<?php if ($this->_var['goods']['out_invoice_no'] != ""): ?><?php echo $this->_var['goods']['out_shipp_shipping']; ?><?php else: ?>&nbsp;<?php endif; ?></span>
                            </div>
                            <div class="t-right" ectype="track-packages-btn">
                                <a href="javascript:void(0)" class="sc-btn"><i class="iconfont icon-truck"></i><?php echo $this->_var['lang']['Track']; ?></a>
                                <div class="comment-box" ectype="track-packages-info">
                                    <i class="box-i"></i>
                                    <div class="conmment-box-content">
                                        <div class="cont" id="seller_deliveryInfo">
                                            
                                        </div>
                                    </div>
                                </div>
                                <span id="invoice_no_<?php echo $this->_var['goods']['order_id']; ?>" style="display:none"><?php echo $this->_var['goods']['out_invoice_no']; ?></span>
                                <span id="shipping_name_<?php echo $this->_var['goods']['order_id']; ?>" style="display:none"><?php echo $this->_var['goods']['out_shipp_shipping']; ?></span>
                            </div>
                        </dt>
                    </dl>
                </div>
            </div>
            <?php if ($this->_var['goods']['out_invoice_no']): ?>          
            <script language="javascript">
            $("#seller_deliveryInfo").html("<center>"+json_languages.logistics_tracking_in+"</center>");
            if(document.getElementById("shipping_name_<?php echo $this->_var['goods']['order_id']; ?>"))
            {
                var expressid = document.getElementById("shipping_name_<?php echo $this->_var['goods']['order_id']; ?>").innerHTML;
                var expressno = document.getElementById("invoice_no_<?php echo $this->_var['goods']['order_id']; ?>").innerHTML;
            }
            $.ajax({
                url: "plugins/kuaidi/express.php",
                type: "post",
                data:'com=' + expressid + '&nu=' + expressno,
                success: function(data,textStatus){
                    $("#seller_deliveryInfo").html(data);
                },
                 error: function(o){
                }
            });
            </script> 
            <?php endif; ?>
            <?php endif; ?>
            
            <?php if ($this->_var['goods']['agree_apply'] && $this->_var['goods']['return_type'] != 3): ?>
            
            <div class="user-info-list">
                <div class="info-title">
                    <h2><?php echo $this->_var['lang']['Express_info']; ?></h2>
                </div>
                <?php if ($this->_var['goods']['back_shipp_shipping']): ?>
                <div class="express_list">
                    <div class="ex_tit"><?php echo $this->_var['lang']['User_sent']; ?></div>
                    <div class="ex_con">
                        <div class="ex_item">
                            <span><?php echo $this->_var['lang']['Express_company']; ?>：</span>
                            <span class="blue"><?php echo $this->_var['goods']['back_shipp_shipping']; ?></span>
                        </div>
                        <div class="ex_item">
                            <span><?php echo $this->_var['lang']['courier_sz']; ?>：</span>
                            <span class="blue"><?php echo $this->_var['goods']['back_invoice_no']; ?></span>
                        </div>
                    </div>
                </div>  
                <div class="blank"></div>
                <?php else: ?>
                <div class="express_list">
                    <div class="ex_tit lh26"><?php echo $this->_var['lang']['Express_info_two']; ?></div>
                    <div class="ex_con">
                        <div class="ex_item">
                            <span><?php echo $this->_var['lang']['Express_company']; ?>：</span>
                            <select name="express_name" onchange="select_express(this)" class="select">
                                <option value="0"><?php echo $this->_var['lang']['select_Express_company']; ?></option><?php $_from = $this->_var['shipping_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'shipping');if (count($_from)):
    foreach ($_from AS $this->_var['shipping']):
?>
                                <option value="<?php echo $this->_var['shipping']['shipping_id']; ?>"><?php echo $this->_var['shipping']['shipping_name']; ?></option><?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                <option value="999"><?php echo $this->_var['lang']['Other']; ?></option>
                            </select>
                            <input type="text" name="other_express" id="other_express" class="ml10"  style="display:none"/>
                        </div>
                        <div class="ex_item">
                            <span><?php echo $this->_var['lang']['courier_sz']; ?>：</span>
                            <input type="text" name="express_sn" class="text text-2"/>
                        </div>
                        <input type="submit" class="btn sc-redBg-btn btn30 ml75" value="<?php echo $this->_var['lang']['button_submit']; ?>"/>
                        <input type="hidden" name="act" value="wholesale_edit_express">
                        <input type="hidden" name="order_id" value="<?php echo $this->_var['goods']['order_id']; ?>" />
                        <input type="hidden" name="ret_id" value="<?php echo $this->_var['goods']['ret_id']; ?>" />
                    </div>
                </div>
                <?php endif; ?>
                <?php if ($this->_var['goods']['out_shipp_shipping']): ?>
                <div class="express_list">
                    <div class="ex_tit"><?php echo $this->_var['lang']['seller_shipping']; ?></div>
                    <div class="ex_con">
                        <div class="ex_item">
                            <span><?php echo $this->_var['lang']['Express_company']; ?>：</span>
                            <span class="blue"><?php echo $this->_var['goods']['out_shipp_shipping']; ?></span>
                        </div>
                        <div class="ex_item">
                            <span><?php echo $this->_var['lang']['courier_sz']; ?>：</span>
                            <span class="blue"><?php echo $this->_var['goods']['out_invoice_no']; ?></span>
                        </div>
                    </div>        
                </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            <div class="user-table-list">
                <div class="pt10 pb10">
                <a href="<?php echo $this->_var['goods']['shop_url']; ?>" class="user-shop-link"><?php echo $this->_var['goods']['suppliers_name']; ?></a>
                    <?php if ($this->_var['goods']['is_IM'] == 1 || $this->_var['goods']['is_dsc']): ?>
                    <a id="IM" onclick="openWin(this)" href="javascript:;" ru_id="<?php echo $this->_var['goods']['ru_id']; ?>"  class="iconfont icon-kefu user-shop-kefu"></a>
                    <?php else: ?>
                    <?php if ($this->_var['goods']['kf_type'] == 1): ?>
                    <a href="http://www.taobao.com/webww/ww.php?ver=3&touid=<?php echo $this->_var['goods']['kf_ww']; ?>&siteid=cntaobao&status=1&charset=utf-8" class="iconfont icon-kefu user-shop-kefu" target="_blank"></a>
                    <?php else: ?>
                    <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $this->_var['goods']['kf_qq']; ?>&site=qq&menu=yes" class="iconfont icon-kefu user-shop-kefu" target="_blank"></a>
                    <?php endif; ?>
                    <?php endif; ?>                   
                </div>
                <table class="user-table user-table-detail-goods">
                    <colgroup>
                        <col width="320">
                        <col width="110">
                        <col width="120">
                        <col width="95">
                        <col width="90">
                        <col>
                    </colgroup>
                    <thead>
                        <tr>
                            <th><?php echo $this->_var['lang']['goods']; ?></th>
                            <th class="tl"><?php echo $this->_var['lang']['goods_attr']; ?></th>
                            <th class="tl"><?php echo $this->_var['lang']['unit_price_user']; ?></th>
                            <th class="tl"><?php echo $this->_var['lang']['number_to']; ?></th>
                            <th><?php echo $this->_var['lang']['ws_subtotal']; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <a href="<?php echo $this->_var['goods']['url']; ?>" class="img"><img src="<?php echo $this->_var['goods']['goods_thumb']; ?>" alt=""></a>                      
                                <a href="<?php echo $this->_var['goods']['url']; ?>" class="name"><?php echo sub_str($this->_var['goods']['goods_name'],25); ?></a>
                            </td>
                            <td><?php echo nl2br($this->_var['goods']['goods_attr']); ?></td>
                            <td><?php echo $this->_var['goods']['goods_price']; ?></td>
                            <td>x<?php echo $this->_var['goods']['return_number']; ?></td>
                            <td><?php echo $this->_var['goods']['should_return']; ?></td>
                        </tr>
                    </tbody>
                </table>
                <?php if ($this->_var['goods']['return_type'] == 1 || $this->_var['goods']['return_type'] == 3): ?>
                    <?php if ($this->_var['goods']['return_shipping_fee'] && $this->_var['goods']['refound_status1'] == 1): ?>
                    <div class="user-order-detail-total" style="margin-bottom:0px;">
                        <dl class="total-row" style="margin-top:0px; margin-bottom:0px;">
                            <dt class="total-label"><?php echo $this->_var['lang']['amount_return']; ?>：</dt>
                            <dd class="total-value" style="font-size:14px; font-weight:normal; color:#999"> + <?php echo $this->_var['goods']['formated_should_return']; ?></dd>
                        </dl>
                    </div>
                    <div class="user-order-detail-total" style="margin-top:0px;">
                        <dl class="total-row" style="margin-top:0px;">
                            <dt class="total-label"><?php echo $this->_var['lang']['return_total']; ?>：</dt>
                            <dd class="total-value" style="font-size:18px; font-weight:normal"><?php echo $this->_var['goods']['formated_return_amount']; ?></dd>
                        </dl>
                    </div>
                    <?php else: ?>
                    <div class="user-order-detail-total">
                        <dl class="total-row">
                            <dt class="total-label"><?php echo $this->_var['lang']['amount_return']; ?>：</dt>
                            <dd class="total-value"><?php echo $this->_var['goods']['should_return']; ?></dd>
                        </dl>
                    </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            <?php if ($this->_var['goods']['img_list']): ?>
            <div class="user-info-list b-t-0">
                <div class="info-title"><h2><?php echo $this->_var['lang']['pic_voucher']; ?></h2></div>
                <div class="info-content">
                    <div class="info-item info-item-100">
                        <?php $_from = $this->_var['goods']['img_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'img');if (count($_from)):
    foreach ($_from AS $this->_var['img']):
?>
                        <a href="<?php echo $this->_var['img']['img_file']; ?>" target="_blank"><img src="<?php echo $this->_var['img']['img_file']; ?>" width="100" height="100" style="border:1px #ccc solid; padding:2px;" /></a>
                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            
        </div>
        </form>
        <?php endif; ?> 
              
        
         
        <?php if ($this->_var['action'] == 'wholesale_goods_order'): ?>
        <div class="user-mod">
            <div class="user-title">
                <h2><?php echo $this->_var['lang']['return_policy_apply']; ?></h2>
            </div>
            <form method="post" action="user.php" name="theFrom" id="theFrom">
                <div class="uaer-return-app clearfix">
                    <?php if ($this->_var['package_buy']): ?>
                    <div class="no_records">
                        <i class="no_icon_two"></i>
                        <div class="no_info"><h3><?php echo $this->_var['lang']['package_buy_notic']; ?></h3></div>
                    </div>              
                    <?php else: ?>         
                    <?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
                    <div class="tl-item">
                        <div class="item-t">
                            <div class="t-goods">
                                <div class="t-img">
                                    <?php if ($this->_var['goods']['goods_id'] > 0 && $this->_var['goods']['extension_code'] != 'package_buy'): ?> 
                                        <a href="<?php echo $this->_var['goods']['url']; ?>" target="_blank" class="f6"><img width="55" height="55" src="<?php echo $this->_var['goods']['goods_thumb']; ?>" title="<?php echo $this->_var['goods']['goods_name']; ?>"></a> 
                                    <?php if ($this->_var['goods']['parent_id'] > 0): ?> 
                                        <span style="color:#FF0000">（<?php echo $this->_var['lang']['accessories']; ?>）</span> 
                                    <?php elseif ($this->_var['goods']['is_gift']): ?> 
                                        <span style="color:#FF0000">（<?php echo $this->_var['lang']['largess']; ?>）</span> 
                                    <?php endif; ?> 
                                    <?php elseif ($this->_var['goods']['goods_id'] > 0 && $this->_var['goods']['extension_code'] == 'package_buy'): ?> 
                                        <a href="javascript:void(0)" onclick="setSuitShow(<?php echo $this->_var['goods']['goods_id']; ?>)" class="f6"><img width="55" height="55" src="<?php echo $this->_var['goods']['goods_thumb']; ?>" title="<?php echo $this->_var['goods']['goods_name']; ?>"><span style="color:#FF0000;"><?php echo $this->_var['lang']['remark_package']; ?></span></a>
                                        <div id="suit_<?php echo $this->_var['goods']['goods_id']; ?>" style="display:none"> 
                                            <?php $_from = $this->_var['goods']['package_goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'package_goods_list');if (count($_from)):
    foreach ($_from AS $this->_var['package_goods_list']):
?> 
                                                <a href="<?php echo $this->_var['package_goods_list']['url']; ?>" target="_blank" class="f6"><img width="55" height="55" src="<?php echo $this->_var['goods']['goods_thumb']; ?>" title="<?php echo $this->_var['goods']['goods_name']; ?>"></a><br />
                                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="t-info">
                                    <div class="info-name"><a href="<?php echo $this->_var['goods']['url']; ?>" class="ftx-03" target="_blank"><?php echo $this->_var['goods']['goods_name']; ?></a></div>
                                    <div class="info-price"><b><?php echo $this->_var['goods']['goods_price']; ?></b><i>×</i><span><?php echo $this->_var['goods']['goods_number']; ?></span></div>
                                    <div class="info-attr"><?php if ($this->_var['goods']['goods_attr']): ?><?php echo $this->_var['goods']['goods_attr']; ?><?php else: ?><?php echo $this->_var['lang']['nothing']; ?><?php endif; ?></div>
                                </div>
                            </div>
                            <div class="t-statu">
                            <?php if ($this->_var['goods']['is_refound'] > 0): ?>
                                <span class="ftx-01 fs14"><?php echo $this->_var['lang']['Have_applied']; ?></span> 
                            <?php else: ?> 
                                <a href="user.php?act=wholesale_apply_return&rec_id=<?php echo $this->_var['goods']['rec_id']; ?>&order_id=<?php echo $this->_var['order_id']; ?>" class="sc-btn"><?php echo $this->_var['lang']['applied']; ?></a> 
                            <?php endif; ?>
                            </div>
                        </div>
                        <div class="item-f">
                            <div class="f-left">
                                <div class="checkbox">
                                    <input type="checkbox" name="checkboxes[]" value="<?php echo $this->_var['goods']['rec_id']; ?>" class="ui-checkbox" id="checkbox_<?php echo $this->_var['goods']['rec_id']; ?>" />
                                    <label for="checkbox_<?php echo $this->_var['goods']['rec_id']; ?>" class="ui-label"></label>
                                </div>
                            </div>
                            <div class="f-right">
                                <span class="red mr50"><?php if ($this->_var['goods']['goods_cause']): ?><?php echo $this->_var['lang']['only_support']; ?>：<?php $_from = $this->_var['goods']['goods_cause']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cause');$this->_foreach['goods_cause'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['goods_cause']['total'] > 0):
    foreach ($_from AS $this->_var['cause']):
        $this->_foreach['goods_cause']['iteration']++;
?><?php if (! ($this->_foreach['goods_cause']['iteration'] == $this->_foreach['goods_cause']['total'])): ?><?php echo $this->_var['cause']['lang']; ?>、<?php else: ?><?php echo $this->_var['cause']['lang']; ?><?php endif; ?><?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?><?php else: ?><?php echo $this->_var['lang']['no_support_return']; ?><?php endif; ?></span>
                                <span><?php echo $this->_var['lang']['shopping_money']; ?><?php if ($this->_var['order']['extension_code'] == "group_buy"): ?><?php echo $this->_var['lang']['gb_deposit']; ?><?php endif; ?>：<?php echo $this->_var['goods']['subtotal']; ?></span>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; else: ?>
                    <div class="no_records">
                        <i class="no_icon_two"></i>
                        <div class="no_info"><h3><?php echo $this->_var['lang']['order_not_notic']; ?></h3></div>
                    </div>
                    <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    <div class="tl-tfoor">
                        <div class="checkbox">
                            <input type="checkbox" name="all_list" class="ui-checkbox" id="checkbox_stars" />
                            <label for="checkbox_stars" class="ui-label"><?php echo $this->_var['lang']['all']; ?></label>
                        </div>
                        <a href="javascript:;" class="sc-btn" ectype="submitBtn" ><?php echo $this->_var['lang']['batch_applied']; ?></a>
                        <input type="hidden" name="act" value="wholesale_batch_applied">
                        <input type="hidden" name="order_id" value="<?php echo $this->_var['order_id']; ?>">
                    </div>
                    <?php endif; ?>
                </div>
            </form>
        </div>
        <?php endif; ?>
        
        
         
        <?php if ($this->_var['action'] == 'wholesale_apply_return'): ?>
        <div class="user-mod user_apply_return">
            <div class="user-title">
                <h2><?php echo $this->_var['lang']['return_list']; ?></h2>
                <a href="user.php?act=service_detail" class="more"><?php echo $this->_var['lang']['service_note']; ?></a>
            </div>
            <div class="uaer-return-app clearfix">
                <div class="tl-item">
                    <div class="item-t b-b-0">
                        <div class="t-goods">
                            <div class="t-img">
                                <?php if ($this->_var['goods_return']['goods_id'] > 0 && $this->_var['goods_return']['extension_code'] != 'package_buy'): ?> 
                                    <a href="<?php echo $this->_var['goods_return']['url']; ?>" target="_blank" class="f6">
                                        <img width="55" height="55" src="<?php echo $this->_var['goods_return']['goods_thumb']; ?>" title="<?php echo $this->_var['goods_return']['goods_name']; ?>">
                                    </a> 
                                    <?php if ($this->_var['goods_return']['parent_id'] > 0): ?> 
                                    <span class="red">（<?php echo $this->_var['lang']['accessories']; ?>）</span> 
                                    <?php elseif ($this->_var['goods_return']['is_gift']): ?> 
                                    <span class="red">（<?php echo $this->_var['lang']['largess']; ?>）</span> 
                                    <?php endif; ?> 
                                <?php elseif ($this->_var['goods_return']['goods_id'] > 0 && $this->_var['goods_return']['extension_code'] == 'package_buy'): ?> 
                                    <a href="javascript:void(0)" onclick="setSuitShow(<?php echo $this->_var['goods_return']['goods_id']; ?>)" class="f6">
                                        <img width="55" height="55" src="<?php echo $this->_var['goods_return']['goods_thumb']; ?>" title="<?php echo $this->_var['goods_return']['goods_name']; ?>"><span style="color:#FF0000;"><?php echo $this->_var['lang']['remark_package']; ?></span>
                                    </a>
                                    <div id="suit_<?php echo $this->_var['goods_return']['goods_id']; ?>" style="display:none"> 
                                        <?php $_from = $this->_var['goods_return']['package_goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'package_goods_list');if (count($_from)):
    foreach ($_from AS $this->_var['package_goods_list']):
?> 
                                            <a href="<?php echo $this->_var['package_goods_list']['url']; ?>" target="_blank" class="f6">
                                                <img width="55" height="55" src="<?php echo $this->_var['package_goods_list']['goods_thumb']; ?>" title="<?php echo $this->_var['package_goods_list']['goods_name']; ?>">
                                            </a>
                                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="t-info">
                                <div class="info-name"><a href="goods.php?id=<?php echo $this->_var['goods_return']['goods_id']; ?>" class="ftx-03" target="_blank"><?php echo $this->_var['goods_return']['goods_name']; ?></a></div>
                                <div class="info-price"><b><?php echo $this->_var['goods_return']['goods_price']; ?></b><i>×</i><span><?php echo $this->_var['goods_return']['goods_number']; ?></span></div>
                                <div class="info-attr"><?php if ($this->_var['goods_return']['goods_attr']): ?><?php echo $this->_var['goods_return']['goods_attr']; ?><?php else: ?><?php echo $this->_var['lang']['nothing']; ?><?php endif; ?></div>
                            </div>
                        </div>
                        <div class="t-statu"><?php echo $this->_var['goods_return']['subtotal']; ?></div>
                    </div>
                </div>
            </div>
            <div class="applyReturnForm">
                <form id="formReturn" name="formReturn" method="post" action="user.php" onsubmit="return check_sub()">
                    <div class="return_ts">
                        <em class="fl">* <?php echo $this->_var['lang']['reminder']; ?>：</em>
                        <div class="fl"><?php echo $this->_var['lang']['wholesale_reminder_one']; ?>&nbsp;<em><?php echo $this->_var['goods_return']['suppliers_name']; ?></em>&nbsp;<?php echo $this->_var['lang']['reminder_two']; ?></div>
                    </div>
                    <div class="form">
                        <?php if ($this->_var['goods_cause']): ?>
                        <div class="item item1 first">
                            <div class="label"><em>*</em><?php echo $this->_var['lang']['Service_type']; ?>：</div>
                            <div class="value value-checkbox">
                                <?php $_from = $this->_var['goods_cause']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
                                    <?php if ($this->_var['order']['shipping_status'] == 1 || ( $this->_var['order']['shipping_status'] != 1 && $this->_var['goods']['cause'] == 3 )): ?>
                                    <div class="value-item <?php if ($this->_var['goods']['is_checked'] == 1): ?>selected<?php endif; ?>">
                                        <input type="radio" id="service-<?php echo $this->_var['goods']['cause']; ?>" name="return_type" value="<?php echo $this->_var['goods']['cause']; ?>" class="ui-radio" autocomplete="off" <?php if ($this->_var['goods']['is_checked'] == 1): ?>checked<?php endif; ?> />
                                        <label for="service-<?php echo $this->_var['goods']['cause']; ?>" class="ui-radio-label"><?php echo $this->_var['goods']['lang']; ?></label>
                                    </div>
                                    <?php endif; ?>
                                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                <input name="return_rec_id" value="<?php echo $this->_var['goods_return']['rec_id']; ?>" type="hidden" />
                                <input name="return_g_id" value="<?php echo $this->_var['goods_return']['goods_id']; ?>" type="hidden" />
                                <input name="return_g_number" value="<?php echo $this->_var['goods_return']['goods_number']; ?>" type="hidden" />
                            </div>
                            <div class="lists" ectype="return_lists">
                                <div class="return_div" ectype="return_div">
                                    <div class="type_box1" name="type_maintain" id="maintain_<?php echo $this->_var['goods_return']['rec_id']; ?>">
                                        <div class="type_item"><?php echo $this->_var['lang']['Repair_number']; ?>：</div>
                                        <div class="type_con">
                                            <a onclick="buyNumber.minus(this, 1)" href="javascript:;" id="decrease" class="plus_minus"><i class="iconfont icon-reduce"></i></a>
                                            <input type="text" class="return_num" defaultnumber="1" value="1" id="maintain_<?php echo $this->_var['goods_return']['rec_id']; ?>" name="maintain_number" onblur="check_return_num(this,<?php echo $this->_var['goods_return']['goods_number']; ?> ,<?php echo $this->_var['goods_return']['rec_id']; ?>, 1)"/>
                                            <a onclick="buyNumber.plus(this, 1)" href="javascript:;" id="increase" class="plus_minus"><i class="iconfont icon-plus"></i></a>
                                            <div class="return_sm">(<?php echo $this->_var['lang']['Repair_one']; ?><span><?php echo $this->_var['goods_return']['goods_number']; ?></span><?php echo $this->_var['lang']['Repair_two']; ?><span id="maintain_span_<?php echo $this->_var['goods_return']['rec_id']; ?>" name="maintain">1</span><?php echo $this->_var['lang']['jian']; ?>)</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="return_div" ectype="return_div" style="display:none;">
                                    <div class="type_box1" name="type_box1" id="returnid_<?php echo $this->_var['goods_return']['rec_id']; ?>">
                                        <div class="type_item"><?php echo $this->_var['lang']['return_number']; ?>：</div>
                                        <div class="type_con">
                                            <a onclick="buyNumber.minus(this, 1)" href="javascript:;" id="decrease" class="plus_minus"><i class="iconfont icon-reduce"></i></a>
                                            <input type="text" class="return_num" defaultnumber="1" value="1" id="returnid_<?php echo $this->_var['goods_return']['rec_id']; ?>" name="return_num" onblur="check_return_num(this,<?php echo $this->_var['goods_return']['goods_number']; ?> ,<?php echo $this->_var['goods_return']['rec_id']; ?>, 2)" />
                                            <a onclick="buyNumber.plus(this, 1)" href="javascript:;" id="increase" class="plus_minus"><i class="iconfont icon-plus"></i></a>
                                            <div class="return_sm">(<?php echo $this->_var['lang']['return_one']; ?><span><?php echo $this->_var['goods_return']['goods_number']; ?></span><?php echo $this->_var['lang']['return_two']; ?><span id="retired_<?php echo $this->_var['goods_return']['rec_id']; ?>" name="retired">1</span><?php echo $this->_var['lang']['jian']; ?>)</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="return_div" ectype="return_div" style="display:none;">
                                    <div class="spec_div" id="spec_<?php echo $this->_var['goods_return']['rec_id']; ?>" style="display:none"></div>
                                    <div class="spec_list" id="splist_<?php echo $this->_var['goods_return']['rec_id']; ?>" style="display:none"></div>
                                    <div name="type_box2" class="type_box2" id="changeid_<?php echo $this->_var['goods_return']['rec_id']; ?>">
                                        <div class="return_sm">(<?php echo $this->_var['lang']['return_one']; ?><span><?php echo $this->_var['goods_return']['goods_number']; ?></span><?php echo $this->_var['lang']['change_two']; ?><span id="retired1_<?php echo $this->_var['goods_return']['rec_id']; ?>">1</span><?php echo $this->_var['lang']['jian']; ?>)</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item item1">
                            <div class="label"><?php echo $this->_var['lang']['Application_credentials']; ?>：</div>
                            <div class="value">
                                 <input name="credentials" type="checkbox" value="" class="ui-checkbox" id="credentials"/>
                                 <label for="credentials" class="ui-label"><?php echo $this->_var['lang']['has_Test_Report']; ?></label>
                            </div>
                        </div>
                        <div class="item">
                            <div class="label"><em>*</em><?php echo $this->_var['lang']['return_reason']; ?>：</div>
                            <div class="value">
                                <span class="cause_select">
                                <select name="parent_id" id="cause_<?php echo $this->_var['goods_return']['rec_id']; ?>" onchange="selectCause(this.value ,<?php echo $this->_var['goods_return']['rec_id']; ?>)">
                                <option value="0"><?php echo $this->_var['lang']['please_select']; ?></option>
                                <?php echo $this->_var['cause_list']; ?>
                                </select>
                                </span>
                                <span id="children_<?php echo $this->_var['goods_return']['rec_id']; ?>" class="cause_select"></span>
                            </div>
                        </div>
                        <div class="item">
                            <div class="label"><em>*</em><?php echo $this->_var['lang']['problem_desc']; ?>：</div>
                            <div class="value"><textarea cols="40" class="text_desc" rows="4" name="return_brief"></textarea></div>
                        </div>
                        <div class="item">
                            <div class="label"><?php echo $this->_var['lang']['pic_info']; ?>：</div>
                            <div class="value">
                                <div class="upload_img">
                                    <div class="SWFUpload"><input type="button" id="uploadbutton" class="button" value="" data-upload_type="wholesale_goods"/></div>
                                    <?php echo $this->_var['lang']['pic_info_one']; ?>
                                    <div class="up_img return_images"<?php if (! $this->_var['img_list']): ?> style="display:none;"<?php endif; ?>>
                                        <div class="mscoll">
                                            <a id="scollUp" class="mleft prev"><i class="iconfont icon-left"></i></a>
                                            <div class="mslist">
                                                <ul class="img-list-li">
                                                    <?php $_from = $this->_var['img_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'img');$this->_foreach['return'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['return']['total'] > 0):
    foreach ($_from AS $this->_var['img']):
        $this->_foreach['return']['iteration']++;
?>
                                                    <li>
                                                        <a href="<?php echo $this->_var['img']['img_file']; ?>" target="_blank"><img class="err-product" width="60" height="60" src="<?php echo $this->_var['img']['img_file']; ?>" /></a>
                                                    </li>
                                                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                                </ul>
                                            </div>
                                            <a id="scollDown" class="mright next"><i class="iconfont icon-right"></i></a>
                                        </div>
                                        <a class="apply_goods_return clear_pictures" href="javascript:void(0);"><?php echo $this->_var['lang']['Empty_picture']; ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div ectype="return-type">
                            <div class="item">
                                <div class="label"><em>*</em><?php echo $this->_var['lang']['label_address']; ?>：</div>
                                <div class="value">
                                    <div class="address" ectype="regionLinkage">
                                        <dl class="mod-select mod-select-small" ectype="smartdropdown">
                                            <dt>
                                                <span class="txt" ectype="txt"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['0']; ?></span>
                                                <input type="hidden" value="<?php echo $this->_var['consignee']['country']; ?>" name="country">
                                            </dt>
                                            <dd ectype="layer">
                                                <?php $_from = $this->_var['country_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'country');if (count($_from)):
    foreach ($_from AS $this->_var['country']):
?>
                                                <div class="option" data-value="<?php echo $this->_var['country']['region_id']; ?>" data-text="<?php echo $this->_var['country']['region_name']; ?>" ectype="ragionItem" data-type="1"><?php echo $this->_var['country']['region_name']; ?></div>
                                                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                            </dd>
                                        </dl>
                                        <dl class="mod-select mod-select-small" ectype="smartdropdown">
                                            <dt><span class="txt" ectype="txt"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['1']; ?></span><input type="hidden" value="<?php echo $this->_var['consignee']['province']; ?>" ectype="ragionItem"name="province"></dt>
                                            <dd ectype="layer">
                                                <div class="option" data-value="0"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['1']; ?></div>
                                                <?php $_from = $this->_var['province_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'province_0_24039700_1568788891');if (count($_from)):
    foreach ($_from AS $this->_var['province_0_24039700_1568788891']):
?>
                                                <div class="option" data-value="<?php echo $this->_var['province_0_24039700_1568788891']['region_id']; ?>" data-text="<?php echo $this->_var['province_0_24039700_1568788891']['region_name']; ?>" data-type="2" ectype="ragionItem"><?php echo $this->_var['province_0_24039700_1568788891']['region_name']; ?></div>
                                                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                            </dd>
                                        </dl>
                                        <dl class="mod-select mod-select-small" ectype="smartdropdown">
                                            <dt><span class="txt" ectype="txt"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['2']; ?></span><input type="hidden" value="<?php echo $this->_var['consignee']['city']; ?>" name="city" ></dt>
                                            <dd ectype="layer">
                                                <div class="option" data-value="0"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['2']; ?></div>
                                                <?php $_from = $this->_var['city_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'city');if (count($_from)):
    foreach ($_from AS $this->_var['city']):
?>
                                                <div class="option" data-value="<?php echo $this->_var['city']['region_id']; ?>" data-type="3" data-text="<?php echo $this->_var['city']['region_name']; ?>" ectype="ragionItem"><?php echo $this->_var['city']['region_name']; ?></div>
                                                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                            </dd>
                                        </dl>
                                        <dl class="mod-select mod-select-small" ectype="smartdropdown" style="display:none">
                                            <dt><span class="txt" ectype="txt"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['3']; ?></span><input type="hidden" value="<?php echo $this->_var['consignee']['district']; ?>" name="district"></dt>
                                            <dd ectype="layer">
                                                <div class="option" data-value="0"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['3']; ?></div>
                                                <?php $_from = $this->_var['district_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'district');if (count($_from)):
    foreach ($_from AS $this->_var['district']):
?>
                                                <div class="option" data-value="<?php echo $this->_var['district']['region_id']; ?>" data-type="4" data-text="<?php echo $this->_var['district']['region_name']; ?>" ectype="ragionItem"><?php echo $this->_var['district']['region_name']; ?></div>
                                                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                            </dd>
                                        </dl>
                                        <dl class="mod-select mod-select-small" ectype="smartdropdown" style="display:none">
                                            <dt><span class="txt" ectype="txt"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['3']; ?></span><input type="hidden" value="<?php echo $this->_var['consignee']['street']; ?>" name="street"></dt>
                                            <dd ectype="layer">
                                                <div class="option" data-value="0"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['3']; ?></div>
                                                <?php $_from = $this->_var['street_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'street');if (count($_from)):
    foreach ($_from AS $this->_var['street']):
?>
                                                <div class="option" data-value="<?php echo $this->_var['street']['region_id']; ?>" data-type="5" data-text="<?php echo $this->_var['street']['region_name']; ?>" ectype="ragionItem"><?php echo $this->_var['street']['region_name']; ?></div>
                                                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                            </dd>
                                        </dl>
                                    </div>
                                    <div class="address_xq">
                                        <input type="text" class="text_item"  name="return_address" value="<?php echo $this->_var['consignee']['address']; ?>" size="42"/>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="label"><em>*</em><?php echo $this->_var['lang']['Contact_name']; ?>：</div>
                                <div class="value">
                                    <input type="text" class="text_item"  name="addressee" value="<?php echo $this->_var['consignee']['consignee']; ?>" size="42"/>
                                    <input type="hidden" name="hid1" value="<?php echo $this->_var['consignee']['consignee']; ?>"/>
                                </div>
                            </div>
                            <div class="item">
                                <div class="label"><em>*</em><?php echo $this->_var['lang']['label_mobile']; ?>：</div>
                                <div class="value">
                                    <input type="text" class="text_item"  name="mobile" value="<?php echo $this->_var['consignee']['mobile']; ?>" size="42"/>
                                </div>
                            </div>
                            <div class="item">
                                <div class="label"><?php echo $this->_var['lang']['email_user']; ?>：</div>
                                <div class="value">
                                    <input type="text" class="text_item" name="code" value="<?php echo $this->_var['consignee']['zipcode']; ?>" size="42"/>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="label"><?php echo $this->_var['lang']['type']['0']; ?>：</div>
                            <div class="value">
                                <textarea cols="40" class="text_area" rows="4" name="return_remark"></textarea>
                            </div>
                        </div>
                        <div class="item">
                            <div class="label">&nbsp;</div>
                            <div class="value">
                                <input type="hidden" name="chargeoff_status" value="<?php echo $this->_var['order']['chargeoff_status']; ?>" />
                                <input type="submit" value="<?php echo $this->_var['lang']['submit_goods']; ?>" class="sc-btn btn30 sc-redBg-btn" />
                                <input type="hidden" name="act" value="wholesale_submit_return" />
                                <input type="hidden" name="rec_id" value="<?php echo $this->_var['goods_return']['rec_id']; ?>" />
                            </div>
                        </div>
                        <?php else: ?>
                        <div class="no_records">
                            <i class="no_icon_two"></i>
                            <div class="no_info"><h3><?php echo $this->_var['lang']['no_support_return']; ?></h3></div>
                        </div>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>  
        <?php endif; ?>
          
        
        
    </div>
</div>
    
<?php echo $this->fetch('library/page_footer.lbi'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'jquery.SuperSlide.2.1.1.js,jquery.yomi.js,common.js,./sms/sms.js,jquery.validation.min.js,jquery.nyroModal.js,perfect-scrollbar/perfect-scrollbar.min.js,calendar.php,plupload.full.min.js,lib_ecmobanFunc.js,user.js,jquery.picTip.js')); ?>
<?php if ($this->_var['action'] == 'profile'): ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'amazeui/amazeui.min.js,cropper/cropper.min.js')); ?>
<?php endif; ?>
<script type="text/javascript" src="themes/<?php echo $GLOBALS['_CFG']['template']; ?>/js/jquery.purebox.js"></script>
<script type="text/javascript" src="themes/<?php echo $GLOBALS['_CFG']['template']; ?>/js/region.js"></script>
<script type="text/javascript" src="themes/<?php echo $GLOBALS['_CFG']['template']; ?>/js/dsc-common.js"></script>

<script type="text/javascript">
$(function(){
	//tab切换
	$("*[ectype='tabSection']").slide({titCell:"*[ectype='tabs'] li",mainCell:"*[ectype='tabContent']",trigger:"click",titOnClassName:"active"});
	
	//查看图片
	$(".nyroModal").nyroModal();
	
	if(document.getElementById("seccode")){
		$("#seccode").val(<?php echo empty($this->_var['sms_security_code']) ? '0' : $this->_var['sms_security_code']; ?>);
	}
	
	//微信扫码弹出框
	$("[data-type='wxpay']").on("click",function(){
		var content = $("#wxpay_dialog").html();
		pb({
			id: "scanCode",
			title: "<?php echo $this->_var['lang']['wxpay_pay']; ?>",
			width: 716,
			content: content,
			drag: true,
			foot: false,
			cl_cBtn: false,
			cBtn: false
		});
	});
	
	//优惠券列表数量过多时添加滚动轴
	$(".coupons-items").perfectScrollbar("destroy");
	$(".coupons-items").perfectScrollbar();
});
<?php if ($this->_var['action'] == 'address'): ?>
<?php if ($this->_var['address_id'] > 0): ?>$.levelLink();<?php else: ?>$.levelLink(1);<?php endif; ?>
<?php endif; ?>
</script>


<?php if ($this->_var['action'] == 'snatch_list'): ?>
<script type="text/javascript">
	function get_SnatchSearch(idTxt, action, type, t, c){
		var keyword, status_keyword, date_keyword;  
		var snatch = new Object();
		if(t){
			keyword = $(t).data('id');
			
			if(idTxt == 'status_list'){
				$("input[name='order_status_list']").val(keyword);
			}else if(idTxt == 'submitDate'){
				$("input[name='order_submitDate']").val(keyword);
			}
		}else{
			keyword = document.getElementById(idTxt).value;
		}

		if(c){
			$(c).addClass("active").siblings().removeClass("active");
		}
		
		if(idTxt == 'submitDate'){
			var status_keyword = $("input[name='order_status_list']").val();
			snatch.status_keyword = status_keyword;
		}else if(idTxt == 'status_list'){
			var date_keyword = $("input[name='order_submitDate']").val();
			snatch.date_keyword = date_keyword;
		}
		
		snatch.idTxt = idTxt;
		snatch.keyword = keyword;
		snatch.action = action;
		snatch.type = type;

		Ajax.call('user.php?act=snatch_to_query', 'snatch=' + $.toJSON(snatch), auctionResponse, 'POST', 'JSON');
	}
	
	function auctionResponse(result){
		if(result.error == 0){
			$("#user-snatch-list").html(result.content);
		}
	}
</script>
<?php endif; ?>

<?php if ($this->_var['action'] == 'auction_list'): ?>
<script type="text/javascript">
	function get_AuctionSearch(idTxt, action, type, t, c){
		var keyword, status_keyword, date_keyword;  
		var auction = new Object();
		if(t){
			keyword = $(t).data('id');
			
			if(idTxt == 'status_list'){
				$("input[name='order_status_list']").val(keyword);
			}else if(idTxt == 'submitDate'){
				$("input[name='order_submitDate']").val(keyword);
			}
		}else{
			keyword = document.getElementById(idTxt).value;
		}

		if(c){
			$(c).addClass("active").siblings().removeClass("active");
		}
		
		if(idTxt == 'submitDate'){
			var status_keyword = $("input[name='order_status_list']").val();
			auction.status_keyword = status_keyword;
		}else if(idTxt == 'status_list'){
			var date_keyword = $("input[name='order_submitDate']").val();
			auction.date_keyword = date_keyword;
		}
		
		auction.idTxt = idTxt;
		auction.keyword = keyword;
		auction.action = action;
		auction.type = type;

		Ajax.call('user.php?act=auction_to_query', 'auction=' + $.toJSON(auction), auctionResponse, 'POST', 'JSON');
	}
	
	function auctionResponse(result){
		if(result.error == 0){
			$("#user-auction-list").html(result.content);
		}
	}
</script>
<?php endif; ?>

<?php if ($this->_var['action'] == 'order_list' || $this->_var['action'] == 'order_recycle' || $this->_var['action'] == 'auction'): ?>
<script type="text/javascript">
	<?php if ($this->_var['order_type']): ?>
	$(function(){
		if(<?php echo $this->_var['order_where']; ?> == 1){
			get_OrderSearch('to_unconfirmed', '<?php echo $this->_var['action']; ?>', 'toBe_unconfirmed')
		}else if(<?php echo $this->_var['order_where']; ?> == 2){
			get_OrderSearch('payId', '<?php echo $this->_var['action']; ?>', 'toBe_pay')
		}else if(<?php echo $this->_var['order_where']; ?> == 3){
			get_OrderSearch('to_confirm_order', '<?php echo $this->_var['action']; ?>', 'toBe_confirmed')
		}else if(<?php echo $this->_var['order_where']; ?> == 4){
			get_OrderSearch('to_finished', '<?php echo $this->_var['action']; ?>', 'toBe_finished')
		}
	});
	<?php endif; ?>
	
	//删除、还原、永久性删除订单 start
	function get_order_delete_restore(action, order_id){
		var order = new Object();
		var firm;

		if(action == 'delete'){
			firm = json_languages.operation_order_one;
		}else if(action == 'restore'){
			firm = json_languages.operation_order_two;
		}else if(action == 'thorough'){
			firm = json_languages.operation_order_three;
		}
		
		order.order_id = order_id; 
		order.action  = action; 
		<?php if ($this->_var['action'] == 'auction'): ?>
		order.act = 'auction';
		<?php else: ?>
		order.act = 'order_list';
		<?php endif; ?>

		if(confirm(firm)){
			Ajax.call('user.php?act=order_delete_restore', 'order=' + $.toJSON(order), orderResponse, 'POST', 'JSON');
		}
	}
	
	//删除、还原、永久性删除订单 end
	
	
	//by wang 修改过
	function get_OrderSearch(idTxt, action, type, t, c){
		var keyword, status_keyword, date_keyword;  
		var order = new Object();
		if(t){
			keyword = $(t).data('id');
			
			if(idTxt == 'status_list'){
				$("input[name='order_status_list']").val(keyword);
			}else if(idTxt == 'submitDate'){
				$("input[name='order_submitDate']").val(keyword);
			}
		}else{
			keyword = document.getElementById(idTxt).value;
		}

		if(c){
			$(c).addClass("active").siblings().removeClass("active");
		}
		
		if(idTxt == 'submitDate'){
			var status_keyword = $("input[name='order_status_list']").val();
			order.status_keyword = status_keyword;
		}else if(idTxt == 'status_list'){
			var date_keyword = $("input[name='order_submitDate']").val();
			order.date_keyword = date_keyword;
		}
		
		order.idTxt = idTxt;
		order.keyword = keyword;
		order.action = action;
		order.type = type;

		Ajax.call('user.php?act=order_to_query', 'order=' + $.toJSON(order), orderResponse, 'POST', 'JSON');
	}
	
	function orderResponse(result){
		if(result.error == 0){
			$("#user_order_list").html(result.content);
		}
	}
</script>
<?php endif; ?>

<?php if ($this->_var['action'] == 'address_list'): ?>
<script type="text/javascript">
	function alertDelAddressDiag(address_id){
		pbDialog(json_languages.delete_consignee,"",0,490,"","",true,function(){
			Ajax.call('user.php?act=ajax_del_address', 'address_id=' + address_id, delAddressResponse, 'GET', 'JSON');
		});
	}
	
	function delAddressResponse(res){
		$(".consignee_list_"+res.address_id).remove();
	}
	
	//设置默认收获地址
	function makeAddressAllDefault(address_id){
		pbDialog(json_languages.default_consignee,"",0,490,"","",true,function(){
			Ajax.call('user.php?act=ajax_make_address', 'address_id=' + address_id, makeAddressResponse, 'GET', 'JSON');
		});
	}
	
	function makeAddressResponse(res){
		location.reload();
	}
</script>
<?php endif; ?>

<?php if ($this->_var['action'] == 'bonus'): ?>
<script type="text/javascript">
	function new_addBonus(){
		var bns = new Object;
		
		bns.bonus_sn = $(".txt_input_cardnum").val();
		bns.password = $(".txt_input_cardpw").val();
		bns.captcha = $(":input[name='captcha']").val();
		
		if(bns.bonus_sn == ''){
			message = json_languages.card_number_null;
		}else if(bns.password == ''){
			message = json_languages.Real_name_password_null;
		}else if(bns.captcha == ''){
			message = json_languages.null_captcha_login;
		}
		
		if(bns.bonus_sn != '' && bns.password != '' && bns.captcha != ''){
			Ajax.call('user.php', 'act=act_add_bonus&bns=' + $.toJSON(bns), function(data){
				if(data.error == 2){
					pbDialog(data.message,"",0,"","","",true,function(){
						location.href = "user.php";
					});
				}else if(data.error == 3){
					pbDialog(data.message,"",0);
				}else if(data.error == 0){
					pbDialog(data.message,"",1,"","","",true,function(){
						location.href = "user.php?act=bonus";
					});
				}else{
					pbDialog(data.message,"",0);
				}
			}, 'POST', 'JSON');
		}else{
			pbDialog(message,"",0);
		}
	}
</script>
<?php endif; ?>

<?php if ($this->_var['action'] == 'order_list' || $this->_var['action'] == 'auction' || $this->_var['action'] == 'order_recycle'): ?>
<script type="text/javascript">
	$.divselect("#order_status","#order_status_val",function(){
		var order    = new Object();
		var key		 = $("#order_status_val").val();
		var date_keyword = $("input[name='order_submitDate']").val();

		order.idTxt   	= $("#order_status_"+key+" a").attr('data-idTxt'); 
		order.keyword   = $("#order_status_"+key+" a").attr('data-id'); 
		order.action  	= $("#order_status_"+key+" a").attr('data-action'); 
		order.type   	= $("#order_status_"+key+" a").attr('data-type'); 
		order.date_keyword   = date_keyword; 	
		
		Ajax.call('user.php?act=order_to_query', 'order=' + $.toJSON(order), orderResponse, 'POST', 'JSON');
	});
	
	$.divselect("#dateTime","#dateTime_val",function(){
		var order    = new Object();
		var key		 = $("#dateTime_val").val();
		var status_keyword = $("input[name='order_status_list']").val();

		order.idTxt   	= $("#time_"+key+" a").attr('data-idTxt'); 
		order.keyword   = $("#time_"+key+" a").attr('data-id'); 
		order.action  	= $("#time_"+key+" a").attr('data-action'); 
		order.type   	= $("#time_"+key+" a").attr('data-type'); 
		order.status_keyword   = status_keyword; 	
		
		Ajax.call('user.php?act=order_to_query', 'order=' + $.toJSON(order), orderResponse, 'POST', 'JSON');
	});
</script>
<?php endif; ?>

<?php if ($this->_var['action'] == 'wholesale_buy'): ?>
<script type="text/javascript">
	$.divselect("#wholesale_order_status","#wholesale_order_status_val",function(){
		var order    = new Object();
		var key		 = $("#wholesale_order_status_val").val();
		var date_keyword = $("input[name='wholesale_order_submitDate']").val();
	
		order.idTxt   	= $("#wholesale_order_status_"+key+" a").attr('data-idTxt'); 
		order.keyword   = $("#wholesale_order_status_"+key+" a").attr('data-id'); 
		order.action  	= $("#wholesale_order_status_"+key+" a").attr('data-action'); 
		order.type   	= $("#wholesale_order_status_"+key+" a").attr('data-type'); 
		order.date_keyword   = date_keyword; 	
	
		Ajax.call('user.php?act=wholesale_order_to_query', 'order=' + $.toJSON(order), orderResponse, 'POST', 'JSON');
	});
	
	$.divselect("#DateTime","#wholesale_dateTime_val",function(){
		var order    = new Object();
		var key		 = $("#wholesale_dateTime_val").val();
		var status_keyword = $("input[name='wholesale_order_submitDate']").val();
		order.idTxt   	= $("#time_"+key+" a").attr('data-idTxt'); 
		order.keyword   = $("#time_"+key+" a").attr('data-id'); 
		order.action  	= $("#time_"+key+" a").attr('data-action'); 
		order.type   	= $("#time_"+key+" a").attr('data-type'); 
		order.status_keyword   = status_keyword; 	
	
		Ajax.call('user.php?act=wholesale_order_to_query', 'order=' + $.toJSON(order), orderResponse, 'POST', 'JSON');
	});
	
	$(document).on("click","*[ectype='userWhoConfirm']",function(){
		var orderid = $(this).data("orderid");
		pbDialog("是否把此订单设为已完成","",0,"","","",true,function(){
			location.href="user.php?act=wholesale_affirm_received&order_id="+ orderid;
		});
	});
</script>
<?php endif; ?>

<?php if ($this->_var['action'] == "account_deposit"): ?>  
<script type="text/javascript">
$(function(){
	/* 返回实名认证页面 */
	$("#goback_account_log").click(function(){
		location.href = "user.php?act=account_log";
	});
	
	$("#submitBtn").click(function(){
		if($("#formSurplus").valid()){
			//防止表单重复提交
			if(checkSubmit() == true){
				$(this).parents("form").submit();
			}else{
				return false;
			}
		}
	});
	
	$('#formSurplus').validate({
		errorPlacement:function(error, element){
			var error_div = element.parents('div.value').find('div.form_prompt');
			//element.parents('div.label_value').find(".notic").hide();
			error_div.append(error);
		},
		rules : {
			amount : {
				required : true,
				number:true,
				min : <?php echo $this->_var['buyer_recharge']; ?>
			}
		},
		messages : {
			amount : {
				required : json_languages.recharge_amount_null,
				number:json_languages.recharge_amount_wrongful,
				min:json_languages.recharge_amount_lower+<?php echo $this->_var['buyer_recharge']; ?>+"<?php echo $this->_var['lang']['yuan']; ?>"
			}
		}
	});
  
});
</script>
<?php endif; ?>

<?php if ($this->_var['action'] == 'account_raply'): ?>
<script type="text/javascript">
	$(function(){
		$("#submitBtn").click(function(){
			if($("#formSurplus").valid()){
				//防止表单重复提交
				if(checkSubmit() == true){
					$(this).parents("form").submit();
				}else{
					return false;
				}
			}
		});
		
		$('#formSurplus').validate({
			errorPlacement:function(error, element){
				var error_div = element.parents('div.value').find('div.form_prompt');
				//element.parents('div.label_value').find(".notic").hide();
				error_div.append(error);
			},
			rules : {
				amount : {
					required : true,
					number:true,
                    min : <?php echo $this->_var['buyer_cash']; ?>,
					max : <?php echo $this->_var['user_info']['user_money']; ?>
				},
				mobile_code:{
					required : true,
					remote : {
						cache: false,
						async:false,
						type:'POST',
						url:'user.php?act=code_notice',
						data:{
							mobile_code:function(){
								return $("input[name='mobile_code']").val();
							}
						}
					}
				}
			},
			messages : {
				amount : {
					required : json_languages.amount_of_cash_null,
					number:json_languages.amount_of_cash_wrongful,
                    min:json_languages.amount_of_cash_min+<?php echo $this->_var['buyer_cash']; ?>+"<?php echo $this->_var['lang']['yuan']; ?>",
					max:json_languages.amount_of_cash_max+<?php echo $this->_var['user_info']['user_money']; ?>+"<?php echo $this->_var['lang']['yuan']; ?>"
				},
				mobile_code : {
					required : json_languages.mobile_code_null,
					remote:json_languages.mobile_code_incorrect
				}
			}
		});
	});
</script>
<?php endif; ?>

<?php if ($this->_var['action'] == 'wholesale_purchase'): ?>
<script type="text/javascript">
	$(".t-images").slide({"mainCell":".t-images-info ul",effect:"left",trigger:"click",pnLoop:false,autoPage:true,vis:2,scroll:1});
	
	var opts1 = {
		'targetId':'start_date',//时间写入对象的id
		'triggerId':['start_date'],//触发事件的对象id
		'alignId':'text_time1',//日历对齐对象
		'format':'-',//时间格式 默认'YYYY-MM-DD HH:MM:SS'
		'min':'' //最小时间
	},opts2 = {
		'targetId':'end_date',
		'triggerId':['end_date'],
		'alignId':'text_time2',
		'format':'-',
		'min':''
	}
	xvDate(opts1);
	xvDate(opts2);
</script>
<?php endif; ?>

<?php if ($this->_var['action'] == 'want_buy'): ?>
<script type="text/javascript">
	$(".t-images").slide({"mainCell":".t-images-info ul",effect:"left",trigger:"click",pnLoop:false,autoPage:true,vis:2,scroll:1});
	
	var opts1 = {
		'targetId':'wantbut_start_date',//时间写入对象的id
		'triggerId':['wantbut_start_date'],//触发事件的对象id
		'alignId':'text_time1',//日历对齐对象
		'format':'-',//时间格式 默认'YYYY-MM-DD HH:MM:SS'
		'min':'' //最小时间
	},opts2 = {
		'targetId':'wantbut_end_date',
		'triggerId':['wantbut_end_date'],
		'alignId':'text_time2',
		'format':'-',
		'min':''
	}
	xvDate(opts1);
	xvDate(opts2);
</script>
<?php endif; ?>

<?php if ($this->_var['action'] == 'profile'): ?>
<script type="text/javascript">
	<?php if ($this->_var['profile']['user_picture']): ?>
	var user_img='<?php echo $this->_var['profile']['user_picture']; ?>?&'+Math.random();
	<?php else: ?>
	var user_img="themes/<?php echo $GLOBALS['_CFG']['template']; ?>/images/touxiang.jpg";
	<?php endif; ?>
	
	$("*[ectype='up-pre-before']").find("img").attr('src',user_img)
	$("*[ectype='upImgTouch'] img").attr('src',user_img);
	
	
	//提交修改个人信息表单
	$("a[ectype='submit']").on("click",function(){
		$("form[name='formEdit']").submit();
	});
	
	//上传头像
	$(function(){
		//初始化
		var $image = $("*[ectype='image']"),//图片对象
			$inputImage = $("*[ectype='fileImage']"),//上传file按钮
			$modalDoc = $("*[ectype='docMdal']");//上传弹出层
			$modalLoad = $("*[ectype='modalLoad']"),//加载层
			$modalAlert = $("*[ectype='modalAlert']"),//提示层
			$alertContent = $modalAlert.find("*[ectype='alertContent']");//提示层内容
			
		var	URL = window.URL || window.webkitURL;
		var	blobURL;
			
		$image.cropper({
			aspectRatio:"1",
			autoCropArea:0.8,
			preview:".up-pre-after"
		});
		
		//弹出上传图片栏
		$("*[ectype='upImgTouch']").click(function(){
			$modalDoc.modal({width:'600px'});
		});
		
		//上传图片
		if(URL){
			$inputImage.change(function(){
				var files = this.files;
				var file;

				if(files && files.length){
				   file = files[0];

				   if(/^image\/\w+$/.test(file.type)){
						blobURL = URL.createObjectURL(file);
						$image.one('built.cropper',function(){
						   URL.revokeObjectURL(blobURL);
						}).cropper('reset').cropper('replace', blobURL);
						//$inputImage.val('');
					}else{
						window.alert('<?php echo $this->_var['lang']['select_img_file']; ?>');
					}
				}
				
				// Amazi UI 上传文件显示代码
				var fileNames = '';
				$.each(this.files,function(){
					fileNames += '<span class="am-badge">' + this.name + '</span>';
				});
			
				$('#file-list').html(fileNames);
			});
		}else{
			$inputImage.prop('disabled', true).parent().addClass('disabled');
		}
		
		//绑定上传事件
		$("*[ectype='upBtnOk']").on('click',function(){
			var img_src = $image.attr("src");
			var url = $(this).attr("url");
			var canvas = $image.cropper('getCroppedCanvas');
			var data = canvas.toDataURL(); //转成base64

			//判断上传图片是否为空
			if(img_src == ""){
				//提示层赋值后，弹出提示
				$alertContent.html("<div class='error'><?php echo $this->_var['lang']['not_select_img_file']; ?></div>");
				$modalAlert.modal();
				return false;
			}
			
			$.ajax({  
				url:url,  
				dataType:"json",  
				type: "POST",
				data: {"image":data.toString()},  
				success: function(data,textStatus){
					//提示层赋值后，弹出提示
					$alertContent.html("<div class='success'>" + data.result + "</div>");
					$modalAlert.modal();
					
					if(data.error == "ok"){
						$("*[ectype='upImgTouch'] img").attr("src",data.file+'?&'+Math.random());
						
						var img_name = data.file.split('/')[2];
						
					}
				},
				error: function(){
					//提示层赋值后，弹出提示
					$alertContent.html("<div class='error'><?php echo $this->_var['lang']['update_file_error']; ?></div>");
					$modalAlert.modal();
				}  
			});
		});
		
		//图片旋转
		$("*[ectype='rotate']").on("click",function(){
			var type = $(this).data("type")
				val = 0;
			
			if(type == "left"){
				val = -90;
			}else{
				val = 90
			}
			
			if($image.attr("src") != ""){
				$image.cropper('rotate', val);
			}else{
				//提示层赋值后，弹出提示
				$alertContent.html("<div class='error'><?php echo $this->_var['lang']['select_img_file']; ?></div>");
				$modalAlert.modal();
			}
		});
		
		$(".am-modal-btn").click(function(){
			$modalDoc.modal();
		});
	});
</script>
<?php endif; ?>

<?php if ($this->_var['action'] == 'return_list'): ?>
<script type="text/javascript">
	//删除已完成退换货订单 start
	function get_order_delete_return(order_id){
		var order = new Object();
		order.order_id   = order_id;
		var firm = json_languages.operation_order_one;
		if(confirm(firm)){
			Ajax.call('user.php?act=order_delete_return', 'order=' + $.toJSON(order),function(result){
				if(result.error == 0){
					$("#return_list").html(result.content);
					$(".red").text(result.pager.record_count);
				}
			}, 'POST', 'JSON');
		}  
	}
</script>
<?php endif; ?>

<?php if ($this->_var['action'] == 'wholesale_return_list'): ?>
<script type="text/javascript">
    //删除已完成退换货订单 start
    function get_wholesale_order_delete_return(order_id){
        var order = new Object();
        order.order_id   = order_id;
        var firm = json_languages.operation_order_one;
        if(confirm(firm)){
            Ajax.call('user.php?act=wholesale_order_delete_return', 'order=' + $.toJSON(order),function(result){
                if(result.error == 0){
                    $("#return_list").html(result.content);
                    $(".red").text(result.pager.record_count);
                }
            }, 'POST', 'JSON');
        }  
    }
</script>
<?php endif; ?>

<?php if ($this->_var['action'] == 'apply_return' || $this->_var['action'] == 'wholesale_apply_return'): ?>
<?php if ($this->_var['goods_return']['rec_id']): ?>
<script type="text/javascript">
//退换货上传图片，支持多图片选择上传
var uploader_gallery = new plupload.Uploader({//创建实例的构造方法
	runtimes: 'html5,flash,silverlight,html4', //上传插件初始化选用那种方式的优先级顺序
	browse_button: 'uploadbutton', // 上传按钮
	url: "return_images.php?act=ajax_return_images&rec_id=<?php echo $this->_var['goods_return']['rec_id']; ?>&userId=<?php echo $this->_var['user_id']; ?>&sessid=<?php echo $this->_var['sessid']; ?>&upload_type="+$("#uploadbutton").data('upload_type'), //远程上传地址
	filters: {
		max_file_size: '2mb', //最大上传文件大小（格式100b, 10kb, 10mb, 1gb）
		mime_types: [//允许文件上传类型
			{title: "files", extensions: "bmp,gif,jpg,png,jpeg"}
		]
	},
	multi_selection: true, //true:ctrl多文件上传, false 单文件上传
	init: {
	   FilesAdded: function(up, files) { //文件上传前
			var len = $(".img-list-li li").length;
			plupload.each(files, function(file){ //遍历文件
				len ++;
			});
			if(len > 10){
				pbDialog(json_languages.comment_img_number,"",0);
			}else{
				//开始上传单张循环上传
				submitBtn();
			}
		},
		FileUploaded: function(up, file, info) { //文件上传成功的时候触发
			var data = eval("(" + info.response + ")");
			if(data.error == 2){
				pbDialog(json_languages.login_error,"",0);
				return;
			}else{
				$(".mslist").html(data.content);
				$(".return_images").show();
				mscoll();
			}
		},
		UploadComplete:function(up,file){//所有文件上传成功时触发
				
		},
		Error: function(up, err) { //上传出错的时候触发
			pbDialog(err.message,"",0);
		}
	}
});
uploader_gallery.init();

$(function(){
	if($("input[name='return_type']").val() != 2){
		
		$("*[ectype='return-type']").hide();
	}
	$("input[name='return_type']").on("click",function(){
		var val = $(this).val(),
			list = $("*[ectype='return_lists']"),
			div = list.find("*[ectype='return_div']");			
		
		div.eq(val).show().siblings().hide();
		
		if(val == 0){
			$("*[ectype='return-type']").show();
		}else if(val == 1){
			$("*[ectype='return-type']").hide();
		}else if(val == 2){
			$("*[ectype='return-type']").show();
			// get_spec();
		}else if(val == 3){
			$("*[ectype='return-type']").hide();
		}else{
			$("*[ectype='return-type']").hide();
			div.hide();
		}
		
		//默认退换货数量为1
		$("input[name='maintain_number'],input[name='attr_num'],input[name='return_num']").val(1);
	});
	
	$("input[name='return_type']:first").click(); //默认退换货服务类型第一个选中点击
	
	//清空上传的图片
	var rec_id = $("input[name='return_rec_id']").val();
	
	$('.clear_pictures').click(function(){
		Ajax.call('return_images.php?act=clear_pictures&upload_type='+$("#uploadbutton").data('upload_type'), '&rec_id=' + rec_id,function(res){
			$('.mslist').html(res.content);
			$('.return_images').hide();
		}, 'POST', 'JSON');
	});
});

function submitBtn(){
	uploader_gallery.setOption("multipart_params");//设置传参
	uploader_gallery.start();//开始控件
};

/**选择退换货原因*/
function selectCause(val, rec_id) {
	if (val > 0) {
		Ajax.call('user.php?act=ajax_select_cause', 'c_id=' + val + '&rec_id=' + rec_id,function(res){
			rec_id = res.rec_id;
			$('#children_' + rec_id).html(res.option);
		}, 'POST', 'JSON');
	}
	else {
		$('#children_' + rec_id).html("");
	}
}

/**维修退货数量控制 **/
function check_return_num(obj, num, rec_id, type) {
	if ($(obj).val() > num) {
		$(obj).val(num);
	}
	if ($(obj).val() <= 0) {
		$(obj).val(1);
	}
	var val = $(obj).val();
	
	if(type == 1){
		$('#maintain_span_' + rec_id).html(val);
	}else if(type == 2){
		$('#retired_' + rec_id).html(val);
	}
}

/**换货数量控制 **/
function check_attr_num(obj, num, rec_id) {
	var val = $(obj).val();
	if (val > num) {
		val = num;
		$(obj).val(num);
	}
	if (val <= 0) {
		val = 1;
		$(obj).val(1);
	}
	
	$('#retired1_' + rec_id).html(val);
}

/**换货获得商品属性*/
function get_spec() {
	var rec_id = $("input[name='return_rec_id']").val();    
	var g_id = $("input[name='return_g_id']").val();    
	var g_number = $("input[name='return_g_number']").val();    
	
	Ajax.call('ajax_dialog.php?act=ajax_get_spec', 'rec_id=' + rec_id + '&g_id=' + g_id + '&g_number=' + g_number, get_pro_response, 'POST', 'JSON');
}

/**获得属性列表回调函数*/
function get_pro_response(res) {
	var spec = $("#spec_" + res.rec_id);
	
	spec.html("");
	spec.append(res.spec).show();
	
	if(res.attr_val != ''){
		var arr = new Array();
		var attr_arr = new Array();
		arr = res.attr_val.split(',');
		for(var i=0; i<arr.length; i++){
			attr_arr = arr[i].split('_');
			$("#attr_" + attr_arr[0]).val(attr_arr[1]);
		}
	}
}

/**选择商品属性*/
function setChange(id, t, attr_id) {
	$(t).addClass("cattsel").siblings().removeClass("cattsel");
	
	$('#attr_' + attr_id).val(id);
}

/**退换货数量变化*/
var buyNumber = {
	maxNumber : 100,
	minNumber : 1,
	rec_id : $("input[name='rec_id']").val(),

	defaultNumber : function(inputName){
		var defaultnumber = $("input[name='" +inputName+ "']").attr('defaultnumber');
		defaultnumber = parseInt(defaultnumber)
		if(defaultnumber < 1){
			defaultnumber = 1;
		}
		return defaultnumber;
	},
																							
	goodNumber : function(type, inputName, lastSpan, num){
		if(typeof(num) == 'number' && type == 2){
			lastSpan.html(num);
			return $("input[name='" +inputName+ "']").val(num);
		}else{
			return parseInt($("input[name='" +inputName+ "']").val());
		}
	},
	plus : function(obj, obj_type){
		var input_name = $(obj).parent().find('input').attr('name');

		if(obj_type == 1){
			var lastSpan = $(obj).parent().find('span').last();
		}else if(obj_type == 2){
			var lastSpan = $('#retired1_' + buyNumber.rec_id);
		}

		var num = buyNumber.goodNumber(1, input_name) + buyNumber.defaultNumber(input_name);
		var return_number = $("input[name='return_g_number']").val();

		if(num > return_number){
			pbDialog(json_languages.change_two +return_number+ json_languages.jian,"",0);
			num = return_number;
		}

		if(num <= buyNumber.maxNumber){
			buyNumber.goodNumber(2, input_name, lastSpan, num);
		}
	},
	minus : function(obj, obj_type){
		var input_name = $(obj).parent().find('input').attr('name');

		if(obj_type == 1){
			var lastSpan = $(obj).parent().find('span').last();
		}else if(obj_type == 2){
			var lastSpan = $('#retired1_' + buyNumber.rec_id);
		}

		var num = buyNumber.goodNumber(1, input_name) - buyNumber.defaultNumber(input_name);

		if(num >= buyNumber.minNumber){
			buyNumber.goodNumber(2, input_name, lastSpan, num);
		}
	}                                                                                                        
}

/**大于5张图片 左右显示滚动切换*/
function mscoll(){
	$(".mscoll").slide({mainCell:".mslist ul",effect:"left",pnLoop:false,autoPlay:false,autoPage:true,scroll:1,vis:5});
}
mscoll();

/**提交验证表单*/
function check_sub() {
	var frm = $('#formReturn');
	var rec_id = $("input[name='return_rec_id']").val();    
	
	if($("#cause_" + rec_id).val() == 0){
		pbDialog(json_languages.return_one,"",0);
		return false;
	}else{
		if($("#last_option_" + rec_id).val() == 0){
			pbDialog(json_languages.return_two,"",0);
			return false;
		}
	}
	
	if($(".text_desc").val() == ''){
		pbDialog(json_languages.return_three,"",0);
		return false;
	}
	
	var selCountries = $('#selCountries_0').val();
	var selProvinces = $('#selProvinces_0').val();
	var selCities = $('#selCities_0').val();
	
	if(selCountries == 0){
		pbDialog(json_languages.return_four,"",0);
		return false;
	}else if(selProvinces == 0){
		pbDialog(json_languages.selProvinces,"",0);
		return false;
	}else if(selCities == 0){
		pbDialog(json_languages.selCities,"",0);
		return false;
	}else{
		var selDistricts = $('#selDistricts_0');
		if(selDistricts.attr('style') != 'display:none'){
			if(selDistricts.val() == 0){
				pbDialog(json_languages.selDistricts,"",0);
				return false;
			}
		}
	}
	
	if($("input[name='return_address']").val() == ''){
		pbDialog(json_languages.address_empty,"",0);
		return false;
	}
	
	if($("input[name='addressee']").val() == ''){
		pbDialog(json_languages.Contact_name_empty,"",0);
		return false;
	}
	
	if($("input[name='mobile']").val() != ''){
		if($("input[name='mobile']").val().length != 11){
			pbDialog(json_languages.phone_format_error,"",0);
			return false;
		}
	}else{
		pbDialog(json_languages.msg_phone_blank,"",0);
		return false;
	}
	
	frm.action = frm.action + '?act=submit_return';
	frm.submit();
	return true;
}

$.levelLink();
</script>
<?php endif; ?>
<?php endif; ?>

<?php if ($this->_var['action'] == 'batch_applied' || $this->_var['action'] == 'wholesale_batch_applied'): ?>
<script type="text/javascript">
//退换货上传图片，支持多图片选择上传
var uploader_gallery = new plupload.Uploader({//创建实例的构造方法
	runtimes: 'html5,flash,silverlight,html4', //上传插件初始化选用那种方式的优先级顺序
	browse_button: 'uploadbutton', // 上传按钮
	url: "return_images.php?act=ajax_return_images&rec_ids=<?php echo $this->_var['rec_ids']; ?>&userId=<?php echo $this->_var['user_id']; ?>&sessid=<?php echo $this->_var['sessid']; ?>&upload_type="+$("#uploadbutton").data('upload_type'), //远程上传地址
	filters: {
		max_file_size: '2mb', //最大上传文件大小（格式100b, 10kb, 10mb, 1gb）
		mime_types: [//允许文件上传类型
			{title: "files", extensions: "bmp,gif,jpg,png,jpeg"}
		]
	},
	multi_selection: true, //true:ctrl多文件上传, false 单文件上传
	init: {
	   FilesAdded: function(up, files) { //文件上传前
			var len = $(".img-list-li li").length;
			plupload.each(files, function(file){ //遍历文件
				len ++;
			});
			if(len > 10){
				pbDialog(json_languages.comment_img_number,"",0);
			}else{
				//开始上传单张循环上传
				submitBtn();
			}
		},
		FileUploaded: function(up, file, info) { //文件上传成功的时候触发
			var data = eval("(" + info.response + ")");
			if(data.error == 2){
				pbDialog(json_languages.login_error,"",0);
				return;
			}else{
				$(".mslist").html(data.content);
				$(".return_images").show();
				mscoll();
			}
		},
		UploadComplete:function(up,file){//所有文件上传成功时触发
				
		},
		Error: function(up, err) { //上传出错的时候触发
			pbDialog(err.message,"",0);
		}
	}
});
uploader_gallery.init();

$(function(){
	if($("input[name='return_type']").val() != 2){
		$("*[ectype='return-type']").hide();
	}	
	$("input[name='return_type']").on("click",function(){
		var val = $(this).val(),
			list = $("*[ectype='return_lists']"),
			div = list.find("*[ectype='return_div']");			
		
		div.eq(val).show().siblings().hide();
		
		if(val == 0){
			$("*[ectype='return-type']").show();
		}else if(val == 1){
			$("*[ectype='return-type']").hide();
		}else if(val == 2){
			$("*[ectype='return-type']").show();
		}else{
			$("*[ectype='return-type']").hide();
			div.hide();
		}
	});
	
	
	//清空上传的图片
	$('.clear_pictures').click(function(){
		Ajax.call('return_images.php?act=clear_pictures&upload_type='+$("#uploadbutton").data('upload_type'), '&rec_ids=<?php echo $this->_var['rec_ids']; ?>',function(res){
			$('.mslist').html(res.content);
			$('.return_images').hide();
		}, 'POST', 'JSON');
	});
});

function submitBtn(){
	uploader_gallery.setOption("multipart_params");//设置传参
	uploader_gallery.start();//开始控件
};

/**选择退换货原因*/
function selectCause(val, rec_id) {
	if (val > 0) {
		Ajax.call('user.php?act=ajax_select_cause', 'c_id=' + val + '&rec_id=' + rec_id,function(res){
			rec_id = res.rec_id;
			$('#children_' + rec_id).html(res.option);
		}, 'POST', 'JSON');
	}
	else {
		$('#children_' + rec_id).html("");
	}
}

/**大于5张图片 左右显示滚动切换*/
function mscoll(){
	$(".mscoll").slide({mainCell:".mslist ul",effect:"left",pnLoop:false,autoPlay:false,autoPage:true,scroll:1,vis:5});
}
mscoll();

/**提交验证表单*/
function check_sub() {
	var frm = $('#formReturn');
	
	if($(".text_desc").val() == ''){
		pbDialog(json_languages.return_three,"",0);
		return false;
	}
	
	var selCountries = $('#selCountries_0').val();
	var selProvinces = $('#selProvinces_0').val();
	var selCities = $('#selCities_0').val();
	
	if(selCountries == 0){
		pbDialog(json_languages.return_four,"",0);
		return false;
	}else if(selProvinces == 0){
		pbDialog(json_languages.selProvinces,"",0);
		return false;
	}else if(selCities == 0){
		pbDialog(json_languages.selCities,"",0);
		return false;
	}else{
		var selDistricts = $('#selDistricts_0');
		if(selDistricts.attr('style') != 'display:none'){
			if(selDistricts.val() == 0){
				pbDialog(json_languages.selDistricts,"",0);
				return false;
			}
		}
	}
	
	if($("input[name='return_address']").val() == ''){
		pbDialog(json_languages.address_empty,"",0);
		return false;
	}
	
	if($("input[name='addressee']").val() == ''){
		pbDialog(json_languages.Contact_name_empty,"",0);
		return false;
	}
	
	if($("input[name='mobile']").val() != ''){
		if($("input[name='mobile']").val().length != 11){
			pbDialog(json_languages.phone_format_error,"",0);
			return false;
		}
	}else{
		pbDialog(json_languages.msg_phone_blank,"",0);
		return false;
	}
	
	frm.action = frm.action + '?act=submit_batch_return';
	frm.submit();
	return true;
}

$.levelLink();
</script>
<?php endif; ?>

<?php if ($this->_var['action'] == 'goods_order' || $this->_var['action'] == 'wholesale_goods_order'): ?>
<script type="text/javascript">
	$("*[ectype='submitBtn']").click(function(){
		$("#theFrom").submit();
	});
</script>
<?php endif; ?>

<?php if ($this->_var['action'] == 'track_packages'): ?>
<?php if ($this->_var['orders']): ?>                  
<script language="javascript">
	$(".user-trackpack .item").each(function(){
		var id = $(this).data('orderid');
		var expressid = $("#shipping_name_"+id).html();
		var expressno = $("#invoice_no_"+id).html();

		//$("#retData_"+id).html("<center>"+logistics_tracking_in+"</center>");
		$.ajax({
			url: "plugins/kuaidi/express.php",
			type: "post",
			data:'com=' + expressid + '&nu=' + expressno,
			success: function(data,textStatus){
				$("#retData_"+id).html(data);
			},
			 error: function(o){
			}
		});
	});
</script>
<?php endif; ?>
<?php endif; ?>

<?php if ($this->_var['action'] == 'application_grade' || $this->_var['action'] == 'application_grade_edit'): ?>     
<script language="JavaScript">
   $("a[ectype='submit']").on("click",function(){
		var frm  = $("form[name='grade_theForm']");
		var count_charge = frm.find("input[name='all_count_charge']").val();
		var msg = '';
		<?php $_from = $this->_var['entry_criteriat_info']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'info');if (count($_from)):
    foreach ($_from AS $this->_var['info']):
?>
			<?php if ($this->_var['info']['child']): ?>
				<?php $_from = $this->_var['info']['child']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'child');if (count($_from)):
    foreach ($_from AS $this->_var['child']):
?>
					<?php if ($this->_var['child']['is_mandatory'] == 1 && $this->_var['child']['type'] != 'charge'): ?>
						
							var name="value[<?php echo $this->_var['child']['id']; ?>]";
							var prompt  = "<?php echo $this->_var['child']['criteria_name']; ?>"+json_languages.cannot_null
							var a  = frm.find("input[name='"+name+"']").val();
							var error = frm.find("input[name='"+name+"']").nextAll('.notic');
							<?php if ($this->_var['child']['type'] == 'file' && $this->_var['action'] == 'application_grade_edit'): ?>
								a = '1';
							<?php endif; ?>
							if(a.length == 0){
							   error.html(prompt);
							   msg += prompt + '\n';
							}
						
					<?php endif; ?>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

		if(count_charge > 0){
			var prompt = '<div class="notic">' + json_languages.select_payment_pls + '</div>';
			 var pay_id  = frm.find("input[name='pay_id']").val();
			 if(pay_id.length == 0){
				 $(".pay_id_erro").append(prompt);
				  msg += prompt + '\n';
			 }
		}
		if (msg.length > 0){
			return false;
		}else{
			frm.submit();
		}
	});
	
	window.onload = function()
	{
		add_charge();
	}

	/*年限操作发生事件*/
	function add_charge(i){
		var re = /^[1-9]+[0-9]*]*$/; //大于0整数数字
		var all_count_charge = document.forms['grade_theForm'].elements['all_count_charge'];
		var price_one = document.forms['grade_theForm'].elements['count_charge'].value;
		var num = document.forms['grade_theForm'].elements['fee_num'];
		var count = document.getElementById('count_charge');
        var no_cumulative_price = document.forms['grade_theForm'].elements['no_cumulative_price'].value;
		if(i == 'reduce'){
			if(num.value == 1){
				pbDialog(json_languages.settled_down_lt1,"",0);
			}else{          
				if(num.value > 1){
					price_one = Number(price_one) - Number(no_cumulative_price);
				}
				num.value = parseInt(num.value)-1;
				all_count_charge.value = count.innerHTML = Number(count.innerHTML) - Number(price_one);
			}
		}else if(i == 'reset'){
			 all_count_charge.value = count.innerHTML = Number(price_one);
		}else if(i == 'add'){
			num.value = parseInt(num.value)+1;
			if(num.value > 1){
				price_one = Number(price_one) - Number(no_cumulative_price);
			}
			all_count_charge.value  = count.innerHTML = Number(count.innerHTML) + Number(price_one);
		}else if(i == 'keyup'){
			if(!re.test(num.value)){
				pbDialog(json_languages.Wrongful_input,"",0);
			}else{
				price_one = Number(price_one) - Number(no_cumulative_price);
				all_count_charge.value =  count.innerHTML = parseInt(num.value) * Number(price_one) + Number(no_cumulative_price);
			}
		}else{
			price_one = Number(price_one) - Number(no_cumulative_price);
            all_count_charge.value =  count.innerHTML = parseInt(num.value) * Number(price_one) + Number(no_cumulative_price);
		}
	}
</script>
<?php endif; ?>

<?php if ($this->_var['action'] == 'value_card'): ?>
<script type="text/javascript">
$("*[ectype='submitVC']").on("click",function(){
	
	new_addVC();
	
});
function new_addVC(){
	var vc = new Object;
	var message;
	
	vc.value_card_sn = $(".txt_input_cardnum").val();
	vc.password = $(".txt_input_cardpw").val();
	vc.captcha = $(":input[name='captcha']").val();
	
	if(vc.value_card_sn == ''){
		message = json_languages.card_number_null;
	}else if(vc.password == ''){
		message = json_languages.Real_name_password_null;
	}else if(vc.captcha == ''){
		message = json_languages.null_captcha_login;
	}
	
	if(vc.value_card_sn != '' && vc.password != '' && vc.captcha != ''){
		Ajax.call('user.php', 'act=add_value_card&vc=' + $.toJSON(vc), function(data){
			if(data.error == 2){
				var back_url = "user.php?act=value_card";
				$.notLogin("get_ajax_content.php?act=get_login_dialog",back_url);
			}else if(data.error == 3){
				pbDialog(data.message,"",0);
			}else if(data.error == 0){
				pbDialog(data.message,"",1,"","","",true,function(){
					 location.href = "user.php?act=value_card";
				});
			}else{
				pbDialog(data.message,"",0,"","",70);
			}
		}, 'POST', 'JSON');
	}else{
		pbDialog(message,"",0);
	}
}

function to_pay(vid){
	Ajax.call("get_ajax_content.php?act=to_pay_card&vid="+vid, '', function(data){
		pb({
			id:"storeDialogBody",
			title:"<?php echo $this->_var['lang']['value_card_filling']; ?>",
			width:450,
			height:250,
			content:data.content, 	//调取内容
			drag:false,
			foot:false
		});
	}, 'POST','JSON');

}
function remove_bind(vid){
	Ajax.call("get_ajax_content.php?act=remove_bind&vid="+vid, '', function(data){
		pb({
			id:"storeDialogBody",
			title:"<?php echo $this->_var['lang']['value_card_unwrap']; ?>",
			width:450,
			height:250,
			content:data.content, 	//调取内容
			drag:false,
			foot:false
		});
	}, 'POST','JSON');

}
</script>
<?php endif; ?>

<?php if ($this->_var['action'] == 'to_paid'): ?>    
<script type="text/javascript">
$("*[ectype='submitVC']").on("click",function(){
	new_addPC();
});
function new_addPC(){
	var pc = new Object;
	var message;
	
	pc.pay_card_sn = $(".txt_input_cardnum2").val();
	pc.vid = <?php echo $this->_var['vid']; ?>;
	pc.password = $(".txt_input_cardpw2").val();
	pc.captcha = $(".captcha_error2").val();
	
	if(pc.pay_card_sn == ''){
		message = json_languages.card_number_null;
	}else if(pc.password == ''){
		message = json_languages.Real_name_password_null;
	}else if(pc.captcha == ''){
		message = json_languages.null_captcha_login;
	}
	
	if(pc.pay_card_sn != '' && pc.password != '' && pc.captcha != ''){
		Ajax.call('user.php', 'act=use_pay_card&pc=' + $.toJSON(pc), function(data){
			if(data.error == 2){
				pbDialog(data.message,"",0,"","","",true,function(){
					location.href = "user.php";
				});
			}else if(data.error == 3){
				pbDialog(data.message,"",0);
			}else if(data.error == 0){
				pbDialog(data.message,"",1,"","","",true,function(){
					 location.href = "user.php?act=value_card";
				});
			}else{
				pbDialog(data.message,"",0,"","",70);
			}
		}, 'POST', 'JSON');
	}else{
		pbDialog(message,"",0);
	}
}
</script>
<?php endif; ?>

<?php if ($this->_var['action'] == 'crowdfunding'): ?>
<script type="text/javascript">
$(function(){
    $(document).on("click","*[data-dialog='zc_focus_dialog']",function(){
        var divId = $(this).data('divid');
        var url = $(this).data('url');
        var result = json_languages.cancel_zc;
        var content = '<div class="tip-box icon-box">' +'<span class="warn-icon m-icon"></span>' + '<div class="item-fore">' +'<h3 class="rem ftx-04">'+result+'</h3>' +'</div>' +'</div>';
        pb({
            id:divId,
            title:json_languages.no_attention,
            width:455,
            height:58,
            ok_title:json_languages.determine, 	//按钮名称
            cl_title:json_languages.cancel, 	//按钮名称
            content:content, 	//调取内容
            drag:false,
            foot:true,
            onOk:function(){
                location.href = url;
            }
        });
        
        $('#' + divId + ' .tip-box .pb-ok').addClass('color_df3134');
    });
	
	$('.ui-tab a').click(function(){
		var index = $(this).data('val');
		$(this).addClass('curr').siblings("a").removeClass('curr');
		$(this).parents(".my_box").find(".pay_item").eq(index-1).show().siblings(".pay_item").hide();
	});
});
</script>
<?php endif; ?>

<?php if ($this->_var['action'] == 'account_bind'): ?>
<script type="text/javascript">
//购物车弹出框效果
$(document).on("click","*[data-dialog='oathdialog']",function(){
	
	var title = json_languages.Un_bind;
	var id = $(this).data('id');
	var username = $(this).data('username');
	var identity = $(this).data('identity');
	
	var title_h3 = json_languages.bind_user_one + title + identity + json_languages.account_bind_fuor + '？';
	var title_span = json_languages.account_bind_five+'<?php echo $this->_var['dwt_shop_name']; ?>'+ json_languages.account_bind_fuor + '：' + username + json_languages.registered +'.';
	
	pbDialog(title_h3,title_span,0,455,58,80,true,function(){
		Ajax.call('user.php?act=oath_remove', 'id=' + id + '&identity=' + identity, oath_removeResponse, 'POST','JSON');
	});
});

function oath_removeResponse(result){
	location.reload();
}
</script>
<?php endif; ?>

<?php if ($this->_var['action'] == 'account_safe'): ?>
<script type="text/javascript">
	/* 账号安全 使用手机验证、支付密码验证、使用邮箱验证、修改登录密码 提交表单 */
	$("*[ectype='submitBtn']").click(function(){
		var formName = $(this).parents("*[ectype='user_security_from']").attr("name");

		$("form[name='"+formName+"']").validate({
			errorPlacement:function(error, element){
				var error_div = element.parents('div.form-value').find('div.form_prompt');
				error_div.html("").append(error);
			},
			ignore : ""
		});
		
		//所有账户安全验证方式 验证码验证通用
		$("input[name='authCode']").rules("add",{
			required : true,
			remote : {
				cache: false,
				async:false,
				type:'POST',
				url:'user.php?act=account_safe&type=change_password&verify=authcode',
				data:{
					authCode:function(){
						return $("input[name='authCode']").val();
					}
				}
			},
			messages : {
				required : json_languages.null_captcha_login,
				remote : json_languages.null_captcha_error
			}
		});
		
		//修改登录密码和修改支付密码 第二步 填写新密码验证
		if(formName == "change_password_s" || formName == "payment_password"){
			var newpass = "",
				re_newpass = "",
				re_newpass_yz = "";
			
			if(formName == "change_password_s"){
				newpass = json_languages.new_login_pwd_null;
				re_newpass = json_languages.new_login_pwd_error;
				re_newpass_yz = json_languages.secondary_login_pwd_error;
			}else{
				newpass = json_languages.new_pay_pwd_null;
				re_newpass = json_languages.new_pay_pwd_error;
				re_newpass_yz = json_languages.secondary_pay_pwd_error;
			}
			
			//新密码
			$("input[name='new_password']").rules("add",{
				required : true,
				messages : {
					required : newpass
				}
			});
			
			//确认新密码
			$("input[name='re_new_password']").rules("add",{
				required : true,
				equalTo : "#password",
				messages : {
					required : re_newpass,
					equalTo : re_newpass_yz
				}
			});
		}
		
		/* 账号安全 第一步 使用手机验证 提交表单验证 */
		if(formName == "formUser"){
			//手机号码
			$("input[name='mobile_phone']").rules("add",{
				required : true,
				isMobile : true,
				messages : {
					required : json_languages.msg_phone_blank,
					isMobile : json_languages.msg_phone_not
				}
			});
			
			//手机短信验证码
			$("input[name='mobile_code']").rules("add",{
				required : true,
				remote : {
					cache: false,
					async:false,
					type:'POST',
					url:'user.php?act=account_safe&type=change_password&verify=mobilecode',
					data:{
						mobile_code:function(){
							return $("input[name='mobile_code']").val();
						}
					}
				},
				messages : {
					required : json_languages.null_captcha_login_phone,
					remote : json_languages.error_captcha_login_phone
				}
			});
		}
		
		/* 账号安全 第一步 使用支付密码验证 提交表单验证 */
		if(formName == "formUserPwd"){
			//支付密码
			$("input[name='pay_password']").rules("add",{
				required : true,
				remote : {
					cache: false,
					async:false,
					type:'POST',
					url:'user.php?act=account_safe&type=change_password&verify=pay_pwd',
					data:{
						payPwd:function(){
							return $("input[name='pay_password']").val();
						}
					}
				},
				messages : {
					required : json_languages.pay_password_packup_null,
					remote : json_languages.pay_password_packup_error
				}
			});
		}
		
		/* 账号安全 第一步 使用邮箱验证 提交表单验证 */
		if(formName == "change_email_s"){
			//支付密码
			$("input[name='change_email']").rules("add",{
				required : true,
				email : true,
				messages : {
					required : json_languages.null_email_user,
					email:json_languages.email_error
				}
			});
		}
		
		if(formName == "change_email_s"){
			/* 账号安全 使用邮箱验证通过 提交表单 */
			if($("form[name='"+formName+"']").valid()){
				var type = $(this).data("type");
				sendChangeEmail(type);
			}
		}else{
			/* 账号安全 非邮箱验证通过 提交表单 */
			if($("form[name='"+formName+"']").valid()){
				$("form[name='"+formName+"']").submit();
			}
		}
	});
	
	/* 账户安全 实名认证 */
	$("#authSubmit").click(function(){
		if($("form[name='real_name']").valid()){
			$("form[name='real_name']").submit();
		}
	});
	
	$("form[name='real_name']").validate({
		errorPlacement:function(error, element){
			var error_div = element.parents('div.value').find('div.form_prompt');
			element.parents('div.value').find(".notic").hide();
			error_div.append(error);
		},
		ignore:"",
		rules : {
			real_name : {
				required : true
			},
			self_num:{
				required : true,
				isIdCardNo:true
			},
			bank_name:{
				required : true
			},
			bank_card:{
				required : true
			},
			textfile_zheng:{
				required : true
			},
			textfile_fan:{
				required : true
			},
			mobile_phone:{
				required : true,
				isMobile : true
			},
			mobile_code:{
				required : true,
				remote : {
					cache: false,
					async:false,
					type:'POST',
					url:'user.php?act=account_safe&type=change_password&verify=mobilecode',
					data:{
						mobile_code:function(){
							return $("input[name='mobile_code']").val();
						}
					}
				}
			}
		},
		messages : {
			real_name : {
				required : json_languages.Real_name_null
			},
			self_num:{
				required : json_languages.number_ID_null,
				isIdCardNo:json_languages.number_ID_error
			},
			bank_name:{
				required : json_languages.bank_of_deposit_null
			},
			bank_card:{
				required : json_languages.bank_number_null
			},
			textfile_zheng:{
				required : json_languages.front_pic_null
			},
			textfile_fan:{
				required : json_languages.reverse_pic_null
			},
			mobile_phone : {
				required : json_languages.msg_phone_blank,
				isMobile : json_languages.msg_phone_not,
			},
			mobile_code : {
				required : json_languages.null_captcha_login_phone,
				remote : json_languages.error_captcha_login_phone
			}
		}
	});

	/* 账号安全 使用邮箱验证 使用发送邮箱 */
	function sendChangeEmail(mail_type){
		var authCode = $("input[name='authCode']").val(), 			//验证码
			mail_address = $("input[name='change_email']").val(),	//邮箱
			mail_address_data = '',									//ajax请求数据
			mail_url = '',											//ajax请求地址
			location_href_url = '';									//回调地址
		
		var isValidatedSize = $("input[name='is_validated']").size(),
			isValidated = '';
		
		if(mail_type == 'change_pwd'){
			mail_url = "user.php?is_ajax=1&act=account_safe&type=change_email&step=second_email_verify&mail_type=change_pwd";
			location_href_url = "user.php?act=account_safe&type=change_password&step=first&sign=validate_mail_ok";
		}else if(mail_type == 'change_mail'){
			mail_url = "user.php?is_ajax=1&act=account_safe&type=change_email&step=second_email_verify&mail_type=change_mail";
			location_href_url = "user.php?act=account_safe&type=change_email&step=first&sign=validate_mail_ok";
		}else if(mail_type == 'change_mobile'){
			mail_url = "user.php?is_ajax=1&act=account_safe&type=change_email&step=second_email_verify&mail_type=change_mobile";
			location_href_url = "user.php?act=account_safe&type=change_phone&step=first&sign=validate_mail_ok";
		}else if(mail_type == 'change_paypwd'){
			mail_url = "user.php?is_ajax=1&act=account_safe&type=change_email&step=second_email_verify&mail_type=change_paypwd";
			location_href_url = "user.php?act=account_safe&type=payment_password&step=first&sign=validate_mail_ok";
		}else if(mail_type == 'validate_mail'){
			mail_url = "user.php?is_ajax=1&act=account_safe&type=change_email&step=second_email_verify&mail_type=validate_mail";
			location_href_url = "user.php?act=account_safe&type=change_email&step=first&sign=validate_mail_ok";
		}else if(mail_type == 'edit_mail'){
			// 更改邮箱                    
			if(isValidatedSize == 1){
				isValidated = "&validated=1";
			}

			mail_url = "user.php?is_ajax=1&act=account_safe&type=change_email&step=second_email_verify&mail_type=edit_mail" + isValidated;
			location_href_url = "user.php?act=account_safe&type=change_email&step=second&sign=edit_email_ok";
		}

		//发送验证邮件
		$.ajax({
			cache: false,
			async: false,
			type: 'POST',
			data: {mail_address_data: mail_address},
			url: mail_url,
			success: function (res) {
				var result = eval("("+res+")");
				if(result.error){
					pbDialog(result.message,"",0);
					
					return false;
				}else{
					window.location.href=location_href_url;
				}
			}
		});
	}
</script>
<?php endif; ?>
<?php if ($this->_var['action'] == 'address'): ?>
<script type="text/javascript">
	$("#submitAddress").on("click",function(){
		var count = $("input[name='count_consignee']").val();
		
		if(count < 10){
			if($(this).parents("form[name='theForm']").valid()){
				$(this).parents("form[name='theForm']").submit();
			}
		}else{
			pbDialog(json_languages.add_address_10,"",0);
		}
	});
	
	$("form[name='theForm']").validate({
		errorPlacement:function(error, element){
			var error_div = element.parents('div.form-value').find('div.form_prompt');
			element.parents('div.form-value').find(".notic").hide();
			error_div.html("").append(error);
		},
		ignore:".ignore",
		rules : {
			consignee : {
				required : true
			},
			mobile : {
				required : true,
				isMobile : true
			},
			province : {
				min : 1
			},
			city : {
				min : 1
			},
			district : {
				min : 1
			},
			street : {
				min : 1
			},
			address : {
				required : true
			}
		},
		messages : {
			consignee : {
				required : json_languages.address_empty
			},
			mobile : {
				required : json_languages.msg_phone_blank,
				isMobile : json_languages.phone_format_error
			},
			province : {
				min : json_languages.Province
			},
			city : {
				min : json_languages.City
			},
			district : {
				min : json_languages.District
			},
			street : {
				min : json_languages.Street
			},
			address : {
				required : json_languages.Detailed_address_null
			}
		}
	});
</script>
<?php endif; ?>
<?php if ($this->_var['action'] == 'apply_suppliers'): ?>
<script type="text/javascript">
    /* 账户安全 实名认证 */
    $("#authSubmit").click(function(){
        if($("form[name='apply_suppliers']").valid()){
            $("form[name='apply_suppliers']").submit();
        }
    });
    
    $("form[name='apply_suppliers']").validate({
        errorPlacement:function(error, element){
            var error_div = element.parents('div.value').find('div.form_prompt');
            element.parents('div.value').find(".notic").hide();
            error_div.append(error);
        },
        ignore:".ignore",
        rules : {
            real_name : {
                required : true
            },
            self_num:{
                required : true,
                isIdCardNo:true
            },
            company_name:{
                required : true
            },
            company_address:{
                required : true
            },
            city:{
                required : true,
                min : 1 
            },
            textfile_zheng:{
                required : true
            },
            textfile_fan:{
                required : true
            },
            mobile_phone:{
                required : true,
                isMobile : true
            },
            mobile_code:{
                required : true,
                remote : {
                    cache: false,
                    async:false,
                    type:'POST',
                    url:'user.php?act=account_safe&type=change_password&verify=mobilecode',
                    data:{
                        mobile_code:function(){
                            return $("input[name='mobile_code']").val();
                        }
                    }
                }
            }
        },
        messages : {
            real_name : {
                required : json_languages.Real_name_null
            },
            self_num:{
                required : json_languages.number_ID_null,
                isIdCardNo:json_languages.number_ID_error
            },
            company_name:{
                required : json_languages.company_name_notic,
            },
            company_address:{
                required : json_languages.company_address_notic,
            },
            city:{
                required : json_languages.enter_region,
                min : json_languages.enter_region
            },            
            textfile_zheng:{
                required : json_languages.front_pic_null
            },
            textfile_fan:{
                required : json_languages.reverse_pic_null
            },
            mobile_phone : {
                required : json_languages.msg_phone_blank,
                isMobile : json_languages.msg_phone_not,
            },
            mobile_code : {
                required : json_languages.null_captcha_login_phone,
                remote : json_languages.error_captcha_login_phone
            }
        }
    });
    
    $.levelLink();//三级联动
    
    $.divselect("#first_cate","#first_cate_val",function(){
        val = $("#first_cate_val").val();   
        var filter = new Object;
        filter.cat_id  = val;
        Ajax.call('user.php?is_ajax=1&act=addChildCate', filter, responseSelectChildCate, 'GET', 'JSON');
    })
    
    function responseSelectChildCate(result){
        
        var steps = document.getElementById('steps_re_span');
        
        if(result.error == 0){
            steps.innerHTML = result.content;
        }
    }
</script>
<?php endif; ?>
</body>
</html>
