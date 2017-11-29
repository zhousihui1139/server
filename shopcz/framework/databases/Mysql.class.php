<?php

class Mysql{
	protected $link = false;  //数据库连接资源
	protected $fetchmode=MYSQLI_ASSOC ;    //设置 返回数组类型
	protected $table;           //表名
    protected $sql=null;
	
	/**
	 * 构造函数，负责连接服务器、选择数据库、设置字符集等
	 * @param $config string 配置数组
	 */
	public function __construct($config = array()){
		$host = isset($config['host'])? $config['host'] : 'localhost';
		$user = isset($config['user'])? $config['user'] : 'root';
		$password = isset($config['password'])? $config['password'] : 'root';
		$dbname = isset($config['dbname'])? $config['dbname'] : '';
		$port = isset($config['port'])? $config['port'] : '3306';
		$charset = isset($config['charset'])? $config['charset'] : 'utf8';
		$this->link = mysqli_connect($host,$user,$password,$dbname,$port) or die('数据库连接错误');

		$table = isset($config['table'])? $config['table'] : die('请输入数据库表');
		$this->table = $table;
		$this->setChar($charset);  //设置字符集
	}


	/**
	 * 设置字符集
	 * @access private
	 * @param $charset string 字符集
	 */
	private function setChar($charest){
		$sql = 'set names '.$charest;
		$this->query($sql);
	}

	/** 增
     * @param $data
     * @return bool|\mysqli_result
     */
    public function insert($data){
        try {
            if (!is_array($data)) {
                throw new \Exception("字段名及值请用形如\"['字段名'=>'值']\"的数组输入");
            }
        } catch (\Exception $e) {
            echo $e->getMessage() . ' ' . $e->getFile() . ' line ' . $e->getLine();
            exit;
        }
        foreach ($data as $k => $v) {
            $data[$k] = is_string($v)?'\''.$v.'\'':$v;
        }
        $keys = array_keys($data);
        $column = implode(',',$keys);

        $values = array_values($data);
        $value = implode(',',$values);

        $table = $this->table;
        $query = "insert into $table($column) value($value)";
        $bool = $this->query($query);
        return $bool;
    }

    /**  删
     * @param null $condition
     * @return bool|int
     */
    public function delete($condition){
        if(is_null($condition)){
            echo '此操作将删除表所有数据!!!本函数不支持此操作';
            exit;
        }
        $condition = ' where '.$condition;
        $table = $this->table;
        $query = "delete from $table".$condition;
        $this->query($query);
        $rows = mysqli_affected_rows($this->link);
        if($rows>0){
            return $rows;
        }else{
            return false;
        }
    }

    /**  改
     * @param $data
     * @param $condition
     * @return bool|int
     */
    public function update($data,$condition){
        $re_data = [];
        try {
            if (!is_array($data)) {
                throw new \Exception("字段名及值(第二个参数)请用形如\"['字段名'=>'值']\"的数组输入");
            }
        } catch (\Exception $e) {
            echo $e->getMessage() . ' ' . $e->getFile() . ' line ' . $e->getLine();
            exit;
        }
        foreach($data as $key=>$val){
            $val = is_string($val)?'\''.$val.'\'':$val;
            $re_data[]="`$key`=$val";
        }
        $data = implode(',',$re_data);
        $table = $this->table;
        if(is_null($condition) || empty($condition)){
            die ('请输入更新数据的限定条件');
        }else{
            $condition = ' where '.$condition;
        }
        $query = "UPDATE $table SET $data".$condition;
        $this->query($query);
        $rows = mysqli_affected_rows($this->link);
        if($rows>0){
            return $rows;
        }else{
            return false;
        }
    }

    /**  设置 查询操作 返回的数组类型
     * @param $mode
     */
    public function setFetchmode($mode){
        if($mode!=MYSQLI_ASSOC && $mode!=MYSQLI_BOTH && $mode!=MYSQLI_NUM){
            $mode = MYSQLI_NUM;
        }
        $this->fetchmode = $mode;
    }


    /**
     * [自定义sql语句]
     * @param [string] $sql [自定义sql语句,用于联表操作]
     */
    public function setSql($sql)
    {
        $this->sql = $sql;
    }

    /**
     * 执行sql语句
     * @access public
     * @param $sql string 查询sql语句
     * @return $result，成功返回资源，失败则输出错误信息，并退出
     */
    public function query($query){
        //sql日志功能
        if($GLOBALS['config']['debug']){
            $str ="[" . date("Y-m-d H-i-s") . "]" . $query . PHP_EOL;
            file_put_contents('log.text',$str,FILE_APPEND);
        }
        //执行sql语句
        $result = mysqli_query($this->link,$query);
        //设置报错
        if (! $result) {
            die($this->errno().':'.$this->error().'<br />出错语句为'.$query.'<br />');
        }
        //初始化自定义sql语句
        $this->sql = null;
        return $result;
    }

   /**拼接 查询 SQL语句
     * [buildQuery description]
     * @param  [array] $config [description]
     * @return [type]         [description]
     */
    private function buildQuery($config){
        $table = $this->table;
        $query = '';
        if(!isset($config['column']) || empty($config['column'])){
            $query .= "SELECT * FROM ".$table;
        }else {
            try {
                if (!is_array($config['column'])) {
                    throw new \Exception("字段名参数请用(['column'=>[]])数组输入");
                }
            } catch (\Exception $e) {
                echo $e->getMessage() . ' ' . $e->getFile() . ' line ' . $e->getLine();
                exit;
            }
            $query .= "SELECT ".implode(',',$config['column'])." FROM ".$table;
        }
        $condition = ['where','group by','having','order by','limit'];
        
        foreach($condition as $val){
            if(isset($config[$val]) && !empty($config[$val])){
                $query .= " $val ".$config[$val];
            }
        }
        return $query;
    }

    /** 获取所有记录
     * @param $table
     * @param array $config
     * @return array|null
     */
    public function fetchAll($config=[])
    {
        $table = $this->table;
        //若有自定义sql语句传入,则使用;若没有,则前往拼装sql
        $query = is_null($this->sql)?$this->buildQuery($config):$this->sql;
        $result = $this->query($query);
        $arr = mysqli_fetch_all($result,$this->fetchmode);
        return $arr;
    }

    /** 获取一行记录
     * @param array $config
     * @return array|null
     */
    public function fetchRow($config=[])
    {
        $table = $this->table;
        $query = is_null($this->sql)?$this->buildQuery($config):$this->sql;
        $result = $this->query($query);
        $arr = mysqli_fetch_array($result,$this->fetchmode);
        return $arr;
    }

    /**获取记录条数
     * @param array $config
     * @return array|null
     */
    public function fetchNum($config=[])
    {
        $table = $this->table;
        $query = is_null($this->sql)?$this->buildQuery($config):$this->sql;
        $result = $this->query($query);
        $num = mysqli_num_rows($result);
        return $num;
    }

	/**
	 * 获取某一列的记录
	 * @access public
	 * @param $sql string 执行的sql语句
	 * @return $list array 返回由该列的值构成的一维数组
	 */
	public function getCol($config=[]){
		$table = $this->table;
        $query = is_null($this->sql)?$this->buildQuery($config):$this->sql;
        $result = $this->query($query);
        $arr = mysqli_fetch_all($result,$this->fetchmode);
		foreach ($arr as $row) {
		 	$list[] = $row[0];
		 } 
		return $list;
	}

	/**
	 * 获取上一步insert操作产生的id
	 */
	public function getInsertId(){
		return mysqli_insert_id($this->link);
	}

	/**
	 * 获取错误号
	 * @access private
	 * @return 错误号
	 */
	public function errno(){
		return mysqli_errno($this->link);
	}

	/**
	 * 获取错误信息
	 * @access private
	 * @return 错误private信息
	 */
	public function error(){
		return mysqli_error($this->link);
	}
}