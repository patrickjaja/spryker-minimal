 # spryker-minimal
 Spryker starter kit to bootstrap applications with minimal effort.
 Function scope with UI:
 - Customer
 - Navigation
 - User
 - CMS
 - Glossary (l8n)

 # How to install
 - cd docker
 - PROJECT_NAME=spryker-minimal docker-compose up -d
 - ./rmq.sh
 - docker exec -it spryker-minimal-php composer install --no-interaction
 - docker exec -it spryker-minimal-php vendor/bin/install
 - change hosts file and add 127.0.0.1 zed.de.suite.local and 127.0.0.1 de.suite.local
 
 # URLS
 - http://zed.de.suite.local/ admin@spryker.com / change123
 - http://de.suite.local/
 
 # Build app image locally
 - docker build ./docker -t spryker-minimal-php
 
 # update modules
 - git submodule foreach git pull origin master