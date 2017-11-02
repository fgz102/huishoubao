<?php 
require_once '../include.php';
checkLogined();
$rows=getAllCate();
if(!$rows){
	alertMes("没有相应分类，请先添加分类!!", "addCate.php");
}
$id=$_REQUEST['id'];
$proInfo=getProById($id);
$sql="select * from imooc_term order by id asc";
$rows_term=fetchAll($sql);
$sql_config="select * from imooc_config where p_id={$id} order by term_id asc";
$configInfo=fetchAll($sql_config);
//print_r($proInfo);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>-.-</title>
<link href="./styles/global.css"  rel="stylesheet"  type="text/css" media="all" />
<script type="text/javascript" charset="utf-8" src="../plugins/kindeditor/kindeditor.js"></script>
<script type="text/javascript" charset="utf-8" src="../plugins/kindeditor/lang/zh_CN.js"></script>
<script type="text/javascript" src="./scripts/jquery-1.6.4.js"></script>
<script>
        KindEditor.ready(function(K) {
                window.editor = K.create('#editor_id');
        });
        $(document).ready(function(){
        	$("#selectFileBtn").click(function(){
        		$fileField = $('<input type="file" name="thumbs[]"/>');
        		$fileField.hide();
        		$("#attachList").append($fileField);
        		$fileField.trigger("click");
        		$fileField.change(function(){
        		$path = $(this).val();
        		$filename = $path.substring($path.lastIndexOf("\\")+1);
        		$attachItem = $('<div class="attachItem"><div class="left">a.gif</div><div class="right"><a href="#" title="删除附件">删除</a></div></div>');
        		$attachItem.find(".left").html($filename);
        		$("#attachList").append($attachItem);		
        		});
        	});
        	$("#attachList>.attachItem").find('a').live('click',function(obj,i){
        		$(this).parents('.attachItem').prev('input').remove();
        		$(this).parents('.attachItem').remove();
        	});
        });
</script>
</head>
<body>
<h3>编辑商品</h3>
<form action="doAdminAction.php?act=editPro&id=<?php echo $id;?>" method="post" enctype="multipart/form-data">
<table width="70%"  border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
	<tr>
		<td align="right">商品名称</td>
		<td><input type="text" name="pName"  value="<?php echo $proInfo['pName'];?>"/></td>
	</tr>
	<tr>
		<td align="right">商品分类</td>
		<td>
		<select name="cId">
			<?php foreach($rows as $row):?>
				<option value="<?php echo $row['id'];?>" <?php echo $row['id']==$proInfo['cId']?"selected='selected'":null;?>><?php echo $row['cName'];?></option>
			<?php endforeach;?>
		</select>
		</td>
	</tr>


	<tr>
		<td align="right">最高价</td>
		<td><input type="text" name="iPrice"  value="<?php echo $proInfo['iPrice'];?>"/></td>
	</tr>

	<?php  $i=0;foreach($rows_term as $row):?>	
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
		<td align="center" colspan="1"><input type="text" name="<?php echo $row['id'].'_1'?>" placeholder="请输入减去价格" value="<?php  echo $configInfo[$i]['selection_one']; ?>"/></td>
		<td align="center" colspan="1"><input type="text" name="<?php echo $row['id'].'_2'?>" placeholder="请输入减去价格" value="<?php  echo $configInfo[$i]['selection_two']; ?>"/></td>
		<td align="center" colspan="1">
			<?php if(!empty($row['selection_three'])):?>
			<input type="text" name="<?php echo $row['id'].'_3'?>" placeholder="请输入减去价格" value="<?php  echo $configInfo[$i]['selection_three']; ?>"/>
			<?php endif?>
		</td>
		<td align="center" colspan="1">
			<?php if(!empty($row['selection_four'])):?>
			<input type="text" name="<?php echo $row['id'].'_4'?>" placeholder="请输入减去价格" value="<?php  echo $configInfo[$i]['selection_four']; ?>"/>
			<?php endif?>
		</td>
	</tr>
	<?php $i++;endforeach?>
	<tr>
		<td colspan="2"><input type="submit"  value="编辑商品"/></td>
	</tr>
</table>
</form>
</body>
</html>