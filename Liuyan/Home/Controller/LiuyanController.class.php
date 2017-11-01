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
		$times = array();
		$shuliang = array();
		$tianshu = 30;
		$liuyans = M('Liuyan');
		for ($x = 0; $x <= $tianshu; $x++) {
			$datas = date("d", time() + ($x - $tianshu) * 24 * 60 * 60);
			$start = date("Y-m-d 00:00:00", time() + ($x - $tianshu) * 24 * 60 * 60);
			$end = date("Y-m-d 23:59:59", time() + ($x - $tianshu) * 24 * 60 * 60);
			$condition['tjtime'] = array(array('egt', $start), array('elt', $end));
			$condition['zt'] = array('between', '0,1');
			$times[$x] = $datas;
			$condition['hospital'] = array('eq', 1);
			$count = $liuyans
				->where($condition)
				->count();

			$count_xinan[$x] = $count;
			$condition['hospital'] = array('eq', 3);
			$count = $liuyans
				->where($condition)
				->count();
			$count_taiyuan[$x] = $count;
			$condition['hospital'] = array('eq', 2);
			$count = $liuyans
				->where($condition)
				->count();
			$count_guizhou[$x] = $count;
		}
		$liu['times'] = $times;
		$liu['count_xinan'] = $count_xinan;
		$liu['count_guizhou'] = $count_guizhou;
		$liu['count_taiyuan'] = $count_taiyuan;
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