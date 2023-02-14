# Quaver.Tournaments

Platform that helps organisers host their own tournaments.

## What the project contains

TBA

# Setting up project

## Requirements

1. Nginx (or other web server)
2. PHP 8.2 (or above)
3. Mariadb (or MySQL)
4. Redis

## Install

1. Clone the project
2. Configure the server to use `/public` for root directory. [Settings up with Nginx](#nginx-config)
3. Copy `.env.example` and rename to `.env` and configure it
4. Run `composer install`
5. Run `php artisan key:generate`
6. Run `sh deploy.sh`

#### Nginx config

```nginx
server {
    listen 443 ssl http2;
    server_name tournaments.quavergame.com;
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
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

### Commands

- `artisan user:role`
- `artisan user:ghost`

### ENV
For linking Discord - https://discord.com/developers/applications
For login with Quaver - https://quavergame.com/developers/applications

- `APP_LOCK` - `true` or `false`
- `AUTH_USER` - user
- `AUTH_PASSWORD` - password


- `DISCORD_BOT=false` - TBA


- `DISCORD_CLIENT_ID=` - Discord bot client id
- `DISCORD_SECRET=` - Discord bot secret
- `DISCORD_REDIRECT=` - Redirect after login


- `QUAVER_CLIENT_ID=` - Quaver client id
- `QUAVER_SECRET=` - Quaver secret
- `QUAVER_REDIRECT=` - Redirect after login

## License

This project is licensed under the AGPL-3.0 license.
