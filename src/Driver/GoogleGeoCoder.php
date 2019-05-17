<?php

namespace Kubill\Lbs\Driver;

use Kubill\Lbs\Contracts\GeoCoder;

/**
 * Google LBS WebService API
 *
 * Class GoogleGeoCoder
 * @package Kubill\Lbs\Driver
 * @url https://developers.google.com/maps/documentation/geocoding/start
 */
class GoogleGeoCoder extends BaseGeoCoder implements GeoCoder
{
    public function __construct($key)
    {
        parent::__construct($key);
        $this->api_url = 'https://maps.googleapis.com/maps/api/geocode/json';
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
            'key' => $this->key,
            'address' => $addr,
        ]);
        try {
            $response = $this->getHttpClient()->get($this->api_url, [
                'query' => $query,
            ])->getBody()->getContents();
            $data = json_decode($response, true);
            if ($data['status'] == 0) {
                $result = $data['result']['geometry']['location'];
                return $result;
            } else {
                return $data;
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode(), $e);
        }
    }
}
