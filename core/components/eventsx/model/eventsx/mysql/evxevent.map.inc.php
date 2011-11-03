<?php
$xpdo_meta_map['evxEvent']= array (
  'package' => 'eventsx',
  'table' => 'eventsx_events',
  'fields' => 
  array (
    'active' => 0,
    'name' => '',
    'description' => '',
    'startdate' => NULL,
    'enddate' => NULL,
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
  ),
);
