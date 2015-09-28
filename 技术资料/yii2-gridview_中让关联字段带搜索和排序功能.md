#Yii2-GridView 中让关联字段带搜索和排序功能
**情境要求：**

要在订单（Order）视图的gridview中显示出客户（Customer）姓名，并使其具有与其它字段相同的排序和搜索功能。

**数据库结构**

订单表order含有字段customer_id 与 客户表customer的id字段关联

**首先确保在Order Model中包含以下代码：**

	public function getCustomer()
	{
    	return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }

用gii会自动生成此代码；

第一步：
在OrderSearch添加一个$customer_name变量

	class OrderSearch extends Order
	{
    	public $customer_name; //<=====就是加在这里
	}
	
第二步：
修改OrderSearch中的search函数

	public function search($params)
	{
    	$query =  Order::find();
    	$query->joinWith(['customer']);<=====加入这句
    	$dataProvider = new ActiveDataProvider([
        	'query' => $query,
    	]);
    
    	$dataProvider->setSort([
        'attributes' => [
            /* 其它字段不要动 */    
            /*  下面这段是加入的 */
            /*=============*/
            'customer_name' => [
                'asc' => ['customer.customer_name' => SORT_ASC],
                'desc' => ['customer.customer_name' => SORT_DESC],
                'label' => 'Customer Name'
            ],
            /*=============*/
        ]
    ]); 

    if (!($this->load($params) && $this->validate())) {
        return $dataProvider;
    }

    $query->andFilterWhere([
        'id' => $this->id,
        'user_id' => $this->user_id,
        'customer_id' => $this->customer_id,
        'order_time' => $this->order_time,
        'pay_time' => $this->pay_time,
    ]);

    $query->andFilterWhere(['like', 'status', $this->status]);
     $query->andFilterWhere(['like', 'customer.customer_name', $this->customer_name]) ;//<=====加入这句
    
    return $dataProvider;
    }
    
第三步：
修改order/index视图的gridview

	<?= GridView::widget([
    	'dataProvider' => $dataProvider,
    	'filterModel' => $searchModel,
    	'columns' => [
        	['class' => 'yii\grid\SerialColumn'],
        	'id',
        	'customer_id',  
        	'status',
        	['label'=>'客户',  'attribute' => 				'customer_name',  'value' => 				'customer.customer_name' ],//<=====加入这句
        	['class' => 'yii\grid\ActionColumn'],
    	],
    ]); ?>
    
好了就这样，希望对你有帮助。


**试了下，不出现搜索框:**

`修改`['label'=>'客户', 'attribute' => 'customer_name', 'value' => 'customer.customer_name' ] 

`为`['label'=>'客户', 'attribute' => 'customer_name', 'value' => 'customer.customer_name', ,'filter'=>Html::activeTextInput($searchModel, 'customer_name',['class'=>'form-control']) ] 

现在搜索框出现了，但是输入后还是不能查询出结果

然后修改gii生成的那个搜索模型文件有个rules方法里将 customer_name 属性加入到安全搜索字段中 ['customer_name','safe] 这样就可以实现搜索了