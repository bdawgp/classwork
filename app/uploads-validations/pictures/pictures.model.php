<?php

// id integer NOT NULL PRIMARY KEY AUTOINCREMENT,
// title varchar,
// file_path varchar,
// date_taken date,
// user_id integer

  class Picture extends ActiveRecord\Model {
    protected $file_type = '';

    static $validates_presence_of = array(
      array('title'),
      array('date_taken'),
      array('file_path')
    );

    public function save_file($file){
      $this->file_type = explode('/',$file->type,2)[0];
      if($this->file_type !== 'image') return;

      if(!is_dir('assets/pictures')) mkdir('assets/pictures');
      $ext = pathinfo($file->name, PATHINFO_EXTENSION);

      $hash = md5_file($file->tmp_name).time();
      $this->file_path = 'assets/pictures/'.$hash.'.'.$ext;
      move_uploaded_file($file->tmp_name,$this->file_path);
    }

    public function validate(){
      if($this->is_new_record() && $this->file_type !== 'image'){
        $this->errors->add('file_type', 'must be an image');
      }
    }
  }

  return 'Picture';
