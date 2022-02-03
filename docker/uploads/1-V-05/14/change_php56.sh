#!/bin/zsh

update-alternatives --set php /usr/bin/php5.6
a2dismod php7.0
a2dismod php7.3
a2dismod php7.4
a2enmod php5.6
systemctl restart apache2
