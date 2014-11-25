<?php
  require_once(dirname(__FILE__).'/hobbits.model.php');

  if(!class_exists('HobbitsController')){
    class HobbitsController extends stdClass {}
  }
  $ctrl = new HobbitsController;

  // CREATE
  $ctrl->create = function() use($app){
    $data = $app->request->params('hobbit');

    $hobbit = Hobbit::create($data);

    $app->response->setBody($hobbit->to_json());
  };

  // READ
  $ctrl->index = function() use($app){
    $hobbits = array_map(function($hobbit){
      return $hobbit->to_array();
    }, Hobbit::find('all'));

    $app->response->setBody(json_encode($hobbits));
  };

  $ctrl->show = function($id) use($app){
    $hobbit = Hobbit::find_by_id($id);

    if($hobbit){
      $app->response->write($hobbit->to_json());
    }else{
      $app->response->setStatus(404);
    }
  };

  // UPDATE
  $ctrl->update = function($id) use($app){
    $data = $app->request->params('hobbit');

    $hobbit = Hobbit::find_by_id($id);

    if($hobbit){
      $hobbit->set_attributes($data);
      $hobbit->save();

      $app->response->write($hobbit->to_json());
    }else{
      $app->response->setStatus(404);
    }
  };

  // DELETE
  $ctrl->destroy = function($id) use($app){
    $hobbit = Hobbit::find_by_id($id);

    if($hobbit){
      $hobbit->delete();

      $app->response->setStatus(204);
    }else{
      $app->response->setStatus(404);
    }
  };

  return $ctrl;
