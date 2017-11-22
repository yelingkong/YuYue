<?php
namespace Common\Model;
use Think\Model;

class HistoryModel extends Model {
	private $_db = '';

	public function __construct() {
		$this->_db = M('History');
	}

	public function insert($data = array()) {
		if (!$data || !is_array($data)) {
			return 0;
		}
		return $this->_db->add($data);
	}
	public function getHistory($data, $page, $pageSize = 10) {
		$offset = ($page - 1) * $pageSize;
		$list = $this->_db->where($conditions)
			->order('id desc')
			->limit($offset, $pageSize)
			->join('left JOIN yy_admin ON yy_history.name_id = yy_admin.admin_id')
			->select();

		return $list;

	}

}
