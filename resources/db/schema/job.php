<?php
/**
 *
 * Schema definition for 'mcommerce'
 *
 * Last update: 2016-04-28
 *
 */
$schemas = (!isset($schemas)) ? array() : $schemas;
$schemas['job'] = array(
    'job_id' => array(
        'type' => 'int(11) unsigned',
        'auto_increment' => true,
        'primary' => true,
    ),
    'value_id' => array(
        'type' => 'int(11) unsigned',
    ),
    'display_search' => array(
        'type' => 'tinyint(1) unsigned',
        'default' => '1',
    ),
    'display_place_icon' => array(
        'type' => 'tinyint(1) unsigned',
        'default' => '0',
    ),
    'title_company' => array(
        'type' => 'varchar(128)',
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'default' => 'Company',
    ),
    'title_place' => array(
        'type' => 'varchar(128)',
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'default' => 'Place',
    ),
    'created_at' => array(
        'type' => 'datetime',
    ),
    'updated_at' => array(
        'type' => 'datetime',
    ),
);