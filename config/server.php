<?php
/**
 * Swoole Server 配置文件。当应用以Swoole方式运行时需要。
 * 用法：
 *  $ composer require uniondrug/server
 *  $ php server start
 */
use Uniondrug\Server\Servitization\Server\HTTPServer;
use Uniondrug\Server\Servitization\Server\ManagerServer;
use Uniondrug\Server\Servitization\Server\TCPServer;

return [
    'default' => [
        'host' => 'http://0.0.0.0:8000',
        'class' => HTTPServer::class,
        'options' => [
            'pid_file' => __DIR__.'/../tmp/pid/server.pid',
            'log_file' => __DIR__.'/../log/server.log',
            'log_level' => 0,
            'worker_num' => 1,
            'task_worker_num' => 2,
            'max_request' => 5000,
            'task_max_request' => 5000,
        ],
        'autoreload' => true,
        'processes' => [],
        'listeners' => [
            [
                'class' => ManagerServer::class,
                'host' => 'tcp://0.0.0.0:7000',
            ],
            [
                'class' => TCPServer::class,
                'host' => 'tcp://0.0.0.0:9000',
            ],
        ],
    ],
    'production' => [
        'autoreload' => false,
        'host' => 'http://10.46.231.5:8000',
        'options' => [
            'worker_num' => 4,
            'task_worker_num' => 4,
        ],
        'listeners' => [
            [
                'class' => ManagerServer::class,
                'host' => 'tcp://10.46.231.5:7000',
            ],
            [
                'class' => TCPServer::class,
                'host' => 'tcp://10.46.231.5:9000',
            ],
        ],
    ],
];