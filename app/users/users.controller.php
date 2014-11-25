<?php

  $dir = dirname(__FILE__);
  require_once($dir.'/users.model.php');

  if(!class_exists('UsersController')){
    class UsersController extends stdClass {}
  }
  $ctrl = new UsersController;

  $ctrl->index = function() use($app,$dir){
    if(!$_SESSION['user']){
      $app->redirect($app->urlFor('users_login').'?mustLogin');
      return;
    }

    $user = User::find_by_id($_SESSION['user']);

    ob_start();
    require($dir.'/views/index.php');
    $render = ob_get_clean();

    require('views/layout.php');
  };

  $ctrl->loginForm = function() use($app,$dir){
    if($_SESSION['user']){
      $app->redirect($app->urlFor('users_home'));
      return;
    }

    ob_start();
    require($dir.'/views/loginForm.php');
    $render = ob_get_clean();

    require('views/layout.php');
  };
  $ctrl->login = function() use($app){
    if($_SESSION['user']){
      $app->redirect($app->urlFor('users_home'));
      return;
    }
    $data = $app->request->params('login');

    $user = User::find_by_email($data['email']);

    if($user && password_verify($data['password'],$user->password_digest)){
      $_SESSION['user'] = $user->id;
      $app->redirect($app->urlFor('users_home').'?success');
    }else{
      $app->redirect($app->urlFor('users_login').'?invalid');
    }
  };
  $ctrl->logout = function() use($app){
    $_SESSION['user'] = null;
    $app->redirect($app->urlFor('users_login'));
  };

  $ctrl->signupForm = function() use($app,$dir){
    if($_SESSION['user']){
      $app->redirect($app->urlFor('users_home'));
      return;
    }

    ob_start();
    require($dir.'/views/signupForm.php');
    $render = ob_get_clean();

    require('views/layout.php');
  };
  $ctrl->signup = function() use($app){
    $data = $app->request->params('user');

    $data['password_digest'] = password_hash($data['password'],PASSWORD_BCRYPT);
    unset($data['password']);

    $user = User::create($data);

    if($user){
      $_SESSION['user'] = $user->id;
      $app->redirect($app->urlFor('users_home'));
    }else{
      $app->redirect($app->urlFor('users_register'));
    }
  };

  return $ctrl;
