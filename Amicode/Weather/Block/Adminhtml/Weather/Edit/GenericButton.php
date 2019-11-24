<?php
/**
 * Copyright © 2019 AmiCode. All rights reserved.
 */
namespace Amicode\Weather\Block\Adminhtml\Weather\Edit;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Exception\NoSuchEntityException;
use Amicode\Weather\Api\WeatherRepositoryInterface;

/**
 * Class GenericButton
 */
class GenericButton
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * @var WeatherRepositoryInterface
     */
    protected $_weatherRepository;

    /**
     * @param Context $context
     * @param WeatherRepositoryInterface $weatherRepository
     */
    public function __construct(
        Context $context,
        WeatherRepositoryInterface $weatherRepository
    ) {
        $this->context = $context;
        $this->_weatherRepository = $weatherRepository;
    }

    /**
     * Return Category ID
     *
     * @return int|null
     */
    public function getWeatherId()
    {
        try {
            return $this->_weatherRepository->get(
                $this->context->getRequest()->getParam('id')
            )->getId();
        } catch (NoSuchEntityException $e) {
        }
        return null;
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
