create database labs;

use labs;

create table teacher(
	id int not null unique,
	teacher_name varchar(50) not null unique,
	teacher_pass varchar(70) not null,
	levels varchar(20) not null,
	email varchar(40) default "<-- no email provided -->",
	primary key(id)
);

create table class(
	id int not null auto_increment unique,
	class_name varchar(6) not null unique,
	class_teacher int not null unique,
	primary key(id),
	foreign key (class_teacher) references teacher(id)
);

create table student(
	id int not null unique,
	student_name varchar(50) not null unique,
	class_id int not null,
	primary key(id),
	foreign key (class_id) references class(id)
);

create table item(
	id int not null auto_increment unique,
	item_name varchar(50) not null,
	lab_location int not null,
	specs varchar(100) default '',
	quantity int default 0,
	lab varchar(1) not null default "p",
	primary key(id)
);

create table student_checkout(
	id int auto_increment not null unique,
	student_id int not null,
	item_id int not null,
	quantity int not null,
	returned int not null default 0,
	checkout_date date default now(),
	lab varchar(1) not null default "p",
	returned_date date,
	primary key(id),
	foreign key (student_id) references student(id),
	foreign key (item_id) references item(id)
);

create table purchase_request(
	id int not null auto_increment unique,
	teacher_id int not null,
	item_name varchar(50) not null,
	quantity_ordered int not null,
	quantity_received int,
	specs varchar(100),
	date_ordered datetime not null default now(),
	arrived bit not null,
	date_arrived datetime not null default now(),
	comments varchar(100),
	bill_code varchar(10) default "<No Bill>",
	lab varchar(1) not null default "p",
	primary key(id),
	foreign key (teacher_id) references teacher(id)
);

create table lab_transaction(
	id int not null unique auto_increment,
	from_lab varchar(1) not null,
	item_name varchar(50) not null,
	quantity int not null,
	specs varchar(100),
	lab varchar(20) not null,
	date_arrived datetime not null default now(),
	comments varchar(100),
	bill_code varchar(10) default "<No Bill>",
	primary key(id)
);

create table dept_transaction(
	id int not null unique auto_increment,
	from_lab varchar(1) not null,
	item_name varchar(50) not null,
	quantity int not null,
	specs varchar(100),
	to_lab varchar(20) not null,
	date_arrived datetime not null default now(),
	comments varchar(100),
	bill_code varchar(10) default "<No Bill>",
	primary key(id)
);

create table lab_booking(
	id int not null auto_increment,
	booked_date date,
	booked_time varchar(15),
	teacher_id int,
	class_id int,
	lab varchar(1) default "p",
	primary key (id),
	foreign key (teacher_id) references teacher(id),
	foreign key (class_id) references class(id)
);

insert into teacher(id, teacher_name, teacher_pass, levels) values (1, 'abhinav', '9992', 0);
insert into teacher(id, teacher_name, teacher_pass, levels) values (2, 'arjun', '9151', 0);
insert into teacher(id, teacher_name, teacher_pass, levels) values (3, 'c', '6512', 2);
insert into teacher(id, teacher_name, teacher_pass, levels) values (4, 'd', '1161', 2);
insert into teacher(id, teacher_name, teacher_pass, levels) values (5, 'e', '9987', 2);
insert into teacher(id, teacher_name, teacher_pass, levels) values (6, 'f', '1572', 2);
insert into teacher(id, teacher_name, teacher_pass, levels) values (7, 'g', '3950', 2);
insert into teacher(id, teacher_name, teacher_pass, levels) values (8, 'h', '9500', 2);
insert into teacher(id, teacher_name, teacher_pass, levels) values (9, 'i', '2950', 2);
insert into teacher(id, teacher_name, teacher_pass, levels) values (10, 'j', '5014', 2);
insert into teacher(id, teacher_name, teacher_pass, levels) values (11, 'k', '4056', 2);
insert into teacher(id, teacher_name, teacher_pass, levels) values (12, 'l', '4716', 2);
insert into teacher(id, teacher_name, teacher_pass, levels) values (13, 'm', '6312', 2);
insert into teacher(id, teacher_name, teacher_pass, levels) values (14, 'n', '9726', 2);
insert into teacher(id, teacher_name, teacher_pass, levels) values (15, 'o', '2123', 2);
insert into teacher(id, teacher_name, teacher_pass, levels) values (16, 'p', '9781', 2);
insert into teacher(id, teacher_name, teacher_pass, levels) values (17, 'q', '1061', 2);
insert into teacher(id, teacher_name, teacher_pass, levels) values (18, 'r', '5093', 2);
insert into teacher(id, teacher_name, teacher_pass, levels) values (19, 's', '2174', 2);
insert into teacher(id, teacher_name, teacher_pass, levels) values (20, 't', '7392', 2);
insert into teacher(id, teacher_name, teacher_pass, levels) values (21, 'u', '1961', 2);
insert into teacher(id, teacher_name, teacher_pass, levels) values (22, 'v', '6302', 2);
insert into teacher(id, teacher_name, teacher_pass, levels) values (23, 'w', '1174', 2);
insert into teacher(id, teacher_name, teacher_pass, levels) values (24, 'x', '2852', 2);
insert into teacher(id, teacher_name, teacher_pass, levels) values (25, 'y', '3290', 2);
insert into teacher(id, teacher_name, teacher_pass, levels) values (26, 'z', '713', 2);

insert into class(class_name, class_teacher) values ('8A', 3);
insert into class(class_name, class_teacher) values ('8B', 16);
insert into class(class_name, class_teacher) values ('9A', 24);
insert into class(class_name, class_teacher) values ('9B', 26);
insert into class(class_name, class_teacher) values ('10A', 25);
insert into class(class_name, class_teacher) values ('10B', 11);
insert into class(class_name, class_teacher) values ('11', 1);
insert into class(class_name, class_teacher) values ('12', 18);
insert into class(class_name, class_teacher) values ('13', 20);

insert into item (item_name, quantity) values ('lol', 497);
insert into item (item_name, quantity) values ('sar', 738);
insert into item (item_name, quantity) values ('wfg', 127);
insert into item (item_name, quantity) values ('sdgt', 871);
insert into item (item_name, quantity) values ('wfr', 870);
insert into item (item_name, quantity) values ('qfa', 381);
insert into item (item_name, quantity) values ('gae', 669);
insert into item (item_name, quantity) values ('tw', 980);
insert into item (item_name, quantity) values ('SH', 359);
insert into item (item_name, quantity) values ('WEF', 888);
insert into item (item_name, quantity) values ('WAETG', 858);
insert into item (item_name, quantity) values ('EA', 781);
insert into item (item_name, quantity) values ('fae', 887);
insert into item (item_name, quantity) values ('WEGT', 65);
insert into item (item_name, quantity) values ('w', 742);
insert into item (item_name, quantity) values ('fm', 268);
insert into item (item_name, quantity) values ('wdf', 624);
insert into item (item_name, quantity) values ('fq', 316);
insert into item (item_name, quantity) values ('h', 136);
insert into item (item_name, quantity) values ('gre', 982);
insert into item (item_name, quantity) values ('tg', 399);
insert into item (item_name, quantity) values ('sergh', 187);
insert into item (item_name, quantity) values ('rshyrt', 555);

INSERT INTO STUDENT (id, class_id, student_name) VALUES (2012029,7,"Aakanksha Patil");
INSERT INTO STUDENT (id, class_id, student_name) VALUES (2014029,9,"Aakhashini C.N.");
INSERT INTO STUDENT (id, class_id, student_name) VALUES (2018061,8,"Aarushi N C");
INSERT INTO STUDENT (id, class_id, student_name) VALUES (2018057,8,"Aasritha Edara");
INSERT INTO STUDENT (id, class_id, student_name) VALUES (601,8,"Abhinav Dinesh Srivatsa");
INSERT INTO STUDENT (id, class_id, student_name) VALUES (770,7,"Adhavan J R");
INSERT INTO STUDENT (id, class_id, student_name) VALUES (2013051,1,"Adhith S");
INSERT INTO STUDENT (id, class_id, student_name) VALUES (702,4,"Aditi Srinivas Iyer");
INSERT INTO STUDENT (id, class_id, student_name) VALUES (2014023,8,"Aditya Ilinani");
INSERT INTO STUDENT (id, class_id, student_name) VALUES (2018052,8,"Aditya Soni");
INSERT INTO STUDENT (id, class_id, student_name) VALUES (2019027,1,"Aishaanya Prasoon Joshi");
INSERT INTO STUDENT (id, class_id, student_name) VALUES (2019016,1,"Aiyana Adhir Varma");
INSERT INTO STUDENT (id, class_id, student_name) VALUES (7923,2,"Ajith Krishna Reddy");
INSERT INTO STUDENT (id, class_id, student_name) VALUES (2014025,9,"Akash Iyer");
INSERT INTO STUDENT (id, class_id, student_name) VALUES (2017019,5,"Allen Romi");
INSERT INTO STUDENT (id, class_id, student_name) VALUES (2018037,4,"Almas Taneja");
INSERT INTO STUDENT (id, class_id, student_name) VALUES (2014022,8,"Amartya Ilinani");
INSERT INTO STUDENT (id, class_id, student_name) VALUES (2015034,8,"Amitha Mohan Chandran");
INSERT INTO STUDENT (id, class_id, student_name) VALUES (2014027,9,"Anahita Belliraj");
INSERT INTO STUDENT (id, class_id, student_name) VALUES (2017020,5,"Anand Shankar Hariharan");
INSERT INTO STUDENT (id, class_id, student_name) VALUES (2014026,9,"Ananiya Belliraj");
INSERT INTO STUDENT (id, class_id, student_name) VALUES (2019038,7,"Ananya Anirudh Mohta");
INSERT INTO STUDENT (id, class_id, student_name) VALUES (2015068,2,"Ananya Rakheja");
INSERT INTO STUDENT (id, class_id, student_name) VALUES (2017027,6,"Aniruddh Raghavan");
INSERT INTO STUDENT (id, class_id, student_name) VALUES (2018054,8,"Anirudh A.V");
INSERT INTO STUDENT (id, class_id, student_name) VALUES (2015039,8,"Anirudh Sundaram");
INSERT INTO STUDENT (id, class_id, student_name) VALUES (2014045,3,"Anju Srinivasan");
INSERT INTO STUDENT (id, class_id, student_name) VALUES (609,5,"Anushaa Ramesh");
INSERT INTO STUDENT (id, class_id, student_name) VALUES (2016015,1,"Aradhana Anoop");
INSERT INTO STUDENT (id, class_id, student_name) VALUES (2016036,6,"Araj S Dariwal");
INSERT INTO STUDENT (id, class_id, student_name) VALUES (2015036,8,"Archit Murali");
INSERT INTO STUDENT (id, class_id, student_name) VALUES (2019022,1,"Arihant Kumar Jain");
INSERT INTO STUDENT (id, class_id, student_name) VALUES (424,8,"Arjun Sivakumar");
INSERT INTO STUDENT (id, class_id, student_name) VALUES (2018067,3,"Arth Gupta");
INSERT INTO STUDENT (id, class_id, student_name) VALUES (2015018,1,"Arth Rajesh Saathi");
INSERT INTO STUDENT (id, class_id, student_name) VALUES (2019047,1,"Aryaman Ronak Mistry");
INSERT INTO STUDENT (id, class_id, student_name) VALUES (7915,9,"Ashwanthi Vinod");
INSERT INTO STUDENT (id, class_id, student_name) VALUES (2012017,6,"Ashwin Subramanian");
INSERT INTO STUDENT (id, class_id, student_name) VALUES (2013052,2,"Aswath S");
INSERT INTO STUDENT (id, class_id, student_name) VALUES (2013006,2,"Azara Singh");