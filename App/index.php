<?php

namespace App;

require_once 'Classes/Satellite.php';

use App\Classes\Satellite;

$satellite = new Satellite();

//Default values
$id = '25544';
$chosenLatitude = 40.6892;
$chosenLongitude = 74.0445;
$timestamp = time();


echo "List of Satellites:\n";
echo $satellite->listSatellites();
echo "\n";

echo "Report for Satellite with ID:".$id. "\n";
echo $report = $satellite->getSatelliteReport($id);
echo "\n";

echo "Satellite with ID has Position:".$id. "\n";
$currentPosition = $satellite->getSatellitePositions($id, $timestamp);
echo $currentPosition;
echo "\n";

$currentPosition = json_decode($currentPosition);

$longitude = $currentPosition[0]->longitude;
$latitude = $currentPosition[0]->latitude;

$distance = $satellite->haversineGreatCircleDistance($latitude, $longitude, $chosenLatitude, $chosenLongitude );

echo 'The distance between two coordinates is:'.$distance.'KM';
echo "\n";
