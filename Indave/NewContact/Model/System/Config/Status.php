<?php

namespace Indave\NewContact\Model\System\Config;

use Magento\Framework\Option\ArrayInterface;

class Status implements ArrayInterface
{
    const ENABLED  = 1;
    const DISABLED = 0;

    /**
     * @return array
     */
    public function toOptionArray()
    {
        $options = [
            self::ENABLED => __('Yes'),
            self::DISABLED => __('No')
        ];

        return $options;
    }
}