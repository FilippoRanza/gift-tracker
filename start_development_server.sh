#! /bin/bash

sudo systemctl start mariadb.service
sudo systemctl start lighttpd.service

xdg-open localhost/phpmyadmin 
xdg-open localhost:8000  

php artisan serve
