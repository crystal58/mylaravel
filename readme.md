laravel 5.1 学习


安装

git clone https://github.com/crystal58/mylaravel.git projectname
cd projectname
composer install
php artisan key:generate
Create a database and inform .env
php artisan migrate --seed to create and populate tables
Inform config/mail.php for email sends
php artisan vendor:publish to publish filemanager