<?php
/**
 * Swoole Server 配置文件。当应用以Swoole方式运行时需要。
 * 用法：
 *  $ composer require uniondrug/server
 *  $ php server start
 */
use Uniondrug\Server\Servitization\Server\HTTPServer;

return [
    'default' => [
        'host' => 'http://0.0.0.0:8000',
        'class' => HTTPServer::class,
        'options' => [
            'pid_file' => __DIR__.'/../tmp/server.pid',
            'log_file' => __DIR__.'/../log/server.log',
            'log_level' => 0,
            'worker_num' => 2,
            'task_worker_num' => 8,
            'max_request' => 5000,
            'task_max_request' => 5000
        ],
        'autoreload' => false,
        'processes' => [],
        'listeners' => []
    ],
    'production' => [
        'host' => 'http://10.46.231.5:8000',
        'listeners' => []
    ],
];
