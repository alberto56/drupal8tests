<?php

/**
 * Function
 *
 * Description
 *
 * @param $
 *   Drupal\drupal8tests\Form\Drupal8TestsForm
 *
 * @return
 *
 * @throws Exception
 */
spl_autoload_register(function($class_name) {
  if (strpos($class_name, 'drupal8tests') === FALSE) {
    return;
  }
  try {
    $parts = explode('\\', $class_name);
    // remove "Drupal" from the beginning of the class name
    array_shift($parts);
    $module = array_shift($parts);
    $path = 'src/' . implode('/', $parts);
    require_once($path . '.php');
  }
  catch (Exception $e) {
    throw new \Exception('Autoloader at ' . __FILE__ . ' was asked by ' . realistic_dummy_content_api_calling_function(4) . ' to autoload the class ' . $class_name . ' but found the following error: ' . $e->getMessage());
  }
});
