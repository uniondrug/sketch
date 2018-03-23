<?php
/**
 * SimpleProvider.php
 */
namespace App\Providers;

use App\Services\ExampleService;
use Phalcon\Di\ServiceProviderInterface;

class SimpleProvider implements ServiceProviderInterface
{
    public function register(\Phalcon\DiInterface $di)
    {
        $di->setShared('exampleService', function(){
            return new ExampleService();
        });
    }
}
