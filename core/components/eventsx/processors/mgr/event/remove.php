<?php
if($modx->removeObject('evxEvent', array('id' => $_REQUEST['id']))) {
    return $modx->error->success('');
}
else {
	return $modx->error->failure($modx->lexicon('eventsx.event.error.nf'));
}