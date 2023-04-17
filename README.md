
# Task Management

A small application created using Laravel 10, Livewire 2, Alpine.js, and Tailwind stack in managing projects and tasks. An application same as kanban boards yet more on sorting the list that transfering categories.

## Project

Clone repository from this link: `https://github.com/bmaraon/task-management`.


## Configurations

To run this project, please refer to this environment variables.
#### .env
```
APP_NAME="Task Management"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:9002

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_management
DB_USERNAME=root
DB_PASSWORD=

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1

VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
VITE_PUSHER_HOST="${PUSHER_HOST}"
VITE_PUSHER_PORT="${PUSHER_PORT}"
VITE_PUSHER_SCHEME="${PUSHER_SCHEME}"
VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
```
#### vite.config.js
```
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});

```
#### tailwind.config.js
```
/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}

```


## Installation
- Open Git Bash or any terminal
- Access SQL server then create database
```
mysql -uroot -p
create database task_management charset=utf8mb4;
```
- Go to project root directory
- Install dependencies
```bash
composer install
...

npm install
...
```
- Generate app key
```
php artisan key:generate
```
- Migration and seeder (remove seeder if not necessary)
```
php artisan migrate --seed
```


    
## Running the application

Backend
```bash
php artisan serve --port=9002
```

Frontend
```bash
npm run dev
```
or
```bash
npm run production
```
