<?php 
require_once 'include.php';
$cates=getAllcate();
if(!($cates && is_array($cates))){
	alertMes("不好意思，网站维护中!!!", "http://www.imooc.com");
}
$pid=$_GET['pid'];
//查询商品表
$sql_pro="select pName,iPrice from imooc_pro where id={$pid}";
$proinfo=fetchOne($sql_pro);
//查询配置表 根据p_id
$sql_termid="select term_id from imooc_config where imooc_config.p_id={$pid}";
//输出条件和选项 根据term_id
$termids=fetchAll($sql_termid);
$arr_str="";
foreach($termids as $k=>$val){
	$arr_str=$arr_str.$val['term_id'].',';
}
$arr_str=substr($arr_str, 0,strlen($arr_str)-1);
$sql_term="select * from imooc_term where imooc_term.id in ($arr_str) order by id asc";
$allterm=fetchAll($sql_term);



?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, maximum-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no, email=no">
    <meta name="keywords" content="<?php echo $proinfo['pName']?>回收价格,<?php echo $proinfo['pName']?>估价,二手<?php echo $proinfo['pName']?>能卖多少钱">
    <meta name="description"  content="专业回收二手，提供二手估价、二手回收价格、二手价格走势、价格查询等服务。回收咖-价格好,打款快,服务优,二手手机估价、回收第一选择！">
    <title><?php echo $proinfo['pName']?>回收价格|<?php echo $proinfo['pName']?>估价|<?php echo $proinfo['pName']?>能卖多少钱 –大咖</title>
    <link rel="stylesheet" href="css/swiper/swiper.min.css">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/new-evaluate.css">
    <link rel="stylesheet" href="css/evaluate.css">
</head>
<body class="yellow">



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
var m_pid = <?php echo $pid?>;
var m_pName = "<?php echo $proinfo['pName']?>";
var m_iPrice = "<?php echo $proinfo['iPrice']?>";
</script>

<noscript>
<h2 style="text-align: center;">为了保障正确的功能，请开启JavaScript</h2>
</noscript>

<!--顶部固定内容-->
<div class="header">

    
    <div class="progress">
        <div class="progress-wrap">
            <span class="name"><?php echo $proinfo['pName']?>评估进度条</span>
            <span class="ratio">0%</span>
        </div>
        <div class="cover" style="width: 0;"></div>
    </div>
    <div class="tip">请根据实际情况评估您的机器：如最终检测结果与您的评估一致，收款速度提升30%以上</div>
</div>


<div class="scroll-wrap">
    <div class="evaluate-content">
        <div class="evaluate-wrap base-options">
                <?php $first=true; foreach($allterm as $k=>$val):?>
                	<?php if($val['ismore']==0):?>
                		<?php if($first):?>
                		<dl class="evaluate-item open" data-key="<?php echo $val['id']?>">
                		<?php $first=false; else:?>
                		<dl class="evaluate-item" data-key="<?php echo $val['id']?>">
                		<?php endif?>
                    <dt class="evaluate-title"><?php echo $val['term']?></dt>
                    <dd class="eva-options">
                        <ul class="eva-options-wrap">
                                <li class="eva-option base-option"  data-key="<?php echo $val['id']?>" data-value="selection_one" data-checked="">
                                    <p><?php echo $val['selection_one']?></p>              
                                </li>                                                      
                                <li class="eva-option base-option"  data-key="<?php echo $val['id']?>" data-value="selection_two" data-checked="">
                                    <p><?php echo $val['selection_two']?></p>              
                                </li>                                                      
                                <?php if(!empty($val['selection_three'])):?>               
                                <li class="eva-option base-option"  data-key="<?php echo $val['id']?>" data-value="selection_three" data-checked="">
                                    <p><?php echo $val['selection_three']?></p>
                                </li>
                                <?php endif?>
                                <?php if(!empty($val['selection_four'])):?>
                                							<li class="eva-option base-option" data-key="<?php echo $val['id']?>" data-value="selection_four">
                                    <p><?php echo $val['selection_four']?></p>
                                </li>
                                <?php endif?>
                                                    </ul>
                    </dd>
                </dl>
                <?php endif?>
                <?php endforeach?>
        </div>
        		<div class="evaluate-wrap func-options">
            	<div class="evaluate-title">功能选项(可多选或不选)</div>
           		 <ul class="eva-options flex">
            		<?php foreach($allterm as $k=>$val):?>
                	<?php if($val['ismore']==1):?>
                       <li class="eva-option base-option"  data-key="<?php echo $val['id']?>" data-value="selection_one" data-checked="">
                            <p><?php echo $val['selection_one']?></p>              
                        </li>                                                      
                        <li class="eva-option base-option"  data-key="<?php echo $val['id']?>" data-value="selection_two" data-checked="">
                            <p><?php echo $val['selection_two']?></p>              
                        </li>                                                      
                        <?php if(!empty($val['selection_three'])):?>               
                        <li class="eva-option base-option"  data-key="<?php echo $val['id']?>" data-value="selection_three" data-checked="">
                            <p><?php echo $val['selection_three']?></p>            
                        </li>                                                      
                        <?php endif?>                                              
                        <?php if(!empty($val['selection_four'])):?>                
                        <li class="eva-option base-option"  data-key="<?php echo $val['id']?>" data-value="selection_four" data-checked="">
                            <p><?php echo $val['selection_four']?></p>
                        </li>
                        <?php endif?>
                    <?php endif?>
                    <?php endforeach?>
             </ul>
        </div>
        <div style="height: 1rem;">
        </div>
    </div>
    <div class="sbt-wrap border-1px border-1px--top">
        <button type="button" class="hsb-button button-submit " disabled>查看估价</button>
    </div>
</div>

<script src="js/zepto.min.js"></script>
<script src="js/iscroll.js"></script>
<script src="js/common.js"></script>
<script src='js/evaluate.js'></script>

    <div class="f-dn">


</body>
</html>