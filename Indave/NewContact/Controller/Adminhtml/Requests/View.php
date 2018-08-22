<?php
namespace Indave\NewContact\Controller\Adminhtml\Requests;

use Indave\NewContact\Controller\Adminhtml\Requests;

class View extends Requests{

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

        $this->_coreRegistry->register('indave_newcontact_request', $model);

        $resultPage = $this->_resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend((__('View Request')));

        return $resultPage;
    }

}