#!/bin/bash

set -e

if [ "$2" ]; then
  echo 'Please encase your drush commands in quotations, for example:'
  echo './scripts/drush.sh "en mymodule -y"'
  exit 1;
fi

docker-compose exec web /bin/bash -c "drush $1"
