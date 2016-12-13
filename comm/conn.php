<?php 
/*
公共的数据库连接
 */
// 第1步：连接数据库
$res = mysql_connect(DB_HOST, DB_USER, DB_PASS);
mysql_select_db(DB_NAME);

// 第2步：判断数据库的连接，假如连接失败，退出程序
if(!$res)
{
	die("数据库连接失败".mysql_error());
}

// 第3步：设置字符集
mysql_set_charset("utf8", $res);
?>