<?php
/**
 * 应用配置文件，通用配置你可以在这里处理
 *
 * debug: 调试模式，打开后，系统任何错误会被Phalcon的调试器展示。关闭的话，异常时返回一个错误信息给客户端。
 * appName: 应用名称。
 * providers: 应用需要的服务注入。
 */
return [
    'default'    => [
        'debug'               => true, // 调试开关
        'appName'             => 'UniondrugService', // 应用名称
        'appVersion'          => '1.0.0',
        'useAnnotationRouter' => true, // 是否启用注解路由
        // 服务注册入口
        'providers'           => [
            \App\Providers\SimpleProvider::class,
            \Uniondrug\Service\ServiceServiceProvider::class,
            /**
             * 去掉注册，如果需要用这些服务的话
             */
//            \Uniondrug\Middleware\MiddlewareServiceProvider::class,
//            \Uniondrug\Cache\CacheServiceProvider::class,
//            \Uniondrug\Validation\ValidationServiceProvider::class,
//            \Uniondrug\Register\RegisterClientServiceProvider::class,
        ],
    ],
    'production' => [
        'debug' => false,
    ],
];
