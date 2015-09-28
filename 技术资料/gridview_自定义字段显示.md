#GridView 自定义字段显示
GridView::widget 里面怎么去自定义一个字段，，比如 订单状态，数据库里存的是1 2 3，怎么去对应的去显示？

	[   'class'=>'yii\grid\DataColumn',
                        'label'=>'客户',
                        'attribute'=>'LPT_ID',
                        'format'=>'text',
                        'value'=> function ($model, $key, $index, $cloumn){
                            return $model->LPT_ID==null?'':$model->LPT_ID;
                        },
                    ],