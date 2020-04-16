<?php

ini_set('display_errors', '1');
include('./config.php');
require('./db.php');

//::TODO 读取产品和库存

$db = new db($dbConfig);
$goods = $db->findOne(1);

//::TODO 点击减少库存

if($goods ['goods_stock'] <= 0) {
	echo '<h1>商品已被抢空~~~</h1>';
} else {
	if(isset($_POST['seckill'])) {
		$db->save($goods ['id'], $goods ['goods_stock'] -1);
		echo json_encode(array('code' => 1, 'msg' => 'ok', 'result' => null));
	}
}