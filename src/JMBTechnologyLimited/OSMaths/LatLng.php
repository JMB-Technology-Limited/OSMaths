<?php

namespace JMBTechnologyLimited\OSMaths;

/**
 *
 * @link https://github.com/JMB-Technology-Limited/OSMaths
 * @license https://raw.github.com/JMB-Technology-Limited/OSMaths/master/LICENSE.md 3-clause BSD
 * @copyright (c) JMB Technology Limited, http://jmbtechnology.co.uk/
 */


abstract class LatLng {

    protected $lat;

    protected $lng;

    /**
     * LatLng constructor.
     * @param $lat
     * @param $lng
     */
    public function __construct($lat, $lng)
    {
        $this->lat = $lat;
        $this->lng = $lng;
    }

    /**
     * @return mixed
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * @return mixed
     */
    public function getLng()
    {
        return $this->lng;
    }


}
