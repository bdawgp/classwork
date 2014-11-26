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

    public function validate(){
      if(!strtotime($this->birthday)):
        $this->errors->add('birthday', 'must be a valid date');
      endif;
    }
  }

  return 'Bio';
