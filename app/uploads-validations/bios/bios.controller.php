<?php

  $dir = dirname(__FILE__);
  require_once($dir.'/bios.model.php');

  if(!class_exists('BiosController')){
    class BiosController extends stdClass {}
  }
  $ctrl = new BiosController;

  // CREATE
  $ctrl->blank = function() use($app,$dir){
    $bio = new Bio((array)$app->request->params('bio'));

    $error = $app->request->get('error');

    ob_start();
    include(dirname($dir).'/views/_nav.php');
    include($dir.'/views/blank.php');
    $render = ob_get_clean();

    include('views/layout.php');
  };

  $ctrl->create = function() use($app){
    $data = $app->request->params('bio');

    $bio = Bio::create($data);

    if($bio->is_valid()){
      $app->redirect($app->urlFor('bio',array('id' => $bio->id)));
    }else{
      $errors = implode('. ',$bio->errors->full_messages());

      $query = http_build_query(array(
        'error' => $errors,
        'bio' => $bio->to_array()
      ));

      $app->redirect($app->urlFor('new_bio').'?'.$query);
    }
  };

  // READ
  $ctrl->index = function() use($app,$dir){
    $bios = Bio::find('all');

    ob_start();
    include(dirname($dir).'/views/_nav.php');
    include($dir.'/views/index.php');
    $render = ob_get_clean();

    include('views/layout.php');
  };

  $ctrl->show = function($id) use($app,$dir,$ctrl){
    $bio = call_user_func($ctrl->getBio,$id);
    if(!$bio) return;

    ob_start();
    include(dirname($dir).'/views/_nav.php');
    include($dir.'/views/show.php');
    $render = ob_get_clean();

    include('views/layout.php');
  };

  $ctrl->getBio = function($id) use($app){
    $bio = Bio::find_by_id($id);

    if(!$bio){
      $app->response->setStatus(404);
      $app->redirect($app->urlFor('bios'));
    }

    return $bio;
  };

  return $ctrl;
