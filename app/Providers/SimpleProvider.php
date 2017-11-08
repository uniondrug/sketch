<?php
/**
 * SimpleProvider.php
 *
 */

namespace App\Providers;

use Phalcon\Di\ServiceProviderInterface;

class SimpleProvider implements ServiceProviderInterface
{
    public function register(\Phalcon\DiInterface $di)
    {
        $di->setShared(
            'someService',
            function () {
                return null;
            }
        );
    }

}
