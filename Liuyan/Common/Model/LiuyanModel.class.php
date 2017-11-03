<?php
namespace Common\Model;
use Think\Model;

/**
 * 留言模型
 * @author  yekong
 */
class LiuyanModel extends Model {
	private $_db = '';
	public function __construct() {
		$this->_db = M('liuyan');
	}
	public function select($data = array(), $limit = 100) {
		$conditions = $data;
		$list = $this->_db->where($conditions)->order('id desc')->limit($limit)->select();
		return $list;
	}
	public function insert($data = array()) {
		if (!is_array($data) || !$data) {
			return 0;
		}
		$data['create_time'] = time();
		$data['username'] = getLoginUsername();
		return $this->_db->add($data);
	}
	public function getLiuyan($data, $page, $pageSize = 10) {
		$conditions = $data;
		if (isset($data['tel']) && $data['tel']) {
			$conditions['tel'] = array('like', '%' . $data['tel'] . '%');
		}
		$conditions['zt'] = array('neq', -1);
		$offset = ($page - 1) * $pageSize;
		$list = $this->_db->where($conditions)
			->order('id desc')
			->limit($offset, $pageSize)
			->join('left JOIN yy_hospital ON yy_liuyan.hospital = yy_hospital.hid')
			->join('left JOIN yy_zt ON yy_liuyan.zt = yy_zt.zt_status')
			->select();

		return $list;

	}
	public function getLiuyantel($data = array()) {
		$conditions = $data;
		if (isset($data['tel']) && $data['tel']) {
			$conditions['tel'] = array('like', '%' . $data['id'] . '%');
		}
		$conditions['zt'] = array('neq', -1);
		return $this->_db->where($conditions)->count();
	}

	public function find($id) {
		$data = $this->_db->where('id=' . $id)->find();
		return $data;
	}

	public function updateById($id, $data) {
		if (!$id || !is_numeric($id)) {
			throw_exception("ID不合法");
		}
		if (!$data || !is_array($data)) {
			throw_exception('更新数据不合法');
		}

		return $this->_db->where('id=' . $id)->save($data);
	}
	public function maxcount() {
		$data['zt'] = array('eq', -1);
		return $this->_db->where($data)->order('id desc')->limit(1)->find();
	}
	public function updateztById($id, $zt) {
		if (!is_numeric($zt)) {
			throw_exception('status不能为非数字');
		}
		if (!$id || !is_numeric($id)) {
			throw_exception('id不合法');
		}
		$data['zt'] = $zt;

		return $this->_db->where('id=' . $id)->save($data);
	}

}
