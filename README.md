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

#### 2、导入数据结构
```
php yii migrate --migrationPath=@xing/article/migrations
```

#### 3、图片上传配置
##### 单/多文件上传控件配置
将以下配置复制插入至 params.php
（插件地址：https://packagist.org/packages/xing.chen/webuploader)
```php
'xingUploader' => [
    // 前端访问路径
    'visitDomain' => IMG_DOMAIN . 'upload/',
    // 上传url
    'uploadUrl' => 'article/article/file-upload',
    'config' => [
        'defaultImage' => '/images/icon/upload.jpg',
        'disableGlobalDnd' => true,
        'accept' => [
            'title' => 'Images',
            'extensions' => 'jpg,jpeg,bmp,png',
            'mimeTypes' => 'image/jpg,image/jpeg,image/png,image/bmp',
        ],
        'pick' => [
            'multiple' => false,
        ],
    ],
]
```
##### 文件上传配置
（插件地址：https://packagist.org/packages/xing.chen/upload）
```php
'components' => [
    'upload' => [
        'class' => 'xing\upload\core\YiiFactory',
        # 默认使用驱动
        'driveName' => 'ali',
        'config' =>[
            // oss配置
            'ali' => [
                'OSS_ACCESS_ID' => 'OSS_ACCESS_ID',
                'OSS_ACCESS_KEY' => 'OSS_ACCESS_KEY',
                'OSS_ENDPOINT' => 'oss 里的ENDPOINT',
                'UploadBucket' => 'Bucket名称',            //上传到云存储服务器的bucket名字
                'UploadDomain' => 'xxx.com',    //上传文件的Bucket可以自定义域名，对于不同的Bucket使用不同的自定义域名
                'domain' => 'http://xxx.com/',
                'relativePath' => 'upload/',
            ],
            // 上传到自有服务器配置
            'yii' => [
                'uploadPathRoot' => '@api/web/',
                'maxSize' => 2048000,
                'domain' => 'http://xxx.com/',
                'relativePath' => 'upload/',
            ],
        ],
    ]
    ];
```

# yii 框架中使用
很简单，只要在控制器中继承文章系统就可以了，随便你用什么文件夹或模块名

但是前台由于涉及url输出，目前url规则是固定的
##### 前台控制器：
```php
正在开发
```
##### 后台控制器
```php
use \xing\article\backend\controllers\ArticleBaseTrait;
```
##### api控制器
```php
正在开发
```