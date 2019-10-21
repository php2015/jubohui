<!doctype html>
<html>
<head><?php echo $this->fetch('library/admin_html_head.lbi'); ?></head>

<body class="iframe_body">
	<div class="warpper">
		<div class="title"><?php echo $this->_var['lang']['12_template']; ?> - <?php echo $this->_var['lang']['library']; ?></div>
        <div class="content">
        	<div class="explanation" id="explanation">
                <div class="ex_tit"><i class="sc_icon"></i><h4><?php echo $this->_var['lang']['operating_hints']; ?></h4><span id="explanationZoom" title="<?php echo $this->_var['lang']['fold_tips']; ?>"></span></div>
                <ul>
                    <li><?php echo $this->_var['lang']['operation_prompt_content']['library']['0']; ?></li>
                    <li><?php echo $this->_var['lang']['operation_prompt_content']['library']['1']; ?></li>
                </ul>
            </div>
        	<div class="flexilist">
                <div class="common-content">
                <form method="post" onsubmit="return false">
                    <div class="form-div">
                        <label class="fl"><?php echo $this->_var['lang']['select_library']; ?></label>
                        <div id="selLib" class="imitate_select select_w320" rank="1">
                            <div class="cite"><?php echo $this->_var['lang']['select_cat']; ?></div>
                            <ul>
                                <?php $_from = $this->_var['libraries']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'vo');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['vo']):
?>
                                <li><a href="javascript:;" data-value="<?php echo $this->_var['key']; ?>" class="ftx-01"><?php echo $this->_var['vo']; ?></a></li>
                                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                            </ul>
                            <input name="catFirst" type="hidden" value="0" id="selLib_val">
                        </div>
                    </div>
                    
                    <div class="main-div mt20">
                        <div class="libContent"><textarea id="libContent" rows="20" class="textarea"><?php echo htmlspecialchars($this->_var['library_html']); ?></textarea></div>
                        <div class="info_btn mt20">
                            <input type="button" value="<?php echo $this->_var['lang']['button_submit']; ?>" class="button" onclick="updateLibrary()" />
                            <input type="button" value="<?php echo $this->_var['lang']['button_restore']; ?>" class="button button_restore" onclick="restoreLibrary()" />
                        </div>
                    </div>
                </form>
                </div>
			</div>
        </div>
	</div>        
    <?php echo $this->fetch('library/pagefooter.lbi'); ?>
    
    <script type="text/javascript">
    $(document).on('click','.ftx-01',function(){
        var currLib = $(this).data('value');
        $('#selLib_val').val(currLib);
        loadLibrary(currLib);
    });
    
    var currLibrary = "<?php echo $this->_var['curr_library']; ?>";
    var content = '';
    
    /**
     * 载入库项目内容
     */
    function loadLibrary(currLib)
    {
        curContent = document.getElementById('libContent').value;
    
        if (content != curContent && content != '')
        {
            if (!confirm(save_confirm))
            {
                return;
            }
        }
    
        Ajax.call('template.php?is_ajax=1&act=load_library', 'lib='+ currLib, loadLibraryResponse, "GET", "JSON");
    }
    
    /**
     * 还原库项目内容
     */
    function restoreLibrary()
    {
        selLib  = document.getElementById('selLib');
        currLib = selLib.options[selLib.selectedIndex].value;
    
        Ajax.call('template.php?is_ajax=1&act=restore_library', "lib="+currLib, loadLibraryResponse, "GET", "JSON");
    }
    
    /**
     * 处理载入的反馈信息
     */
    function loadLibraryResponse(result)
    {
        if (result.error == 0)
        {
            document.getElementById('libContent').value=result.content;
        }
    
        if (result.message.length > 0)
        {
          alert(result.message);
        }
    }
    
    /**
     * 更新库项目内容
     */
    function updateLibrary()
    {
        currLib = $('#selLib_val').val();
        content = document.getElementById('libContent').value;
    
        if (Utils.trim(content) == "")
        {
            alert(empty_content);
            return;
        }
        Ajax.call('template.php?act=update_library&is_ajax=1', 'lib=' + currLib + "&html=" + encodeURIComponent(content), updateLibraryResponse, "POST", "JSON");
    }
    
    /**
     * 处理更新的反馈信息
     */
    function updateLibraryResponse(result)
    {
      if (result.message.length > 0)
      {
        alert(result.message);
      }
    }
    
    </script>
    
</body>
</html>