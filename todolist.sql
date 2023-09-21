create database todolist;
create table users(
	id int(10) primary key auto_increment,
    username varchar(255) not null unique,
    password varchar(255) not null,
    fullname varchar(255) not null
);
create table setting(
	id int(10) primary key,
	pomodoro int(10) not null,
    shortbreak int(10) not null,
    longbreak int(10) not null,
	autoStartBreak int(1) not null,
    autoStartPomodoro int(1) not null,
    autoCheckTask int(1) not null,
    longBreakInterval int(1) not null,
    pomodoroColor varchar(10) not null,
    shortBreakColor varchar(10) not null,
    longBreakColor varchar(10) not null,
    Check (autoStartBreak = 1 or autoStartBreak = 0),
    Check (autoStartPomodoro = 1 or autoStartPomodoro = 0),
    Check (autoCheckTask = 1 or autoCheckTask = 0),
    foreign key (id) references users(id)
);
create table tasks(
	userID int(10) not null,
    taskID int(10) primary key auto_increment,
    title varchar(255) not null,
    description varchar(255),
    finishTime int(3) not null,
    currentTime int(3) not null,
    foreign key (userID) references users(id)
);