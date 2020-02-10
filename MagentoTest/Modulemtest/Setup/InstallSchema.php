<?php

namespace MagentoTest\Modulemtest\Setup;

use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

/**
 * Class InstallSchema
 * @package Alevel\ModuleSchemazilla\Setup
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * @param SchemaSetupInterface   $setup
     * @param ModuleContextInterface $context
     *
     * @throws \Zend_Db_Exception
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $table = $setup->getConnection()
            ->newTable($setup->getTable('magentotest_modulemtest_model'))
            ->addColumn(
                'id',
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'primary'  => true, 'nullable' => false],
                'Entity Id'
            )->addColumn(
                'name',
                Table::TYPE_TEXT,
                null,
                [ 'nullable' => false],
                'Name'
            )->addColumn(
                'email',
                Table::TYPE_TEXT,
                null,
                ['nullable' => false],
                'Email'
            )->addColumn(
                'content',
                Table::TYPE_TEXT,
                null,
                ['nullable' => false],
                'Content'
            )->addColumn(
                'updated_at',
                Table::TYPE_DATETIME,
                null,
                ['nullable' => false, 'default' => new \Zend_Db_Expr('CURRENT_TIMESTAMP')],
                'Updated At'
            )->addIndex(
                $setup->getIdxName($setup->getTable('magentotest_modulemtest_model'), ['id'], AdapterInterface::INDEX_TYPE_INDEX),
                ['id'],
                [
                    'type' => AdapterInterface::INDEX_TYPE_INDEX
                ]
            );
        $setup->getConnection()->createTable($table);

        $setup->endSetup();
    }
}