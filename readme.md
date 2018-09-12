This is test project for fetching and displaying data from markethot.ru.

# Installation
Run
```
docker-compose up -d 
```

When docker will be running, run
```
docker exec market.app php artisan init:app
```

# Fetching data
By default all data fetching automatically once every thirty minutes. To force update run this command
```
docker exec market.app php artisan fetch:data
```

History of all synchronizations can be found at `http://localhost/api/sync_history`


# Useful commands
Create dump
```
docker exec market.db /usr/bin/mysqldump -uroot -pmarket market > docker/db/backup.sql
```

Rebuild docker image
```
docker image build --file=./docker/app/Dockerfile --tag=dmitrylobanow/market_app .
docker push dmitrylobanow/market_app
```

Create index
```
php artisan elastic:create-index Market\\ElasticScout\\ProductIndexConfigurator
```

Install docker plugin
```
vagrant plugin install vagrant-docker-compose
```
