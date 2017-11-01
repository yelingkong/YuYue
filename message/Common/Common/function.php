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

function getCity($ip = '') {
	if ($ip == '') {
		$url = "http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json";
		$ip = json_decode(file_get_contents($url), true);
		$data = $ip;
	} else {
		$url = "http://ip.taobao.com/service/getIpInfo.php?ip=" . $ip;
		$ip = json_decode(file_get_contents($url));
		if ((string) $ip->code == '1') {
			return false;
		}
		$data = (array) $ip->data;
	}

	return $data;
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
