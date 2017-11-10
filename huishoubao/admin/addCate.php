<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>添加分类</title>
<link href="./styles/global.css"  rel="stylesheet"  type="text/css" media="all" />
<script type="text/javascript" charset="utf-8" src="../plugins/kindeditor/kindeditor.js"></script>
<script type="text/javascript" charset="utf-8" src="../plugins/kindeditor/lang/zh_CN.js"></script>
<script type="text/javascript" src="./scripts/jquery-1.6.4.js"></script>
<script type="text/javascript">
		//添加商品编辑器
        KindEditor.ready(function(K) {
                window.editor = K.create('#editor_id');
        });
        //添加商品附件按钮及事件
        $(document).ready(function(){
        	$("#selectFileBtn_icon").click(function(){
        		$fileField_icon = $('<input type="file" name="thumbs_icon[]"/>');
        		$fileField_icon.hide();
        		$("#attachList_icon").append($fileField_icon);
        		$fileField_icon.trigger("click");
        		$fileField_icon.change(function(){
	        		$path_icon = $(this).val();
	        		$filename_icon = $path_icon.substring($path_icon.lastIndexOf("\\")+1);
	        		$attachItem_icon = $('<div class="attachItem"><div class="left">a.gif</div><div class="right"><a href="javascript:void(0)" title="删除附件">删除</a></div></div>');
	        		$attachItem_icon.find(".left").html($filename_icon);
	        		$("#attachList_icon").append($attachItem_icon);		
        		});
        	});
        	$("#attachList_icon>.attachItem").find('a').live('click',function(obj,i){
        		$(this).parents('.attachItem').prev('input').remove();
        		$(this).parents('.attachItem').remove();
        	});
        	$("#selectFileBtn_baojia").click(function(){
        		$fileField_baojia = $('<input type="file" name="thumbs_baojia[]"/>');
        		$fileField_baojia.hide();
        		$("#attachList_baojia").append($fileField_baojia);
        		$fileField_baojia.trigger("click");
        		$fileField_baojia.change(function(){
        		$path_baojia = $(this).val();
        		$filename_baojia = $path_baojia.substring($path_baojia.lastIndexOf("\\")+1);
        		$attachItem_baojia = $('<div class="attachItem"><div class="left">a.gif</div><div class="right"><a href="javascript:void(0)" title="删除附件">删除</a></div></div>');
        		$attachItem_baojia.find(".left").html($filename_baojia);
        		$("#attachList_baojia").append($attachItem_baojia);		
        		});
        	});
        	$("#attachList_baojia>.attachItem").find('a').live('click',function(obj,i){
        		$(this).parents('.attachItem').prev('input').remove();
        		$(this).parents('.attachItem').remove();
        	});
        });	
</script>
</head>
<body>
<h3>添加分类</h3>
<form action="doAdminAction.php?act=addCate" method="post">
<table width="70%" border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
	<tr>
		<td align="right">分类名称</td>
		<td><input type="text" name="cName" placeholder="请输入分类名称"/></td>
	</tr>

	<tr>
		<td align="right">商品描述</td>
		<td >
			<textarea name="pDesc" id="editor_id" style="width:100%;height:150px;"></textarea>
		</td>
	</tr>
	<tr>
		<td  align="right">商品icon图</td>
		<td >
			<a href="javascript:void(0)" id="selectFileBtn_icon" class="selectFileBtn">添加附件</a>
			<div id="attachList_icon" class="clear"></div>
		</td>
	</tr>
	<tr>
		<td align="right">商品报价图</td>
		<td >
			<a href="javascript:void(0)" id="selectFileBtn_baojia" class="selectFileBtn">添加附件</a>
			<div id="attachList_baojia" class="clear"></div>
		</td>
	</tr>
	<tr>
		<td colspan="2"><input type="submit"  value="添加分类"/></td>
	</tr>	
</table>
</form>
</body>
</html>