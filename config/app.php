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
        'appName'             => env('APP_NAME', 'UniondrugSketch'), // 应用名称
        'appVersion'          => '1.0.0',
        'useAnnotationRouter' => true, // 是否启用注解路由
        'providers'           => [
            /**
             * 框架服务，如需使用其他框架组件，在这里添加其注册。
             */
            \Uniondrug\Service\ServiceServiceProvider::class, // 核心服务，提供模块输入输出的统一处理方法
            \Uniondrug\HttpClient\HttpClientServiceProvider::class, // httpClient服务
            \Uniondrug\Middleware\MiddlewareServiceProvider::class, // 中间件服务
            \Uniondrug\Validation\ValidationServiceProvider::class, // 验证器服务
            \Uniondrug\Register\RegisterClientServiceProvider::class, // NameService客户端服务
            \Uniondrug\Trace\TraceClientServiceProvider::class, // 链路跟踪客户端服务
            \Uniondrug\ServiceSdk\SdkServiceProvider::class, // SDK 服务

            /**
             * 以下可选服务
             */
            //\Uniondrug\Cache\CacheServiceProvider::class, // 缓存服务 cache， 需安装 uniondrug/cache
            //\Uniondrug\Redis\RedisServiceProvider::class, // Redis服务 redis，需安装 uniondrug/redis

            /**
             * 以下服务依赖swoole
             */
            //\Uniondrug\TcpClient\TcpClientServiceProvider::class, // TCP rpc客户端，需安装 uniondrug/tcp-clent
            //\Uniondrug\Crontab\CrontabServiceProvider::class, // 定时任务服务，需安装 uniondrug/crontab

            /**
             * 应用内服务注册
             */
            \App\Providers\AppServiceProvider::class,
        ],
    ],
    'production' => [
        'debug' => false,
    ],
];
