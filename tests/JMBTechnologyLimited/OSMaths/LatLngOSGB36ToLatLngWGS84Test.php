<?php

namespace JMBTechnologyLimited\OSMaths;


/**
 *
 * @link https://github.com/JMB-Technology-Limited/OSMaths
 * @license https://raw.github.com/JMB-Technology-Limited/OSMaths/master/LICENSE.md 3-clause BSD
 * @copyright (c) JMB Technology Limited, http://jmbtechnology.co.uk/
 */


class LatLngOSGB36ToLatLngWGS84Test extends \PHPUnit_Framework_TestCase {


    function dataForTest() {
        return array(
            array(55.954456721624, -3.1525104945604, 55.954400681908, -3.1539398015035967),
            array(55.960427, -3.2001035618000002, 55.960369598100002, -3.2015270214), // EH3 5DH
        );
    }


    const ROUND = 10;

    /**
     * @dataProvider dataForTest
     */
    function test1($inLat, $inLng, $outLat, $outLng) {



        $in = new LatLngOSGB36($inLat, $inLng);

        $out = $in->toLatLngWGS84();

        $this->assertEquals(round($outLat, self::ROUND), round($out->getLat(), self::ROUND));
        $this->assertEquals(round($outLng, self::ROUND), round($out->getLng(), self::ROUND));

    }

}

