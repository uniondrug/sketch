# sketch

1. `composer.json` - 第3方PHP运行扩展依赖
1. `consul.json` - 注册Consul服务依赖
1. `postman.json` - 导出文档依赖


### 生成文档

> 生成文档时, 包括`markdown`、`postman.json`、`SDK`扩展，位于项目的`docs`目录下。

```bash
php console postman
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

