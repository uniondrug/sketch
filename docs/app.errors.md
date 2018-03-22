# Errors

```text
/── app/Errors
    ├── Code.php
    └── Error.php
```


### 错误定义

* `定义编码` - 应用内部编码, 范围从1开始到9999之间
* `错误消息` - 每一个编码对应一条消息文本, 以数组形式定义
* `编码计算` - 当应用跑出错误异常时, 追加应该的固定值, 以将不同应用间的编码区分开


```text
<?php
namespace App\Errors;

use Uniondrug\Framework\Errors\Code as FrameworkErrorCode;

class Code extends FrameworkErrorCode
{
    const FAILURE_CREATE = 1;
    const FAILURE_UPDATE = 2;
    const FAILURE_DELETE = 3;
    protected static $codeMessages = [
        Code::FAILURE_CREATE => "添加记录失败",
        Code::FAILURE_UPDATE => "编辑记录失败",
        Code::FAILURE_DELETE => "删除记录失败",
    ];
    protected static $codePlus = 10000;
}
```


### 抛出异常

1. 第1参数: `int $code`
    1. 限整型
    1. 限使用常量, 禁止使用Error(1)这类的字面整型
1. 第2参数: `int $message`
    1. 错误原因限字符串
    1. 支持sprintf格式化
1. 第3参数: `... $args` - 不定长和类型的可变数组参数
    1. 仅当第2参数为格式化输出时才需传递
    2. 第3参数`$args`数组长度必须和格式中的变量数量一致


```text
<?php
namespace App\Services;

use App\Errors\Code;
use App\Errors\Error;
use App\Services\Abstracts\Service;

class ExampleService extends Service
{
    public function name1()
    {
        // 预定义消息
        // 定义编号: 1
        // 错误编码: 10001
        // 消息内容: 添加记录失败
        throw new Error(Code::FAILURE_CREATE);
    }

    public function name2()
    {
        // 自定义消息
        // 定义编号: 2
        // 错误编码: 10002
        // 消息内容: 更新Example失败
        throw new Error(Code::FAILURE_UPDATE, "更新Example失败");
    }

    public function name3()
    {
        // 自定义带格式化的消息
        // 定义编号: 3
        // 错误编码: 10003
        // 消息内容: 删除第[3]号记录, 因[不存在]致使失败
        throw new Error(Code::FAILURE_DELETE, "删除第[%d]号记录, 因[%s]致使失败", 3, "不存在");
    }
}
```
