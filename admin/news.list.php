<?php 
// 引入头部的公共文件
require_once("./comm/a_header.php");
require_once("../comm/config.php");
require_once("../comm/conn.php");
require_once("../comm/func.php");

// 获取当前页码
$p = isset($_GET['p']) ? $_GET['p'] : 1;

/*
分页代码：

声明每页显示多少条  5条
总页数：            (总条数/每页显示的条数) 小数进1

首页 上一页 1 2 3 4 5 下一页 末尾

SELECT * FROM news LIMIT 0, 2
SELECT * FROM news LIMIT 2, 2

第一页 1  LIMIT 0, 2            (1-1)*2
第二页 2  LIMIT 2, 2            (2-1)*2

2		2
3       4


偏移量 = (当前页码数-1)*每页的条数

 */

// 每页显示的条数
$page_num = 2;

// 计算总页数
$sql = "SELECT COUNT(*) FROM news";
$result = mysql_query($sql, $res);
$count = mysql_fetch_row($result);
// 总条数
$counts = $count[0];
// 总页数
$page_nums = ceil($counts / $page_num);

// 翻页的判断
if($p == 0)
{
	$p = 1;
}
elseif($p > $page_nums)
{
	$p = $page_nums;
}

// 偏移量
$offset = ($p-1) * $page_num;


// die;

// 声明一个变量存储提示的信息
$msg = "";

// 数据库的读取操作：天龙八步

// 第4步：准备SQL
$sql = "SELECT * FROM news ORDER BY id DESC LIMIT {$offset}, {$page_num}";

// 第5步：发送SQL语句
$result = mysql_query($sql, $res);

// 第6步：处理结果集
$news = array();

if($result)
{
	// 处理结果集
	while($list = mysql_fetch_assoc($result))
	{
		// 把每次读取的结果放在空数组中
		$news[] = $list;
	}
} else
{
	$msg = "当前数据库没有记录";
}

// var_dump($news);

// 第7步：释放结果集
mysql_free_result($result);

// 第8步：关闭数据库连接
mysql_close($res);

?>

<div id="page-wrapper">
<div id="page-inner">


<div class="row">
<div class="col-md-12">
	<h1 class="page-header">
		文章列表
	</h1>
</div>
</div>
<!-- /. ROW  -->


<!-- 内容主体开始 -->
<div class="row">
	<div class="col-md-12 page-news-btn">
		<a href="news.add.php" class="btn btn-success btn-sm">添加文章</a>
	</div>
	<div class="col-md-12">
		<table class="table table-striped">
			<tr>
				<th>ID</th>
				<th>文章标题</th>
				<th>作者</th>
				<th>状态</th>
				<th>时间</th>
				<th>操作</th>
			</tr>
			
			<?php foreach($news as $list): ?>
			<tr>
				<td><?php echo $list['id'] ?></td>
				<td><?php echo $list['title'] ?></td>
				<td><?php echo $list['author'] ?></td>
				<td><?php echo getStatus($list['status']); ?></td>
				<td><?php echo date("Y-m-d H:i:s", $list['addtime']); ?></td>
				<td>
					<a href="./news.del.php?id=<?php echo $list['id'] ?>" class="btn btn-danger btn-sm">删除</a>
					<a href="./news.modify.php?id=<?php echo $list['id'] ?>" class="btn btn-primary btn-sm">编辑</a>
				</td>
			</tr>
		<?php endforeach; ?>
		<tr>
			<td colspan="6" align="center">
				<?php echo createPage($page_num, $page_nums); ?>
			</td>
		</tr>
		</table>
	</div>
</div>
<!-- 内容结束 -->


<?php require_once("./comm/a_footer.php"); ?>