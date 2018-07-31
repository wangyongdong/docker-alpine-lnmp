<?php
//实例化redis
$redis = new Redis();
//连接
//$redis->connect('172.17.0.2', 6379);
$redis->connect('redis', 6379);
$redis->auth('123456'); //密码验证
//检测是否连接成功
echo "Server is running: " . $redis->ping();