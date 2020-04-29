### Usage Instruction:

Run Lumen Rest API:

```bash
cd backend-lumen
composer install
# configure your key, database, etc in `.env` file
php artisan migrate --seed
# generate jwt token
php artisan jwt:secret
php artisan serve
```