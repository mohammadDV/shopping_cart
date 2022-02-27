## Manage products with inventory in shopping cart service

First of all personally I think in normal mode inventory management should be checked at the time of final registration of the order, but in this system I tried to manage product inventory on the shopping card and also in the future to return products that are unreasonable on the shopping card We can put a ‘Job' that can empty the customer card after about 10 minutes and then return the product inventory.
In this system you can see all of products and details product and adding every product to your shopping cart with containing number of you want but if your suggest more than stock of product you will face an error.
You can also change number of you want and delete one of product in your shopping cart and you can clear your shopping cart completely.
It is remarkable to say, I didn’t use “Users Table” and “Authentication” in this system. I tried to use “unique_id” as a unique identifier for each client. Which can be changed in different strategies, for example we can change it to “Token” or “Session_id” or “User_id” and  I tried manage inventory of product in all of request as much as possible.

## Project’s files:

1.	StockService.php 	    in “app/Services/”.
2.	CartTrait.php           in “app/Traits/”.
3.	tests	    			in “tests/Feature/Models/”.
4.	controllers				in “app/Http/Controllers/Api/”
5.	models					in “app/Models/”
6.	Requests				in “app/Http/Requests/”
7.	Resources				in “app/Http/Resources/”
8.	Factories				in “database/factories/”
9.	Migrations				in “database/migrations/”
10.	Seeders				    in “database/seeders/”



## for executing this service it's enough you do these

-	Command to run migration “php artisan migration”.
-	Command to run seeder “php artisan db:seed ProductSeeder”.
-	Command to run system's test “php artisan test”.


The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
