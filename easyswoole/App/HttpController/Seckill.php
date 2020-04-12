<?php


namespace App\HttpController;

use EasySwoole\Http\AbstractInterface\Controller;
use EasySwoole\Http\Message\Status;

use App\Model\BaseModel;

class Seckill extends Controller
{
	public function index()
	{
		//TODO::界面


		$model = new BaseModel;
		$client = $model->mysqli();
	    //构建sql
	    $client->queryBuilder()->get('goods');
	    //执行sql
	    $data = $client->execBuilder();
	    $this->writeJson(Status::CODE_OK, $data, 'success');
	}

	public function grab()
	{
		// $id = (int)$this->input('id', 1);

		$id = $this->request()->getRequestParam('id');

		$model = new BaseModel;
		$client = $model->mysqli();
	    //构建sql
	    $client->queryBuilder()->where('id', $id)->getOne('goods');
	    $goods = $client->execBuilder();
	    if(empty($goods)) {
	    	$this->writeJson(4000, null, '商品不存在');
	    	return false;
	    }

	    if(isset($goods ['0']['goods_stock']) && $goods ['0']['goods_stock'] > 0) {
			$client->queryBuilder()
			    ->where('id', $id)
			    ->update('goods', [
			        'goods_stock'    => \EasySwoole\Mysqli\QueryBuilder::dec(1),
			    ]);
			$client->execBuilder();
			$this->writeJson(Status::CODE_OK, null, '秒杀KO');
	    } else {
			$this->writeJson(4000, null, '商品已被抢完啦~~~');
	    }


	}

}