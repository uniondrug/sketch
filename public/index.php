<?php
/**
 * @version 1.0.0
 * @author: Uniondrug
 */

// 打开所有错误
error_reporting(E_ALL);

// Check Phalcon Version
$phalconVersion = phpversion('phalcon');
if (!$phalconVersion || version_compare($phalconVersion, '3.2.0') < 0) {
    echo "Phalcon v3.2.0+ Must Be Installed";
    exit;
}

// Composer Init
require_once __DIR__ . '/../vendor/autoload.php';

// Boot Application
$container = new Pails\Container(dirname(__DIR__));
$container->run(App\Application::class);
