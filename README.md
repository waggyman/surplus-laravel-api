### Simple Product CRUD API
In this repo, we provide a REST API made with **LARAVEL**. At the moment what you can do while using this application are:
- CRUD PRODUCT
- CRUD CATEGORY
- CRUD IMAGE

To run this repository you need to make sure:
- Have git
- Have PHP 8+ in your local machine
- Have composer 2 in your local machine
- Have MySQL Server (Make sure you create a db named 'surplus')
- Have Postman application

After you make sure everything, now you can run the application with:
1. Clone the repository with `git clone`
```shell
git clone git@github.com:waggyman/surplus-laravel-api.git
```
2. cd to the cloned project
```shell
cd surplus-laravel-api
```
3. copy the `.env.example` to `.env`
```shell
cp .env.example .env
```
4. Modify the `.env` file with your code editor. Change the corresponding variable
```shell
# .env file
DB_CONNECTION=mysql
DB_HOST={YOUR HOST | If local usually it's 127.0.0.1}
DB_PORT={DB PORT | Usually 3306}
DB_DATABASE=surplus
DB_USERNAME={your db username | root}
DB_PASSWORD={your db password}
```
5. After change and save the `.env` file. You need to run `composer install`
```shell
composer install -v
```
6. Once the composer installation is done. You can validate if the application can be ran or not with testing the artisan
```shell
php artisan
```
If it's success, you should be able to see this:
```shell
Laravel Framework 10.4.1

Usage:
  command [options] [arguments]

Options:
  -h, --help            Display help for the given command. When no command is given display help for the list command
  -q, --quiet           Do not output any message
  -V, --version         Display this application version
      --ansi|--no-ansi  Force (or disable --no-ansi) ANSI output
  -n, --no-interaction  Do not ask any interactive question
      --env[=ENV]       The environment the command should run under
  -v|vv|vvv, --verbose  Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
```

7. After you verify. You need to generate key with:
```shell
php artisan key:generate
```

8. Then you need to run the migration. It's used to populate the table for this application
```shell
php artisan migrate
```

9. Once the migration success, you need to run the seeder. It's used to generate some data inside those table
```shell
php artisan db:seed
```

10. After everything is success. You need to use the `serve` command to make the application run.
```shell
php artisan serve
```

11. Then to verify. You can just open a browser and in the url box just type `localhost:8000/api/products`. If the previous step is success. You should be able to see a JSON Response filled with product data.

(optional)
12. You can import the file named `SURPLUS_API.postman_collection.json` from this repository to your Postman. Once you imported it, you should be able to see new **collection** in your postman. From that collection you can see there are 3 folder `PRODUCT`, `IMAGE` and `CATEGORY`. Those folder contained some HTTP Request that you can use directly.