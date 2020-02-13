<?php

namespace MagentoTest\Modulemtest\Block;

use MagentoTest\Modulemtest\Api\MainRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

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

    public function __construct(
        Context $context,
        MainRepositoryInterface $mainRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->mainRepository = $mainRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
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
        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter('enabled', true, 'eq')
            ->create();

        $searchResult = $this->mainRepository->getList($searchCriteria);

        return $searchResult;
    }
}