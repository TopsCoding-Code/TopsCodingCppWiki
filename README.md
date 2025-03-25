# Chinese doc

## TopsCodingCpp

一个使用 PHP 和 MySQL 构造的简易网站，由 wym-code 开发。

### 作用

用来储存 TopsCoding 用户共同维护的 C++ 维基。

用户可以注册、登录，在用户登陆后可以发布评论。

管理员用户可以编辑文章、创建文章和管理文章，管理员权限只能由 MySQL 授予。

### 安装

[Release Page](./releases)

#### 手动安装

下载 `source.zip` 并解压。请确保您已经安装了：PHP，MySQL 和解析器（如 Apache）并配置好 mysqli。

然后解压到您的服务器根目录或者您想安装的目录（可能是 /var/www/html/topscodingcppwiki/），此时在目录里应该能看到多个 `.php` 文件。打开 `configure.php` 并编辑。

`configure.php`：

```php
<?php
$db_hostname="localhost";
$db_username="root";
$db_password="password";
$db_database="database";
...
?>
```

我们推荐您使用 root 用户，否则请确保您的 `username@hostname`（`using password: yes`） 有权限登录。

接下来进入 MySQL 命令行。

```sql
CREATE DATABASE topscodingcppwiki;
USE topscodingcppwiki;
CREATE TABLE articles (
    id CHAR(255) NOT NULL,
    title CHAR(255) NOT NULL,
    content TEXT NOT NULL,
    comments json,
    PRIMARY KEY (id)
);
CREATE TABLE users (
    id INT NOT NULL AUTO_INCREMENT,
    username CHAR(20) NOT NULL,
    password CHAR(255) NOT NULL,
    token CHAR(255) NOT NULL,
    access ENUM('default', 'admin') DEFAULT 'default',
    PRIMARY KEY (id)
);
```

### 管理

#### 设为管理员

在 MySQL 终端，选中数据库，执行：

```sql
UPDATE users SET access = 'admin' WHERE id = <id>;
```

### 使用

#### 登录/注册

login.php/register.php

目前不支持评论，而且没有 UI，正在开发中。。。
