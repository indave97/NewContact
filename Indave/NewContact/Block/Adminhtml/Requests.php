<?php
namespace Indave\NewContact\Block\Adminhtml;

class Requests extends \Magento\Backend\Block\Widget\Grid\Container
{

    protected function _construct()
    {
        $this->_controller = 'adminhtml_requests';
        $this->_blockGroup = 'Indave_NewContact';
        $this->_headerText = __('Requests');
        $this->_addButtonLabel = __('Create New Request');
        parent::_construct();
    }
}