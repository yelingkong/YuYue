<?php
namespace Home\Controller;
use Think\Controller;

class IndexController extends Controller {
	public function index() {
		header('Access-Control-Allow-Origin: *');
		// 保存数据
		if (IS_POST) {
			if (!isset($_POST['tel']) || !$_POST['tel']) {
				return show(0, '电话不能为空');
			}
			$condition['tel'] = $_POST['tel'];
			$liuyans = M('Liuyan');
			$count = $liuyans->where($condition)->count();
			if ($count) {
				return show(0, '号码已存在,不用再提交啦！^_^;');
			}
			$city = array();
			$_POST['ip'] = get_client_ip();
			$city = getCity(get_client_ip());
			$_POST['city'] = $city['region'] . $city['city'];
			$_POST['zt'] = 0;
			$_POST['tjtime'] = date("Y-m-d H:i:s");
			$id = D("Liuyan")->insert($_POST);
			if (!$id) {
				return show(0, '信息提交失败啦〒_〒');
			}
			return show(1, '信息提交成功啦*^_^*');
		}
		$this->display();
	}
}