#!/bin/sh
me=`basename "$0" | cut -d "." -f 1`
count=$(dig google.de @10.83.252.11 | grep NOERROR | wc -l)
if [ $count -eq 1 ]; then
	echo "<status>green</status>" > /var/www/html/simone/$me.xml
else
	echo "<fail><msg>DNS Server nicht erreichbar!</msg><prio>3</prio><device>vm1fffgwcd1</device></fail>" > /var/www/html/simone/$me.xml
fi
