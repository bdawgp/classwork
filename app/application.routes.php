<?php
  return function() use($app){
    $app->get('/', function() use($app){
      $app->response->setBody('It works!');
    })->name('root');
  };
