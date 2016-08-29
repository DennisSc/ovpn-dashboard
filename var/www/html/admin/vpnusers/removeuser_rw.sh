#!/bin/bash
#

not_root() {
    echo "ERROR: You have to be root to execute this script"
    exit 1
}

: ${1?"Usage: $0 -c name -o outdir"}






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
	-o|--outdir)
    OUTDIRTEMP="$2"
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

OUTDIR=$OUTDIRTEMP/$CLIENTNAME
#echo OutDir 	=  "${OUTDIR}"
#echo ClientName	=  "${CLIENTNAME}"
#exit 1
cd /etc/openvpn/easy-rsa2/
source ./vars  >/dev/null
/etc/openvpn/easy-rsa2/revoke-full $CLIENTNAME >/dev/null  2>&1



rm -rf  $OUTDIR
#exit 1


rm -rf /etc/openvpn/ccd/$CLIENTNAME
#rm keys/$CLIENTNAME.*



echo "DSC ovpn RemclientWizRW done"

