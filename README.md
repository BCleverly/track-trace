# Track & Trace

This is an open source MIT licensed website to allow for easy track and trace for a business with a single or multiple locations. It allows for a configured data retention period, default is at 21 days. After this time period, records will be automatically purged at the end of the day.

## Roadmap
1. Data export for when you need to contact people (CSV/Excel/JSON)
1. Add unit tests
1. Investigate an install wizard for non cli installed

## Requirements
- [Laravel 8 requirements](https://laravel.com/docs/8.x/installation#server-requirements)
- PHP 7.3 and up
- NodeJS v12.19 - previous versions may work but not tested
- Maria/MySql database, other datebases may work but not tested
- Superviors if running on a *nix box to allow for the scheduled task.

# Installation
1. Clone/Download this repository to where you want to install it.
1. Duplicated the `.env.example` file and add the database connection details and make sure `APP_URL` is set to the correct domain
   1. If you want a custom visitor retention period, set `VISITOR_RETENTION_PERIOD` to the number of days that's required in your country/county.
1. `composer install` and `npm install` then `npm run production`
1. Run the database migrations `php artisan migrate`
1. Add a user via the command `php artisan user:create` You will be prompted for fields
1. Add the following supervisor script to your system if you're on a *nix machine, see normal [Laravel instructions](https://laravel.com/docs/8.x/queues#supervisor-configuration)
```
[program:laravel-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /path/to/app/artisan queue:work sqs --sleep=3 --tries=3 --max-time=3600
autostart=true
autorestart=true
user=forge
numprocs=8
redirect_stderr=true
stdout_logfile=/home/forge/app.com/worker.log
stopwaitsecs=3600
```
1. If you can't use supervisor, then please set this in the env file to false `APP_SUPERVISOR_IN_USE=false`. This will trigger the command once per day at the start of the day. Uses the cache system to determine when to run, and sets the `ttl` to the end of the day.

## Commands
- `php artisan user:create` - Creates a user account
- `php artisan venue:generate-qr` - Generates QR codes for Venues
- `php artisan visitors:remove-old` - Removes all users outside of the retention period
