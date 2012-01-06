<?php
//get id of single event page
$eventPage = $modx->getOption('evxEventPage', null, 1);

//get id of events (overview) page
$eventsPage = $modx->getOption('evxEventsPage', null, 1);

//get regex escaped name/url of events (overview) page without /
$eventsPageRegex = preg_quote(trim($modx->makeUrl($eventsPage), '/'));

//calendar item template
$eventTpl = $modx->getOption('evxEventCalendarTpl', null, 'evxEventCalendarTpl');

//JSON URI
$jsonURI = $modx->getOption('evxJSON', null, 'eventsxJSON');

//output calendar JSON
if ($modx->event->name == 'OnPageNotFound' && preg_match('/'.$jsonURI.'\?.*$/', $_SERVER['REQUEST_URI']))
{
    $modx->getService('eventsx','EventsX',$modx->getOption('eventsx.core_path',null,$modx->getOption('core_path').'components/eventsx/').'model/eventsx/',$scriptProperties);

    $month = $modx->getOption('month', $_GET, date('m'));
    $year = $modx->getOption('year', $_GET, date('Y'));

    $startdate = $year.'-'.$month.'-01';
    $enddate = date('Y-m-t',mktime(0, 0, 0, $month, 1, $year));
    $daysInMonth = date('t',mktime(0, 0, 0, $month, 1, $year));

    $c = $modx->newQuery('evxEvent');
    $c->select('id, name, description, UNIX_TIMESTAMP(startdate) AS startTime, UNIX_TIMESTAMP(enddate) AS endTime, location, street, pc, city, country, website');
    $c->where(
        array(
            'active' => 1,
            "startdate <= '$enddate' AND  enddate >= '$startdate'"
        )
    );

    $eventDays = array();

    $events = $modx->getCollection('evxEvent', $c);
    foreach($events as $event)
    {
        $event = $event->toArray();
        $event['url'] = $modx->makeUrl($eventsPage).urlencode($event['name']).'/'.$event['id'];
        $event['html'] = $modx->getChunk($eventTpl, $event);
        for($i=1; $i <= $daysInMonth; $i++)
        {
            $dayTimestamp = mktime(0, 0, 0, $month, $i, $year);
            if($event['startTime'] <= $dayTimestamp && $event['endTime'] >= $dayTimestamp)
            {
                $eventDays[$i][] = $event;
            }
        }
    }

    echo $modx->toJSON($eventDays);
    exit;
}

//go to event page
elseif ($modx->event->name == 'OnPageNotFound' && preg_match('/'.$eventsPageRegex.'\/.*\/[0-9]+$/', $_SERVER['REQUEST_URI']))
{
    $modx->sendForward($eventPage);
}