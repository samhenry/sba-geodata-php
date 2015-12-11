<?php
 
use SamHenry\Geodata\Geodata;
 
class GeodataTest extends PHPUnit_Framework_TestCase {
 
  public function testGetCities()
  {
    $geodata = new Geodata('json');
	$result = $geodata->getCities('MD');
    $this->assertTrue(!empty($result));
  }
 
  public function testGetCounties()
  {
    $geodata = new Geodata('json');
	$result = $geodata->getCounties('MD');
    $this->assertTrue(!empty($result));
  }
 
  public function testGetCityData()
  {
    $geodata = new Geodata('json');
	$result = $geodata->getCity('MD','Baltimore');
    $this->assertTrue(!empty($result));
  }
 
  public function testGetCountyData()
  {
    $geodata = new Geodata('json');
	$result = $geodata->getCounty('MD','Montgomery County');
    $this->assertTrue(!empty($result));
  }
 
}