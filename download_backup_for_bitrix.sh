#!/bin/bash

URL=$1
COUNTER=1

function f_download_backup(){

    if [ ! -d site_backup ]
    then
        mkdir site_backup
    fi

    if [[ `wget -S --spider "$URL"  2>&1 | grep 'HTTP/1.1 200 OK'` ]]
    then
        wget -cP ./site_backup -c "$URL"
    fi

    while true
    do
        if [[ `wget -S --spider "$URL.$COUNTER"  2>&1 | grep 'HTTP/1.1 200 OK'` ]]
        then 
            echo "    file exists"
            wget -P ./site_backup -c "$URL.$COUNTER"
        else
            echo "    all files have already been downloaded."
            break
        fi
        
        ((COUNTER=COUNTER+1))
    done
}

function f_unpack_backup(){
    
    echo "    unpacking."

    if [ ! -d ./htdocs ]
    then
        mkdir ./htdocs
    fi
    
    cat *$(ls -v site_backup/*tar.*) | tar zxf - -C ./htdocs
}

function f_create_dirs(){
    mkdir -p system/php
    mkdir -p system/nginx
    mkdir -p system/mysql
}

if [ -n "$1" ]
then
    f_download_backup
    f_create_dirs

    if [ ! -d "./htdocs" ]
    then
        f_unpack_backup
    else
        echo "    directory './htdocs' is exists. unpacking have been skipped."
    fi
else
    f_create_dirs
fi

