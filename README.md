 # How to install
 - .\docker\docker-compose up -d
 - .\docker\rmq.sh
 - docker exec -it spryker-minimal-php composer install --no-interaction
 - docker exec -it spryker-minimal-php vendor/bin/install
 - change hosts file and add 127.0.0.1 zed.de.suite.local and 127.0.0.1 de.suite.local
 
 # Helpers
 ## copy postgres database to local
 - docker cp spryker-minimal-postgres:/var/lib/postgresql/data ../current/data/postgres
 