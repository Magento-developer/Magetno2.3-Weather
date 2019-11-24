<?php
/**
 * Copyright © 2019 AmiCode. All rights reserved.
 */

namespace Amicode\Weather\Helper;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\Filesystem;
use Magento\Framework\Filesystem\Driver\File;
use Magento\Framework\Json\Helper\Data as JsonHelper;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\StoreManagerInterface;


/**
 * Class Data
 * @package Amicode\Weather\Helper
 */
class Data extends AbstractHelper
{
    /**
     * @type string
     */
    const CONFIG_XML_ENABLE = 'amicodeweather/general/enable';

    /**
     * @type string
     */
    const CONFIG_XML_ACCESS_KEY = 'amicodeweather/general/api_key';

    /**
     * @type string
     */
    const CONFIG_XML_CITY_NAME = 'amicodeweather/general/city_name';

    /**
     * @type string
     */
    const CONFIG_XML_API_URL = 'http://api.openweathermap.org/data/2.5/weather?units=metric';

    /**
     * @type StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @type JsonHelper
     */
    protected $jsonHelper;

    /**
     * @type ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * Data constructor.
     * @param Context $context
     * @param StoreManagerInterface $storeManager
     * @param JsonHelper $jsonHelper
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        Context $context,
        StoreManagerInterface $storeManager,
        JsonHelper $jsonHelper,
        ScopeConfigInterface $scopeConfig
    )
    {
        $this->storeManager = $storeManager;
        $this->jsonHelper = $jsonHelper;
        $this->scopeConfig = $scopeConfig;

        parent::__construct($context);
    }

    /**
     * Get Access Key
     * @return string
     */
    public function getAccessKey()
    {
        return $this->scopeConfig->getValue(self::CONFIG_XML_ACCESS_KEY, ScopeInterface::SCOPE_STORE);
    }

    /**
     * Get city name
     *
     * @return string
     */
    public function getCityName()
    {
        return $this->scopeConfig->getValue(self::CONFIG_XML_CITY_NAME, ScopeInterface::SCOPE_STORE);
    }

    /**
     * Get Api Weather url
     *
     * @return string
     */
    public function getApiWeatherUrl()
    {
        $apiWeatherUrl = self::CONFIG_XML_API_URL;
        $cityName = $this->getCityName();
        $accessKey = $this->getAccessKey();

        return $apiWeatherUrl . '&q=' . $cityName . ',PL&appid=' . $accessKey;
    }

    /**
     * Decodes the given $encodedValue string which is
     * encoded in the JSON format
     *
     * @param string $encodedValue
     *
     * @return mixed
     */
    public function jsonDecode($encodedValue)
    {
        try {
            $decodeValue = $this->jsonHelper->jsonDecode($encodedValue);
        } catch (\Exception $e) {
            $decodeValue = [];
        }
        return $decodeValue;
    }

    /**
     * Check module is enable
     *
     * @return bool
     */
    public function isModuleEnable()
    {
        return $this->scopeConfig->getValue(self::CONFIG_XML_ENABLE, ScopeInterface::SCOPE_STORE);
    }

    /**
     * @return mixed
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getMediaUrl()
    {
        $mediaUrl = $this->storeManager
            ->getStore()
            ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        return $mediaUrl;
    }

    /**
     * @param $imageName
     * @return string|null
     */
    public function getImage($imageName)
    {
        if ($imageName) {
            $imageName .= '@2x.png';
            return $imageName;
        }
    }
}
