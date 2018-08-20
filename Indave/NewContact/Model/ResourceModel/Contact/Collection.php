<?php

namespace Indave\NewContact\Model\ResourceModel\Contact;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'id';
    protected $_eventPrefix = 'contact_collection';
    protected $_eventObject = 'contact_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Indave\NewContact\Model\Contact', 'Indave\NewContact\Model\ResourceModel\Contact');
    }

    protected function getStatus(){
        $data = $this->getData();
        return $data['status'];
    }

}