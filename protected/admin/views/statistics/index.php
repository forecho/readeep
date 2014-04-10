<?php
/* @var $this StatisticsController */

$this->breadcrumbs=array(
	'Statistics',
);
?>

<!-- <div id="statistics" style="height:500px;border:1px solid #ccc;padding:10px;"> -->
<div id="statistics" style="height:500px;padding:10px;">
</div>
<h1><?php echo date('Y年m月',time())?>文章图形统计</h1>


<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/echarts/esl.js"></script>
<script>
   require.config({
        paths:{
            echarts:'./js/echarts',

            'echarts/chart/bar' : '.<?php echo Yii::app()->request->baseUrl; ?>/js/echarts/echarts',
            'echarts/chart/line': '.<?php echo Yii::app()->request->baseUrl; ?>/js/echarts/echarts',
        }
    });

	require(
        [           
            'echarts',
            'echarts/chart/bar',
            'echarts/chart/line',
        ],
		
        function(ec) {
            var myChart = ec.init(document.getElementById('statistics'));
			var option = {
                tooltip : {
                    trigger: 'axis'
                },
                legend: {
                    data:<?php echo $type?>
                },
                toolbox: {
                    show : true,
                    feature : {
                        mark : false,
                        dataView : {readOnly: false},
                        magicType:['line', 'bar'],
                        restore : true,
                        saveAsImage : true
                    }
                },
                calculable : true,
                xAxis : [
                    {
                        type : 'category',
                        data : <?php echo $title?>
                    }
                ],
                yAxis : [
                    {
                        type : 'value',
                        splitArea : {show : true}
                    }
                ],
                series : [
                    {
                        name:'访问量',
                        type:'bar',
                        data:<?php echo $view_count?>
                    },
                    {
                        name:'点赞数',
                        type:'bar',
                        data:<?php echo $like_count?>
                    },
                    {
                        name:'感谢数',
                        type:'bar',
                        data:<?php echo $thanks_count?>
                    }
                ]
            };
            myChart.setOption(option);
        }
    );
   </script>