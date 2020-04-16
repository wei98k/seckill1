<?php
/**
* pdo
*/
class db
{
	public $dbHost;
	public $dbName;
	public $dbUser;
	public $dbPawd;

	private $conn; // 连接对象

	function __construct($config)
	{
		if(empty($config)) {
			// 抛出异常
			return false;
		}

		$this->dbHost = $config ['db_host'];
		$this->dbName = $config ['db_name'];
		$this->dbUser = $config ['db_user'];
		$this->dbPawd = $config ['db_pawd'];

		$this->conn();
	}

	private function conn()
	{
		$this->conn = new PDO("mysql:host={$this->dbHost};dbname={$this->dbName}", $this->dbUser, $this->dbPawd);
	}



	public function save($id, $stock)
	{
		return $this->conn->exec("update goods set goods_stock = {$stock} where id = {$id}");
	}

	public function add()
	{

	}

	public function delete()
	{

	}

	public function findOne($id)
	{
	
		$sth = $this->conn->prepare('SELECT * FROM goods WHERE id = :id for update');
		$sth->bindParam(':id', $id, PDO::PARAM_INT);
		$sth->execute();
		return $sth->fetch(PDO::FETCH_ASSOC);
	}

	public function select()
	{

	}

	public function seckill($goodsId)
	{

	}
}