<!doctype html>
<html>
<head><?php echo $this->fetch('library/admin_html_head.lbi'); ?></head>

<body class="iframe_body">
<div class="warpper">
    <div class="title"><?php echo $this->_var['lang']['12_template']; ?> - <?php echo $this->_var['lang']['template_select']; ?></div>
    <div class="content">
        <div class="explanation" id="explanation">
            <div class="ex_tit"><i class="sc_icon"></i><h4><?php echo $this->_var['lang']['operating_hints']; ?></h4><span id="explanationZoom" title="<?php echo $this->_var['lang']['fold_tips']; ?>"></span></div>
            <ul>
                <li><?php echo $this->_var['lang']['operation_prompt_content']['template_list']['0']; ?></li>
                <li><?php echo $this->_var['lang']['operation_prompt_content']['template_list']['1']; ?></li>
            </ul>
        </div>
        <div class="flexilist">
            <div class="common-content">
                <div class="mian-info">
                    <div class="templet">
                        <div class="templet-thumb"><img src="<?php echo $this->_var['curr_template']['screenshot']; ?>" width="168" height="216" ectype="tempImg" /></div>
                        <div class="templet-info">
                            <h3 class="template_tit"><?php echo $this->_var['lang']['template_current']; ?></h3>
                            <strong class="template_name" ectype="tempName"><?php echo $this->_var['curr_template']['name']; ?></strong>
                            <div class="template_desc" ectype="tempDesc"><?php echo $this->_var['curr_template']['desc']; ?></div>
                            <input class="button" onclick="backupTemplate('<?php echo $this->_var['curr_template']['code']; ?>')" value="<?php echo $this->_var['lang']['backup']; ?>" type="button" id="default">
                        </div>
                        <div class="plat"></div>
                    </div>
                    <div class="template-list" ectype="templateList">
                        <ul>
                            <?php $_from = $this->_var['available_templates']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'template');if (count($_from)):
    foreach ($_from AS $this->_var['template']):
?>
                            <li<?php if ($this->_var['curr_template']['code'] == $this->_var['template']['code']): ?> class="curr"<?php endif; ?>>
                                <div class="tit"><?php echo $this->_var['template']['name']; ?></div>
                                <div class="span"><?php echo $this->_var['template']['desc']; ?></div>
                                <div class="img" onclick="javascript:setupTemplate('<?php echo $this->_var['template']['code']; ?>',this)">
                                    <?php if ($this->_var['template']['screenshot']): ?><img src="<?php echo $this->_var['template']['screenshot']; ?>" alt="<?php echo $this->_var['template']['name']; ?>" border="0" width="263" height="338" id="<?php echo $this->_var['template']['code']; ?>" /><?php endif; ?>
                                    <div class="bg"></div>
                                </div>
                                <a href="images/template/screenshot<?php echo $this->_var['template']['version']; ?>.png" class="nyroModal" target="_blank"><?php echo $this->_var['lang']['view_big_img']; ?></a>
                                <div class="box">
                                    <i class="icon icon-gou"></i>
                                    <span><?php echo $this->_var['lang']['use_active_template']; ?></span>
                                </div>
                                <div ectype="tempCode"><i class="ing"></i></div>
                            </li>
                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->fetch('library/pagefooter.lbi'); ?>
<script type="text/javascript">
    // 点击查看图片
    $(function(){
       // $(".nyroModal").nyroModal();
    });

    /**
     * 模板风格 全局变量
     */
    var T = 0;
    var StyleSelected = '<?php echo $this->_var['curr_tpl_style']; ?>';
    var StyleCode = '';
    var StyleTem = '';

    /**
     * 安装模版
     */
    function setupTemplate(tpl,obj)
    {
		var obj = $(obj);
		
		obj.parents("li").addClass("curr").siblings().removeClass("curr");
		
        if (tpl != StyleTem)
        {
            StyleCode = '';
        }
        if (confirm(setupConfirm))
        {
            Ajax.call('template.php?is_ajax=1&act=install', 'tpl_name=' + tpl, setupTemplateResponse, 'GET', 'JSON');
        }
    }

    /**
     * 处理安装模版的反馈信息
     */
    function setupTemplateResponse(result)
    {
        StyleCode = '';
        if (result.message.length > 0)
        {
            alert(result.message);
        }
        if (result.error == 0)
        {
            showTemplateInfo(result.content);
        }
    }
	
	/**
     * 显示模板信息
     */
    function showTemplateInfo(res)
    {
		$("*[ectype='tempImg']").attr("src",res.screenshot);
		$("*[ectype='tempName']").html(res.name);
		$("*[ectype='tempDesc']").html(res.desc);
    }

    /**
     * 备份当前模板
     */
    function backupTemplate(tpl)
    {
        Ajax.call('template.php?is_ajax=1&act=backup', 'tpl_name=' + tpl, backupTemplateResponse, "GET", "JSON");
    }

    function backupTemplateResponse(result)
    {
        if (result.message.length>0)
        {
            alert(result.message);
        }

        if (result.error == 0)
        {
            location.href = result.content;
        }
    }
</script>
</body>
</html>
