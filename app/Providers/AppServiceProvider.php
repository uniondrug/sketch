<?php
/**
 * 应用内服务注册。
 *
 * 由应用创建的服务：`app/Services`下面的服务，在这里注册服务名称。并且在`app/Services/Abstracts/ServiceTrait.php`内添加属性注解。
 * 这样在开发时，IDE就非常友好的提示了。
 *
 * 非应用内的服务，请在`config/app.php`里面，添加服务的注册。
 */

namespace App\Providers;

use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Text;

/**
 * @package App\Providers
 */
class AppServiceProvider implements ServiceProviderInterface
{
    /**
     * @param \Phalcon\DiInterface|\Uniondrug\Framework\Container $di
     */
    public function register(\Phalcon\DiInterface $di)
    {
        // Register services
        $this->registerServices($di);

        // Other things
    }

    /**
     * 自动注册Services目录下的服务
     *
     * @param \Phalcon\DiInterface|\Uniondrug\Framework\Container $di
     */
    public function registerServices(\Phalcon\DiInterface $di)
    {
        $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($di->appPath() . DIRECTORY_SEPARATOR . 'Services'),
            \RecursiveIteratorIterator::SELF_FIRST);
        foreach ($iterator as $item) {
            if (Text::endsWith($item, 'Service.php', false)) {
                $name = str_replace([$di->appPath() . DIRECTORY_SEPARATOR . 'Services' . DIRECTORY_SEPARATOR, '.php'], '', $item);
                if ($name) {
                    $name = str_replace(DIRECTORY_SEPARATOR, '\\', $name);
                    $serviceBaseName = basename($item, '.php');
                    $serviceClassName = 'App\\Services\\' . $name;
                    $di->setShared(lcfirst($serviceBaseName), $serviceClassName);
                }
            }
        }
    }
}
