<?php
/**
 * EventsX Connector
 *
 * @package eventsx
 */
require_once dirname(dirname(dirname(dirname(__FILE__)))).'/config.core.php';
require_once MODX_CORE_PATH.'config/'.MODX_CONFIG_KEY.'.inc.php';
require_once MODX_CONNECTORS_PATH.'index.php';

$corePath = $modx->getOption('eventsx.core_path',null,$modx->getOption('core_path').'components/eventsx/');
require_once $corePath.'model/eventsx/eventsx.class.php';
$modx->eventsx = new EventsX($modx);

$modx->lexicon->load('eventsx:default');

/* handle request */
$path = $modx->getOption('processorsPath',$modx->eventsx->config,$corePath.'processors/');
$modx->request->handleRequest(array(
    'processors_path' => $path,
    'location' => '',
));