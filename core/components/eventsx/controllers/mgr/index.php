<?php
/**
 * Loads the home page.
 *
 * @package eventsx
 * @subpackage controllers
 */

$modx->regClientStartupScript($eventsx->config['jsUrl'].'mgr/widgets/events.grid.js');
$modx->regClientStartupScript($eventsx->config['jsUrl'].'mgr/widgets/home.panel.js');
$modx->regClientStartupScript($eventsx->config['jsUrl'].'mgr/sections/index.js');

$output = '<div id="eventsx-panel-home-div"></div>';

return $output;