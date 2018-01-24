<?php
/**
 * middlewares.php
 *
 */
return [
    'default' => [
        'cors' => \UniondrugMiddleware\Middlewares\CorsMiddleware::class,
    ],
];