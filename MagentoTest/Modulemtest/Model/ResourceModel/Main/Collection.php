<?php

namespace MagentoTest\Modulemtest\Model\ResourceModel\Main;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            \MagentoTest\Modulemtest\Model\Main::class,
            \MagentoTest\Modulemtest\Model\ResourceModel\Main::class
        );
    }
}
