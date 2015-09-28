#mysql启动和关闭外键约束的方法(FOREIGN_KEY_CHECKS) 
在MySQL中删除一张表或一条数据的时候，出现

	[Err] 1451 -Cannot delete or update a parent row: a foreign key constraint fails (...) 

这是因为MySQL中设置了foreign key关联，造成无法更新或删除数据。可以通过设置FOREIGN_KEY_CHECKS变量来避免这种情况。

###禁用外键约束，我们可以使用:

	SET FOREIGN_KEY_CHECKS=0;
  
###启动外键约束，我们可以使用:

    SET FOREIGN_KEY_CHECKS=1;

###查看当前FOREIGN_KEY_CHECKS的值，可用如下命令：

    SELECT  @@FOREIGN_KEY_CHECKS; 