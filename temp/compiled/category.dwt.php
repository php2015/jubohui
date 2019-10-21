<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Keywords" content="<?php echo $this->_var['keywords']; ?>" />
<meta name="Description" content="<?php echo $this->_var['description']; ?>" />

<title><?php echo $this->_var['page_title']; ?></title>



<link rel="shortcut icon" href="favicon.ico" />
<?php echo $this->fetch('library/js_languages_new.lbi'); ?>
<link rel="stylesheet" type="text/css" href="themes/<?php echo $GLOBALS['_CFG']['template']; ?>/css/suggest.css" />
<link rel="stylesheet" type="text/css" href="themes/<?php echo $GLOBALS['_CFG']['template']; ?>/css/select.css" />
<link rel="stylesheet" type="text/css" href="js/perfect-scrollbar/perfect-scrollbar.min.css" />
</head>

<body>
	<?php echo $this->fetch('library/page_header_category.lbi'); ?>
    <?php echo $this->fetch('library/category_recommend_hot.lbi'); ?>
	<div class="w w1390">
    	<?php echo $this->fetch('library/ur_here.lbi'); ?>
    </div>
    <div class="container">
    	<div class="w w1390">
            <div class="selector">
                <?php echo $this->fetch('library/category_screening.lbi'); ?>
            </div>
            <?php echo $this->fetch('library/goods_list.lbi'); ?>
            
            <div class="p-panel-main guess-love">
            	<div class="ftit ftit-delr"><h3><?php echo $this->_var['lang']['guess_love']; ?></h3></div>
                <div class="gl-list clearfix">
                	<ul class="clearfix">
                        <?php $_from = $this->_var['guess_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');$this->_foreach['guess_goods'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['guess_goods']['total'] > 0):
    foreach ($_from AS $this->_var['goods']):
        $this->_foreach['guess_goods']['iteration']++;
?>
                        <?php if ($this->_foreach['guess_goods']['iteration'] < 8): ?>
                    	<li class="opacity_img">
                        	<div class="p-img"><a href="<?php echo $this->_var['goods']['url']; ?>" target="_blank"><img src="<?php echo $this->_var['goods']['goods_thumb']; ?>" width="190" height="190"></a></div>
                            <div class="p-price">
                                <?php if ($this->_var['goods']['promote_price'] != ''): ?>
                                    <?php echo $this->_var['goods']['promote_price']; ?>
                                <?php else: ?>
                                    <?php echo $this->_var['goods']['shop_price']; ?>
                                <?php endif; ?>
                            </div>
                            <div class="p-name"><a href="<?php echo $this->_var['goods']['url']; ?>" title="<?php echo htmlspecialchars($this->_var['goods']['goods_name']); ?>" target="_blank"><?php echo $this->_var['goods']['goods_name']; ?></a></div>
                        	<div class="p-num"><?php echo $this->_var['lang']['Sold']; ?><em><?php echo $this->_var['goods']['sales_volume']; ?></em><?php echo $this->_var['lang']['jian']; ?></div>
                        </li>
                        <?php endif; ?>
                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php 
$k = array (
  'name' => 'user_menu_position',
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?>
    	 
	<?php echo $this->fetch('library/duibi.lbi'); ?>
    
    <?php echo $this->fetch('library/page_footer.lbi'); ?>
    
    <?php echo $this->smarty_insert_scripts(array('files'=>'jquery.SuperSlide.2.1.1.js,common.js,compare.js,cart_common.js,parabola.js,shopping_flow.js,cart_quick_links.js,jd_choose.js,perfect-scrollbar/perfect-scrollbar.min.js')); ?>
	<script type="text/javascript" src="themes/<?php echo $GLOBALS['_CFG']['template']; ?>/js/dsc-common.js"></script>
    <script type="text/javascript" src="themes/<?php echo $GLOBALS['_CFG']['template']; ?>/js/jquery.purebox.js"></script>
    <?php if ($this->_var['category_load_type']): ?><script type="text/javascript" src="themes/<?php echo $GLOBALS['_CFG']['template']; ?>/js/asyLoadfloor.js"></script><?php endif; ?>
	<script type="text/javascript">
	$(function(){
		$(".gl-i-wrap").slide({mainCell:".sider ul",effect:"left",pnLoop:false,autoPlay:false,autoPage:true,prevCell:".sider-prev",nextCell:".sider-next",vis:5});
		
		//对比
		Compare.init();

		<?php if ($this->_var['category_load_type']): ?>
		var query_string = '<?php echo $this->_var['query_string']; ?>';
		$.itemLoad('.gl-warp-large .goods-list-warp','.gl-item','.goods-spread',query_string,0);
		<?php endif; ?>
		
		$("*[ectype='fsortTab'] .item").on("click",function(){
			var index = $(this).index();
			<?php if ($this->_var['category_load_type']): ?>
			if(index == 1){
				$.itemLoad('.gl-warp-samll .goods-list-warp','.gl-h-item','.goods-spread',query_string,1);
			}
			<?php endif; ?>
		});
	});
    </script>
</body>
</html>
