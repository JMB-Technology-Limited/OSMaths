<?php

namespace JMBTechnologyLimited\OSMaths;

/**
 *
 * @link https://github.com/JMB-Technology-Limited/OSMaths
 * @license https://raw.github.com/JMB-Technology-Limited/OSMaths/master/LICENSE.md 3-clause BSD
 * @copyright (c) JMB Technology Limited, http://jmbtechnology.co.uk/
 */

class Transform {


    // m
    protected $tx;
    protected $ty;
    protected $tz;

    //s
    protected $rx;
    protected $ry;
    protected $rz;

    // ppm
    protected $s;

    function __construct($tx, $ty, $tz, $rx, $ry, $rz, $s)
    {
        $this->rx = $rx;
        $this->ry = $ry;
        $this->rz = $rz;
        $this->s = $s;
        $this->tx = $tx;
        $this->ty = $ty;
        $this->tz = $tz;
    }

    /**
     * @return mixed
     */
    public function getRx()
    {
        return $this->rx;
    }

    /**
     * @return mixed
     */
    public function getRy()
    {
        return $this->ry;
    }

    /**
     * @return mixed
     */
    public function getRz()
    {
        return $this->rz;
    }

    /**
     * @return mixed
     */
    public function getS()
    {
        return $this->s;
    }

    /**
     * @return mixed
     */
    public function getTx()
    {
        return $this->tx;
    }

    /**
     * @return mixed
     */
    public function getTy()
    {
        return $this->ty;
    }

    /**
     * @return mixed
     */
    public function getTz()
    {
        return $this->tz;
    }

    /**
     * @return Transform
     */
    public function reverse() {
        return new Transform(
            $this->tx * -1,
            $this->ty * -1,
            $this->tz * -1,
            $this->rx * -1,
            $this->ry * -1,
            $this->rz * -1,
            $this->s * -1);
    }

}

