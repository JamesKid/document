#Yii2 Ajax Validation
##1.Form需要支持ajax验证
 	<?php $form = ActiveForm::begin(['id' => 'login-form',
                'method' =>'post',
                'enableAjaxValidation' => true,
                'enableClientValidation' => true,
                ]); ?>
                
                
##2.按钮需要转换成ajax事件处理
	function ajaxSubmit(frm, fn) {
            $.ajax({
                cache: true,
                type: frm.method,
                url: frm.action,
                data: $(frm).serializeArray(),
                async: false,
                success: fn
            });
        }

        $().ready(function () {
            var formID = "login-form";// 你的formid

            $('#'+formID).bind('submit', function(){
                ajaxSubmit(this, function(data){
                    alert(JSON.stringify(data));

                });
                return false;
            });
        });
        
        
##3.返回值返回成JSON格式，以便后期处理
	if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()))
        {
            if (!$model->validate()) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
        }