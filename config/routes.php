<?php
/**
 * 自定义路由的配置文件，可以不定义。
 * 默认的路由是：
 *   /controller/action/params0/params1/params2...  完整的控制器、方法、参数规则
 *   /controller  只有控制器，调用默认的indexAction()方法
 * 本文件可以额外定义，方法如下：
 *  '/my/route' => 'controller::action' 这个方法定义简单，不限制请求的HTTP方法。
 * 或者：
 *  '/my/route' => ['path' => 'controller::action', 'methods' => ['GET', 'POST']]  这个方法可以限制请求的HTTP方法
 * 自定义路由的优先级高于默认路由。
 * 举例：
 *      '/mm'  => 'orders::list',
 *      '/mmm' => ['path' => 'orders::list', 'methods' => ['GET']],
 */
return [
    'default' => []
];
