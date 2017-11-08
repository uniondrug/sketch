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
│   │   └── Example.php
│   ├── Services
│   │   └── ExampleService.php
│   ├── Providers
│   │   └── ExampleSProvider.php
│   └── Application.php
├── config
│   └── example.php
├── log
│   └── type
│       └── date.log
├── public
│   └── index.php
├── tmp
└── vendor
    └── uniondrug
        └── service
            ├── src
            │   ├── Exception.php
            │   ├── Registry.php
            │   ├── ResponseWriter.php
            │   ├── ResultReader.php
            │   └── Types.php
            └── README.md
```

*Example Composer*

> composer.json

```json
{
    "name" : "uniondrug/template-service",
    "description" : "Uniondrug",
    "keywords" : [
        "phalcon",
        "php"
    ],
    "license" : "proprietary",
    "type" : "project",
    "authors" : [],
    "require" : {
        "guzzlehttp/guzzle" : "^6.2",
        "uniondrug/framework" : "dev-master",
        "uniondrug/service" : "dev-master",
        "uniondrug/service-client" : "dev-master",
        "uniondrug/service-server" : "dev-master"
    },
    "autoload" : {
        "psr-4" : {}
    },
    "config" : {
        "preferred-install" : "dist",
        "sort-packages" : true
    }
}
```