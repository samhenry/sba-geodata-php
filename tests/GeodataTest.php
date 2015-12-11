<?php
 
use SamHenry\Geodata\Geodata;
 
class GeodataTest extends PHPUnit_Framework_TestCase {
 
  public function testGetCities()
  {
    $geodata = new Geodata('json');
	$result = $geodata->getCities('MD');
    $this->assertTrue(!empty($result));
  }
 
  public function testGetCitiesLinks()
  {
    $geodata = new Geodata('json');
	$result = $geodata->getCities('MD','links');
    $this->assertTrue(!empty($result));
  }
 
  public function testGetCitiesPrimary()
  {
    $geodata = new Geodata('json');
	$result = $geodata->getCities('MD','primary');
    $this->assertTrue(!empty($result));
  }
 
  public function testGetCounties()
  {
    $geodata = new Geodata('json');
	$result = $geodata->getCounties('MD');
    $this->assertTrue(!empty($result));
  }
 
  public function testGetCountiesLinks()
  {
    $geodata = new Geodata('json');
	$result = $geodata->getCounties('MD','links');
    $this->assertTrue(!empty($result));
  }
 
  public function testGetCountiesPrimary()
  {
    $geodata = new Geodata('json');
	$result = $geodata->getCounties('MD','primary');
    $this->assertTrue(!empty($result));
  }
 
  public function testGetCityData()
  {
    $geodata = new Geodata('json');
	$result = $geodata->getCity('MD','Baltimore');
    $this->assertTrue(!empty($result));
  }
 
  public function testGetCityLinks()
  {
    $geodata = new Geodata('json');
	$result = $geodata->getCity('MD','Baltimore','links');
    $this->assertTrue(!empty($result));
  }
 
  public function testGetCityPrimary()
  {
    $geodata = new Geodata('json');
	$result = $geodata->getCity('MD','Baltimore','primary');
    $this->assertTrue(!empty($result));
  }
 
  public function testGetCountyData()
  {
    $geodata = new Geodata('json');
	$result = $geodata->getCounty('MD','Montgomery County');
    $this->assertTrue(!empty($result));
  }
 
  public function testGetCountyLinks()
  {
    $geodata = new Geodata('json');
	$result = $geodata->getCounty('MD','Montgomery County','links');
    $this->assertTrue(!empty($result));
  }
 
  public function testGetCountyPrimary()
  {
    $geodata = new Geodata('json');
	$result = $geodata->getCounty('MD','Montgomery County','primary');
    $this->assertTrue(!empty($result));
  }
 
}