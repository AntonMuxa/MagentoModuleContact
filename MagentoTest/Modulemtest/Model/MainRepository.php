<?php

namespace MagentoTest\Modulemtest\Model;

use MagentoTest\Modulemtest\Api\Data\MainInterface;
use MagentoTest\Modulemtest\Api\Data\MainSearchResultsInterface;
use MagentoTest\Modulemtest\Api\MainRepositoryInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use MagentoTest\Modulemtest\Api\Data\MainSearchResultsInterfaceFactory;
use MagentoTest\Modulemtest\Model\ResourceModel\Main\CollectionFactory;
use MagentoTest\Modulemtest\Model\MainFactory;
use MagentoTest\Modulemtest\Model\ResourceModel\Main as ResourceModel;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class MainRepository.
 *
 * @package MagentoTest\Modulemtest\Model
 */
class MainRepository implements MainRepositoryInterface
{
    /**
     * @var ResourceModel
     */
    protected $resource;

    /**
     * @var \MagentoTest\Modulemtest\Model\MainFactory
     */
    protected $mainFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var mainSearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;

    /**
     * MainRepository constructor.
     *
     * @param ResourceModel                      $resource
     * @param \MagentoTest\Modulemtest\Model\MainFactory $mainFactory
     * @param CollectionProcessorInterface       $collectionProcessor
     * @param CollectionFactory                  $collectionFactory
     * @param MainSearchResultsInterfaceFactory  $mainSearchResultsInterfaceFactory
     */
    public function __construct(
        ResourceModel $resource,
        MainFactory $mainFactory,
        CollectionProcessorInterface $collectionProcessor,
        CollectionFactory $collectionFactory,
        MainSearchResultsInterfaceFactory $mainSearchResultsInterfaceFactory
    ) {
        $this->resource = $resource;
        $this->mainFactory = $mainFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->collectionFactory = $collectionFactory;
        $this->searchResultsFactory = $mainSearchResultsInterfaceFactory;
    }

    /**
     * @param int $id
     *
     * @return mainInterface|void
     * @throws NoSuchEntityException
     */
    public function getById(int $id)
    {
        $main = $this->mainFactory->create();
        $this->resource->load($main, $id);

        if (!$main->getId()) {
            throw new NoSuchEntityException(__('Main with id "%1" does not exist.', $id));
        }
    }

    public function deleteById(int $id)
    {
        $this->delete($this->getById($id));
    }

    /**
     * @param MainInterface $main
     *
     * @throws CouldNotSaveException
     */
    public function save(MainInterface $main): void
    {
        try {
            $this->resource->save($main);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     *
     * @return MainSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->collectionFactory->create();

        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResult = $this->searchResultsFactory->create();
        $searchResult->setSearchCriteria($searchCriteria);
        $searchResult->setItems($collection->getItems());
        $searchResult->setTotalCount($collection->getSize());

        return $searchResult;
    }

    /**
     * @param MainInterface $main
     *
     * @return $this
     */
    public function delete(MainInterface $main)
    {
        try {
            $this->resource->delete($main);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }

        return $this;
    }
}