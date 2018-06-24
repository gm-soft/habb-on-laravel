## Habb-on-Laravel

### Использованные либы
* https://laravelcollective.com/docs/5.3/html
* dataTables

### StackOverflow Driven Development
* http://stackoverflow.com/questions/23786359/laravel-migration-unique-key-is-too-long-even-if-specified
* https://laravel-news.com/laravel-5-4-key-too-long-error
* http://stackoverflow.com/questions/39196968/laravel-5-3-new-authroutes/39197278#39197278
* http://stackoverflow.com/questions/22405762/laravel-update-model-with-unique-validation-rule-for-attribute
* https://laracasts.com/discuss/channels/requests/laravel-5-cant-use-ajax-post-request

[Статья](https://shareurcodes.com/blog/laravel%20datatables%20server%20side%20processing) о том, как сделать обработку DataTables на сервере, чтоб не нагружать базу 


````
artisan down

composer self-update
composer update

git checkout -f
git pull origin master

artisan migrate --force
artisan cache:clear

rm -rf public/assets
mkdir public/assets

artisan up
````

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).