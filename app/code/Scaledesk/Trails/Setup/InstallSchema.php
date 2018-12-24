<?php

namespace Scaledesk\Trails\Setup;

use \Magento\Framework\Setup\InstallSchemaInterface;
use \Magento\Framework\Setup\ModuleContextInterface;
use \Magento\Framework\Setup\SchemaSetupInterface;
use \Magento\Framework\DB\Ddl\Table;

/**
 * Class InstallSchema
 *
 * @package Scaledesk\Post\Setup
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * Install Blog Posts table
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $tableName = $setup->getTable('scaledesk_trails');
        

        if ($setup->getConnection()->isTableExists($tableName) != true) {
            $table = $setup->getConnection()
                ->newTable($tableName)
                ->addColumn(
                    'trails_id',
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'unsigned' => true,
                        'nullable' => false,
                        'primary' => true
                    ],
                    'ID'
                )
                ->addColumn(
                    'trails_name',
                    Table::TYPE_TEXT,
                    null,
                    ['nullable' => false],
                    'Title'
                )
                ->addColumn(
                    'trails_start_date',
                    Table::TYPE_DATETIME,
                    null,
                    ['nullable' => false],
                    'Start Date'
                )
                ->addColumn(
                    'trails_end_date',
                    Table::TYPE_DATETIME,
                    null,
                    ['nullable' => false],
                    'End Date'
                )
                ->addColumn(
                    'trails_trip_duration',
                    Table::TYPE_TEXT,
                    null,
                    ['nullable' => false],
                    'Trip Duration'
                )
                ->addColumn(
                    'trails_start_point',
                    Table::TYPE_TEXT,
                    null,
                    ['nullable' => false],
                    'Start Point'
                )
                ->addColumn(
                    'trails_end_point',
                    Table::TYPE_TEXT,
                    null,
                    ['nullable' => false],
                    'End Point'
                )
                ->addColumn(
                    'trails_vehicle_name',
                    Table::TYPE_TEXT,
                    null,
                    ['nullable' => false],
                    'Vehicle Name'
                )

                ->addColumn(
                    'trails_describing',
                    Table::TYPE_TEXT,
                    null,
                    ['nullable' => false],
                    'Start Describing'
                )
                ->addColumn(
                    'trails_url',
                    Table::TYPE_TEXT,
                    null,
                    ['nullable' => false],
                    'Image / Videos'
                )

                ->addColumn(
                    'trails_slug',
                    Table::TYPE_TEXT,
                    null,
                    ['nullable' => false],
                    'Slug'
                )

                ->addColumn(
                    'created_at',
                    Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => Table::TIMESTAMP_INIT],
                    'Created At'
                )

                ->addColumn(
                    'entity_id',
                    Table::TYPE_INTEGER,
                    null,
                    [

                        'nullable' => false,

                    ],
                    'User ID'
                )
                ->addColumn(
                    'trails_featured',
                    Table::TYPE_INTEGER,
                    null,
                    [

                        'nullable' => false,

                    ],
                    'Trails Featured'
                )

                ->setComment('Scaledesk Post');
            $setup->getConnection()->createTable($table);
        }

        $setup->endSetup();
    }
}
