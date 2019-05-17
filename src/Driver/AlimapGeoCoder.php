<?php

namespace Kubill\Lbs\Driver;

use Kubill\Lbs\Contracts\GeoCoder;

/**
 * 高德LBS WebService API
 *
 * Class AlimapGeoCoder
 * @package Kubill\Lbs\Driver
 * @url https://lbs.amap.com/api/webservice/guide/api/georegeo
 */
class AlimapGeoCoder extends BaseGeoCoder implements GeoCoder
{
    public function __construct($key)
    {
        parent::__construct($key);
        $this->api_url = 'https://restapi.amap.com/v3/geocode/geo';
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
            if ($data['status'] == 1) {
                $geocoderArr = explode(',', $data['geocodes'][0]['location']);
                $result['lng'] = $geocoderArr[0];
                $result['lat'] = $geocoderArr[1];
                return $result;
            } else {
                return $data;
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode(), $e);
        }
    }
}
