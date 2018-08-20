<?php

namespace Indave\NewContact\Controller\Adminhtml\Requests;

use Indave\NewContact\Controller\Adminhtml\Requests;
use Magento\TestFramework\Event\Magento;

class Save extends Requests
{
    /**
     * @return void
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();

        if ($data) {
            $requestModel = $this->_contactFactory->create();
            $requestId = $this->getRequest()->getParam('id');

            $requestModel->load($requestId);
            $info = $requestModel->getData();
            $requestModel->setData($data);

            try {
                // Save news
                $saveData = $requestModel->save();
                if($saveData){
                    /* Receiver Detail  */
                    $receiverInfo = [
                        'email' => $info['email']
                    ];

                    $emailTempVariables['comment'] = $requestModel['answer'];

                    /* We write send mail function in helper because if we want to
                       use same in other action then we can call it directly from helper */

                    /* call send mail method from helper or where you define it*/
                    $this->_objectManager->get('Indave\NewContact\Helper\Email')->answerSend(
                        $emailTempVariables,
                        $receiverInfo
                    );

                    // Display success message
                    $this->messageManager->addSuccessMessage(__('The request has been saved.'));

                    // Check if 'Save and Continue'
                    if ($this->getRequest()->getParam('back')) {
                        $this->_redirect('*/*/edit', ['id' => $requestModel->getId(), '_current' => true]);
                        return;
                    }

                    // Go to grid page
                    $this->_redirect('*/*/');
                    return;
                }
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            }

            $this->_getSession()->setFormData($data);
            $this->_redirect('*/*/edit', ['id' => $requestId]);
        }
    }
}