<?php
/**
 * 调用链跟踪服务器设置
 *
 * HTTP方式的采集：
 * enable:  是否将trace信息上报
 * service: 采集服务地址，可以是 tcp://ip:port or http://ip:port
 * timeout: 超时时间
 */
return [
    'default' => [
        'enable'  => true,
        'service' => 'http://127.0.0.1:8081',
        'timeout' => 10,
    ],
];
