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
			$str = "<a href='#' style='color: red;'>不显示</a>";
			break;

		case 1:
			$str = "<a href='#' style='color: green;'>显示</a>";
			break;

		default:
			$str = "非法值";
	}

	return $str;
}

/**
 * 翻页的函数
 * @param  [type] $pageNums  [description]
 * @param  [type] $pageCount [description]
 * @return [type]            [description]
 */
function createPage($pageNums, $pageCount)
{
	$url = $_SERVER['PHP_SELF'];
	// 获取当前页
	$p = isset($_GET['p']) ? $_GET['p'] : 1;

	if($p < 1)
	{
		$p = 1;
	}
	elseif($p > $pageCount)
	{
		$p = $pageCount;
	}

	$str = '<div class="page_nav">';
	$str .= '<a href="'.$url.'?p=1">首页</a>';
	$str .= '<a href="'.$url.'?p='.($p-1).'">上一页</a>';
	for($i=1; $i<=$pageNums; $i++)
	{
		$str .= "<a href='".$_SERVER['PHP_SELF']."?p={$i}'>{$i}</a>";
	}

	$str .= '<a href="'.$url.'?p='.($p+1).'">下一页</a>';
	$str .= '<a href="'.$url.'?p='.$pageCount.'">末页</a></div>';

	return $str;
}


?>