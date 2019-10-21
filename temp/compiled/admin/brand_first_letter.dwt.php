<!doctype html>
<html>
<head><?php echo $this->fetch('library/admin_html_head.lbi'); ?></head>
 
<body class="iframe_body">
	<div class="warpper">
    	<div class="title"><a href="brand.php?act=list" class="s-back"><?php echo $this->_var['lang']['back']; ?></a><?php echo $this->_var['lang']['goods_alt']; ?> - <?php echo $this->_var['ur_here']; ?></div>
        <div class="content">
        	<div class="explanation" id="explanation">
            	<div class="ex_tit"><i class="sc_icon"></i><h4><?php echo $this->_var['lang']['operating_hints']; ?></h4><span id="explanationZoom" title="<?php echo $this->_var['lang']['fold_tips']; ?>"></span></div>
                <ul>
                	<li><?php echo $this->_var['lang']['operation_prompt_content']['create_brand_letter']['0']; ?></li>
                </ul>
            </div>
            <div class="flexilist">
                <div class="common-content">
                    <div class="mian-info">
						<div class="list-div">
						<?php echo $this->_var['lang']['current_modification_data']; ?><?php echo empty($this->_var['record_count']) ? '0' : $this->_var['record_count']; ?><?php echo $this->_var['lang']['tiao']; ?>
						</div>
						<div style=" width:100px; height:10px; clear:both; overflow:hidden;"></div>
						<div class="list-div">
						<table id="listTable">
							<tr>
                            	<th width="10%"><div class="tDiv"><?php echo $this->_var['lang']['record_id']; ?><div></th>
								<th width="10%"><div class="tDiv"><?php echo $this->_var['lang']['brand']; ?>ID</div></th>
								<th width="15%"><div class="tDiv"><?php echo $this->_var['lang']['brand_name']; ?></div></th>
								<th width="15%"><div class="tDiv"><?php echo $this->_var['lang']['brand_first_char']; ?></div></th>
							</tr>
						</table>
						</div>
                    </div>
                </div>
            </div>
		</div>
	</div>
	<?php echo $this->fetch('library/pagefooter.lbi'); ?>
    <?php echo $this->smarty_insert_scripts(array('files'=>'jquery.purebox.js')); ?>
    <script type="text/javascript">
        $(function(){
            start(<?php echo $this->_var['page']; ?>);
			ajax_title();
        });
        
        function start(page)
        {
            Ajax.call('brand.php?act=create_brand_initial', 'page=' + page, start_response, 'POST', 'JSON');
        }
        
        /**
         * 处理反馈信息
         * @param: result
         * @return
         */
        function start_response(result)
        {
            if(result.is_stop == 1){
                var tbl = document.getElementById("listTable"); //获取表格对象
                var row = tbl.insertRow(-1);
                
				cell = row.insertCell(0);
                cell.innerHTML = "<div class='tDiv'>"+result.filter_page+"</div>";
                cell = row.insertCell(1);
                cell.innerHTML = "<div class='tDiv'>"+result.list.brand_id+"</div>";
                cell = row.insertCell(2);
                cell.innerHTML = "<div class='tDiv'>"+result.list.brand_name+"</div>";
                cell = row.insertCell(3);
                cell.innerHTML = "<div class='tDiv'>"+result.list.letter+"</div>";
				
                if(result.is_stop == 1){
                    start(result.page);
                }	
            }
            
            if(result.is_stop == 0){
				$("#title_name").addClass("red");
                $("#title_name").html(title_name_one);
            }else{
				$("#title_name").html(title_name_two);
			}
        }
    </script>
</body>
</html>