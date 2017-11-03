<?php

namespace Home\Controller;

use Think\Controller;

class IndexController extends Controller {
	public function index() {
		header("Content-type: text/html; charset=utf-8");
		header('Access-Control-Allow-Origin: *');
		$rules = array(
			array('tel', 'require', '号码不能为空哦〒_〒！'),
			array('tel', '', '号码已存在，无需重复提交啦！^_^;', 0, 'unique', 3),
			array('name', 'require', '姓名不能为空哦〒_〒！'),
		);
		$hospital = M('hospital');
		$list = $hospital->limit(10)->select();
		$this->assign('list', $list);
		$Liuyan = M("Liuyan");
		if (IS_POST) {
			if (!$Liuyan->validate($rules)->create()) {
				return show(0, $Liuyan->getError());
			} else {
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

		}
		$this->display();
	}
}