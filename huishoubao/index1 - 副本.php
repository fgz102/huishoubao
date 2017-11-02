<?php 
require_once 'include.php';
$cates=getAllcate();

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
	<meta name="description" content="卖二手手机,旧手机就上回收宝，回收苹果三星华为等品牌手机。提供手机回收报价、二手手机价格评估|查询、上门回收手机等服务，正规的二手手机回收、回收旧手机的网站，专业估价、质检、交易流程。">
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
</script>

<noscript>
<h2 style="text-align: center;">为了保障正确的功能，请开启JavaScript</h2>
</noscript>	<div id="index-panel" class="select-model">
		<!-- 搜索 -->
		<div class="search-feild pd-10">
			<a href="javascript:;" class="search-btn" id="search-label">
			    <img src="img/icons/logo-search.png" alt="">
			    请输入搜索内容
			</a>
		</div>

		<!-- 型号选择 -->
		<div class="select-feild">
			<div class="brand-list">
			    <a href="/mobile/getModels_15.html?pid=1004" class="mobile">手机/平板</a>
			   <!-- <a href="/mobile/getModels_11.html?pid=1004&type=tablet" class="tablet">平板</a> -->
				<div id="wrapperL" class="wrapperL">
					<div id="scrollerL">
						<ul class="brand-list-wrapper js-m-brands">
						    <!--  -->
							<?php foreach($cates as $cate):?>
							<li class="item" data-mid=""><?php echo $cate['cName'];?></li>
							<?php endforeach;?>
						</ul>
					</div>
				</div>
			</div>
			<div class="model-list">
			    <div id="wrapper" class="wrapper">			    	
					<div id="scroller">
					    <ul class="model-list-wrapper">
	
					    		<li>
					    			<a href="getParamsByItemid.html?pid=1004">
					    			<span class="z-crt"></span>iPhone 8 plus					    			    					    			</a>
					    		</li>
							
					    	<li>
					    			<a href="getParamsByItemid.html?pid=1004">
					    			<span class="z-crt"></span>iPhone 8					    			    					    			</a>
					    		</li>
					    		<li>
					    			<a href="getParamsByItemid.html?pid=1004">
					    			<span class="z-crt"></span>iPad Pro					    			    					    			</a>
					    		</li>
					    		<li>
					    			<a href="getParamsByItemid.html?pid=1004">
					    			<span>4</span>iPhone 7 Plus					    			    					    			</a>
					    		</li>
					    		<li>
					    			<a href="getParamsByItemid.html?pid=1004">
					    			<span>5</span>iPhone 7					    			    					    			</a>
					    		</li>
					    		<li>
					    			<a href="getParamsByItemid.html?pid=1004">
					    			<span>6</span>iPhone 6 Plus					    			    					    			</a>
					    		</li>
					    		<li>
					    			<a href="getParamsByItemid.html?pid=1004">
					    			<span>7</span>iPhone 6s Plus					    			    					    			</a>
					    		</li>
					    		<li>
					    			<a href="getParamsByItemid.html?pid=1004">
					    			<span>8</span>iPad Air 2					    			    					    			</a>
					    		</li>
					    		<li>
					    			<a href="getParamsByItemid.html?pid=1004">
					    			<span>9</span>iPad Air 2					    			    					    			</a>
					    		</li>
					    		<li>
					    			<a href="getParamsByItemid.html?pid=1004">
					    			<span>10</span>iPhone 6s					    			    					    			</a>
					    		</li>
					    		<li>
					    			<a href="getParamsByItemid.html?pid=1004">
					    			<span>11</span>iPhone 6					    			    					    			</a>
					    		</li>
					    		<li>
					    			<a href="getParamsByItemid.html?pid=1004">
					    			<span>12</span>iPad mini 4					    			    					    			</a>
					    		</li>
					    		<li>
					    			<a href="getParamsByItemid.html?pid=1004">
					    			<span>13</span>iPad mini 4					    			    					    			</a>
					    		</li>
					    		<li>
					    			<a href="getParamsByItemid.html?pid=1004">
					    			<span>14</span>Apple iPad(iPad 5th gen) 					    			    					    			</a>
					    		</li>
					    		<li>
					    			<a href="getParamsByItemid.html?pid=1004">
					    			<span>15</span>iPad Air 1					    			    					    			</a>
					    		</li>
					    		<li>
					    			<a href="getParamsByItemid.html?pid=1004">
					    			<span>16</span>iPad Air					    			    					    			</a>
					    		</li>
					    		<li>
					    			<a href="getParamsByItemid.html?pid=1004">
					    			<span>17</span>iPhone SE				    			    					    			</a>
					    		</li>
					    		<li>
					    			<a href="getParamsByItemid.html?pid=1004">
					    			<span>18</span>iPad mini 3			    			    					    			</a>
					    		</li>
					    		<li>
					    			<a href="getParamsByItemid.html?pid=1004">
					    			<span>19</span>iPad mini 3			    			    					    			</a>
					    		</li>
					    		<li>
					    			<a href="getParamsByItemid.html?pid=1004">
					    			<span>20</span>iPad mini 2			    			    					    			</a>
					    		</li>
					    		<li>
					    			<a href="getParamsByItemid.html?pid=1004">
					    			<span>21</span>iPad mini 2			    			    					    			</a>
					    		</li>
					    		<li>
					    			<a href="getParamsByItemid.html?pid=1004">
					    			<span>22</span>iPad 4				    			    					    			</a>
					    		</li>
					    		<li>
					    			<a href="getParamsByItemid.html?pid=1004">
					    			<span>23</span>iPad 4					    			    					    			</a>
					    		</li>
					    		<li>
					    			<a href="getParamsByItemid.html?pid=1004">
					    			 <span>24</span>iPad 3					    			    					    			</a>
					    		</li>
					    		<li>
					    			<a href="getParamsByItemid.html?pid=1004">
					    			<span>25</span>iPad 3				    			    					    			</a>
					    		</li>
					    		<li>
					    			<a href="getParamsByItemid.html?pid=1004">
					    			<span>26</span>iPad mini 1					    			    					    			</a>
					    		</li>
					    		<li>
					    			<a href="getParamsByItemid.html?pid=1004">
					    			<span>27</span>iPad mini					    			    					    			</a>
					    		</li>
					    		<li>
					    			<a href="getParamsByItemid.html?pid=1004">
					    			<span>28</span>iPhone 5s					    			    					    			</a>
					    		</li>
					    		<li>
					    			<a href="getParamsByItemid.html?pid=1004">
					    			<span>29</span>iPad 2					    			    					    			</a>
					    		</li>
					    		<li>
					    			<a href="getParamsByItemid.html?pid=1004">
					    			<span>30</span>iPad 2					    			    					    			</a>
					    		</li>
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

	<div id="search-panel" class="search-panel f-dn">
		<div class="search-panel-feild clearfix">
			<div class="search">
				<input type="search" id="text-search" class="text-search js-text-search" placeholder="请输入搜索内容">
			</div>
			<div id="search-cancel" class="search-btn">取消</div>
		</div>
		<div id="g-default-container">
			<div class="search-history pd-10">
				<div class="search-history-title">
					<div class="search-history-txt f-l">搜索历史</div>
					<a href="javascript:;" class="clear-history-btn f-r">清除历史</a>
				</div>
				<ul class="search-history-list js-history-list clearfix">
					<li>iPhone 6s Plus</li>
					<li>iPhone 6s Plus</li>
					<li>iPhone 6s Plus</li>
					<li>iPhone 6s Plus</li>
				</ul>
			</div>
			<div class="search-hot pd-10">
				<div class="search-hot-title">
					<div class="search-hot-txt">热门搜索</div>
				</div>
				<ul class="search-hot-list">
					<li class="hot-list-item"><a href="getParamsByItemid.html?pid=1004">iPhone 5s</a></li>
					<li class="hot-list-item"><a href="getParamsByItemid.html?pid=1004">iPhone 4s</a></li>
					<li class="hot-list-item"><a href="getParamsByItemid.html?pid=1004">iPhone 6</a></li>
					<li class="hot-list-item"><a href="getParamsByItemid.html?pid=1004">iPhone 5</a></li>
					<li class="hot-list-item"><a href="getParamsByItemid.html?pid=1004">OPPO A33</a></li>
					<li class="hot-list-item"><a href="getParamsByItemid.html?pid=1004">OPPO R9</a></li>
					<li class="hot-list-item"><a href="getParamsByItemid.html?pid=1004">OPPO R9s</a></li>
					<li class="hot-list-item"><a href="getParamsByItemid.html?pid=1004">vivo Y51</a></li>
					<li class="hot-list-item"><a href="getParamsByItemid.html?pid=1004">红米Note 2</a></li>
					<li class="hot-list-item"><a href="getParamsByItemid.html?pid=1004">小米手机4</a></li>
				</ul>
			</div>
		</div>
		<div id="g-result-container" style="display: none;">
			<div id="wrapperRst">
				<div id="scrollerRst">
				    <ul id="search-result-panel" class="search-result-panel">

					</ul>
				    <div class="rst-circleGBox">
				        <span class="circleG circleG_3"></span>
				        <span class="circleG circleG_2"></span>
				        <span class="circleG circleG_1"></span>
				    </div>
				    <div class="rst-end">o(∩_∩)o~ 已经看到最后了哦</div>
				    <div class="rst-none">暂无搜索结果<br>可以试试对型号与品牌分开搜索</div>
				</div>
			</div>
		</div>
	</div>
	<script>
	var __CONFIG__ = {
        'pageindex':0,
        'pagesize':30,
        'total':38,
        'mid':11,
        'pid':1004    };
	var arr=document.getElementsByClassName("item");
	arr[0].classList.add("active");
	</script>

	<div class="mo-mark js-mo-mark"></div>
    <script src="js/zepto.min.js"></script>
	<script src="js/iscroll.js"></script>
	<script src="js/common.js"></script>
	<script src="js/model-new.js"></script>
</body>
</html>