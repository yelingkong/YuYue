<?php
namespace Common\Model;
use Think\Model;

/**
 * 留言提交
 * @author  yekong
 */
class LiuyanModel extends Model {
	private $_db = '';
	public function __construct() {
		$this->_db = M('liuyan');
	}
	public function insert($data = array()) {
		if (!is_array($data) || !$data) {
			return 0;
		}
		return $this->_db->add($data);
	}
	public function getLiuyantel($data = array()) {
		$conditions = $data;
		$list = $this->_db->where($conditions)->select();
		return $list;
	}

}
