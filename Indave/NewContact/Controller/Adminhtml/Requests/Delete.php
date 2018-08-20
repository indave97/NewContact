<?php

namespace Indave\NewContact\Controller\Adminhtml\Requests;

use Magento\Backend\App\Action;

class Delete extends Action
{
    protected $_model;

    /**
     * @param Action\Context $context
     * @param \Maxime\Jobs\Model\Department $model
     */
    public function __construct(
        Action\Context $context,
        \Indave\NewContact\Model\Contact $model
    ) {
        parent::__construct($context);
        $this->_model = $model;
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Indave_NewContact::contact_delete');
    }

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $model = $this->_model;
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccessMessage(__('Request deleted'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }
        $this->messageManager->addErrorMessage(__('Request does not exist'));
        return $resultRedirect->setPath('*/*/');
    }
}