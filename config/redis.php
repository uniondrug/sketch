<?php
/**
 * Redis配置文件。
 * options: Redis服务的配置参数，参考如下：
 * <code>
 *        'options'  => [
 *            'prefix'=> '_PREFIX_', // key值前缀，项目之间隔离区分
 *            'host' => 'localhost',
 *            'port' => 6379,
 *            'auth' => 'foobared',
 *            'persistent' => false, // 持久化连接，默认不持久化
 *            'index' => 0,
 *        ],
 * </code>
 */
return [
    'default' => [
        'persistent' => false,
        'index' => 0,
        'prefix' => '_SKETCH_',
        'host' => '127.0.0.1',
        'port' => 6379,
        'auth' => '',
    ]
];