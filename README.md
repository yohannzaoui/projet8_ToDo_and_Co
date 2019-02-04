*ToDoList App Your Task Application*
==================================
### *Project 8 OpenClassRooms*

[![Codacy Badge](https://api.codacy.com/project/badge/Grade/a711004de5cd4e5f9b4bc892faf33146)](https://app.codacy.com/app/yohannzaoui/projet8_ToDo_and_Co?utm_source=github.com&utm_medium=referral&utm_content=yohannzaoui/projet8_ToDo_and_Co&utm_campaign=Badge_Grade_Dashboard)
[![Maintainability](https://api.codeclimate.com/v1/badges/96bff9fc7d6cd02562bb/maintainability)](https://codeclimate.com/github/yohannzaoui/projet8_ToDo_and_Co/maintainability)

* Developped with the Symfony 3.4 framework
* CSS : Bootstrap 4

## Prérequisites
* **Php 7.2**
* **Mysql 5.7**
* **Redis Server**

## Tested with:
- PHPUnit [more infos](https://phpunit.de/)
- Selenium [more infos](https://www.seleniumhq.org/)

## Metrics with:
- PHP Metrics
- BlackFire

## Cache with:
- Redis

## Install application:
1. clone or download the repository into your environment. https://github.com/yohannzaoui/projet8_ToDo_and_Co.git
2. composer install
3. and enter your parameters database
4. php bin/console doctrine:database:create
5. php bin/console doctrine:schema:update --force
6. php bin/console doctrine:fixtures:load
7. Run REDIS server [more informations](https://redis.io/)
- Create user
- Create task

[Security documentation](https://github.com/yohannzaoui/projet8_ToDo_and_Co/blob/master/docs/documents/symfony_security.pdf)

[Quality Code documentation](https://github.com/yohannzaoui/projet8_ToDo_and_Co/blob/master/docs/documents/audit_qualit%C3%A9.pdf)

[Contribute to this project](https://github.com/yohannzaoui/projet8_ToDo_and_Co/blob/master/Contributing.md)

# *Enjoy !!*



