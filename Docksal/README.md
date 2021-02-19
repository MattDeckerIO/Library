# Docksal local configuration

1. Install Docksal
   - https://docksal.io/installation#macos-docker-desktop

1. Add Docksal alias to `~/.bashrc` or `~/.zshrc`.
   - `alias docksal="DOCKER_NATIVE=1 bash <(curl -fsSL https://get.docksal.io)"`
   - Source your modified `~/.bashrc` or `~/.zshrc`.

1. Initialize Docksal containers
   - Run `docksal` via terminal.

1. Verify multiple docksal containers are running.
   - `docker ps`

## New project
1. In terminal, navigate to your project directory.
   - e.g. `cd ~/Sites`

1. Create new project
   - `fin project create`
     - The project name specified in this step will be used for the folder and the project URL.
     - If you select the `Drupal Composer` project it will create a fully functional Drupal application.

## Existing project with .docksal directory
  - Clone repository into project directory
    - `cd ~/Sites/projectname`
    - `git clone https://path-to-repo.git ./`
  - Start environment
    - `fin start`

## Existing project without .docksal directory
1. Copy the .docksal directory from this respository into the project root
1. Start environment
   - `fin init`
1. ...

## Commands
- `docksal` Initializes the docksal containers if they are not running.
- **Project**
   - `fin pl` List all running projects
   - `fin ps` Detail status of the project for the current folder.
   - `fin start` Starts the project for the current folder.
   - `fin stop` Stops the project for the current folder.
- **Database**
  - `fin db dump filename.sql` Exports the database
  - `fin db import filename.sql` Imports a database file.
  -  `zcat < filename.sql.gz | fin db import` Imports a compressed database file.
- **CLI**
  - `fin drush *command*` Runs a drush command. e.g. `fin drush cim -y`
  - `fin composer *command*` Runs composer commands e.g. `fin composer install`
  - `fin exec npm run *command*` Runs package.json commands e.g. `fin exec npm run build`
- **Xdebug**
  - `fin xdebug enable` Enables Xdebug for PHP
  - `fin xdebug disable` Disables Xdebug for PHP


### Database connection variables
```php
    $host = getenv('MYSQL_HOST');
    $user = getenv('MYSQL_USER');
    $pass = getenv('MYSQL_PASSWORD');
    $db   = getenv('MYSQL_DATABASE');
```

### Links
[Docksal Help](http://docs.docksal.io/fin/fin-help/)

[XDebug](https://docs.docksal.io/tools/xdebug/)

Website: http://projectname.docksal

MailHog: http://mail.projectname.docksal