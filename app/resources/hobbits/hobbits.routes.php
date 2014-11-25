<?php
  return function() use($app){
    $dir = dirname(__FILE__);

    $ctrl = require($dir.'/hobbits.controller.php');

    // CREATE
    $app->post('/', $ctrl->create);

    // READ
    $app->get('/', $ctrl->index);
    $app->get('/:id', $ctrl->show);

    // UPDATE
    $app->post('/:id', $ctrl->update); // Use post because put and patch params aren't being parsed

    // DELETE
    $app->delete('/:id', $ctrl->destroy);
  };
