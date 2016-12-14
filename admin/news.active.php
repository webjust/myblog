<?php
header("Content-Type: text/html; charset=utf-8");
require_once("../comm/config.php");
require_once("../comm/conn.php");

/*
修改文章的状态
 */

// 获取GET传输过来的参数
$action = isset($_GET['a']) ? $_GET['a'] : "";
$id = isset($_GET['id']) ? $_GET['id'] : "";
$status = isset($_GET['status']) ? $_GET['status'] : "";

// 修改状态值$status
if($action == "status")
{
	// 当$GET['a']值为status的时候，就执行修改程序
	$status += 1;    
	$status %= 2;

	/*
		1	0
		2	1
		0	1
	 */
	
	// 准备SQL语句
	$sql = "UPDATE news SET status = {$status} WHERE id = {$id}";

	// 执行SQL语句
	$result = mysql_query($sql, $res);

	// 判断执行的结果
	if($result)
	{
		echo "执行成功，3秒后跳转到文章管理列表页面";
		echo '<meta http-equiv="Refresh" content="3; url=./news.list.php" />';
		die;
	} else{
		echo "修改失败";
		echo '<meta http-equiv="Refresh" content="3; url=./news.list.php" />';
		die;
	}

	// 关闭连接
	mysql_close($res);
}


?>