#!/bin/sh
me=`basename "$0" | cut -d "." -f 1`
count=$(ip r s tab fff | wc -l)
if [ $count -gt 100 ]; then
	echo "<status>green</status>" > /var/www/html/simone/$me.xml
else
	echo "<fail><msg>Weniger als 100 Routen in Tabelle fff Aktueller Wert: $count</msg><prio>3</prio><device>vm1fffgwcd1</device></fail>" > /var/www/html/simone/$me.xml
fi
