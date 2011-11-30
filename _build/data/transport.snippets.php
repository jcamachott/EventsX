<?php
$snippets = array();

$snippets[0] = $modx->newObject('modSnippet');
$snippets[0]->set('id', 0);
$snippets[0]->set('name', 'EventsX');
$snippets[0]->set('description', 'Upcoming events list');
$snippets[0]->set('snippet', file_get_contents($sources['source_core'].'/elements/snippets/eventsx.snippet.php'));

$snippets[1] = $modx->newObject('modSnippet');
$snippets[2]->set('id', 0);
$snippets[3]->set('name', 'evxEvent');
$snippets[4]->set('description', 'Get event data (for event page)');
$snippets[5]->set('snippet', file_get_contents($sources['source_core'].'/elements/snippets/evxevent.snippet.php'));