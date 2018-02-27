<?php
/**
 * 模型的基类，可以在这定义是否使用读写分离。
 */
namespace App\Models;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Behavior\Timestampable;

abstract class AbstractModel extends Model
{
    public function initialize()
    {
        $this->addBehavior(
            new Timestampable(
                [
                    'beforeCreate' => [
                        'field'  => ['gmtCreated', 'gmtUpdated'],
                        'format' => 'Y-m-d H:i:s',
                    ],
                    'beforeUpdate' => [
                        'field'  => 'gmtUpdated',
                        'format' => 'Y-m-d H:i:s',
                    ],
                ]
            )
        );
    }
}
