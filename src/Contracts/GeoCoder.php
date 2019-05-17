<?php

namespace Kubill\Lbs\Contracts;


interface GeoCoder
{
    /**
     * 把地址转坐标
     *
     * @param  string  $addr
     * @return array
     */
    public function addr2coder($addr);
}
