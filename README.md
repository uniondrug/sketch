# uniondrug framework

> UnionDrug微服务`MicroService`基础框架。

* PHP `7.1+`
* Phalcon `3.2+`

### how to?
```bash
composer create-project uniondrug/sketch myProject
```

### Directory

```text
├── README.md
├── app
│   ├── Controllers
│   │   ├── Abstracts
│   │   │   └── Controller.php
│   │   └── IndexController.php
│   ├── Errors
│   │   ├── Code.php
│   │   └── Error.php
│   ├── Logics
│   │   ├── Abstracts
│   │   │   └── Logic.php
│   │   └── ExampleLogic.php
│   ├── Models
│   │   ├── Abstracts
│   │   │   └── Model.php
│   │   └── Example.php
│   ├── Providers
│   │   └── SimpleProvider.php
│   ├── Services
│   │   ├── Abstracts
│   │   │   ├── Service.php
│   │   │   └── ServiceTrait.php
│   │   └── ExampleService.php
│   └── Structs
│       ├── Abstracts
│       ├── ExampleStruct.php
│       └── Results
│           └── ExampleResult.php
├── composer.json
├── config
│   ├── app.php
│   ├── cache.php
│   ├── database.php
│   ├── exception.php
│   ├── logger.php
│   ├── middlewares.php
│   ├── register.php
│   ├── routes.php
│   ├── server.php
│   └── trace.php
├── log
├── public
│   └── index.php
└── tmp
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
