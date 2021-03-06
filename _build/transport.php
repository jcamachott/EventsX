<?php
/**
 * EventsX build script
 *
 * @package eventsx
 * @subpackage build
 */
$mtime = microtime();
$mtime = explode(" ", $mtime);
$mtime = $mtime[1] + $mtime[0];
$tstart = $mtime;
set_time_limit(0); /* makes sure our script doesn't timeout */

$root = dirname(dirname(__FILE__)).'/';

$root = $_SERVER['DOCUMENT_ROOT'].'/';

$sources= array (
    'root' => $root,
    'build' => $root .'_build_eventsx/',
    'resolvers' => $root . '_build_eventsx/resolvers/',
    'data' => $root . '_build_eventsx/data/',
    'source_core' => $root.'core/components/eventsx',
    'lexicon' => $root . 'core/components/eventsx/lexicon/',
    'source_assets' => $root.'assets/components/eventsx',
    'docs' => $root.'core/components/eventsx/docs/',
);

unset($root); // save memory

require_once dirname(__FILE__) . '/build.config.php';

require_once MODX_CORE_PATH . 'model/modx/modx.class.php';

$modx= new modX();
$modx->initialize('mgr');
$modx->setLogLevel(modX::LOG_LEVEL_INFO);
$modx->setLogTarget(XPDO_CLI_MODE ? 'ECHO' : 'HTML');

$modx->loadClass('transport.modPackageBuilder','',false, true);
$builder = new modPackageBuilder($modx);
$builder->createPackage('eventsx','0.1.0','alpha');
$builder->registerNamespace('eventsx',false,true,'{core_path}components/eventsx/');

/* load action/menu */
$menu = include $sources['data'].'transport.menu.php';

$vehicle= $builder->createVehicle($menu,array (
    xPDOTransport::PRESERVE_KEYS => true,
    xPDOTransport::UPDATE_OBJECT => true,
    xPDOTransport::UNIQUE_KEY => 'text',
    xPDOTransport::RELATED_OBJECTS => true,
    xPDOTransport::RELATED_OBJECT_ATTRIBUTES => array (
        'Action' => array (
            xPDOTransport::PRESERVE_KEYS => false,
            xPDOTransport::UPDATE_OBJECT => true,
            xPDOTransport::UNIQUE_KEY => array ('namespace','controller'),
        ),
    ),
));
$builder->putVehicle($vehicle);
unset($vehicle,$action); /* to keep memory low */

/* create category */
$category= $modx->newObject('modCategory');
$category->set('id',1);
$category->set('category','EventsX');

include $sources['data'].'transport.snippets.php';
$category->addMany($snippets);

include $sources['data'].'transport.chunks.php';
$category->addMany($chunks);

include $sources['data'].'transport.plugins.php';
$category->addMany($plugins);

/* create category vehicle */
$attr = array(
    xPDOTransport::UNIQUE_KEY => 'category',
    xPDOTransport::PRESERVE_KEYS => false,
    xPDOTransport::UPDATE_OBJECT => true,
    xPDOTransport::RELATED_OBJECTS => true,
    xPDOTransport::RELATED_OBJECT_ATTRIBUTES => array (
        'Snippets' => array(
            xPDOTransport::PRESERVE_KEYS => false,
            xPDOTransport::UPDATE_OBJECT => true,
            xPDOTransport::UNIQUE_KEY => 'name',
        ),
        'Chunks' => array (
            xPDOTransport::PRESERVE_KEYS => false,
            xPDOTransport::UPDATE_OBJECT => false,
            xPDOTransport::UNIQUE_KEY => 'name',
        ),
        'Plugins' => array (
            xPDOTransport::PRESERVE_KEYS => true,
            xPDOTransport::UPDATE_OBJECT => true,
            xPDOTransport::UNIQUE_KEY => 'name',
        ),
        'PluginEvents' => array(
            xPDOTransport::PRESERVE_KEYS => true,
            xPDOTransport::UPDATE_OBJECT => false,
            xPDOTransport::UNIQUE_KEY => array('pluginid','event'),
        )
    )
);
$vehicle = $builder->createVehicle($category,$attr);

$vehicle->resolve('file',array(
    'source' => $sources['source_core'],
    'target' => "return MODX_CORE_PATH . 'components/';",
));
$vehicle->resolve('file',array(
    'source' => $sources['source_assets'],
    'target' => "return MODX_ASSETS_PATH . 'components/';",
));
$vehicle->resolve('php',array(
    'source' => $sources['resolvers'].'postactions.resolver.php',
));
$builder->putVehicle($vehicle);

/* now pack in the license file, readme and setup options */

$builder->setPackageAttributes(array(
    'readme' => file_get_contents($sources['docs'] . 'readme.txt'),
    'license' => file_get_contents($sources['docs'] . 'license.txt')
));

$builder->pack();

$mtime= microtime();
$mtime= explode(" ", $mtime);
$mtime= $mtime[1] + $mtime[0];
$tend= $mtime;
$totalTime= ($tend - $tstart);
$totalTime= sprintf("%2.4f s", $totalTime);

$modx->log(modX::LOG_LEVEL_INFO,"\nPackage Built.\nExecution time: {$totalTime}\n");
exit();