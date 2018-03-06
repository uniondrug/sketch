<?php
/**
 * middlewares.php
 *
 */
return [
    'default' => [
        'cors'  => \Uniondrug\Middleware\Middlewares\CorsMiddleware::class,
        'trace' => \Uniondrug\Middleware\Middlewares\TraceMiddleware::class,
    ],
];