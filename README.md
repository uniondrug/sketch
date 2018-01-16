# uniondrug framework

> UnionDrug微服务`MicroService`基础框架。

* PHP `7.0+`
* Phalcon `3.2+`

### how to?
```bash
composer create-project uniondrug/sketch myProject
```

### Directory

```text
├── app
│   ├── Controllers
│   │   └── ExampleController.php
│   ├── Models
│   │   ├─  AbstractModel.php
│   │   └── Example.php
│   ├── Services
│   │   ├─  AbstractService.php
│   │   └── ExampleService.php
│   └── Providers
│       └── ExampleProvider.php
├── config
│   └── app.php
├── log
│   └── type
│       └── date.log
├── public
│   └── index.php
├── tmp
└── vendor
    └── 第三方库
```


### 使用命令行

引入命令行工具（按需）

```
$ composer require uniondrug/console
$ php console config
```

### 使用Swoole

引入swoole应用服务器（按需）

```
$ composer require uniondrug/server
$ cp vendor/uniondurg/server/server.php.example config/server.php
$ cp vendor/uniondurg/server/exception.php.example config/exception.php
$ php server start
```

备注：如果出现包冲突，手工编辑项目的`composer.json`，将依赖`fastd/swoole`显式定义在`require`部分，然后执行`composer update`：
```
  "require": {
    ...
    "fastd/swoole": "^2.2@beta",
    "uniondrug/server": "^1.0",
    ...
  },
```