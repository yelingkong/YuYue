<?php
namespace Common\Model;
use Think\Model;

/**
 * 用户组操作
 * @author  singwa
 */
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

}
