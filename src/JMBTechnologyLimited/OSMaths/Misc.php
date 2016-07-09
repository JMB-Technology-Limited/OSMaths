<?php

namespace JMBTechnologyLimited\OSMaths;

/**
 *
 * @link https://github.com/JMB-Technology-Limited/OSMaths
 * @license https://raw.github.com/JMB-Technology-Limited/OSMaths/master/LICENSE.md 3-clause BSD
 * @copyright (c) JMB Technology Limited, http://jmbtechnology.co.uk/
 */

class Misc
{

    public static function toRadians($in) {
        return $in * pi() / 180;
    }

    public static function toDegrees($in) {
        return $in * 180 / pi();
    }

}

