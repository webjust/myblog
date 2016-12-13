<?php 
// 引入头部的公共文件
require_once("./comm/a_header.php");
?>

<div id="page-wrapper">
<div id="page-inner">


<div class="row">
<div class="col-md-12">
	<h1 class="page-header">
		文章添加
	</h1>
</div>
</div>
<!-- /. ROW  -->


<!-- 内容主体开始 -->
<div class="row">
	<div class="col-md-12">
		<!-- 文章提交表单开始 -->
		<form action="./news.add.handle.php" method="POST">
			<table class="table">
				<tr>
					<td width="10%">
						<div class="form-group">
							<label>文章标题</label>
						</div>
					</td>
					<td><div class="form-group">
						<input type="text" name="title" class="form-control" placeholder="输入文章标题" style="width: 500px;" />
					</div></td>
				</tr>
				<tr>
					<td width="10%">
						<div class="form-group">
							<label>文章作者</label>
						</div>
					</td>
					<td><div class="form-group">
						<input type="text" name="author" class="form-control" placeholder="作者名" style="width: 100px;" />
					</div></td>
				</tr>
				<tr>
					<td width="10%">
						<div class="form-group">
							<label>短描述</label>
						</div>
					</td>
					<td><div class="form-group">
						<textarea name="description" cols="100" rows="3"></textarea>
					</div></td>
				</tr>
				<tr>
					<td width="10%">
						<div class="form-group">
							<label>文章内容</label>
						</div>
					</td>
					<td><div class="form-group">
						<textarea name="content" cols="100" rows="10"></textarea>
					</div></td>
				</tr>
				<tr>
					<td></td>
					<td>
						<input type="submit" name="sub" class="btn btn-primary btn-sm">
					</td>
				</tr>			
			</table>
		</form>
		<!-- 文章提交表单结束 -->
	</div>
</div>
<!-- 内容结束 -->


<?php require_once("./comm/a_footer.php"); ?>