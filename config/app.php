<?php
/**
 * 应用配置文件，通用配置你可以在这里处理
 *
 * debug: 调试模式，打开后，系统任何错误会被Phalcon的调试器展示。关闭的话，异常时返回一个错误信息给客户端。
 * appName: 应用名称。
 * providers: 应用需要的服务注入。
 */
return [
    'default' => [
        'debug' => true,
        'appName' => 'UniondrugService',
        'providers' => [
            \App\Providers\SimpleProvider::class,
        ]
    ],
];
