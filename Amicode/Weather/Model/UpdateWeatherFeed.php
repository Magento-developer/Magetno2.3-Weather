<?php
/**
 * Copyright © 2019 AmiCode. All rights reserved.
 */

namespace Amicode\Weather\Model;

use Amicode\Weather\Api\Data\WeatherInterfaceFactory;
use Amicode\Weather\Api\WeatherRepositoryInterface;
use Amicode\Weather\Helper\Data as DataHelper;
use Amicode\Weather\Logger\Logger as LoggerWeather;
use Magento\Framework\HTTP\Adapter\CurlFactory;
use Magento\Framework\Model\AbstractModel;


class UpdateWeatherFeed extends AbstractModel
{
    /**
     * @var DataHelper
     */
    protected $_dataHelper;

    /**
     * @var CurlFactory
     */
    protected $_curlFactory;

    /**
     * @var LoggerWeather
     */
    protected $_logger;

    /**
     * @var WeatherInterfaceFactory
     */
    protected $_weatherFactory;

    /**
     * @var WeatherRepositoryInterface
     */
    private $_weatherRepository;

    public function __construct(
        DataHelper $dataHelper,
        CurlFactory $curlFactory,
        LoggerWeather $logger,
        WeatherInterfaceFactory $weatherFactory,
        WeatherRepositoryInterface $weatherRepository
    )
    {
        $this->_dataHelper = $dataHelper;
        $this->_curlFactory = $curlFactory;
        $this->_logger = $logger;
        $this->_weatherFactory = $weatherFactory;
        $this->_weatherRepository = $weatherRepository;
    }

    public function execute()
    {
        $result = $this->getWeather();
        if ($result) {
            try {
                /** @var Amicode\Weather\Api\Data\WeatherInterface $weather */
                $weather = $this->_weatherFactory->create();
                $weather->setName($result['name']);

                if (isset($result['weather'][0])) {
                    $weather->setWeatherMain($result['weather'][0]['main']);
                    $weather->setWeatherDescription($result['weather'][0]['description']);
                    $weather->setWeatherIcon($result['weather'][0]['icon']);
                }
                if (isset($result['main'])) {
                    $weather->setTemp($result['main']['temp']);
                    $weather->setPressure($result['main']['pressure']);
                    $weather->setHumidity($result['main']['humidity']);
                    $weather->setTempMin($result['main']['temp_min']);
                    $weather->setTempMax($result['main']['temp_max']);
                }
                $weather->setVisibility($result['visibility']);
                if (isset($result['wind'])) {
                    $weather->setWindSpeed($result['wind']['speed']);
                    $weather->setWindDeg($result['wind']['deg']);
                }
                $weather->setClouds($result['clouds']['all']);
                $weather->setCurrentDate($result['dt']);
                $weather->setSunrise($result['sys']['sunrise'] ?? null);
                $weather->setSunset($result['sys']['sunset'] ?? null);

                $this->_weatherRepository->save($weather);
            } catch (\Exception $e) {
                $this->_logger->critical($e->getMessage());
            }
        }
    }

    /**
     * Get Weather
     *
     * @return array
     */
    public function getWeather()
    {
        $this->_logger->info('starutje cron');
        $result = [];
        $apiWeatherUrl = $this->_dataHelper->getApiWeatherUrl();

        $curl = $this->_curlFactory->create();
        $curl->write(\Zend_Http_Client::GET, $apiWeatherUrl, '1.1');
        try {
            $resultCurl = $curl->read();
            if (!empty($resultCurl)) {
                $responseBody = \Zend_Http_Response::extractBody($resultCurl);
                $result += $this->_dataHelper->jsonDecode($responseBody);
            }
        } catch (\Exception $e) {
            $this->_logger->critical($e->getMessage());
        }
        $curl->close();

        return $result;
    }
}