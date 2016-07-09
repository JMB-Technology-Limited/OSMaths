# OSMaths

This is a PHP library for doing the conversations around the coordinate systems used for Ordnance Survey Open Data only.

Most of the Open Data comes in Easting/Northing. It needs converting to Latitude and Longitude.
Further more, this is in OSGB36, and you probably want your Lat/Lng in WGS84, which is the same projection Open Street Map and Google Maps use.

I am not an expert in mapping systems. I cobbled this together from other sources based on my needs.
I would love to retire it if someone else has a PHP library that does this with a permissive license.

## Install via Composer

https://packagist.org/packages/jmbtechnologylimited/osmaths

composer require jmbtechnologylimited/osmaths

## Use

    $en = new EastingNorthing($inEasting, $inNorthing);
    $latlng = $en->toLatLngOSGB36()->toLatLngWGS84();
    print $latlng->getLat();
    print $latlng->getLng();

## Code Standards

Every object is immutable, so you can pass around data objects without worrying they will be changed.

## License

BSD License

Note this software does not contain any actual data from the Ordnance Survey. You must get that yourself, and agree to their license to.

## Sources and References that have been helpful

  *  https://www.ordnancesurvey.co.uk/business-and-government/products/opendata-products.html
  *  https://www.ordnancesurvey.co.uk/docs/support/guide-coordinate-systems-great-britain.pdf
  *  http://www.movable-type.co.uk/scripts/latlong-gridref.html

