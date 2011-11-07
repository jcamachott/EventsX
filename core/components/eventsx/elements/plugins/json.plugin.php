<?php
if ($modx->event->name == 'OnPageNotFound' && strpos($_SERVER['REQUEST_URI'], 'eventsxJSON')) {

    $modx->getService('eventsx','EventsX',$modx->getOption('eventsx.core_path',null,$modx->getOption('core_path').'components/eventsx/').'model/eventsx/',$scriptProperties);

    $month = $modx->getOption('month', $_GET, date('m'));
    $year = $modx->getOption('year', $_GET, date('Y'));

    $startdate = $year.'-'.$month.'-01';
    $enddate = date('Y-m-t',mktime(0, 0, 0, $month, 1, $year));
    $daysInMonth = date('t',mktime(0, 0, 0, $month, 1, $year));

    $c = $modx->newQuery('evxEvent');
    $c->select('id, name, UNIX_TIMESTAMP(startdate) AS startTime, UNIX_TIMESTAMP(enddate) AS endTime');
    $c->where(array(
                 "startdate <= '$enddate' AND  enddate >= '$startdate'"
              )
    );
    
    $list = array();
    $events = $modx->getCollection('evxEvent', $c);
    foreach($events as $event) {
        $event = $event->toArray();
        $days = array();
        for($i=1; $i <= $daysInMonth; $i++) {
            $dayTimestamp = mktime(0, 0, 0, $month, $i, $year);
            if($event['startTime'] <= $dayTimestamp && $event['endTime'] >= $dayTimestamp) {
                $days[] = $i;
            }
        }
        $event['days'] = $days; //days of this month the event should be listed

        $list[] = $event;
    }

    echo $modx->toJSON($list);
    exit;
}