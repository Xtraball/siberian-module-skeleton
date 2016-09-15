<?php

$schemas = (!isset($schemas)) ? array() : $schemas;
$schemas['job_company'] = array(
    'company_id' => array(
        'type' => 'int(11) unsigned',
        'auto_increment' => true,
        'primary' => true,
    ),
    'job_id' => array(
        'type' => 'int(11) unsigned',
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
    'location' => array(
        'type' => 'varchar(512)',
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
    ),
    'employee_count' => array(
        'type' => 'varchar(128)',
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
    ),
    'email' => array(
        'type' => 'varchar(64)',
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
    ),
    'logo' => array(
        'type' => 'varchar(255)',
        'is_null' => true,
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
    ),
    'header' => array(
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