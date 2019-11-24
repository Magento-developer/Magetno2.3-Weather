<?php
/**
 * Copyright © 2019 AmiCode. All rights reserved.
 */
namespace Amicode\Weather\Model;

use Amicode\Weather\Api\Data\WeatherInterface;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\DataObject\IdentityInterface;

class Weather extends AbstractModel implements WeatherInterface,  IdentityInterface
{
    const CACHE_TAG = 'amicodeweather_weather';

    protected $_cacheTag = 'amicodeweather_weather';

    protected $_eventPrefix = 'amicodeweather_weather';

    protected $_eventObject = 'weather';

    protected function _construct()
    {
        $this->_init('Amicode\Weather\Model\ResourceModel\Weather');
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getData(self::ENTITY_ID);
    }

    /**
     * {@inheritdoc}
     */
    public function setId($id)
    {
        $this->setData(self::ENTITY_ID, $id);
    }

    /**
     * {@inheritdoc}
     */
    public function getWeatherMain()
    {
        return $this->getData(self::WEATHER_MAIN);
    }

    /**
     * {@inheritdoc}
     */
    public function setWeatherMain($weatherMain)
    {
        $this->setData(self::WEATHER_MAIN, $weatherMain);
    }

    /**
     * {@inheritdoc}
     */
    public function getWeatherDescription()
    {
        return $this->getData(self::WEATHER_DESCRIPTION);
    }

    /**
     * {@inheritdoc}
     */
    public function setWeatherDescription($weatherDescription)
    {
        $this->setData(self::WEATHER_DESCRIPTION, $weatherDescription);
    }

    /**
     * {@inheritdoc}
     */
    public function getWeatherIcon()
    {
        return $this->getData(self::WEATHER_ICON);
    }

    /**
     * {@inheritdoc}
     */
    public function setWeatherIcon($weatherIcon)
    {
        $this->setData(self::WEATHER_ICON, $weatherIcon);
    }

    /**
     * {@inheritdoc}
     */
    public function getTemp()
    {
        return $this->getData(self::TEMP);
    }

    /**
     * {@inheritdoc}
     */
    public function setTemp($temp)
    {
        $this->setData(self::TEMP, $temp);
    }

    /**
     * {@inheritdoc}
     */
    public function getHumidity()
    {
        return $this->getData(self::HUMIDITY);
    }

    /**
     * {@inheritdoc}
     */
    public function setHumidity($humidity)
    {
        $this->setData(self::HUMIDITY, $humidity);
    }

    /**
     * {@inheritdoc}
     */
    public function getPressure()
    {
        return $this->getData(self::PRESSURE);
    }

    /**
     * {@inheritdoc}
     */
    public function setPressure($pressure)
    {
        $this->setData(self::PRESSURE, $pressure);
    }

    /**
     * {@inheritdoc}
     */
    public function getTempMin()
    {
        return $this->getData(self::TEMP_MIN);
    }

    /**
     * {@inheritdoc}
     */
    public function setTempMin($tempMin)
    {
        $this->setData(self::TEMP_MIN, $tempMin);
    }

    /**
     * {@inheritdoc}
     */
    public function getTempMax()
    {
        return $this->getData(self::TEMP_MAX);
    }

    /**
     * {@inheritdoc}
     */
    public function setTempMax($tempMax)
    {
        $this->setData(self::TEMP_MAX, $tempMax);
    }

    /**
     * {@inheritdoc}
     */
    public function getVisibility()
    {
        return $this->getData(self::VISIBILITY);
    }

    /**
     * {@inheritdoc}
     */
    public function setVisibility($visibility)
    {
        $this->setData(self::VISIBILITY, $visibility);
    }

    /**
     * {@inheritdoc}
     */
    public function getWindSpeed()
    {
        return $this->getData(self::WIND_SPEED);
    }

    /**
     * {@inheritdoc}
     */
    public function setWindSpeed($windSpeed)
    {
        $this->setData(self::WIND_SPEED, $windSpeed);
    }

    /**
     * {@inheritdoc}
     */
    public function getWindDeg()
    {
        return $this->getData(self::WIND_DEG);
    }

    /**
     * {@inheritdoc}
     */
    public function setWindDeg($windDeg)
    {
        $this->setData(self::WIND_DEG, $windDeg);
    }

    /**
     * {@inheritdoc}
     */
    public function getClouds()
    {
        return $this->getData(self::CLOUDS);
    }

    /**
     * {@inheritdoc}
     */
    public function setClouds($clouds)
    {
        $this->setData(self::CLOUDS, $clouds);
    }

    /**
     * {@inheritdoc}
     */
    public function getCurrentDate()
    {
        return $this->getData(self::CURRENT_DATE);
    }

    /**
     * {@inheritdoc}
     */
    public function setCurrentDate($currentDate)
    {
        $this->setData(self::CURRENT_DATE, $currentDate);
    }

    /**
     * Set Sunrise
     *
     * @return string|null
     */
    public function getSunrise()
    {
        return $this->getData(self::SUNRISE);
    }

    /**
     * {@inheritdoc}
     */
    public function setSunrise($sunrise)
    {
        $this->setData(self::SUNRISE, $sunrise);
    }
    /**
     * {@inheritdoc}
     */
    public function getSunset()
    {
        return $this->getData(self::SUNSET);
    }

    /**
     * {@inheritdoc}
     */
    public function setSunset($sunset)
    {
        $this->setData(self::SUNSET, $sunset);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        $this->setData(self::NAME, $name);
    }

    /**
     * {@inheritdoc}
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}