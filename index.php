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
		header("refresh: 0; url = index.php");

	}
}


?>


<!DOCTYPE html>
<html>
<head>
	<title>秒杀系统</title>
</head>
<body>

<div style="width:500px; min-height: 300px; margin:100px auto;">

<form method="POST">
	
<h2>秒杀系统-v1</h2>
	<table>
		<tr>
			<td>商品名:</td>
			<td><?php echo $goods ['goods_name'];?></td>
		</tr>
		<tr>
			<td>库存:</td>
			<td><?php echo $goods ['goods_stock'];?></td>
		</tr>
		<tr>
			<td>操作:</td>
			<td> <input type="submit" name="seckill" value="提交" /> </td>
		</tr>

	</table>
</form>	
</div>

</body>
</html>

