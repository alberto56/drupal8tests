#!/bin/bash
set -e

./scripts/destroy.sh
docker-compose build
docker-compose up -d
docker-compose exec web /run.sh

echo ''
echo 'If all went well you can now access your site with username admin and:'
echo 'password admin at:'
echo ''
echo ' => '$(./scripts/uli.sh)
echo ''
