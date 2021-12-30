#!/bin/bash

source ./operations.sh

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
