#!/bin/bash
mawk '{print tolower($0)}' OUTPUT.TXT > d0.txt
mawk '{for (i=1;i<=NF;i++) gsub (/^ */,"",$i);print}' < d0.txt > d1.txt;
rm d0.txt;uniq -ic d1.txt | sort -nrs -T /tmp > d2.txt;
rm d1.txt;cat ~/Downloads/OUT.txt.4 d2.txt  > d3.txt;
rm d2.txt;awk '$2 ~ /^http/' d3.txt > d4.txt
rm d3.txt;gawk -f 2.awk d4.txt > d5.txt
rm d4.txt;gawk -f 1.awk d5.txt > d6.txt
rm d5.txt;sort -urs -k2 -k1 -T/tmp d6.txt > d7.txt
rm d6.txt;sort -nsrk1 -T/tmp d7.txt > d8.txt;
rm d7.txt;grep -ivE '\/\/\/|porn|enable javascript|dx\.doi.\org|wishesh\.com|oxforddictionaries\.com|feedburner.\com|slingshot.\org|signin|editthispage.\com|\/rss\/|\/rss|\/login|\/feed|\/user|\/users|logout|logoff|\/profile|ixsid\=|\/register|\/my\-admin|\/wp\-admin|wp\-login|\/subscribe|tag\=|comment\-form|destination\=node|\?feed|\.xml|\=rss|\.rss|\/feed\/|\/feeds\/|\/news\/|\/tagged\/|\/keyword\/|\/topics\/|\/topic\/|\/category\/|\/tag\/|\/tags\/|\/label\/' d8.txt > d9.txt
rm d8.txt;gzip -c -9 d9.txt > d5.txt.gz