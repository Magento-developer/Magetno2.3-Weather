<?php
/**
 * Copyright © 2019 AmiCode. All rights reserved.
 */
namespace Amicode\Weather\Controller\Adminhtml\Weather;

use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\Request\DataPersistorInterface;

class Save extends Action implements HttpPostActionInterface
{

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    public function __construct(
        Action\Context $context,
        DataPersistorInterface $dataPersistor
    )
    {
        $this->dataPersistor = $dataPersistor;
        parent::__construct($context);
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Amicode_Weather::weather');
    }

    /**
     * Save action
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();


        if ($data) {
            if (empty($data['id'])) {
                $data['id'] = null;
            }
            /** @var \Amicode\Weather\Model\Weather $model */
            $model = $this->_objectManager->create('Amicode\Weather\Model\WeatherFactory')->create();

            $id = $this->getRequest()->getParam('id');
            if ($id) {
                try {
                    $model->load($id);
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This weather no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            }

            $model->setData($data);

            try {
                $model->save($model);

                $this->messageManager->addSuccessMessage(__('You saved the weather.'));
                $this->dataPersistor->clear('amicodeweather_weather');
                return $this->processPageReturn($model, $data, $resultRedirect);
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the weather.'));
            }

            $this->dataPersistor->set('amicodeweather_weather', $data);
            return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
        }
        return $resultRedirect->setPath('*/*/');
    }

    /**
     * Process and set the page return
     *
     * @param \Ideo\InstagramFeed\Model\ApiManage $model
     * @param array $data
     * @param \Magento\Framework\Controller\ResultInterface $resultRedirect
     * @return \Magento\Framework\Controller\ResultInterface
     */
    private function processPageReturn($model, $data, $resultRedirect)
    {
        $redirect = $data['back'] ?? 'close';

        if ($redirect ==='continue') {
            $resultRedirect->setPath('*/*/edit', ['id' => $model->getId()]);
        } else if ($redirect === 'close') {
            $resultRedirect->setPath('*/*/');
        }
        return $resultRedirect;
    }
}
