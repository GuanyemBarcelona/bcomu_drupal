Guanyem Web Team: Drupal 7 installation
=========
Version 2.2.1
---
Drupal site general recommendations
===================================

Site Installation Checklist
---------------------------
**Through SSH:**

- Go to the project's folder (e.g. /myweb/httpdocs, the root from now on), and empty it
- Enter this folder and clone this repo there (add . at the end of the clone statement)
- Install drupal dependencies:

```
composer install
```

- Copy all files from the /core folder and paste them inside root, without overwriting anything
- Create a database. Enter in mysql console and:

```mysql
CREATE DATABASE `DB_NAME` CHARACTER SET utf8 COLLATE utf8_general_ci; GRANT ALL ON `DB_NAME`.* TO `DB_USER`@localhost IDENTIFIED BY 'DB_PASSWORD'; FLUSH PRIVILEGES;
```

and exit the mysql console
- In /sites/default/ create a file named secret.settings.php with this inside (This file should NEVER be committed to version control):
    
```php
<?php
/**
 * Site environment
 * dev or pro or whatever environment you need
 */
$conf['environment'] = 'dev';

// the database settings for this environment
$databases = array (
  'default' => 
  array (
    'default' => 
    array (
      'database' => 'DB_NAME',
      'username' => 'DB_USER',
      'password' => 'DB_PASSWORD',
      'host' => 'localhost',
      'port' => '',
      'driver' => 'mysql',
      'prefix' => '',
    ),
  ),
);
```

- Copy /sites/default/default.settings.php as settings.php (you can safely commit settings.php to version control):
- Make settings.php and secret.settings.php non writable
- Remove install.php from root
  
The Theme
=========
The custom site theme is a nice SASS boilerplate theme for Drupal 7, loosely based on the Zen theme. 

This theme has been carefully created after years of Drupal 7 experience.

The code is made following strictly SoC (Separation of Concerns) principles.

This theme uses npm (node package manager) to load dependencies and to run gulp, which in turn parses the SASS files into css.

Theme dependencies
------------------
- Composer: https://getcomposer.org/
- Node.js: https://nodejs.org/en/download/package-manager/
- Drush (recommended): http://docs.drush.org/en/master/install/

Deployment
----------
- Go to the theme folder and install dependencies, just the first time:

> npm install

- Each time you deploy, to process the sass files into css you must do:

> npm run gulp

or you can 

> npm run gulp watch

for continuous watching of sass files changes.
