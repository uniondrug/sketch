# SKETCH

```text
/
└─ example
   ├── app                  # 应用主目录
   ├── config               # 配置文件目录
   ├── docs                 # 文档目录
   ├── log                  # 日志目录
   ├── public               # nginx配置中的root指向目录
   ├── tmp                  # 临时文件存储目录
   ├── vendor               # Composer依赖库目录
   ├── composer.json        # Composer依赖配置文件
   ├── consul.json          # Consul服务配置文件
   ├── postman.json         # Postman文档导出配置文件
   └── README.md            # 项目目录
```



### 快速安装

1. `composer create-project` - 创建项目模板指令
1. `uniondrug/sketch` - 模板项目
1. `<example>` - 安装的项目名称(即: 文件夹名称)

```text
composer create-project uniondrug/sketch <example>
```



### 导出文档

1. `SDK`
1. `MARKDOWN`
1. `POSTMAN`

```bash
php console postman
```



### 服务注册

1. `OP` - 操作类型, 可选register、deregister
1. `OPTIONS` - 支持选项
    1. `--env=development|testing|release|production` - 指定环境名
    1. `--domain=<YES|NO>` - 是否以域名模式注册(默认: YES)
    1. `--docker=<YES|NO>` - 是否Docker容器中注册(默认: NO)
    1. `--service-ip=<127.0.0.1>` - 服务的IP地址或域名
    1. `--service-port=<8080>` - 服务的Port端口号
    1. `--consul-ip=<127.0.0.1>` - Consul安装的IP地址
    1. `--consul-port=<8500>` - Consul安装的Port端口号
    1. `--app-path=<PATH>` - 应用所在目录, 默认当前应用

*语法*

```bash
php console consul OP [OPTIONS]
```

*示例*

```bash
php console consul register \
    --env=release \
    --consul-ip=192.168.3.195 \
    --consul-port=8500 \
    --service-ip=192.168.3.195 \
    --service-port=8080
```



### 构建镜像

> 构建镜像时, 脚本先在项目的根目录生成`Dockerfile`和`dockerfile.sh`二个文件，
然后自动执行`dockerfile.sh`文件并生项目镜像；
项目镜像的关键参数由配置文件`config/app.php`文件定义的如下字段。

1. `app.dockerImage` - 基础镜像名称, 默认: `uniondrug:base`.
1. `app.appName` - 项目镜像名称
1. `app.appVersion` - 项目镜像版本

*快速生成*

```bash
# 生成镜像
php console docker
```

*手动生成*

```bash
# 手动生成镜像
sh dockerfile.sh
```

