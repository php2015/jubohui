<div class="login-wrap">
    
    <div class="login-form">
    	<?php if ($this->_var['website_list']): ?>
    	<div class="coagent">
            <div class="tit"><h3><?php echo $this->_var['lang']['Third_party_Lgion']; ?></h3><span></span></div>
            <div class="coagent-warp">
            	<?php $_from = $this->_var['website_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'website');if (count($_from)):
    foreach ($_from AS $this->_var['website']):
?>
                <?php if ($this->_var['website']['web_type'] == 'weixin'): ?>
                	<a href="wechat_oauth.php?act=login<?php if ($this->_var['website']['back_act'] != ''): ?>&user_callblock=<?php echo $this->_var['website']['back_act']; ?><?php endif; ?>" class="<?php echo $this->_var['website']['web_type']; ?>"><b class="third-party-icon <?php echo $this->_var['website']['web_type']; ?>-icon"></b></a>
                <?php else: ?>
                    <a href="user.php?act=oath&type=<?php echo $this->_var['website']['web_type']; ?><?php if ($this->_var['website']['back_act'] != ''): ?>&user_callblock=<?php echo $this->_var['website']['back_act']; ?><?php endif; ?>" class="<?php echo $this->_var['website']['web_type']; ?>"><b class="third-party-icon <?php echo $this->_var['website']['web_type']; ?>-icon"></b></a>
                <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            </div>
        </div>
        <?php endif; ?>
        <div class="login-box">
            <div class="tit"><h3><?php echo $this->_var['lang']['account_login']; ?></h3><span></span></div>
            <div class="msg-wrap"></div>
            <div class="form">
            	<form name="formLogin" action="<?php echo $this->_var['site_domain']; ?>user.php" method="post" onSubmit="userLogin();return false;">
                	<div class="item">
                        <div class="item-info">
                            <i class="iconfont icon-name"></i>
                            <input type="text" id="loginname" name="username" class="text" value="" placeholder="<?php echo $this->_var['lang']['label_username']; ?>" />
                        </div>
                    </div>
                    <div class="item">
                        <div class="item-info">
                            <i class="iconfont icon-password"></i>
                            <input type="password" style="display:none"/>
                            <input type="password" id="nloginpwd" name="password" value="" class="text" placeholder="<?php echo $this->_var['lang']['label_password']; ?>" />
                        </div>
                    </div>
                    <?php if ($this->_var['enabled_captcha']): ?>
                    <div class="item">
                        <div class="item-info">
                            <i class="iconfont icon-security"></i>
                            <input type="text" id="captcha" name="captcha" value="" class="text text-2 fl" placeholder="<?php echo $this->_var['lang']['comment_captcha']; ?>" />
                            <img src="captcha_verify.php?captcha=is_login&<?php echo $this->_var['rand']; ?>" alt="captcha" class="captcha_img fl" onClick="this.src='captcha_verify.php?captcha=is_login&'+Math.random()" />
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="item">
                        <input id="remember" name="remember" type="checkbox" class="ui-checkbox">
                        <label for="remember" class="ui-label"><?php echo $this->_var['user_lang']['remember']; ?></label>
                    </div>
                    <div class="item item-button">
                    	<input type="hidden" name="dsc_token" value="<?php echo empty($this->_var['dsc_token']) ? '0' : $this->_var['dsc_token']; ?>" />
                        <input type="hidden" name="act" value="act_login" />
                        <input type="hidden" name="back_act" value="<?php echo $this->_var['back_act']; ?>" />
                        <input type="submit" name="submit" value="<?php echo $this->_var['lang']['signin_now']; ?>" class="btn sc-redBg-btn" />
                    </div>
                    <div class="lie">
                    	<a href="user.php?act=get_password" class="notpwd gary fl" target="_blank"><?php echo $this->_var['lang']['passportforgot_password']; ?></a>
                    	<?php if ($this->_var['shop_reg_closed'] != 1): ?><a href="user.php?act=register" class="notpwd red fr" target="_blank"><?php echo $this->_var['lang']['Free_registration']; ?></a><?php endif; ?>
                    </div>
                </form>
            </div>
    	</div>        
    </div>
    <script type="text/javascript">
	<?php $_from = $this->_var['user_lang']['passport_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('k', 'lang_0_10027400_1569574698');if (count($_from)):
    foreach ($_from AS $this->_var['k'] => $this->_var['lang_0_10027400_1569574698']):
?>
	var <?php echo $this->_var['k']; ?>="<?php echo $this->_var['lang_0_10027400_1569574698']; ?>";
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		/* *
		 * 会员登录
		*/ 
		function userLogin()
		{
			var frm = $("form[name='formLogin']");
			var username = frm.find("input[name='username']");
			var password = frm.find("input[name='password']");
			var captcha = frm.find("input[name='captcha']");
			var dsc_token = frm.find("input[name='dsc_token']");
			var error = frm.find(".msg-error");
			var msg = '';
			
			if(username.val()==""){
				error.show();
				username.parents(".item").addClass("item-error");
				msg += username_empty;
				showMesInfo(msg);
				return false;
			}
			
			if(password.val()==""){
				error.show();
				password.parents(".item").addClass("item-error");
				msg += password_empty;
				showMesInfo(msg);
				return false;
			}
			
			if(captcha.val()==""){
				error.show();
				captcha.parents(".item").addClass("item-error");
				msg += captcha_empty;
				showMesInfo(msg);
				return false;
			}
			var back_act=frm.find("input[name='back_act']").val();
			
			<?php if ($this->_var['is_jsonp'] && $this->_var['site_domain']): ?>
				
				var post_url = "act=act_login&is_jsonp=" + <?php echo $this->_var['is_jsonp']; ?> + '&username=' + username.val()+'&password='+password.val()+'&dsc_token='+dsc_token.val()+'&captcha='+captcha.val()+'&back_act='+back_act;

				$.ajax({
				   type: "POST",
				   /*jquery Ajax跨域*/
				   url: "<?php echo $this->_var['site_domain']; ?>user.php",
				   data: post_url,
				   dataType:'jsonp',
				   jsonp:"jsoncallback",
				   success: function(data){
					   return_login(data)
				   }
				});
			<?php else: ?>
				Ajax.call( 'user.php?act=act_login', 'username=' + username.val()+'&password='+password.val()+'&dsc_token='+dsc_token.val()+'&captcha='+captcha.val()+'&back_act='+back_act, return_login , 'POST', 'JSON');
			<?php endif; ?>
		}
		
		function return_login(result)
		{
			if(result.error>0)
			{
				showMesInfo(result.message);	
			}
			else
			{
				if(result.ucdata){
					$("body").append(result.ucdata)
				}
				location.href=result.url;
			}
		}
		
		function showMesInfo(msg) {
			$('.login-wrap .msg-wrap').empty();
			var info = '<div class="msg-error"><b></b>' + msg + '</div>';
			$('.login-wrap .msg-wrap').append(info);
		}
	</script>
</div>
