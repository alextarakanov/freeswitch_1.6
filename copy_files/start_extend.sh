#!/bin/bash

CONTAINER_IP=`/bin/hostname -i`
FS_DIR='/usr/local/freeswitch/conf'

#apt-get install -y net-tools sngrep tcpdump mc inetutils-ping &&
rm  -Rf $FS_DIR/ &&
cp -Rf /copy_files/freeswitch  $FS_DIR &&        
mkdir -p $FS_DIR/include  &&
mkdir -p /root/.config/mc &&

# echo "ENTRY '$FS_DIR' URL '$FS_DIR'" > /root/.config/mc/hotlist
# echo "alias fs='/usr/local/freeswitch/bin/fs_cli'" > /root/.bashrc

echo '<X-PRE-PROCESS cmd="include" data="extend/freeswitch.xml"/>' > $FS_DIR/freeswitch.xml

echo "
<X-PRE-PROCESS cmd=\"set\" data=\"external_rtp_ip_ext=$FS_EXTNET_IP\"/>
<X-PRE-PROCESS cmd=\"set\" data=\"external_sip_ip_ext=$FS_EXTNET_IP\"/>

<X-PRE-PROCESS cmd=\"set\" data=\"external_rtp_ip=$IP_LOCAL_IPIP\"/>
<X-PRE-PROCESS cmd=\"set\" data=\"external_sip_ip=$IP_LOCAL_IPIP\"/>

<X-PRE-PROCESS cmd=\"set\" data=\"external_sip_port=$FS_EXTNET_SIP_PORT\"/>
<X-PRE-PROCESS cmd=\"set\" data=\"external-user-agent-string=$UA7\"/>


<X-PRE-PROCESS cmd=\"set\" data=\"localnet_rtp_ip=$FS_IP\"/>
<X-PRE-PROCESS cmd=\"set\" data=\"localnet_sip_ip=$FS_IP\"/>


<X-PRE-PROCESS cmd=\"set\" data=\"localnet_sip_port=$FS_LOCALNET_SIP_PORT\"/>
<X-PRE-PROCESS cmd=\"set\" data=\"localnet-user-agent-string=$FS_UA\"/>


<X-PRE-PROCESS cmd=\"set\" data=\"log-auth-failures=true\"/>

" > $FS_DIR/include/vars.xml

echo "<param name="rtp-start-port" value=\"$MAINFS_START_RTP\"/>
<param name="rtp-end-port" value=\"$MAINFS_STOP_RTP\"/>
" > $FS_DIR/include/switch.conf.xml


echo "
<gateway name='$FS_SIP_LOGIN'>
    <param name='username' value='+$FS_SIP_NUMBER'/>
    <param name='auth-username' value='+$FS_SIP_NUMBER@ims.unite.md'/>
    <param name='password' value='$FS_SIP_PASSWD'/>
    <param name='user-agent-string' value='$FS_UA'/>
    <param name='proxy' value='212.0.211.152'/>
    <param name='from-domain' value='ims.unite.md'/>
    <param name='expire-seconds' value='1840'/>
    <param name='retry-seconds' value='90'/>
    <param name='register' value='true'/>
    <param name='caller-id-in-from' value='false'/>
    <param name='inbound-proxy-media' value='false'/>
    <param name='extension-in-contact' value='true'/>
    <param name='disable-transcoding' value='true'/>
    <param name='ping' value='50'/>
    <param name='register-transport' value='udp'/>
</gateway>
" > $FS_DIR/extend/sip_profiles/external/sip_unite.xml

echo "
<include>
 <extension name='income_from_local_190222'>
    <condition field='destination_number' expression='^190326#(.+)$' >
        <action application='log' data='ERR start \${destination_number}'/>
        <action application='set' data='sip-force-contact=NDLB-connectile-dysfunction'/>
        <action application='set' data='session_in_hangup_hook=true'/>
        <action application='set' data='bypass_media=false'/>
        <action application='set' data='hangup_after_bridge=true'/>
        <action application='bridge' data='{sip_cid_type=none}sofia/gateway/$FS_SIP_LOGIN/+\${1}'/>
        <action application='hangup' data='NORMAL_TEMPORARY_FAILURE'/>
    </condition>
 </extension>
</include>
" > $FS_DIR/extend/dialplan/localnet/190222_unite.xml

echo "
<configuration name='acl.conf' description='Network Lists'>
  <network-lists>
    
    <list name='docker_local_net' default='deny'>
      <node type='allow' cidr='$FS_DOCKER_SUBNET'/>
      <node type='allow' cidr='127.0.0.1/32'/>
    </list>
    
    <list name='docker_extend_net' default='deny'>
      <node type='allow' cidr='$UNITEL_NET/$UNITEL_MASK_BIT'/>
      <node type='allow' cidr='127.0.0.1/32'/>
    </list>

    <list name='domains' default='deny'>
      <node type='allow' domain='$${domain}'/>
    </list>

  </network-lists>
</configuration>
" > $FS_DIR/extend/autoload_configs/acl.conf.xml

echo "
[$MYSQL_DATABASE]
Driver=MySQL
SERVER=$IP_MYSQL
PORT=3306
DATABASE=$MYSQL_DATABASE
USER=$MYSQL_USER
PASSWORD=$MYSQL_PASSWORD
" > /etc/odbc.ini

# sed -i "s/\"odbc:\/\/freeswitch\"/\"odbc:\/\/$MYSQL_DATABASE\"/" /usr/local/freeswitch/conf/main/autoload_configs/odbc_cdr.xml

sed -i "s/<param name=\"rtp-start-port\" value=\"18000\"\/>/<param name=\"rtp-start-port\" value=\"$FS_START_RTP\"\/>/" $FS_DIR/main/autoload_configs/switch.conf.xml
sed -i "s/<param name=\"rtp-end-port\" value=\"20000\"\/>/<param name=\"rtp-end-port\" value=\"$FS_STOP_RTP\"\/>/" $FS_DIR/main/autoload_configs/switch.conf.xml



 echo "/sbin/iptunnel del tun0" >> /ipip.sh
 echo "/sbin/ip tunnel add tun0 mode ipip remote $FS_EXTNET_IP local $FS_IP dev eth0" >> /ipip.sh
 echo "/sbin/ifconfig tun0 $IP_LOCAL_IPIP netmask $IP_MASK_IPIP pointopoint $IP_GW_IPIP" >> /ipip.sh
 echo "/sbin/ifconfig tun0 mtu 1482 up" >> /ipip.sh
 echo "/sbin/route add -net $UNITEL_NET netmask $UNITEL_MASK gw $IP_GW_IPIP dev tun0" >> /ipip.sh

chmod +x /ipip.sh

/ipip.sh

nohup ping 10.0.0.1 -i 10 > /dev/null 2>&1 &

service snmpd start &&
service freeswitch start &&
tail -f /usr/local/freeswitch/log/freeswitch.log