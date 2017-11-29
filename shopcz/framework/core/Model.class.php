<?php

//模型类基类
class Model{
	protected $db; //Mysql 类实例化对象
	protected $table;
	public function __construct($table){
		$dbconfig['host'] = $GLOBALS['config']['host'];
		$dbconfig['user'] = $GLOBALS['config']['user'];
		$dbconfig['password'] = $GLOBALS['config']['password'];
		$dbconfig['dbname'] = $GLOBALS['config']['dbname'];
		$dbconfig['port'] = $GLOBALS['config']['port'];
		$dbconfig['charset'] = $GLOBALS['config']['charset'];
		
		$dbconfig['table'] = $GLOBALS['config']['prefix'] . $table;
		$this->table = $dbconfig['table'];
		$this->db = new Mysql($dbconfig);
	}

	/**
	 * 自动插入记录
	 * @access public
	 * @param $list array 关联数组['字段名'=>'值']
	 * @return mixed 成功返回插入的id，失败则返回false
	 */
	public function insert($data){
		if ($this->db->insert($data)) {
			# 插入成功,返回最后插入的记录id
			return $this->getInsertId();
		} else {
			# 插入失败，返回false
			return false;
		}
		
	}

	/**
	 * 自动更新记录
	 * @access public
	 * @param $list array 需要更新的关联数组
	 * @return mixed 成功返回受影响的记录行数，失败返回false
	 */
	public function update($data,$condition){
		if ($rows = $this->db->update($data,$condition)) {
			# 成功，并判断受影响的记录数
				# 有受影响的记录数
				return $rows;
		} else {
			# 没有受影响的记录数，没有更新操作
			return false;
		}	
	}

	/**
	 * 自动删除
	 * @access public
	 * @param $pk mixed 可以为一个整型，也可以为数组
	 * @return mixed 成功返回删除的记录数，失败则返回false
	 */
	public function delete($condition=null){
		if ($rows = $this->db->delete($condition)) {
			# 成功，并判断受影响的记录数
			# 有受影响的记录
			return $rows;
		} else {
			# 没有受影响的记录
			return false;
		}		
	}

	/**  设置查询操作返回的数组类型 可选值:MYSQLI_ASSOC,MYSQLI_BOTH,MYSQLI_NUM
	 *默认为MYSQLI_ASSOC
     * @param $mode
     */
    public function setFetchmode($mode){
        $this->db->setFetchmode($mode);
    }

	/**
	 * 获取总的记录数
	 * @param array $config 字段名及查询条件，如['column'=>['name','id'],'where'=>'','group by'=>'','having'=>'','order by'=>'','limit'=>'']
	 * 不填默认查询所有数据
	 * @return number 返回查询的记录数
	 */
	public function total($config=[]){
		return $this->db->fetchNum($config);
	}

	/**
	 * 获取所有记录
	* @param array $config 字段名及查询条件，如['column'=>['name','id'],'where'=>'','group by'=>'','having'=>'','order by'=>'','limit'=>'']
	 * 不填默认查询所有数据
	 * @return array 返回所有记录组成的二维数组
	 */
	public function getAll($config=[]){
		return ($this->db->fetchAll($config));
	}

	/**
	 * 获取一条记录
	* @param array $config 字段名及查询条件，如['column'=>['name','id'],'where'=>'','group by'=>'','having'=>'','order by'=>'','limit'=>'']
	 * 不填默认查询所有数据
	 * @return array 返回查询到的一维数组
	 */
	public function getRow($config=[]){
		return $this->db->fetchRow($config);
	}

	/**
	 * 获取某一列的值
	* @param array $config 字段名及查询条件，如['column'=>['name','id'],'where'=>'','group by'=>'','having'=>'','order by'=>'','limit'=>'']
	 * 不填默认查询所有数据
	 * @return array 返回由该列的值构成的一维数组
	 */
	public function getCol($config=[]){
		return $this->db->getCol($config);
	}

	/**
	 * 获取上一步insert操作产生的id
	 */
	public function getInsertId(){
		return $this->db->getInsertId();
	}

	/**
	 * 获取错误号
	 * @access private
	 * @return 错误号
	 */
	public function errno(){
		return $this->db->errno();
	}

	/**
	 * 获取错误信息
	 * @access private
	 * @return 错误private信息
	 */
	public function error(){
		return $this->db->error();
	}
}