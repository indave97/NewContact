<?php

namespace Indave\NewContact\Controller\Adminhtml\Requests;

use Indave\NewContact\Controller\Adminhtml\Requests;

class Index extends Requests
{

    public function execute()
    {
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend((__('Requests')));

        return $resultPage;
    }


}