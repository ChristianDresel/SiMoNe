#!/bin/sh

for i in `ls /var/www/html/simone/scripte/*.sh`
do
 sh $i;
done
