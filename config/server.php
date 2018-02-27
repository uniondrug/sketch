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
    'default' => [
        'host'      => 'http://0.0.0.0:9527',
        'class'     => \Uniondrug\Server\Servitization\Server\HTTPServer::class,
        'options'   => [
            'pid_file'        => __DIR__ . '/../tmp/pid/server.pid',
            'worker_num'      => 1,
            'task_worker_num' => 1,
        ],
        'processes' => [
        ],
        'listeners' => [
            [
                'class' => \Uniondrug\Server\Servitization\Server\ManagerServer::class,
                'host'  => 'tcp://0.0.0.0:9530',
            ],
        ],
    ],
];
