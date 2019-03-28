#!/bin/sh
CONTAINER_IP=`/bin/hostname -i`
FS_DIR='/usr/local/freeswitch/conf'

#apt-get install -y net-tools sngrep tcpdump mc inetutils-ping &&
rm  -Rf $FS_DIR/ &&
cp -Rf /copy_files/freeswitch  $FS_DIR &&        
mkdir -p $FS_DIR/include  &&
mkdir -p /root/.config/mc &&

# echo "ENTRY '$FS_DIR' URL '$FS_DIR'" > /root/.config/mc/hotlist
# echo "alias fs='/usr/local/freeswitch/bin/fs_cli'" > /root/.bashrc

echo '<X-PRE-PROCESS cmd="include" data="main/freeswitch.xml"/>' > $FS_DIR/freeswitch.xml

echo "
<X-PRE-PROCESS cmd=\"set\" data=\"external_rtp_ip=$MAINFS_HOST_EXTNET_IP\"/>
<X-PRE-PROCESS cmd=\"set\" data=\"external_sip_ip=$MAINFS_HOST_EXTNET_IP\"/>
<X-PRE-PROCESS cmd=\"set\" data=\"external_sip_port=$MAINFS_DOCKER_EXTNET_SIP_PORT\"/>
<X-PRE-PROCESS cmd=\"set\" data=\"external-user-agent-string=$UA4\"/>
<X-PRE-PROCESS cmd=\"set\" data=\"localnet_rtp_ip=$MAINFS_DOCKER_LOCALNET_IP\"/>
<X-PRE-PROCESS cmd=\"set\" data=\"localnet_sip_ip=$MAINFS_DOCKER_LOCALNET_IP\"/>
<X-PRE-PROCESS cmd=\"set\" data=\"localnet_sip_port=$MAINFS_DOCKER_LOCALNET_SIP_PORT\"/>
<X-PRE-PROCESS cmd=\"set\" data=\"localnet-user-agent-string=$UA\"/>
" > $FS_DIR/include/vars.xml

echo "<param name="rtp-start-port" value=\"$MAINFS_START_RTP\"/>
<param name="rtp-end-port" value=\"$MAINFS_STOP_RTP\"/>
" > $FS_DIR/include/switch.conf.xml


echo "
[$MYSQL_DATABASE]
Driver=MySQL
SERVER=$IP_MYSQL
PORT=3306
DATABASE=$MYSQL_DATABASE
USER=$MYSQL_USER
PASSWORD=$MYSQL_PASSWORD
" > /etc/odbc.ini

sed -i "s/\"odbc:\/\/freeswitch\"/\"odbc:\/\/$MYSQL_DATABASE\"/" /usr/local/freeswitch/conf/main/autoload_configs/odbc_cdr.xml

service snmpd start &&
service freeswitch start &&
tail -f /usr/local/freeswitch/log/freeswitch.log

