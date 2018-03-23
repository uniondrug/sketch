# Logics

> 业务逻辑自Controller层抽离, 项目中可以没有Logic层; 
当项目中无Logic层时，相同的业务逻辑代码需编写在Controller的Action方法中。
由于Controller直接处理来自HTTP发起来的请求，当要进行逻辑复用时将无法实现。
为什么要进行Logic层折分呢?

1. `逻辑复用` - 相同逻辑在多个接口、Command、Task等应用场景中复用。
1. `多路切换` - 在特殊场景的灰度发布时, 可按区域或版本等条件, 切换逻辑。
1. `平滑迭代` - 按版本号切换
1. `逻辑合并` - 当新的接口的逻辑来自已有的2或n个逻辑合并时, 从Controller层拼接, 无需重新开发。



> Controller与Logic层对应关系

1. `1-Controller` vs `n-Logic`、
1. `1-Logic` vs `n-Action`


```text
/── app/Logics
    ├── Abstracts
    │   └── Logic.php
    └── Module                  // 数据表的大驼峰
        ├── AddLogic.php        // 添加逻辑
        ├── DelLogic.php        // 删除逻辑
        ├── EditLogic.php       // 编辑逻辑
        ├── ListLogic.php       // 列表逻辑
        ├── PagingLogic.php     // 分页逻辑
        └── TreeLogic.php       // 树结构逻辑
```

### 允许与严禁

> Logic逻辑层的允许与严禁和控制器Controller完全一致, [查看详情](./app.controllers.md)



### 抽象

> 逻辑层下的抽象类, 务必定义在`Abstracts`目录下

* 命名空间 - `App\Logics\Abstracts`
* 命名规则 - `Logic` - 与对外暴露的控制器区分开, 不需要后缀



### 标准

* 命名空间 - `App\Logics\Module`
* 类 命 名 - `ActionLogic` - 以Logic结尾


*逻辑层示例*

```php

use App\Logics\Abstracts\Logic;

class AddLogic extends Logic
{
    /**
     * @param array|null|object $payload 入参
     * @return StructInterface
     */
    public function run($payload)
    {
        // 1. 将入参数转为标准结构体
        $struct = AddStruct::factory($payload);

        // 2. 业务执行过程
        $this->db->begin();
        try{
            // ......
            $result = $this->exampleService->add($struct);
            // ......
            $this->db->commit();
        } catch(\Exception $e) {
            $this->db->rollback();
            throw new Error($e->getCode(), $e->getMessage());
        }
        
        // 3. 返回结果
        return Row::factory($result);
    }
}
```


*控制器层示例*

```text
/**
 * @RoutePrefix(/example)
 */
class ExampleController extends Controller
{
    /**
     * @Post(/add)
     * @return ResponseInterface
     */
    public function addAction()
    {
        // 1. 从HTTP请求中获取入参数据
        $payload = $this->request->getJsonRawBody();
        // 2. 将入参传给逻辑层处理并获取结果
        $results = AddLogic::factory($payload);
        // 3. 输出结果
        return $this->serviceServer->withObject($results)->response();
    }
}
```
