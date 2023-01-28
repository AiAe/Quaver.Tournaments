# QOT

Quaver Official Tournament - Website

## About this project

This project aims to be useful for everyone who is interested in hosting a tournament.

## What the project contains

None

## API

None

# Setting up project

## Requirements

1. Nginx (or other web server)
2. PHP 8.1 (or above)
3. Mariadb (or MySQL)
4. Redis

## Install

1. Clone the project
2. Configure the server to use `/public` for root directory. [Settings up with Nginx](#nginx-config)
3. Copy `.env.example` and rename to `.env` and configure it
4. Run `composer install`
5. Run `php artisan key:generate`
6. Run `php artisan migrate`

#### Nginx config

```apacheconf
server {
    listen 443 ssl http2;
    server_name qot.ovh;
    root /qot/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.0-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

### Deploying

`sh deploy.sh`

### Commands

- `artisan user:role`

## ENV

For [QOT.Bot](https://github.com/AiAe/qot.bot)
1. `DISCORD_BOT=false` - change to `true` if bot is set up

For linking Discord - https://discord.com/developers/applications
1. `DISCORD_REDIRECT=` - where to redirect the user after login (default: https://qot.ovh/oauth/discord/callback)
2. `DISCORD_CLIENT_ID=` - Discord bot client id
3. `DISCORD_SECRET=` - Discord bot secret

For login with Quaver - https://quavergame.com/developers/applications
1. `QUAVER_CLIENT_ID=` - Quaver client id
2. `QUAVER_SECRET=` - Quaver secret
3. `QUAVER_REDIRECT=` - where to redirect after the user login (default: https://qot.ovh/oauth/quaver/callback)

# License

This project is licensed under the AGPL-3.0 license.
