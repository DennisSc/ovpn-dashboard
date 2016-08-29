#!/bin/bash
#

not_root() {
    echo "ERROR: You have to be root to execute this script"
    exit 1
}

: ${1?"Usage: $0 -pr protocol -po port -s subnet -m netmask -c cipher -i intraclientenable -l lzoenable"}





# Check if user is root
[ $EUID != 0 ] && not_root


while [[ $# -gt 1 ]]
do
key="$1"

case $key in
    -pr)
    PROTOCOL="$2"
    shift # past argument
    ;;
	-po)
    PORT="$2"
    shift # past argument
    ;;
	-s)
    SUBNET="$2"
    shift # past argument
    ;;
	-m)
    NETMASK="$2"
    shift # past argument
    ;;
	-c)
    CIPHER="$2"
    shift # past argument
    ;;
	-i)
    INTERCLIENT="$2"
    shift # past argument
    ;;
	-l)
    LZO="$2"
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



#change protocol entry
if [[ -n $PROTOCOL ]] 
then
	OLDPROTOCOL=$(cat /etc/openvpn/server.conf | grep proto)
	sed -i -e 's/'"$OLDPROTOCOL"'/'"proto $PROTOCOL"'/g' /etc/openvpn/server.conf 
fi

#change port entry
if [[ -n $PORT ]] 
then

	#change protocol entry
	OLDPORT=$(cat /etc/openvpn/server.conf | grep port)
	sed -i -e 's/'"$OLDPORT"'/'"port $PORT"'/g' /etc/openvpn/server.conf 
fi


#change transit net entry
if [[ -n $SUBNET ]] 
then

	if [[ -n $NETMASK ]] 
	then
		echo "server $SUBNET $NETMASK"
		#echo "$NEWNET"
		#exit 1		
		#change protocol entry
		OLDNET=$(cat /etc/openvpn/server.conf | grep "server ")
		sed -i -e 's/'"$OLDNET"'/'"server $SUBNET $NETMASK"'/g' /etc/openvpn/server.conf 
	fi
fi


#change cipher entry
if [[ -n $CIPHER ]] 
then
	#change protocol entry
	OLDCIPHER=$(cat /etc/openvpn/server.conf | grep cipher)
	sed -i -e 's/'"$OLDCIPHER"'/'"cipher $CIPHER"'/g' /etc/openvpn/server.conf 
fi


#change intraClientComm entry
if [[ -n $INTERCLIENT ]] 
then
	#change protocol entry
	OLDINTER=$(cat /etc/openvpn/server.conf | grep client-to-client)

	if [ $INTERCLIENT -eq "1" ];	then
		sed -i -e 's/'"$OLDINTER"'/'"client-to-client"'/g' /etc/openvpn/server.conf 
	else
		sed -i -e 's/'"$OLDINTER"'/'";client-to-client"'/g' /etc/openvpn/server.conf 
	
	fi
fi


#change lzo entry
if [[ -n $LZO ]] 
then
	#change protocol entry
	OLDLZO=$(cat /etc/openvpn/server.conf | grep lzo)

	if [ $LZO -eq "1" ];	then
		sed -i -e 's/'"$OLDLZO"'/'"comp-lzo"'/g' /etc/openvpn/server.conf 
	else
		sed -i -e 's/'"$OLDLZO"'/'";comp-lzo"'/g' /etc/openvpn/server.conf 
	
	fi
fi



echo "Port $PORT"
echo "Proto $PROTOCOL"
echo "Transit Net $SUBNET"
echo "Transit Net Mask: $NETMASK"
echo "Cipher: $CIPHER"
echo "Inter-client-comm: $INTERCLIENT"
echo "LZO Compression: $LZO"
