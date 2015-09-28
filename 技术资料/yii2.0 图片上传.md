yii2.0 图片上传

下面小伙就带领大学学习一下 Yii2.0 的图片上传类的使用，还是老样子，如果代码样式混乱，我会附上截图供大家学习。

UserController.php 很重要的一步，那就是 
	
	use yii\web\UploadedFile; 

	public function actionUpload(){
      $model = new  User();  user 为用户表model；
    
      if ($model->load(Yii::$app->request->post()) && $model->validate()) {
             $upload = $this->uploadedFile($model, 'image');
             $uploadpath = $this->fileExists('./images/' . date('Ymd') . '/');  上传路径
     
              if($model->save()){
                   $upload->saveAs($uploadpath . $upload->name);
               }
      }
	}

 	public function uploadedFile($model, $item)
    {
        $upload = UploadedFile::getInstance($model, $item);
        $model->image = $upload->name;

        return $upload;
    }

 	public function fileExists($uploadpath)
    {

        if(!file_exists($uploadpath)){
            mkdir($uploadpath);
        }

        return $uploadpath;
    }


上面只是简单的列出了使用方法，不够详细。在实际开发中需要自己去添加一些验证等等的......下面我简单的解释一下上面的代码。

1、首先我们要生成一个 数据model 的实例 这里我以user  模型做例子

2、然后我们调用 uploadedFile 类，把 UploadedFile类实例化一个对象，顺便把 数据模型里面的 image 参数进行填充数据，就是赋值。

3、调用 UploadedFile 类下面的 saveAs() 方法，将图片保存到你先要存放的目录下即可
4、在 Liunx 下开发过程中，也许会遇到权限问题，将目录权限进行设置即可。


相关的规则设定如下：

	public function rules()
	{
	    return [
	        [['title','content'], 'required','message'=>"{attribute}不能为空"],
	        ['content','string'],
	        ['title','string', 'max' => 225],
	        ['image','file',
	            'extensions'=>['jpg','png','gif'],'wrongExtension'=>'只能上传{extensions}类型文件！',
	            'maxSize'=>1024*1024*2,'tooBig'=>'文件上传过大！',
	            'skipOnEmpty'=>false,'uploadRequired'=>'请上传文件！',
	            'message'=>'上传失败！'
	         ]
	    ];
	}