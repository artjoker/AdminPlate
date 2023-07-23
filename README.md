# Artjoker AdminPlate

**PHP:** 8.2  
**Database:** PostgreSQL 14 or MySQL 8

### Demo Credentials

**Admin:** admin@example.com  
**Password:** secret

**User:** user@example.com  
**Password:** secret

### Locally Installation

- `cd boilerplate`
- `cp .env.example .env`
- Run `docker-compose up -d`
- Inside php container `docker-compose exec php bash`
- `composer install`
- `php artisan key:generate`
- `php artisan migrate:fresh --seed`
- `php artisan ide-helper:models -M`
- Inside node container `docker-compose run node bash`
- `yarn`
- `yarn dev`
- Run `docker-compose down && docker-compose up -d`
- Open in browser `http://localhost/`

If you've done it once, you've done it a million times. :)




