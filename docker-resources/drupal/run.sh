#!/bin/bash
#
# This script is run when the Drupal docker container is ready. It prepares
# an environment for development or testing, which contains a full Drupal
# 8 installation with a running website and the drupal8tests module enabled.
#
set -e

# Install Drupal.
# In order to prevent the "unable to send mail" error, we are including
# the "install_configure_form" line, which itself forces us to include the
# profile (standard), which would otherwise be optional. See the output
# of "drush help si" from where this is taken.
cd /var/www/html && \
  drush si \
  --account-name=admin \
  --account-pass=admin \
  -y --db-url=mysql://drupal:drupal@database:3306/drupal \
  standard \
  install_configure_form.update_status_module='array(FALSE,FALSE)'

# Enable our module, drupal8tests.
cd /var/www/html && \
  drush en drupal8tests devel simpletest -y && \
  chown -R www-data:www-data ./sites/default/files && \
  drush cache-rebuild
