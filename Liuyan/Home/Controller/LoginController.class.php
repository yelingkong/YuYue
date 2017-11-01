<?php
namespace Home\Controller;
use Think\Controller;

/**
 * use Common\Model 这块可以不需要使用，框架默认会加载里面的内容
 */
class LoginController extends Controller {

	public function index() {
		$host = get_client_ip();
		$list = '171.221.254.140,127.0.0.1';
		if (in_host($host, $list)) {
			if (session('adminUser')) {
				$this->redirect('/admin.php?c=index');
			}
			$this->display();
		} else {
			$this->display("login/login");
		}

	}
/*登录检测*/
	public function check() {
		$username = $_POST['username'];
		$password = $_POST['password'];
		if (!trim($username)) {
			return show(0, '用户名不能为空');
		}
		if (!trim($password)) {
			return show(0, '密码不能为空');
		}

		$ret = D('Admin')->getAdminByUsername($username);
		if (!$ret || $ret['status'] != 1) {
			return show(0, '该用户不存在');
		}
		if ($ret['password'] != getMd5Password($password)) {
			return show(0, '密码错误');

		}

		$_login['name_id'] = $ret['admin_id'];
		$_login['ip'] = get_client_ip();
		$_login['login_time'] = date("Y-m-d H:i:s");
		D("Admin")->updateByAdminId($ret['admin_id'], array('lastlogintime' => time()));
		D("History")->insert($_login); //记录登录日志
		session('adminUser', $ret);
		return show(1, '登录成功');

	}

	public function loginout() {
		session('adminUser', null);
		$this->redirect('/admin.php?c=login');
	}

}