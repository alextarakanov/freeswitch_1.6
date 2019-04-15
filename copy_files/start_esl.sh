#!/bin/bash

DIR=/usr/local/esl
cp -fR /esl $DIR

sed -i "s/\$address='172.10.0.1'/\$address = '$IP_ESL'/" $DIR/unite_chose.php
sed -i "s/\$port='44445'/\$port='$PORT_ESL'/" $DIR/unite_chose.php

php /usr/local/esl/unite_chose.php
