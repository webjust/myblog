<?php 

/**
 * 通过文章的状态值，输出它的状态
 * @param  [type] $status [文章的状态值]
 * @return [type]         [输出中文的文章状态]
 */
function getStatus($status)
{
	$str = "";

	switch ($status)
	{
		case 0:
			$str = "不显示";
			break;

		case 1:
			$str = "显示";
			break;

		default:
			$str = "非法值";
	}

	return $str;
}

/**
 * 翻页的函数：输出翻页的按钮
 * @param  [type] $pageNums  [description]
 * @param  [type] $pageCount [description]
 * @return [type]            [description]
 */
function createPage($pageNums)
{
	$url = $_SERVER['PHP_SELF'];
	
	// 获取当前页码
	$p = isset($_GET['p']) ? $_GET['p'] : 1;

	// 非法的页码数
	if($p < 1)
	{
		$p = 1;
	}
	elseif($p > $pageNums)
	{
		$p = $pageNums;
	}

	$str = '<div class="page_nav">';
	$str .= '<a href="'.$url.'?p=1">首页</a>';
	$str .= '<a href="'.$url.'?p='.($p-1).'">上一页</a>';
	
	// 输出页码 1 2 3
	for($i=1; $i<=$pageNums; $i++)
	{
		// 声明一个标识，当当前页码数和$i相等
		$biaozhi = ($p == $i) ? "class='active'" : "";
		$str .= "<a ".$biaozhi." href='".$_SERVER['PHP_SELF']."?p={$i}'>{$i}</a>";
	}

	$str .= '<a href="'.$url.'?p='.($p+1).'">下一页</a>';
	$str .= '<a href="'.$url.'?p='.$pageNums.'">末页</a></div>';

	return $str;
}

/**
 * 判断用户是否登录，未登录就跳转到登录页
 * @return [type] [description]
 */
function getLoginStatus()
{
	// 初始化
	session_start();

	$islogin = isset($_SESSION['islogin']) ? $_SESSION['islogin'] : 0;

	// 判断用户是否已经登录，未登录就跳转到登录页
	if(!$islogin)
	{
		echo "您还未登录，3秒后跳转到登录页";
		echo '<meta http-equiv="Refresh" content="3; url=./login.php" />';
		die;
	}
}


?>