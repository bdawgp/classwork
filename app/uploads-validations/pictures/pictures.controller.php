<?php

  $dir = dirname(__FILE__);
  require_once($dir.'/pictures.model.php');

  if(!class_exists('PicturesController')){
    class PicturesController extends stdClass {}
  }
  $ctrl = new PicturesController;

  // CREATE
  $ctrl->blank = function() use($app,$dir){
    $picture = new Picture((array)$app->request->params('picture'));

    $error = $app->request->get('error');

    ob_start();
    include(dirname($dir).'/views/_nav.php');
    include($dir.'/views/blank.php');
    $render = ob_get_clean();

    include('views/layout.php');
  };

  $ctrl->create = function() use($app){
    $data = $app->request->params('picture');

    $picture = new Picture($data);

    $file = (object)$_FILES['image'];
    $picture->save_file($file);

    $picture->save();

    if($picture->is_valid()){
      $app->redirect($app->urlFor('picture',array('id' => $picture->id)));
    }else{
      if($picture->file_path) unlink($picture->file_path);

      $errors = implode('. ',$picture->errors->full_messages());

      $query = http_build_query(array(
        'error' => $errors,
        'picture' => $picture->to_array()
      ));

      $app->redirect($app->urlFor('new_picture').'?'.$query);
    }
  };

  // READ
  $ctrl->index = function() use($app,$dir){
    $pictures = Picture::find('all');

    ob_start();
    include(dirname($dir).'/views/_nav.php');
    include($dir.'/views/index.php');
    $render = ob_get_clean();

    include('views/layout.php');
  };

  $ctrl->show = function($id) use($app,$dir,$ctrl){
    $picture = call_user_func($ctrl->getPicture,$id);
    if(!$picture) return;

    ob_start();
    include(dirname($dir).'/views/_nav.php');
    include($dir.'/views/show.php');
    $render = ob_get_clean();

    include('views/layout.php');
  };

  // UPDATE
  $ctrl->edit = function($id) use($app,$dir,$ctrl){
    $picture = call_user_func($ctrl->getPicture,$id);
    if(!$picture) return;

    ob_start();
    include(dirname($dir).'/views/_nav.php');
    include($dir.'/views/edit.php');
    $render = ob_get_clean();

    include('views/layout.php');
  };

  $ctrl->update = function($id) use($app,$ctrl){
    $picture = call_user_func($ctrl->getPicture,$id);
    if(!$picture) return;

    $data = $app->request->params('picture');
    $picture->update_attributes($data);

    if($picture->is_valid()){
      $app->redirect($app->urlFor('picture',array('id' => $picture->id)));
    }else{
      $errors = implode('. ',$picture->errors->full_messages());

      $query = http_build_query(array(
        'error' => $errors,
        'picture' => $picture->to_array()
      ));

      $app->redirect($app->urlFor('new_picture').'?'.$query);
    }
  };


  // DELETE
  $ctrl->destroy = function($id) use($app,$ctrl){
    $picture = call_user_func($ctrl->getPicture,$id);
    if(!$picture) return;

    $picture->delete();

    $app->redirect($app->urlFor('pictures'));
  };

  $ctrl->getPicture = function($id) use($app){
    $picture = Picture::find_by_id($id);

    if(!$picture){
      $app->response->setStatus(404);
      $app->redirect($app->urlFor('pictures'));
    }

    return $picture;
  };

  return $ctrl;
