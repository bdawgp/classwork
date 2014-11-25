<?php
  return function() use($app){
    $dir = dirname(__FILE__);

    $ctrl = require($dir.'/bios.controller.php');

    // CREATE
    $app->get('/new', $ctrl->blank)->name('new_bio');
    $app->post('/', $ctrl->create);

    // READ
    $app->get('/', $ctrl->index)->name('bios');
    $app->get('/:id', $ctrl->show)->name('bio');
  };
