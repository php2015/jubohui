<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Keywords" content="<?php echo $this->_var['keywords']; ?>" />
<meta name="Description" content="<?php echo $this->_var['description']; ?>" />

<title><?php echo $this->_var['page_title']; ?></title>



<link rel="shortcut icon" href="favicon.ico" />
<?php echo $this->fetch('library/js_languages_new.lbi'); ?>
<link rel="stylesheet" type="text/css" href="themes/<?php echo $GLOBALS['_CFG']['template']; ?>/css/goods_fitting.css" />
<link rel="stylesheet" type="text/css" href="themes/<?php echo $GLOBALS['_CFG']['template']; ?>/css/suggest.css" />
<link rel="stylesheet" type="text/css" href="js/calendar/calendar.min.css" />
<link rel="stylesheet" type="text/css" href="js/perfect-scrollbar/perfect-scrollbar.min.css" />
</head>

<body>
    <?php echo $this->fetch('library/page_header_common.lbi'); ?>
    <div class="full-main-n">
        <div class="w w1200 relative">
        <?php echo $this->fetch('library/ur_here.lbi'); ?>
        </div>
    </div>
    <div class="container">
    	<div class="w w1200">
            <div class="product-info mt20">
                <?php echo $this->fetch('library/goods_gallery.lbi'); ?>
                <div class="product-wrap<?php if ($this->_var['goods']['user_id']): ?> product-wrap-min<?php endif; ?>">
                    <form action="javascript:addToCart(<?php echo $this->_var['goods']['goods_id']; ?>)" method="post" name="ECS_FORMBUY" id="ECS_FORMBUY" >
                		<div class="name"><?php echo $this->_var['goods']['goods_style_name']; ?></div>
                        <?php if ($this->_var['goods']['goods_brief']): ?>
                        <div class="newp"><?php echo $this->_var['goods']['goods_brief']; ?></div>
                        <?php endif; ?>
                        <?php if ($this->_var['goods']['gmt_end_time']): ?>
                        <div class="activity-title" <?php if ($this->_var['promo_count'] > 1): ?> style="display:none;"<?php endif; ?>>
                            <div class="activity-type"><i class="icon icon-promotion"></i><?php echo $this->_var['lang']['promotion_time']; ?></div>
                            <div class="sk-time-cd">
                                <div class="sk-cd-tit"><?php echo $this->_var['lang']['distance_end']; ?></div>
                                <div class="cd-time" ectype="time" data-time="<?php echo $this->_var['goods']['promote_end_time']; ?>">
                                    <div class="days">00</div>
                                    <span class="split">:</span>
                                    <div class="hours">00</div>
                                    <span class="split">:</span>
                                    <div class="minutes">00</div>
                                    <span class="split">:</span>
                                    <div class="seconds">00</div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="summary">
                            <div class="summary-price-wrap">
                                <div class="s-p-w-wrap">
                                    <div class="summary-item si-shop-price">
                                        <div class="si-tit"><?php if ($this->_var['goods']['gmt_end_time']): ?><?php echo $this->_var['lang']['promote_price']; ?><?php else: ?><?php echo $this->_var['lang']['shop_price']; ?><?php endif; ?></div>
                                        <div class="si-warp">
                                            <strong class="shop-price" id="ECS_SHOPPRICE" ectype="SHOP_PRICE"></strong>
                                            <span class="price-notify" data-userid="<?php echo $this->_var['user_id']; ?>" data-goodsid="<?php echo $this->_var['goods']['goods_id']; ?>" ectype="priceNotify"><?php echo $this->_var['lang']['price_notice']; ?></span>
                                        </div>
                                    </div>
                                    <?php if ($this->_var['cfg']['show_marketprice']): ?>
                                    <div class="summary-item si-market-price">
                                        <div class="si-tit"><?php echo $this->_var['lang']['market_prices']; ?></div>
                                        <div class="si-warp"><div class="m-price" id="ECS_MARKETPRICE"></div></div>
                                    </div>
                                    <?php endif; ?>
                                    <div class="si-info">
                                        <div class="si-cumulative"><?php echo $this->_var['lang']['Cumulative_evaluation']; ?><em><?php echo $this->_var['comment_all']['allmen']; ?></em></div>
                                        <div class="si-cumulative"><?php echo $this->_var['lang']['Cumulative_Sales']; ?><em><?php echo $this->_var['goods']['sales_volume']; ?></em></div>
                                    </div>
                                    <?php if ($this->_var['two_code']): ?>
                                    <div class="si-phone-code">
                                        <div class="qrcode-wrap">
                                            <div class="qrcode_tit"><?php echo $this->_var['lang']['summary_phone']; ?><i class="iconfont icon-qr-code"></i></div>
                                            <div class="qrcode_pop">
                                                <div class="mobile-qrcode"><img src="<?php echo $this->_var['weixin_img_url']; ?>" alt="<?php echo $this->_var['lang']['two_code']; ?>" title="<?php echo $this->_var['weixin_img_text']; ?>" width="175"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <?php if ($this->_var['goods_coupons']): ?>
                                    <div class="summary-item si-coupon">
                                        <div class="si-tit"><?php echo $this->_var['lang']['Collar_ticket_alt']; ?></div>
                                        <div class="si-warp">
                                            <?php $_from = $this->_var['goods_coupons']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'vo');if (count($_from)):
    foreach ($_from AS $this->_var['vo']):
?>
                                            <a class="J-open-tb" href="#none" data-goodsid="<?php echo $this->_var['goods_id']; ?>">
                                                <div class="quan-item"><i class="i-left"></i><?php echo $this->_var['lang']['man']; ?><?php echo $this->_var['vo']['cou_man']; ?><?php echo $this->_var['lang']['minus']; ?><?php echo $this->_var['vo']['cou_money']; ?><i class="i-right"></i></div>
                                            </a>
                                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                        </div>
                                    </div>
                                    <?php endif; ?>

                                    <?php if ($this->_var['promotion'] || $this->_var['goods']['consumption']): ?>
                                    <div class="summary-item si-promotion"<?php if ($this->_var['promo_count'] > 2): ?> ectype="view-prom"<?php endif; ?><?php if ($this->_var['promo_count'] < 2): ?> style="height:24px;"<?php endif; ?>>
                                        <div class="si-tit"><?php echo $this->_var['lang']['promotion_alt']; ?></div>
                                        <div class="si-warp">
                                            <div class="prom-items">
                                                <?php $_from = $this->_var['promotion']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');$this->_foreach['nopromotion'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['nopromotion']['total'] > 0):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
        $this->_foreach['nopromotion']['iteration']++;
?>
                                                <?php if ($this->_var['item']['type'] == "favourable"): ?>
                                                <div class="prom-item">
                                                    <?php if ($this->_var['item']['act_type'] == 0): ?>
                                                    <em class="prom-tip"><?php echo $this->_var['lang']['With_a_gift']; ?></em>
                                                    <?php elseif ($this->_var['item']['act_type'] == 1): ?>
                                                    <em class="prom-tip"><?php echo $this->_var['lang']['Stand_minus']; ?></em>
                                                    <?php elseif ($this->_var['item']['act_type'] == 2): ?>
                                                    <em class="prom-tip"><?php echo $this->_var['lang']['discount']; ?></em>
                                                    <?php endif; ?>
                                                    <?php echo $this->_var['item']['act_name']; ?>
                                                </div>
                                                <?php elseif ($this->_var['item']['type'] == "group_buy"): ?>
                                                <div class="prom-item">
                                                    <a href="<?php echo $this->_var['item']['url']; ?>" title="<?php echo $this->_var['lang']['group_buy']; ?>" class="prom-tip" title="<?php echo $this->_var['lang']['group_buy']; ?>"><?php echo $this->_var['lang']['group_buy']; ?></a>
                                                </div>
                                                <?php elseif ($this->_var['item']['type'] == "auction"): ?>
                                                <div class="prom-item">
                                                    <a href="auction.php" title="<?php echo $this->_var['lang']['auction']; ?>" class="prom-tip" title="<?php echo $this->_var['lang']['auction']; ?>"><?php echo $this->_var['lang']['auction']; ?></a>
                                                </div>
                                                <?php elseif ($this->_var['item']['type'] == "snatch"): ?>
                                                <div class="prom-item">
                                                    <a href="<?php echo $this->_var['item']['url']; ?>" title="<?php echo $this->_var['lang']['snatch']; ?>" class="prom-tip" title="<?php echo $this->_var['lang']['snatch']; ?>"><?php echo $this->_var['lang']['snatch']; ?></a>
                                                </div>
                                                <?php endif; ?>
                                                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                                <?php if ($this->_var['goods']['consumption']): ?>
                                                <div class="prom-item">
                                                    <a href="javascript:;" class="prom-tip" title="<?php echo $this->_var['lang']['Full_reduction']; ?>"><?php echo $this->_var['lang']['Full_reduction']; ?></a>
                                                    <em class="h1_red" title="<?php $_from = $this->_var['goods']['consumption']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'con');$this->_foreach['nocon'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['nocon']['total'] > 0):
    foreach ($_from AS $this->_var['con']):
        $this->_foreach['nocon']['iteration']++;
?><?php echo $this->_var['lang']['man']; ?><?php echo $this->_var['con']['cfull']; ?><?php echo $this->_var['lang']['minus']; ?><?php echo $this->_var['con']['creduce']; ?><?php if (! ($this->_foreach['nocon']['iteration'] == $this->_foreach['nocon']['total'])): ?>，<?php endif; ?><?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>"><?php $_from = $this->_var['goods']['consumption']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'con');$this->_foreach['nocon'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['nocon']['total'] > 0):
    foreach ($_from AS $this->_var['con']):
        $this->_foreach['nocon']['iteration']++;
?><?php echo $this->_var['lang']['man']; ?><?php echo $this->_var['con']['cfull']; ?><?php echo $this->_var['lang']['minus']; ?><?php echo $this->_var['con']['creduce']; ?><?php if (! ($this->_foreach['nocon']['iteration'] == $this->_foreach['nocon']['total'])): ?>，<?php endif; ?><?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?></em>
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                            <?php if ($this->_var['promo_count'] > 2): ?>
                                            <div class="view-all-promotions">
                                                <span class="prom-sum"><?php echo $this->_var['lang']['total']; ?><em class="prom-number"><?php echo $this->_var['promo_count']; ?></em><?php echo $this->_var['lang']['Item_promotion']; ?></span>
                                                <i class="iconfont icon-down"></i>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <div class="clear"></div>
                                </div>
                            </div>
                            <div class="summary-basic-info">
                                <?php if ($this->_var['volume_price_list']): ?>
                                <div class="summary-item is-ladder">
                                    <div class="si-tit"><?php echo $this->_var['lang']['Preferential_steps']; ?></div>
                                    <div class="si-warp">
                                        <a href="javascript:void(0);" class="link-red" ectype="view_priceLadder"><?php echo $this->_var['lang']['View_price_ladder']; ?></a>
                                        <dl class="priceLadder" ectype="priceLadder">
                                            <dt>
                                                <span><?php echo $this->_var['lang']['number_to']; ?></span>
                                                <span><?php echo $this->_var['lang']['preferences_price']; ?></span>
                                            </dt>
                                            <?php $_from = $this->_var['volume_price_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('price_key', 'price_list');if (count($_from)):
    foreach ($_from AS $this->_var['price_key'] => $this->_var['price_list']):
?>
                                            <dd>
                                                <span><?php echo $this->_var['price_list']['number']; ?></span>
                                                <span><?php echo $this->_var['price_list']['format_price']; ?></span>
                                            </dd>
                                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                        </dl>
                                    </div>
                                </div>
                                <?php endif; ?>

                                <?php if ($this->_var['rank_prices'] && $this->_var['cfg']['show_rank_price'] && ! $this->_var['goods']['gmt_end_time']): ?>
                                <div class="summary-item is-ladder">
                                    <div class="si-tit"><?php echo $this->_var['lang']['rank_prices']; ?></div>
                                    <div class="si-warp">
                                        <a href="javascript:void(0);" class="link-red" ectype="view_priceLadder"><?php echo $this->_var['lang']['View_price_ladder']; ?></a>
                                        <dl class="priceLadder goods_rank_prices" ectype="priceLadder">
                                            <dt>
                                                <span><?php echo $this->_var['lang']['rank']; ?></span>
                                                <span><?php echo $this->_var['lang']['prices']; ?></span>
                                            </dt>
                                            <?php $_from = $this->_var['rank_prices']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('price_key', 'rank');if (count($_from)):
    foreach ($_from AS $this->_var['price_key'] => $this->_var['rank']):
?>
                                            <dd>
                                                <span><?php echo $this->_var['rank']['rank_name']; ?></span>
                                                <span><?php echo $this->_var['rank']['price']; ?></span>
                                            </dd>
                                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                        </dl>
                                    </div>
                                </div>
                                <?php endif; ?>

                                <div class="summary-item is-stock">
                                    <div class="si-tit"><?php echo $this->_var['lang']['distribution']; ?></div>
                                    <div class="si-warp">
                                        <span class="initial-area">
                                            <?php if ($this->_var['adress']['city']): ?>
                                                <?php echo $this->_var['adress']['city']; ?>
                                            <?php else: ?>
                                                <?php echo $this->_var['basic_info']['city']; ?>
                                            <?php endif; ?>
                                        </span>
                                        <span>至</span>
                                        <div class="store-selector">
                                            <div class="text-select" id="area_address" ectype="areaSelect"></div>
                                        </div>
                                        <div class="store-warehouse">
                                            <div class="store-warehouse-info"></div>
                                            <div id="isHas_warehouse_num" class="store-prompt"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="summary-item is-service">
                                    <div class="si-tit"><?php echo $this->_var['lang']['service']; ?></div>
                                    <div class="si-warp">
                                        <div class="fl">
                                        <?php if ($this->_var['goods']['user_id'] > 0): ?>
                                            <?php echo $this->_var['lang']['you']; ?> <a href="<?php echo $this->_var['goods']['store_url']; ?>" class="link-red" target="_blank"><?php echo $this->_var['goods']['rz_shopName']; ?></a> <?php echo $this->_var['lang']['After_sale_service']; ?>
                                        <?php else: ?>
                                            <?php echo $this->_var['lang']['you']; ?> <a href="javascript:void(0)" class="link-red"><?php echo $this->_var['goods']['rz_shopName']; ?></a> <?php echo $this->_var['lang']['After_sale_service']; ?>
                                        <?php endif; ?>
                                        </div>
                                        <div class="fl pl10" id="user_area_shipping"></div>
                                    </div>
                                </div>
                                <?php if ($this->_var['cfg']['show_brand'] && $this->_var['goods']['user_id'] && $this->_var['goods']['goods_brand']): ?>
                                <div class="summary-item is-brand">
                                    <div class="si-tit"><?php echo $this->_var['lang']['brand']; ?></div>
                                    <div class="si-warp"><a href="<?php echo $this->_var['goods']['goods_brand_url']; ?>" target="_blank"><?php echo $this->_var['goods']['goods_brand']; ?></a></div>
                                </div>
                                <?php endif; ?>
                                <?php if ($this->_var['cfg']['use_integral']): ?>
                                <div class="summary-item is-integral">
                                    <div class="si-tit"><?php echo $this->_var['lang']['keyong_integral']; ?></div>
                                    <div class="si-warp"><?php echo $this->_var['lang']['keyong']; ?> <span class="integral"><?php echo $this->_var['goods']['integral']; ?></span></div>
                                </div>
                                <?php endif; ?>
                                <?php if ($this->_var['goods']['give_integral'] && $this->_var['cfg']['show_give_integral']): ?>
                                <div class="summary-item is-integral">
                                    <div class="si-tit"><?php echo $this->_var['lang']['is_integral']; ?></div>
                                    <div class="si-warp"><span class="integral"><?php echo $this->_var['goods']['give_integral']; ?></span></div>
                                </div>
                                <?php endif; ?>
                                <?php if ($this->_var['goods']['goods_extends']['is_reality'] || $this->_var['goods']['goods_extends']['is_return'] || $this->_var['goods']['goods_extends']['is_fast']): ?>
                                <div class="summary-item">
                                    <div class="si-tit"><?php echo $this->_var['lang']['promise']; ?></div>
                                    <div class="si-warp">
                                        <ul class="tips-list">
                                            <?php if ($this->_var['goods']['goods_extends']['is_reality']): ?><li class="choose-item choose-zp"><i class="iconfont icon-zheng"></i><?php echo $this->_var['lang']['is_reality']; ?></li><?php endif; ?>
                                            <?php if ($this->_var['goods']['goods_extends']['is_return']): ?><li class="choose-item choose-bt"><i class="iconfont icon-money"></i><?php echo $this->_var['lang']['is_return']; ?></li><?php endif; ?>
                                            <?php if ($this->_var['goods']['goods_extends']['is_fast']): ?><li class="choose-item choose-ss"><i class="iconfont icon-light"></i><?php echo $this->_var['lang']['is_fast']; ?></li><?php endif; ?>
                                        </ul>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if ($this->_var['goods']['is_xiangou'] == 1 && $this->_var['xiangou'] == 1): ?>
                                <div class="summary-item is-xiangou">
                                    <div class="si-tit"><?php echo $this->_var['lang']['limit_shop']; ?></div>
                                    <div class="si-warp">
                                        <em id="restrict_amount" ectype="restrictNumber" data-value="<?php echo $this->_var['goods']['xiangou_num']; ?>"><?php echo $this->_var['goods']['xiangou_num']; ?></em>
                                        <span><?php if ($this->_var['goods']['goods_unit']): ?><?php echo $this->_var['goods']['goods_unit']; ?><?php elseif ($this->_var['goods']['measure_unit']): ?><?php echo $this->_var['goods']['measure_unit']; ?><?php endif; ?></span>
                                        <span>（<?php echo $this->_var['lang']['Already_buy']; ?>：<em id="orderG_number" ectype="orderGNumber" data-value="<?php echo empty($this->_var['orderG_number']) ? '0' : $this->_var['orderG_number']; ?>"><?php echo empty($this->_var['orderG_number']) ? '0' : $this->_var['orderG_number']; ?></em><?php if ($this->_var['goods']['goods_unit']): ?><?php echo $this->_var['goods']['goods_unit']; ?><?php elseif ($this->_var['goods']['measure_unit']): ?><?php echo $this->_var['goods']['measure_unit']; ?><?php endif; ?>）</span>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if ($this->_var['area_position_list'] && $this->_var['goods']['store_count'] > 0): ?>
                                <div class="summary-item is-since" ectype="list-store-pick">
                                    <div class="si-tit"><?php echo $this->_var['lang']['self_lifting']; ?></div>
                                    <div class="si-warp">
                                        <a href="javascript:void(0);" ectype="seller_store" class="link-red"><i class="iconfont icon-store-alt"></i><?php echo $this->_var['lang']['select_store_info']; ?></a>
                                        <span class="ml10"><?php echo $this->_var['lang']['select_store_info_notic']; ?></span>
                                    </div>
                                </div>
                                <?php endif; ?>
                                
                                <?php if ($this->_var['specification']): ?>
                                <?php $_from = $this->_var['specification']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('spec_key', 'spec');if (count($_from)):
    foreach ($_from AS $this->_var['spec_key'] => $this->_var['spec']):
?>
                                <?php if ($this->_var['spec']['values']): ?>
                                <div class="summary-item is-attr goods_info_attr" ectype="is-attr" data-type="<?php if ($this->_var['spec']['attr_type'] == 1): ?>radio<?php else: ?>checkbox<?php endif; ?>">
                                    <div class="si-tit"><?php echo $this->_var['spec']['name']; ?></div>
                                    <?php if ($this->_var['cfg']['goodsattr_style'] == 1): ?>
                                    <div class="si-warp">
                                        <ul>
                                            <?php $_from = $this->_var['spec']['values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'value');$this->_foreach['attrvalues'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['attrvalues']['total'] > 0):
    foreach ($_from AS $this->_var['key'] => $this->_var['value']):
        $this->_foreach['attrvalues']['iteration']++;
?>
                                            <?php if ($this->_var['spec']['is_checked'] > 0): ?>
                                            <li class="item<?php if ($this->_var['value']['checked'] == 1): ?> selected<?php endif; ?>" data-name="<?php echo $this->_var['value']['id']; ?>">
                                                <b></b>
                                                <a href="<?php if ($this->_var['value']['img_site']): ?><?php echo $this->_var['value']['img_site']; ?><?php else: ?>javascript:void(0);<?php endif; ?>">
                                                    <?php if ($this->_var['value']['img_flie']): ?>
                                                    <img src="<?php echo $this->_var['value']['img_flie']; ?>" width="24" height="24" />
                                                    <?php endif; ?>
                                                    <i><?php echo $this->_var['value']['label']; ?></i>
                                                    <input id="spec_value_<?php echo $this->_var['value']['id']; ?>" type="<?php if ($this->_var['spec']['attr_type'] == 2): ?>checkbox<?php else: ?>radio<?php endif; ?>" data-attrtype="<?php if ($this->_var['spec']['attr_type'] == 2): ?>2<?php else: ?>1<?php endif; ?>" name="spec_<?php echo $this->_var['spec_key']; ?>" value="<?php echo $this->_var['value']['id']; ?>" autocomplete="off" class="hide" />
                                                    <?php if ($this->_var['value']['checked'] == 1): ?>
                                                    <script type="text/javascript">
                                                        $(function(){
															$("#spec_value_<?php echo $this->_var['value']['id']; ?>").prop("checked", true);
                                                        });
                                                    </script>
                                                    <?php endif; ?>
                                                </a>
                                            </li>
                                            <?php else: ?>
                                            <li class="item <?php if ($this->_var['key'] == 0): ?> selected<?php endif; ?>" data-name="<?php echo $this->_var['value']['id']; ?>">
                                                <b></b>
                                                <a href="javascript:void(0);" name="<?php echo $this->_var['value']['id']; ?>" class="noimg">
                                                    <i><?php echo $this->_var['value']['label']; ?></i>
                                                    <input id="spec_value_<?php echo $this->_var['value']['id']; ?>" type="<?php if ($this->_var['spec']['attr_type'] == 2): ?>checkbox<?php else: ?>radio<?php endif; ?>" data-attrtype="<?php if ($this->_var['spec']['attr_type'] == 2): ?>2<?php else: ?>1<?php endif; ?>" name="spec_<?php echo $this->_var['spec_key']; ?>" value="<?php echo $this->_var['value']['id']; ?>" autocomplete="off" class="hide" /></a>
                                                    <?php if ($this->_var['key'] == 0): ?>
                                                    <script type="text/javascript">
                                                        $(function(){
                                                            $("#spec_value_<?php echo $this->_var['value']['id']; ?>").prop("checked", true);
                                                        });
                                                    </script>
                                                    <?php endif; ?>
                                                </a>
                                            </li>
                                            <?php endif; ?>
                                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                        </ul>
                                    </div>
                                    <?php else: ?>
                                    ...
                                    <?php endif; ?>
                                    <input type="hidden" name="spec_list" value="<?php echo $this->_var['spec_key']; ?>" data-spectype="<?php if ($this->_var['spec']['attr_type'] == 1): ?>attr-radio<?php else: ?>attr-check<?php endif; ?>" />
                                </div>
                                <?php endif; ?>
                                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                <?php endif; ?>

                                <?php if ($this->_var['stages']): ?>
                                <div class="summary-item is-ious" ectype="is-ious">
                                    <div class="si-tit"><?php echo $this->_var['lang']['biaotiao']; ?></div>
                                    <div class="si-warp">
                                        <?php $_from = $this->_var['stages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('k', 'vo');if (count($_from)):
    foreach ($_from AS $this->_var['k'] => $this->_var['vo']):
?>
                                        <?php if ($this->_var['k'] == 1): ?>
                                        <div class="item" data-value="<?php echo $this->_var['k']; ?>">
                                            <b></b>
                                            <a href="javascript:void(0);"><i><?php echo $this->_var['lang']['noFree_30']; ?></i></a>
                                            <div class="baitiao-tips">
                                                <span><?php echo $this->_var['lang']['nofree']; ?></span>
                                            </div>
                                        </div>
                                        <?php else: ?>
                                        <div class="item" data-value="<?php echo $this->_var['k']; ?>">
                                            <b></b>
                                            <a href="javascript:void(0);"><i>￥<?php echo $this->_var['vo']['stages_one_price']; ?>×<?php echo $this->_var['k']; ?><?php echo $this->_var['lang']['qi']; ?></i></a>
                                            <div class="baitiao-tips">
                                                <span><?php echo $this->_var['lang']['free_desc']; ?><?php echo $this->_var['goods']['stages_rate']; ?>%，￥<?php echo $this->_var['vo']['stages_one_price']; ?>×<?php echo $this->_var['k']; ?><?php echo $this->_var['lang']['qi']; ?></span>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                        <div class="bt-info-tips">
                                            <a href="javascript:void(0);"><i class="question"></i></a>
                                            <div class="tips">
                                                <div class="sprite-arrow"></div>
                                                <div class="content">
                                                    <p><?php echo $this->_var['lang']['bt_stages_one']; ?></p>
                                                    <p><?php echo $this->_var['lang']['bt_stages_two']; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="stages_qishu" value=""/>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <div class="summary-item is-number">
                                    <div class="si-tit"><?php echo $this->_var['lang']['number_to']; ?></div>
                                    <div class="si-warp">
                                        <div class="amount-warp">
                                            <input class="text buy-num" ectype="quantity" value="1" name="number" defaultnumber="1">
                                            <div class="a-btn">
                                                <a href="javascript:void(0);" class="btn-add" ectype="btnAdd"><i class="iconfont icon-up"></i></a>
                                                <a href="javascript:void(0);" class="btn-reduce btn-disabled" ectype="btnReduce"><i class="iconfont icon-down"></i></a>
                                                <input type="hidden" name="perNumber" id="perNumber" ectype="perNumber" value="0">
                                                <input type="hidden" name="perMinNumber" id="perMinNumber" ectype="perMinNumber" value="1">
                                            </div>
                                            <input name="confirm_type" id="confirm_type" type="hidden" value="3" />
                                        </div>
                                        <?php if ($this->_var['cfg']['show_goodsnumber']): ?>
                                        <span><?php echo $this->_var['lang']['goods_inventory']; ?>&nbsp;<em id="goods_attr_num" ectype="goods_attr_num"></em>&nbsp;<?php if ($this->_var['goods']['goods_unit']): ?><?php echo $this->_var['goods']['goods_unit']; ?><?php else: ?><?php echo $this->_var['goods']['measure_unit']; ?><?php endif; ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="choose-btns<?php if (! $this->_var['area_position_list'] || $this->_var['goods']['store_count'] <= 0 || ! $this->_var['stages'] || $this->_var['goods']['is_on_sale'] == 0): ?> ml60<?php endif; ?> clearfix">
                                <?php if ($this->_var['shop_close'] == 0 && $this->_var['goods']['user_id'] != 0): ?>
                                	<a class="btn-invalid" href="javascript:void(0);"><?php echo $this->_var['lang']['shop_close']; ?></a>
                                <?php else: ?>
                                    <?php if ($this->_var['goods']['is_alone_sale'] == 0): ?>
                                    <a href="category.php?id=347" class="btn-buynow"><?php echo $this->_var['lang']['is_alone_sale']; ?></a>
                                    <?php else: ?>
                                        <?php if ($this->_var['goods']['review_status'] <= 2 || $this->_var['goods']['is_on_sale'] == 0): ?>
                                            <a id="sold_out" class="btn-invalid" href="javascript:void(0);"><?php echo $this->_var['lang']['is_on_sale']; ?></a>
                                        <?php else: ?>
                                            <?php if ($this->_var['goods_area'] == 1): ?>
                                                <a href="<?php if ($this->_var['user_id'] <= 0 && $this->_var['one_step_buy']): ?>#none<?php else: ?>javascript:bool=0;addToCart(<?php echo $this->_var['goods']['goods_id']; ?>)<?php endif; ?>" data-type="<?php echo $this->_var['one_step_buy']; ?>" class="btn-buynow" ectype="btn-buynow"><?php echo $this->_var['lang']['button_buy']; ?></a>
                                                <?php if (! $this->_var['one_step_buy']): ?>
                                                    <a href="javascript:bool=0;addToCartShowDiv(<?php echo $this->_var['goods']['goods_id']; ?>)" class="btn-append" ectype="btn-append"><i class="iconfont icon-carts"></i><?php echo $this->_var['lang']['btn_add_to_cart']; ?></a>
                                                <?php endif; ?>
                                                
                                                <?php if ($this->_var['stages']): ?>
                                                    <a href="javascript:void(0);" class="btn-baitiao" ectype="byStages"><?php echo $this->_var['lang']['Installment_purchase']; ?></a>
                                                <?php endif; ?>
                                                
                                            <?php else: ?>
                                            <a id="no_addToCart" class="btn-invalid btn_disabled" href="javascript:void(0);"><?php echo $this->_var['lang']['temporarily_stock']; ?></a>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <?php if ($this->_var['area_position_list'] && $this->_var['goods']['store_count'] > 0): ?>
                                <a href="javascript:void(0);" class="btn-since" ectype="btn-store-pick"><?php echo $this->_var['lang']['btn_store_pick']; ?></a>
                                <?php endif; ?>
                            </div>
                            <?php if ($this->_var['goods']['goods_tag']): ?>
                            <div class="summary-basic-info">
                                <div class="summary-item is-service">
                                    <div class="si-tit"><?php echo $this->_var['lang']['service_promise']; ?></div>
                                    <div class="si-warp">
                                        <?php $_from = $this->_var['goods']['goods_tag']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'tag');if (count($_from)):
    foreach ($_from AS $this->_var['tag']):
?>
                                        <span class="tary"><?php echo $this->_var['tag']; ?></span>
                                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php if (! $this->_var['goods']['goods_extends']['is_return'] || $this->_var['goods']['is_alone_sale'] == 0): ?>
                            <div class="summary-basic-info">
                                <div class="summary-item is-service">
                                    <div class="si-tit"><?php echo $this->_var['lang']['reminder']; ?></div>
                                    <div class="si-warp gray">
                                        <?php if ($this->_var['goods']['is_alone_sale'] == 0): ?>
                                        <p><?php echo $this->_var['lang']['is_alone_sale_notic']; ?></p>
                                        <?php endif; ?>
                                        <?php if (! $this->_var['goods']['goods_extends']['is_return']): ?>
                                        <p><?php echo $this->_var['lang']['is_return_notic']; ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                    	</div>
                        <input type="hidden" value="<?php echo $this->_var['goods']['goods_id']; ?>" name="goods_id" />
                        <input type="hidden" value="<?php echo $this->_var['goods_id']; ?>" id="good_id" name="good_id" />
                        <input type="hidden" value="<?php echo $_SESSION['user_id']; ?>" id="user_id" name="user_id"/>
                        <input type="hidden" value="<?php echo empty($this->_var['area']['street_list']) ? '0' : $this->_var['area']['street_list']; ?>" name="street_list" />
                        <input type="hidden" value="<?php echo $this->_var['xiangou']; ?>" name="restrictShop" ectype="restrictShop" />
                        <input type="hidden" value="<?php echo $this->_var['cfg']['add_shop_price']; ?>" name="add_shop_price" ectype="add_shop_price" />
                    </form>
                </div>
                <?php if (! $this->_var['goods']['user_id']): ?>
                <div class="track" id="see_more_goods">

                </div>
                <?php else: ?>
                <div class="seller-pop">
                    <div class="seller-logo">
                    	<?php if ($this->_var['goods']['shopinfo']['brand_thumb']): ?>
                            <a href="<?php echo $this->_var['goods']['store_url']; ?>" target="_blank"><img src="<?php echo $this->_var['goods']['shopinfo']['brand_thumb']; ?>" /></a>
                        <?php else: ?>
                            <a href="<?php echo $this->_var['goods']['goods_brand_url']; ?>" target="_blank"><?php echo $this->_var['goods']['goods_brand']; ?></a>
                        <?php endif; ?>
                    </div>
                    <div class="seller-info">
                    	<a href="<?php echo $this->_var['goods']['store_url']; ?>" title="<?php echo $this->_var['goods']['rz_shopName']; ?>" target="_blank" class="name"><?php echo $this->_var['goods']['rz_shopName']; ?></a>
                        <?php if ($this->_var['shop_information']['is_IM'] == 1 || $this->_var['shop_information']['is_dsc']): ?>
                            <a id="IM" href="javascript:;" onclick="openWin(this)" ru_id="<?php echo $this->_var['goods']['user_id']; ?>" goods_id="<?php echo $this->_var['goods']['goods_id']; ?>"><i class="icon i-kefu"></i></a>
                        <?php else: ?>
                            <?php if ($this->_var['basic_info']['kf_type'] == 1): ?>
                                <a href="http://www.taobao.com/webww/ww.php?ver=3&touid=<?php echo $this->_var['basic_info']['kf_ww']; ?>&siteid=cntaobao&status=1&charset=utf-8" target="_blank"><i class="icon i-kefu"></i></a>
                            <?php else: ?>
                                <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $this->_var['basic_info']['kf_qq']; ?>&site=qq&menu=yes" target="_blank"><i class="icon i-kefu"></i></a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <?php if ($this->_var['goods']['shopinfo']['self_run']): ?>
                    <div class="seller-sr"><?php echo $this->_var['lang']['platform_self']; ?></div>
                    <?php endif; ?>
                    <div class="seller-pop-box">
                    	<div class="s-score">
                            <span class="score-icon"><span class="score-icon-bg" style="width:<?php echo $this->_var['merch_cmt']['cmt']['all_zconments']['allReview']; ?>%;"></span></span>
                            <span><?php echo $this->_var['merch_cmt']['cmt']['all_zconments']['score']; ?></span>
                            <i class="iconfont icon-down"></i>
                        </div>
                        <div class="g-s-parts">
                            <div class="parts-item parts-goods">
                                <span class="col1"><?php echo $this->_var['lang']['evaluation_single']; ?></span>
                                <span class="col2 <?php if ($this->_var['merch_cmt']['cmt']['commentRank']['zconments']['is_status'] == 1): ?>ftx-01<?php elseif ($this->_var['merch_cmt']['cmt']['commentRank']['zconments']['is_status'] == 2): ?>average<?php else: ?>ftx-02<?php endif; ?>"><?php echo $this->_var['merch_cmt']['cmt']['commentRank']['zconments']['score']; ?><i class="iconfont icon-arrow-<?php if ($this->_var['merch_cmt']['cmt']['commentRank']['zconments']['is_status'] == 1): ?>up<?php elseif ($this->_var['merch_cmt']['cmt']['commentRank']['zconments']['is_status'] == 2): ?>average<?php else: ?>down<?php endif; ?>"></i></span>
                            </div>
                            <div class="parts-item parts-goods">
                                <span class="col1"><?php echo $this->_var['lang']['service_attitude']; ?></span>
                                <span class="col2 <?php if ($this->_var['merch_cmt']['cmt']['commentServer']['zconments']['is_status'] == 1): ?>ftx-01<?php elseif ($this->_var['merch_cmt']['cmt']['commentServer']['zconments']['is_status'] == 2): ?>average<?php else: ?>ftx-02<?php endif; ?>"><?php echo $this->_var['merch_cmt']['cmt']['commentServer']['zconments']['score']; ?><i class="iconfont icon-arrow-<?php if ($this->_var['merch_cmt']['cmt']['commentServer']['zconments']['is_status'] == 1): ?>up<?php elseif ($this->_var['merch_cmt']['cmt']['commentServer']['zconments']['is_status'] == 2): ?>average<?php else: ?>down<?php endif; ?>"></i></span>
                            </div>
                            <div class="parts-item parts-goods">
                                <span class="col1"><?php echo $this->_var['lang']['delivery_speed']; ?></span>
                                <span class="col2 <?php if ($this->_var['merch_cmt']['cmt']['commentDelivery']['zconments']['is_status'] == 1): ?>ftx-01<?php elseif ($this->_var['merch_cmt']['cmt']['commentDelivery']['zconments']['is_status'] == 2): ?>average<?php else: ?>ftx-02<?php endif; ?>"><?php echo $this->_var['merch_cmt']['cmt']['commentDelivery']['zconments']['score']; ?><i class="iconfont icon-arrow-<?php if ($this->_var['merch_cmt']['cmt']['commentDelivery']['zconments']['is_status'] == 1): ?>up<?php elseif ($this->_var['merch_cmt']['cmt']['commentDelivery']['zconments']['is_status'] == 2): ?>average<?php else: ?>down<?php endif; ?>"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="seller-item">
                    	<a href="javascript:void(0);" ectype="collect_store" data-type='goods' data-value='{"userid":<?php echo $this->_var['user_id']; ?>,"storeid":<?php echo $this->_var['goods']['user_id']; ?>}' class="gz-store" data-url="<?php echo $this->_var['goods']['goods_url']; ?>"></a>
                        <a href="<?php echo $this->_var['goods']['store_url']; ?>" class="store-home"><i class="iconfont icon-home-store"></i><?php echo $this->_var['lang']['seller_store']; ?></a>
                        <input type="hidden" name="error" value="<?php echo $this->_var['goods']['error']; ?>" id="error"/>
                    </div>
                    <div class="seller-tel"><i class="iconfont icon-tel"></i><?php if ($this->_var['shop_information']['kf_tel']): ?><?php echo $this->_var['shop_information']['kf_tel']; ?><?php else: ?><?php echo $this->_var['lang']['kf_tel_zanwu']; ?><?php endif; ?></div>
                </div>
                <?php endif; ?>
                <div class="clear"></div>
            </div>
            <?php echo $this->fetch('library/goods_fittings.lbi'); ?>
            <div class="goods-main-layout">
            	<div class="g-m-left">
                    <?php echo $this->fetch('library/goods_merchants.lbi'); ?>
                    <?php if ($this->_var['basic_info']['kf_type'] == 1): ?>
                        <?php if ($this->_var['basic_info']['kf_ww_all']): ?>
                        <div class="g-main service_list">
                            <div class="mt"><h3><?php echo $this->_var['lang']['store_Customer_service']; ?></h3></div>
                            <div class="mc">
                                <ul>
                                    <?php $_from = $this->_var['basic_info']['kf_ww_all']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'kf_ww');if (count($_from)):
    foreach ($_from AS $this->_var['kf_ww']):
?>
                                    <li><a href="http://www.taobao.com/webww/ww.php?ver=3&touid=<?php echo $this->_var['kf_ww']['1']; ?>&siteid=cntaobao&status=1&charset=utf-8" target="_blank"><i class="icon_service_ww"></i><span><?php echo $this->_var['kf_ww']['0']; ?></span></a></li>
                                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                </ul>
                            </div>
                        </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <?php if ($this->_var['basic_info']['kf_qq_all']): ?>
                        <div class="g-main service_list">
                            <div class="mt"><h3><?php echo $this->_var['lang']['store_Customer_service']; ?></h3></div>
                            <div class="mc">
                                <ul>
                                    <?php $_from = $this->_var['basic_info']['kf_qq_all']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'kf_qq');if (count($_from)):
    foreach ($_from AS $this->_var['kf_qq']):
?>
                                        <li class="service_qq"><a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $this->_var['kf_qq']['1']; ?>&site=qq&menu=yes" target="_blank"><i class="icon i-kefu"></i><span><?php echo $this->_var['kf_qq']['0']; ?></span></a></li>
                                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                </ul>
                            </div>
                        </div>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php if ($this->_var['goods_store_cat']): ?>
                    <div class="g-main g-store-cate">
                    	<div class="mt">
                            <h3><?php echo $this->_var['lang']['Store_cat']; ?></h3>
                        </div>
                        <div class="mc">
                            <div class="g-s-cate-warp">
                                <?php $_from = $this->_var['goods_store_cat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'cat');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['cat']):
?>
                            	<dl<?php if ($this->_var['cat']['cat_id']): ?> ectype="cateOpen"<?php else: ?> class="hover"<?php endif; ?>>
                                    <dt><i class="icon"></i><a href="<?php echo $this->_var['cat']['url']; ?>" target="_blank"><?php echo $this->_var['cat']['name']; ?></a></dt>
                                    <?php if ($this->_var['cat']['cat_id']): ?>
                                    <dd>
                                        <?php $_from = $this->_var['cat']['cat_id']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'cat');$this->_foreach['nocat'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['nocat']['total'] > 0):
    foreach ($_from AS $this->_var['key'] => $this->_var['cat']):
        $this->_foreach['nocat']['iteration']++;
?>
                                    	<a href="<?php echo $this->_var['cat']['url']; ?>" class="a-item" target="_blank">&gt; <?php echo $this->_var['cat']['name']; ?></a>
                                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                    </dd>
                                    <?php endif; ?>
                                </dl>
                                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if ($this->_var['goods_related_cat']): ?>
                    <div class="g-main">
                    	<div class="mt">
                            <h3><?php echo $this->_var['lang']['Relevant_cat']; ?></h3>
                        </div>
                        <div class="mc">
                            <div class="mc-warp">
                            	<div class="items">
                                    <?php $_from = $this->_var['goods_related_cat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cat');$this->_foreach['cat'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['cat']['total'] > 0):
    foreach ($_from AS $this->_var['cat']):
        $this->_foreach['cat']['iteration']++;
?>
                                    <?php if ($this->_foreach['cat']['iteration'] < 11): ?>
                                    <div class="item"><a href="<?php echo $this->_var['cat']['url']; ?>" target="_blank"><?php echo $this->_var['cat']['cat_name']; ?></a></div>
                                    <?php endif; ?>
                                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if ($this->_var['goods_brand']): ?>
                    <div class="g-main">
                    	<div class="mt">
                            <h3><?php echo $this->_var['lang']['Other_brands']; ?></h3>
                        </div>
                        <div class="mc">
                            <div class="mc-warp">
                            	<div class="items">
                                    <?php $_from = $this->_var['goods_brand']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'brand');if (count($_from)):
    foreach ($_from AS $this->_var['brand']):
?>
                                    <div class="item"><a href="<?php echo $this->_var['brand']['url']; ?>" target="_blank"><?php echo $this->_var['brand']['brand_name']; ?></a></div>
                                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    
                    <?php echo $this->fetch('library/goods_article.lbi'); ?>
                    

                    <?php if ($this->_var['new_goods'] || $this->_var['best_goods'] || $this->_var['hot_goods']): ?>
                    <div class="g-main g-rank">
                        <div class="mc">
                            <ul class="mc-tab" ectype="rankMcTab">
                            	<?php if ($this->_var['new_goods']): ?><li class="curr">新品</li><?php endif; ?>
                                <?php if ($this->_var['best_goods']): ?><li>推荐</li><?php endif; ?>
                                <?php if ($this->_var['hot_goods']): ?><li>热销</li><?php endif; ?>
                            </ul>
                        	<div class="mc-content">
                                    
                                    <?php echo $this->fetch('library/recommend_new_goods.lbi'); ?>
                                    
                                    
                                    <?php echo $this->fetch('library/recommend_best_goods.lbi'); ?>
                                    
                                    
                                    <?php echo $this->fetch('library/recommend_hot_goods.lbi'); ?>
                                    
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    
                    <?php 
$k = array (
  'name' => 'history_goods',
  'goods_id' => '0',
  'warehouse_id' => $this->_var['region_id'],
  'area_id' => $this->_var['area_id'],
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?>

                    
                    <?php echo $this->fetch('library/goods_related.lbi'); ?>
                    
                </div>
                <div class="g-m-detail">
                	<div class="gm-tabbox" ectype="gm-tabs">
                    	<ul class="gm-tab">
                            <li class="curr" ectype="gm-tab-item"><?php echo $this->_var['lang']['description']; ?></li>
                            <?php if ($this->_var['properties']): ?><li ectype="gm-tab-item-spec"><?php echo $this->_var['lang']['specification']; ?></li><?php endif; ?>
                            <li ectype="gm-tab-item"><?php echo $this->_var['lang']['user_comment']; ?>（<em class="ReviewsCount"><?php echo $this->_var['comment_all']['allmen']; ?></em>）</li>
                            <li ectype="gm-tab-item"><?php echo $this->_var['lang']['discuss_user']; ?></li>
                        </ul>
                        <div class="extra">
                        	<div class="item">
								<?php if ($this->_var['two_code']): ?>
                                <div class="si-phone-code">
                                    <div class="qrcode-wrap">
                                        <div class="qrcode_tit"><?php echo $this->_var['lang']['summary_phone']; ?><i class="iconfont icon-qr-code"></i></div>
                                        <div class="qrcode_pop">
                                            <div class="mobile-qrcode"><img src="<?php echo $this->_var['weixin_img_url']; ?>" alt="<?php echo $this->_var['lang']['two_code']; ?>" title="<?php echo $this->_var['weixin_img_text']; ?>" width="175"></div>
                                        </div>
                                    </div>
                                </div>
								<?php endif; ?>
                            	<div class="inner">
                                	<a href="javascript:void(0)" class="btn sc-redBg-btn" id="btn-anchor" ectype="tb-tab-anchor"><?php echo $this->_var['lang']['btn_add_to_cart']; ?></a>
                                	<div class="tb-popsku">
                                    	<span class="arrow-top"></span>
                                        <div class="tb-popsku-content">
                                        	<div class="tb-list">
                                            	<div class="tb-label"><?php echo $this->_var['lang']['price']; ?>：</div>
                                                <div class="tb-value"><strong class="shop-price" ectype="SHOP_PRICE"></strong></div>
                                            </div>
                                            <?php $_from = $this->_var['specification']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('spec_key', 'spec');if (count($_from)):
    foreach ($_from AS $this->_var['spec_key'] => $this->_var['spec']):
?>
                                            <?php if ($this->_var['spec']['values']): ?>
                                            <div class="tb-list is-attr goods_info_attr" ectype="is-attr" data-type="<?php if ($this->_var['spec']['attr_type'] == 1): ?>radio<?php else: ?>checkbox<?php endif; ?>">
                                                <div class="tb-label"><?php echo $this->_var['spec']['name']; ?>：</div>
                                                <?php if ($this->_var['cfg']['goodsattr_style'] == 1): ?>
                                                <div class="tb-value">
                                                    <ul>
                                                    <?php $_from = $this->_var['spec']['values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'value');$this->_foreach['attrvalues'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['attrvalues']['total'] > 0):
    foreach ($_from AS $this->_var['key'] => $this->_var['value']):
        $this->_foreach['attrvalues']['iteration']++;
?>
                                                    <?php if ($this->_var['spec']['is_checked'] > 0): ?>
                                                    <li class="item<?php if ($this->_var['value']['checked'] == 1): ?> selected<?php endif; ?>" data-name="<?php echo $this->_var['value']['id']; ?>">
                                                        <b></b>
                                                        <a href="<?php if ($this->_var['value']['img_site']): ?><?php echo $this->_var['value']['img_site']; ?><?php else: ?>javascript:void(0);<?php endif; ?>"<?php if ($this->_var['value']['img_site']): ?> target="_blank"<?php endif; ?>>
                                                            <?php if ($this->_var['value']['img_flie']): ?>
                                                            <img src="<?php echo $this->_var['value']['img_flie']; ?>" width="24" height="24" />
                                                            <?php endif; ?>
                                                            <i><?php echo $this->_var['value']['label']; ?></i>
                                                            <input id="spec_value_<?php echo $this->_var['value']['id']; ?>" type="<?php if ($this->_var['spec']['attr_type'] == 2): ?>checkbox<?php else: ?>radio<?php endif; ?>" data-attrtype="<?php if ($this->_var['spec']['attr_type'] == 2): ?>2<?php else: ?>1<?php endif; ?>" name="spec_<?php echo $this->_var['spec_key']; ?>" value="<?php echo $this->_var['value']['id']; ?>" class="hide" autocomplete="off" />
                                                            <?php if ($this->_var['value']['checked'] == 1): ?>
                                                            <script type="text/javascript">
                                                                $(function(){
                                                                    $("#spec_value_<?php echo $this->_var['value']['id']; ?>").prop("checked", true);
                                                                });
                                                            </script>
                                                            <?php endif; ?>
                                                        </a>
                                                    </li>
                                                    <?php else: ?>
                                                    <li class="item <?php if ($this->_var['key'] == 0): ?> selected<?php endif; ?>" data-name="<?php echo $this->_var['value']['id']; ?>">
                                                        <b></b>
                                                        <a href="javascript:void(0);" name="<?php echo $this->_var['value']['id']; ?>" class="noimg">
                                                            <i><?php echo $this->_var['value']['label']; ?></i>
                                                            <input id="spec_value_<?php echo $this->_var['value']['id']; ?>" type="<?php if ($this->_var['spec']['attr_type'] == 2): ?>checkbox<?php else: ?>radio<?php endif; ?>" data-attrtype="<?php if ($this->_var['spec']['attr_type'] == 2): ?>2<?php else: ?>1<?php endif; ?>" name="spec_<?php echo $this->_var['spec_key']; ?>" value="<?php echo $this->_var['value']['id']; ?>" autocomplete="off" class="hide" /></a>
                                                            <?php if ($this->_var['key'] == 0): ?>
                                                            <script type="text/javascript">
                                                                $(function(){
                                                                    $("#spec_value_<?php echo $this->_var['value']['id']; ?>").prop("checked", true);
                                                                });
                                                            </script>
                                                            <?php endif; ?>
                                                        </a>
                                                    </li>
                                                    <?php endif; ?>
                                                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                                    </ul>
                                                </div>
                                                <?php else: ?>
                                                ...
                                                <?php endif; ?>
                                                <input type="hidden" name="spec_list" value="<?php echo $this->_var['spec_key']; ?>" data-spectype="<?php if ($this->_var['spec']['attr_type'] == 1): ?>attr-radio<?php else: ?>attr-check<?php endif; ?>" />
                                            </div>
                                            <?php endif; ?>
                                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                        	<div class="tb-list">
                                            	<div class="tb-label"><?php echo $this->_var['lang']['number_to']; ?>：</div>
												<div class="tb-value">
													<div class="amount-warp">
														<input class="text buy-num" ectype="quantity" value="1" name="number" defaultnumber="1">
														<div class="a-btn">
															<a href="javascript:void(0);" class="btn-add" ectype="btnAdd"><i class="iconfont icon-up"></i></a>
															<a href="javascript:void(0);" class="btn-reduce btn-disabled" ectype="btnReduce"><i class="iconfont icon-down"></i></a>
														</div>
														<input name="confirm_type" id="confirm_type" type="hidden" value="3" />
													</div>
													<span class="lh30 ml10"><?php echo $this->_var['lang']['goods_inventory']; ?>&nbsp;<em ectype="goods_attr_num"></em>&nbsp;<?php if ($this->_var['goods']['goods_unit']): ?><?php echo $this->_var['goods']['goods_unit']; ?><?php else: ?><?php echo $this->_var['goods']['measure_unit']; ?><?php endif; ?></span>
												</div>
											</div>
                                            <div class="tb-list">
                                            	<div class="tb-label">&nbsp;</div>
                                                <div class="tb-value">
													<a href="javascript:bool=0;addToCartShowDiv(<?php echo $this->_var['goods']['goods_id']; ?>)" class="cz-btn cz-btn-true" ectype="btn-append"><?php echo $this->_var['lang']['assign']; ?></a>
                                                    <a href="javascript:void(0);" class="cz-btn cz-btn-false" ectype="tb-cancel"><?php echo $this->_var['lang']['is_cancel']; ?></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="gm-tab-qp-bort" ectype="qp-bort"></div>
                    </div>
                    <div class="gm-floors" ectype="gm-floors">
                        <div class="gm-f-item gm-f-details" ectype="gm-item">
                            <div class="gm-title">
                                <h3><?php echo $this->_var['lang']['description']; ?></h3>
                            </div>
                            <div class="goods-para-list">
                                <dl class="goods-para">
                                    <dd class="column"><span><?php echo $this->_var['lang']['goods_name']; ?>：<?php echo htmlspecialchars($this->_var['goods']['goods_name']); ?></span></dd>
                                    <dd class="column"><span><?php echo $this->_var['lang']['Commodity_number']; ?>：<?php echo $this->_var['goods']['goods_sn']; ?></span></dd>
                                    <dd class="column"><span><?php echo $this->_var['lang']['seller_store']; ?>：<a href="<?php echo $this->_var['goods']['store_url']; ?>" title="<?php echo $this->_var['goods']['rz_shopName']; ?>" target="_blank"><?php echo $this->_var['goods']['rz_shopName']; ?></a></span></dd>
                                    <?php if ($this->_var['cfg']['show_goodsweight']): ?>
                                    <dd class="column"><span><?php echo $this->_var['lang']['weight']; ?>：<?php echo $this->_var['goods']['goods_weight']; ?></span></dd>
                                    <?php endif; ?>
                                    <?php if ($this->_var['cfg']['show_addtime']): ?>
                                    <dd class="column"><span><?php echo $this->_var['lang']['add_time']; ?><?php echo $this->_var['goods']['add_time']; ?></span></dd>
                                    <?php endif; ?>
                                </dl>

                                <?php if ($this->_var['properties']): ?>
                                <dl class="goods-para">
                                    <?php $_from = $this->_var['properties']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'property_group');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['property_group']):
?>
                                    <?php $_from = $this->_var['property_group']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'property');$this->_foreach['noproperty'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['noproperty']['total'] > 0):
    foreach ($_from AS $this->_var['property']):
        $this->_foreach['noproperty']['iteration']++;
?>
                                    <?php if ($this->_foreach['noproperty']['iteration'] < 13): ?>
                                    <dd class="column"><span title="<?php echo $this->_var['property']['value']; ?>"><?php echo htmlspecialchars($this->_var['property']['name']); ?>：<?php echo $this->_var['property']['value']; ?></span></dd>
                                    <?php endif; ?>
                                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                </dl>
                                <?php endif; ?>
                                <?php if ($this->_var['extend_info']): ?>
                                <dl class="goods-para">
                                    <?php $_from = $this->_var['extend_info']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'info_0_96131400_1569563928');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['info_0_96131400_1569563928']):
?>
                                    <dd class="column"><span title="<?php echo htmlspecialchars($this->_var['info_0_96131400_1569563928']); ?>"><?php echo $this->_var['key']; ?>：<?php echo htmlspecialchars($this->_var['info_0_96131400_1569563928']); ?></span></dd>
                                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                </dl>
                                <?php endif; ?>
                                <?php if ($this->_var['properties']): ?>
                                <p class="more-par">
                                    <a href="javascript:void(0);" ectype="product-detail" class="ftx-05"><?php echo $this->_var['lang']['more_parameters']; ?>>></a>
                                </p>
                                <?php endif; ?>
                            </div>

                            <?php echo $this->_var['goods']['goods_desc']; ?>
                        </div>
                        <?php if ($this->_var['properties']): ?>
                        <div class="gm-f-item gm-f-parameter" ectype="gm-item" id="product-detail" style="display:none;">
                            <div class="gm-title">
                                <h3><?php echo $this->_var['lang']['specification']; ?></h3>
                            </div>
                            <div class="Ptable">
                                <?php $_from = $this->_var['properties']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'property_group');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['property_group']):
?>
                                <div class="Ptable-item">
                                    <h3><?php echo $this->_var['key']; ?></h3>
                                    <dl>
                                        <?php $_from = $this->_var['property_group']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'property');if (count($_from)):
    foreach ($_from AS $this->_var['property']):
?>
                                        <dt><?php echo htmlspecialchars($this->_var['property']['name']); ?></dt>
                                        <dd title="<?php echo $this->_var['property']['value']; ?>"><?php echo $this->_var['property']['value']; ?></dd>
                                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                    </dl>
                                </div>
                                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="gm-f-item gm-f-comment" ectype="gm-item">
                            <div class="gm-title">
                                <h3><?php echo $this->_var['lang']['comment_sunburn']; ?></h3>
                                <?php 
$k = array (
  'name' => 'goods_comment_title',
  'goods_id' => $this->_var['goods']['goods_id'],
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?>
                            </div>
                            <div class="gm-warp">
                                <div class="praise-rate-warp">
                                    <div class="rate">
                                        <strong><?php echo $this->_var['comment_all']['goodReview']; ?></strong>
                                        <span class="rate-span">
                                            <span class="tit"><?php echo $this->_var['lang']['Rate_praise']; ?></span>
                                            <span class="bf">%</span>
                                        </span>
                                    </div>
                                    <div class="actor-new">
                                        <?php if ($this->_var['goods']['impression_list']): ?>
                                        <dl>
                                            <dd ectype="comment_tag" data-type="1"><span class="red"><?php echo $this->_var['lang']['all_attribute']; ?></span></dd>
                                            <?php $_from = $this->_var['goods']['impression_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'tag');if (count($_from)):
    foreach ($_from AS $this->_var['tag']):
?>
                                            <dd ectype="comment_tag"><span><?php echo $this->_var['tag']['txt']; ?></span>(<?php echo $this->_var['tag']['num']; ?>)</dd>
                                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                        </dl>
                                        <?php else: ?>
                                        <div class="not_impression"><?php echo $this->_var['lang']['not_impression']; ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="com-list-main">
                                <?php echo $this->fetch('library/comments.lbi'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="gm-f-item gm-f-tiezi" ectype="gm-item">
                            <?php 
$k = array (
  'name' => 'goods_discuss_title',
  'goods_id' => $this->_var['goods']['goods_id'],
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?>
                            <div class="table" id='discuss_list_ECS_COMMENT'></div>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="rection" id="guess_goods_love">
                </div>
            </div>
        </div>

        <div class="hidden">
            
            <div id="notify_box" class="hide">
                <div class="sale-notice">
                    <div class="prompt"><?php echo $this->_var['lang']['price_notice_desc']; ?></div>
                    <div class="user-form foreg-form">
                        <div class="form-row">
                            <div class="form-label"><em class="red">*</em><?php echo $this->_var['lang']['Price_below']; ?>：</div>
                            <div class="form-value">
                                <input type="text" id="price-notice" name="price-notice" class="form-input w120 fl">
                                <div class="notic"><?php echo $this->_var['lang']['Price_below_one']; ?></div>
                                <div class="error"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-label"><em class="red">*</em><?php echo $this->_var['lang']['label_mobile']; ?></div>
                            <div class="form-value">
                                <input type="text" class="form-input" id="cellphone" name="cellphone">
                                <div class="error"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-label"><em class="red">*</em><?php echo $this->_var['lang']['website_email']; ?>：</div>
                            <div class="form-value">
                                <input type="text" class="form-input" id="user_email_notice" name="email">
                                <div class="error"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="ecsc-cart-popup" id="addtocartdialog">
                <div class="loading-mask"></div>
                <div class="loading">
                    <div class="center_pop_txt">
                        <div class="title"><h3><?php echo $this->_var['lang']['Prompt']; ?></h3><a href="javascript:loadingClose();" title="<?php echo $this->_var['lang']['close']; ?>" class="loading-x">X</a></div>
                    </div>
                    <div class="btns">
                        <a href="flow.php" class="ecsc-btn-mini ecsc-btn-orange"><?php echo $this->_var['lang']['go_pay']; ?></a>
                        <a href="javascript:loadingClose();" class="ecsc-btn-mini"><?php echo $this->_var['lang']['go_shopping']; ?></a>
                    </div>
                </div>
            </div>
        </div>

        
		<?php echo $this->fetch('library/duibi.lbi'); ?>
        

        <?php echo $this->fetch('library/goods_fittings_cnt.lbi'); ?>
    </div>

    <?php 
$k = array (
  'name' => 'user_menu_position',
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?>

    <?php echo $this->fetch('library/page_footer.lbi'); ?>

    <?php echo $this->smarty_insert_scripts(array('files'=>'jquery.SuperSlide.2.1.1.js,jquery.yomi.js,common.js,compare.js,cart_common.js,warehouse_area.js,magiczoomplus.js,cart_quick_links.js')); ?>
    <script type="text/javascript" src="js/calendar.php?lang=<?php echo $this->_var['cfg_lang']; ?>"></script>
	<script type="text/javascript" src="js/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script type="text/javascript" src="themes/<?php echo $GLOBALS['_CFG']['template']; ?>/js/dsc-common.js"></script>
    <script type="text/javascript" src="themes/<?php echo $GLOBALS['_CFG']['template']; ?>/js/jquery.purebox.js"></script>
    <script type="text/javascript" src="themes/<?php echo $GLOBALS['_CFG']['template']; ?>/js/region.js"></script>
	<script type="text/javascript" src="themes/<?php echo $GLOBALS['_CFG']['template']; ?>/js/goodsFittings.js"></script>

	<script type="text/javascript">

	//商品详情
	goods_desc_floor();

	//商品相册小图滚动
	$(".spec-list").slide({mainCell:".spec-items ul",effect:"left",trigger:"click",pnLoop:false,autoPage:true,scroll:1,vis:5,prevCell:".spec-prev",nextCell:".spec-next"});

	//右侧看了又看上下滚动
	$(".track_warp").slide({mainCell:".track-con ul",effect:"top",pnLoop:false,autoPlay:false,autoPage:true,prevCell:".sprite-up",nextCell:".sprite-down",vis:3});

	//商品搭配切换
	$(".combo-inner").slide({titCell:".tab-nav li",mainCell:".tab-content",titOnClassName:"curr",trigger:"click"});

	//商品搭配 多个商品滚动切换
	$(".combo-items").slide({mainCell:".combo-items-warp ul",effect:"left",pnLoop:false,autoPlay:false,autoPage:true,prevCell:".o-prev",nextCell:".o-next",vis:4});

	//左侧新品 热销 推荐排行切换
	$(".g-rank").slide({titCell:".mc-tab li",mainCell:".mc-content",titOnClassName:"curr",trigger:"click"});

	<?php if ($this->_var['goods']['gmt_end_time']): ?>
	//促销价格倒计时
	$(".cd-time").each(function(){
		$(this).yomi();
	});
	<?php endif; ?>

	//全局变量
	var seller_id = <?php echo empty($this->_var['goods']['user_id']) ? '0' : $this->_var['goods']['user_id']; ?>;
	var goods_id = <?php echo empty($this->_var['goods_id']) ? '0' : $this->_var['goods_id']; ?>;
	var goodsId = <?php echo empty($this->_var['goods_id']) ? '0' : $this->_var['goods_id']; ?>;
	var goodsattr_style = <?php echo empty($this->_var['cfg']['goodsattr_style']) ? '1' : $this->_var['cfg']['goodsattr_style']; ?>;
	var gmt_end_time = <?php echo empty($this->_var['promote_end_time']) ? '0' : $this->_var['promote_end_time']; ?>;
	var now_time = <?php echo $this->_var['now_time']; ?>;
	var isReturn = false;
	$(function(){

		<?php if ($this->_var['see_more_goods']): ?>
		seeMoreGoods();
		<?php endif; ?>

		if(seller_id > 0){
			goods_collect_store(seller_id);
		}

		guessGoodsLove();

		//对比默认加载
		Compare.init();
	});

	/******************************************* js方法 start***********************************************/

	var add_shop_price = $("*[ectype='add_shop_price']").val();

	/* 点击可选属性或改变数量时修改商品价格的函数 */
	function changePrice(onload){
		var qty = $("*[ectype='quantity']").val();
		var goods_attr_id = '';
		var goods_attr = '';
		var attr_id = '';
		var attr = '';
		var region_id = $(":input[name='region_id']").val();
		var area_id = $(":input[name='area_id']").val();
        var area_city = $("input[name='area_city']").val();

		if(!region_id){
		   region_id = <?php echo empty($this->_var['region_id']) ? '0' : $this->_var['region_id']; ?>;
	   }

	   if(!area_id){
		   area_id = <?php echo empty($this->_var['area_id']) ? '0' : $this->_var['area_id']; ?>;
	   }

		goods_attr_id = getSelectedAttributes(document.forms['ECS_FORMBUY']);

		if(onload != 'onload'){
			if(add_shop_price == 0){
				attr_id = getSelectedAttributesGroup(document.forms['ECS_FORMBUY']);
				goods_attr = '&goods_attr=' + attr_id;
			}
			Ajax.call('goods.php', 'act=price&id=' + goodsId + '&attr=' + goods_attr_id + goods_attr + '&number=' + qty + '&warehouse_id=' + region_id + '&area_id=' + area_id, changePriceResponse, 'GET', 'JSON');
		}else{
			attr = '&attr=' + goods_attr_id;
			Ajax.call('goods.php', 'act=price&id=' + goodsId + attr + '&number=' + qty + '&warehouse_id=' + region_id + '&area_id=' + area_id + '&onload=' + onload, changePriceResponse, 'GET', 'JSON');
		}
	}

	/* 接收返回的信息 回调函数 */
	function changePriceResponse(res){
		if(res.err_msg.length > 0){
			pbDialog(res.err_msg," ",0,450,80,50);
		}else{
			//商品条形码
			if($("#bar_code").length > 0){
				if(res.bar_code){
					$("#bar_code").html(res.bar_code);
					$("#bar_code").parents(".bar_code").removeClass("hide");
				}else{
					$("#bar_code").parents(".bar_code").addClass("hide");
				}
			}

			$("#cost-price").html(res.marketPrice_amount);

			//更新库存
			if($("*[ectype='goods_attr_num']").length > 0){
				$("*[ectype='goods_attr_num']").html(res.attr_number);
				$("*[ectype='perNumber']").val(res.attr_number);
			}

			//更新已购买数量
			if($("#orderG_number").length > 0){
				$("#orderG_number").html(res.orderG_number);
			}

			if($("#ECS_SHOPPRICE").length > 0){
				//市场价
				if($("#ECS_MARKETPRICE").length > 0){
					$("#ECS_MARKETPRICE").html(res.result_market);
				}

				//商品价格
				if(res.onload == 'onload'){
					$("*[ectype='SHOP_PRICE']").html(res.result);
				}else{
					if(add_shop_price == 1){
						$("*[ectype='SHOP_PRICE']").html(res.result);
					}else{
						if(res.show_goods == 1){
							$("*[ectype='SHOP_PRICE']").html(res.spec_price);
						}else{
							$("*[ectype='SHOP_PRICE']").html(res.result);
						}
					}
				}
		                if(add_shop_price == 0 && res.goods_rank_prices){
		                    $(".goods_rank_prices").html(res.goods_rank_prices);
		                }
				//搭配 套餐价
				var combo_shop = document.getElementsByName('combo_shopPrice[]');
				var combo_mark = document.getElementsByName('combo_markPrice[]');

				for(var i=0; i<combo_shop.length; i++){
					combo_shop[i].innerHTML = res.shop_price;
				}

				for(var i=0; i<combo_mark.length; i++){
					combo_mark[i].innerHTML = res.market_price;
				}
			}

			if(res.err_no == 2){
				$("#isHas_warehouse_num").html(json_languages.shiping_prompt);
			}else{
				var isHas;
				var is_shipping = Number($("#is_shipping").val());

				if($("#isHas_warehouse_num").length > 0){
					if((res.attr_number > 0) && (res.attr_number > 0 || res.original_spec_price == res.original_shop_price) && (<?php echo empty($this->_var['goods']['is_on_sale']) ? '0' : $this->_var['goods']['is_on_sale']; ?> != 0 || is_shipping == 1)){
						$("a[ectype='btn-append']").attr('href','javascript:addToCartShowDiv(<?php echo $this->_var['goods']['goods_id']; ?>)').removeClass('btn_disabled');
						$("a[ectype='btn-buynow']").attr('href','<?php if ($this->_var['user_id'] <= 0 && $this->_var['one_step_buy']): ?>#none<?php else: ?>javascript:addToCart(<?php echo $this->_var['goods']['goods_id']; ?>)<?php endif; ?>').removeClass('btn_disabled');
						$("a[ectype='byStages']").removeClass('btn_disabled');
						$('a').remove('#quehuo');
						isHas = '<strong>'+json_languages.Have_goods+'</strong>，'+json_languages.Deliver_back_order;

						$("a[ectype='btn-buynow']").show();
						$("a[ectype='btn-append']").show();
						$("a[ectype='byStages']").show();
					}else{
						isHas = '<strong>'+json_languages.No_goods+'</strong>，'+json_languages.goods_over;

						$("a[ectype='btn-buynow']").attr('href','javascript:void(0)').addClass('btn_disabled');
						$("a[ectype='btn-append']").attr('href','javascript:void(0)').addClass('btn_disabled');
						$("a[ectype='byStages']").addClass('btn_disabled');

						<?php if ($this->_var['goods']['review_status'] >= 3): ?>
							if(!document.getElementById('quehuo')){
								if(<?php echo empty($this->_var['goods']['is_on_sale']) ? '0' : $this->_var['goods']['is_on_sale']; ?> != 0 || is_shipping == 1){
									$("a[ectype='btn-buynow']").hide();
									$("a[ectype='btn-append']").hide();
									$("a[ectype='byStages']").hide();
									$('.choose-btns').append('<a id="quehuo" class="btn-buynow" href="javascript:addToCart(<?php echo $this->_var['goods']['goods_id']; ?>);">暂时缺货</a>');
								}
							}
						<?php endif; ?>
					}

					if(res.store_type == 1){
						$("[ectype='btn-store-pick']").show();
						$("[ectype='list-store-pick']").show();
					}else{
						$("[ectype='btn-store-pick']").hide();
						$("[ectype='list-store-pick']").hide();
					}
					if(is_shipping == 0){
						//商品没有选择运费模板或者没有设置固定运费时，提示不支持配送
						var freight_info = $("#user_area_shipping").find("*[ectype='freight_info_span']");
						if(freight_info.length < 1){
							$("#user_area_shipping").html("<span class='gary'>[ "+ json_languages.shiping_prompt+" ]</span>");
						}
					}

					$("#isHas_warehouse_num").html(isHas);
				}
			}

			if(res.fittings_interval){
				for(var i=0; i<res.fittings_interval.length; i++){
					$("#m_goods_" + res.fittings_interval[i].groupId).html(res.fittings_interval[i].fittings_minMax);
					$("#m_goods_save_" + res.fittings_interval[i].groupId).html(res.fittings_interval[i].save_minMaxPrice);
					$("#m_goods_reference_" + res.fittings_interval[i].groupId).html(res.fittings_interval[i].market_minMax);
				}
			}

			if(res.onload == 'onload'){
				$("*[ectype='SHOP_PRICE']").html(res.result);
			}

            $(".ECS_fittings_interval").html(res.result);

			//更新白条分期购每期的价格 start
			if(res.stages){
				var i = 0;
				$.each(res.stages,function(k,v){
					if(k!=1) {
                        $("*[ectype='is-ious'] .item i").eq(i).html('￥' + v + '×' + k + json_languages.qi);
                        $("*[ectype='is-ious'] .item i").eq(i).next('span').html(json_languages.free_desc+'<?php echo $this->_var['goods']['stages_rate']; ?>%，￥' + v + '×' + k + json_languages.qi);
					}
					i++;
				});
			}
		}

		isReturn = true;

		if(res.onload == "onload"){
			quantity();
		}
	}

	/* 商品看了又看 start */
	function seeMoreGoods(){
		var region_id = $(":input[name='region_id']").val();
		var area_id = $(":input[name='area_id']").val();

		if(!region_id){
		   region_id = <?php echo empty($this->_var['region_id']) ? '0' : $this->_var['region_id']; ?>;
	   }

	   if(!area_id){
		   area_id = <?php echo empty($this->_var['area_id']) ? '0' : $this->_var['area_id']; ?>;
	   }

		Ajax.call('ajax_dialog.php', 'act=see_more_goods&goods_id=' + goodsId + '&cat_id=' + <?php echo empty($this->_var['goods']['cat_id']) ? '0' : $this->_var['goods']['cat_id']; ?> + '&seller_id=' + <?php echo empty($this->_var['goods']['user_id']) ? '0' : $this->_var['goods']['user_id']; ?> + '&warehouse_id=' + region_id + '&area_id=' + area_id, seeMoreResponse, 'GET', 'JSON');
	}

	function seeMoreResponse(res){
		$("#see_more_goods").html(res.content);

		//右侧看了又看上下滚动
		$(".track_warp").slide({mainCell:".track-con ul",effect:"top",pnLoop:false,autoPlay:false,autoPage:true,prevCell:".sprite-up",nextCell:".sprite-down",vis:3});
	}
	/* 商品看了又看 end */

	/* 商品猜你喜欢 start */
	function guessGoodsLove(){
		var region_id = $(":input[name='region_id']").val();
		var area_id = $(":input[name='area_id']").val();

		if(!region_id){
		   region_id = <?php echo empty($this->_var['region_id']) ? '0' : $this->_var['region_id']; ?>;
	   }

	   if(!area_id){
		   area_id = <?php echo empty($this->_var['area_id']) ? '0' : $this->_var['area_id']; ?>;
	   }

		Ajax.call('ajax_dialog.php', 'act=guess_goods_love&goods_id=' + goodsId + '&warehouse_id=' + region_id + '&area_id=' + area_id, guessGoodsLoveResponse, 'GET', 'JSON');
	}

	function guessGoodsLoveResponse(res){
		$("#guess_goods_love").html(res.content);
	}
	/* 商品猜你喜欢 end */

	/******************************************* js方法 end***********************************************/
	</script>
    <?php 
$k = array (
  'name' => 'goods_delivery_area_js',
  'area' => $this->_var['area'],
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?>
</body>
</html>
