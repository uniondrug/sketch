# Models

> Model在框架中与数据表绑定，即一个Model对应一张数据表；
其关系为 `1-Table` vs `1-Model` vs `1-Service`。

1. 空间名: `App\Models`
1. 继承自: `Uniondrug\Framework\Models\Model`
1. 表同名: 类命名必须以`大驼峰`且与`数据表同表`, 如表`merchant`对应`Merchant`模型, 表`merchant_contact`对应`MerchantContact`模型。
1. 类注释: 对IDE友好, 需定义以下注释
    1. `@property type $name comment` - 告诉IDE, 该Model下有$name属性, 其值类型为`type`基础类型



### 允许

> 一般情况, 一个Model定义空类即可, 同时满足Model与Table的映射和绑定，也可以有以下允话

1. `常量` - Model/Table固有属性(非property, 如状态位)
    1. `全大写`
    1. `下划线分隔`
    1. `字段名前缀`
1. `静态私有属性` - 对各常量的反射关系
1. `计算属性` - 以getter模式模式读取非表中指定字段的值, 且不接受传参。
1. `指定表名` - 定getSource()方法返回数据表的真实表名, 一般Model的类名与Table名一致, 不需要额外定义。
1. `关系映射` - 如`hasOne`、`hasMonay`等
1. `事件方法` - 如`beforeSave()`、`afterSave()`等



### 禁止

1. 写其它模型数据
1. 操作非relation的Model数据



### 计算属性/方法

> 计算属性用于在对Struct中的字段进行赋值时, 数据源来自getter方法。如

```text
class ExampleStruct extends Struct
{
    /**
     * 使用getCreatedDate()方法的返回值进行赋值
     * @var string
     */
    public $createdDate;
    /**
     * 当入参Model中未定义statusText属性
     * 但定义了getStatusText()方法时, 则
     * 使用getStatusText()方法的返回值
     * @var string
     */
    public $statusText;
}
```

1. 预定义
    1. getCreatedDate() - string - 记录创建日期, 如: 2018-03-23
    1. getCreatedDatetime() - string - 记录创建时间, 如: 2018-03-23 08:09:10
    1. getCreatedtime() - string - 记录创建时间, 如: 09:10
    1. getUpdatedDate() - string - 记录修改日期, 如: 2018-03-23
    1. getUpdatedDatetime() - string - 记录修改时间, 如: 2018-03-23 08:09:10
    1. getUpdatedtime() - string - 记录修改时间, 如: 09:10
1. 自定义
    1. 限返回本Model的数据
    1. 命名以getter模式的驼峰, 如`getStatusText()`
    1. 当进行状态、类型等整型匹配其名称时使用Text后缀, 如: getStatusText(), getMerchantTypeText()


### 示例代码

```text
<?php
namespace App\Models\Example;

use App\Models\Abstracts\Model as FrameworkModel;

class Example extends FrameworkModel
{
    const STATUS_DISABLE = 0;
    const STATUS_ENABLE = 1;
    const STATUS_UNKNOWN = 255;

    private static $statusTexts = [
        Example::STATUS_DISABLE => '禁用',
        Example::STATUS_ENABLE => '启用', 
        Exapmle::STATUS_UNKNOWN => '其它'
    ];
    
    /**
     * 将int型状态位转成状态文本
     * @return string
     */
    public function getStatusText()
    {
        if (isset(static::$statusTexts[$this->status])){
            return static::$statusTexts[$this->status];
        }
        return static::$statusTexts[static::STATUS_UNKNOWN];
    }

    /**
     * 当表名与Model名称一致时不需要定义
     * @return string
     */
    public function getSource()
    {
        return 'example';
    }
}
```