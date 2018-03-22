# Services

> Service作为Model的扩展, 关系为 `1-Service` vs `1-Model`, 
一个Service仅可操作(增、删、改、查)与其对应的Model数据，
禁止在指定Service中操作其它Model数据，参数可以为其它Model。



### 入参类型

> Service定义方法时，其入参必须为以下当中的1或2个；最多不得超过3个。
在约大多数场景中, 其它所需入参应该包含在Struct结构体或Model中。

1. `integer` **$id** - 整型参数, 如按ID值进行查询
1. `string` **$column** - 字符串参数, 如按字段值进行查询
1. `Phalcon\Mvc\ModelInterface` **$model** - 模型参数, 如修改、删除指定模型数据
1. `Uniondrug\Structs\StructInterface` **$struct** - 结构参数, 标准化的入参类型

*示例*

```text
class ExampleService extends Service
{
    // 省略
    public function edit(Example $model, EditStruct $struct)
    {
        // 省略...
        if ($model->save()){
            return $model;
        }
        throw new Error(Code::FAILURE_UPDATE, "修改%d号数据失败", $model->id);
    }
}
```


### 返回类型

> Service进行业务逻辑处理时, 一般返回如下固定的数据类型；
严禁在Service中通过调用`toArray()`、`toJson()`方法转换结果；
实际转换过程应在Logic层按需转换，当转换后，计算属性将丢失，
限制了Logic层的业务处理与Struct层的数据解析。

1. `boolean` - 业务逻辑进行是、否判断，如`isAccess(ModelInterface $model)`。
1. `integer` - 如业务数据进行数量计算；如子菜单数量
1. `Phalcon\Mvc\ModelInterface` - 返回指定Model
1. `Phalcon\Mvc\Model\ResultsetInterface` - 如通过find()方法返回的指定Model列表
1. `Phalcon\Mvc\Model\Resultset\Complex` - 如通过Builder创建的自定义查询结果
1. `Phalcon\Mvc\Model\Resultset\Simple` - 如通过Builder创建的自定义查询结果
1. `\stdClass` of `Phalcon\Mvc\Model\Query\Builder->getPaginate()` - 分页结果 `slice of the resultset`

*示例*

```text
class ExampleService extends Service
{
    // 省略
    public function getList(ListStruct $struct)
    {
        $builder = $this->modelsManager->createBuilder();
        $builder->from(['m' => Merchant::class]);
        $builder->where("m.merchantType = :merchantType:", ['merchantType' => $struct->merchantType]);
        $builder->innerJoin(MerchantContact::class, "m.merchantId = c.merchantId", "c");
        return $this->withQueryList($builder);
    }
}
```


### 保留方法

> 保留方法指按约定保留的几个方法, 用于统一的使用原则

1. `ModelInterface` - **add**(`AddStruct` **$struct**) - 添加记录
1. `ModelInterface` - **del**(`ModelInterface` **$model**) - 删除
1. `ModelInterface` - **edit**(`ModelInterface` **$model**, `EditStruct` **$struct**) - 编辑记录
1. `ModelInterface|false` - **getById**(`int` **$id**) - 按主键值读取Model
1. `ResultsetInterface` - **getList**(`ListStruct` **$struct**) - 读取列表
1. `\stdClass` - **getPaging**(`PagingStruct` **$struct**) - 读取分页



### 推荐方法

1. `int` - **delByModel**(`ModelInterface` **$model**)
1. `ModelInterface` - **getByColumn**(`int` **$id**)



### 允许

1. `抛异常` - 单个业务操作失败, 可以抛出[Error](./app.errors.md)异常, 用于在Logic逻辑控制时触发rollback回滚。


### 禁止

1. `验证入参` - 以`StructInterface`、`ModelInterface`为入参时, 其数据以可信为前提，禁止再验证
1. `修改入参` - 禁止在Service中修改入参对象的值
1. `多业务` - 禁止在一个方法中操作多个业务
    1. 2个或以下的读
    1. 增、改、删混用
1. `DB事务` - 禁止在Service中直接使用事务, 但凡事务必须在Logic逻辑层合并, 遵循
    1. 1个方法只干一件事



```text
<?php
namespace App\Services;

use App\Services\Abstracts\Service;

class ExampleService extends Service
{
    /**
     * 添加记录
     * @param AddStruct $struct 入参结构体
     * @return Example
     * @throws Error
     */
    public function add(AddStruct $struct)
    {
        // 省略
    }
}
```
