<?php
/**
 * 服务注册中心的配置文件。
 *
 * host: 注册中心服务器地址
 * port: 注册中心服务器端口
 * timeout: 连接超时时间，单位 秒，默认 30
 */
return [
    'default' => [
        'service' => 'http://ns.module.dev.turboradio.cn',
        'timeout' => 30,
    ],
    'testing'=>[
        'service' => 'http://ns.module.test.turboradio.cn',
    ],
    'production'=>[
        'service' => 'http://ns.module.uniondrug.cn',
    ],
];
