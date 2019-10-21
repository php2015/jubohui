<?php if ($this->_var['comments']): ?>
<?php $_from = $this->_var['comments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'comment');$this->_foreach['no'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['no']['total'] > 0):
    foreach ($_from AS $this->_var['comment']):
        $this->_foreach['no']['iteration']++;
?>
<div class="com-list-item" id="comment_show">
	<div class="com-user-name">
		<div class="user-ico">
			<?php if ($this->_var['comment']['user_picture']): ?>
			<img src="<?php echo $this->_var['comment']['user_picture']; ?>" width="50" height="50">
			<?php else: ?>
			<img src="themes/ecmoban_dsc2017/images/touxiang.jpg" width="50" height="50" />
			<?php endif; ?>
		</div>
		<div class="user-txt"><?php echo htmlspecialchars($this->_var['comment']['username']); ?></div>
	</div>
	<div class="com-item-warp">
		<div class="ciw-top">
			<div class="grade-star"><span class="grade-star-bg" style="width:<?php if ($this->_var['comment']['rank'] == 1): ?>20<?php elseif ($this->_var['comment']['rank'] == 2): ?>40<?php elseif ($this->_var['comment']['rank'] == 3): ?>60<?php elseif ($this->_var['comment']['rank'] == 4): ?>80<?php elseif ($this->_var['comment']['rank'] == 5): ?>100<?php endif; ?>%"></span></div>
			<div class="ciw-actor-info">
				<?php $_from = $this->_var['comment']['goods_tag']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'tag_0_30588500_1569574691');$this->_foreach['no'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['no']['total'] > 0):
    foreach ($_from AS $this->_var['tag_0_30588500_1569574691']):
        $this->_foreach['no']['iteration']++;
?>
                <?php if ($this->_var['tag_0_30588500_1569574691']['txt']): ?>			
				<span><e><?php echo $this->_var['tag_0_30588500_1569574691']['txt']; ?></e></span>
                <?php endif; ?>			
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>			
			</div>
			<div class="ciw-time"><?php echo $this->_var['comment']['add_time']; ?></div>
		</div>
		<div class="ciw-content">
			<div class="com-warp">
				<div class="com-txt"><?php echo $this->_var['comment']['content']; ?></div>
				<div class="com-operate">
                	<div class="com-operate-warp">
                        <a href="javascript:void(0);" class="nice comment_nice<?php if ($this->_var['comment']['useful'] > 0): ?> selected<?php endif; ?>" data-commentid="<?php echo $this->_var['comment']['id']; ?>" data-idvalue="<?php echo $this->_var['comment']['id_value']; ?>"><i class="iconfont icon-thumb"></i><em class='reply-nice<?php echo $this->_var['comment']['id']; ?>'><?php echo $this->_var['comment']['useful']; ?></em></a>
                        <a href="javascript:void(0);" class="reply<?php if ($this->_var['comment']['reply_count'] > 0): ?> selected<?php endif; ?>" ectype="reply"><i class="iconfont icon-comment"></i><font class="reply-count<?php echo $this->_var['comment']['id']; ?>"><?php echo $this->_var['comment']['reply_count']; ?></font></a>
                    </div>
				</div>
                <div class="comment-content reply-textarea hide" id="reply-textarea<?php echo $this->_var['comment']['id']; ?>">
                    <div class="reply-arrow"><b class="layer"></b></div>
                    <div class="inner">
                        <textarea class="reply-input" name="reply_content<?php echo $this->_var['comment']['id']; ?>" id="reply_content<?php echo $this->_var['comment']['id']; ?>" placeholder="<?php echo htmlspecialchars($this->_var['comment']['username']); ?>："></textarea>
                    </div>
                    <div class="btnbox">
                        <span id="reply-error<?php echo $this->_var['comment']['id']; ?>"></span>
                        <input name="comment_goods<?php echo $this->_var['comment']['id']; ?>" id="comment_goods<?php echo $this->_var['comment']['id']; ?>" type="hidden" value="<?php echo $this->_var['comment']['id_value']; ?>">
                        <input name="comment_user<?php echo $this->_var['comment']['id']; ?>" id="comment_user<?php echo $this->_var['comment']['id']; ?>" type="hidden" value="<?php echo $this->_var['comment']['user_id']; ?>">
                        <a href="javascript:void(0);" class="btn sc-redBg-btn btn25 mt10 mr0" ectype="replySubmit" data-value="<?php echo $this->_var['comment']['id']; ?>"><?php echo $this->_var['lang']['submit_goods']; ?></a>
                    </div>
                </div>
				<?php if ($this->_var['comment']['img_list']): ?>
				<div class="com-imgs">
					<div class="p-imgs-warp">
						<div class="p-thumb-img">
							<ul>
								<?php $_from = $this->_var['comment']['img_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'img');$this->_foreach['img'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['img']['total'] > 0):
    foreach ($_from AS $this->_var['key'] => $this->_var['img']):
        $this->_foreach['img']['iteration']++;
?>
								<li data-src="<?php echo $this->_var['img']['comment_img']; ?>" data-count="<?php echo $this->_foreach['img']['iteration']; ?>"><a href="javascript:void(0);"><img src="<?php echo $this->_var['img']['comment_img']; ?>"></a></li>
								<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
							</ul>
						</div>
						<div class="p-view-img" style="display:none;">
							<img src="">
							<a href="javascript:void(0);" class="p-prev"><i></i></a>
							<a href="javascript:void(0);" class="p-next"><i></i></a>
						</div>
					</div>
				</div>
				<?php endif; ?>
        <div class="com_goods_attr fl"><?php if ($this->_var['comment']['goods_attr']): ?> [<?php echo $this->_var['comment']['goods_attr']; ?>]<?php endif; ?></div>
			</div>
			<?php if ($this->_var['comment']['re_content']): ?>
			<div class="reply_info">
				<div class="item"><em><?php echo $this->_var['comment']['shop_name']; ?>：</em><?php echo $this->_var['comment']['re_content']; ?></div>
			</div>
			<?php endif; ?>
			<div class="reply_info comment-reply<?php echo $this->_var['comment']['id']; ?>" id="reply_comment_ECS_COMMENT<?php echo $this->_var['comment']['id']; ?>">
				<?php $_from = $this->_var['comment']['reply_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'reply');if (count($_from)):
    foreach ($_from AS $this->_var['reply']):
?>
				<div class="item">                                          
                    <em><?php echo $this->_var['reply']['user_name']; ?>：</em>
                    <span class="words"><?php echo $this->_var['reply']['content']; ?></span>
                    <span class="time fr">&#12288;<?php echo $this->_var['reply']['add_time']; ?></span>                                              
				</div>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				<?php if ($this->_var['comment']['reply_count'] > $this->_var['comment']['reply_size']): ?>
				<div class="pages26">
					<div class="pages">
						<div class="pages-it">
							<?php echo $this->_var['comment']['reply_pager']; ?>
						</div>
					</div>
				</div>
				<?php endif; ?>
			</div>			
		</div>
	</div>
</div>
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
<?php else: ?>
<div class="no_records no_comments_qt">
    <i class="no_icon no_icon_three"></i>
    <span class="block"><?php echo $this->_var['lang']['not_evaluate']; ?></span>
</div>
<?php endif; ?>

<?php if ($this->_var['count'] > $this->_var['size']): ?>
<div class="pages26">
    <div class="pages">
        <div class="pages-it">
        <?php echo $this->_var['pager']; ?>
        </div>
    </div>
</div>
<?php endif; ?>
<script type="text/javascript">
	$(function(){
		$("*[ectype='replySubmit']").click(function(){
			var T = $(this);
			var comment_id = T.data("value");
			var reply_content = $("#reply_content" + comment_id).val();
			var user_id = $("#comment_user" + comment_id).val();
			var goods_id = $("#comment_goods" + comment_id).val();
			
			if(reply_content == ''){
				$("#reply-error" + comment_id).html(json_languages.please_message_input);
				return false;
			}

			Ajax.call('comment.php', 'act=comment_reply&comment_id=' + comment_id + '&reply_content=' + reply_content + '&goods_id=' + goods_id + '&user_id=' + user_id, commentReplyResponse, 'POST', 'JSON');
		});
		
		$('.comment_nice').click(function(){
			var T = $(this);
			var comment_id = T.data('commentid');
			var goods_id = T.data('idvalue');
			var type = 'comment';
			
			Ajax.call('comment.php', 'act=add_useful&id=' + comment_id + '&goods_id=' + goods_id + '&type=' + type, niceResponse, 'GET', 'JSON');
		});
	});
	
	function commentReplyResponse(res){
		if(res.err_no == 1){
			var back_url = res.url;
			$.notLogin("get_ajax_content.php?act=get_login_dialog",back_url);
			return false;
		}else if(res.err_no == 2){
			$("#reply-error" + res.comment_id).html(json_languages.been_evaluated);
		}else{
			$("#reply-error" + res.comment_id).html(json_languages.Add_success);
			$("#reply_content" + res.comment_id).val('');
			$("#reply-textarea" + res.comment_id).addClass('hide');
            $(".reply-count").addClass('red');
		}
		$(".comment-reply" + res.comment_id).html(res.content);
		$(".reply-count" + res.comment_id).html(res.reply_count);
	}
	
	function niceResponse(res){
		if(res.err_no == 1){
			var back_url = res.url;
			$.notLogin("get_ajax_content.php?act=get_login_dialog",back_url);
			return false;
		}else if(res.err_no == 0){
			$(".reply-nice" + res.id).html(res.useful);
            $(".comment_nice").addClass("selected");
		}
	}
</script>