<?php
/**
 * 后台Index相关
 */
namespace Home\Controller;
use Think\Controller;

class IndexController extends CommonController {

	public function index() {
		$liuyan = D('Liuyan')->maxcount();
		$adminCount = D("Admin")->getLastLoginUsers();
		$this->assign('liuyan', $liuyan); /*调用留言列表*/
		$this->assign('admincount', $adminCount); /*调用用户信息*/
		$this->display('Index/lately');
	}
	public function xinan() {
		$liuyan = D('Liuyan')->maxcount();
		$adminCount = D("Admin")->getLastLoginUsers();
		$this->assign('liuyan', $liuyan); /*调用留言列表*/
		$this->assign('admincount', $adminCount); /*调用用户信息*/
		$this->display('index');
	}
	public function guizhou() {
		$liuyan = D('Liuyan')->maxcount();
		$adminCount = D("Admin")->getLastLoginUsers();
		$this->assign('liuyan', $liuyan); /*调用留言列表*/
		$this->assign('admincount', $adminCount); /*调用用户信息*/
		$this->display();
	}
	public function taiyuan() {
		$liuyan = D('Liuyan')->maxcount();
		$adminCount = D("Admin")->getLastLoginUsers();
		$this->assign('liuyan', $liuyan); /*调用留言列表*/
		$this->assign('admincount', $adminCount); /*调用用户信息*/
		$this->display();
	}

}