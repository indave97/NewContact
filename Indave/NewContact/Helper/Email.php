<?php
namespace Indave\NewContact\Helper;

use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\App\Area;
use Magento\Contact\Model\ConfigInterface;

class Email extends \Magento\Framework\App\Helper\AbstractHelper {

    const XML_PATH_EMAIL_TEMPLATE_FIELD = 'newcontact/email/indave_newcontact_answer';
    protected $_scopeConfig;
    protected $_storeManager;
    protected $inlineTranslation;
    protected $_transportBuilder;
    protected $temp_id;
    protected $contactsConfig;

    public function __construct(
        \Magento\Contact\Model\ConfigInterface $contactsConfig,
        \Magento\Framework\App\Helper\Context $context,
        StoreManagerInterface $storeManager,
        StateInterface $inlineTranslation,
        TransportBuilder $transportBuilder
    )
    {
        $this->_scopeConfig = $context;
        $this->contactsConfig = $contactsConfig;
        parent::__construct($context);
        $this->_storeManager = $storeManager;
        $this->inlineTranslation = $inlineTranslation;
        $this->_transportBuilder = $transportBuilder;
    }

    protected function getConfigValue($path, $storeId)
    {
        return $this->scopeConfig->getValue(
            $path,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    public function getStore()
    {
        return $this->_storeManager->getStore();
    }

    public function answerSend($emailTemplateVariables,$receiverInfo)
    {
        $this->inlineTranslation->suspend();
        try {
            $transport = $this->_transportBuilder
                ->setTemplateIdentifier('indave_newcontact_answer')
                ->setTemplateOptions(
                    [
                        'area' => Area::AREA_FRONTEND,
                        'store' => $this->_storeManager->getStore()->getId()
                    ]
                )
                ->setTemplateVars($emailTemplateVariables)
                ->setFrom($this->contactsConfig->emailSender())
                ->addTo($receiverInfo['email'])
                ->getTransport();

            $transport->sendMessage();
        } finally {
            $this->inlineTranslation->resume();
        }
    }
}