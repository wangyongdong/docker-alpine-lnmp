(1) 安装
`cd $HOME && git clone git@github.com:wangyongdong/v2ray-tls-web.git`

```text
├── nginx                    
│   ├── cert                                        HTTPS证书文件目录
│   │   ├── v2ray.crt
│   │   ├── v2ray.key
│   ├── conf                                        配置文件目录
│   │   ├── nginx.conf                              配置文件，在 Dockerfile 中指定，可修改配置后执行
│   │   ├── vhost                                   虚拟主机配置文件
│   │   │    ├── v2ray.conf
│   ├── logs                                        日志目录
│   │   ├── access.log                              日志文件，可以在 nginx.conf 中配置
│   │   ├── error.log                               日志文件，可以在 nginx.conf 中配置
├── v2ray                    
│   ├── Dockerfile                                  官方Dockerfile
│   ├── config.json                                 v2ray配置文件
│   ├── logs                                        日志目录
├── html                                             代码存放处      
```

(2) 获取镜像
docker pull wangyongdong/docker-nginx
docker pull v2ray/dev
 
(3) 修改配置文件
生成新的UUID：[在线UUID生成器](https://www.uuidgenerator.net/)
V2ray的配置可以参考文档[WebSocket+TLS+Web](https://toutyrater.github.io/advanced/wss_and_web.html)
- 域名: www.sitename.com
- v2ray端口: 10080
- proxy_pass: http://127.0.0.1
- pat: /ray
- UUID: 12345678-1234-12345-1234-123456789abc
- HTTPS证书

(4) 部署容器 链接到nginx容器
- 运行v2ray
docker run --name v2ray -p 10080:10080 \
    -v $HOME/docker/v2ray-tls-web/v2ray/config.json:/etc/v2ray/config.json \
    -v $HOME/docker/v2ray-tls-web/v2ray/logs:/var/log/v2ray \
    -d v2ray/dev
- 查看IP `v2ray ip :docker inspect --format='{{.NetworkSettings.IPAddress}}' v2ray`
- 修改 v2ray.conf 的 proxy_pass 地址
- 运行nginx
docker run --name nginx-v2ray -p 443:443 \
    -v $HOME/docker/v2ray-tls-web/html:/usr/local/nginx/html \
    -v $HOME/docker/v2ray-tls-web/nginx/logs:/usr/local/nginx/logs \
    -v $HOME/docker/v2ray-tls-web/nginx/conf/nginx.conf:/usr/local/nginx/conf/nginx.conf \
    -v $HOME/docker/v2ray-tls-web/nginx/conf/vhost:/usr/local/nginx/conf/vhost \
    -v $HOME/docker/v2ray-tls-web/nginx/conf/cert:/usr/local/nginx/cert \
    --link v2ray:v2ray -d wangyongdong/docker-nginx
