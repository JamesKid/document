#1.composer国内镜像：

**1.先找到config文件**

	sudo composer config -l -g

**2.修改config.json配置文件**

（注：“/root/.composer/”，要用第一步中看到的
home路径替换）

	$ sudo vim /root/.composer/config.json

**3.修改config.json配置文件，增加镜像地址**

最终结果如下：

	{
		"config": {

    	},
    	"repositories": [
        	{"type": "composer", "url": "http://pkg.phpcomposer.com/repo/packagist/"},
        	{"packagist": false}
    	]
    }
    
**4.修改composer.json配置文件，增加镜像地址**

	{
    	"repositories": [
                {"type": "composer", "url": "http://pkg.phpcomposer.com/repo/packagist/"},
                {"packagist": false}
            ]
    }
            
#2.Yii安装第三方控件问题：

**如果出现如下错误：**

	Problem 1
	
	yiisoft/yii2-jui 2.0.0 requires bower-asset/jquery-ui 1.11.*@stable -> no matching package found.
	
	yiisoft/yii2-jui 2.0.0 requires bower-asset/jquery-ui 1.11.*@stable -> no matching package found.

**需要执行如下命令：**

	composer global require "fxp/composer-asset-plugin:1.0.0"