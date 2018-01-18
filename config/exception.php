<?php
/**
 * 异常处理。response用作返回格式的封装。
 */
return [
    'default' => [
        'response' => function (Throwable $e) {
            return [
                'error'    => $e->getMessage(),
                'errno'    => $e->getCode() ?: '-1',
                'dataType' => 'ERROR',
            ];
        },
    ],
];
