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

    ob_start();
    require($dir.'/views/blank.php');
    $render = ob_get_clean();

    require('views/layout.php');
  };

  // READ
  $ctrl->index = function() use($app,$dir){
    $hobbits = Hobbit::find('all');

    $col = (in_array($_GET['col'],array('id','name'))) ? $_GET['col'] : 'id';
    $asc = ($_GET['dir'] == 'desc') ? -1 : 1;

    usort($hobbits, function($a, $b) use($col,$asc){
      if($a->$col == $b->$col) return 0;

      return ($a->$col < $b->$col ? -1 : 1)*$asc;
    });

    ob_start();
    require($dir.'/views/index.php');
    $render = ob_get_clean();

    require('views/layout.php');
  };

  $ctrl->show = function($id) use($app,$dir,$ctrl){
    $hobbit = call_user_func($ctrl->getHobbit,$id);
    if(!$hobbit) return;

    ob_start();
    require($dir.'/views/show.php');
    $render = ob_get_clean();

    require('views/layout.php');
  };

  // UPDATE
  $ctrl->update = function($id) use($app,$ctrl){
    $data = $app->request->params('hobbit');

    $hobbit = call_user_func($ctrl->getHobbit,$id);
    if(!$hobbit) return;

    $hobbit->set_attributes($data);
    $hobbit->save();

    $app->redirect($app->urlFor('hobbit',array('id'=>$id)));
  };

  $ctrl->edit = function($id) use($app,$dir,$ctrl){
    $hobbit = call_user_func($ctrl->getHobbit,$id);
    if(!$hobbit) return;

    ob_start();
    require($dir.'/views/edit.php');
    $render = ob_get_clean();

    require('views/layout.php');
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
      $app->redirect($app->urlFor('hobbits'));
    }

    return $hobbit;
  };

  return $ctrl;
