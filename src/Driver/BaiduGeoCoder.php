<?php

namespace Kubill\Lbs\Driver;

use Kubill\Lbs\Contracts\GeoCoder;

/**
 * 百度LBS WebService API
 *
 * Class BaiduGeoCoder
 * @package Kubill\Lbs\Driver
 * @url http://lbsyun.baidu.com/index.php?title=lbscloud
 */
class BaiduGeoCoder extends BaseGeoCoder implements GeoCoder
{
    public function __construct($key)
    {
        parent::__construct($key);
        $this->api_url = 'http://api.map.baidu.com/cloudgc/v1';
    }

    /**
     * 把地址转坐标
     *
     * @param string $addr
     *
     * @return array|mixed
     * @throws \Exception
     */
    public function addr2coder($addr)
    {
        $query = array_filter([
            'ak' => $this->key,
            'address' => $addr,
        ]);
        try {
            $response = $this->getHttpClient()->get($this->api_url, [
                'query' => $query,
            ])->getBody()->getContents();
            $data = json_decode($response, true);
            if ($data['status'] == 0) {
                $result = $data['result']['location'];
                return $result;
            } else {
                return $data;
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode(), $e);
        }
    }
}
