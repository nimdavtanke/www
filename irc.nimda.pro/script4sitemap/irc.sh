#!/bin/bash

cat $1 | grep URL >> temp.txt
######################################################################################
cat temp.txt | while read line
do
echo $line | sed 's#\ \[#<\/loc><\/url>\ \[#g' >> temp1.txt
done
######################################################################################
sleep 1
cat temp1.txt | awk '{print $3}' >> temp2.txt
######################################################################################
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>" > /var/www/html/irc.nimda.pro/$1.xml
echo "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">" >> /var/www/html/irc.nimda.pro/$1.xml
######################################################################################
sleep 1
cat temp2.txt | while read line
do
echo $line | sed 's#URL:http#<url><loc>http#g' >> /var/www/html/irc.nimda.pro/$1.xml
done
######################################################################################
echo "</urlset>" >> /var/www/html/irc.nimda.pro/$1.xml
######################################################################################
rm temp.txt temp1.txt temp2.txt
######################################################################################
echo $filename