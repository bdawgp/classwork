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
