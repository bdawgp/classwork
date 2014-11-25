<?php
  return function() use($app){
    $dir = dirname(__FILE__);

    $ctrl = require($dir.'/users.controller.php');

    $app->get('/',$ctrl->index)->name('users_home');

    $app->get('/login',$ctrl->loginForm)->name('users_login');
    $app->post('/login',$ctrl->login);
    $app->delete('/login',$ctrl->logout);

    $app->get('/register',$ctrl->signupForm)->name('users_register');
    $app->post('/register',$ctrl->signup);
  };
