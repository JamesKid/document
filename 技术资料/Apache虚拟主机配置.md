#Apache虚拟主机配置

##增加监听端口（修改conf/httpd.conf文件）
	Listen 127.0.0.1:8092

##修改主站点权限（修改conf/httpd.conf文件）

	<Directory />
		AllowOverride none
		# Require all denied
	</Directory>

##允许虚拟主机配置（修改conf/httpd.conf文件）
	# Virtual hosts
	Include conf/extra/httpd-vhosts.conf

##增加虚拟主机配置（修改conf/extra/httpd-vhosts.conf文件）

	<VirtualHost *:8092> 
		ServerAdmin webmaster@dummy-host.localhost 
		DocumentRoot "D:/Work/HP/E-Learning/elearningLMS/SourceCode" 
		ServerName localhost 
	
		DirectoryIndex index.php index.html index.htm
		<Directory "D:/Work/HP/E-Learning/elearningLMS/SourceCode"> 
			Options Indexes FollowSymLinks 
			AllowOverride all 
			Order allow,deny 
			Allow from all 
		</Directory> 
	</VirtualHost> 

##增加别名配置
    <IfModule alias_module>
        Alias /eft "/efront"
    </IfModule>


##需要注意打开如下项目

	LoadModule rewrite_module modules/mod_rewrite.so

	在php.ini文件中
	short_open_tag = On

	开启xdebug（开发环境需要）
	xdebug.remote_enable = on

##CGI模式需要做如下配置

	LoadModule fcgid_module modules/mod_fcgid.so

	<IfModule mod_fcgid.c>
	AddHandler fcgid-script .fcgi .php
	# Where to look for the php.ini file?
	FcgidInitialEnv PHPRC        "C:/Php/php-5.5.29-nts-Win32-VC11-x86"
	# Set PHP_FCGI_MAX_REQUESTS to greater than or equal to FcgidMaxRequestsPerProcess
	# to prevent php-cgi process from exiting before all requests completed
	FcgidInitialEnv PHP_FCGI_MAX_REQUESTS      1000
	# Maximum requests a process should handle before it is terminated
	FcgidMaxRequestsPerProcess       1000
	# Maximum number of PHP processes
	FcgidMaxProcesses             100
	# Number of seconds of idle time before a php-cgi process is terminated
	FcgidIOTimeout             120
	FcgidIdleTimeout                120
	#200MB上传
	FcgidMaxRequestLen 204800000 
	#Path to php-cgi
	FcgidWrapper "C:/Php/php-5.5.29-nts-Win32-VC11-x86/php-cgi.exe" .php
	# Define the MIME-Type for ".php" files
	AddType application/x-httpd-php .php
	</IfModule>

	另外还需要修改
 	Options Indexes FollowSymLinks Includes ExecCGI