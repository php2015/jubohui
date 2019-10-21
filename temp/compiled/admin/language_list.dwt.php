<!doctype html>
<html>
<head><?php echo $this->fetch('library/admin_html_head.lbi'); ?></head>

<body class="iframe_body">
<div class="warpper">
	<div class="title"><?php echo $this->_var['lang']['12_template']; ?> - <?php echo $this->_var['lang']['edit_languages']; ?></div>
    <div class="content">
    	<div class="explanation" id="explanation">
            <div class="ex_tit"><i class="sc_icon"></i><h4><?php echo $this->_var['lang']['operating_hints']; ?></h4><span id="explanationZoom" title="<?php echo $this->_var['lang']['fold_tips']; ?>"></span></div>
            <ul>
                <li><?php echo $this->_var['lang']['operation_prompt_content']['list']['0']; ?></li>
                <li><?php echo $this->_var['lang']['operation_prompt_content']['list']['1']; ?></li>
                <li><?php echo $this->_var['lang']['operation_prompt_content']['list']['2']; ?></li>
            </ul>
        </div>
    	<div class="flexilist">
        	<div class="common-content">
            <div class="form-div">
                <form name="searchForm" action="edit_languages.php" method="post" onSubmit="return validate();">
                    <div class="imitate_select select_w320" rank="1">
                        <div class="cite"><?php echo $this->_var['lang']['select_cat']; ?></div>
                        <ul>
                            <?php $_from = $this->_var['lang_arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'vo');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['vo']):
?>
                            <li><a href="javascript:;" data-value="<?php echo $this->_var['key']; ?>" class="ftx-01"><?php echo $this->_var['vo']; ?></a></li>
                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                        </ul>
                        <input name="lang_file" type="hidden" value="0">
                    </div>        
                    <label class="fl lh30"><?php echo $this->_var['lang']['enter_keywords']; ?>：</label>
                    <input type="text" name="keyword" size="30" class="text" />
                    <input type="submit" value="<?php echo $this->_var['lang']['button_search']; ?>" class="btn btn30 red_btn" />
                    <input type="hidden" name="act" value="list" />
                </form>
            </div>
            <ul style="padding:0; margin: 0; list-style-type:none; color: #CC0000;">
              <?php if ($this->_var['file_attr']): ?>
              <li style="border: 1px solid #CC0000; background: #FFFFCC; padding: 10px; margin-bottom: 5px;" ><?php echo $this->_var['file_attr']; ?></li>
              <?php endif; ?>
            </ul>
            <form method="post" action="edit_languages.php">
                <div class="list-div mt20" id="listDiv">
                    <table width="100%" cellspacing="0" cellpadding="0" id="list-table">
                    <tr>
                        <th width="30%"><div class="tDiv"><?php echo $this->_var['lang']['item_name']; ?></div></th>
                        <th width="70%"><div class="tDiv"><?php echo $this->_var['lang']['item_value']; ?></div></th>
                    </tr>
                    <?php if ($this->_var['language_arr']): ?>
                        <?php $_from = $this->_var['language_arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'list');if (count($_from)):
    foreach ($_from AS $this->_var['list']):
?>
                        <tr>
                            <td>
                            	<div class="tDiv">
                                <?php echo $this->_var['list']['item_id']; ?><input type="hidden" name="item_id[]" value="<?php echo $this->_var['list']['item_id']; ?>" />
                                </div>
                            </td>
                            <td>
                            	<div class="tDiv">
                                	<input type="text" name="item_content[]" class="text" value="<?php echo htmlspecialchars($this->_var['list']['item_content']); ?>" size="60" />
                                </div>
                            </td>
                        </tr>
                        <tr style="display:none">
                            <td>&nbsp;</td>
                            <td>
                                <input type="hidden" name="item[]" value="<?php echo htmlspecialchars($this->_var['list']['item']); ?>" size="60"/>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr><td class="no-records" colspan="10"><?php echo $this->_var['lang']['no_records']; ?></td></tr>
                        <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
                        <tr>
                            <td colspan="2">
                                <div class="info_btn tc pt20 pb20">
                                    <input type="hidden" name="act" value="edit" />
                                    <input type="hidden" name="file_path" value="<?php echo $this->_var['file_path']; ?>" />
                                    <input type="hidden" name="keyword" value="<?php echo $this->_var['keyword']; ?>" />
                                    <input type="submit" value="<?php echo $this->_var['lang']['edit_button']; ?>" class="button fn" />
                                    <input type="reset" value="<?php echo $this->_var['lang']['reset_button']; ?>" class="button reset_button fn" />
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><div class="tDiv"><strong><?php echo $this->_var['lang']['notice_edit']; ?></strong></div></td>
                        </tr>
                    <?php else: ?>
                         <tr><td class="no-records" colspan="10"><?php echo $this->_var['lang']['search_languages']; ?></td></tr>  
                    <?php endif; ?>
                    </table>
                </div>
            </form>
            </div>
    	</div>        
	</div>
</div>
<?php echo $this->fetch('library/pagefooter.lbi'); ?>
<script type="text/javascript">
function validate()
{
    var frm     = document.forms['searchForm'];
    var keyword = frm.elements['keyword'].value;
    if (keyword.length == 0)
    {
        alert(keyword_empty_error);
        return false;
    }
    return true;
}
</script>
</body>
</html>
