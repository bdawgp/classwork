<?php
  $config = ActiveRecord\Config::instance();

  $config->set_connections(array(
    'primary' => 'sqlite://primary.db'
  ));
  $config->set_default_connection('primary');
