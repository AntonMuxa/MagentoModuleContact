<?php

namespace MagentoTest\Modulemtest\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Main extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('magentotest_modulemtest_model', 'id');
    }
}
