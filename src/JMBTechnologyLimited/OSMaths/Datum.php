<?php

namespace JMBTechnologyLimited\OSMaths;

/**
 *
 * @link https://github.com/JMB-Technology-Limited/OSMaths
 * @license https://raw.github.com/JMB-Technology-Limited/OSMaths/master/LICENSE.md 3-clause BSD
 * @copyright (c) JMB Technology Limited, http://jmbtechnology.co.uk/
 */

abstract class Datum {

    /** @var  Ellipsoid */
    protected $ellipsoid;

    /** @var Transform */
    protected $transform;


    /**
     * @return Ellipsoid
     */
    public function getEllipsoid()
    {
        return $this->ellipsoid;
    }

    /**
     * @return Transform
     */
    public function getTransform()
    {
        return $this->transform;
    }

    public abstract function getLatLng($lat, $lng);

}

