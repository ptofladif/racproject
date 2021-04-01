##LaravelDaily/Laravel-AdminLTE3-Boilerplate

```
git commit -m "first commit"
git branch -M main
git remote add origin git@github.com:ptofladif/racproject.git
git push -u origin main
```

##package.json

```
"start": "php artisan serve --port=8008"
```

```
php artisan make:migration create_cars_table  --create=cars 

php artisan make:controller CarController --resource --model=Car

php artisan make:migration create_rents_table  --create=rents 

php artisan make:controller RentController --resource --model=Rent
```
##npm start

heroku plugins:install heroku-builds

heroku builds:cancel -a YOUR_HEROKU_APP_NAME

heroku login -i

heroku create rac-app-mf

heroku git:remote -a rac-app-mf

git push heroku main


heroku run bash

composer install

php artisan config:cache

php artisan passport:install

php artisan passport:keys

php artisan vendor:publish --tag=passport-config
