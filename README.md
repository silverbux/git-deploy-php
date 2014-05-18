git-deploy-php
==============

php script to deploy git repository directly to your server using Git Webhook


 **1.) Basic Usage** <br>
 http://domain.com/deploy.php?pass=put_password_here <br>
 **2.) With laravel migrate** <br>
 http://domain.com/deploy.php?pass=put_password_here&c=php artisan migrate <br>
 **3.) With laravel migrate and db seet** <br>
 http://domain.com/deploy.php?pass=put_password_here&c=php artisan migrate,php artisan db:seed