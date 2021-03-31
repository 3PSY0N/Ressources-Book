# Testing

```
composer install
yarn install
yarn dev
php bin/console doctrine:database:create --if-not-exists
php bin/console doctrine:schema:create
php bin/console doctrine:fixtures:load --no-interaction
```

User: `john@doe.com`

Password: `jdoe`
