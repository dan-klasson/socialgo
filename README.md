Symfony assessment using the Facebook API.
========================

* Add the app id and secret to `app/config.config.yml`
* Change database password in `app/config/parameters.ini`
* Run `php app/console doctrine:database:create` to create the database
* Run `php app/console doctrine:schema:update --force` to create the schema
* Run: `php bin/vendors install` to install all third party apps
* Setup the permissions on the cache and logs folder depending on you OS
