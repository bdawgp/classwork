<?php
  $dir = dirname(__FILE__);

  // Auto-load scripts
  $autoload = require($dir.'/../vendor/autoload.php');

  // Initialize ActiveRecord and database
  require($dir.'/config/initDatabase.php');
  require($dir.'/config/database.php');

  // Initialize App
  $app = new \Slim\Slim();

  // include routes
  $app->group('', require($dir.'/application.routes.php'));
  $app->group('/resources', require($dir.'/resources/resources.routes.php'));

  // Launch app listener
  $app->run();
