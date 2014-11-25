<?php
  $dir = dirname(__FILE__);
  require_once($dir.'/hobbits.model.php');

  if(!class_exists('HobbitsController')){
    class HobbitsController extends stdClass {}
  }
  $ctrl = new HobbitsController;

  // CREATE
  $ctrl->create = function() use($app){
    $data = $app->request->params('hobbit');

    $hobbit = Hobbit::create($data);

    $app->redirect($app->urlFor('hobbit',array('id'=>$hobbit->id)));
  };

  $ctrl->blank = function() use($app,$dir){
    $hobbit = new Hobbit();

    require($dir.'/views/blank.php');
  };

  // READ
  $ctrl->index = function() use($app,$dir){
    $hobbits = Hobbit::find('all');

    require($dir.'/views/index.php');
  };

  $ctrl->show = function($id) use($app,$dir,$ctrl){
    $hobbit = call_user_func($ctrl->getHobbit,$id);
    if(!$hobbit){
      $app->redirect($app->urlFor('hobbits'));
      return;
    }

    require($dir.'/views/show.php');
  };

  // UPDATE
  $ctrl->update = function($id) use($app,$ctrl){
    $data = $app->request->params('hobbit');

    $hobbit = call_user_func($ctrl->getHobbit,$id);
    if(!$hobbit){
      $app->redirect($app->urlFor('hobbits'));
      return;
    }

    $hobbit->set_attributes($data);
    $hobbit->save();

    $app->redirect($app->urlFor('hobbit',array('id'=>$id)));
  };

  $ctrl->edit = function($id) use($app,$dir,$ctrl){
    $hobbit = call_user_func($ctrl->getHobbit,$id);
    if(!$hobbit){
      $app->redirect($app->urlFor('hobbits'));
      return;
    }

    require($dir.'/views/edit.php');
  };

  // DELETE
  $ctrl->destroy = function($id) use($app,$ctrl){
    $hobbit = call_user_func($ctrl->getHobbit,$id);
    if(!$hobbit) return;

    $hobbit->delete();

    $app->redirect($app->urlFor('hobbits'));
  };

  $ctrl->getHobbit = function($id) use($app){
    $hobbit = Hobbit::find_by_id($id);

    if(!$hobbit){
      $app->response->setStatus(404);
      $app->response->finalize();
    }

    return $hobbit;
  };

  return $ctrl;
