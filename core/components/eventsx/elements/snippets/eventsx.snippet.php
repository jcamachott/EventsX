<?php
$modx->getService('eventsx','EventsX',$modx->getOption('eventsx.core_path',null,$modx->getOption('core_path').'components/eventsx/').'model/eventsx/',$scriptProperties);

//get id of events (overview) page
$eventsPage = $modx->getOption('evxEventsPage', null, 1);

//max number over events shown
$limit = $modx->getOption('limit', $scriptProperties, 5);

//event chunk
$tpl = $modx->getOption('tpl', $scriptProperties, 'evxEventTpl');

//default event classes
$eventClass = $modx->getOption('eventClass', $scriptProperties, 'event');
$oddClass = $modx->getOption('eventClass', $scriptProperties, 'odd');
$evenClass = $modx->getOption('eventClass', $scriptProperties, 'even');

$c = $modx->newQuery('evxEvent');
$c->andCondition(array('active' => 1, "enddate >= '".date('Y-m-d')."'"));
$c->limit($limit);
$c->sortby('startdate', 'ASC');
$events = $modx->getCollection('evxEvent', $c);

$output = '';
$i = 1;
foreach($events as $event)
{
    $event = $event->toArray();
    $event['idx'] = $i;
    $event['classes'] = $eventClass.' '.($i & 1 ? $oddClass : $evenClass);
    $event['url'] = $modx->makeUrl($eventsPage).urlencode($event['name']).'/'.$event['id'];
    $output .= $modx->getChunk($tpl, $event);
    $i++;
}
return $output;