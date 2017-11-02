<?php 
require_once '../include.php';
checkLogined();
$rows=getAllCate();
if(!$rows){
	alertMes("没有相应分类，请先添加分类!!", "addCate.php");
}
$sql="select * from imooc_term order by id asc";
$rows_term=fetchAll($sql);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>-.-</title>
<link href="./styles/global.css"  rel="stylesheet"  type="text/css" media="all" />
<!--<script type="text/javascript" charset="utf-8" src="../plugins/kindeditor/kindeditor.js"></script>-->
<!--<script type="text/javascript" charset="utf-8" src="../plugins/kindeditor/lang/zh_CN.js"></script>-->
<script type="text/javascript" src="./scripts/jquery-1.6.4.js"></script>
</head>
<body>
<h3>添加商品</h3>
<form action="doAdminAction.php?act=addPro" method="post" enctype="multipart/form-data">
<table width="70%"  border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
	<tr>
		<td align="right" colspan="2">商品名称</td>
		<td colspan="2"><input type="text" name="pName"  placeholder="请输入商品名称"/></td>
	</tr>
	<tr>
		<td align="right" colspan="2">商品分类</td>
		<td colspan="2">
		<select name="cId">
			<?php foreach($rows as $row):?>
				<option value="<?php echo $row['id'];?>"><?php echo $row['cName'];?></option>
			<?php endforeach;?>
		</select>
		</td>
	</tr>
	<tr>
		<td align="right" colspan="2">商品基础价</td>
		<td colspan="2"><input type="text" name="iPrice"  placeholder="请输入商品基础价"/></td>
	</tr>
	<?php  foreach($rows_term as $row):?>	
	<tr>
		<td colspan="4" style="color:rgb(216, 72, 72)"><?php echo $row['term']?></td>
	</tr>
	<tr rowspan="1">
		<td align="center" colspan="1"><?php echo $row['selection_one']?></td>
		<td align="center" colspan="1"><?php echo $row['selection_two']?></td>
		<td align="center" colspan="1"><?php echo $row['selection_three']?></td>
		<td align="center" colspan="1"><?php echo $row['selection_four']?></td>
	</tr>
	<tr rowspan="1">
		<td align="center" colspan="1"><input type="text" name="<?php echo $row['id'].'_1'?>" placeholder="请输入减去价格" /></td>
		<td align="center" colspan="1"><input type="text" name="<?php echo $row['id'].'_2'?>" placeholder="请输入减去价格" /></td>
		<td align="center" colspan="1">
			<?php if(!empty($row['selection_three'])):?>
			<input type="text" name="<?php echo $row['id'].'_3'?>" placeholder="请输入减去价格" />
			<?php endif?>
		</td>
		<td align="center" colspan="1">
			<?php if(!empty($row['selection_four'])):?>
			<input type="text" name="<?php echo $row['id'].'_4'?>" placeholder="请输入减去价格" />
			<?php endif?>
		</td>
	</tr>
	<?php endforeach?>
	<tr>
		<td colspan="4"><input type="submit"  value="发布商品"/></td>
	</tr>
</table>
</form>
</body>
</html>