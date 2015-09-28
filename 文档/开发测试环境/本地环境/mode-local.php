<?php
defined('YII_DEBUG') or define('YII_DEBUG', true);//开发环境用true, 生产环境用false，为true时开启debug工具条
defined('YII_ENV') or define('YII_ENV', 'dev');//开发环境用dev, 生产环境用prod，为dev时错误页面显示详细信息
error_reporting(E_ERROR);//开发环境需要此行, 生产环境注释此行