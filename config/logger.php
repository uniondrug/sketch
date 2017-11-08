<?php
/**
 * 系统默认日志配置，目前就一个参数。
 *
 * 系统默认的日志服务的名称是：logger，也就是说在控制器里面，$this->logger->info() 即可记录日志。
 *
 * 1、路径目录：
 * 日志路径在 log/app/YYYY-MM-DD.log
 * 如果设置分隔目录： log/app/YYYY-MM/YYYY-MM-DD.log
 *
 * 2、分类日志：
 * 默认日志分类是app。可以使用的时候，选择或者设置日志分类。
 * 比如，在控制器里面： $this->di->getLogger('orders')->info('balabala'); 会将日志记录在 log/orders/ 目录下面。
 */
return [
    'development' => [
        'splitDir' => false, // 按月分隔目录
    ],
];
