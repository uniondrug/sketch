<?php
/**
 * 数据库配置。每个项目要求最多只连接一个数据库。
 * adapter: 适配器，当前只使用mysql
 * debug: 调试模式开关，打开时，会在日志目录记录数据库详细日志；
 * useSlave: 是否读写分离。打开时，需要同时设置 slaveConnection 的内容。
 * connection: 连接参数。
 */
return [
    'default' => [
        'adapter' => 'mysql',
        'debug' => false,
        'useSlave' => false,
        'interval' => 0,
        'connection' => [
            'dbname' => 'test',
            'charset' => 'utf8'
        ]
    ],
    'development' => [
        'connection' => [
            'host' => 'localhost',
            'port' => 3306,
            'username' => 'root',
            'password' => ''
        ]
    ],
    'testing' => [
        'connection' => [
            'host' => 'localhost',
            'port' => 3306,
            'username' => 'root',
            'password' => ''
        ]
    ],
    'release' => [
        'connection' => [
            'host' => 'localhost',
            'port' => 3306,
            'username' => 'root',
            'password' => ''
        ]
    ],
    'production' => [
        'connection' => [
            'host' => 'localhost',
            'port' => 3306,
            'username' => 'root',
            'password' => ''
        ]
    ]
];
