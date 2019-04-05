# freeswitch_1.6

``` bash 
echo '
MYSQL_ROOT_PASSWORD=pwd
MYSQL_DATABASE=fs
MYSQL_USER=fsuser
MYSQL_PASSWORD=fs_pwd
' > /security/db.env
```


add for f1 env


``` bash  
echo '
FS_EXTNET_IP=1.2.3.4
FS_SIP_LOGIN=login1
FS_SIP_NUMBER=33443322
FS_SIP_PASSWD=pwd1
FS_UA=Linksys/SPA901-5.1.5
'>  /security/fs1.env
```
add f2 env

``` bash  
echo '
FS_EXTNET_IP=1.2.3.4
FS_SIP_LOGIN=login2
FS_SIP_NUMBER=33443322
FS_SIP_PASSWD=pwd2
FS_UA=Linksys/SPA901-5.1.5
'>  /security/fs2.env
```

add main freeswitch
``` bash  
echo '
MAINFS_HOST_EXTNET_IP=1.2.3.4
' > /security/mainfs.env
```

get  docker container  
docker push cr80/fs16:v8
