<?php

namespace Indave\NewContact\Controller\Adminhtml\Requests;

use Indave\NewContact\Controller\Adminhtml\Requests;

class Edit extends Requests
{
    /**
     * @return void
     */
    public function execute()
    {
        $requestId = $this->getRequest()->getParam('id');

        $model = $this->_contactFactory->create();
        $this->_coreRegistry->register('request_id', $requestId);

        if ($requestId) {
            $model->load($requestId);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This request no longer exists.'));
                $this->_redirect('*/*/');
                return;
            }
        }

        // Restore previously entered form data from session
        $data = $this->_session->getRequestData(true);
        if (!empty($data)) {
            $model->setData($data);
        }
        $this->_coreRegistry->register('indave_newcontact', $model);

        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('Indave_NewContact::main_menu');
        $resultPage->getConfig()->getTitle()->prepend(__('Simple Request'));

        return $resultPage;
    }
}