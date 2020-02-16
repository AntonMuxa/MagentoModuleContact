<?php


namespace MagentoTest\Modulemtest\Block\Adminhtml;

use Magento\Backend\Block\Template;


class Main extends Template
{

    public function greet()
    {
        $return = 'Hello world';
        return $return;
    }

}