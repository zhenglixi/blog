<?php
return array(
    // 'SHOW_PAGE_TRACE'       => true,

	'APP_GROUP_LIST'        => 'Index,Admin',  // 开启分组
	'DEFAULT_GROUP'         => 'Index',        // 默认分组
    'APP_GROUP_MODE'        => 1,              // 采用独立分组模式    
    'APP_GROUP_PATH'        => 'Modules',      // 默认模块路径'Modules'

    'LOAD_EXT_CONFIG'       => 'verify,water', // 载入附加配置

    // 路由
    'URL_MODEL'             => 2,              // (U方法)重写模式
    'URL_ROUTER_ON'         => true,
    'URL_ROUTE_RULES'       => array(
        '/^c_(\d+)$/'       => 'Index/List/index?id=:1',
        ':id\d'             => 'Index/Show/index', 
        ),

	// 数据库连接参数
	'DB_HOST'               => '127.0.0.1',    // 服务器地址
    'DB_USER'               => 'root',         // 用户名
    'DB_PWD'                => 'zw726918',     // 密码
    'DB_NAME'               => 'blog',         // 数据库名
    'DB_PREFIX'             => 'hd_',          // 数据库表前缀

    // 点语法默认解析
    // 'TMPL_VAR_IDENTIFY'     => 'array',

    // 模板路径
    // 'TMPL_FILE_DEPR'        => '_',

    // 自定义SESSION 数据库存储
    // 'SESSION_TYPE'          => 'db',
);
?>