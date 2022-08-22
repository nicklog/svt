ARG PHP_EXTENSIONS="pdo_mysql imagick gd intl bcmath"

FROM thecodingmachine/php:8.1-v4-apache-node14 as builder

COPY --chown=docker:docker . /var/www/html/

RUN composer install --no-dev --no-interaction --no-scripts --no-progress --classmap-authoritative --ignore-platform-reqs
RUN yarn install --force
RUN yarn build
RUN sudo rm -rf assets docker docs node_modules tests \
    .env.test .env.local.dist .gitignore composer-require-checker.json docker-compose.yml Makefile package.json \
    phpcs.xml phpstan.neon phpstan-baseline.neon phpunit.xml webpack.config.js .editorconfig README.md composer-unused.php rector.php

#RUN sudo mkdir -p /var/www/html/var/cache
#RUN sudo mkdir -p /var/www/html/var/log
#RUN sudo chmod -R 0777 /var/www/html/var

FROM thecodingmachine/php:8.1-v4-apache

COPY --from=builder /var/www/html /var/www/html

ENV TEMPLATE_PHP_INI="production"
ENV PHP_EXTENSIONS="pdo_mysql imagick gd intl bcmath"

ENV STARTUP_COMMAND_1="bin/console cache:clear" \
    STARTUP_COMMAND_2="bin/console cache:warmup" \
    STARTUP_COMMAND_3="bin/console doctrine:migrations:migrate --no-interaction" \
    STARTUP_COMMAND_4="bin/console assets:install public"

ENV APACHE_DOCUMENT_ROOT="public/"
#ENV APACHE_RUN_USER=www-data
#ENV APACHE_RUN_GROUP=www-data

VOLUME /var/www/html/
EXPOSE 80
