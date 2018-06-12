<?php
/**
 * middlewares.php
 */
return [
    'default' => [
        // 应用定义的中间件
        'middlewares' => [],
        // 全局中间件，会应用在全部路由，优先级在应用定义之前
        'global' => [
            'cors',
            'favicon',
            'trace',
        ],
        // 全局中间件，会应用在全部路由，优先级在应用定义之后
        'globalAfter' => [
            'powered',
        ],
        // 以下是中间件用到的配置参数
        'cache' => [
            'lifetime' => 60,
        ],
        'powered_by' => 'Uinondrug',
    ],
];