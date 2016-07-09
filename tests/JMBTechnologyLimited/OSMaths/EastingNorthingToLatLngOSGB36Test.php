<?php

namespace JMBTechnologyLimited\OSMaths;


/**
 *
 * @link https://github.com/JMB-Technology-Limited/OSMaths
 * @license https://raw.github.com/JMB-Technology-Limited/OSMaths/master/LICENSE.md 3-clause BSD
 * @copyright (c) JMB Technology Limited, http://jmbtechnology.co.uk/
 */

class EastingNorthingToLatLngOSGB36Test extends \PHPUnit_Framework_TestCase
{

    function dataForTest() {
        return array(
            array(325085, 674802, 55.960427, -3.2001035618000002), // EH3 5DH
        );
    }


    const ROUND = 6;

    /**
     * @dataProvider dataForTest
     */
    function test1($inEasting, $inNorthing, $outLat, $outLng) {



        $in = new EastingNorthing($inEasting, $inNorthing);

        $out = $in->toLatLngOSGB36();

        $this->assertEquals(round($outLat, self::ROUND), round($out->getLat(), self::ROUND));
        $this->assertEquals(round($outLng, self::ROUND), round($out->getLng(), self::ROUND));

    }



}

