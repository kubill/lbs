<?php

namespace Kubill\Lbs;

use Kubill\Lbs\Driver\AlimapGeoCoder;
use Kubill\Lbs\Driver\BaiduGeoCoder;
use Kubill\Lbs\Driver\GoogleGeoCoder;
use Kubill\Lbs\Driver\TencentGeoCoder;

/**
 * 地址解析类库
 *
 * Class GeoCoder
 * @package Kubill\Lbs
 */
class GeoCoder
{
    /**
     * 存储实现
     *
     * @var \Kubill\Lbs\Contracts\GeoCoder;
     */
    protected $driver;

    protected $key;

    /**
     * GeoCoder constructor.
     * @param string $key
     * @param string $name 服务提供商名称
     */
    public function __construct($key, $name = null)
    {
        $this->key = $key;
        $name = $name ?: $this->getDefaultDriver();
        $this->resolve($name);
    }

    /**
     * 把地址转坐标
     *
     * @param  string $addr
     * @return array
     */
    public function addr2coder($addr)
    {
        return $this->driver->addr2coder($addr);
    }

    /**
     * 获取默认的驱动名称
     *
     * @return string
     */
    public function getDefaultDriver()
    {
        return 'tencent';
    }

    /**
     * 根据名称创建缓存驱动
     *
     * @param  string $name
     * @return \Kubill\Lbs\Contracts\GeoCoder
     *
     * @throws \InvalidArgumentException
     */
    protected function resolve($name)
    {
        $driverMethod = 'create' . ucfirst($name) . 'Driver';
        if (method_exists($this, $driverMethod)) {
            return $this->{$driverMethod}();
        } else {
            throw new \InvalidArgumentException("Driver [{$name}] is not supported.");
        }
    }

    /**
     * 创建腾讯驱动实例
     *
     */
    protected function createTencentDriver()
    {
        $this->driver = new TencentGeoCoder($this->key);
    }

    /**
     * 创建百度驱动实例
     *
     */
    protected function createBaiduDriver()
    {
        $this->driver = new BaiduGeoCoder($this->key);
    }

    /**
     * 创建高德驱动实例
     *
     */
    protected function createAlimapDriver()
    {
        $this->driver = new AlimapGeoCoder($this->key);
    }

    /**
     * 创建谷歌驱动实例
     *
     */
    protected function createGoogleDriver()
    {
        $this->driver = new GoogleGeoCoder($this->key);
    }
}
