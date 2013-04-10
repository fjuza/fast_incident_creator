Fast Incident Creator 0.3
==========================

Fully functional version.

Changelog 2013.04.10
----------------------------

* No selection of technician key. This is instead set as a constant in variables.php
* Can open new incidents.
* Can close incidents directly.

Known Issues 2013.04.10
--------------------------------

* Still not possible to add new incident-types through the interface.
* No proper feedback to users.
* No valdidation of names submitted. need to check and see if requester exists.

To do 2013.04.10
----------------------

* Need to fix ajax for feedback
* Possibility to make changes to the incident before submitting it.
* Adding checks to prevent multiple incidents from being created if accidentally clicking more than once on the submit button.
* Fix a rolldown list of possible technicians.
* Give the requester textbox ajax feedback and let it remember names.

Fast Incident Creator 0.2a
==========================

Still some major issues to fix before the software is usable. See changelog for what is new since last.

Changelog 2013.04.09
---------------------------------

* Update to README.md
* Fixed some small issues with PHP code.  
* Added more debug output in requesthandler.php.

Known issues 2013.04.09
---------------------------

* Still some kinks when POSTing requests to ServiceDesk Plus. (fixed)
* Some issues in handling the XML respons from ServiceDesk Plus.  (fixed)


Changelog 2013.04.01
--------------------------

* Added look and feel
* Tool to add new request types.
* Added debug output. Just set $DEBUG to true.


Known issues 2013.04.01
---------------------------

* Still some kinks when POSTing requests to ServiceDesk Plus. (fixed)



Fast Incident Creator 0.1a
==========================

A simple site to create and close incidents in ManageEngine ServiceDesk Plus REST API.

At the moment nothing works.

