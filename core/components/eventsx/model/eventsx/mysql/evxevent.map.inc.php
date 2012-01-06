<?php
$xpdo_meta_map['evxEvent']= array (
  'package' => 'eventsx',
  'table' => 'eventsx_events',
  'fields' => 
  array (
    'active' => 0,
    'name' => '',
    'introtext' => '',
    'description' => '',
    'startdate' => NULL,
    'enddate' => NULL,
    'location' => '',
    'street' => '',
    'pc' => '',
    'city' => '',
    'region' => '',
    'country' => '',
    'website' => '',
  ),
  'fieldMeta' => 
  array (
    'active' => 
    array (
      'dbtype' => 'int',
      'precision' => '1',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
    'name' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'introtext' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'description' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'startdate' => 
    array (
      'dbtype' => 'date',
      'phptype' => 'date',
      'null' => true,
    ),
    'enddate' => 
    array (
      'dbtype' => 'date',
      'phptype' => 'date',
      'null' => true,
    ),
    'location' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'street' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'pc' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '10',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'city' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'region' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'country' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'website' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
  ),
);
