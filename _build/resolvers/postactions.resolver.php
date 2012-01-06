<?php
if($options[xPDOTransport::PACKAGE_ACTION] == xPDOTransport::ACTION_UPGRADE) {
	$action = 'upgrade';	
} elseif ($options[xPDOTransport::PACKAGE_ACTION] == xPDOTransport::ACTION_INSTALL) {
	$action = 'install';	
}

$success = false;
switch ($action) {  
	case 'upgrade':
	case 'install':
		// Create a reference to MODx since this resolver is executed from WITHIN a modCategory
		$modx =& $object->xpdo; 

		if (!isset($modx->eventsx) || $modx->eventsx == null) {
			$modx->addPackage('eventsx', $modx->getOption('core_path').'components/eventsx/model/');
		    $modx->eventsx = $modx->getService('eventsx', 'EventsX', $modx->getOption('core_path').'components/eventsx/model/eventsx/');
		}

		$mgr = $modx->getManager();
        $mgr->createObjectContainer('evxEvent');

        $modx->exec("ALTER TABLE {$modx->getTableName('evxEvent')} ADD `region` varchar(255) NOT NULL default '' AFTER `city`");
        $modx->exec("ALTER TABLE {$modx->getTableName('evxEvent')} ADD `introtext` text NOT NULL default '' AFTER `name`");

		$success = true;
		break;
}