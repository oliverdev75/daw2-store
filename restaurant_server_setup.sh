#!/bin/sh

virtualhost_template="
<VirtualHost *:80>
        ServerAdmin webmaster@localhost
        DocumentRoot /var/www/sf-restaurant/public

        ErrorLog ${APACHE_LOG_DIR}/error.log
        CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>

# vim: syntax=apache ts=4 sw=4 sts=4 sr noet
"

install_composer() {
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
    php -r "if (hash_file('sha384', 'composer-setup.php') === 'dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
    php composer-setup.php
    php -r "unlink('composer-setup.php');"
    
    if ! [ -f "composer.phar" ]
    then
        echo "Failed to install Composer"
        exit 1
    fi

    composer_exit=`./composer.phar -V`
    if [ $? -eq 0 ]
    then
        echo "Composer was successfuly installed: " $composer_exit
        exit 1
    else
        echo "Failed to install Composer"
    fi

    mv composer.phar /usr/local/bin/composer
    echo "Composer moved to binaries"
}

check_service() {
    echo -e "Checking $2 installation..."
    command_exit=`$1`
    if [ $command_exit -ne 0 ]
    then
        echo "$2 was succesfuly installed: " $command_exit
    else
        echo "Failed to install $2"
        exit 1
    fi
}

create_hosting() {
    # Create web directory
    mkdir /var/www/sf-restaurant
    chown www-data:root /var/www/sf-restaurant
    chmod 774 /var/www/sf-restaurant

    # Create virtualhost
    echo $virtualhost_template > /etc/apache2/site-available/sf-restaurant.conf
    a2ensite
}

if [ $(id -u) -ne 0 ]
then
    echo "Must execute this script a root."
    exit 1
fi


echo "Installing services..."
apt-get update && \
apt-get install apache2 php8.2 php8.2-{fpm,mysql} mysql-server

check_service 'apache2 -v' Apache2
check_service 'php -v' PHP
check_service 'mysql --version' MySQL

install_composer