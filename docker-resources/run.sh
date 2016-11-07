#!/bin/bash
set -e

cd /var/www/html && \
  drush si \
  --account-name=admin \
  --account-pass=admin \
  -y --db-url=mysql://drupal:drupal@database:3306/drupal \
  standard \
  install_configure_form.update_status_module='array(FALSE,FALSE)'

cd /var/www/html && \
  drush en drupal8tests devel simpletest -y && \
  chown -R www-data:www-data ./sites/default/files && \
  drush cache-rebuild
