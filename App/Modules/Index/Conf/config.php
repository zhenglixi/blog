<?php
return array(
	'APP_AUTOLOAD_PATH' => '@.TagLib',  // 当前项目.标签库路径
	'TAGLIB_BUILD_IN' => 'Cx,Hd',       // ThinkPHP核心标签库名,自定义标签库名

	'HTML_CACHE_ON' => true,            // 开启静态(页面文件)缓存
	'HTML_CACHE_RULES' => array(
		'Show:index' => array('{:module}_{:action}_{id}',3600) // 3600秒;0,永久缓存
		),

	// 'DATA_CACHE_TYPE' => 'Memcache',    // 开启动态缓存(默认'File')
	// 'MEMCACHE_HOST' => '127.0.0.1',
	// 'MEMCACHE_PORT' => 11211,
	);