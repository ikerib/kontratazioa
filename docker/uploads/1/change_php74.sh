#!/bin/zsh


update-alternatives --set php /usr/bin/php7.4
a2dismod php56
a2dismod php7.0
a2dismod php7.3
a2enmod php7.4
systemctl restart apache2
