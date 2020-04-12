<?php

namespace App\Model;
use EasySwoole\Mysqli\QueryBuilder;

class BaseModel {

	public function mysqli()
	{

		$config = new \EasySwoole\Mysqli\Config([
		    'host'          => 'mysql',
		    'port'          => 3306,
		    'user'          => 'root',
		    'password'      => 'root',
		    'database'      => 'seckill',
		    'timeout'       => 5,
		    'charset'       => 'utf8mb4',
		]);
		return new \EasySwoole\Mysqli\Client($config);
	}

}