<?php
//$servername = "172.17.0.4";
$servername = "mysql";
$username = "root";
$password = "123456";

try {
    $conn = new PDO("mysql:host=$servername;", $username, $password);
    echo "连接成功";
}
catch(PDOException $e)
{
    echo $e->getMessage();
}
?>