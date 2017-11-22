<?php

/**

 * 后台Index相关

 */

namespace Home\Controller;

use Think\Controller;

class IndexController extends CommonController {

	public function index() {
		$hospital = M('hospital');
		$list = $hospital->limit(10)->select();
		$liuyan = D('Liuyan')->maxcount();
		$adminCount = D("Admin")->getLastLoginUsers();
		$this->assign('liuyan', $liuyan); /*调用留言列表*/
		$this->assign('list', $list);
		$this->assign('admincount', $adminCount); /*调用用户信息*/
		$this->display('Index/lately');

	}

	public function liuyan($hospital) {
		$hospital = M('hospital');
		$list = $hospital->limit(10)->select();
		$this->assign('list', $list);
		$liuyan = D('Liuyan')->maxcount();
		$adminCount = D("Admin")->getLastLoginUsers();
		$this->assign('liuyan', $liuyan); /*调用留言列表*/
		$this->assign('admincount', $adminCount); /*调用用户信息*/
		$this->display('Index/index');

	}
	public function hospital() {
		$hospital = M('hospital');
		$list = $hospital->limit(10)->select();
		$this->assign('list', $list);
		$liuyan = D('Liuyan')->maxcount();
		$adminCount = D("Admin")->getLastLoginUsers();
		$this->assign('liuyan', $liuyan); /*调用留言列表*/
		$this->assign('admincount', $adminCount); /*调用用户信息*/
		$this->display('Index/hospital');

	}
	public function logs() {
		$hospital = M('hospital');
		$list = $hospital->limit(10)->select();
		$this->assign('list', $list);
		$liuyan = D('Liuyan')->maxcount();
		$adminCount = D("Admin")->getLastLoginUsers();
		$this->assign('liuyan', $liuyan); /*调用留言列表*/
		$this->assign('admincount', $adminCount); /*调用用户信息*/
		$this->display('Index/history');

	}

}