<?php
/**
 * Swoole Server 配置文件。当应用以Swoole方式运行时需要。
 *
 * 用法：
 *
 *  $ composer require uniondrug/server
 *
 *  $ php server start
 *
 */

return [
    'default'    => [
        'host'       => 'http://0.0.0.0:8000', // 改成module分配好的端口号
        'class'      => \Uniondrug\Server\Servitization\Server\HTTPServer::class,
        'options'    => [
            'pid_file'         => __DIR__ . '/../tmp/pid/server.pid',
            'log_file'         => __DIR__ . '/../log/server.log',
            'log_level'        => 0,
            'worker_num'       => 1,
            'task_worker_num'  => 2,
            'max_request'      => 5000,
            'task_max_request' => 5000,
        ],
        'autoreload' => true,
        'processes'  => [
        ],
        'listeners'  => [
            [
                'class' => \Uniondrug\Server\Servitization\Server\ManagerServer::class,
                'host'  => 'tcp://0.0.0.0:7000', // 改成module分配好的端口号，首位换成7
            ],
            [
                'class' => \Uniondrug\Server\Servitization\Server\TCPServer::class,
                'host'  => 'tcp://0.0.0.0:9000', // 改成module分配好的端口号，首位换成9
            ],
        ],
    ],
    'production' => [
        'autoreload' => false,
        'host'       => 'http://10.46.231.5:8000', // 改成module分配好的端口号
        'options'    => [
            'worker_num'      => 4,
            'task_worker_num' => 4,
        ],
        'listeners'  => [
            [
                'class' => \Uniondrug\Server\Servitization\Server\ManagerServer::class,
                'host'  => 'tcp://10.46.231.5:7000', // 改成module分配好的端口号，首位换成7
            ],
            [
                'class' => \Uniondrug\Server\Servitization\Server\TCPServer::class,
                'host'  => 'tcp://10.46.231.5:9000', // 改成module分配好的端口号，首位换成9
            ],
        ],
    ],
];