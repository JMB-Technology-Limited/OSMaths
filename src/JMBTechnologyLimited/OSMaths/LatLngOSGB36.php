<?php

namespace JMBTechnologyLimited\OSMaths;

/**
 *
 * @link https://github.com/JMB-Technology-Limited/OSMaths
 * @license https://raw.github.com/JMB-Technology-Limited/OSMaths/master/LICENSE.md 3-clause BSD
 * @copyright (c) JMB Technology Limited, http://jmbtechnology.co.uk/
 */


class LatLngOSGB36 extends LatLng {



    /** @return Vector */
    protected function toCartesian() {
        $Glat = Misc::toRadians($this->lat);
        $Glng = Misc::toRadians($this->lng);
        // height above ellipsoid - not currently used
        $h = 0;
        $datum = new DatumOSGB36();
        $a = $datum->getEllipsoid()->getA();
        $b = $datum->getEllipsoid()->getB();
        $sinGlat = sin($Glat);
        $cosGlat = cos($Glat);
        $sinGlng = sin($Glng);
        $cosGlng = cos($Glng);
        $eSq = ($a*$a - $b*$b) / ($a*$a);
        $v = $a / sqrt(1 - $eSq * $sinGlat * $sinGlat);
        $x = ($v + $h) * $cosGlat * $cosGlng;
        $y = ($v + $h) * $cosGlat * $sinGlng;
        $z = ((1-$eSq)*$v + $h) * $sinGlat;
        return new Vector($x, $y, $z);
    }




    public function toLatLngWGS84() {

        $datumOSGB36 = new DatumOSGB36();
        $transform = $datumOSGB36->getTransform();
        $transform = $transform->reverse();

        $vector = $this->toCartesian();
        $vector = $vector->applyTransform($transform);
        return $vector->toLatLng(new DatumWGS84());

    }

}

