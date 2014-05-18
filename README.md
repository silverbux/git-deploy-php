git-deploy-php
==============

php script to deploy git repository directly to your server using Git Webhook


 **1.) Basic Usage**
 http://domain.com/deploy.php?pass=put_password_here
 **2.) With laravel migrate**
 http://domain.com/deploy.php?pass=put_password_here&c=php artisan migrate
 **3.) With laravel migrate and db seet**
 http://domain.com/deploy.php?pass=put_password_here&c=php artisan migrate,php artisan db:seed