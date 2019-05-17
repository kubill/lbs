#LBS插件库
------------

支持 Google、高德、腾讯、百度 

Install using composer:

```bash
composer require kubill/lbs
```
配置
-
在使用之前，去个平台获取相应的key

基本用法
-----------

```php
use Kubill\Lbs\GeoCoder;

$geoCoder = new GeoCoder($key,$driver);
$geoCoder->addr2coder($addr);
```

在 laravel 中使用
-
```php
php artisan vendor:publish --provider="Kubill\Lbs\ServiceProvider"
```
配置 .env
```php
LBS_DRIVER=tencent
LBS_KEY=xxxxx
```

服务名访问
```php
app('GeoCoder')->addr2coder('地址');
```
Facade
```php
\Kubill\Lbs\Facades\GeoCoder::addr2coder('地址');
```

## License

Lbs is licensed under [The MIT License (MIT)](LICENSE).
