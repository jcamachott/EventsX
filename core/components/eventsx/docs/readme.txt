#############################################################
#             EventsX: events list/calendar                 #
#                                                           #
# Version: 0.1.0 beta                                       #
# Released: 2012-01-06                                      #
#                                                           #
# Author: Jeroen Kenters Web Development / www.kenters.com  #
#                                                           #
# License: GNU GENERAL PUBLIC LICENSE, Version 2            #
#############################################################

==========================================
 Description
==========================================
EventsX shows upcoming (and previous) events on a (jQuery)
calendar and/or upcoming events list.

==========================================
 Features
==========================================
* events management (create/update/remove/(de)activate)
* every event has a start and end date
  (can be the same date for single day events)
* jQuery calendar included
* Languages:
  - english
  - dutch
  - german (thanks to Anselm Hannemann)
  - russian

==========================================
 Upcoming versions (TODO)
==========================================
* Events registration (allow visitors to buy tickets) (?)
* Probably some bug fixing :-)

==========================================
 Requirements
==========================================
* MODX Revolution (tested with 2.1.3+)
* jQuery for the calendar
  (you can also create your own JSON based calendar)

==========================================
 Installation
==========================================
* Install through Package Management

==========================================
 Usage
==========================================
* Go to components -> EventsX and create some events
  (make sure they are active)
* Add jQuery to your website template if necessary
  (only needed on pages where calendar will be used)
* Copy & add /assets/components/calendar.js to your website
  template (only needed on pages where calendar will be used)
* Copy & add /assets/components/jquery.calendar-widget.js to
  your website template (only needed on pages where calendar
  will be used)
* Create a resource for the events calendar (or add it to
  your template(s))
* Create a resource for the upcoming events list
  (see template example below)
* Create a resource below that for a single event
  (see template example below)
* Create a Context setting 'evxEventsPage' and set the
  'upcoming events page' id as value
* Create a Context setting 'evxEventPage' and set the
  'single event page' id as value
* Don't forget to save your context and
  clear the cache (context settings are cached)

==========================================
 Example events calendar template
==========================================
<html>
<head>
<title>[[++site_name]] - [[*pagetitle]]</title>
<base href="[[++site_url]]" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="assets/components/eventsx/js/web/jquery.calendar-widget.js"></script>
<script type="text/javascript" src="assets/components/eventsx/js/web/calendar.js"></script>
<link rel="stylesheet" type="text/css" href="assets/components/eventsx/css/calendar.css" />
</head>
<body>
  <a href="" id="prevMonth">previous month</a> <a href="" id="nextMonth">next month</a>
  <div id="calendar"></div>
  [[*content]]
</body>
</html>

==========================================
 Example upcoming events list template
==========================================
<html>
<head>
<title>[[++site_name]] - [[*pagetitle]]</title>
<base href="[[++site_url]]" />
</head>
<body>
    [[!EventsX? &tpl=`evxEventTpl` &limit=`10`]]
    [[*content]]
</body>
</html>

==========================================
 Example single event template
==========================================
[[!evxEvent?]]<html>
<head>
<title>[[++site_name]] - [[*pagetitle]]</title>
<base href="[[++site_url]]" />
</head>
<body>
    <p>Name: [[+event.name]]</p>
    <p>Start date: [[+event.startdate:strtotime:date=`%d-%m-%Y`]]</p>
    <p>End date: [[+event.enddate:strtotime:date=`%d-%m-%Y`]]</p>
    [[+description]]<!-- Description is a TinyMCE field by default, so no <p> here -->
    <h2>Location</h2>
    <p>[[+event.location]]<br /> [[+event.street]]<br /> [[+event.pc]]<br /> [[+event.city]]<br /> [[+event.region]]<br /> [[+event.country]]</p>
    <p><a href="[[+event.website]]">Visit website</a></p>
</body>
</html>