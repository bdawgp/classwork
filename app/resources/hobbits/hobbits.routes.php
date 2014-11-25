<?php
  return function() use($app){
    $dir = dirname(__FILE__);

    $ctrl = require($dir.'/hobbits.controller.php');

    // CREATE
    $app->get('/new', $ctrl->blank)->name('new_hobbit');
    $app->post('/', $ctrl->create);

    // READ
    $app->get('/', $ctrl->index)->name('hobbits');
    $app->get('/:id', $ctrl->show)->name('hobbit');

    // UPDATE
    $app->get('/:id/edit', $ctrl->edit)->name('edit_hobbit');
    $app->post('/:id', $ctrl->update); // Use post because put and patch params aren't being parsed

    // DELETE
    $app->delete('/:id', $ctrl->destroy);
  };
