<?php
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);

	$login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING); // trim удаляет лишние пробелы, filter_var удаляет html символы и другие символы, которые не стоит добавлять в базу данных
	$pass = filter_var(trim($_POST['pass']), FILTER_SANITIZE_STRING);

	$pass = md5($pass."sdf4g54g5");

	require "../blocks/connect.php";

	$result = $mysql->query("SELECT * FROM `users` WHERE `login` = '$login' AND `pass` = '$pass'");
	$user = $result->fetch_assoc();

	if (count($user) == 0) {
		echo "Такой пользователь не найден";
		exit();
	}

	setcookie('user', $user['name'], time() + 3600, "/");

	// print_r($user);
	// exit();


	$mysql->close();

	header('Location: /newsite/');
?>