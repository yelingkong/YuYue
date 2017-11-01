<?php
/**
 * 后台Index相关
 */
namespace Home\Controller;
use Think\Controller;

/**
 * 文章内容管理
 */
class LiuyanController extends CommonController {

	public function index() {
		$condition['zt'] = array('NEQ', -1);
		$conds = array();
		$liuyans2 = array();
		$page = $_REQUEST['page'] ? $_REQUEST['page'] : 1;
		$pageSize = $_REQUEST['limit'] ? $_REQUEST['limit'] : 1;
		$liuyan = D("Liuyan")->getLiuyan($conds, $page, $pageSize);
		$liuyans = M('Liuyan');
		$count = $liuyans->where($condition)->count(); // 查询满足要求的总记录数
		$res = new \Think\Page($count, $pageSize);
		$pageres = $res->show();
		$this->assign('liuyan', $liuyan);
		$this->assign('pageres', $pageres);
		$liuyans2['code'] = 0;
		$liuyans2['msg'] = "";
		$liuyans2['count'] = intval($count);
		$liuyans2['data'] = $liuyan;
		$this->display();
	}
	public function getliuyan() {
		$condition['zt'] = array('NEQ', -1);
		$conds = array();
		$liuyans2 = array();
		$conds['hospital'] = $_REQUEST['hospital'] ? $_REQUEST['hospital'] : 1;
		$condition['hospital'] = $_REQUEST['hospital'] ? $_REQUEST['hospital'] : 1;
		$page = $_REQUEST['page'] ? $_REQUEST['page'] : 1;
		$pageSize = $_REQUEST['limit'] ? $_REQUEST['limit'] : 1;
		$liuyan = D("Liuyan")->getLiuyan($conds, $page, $pageSize);
		$liuyans = M('Liuyan');
		$count = $liuyans->where($condition)->count(); // 查询满足要求的总记录数
		$res = new \Think\Page($count, $pageSize);
		$pageres = $res->show();
		$this->assign('liuyan', $liuyan);
		$this->assign('pageres', $pageres);
		$liuyans2['code'] = 0;
		$liuyans2['msg'] = "";
		$liuyans2['count'] = intval($count);
		$liuyans2['data'] = $liuyan;
		$this->ajaxReturn($liuyans2, 'JSON');
	}

	public function Lately() {
		$liu = array();
		$counts = array();
		$shuliang = array();
		$tianshu = 30;
		$hospital = M('hospital');
		$liuyans = M('Liuyan');
		$condition['hstatus'] = array('eq', 1);
		$hospital_count = $hospital
			->where($condition)
			->count();
		$hospital_list = $hospital
			->where($condition)
			->select();
		$liu['times'] = Lately_time($tianshu);
		for ($h = 0; $h < $hospital_count; $h++) {
			$liu['hospital'][$h] = $hospital_list[$h]['hname'];
			$counts = Lately_zi($tianshu, $hospital_list[$h]['hid']);
			$liu['hospitals'][$h] = array('name' => $hospital_list[$h]['hname'], 'type' => 'line', 'stack' => '总量', 'data' => $counts);
		};
		$this->ajaxReturn($liu, 'JSON');
	}
	/*状态修改设置*/
	public function setzt() {
		try {
			if ($_POST) {
				$id = $_POST['id'];
				$zt = $_POST['zt'];
				// 执行数据更新操作
				$res = D("Liuyan")->updateztById($id, $zt);
				if ($res) {
					return show_zt(1, '操作成功', $zt);
				} else {
					return show(0, '操作失败');
				}
			}
		} catch (Exception $e) {
			return show(0, $e->getMessage());
		}
		return show(0, '没有提交的数据');
	}
}