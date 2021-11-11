#!/bin/bash

#https://technotile.ru/bitrix/backup/technotile.ru_20210927_181657_full_06c5c772.tar.gz

URL=$1
COUNTER=1

function f_download_backup(){

    if [ ! -d site_backup ]
    then
        mkdir site_backup
    fi

    if [[ `wget -S --spider "$URL"  2>&1 | grep 'HTTP/1.1 200 OK'` ]]
    then
        wget -P ./site_backup -c "$URL"
        #echo "good"
    fi

    while true
    do
        if [[ `wget -S --spider "$URL.$COUNTER"  2>&1 | grep 'HTTP/1.1 200 OK'` ]]
        then 
            echo "file exists"
            wget -P ./site_backup -c "$URL.$COUNTER"
            #echo "$URL.$COUNTER"
        else
            echo "file does not exist"
            break
        fi
        
        ((COUNTER=COUNTER+1))
    done
}

function f_unpack_backup(){
    
    echo "unpacking."

    if [ ! -d ./htdocs ]
    then
        mkdir ./htdocs
    fi
    
    cat *$(ls -v site_backup/*tar.*) | tar zxf - -C ./htdocs
}

f_download_backup
f_unpack_backup
