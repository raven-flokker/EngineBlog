<?php
session_start();
//Устанавливаем доступы к базе данных:
$host = 'localhost'; //имя хоста, на локальном компьютере это localhost
$user = 'root'; //имя пользователя, по умолчанию это root
$password = ''; //пароль, по умолчанию пустой
$db_name = 'testEn'; //имя базы данных

//Соединяемся с базой данных используя наши доступы:
$link = mysqli_connect($host, $user, $password, $db_name) or die(mysqli_error($link));

/*
	Соединение записывается в переменную $link,
	которая используется дальше для работы mysqi_query.
*/
mysqli_query($link, "SET NAMES 'utf-8'");


$passwordAdmin = '123';