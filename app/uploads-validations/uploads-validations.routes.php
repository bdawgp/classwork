<?php
  return function() use($app){
    $dir = dirname(__FILE__);

    $app->get('', function() use($app){
      $app->redirect($app->urlFor('bios'));
    });
    $app->group('/bios', require($dir.'/bios/bios.routes.php'));
  };
