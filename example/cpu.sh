#!/bin/sh
me=`basename "$0" | cut -d "." -f 1`
count=$(cat /proc/loadavg | cut -d " " -f 2)
if [ $(echo "if ($count <= 2.00) 1 else 0" | bc) -eq 1  ]; then
        echo "<fail><msg>loadavg zu hoch Aktueller Wert: $count</msg><prio>3</prio><device>vm1fffgwcd1</device></fail>" > /var/www/html/simone/$me.xml
fi
if [ $(echo "if ($count <= 1.45) 1 else 0" | bc) -eq 1  ]; then
        echo "<fail><msg>loadavg zu hoch Aktueller Wert: $count</msg><prio>2</prio><device>vm1fffgwcd1</device></fail>" > /var/www/html/simone/$me.xml
fi
if [ $(echo "if ($count <= 1.00) 1 else 0" | bc) -eq 1  ]; then
        echo "<fail><msg>loadavg zu hoch Aktueller Wert: $count</msg><prio>1</prio><device>vm1fffgwcd1</device></fail>" > /var/www/html/simone/$me.xml
fi
if [ $(echo "if ($count <= 0.70) 1 else 0" | bc) -eq 1 ]; then
        echo "<status>green</status>" > /var/www/html/simone/$me.xml
fi
