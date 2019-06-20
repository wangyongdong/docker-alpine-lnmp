## alpine-lnmp
> The docker-compose.yml include PHP7、NGINX、MySql、Redis
> 一键安装 LNMP 环境 

### Build Images

- [alpine](https://github.com/wangyongdong/docker-alpine/tree/master/alpine)
- [Redis](https://github.com/wangyongdong/docker-alpine/tree/master/Redis)
- [MySql](https://github.com/wangyongdong/docker-alpine/tree/master/mysql)
- [Nginx](https://github.com/wangyongdong/docker-alpine/tree/master/nginx)
- [PHP](https://github.com/wangyongdong/docker-alpine/tree/master/php)


### Directory
```text
/
├── data                                               数据挂载目录
│   ├──mysql                                          MySql挂载目录
│   │   ├── conf                                     配置文件目录
│   │   │   ├── my.cnf                              配置文件，在 Dockerfile 中指定，可修改配置后执行
│   │   ├── data                                     数据目录
│   │   ├── logs                                     日志目录
│   │   │   ├── error.log                           错误日志，可以在 my.cnf 中配置
│   │   │   ├── slow_query.log                      慢查询日志，可以在 my.cnf 中配置
│   │ 
│   ├── nginx                                         Nginx挂载目录
│   │   ├── cert                                     HTTPS证书文件目录
│   │   ├── conf                                     配置文件目录
│   │   │   ├── nginx.conf                          配置文件，在 Dockerfile 中指定，可修改配置后执行
│   │   │   ├── vhost                               虚拟主机配置文件
│   │   │   │    ├── www.site-https.com.conf       虚拟主机配置示例
│   │   │   │    ├── www.site-test.com.conf        虚拟主机配置示例
│   │   ├── logs                                     日志目录
│   │   │   ├── access.log                          日志文件，可以在 nginx.conf 中配置
│   │   │   ├── error.log                           日志文件，可以在 nginx.conf 中配置
│   │ 
│   ├── php                                           PHP挂载目录
│   │   ├── conf                                     配置文件目录
│   │   │   ├── php.ini                             配置文件，在 Dockerfile 中指定，可修改配置后执行
│   │   │   ├── php-fpm.conf                        配置文件，可修改配置后执行
│   │   │   ├── www.conf                            配置文件，可修改配置后执行
│   │   ├── logs                                     日志目录
│   │   │   ├── error.log                           日志文件，可以在 php-fpm.conf 中配置
│   │   
│   ├── redis                                         REDIS挂载目录
│   │   ├── conf                                     配置文件目录
│   │   │   ├── redis.conf                          配置文件，在 Dockerfile 中指定，密码在此修改，可修改配置后执行
│   │   ├── data                                     数据目录
│   │   ├── logs                                     日志目录
│   │   │   ├── redis.log                           日志文件，可以在 redis.conf 中配置
│   │   
│   ├── www                                           代码存放目录
│
├── docker-compose.yml                                 docker-compose 文件
```

### Custom
    
    - 自定义端口
    - 自定义数据库密码
    - 自定义redis密码
    - 自定义挂载目录，确保挂载目录有相应的文件

### Require

    - `git`
    - `docker`
    - `docker-compose`
    
### Use

    - `git clone git@github.com:wangyongdong/alpine-lnmp.git` 克隆项目
    - `cd alpine-lnmp`
    - `docker-compose up -d` RUN

#### Composer
    
    PHP 容器已经安装 Composer，使用时进入到容器内部执行
    
    `docker exec -it php /bin/sh`
    
    然后进入对应目录执行：`composer update`

### HTTPS

      - 1. 将证书文件分别命名为 `nginx_ssl.pem`，`nginx_ssl.key`，存放在 `data/nginx/cert` 目录下
      - 2. 修改 `nginx.conf` 或 虚拟主机配置文件 `vhost/www.xxx.conf`，示例查于 `www.site-https.com.conf`
      - 3. 修改 `www.site-https.com.conf` 去掉 `default_server` ，不去掉的话会报错
      - 4. `docker-compose up -d`
      - 5. 输入 `https://xxx` 测试

### v2ray

若要配置使用v2ray
- 1. cp -R ./data/v2ray-tls-web/html/www.seeyd.com/ ./data/alpine-lnmp/data/www
- 2. cp -R ./data/v2ray-tls-web/nginx/conf/vhost/v2ray.conf ./data/alpine-lnmp/data/nginx/conf/vhost/
- 3. cp -R ./data/v2ray-tls-web/nginx/cert/v2ray.* ./data/alpine-lnmp/data/nginx/cert/
- 4. 修改 `docker-compose.yml` v2ray的端口
- 5. 配置config.json `port` `listen` `id` `path`
- 6. 配置v2ray.conf `server_name` `location` `proxy_pass` `root` （先查询IP `docker inspect -f '{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}'`）
- 7. `docker-compose up -d`
- 8. 测试是否nginx容器可以ping通v2ray容器

参考[v2ray-tls-web](https://github.com/wangyongdong/v2ray-tls-web/blob/master/README.md)

### Test

    - 127.0.0.1     访问链测试
    - 127.0.0.1/mysql.php 测试mysql，默认使用容器名连接，可以修改连接ip地址
    - 127.0.0.1/redis.php 测试redis，默认使用容器名连接，可以修改连接ip地址，redis密码在配置文件中修改
    -  `docker exec -it nginx ping v2ray` 查看ngxin是否可以链接到v2ray
    - 查看IP `docker inspect -f '{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}' v2ray`
    - 修改 v2ray.conf 的 proxy_pass IP地址，然后再次测试
    
### DEBUG

    - `docker-compose ps` 查看运行容器
    - `docker-compose stop` 停止容器
    - `docker-compose rm` 删除容器
    - `docker inspect xxx` 查看运行容器ip
    - `docker network ls` 查看网络
    

