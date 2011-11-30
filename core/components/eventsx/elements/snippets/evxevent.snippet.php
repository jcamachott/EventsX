<?php
$modx->getService('eventsx','EventsX',$modx->getOption('eventsx.core_path',null,$modx->getOption('core_path').'components/eventsx/').'model/eventsx/',$scriptProperties);

//get id of events (overview) page
$eventsPage = $modx->getOption('evxEventsPage', $scriptProperties, 1);

//get regex escaped name/url of events (overview) page without /
//events are below overiew page. e.a. /events/event-name/10
$eventsPageRegex = preg_quote(trim($modx->makeUrl($eventsPage), '/'));

//single event
if(preg_match('/'.$eventsPageRegex.'\/.*\/[0-9]+$/', $_SERVER['REQUEST_URI']))
{
    $event = explode('/', $_SERVER['REQUEST_URI']);
    $event = end($event);
    $event = $modx->getObject('evxEvent', array('id' => $event, 'active' => 1));
    if(is_object($event)) {
        $modx->setPlaceholders($event->toArray(), 'event.');
        return '';
    }
}

$modx->sendRedirect($modx->makeUrl($eventsPage));