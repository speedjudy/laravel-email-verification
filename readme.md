## Build app

### Step 1
- git clone `https://github.com/OlegMarko/email-verification.git`
- `cd email-verification`
- add permissions to ./public ./storage ./bootstrap
- change `.env` file similar to `.env.example`
- run command: `php artisan migrate`
- run command: `php artisan serve`
- visit to [http://127.0.0.1:8000](http://127.0.0.1:8000)