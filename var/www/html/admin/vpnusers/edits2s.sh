#!/bin/bash
#

not_root() {
    echo "ERROR: You have to be root to execute this script"
    exit 1
}

: ${1?"Usage: $0 -c name -s subnet -n netmask -o folder"}






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
	-n|--netmask)
    NETMASK="$2"
    shift # past argument
    ;;
	-s|--subnet)
    SUBNET="$2"
    shift # past argument
    ;;
	-o|--outdir)
    OUTDIR="$2"
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



oldiroute=$(cat /etc/openvpn/ccd/$CLIENTNAME)
oldroute=$(cat /etc/openvpn/ccd/$CLIENTNAME | sed -r 's/^.{7}//')
regex=$(echo "route "$oldroute)
#echo $oldroute
#echo $oldiroute
#echo $regex
#exit 1


sed  -i '/'"$oldiroute"'/c\iroute '"$SUBNET $NETMASK"'' /etc/openvpn/ccd/$CLIENTNAME
sed  -i '/'"$regex"'/c\route '"$SUBNET $NETMASK"'' /etc/openvpn/server.conf


echo "edit done"

