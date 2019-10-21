 
<div class="preview" if="preview">
	<div class="gallery_wrap">
        <ul>
            <?php if ($this->_var['goods']['goods_video'] != ''): ?>
            <li ectype="video">
                <video id="videoPlay" width="398" height="398" src="<?php echo $this->_var['goods']['goods_video_path']; ?>" preload="auto" poster="">
                    <source src="<?php echo $this->_var['goods']['goods_video_path']; ?>" class="goods_video_js" type="video/mp4"/>
                </video>
                <div class="video_default"></div>
            </li>
            <?php endif; ?>
            <li ectype="img"<?php if ($this->_var['goods']['goods_video'] != ''): ?> style="display: none;"<?php endif; ?>>
                <a href="<?php if ($this->_var['goods']['goods_video'] == ''): ?><?php if ($this->_var['pictures']['0']['img_url']): ?><?php echo $this->_var['pictures']['0']['img_url']; ?><?php else: ?><?php echo $this->_var['goods']['goods_img']; ?><?php endif; ?><?php else: ?><?php echo $this->_var['goods']['goods_video_path']; ?><?php endif; ?>" class="MagicZoomPlus" id="Zoomer" rel="hint-text: ; selectors-effect: false; selectors-class: img-hover; selectors-change: mouseover; zoom-distance: 10;zoom-width: 400; zoom-height: 474;">
                    <img src="<?php if ($this->_var['pictures']['0']['img_url']): ?><?php echo $this->_var['pictures']['0']['img_url']; ?><?php else: ?><?php echo $this->_var['goods']['goods_img']; ?><?php endif; ?>" id="J_prodImg" alt="<?php echo htmlspecialchars($this->_var['goods']['goods_name']); ?>">
                </a>
            </li>
        </ul>
    </div>
	<div class="spec-list">
		<a href="javascript:void(0);" class="spec-prev"><i class="iconfont icon-left"></i></a>
		<div class="spec-items">
			<ul>
                <?php if ($this->_var['goods']['goods_video'] != ''): ?>
                <li data-type="video"><a href="javascript:void(0);" rev="<?php echo $this->_var['goods']['goods_video_path']; ?>" class="img-hover"><img src="<?php echo $this->_var['goods']['goods_img']; ?>" width="58" height="58"></a></li>
                <?php endif; ?>
                <?php if (! $this->_var['pictures']['0']['img_url'] && $this->_var['goods']['goods_img']): ?>
                <li data-type="img">
                    <a href="<?php echo $this->_var['goods']['goods_img']; ?>" rel="zoom-id: Zoomer" rev="<?php echo $this->_var['goods']['goods_img']; ?>">
                        <img src="<?php echo $this->_var['goods']['goods_img']; ?>" alt="<?php echo $this->_var['goods']['goods_name']; ?>" width="58" height="58"/>
                    </a>
                </li>
                <?php endif; ?>
            	<?php if ($this->_var['pictures']): ?> 
                <?php $_from = $this->_var['pictures']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'picture');$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from AS $this->_var['picture']):
        $this->_foreach['foo']['iteration']++;
?>
                <li data-type="img">
					<a href="<?php if ($this->_var['picture']['img_url']): ?><?php echo $this->_var['picture']['img_url']; ?><?php else: ?><?php echo $this->_var['picture']['thumb_url']; ?><?php endif; ?>" rel="zoom-id: Zoomer" rev="<?php if ($this->_var['picture']['img_url']): ?><?php echo $this->_var['picture']['img_url']; ?><?php else: ?><?php echo $this->_var['picture']['thumb_url']; ?><?php endif; ?>" <?php if (($this->_foreach['foo']['iteration'] <= 1)): ?>class="img-hover"<?php endif; ?>>
						<img src="<?php if ($this->_var['picture']['thumb_url']): ?><?php echo $this->_var['picture']['thumb_url']; ?><?php else: ?><?php echo $this->_var['picture']['img_url']; ?><?php endif; ?>" alt="<?php echo $this->_var['goods']['goods_name']; ?>" width="58" height="58" />
					</a>
				</li>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
              	<?php endif; ?>
			</ul>
		</div>
		<a href="javascript:void(0);" class="spec-next"><i class="iconfont icon-right"></i></a>
	</div>
    <?php if ($this->_var['filename'] != 'group_buy' && $this->_var['filename'] != 'auction' && $this->_var['filename'] != 'snatch' && $this->_var['filename'] != 'exchange'): ?>
    <div class="short-share">
        <?php if ($this->_var['cfg']['show_goodssn']): ?><div class="short-share-r bar_code hide"><?php echo $this->_var['lang']['bar_code']; ?>：<em id="bar_code"></em></div><?php endif; ?>
        <div class="left-btn">
            <div class="duibi">
                <a href="javascript:void(0);" id="compareLink">
                    <input type="checkbox" name="" class="ui-checkbox" id="<?php echo $this->_var['goods']['goods_id']; ?>" onClick="Compare.add(this, <?php echo $this->_var['goods']['goods_id']; ?>,'<?php echo htmlspecialchars($this->_var['goods']['goods_name']); ?>','<?php echo $this->_var['goods']['goods_type']; ?>', '<?php echo $this->_var['goods']['goods_thumb']; ?>', '<?php echo $this->_var['goods']['shop_price']; ?>', '<?php echo $this->_var['goods']['market_price']; ?>')">
                    <label for="<?php echo $this->_var['goods']['goods_id']; ?>" class="ui-label"><?php echo $this->_var['lang']['compare']; ?></label>
                </a>
            </div>
            <a href="javascript:void(0);" class="collection choose-btn-coll" data-dialog="goods_collect_dialog" data-divid="goods_collect" data-url="user.php?act=collect" data-goodsid="<?php echo $this->_var['goods']['goods_id']; ?>" data-type="goods"><i class="iconfont choose-btn-icon<?php if ($this->_var['goods']['is_collect']): ?> icon-collection-alt<?php else: ?> icon-collection<?php endif; ?>" id="collection_iconfont"></i><em><?php echo $this->_var['lang']['collect']; ?> (<span id="collect_count"></span>)</em></a>
            <?php if ($this->_var['is_http'] == 2): ?>
            <div class="bdsharebuttonbox" style=" width:50px; height:25px; float:left;">
                <a href="javascript:void(0);" data-cmd="more" class="share bds_more" style=" width:50px; height:25px; background:none; margin:0px 0px 0px 15px; padding:0px;"><i class="iconfont icon-share"></i><em><?php echo $this->_var['lang']['share_flow']; ?></em></a>
            </div>
            <?php else: ?>
            <div id="bdshare" class="bdshare_t bds_tools get-codes-bdshare" ><a class="share bds_more" href="#none"><i class="iconfont icon-share"></i><em><?php echo $this->_var['lang']['share_flow']; ?></em></a></div>
            <?php endif; ?>
			<?php if ($this->_var['cfg']['is_illegal'] == 1): ?>
            <a class="report fr" href="#none" ectype="report"><em><?php echo $this->_var['lang']['report']; ?></em></a>
			<?php endif; ?>
        </div>
    </div>
    <?php endif; ?>
</div>
<script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=692785" ></script>
<script type="text/javascript" id="bdshell_js"></script>
<?php if ($this->_var['is_http'] == 2): ?>
<script type="text/javascript">
	document.getElementById("bdshell_js").src = "<?php echo $this->_var['url']; ?>static/api/js/share.js?v=89860593.js?cdnversion=" + new Date().getHours();
</script>
<?php else: ?>
<script type="text/javascript">
	document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + new Date().getHours();
</script>
<?php endif; ?>

<script type="text/javascript">
$(function(){
	get_collection();

    $(".spec-items li").on("mouseover",function(){
        var type = $(this).data("type");
        if(type == 'img'){
            $(".gallery_wrap").find("*[ectype='img']").show().siblings().hide();
        }else{
            $(".gallery_wrap").find("*[ectype='video']").show().siblings().hide();
        }

        $(this).find("a").addClass("img-hover");
        $(this).siblings().find("a").removeClass("img-hover");
    });

    $(".video_default").on("click",function(){
        $('#videoPlay').click();
        $(this).hide();
    });

});

var video = document.getElementById("videoPlay");
if(video){
    video.onclick=function(){
        if(video.paused){
            video.play();
            $(".video_default").hide();
        }else{
            video.pause();
            $(".video_default").show();
        }
    }

    video.addEventListener("ended",function(){
        video.currentTime = 0;
        $(".video_default").show();
    })
}
function get_collection(){
	Ajax.call('ajax_dialog.php', 'act=goods_collection&goods_id=' + <?php echo empty($this->_var['goods_id']) ? '0' : $this->_var['goods_id']; ?>, goodsCollectionResponse, 'GET', 'JSON');
}

function goodsCollectionResponse(res){
	$("#collect_count").html(res.collect_count);
	
	if(res.is_collect > 0){
		$(".collection").addClass('selected');
		$("#collection_iconfont").addClass("icon-collection-alt");
		$("#collection_iconfont").removeClass('icon-collection');
	}else{
		$(".collection").removeClass('selected');
		$("#collection_iconfont").addClass("icon-collection");
		$("#collection_iconfont").removeClass('icon-collection-alt');
	}
}

</script>
