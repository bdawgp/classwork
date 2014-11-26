<?php
  return function() use($app){
    $dir = dirname(__FILE__);

    $ctrl = require($dir.'/pictures.controller.php');

    // CREATE
    $app->get('/new', $ctrl->blank)->name('new_picture');
    $app->post('/', $ctrl->create);

    // READ
    $app->get('/', $ctrl->index)->name('pictures');
    $app->get('/:id', $ctrl->show)->name('picture');

    // UPDATE
    $app->get('/:id/edit', $ctrl->edit)->name('edit_picture');
    $app->post('/:id', $ctrl->update);

    // DELETE
    $app->delete('/:id', $ctrl->destroy);
  };
