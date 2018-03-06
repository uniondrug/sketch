<?php
/**
 * 调用链跟踪服务器设置
 *
 * HTTP方式的采集：
 * service: 采集API的完整路径
 *
 * TCP方式的采集：
 * host: 服务器地址
 * port: 服务器端口
 *
 * 上面两个方式都配置，会优先使用TCP方式
 *
 * timeout: 超时时间
 */
return [
    'default' => [
        'service' => 'http://127.0.0.1:8081/collector',
        'host'    => '127.0.0.1',
        'port'    => 9081,
        'timeout' => 10,
    ],
];
