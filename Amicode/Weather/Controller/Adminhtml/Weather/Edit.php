<?php
/**
 * Copyright © 2019 AmiCode. All rights reserved.
 */
namespace Amicode\Weather\Controller\Adminhtml\Weather;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Registry;

class Edit extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_resultPageFactory;


    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_coreRegistry;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magento\Framework\Registry $registry
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        Registry $registry
    ) {
        parent::__construct($context);
        $this->_coreRegistry = $registry;
        $this->_resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('id');

        $model = $this->_objectManager->create(\Amicode\Weather\Model\Weather::class);
        // 2. Initial checking
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This weather feed no longer exists.'));
                /** \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }

        $this->_coreRegistry->register('amicodeweather_weather', $model);

        // 5. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->_initAction();
        //$titlePage =
        $resultPage->getConfig()->getTitle()->prepend(__('Weather Feed'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? $model->getName() . ': [' . $model->getCurrentDate() . "]" : __('Add Weather'));

        return $resultPage;
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
        $resultPage->addBreadcrumb(__('Weather Feed Edit'), __('Weather Feed Edit'));

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

