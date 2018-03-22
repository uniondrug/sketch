# Controllers

```text
/── app/Controllers
    ├── Abstracts
    │   └── Base.php
    ├── Traits
    │   └── ExampleTrait.php
    └── IndexController.php
```

### 允许与严禁

1. 允许
    1. DB事务块, 细粒度在Service中实现, 分发到逻辑层进行事务控制
        1. **begin**() - 开启一组事务/$this-db->begin()
        1. **commit**() - 提交一组事务/$this->db->commit()
        1. **rollback**() - 回滚一组事务/$this->db->rollback()
    1. Model字段读, 如 $id = $model->id
1. 严禁
    1. DB读与写操作, 归口到Service中
        1. Model - find/findFirst/save/insert/update/delete()
        1. Query - 编写SQL查询



### 抽像

> 控制器下的抽象类, 务必定义在`Abstracts`目录下

* 命名空间 - `App\Controllers\Abstracts`
* 命名规则 - `Example` - 与对外暴露的控制器区分开, 不需要后缀


### 复用

> 复用Trait在项目中非必须, 视项目自行选择

* 命名空间 - `App\Controllers\Traits`
* 命名规则 - `ExampleTrait` - 以Trait结尾


### 标准

* 命名空间 - `App\Controllers`
* 类 命 名 - `ExampleController` - 以Controller结尾



### 注解路由

1. `@RoutePrefix(/example)` - URL前缀
1. `@Route(/action)` - 不限请求方式, 此时Route支持以下规则
    1. `@Delete(/action)` - 发送DELETE请求
    1. `@Get(/action)` - 发送GET请求
    1. `@Patch(/action)` - 发送PATCH请求
    1. `@Post(/action)` - 发送POST请求
    1. `@Put(/action)` - 发送PUT请求
1. `@Middleware(name)` - 定义中间件支持


*示例*

```php

use App\Controllers\Base;

/**
 * @RoutePrefix(/example)
 */
class ExampleController extends Base
{
    /**
     * HTTP/1.1 GET /example/name1
     * @Get(/name1)
     */
    public function name1Action()
    {
    }

    /**
     * HTTP/1.1 POST /example/name2
     * @Post(/name2)
     */
    public function name2Action()
    {
    }

    /**
     * HTTP/1.1 DELETE /example/name3
     * @Delete(/name3)
     */
    public function name3Action()
    {
    }

    /**
     * HTTP/1.1 PUT /example/name4
     * @Delete(/name4)
     */
    public function name4Action()
    {
    }

    /**
     * HTTP/1.1 PATCH /example/name5
     * @Patch(/name5)
     */
    public function name5Action()
    {
    }
}
```

