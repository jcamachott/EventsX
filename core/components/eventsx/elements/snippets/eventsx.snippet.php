<?php
$modx->getService('eventsx','EventsX',$modx->getOption('eventsx.core_path',null,$modx->getOption('core_path').'components/eventsx/').'model/eventsx/',$scriptProperties);

//get id of events (overview) page
$eventsPage = $modx->getOption('evxEventsPage', null, 1);

//max number over events shown
$limit = $modx->getOption('limit', $scriptProperties, 5);

//event chunk
$tpl = $modx->getOption('tpl', $scriptProperties, 'evxEventTpl');

$c = $modx->newQuery('evxEvent');
$c->andCondition(array('active' => 1, 'startdate >= NOW()'));
$c->limit($limit);
$c->sortby('startdate', 'ASC');
$events = $modx->getCollection('evxEvent', $c);

$output = '';
foreach($events as $event)
{
   $event = $event->toArray();
   $event['url'] = $modx->makeUrl($eventsPage).urlencode($event['name']).'/'.$event['id'];
   $output .= $modx->getChunk($tpl, $event);
}
return $output;