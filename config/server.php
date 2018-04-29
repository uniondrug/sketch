<?php
/**
 * Swoole Server 配置文件。当应用以Swoole方式运行时需要。
 *
 * 如果项目用Swoole运行，首先请配置服务的IP和端口，避免启动时与其他项目冲突。
 *
 * 用法：
 *
 *  $ composer require uniondrug/server
 *
 *  $ php server start
 *
 */

return [
    'default'     => [
        'host'       => 'http://0.0.0.0:8080',
        'class'      => \Uniondrug\Server\Servitization\Server\HTTPServer::class,
        'options'    => [
            'pid_file'        => __DIR__ . '/../tmp/pid/server.pid',
            'worker_num'      => 2,
            'task_worker_num' => 1,
        ],
        'autoreload' => false,
        'processes'  => [
            /**
             * 定时任务进程，需要时开启
             */
            //\Uniondrug\Crontab\Processes\ExecProcess::class,
            //\Uniondrug\Crontab\Processes\ManagerProcess::class,
        ],
        'listeners'  => [
            [
                'class' => \Uniondrug\Server\Servitization\Server\ManagerServer::class,
                'host'  => 'tcp://0.0.0.0:7080',
            ],
            /**
             * TCP方式服务调用
             */
//            [
//                'class' => \Uniondrug\Server\Servitization\Server\TCPServer::class,
//                'host'  => 'tcp://0.0.0.0:9080',
//            ],
        ],
    ],
    'development' => [
        'autoreload' => true,
        'processes'  => [
            \Uniondrug\Server\Processes\ReloadProcess::class,
        ],
    ],
    'production'  => [
        'host'      => 'http://0.0.0.0:8080',
        'options'   => [
            'worker_num'      => 8,
            'task_worker_num' => 2,
        ],
        'listeners' => [
            [
                'class' => \Uniondrug\Server\Servitization\Server\ManagerServer::class,
                'host'  => 'tcp://0.0.0.0:7080',
            ],
        ],
    ],
];
