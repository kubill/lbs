<?php

namespace Kubill\Lbs\Driver;

use GuzzleHttp\Client;

class BaseGeoCoder
{
    /**
     * @var string
     */
    protected $key;
    /**
     * @var string
     */
    protected $api_url;
    /**
     * @var array
     */
    protected $guzzleOptions = [];

    public function __construct($key)
    {
        $this->key = $key;
    }

    /**
     * @return \GuzzleHttp\Client
     */
    public function getHttpClient()
    {
        return new Client($this->guzzleOptions);
    }

    /**
     * @param array $options
     */
    public function setGuzzleOptions(array $options)
    {
        $this->guzzleOptions = $options;
    }
}
