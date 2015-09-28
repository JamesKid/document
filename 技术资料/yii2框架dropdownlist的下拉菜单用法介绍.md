#yii2框架dropDownList的下拉菜单用法介绍

dropDownList是yii框架中一个自带的下拉功能了解，我们可以直接使用dropDownList来实现html的select菜单，下面一起来看看。

**Yii2.0 默认的 dropdownlist 的使用方法.**

	<?php echo $form->field($model, 'name[]')->dropDownList(['a' => 'Item A', 'b' => 'Item B', 'c' => 'Item C']); ?>

**在yii2中加放请选择的下拉菜单**

	<php echo $form->field($model, 'name[]')->dropDownList($listData, 
                        ['prompt'=>'Select...']);>
                        
**DropDownList 在模型中使用**

	<?php 
	$countries=Country::find()->all();
	$listData=ArrayHelper::map($countries,'code','name');
	echo $form->field($model, 'name')->dropDownList(
                                $listData, 
                                ['prompt'=>'Select...']);
    ?>

**下拉菜单的默认值设置我们使用 prompt 关键字 实例：**

	$form->field($searchmodel, 'moneytype')->dropDownList($soucetype, ['prompt' => '请选择金额来源')])

好的 下拉菜单的默认值设置就是这样简单，下面我们在说说带有插件的文本框默认值是如何设置的。

我现在就拿这个表单后面的两个使用了时间插件的文本域为例，在这里 prompt 关键字就不行了，我们要使用 placeholder 关键字

	$form->field($searchmodel, 'startdate')->widget(DatePicker::className(),['clientOptions' => ['dateFormat' => 'yy-mm-dd']])->textInput(['placeholder' => Yii::t('app', 'Start time')])


ActiveForm 类的 dropDownList 方法(优点，默认使用yii的样式)

**1、在控制器的方法里面 ，我们需要拿到数据，一定是 findAll() 或者是 all() 方法的数据，实例如下：**

	public function actionIndex()
    {
        $model = new UserModel();
        $data = Customer::find()->all();
        return $this->render('index', [
            'model' => $model,
            'data' => $data,
        ]);
    }	
    
**2、在视图页面，我们使用 yii 的表单生成器。**

	$form->field($model, 'username')->dropDownList(ArrayHelper::map($data,'id', 'customer_name'));
	
dropDownList           --->     yii2.0  下拉列表的方法

ArrayHelper::map()     --->     构建一个(key => value) 的一维或多维数组

$data               --->     数据源

id                  --->     option 的 value 值

customer_name       --->     option 标签的 值

<br />

**Html 类的 activeDropDownList方法(优点，可以自定义任何样式)**

1、和第一种方法的第一步一样，拿到数据。不过多解释了。

2、＼yii＼helpers＼Html 类为我们提供了下拉列表的实现方法 activeDropDownList 方法

	Html::activeDropDownList($model, 'username', ArrayHelper::map($data,'id', 'customer_name'), ['style' => 'border:1px solid red;']);


参数和第一种方法的参数含义相同，不做解释。

<br />

**Html 类的 dropDownList方法(优点，可以自定义任何样式)**

1、和第一种方法的第一步一样，拿到数据。不过多解释了。

2、＼yii＼helpers＼Html 类为我们提供了下拉列表的实现方法 dropDownList方法

	Html::dropDownList('username', null, ArrayHelper::map($data,'id', 'customer_name'), ['class' => 'dropdownlist']);