CREATE TABLE hobbits (
  id integer NOT NULL PRIMARY KEY AUTOINCREMENT,
  name varchar(200)
);


CREATE TABLE users (
  id integer NOT NULL PRIMARY KEY AUTOINCREMENT,
  name varchar,
  email varchar NOT NULL UNIQUE,
  password_digest varchar
);

CREATE TABLE pictures (
  id integer NOT NULL PRIMARY KEY AUTOINCREMENT,
  title varchar,
  file_path varchar,
  date_taken varchar
);

CREATE TABLE bios (
  id integer NOT NULL PRIMARY KEY AUTOINCREMENT,
  name varchar,
  birthday varchar,
  content text
);
