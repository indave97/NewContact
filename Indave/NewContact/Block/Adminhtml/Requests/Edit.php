<?php

namespace Indave\NewContact\Block\Adminhtml\Requests;

use Magento\Backend\Block\Widget\Form\Container;

class Edit extends Container
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    /**
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Indave_NewContact::contact_save');
    }

    /**
     * Init class
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_objectId = 'id';
        $this->_controller = 'adminhtml_requests';
        $this->_blockGroup = 'Indave_NewContact';

        parent::_construct();

        $this->buttonList->update('save', 'label', __('Save Request'));
        $this->buttonList->update('delete', 'label', __('Delete Request'));

        $this->buttonList->add(
            'save_and_continue',
            [
                'label' => __('Save and Continue Edit'),
                'class' => 'save',
                'data_attribute' => [
                    'mage-init' => ['button' => ['event' => 'saveAndContinueEdit', 'target' => '#edit_form']],
                ]
            ],
            10
        );
    }
    /**
     * Retrieve text for header element depending on loaded news
     *
     * @return string
     */
    public function getHeaderText()
    {
        $newsRegistry = $this->_coreRegistry->registry('indave_newcontact');
        if ($newsRegistry->getId()) {
            $newsTitle = $this->escapeHtml($newsRegistry->getId());
            return __("Edit Request '%1'", $newsTitle);
        } else {
            return __('Add Request');
        }
    }

    protected function _getSaveAndContinueUrl()
    {
        return $this->getUrl('requests/*/save', ['_current' => true, 'back' => 'edit', 'active_tab' => '']);
    }
}