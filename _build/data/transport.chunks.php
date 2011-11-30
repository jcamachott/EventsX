<?php
$chunks = array();

$chunks[0] = $modx->newObject('modChunk');
$chunks[0]->set('id', 0);
$chunks[0]->set('name', 'evxEventCalendarTpl');
$chunks[0]->set('description', 'Event html for calendar');
$chunks[0]->set('snippet', file_get_contents($sources['source_core'].'/elements/chunks/evxEventCalendarTpl.chunk.tpl'));

$chunks[1] = $modx->newObject('modChunk');
$chunks[1]->set('id', 0);
$chunks[1]->set('name', 'evxEventTpl');
$chunks[1]->set('description', 'Event html for upcoming events list');
$chunks[1]->set('snippet', file_get_contents($sources['source_core'].'/elements/chunks/evxEventTpl.chunk.tpl'));