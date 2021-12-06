#!/bin/bash

source ./operations.sh

##  http://manao-team.com/bitrix/backup/manao-team.com_20211101_175838_full_99e1ae5e.tar.gz

# c create log dirs
# d delete
# n all

while getopts "cdn:u" OPT
do

    case "$OPT" in
    "n")
        f_download_backup "$OPTARG"
        f_create_dirs
        f_unpack_backup
    ;;
    "c")
        f_create_log_dirs
    ;;
    "d")
        f_recreate_log_dirs
    ;;
    "u")
        f_unpack_backup
    ;;
    "*")
    ;;
    esac
done