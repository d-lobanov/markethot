FROM php:7.2-fpm

WORKDIR /var/www

RUN apt-get update
RUN apt-get install -y --no-install-recommends \
        zlib1g-dev \
        git \
        gnupg \
        apt-transport-https \
        zip \
        unzip \
        cron

# Installing yarn
RUN apt-get remove -y cmdtest

RUN curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add -
RUN echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list

RUN curl -sL https://deb.nodesource.com/setup_10.x -o /tmp/nodesource_setup.sh
RUN bash /tmp/nodesource_setup.sh
RUN apt-get update
RUN apt-get install -y --no-install-recommends \
    yarn \
    nodejs \
    build-essential
# End installing yarn

RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install zip

# Set up cron
RUN printf "* * * * * cd /var/www && /usr/local/bin/php artisan schedule:run >> /var/log/cron.log 2>&1\n" >> /etc/cron.d/scheduler-cron
RUN chmod 0644 /etc/cron.d/scheduler-cron
RUN crontab /etc/cron.d/scheduler-cron
RUN touch /var/log/cron.log

CMD yarn install && php composer.phar install && cron && php-fpm
