# Response

> 返回结果 `Response` 用在控制器 `Controller` 中, 
本版本对Response做了重新设计，
仅对结构体 `StructInterface` 数据做支持；
故而，开发务必遵循约束，
保障其逻辑处理结束之后的结果是`StructInterface`实例。


1. 开放
    1. withStruct(StructInterface $struct)
1. 废弃 / deprecated
    1. withError()
    1. withList()
    1. withObject()
    1. withPaging()
    1. withSuccess()



### 标准结构

1. string **errno** - 错误编码
    1. `正确` - 固定为`0`字符串
    1. `错误` - 固定非`0`字符串, `>0` 表示应用级错误, `<0` 表示系统级(或uncatched)错误
1. string **error** - 错误原因
    1. `正确` - 固定为`空字符串`值
    1. `错误` - 具体的错误原因描述, 应该定义或系统级默认
1. string **dataType** 定义data字段的数据类型
    1. `ERROR` - 表示出错时, data字段的结构, 一般同OBJECT类型
    1. `OBJECT` - 表示普通键值对数据
    1. `LIST` - 表示数据列表
    1. `PAGING` - 表示分页数据
1. object **data** 主数据结构, 参考下例


*ERROR*

```text
{
    "errno" : "10001", 
    "error" : "错误原因描述", 
    "dataType" : "ERROR", 
    "data" : {
    }
}
```



*OBJECT*

```text
{
    "errno" : "0", 
    "error" : "", 
    "dataType" : "OBJECT", 
    "data" : {
        "id" : "1", 
        "name" : "value"
    }
}
```



*LIST*

```text
{
    "errno" : "0", 
    "error" : "", 
    "dataType" : "OBJECT", 
    "data" : {
        "body" : [
            {
                "id" : "1", 
                "name" : "value-1"
            },
            {
                "id" : "2", 
                "name" : "value-2"
            }
        ]
    }
}
```



*PAGING*

```text
{
    "errno" : "0", 
    "error" : "", 
    "dataType" : "OBJECT", 
    "data" : {
        "body" : [
            {
                "id" : "1", 
                "name" : "value-1"
            },
            {
                "id" : "2", 
                "name" : "value-2"
            }
        ],
        "paging" : {
            "first": "1",
            "before": "1",
            "current": "1",
            "last": "1",
            "next": "1",
            "totalPages": "1",
            "totalItems": "2"
        }
    }
}
```
