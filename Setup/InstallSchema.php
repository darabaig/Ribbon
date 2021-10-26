<?php
/**
 * Dara.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the End-user License Agreement
 *
 * @package     Dara Ribbon v1.x.x
 * @copyright   Copyright (c) 2021 Dara.
 * @license     End-user License Agreement
 * See COPYING.txt for license details.
 */

namespace Dara\Ribbon\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        /**
         * Create table 'dara_ribbons'
         */
        $table = $installer->getConnection()->newTable(
            $installer->getTable('dara_ribbons')
        )->addColumn(
            'ribbon_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true],
            'Ribbon ID'
        )->addColumn(
            'ribbon_name',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Ribbon Title'
        )->addColumn(
            'ribbon_description',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            '2M',
            [],
            'Ribbon Description'
        )->addColumn(
            'ribbon_link',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Ribbon Link'
        )->addColumn(
            'ribbon_color',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Band Color'
        )->addColumn(
            'ribbon_start_date',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Ribbon Start Date'
        )->addColumn(
            'ribbon_end_date',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Ribbon End Date'
        )->addColumn(
            'ribbon_pages',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Ribbon Pages'
        )->addColumn(
            'creation_time',
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
            'Ribbon Creation Time'
        )->addColumn(
            'update_time',
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
            'Ribbon Modification Time'
        )->addColumn(
            'is_active',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            ['nullable' => false, 'default' => '1'],
            'Is Ribbon Active'
        )->addIndex(
            $setup->getIdxName(
                $installer->getTable('dara_ribbons'),
                ['ribbon_name', 'ribbon_link'],
                AdapterInterface::INDEX_TYPE_FULLTEXT
            ),
            ['ribbon_name', 'ribbon_link'],
            ['type' => AdapterInterface::INDEX_TYPE_FULLTEXT]
        )->setComment(
            'Dara Ribbon Table'
        );
        $installer->getConnection()->createTable($table);
        $installer->endSetup();
    }
}
