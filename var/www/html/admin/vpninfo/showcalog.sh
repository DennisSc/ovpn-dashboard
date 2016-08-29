#!/bin/sh


not_root() {
    echo "ERROR: You have to be root to execute this script"
    exit 1
}


# Check if user is root
[ $EUID != 0 ] && not_root


awk '{print NR ":" $0}' /etc/openvpn/easy-rsa2/keys/index.txt | sort -t: -k 1nr,1 | sed 's/^[0-9][0-9]*://'
