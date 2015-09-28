#iframe中子父窗口互调的js方法

##一、父窗口调用iframe子窗口方法 
1、HTML语法：

	<iframe name="myFrame" src="child.html"></iframe> 
2、父窗口调用子窗口：

	myFrame.window.functionName(); 
3、子窗品调用父窗口：

	parent.functionName(); 
简单地说,也就是在子窗口中调用的变量或函数前加个parent.就行 

4、父窗口页面源码： 
复制代码 代码如下:

	<html> 
	<head> 
	<script type="text/javascript"> 
		function say() { 
			alert("parent.html------>I'm at parent.html"); 
		} 
		function callChild() 
		{ 
			//document.frames("myFrame").f1(); 
			myFrame.window.say(); 
		} 
		</script> 
	</head> 
	<body> 
		<input type=button value="调用child.html中的函数say()" onclick="callChild()"> 
		<iframe name="myFrame" src="child.html"></iframe> 
		</body> 
	</html>

5、子窗口页面： 

复制代码 代码如下:

	<html> 
	<head> 
	<script type="text/javascript"> 
	function say() 
	{ 
		alert("child.html--->I'm at child.html"); 
	} 
	function callParent() { 
		parent.say(); 
	} 
	</script> 
	</head> 
	<body> 
		<input type=button value="调用parent.html中的say()函数" onclick="callParent()"> 
	</body> 
	</html>

##二、iframe 父窗口和子窗口相互的调用方法 
###1、IE中使用方法： 

父窗口调用子窗口：

iframe_ID.iframe_document_object.object_attribute = attribute_value 

例子：onClick="iframe_text.myH1.innerText='http://www.pint.com';" 

子窗口调用父窗口：

parent.parent_document_object.object_attribute = attribute_value 

例子：onclick="parent.myH1.innerText='http://www.pint.com';" 

###2、Firefox中使用方法： 
上面在IE下没有问题，但在firefox下不正常。在firefox下，应该是如下调用方法： 

父窗口调用子窗口：

window.frames["iframe_ID"].document.getElementById("iframe_document_object"­).object_attribute = attribute_value 

例： window.frames["iframe_text"].document.getElementById("myH1").innerHTML= "http://hi.jb51.net/"; 

子窗口调用父窗口：

parent.document.getElementById("parent_document_object").object_attribute = attribute_value 

例： parent.document.getElementById("myH1").innerHTML = "http://jb51.net/"; 

###3、完整的例子 
test.htm 

复制代码 代码如下:

	<HTML> 
	<HEAD> 
	<TITLE> Test Page </TITLE> 
	<script src="prototype-1.4.0.js"></script> 
	<script language="javascript"> 
	function show() 
	{ 
	window.frames["iframe_text"].document.getElementById("myH1").innerHTML = "http://hi.jb51.net/"; 
	} 
	</script> 
	</HEAD> 
	<BODY> 
	<iframe height="350" width="600" src="iframe_test.htm" name="iframe_text"></iframe> 
	<form action="" method="post"> 
	<input name="haha" id="haha" type="text" maxlength="30" value="haha" /> 
	<br /> 
	<textarea cols="50" rows="5" id="getAttributeMethod"></textarea> 
	<input type="button" onClick="show();" value="提交"/> 
	</form> 
	<h1 id="myH1">d</h1> 
	</BODY> 
	</HTML>

frame_test.htm 

代码如下:

	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
	<html xmlns="http://www.w3.org/1999/xhtml"> 
	<head> 
	<meta http-equiv="Content-Type" content="text/html; charset=gb2312" /> 
	<title>无标题文档</title> 
	</head> 
	<script language="javascript"> 
	function show() 
	{ 
		parent.document.getElementById("myH1").innerHTML = http://jb51.net/; 
	} 
	</script> 
	<body> 
	<h1 id="myH1">ha</h1> 
	<form action="" method="post"> 
	<input name="abc" id="abc" type="text" maxlength="30" value="abc" /> 
	<br /> 
	<textarea cols="50" rows="10" id="text"></textarea> 
	<br /> 
	<input type="button" value="提交" onclick="show();"/> 
	</form> 
	</body> 
	</html>

test.htm里面firefox下访问iframe 必须用name，不能用id，所以要改为name="iframe_test" 

##三、在c#中如何动态改变iframe的src值，动态指向一个网页
 
1)如果是javascript脚本 

给iframe加一个ID如<iframe id=frmList…… 

在脚本写 

frmList.document.location=strNewUrl 

2)如果是后台程序 

给iframe加一个ID，再加上runat=server 如<iframe id=frmList runat=server …… 

在程序里写 

frmList.Attributes.Add("src",strNewUrl); 