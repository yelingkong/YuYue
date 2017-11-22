<?php
namespace Common\Model;
use Think\Model;

class HospitalModel extends Model {
	private $_db = '';

	public function __construct() {
		$this->_db = M('hospital');
	}

	public function insert($data = array()) {
		if (!$data || !is_array($data)) {
			return 0;
		}
		return $this->_db->add($data);
	}
}
