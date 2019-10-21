<?php
//zend by 多点乐  禁止倒卖 一经发现停止任何服务
/**
 * 查询用户地址信息
 * user
 * order
 */
function get_user_region_address($order_id = 0, $address = '', $type = 0)
{
    if ($type == 1) {
        $table = 'order_return';
        $where = "o.ret_id = '$order_id'";
    } else {
        $table = 'order_info';
        $where = "o.order_id = '$order_id'";
    }

    /* 取得区域名 **|IFNULL(c.region_name, ''), '  ', |** */
    $sql = "SELECT concat(IFNULL(p.region_name, ''), " .
        "'  ', IFNULL(t.region_name, ''), '  ', IFNULL(d.region_name, ''), '  ', IFNULL(s.region_name, '')) AS region " .
        "FROM " . $GLOBALS['ecs']->table($table) . " AS o " .
        //"LEFT JOIN " . $GLOBALS['ecs']->table('region') . " AS c ON o.country = c.region_id " .
        "LEFT JOIN " . $GLOBALS['ecs']->table('region') . " AS p ON o.province = p.region_id " .
        "LEFT JOIN " . $GLOBALS['ecs']->table('region') . " AS t ON o.city = t.region_id " .
        "LEFT JOIN " . $GLOBALS['ecs']->table('region') . " AS d ON o.district = d.region_id " .
        "LEFT JOIN " . $GLOBALS['ecs']->table('region') . " AS s ON o.street = s.region_id " .
        "WHERE " . $where;
    $region = $GLOBALS['db']->getOne($sql);

    if ($address) {
        $region = $region . "&nbsp;" . $address;
    }

    return $region;
}

function stateFlow($state){
	$stageLast = array();
	if(!empty($state)){
		if($state == 1){
			$stageLast['s1'] = '项目经理已入住';
			$stageLast['c1'] = '1';
			$stageLast['s2'] = '项目经理申报未验收';
			$stageLast['c2'] = '0';
			$stageLast['s3'] = '质检未确认';
			$stageLast['c3'] = '0';
			$stageLast['s4'] = '用户未确认';
			$stageLast['c4'] = '0';
		}
		if($state == 2){
			$stageLast['s1'] = '项目经理已入住';
			$stageLast['c1'] = '1';
			$stageLast['s2'] = '项目经理申报已验收';
			$stageLast['c2'] = '1';
			$stageLast['s3'] = '质检未确认';
			$stageLast['c3'] = '0';
			$stageLast['s4'] = '用户未确认';
			$stageLast['c4'] = '0';
		}
		if($state == 3){
			$stageLast['s1'] = '项目经理已入住';
			$stageLast['c1'] = '1';
			$stageLast['s2'] = '项目经理申报已验收';
			$stageLast['c2'] = '1';
			$stageLast['s3'] = '质检已确认';
			$stageLast['c3'] = '1';
			$stageLast['s4'] = '用户未确认';
			$stageLast['c4'] = '0';
		}
		if($state == 4){
			$stageLast['s1'] = '项目经理已入住';
			$stageLast['c1'] = '1';
			$stageLast['s2'] = '项目经理申报已验收';
			$stageLast['c2'] = '1';
			$stageLast['s3'] = '质检已确认';
			$stageLast['c3'] = '1';
			$stageLast['s4'] = '用户已确认';
			$stageLast['c4'] = '1';
		}
	}else{
		$stageLast['s1'] = '项目经理未入住';
		$stageLast['c1'] = '0';
		$stageLast['s2'] = '项目经理申报未验收';
		$stageLast['c2'] = '0';
		$stageLast['s3'] = '质检未确认';
		$stageLast['c3'] = '0';
		$stageLast['s4'] = '用户未确认';
		$stageLast['c4'] = '0';
	}
	return $stageLast;
}

function stateFlowOne($state){
	// $stageLast = array();
	if(!empty($state)){
		if($state == 1){
			$stageLast = '项目经理已入住';
		}
		if($state == 2){
			$stageLast = '项目经理申报已验收';
		}
		if($state == 3){
			$stageLast = '质检已确认';
		}
		if($state == 4){
			$stageLast = '用户已确认';
		}
	}else{
		$stageLast = '项目经理未入住';
	}
	return $stageLast;
}

//功能：计算两个时间戳之间相差的日时分秒
//$begin_time  开始时间戳
//$end_time 结束时间戳
function timediff($begin_time,$end_time)
{
      if($begin_time < $end_time){
         $starttime = $begin_time;
         $endtime = $end_time;
      }else{
         $starttime = $end_time;
         $endtime = $begin_time;
      }

      //计算天数
      $timediff = $endtime-$starttime;
      $days = intval($timediff/86400);
      //计算小时数
      $remain = $timediff%86400;
      $hours = intval($remain/3600);
      //计算分钟数
      $remain = $remain%3600;
      $mins = intval($remain/60);
      //计算秒数
      $secs = $remain%60;
      $res = array("day" => $days,"hour" => $hours,"min" => $mins,"sec" => $secs);
      return $res;
}

// 检测是否登录并有外部设计师管理权限
function checkPower($user_rank){
	if(session('manager_id')){
		// print_r(session('manager_id'));exit;
		$user_id = session('manager_id');
		$users = dao('users')->where(array('user_id' => $user_id))->find();
		
		if($users['user_rank'] == $user_rank){
			return true;
		}else{
			return false;
		}
	}else{
		return false;
	}
}

/**
 * curl请求
 * @param  String $url     请求地址
 * @param  Array  $data    请求参数
 * @param  Array  $header  请求header
 * @param  Int    $timeout 超时时间
 * @return String
 */
function doCurl($url, $data=array(), $header=array(), $timeout=30){  
	
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
 
    $response = curl_exec($ch);  
 
    if($error=curl_error($ch)){  
        die($error);
    }  
 
    curl_close($ch);  
 
    return $response;
}

// unicode转译
function unicodeDecode($unicode_str){
    $json = '{"str":"'.$unicode_str.'"}';
    $arr = json_decode($json,true);
    if(empty($arr)) return '';
    return $arr['str'];
}
?>
