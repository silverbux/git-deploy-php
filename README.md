git-deploy-php
==============

PHP to deploy git repository directly to your server using Git Webhook.

### Basic usage:

```
http://yourdomain.com/deploy.php?pass=YOUR_PASSWORD
```

###Laravel Migrate

```
http://domain.com/deploy.php?pass=YOUR_PASSWORD&c=php artisan migrate
```

###Laravel Migrate and DB Seed

```
http://domain.com/deploy.php?pass=YOUR_PASSWORD&c=php artisan migrate,php artisan db:seed
```
