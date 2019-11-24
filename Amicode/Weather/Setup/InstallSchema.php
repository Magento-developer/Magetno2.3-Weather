<?php
/**
 * Copyright © 2019 AmiCode. All rights reserved.
 */

namespace Amicode\Weather\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @throws \Zend_Db_Exception
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    )
    {
        $installer = $setup;
        $installer->startSetup();

        $weatherTable = $installer->getTable('amicode_weather');

        if (!$setup->tableExists($weatherTable)) {
            $table = $setup->getConnection()->newTable(
                $weatherTable
            )
                ->addColumn(
                    'entity_id',
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'nullable' => false,
                        'primary' => true,
                        'unsigned' => true,
                    ],
                    'Entity_id ID'
                )
                ->addColumn(
                    'weather_main',
                    Table::TYPE_TEXT,
                    64,
                    [],
                    'Group of weather parameters'
                )
                ->addColumn(
                    'weather_description',
                    Table::TYPE_TEXT,
                    256,
                    [],
                    'Weather condition within the group'
                )
                ->addColumn(
                    'weather_icon',
                    Table::TYPE_TEXT,
                    64,
                    [],
                    'Weather icon id'
                )
                ->addColumn(
                    'temp',
                    Table::TYPE_FLOAT,
                    null,
                    [],
                    'Temperature'
                )
                ->addColumn(
                    'humidity',
                    Table::TYPE_INTEGER,
                    null,
                    ['unsigned' => true],
                    'Humidity, %'
                )
                ->addColumn(
                    'pressure',
                    Table::TYPE_INTEGER,
                    null,
                    ['unsigned' => true],
                    'Atmospheric pressure'
                )
                ->addColumn(
                    'temp_min',
                    Table::TYPE_FLOAT,
                    null,
                    [],
                    'Minimum temperature'
                )
                ->addColumn(
                    'temp_max',
                    Table::TYPE_FLOAT,
                    null,
                    [],
                    'Maximum temperature'
                )
                ->addColumn(
                    'visibility',
                    Table::TYPE_INTEGER,
                    null,
                    ['unsigned' => true],
                    'Visibility'
                )
                ->addColumn(
                    'wind_speed',
                    Table::TYPE_FLOAT,
                    null,
                    [],
                    'Wind speed'
                )
                ->addColumn(
                    'wind_deg',
                    Table::TYPE_INTEGER,
                    null,
                    ['unsigned' => true],
                    'Wind direction'
                )
                ->addColumn(
                    'clouds',
                    Table::TYPE_INTEGER,
                    null,
                    ['unsigned' => true],
                    'Cloudiness'
                )
                ->addColumn(
                    'current_date',
                    Table::TYPE_TIMESTAMP,
                    null,
                    [],
                    'Time of data calculation'
                )
                ->addColumn(
                    'sunrise',
                    Table::TYPE_TIMESTAMP,
                    null,
                    [],
                    'Sunrise'
                )
                ->addColumn(
                    'sunset',
                    Table::TYPE_TIMESTAMP,
                    null,
                    [],
                    'Sunset'
                )
                ->addColumn(
                    'name',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => false],
                    'City name'
                )
                ->addColumn(
                    'created_at',
                    Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => Table::TIMESTAMP_INIT],
                    'Created At'
                )
                ->addColumn(
                    'updated_at',
                    Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => Table::TIMESTAMP_INIT_UPDATE],
                    'Updated At'
                )
                ->addIndex(
                    $installer->getIdxName('amicode_weather', ['name']),
                    ['name']
                )
                ->setComment('Weather Table');
            $installer->getConnection()->createTable($table);

        } else {
            $installer->getConnection()->truncateTable($weatherTable);
        }
        $installer->endSetup();
    }
}
