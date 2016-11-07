#!/bin/bash

set -e

./scripts/tests/unit-phpunit.sh
./scripts/create.sh
./scripts/tests/unit-drupal.sh
