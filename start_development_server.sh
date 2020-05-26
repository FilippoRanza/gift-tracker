#! /bin/bash

sudo systemctl start mariadb.service
sudo systemctl start lighttpd.service

python -m webbrowser localhost/phpmyadmin &
python -m webbrowser localhost:8000  &

php artisan serve
