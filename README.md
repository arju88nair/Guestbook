# Guestbook

A simple example of a user base Guestbook where users will be able to add posts about their entries which is implemented on core PHP and MySQL

## Requisites

```
PHP 5.6+
MySQL

```
---
## Setup
```
git clone git@github.com:arju88nair/Guestbook.git (Make sure the SSH keys are configured or else go for the HTTPS url)
php -f Datbase.php
Create uploads folder in the root with required permissions
php -S  localhost:8080  index.php 
```

The `Database.php` script will create a dummy admin user.
 
## Todo
- Better routing.
- Better messaging and display for messages.
- Proper MVC structure
- Better conditions and checks
- Better API instance class
- JWT or similar token based auth for APIs
