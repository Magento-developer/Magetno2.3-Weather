<?php
/**
 * Copyright © 2019 AmiCode. All rights reserved.
 */
namespace Amicode\Weather\Controller\Adminhtml\Weather;

use Amicode\Weather\Model\UpdateWeatherFeed;
use Amicode\Weather\Logger\Logger;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;

class NewAction extends \Magento\Backend\App\Action
{

    /**
     * @var UpdateWeatherFeed
     */
    protected $_updateWeatherFeed;

    /**
     * @var Logger
     */
    protected $_logger;

    /**
     * @var ResultFactory
     */
    protected $_resultFactory;

    public function __construct(
        Context $context,
        UpdateWeatherFeed $updateWeatherFeed,
        Logger $logger,
        ResultFactory $resultFactory

    ) {
        $this->_updateWeatherFeed = $updateWeatherFeed;
        $this->_logger = $logger;
        $this->_resultFactory = $resultFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        try {
            $this->_updateWeatherFeed->execute();
            $this->messageManager->addSuccessMessage(__('A Weather have been updated.'));
        } catch (\Exception $e) {
            $this->_logger->critical($e->getMessage());
            $this->messageManager->addErrorMessage($e->getMessage());
        }


        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->_resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);

        return $resultRedirect->setPath('*/*/');
    }
}
