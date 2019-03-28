#!/bin/sh
DIR='/home/alex/docker/betterVoice/fs_ilas'
IPTABELS=/sbin/iptables

cd /home/alex/docker/betterVoice/fs_ilas
. /home/alex/docker/betterVoice/fs_ilas/.env


case "$1" in
    start)
	/usr/bin/docker-compose up -d
	sudo $IPTABELS -A DOCKER -t nat -p udp -m udp ! -i $FS_NETWORK_NAME --dport $MAINFS_START_RTP:$MAINFS_STOP_RTP -j DNAT --to-destination $MAINFS_DOCKER_LOCALNET_IP:$MAINFS_START_RTP-$MAINFS_STOP_RTP
	sudo $IPTABELS -A DOCKER -p udp -m udp -d $MAINFS_DOCKER_LOCALNET_IP/32 ! -i $FS_NETWORK_NAME -o $FS_NETWORK_NAME --dport $MAINFS_START_RTP:$MAINFS_STOP_RTP -j ACCEPT
	sudo $IPTABELS -A POSTROUTING -t nat -p udp -m udp -s $MAINFS_DOCKER_LOCALNET_IP/32 -d $MAINFS_DOCKER_LOCALNET_IP/32 --dport $MAINFS_START_RTP:$MAINFS_STOP_RTP -j MASQUERADE
	echo "Start composer"
	echo "."
	;;

   stop)
	/usr/bin/docker-compose down
	sudo $IPTABELS -D DOCKER -t nat -p udp -m udp ! -i $FS_NETWORK_NAME --dport $MAINFS_START_RTP:$MAINFS_STOP_RTP -j DNAT --to-destination $MAINFS_DOCKER_LOCALNET_IP:$MAINFS_START_RTP-$MAINFS_STOP_RTP
	sudo $IPTABELS -D DOCKER -p udp -m udp -d $MAINFS_DOCKER_LOCALNET_IP/32 ! -i $FS_NETWORK_NAME -o $FS_NETWORK_NAME --dport $MAINFS_START_RTP:$MAINFS_STOP_RTP -j ACCEPT
	sudo $IPTABELS -D POSTROUTING -t nat -p udp -m udp -s $MAINFS_DOCKER_LOCALNET_IP/32 -d $MAINFS_DOCKER_LOCALNET_IP/32 --dport $MAINFS_START_RTP:$MAINFS_STOP_RTP -j MASQUERADE
	echo "Stop docker"
	echo "."
	;;

   restart)
	/usr/bin/docker-compose restart
	echo "restart docker compser"
	echo "."
	;;
   nstatus)
	/usr/bin/docker network ls
	echo "status network"
	echo "."
	;;

   dstatus)
	/usr/bin/docker ps -as
	echo "status network"
	echo "."
	;;
    *)
	echo "You must write argv: start|stop|restart|nstatus|dstatus"
	echo "."
          ;;
esac
