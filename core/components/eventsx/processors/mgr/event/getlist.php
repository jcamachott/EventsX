<?php
/**
 * Get a list of EventsX
 *
 * @package eventsx
 * @subpackage processors
 */
/* setup default properties */
$isLimit = !empty($scriptProperties['limit']);
$start = $modx->getOption('start',$scriptProperties,0);
$limit = $modx->getOption('limit',$scriptProperties,20);
$sort = $modx->getOption('sort',$scriptProperties,'id');
$dir = $modx->getOption('dir',$scriptProperties,'ASC');
$query = $modx->getOption('query',$scriptProperties,'');

/* build query */
$c = $modx->newQuery('evxEvent');

if (!empty($query)) {
    $c->where(array(
        'name:LIKE' => '%'.$query.'%'
    ));
}

$count = $modx->getCount('evxEvent',$c);
$c->sortby($sort,$dir);
if ($isLimit) $c->limit($limit,$start);
$events = $modx->getIterator('evxEvent', $c);

/* iterate */
$list = array();
foreach ($events as $event) {
    $list[]= $event->toArray();
}
return $this->outputArray($list,$count);