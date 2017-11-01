<?php

/**
 * 公用的方法
 */

function show($status, $message, $data = array()) {
	$reuslt = array(
		'status' => $status,
		'message' => $message,
		'data' => $data,
	);

	exit(json_encode($reuslt));
}
function ipxian() {
	$host = get_client_ip();
	$list = '171.221.254.140';
	if (in_host($host, $list)) {
		$this->display("login/login");
	}
}
function show_zt($status, $message, $status2) {
	$reuslt = array(
		'status' => $status,
		'message' => $message,
		'status2' => $status2,
	);

	exit(json_encode($reuslt));
}
function getMd5Password($password) {
	return md5($password . C('MD5_PRE'));
}
function getMenuType($type) {
	return $type == 1 ? '后台菜单' : '前端导航';
}
function getstatus($status) {
	if ($status == 0) {
		$str = '未沟通';
	} elseif ($status == 1) {
		$str = '已沟通';
	} elseif ($status == -1) {
		$str = '删除';
	}
	return $str;
}
function getsex($sex) {
	if ($sex == 0) {
		$str = '女';
	} elseif ($sex == 1) {
		$str = '男';
	}
	return $str;
}
function status($status) {
	if ($status == 0) {
		$str = '关闭';
	} elseif ($status == 1) {
		$str = '正常';
	} elseif ($status == -1) {
		$str = '删除';
	}
	return $str;
}
function gethospital($hospital) {
	if ($hospital == 1) {
		$str = '西南';
	} elseif ($hospital == 2) {
		$str = '贵州';
	} elseif ($hospital == 3) {
		$str = '太原';
	} elseif ($hospital == 4) {
		$str = '其他';
	}
	return $str;
}
function getAdminMenuUrl($nav) {
	$url = '/admin.php?c=' . $nav['c'] . '&a=' . $nav['a'];
	if ($nav['f'] == 'index') {
		$url = '/admin.php?c=' . $nav['c'];
	}
	return $url;
}
function getActive($navc) {
	$c = strtolower(CONTROLLER_NAME);
	if (strtolower($navc) == $c) {
		return 'class="active"';
	}
	return '';
}
function showKind($status, $data) {
	header('Content-type:application/json;charset=UTF-8');
	if ($status == 0) {
		exit(json_encode(array('error' => 0, 'url' => $data)));
	}
	exit(json_encode(array('error' => 1, 'message' => '上传失败')));
}
function getLoginUsername() {
	return $_SESSION['adminUser']['username'] ? $_SESSION['adminUser']['username'] : '';
}
function getCatName($navs, $id) {
	foreach ($navs as $nav) {
		$navList[$nav['menu_id']] = $nav['name'];
	}
	return isset($navList[$id]) ? $navList[$id] : '';
}
function getCopyFromById($id) {
	$copyFrom = C("COPY_FROM");
	return $copyFrom[$id] ? $copyFrom[$id] : '';
}
function isThumb($thumb) {
	if ($thumb) {
		return '<span style="color:red">有</span>';
	}
	return '无';
}
function Lately_time($tianshu) {
	/*返回最近天数的数组*/
	$times = array();
	for ($x = 0; $x <= $tianshu; $x++) {
		$datas = date("d", time() + ($x - $tianshu) * 24 * 60 * 60);
		$times[$x] = $datas;
	}
	return $times;
}
function Lately_zi($tianshu, $hospitalid) {
	/*返回指定天数的医院留言当天数量*/
	$counts = array();
	$liuyans = M('Liuyan');
	for ($x = 0; $x <= $tianshu; $x++) {
		$datas = date("d", time() + ($x - $tianshu) * 24 * 60 * 60);
		$start = date("Y-m-d 00:00:00", time() + ($x - $tianshu) * 24 * 60 * 60);
		$end = date("Y-m-d 23:59:59", time() + ($x - $tianshu) * 24 * 60 * 60);
		$condition['tjtime'] = array(array('egt', $start), array('elt', $end));
		$condition['zt'] = array('between', '0,1');
		$times[$x] = $datas;
		$condition['hospital'] = array('eq', $hospitalid);
		$count = $liuyans
			->where($condition)
			->count();
		$counts[$x] = $count;
	}
	return $counts;
}

/**
+----------------------------------------------------------
 * 字符串截取，支持中文和其他编码
+----------------------------------------------------------
 * @static
 * @access public
+----------------------------------------------------------
 * @param string $str 需要转换的字符串
 * @param string $start 开始位置
 * @param string $length 截取长度
 * @param string $charset 编码格式
 * @param string $suffix 截断显示字符
+----------------------------------------------------------
 * @return string
+----------------------------------------------------------
 */
function msubstr($str, $start = 0, $length, $charset = "utf-8", $suffix = true) {
	$len = substr($str);
	if (function_exists("mb_substr")) {
		if ($suffix) {
			return mb_substr($str, $start, $length, $charset) . "...";
		} else {
			return mb_substr($str, $start, $length, $charset);
		}

	} elseif (function_exists('iconv_substr')) {
		if ($suffix && $len > $length) {
			return iconv_substr($str, $start, $length, $charset) . "...";
		} else {
			return iconv_substr($str, $start, $length, $charset);
		}

	}
	$re['utf-8'] = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
	$re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
	$re['gbk'] = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
	$re['big5'] = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
	preg_match_all($re[$charset], $str, $match);
	$slice = join("", array_slice($match[0], $start, $length));
	if ($suffix) {
		return $slice . "…";
	}

	return $slice;
}
function in_host($host, $list) {
	$list = ',' . $list . ',';
	$is_in = false;
	// 1.判断最简单的情况
	$is_in = strpos($list, ',' . $host . ',') === false ? false : true;
	// 2.判断通配符情况
	if (!$is_in && strpos($list, '*') !== false) {
		$hosts = array();
		$hosts = explode('.', $host);
		// 组装每个 * 通配符的情况
		foreach ($hosts as $k1 => $v1) {
			$host_now = '';
			foreach ($hosts as $k2 => $v2) {
				$host_now .= ($k2 == $k1 ? '*' : $v2) . '.';
			}
			// 组装好后进行判断
			if (strpos($list, ',' . substr($host_now, 0, -1) . ',') !== false) {
				$is_in = true;
				break;
			}
		}
	}
	// 3.判断IP段限制
	if (!$is_in && strpos($list, '-') !== false) {
		$lists = explode(',', trim($list, ','));
		$host_long = ip2long($host);
		foreach ($lists as $k => $v) {
			if (strpos($v, '-') !== false) {
				list($host1, $host2) = explode('-', $v);
				if ($host_long >= ip2long($host1) && $host_long <= ip2long($host2)) {
					$is_in = true;
					break;
				}
			}
		}
	}
	return $is_in;
}