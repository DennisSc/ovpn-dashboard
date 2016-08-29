#!/bin/bash
#

not_root() {
    echo "ERROR: You have to be root to execute this script"
    exit 1
}

: ${1?"Usage: $0 -c name -t type [-n network] -s server -o outdir"}



mask2cdr()
{
   # Assumes there's no "255." after a non-255 byte in the mask
   set -- 0^^^128^192^224^240^248^252^254^ ${#1} ${1##*255.}
   set -- $(( ($2 - ${#3})*2 )) ${1%%${3%%.*}*}
   echo $(( $1 + (${#2}/4) ))
}

cdr2mask()
{
   # Number of args to shift, 255..255, first non-255 byte, zeroes
   set -- $(( 5 - ($1 / 8) )) 255 255 255 255 $(( (255 << (8 - ($1 % 8))) & 255 )) 0 0 0
   [ $1 -gt 1 ] && shift $1 || shift
   echo ${1-0}.${2-0}.${3-0}.${4-0}
}


# Check if user is root
[ $EUID != 0 ] && not_root



# get working directory (where script and example configuration files are stored)
SCRIPTDIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"



while [[ $# -gt 1 ]]
do
key="$1"

case $key in
    -c|--clientname)
    CLIENTNAME="$2"
    shift # past argument
    ;;
    -t|--type)
    CLIENTTYPE="$2"
    shift # past argument
    ;;
    -n|--network)
    RAWSUBNET="$2"
    shift # past argument
    ;;
	-s|--server)
    SERVER="$2"
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




echo CLIENT NAME	 = "${CLIENTNAME}"
echo CLIENT TYPE     = "${CLIENTTYPE}"
echo NETWORK         = "${RAWSUBNET}"
echo SERVER URL      = "${SERVER}"

if [ $CLIENTTYPE = "s2s" ]; then

	arrSUBNET=(${RAWSUBNET//// })
	SUBNET=(${arrSUBNET[0]})
	NETMASK=$(cdr2mask ${arrSUBNET[1]})
	echo Calculated network address     = "${SUBNET}"
	echo Calculated network mask        = "${NETMASK}"


	cd /etc/openvpn/easy-rsa2/
	source ./vars
	./pkitool $CLIENTNAME  > /dev/null 2>&1

	OUTDIR=$OUTDIRTEMP/$CLIENTNAME
	echo OutDir 	=  "${OUTDIR}"
	
	mkdir  $OUTDIR
	#exit 1
	cp /etc/openvpn/easy-rsa2/keys/ca.crt $OUTDIR/
	cp /etc/openvpn/easy-rsa2/keys/$CLIENTNAME.crt $OUTDIR/
	cp /etc/openvpn/easy-rsa2/keys/$CLIENTNAME.key $OUTDIR/

	sed -i -e '$a\'  /etc/openvpn/server.conf
	sed -i -e '$a\#subnet for '"$CLIENTNAME"':'  /etc/openvpn/server.conf
	sed -i -e '$a\route '"$SUBNET"' '"$NETMASK"'' /etc/openvpn/server.conf

	cp $SCRIPTDIR/s2s_example.conf $OUTDIR/$CLIENTNAME.conf
	sed -i -e 's/servername.com/'"$SERVER"'/g' $OUTDIR/$CLIENTNAME.conf
	sed -i -e 's/clientname/'"$CLIENTNAME"'/g' $OUTDIR/$CLIENTNAME.conf

	zip  -j $OUTDIR/$CLIENTNAME.zip $OUTDIR/*
#	rm $OUTDIR/*.crt
#	rm $OUTDIR/*.key
#	rm $OUTDIR/*.conf

	echo "iroute $SUBNET $NETMASK" > /etc/openvpn/ccd/$CLIENTNAME


elif [[ $CLIENTTYPE = "rw1"  ||  $CLIENTTYPE = "rw2" ]]; then

	cd /etc/openvpn/easy-rsa2/
	source ./vars
	./pkitool $CLIENTNAME  > /dev/null 2>&1

	OUTDIR=$OUTDIRTEMP/$CLIENTNAME
	echo OutDir 	=  "${OUTDIR}"
	
	mkdir  $OUTDIR
	#exit 1
	cp /etc/openvpn/easy-rsa2/keys/ca.crt $OUTDIR/
	cp /etc/openvpn/easy-rsa2/keys/$CLIENTNAME.crt $OUTDIR/
	cp /etc/openvpn/easy-rsa2/keys/$CLIENTNAME.key $OUTDIR/

	if [ $CLIENTTYPE = "rw1" ]; then
		cp $SCRIPTDIR/roadwarrior1_example.ovpn $OUTDIR/$CLIENTNAME.ovpn
	else #if clienttype rw2
		cp $SCRIPTDIR/roadwarrior2_example.ovpn $OUTDIR/$CLIENTNAME.ovpn
	fi
	
	sed -i -e 's/servername.com/'"$SERVER"'/g' $OUTDIR/$CLIENTNAME.ovpn
	sed -i -e 's/clientname/'"$CLIENTNAME"'/g' $OUTDIR/$CLIENTNAME.ovpn
	
	chmod +r $OUTDIR/$CLIENTNAME.ovpn

	zip  -j $OUTDIR/$CLIENTNAME.zip $OUTDIR/*
#	rm $OUTDIR/*.crt
#	rm $OUTDIR/*.key
#	rm $OUTDIR/*.ovpn


	
	echo "" > /etc/openvpn/ccd/$CLIENTNAME


fi

echo "DSC ovpn clientWiz done"


