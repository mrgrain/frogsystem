# Frogsystem Next

## Installation
Using Vagrant:
```
git clone git@github.com:frogsystem/frogsystem.git frogsystem/
vagrant up
```

Manually:
```
git clone git@github.com:frogsystem/frogsystem.git frogsystem/
composer install
cp -n .env.example .env
mysql my_database < migration/structure.sql
```

## Configuration
Set the following configuration values in your `.env` file:
 * `APP_KEY` General application encryption key
 * `SPAM_KEY` Key used for captcha encryption

 * `DB_TYPE` Type of the database connection, e.g. `mysql`
 * `DB_NAME` Database name
 * `DB_USER` User name for database login
 * `DB_PASSWORD` Password for database login
 * `DB_HOST` Database hostname
 * `DB_PREFIX` Table prefix for application tables, use `fs2_` as default



### Database
If your not using Vagrant, adjust the configuration entry `main.url` in the `fs2_config` table.

## Usage
There is an admin account set up ready for use. Login with `admin/admin` as username/password.


## Known Issues

### xdebug
The template system uses quite a lot recursion. Tell xdebug to allow a bit more than the default setting:
```
xdebug.max_nesting_level = 200000
```
