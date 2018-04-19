#!/bin/bash
wget --recursive --level=0 --no-parent --no-verbose --spider http://irc.nimda.pro/ --append-output=sitemap
/var/www/html/irc.nimda.pro/script4sitemap/irc.sh sitemap &
sleep 10
rm -rf sitemap
