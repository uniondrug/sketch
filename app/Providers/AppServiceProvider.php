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

use App\Services\ExampleService;
use Uniondrug\Framework\Services\ServiceProvider;
use Uniondrug\ServiceSdk\ServiceSdk;

/**
 * @package App\Providers
 */
class AppServiceProvider extends ServiceProvider
{
    public function bootstrap(\Phalcon\DiInterface $di)
    {
        // service sdk usage.
        $di->setShared('exampleService', function () {
            return new ExampleService();
        });
    }
}
