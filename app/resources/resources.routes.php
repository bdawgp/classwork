<?php
  return function() use($app){
    $dir = dirname(__FILE__);

    $app->group('', require($dir.'/hobbits/hobbits.routes.php'));
  };
