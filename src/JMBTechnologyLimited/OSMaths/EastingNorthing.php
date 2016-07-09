<?php

namespace JMBTechnologyLimited\OSMaths;


/**
 *
 * @link https://github.com/JMB-Technology-Limited/OSMaths
 * @license https://raw.github.com/JMB-Technology-Limited/OSMaths/master/LICENSE.md 3-clause BSD
 * @copyright (c) JMB Technology Limited, http://jmbtechnology.co.uk/
 */

class EastingNorthing {

    protected $easting;

    protected $northing;

    /**
     * EastingNorthing constructor.
     * @param $easting
     * @param $northing
     */
    public function __construct($easting, $northing)
    {
        $this->easting = $easting;
        $this->northing = $northing;
    }

    /**
     * @return mixed
     */
    public function getNorthing()
    {
        return $this->northing;
    }

    /**
     * @return mixed
     */
    public function getEasting()
    {
        return $this->easting;
    }




    /**
     * @return LatLngOSGB36
     */
    public function toLatLngOSGB36() {

        // Airy 1830 major & minor semi-axes
        $a = 6377563.396;
        $b = 6356256.909;
        // NatGrid scale factor on central meridian
        $F0 = 0.9996012717;
        // NatGrid true origin is 49°N,2°W
        $phi0 = Misc::toRadians(49);
        $lambda0 = Misc::toRadians(-2);
        // northing & easting of true origin, metres
        $N0 = -100000;
        $E0 = 400000;
        // eccentricity squared
        $e2 = 1 - ($b*$b)/($a*$a);
        // n, n^2, n^3
        $n = ($a-$b)/($a+$b);
        $n2 = $n*$n;
        $n3 = $n*$n*$n;

        $phi=$phi0;
        $M=0;
        do {
            $phi = ($this->northing-$N0-$M)/($a*$F0) + $phi;

            $Ma = (1 + $n + (5/4)*$n2 + (5/4)*$n3) * ($phi - $phi0);
            $Mb = (3*$n + 3*$n2 + (21/8)*$n3) * sin($phi - $phi0) * cos($phi + $phi0);
            $Mc = ((15/8)*$n2 + (15/8)*$n3) * sin(2*($phi - $phi0)) * cos(2*($phi + $phi0));
            $Md = (35/24)*$n3 * sin(3*($phi - $phi0)) * cos(3*($phi + $phi0));
            $M = $b * $F0 * ($Ma - $Mb + $Mc - $Md);              // meridional arc

        } while ($this->northing-$N0-$M >= 0.00001);  // ie until < 0.01mm

        $cosPhi = cos($phi);
        $sinPhi = sin($phi);
        $tanPhi = tan($phi);
        $tan2Phi = pow($tanPhi, 2);
        $tan4Phi = pow($tanPhi, 4);
        // nu = transverse radius of curvature
        $nu = $a*$F0/sqrt(1-$e2*$sinPhi*$sinPhi);
        // rho = meridional radius of curvature
        $rho = $a*$F0*(1-$e2)/pow(1-$e2*$sinPhi*$sinPhi, 1.5);
        // eta = ?
        $eta2 = $nu/$rho-1;


        $secPhi = 1/$cosPhi;
        $nu3 = pow($nu, 3);
        $nu5 = pow($nu, 5);
        $nu7 = pow($nu, 7);
        $VII = $tanPhi/(2*$rho*$nu);
        $VIII = $tanPhi/(24*$rho*$nu3)*(5+3*$tan2Phi+$eta2-9*$tan2Phi*$eta2);
        $IX = $tanPhi/(720*$rho*$nu5)*(61+90*$tan2Phi+45*$tan4Phi);
        $X = $secPhi/$nu;
        $XI = $secPhi/(6*$nu3)*($nu/$rho+2*$tan2Phi);
        $XII = $secPhi/(120*$nu5)*(5+28*$tan2Phi+24*$tan4Phi);
        $XIIA = $secPhi/(5040*$nu7)*(61+662*$tan2Phi+1320*$tan4Phi+720*pow($tanPhi, 6));

        $dE = ($this->easting-$E0);
        $lat = $phi - $VII*pow($dE,2) + $VIII*pow($dE,4) - $IX*pow($dE,6);
        $lng = $lambda0 + $X*$dE - $XI*pow($dE,3) + $XII*pow($dE,5) - $XIIA*pow($dE,7);

        return new LatLngOSGB36(Misc::toDegrees($lat), Misc::toDegrees($lng));

    }

}
