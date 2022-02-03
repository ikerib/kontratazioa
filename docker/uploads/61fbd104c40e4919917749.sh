#!/bin/zsh


update-alternatives --set php /usr/bin/php7.3
a2dismod php5.6
a2dismod php7.0
a2dismod php7.4
a2enmod php7.3
systemctl restart apache2
