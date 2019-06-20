## 挂载目录

### mysql

    - conf                  配置文件
        - my.cnf
    - data                  数据存放
    - log
        - error.log         错误日志
        - slow_query.log    慢查询日志
        
### redis
    
    - conf                  配置文件
        - redis.conf
    - data                  数据存放
    - logs                  数据存放
        - redis.log
    
### php

    - logs                  错误日志
        - error.log
    - conf    
        - php.ini
        - php-fpm.conf
        - www.conf
    
### nginx

    - logs                  日志
        - access.log
        - error.log     
    - cert                  ssl
        - nginx_ssl.key
        - nginx_ssl.pem
    - conf                  配置文件
        - nginx.conf
        - vhost
            - www.site-https.com.conf.bak
            - www.site-test.com.conf.bak
 
 ### v2ray-tls-web
     - html
        - v2ray/index.html
     - nginx   
        - logs                  日志
            - access.log
            - error.log     
        - cert                  ssl
            - v2ray.key
            - v2ray.crt
        - conf                  配置文件
            - nginx.conf
            - vhost
                - v2ray.conf
     - v2ray
         - logs                  日志
             - access.log
             - error.log     
         - config.json
         - Dockerfile   
### www
    - 网站代码存放位置