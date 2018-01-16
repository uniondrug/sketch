# uniondrug framework

> UnionDrug微服务`MicroService`基础框架。

* PHP `7.0+`
* Phalcon `3.2+`

### how to?
```bash
composer create-project uniondrug/sketch myProject
```

*Directory*

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

*Example Composer*

> composer.json

```json
{
  "name": "uniondrug/sketch",
  "description": "Uniondrug Service Application Template",
  "keywords": ["phalcon", "framework", "php"],
  "license": "proprietary",
  "type": "project",
  "authors": [
    {
      "name": "Uniondrug R&D Team",
      "email": "dev@uniondrug.cn"
    }
  ],
  "require": {
    "guzzlehttp/guzzle" : "^6.2",
    "uniondrug/framework": "^1.0",
    "uniondrug/service": "dev-master",
    "uniondrug/service-client": "dev-master",
    "uniondrug/service-server": "dev-master"
  },
  "autoload": {
    "psr-4": {
      "App\\": "app/"
    }
  },
  "config": {
    "preferred-install": "dist",
    "sort-packages": true,
    "bin-dir": ""
  }
}
```
