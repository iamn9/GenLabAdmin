# GenLab Application on Laravel
A Laravel-based application for managing item loans and reservations at UPVTC General Laboratory. Made for University of the Philippines Visayas Tacloban College by UP Interactive Society. 

See demo here:
 http://genlab.herokuapp.com/


## Requirements
This app needs:

* [Composer](https://getcomposer.org/).
* [Laravel](http://laravel.com/)
* A database management system such as PostgreSQL or MySQL
* Several other packages defined under composer.json


## Installation
Laravel utilizes Composer to manage its dependencies. So, before using Laravel, you will need to make sure you have [Composer](https://getcomposer.org/) installed on your machine. 

Then, download the Laravel installer using Composer.
```bash
composer global require "laravel/installer=~1.1"
```

Once you're done, clone this project:

```bash
git clone https://gitlab.com/nagarcia2/GenLabAdmin.git
```

### First steps, database creation, migrations and login
Once project is cloned, you have to follow the usual steps of any laravel project:

- Execute *$ composer update* to download and/or update your system for the packages needed.
- Create a database.
- Create/check .env file and configure database access (database name, password, etc) See example at .env.example
- Set-up your application key using *$ php artisan key:generate*
- Run migrations with command *$ php artisan migrate*
- Run seeder to "seed" initial contents of your database. *$ php artisan db:seed*



# Artisan Commands
Most definitely, this app will work using the artisan commands provided by Laravel. This section will discuss commands used to set-up the project on your development machine.

### key:generate
This is a command that sets the APP_KEY value in your .env file.
```bash
php artisan key:generate
```

### migrate
Migrations are like version control for your database, allowing your team to easily modify and share the application's database schema. Executing this creates the following tables to your database defined in your .env file:
- users
- items
- carts
- cart_items
- transactions

```bash
php artisan migrate
```

### db:seed
Laravel includes a simple method of seeding your database with test data using seed classes. All seed classes are stored in the database/seeds directory.

The **db:seed** command initially seeds the project through database/seeds/DatabaseSeeder.php.
Two accounts, **User** and **Admin**, are created by default.

**User Account** <br>
Email: user@up.edu.ph <br>
Password: 201400000 <br>

**Admin Account** <br>
Email: admin@up.edu.ph <br>
Password: sysadupvtc <br>

```bash
php artisan db:seed
```

Additionally, you can seed the Items table using **--class=ItemsTableSeeder**

```bash
php artisan db:seed -- class=ItemsTableSeeder
```


## Issues
If you discover any security related issues, please email nagarcia2@up.edu.ph or send a report using the issue tracker. Thanks!


## Credits
**Version 1**
- [Noel Garcia](https://gitlab.com/nagarcia2)
- [Ferlie Mae Penido](#)
- [Kristine Joyce Sabar](#)

**Version 2**
- [Noel Garcia](https://gitlab.com/nagarcia2)
- [April Joy Padrigano](#)
- [Jude Clarence Baguinang](#)
- [Nelbert Binongo](#)

