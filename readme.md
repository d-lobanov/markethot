This is a test project for fetching and displaying data from markethot.ru.

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
By default all data fetching automatically once [every thirty minutes](/app/Console/Kernel.php#L28). To force update run this command
```
docker exec market.app php artisan fetch:data
```

History of all synchronizations can be found at `http://localhost/api/sync_history`

# Searching
This application uses ElasticSearch and ElasticSearch driver for Laravel Scout. Configuration can be found [here](/app/ElasticScout).
Scout package updates and deletes data from ElasticSearch in case if searchable model was updated/deleted. If data was added into database directly, import this data to elasticsearch using those commands 
```
docker exec market.app php artisan scout:flush Market\\Models\\Product
docker exec market.app php artisan scout:import Market\\Models\\Product
```

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
