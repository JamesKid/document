#yii2.0 DetailView 自定义样式
GII　生成如下：

	<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        ['label'=>'name','value'=>$model->name],
    ],
	]) ?>
	
自定义如下：

	<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        ['label'=>'name','value'=>$model->name)],
    ],
    'template' => '<tr><th>{label}</th><td>{value}</td></tr>', 
    'options' => ['class' => 'table table-striped table-bordered detail-view'],
	]) ?>
	
输出后的HTML为：

    <table class="table table-striped table-bordered detail-view"><tr><th>Uid</th><td>1</td></tr><tr><th>gender</th><td>Female</td></tr></table>


其它具体参数，可以参考【[yii\widgets\DetailView](https://github.com/yiisoft/yii2/blob/master/framework/widgets/DetailView.php)】