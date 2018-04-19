#!/bin/bash

while IFS= read -r -d '' FNAME; do
sed -i 's|http:\/\/dic|https:\/\/dic|g' $FNAME
done < <(find /var/www/html/dic.nimda.pro/sitemaps/ -type f -print0)
