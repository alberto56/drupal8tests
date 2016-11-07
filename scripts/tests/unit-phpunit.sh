#!/bin/bash
#
# Runs the unit tests; these are the simplest tests available to Drupal.
#
set -e

docker run -ti \
  -v "$(pwd)"/src:/app/src \
  -v "$(pwd)"/tests/src/PHPUnit:/app/tests \
  -v "$(pwd)"/docker-resources/phpunit/autoload.php:/app/autoload.php \
  -v "$(pwd)"/docker-resources/phpunit/phpunit.xml:/app/phpunit.xml \
  phpunit/phpunit \
  --group drupal8tests .
