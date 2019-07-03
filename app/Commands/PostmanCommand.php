<?php
/**
 * @author wsfuyibing <websearch@163.com>
 * @date   2019-07-03
 */
namespace App\Commands;

use Uniondrug\Postman\Commands\Postman;

/**
 * 生成项目级文档
 * <code>
 * php console postman
 * </code>
 * @package App\Commands
 */
class PostmanCommand extends Postman
{
    /**
     * 命令名称
     * @var string
     */
    protected $signature = 'postman';
    /**
     * 命令描述
     * @var string
     */
    protected $description = '导出Postman/Markdown文档、SDK模板';

    /**
     * @inheritdoc
     */
    public function handle()
    {
        parent::handle();
    }
}
