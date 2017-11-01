<?php
/**
 * 后台菜单相关
 */
namespace Home\Controller;
use Think\Controller;

class HistoryController extends CommonController {

	public function index() {
		$conds = array();
		$name = $_GET['hname'];
		if ($name) {
			$conds['hname'] = $name;
		}
		$page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
		$pageSize = 10;
		$hospital = D("Hospital")->gethospital();
		$pageres = $res->show();
		$this->assign('hospital', $hospital);
		$this->display();
	}
	public function getname() {
		$hospital = D("Hospital")->gethospital();
		$this->ajaxReturn($hospital);

	}

}