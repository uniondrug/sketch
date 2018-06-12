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
    'default'    => [
        'enable'  => true,
        'service' => 'http://trace.module.dev.turboradio.cn',
        'timeout' => 30,
    ],
    'testing'    => [
        'service' => 'http://trace.module.test.turboradio.cn',
    ],
    'production' => [
        'service' => 'http://trace.module.uniondrug.cn',
    ],
];
