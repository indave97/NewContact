<?php

namespace Indave\NewContact\Model;

class Contact extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface{

    const CACHE_TAG = 'contact';

    protected $_cacheTag = 'contact';

    protected $_eventPrefix = 'contact';


    protected function _construct()
    {
        $this->_init('Indave\NewContact\Model\ResourceModel\Contact');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }
}