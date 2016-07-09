<?php

namespace JMBTechnologyLimited\OSMaths;


/**
 *
 * @link https://github.com/JMB-Technology-Limited/OSMaths
 * @license https://raw.github.com/JMB-Technology-Limited/OSMaths/master/LICENSE.md 3-clause BSD
 * @copyright (c) JMB Technology Limited, http://jmbtechnology.co.uk/
 */


class Vector {


    protected $x;
    protected $y;
    protected $z;

    function __construct($x, $y, $z)
    {
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
    }

    /**
     * @return mixed
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * @param mixed $x
     */
    public function setX($x)
    {
        $this->x = $x;
    }

    /**
     * @return mixed
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * @param mixed $y
     */
    public function setY($y)
    {
        $this->y = $y;
    }

    /**
     * @return mixed
     */
    public function getZ()
    {
        return $this->z;
    }

    /**
     * @param mixed $z
     */
    public function setZ($z)
    {
        $this->z = $z;
    }

    /**
     * @param Transform $transform
     * @return Vector
     */
    public function applyTransform(Transform $transform) {


        $rx = Misc::toRadians($transform->getRx()/3600); // normalise seconds to radians
        $ry = Misc::toRadians($transform->getRy()/3600); // normalise seconds to radians
        $rz = Misc::toRadians($transform->getRz()/3600); // normalise seconds to radians


        $s1 = $transform->getS() / (1e6) + 1;          // normalise ppm to (s+1)

        $x2 = $transform->getTx() + $this->x*$s1 - $this->y*$rz + $this->z*$ry;
        $y2 = $transform->getTy() + $this->x*$rz + $this->y*$s1 - $this->z*$rx;
        $z2 = $transform->getTz() - $this->x*$ry + $this->y*$rx + $this->z*$s1;

        return new Vector($x2, $y2, $z2);

    }


    /**
     * @param Datum $datum
     * @return LatLng
     */
    public function toLatLng(Datum  $datum) {

        $ellipsoid = $datum->getEllipsoid();

        $e2 = ($ellipsoid->getA()*$ellipsoid->getA() - $ellipsoid->getB()*$ellipsoid->getB()) /
            ($ellipsoid->getA()*$ellipsoid->getA()); // 1st eccentricity squared
        $G12 = ($ellipsoid->getA()*$ellipsoid->getA() - $ellipsoid->getB()*$ellipsoid->getB()) /
            ($ellipsoid->getB()*$ellipsoid->getB()); // 2nd eccentricity squared
        $p = sqrt($this->x*$this->x + $this->y*$this->y); // distance from minor axis
        $R = sqrt($p*$p + $this->z+$this->z);

        // parametric latitude (Bowring eqn 17, replacing tanβ = z·a / p·b)
        $tan = ($ellipsoid->getB()*$this->z)/($ellipsoid->getA()*$p)  *  (1+$G12*$ellipsoid->getB()/$R);
        $sin = $tan / sqrt(1 + $tan*$tan);
        $cos = $sin / $tan;

        // geodetic latitude (Bowring eqn 18)
        $G2 = atan2($this->z + $G12*$ellipsoid->getB()*$sin*$sin*$sin,
            $p - $e2*$ellipsoid->getA()*$cos*$cos*$cos);

        // longitude
        $G3 = atan2($this->y, $this->x);

        return $datum->getLatLng(Misc::toDegrees($G2), Misc::toDegrees($G3));

    }


}

