<?php
header("Content-Type:text/html; charset=utf-8");
require_once("../comm/config.php");
require_once("../comm/conn.php");
require_once("../comm/func.php");
getLoginStatus();

/*
删除操作：
 */

$id = isset($_GET['id']) ? $_GET['id'] : FALSE;

if($id)
{
	// 准备SQL语句
	$sql = "DELETE FROM news WHERE id = {$id}";

	// 发送SQL
	$result = mysql_query($sql, $res);

	// 受影响行
	$affected_nums = mysql_affected_rows($res);	//0

	if($result && $affected_nums){
		// 执行成功
		echo "<script>alert('删除成功'); window.location = './news.list.php'</script>";
		die;
	} else{
		echo "<script>alert('删除失败'); window.location = './news.list.php'</script>";
		die;
	}

	// 关闭连接
	mysql_close($res);
}

?>