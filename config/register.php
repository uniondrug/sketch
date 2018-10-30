<?php
/**
 * 服务注册中心的配置文件。
 * host: 注册中心服务器地址
 * port: 注册中心服务器端口
 * timeout: 连接超时时间，单位 秒，默认 30
 */
return [
    'default' => [
        'timeout' => 30
    ],
    'development' => [
        'service' => 'http://ns.module.dev.turboradio.cn'
    ],
    'testing' => [
        'service' => 'http://ns.module.test.turboradio.cn'
    ],
    'release' => [
        'service' => 'http://ns.module.turboradio.cn'
    ],
    'production' => [
        'service' => 'http://ns.module.uniondrug.cn'
    ]
];
