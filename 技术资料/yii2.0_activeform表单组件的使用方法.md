#YII2.0 Activeform表单组件的使用方法

文本框:textInput();

密码框:passwordInput();

单选框:radio(),radioList();

复选框:checkbox(),checkboxList();

下拉框:dropDownList();

隐藏域:hiddenInput();

文本域:textarea(['rows'=>3]);

文件上传:fileInput();

提交按钮:submitButton();

重置按钮:resetButtun(); 

	<?php
	$form = ActiveForm::begin([
    'action' => ['test/getpost'],
    'method'=>'post',
    ]); ?>
 
	<? echo $form->field($model, 'username')->textInput(['maxlength' => 20]) ?>
	
	<? echo $form->field($model, 'password')->passwordInput(['maxlength' => 20]) ?>
	
	<? echo $form->field($model, 'sex')->radioList(['1'=>'男','0'=>'女']) ?>
	
	<? echo $form->field($model, 'edu')->dropDownList(['1'=>'大学','2'=>'高中','3'=>'初中'],['prompt'=>'请选择','style'=>'width:120px']) ?>
	
	<? echo $form->field($model, 'file')->fileInput() ?>
	
	<? echo $form->field($model, 'hobby')->checkboxList(['0'=>'篮球','1'=>'足球','2'=>'羽毛球','3'=>'乒乓球']) ?>

	<? echo $form->field($model, 'info')->textarea(['rows'=>3]) ?>
 
	<? echo $form->field($model, 'userid')->hiddenInput(['value'=>3]) ?>
 
	<? echo Html::submitButton('提交', ['class'=>'btn btn-primary','name' =>'submit-button']) ?> 
	  
	<? echo Html::resetButton('重置', ['class'=>'btn btn-primary','name' =>'submit-button']) ?>
	
	<?php ActiveForm::end(); ?>