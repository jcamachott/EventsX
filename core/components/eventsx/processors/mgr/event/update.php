<?php
$event = $modx->getObject('evxEvent', array('id' => $scriptProperties['id']));
if(!is_object($event)) {
    $event = $modx->newObject('evxEvent');
}
$event->fromArray($scriptProperties);

if ($event->save()) {
	return $modx->error->success('', $event);
}
else {
	return $modx->error->failure('');
}