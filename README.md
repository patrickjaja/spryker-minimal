 - composer install --no-interaction
 
 
 # copy postgres database to local
 # - docker cp spryker-minimal-postgres:/var/lib/postgresql/data ../current/data/postgres
 
 # prepare rmq
 docker exec -i spryker-minimal-rabbitmq rabbitmqctl add_vhost /DE_development_zed
 docker exec -i spryker-minimal-rabbitmq rabbitmqctl add_user DE_development mate20mg
 docker exec -i spryker-minimal-rabbitmq rabbitmqctl set_user_tags DE_development administrator
 docker exec -i spryker-minimal-rabbitmq rabbitmqctl set_permissions -p /DE_development_zed DE_development ".*" ".*" ".*"
 
 docker exec -i spryker-minimal-rabbitmq rabbitmqctl add_user admin mate20mg
 docker exec -i spryker-minimal-rabbitmq rabbitmqctl set_user_tags admin administrator
 docker exec -i spryker-minimal-rabbitmq rabbitmqctl set_permissions -p /DE_development_zed admin ".*" ".*" ".*"
