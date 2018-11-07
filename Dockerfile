#
# 构建Docker镜像
# 本文件由脚本生成, 请不要修改
# 时间: 2018-11-07 10:53 +0800
#
FROM uniondrug:base

# Copy application Directories and files
COPY app /uniondrug/app/app
COPY composer.json /uniondrug/app/composer.json
COPY composer.lock /uniondrug/app/composer.lock
COPY config /uniondrug/app/config
COPY consul.json /uniondrug/app/consul.json
COPY Dockerfile /uniondrug/app/Dockerfile
COPY dockerfile.sh /uniondrug/app/dockerfile.sh
COPY docs /uniondrug/app/docs
COPY postman.json /uniondrug/app/postman.json
COPY public /uniondrug/app/public
COPY README.md /uniondrug/app/README.md
COPY vendor /uniondrug/app/vendor
# 应用仓库
RUN cd /uniondrug/app && mkdir log tmp && \
    cd /uniondrug/tmp && git clone https://github.com/uniondrug/docker.git . &&\
    php install && \
    chmod +x /usr/local/bin/entrypoint && \
    chown -R uniondrug:uniondrug /uniondrug

# 环境变量
ENV DOCKER_MODE="swoole"
ENV SERVICE_NAME="sketch.module"
ENV SERVICE_PORT="8000"

# 端口与入口
WORKDIR /uniondrug/app
EXPOSE 8000
# ENTRYPOINT ["/usr/local/bin/entrypoint"]
