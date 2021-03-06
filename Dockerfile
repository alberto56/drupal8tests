FROM drupal:8

RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer
RUN composer global require drush/drush:8
RUN ln -s /root/.composer/vendor/drush/drush/drush /bin/drush

RUN apt-get update && apt-get upgrade -y
RUN apt-get install -y mysql-client

ADD docker-resources/run.sh /run.sh

EXPOSE 80
