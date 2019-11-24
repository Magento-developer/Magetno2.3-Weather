<?php
/**
 * Copyright © 2019 AmiCode. All rights reserved.
 */
namespace Amicode\Weather\Controller\Adminhtml\Weather;

class Delete extends \Magento\Backend\App\Action
{

    /**
     * Delete action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('id');

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

        if ($id) {
            $title = __('Weather');
            try {
                // init model and delete
                $model = $this->_objectManager->create('Amicode\Weather\Model\Weather');
                $model->load($id);
               
                $model->delete();
                // display success message
                $this->messageManager->addSuccessMessage(__('The weather has been deleted.'));
                // go to grid
                $this->_eventManager->dispatch(
                    'adminhtml_amicodeweather_on_delete',
                    ['title' => $title, 'status' => 'success']
                );
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->_eventManager->dispatch(
                    'adminhtml_amicodeweather_on_delete',
                    ['title' => $title, 'status' => 'fail']
                );
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a weather to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}
