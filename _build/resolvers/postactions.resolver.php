<?php
if($options[xPDOTransport::PACKAGE_ACTION] == xPDOTransport::ACTION_UPGRADE) {
	$action = 'upgrade';	
} elseif ($options[xPDOTransport::PACKAGE_ACTION] == xPDOTransport::ACTION_INSTALL) {
	$action = 'install';	
}

$success = false;
switch ($action) {  
	case 'upgrade':
        $success = true;
        break;
	case 'install':
		// Create a reference to MODx since this resolver is executed from WITHIN a modCategory
		$modx =& $object->xpdo; 

		if (!isset($modx->eventsx) || $modx->eventsx == null) {
			$modx->addPackage('eventsx', $modx->getOption('core_path').'components/eventsx/model/');
		    $modx->eventsx = $modx->getService('eventsx', 'EventsX', $modx->getOption('core_path').'components/eventsx/model/eventsx/');
		}

		$mgr = $modx->getManager();
        $mgr->createObjectContainer('evxEvent');

		$success = true;
		break;
}