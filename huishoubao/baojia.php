<?php
require 'include.php';
$sql="select * from imooc_album,imooc_pro where imooc_album.pid=imooc_pro.id";
$rows = fetchAll($sql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" style="font-size: 52.0833px;">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!--使用X-UA-Compatible标签强制IE8采用低版本方式渲染-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="国内外手机、平板、电脑的报价、批发、回收服务；买卖交易服务；苹果官方换机服务；保修查询服务等">
    <meta name="keywords" content="苹果官方换机服务，快速查码，二手回收，手机回收，二手手机废旧数码回收，官换机批发，买卖交易平台，竞拍平台，数码竞拍，数码竞拍平台">
    <!--安全策略经过优化处理-->
    <title>报价</title>
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="icon" href="" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/mb_index.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script> 
    		 
    <script charset="utf-8" src="chrome-extension://jgphnjokjhjlcnnajmfjlacjnjkhleah/js/btype.js"></script></head>
    <body>
    <script>
        !function(n){
            var e=n.document,t=e.documentElement,i=720,d=i/100,o="orientationchange"in n?"orientationchange":"resize",a=function(){var n=t.clientWidth||320;n>720&&(n=720),t.style.fontSize=n/d+"px"};e.addEventListener&&(n.addEventListener(o,a,!1),e.addEventListener("DOMContentLoaded",a,!1))
        }(window);
    </script>
    <div class="box">
        <div class="page_index" data-log="首页">
            <header class="quote_header">
    <div class="header_top quote_header_top">
        <div class="back"><a href="https://www.wanlixingyunduan.com/quote"><span class="glyphicon glyphicon-menu-left"></span></a></div>
        <div class="search quote_search">
            <a href="javascript:void(0)">
                <span class="glyphicon glyphicon-search text"></span>
                <span class="text">搜索功能正在完善中</span>
            </a>
        </div><!--search结束-->
    </div><!--header_top 结束-->
    <nav>
        <div class="slick_track clearfix">
            <div class="li  on " id="phone">二手手机</div>
        </div><!--.slick_track 结束-->
    </nav><!--nav结束-->
</header><!--header结束-->
<div class="main_container quote_main_container">
    <div class="container_box">
        <div class="brand">
            <div class="brand_content">
                <ul id="#phone">
                	<?php foreach($rows as $row):?>
                    <li>
						<a href="baojiaDetail.php?pid=<?php echo $row['pid']?>" title="<?php echo $row['pName']?>">
							<img src="<?php echo $row['iconPath']?>" alt="<?php echo $row['pName']?>">
							<div class="brand_name"><?php echo $row['pName']?></div>
						</a>
					</li>
					<?php endforeach;?>
                </ul>
            </div><!-- .brands_content结束 -->
        </div><!-- .brands结束 -->
    </div>
</div><!-- .main_container结束 -->
</div><!-- .main_container结束 -->
    </div><!--page_index结束-->    
    <!--box结束-->		
</body></html>