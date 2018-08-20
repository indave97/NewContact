<?php

namespace Indave\NewContact\Setup;

use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface{

    public function install(SchemaSetupInterface $setup,ModuleContextInterface $context){
        $setup->startSetup();
        $conn = $setup->getConnection();
        $tableName = $setup->getTable('contact');
        if($conn->isTableExists($tableName) != true){
            $table = $conn->newTable($tableName)
                ->addColumn(
                    'id',
                    Table::TYPE_INTEGER,
                    null,
                    ['identity'=>true,'unsigned'=>true,'nullable'=>false,'primary'=>true]
                )
                ->addColumn(
                    'name',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable'=>false,'default'=>'']
                )
                ->addColumn(
                    'email',
                    Table::TYPE_TEXT,
                    255,
                    ['nullbale'=>false,'default'=>'']
                )
                ->addColumn(
                    'text',
                    Table::TYPE_TEXT,
                    '2M',
                    ['nullbale'=>false,'default'=>'']
                )
                ->addColumn(
                    'answer',
                    Table::TYPE_TEXT,
                    '2M',
                    ['nullbale'=>false,'default'=>'']
                )
                ->addColumn(
                    'status',
                    Table::TYPE_SMALLINT,
                    2,
                    ['nullbale'=>false,'default'=> 0]
                )
                ->setOption('charset','utf8');
            $conn->createTable($table);
        }
        $setup->endSetup();
    }

}