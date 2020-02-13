<?php

namespace MagentoTest\Modulemtest\Api;

use MagentoTest\Modulemtest\Api\Data\MainInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Api\SearchCriteriaInterface;
use MagentoTest\Modulemtest\Api\Data\MainSearchResultsInterface;

/**
 * Interface MainRepositoryInterface
 * @package MagentoTest\ModulemtestApi
 */
interface MainRepositoryInterface
{
    /**
     *
     * @param int $id
     *
     * @return MainInterface
     *
     * @throws NoSuchEntityException
     */
    public function getById(int $id);

    /**
     *
     * @param int $id
     *
     * @return MainInterface
     *
     */
    public function deleteById(int $id);

    /**
     *
     * @param MainInterface $main
     *
     * @throws CouldNotSaveException
     */
    public function save(MainInterface $main): void ;

    /**
     *
     * @param SearchCriteriaInterface $searchCriteria
     *
     * @return MainSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     *
     * @param MainInterface $main
     *
     * @throws CouldNotSaveException
     */
    public function delete(MainInterface $main);
}