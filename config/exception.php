<?php
/**
 * 最底层异常处理。
 *
 * 如果在服务或者控制器中没有处理的异常，将会由底层统一处理。
 */
return [
    'default' => [
        'response' => function (Throwable $e) {
            return [
                'error'    => $e->getMessage(),
                'errno'    => (string) $e->getCode() ?: '-1',
                'dataType' => 'ERROR',
            ];
        },
    ],
];
