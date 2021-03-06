<?php

/**
 * SBA Geodata API
 *
 * @link https://github.com/samhenry/sba-geodata-php
 * @author Sam Henry
 * @since 12.10.2015
 */

require '../src/Geodata.php';
use SamHenry\Geodata\Geodata;

// Initialize class
$geodata = new Geodata('json');

// Retrieve all counties in Maryland
$result = $geodata->getCounties('MD');

// Print Results
echo '<pre>';
foreach($result as $r){
	echo 'Name: '.$r->name . PHP_EOL;
	echo 'ID: '.$r->feature_id . PHP_EOL;
	echo 'Class: '.$r->feat_class . PHP_EOL;
	echo 'FIPS Class: '.$r->fips_class . PHP_EOL;
	echo 'State: '.$r->state_name . PHP_EOL;
	echo 'Coordinates: '.$r->primary_latitude.','.$r->primary_longitude. PHP_EOL;
	echo 'URL: '.$r->url. PHP_EOL;
	echo PHP_EOL;
}
echo '</pre>';