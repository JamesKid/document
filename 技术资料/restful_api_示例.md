#Restful API 示例
#返回json格式数据
	curl -i -H "Accept:application/json" "http://elearninglmsyii/api/user.html"

	curl -i -H "Accept:application/json" "http://elearninglmsyii/api/user/FD94EF82-12D9-A03E-070F-CD41BE53E303.html"
	
	curl -i -H "Accept:application/json" "http://elearninglmsyii/api/user.html?fields=id,email&expand=fwCompany"


#返回xml格式数据
	curl -i -H "Accept:application/xml" "http://elearninglmsyii/api/user.html"




#增加一个用户
	curl -i -H "Accept:application/json" -H "Content-Type:application/json" -XPOST "http://elearninglmsyii/api/user.html" -d '{"username": "example", "email": "user@example.com"}'


#身份验证
	curl -i -H "Accept:application/json" "http://elearninglmsyii/api/user.html?access-token=21232f297a57a5a743894a0e4a801fc3"


#测试代码
	curl -i -H "Accept:application/json" "http://elearninglmsyii/api/user/test1.html?access-token=21232f297a57a5a743894a0e4a801fc3"

	curl -i -H "Accept:application/json" "http://elearninglmsyii/api/user/test2.html?access-token=21232f297a57a5a743894a0e4a801fc3&kid=1708ED07-D30F-C4D3-D1FB-773FD7D55F49"

	curl -i -H "Accept:application/json" "http://localhost:8092/api/user/login.html?access-token=21232f297a57a5a743894a0e4a801fc3&username=superadmin&password=123456"