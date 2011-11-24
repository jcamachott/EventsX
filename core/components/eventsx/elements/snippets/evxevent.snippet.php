<?php
$modx->getService('eventsx','EventsX',$modx->getOption('eventsx.core_path',null,$modx->getOption('core_path').'components/eventsx/').'model/eventsx/',$scriptProperties);
$event = explode('/', $_SERVER['REQUEST_URI']);
$event = end($event);
$event = $modx->getObject('evxEvent', array('id' => $event, 'active' => 1));
if(is_object($event)) {
    $modx->setPlaceholders($event->toArray(), 'event.');
}
else{
    $modx->sendRedirect($modx->makeUrl($modx->getOption('site_start')));
}