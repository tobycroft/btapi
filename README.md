## 宝塔/aaPanel面板API接口PHP版本

##### 环境

- php >=8.0+

#### What's new?

- 支持 Thinkphp8.x
- 支持 PHP8.5不出错
- 同时支持 aaPanel和宝塔面板
- 支持 V2版本的 API

#### 说明

- 优先支持 PHP8.5但是也兼容 PHP8.2

#### Features

| Module | Types | Highlights |
|--------|-------|------------|
| **Websites** | PHP | Create/delete/start/stop sites, domains, SSL, redirects, rewrite rules, backups, traffic limits, password access, logs, PHP version switch |
| **Databases** | MySQL | CRUD, passwords, backup/restore, SQL import |
| **FTP** | — | Accounts CRUD, password change, enable/disable |
| **Files** | — | Upload files |
| **SSL** | — | Let's Encrypt certificates, deploy, renew, close, HTTPS redirect |
| **System** | — | System stats, disk info, network, panel updates, task count |
| **Plugin** | — | Deployment list, setup packages, speed test |

#### 安装

```php
composer require tobycroft/btapi
```

#### 使用说明

```php
use tobycroft\Bt\System;

// Database|File|Ftp|Plugin|Site|System
// 以上都extends了[Base]都可以调用,如以下示例
$bt = new System('http://127.0.0.1:8888', 'Key', 'cookie保存目录设置');
$bt->getSystemTotal();
```