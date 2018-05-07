<?php
/**
 * middleware.php
 *
 * 中间件配置文件
 *
 * middlewares: 应用自定义中间件的别名和类名的映射
 * global: 全局使用的中间件，前置调用，可用的有：
 *          cors,
 *          cache,
 *          favicon,
 *          trace,
 *          powered
 * globalAfter: 全局使用的中间件，后置第阿勇，可用的有：
 *          powered
 *
 * 其他：每个中间件的参数
 *
 * aliasName => configValue
 */
return [
    'default' => [
        // 应用定义的中间件
        'middlewares' => [
        ],

        // 全局中间件，会应用在全部路由，优先级在应用定义之前
        'global'      => [
            'cors',
            'cache',
            'favicon',
            'trace',
        ],

        // 全局中间件，会应用在全部路由，优先级在应用定义之后
        'globalAfter' => [
            'powered',
        ],

        // 以下是中间件用到的配置参数
        'cache'       => [
            'lifetime' => 60,
        ],

        'powered_by' => 'Uinondrug',
    ],
];