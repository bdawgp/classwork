<?php

// id integer NOT NULL PRIMARY KEY AUTOINCREMENT,
// name varchar,
// birthday varchar,
// content text

  class Bio extends ActiveRecord\Model {
    static $validates_presence_of = array(
      array('name'),
      array('birthday'),
      array('content')
    );
  }

  return 'Bio';
