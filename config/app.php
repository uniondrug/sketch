<?php
/**
 * 应用配置文件，通用配置你可以在这里处理
 * debug: 调试模式，打开后，系统任何错误会被Phalcon的调试器展示。关闭的话，异常时返回一个错误信息给客户端。
 * appName: 应用名称。
 * providers: 应用需要的服务注入。
 */
use App\Providers\AppServiceProvider;
use Uniondrug\HttpClient\HttpClientServiceProvider;
use Uniondrug\Register\RegisterClientServiceProvider;
use Uniondrug\Service\ServiceServiceProvider;
use Uniondrug\ServiceSdk\SdkServiceProvider;
use Uniondrug\Validation\ValidationServiceProvider;

return [
    'default' => [
        'debug' => false,
        'appName' => 'sketch.module',
        'appVersion' => '3.0.0',
        'useAnnotationRouter' => true,
        'providers' => [
            ServiceServiceProvider::class,
            HttpClientServiceProvider::class,
            ValidationServiceProvider::class,
            SdkServiceProvider::class,
            RegisterClientServiceProvider::class,
            AppServiceProvider::class
        ]
    ]
];
