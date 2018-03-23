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


