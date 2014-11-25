<?php
  if($_REQUEST['resetdb']){ unlink('primary.db'); }
  if(file_exists('primary.db')){ return; }

  touch('primary.db');

  $db = new SQLite3('primary.db');

  $sql = file_get_contents(dirname(__FILE__).'/primary.sql');

  if(!$db->exec($sql)){
    exit('Could not seed database: '.$db->lastErrorMsg());
  }
