# article
文章管理系统，目前支持Yii框架，其他框架如果有做开发的话会进行开发

包含

api：文章列表、内容获取、栏目获取

前台：文章列表和内容、栏目的输出

后台：文章增删查改，栏目管理

# 安装
#### 1、获取扩展插件
```
composer require xing.chen/article
```

#### 2、导入数据
```
php yii migrate --migrationPath=@xing/article/migrations
```

# yii 框架中使用
在控制器中继承文章系统
##### 前台控制器：
```php
use \xing\article\yii\frontend\controllers\ArticleBaseTrait;
```
##### 后台控制器
```php
正在开发
```
##### api控制器
```php
正在开发
```