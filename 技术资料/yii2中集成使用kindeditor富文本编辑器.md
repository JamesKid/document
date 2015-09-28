#yii2中集成使用kindeditor富文本编辑器

转自：http://blog.csdn.net/yiifans/article/details/36870547 

我们以advanced模板中frontend应用为例

###首先下载kindeditor

http://kindeditor.googlecode.com/files/kindeditor-4.1.10.zip


###然后解压到web目录，如

	frontend  
		web 
			libs
				kindeditor  


###使用

打开views\site\contract.php文件
引用kindeditor中的css、js等文件

	$this->registerCssFile('libs/kindeditor/themes/default/default.css');  
	$this->registerJsFile('libs/kindeditor/kindeditor-min.js');  
	$this->registerJsFile('libs/kindeditor/lang/zh_CN.js');  


###实例化Kindeditor

	$js=<<<JS  
		var editor;  
			KindEditor.ready(function(K) {  
		editor = K.create('textarea[name="body"]', {  
			allowFileManager : true 
						});
			});  
	JS;  
	$this->registerJs($js,View::POS_END);  


###修改form中的body输入框

	<?= $form->field($model, 'body')->textArea(['name'=>'body','style'=>'width:800px;height:400px;visibility:hidden;']) ?>  


这样就实现完成了。

###注意

在创建kindeditor的时候
	editor = K.create('textarea[name="body"]' )  


name对应的值为textarea中的name的值，并且不能包含[]，具体原因还没细看。

因为通过Yii中的form生成的输入框的name是Contact[body] 所以要更改为 body 

当然，除了使用textarea的name属性之外，还可以使用id选择器。在使用id选择器的时候就不会存在以上的问题了。

	editor = K.create("#contract-body")   


###相关API
http://kindeditor.net/demo.php

http://kindeditor.org/