<?php
session_start();
require_once "conection.php";

/*if (isset($_POST['login']) && isset($_POST['password'])) {
	//немного профильтруем логин
	$login = mysqli_real_escape_string($DataBaseHandle, htmlspecialchars($_POST['login']));
	//хешируем пароль т.к. в базе именно хеш
	$password = md5(md5(trim($_POST['password'])));
	// проверяем введенные данные

	$query = "SELECT * FROM employee WHERE `login`= '$login' AND `password` = '$password' LIMIT 1";
	$sql = mysqli_query($DataBaseHandle, $query) or die(mysqli_error($DataBaseHandle));
	// если такой пользователь есть
	if (mysqli_num_rows($sql) == 1) {
		$row = mysqli_fetch_assoc($sql);
		//ставим метку в сессии 
		$_SESSION['user_id'] = $row['id_employee'];
		$_SESSION['user_login'] = $row['login'];
		$_SESSION['user_id_position'] = $row['id_position'];
		//ставим куки и время их хранения 10 дней
		setcookie("CookieMy", $row['login'], time() + 60 * 60 * 24 * 10);
	} else {
		//если пользователя нет, то пусть пробует еще
		echo "Авторизуйтесь";
	}
}
//проверяем сессию, если она есть, то значит уже авторизовались
if (isset($_SESSION['user_id'])) {
	//echo htmlspecialchars($_SESSION['user_id_position']) . " <br />" . "Вы авторизованы <br />
	//			Т.е. мы проверили сессию и можем открыть доступ к определенным данным";
} else {
	$login = '';
	//проверяем куку, может он уже заходил сюда
	if (isset($_COOKIE['CookieMy'])) {
		$login = htmlspecialchars($_COOKIE['CookieMy']);
	}
}*/
if (isset($_POST['exit'])) {
	unset($_SESSION['user_id']);
	unset($_SESSION['user_login']);
	session_destroy(); 
	?> <script>
	window.setTimeout(function() {
		window.location = 'index.php';
	}, 10)
</script><?
}
?>
<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="utf-8">
	<title>Каталог товаров</title>
	<link href="css/jqcart.css" rel="stylesheet" type="text/css">
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="style.css">

	<!--<script type="text/javascript" src="jquery-1.11.3.min.js"></script>-->
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
   <script type="text/javascript" src="https://www.google.com/jsapi"></script>
   <script src="https://www.gstatic.com/charts/loader.js"></script>
	<script src="script.js"></script>
	<script src="jqcart.min.js"></script>
	<script>
		$(function() {
			'use strict';
			// инициализация плагина
			$.jqCart({
				buttons: '.add_item',
				handler: '.handler.php',
				cartLabel: '.label-place',
				visibleLabel: true,
				openByAdding: false,
				currency: '₽'
			});
			// Пример с дополнительными методами
			$('#open').click(function() {
				$.jqCart('openCart'); // открыть корзину
			});
			$('#clear').click(function() {
				$.jqCart('clearCart'); // очистить корзину
			});
		});
	</script>
</head>

<body>
	<div class="container content">
		<div class="row">
			<!--Колонка типов товаров-->
			<div class="col-md-3">
				<div class="list-group">

					<? if ($_SESSION['user_id_position'] == 0){?>
					<a href="#" id="btn1" class="list-group-item">Конструкторы лего</a>
					<a href="#" id="btn2" class="list-group-item">Куклы барби</a>
					<a href="#" id="btn3" class="list-group-item">Железная дорога</a>
					<a href="#" id="btn4" class="list-group-item">Большие медведи</a>
					<a href="#" id="btn5" class="list-group-item">Мягкие игрушки</a>
					<a href="#" id="btn6" class="list-group-item">Пазлы</a>
					<a href="#" id="btn7" class="list-group-item">Машинки</a>
					<?}?>
					<? if ($_SESSION['user_id_position'] == 1){?>
					<a href="#" id="btn1" class="list-group-item">Конструкторы лего</a>
					<a href="#" id="btn2" class="list-group-item">Куклы барби</a>
					<a href="#" id="btn3" class="list-group-item">Железная дорога</a>
					<a href="#" id="btn4" class="list-group-item">Большие медведи</a>
					<a href="#" id="btn5" class="list-group-item">Мягкие игрушки</a>
					<a href="#" id="btn6" class="list-group-item">Пазлы</a>
					<a href="#" id="btn7" class="list-group-item">Машинки</a>
					<a href="#" id="btn8" class="list-group-item">Сводка за день</a>
					<?}?>
					<? if ($_SESSION['user_id_position'] == 2){?>
					<a href="#" id="btn01" class="list-group-item">Добавить сотрудника</a>
					<a href="#" id="btn02" class="list-group-item">Топ товаров</a>
					<a href="#" id="btn03" class="list-group-item">Просмотр сотрудников</a>
					<a href="#" id="btn04" class="list-group-item">Корзина</a>
					<a href="#" id="btn05" class="list-group-item">Статистика работников</a>
					<a href="#" id="btn06" class="list-group-item">Добавить товар</a>
					<?}?>
				</div>
				<form method="POST">
					<? if ($_SESSION['user_id_position'] < 1){?>
					<div class="mb-3">
						<label for="exampleInputLogin1" class="form-label ">Логин</label>
						<input type="text" name="login" class="form-control" id="exampleInputLogin1">
					</div>
					<p></p>
					<div class="mb-3">
						<label for="exampleInputPassword1" class="form-label">Пароль</label>
						<input type="password" name="password" class="form-control" id="exampleInputPassword1">
					</div>
					<p></p>
					<input name="submit" type="submit" class="btn btn-primary btn-block" value="Вход">
					<?}?>
					<? if ($_SESSION['user_id_position'] >= 1){?>
					<input name="exit" type="submit" class="btn btn-primary btn-block" value="Выход">
					<?}?>
				</form>

			</div>
			<!--Колонка с товарами-->
			<div class="col-md-9 products">

				<? if ($_SESSION['user_id_position'] < 2){?>
				<div class="label-place"></div>
				<?}?>
				<!--<button id="clear">Очистить корзину (вызов метода clearCart)</button>
					<button id="open">Открыть корзину (вызов метода openCart)</button>-->
				<div id="content"></div>
			</div>
		</div>
	</div>

	<script src="bootstrap/js/bootstrap.min.js"></script>
</body>

</html>