<?php 
require_once 'include.php';
$cates=getAllcate();
$sql = "select * from imooc_cate order by id asc";
$cates_num=getResultNum($sql); //分类条数
$result=fetchAll($sql);
//print_r($result);
$all_data=[];
foreach($result as $row){
	$sql3="select id,pName,rank from imooc_pro where cId='".$row["id"]."' order by rank asc";
	$result1=fetchAll($sql3);
	$all_data[$row['cName']]= $result1;
	//echo "$sql3<br>";
}
//print_r($all_data);
if(!($cates && is_array($cates))){
	alertMes("不好意思，网站维护中!!!", "http://www.darcat.com");
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, maximum-scale=1">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no, email=no">
	<meta name="keywords" content="手机回收,二手手机回收,手机回收报价,旧手机回收网">
	<meta name="description" content="卖二手手机,旧手机就上大咖，回收苹果三星华为等品牌手机。提供手机回收报价、二手手机价格评估|查询、上门回收手机等服务，正规的二手手机回收、回收旧手机的网站，专业估价、质检、交易流程。">
	<title>选择机型</title>
	<link rel="stylesheet" href="css/common.css">
	<link rel="stylesheet" href="css/model-new.css">
</head>
<body>
    

<script type="text/javascript">
(function (doc, win) {
    var docEl = doc.documentElement,
        resizeEvt = 'orientationchange' in window ? 'orientationchange' : 'resize',
        recalc = function () {
            var clientWidth = docEl.clientWidth;
            if (!clientWidth) return;
            if (clientWidth >= 740) {
                clientWidth = 740;
            }
            if (clientWidth <= 320) {
                clientWidth = 320;
            }
            docEl.style.fontSize = 100 * (clientWidth / 320) + 'px';
        };
    if (!doc.addEventListener) return;
    recalc();
    win.addEventListener(resizeEvt, recalc, false);
    // doc.addEventListener('DOMContentLoaded', recalc, false);
})(document, window);


var __CONFIG__ = __CONFIG__ || {};
__CONFIG__.PID = '1004';

//百度统计
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?6df4a9c99abf56f977a0c72aa019c6d2";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();


</script>

<noscript>
<h2 style="text-align: center;">为了保障正确的功能，请开启JavaScript</h2>
</noscript>	<div id="index-panel" class="select-model">
		<!-- 搜索 -->
		<div class="search-feild pd-10">
			<!--<a href="javascript:;" class="search-btn" id="search-label">
			    <img src="img/icons/logo-search.png" alt="">
			    请输入搜索内容
			</a>-->
			<div class="search-btn">手机评估</div>
		</div>

		<!-- 型号选择 -->
		<div class="select-feild">
			<div id="brand-list" class="brand-list">
			    <a class="mobile">手机</a>
			   <!-- <a href="/mobile/getModels_11.html?pid=1004&type=tablet" class="tablet">平板</a> -->
				<div id="wrapperL" class="wrapperL">
					<div id="scrollerL">
						<ul id="brand-list-wrapper" class="brand-list-wrapper js-m-brands">
						    <!--  -->
						
							<!--<li class="item" data-mid=""><span href="#content</span></li>-->
							
						</ul>
					</div>
				</div>
			</div>
			<div id="model-list"class="model-list">			
				<div id="wrapper" class="wrapper">
					<div id="scroller">	
						<ul id="model-list-wrapper" class="model-list-wrapper">

						</ul>
						<div class="circleGBox" id="spinner">
							<span class="circleG circleG_3"></span>
							<span class="circleG circleG_2"></span>
							<span class="circleG circleG_1"></span>
						</div>
						<div class="search-end" id="spinnerEnd">o(∩_∩)o~ 已经看到最后了哦</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="js/jquery.min.js"></script>
	<script>
	//获取左边列表元素
	var controls = document.getElementById("brand-list-wrapper");
	//获取右边列表元素
	var contents = document.getElementById("segmentedControlContents");
	var html2=[];
	var html=[];
	var i = 1;
	var	m = <?php echo $cates_num?>;   //左侧选项卡数量 
	var	t = <?php echo json_encode($all_data)?>;
	
	//同类型所有记录条数
	
	console.log(t);
　　		for(var key in t){	
			//根据key来创建左边的分类
			html2.push('<li class="item"><a>'+ key +'</a></li>');
			console.log(key);
　　		}
	controls.innerHTML = html2.join('');
//	contents.innerHTML = html.join('');
	//默认选中第一个
	controls.querySelector('.item').classList.add('active');
	//contents.querySelector('.mui-control-content').classList.add('mui-active');
	$(window).load(function(){
		$('.item:first').trigger('tap');
	});
	</script>

	<div class="mo-mark js-mo-mark"></div>
    <script src="js/zepto.min.js"></script>
	<script src="js/iscroll.js"></script>
	<script src="js/common.js"></script>
	<script src="js/model-new.js"></script>
</body>
</html>