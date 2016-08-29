#!/bin/sh
#data=$(tail -n 1000 /etc/openvpn/openvpn.log)
awk '{print NR ":" $0}' /etc/openvpn/openvpn.log | sort -t: -k 1nr,1 | sed 's/^[0-9][0-9]*://' | head  -1000
#tail -n 7 /etc/openvpn/openvpn.log | awk '{print NR ":" $0}' | sort -t: -k 1nr,1 | sed 's/^[0-9][0-9]*://'
