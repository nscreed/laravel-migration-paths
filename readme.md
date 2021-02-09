## Laravel Migration Paths
* By [nscreed](https://www.github.com/nscreed)

During the periodical development phase the migrations folder may become very large. 
It is very helpful if we can organize the content of the migration folders.
This library helps to organize migration files in different folders. 
Even, if your organize your existing files it will works as well.

### Installations:
Use [Composer](https://getcomposer.org/) to install the library.
```bash
composer require nscreed/laravel-migration-paths
```

After updating composer, add the service provider to the `providers` array in `config/app.php`
```php
NsCreed\MigrationPath\ServiceProvider::class,
```

**Laravel 5.5** uses Package Auto-Discovery, so does not require you to manually add the ServiceProvider.

### Usages
By default all folders under the `migrations` directory will be registered for migrations.

But, if you like to add custom directories which is not under the migrations folder 
you have to publish the config first.

```php
php artisan vendor:publish --provider="NsCreed\MigrationPath\ServiceProvider" --tag="config"
```

Add your custom directories:
```php
'paths' => [
    database_path('migrations'),
    
    // Your Custom Migration Directories
    base_path('src/User/Migrations'),
    base_path('src/Page/Migrations'),
    'path/to/custom_migrations',
    
],
```

### License
This bundle is under the MIT license. For the full copyright and license
information please view the LICENSE file that was distributed with this source code.
