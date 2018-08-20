<?php
namespace Indave\NewContact\Controller\Adminhtml;

use Indave\NewContact\Model\ContactFactory;
use Indave\NewContact\Model\ResourceModel\Contact\CollectionFactory;
use Magento\Contact\Model\MailInterface;

abstract class Requests extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Indave_NewContact::manage_requests';

    protected $_contactFactory;

    protected $_collectionFactory;

    protected $_coreRegistry;

    protected $_resultPageFactory;

    protected $mail;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Registry $coreRegistry,
        ContactFactory $contactFactory,
        CollectionFactory $collectionFactory,
        MailInterface $mail
    ) {
        $this->_contactFactory = $contactFactory;
        $this->_collectionFactory = $collectionFactory;
        $this->_resultPageFactory = $resultPageFactory;
        $this->mail = $mail;
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context);
    }

}