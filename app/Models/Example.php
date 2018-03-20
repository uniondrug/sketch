<?php
/**
 * @author wsfuyibing <websearch@163.com>
 * @date 2018-03-19
 */
namespace App\Models;

use App\Models\Abstracts\Model;

/**
 * 每1个Model对应一张数据表
 * @package App\Models
 */
class Example extends Model
{
    /**
     * 常量定义Model'属性'
     */
    const STATUS_ENABLE = 1;

    /**
     * 计算属性
     * 1. 结构体中定义类属性`statusText`映射到该方法返回值
     * 2. Service使用$model->getStatusText()读取
     * @return mixed
     */
    public function getStatusText()
    {
        return "ENABLE";
    }
}
