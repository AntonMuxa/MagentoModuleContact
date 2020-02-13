<?php


namespace MagentoTest\Modulemtest\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface MainSearchResultsInterface extends SearchResultsInterface
{

    public function getItems();

    public function setItems(array $items);
}