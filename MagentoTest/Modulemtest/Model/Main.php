<?php

namespace MagentoTest\Modulemtest\Model;

use Magento\Framework\Model\AbstractModel;
use MagentoTest\Modulemtest\Api\Data\MainInterface;

use MagentoTest\Modulemtest\Model\ResourceModel\Main as ResourceModel;

class Main extends AbstractModel implements MainInterface
{
    /**
     *  Init resource model.
     */
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    /**
     * @return mixed|string
     */
    public function getName()
    {
        return $this->getData(MainInterface::NAME);
    }

    /**
     * @return mixed|string
     */
    public function getEmail()
    {
        return $this->getData(MainInterface::EMAIL);
    }

    /**
     * @return mixed|string
     */
    public function getContent()
    {
        return $this->getData(MainInterface::CONTENT);
    }
    /**
     * @return mixed|string
     */
    public function getSeason()
    {
        return $this->getData(MainInterface::SEASON);
    }
}
