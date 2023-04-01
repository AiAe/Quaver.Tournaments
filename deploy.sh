/usr/bin/php artisan down --retry=5 --refresh=6 --quiet

/usr/bin/git pull

/usr/local/bin/composer install --no-dev --no-interaction --no-progress

/usr/bin/php artisan migrate --force

/usr/bin/php artisan package:discover
/usr/bin/php artisan view:cache
/usr/bin/php artisan route:cache
/usr/bin/php artisan config:cache

/usr/bin/php artisan queue:restart

# UPDATE ASSETS (it takes some time)
npm i &>/dev/null
npm run build &>/dev/null

APP_VERSION=`git rev-parse --short HEAD`
sed -i 's/^\APP_VERSION=.*/\APP_VERSION='"$APP_VERSION"'/' .env

/usr/bin/php artisan config:cache
/usr/bin/php artisan view:cache

/usr/bin/php artisan storage:link

/usr/bin/php artisan up
