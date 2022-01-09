/usr/bin/git pull

/usr/sbin/composer install --no-dev

/usr/bin/php artisan migrate --force

/usr/bin/php artisan cache:clear
/usr/bin/php artisan config:clear
/usr/bin/php artisan view:clear
/usr/bin/php artisan route:clear

/usr/bin/php artisan optimize:clear
/usr/bin/php artisan package:discover
/usr/bin/php artisan view:cache
/usr/bin/php artisan route:cache
/usr/bin/php artisan config:cache
/usr/bin/php artisan storage:link

/usr/bin/php artisan user:roles
