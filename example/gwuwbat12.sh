#!/bin/sh
me=`basename "$0" | cut -d "." -f 1`
count=$(batctl -m bat12 gwl | grep -v Gateway | wc -l)
if [ $count -eq 1 ]; then
        echo "<status>green</status>" > /var/www/html/simone/$me.xml
else
        echo "<fail><msg>Fehlerhafte Gatewayanzahl bat12, soll: 1 ist: $count</msg><prio>2</prio><device>vm1fffgwcd1</device></fail>" > /var/www/html/simone/$me.xml
fi

