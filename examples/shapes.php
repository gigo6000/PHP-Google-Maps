<?php

require( '../google_maps.php' );
require( '_system/config.php' );

$map = new \googlemaps\GoogleMap();

$circle_options = array(
	'fillColor'	=> '#00ff00',
	'strokeWeight'	=> 1,
	'fillOpacity'	=> 0.05,
	'clickable'	=> false
);
$circle = \googlemaps\overlay\Circle::createFromLocation( 'San Diego, CA', 1000, $circle_options );

$rectangle_options = array(
	'fillColor'	=> '#ff0000',
	'strokeWeight'	=> 3,
	'fillOpacity'	=> 0.05,
	'clickable'	=> false
);
$rectangle = new \googlemaps\overlay\Rectangle(
	\googlemaps\service\Geocoder::getLatLng( 'San Diego, CA' ),
	\googlemaps\service\Geocoder::getLatLng( 'Balboa Park San Diego, CA' ),
	$rectangle_options
);

$map->addObjects( array( $circle, $rectangle ) );
$map->setCenterByLocation( 'San Diego, CA' );
$map->setZoom( 14 );

?>

<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<title>Shapes - <?php echo PAGE_TITLE ?></title>
	<link rel="stylesheet" type="text/css" href="_css/style.css">
	<?php $map->printHeaderJS() ?>
	<?php $map->printMapJS() ?>
</head>
<body>

<h1>Shapes</h1>
<?php require( '_system/nav.php' ) ?>

<p>Simple map example</p>

<?php $map->printMap() ?>

</body>

</html>

