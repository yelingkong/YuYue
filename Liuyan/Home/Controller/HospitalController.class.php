<?php
/**
 * 后台菜单相关
 */
namespace Home\Controller;
use Think\Controller;

class HospitalController extends CommonController {
	public function index() {
		$conds = array();
		$hospital2 = array();
		$page = $_REQUEST['page'] ? $_REQUEST['page'] : 1;
		$pageSize = $_REQUEST['limit'] ? $_REQUEST['limit'] : 1;
		$hospital = D("hospital")->select();
		$hospitals = M('hospital');
		$count = $hospitals->where($condition)->count(); // 查询满足要求的总记录数
		$res = new \Think\Page($count, $pageSize);
		$pageres = $res->show();
		$liuyans2['code'] = 0;
		$liuyans2['msg'] = "";
		$liuyans2['count'] = intval($count);
		$liuyans2['data'] = $hospital;
		$this->ajaxReturn($liuyans2, 'JSON');
	}
	public function edit() {
		$hospital = M('hospital');
		$list = $hospital->limit(10)->select();
		$this->assign('list', $list);
		$liuyan = D('Liuyan')->maxcount();
		$adminCount = D("Admin")->getLastLoginUsers();
		$this->assign('liuyan', $liuyan); /*调用留言列表*/
		$this->assign('admincount', $adminCount); /*调用用户信息*/
		$this->display('Index/hospital_edit');

	}

}