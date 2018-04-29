<?php
/**
 * Redis配置文件。
 *
 * options: Redis服务的配置参数，参考如下：
 * <code>
 *        'options'  => [
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
        'options' => [
            'prefix'     => '_SKETCH_',
            'host'       => '127.0.0.1',
            'port'       => 6379,
            'auth'       => '',
            'persistent' => false,
            'index'      => 0,
        ],
    ],
];