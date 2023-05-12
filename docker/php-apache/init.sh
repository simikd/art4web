#!/bin/bash
chown www-data:www-data -R /var/www/html/storage

exec /usr/sbin/apache2ctl -D FOREGROUND
