#!/bin/bash
#tail -n+1 ./urls.txt|xargs -n1 -P4 ./lynx -cfg=./lynx.cfg -lss=./samples/lynx.lss -connect_timeout=300 -read_timeout=300 -dump -unique_urls -nonumbers 2>/dev/null 1>/dev/null
rm d.txt.gz;
cat OUTPUT.TXT >> OLD_OUTPUT.TXT
gawk '{print tolower($0)}' OLD_OUTPUT.TXT > d0.txt;
gawk '{for (i=1;i<=NF;i++) gsub (/^ */,"",$i);print}' < d0.txt > d1.txt;
rm d0.txt;uniq -ic d1.txt | sort -nrs -T /tmp > d2.txt;
rm d1.txt;gawk '$2 ~ /^http/' < d2.txt > d3.txt;
rm d2.txt;sort -u -k2,2 -T/tmp < d3.txt > d4.txt
rm d3.txt;sort -nsrk1 -T/tmp < d4.txt > d5.txt;
#rm d4.txt;grep -ivE '\/\/\/|porn|enable javascript|dx\.doi.\org|wishesh\.com|oxforddictionaries\.com|feedburner.\com|slingshot.\org|signin|editthispage.\com|\/rss\/|\/rss|\/login|\/feed|\/user|\/users|logout|logoff|\/profile|ixsid\=|\/register|\/my\-admin|\/wp\-admin|wp\-login|\/subscribe|tag\=|comment\-form|destination\=node|\?feed|\.xml|\=rss|\.rss|\/feed\/|\/feeds\/|\/news\/|\/tagged\/|\/keyword\/|\/topics\/|\/topic\/|\/category\/|\/tag\/|\/tags\/|\/label\/' d5.txt > d6.txt
rm d4.txt;gzip -c -9 < d5.txt > d.txt.gz;
