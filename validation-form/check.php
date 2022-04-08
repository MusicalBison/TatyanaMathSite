<?php
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);

	$login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING); // trim удаляет лишние пробелы, filter_var удаляет html символы и другие символы, которые не стоит добавлять в базу данных
	$name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
	$pass = filter_var(trim($_POST['pass']), FILTER_SANITIZE_STRING);

	if(mb_strlen($login) < 5 || mb_strlen($login) > 90) {
		echo "Недопустимая длина логина";
		exit();
	} else if(mb_strlen($name) < 3 || mb_strlen($name) > 50) {
		echo "Недопустимая длина имени";
		exit();
	} else if(mb_strlen($pass) < 2 || mb_strlen($pass) > 6) {
		echo "Недопустимая длина пароля (от 2 до 6 символов)";
		exit();
	}

	$pass = md5($pass."sdf4g54g5");

	require "../blocks/connect.php";

	$mysql->query("INSERT INTO `users` (`login`, `pass`, `name`) VALUES('$login', '$pass', '$name')");

	$mysql->close();

	header('Location: /newsite/');
?>