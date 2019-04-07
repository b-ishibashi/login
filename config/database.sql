create database login1;

create user root@localhost

grant all on login1.* to root@localhost;

use login1;

drop table users;

create table if not exists users(
  id int not null auto_increment primary key,
  email varchar(255) unique,
  password varchar (255),
  created datetime,
  modified datetime
);
