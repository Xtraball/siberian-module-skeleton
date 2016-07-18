<?php

$schemas = (!isset($schemas)) ? array() : $schemas;
$schemas['job'] = array(
    'job_id' => array(
        'type' => 'int(11) unsigned',
        'auto_increment' => true,
        'primary' => true,
    ),
    'company_id' => array(
        'type' => 'int(11) unsigned',
        'foreign_key' => array(
            'table' => 'job_company',
            'column' => 'company_id',
            'name' => 'FK_JOB_COMPANY_COMPANY_ID',
            'on_update' => 'CASCADE',
            'on_delete' => 'CASCADE',
        ),
        'index' => array(
            'key_name' => 'IDX_COMPANY_ID',
            'index_type' => 'BTREE',
            'is_null' => false,
            'is_unique' => false,
        ),
    ),
    'title' => array(
        'type' => 'varchar(255)',
        'is_null' => true,
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
    ),
    'icon' => array(
        'type' => 'varchar(255)',
        'is_null' => true,
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
    ),
    'is_active' => array(
        'type' => 'tinyint(1) unsigned',
        'default' => '0',
    ),
    'created_at' => array(
        'type' => 'datetime',
    ),
    'updated_at' => array(
        'type' => 'datetime',
    ),
);