<?php
/**
 * middlewares.php
 *
 */
return [
    'default' => [
        // 应用定义的中间件
        'middlewares' => [
            'test1' => \App\Middlewares\Test1Middleware::class,
            'test2' => \App\Middlewares\Test2Middleware::class,
            'test3' => \App\Middlewares\Test3Middleware::class,
            'test4' => \App\Middlewares\Test4Middleware::class,
            'test5' => \App\Middlewares\Test5Middleware::class,
        ],

        // 全局中间件，会应用在全部路由，优先级在应用定义之前
        'global'      => [
            'cors', 'cache', 'favicon', 'trace',
        ],

        // 全局中间件，会应用在全部路由，优先级在应用定义之后
        'globalAfter' => [
            'powered',
        ],

        // 以下是中间件用到的配置参数
        'cache'       => [
            'lifetime' => 60,
        ],
        'powered_by'  => 'Uinondrug',
    ],
];