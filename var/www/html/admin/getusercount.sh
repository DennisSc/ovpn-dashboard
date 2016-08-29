#!/bin/bash
#
result="$( ls /etc/openvpn/ccd | wc -l  )"

echo $result
