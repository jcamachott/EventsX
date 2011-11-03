<?php
/**
 * Loads the header for mgr pages.
 *
 * @package eventsx
 * @subpackage controllers
 */
$modx->regClientStartupScript($eventsx->config['jsUrl'].'utils/xdatefield.js');
$modx->regClientStartupScript($eventsx->config['jsUrl'].'mgr/eventsx.js');
$modx->regClientStartupHTMLBlock('<script type="text/javascript">
Ext.onReady(function() {
    EventsX.config = '.$modx->toJSON($eventsx->config).';
});
</script>');

return '';