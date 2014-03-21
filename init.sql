create table user (
  email varchar(100) primary key,
  name varchar(20) not null,
  passwd char(50) not null,
  phone varchar(30),
  is_phone_private boolean,
  location varchar(140),
  is_location_private boolean,
  intro varchar(140),
  is_intro_private boolean
);

create table date (
  id int primary key,
  title varchar(140) not null,
  useremail varchar(100) not null,
  begintime datetime not null,
  endtime datetime,
  location varchar(140),
  bulletin varchar(140),
  foreign key(useremail) references user(email),
  index (useremail)
);

create table datemember (
  id int not null,
  useremail varchar(100) not null,
  foreign key(id) references date(id)
);

create table datecomment (
  id int not null,
  useremail varchar(100) not null,
  comment varchar(140) not null,
  foreign key(id) references date(id)
);
