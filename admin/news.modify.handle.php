<?php
header("Content-Type:text/html; charset=utf-8");
require_once("../comm/config.php"); 
require_once("../comm/conn.php"); 
/*
文章内容的修改程序
 */

// var_dump($_POST);die;

$sub = isset($_POST['sub']) ? $_POST['sub'] : FALSE;

/*
1、获取数据
2、判断非法数据
3、数据库的添加

 */

if($sub)
{
	// 获取数据
	$title = isset($_POST['title']) ? $_POST['title'] : "";
	$author = isset($_POST['author']) ? $_POST['author'] : "";
	$description = isset($_POST['description']) ? $_POST['description'] : "";
	$content = isset($_POST['content']) ? $_POST['content'] : "";
	$status = isset($_POST['content']) ? $_POST['content'] : "";
	$id = isset($_POST['id']) ? $_POST['id'] : "";
	$addtime = time();

	// 非法值的判断：判断文章的标题不能为空
	if(strlen(trim($title))==0)
	{
		echo "<script>alert('文章标题不能为空'); window.location = './news.add.php'</script>";
		die;
	}

	// 准备修改的SQL语句
	$sql = "UPDATE news SET title = '{$title}', author = '{$author}', description = '{$description}', content = '{$content}', status = '{$status}', addtime = '{$addtime}' WHERE id = {$id}";
	// echo $sql;
	// die;

	// 发送SQL语句
	$result = mysql_query($sql, $res);

	// 执行结果
	if($result && mysql_affected_rows($res))
	{
		// 执行成功
		echo "<script>alert('修改成功'); window.location = './news.list.php'</script>";
		die;
	} else{
		echo "<script>alert('修改失败'); window.location = './news.add.php'</script>";
	}

	// 关闭连接
	mysql_close($res);
} else{
	die("非法操作");
}





?>