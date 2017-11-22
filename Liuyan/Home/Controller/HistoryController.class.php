<?php
/**
 * 后台菜单相关
 */
namespace Home\Controller;
use Think\Controller;

class HistoryController extends CommonController {

	public function index() {
		$conds = array();
		$history = array();
		$page = $_REQUEST['page'] ? $_REQUEST['page'] : 1;
		$pageSize = $_REQUEST['limit'] ? $_REQUEST['limit'] : 1;
		$history = D("History")->getHistory($conds, $page, $pageSize);
		$historys = M('history');
		$count = $historys->where($condition)->count(); // 查询满足要求的总记录数
		$res = new \Think\Page($count, $pageSize);
		$pageres = $res->show();
		$history2['code'] = 0;
		$history2['msg'] = "";
		$history2['count'] = intval($count);
		$history2['data'] = $history;
		$this->ajaxReturn($history2, 'JSON');
	}
	public function getname() {
		$hospital = D("Hospital")->gethospital();
		$this->ajaxReturn($hospital);

	}
}