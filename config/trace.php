<?php
/**
 * 调用链跟踪服务器设置
 *
 * HTTP方式的采集：
 * service: 采集API的完整路径，可以是 tcp://ip:port or http://ip:port，也可是一个在服务中心注册的服务，比如：trace
 * timeout: 超时时间
 */
return [
    'default' => [
        'service' => 'http://127.0.0.1:8081',
        'timeout' => 10,
    ],
];
