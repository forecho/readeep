<?php
/*
 * 百度图形统计
 * 2014年4月9日
 * 宇宙兄弟1
 */
class StatisticsController extends Controller
{	
	public $layout = '//layouts/column2';
	
	public function actionIndex()
	{
		$this->pageTitle = Yii::app()->name . ' - ' . date('Y年m月',time()) . ' - 图形统计';
		$this->pageKeyword = Yii::app()->name . '-' . date('Y年m月',time()) . ' - 图形统计';
		$this->pageDesc = Yii::app()->name . date('Y年m月',time()) . '图形统计';
		
		$type = array('0'=>'访问量','1'=>'点赞数','2'=>'感谢数');//可配置
		
		$y=date("Y",time());
		$m=date("m",time());
		$t0=date('t');           		  // 本月一共有几天
		$t1=mktime(0,0,0,$m,1,$y);        // 本月开始时间
		$t2=mktime(23,59,59,$m,$t0,$y);   // 本月结束时间

		$model=new PostPosts('search');
		$criteria=new CDbCriteria;
		$criteria->compare('status',1);
		$criteria->compare('create_time','<'.$t2);
		$criteria->compare('create_time','>'.$t1);
		$result = $model->findAll($criteria);//查询当月文章
		$i= 0;
		foreach ($result as $key=>$val){
			$view_count[$i] = $val['view_count'];
			$like_count[$i] = $val['like_count'];
			$thanks_count[$i] = $val['thanks_count'];
			$title[$i] = $val['title'];
			$i++;
		}
		//转化为json数据
		$type = json_encode($type);
		$view_count = json_encode($view_count);
		$like_count = json_encode($like_count);
		$thanks_count = json_encode($thanks_count);
		$title = json_encode($title);
		$this->render('index',array(
				'type' => $type,
				'view_count' => $view_count,
				'like_count' => $like_count,
				'thanks_count' => $thanks_count,
				'title' => $title
		));
	}
}