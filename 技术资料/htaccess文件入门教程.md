#.htaccess文件入门教程

Apache服务器的.htaccess是一个非常强大的分布式配置文件，学会使用.htaccess，对虚拟主机用户来说，可以实现众多的功能。这里有一篇很容易让人理解的.htaccess介绍，作为入门文章非常的适合。文章最初来自freewebmasterhelp.com，QiRan作了简单的中文翻译，我稍微作了改动！

# 1.1 什么是.htaccess文件

从本指南中，你将可以学习到有关.htaccess文件及其功能的知识，并用以优化你的网站。尽管.htaccess只是一个文件，但它可以更改服务器的设置，允许你做许多不同的事情，最流行的功能是您可以创建自定义的“404 error”页面。.htaccess 并不难于使用，归根结底，它只是在一个text文档中添加几条简单的指令而已。

首先你要判断主机支持它

这可能很难用简单的答案来回答。许多主机支持.htaccess，但实际上并不会特别声明，许多其他类型的主机有能力但并不允许他们的用户使用. htaccess。一般来说，如果你的主机使用Unix或Linux系统，或任何版本的Apache网络服务器，从理论上都是支持.htaccess的，尽管你的主机服务商可能不允许你使用它。

判断你的主机是否允许.htaccess，一个标志很好的是它是否支持文件夹密码保护。为达到此功能，主机服务商需要使用.htaccess（当然，少数情况下他们虽提供密码保护功能，但却并不允许你使用.htaccess）。如果你不确定自己的主机是否支持.htaccess，最好的办法是上传你自己的.htaccess文件看看是否有用，或者直接发送e-mail向你的主机服务商咨询。

Apache系统中的.htaccess文件(或者”分布式配置文件”提供了针对目录改变配置的方法，即，在一个特定的文档目录中放置一个包含一个或多个指令的文件，以作用于此目录及其所有子目录。作为用户，所能使用的命令受到限制。管理员可以通过Apache的AllowOverride指令来设置。

子目录中的指令会覆盖更高级目录或者主服务器配置文件中的指令。

.htaccess必须以ASCII模式上传，最好将其权限设置为644。

.htaccess可以做大量的事情，包括：文件夹密码保护、用户自动重定向、自定义错误页面、改变你的文件扩展名、封禁特定IP地址的用户、只允许特定IP地址的用户、禁止目录列表，以及使用其他文件作为index文件。

# 1.2 如何创建.httaccess文件

创建.htaccess文件也许会给你带来一些困难。写文件很容易，你只需要在文字编缉器（例如：写字板）里写下适当的代码。真正困难的可能是文件的保存，因为.htaccess是一个古怪的文件名（它事实上没有文件名，只有一个由8个字母组成的扩展名），而在一些系统（如windows 3.1）中无法接受这样的文件名。在大多数的操作系统中，你只需用记事本将文档另存为名为： “.htaccess” （包括引号）。如果这也不行，你需要将其先命名为其它名字（例如htaccess.txt），再将其上传到服务器上，之后直接使用FTP软件来重命名。

**警告**

在使用.htaccess之前，我必须给你一些警告。虽然在服务器上使用.htaccess绝对不太可能给你带来任何麻烦（如果有些东西错了，它只是没效用罢了），但如果你使用Microsoft FrontPage Extensions，就必须特别小心。因为FrontPage Extensions本身使用了.htaccess，因此你不能编辑它并加入你自己的信息。如果确实有这方面的需要（并不推荐，但是可能），你应该先从服务器上下载.htaccess文档（如果存在），之后在前面加上你的代码。

**.httacces文件的配置**

# 2.1.配置.htaccess 自定义错误页

我要介绍的.htaccess的第一个应用是自定义错误页面，这将使你可以拥有自己的、个性化的错误页面（例如找不到文件时），而不是你的服务商提供的错误页或没有任何页面。这会让你的网站在出错的时候看上去更专业。你还可以利用脚本程序在发生错误的时候通知你（例如我使用Free Webmaster Help的PHP脚本程序，当找不到页面的时候自动e-mail给我）。

你所知道的任何页面错误代码（像404找不到页面），都可以通过在.htaccess文件里加入下面的文字将其变成自定义页面：

ErrorDocument errornumber /file.html

举例来说，如果我的根目录下有一个nofound.html文件，我想使用它作为404 error的页面：

ErrorDocument 404 /notfound.html

如果文件不在网站的根目录下，你只需要把路径设置为：

ErrorDocument 500 /errorpages/500.html

以下是一些最常用的错误：

常用的客户端请求错误返回代码：

400 – Bad request 错误请求
401 Authorization Required需要验证
403 Forbidden禁止
404 Not Found找不到页面
405 Method Not Allowed
408 Request Timed Out
411 Content Length Required
412 Precondition Failed
413 Request Entity Too Long
414 Request URI Too Long
415 Unsupported Media Type

常见的服务器错误返回代码：

500 Internal Server Error内部服务器错误

接下来，你要做的只是创建一个错误发生时显示的文件，然后把它们和.htaccess一起上传。

用户可以利用.htaccess指定自己事先制作好的错误提醒页面。一般情况下，人们可以专门设立一个目录，例如errors放置这些页面。然后再.htaccess中，加入如下的指令：

ErrorDocument 404 /errors/notfound.html
ErrorDocument 500 /errors/internalerror.html

一条指令一行。上述第一条指令的意思是对于404，也就是没有找到所需要的文档的时候得显示页面为/errors目录下的notfound.html页面。不难看出语法格式为：

ErrorDocument 错误代码 /目录名/文件名.扩展名

如果所需要提示的信息很少的话，不必专门制作页面，直接在指令中使用HTML号了，例如下面这个例子：

ErrorDocument 401 “你没有权限访问该页面，请放弃！”

# 2.2.配置.htaccess 停示显示目录列表

有些时候，由于某种原因，你的目录里没有index文件，这意味着当有人在浏览器地址栏键入了该目录的路径，该目录下所有的文件都会显示出来，这会给你的网站留下安全隐患。

为避免这种情况（而不必创建一堆的新index文件），你可以在你的.htaccess文档中键入以下命令，用以阻止目录列表的显示： Options -Indexes

# 2.3.配置.htaccess 阻止/允许特定的IP地址

某些情况下，你可能只想允许某些特定IP的用户可以访问你的网站（例如：只允许使用特定ISP的用户进入某个目录），或者想封禁某些特定的IP地址（例如：将低级用户隔离于你的信息版面外）。当然，这只在你知道你想拦截的IP地址时才有用，然而现在网上的大多数用户都使用动态IP地址，所以这并不是限制使用的常用方法。

你可以使用以下命令封禁一个IP地址：

deny from 000.000.000.000

这里的000.000.000.000是被封禁的IP地址，如果你只指明了其中的几个，则可以封禁整个网段的地址。如你输入210.10.56.，
则将封禁210.10.56.0～210.10.56.255的所有IP地址。

你可以使用以下命令允许一个IP地址访问网站：

allow from 000.000.000.000

被允许的IP地址则为000.000.000.000，你可以象封禁IP地址一样封禁整个网段。

如果你想阻止所有人访问该目录，则可以使用：

deny from all

不过这并不影响脚本程序使用这个目录下的文档。

# 2.4.配置.htaccess 替换index文件

改变缺省的首页文件

一般情况下缺省的首页文件名有default、index等。不过，有些时候目录中没有缺省文件，而是某个特定的文件名，比如在w3sky中是 w3sky.PHP。这种情况下，要用户记住文件名来访问很麻烦。在.htaccess中可以轻易的设置新的缺省文件名：

DirectoryIndex 新的缺省文件名

也可以列出多个，顺序表明它们之间的优先级别，例如：

DirectoryIndex filename.html index.cgi index.pl default.htm

也许你不想一直使用index.htm或index.html作为目录的索引文件。举例来说，如果你的站点使用PHP文件，你可能会想使用 index.PHP来作为该目录的索引文档。当然也不必局限于“index”文档，如果你愿意，使用.htaccess你甚至能够设置 foofoo.balh来作为你的索引文档！

这些互为替换的索引文件可以排成一个列表，服务器会从左至右进行寻找，检查哪个文档在真实的目录中存在。如果一个也找不到，它将会把目录列表显示出来（除非你已经关闭了显示目录文件列表）。

DirectoryIndex index.PHP index.PHP3 messagebrd.pl index.html index.htm

# 2.5.配置.htaccess 重定向页面

.htaccess最有用的功能之一就是将请求重定向到同站内或站外的不同文档。这在你改变了一个文件名称，但仍然想让用户用旧地址访问到它时，变的极为有用。另一个应用（我发现的很有用的）是重定向到一个长URL，例如在我的时事通讯中，我可以使用一个很简短的URL来指向我的会员链接。以下是一个重定向文件的例子：

Redirect /location/from/root/file.ext

http://www.othersite.com/new/file/location.xyz

上述例子中，访问在root目录下的名为oldfile.html可以键入：

/oldfile.html

访问一个旧次级目录中的文件可以键入：

/old/oldfile.html

你也可以使用.htaccess重定向整个网站的目录。假如你的网站上有一个名为olddirectory的目录，并且你已经在一个新网站 http://www.newsite.com/newdirectory/上建立了与上相同的文档，你可以将旧目录下所有的文件做一次重定向而不必一一声明：

Redirect /olddirectory http://www.newsite.com/newdirectory

这样，任何指向到站点中/olddirectory目录的请求都将被重新指向新的站点，包括附加的额外URL信息。例如有人键入：

http://www.youroldsite.com/olddirecotry/oldfiles/images/image.gif

请求将被重定向到：

http://www.newsite.com/newdirectory/oldfiles/images/image.gif

如果正确使用，此功能将极其强大。

我们可能对网站进行重新规划，将文档进行了迁移，或者更改了目录。这时候，来自搜索引擎或者其他网站链接过来的访问就可能出错。这种情况下，可以通过如下指令来完成旧的URL自动转向到新的地址：

Redirect /旧目录/旧文档名 新文档的地址

或者整个目录的转向：

Redirect 旧目录 新目录

# 3.1.密码保护的.htaccess文件

尽管有各种各样的.htaccess用法，但至今最流行的也可能是最有用的做法是将其用于网站目录可靠的密码保护。尽管JavaScrip等也能做到，但只有.htaccess具有完美的安全性（即访问者必须知晓密码才可以访问目录，并且绝无“后门”可走）。

利用.htaccess将一个目录加上密码保护分两个步骤。第一步是在你的.htaccess文档里加上适当的几行代码，再将.htaccess文档放进你要保护的目录下：

AuthName ‘Section Name’
AuthType Basic
AuthUserFile /full/path/to/.htpasswd
Require valid-user

你可能需要根据你的网站情况修改一下上述内容中的一些部分，如用被保护部分的名字”Members Area”，替换掉”Section Name”。

/full/parth/to/.htpasswd则应该替换为指向.htpasswd文件（后面详述该文档）的完整服务器路径。如果你不知道你网站空间的完整路径，请询问一下你的系统管理员。

# 3.2.密码保护的.htpasswd文件

目录的密码保护比.htaccess的其他功能要麻烦些，因为你必须同时创建一个包含用户名和密码的文档，用于访问你的网站，相关信息（默认）位于一个名为.htpasswd的文档里。像.htaccess一样，.htpasswd也是一个没有文件名且具有8位扩展名的文档，可以放置在你网站里的任何地方（此时密码应加密），但建议你将其保存在网站Web根目录外，这样通过网络就无法访问到它了。

# 3.3.配置 .htaccess 输入用户名和密码

要利用.htaccess对某个目录下的文档设定访问用户和对应的密码，首先要做的是生成一个.htpasswd的文本文档，例如：

forge:y4E7Ec8e7EwV

这里密码经过加密，用户可以自己找些工具将密码加密成.htaccess支持的编码。该文档最好不要放在www目录下，建议放在www根目录文档之外，这样更为安全些。

有了授权用户文档，可以在.htaccess中加入如下指令了：

AuthUserFile .htpasswd的服务器目录
AuthGroupFile /dev/null （需要授权访问的目录）
AuthName EnterPassword
AuthType Basic （授权类型）

require user wsabstract （允许访问的用户，如果希望表中所有用户都允许，可以使用 require valid-user）

注，括号部分为学习时候自己添加的注释

**拒绝来自某个IP的访问**

如果我不想某个政府部门访问到我的站点的内容，那可以通过.htaccess中加入该部门的IP而将它们拒绝在外。

例如：
order allow,deny
deny from 210.10.56.32
deny from 219.5.45.
allow from all

第二行拒绝某个IP，第三行拒绝某个IP段，也就是219.5.45.0~219.2.45.255

**想要拒绝所有人？**用deny from all好了。不止用IP，也可以用域名来设定。

创建好.htpasswd文档后（可以通过文字编辑器创建），下一步是输入用于访问网站的用户名和密码，应为：

username:password

password的位置应该是加密过的密码。你可以通过几种方法来得到加密过的密码：一是使用一个网上提供的permade脚本或自己写一个；另一个很不错的username/password加密服务是通过KxS网站，这里允许你输入用户名及密码，然后生成正确格式的密码。

对于多用户，你只需要在.htpasswd文档中新增同样格式的一行即可。另外还有一些免费的脚本程序可以方便地管理.htpasswd文档，可以自动新增/移除用户等。

# 3.4.配置.htaccess 直接访问加密网站

当你试图访问被.htaccess密码保护的目录时，你的浏览器会弹出标准的username/password对话窗口。如果你不喜欢这种方式，有些脚本程序可以允许你在页面内嵌入username/password输入框来进行认证，你也可以在浏览器的URL框内以以下方式输入用户名和密码（未加密的）：

http://username:password@www.website.com/directory/

# 3.5.利用 .htaccess 防止盗链

如果不喜欢别人在他们的网页上连接自己的图片、文档的话，也可以通过htaccess的指令来做到。

所需要的指令如下：

RewriteCond %{HTTP_REFERER} !^$

RewriteCond %{HTTP_REFERER} !^http://www.smyx.net/.*$ [NC]

RewriteCond %{HTTP_REFERER} !^http://www.smyx.net$	  [NC]

RewriteCond %{HTTP_REFERER} !^http://www.smyx.net/.*$	  [NC]

RewriteCond %{HTTP_REFERER} !^http://www.smyx.net$	  [NC]

RewriteRule .*\.(jpg|jpeg|gif|png)$ http://xxx.cn/xxx.gif [R,NC]

# 3.6.利用 .htaccess进行地址转向

这种方法，就是把yourdomain.com的流量全部301转向到www.yourdomain.com(或者反过来)。其实对于这种方法，国外有人认为对PageRank没有帮助。我觉得是因为他们看到Google管理员工具中有一个首选域工具，可以指定Google的爬虫把 www.yourdomain.com或者yourdomain.com作为抓取和排名的首选域，转向似乎就没有必要了。但确实又有不少人证实这是有效的，反正目前还没有人说这种方法会对SEO或者pagerank有什么损害。

在.htaccess中写入:

RewriteEngine On

RewriteCond %{HTTP_HOST} ^example.com$ [OR]

RewriteCond %{HTTP_HOST} ^www.example.com$

RewriteRule ^(.*)$ http://www.smyx.net/$1 [L,R=301]


# 3.7.利用 .htaccess对域名中 www 的控制

**强制去除www**，你可以把代码改成这样：

RewriteEngine On

RewriteCond %{HTTP_HOST} ^www.smyx.net [NC]

RewriteRule ^(.*)$ http://www.smyx.net/$1 [L,R=301]


请阅读本站文章：域名301跳转的实现方法

**域名前强制加上www**

如果你实在是坚持要把 www 加在前面，我上面的算是白写了，表示遗憾。但，你可以把代码改成这样：

RewriteEngine On

RewriteCond %{HTTP_HOST} ^smyx.net$ [NC]

RewriteRule ^(.*)$ http://www.smyx.net/$1 [L,R=301]


# 4.1. .htaccess 总结

.htaccess是一个站点管理员可以应用的强大工具，有更多的变化以适应不同的用途，可以节约时间及提高网站的安全性

## .htaccess的特别说明

* 启用.htaccess，需要修改httpd.conf，启用AllowOverride，并可以用AllowOverride限制特定命令的使用
* 如果需要使用.htaccess以外的其他文件名，可以用AccessFileName指令来改变。例如，需要使用.config ，则可以在服务器配置文件中按以下方法配置：

## AccessFileName .config

* 一般情况下，不应该使用. htaccess文件，除非你对主配置文件没有访问权限。有一种很常见的误解，认为用户认证只能通过.htaccess文件实现，其实并不是这样，把用户认证写在主配置文件中是完全可行的，而且是一种很好的方法。.htaccess文件应该被用在内容提供者需要针对特定目录改变服务器的配置而又没有 root权限的情况下。如果服务器管理员不愿意频繁修改配置，则可以允许用户通过.htaccess文件自己修改配置，尤其是ISP在同一个机器上运行了多个用户站点，而又希望用户可以自己改变配置的情况下。虽然如此，一般都应该尽可能地避免使用.htaccess文件。任何希望放在.htaccess文件中的配置，都可以放在主配置文件的段中，而且更高效。避免使用.htaccess文件有两个主要原因，即性能和安全。

# 附：.htaccess工具连接

在线 .htaccess文件生成器

http://cooletips.de/htaccess

能够在线生成. htaccess文件，很简单的就配置重定向,系统错误文件等。

.htaccess在线制作

http://cn.htaccess.tk/

可自定义默认编码，错误页面等等