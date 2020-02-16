<?php


namespace MagentoTest\Modulemtest\Setup;

use Magento\Framework\DB\TransactionFactory;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Psr\Log\LoggerInterface;
use MagentoTest\Modulemtest\Api\Data\MainInterfaceFactory;
use Magento\Framework\Math\Random;


class UpgradeData implements UpgradeDataInterface
{
    /**
     * @var MainInterfaceFactory
     */
    private $mainFactory;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var TransactionFactory
     */
    private $transactionFactory;

    /**
     * @var Random
     */
    private $random;

    /**
     * UpgradeData constructor.
     *
     * @param MainInterfaceFactory $mainFactory
     * @param TransactionFactory      $transactionFactory
     * @param SearchCriteriaBuilder   $searchCriteriaBuilder
     * @param Random                  $random
     */

    public function __construct(
        MainInterfaceFactory $mainFactory,
        TransactionFactory $transactionFactory,
        LoggerInterface $logger,
        Random $random
    ) {
        $this->mainFactory = $mainFactory;
        $this->transactionFactory = $transactionFactory;
        $this->logger = $logger;
        $this->random = $random;
    }

    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface   $context
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '0.0.4') < 0) {
            $this->changeData();
        }

        $setup->endSetup();
    }

    /**
     *
     */
    private function changeData()
    {
        $transactionModel = $this->transactionFactory->create();

        for ($i = 3; $i < 20; $i++) {
            $enabled = true;

            $main = $this->mainFactory->create();
            $main->setName(sprintf('Name %d', $i));
            $main->setEmail(sprintf('test_%d@localhost', $i));
            $main->setContent(sprintf('some content%d', $i));
            $main->setSeason('winter');

            if ($i % 2 == 0) {
                $enabled = false;
            }

            $main->setEnabled($enabled);

            $transactionModel->addObject($main);
        }

        try {
            $transactionModel->save();
        } catch ( \Exception $exception) {
            $this->logger->critical($exception->getMessage());
        }
    }

}