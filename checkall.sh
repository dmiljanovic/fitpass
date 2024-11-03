#!/bin/bash
echo "MySQL drop db, create db"
echo "========================================================================="
mysqladmin -uroot -proot drop fitpass
mysqladmin -uroot -proot create fitpass
echo "==================== Composer dump autoload===================="
composer dump-autoload
echo "==================== Artisan migrate===================="
php artisan migrate
echo "==================== Artisan db:seed===================="
php artisan db:seed
echo "======================================================"
echo "git status"
git status
echo "======================================================"
composer dump-autoload
