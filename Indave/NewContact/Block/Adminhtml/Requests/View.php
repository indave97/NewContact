<?php
namespace Indave\NewContact\Block\Adminhtml\Requests;

class View extends \Magento\Framework\View\Element\Template
{
    protected $_contactFactory;
    protected $_coreRegistry;
    protected $_id;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Indave\NewContact\Model\ContactFactory $contactFactory,
        \Magento\Framework\Registry $coreRegistry
    )
    {
        $this->_contactFactory = $contactFactory;
        $this->_coreRegistry = $coreRegistry;
        $this->_id = $this->_coreRegistry->registry('request_id');
        parent::__construct($context);
    }


    public function getCollection(){
        return $this->_coreRegistry->registry('indave_newcontact_request');
    }

    public function getEditUrl()
    {
        return $this->_urlBuilder->getUrl('*/*/edit', ['id' => $this->_id]);
    }
    public function getBackUrl()
    {
        return $this->_urlBuilder->getUrl('*/*/');
    }
    public function getDeleteUrl()
    {
        return $this->_urlBuilder->getUrl('*/*/delete', ['id' => $this->_id]);
    }

}