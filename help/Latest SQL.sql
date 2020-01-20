create database labs;

use labs;

create table teacher(
	id int not null unique,
	teacher_name varchar(50) not null unique,
	teacher_pass varchar(60) not null,
	levels int(1) not null,
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
	lab_location varchar(10),
	specs varchar(100) default '',
	min_quantity int default 0,
	lost_quantity int default 0,
	quantity int default 0,
	price decimal(10,2) not null default 0,
	lab varchar(1) not null default "p",
	recon date,
	primary key(id)
);

create table student_checkout(
	id int auto_increment not null unique,
	student_id int not null,
	item_id int not null,
	quantity int not null,
	returned varchar(1) not null default "N",
	checkout_date date default now(),
	lab varchar(1) not null default "p",
	returned_date date,
	lost varchar(1) not null default "N",
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
	specs varchar(100) not null,
	link varchar(150) not null,
	cost decimal(10,2),
	date_ordered datetime not null default now(),
	arrived bit not null,
	date_arrived datetime not null default now(),
	comments varchar(100),
	bill_code varchar(10) default "<No Bill>",
	lab varchar(1) not null default "p",
	primary key(id),
	foreign key (teacher_id) references teacher(id)
);

create table dept_transaction(
	id int not null auto_increment,
	from_lab varchar(1) not null,
	item_id int not null,
	quantity int not null,
	to_lab varchar(1) not null,
	transfer_date datetime not null default now(),
	comments varchar(100),
	primary key(id),
	foreign key (item_id) references item(id)
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

create table experiment(
	id int not null auto_increment,
	exp_name varchar(50) not null,
	lab varchar(1) not null,
	primary key (id)
);

create table experiment_item(
	id int not null auto_increment,
	exp_id int not null,
	item_id int not null,
	quantity int not null,
	primary key (id),
	foreign key (exp_id) references experiment (id)
);

create table item_booking(
	id int not null auto_increment,
	labbooking_id int not null,
	exp_id int not null,
	quantity int not null default 1,
	returned varchar(1) default "N",
	primary key (id),
	foreign key (exp_id) references experiment (id),
	foreign key (labbooking_id) references lab_booking (id)
);

create table missing(
	id int not null auto_increment,
	item_id int not null,
	quantity int not null,
	entry_date date default now(),
	comments varchar(100) not null,
	accounted varchar(1) default "N",
	checkout_id int,
	primary key (id),
	foreign key (item_id) references item (id),
	foreign key (checkout_id) references checkout (id)
);

insert into teacher(id, teacher_name, teacher_pass, levels, email) values (1, 'abhinav', '$2y$10$Inr2U7NdVEQHAkf4WL3Biu3LrM0FKxz28xZE0nWM1JoqOOYokEJVe', 0, "abhinav@ishahomeschool.org");
insert into teacher(id, teacher_name, teacher_pass, levels) values (2, 'arjun', '$2y$10$Inr2U7NdVEQHAkf4WL3Biu3LrM0FKxz28xZE0nWM1JoqOOYokEJVe', 0);
insert into teacher(id, teacher_name, teacher_pass, levels) values (3, 'c', '6512', 3);
insert into teacher(id, teacher_name, teacher_pass, levels) values (4, 'd', '1161', 3);
insert into teacher(id, teacher_name, teacher_pass, levels) values (5, 'e', '9987', 3);
insert into teacher(id, teacher_name, teacher_pass, levels) values (6, 'f', '1572', 3);
insert into teacher(id, teacher_name, teacher_pass, levels) values (7, 'g', '3950', 3);
insert into teacher(id, teacher_name, teacher_pass, levels) values (8, 'h', '9500', 3);
insert into teacher(id, teacher_name, teacher_pass, levels) values (9, 'i', '2950', 3);
insert into teacher(id, teacher_name, teacher_pass, levels) values (10, 'j', '5014', 3);
insert into teacher(id, teacher_name, teacher_pass, levels) values (11, 'k', '4056', 3);
insert into teacher(id, teacher_name, teacher_pass, levels) values (12, 'l', '4716', 3);
insert into teacher(id, teacher_name, teacher_pass, levels) values (13, 'm', '6312', 3);
insert into teacher(id, teacher_name, teacher_pass, levels) values (14, 'n', '9726', 3);
insert into teacher(id, teacher_name, teacher_pass, levels) values (15, 'o', '2123', 3);
insert into teacher(id, teacher_name, teacher_pass, levels) values (16, 'p', '9781', 3);
insert into teacher(id, teacher_name, teacher_pass, levels) values (17, 'q', '1061', 3);
insert into teacher(id, teacher_name, teacher_pass, levels) values (18, 'r', '5093', 3);
insert into teacher(id, teacher_name, teacher_pass, levels) values (19, 's', '2174', 3);
insert into teacher(id, teacher_name, teacher_pass, levels) values (20, 't', '7392', 3);
insert into teacher(id, teacher_name, teacher_pass, levels) values (21, 'u', '1961', 3);
insert into teacher(id, teacher_name, teacher_pass, levels) values (22, 'v', '6302', 3);
insert into teacher(id, teacher_name, teacher_pass, levels) values (23, 'w', '1174', 3);
insert into teacher(id, teacher_name, teacher_pass, levels) values (24, 'x', '2852', 3);
insert into teacher(id, teacher_name, teacher_pass, levels) values (25, 'y', '3290', 3);
insert into teacher(id, teacher_name, teacher_pass, levels) values (26, 'z', '713', 3);

insert into class(class_name, class_teacher) values ('8A', 3);
insert into class(class_name, class_teacher) values ('8B', 16);
insert into class(class_name, class_teacher) values ('9A', 24);
insert into class(class_name, class_teacher) values ('9B', 26);
insert into class(class_name, class_teacher) values ('10A', 25);
insert into class(class_name, class_teacher) values ('10B', 11);
insert into class(class_name, class_teacher) values ('11', 1);
insert into class(class_name, class_teacher) values ('12', 18);
insert into class(class_name, class_teacher) values ('13', 20);

insert into item (item_name, quantity, min_quantity, price, lab) values ('concave lens', 369, 271, 35.83, 'p');
insert into item (item_name, quantity, min_quantity, price, lab) values ('convex lens', 803, 606, 3.57, 'p');
insert into item (item_name, quantity, min_quantity, price, lab) values ('glass slab', 802, 80, 65.18, 'p');
insert into item (item_name, quantity, min_quantity, price, lab) values ('battery 9V', 529, 579, 59.23, 'p');
insert into item (item_name, quantity, min_quantity, price, lab) values ('battery AA', 970, 230, 2.25, 'p');
insert into item (item_name, quantity, min_quantity, price, lab) values ('battery AAA', 253, 801, 66.7, 'p');
insert into item (item_name, quantity, min_quantity, price, lab) values ('battery eliminator', 969, 404, 70.21, 'p');
insert into item (item_name, quantity, min_quantity, price, lab) values ('rheostat', 733, 209, 84.79, 'p');
insert into item (item_name, quantity, min_quantity, price, lab) values ('arduino uno', 161, 145, 99.78, 'p');
insert into item (item_name, quantity, min_quantity, price, lab) values ('metal bob 2cm', 957, 632, 62.6, 'p');
insert into item (item_name, quantity, min_quantity, price, lab) values ('metal bob 3cm', 204, 198, 8.42, 'p');
insert into item (item_name, quantity, min_quantity, price, lab) values ('stand', 506, 860, 23.07, 'p');
insert into item (item_name, quantity, min_quantity, price, lab) values ('led red', 774, 72, 37.75, 'p');
insert into item (item_name, quantity, min_quantity, price, lab) values ('led red', 683, 781, 13.06, 'p');
insert into item (item_name, quantity, min_quantity, price, lab) values ('led blue', 963, 257, 87.35, 'p');
insert into item (item_name, quantity, min_quantity, price, lab) values ('led red', 178, 441, 91.25, 'p');
insert into item (item_name, quantity, min_quantity, price, lab) values ('led rgb', 118, 370, 55.28, 'p');
insert into item (item_name, quantity, min_quantity, price, lab) values ('buzzer', 169, 877, 84.67, 'p');
insert into item (item_name, quantity, min_quantity, price, lab) values ('resistor 2ohm', 433, 768, 85.18, 'p');
insert into item (item_name, quantity, min_quantity, price, lab) values ('resistor 5ohm', 464, 456, 5.17, 'p');
insert into item (item_name, quantity, min_quantity, price, lab) values ('ammeter', 315, 642, 59.86, 'p');
insert into item (item_name, quantity, min_quantity, price, lab) values ('voltmeter', 972, 197, 47.88, 'p');
insert into item (item_name, quantity, min_quantity, price, lab) values ('scissors', 636, 859, 67.81, 'p');
insert into item (item_name, quantity, min_quantity, price, lab) values ('duct tape', 939, 75, 65.93, 'p');


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
