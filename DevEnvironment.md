# Development Environment using Laravel Sail

1. Install Docker
2. Run `docker run --rm -u "$(id -u):$(id -g)" -v "$(pwd):/var/www/html" -w /var/www/html laravelsail/php82-composer:latest composer install --ignore-platform-reqs`
    - This will use a temporary Docker container to install Sail into the project without having to install PHP yourself.
    - Commands from now on will assume an alias `sail -> ./vendor/bin/sail`
3. Set up configuration from `.env.example`
4. `sail up`, starts up the Docker containers, required every time you want to develop
    - Use `sail down` to shut down the Docker containers
5. `sail artisan key:generate`
6. `sail artisan migrate`, add `--seed` for a seeded test database
7. `sail npm install`
    - `sail npm run build` to compile your CSS
    - `sail npm run dev` to set up a watcher that compiles your CSS
8. `sail test` to run tests
9. Visit `localhost` to view the webapp

## Setup debugging in PhpStorm

- In PhpStorm settings, go to `PHP` and create a new CLI Interpreter
  - Create from Docker and select `sail8.2:app-latest` image
  - Below CLI Interpreter, edit Docker Container settings and set network mode to `quavertournaments_sail`
    (double check with `docker network ls`)
  - Publish the ports you need (or publish all if lazy)
- Add `SAIL_XDEBUG_MODE=develop,debug` to your `.env`, add `coverage` if you want
- Now you can set up running Phpunit using the sail interpreter
