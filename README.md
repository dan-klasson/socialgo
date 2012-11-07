Symfony assessment using the Facebook API.
========================

* Add the `facebook_app_id`, `facebook_secret`  and `database_password` to `app/config/parameters.ini`
* Run: `php bin/vendors install` to install all third party apps
* Run `php app/console doctrine:database:create` to create the database
* Run `php app/console doctrine:schema:update --force` to create the schema
* Setup the permissions on the cache and logs folder depending on you OS
