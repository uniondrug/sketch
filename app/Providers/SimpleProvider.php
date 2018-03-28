<?php
/**
 * SimpleProvider.php
 */
namespace App\Providers;

use Phalcon\Di\ServiceProviderInterface;
use Uniondrug\ServiceSdk\ServiceSdk;
use App\Services\ExampleService;

/**
 * @package App\Providers
 */
class SimpleProvider implements ServiceProviderInterface
{
    public function register(\Phalcon\DiInterface $di)
    {
        // service sdk usage.
        $di->setShared('serviceSdk', function(){
            return new ServiceSdk();
        });
        // service sdk usage.
        $di->setShared('exampleService', function(){
            return new ExampleService();
        });
    }
}
