<?php
/**
 * @package eventsx
 * @subpackage controllers
 */
require_once dirname(dirname(__FILE__)) . '/model/eventsx/eventsx.class.php';
$eventsx = new EventsX($modx);

return $eventsx->initialize('mgr');