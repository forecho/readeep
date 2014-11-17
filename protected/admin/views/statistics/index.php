<?php
/* @var $this StatisticsController */

$this->breadcrumbs=array(
	'Statistics',
);
?>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo Yii::app()->request->baseUrl; ?>/webroot/css/daterangepicker-bs3.css" />
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/webroot/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/webroot/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/webroot/js/moment.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/webroot/js/daterangepicker.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/webroot/js/echarts/echarts.js"></script>
<div id="statistics" style="height:500px;padding:10px;">
</div>
<?php
   $form = $this->beginWidget('CActiveForm', array(
      'id' => 'statistics-form',
      'htmlOptions' => array('name' => 'myForm'),
   ));
?>
<div class="form-group">
   <fieldset>
     <div class="control-group">
        <div class="controls">
           <div class="input-prepend input-group">
               <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span><input type="text" style="width: 220px" name="overduetime" id="reservation" class="form-control" value="<?php echo $start_time;?> — <?php echo $end_time;?>" />
           </div>
        </div>
     </div>
   </fieldset>
</div>
<div class="form-group">
<?php echo CHtml::submitButton('search',array('class'=>'btn btn-primary','name'=>'submit')); ?>
</div>
<?php $this->endWidget(); ?>
<script type="text/javascript">
$(document).ready(function() {
  $('#reservation').daterangepicker(null, function(start, end, label) {
  console.log(start.toISOString(), end.toISOString(), label);
  });
});
</script>

<script>
require.config({
    paths:{
        echarts:'<?php echo Yii::app()->request->baseUrl; ?>/webroot/js/echarts',
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
                showTitle: true,
                feature : {
                    dataView : {
                        show : true,
                        title : '数据视图',
                        readOnly: false,
                        lang : ['数据视图', '关闭', '刷新']
                    },
                    magicType: {
                        show : true,
                        title : {
                            line : '动态类型切换-折线图',
                            bar : '动态类型切换-柱形图',
                        },
                        type : ['line', 'bar']
                    },
                    restore : {
                        show : true,
                        title : '还原',
                        color : 'black'
                    },
                    saveAsImage : {
                        show : true,
                        title : '保存为图片',
                        type : 'jpeg',
                        lang : ['点击本地保存']
                    },
                }
            },
            calculable : true,
            xAxis : [
                {
                    type : 'category',
                    // ['ass']//不能为空
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