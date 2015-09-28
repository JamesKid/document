#yii2.0之GridView自定义按钮和链接用法

这篇文章主要介绍了yii2.0之GridView自定义按钮和链接用法，是非常实用的使用GridView进行表单操作技巧，需要的朋友可以参考下，具体实现方法如下：

	<?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //显示的字段
            //code的值
            ['attribute'=>'这是测试code','value'=>function(){return 'abc';}],
            'name',
            'population',
            [
            	'class' => 'yii\grid\ActionColumn',
            	'header' => '操作',
            ],
           	[
                'label'=>'更多操作',
                'format'=>'raw',
                'value' => function($data){
                    $url = "http://www.baidu.com";
                    return Html::a('添加权限组', $url, ['title' => '审核']); 
                }
            ],
            [
	            'class' => 'yii\grid\ActionColumn',
				'header' => '操作',
              	'template' => '{view}{update}{delete}{audit}',
               'buttons' => [
	               'audit' => function ($url, $model, $key) {
                	return $model->status == 'editable' ? Html::a('<span class="glyphicon glyphicon-user"></span>', $url, ['title' => '审核'] ) : '';
                	}
                ],
                'headerOptions' => ['width' => '80'],
            ],        
        ],
    ]); ?>

