<?php
/**
 * Copyright © 2019 AmiCode. All rights reserved.
 */
namespace Amicode\Weather\Api\Data;

interface WeatherInterface
{
    /**#@+
     * Constants defined for keys of data array
     */
    const ENTITY_ID = 'entity_id';
    const WEATHER_MAIN = 'weather_main';
    const WEATHER_DESCRIPTION = 'weather_description';
    const WEATHER_ICON = 'weather_icon';
    const TEMP = 'temp';
    const HUMIDITY = 'humidity';
    const PRESSURE = 'pressure';
    const TEMP_MIN = 'temp_min';
    const TEMP_MAX = 'temp_max';
    const VISIBILITY = 'visibility';
    const WIND_SPEED = 'wind_speed';
    const WIND_DEG = 'wind_deg';
    CONST CLOUDS = 'clouds';
    CONST CURRENT_DATE = 'current_date';
    CONST SUNRISE = 'sunrise';
    CONST SUNSET = 'sunset';
    CONST NAME = 'name';
    /**#@-*/

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Set ID
     * @param int $id
     * @return \Amicode\Weather\Api\Data\WeatherInterface
     */
    public function setId($id);

    /**
     * Get Weather Main
     *
     * @return string|null
     */
    public function getWeatherMain();

    /**
     * Set Weather Main
     * @param string $weatherMain
     * @return \Amicode\Weather\Api\Data\WeatherInterface
     */
    public function setWeatherMain($weatherMain);

    /**
     * Get Weather Description
     *
     * @return string|null
     */
    public function getWeatherDescription();

    /**
     * set Weather Description
     *
     * @param string $weatherDescription
     * @return \Amicode\Weather\Api\Data\WeatherInterface
     */
    public function setWeatherDescription($weatherDescription);

    /**
     * Get Weather Icon
     *
     * @return string|null
     */
    public function getWeatherIcon();

    /**
     * Set Weather Icon
     * @param string $weatherIcon
     * @return \Amicode\Weather\Api\Data\WeatherInterface
     */
    public function setWeatherIcon($weatherIcon);

    /**
     * Get Temp
     *
     * @return float|null
     */
    public function getTemp();

    /**
     * Set Temp
     *
     * @param float $temp
     * @return \Amicode\Weather\Api\Data\WeatherInterface
     */
    public function setTemp($temp);

    /**
     * Get humidity
     *
     * @return integer|null
     */
    public function getHumidity();

    /**
     * Set humidity
     *
     * @param int $humidity
     * @return \Amicode\Weather\Api\Data\WeatherInterface
     */
    public function setHumidity($humidity);

    /**
     * Get Pressure
     *
     * @return integer|null
     */
    public function getPressure();

    /**
     * Set Pressure
     *
     * @param int $pressure
     * @return \Amicode\Weather\Api\Data\WeatherInterface
     */
    public function setPressure($pressure);

    /**
     * Get Temp min
     *
     * @return float|null
     */
    public function getTempMin();

    /**
     * Set Temp min
     *
     * @param float $tempMin
     * @return \Amicode\Weather\Api\Data\WeatherInterface
     */
    public function setTempMin($tempMin);

    /**
     * Get Temp max
     *
     * @return float|null
     */
    public function getTempMax();

    /**
     * Set Temp max
     *
     * @param float $tempMax
     * @return \Amicode\Weather\Api\Data\WeatherInterface
     */
    public function setTempMax($tempMax);

    /**
     * Get Visibility
     *
     * @return integer|null
     */
    public function getVisibility();

    /**
     * Set Visibility
     *
     * @param int $visibility
     * @return \Amicode\Weather\Api\Data\WeatherInterface
     */
    public function setVisibility($visibility);

    /**
     * Get Wind Speed
     *
     * @return float|null
     */
    public function getWindSpeed();

    /**
     * Set Wind Speed
     *
     * @param float $windSpeed
     * @return \Amicode\Weather\Api\Data\WeatherInterface
     */
    public function setWindSpeed($windSpeed);

    /**
     * Get Wind Deg
     *
     * @return integer|null
     */
    public function getWindDeg();

    /**
     * Set Wind Deg
     *
     * @param int $windDeg
     * @return \Amicode\Weather\Api\Data\WeatherInterface
     */
    public function setWindDeg($windDeg);

    /**
     * Get Clouds
     *
     * @return integer|null
     */
    public function getClouds();

    /**
     * Set Clouds
     *
     * @param string $clouds
     * @return \Amicode\Weather\Api\Data\WeatherInterface
     */
    public function setClouds($clouds);

    /**
     * Get Current Date
     *
     * @return integer|null
     */
    public function getCurrentDate();

    /**
     * Set Current Date
     *
     * @param string $currentDate
     * @return \Amicode\Weather\Api\Data\WeatherInterface
     */
    public function setCurrentDate($currentDate);

    /**
     * Set Sunrise
     *
     * @return string|null
     */
    public function getSunrise();

    /**
     * Get Sunrise
     *
     * @param string $sunrise
     * @return \Amicode\Weather\Api\Data\WeatherInterface
     */
    public function setSunrise($sunrise);

    /**
     * Set Sunset
     *
     * @return string|null
     */
    public function getSunset();

    /**
     * Set Sunset
     *
     * @param string $sunset
     * @return \Amicode\Weather\Api\Data\WeatherInterface
     */
    public function setSunset($sunset);

    /**
     * Get Name
     *
     * @return string|null
     */
    public function getName();

    /**
     * Set Name
     *
     * @param string $name
     * @return \Amicode\Weather\Api\Data\WeatherInterface
     */
    public function setName($name);
}