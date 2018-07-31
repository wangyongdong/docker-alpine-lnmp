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
├── data                    配置文件目录
│   ├── mysql               mysql 目录
│   ├── nginx               nginx 目录
│   ├── php                 php 目录
│   ├── redis               redis 目录
│   ├── www                 PHP代码目录
│   ├── nginx.conf          Nginx默认配置文件
│   ├── mysql.cnf           MySQL用户配置文件
│   ├── php-fpm.conf        PHP-FPM配置文件（部分会覆盖php.ini配置）
│   └── php.ini             PHP默认配置文件
├── docker-compose.yml       docker-compose 文件
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
    
### Test

    - 127.0.0.1     访问链测试
    - 127.0.0.1/mysql.php 测试mysql，默认使用容器名连接，可以修改连接ip地址
    - 127.0.0.1/redis.php 测试redis，默认使用容器名连接，可以修改连接ip地址
    
### DEBUG

    - `docker-compose ps` 查看运行容器
    - `docker-compose stop` 停止容器
    - `docker-compose rm` 删除容器
    - `docker inspect xxx` 查看运行容器ip
    

