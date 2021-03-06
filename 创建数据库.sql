create database bbs;
use bbs;

create table subject(
id int primary key auto_increment,/*帖子编号*/
num int,	/*楼数*/
username varchar(80),
title varchar(255),
cont text,
date datetime);

create table context(
num int,/*楼层数*/
id int,/*帖子*/
tonum int,/*回复*/
username varchar(80),
cont text,
date datetime);

create table user(
id int primary key auto_increment,
username varchar(80),
passwd varchar(100),
email varchar(80),
date datetime);
