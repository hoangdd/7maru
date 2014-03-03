/*Users table -> storage user infomation*/
create table 7maru_users(
	user_id char(20) not null,
	foreign_id char(20) not null,/*Foreign key to 2 tables :(*/
	username varchar(30) not null,
	firstname varchar(30),
	lastname varchar(30),
	date_of_birth date, 
	address text,
	password char(50),
	user_type integer, /*student -> 1, teacher ->2*/
	mail varchar(30),
	phone_number varchar(15), 
	primary key (user_id),
	question int,
	verifycode varchar(50),
	created datetime, 
	modified datetime
);


/*Login table -> login, access token, ip address filter*/
create table 7maru_login(
	user_id char(20) not null,
	access_token char(30),
	ip_address	varchar(30),
	primary key (user_id), 
	-- foreign key (user_id) references users(user_id),
	created datetime, 
	modified datetime
);

/*Students table -> storage student infomation*/
create table 7maru_students(
	student_id char(20) not null,
	credit_account varchar(30),
	level varchar(20),
	primary key (student_id),
	created datetime, 
	modified datetime
);

/*teachers table -> storage teacher infomation*/
create table 7maru_teachers(
	teacher_id char(20) not null,
	bank_account varchar(30),
	office varchar(50),
	description text,
	primary key (teacher_id),
	created datetime, 
	modified datetime
);


/*Block student table -> teacher can block student*/
create table 7maru_block_students(
	id integer not null unique auto_increment,
	teacher_id char(20) not null,
	student_id char(20) not null,
	block_reason text,
	primary key (id),
	-- foreign key (teacher_id) references teachers(teacher_id),
	-- foreign key (student_id) references teachers(student_id),
	created datetime, 
	modified datetime
);

/*Coma table -> storage coma data*/
create table 7maru_comas(
	coma_id integer not null unique auto_increment,
	author varchar(20),
	name varchar(30),
	title varchar(50),
	description text,
	primary key (coma_id),
	-- foreign key (author) references teachers(teacher_id),
	created datetime, 
	modified datetime
);


/*References table -> storage references data*/
create table 7maru_coma_references(
	reference_id integer not null unique auto_increment,
	coma_id integer not null,
	name varchar(50),
	link text,
	reference_type varchar(30),
	primary key (reference_id),
	-- foreign key (coma_id) references comas(coma_id),
	created datetime, 
	modified datetime
);

/*Categories table -> */
create table 7maru_categories(
	category_id integer not null unique auto_increment,
	name varchar(30),
	description text,
	primary key (category_id),
	created datetime, 
	modified datetime
);

/*Coma_categories table -> allow a coma can be in many categories*/
create table 7maru_coma_categories(
	id integer not null unique auto_increment,
	coma_id integer,
	category_id integer,
	primary key (id),
	-- foreign key (coma_id) references comas(coma_id),
	-- foreign key (category_id) references categories(category_id),
	created datetime, 
	modified datetime
);

/*Comments table -> comment feature*/
create table 7maru_comments(
	comment_id integer not null unique auto_increment,
	user_id char(20),
	coma_id char(20),
	primary key (comment_id),
	-- foreign key (user_id) references users(user_id),
	-- foreign key (coma_id) references comas(coma_id),
	/*sort by time created*/
	created datetime, 
	modified datetime
);

/*coma transaction: coma */
create table 7maru_coma_transactions(
	transaction_id integer not null unique auto_increment,
	coma_id integer, 
	student_id char(20),
	primary key (transaction_id),
	-- foreign key (coma_id) references comas(coma_id),
	-- foreign key (student_id) references students(student_id),
	created datetime, 
	modified datetime
);

/*rate_comas table -> student rate coma feature*/
create table 7maru_rate_comas(
	rate_id integer not null unique auto_increment,
	coma_id integer, 
	student_id char(20), 
	rate integer, /*Rate 5/5*/
	primary key (rate_id),
	-- foreign key (coma_id) references comas(coma_id),
	-- foreign key (student_id) references students(student_id),
	created datetime, 
	modified datetime
);

/*Report comas table -> student report coma feature*/
create table 7maru_report_comas(
	report_id integer not null unique auto_increment,
	coma_id integer, 
	student_id char(20),
	report_reason text,
	primary key (report_id),
	-- foreign key (coma_id) references comas(coma_id),
	-- foreign key (student_id) references students(student_id),
	created datetime, 
	modified datetime
);

/*Notifications table -> User's notifications*/
create table 7maru_notifications(
	notification_id integer,
	user_id char(20),
	notification_type integer, /*alert , notice , adverties*/
	content text,
	primary key (notification_id),
	-- foreign key (user_id) references users(user_id),
	created datetime, 
	modified datetime
);

/*Logs table -> system log*/
create table 7maru_logs(
	log_id integer,
	actor char(20), 
	action text,
	primary key (log_id),
	-- foreign key (actor) references users(user_id),
	created datetime, 
	modified datetime
);