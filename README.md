# 部署说明

## composer 下载 vendor 目录

```
composer install --prefer-dist
```

> 每次更新 composer.lock 文件后都要重新执行该命令

## 生成配置文件

开发：

```
php init --env=Development --overwrite=all
```

测试：

```
php init --env=Test --overwrite=all
```

正式：

```
php init --env=Production --overwrite=all
```

> 不同环境的配置建议放在environments目录下，每次修改配置后都要重新执行以上命令
