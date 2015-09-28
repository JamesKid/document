#Ubuntu下搭建PHP+Nginx环境

## 1.先更新ubuntu系统
	apt-get install python-software-properties
	sudo add-apt-repository ppa:ondrej/php5
	sudo apt-get update
	sudo apt-get upgrade

## 2.安装nginx
	sudo apt-get install nginx
安装之后的文件结构大致为：

* 所有的配置文件都在/etc/nginx下，并且每个虚拟主机已经安排在了/etc/nginx/sites-available下
* 日志放在了/var/log/nginx下
* 并已经在/etc/init.d/下创建了启动脚本nginx
* 默认的虚拟主机的目录设置在了/var/www/nginx-default

## 3.启动nginx
	sudo service nginx start
	或
	sudo /etc/init.d/nginx start
访问即可看到nginx欢迎界面


此时可以检查nginx的版本信息

	nginx –v

## 4.安装php环境
	sudo apt-get install php5 php5-cli php5-cgi php5-mysql
可能需要用到的库：
	
	apt-get install curl libcurl3 libcurl3-dev php5-curl
	apt-get install php5-mcrypt
	apt-get install php5-xmlrpc 
	apt-get install php5-gd 

	apt-get install php5-fpm php5-cgi php5-mysql php5-curl php5-gd php5-intl php-pear php5-imagick php5-imap php5-mcrypt php5-memcache php5-ming php5-ps php5-pspell php5-recode php5-snmp php5-sqlite php5-tidy php5-xmlrpc php5-xsl php5-json php5-common php-apc php5-dev libpcre3-dev  

此时可以检查php的版本信息，需要确保是5.5以上版本

	php –version

## 5.安装fastcgi运行环境
	sudo apt-get install spawn-fcgi



## 6.配置nginx
修改nginx的配置文件：/etc/nginx/sites-available/default
 
修改主机名: 
server_name localhost;

修改index的一行为:
index index.php index.html index.htm;

去掉下面部分的注释用于支持php脚本:

	location ~ \.php$ {
	    fastcgi_pass 127.0.0.1:9000;
	    fastcgi_index index.php;
	    fastcgi_param SCRIPT_FILENAME /var/www/nginx-default$fastcgi_script_name;  
		#fastcgi_param 设置参数 /var/www/nginx-default需要修改成root目录
	    include fastcgi_params;
	}

配置完毕后，重启nginx
	
	sudo service nginx restart

## 7.用spawn-fcgi启动php5-cgi

	spawn-fcgi -a 127.0.0.1 -p 9000 -C 10 -u www-data -f /usr/bin/php5-cgi

设置成自启动，我们可以直接在/etc/rc.local中添加启动脚本。

	spawn-fcgi -a 127.0.0.1 -p 9000 -C 10 -u www-data -f /usr/bin/php-cgi 

注：需要添加到语句： exit 0 前面才行


## 8.测试

在/var/www/nginx-default下新建一个index.php文件

	<?php echo phpinfo(); ?>

访问 http://localhost 即可测试成功


## 9.配置php.ini

	upload_max_filesize = 200M

	max_execution_time 600 每个PHP页面运行的最大时间值(秒)，默认30秒 
	max_input_time 600 每个PHP页面接收数据所需的最大时间，默认60秒 
	memory_limit 220M 每个PHP页面所吃掉的最大内存，默认128M 
	post_max_size = 220M 指通过表单POST给PHP的所能接收的最大值，包括表单里的所有值。默认为8M 

	max_input_vars = 5000 限制提交的表单数量

	max_execution_time = 1000     ; Maximum execution time of each script, in seconds
	max_input_time = 1000 ; Maximum amount of time each script may spend parsing request data
	memory_limit = 512M      ; Maximum amount of memory a script may consume 


## 10.本项目配置nginx的方法：

	server {
        listen   8088; ## listen for ipv4; this line is default and implied
        listen   [::]:8088 default ipv6only=on; ## listen for ipv6
        
        client_max_body_size 200M;        

        root /hpe/git_root/elearningLMS/SourceCode;
        index index.php index.html index.htm;

        server_name localhost;
		
		
		location /backend/ {
			try_files $uri $uri/ /backend/index.php?$args;
		}

		location /api/ {
			try_files $uri $uri/ /api/index.php?$args;
		}

		
		location / {
                # First attempt to serve request as file, then
                # as directory, then fall back to index.html
                try_files $uri $uri/ /index.php?$args;
				
                # Uncomment to enable naxsi on this location
                # include /etc/nginx/naxsi.rules
        }

		#location /index.html {
		#	rewrite ^ /index.html break; 
		#}

        # pass the PHP scripts to FastCGI server listening on 127.0.0.1:9000
        #
        location ~ \.php$ {
        #       fastcgi_split_path_info ^(.+\.php)(/.+)$;
        #       # NOTE: You should have "cgi.fix_pathinfo = 0;" in php.ini
        #
        #       # With php5-cgi alone:
                fastcgi_pass 127.0.0.1:9000;
				
        #       # With php5-fpm:
        #       fastcgi_pass unix:/var/run/php5-fpm.sock;
		
                fastcgi_index index.php;
				
        #        fastcgi_param SCRIPT_FILENAME /hpe/git_root/elearningLMS/SourceCode$fastcgi_script_name;
		
                include fastcgi_params;
        }
		
		location ~ /\.(ht|svn|git) {
			deny all;
		}
	}


## 11.efront配置方法

	location ~ /efront/.+\.php  {
		root /hpe/git_root/lms1.0;
		fastcgi_pass 127.0.0.1:9000;
		fastcgi_index index.php;
		include fastcgi_params;
	}
		
	location /efront {
		root /hpe/git_root/lms1.0;
		index index.php;
	}

## 12.重新加载配置
	service php5-fpm reload
还有其他参数，包 括：start|stop|quit|restart|reload|logrotate，修改php.ini后不重启php-cgi，重新加载配置文件 使用reload。