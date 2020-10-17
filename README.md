# Simple user list Symfony App.

### How to run
- Fill `.env` file with access data to your database
- Run command `composer install`
- Run command `npm install`
- Run command `gulp`
- Run command `php bin/console doctrine:migrations:migrate`
- To start server run command `symfony serve`

#### Requirements:
Application need MySQL in version 8.0.

##### Fixtures:
To fill database with sample data run command: `php bin/console doctrine:fixtures:load`. It will create a few user accounts with login as `testN` (where N is number from 0 to 32) and password as `qwerty`.