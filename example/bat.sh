#!/bin/sh
count=$(ip link show | grep bat | grep -v fff | wc -l)
if [ $count -eq 4 ]; then
        echo "<status>green</status>" > /var/www/html/simone/bat.xml
else
        echo "<fail><msg>Fehlerhafte bat Interfaceanzahl, soll: 4 ist: $count</msg><prio>3</prio><device>vm1fffgwcd1</device></fail>" > /var/www/html/simone/bat.xml
fi

