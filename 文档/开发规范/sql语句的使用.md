#sql语句的使用

##一些基本约定
1. 对于基本的增删改，都用model实现，不要去用insert语句
2. 关于删除，原则上都是update is_deleted字段，而不是物理删除
3. 如果使用sql查询，查询条件不要忘记is_deleted
4. 如果使用sql查询，表名记得转换一下，不要直接带有前缀，用$tableName = self::CalculateTableName($model->tableName());
5. sql语句一般写在service层，如果有必要可以构建ViewModel