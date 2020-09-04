-- Host: localhost
-- Creation: 03. Sep 2020 um 11:42

-----------------------------------------------------------

--get users in mysql
select host, user, password from mysql.user;

--calculate average grade of student
select u.firstname, u.lastname, round(sum(g.grade) / count(g.grade), 2) as average
  from tbl_grades as g
  inner join tbl_users as u on g.studentID = u.ID
  group by u.lastname
  order by u.lastname;

--tbl_grades inner join all fk
select u.firstname, u.lastname, s.subject, g.grade
  from tbl_grades as g
  inner join tbl_users as u on g.studentID = u.ID
  inner join tbl_subjects as s on g.subjectID = s.ID
  order by u.lastname;

--tbl_users inner join all fk
select g.name as usergroup, u.firstname, u.lastname, u.username, c.name as class
  from tbl_users as u
  inner join tbl_usergroups as g on u.groupID = g.ID
  left join tbl_classes as c on u.classID = c.ID
  order by g.name, u.lastname;

--tbl_lessons inner join all fk
select s.subject, l.hours, u.firstname, u.lastname, c.name as class
  from tbl_lessons as l
  inner join tbl_users as u on l.teacherID = u.ID
  inner join tbl_subjects as s on l.subjectID = s.ID
  inner join tbl_classes as c on l.classID = c.ID
  order by s.subject;