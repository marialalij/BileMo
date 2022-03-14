ToDoList8
INSTALLATION

Download or clone

Configure environment variables

DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=5.7"

Install the project

Create the database

If the database does not exist, create it with the following command in the project directory:

php bin/console doctrine:database:create

Create database structure thanks to migrations:

php bin/console doctrine:migrations:migrate

Install fixtures to have fake contents:

php bin/console doctrine:fixtures:load

Testing

Unit and functionnal tests have been implemented with PHPUnit,To run all tests: php bin/phpunit

To generate up-to-date test-coverage:php bin/phpunit--coverage-html var/log/test/test-coverage Test-coverageToDoList8
INSTALLATION

Download or clone

Configure environment variables

DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=5.7"

Install the project

Create the database

If the database does not exist, create it with the following command in the project directory:

php bin/console doctrine:database:create

Create database structure thanks to migrations:

php bin/console doctrine:migrations:migrate

Install fixtures to have fake contents:

php bin/console doctrine:fixtures:load

Testing

Unit and functionnal tests have been implemented with PHPUnit,To run all tests: php bin/phpunit

To generate up-to-date test-coverage:php bin/phpunit--coverage-html var/log/test/test-coverage Test-coverage
