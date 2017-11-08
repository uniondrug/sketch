<?php
/**
 * 应用入口
 */
namespace App;

use App\Providers\SimpleProvider;

class Application extends \Pails\Application
{
    protected $_providers = [
        SimpleProvider::class,
    ];
}
