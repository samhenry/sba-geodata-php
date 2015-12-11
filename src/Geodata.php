<?php

namespace SamHenry\Geodata;

/**
 * SBA Geodata API class.
 *
 * API Documentation: http://api.sba.gov/doc/geodata.html
 * Class Documentation: https://github.com/samhenry/sba-geodata-php
 *
 * @author Sam Henry
 *
 * @since 09.12.2015
 *
 * @copyright Sam Henry - GT Web Systems 2015
 *
 * @version 1.0
 *
 * @license BSD http://www.opensource.org/licenses/bsd-license.php
 */
class Geodata
{
    /**
   * The API base URL.
   */
  const API_URL = 'http://api.sba.gov/geodata/';

  /**
   * The API response format.
   *
   * @var string
   */
  private $_format;

  /**
   * Default constructor.
   *
   * @param array|string $config          Geodata configuration data
   */
  public function __construct($format = 'json')
  {
      $this->setFormat($format);
  }

  /**
   * Response Format Setter.
   *
   * @param object|string $data
   */
  public function setFormat($format = 'json')
  {
      (in_array($format, array('json', 'xml'))) ? $format : 'json';
      $this->_format = $format;
  }

  /**
   * Get all links for a specific County.
   *
   * @param string $state_abbrev        	Two-letter abbreviation for a US state
   * @param string $county_name				Full name of a county within the specified state including the words “County”, “Parish”, etc.
   *
   * @return mixed
   */
  public function getCounty($state_abbrev, $county_name, $subject = 'data')
  {
      $county_name = rawurlencode(strtolower($county_name));
      $state_abbrev = strtolower(substr($state_abbrev, 0, 2));
      $subject = strtolower($subject);
      $function = 'all_data_for_county_of';

      if ($subject == 'links') {
          $function = 'all_links_for_county_of';
      } elseif ($subject == 'primary') {
          $function = 'primary_links_for_county_of';
      }

      return $this->_makeCall($function.'/'.$county_name.'/'.$state_abbrev);
  }

  /**
   * Get all links for a specific City.
   *
   * @param string $state_abbrev        	Two-letter abbreviation for a US state
   * @param string $city_name				Full name of a county within the specified state including the words “County”, “Parish”, etc.
   *
   * @return mixed
   */
  public function getCity($state_abbrev, $city_name, $subject = 'data')
  {
      $county_name = rawurlencode(strtolower($city_name));
      $state_abbrev = strtolower(substr($state_abbrev, 0, 2));
      $subject = strtolower($subject);
      $function = 'all_data_for_city_of';

      if ($subject == 'links') {
          $function = 'all_links_for_city_of';
      } elseif ($subject == 'primary') {
          $function = 'primary_links_for_city_of';
      }

      return $this->_makeCall($function.'/'.$city_name.'/'.$state_abbrev);
  }

  /**
   * Get all cities for a specific State.
   *
   * @param string $state_abbrev        	Two-letter abbreviation for a US state
   *
   * @return mixed
   */
  public function getCities($state_abbrev, $subject = 'data')
  {
      $state_abbrev = strtolower(substr($state_abbrev, 0, 2));
      $subject = strtolower($subject);
      $function = 'city_data_for_state_of';

      if ($subject == 'links') {
          $function = 'city_links_for_state_of';
      } elseif ($subject == 'primary') {
          $function = 'primary_city_links_for_state_of';
      }

      return $this->_makeCall($function.'/'.$state_abbrev);
  }

  /**
   * Get all counties for a specific State.
   *
   * @param string $state_abbrev        	Two-letter abbreviation for a US state
   *
   * @return mixed
   */
  public function getCounties($state_abbrev, $subject = 'data')
  {
      $state_abbrev = strtolower(substr($state_abbrev, 0, 2));
      $subject = strtolower($subject);
      $function = 'county_data_for_state_of';

      if ($subject == 'links') {
          $function = 'county_links_for_state_of';
      } elseif ($subject == 'primary') {
          $function = 'primary_county_links_for_state_of';
      }

      return $this->_makeCall($function.'/'.$state_abbrev);
  }

  /**
   * The call operator.
   *
   * @param string $function              API resource path
   *
   * @return mixed
   */
  protected function _makeCall($function)
  {
      $apiCall = self::API_URL.$function.'.'.$this->_format;

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $apiCall);
      curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

      $data = curl_exec($ch);
      $content_type = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);

      if (false === $data) {
          throw new \Exception('Error: _makeCall() - cURL error: '.curl_error($ch));
      }
      curl_close($ch);

      if (strpos($content_type, 'application/json') === false) {
          return json_decode(json_encode(simplexml_load_string($data)));
      } else {
          return json_decode($data);
      }
  }
}
