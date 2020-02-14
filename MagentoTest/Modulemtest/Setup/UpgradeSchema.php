<?php
namespace MagentoTest\Modulemtest\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * Upgrade the Catalog module DB scheme
 */
class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * {@inheritdoc}
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        if (version_compare($context->getVersion(), '0.0.3', '<')) {
            $setup->getConnection()->addColumn(
                $setup->getTable('magentotest_modulemtest_model'),
                'season',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => 16,
                    'nullable' => false,
                    'default' => '',
                    'comment' => 'Season'
                ]
            );
            $setup->getConnection()->addColumn(
                $setup->getTable('magentotest_modulemtest_model'),
                'enabled',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_BOOLEAN,
                    'length' => 1,
                    'nullable' => false,
                    'default' => 1,
                    'comment' => 'Enabled'
                ]
            );
        }
        $setup->endSetup();
    }
}
