<?php

namespace MagentoTest\Modulemtest\Block;

use MagentoTest\Modulemtest\Api\MainRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\App\Config\ScopeConfigInterface;

class Main extends Template
{
    /**
     * @var MainRepositoryInterface
     */
    private $mainRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;
    protected $_scopeConfig;

    public function __construct(
        Context $context,
        MainRepositoryInterface $mainRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        ScopeConfigInterface $scopeConfig,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->mainRepository = $mainRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->_scopeConfig = $scopeConfig;
    }

    /**
     * <pre>
     * - ["from" => $fromValue, "to" => $toValue]
     * - ["eq" => $equalValue]
     * - ["neq" => $notEqualValue]
     * - ["like" => $likeValue]
     * - ["in" => [$inValues]]
     * - ["nin" => [$notInValues]]
     * - ["notnull" => $valueIsNotNull]
     * - ["null" => $valueIsNull]
     * - ["moreq" => $moreOrEqualValue]
     * - ["gt" => $greaterValue]
     * - ["lt" => $lessValue]
     * - ["gteq" => $greaterOrEqualValue]
     * - ["lteq" => $lessOrEqualValue]
     * - ["finset" => $valueInSet]
     * </pre>
     *
     * @return MainSearchResultsInterface
     */
    public function getMain()
    {

        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORES;
        $limit = $this->_scopeConfig->getValue("coupon/fields_masks/coupon_default_val", $storeScope);

        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter('enabled', true, 'eq')
            ->setPageSize($limit)
            ->create();



        $searchResult = $this->mainRepository->getList($searchCriteria);

        return $searchResult;
    }
}