<?php
/**
 * middlewares.php
 */
return [
    'default' => [
        'middlewares' => [],
        'global' => [
            'cors',
            'favicon',
            'trace',
        ],
        'globalAfter' => [
            'powered',
        ],
        'cache' => [
            'lifetime' => 60,
        ],
        'powered_by' => 'Uinondrug'
    ]
];