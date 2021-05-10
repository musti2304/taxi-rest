# Eine simple REST-API-Schnittstelle (unfinished, in progress)
## Idee
* Die Daten werden von drei verschiedenen URLs abgerufen. Die URLs stellen die Daten als einfache HTML-Tabellen zur Verfügung. Diese werden dann zusammengeführt und in einer JSON-Datenstruktur zur Verfügung gestellt. Die Datenstruktur enthält:
** Daten zur Anzahl der Aufträge an allen Bonner Taxi-Halteplätzen
** Daten zur Anzahl der Einstiege an allen Bonner Taxi-Halteplätzen
** Daten zu Wartezeiten an allen Bonner Taxi-Halteplätzen

## Die Schnittstelle wurde mit dem Symfony Framework erstellt
* Die Daten können von beliebigen Clients (hier insbesondere Apps) abgerufen werden.
* Clients sind die beiden Projekte [taxi-android](https://github.com/musti2304/taxi-android) und [taxi-ios](https://github.com/musti2304/taxi-ios)
