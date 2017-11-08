# GenLab Application on Laravel
A Laravel based web application for managing item loans and reservations. Made for University of the Philippines Visayas Tacloban College by UP Interactive Society. 

See demo here:
 http://genlab.herokuapp.com/


## Requirements
This app needs:

* [Composer](https://getcomposer.org/).
* [Laravel](http://laravel.com/)
* several other packages defined under composer.json


## Installation
Laravel utilizes Composer to manage its dependencies. So, before using Laravel, you will need to make sure you have Composer installed on your machine. 
[Composer](https://getcomposer.org/)

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

- Create a database.
- Create/check .env file and configure database access (database name, password, etc) See example at .env.example
- Run migrations with command $ php artisan migrate
- Run seeder to "seed" initial contents of your database. $ php artisan db:seed


## Artisan Commands
Most definitely, this app will work using the artisan commands provided by Laravel. This section will discuss commands necessary to set-up your project on your computer for development.

### migrate
Migrations are like version control for your database, allowing your team to easily modify and share the application's database schema. Executing this creates the following tables to your database defined in your .env file:
- users
- items
- carts
- cart_items
- transactions

```bash
php artisan db:migrate
```

### db:seed
This initially seeds the project with through database/seeds/DatabaseSeeder.php.
Two accounts, **User** and **Admin**, are created.

User Account
Email: user@up.edu.ph
Password: 201400000

Admin Account
Email: admin@up.edu.ph
Password: sysadupvtc

```bash
php artisan db:seed
```

Additionally, you can seed the Items table using **--class=ItemsTableSeeder**

```bash
php artisan db:seed -- class=ItemsTableSeeder
```


## Security
If you discover any security related issues, please email nagarcia2@up.edu.ph instead of using the issue tracker.


## Credits
**Version 1**
- [Noel Garcia][link-author]
- [Ferlie Mae Penido][link-contributor]
- [Kristine Joyce Sabar][link-contributor]

**Version 2**
- [Noel Garcia][link-author]
- [April Joy Padrigano][link-contributor]
- [Jude Clarence Baguinang][link-contributor]
- [Nelbert Binongo][link-contributor]

