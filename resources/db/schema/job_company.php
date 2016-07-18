<?php

$schemas = (!isset($schemas)) ? array() : $schemas;
$schemas['job_company'] = array(
    'company_id' => array(
        'type' => 'int(11) unsigned',
        'auto_increment' => true,
        'primary' => true,
    ),
    'name' => array(
        'type' => 'varchar(255)',
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
    ),
    'description' => array(
        'type' => 'text',
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