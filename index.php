<?php
  if($_SERVER['SERVER_NAME'] == 'localhost'):
    error_reporting(E_ALL ^ E_NOTICE);
    ini_set('display_errors',1);
  endif;

  require_once(dirname(__FILE__).'/app/index.php');
