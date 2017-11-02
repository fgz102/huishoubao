<?php
require_once 'include.php';
$pname=$_POST['pName'];
$p_id=$_POST['pid'];
$iprice=$_POST['iPrice'];
$term=$_POST['terms'];
$sql_config="select term_id,selection_one,selection_two,selection_three,selection_four from imooc_config where imooc_config.p_id={$p_id}";
$allconfig=fetchAll($sql_config);
$allConfigArr;
foreach($allconfig as $k=>$val){
	$allConfigArr[$val['term_id']]['selection_one']=$val['selection_one'];
	$allConfigArr[$val['term_id']]['selection_two']=$val['selection_two'];
	$allConfigArr[$val['term_id']]['selection_three']=$val['selection_three'];
	$allConfigArr[$val['term_id']]['selection_four']=$val['selection_four'];
}

$sql_term="select * from imooc_term order by id asc";
$allterm=fetchAll($sql_term);
$alltermArr;
foreach($allterm as $k=>$val){
	$alltermArr[$val['id']]['selection_one']=$val['selection_one'];
	$alltermArr[$val['id']]['selection_two']=$val['selection_two'];
	$alltermArr[$val['id']]['selection_three']=$val['selection_three'];
	$alltermArr[$val['id']]['selection_four']=$val['selection_four'];
}
//var_dump($alltermArr);

$termjson=json_decode($term);
//var_dump($termjson);
$sub = $iprice;
$term_str;
$i=0;
foreach($termjson as $key=>$value)
{
//	$chooseIndex=json_decode($value);
	if(strpos($key,"_") )
	{
		$str=explode("_",$key,2);
		$sub-=$allConfigArr[$str[0]][$str[1]];
		$term_str[$i]=$alltermArr[$str[0]][$str[1]];
	}
	else
	{
		$sub-=$allConfigArr[$key][$value];
		$term_str[$i]=$alltermArr[$key][$value];	
	}
	$i++;
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
    <title>评估结果</title>
    <link rel="stylesheet" href="css/common-new.css">
    <link rel="stylesheet" href="css/evaluate-new.css">
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
</noscript>    <div>
        <div class="evaluate-res">
            <div class="price">
                估价结果<br /><span class="rmb">&yen;</span><span class="num"><?php echo $sub?></span>
            </div>
                        <div class="tips ellipsis-1">若检测结果与评估情况一致，您将在24小时内以当前价格收款</div>
        </div>
        <div class="title-1 border-bottom pd-10">
            <span></span>
            <a href="getParamsByItemid.php?pid=<?php echo $p_id?>" class="f-r">重新估价</a>
            评估机型：<?php echo $pname?>        </div>
        <div class="evaluate-detail pd-10 ">
            <ul class="evaluate-detail-list clearfix">
            	<?php foreach($term_str as $k=>$val):?>
                    <li><?php echo $val;?></li>
               <?php endforeach?>       
                </ul>
        </div>
        <div class="evaluate-detail-more">
             <div class="evaluate-detail-more-btn"></div>
        </div>
        <div class="evaluate-chart">
            <!--<p class="forecast">预计下月再跌<span> ↓ 28</span> 元，与其闲置，不如换钱买买买</p>-->
            <div class="title-label">
                <div class="hsb-price f-l">大咖报价</div>
                <div class="marker-price f-r">市场均价</div>
            </div>
            <div id="evaluate-chart-body" style="height: 1.9rem"></div>
        </div>
    </div>
    <div class="dividing-line"></div>
    <div class="title-1 border-bottom pd-10">
        大咖服务保障
    </div>
    <div class="service-guarantee">
        <ul class="js-service clearfix">
            <li class="service1 active">0元包邮</li>
            <li class="service2">24小时收款</li>
            <li class="service3">隐私0泄露</li>
            <li class="service4">专业检测</li>
        </ul>
        <div class="pd-10">
            <div class="service-panel js-service-panel pd-10" style="display: block;">
                请优先选择顺丰到付，全国包邮；若不满意检测结果，我们将免费寄回您的手机。
            </div>
            <div class="service-panel js-service-panel">
                收到手机后（以快递签收时间为准），我们会在24小时内完成检测并且给您付款。
            </div>
            <div class="service-panel js-service-panel">
                同意回收后，我们会对您的手机进行专业的数据删除服务，清理过程全程录像监控。
            </div>
            <div class="service-panel js-service-panel">
                规范的流水作业操作，采用盲检技术，全流程视频监控，从业5年以上的检测工程师。
            </div>
        </div>
    </div>
    <div class="dividing-line"></div>
    <div class="hsb-footer"></div>
    <div class="fixed-bottom">
        <div class="recovery-record ellipsis-1">
            已有<span>7,430,000</span>人通过卖旧手机换了钱
        </div>
        <form action="#" class="m-evr-from pd-10" method="GET">
            <input type="hidden" name="pid" value="1004">
            <input type="hidden" name="itemid" value="38">
            <input type="hidden" name="selects" value="73#12#68#36#121#77#63#83#59#55#30#23#21#10">
            <input type="hidden" name="productname" value="iPad 2">
            <input type="hidden" name="quotation" value="38800">
            <input type="hidden" name="productType" value="">
            <a href="tel:17771747170"  class="hsb-button"  value="马上换钱">马上换钱</a>
        </form>
    </div>

    <script src="js/echarts.simple.min.js"></script>
    <script>
        var myChart = echarts.init(document.getElementById('evaluate-chart-body'));
        var config = {
            itemid: "38"
        };
        

var historyTime = [],
    historyPrice = [],
    hsbColor = '#f9be00',
    marketPrice = [];

var marketColor = "#00acff";

    marketColor = "#44c5ff";


    historyTime.push("6");
    historyTime.push("7");
    historyTime.push("8");
    historyTime.push("9");
    historyTime.push("10");
    historyPrice.push(467);
    historyPrice.push(439);
    historyPrice.push(400);
    historyPrice.push(600);
    historyPrice.push(360);

var historyMaxPrice = Math.max.apply(null, historyPrice) + 100;
var historyMinPrice = Math.max((Math.min.apply(null, historyPrice) - 100), 0);
var marketPrice = historyPrice.map(function(value, index) {
    switch(index) {
        case 0:
            return value * (1 - 0.03);
        break;
        case 1:
            return value * (1 - 0.02);
        break;
        case 2:
            return value * (1 - 0.04);
        break;
        case 2:
            return value * (1 - 0.03);
        break;
        case 3:
            return value * (1 - 0.05);
        break;
        case 4:
            return value * (1 - 0.03);
        break;
        default:
            return value * (1 - 0.06);
    }
});

var option = {

    grid: {
        show: true,
        left: '47',
        top: '20',
        right: '22',
        bottom: '20%',
        borderColor: '#ffffff'
    },
    xAxis: {
        type: 'category',
        axisTick: {
            show: true
        },
        splitLine: {
            show: true,
            interval: 0,
            lineStyle: {
                color: ['#f5f5f5', '#f5f5f5', '#f5f5f5', '#f5f5f5', '#f5f5f5', '#ffffff']
            }
        },
        axisLabel: {
            textStyle: {
                color: '#999',
                fontSize: 14
            },            
            formatter: function(value) {
                return value + '月';
            },
        },
        axisLine: {
            show: true,
            lineStyle: {
                color: '#f5f5f5'
            }
        },
        data: historyTime
    },
    yAxis: {
        type: 'value',
        scale: true,
        axisTick: {
            show: false
        },
        axisLine: {
            show: true,
            lineStyle: {
                color: '#fff'
            }
        },
        splitLine: {
            show: true,
            lineStyle: {
                color: ['#f5f5f5', '#f5f5f5', '#f5f5f5', '#f5f5f5', '#ffffff', '#ffffff']
            }
        },
        interval: parseInt((historyMaxPrice - historyMinPrice) / 4),
        min: historyMinPrice,
        max: historyMaxPrice,
        axisLabel: {
            textStyle: {
                color: '#999',
                fontSize: 10
            }
        },
    },
    series: [
        {
            name: '回收价',
            type: 'line',
            label: {
                normal: {
                    show: true,
                    textStyle: {
                        color: '#999',
                        fontSize: 14
                    }
                }
            },
            data: historyPrice,
            symbol: 'circle',
            symbolSize: '5',
            itemStyle: {
                normal: {
                    color: hsbColor 
                }
            }
        },
        {
            name: '市场均价',
            type: 'line',
            label: {
                normal: {
                    show: false,
                    textStyle: {
                        color: '#999',
                        fontSize: 14
                    }
                }
            },
            data: marketPrice,
            symbol: 'circle',
            symbolSize: '5',
            itemStyle: {
                normal: {
                    color: marketColor
                }
            }
        }

    ]
};
myChart.setOption(option);    </script>
    <script src="js/zepto.min.js"></script>
    <script src="js/common.js"></script>
    <script src='js/assessment-result-new.js' type="text/javascript"></script>

    <div class="f-dn">
</body>
</html>