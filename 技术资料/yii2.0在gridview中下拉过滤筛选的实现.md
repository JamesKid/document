#Yii2.0在GridView中下拉过滤筛选的实现

细微的方便也许对于我们的用户来说将会获得最好的体验，用最方便，最快捷，最易操作的方式实现用户需要的功能是我们的工作和职责，今天分享一个在Yii2.0在GridView中下拉过滤筛选的实现，希望能够大家带来一点点的帮助和建议，不说废话了，直接看demo吧

如下是文章管理列表页中如何实现的demo

view层代码

	<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
             [
                'attribute' => 'category',
                'label'=>'栏目',
                'value'=>
                 function($model){
                      return  Article::get_type_text($model->category);   //主要通过此种方式实现
                    },
                'filter' => Article::get_type(),     //此处我们可以将筛选项组合成key-value形式
             ],

            'title',
            [
                'attribute' => 'uid',
                'label'=>'管理员',
                'value'=>
                function($model){
                    return  Article::get_uid_type_text($model->uid);   //主要通过此种方式实现
                },
            ],

            [
                'attribute' => 'updatetime',
                'label'=>'更新时间',
                'value'=>
                function($model){
                    return  date('Y-m-d H:i:s',$model->updatetime);   //主要通过此种方式实现
                },
                'headerOptions' => ['width' => '170'],
            ],

            ['class' => 'yii\grid\ActionColumn', 'header' => '操作'],
        ],
    ]); ?>
    
model层代码

 	/**
     * 将栏目组合成key-value形式
     */
     public static  function  get_type(){
		$cat = Category::find()->all();
      	$cat = ArrayHelper::map($cat, 'id', 'name');
      	return $cat;
     }

    /**
	 * 通过栏目id获得栏目名称
	 * @param unknown $id
	 * @return Ambigous <unknown>
	 */

    public static  function  get_type_text($id){

       $datas = Category::find()->all();
       $datas = ArrayHelper::map($datas, 'id', 'name');
       return  $datas[$id];

    }
    
好了至此我们的基本功能就已经实现了，功能很简单但是却很有用。