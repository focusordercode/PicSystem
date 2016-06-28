<?php
return array(
	//'配置项'=>'配置值'
	'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'canton',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  'root',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'tbl_',    // 数据库表前缀
    
    'MODULE_ALLOW_LIST'    =>    array('Home','Admin','User'),
    'DEFAULT_MODULE'       =>    'Home', 


    'URL_ROUTER_ON'   => true,
 
     //为rest相关操作设置路由，并设置默认路由返回404
    'URL_ROUTE_RULES'=>array( 
        array('get/ancestors','Category/getAncestors'),
        array('get/sub','Category/getChildren'),
        array('get/all','Category/getAll'),
        array('post/sub','Category/addSub'),
        array('post/ancestors','Category/add'),
        array('delete/sub','Category/Delete'),
        array('update/name','Category/updaName'),

        array('get/appcode','AppCode/getAppCode'),

        array('get/title','Product/getTitle','status=1'),
        array('get/categotitle','Product/getCategoTitle'),
        array('get/productinfo','Product/getInfo'),
    )
);