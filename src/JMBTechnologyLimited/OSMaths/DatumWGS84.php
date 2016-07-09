<?php


namespace JMBTechnologyLimited\OSMaths;

/**
 *
 * @link https://github.com/JMB-Technology-Limited/OSMaths
 * @license https://raw.github.com/JMB-Technology-Limited/OSMaths/master/LICENSE.md 3-clause BSD
 * @copyright (c) JMB Technology Limited, http://jmbtechnology.co.uk/
 */

class DatumWGS84 extends Datum {


    function __construct()
    {
        $this->ellipsoid = new Ellipsoid(6378137,6356752.31425, 1/298.257223563);
        $this->transform = new Transform( 0,0,0,0,0,0,0);
    }

    public function getLatLng($lat, $lng)
    {
        return new LatLngWGS84($lat, $lng);
    }
}
