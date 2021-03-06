<?php

require( '../PHPGoogleMaps/Core/Autoloader.php' );
$map_loader = new SplClassLoader('PHPGoogleMaps', '../');
$map_loader->register();

require( '_system/config.php' );
$relevant_code = array(
	'\PHPGoogleMaps\Overlay\Polygon',
	'\PHPGoogleMaps\Overlay\Poly',
	'\PHPGoogleMaps\Overlay\PolyDecorator'
);

use \PHPGoogleMaps\Service\Geocoder;

$map = new \PHPGoogleMaps\Map;

$polygon_paths = array(
	Geocoder::geocode( 'San Diego, CA' ),
	'Austin, TX',
	Geocoder::geocode( 'New Haven, CT' ),
	Geocoder::geocode( 'Seattle, WA' )
);

$polygon_options = array(
	'strokeColor'	=> '#0000ff',
	'fillColor'		=> '#230754',
	'clickable'		=> false
);

$polygon = new \PHPGoogleMaps\Overlay\Polygon( $polygon_paths, $polygon_options );

$polygon->addPath( 'San Francisco, CA' );

$m_options = array(
	'title'	=> 'Center of Polygon',
	'content'	=> 'This marker was added to the center of the polygon via Polygon::getCenter()'
);
$m = \PHPGoogleMaps\Overlay\Marker::createFromLatLng( $polygon->getCenter(), $m_options );

$map->disableAutoEncompass();
$map->setCenter( 'Austin, TX' );
$map->setZoom( 3 );

$map->addObjects( array( &$polygon, $m ) );

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Polygons - <?php echo PAGE_TITLE ?></title>
	<link rel="stylesheet" type="text/css" href="_css/style.css">
	<?php $map->printHeaderJS() ?>
	<?php $map->printMapJS() ?>
</head>
<body>

<h1>Polygons</h1>
<?php require( '_system/nav.php' ) ?>

<?php $map->printMap() ?>
<a href="#" onclick="<?php echo $polygon->getJsVar() ?>.setMap(null)">Hide polygon</a>
</body>

</html>
