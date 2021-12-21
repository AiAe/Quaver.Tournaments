# QOT

Quaver Official Tournament - Website

## About this project

This project aims to be useful for everyone who is interested in hosting tournament.

## What the project contains
1. Login with Quaver
2. Link Discord
3. Join staff form
4. Suggest maps form
5. Basic rules page
6. Staff page (manual)
7. Basic admin panel with information and form data

## ToDos
1. Implement player registrations
2. Mappool - Creating/Editing/View
3. Give all players tourney role and change their nick to Quaver username
4. API for easier spreadsheeting
5. Edit pages from admin panel

## Install
1. Clone the project
2. Configure the server to use `/public` for root directory
3. Copy `.env.example` and rename to `.env` and configure it
4. Run `composer install`
5. Run `php artisan key:generate`
6. Run `php artisan migrate`

## Deploying
1. `git pull`
2. `sh deploy.sh`
