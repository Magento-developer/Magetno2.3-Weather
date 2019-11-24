<?php
/**
 * Copyright © 2019 AmiCode. All rights reserved.
 */
namespace Amicode\Weather\Block;

use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\View\Element\Template;
use Amicode\Weather\Model\ResourceModel\Weather\Collection;

class Weather extends Template
{
    protected $_weatherCollection;

    public function __construct(
        Context $context,
        Collection $weatherCollection
    )
    {
        $this->_weatherCollection = $weatherCollection;
        parent::__construct($context);
    }

    /**
     * @return \Amicode\Weather\Model\Weather
     */
    public function getCurrentWeather()
    {
        $currentWeather = $this->_weatherCollection->getLastItem();
        return $currentWeather;
    }

    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }
}

