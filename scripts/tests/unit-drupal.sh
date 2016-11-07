#!/bin/bash
#
# Runs the unit tests; these are the simplest tests available to Drupal.
#
set -e

docker-compose exec web /bin/bash -c 'cd /var/www/html && \
  php ./core/scripts/run-tests.sh \
  --url http://localhost \
  --dburl mysql://drupal:drupal@database:3306/drupal \
  --verbose \
  drupal8tests'
