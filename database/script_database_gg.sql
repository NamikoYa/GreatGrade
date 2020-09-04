-- Host: localhost
-- Creation: 03. Sep 2020 um 11:42

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-----------------------------------------------------------

--
-- database
--
create database db_greatgrade;
use db_greatgrade;

--
-- database user
--
create user 'GGUser'@'localhost' identified by 'GGPassword';
grant select, update, insert, delete on db_greatgrade.* TO GGUser@'localhost';
flush privileges;

--
-- table structures
--
create table tbl_usergroups (
  ID int not null auto_increment,
  name varchar(20),
  description varchar(255),
  primary key (ID)
);

create table tbl_classes (
  ID int not null auto_increment,
  name varchar(20),
  primary key (ID)
);

create table tbl_subjects (
  ID int not null auto_increment,
  subject varchar(20) not null,
  description varchar(255),
  primary key (ID)
);

create table tbl_users (
  ID int not null auto_increment,
  firstname varchar(40) not null,
  lastname varchar(40) not null,
  username varchar(40) not null,
  password varchar(255) not null,
  groupID int,
  classID int,
  primary key (ID),
  foreign key (groupID) references tbl_usergroups(ID),
  foreign key (classID) references tbl_classes(ID)
);

create table tbl_lessons (
  ID int not null auto_increment,
  subjectID int,
  hours int not null,
  teacherID int,
  classID int,
  primary key (ID),
  foreign key (subjectID) references tbl_subjects(ID),
  foreign key (teacherID) references tbl_users(ID),
  foreign key (classID) references tbl_classes(ID)
);

create table tbl_grades (
  ID int not null auto_increment,
  studentID int,
  subjectID int,
  grade decimal(3,2),
  primary key (ID),
  foreign key (studentID) references tbl_users(ID),
  foreign key (subjectID) references tbl_subjects(ID)
);

--
-- test data
--
insert into tbl_usergroups values
(null, 'administrator', 'all rights, create users'),
(null, 'teacher', 'add and edit grades'),
(null, 'student', 'view content');

insert into tbl_classes values
(null, 'IAP18A'),
(null, 'IBE18A'),
(null, 'ISY18A');

insert into tbl_subjects values
(null, 'Mathematics', 'advanced math, year 3 and 4'),
(null, 'English', 'C1'),
(null, 'Chemistry', 'atoms and stuff'),
(null, 'History', 'humans being silly');

insert into tbl_users values
(null, 'Sara', 'Roth', 'sara.roth', '$2y$10$CDGvKdQ/aeuvBr2WT7unb.I6ILyHTzL34GTKqS.wt4GwEz4WBeEYG', 1, null),
(null, 'Natascha', 'Wernli', 'natascha.wernli', '$2y$10$CDGvKdQ/aeuvBr2WT7unb.I6ILyHTzL34GTKqS.wt4GwEz4WBeEYG', 1, null),
(null, 'Daniel', 'Brodbeck', 'daniel.brodbeck', '$2y$10$CDGvKdQ/aeuvBr2WT7unb.I6ILyHTzL34GTKqS.wt4GwEz4WBeEYG', 1, null),
(null, 'Patty', 'Furniture', 'patty.furniture', '$2y$10$CDGvKdQ/aeuvBr2WT7unb.I6ILyHTzL34GTKqS.wt4GwEz4WBeEYG', 2, null),
(null, 'Toi', 'Story', 'toi.story', '$2y$10$CDGvKdQ/aeuvBr2WT7unb.I6ILyHTzL34GTKqS.wt4GwEz4WBeEYG', 2, null),
(null, 'Skye', 'Blue', 'skye.blue', '$2y$10$CDGvKdQ/aeuvBr2WT7unb.I6ILyHTzL34GTKqS.wt4GwEz4WBeEYG', 2, null),
(null, 'Ester', 'La Vista', 'ester.lavista', '$2y$10$CDGvKdQ/aeuvBr2WT7unb.I6ILyHTzL34GTKqS.wt4GwEz4WBeEYG', 2, null),
(null, 'Cesar', 'Salad', 'cesar.salad', '$2y$10$CDGvKdQ/aeuvBr2WT7unb.I6ILyHTzL34GTKqS.wt4GwEz4WBeEYG', 3, 1),
(null, 'Peet', 'Zaa', 'peet.zaa', '$2y$10$CDGvKdQ/aeuvBr2WT7unb.I6ILyHTzL34GTKqS.wt4GwEz4WBeEYG', 3, 1),
(null, 'Fran', 'Tick', 'fran.tick', '$2y$10$CDGvKdQ/aeuvBr2WT7unb.I6ILyHTzL34GTKqS.wt4GwEz4WBeEYG', 3, 1),
(null, 'Tess', 'Tickles', 'tess.tickles', '$2y$10$CDGvKdQ/aeuvBr2WT7unb.I6ILyHTzL34GTKqS.wt4GwEz4WBeEYG', 3, 2),
(null, 'Chris P.', 'Bacon', 'chrisp.bacon', '$2y$10$CDGvKdQ/aeuvBr2WT7unb.I6ILyHTzL34GTKqS.wt4GwEz4WBeEYG', 3, 2),
(null, 'Dustin', 'Trailblazer', 'dustin.trailblazer', '$2y$10$CDGvKdQ/aeuvBr2WT7unb.I6ILyHTzL34GTKqS.wt4GwEz4WBeEYG', 3, 2),
(null, 'Donald', 'Duck', 'donald.duck', '$2y$10$CDGvKdQ/aeuvBr2WT7unb.I6ILyHTzL34GTKqS.wt4GwEz4WBeEYG', 3, 3),
(null, 'Mickey', 'Mouse', 'mickey.mouse', '$2y$10$CDGvKdQ/aeuvBr2WT7unb.I6ILyHTzL34GTKqS.wt4GwEz4WBeEYG', 3, 3),
(null, 'Uri', 'Nalisis', 'uri.nalisis', '$2y$10$CDGvKdQ/aeuvBr2WT7unb.I6ILyHTzL34GTKqS.wt4GwEz4WBeEYG', 3, 3);

insert into tbl_lessons values
(null, 1, 48, 4, 1),
(null, 1, 48, 4, 2),
(null, 1, 48, 4, 3),
(null, 2, 24, 5, 1),
(null, 2, 24, 5, 2),
(null, 2, 24, 5, 3),
(null, 3, 48, 6, 1),
(null, 3, 48, 6, 2),
(null, 3, 48, 6, 3),
(null, 4, 24, 7, 1),
(null, 4, 24, 7, 2),
(null, 4, 24, 7, 3);

insert into tbl_grades values
(null, 8, 1, 3.40),
(null, 8, 2, 5.30),
(null, 8, 3, 4.70),
(null, 8, 4, 5.10),
(null, 9, 1, 5.80),
(null, 9, 2, 4.20),
(null, 9, 3, 2.60),
(null, 9, 4, 5.75),
(null, 10, 1, 4.75),
(null, 10, 2, 5.50),
(null, 10, 3, 5.25),
(null, 10, 4, 4.80),
(null, 11, 1, 6.00),
(null, 11, 2, 6.00),
(null, 11, 3, 6.00),
(null, 11, 4, 6.00),
(null, 12, 1, null),
(null, 12, 2, null),
(null, 12, 3, null),
(null, 12, 4, null),
(null, 13, 1, null),
(null, 13, 2, null),
(null, 13, 3, null),
(null, 13, 4, null),
(null, 14, 1, null),
(null, 14, 2, null),
(null, 14, 3, null),
(null, 14, 4, null),
(null, 15, 1, null),
(null, 15, 2, null),
(null, 15, 3, null),
(null, 15, 4, null),
(null, 16, 1, null),
(null, 16, 2, null),
(null, 16, 3, null),
(null, 16, 4, null);