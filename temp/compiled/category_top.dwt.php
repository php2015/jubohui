<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Keywords" content="<?php echo $this->_var['keywords']; ?>" />
<meta name="Description" content="<?php echo $this->_var['description']; ?>" />

<title><?php echo $this->_var['page_title']; ?></title>



<link rel="shortcut icon" href="favicon.ico" />
<?php echo $this->fetch('library/js_languages_new.lbi'); ?>
</head>

<body class='<?php if ($this->_var['cate_info']['top_style_tpl'] == 1): ?>catetop-cloth<?php elseif ($this->_var['cate_info']['top_style_tpl'] == 2): ?>catetop-jiadian<?php elseif ($this->_var['cate_info']['top_style_tpl'] == 3): ?>catetop-food<?php else: ?>catetop-default<?php endif; ?>'>
	<?php echo $this->fetch('library/page_header_category_top.lbi'); ?>
	<?php if ($this->_var['cate_info']['top_style_tpl'] == 1): ?>
	<?php echo $this->fetch('library/top_style_tpl_1.lbi'); ?>
	<?php elseif ($this->_var['cate_info']['top_style_tpl'] == 2): ?>
	<?php echo $this->fetch('library/top_style_tpl_2.lbi'); ?>
	<?php elseif ($this->_var['cate_info']['top_style_tpl'] == 3): ?>
	<?php echo $this->fetch('library/top_style_tpl_3.lbi'); ?>
	<?php else: ?>
	<?php echo $this->fetch('library/top_style_tpl_0.lbi'); ?>
	<?php endif; ?>
    <?php 
$k = array (
  'name' => 'user_menu_position',
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?>

    <?php echo $this->fetch('library/page_footer.lbi'); ?>
    
    <?php echo $this->smarty_insert_scripts(array('files'=>'jquery.SuperSlide.2.1.1.js,jquery.yomi.js,cart_common.js,parabola.js,cart_quick_links.js')); ?>
	<script type="text/javascript" src="themes/<?php echo $GLOBALS['_CFG']['template']; ?>/js/dsc-common.js"></script>
    <script type="text/javascript" src="themes/<?php echo $GLOBALS['_CFG']['template']; ?>/js/asyLoadfloor.js"></script>
	<script type="text/javascript" src="themes/<?php echo $GLOBALS['_CFG']['template']; ?>/js/jquery.purebox.js"></script>
    
    <script type="text/javascript">
	$(function(){
		//顶级分类页模板id
		//tpl==0 默认模板、tpl==1 女装模板、tpl==2 家电模板、tpl==3 食品模板
		var tpl = $("input[name='tpl']").val();
		var length = $(".catetop-banner .bd").find("li").length;
		//轮播图
		if(length>1){
			if(tpl == 1){
				$(".catetop-banner").slide({titCell:".cloth-hd ul",mainCell:".bd ul",effect:"fold",interTime:3500,delayTime:500,autoPlay:true,autoPage:true,trigger:"mouseover"});
			}else if(tpl == 3){
				$(".catetop-banner").slide({titCell:".food-hd ul",mainCell:".bd ul",effect:"fold",interTime:3500,delayTime:500,autoPlay:true,autoPage:true,trigger:"mouseover"});
			}else{
				$(".catetop-banner").slide({titCell:".hd ul",mainCell:".bd ul",effect:"fold",interTime:3500,delayTime:500,autoPlay:true,autoPage:true,trigger:"mouseover"});
			}
		}else{
			$(".catetop-banner .hd").hide();
		}
		
		if(tpl == 1){
			//女装模板 精品大牌
			var length2 = $(".selectbrand-slide .bd").find("li").length;
			if(length2>5){
				$(".selectbrand-slide").slide({mainCell:".bd ul",titCell:".hd ul",effect:"left",pnLoop: false,vis: 5,scroll: 5,autoPage:"<li></li>"});
				$(".selectbrand-slide .prev,.selectbrand-slide .next").show();
			}else{
				$(".selectbrand-slide .prev,.selectbrand-slide .next").hide();
			}
		}else if(tpl == 2){
			$(".hotrecommend").slide({hd:".hr-slide-hd ul",effect:"fold"});
		}else if(tpl == 0){
			$(".toprank").slide({effect:"fold",titCell:".hd ul li"});
			$(".catetop-brand .brand-slide").slide({mainCell: '.bs-bd ul',effect: 'left',vis: 10,scroll: 10,autoPage: true});
			$.catetopLift();
			
			if($("input[name='history']").val() == 0){
				$(".lift-history").hide();
			}else{
				$(".lift-history").show();
			}
		}
		
		//随手购
		if($(".atwillgo-slide .bd").find("li").length > 6){
			$(".atwillgo-slide").slide({mainCell:".bd ul",titCell:".hd ul",effect:"left",pnLoop:false,vis: 6,scroll: 6,autoPage:"<li></li>"});
		}else{
			$(".atwillgo-slide").find(".prev,.next").hide();
		}
		
		//楼层异步加载封装函数调用
		if(tpl != 0){
			$.catTopLoad(tpl);
		}
	});
    </script>
</body>
</html>
