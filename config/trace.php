<?php
/**
 * 调用链跟踪服务器设置
 * HTTP方式的采集：
 * service: 采集API的完整路径
 * TCP方式的采集：
 * host: 服务器地址
 * port: 服务器端口
 * 上面两个方式都配置，会优先使用TCP方式
 * timeout: 超时时间
 */
return [
    'default' => [
        'enable' => false,
        'timeout' => 30
    ],
    'development' => [
        'service' => 'http://trace.module.dev.turboradio.cn'
    ],
    'testing' => [
        'service' => 'http://trace.module.test.turboradio.cn'
    ],
    'release' => [
        'service' => 'http://trace.module.turboradio.cn'
    ],
    'production' => [
        'service' => 'http://trace.module.uniondrug.cn'
    ]
];
