<?php
//zend by 多点乐  禁止倒卖 一经发现停止任何服务
if (!defined('IN_ECS')) {
	exit('Hacking attempt');
}

define('MOBILE_WECHAT', ROOT_PATH . 'mobile/app/Modules/Wechat');
define('MOBILE_DRP', ROOT_PATH . 'mobile/app/Modules/Drp');
define('MOBILE_TEAM', ROOT_PATH . 'mobile/app/Modules/Team');
define('MOBILE_BARGAIN', ROOT_PATH . 'mobile/app/Modules/Bargain');
define('MOBILE_KEFU', ROOT_PATH . 'kefu');
define('DEALCONCURRENT_PAY_ORDER', 0);
define('RF_APPLICATION', 0);
define('RF_RECEIVE', 1);
define('RF_SWAPPED_OUT_SINGLE', 2);
define('RF_SWAPPED_OUT', 3);
define('RF_COMPLETE', 4);
define('RF_AGREE_APPLY', 5);
define('REFUSE_APPLY', 6);
define('FF_NOREFOUND', 0);
define('FF_REFOUND', 1);
define('FF_EXCHANGE', 2);
define('FF_MAINTENANCE', 3);
define('FF_NOEXCHANGE', 4);
define('FF_NOMAINTENANCE', 5);
define('ERR_INVALID_IMAGE', 1);
define('ERR_NO_GD', 2);
define('ERR_IMAGE_NOT_EXISTS', 3);
define('ERR_DIRECTORY_READONLY', 4);
define('ERR_UPLOAD_FAILURE', 5);
define('ERR_INVALID_PARAM', 6);
define('ERR_INVALID_IMAGE_TYPE', 7);
define('ERR_COPYFILE_FAILED', 1);
define('ERR_CREATETABLE_FAILED', 2);
define('ERR_DELETEFILE_FAILED', 3);
define('ATTR_TEXT', 0);
define('ATTR_OPTIONAL', 1);
define('ATTR_TEXTAREA', 2);
define('ATTR_URL', 3);
define('ERR_USERNAME_EXISTS', 1);
define('ERR_EMAIL_EXISTS', 2);
define('ERR_INVALID_USERID', 3);
define('ERR_INVALID_USERNAME', 4);
define('ERR_INVALID_PASSWORD', 5);
define('ERR_INVALID_EMAIL', 6);
define('ERR_USERNAME_NOT_ALLOW', 7);
define('ERR_EMAIL_NOT_ALLOW', 8);
define('ERR_PHONE_EXISTS', 9);
define('ERR_NOT_EXISTS', 1);
define('ERR_OUT_OF_STOCK', 2);
define('ERR_NOT_ON_SALE', 3);
define('ERR_CANNT_ALONE_SALE', 4);
define('ERR_NO_BASIC_GOODS', 5);
define('ERR_NEED_SELECT_ATTR', 6);
define('CART_GENERAL_GOODS', 0);
define('CART_GROUP_BUY_GOODS', 1);
define('CART_AUCTION_GOODS', 2);
define('CART_SNATCH_GOODS', 3);
define('CART_EXCHANGE_GOODS', 4);
define('CART_PRESALE_GOODS', 5);
define('CART_SECKILL_GOODS', 6);
define('OS_UNCONFIRMED', 0);
define('OS_CONFIRMED', 1);
define('OS_CANCELED', 2);
define('OS_INVALID', 3);
define('OS_RETURNED', 4);
define('OS_SPLITED', 5);
define('OS_SPLITING_PART', 6);
define('OS_RETURNED_PART', 7);
define('OS_ONLY_REFOUND', 8);
define('PAY_ORDER', 0);
define('PAY_SURPLUS', 1);
define('PAY_APPLYGRADE', 2);
define('PAY_TOPUP', 3);
define('PAY_APPLYTEMP', 4);
define('PAY_WHOLESALE', 5);
define('SS_UNSHIPPED', 0);
define('SS_SHIPPED', 1);
define('SS_RECEIVED', 2);
define('SS_PREPARING', 3);
define('SS_SHIPPED_PART', 4);
define('SS_SHIPPED_ING', 5);
define('OS_SHIPPED_PART', 6);
define('PS_UNPAYED', 0);
define('PS_PAYING', 1);
define('PS_PAYED', 2);
define('PS_PAYED_PART', 3);
define('PS_REFOUND', 4);
define('PS_REFOUND_PART', 5);
define('CS_AWAIT_PAY', 100);
define('CS_AWAIT_SHIP', 101);
define('CS_FINISHED', 102);
define('CS_TO_CONFIRM', 103);
define('CS_CONFIRM_TAKE', 104);
define('CS_ORDER_BACK', 105);
define('CS_NEW_ORDER', 106);
define('CS_NEW_PAID_ORDER', 107);
define('CS_WAIT_GOODS', 108);
define('DELIVERY_SHIPPED', 0);
define('DELIVERY_REFOUND', 1);
define('DELIVERY_CREATE', 2);
define('OOS_WAIT', 0);
define('OOS_CANCEL', 1);
define('OOS_CONSULT', 2);
define('SURPLUS_SAVE', 0);
define('SURPLUS_RETURN', 1);
define('COMMENT_UNCHECKED', 0);
define('COMMENT_CHECKED', 1);
define('COMMENT_REPLYED', 2);
define('SEND_BY_USER', 0);
define('SEND_BY_GOODS', 1);
define('SEND_BY_ORDER', 2);
define('SEND_BY_PRINT', 3);
define('SEND_BY_GET', 4);
define('IMG_AD', 0);
define('FALSH_AD', 1);
define('CODE_AD', 2);
define('TEXT_AD', 3);
define('ATTR_NOT_NEED_SELECT', 0);
define('ATTR_NEED_SELECT', 1);
define('M_MESSAGE', 0);
define('M_COMPLAINT', 1);
define('M_ENQUIRY', 2);
define('M_CUSTOME', 3);
define('M_BUY', 4);
define('M_BUSINESS', 5);
define('M_COMMENT', 6);
define('GBS_PRE_START', 0);
define('GBS_UNDER_WAY', 1);
define('GBS_FINISHED', 2);
define('GBS_SUCCEED', 3);
define('GBS_FAIL', 4);
define('BONUS_NOT_MAIL', 0);
define('BONUS_MAIL_SUCCEED', 1);
define('BONUS_MAIL_FAIL', 2);
define('GAT_SNATCH', 0);
define('GAT_GROUP_BUY', 1);
define('GAT_AUCTION', 2);
define('GAT_POINT_BUY', 3);
define('GAT_PACKAGE', 4);
define('ACT_SAVING', 0);
define('ACT_DRAWING', 1);
define('ACT_ADJUSTING', 2);
define('ACT_OTHER', 99);
define('PWD_MD5', 1);
define('PWD_PRE_SALT', 2);
define('PWD_SUF_SALT', 3);
define('COMMON_CAT', 1);
define('SYSTEM_CAT', 2);
define('INFO_CAT', 3);
define('UPHELP_CAT', 4);
define('HELP_CAT', 5);
define('PRE_START', 0);
define('UNDER_WAY', 1);
define('FINISHED', 2);
define('SETTLED', 3);
define('CAPTCHA_REGISTER', 1);
define('CAPTCHA_LOGIN', 2);
define('CAPTCHA_COMMENT', 4);
define('CAPTCHA_ADMIN', 8);
define('CAPTCHA_LOGIN_FAIL', 16);
define('CAPTCHA_MESSAGE', 32);
define('FAR_ALL', 0);
define('FAR_CATEGORY', 1);
define('FAR_BRAND', 2);
define('FAR_GOODS', 3);
define('AUTONOMOUS_USE', 0);
define('GENERAL_AUDIENCE', 1);
define('FAT_GOODS', 0);
define('FAT_PRICE', 1);
define('FAT_DISCOUNT', 2);
define('COMMENT_LOGIN', 1);
define('COMMENT_CUSTOM', 2);
define('COMMENT_BOUGHT', 3);
define('SDT_SHIP', 0);
define('SDT_PLACE', 1);
define('SDT_PAID', 2);
define('SALES_PAY', 0);
define('SALES_SHIP', 1);
define('ENCRYPT_ZC', 1);
define('ENCRYPT_UC', 2);
define('G_REAL', 1);
define('G_CARD', 0);
define('TO_P', 0);
define('FROM_P', 1);
define('TO_R', 2);
define('FROM_R', 3);
define('ALIPAY_AUTH', 'gh0bis45h89m5mwcoe85us4qrwispes0');
define('ALIPAY_ID', '2088002052150939');
define('BUY_GOODS', 1);
define('COMMENT_GOODS', 2);
define('SEND_LIST', 0);
define('SEND_USER', 1);
define('SEND_RANK', 2);
define('LICENSE_VERSION', '1.0');
define('SHIP_LIST', 'cac|city_express|ems|flat|fpd|post_express|post_mail|presswork|sf_express|sto_express|yto|zto');
define('USER_LOGIN', 1);
define('USER_PICT', 2);
define('USER_INFO', 3);
define('USER_REAL', 4);
define('USER_PPASS', 5);
define('USER_PHONE', 6);
define('USER_EMAIL', 7);
define('USER_LPASS', 8);
define('USER_LINE', 9);

if (!defined('CAL_GREGORIAN')) {
	define('CAL_GREGORIAN', 0);
}

if (!defined('CAL_JULIAN')) {
	define('CAL_JULIAN', 1);
}

if (!defined('CAL_JEWISH')) {
	define('CAL_JEWISH', 2);
}

if (!defined('CAL_FRENCH')) {
	define('CAL_FRENCH', 3);
}

if (!defined('CAL_NUM_CALS')) {
	define('CAL_NUM_CALS', 4);
}

if (!defined('CAL_DOW_DAYNO')) {
	define('CAL_DOW_DAYNO', 0);
}

if (!defined('CAL_DOW_SHORT')) {
	define('CAL_DOW_SHORT', 1);
}

if (!defined('CAL_DOW_LONG')) {
	define('CAL_DOW_LONG', 2);
}

if (!defined('CAL_MONTH_GREGORIAN_SHORT')) {
	define('CAL_MONTH_GREGORIAN_SHORT', 0);
}

if (!defined('CAL_MONTH_GREGORIAN_LONG')) {
	define('CAL_MONTH_GREGORIAN_LONG', 0);
}

if (!defined('CAL_MONTH_GREGORIAN_LONG')) {
	define('CAL_MONTH_GREGORIAN_LONG', 1);
}

if (!defined('CAL_MONTH_JULIAN_SHORT')) {
	define('CAL_MONTH_JULIAN_SHORT', 2);
}

if (!defined('CAL_MONTH_JULIAN_LONG')) {
	define('CAL_MONTH_JULIAN_LONG', 3);
}

if (!defined('CAL_MONTH_JEWISH')) {
	define('CAL_MONTH_JEWISH', 4);
}

if (!defined('CAL_MONTH_FRENCH')) {
	define('CAL_MONTH_FRENCH', 5);
}

if (!defined('CAL_EASTER_DEFAULT')) {
	define('CAL_EASTER_DEFAULT', 0);
}

if (!defined('CAL_EASTER_ROMAN')) {
	define('CAL_EASTER_ROMAN', 1);
}

if (!defined('CAL_EASTER_ALWAYS_GREGORIAN')) {
	define('CAL_EASTER_ALWAYS_GREGORIAN', 2);
}

if (!defined('CAL_EASTER_ALWAYS_JULIAN')) {
	define('CAL_EASTER_ALWAYS_JULIAN', 3);
}

if (!defined('CAL_JEWISH_ADD_ALAFIM_GERESH')) {
	define('CAL_JEWISH_ADD_ALAFIM_GERESH', 2);
}

if (!defined('CAL_JEWISH_ADD_ALAFIM')) {
	define('CAL_JEWISH_ADD_ALAFIM', 4);
}

if (!defined('CAL_JEWISH_ADD_GERESHAYIM')) {
	define('CAL_JEWISH_ADD_GERESHAYIM', 8);
}

?>
