<?php
/**
 * Copyright © 2019 AmiCode. All rights reserved.
 */
namespace Amicode\Weather\Controller\Adminhtml\Weather;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Amicode\Weather\Helper\Data as DataHelper;

class Index extends \Magento\Backend\App\Action
{
	/**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_resultPageFactory;

    /**
     * @var \Amicode\Weather\Helper\Data
     */
    protected $dataHelper;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Amicode\Weather\Helper\Data $dataHelper
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        DataHelper $dataHelper
    ) {
        parent::__construct($context);
        $this->_resultPageFactory = $resultPageFactory;
        $this->_dataHelper = $dataHelper;
    }

    public function execute()
    {
        if ($this->isModuleEnable()) {
            /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
            $resultPage = $this->_initAction();
            return $resultPage;
        } else {
            /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('adminhtml/system_config/edit/section/amicodeweather');
        }
    }

    /**
     * @return boolean
     */
    private function isModuleEnable()
    {
        return $this->_dataHelper->isModuleEnable();
    }

    /**
     * Init layout, menu and breadcrumb
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    protected function _initAction()
    {
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('Amicode_Weather::weather');
        $resultPage->addBreadcrumb(__('Weather Feed'), __('Weather Feed'));
        $resultPage->addBreadcrumb(__('Weather Feed Grid'), __('Weather Feed Grid'));
        $resultPage->getConfig()->getTitle()->prepend(__('Weather Feed Grid'));
        return $resultPage;
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Amicode_Weather::weather');
    }
}

