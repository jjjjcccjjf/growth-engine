
# RestIgniter CRUD / Headless CMS
[![Bless](https://cdn.rawgit.com/LunaGao/BlessYourCodeTag/master/tags/sakyamuni.svg)](http://lunagao.github.io/BlessYourCodeTag/)
[![Bless](https://cdn.rawgit.com/LunaGao/BlessYourCodeTag/master/tags/fsm.svg)](http://lunagao.github.io/BlessYourCodeTag/)

### About RestIgniter CRUD
A fork of [CodeIgniter Rest Server](https://github.com/chriskacerguis/codeigniter-restserver) that has been enhanced for ease of use mainly CRUD operations for developing your own RESTful API. This project will also include a CMS in the future versions.

## Requirements
+ PHP 5.6 or greater

## Dependencies
+ [PHP dotenv for codeigniter](https://github.com/agungjk/phpdotenv-for-codeigniter)

## Setup
This project utilizes [PHP dotenv for codeigniter](https://github.com/agungjk/phpdotenv-for-codeigniter) and it's the only thing you need to edit aside from *creating a database*. The default mode of this application is set to `development`. Therefore, you should create a `.env.development` file in your project root. You can copy the `.env.development.example` provided at the root directory as well.

+ Step 1: Create a `.env.development` file at the project root. You can copy the values from  `.env.development.example` as an example and then fill out the necessary information
+ Step 2: Create a database depending on the `DB_NAME` you setup at the `.env.development`. The default one is `restcrud`, so if you're going to change that (which is most definitely you will), then create a database with the same name.
+ Step 3: That's it! You've now successfully setup this headless CMS. You can now move on to **Migrations**.

## Migrations

Migrations are automatically enabled in the `.env.development` file (if you copy the default values from the example). Though I recommend to set `MIGRATION_ENABLED=` to `FALSE` when your application is in _production mode_ or after you have migrated your database.

### How to create your own Migrations

First if all, migrations can be found in the `application/migrations/` folder. Inside that folder, you can find `application/migrations/example`. Those are migrations that I previously used from other projects. You can take the liberty to copy them or use them as a reference.

Moving on, here's how you create your own migration files:

+ **Step 1**: Create a new file in the `application/migrations` folder
+ **Step 2**: The file name must follow the pattern of `YYYYMMDDHHIISS_migration_name`.

**NOTE:** The datetime in the migration you want to create should be *later* than the last one you created.  
**For example**, if your last file is `20170604120500_crud_table`, then you should do something like `20170604120501_another_table` (this one is one second later) or `20180625000000_another_table` (the date today). Either will work just fine.

+ **Step 3**: Refactor the `class name` of the newly created migration. Following our example, it should be `Migration_migration_name`.
+ **Step 4**: Refactor the table names and field names in the migration as you see fit. You can always use the example migrations as reference if necessary.


### How to use migrations
This repo comes with a Migration controller by default. You can add more commands to the controller as you wish. You can find it in the `application/controllers` folder.

Here are the built-in commands that comes with this repo. Replace `http://localhost/your_site` with your base url.


* __Latest__  
`http://localhost/your_site/migrate`
`http://localhost/your_site/migrate/latest`  
Access this in your browser to perform your migrations to the latest available migration.
* __Reset__   
`http://localhost/your_site/migrate/reset`  
Use this to roll back all migrations. (Usually removes all data in the database)
* __Refresh__  
`http://localhost/your_site/migrate/refresh`  
Perform `reset` then `latest`


## Development reminders
+ Make sure you customize your `application/config/routes.php` and set up your API routes there manually since Codeigniter uses the _magic routing_. Most of the time, you will have to have more control in your routes for a more pragmatic RESTful design.
+ In uploading, you can set your `DEFAULT_FOLDER_PERMISSIONS` constant in `application/config/constants.php`

## TODO:
[x] Integrate create folder in core upload class  
[ ] Documentation of MY_Controller
[ ] Documentation of MY_Model
