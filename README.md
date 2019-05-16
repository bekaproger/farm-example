Farm exmple

clone this repository

run : composer install

configure database

run php artisan migrate

run php artisan farm:start

commands 

add:animal --name={cow, chicken, ..etc} --product= {milk, egg, ..etc} --max={max amount of product the animal gives} --min={min amount of product} --unit={litres, items ... etc} - add an animal

farm:info - show details about farm

get:products - collect all products from farm

all command should be run using php artisan
