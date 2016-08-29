#!/bin/bash
#

not_root() {
    echo "ERROR: You have to be root to execute this script"
    exit 1
}

: ${1?"Usage: $0 -c name -p PEMfile"}






# Check if user is root
[ $EUID != 0 ] && not_root


while [[ $# -gt 1 ]]
do
key="$1"

case $key in
    -c|--clientname)
    CLIENTNAME="$2"
    shift # past argument
    ;;
	-p|--PEM)
    PEMFILE="$2"
    shift # past argument
    ;;
	
    --default)
    DEFAULT=YES
    ;;
    *)
            # unknown option
    ;;
esac
shift # past argument or value
done

cd /etc/openvpn/easy-rsa2
cp keys/$PEMFILE.pem /etc/openvpn/easy-rsa2/keys/$CLIENTNAME.crt
source ./vars >/dev/null
./revoke-full $CLIENTNAME >/dev/null 2>&1
echo "done"
