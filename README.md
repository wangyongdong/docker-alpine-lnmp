## alpine-lnmp
> The docker-compose.yml include PHP7、NGINX、MySql、Redis

### Custom
    
    - 自定义端口
    - 自定义数据库密码
    - 自定义redis密码
    - 自定义挂载目录，确保挂载目录有相应的文件
    
### RUN
    - `git clone git@github.com:wangyongdong/alpine-lnmp.git` 克隆项目
    - `cd alpine-lnmp`
    - `docker-compose up -d`
    
### DEBUG

    - `docker-compose ps` 查看运行容器
    - `docker-compose stop` 停止容器
    - `docker-compose rm` 删除容器
    - `docker inspect xxx` 查看运行容器ip
    
### Test

    - 127.0.0.1/index.php 查看phpinfo
    - 127.0.0.1/mysql.php 测试mysql，默认使用容器名连接，可以修改连接ip地址
    - 127.0.0.1/redis.php 测试redis，默认使用容器名连接，可以修改连接ip地址
