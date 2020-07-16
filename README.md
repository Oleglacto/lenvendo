## Requirements

* PHP version 7.4
* Elasticsearch version 7
* 2 cpu/4gb ram

## Commands for added indexes to elasticsearch 
```
php artisan elastic:update-mapping "App\EloquentModels\Bookmark"
php artisan elastic:create-index "App\BookmarkIndexConfigurator"
```

