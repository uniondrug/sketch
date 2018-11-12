#
# 构建Docker镜像
# 本文件由脚本生成, 请不要修改
# 时间: 2018-11-12 14:11 +0800
#
FROM uniondrug:base

# 拷贝项目文件
# 1. 目录
# 2. 文件
COPY app /uniondrug/app/app
COPY composer.json /uniondrug/app/composer.json
COPY config /uniondrug/app/config
COPY consul.json /uniondrug/app/consul.json
COPY public /uniondrug/app/public
COPY README.md /uniondrug/app/README.md
COPY vendor /uniondrug/app/vendor
# 应用仓库
# 1. 补全项目目录
# 2. Clone工具项目/github
# 3. 变项属主
RUN cd /uniondrug/app && mkdir log tmp && \
    cd /uniondrug/tmp && git clone https://github.com/uniondrug/docker.git . && git checkout master && git pull && \
    php install && \
    chmod +x /usr/local/bin/entrypoint && \
    chown -R uniondrug:uniondrug /uniondrug

# 环境变量
ENV REPOSITORY_URL="https://github.com/uniondrug/sketch.git"
ENV REPOSITORY_BRANCH="master"
ENV SERVICE_MODE="swoole"
ENV SERVICE_NAME="sketch.module"
ENV SERVICE_VERSION="2.0.0"
ENV SERVICE_IP=""
ENV SERVICE_PORT="8080"
# 端口与入口
WORKDIR /uniondrug/app
EXPOSE 8080
ENTRYPOINT ["/usr/local/bin/entrypoint"]
CMD ["start"]
