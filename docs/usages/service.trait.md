# Service Trait

> 定义对IDE友好支持, 使用在项目中使用 `$this->exampleService` 代替 `new ExampleService()`；
实现上述IDE支持, 需按如下步骤定义


### 定义空Trait

1. 空间: `App\Services\Abstracts\ServiceTrait`
1. 用法: 定义 `@property` 注释
1. 格式: `@property type $variable`


```text
/**
 * @property ExampleService $exampleService 示例Service
 */
trait ServiceTrait 
{
    // no code
}
```


### Provide

> 完成前一步空Trait定义时, 仅在IDE环境下友好, 并未实现实例对象注入；按下例操作

1. 空间: `App\Providers\SimpleProvider`
1. 方法: 手动定义shared注入

```text
<?php
namespace App\Providers;

use Phalcon\Di\ServiceProviderInterface;
use App\Services\ExampleService;

class SimpleProvider implements ServiceProviderInterface
{
    public function register(\Phalcon\DiInterface $di)
    {
        // 按需导入
        $di->setShared('exampleService', function () {
            return new ExampleService();
        });
        // 导入更多... 
        // 代码同上, 省略
    }
}
```


