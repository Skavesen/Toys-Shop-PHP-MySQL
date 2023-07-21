<?
session_start();
require_once "conection.php";
require_once "index.php";
/*Добавление товара*/
if ($_GET["type"] == "add_tovar") {
    $id_type = $_POST['id_type'];
    $name = $_POST['name'];
    $cost = $_POST['cost'];
    $description = $_POST['description'];
    $f = 'D:\OpenServer\OpenServer\domains\SSSS\img\Кофе.png';
    $picture = addslashes(file_get_contents('img/'. $_POST['picture']));
    //$picture = addslashes(file_get_contents($_FILES['file']['name']));
    //$picture = addslashes(file_get_contents(move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . $_FILES['file']['name'])));

    $zerna = $_POST['zerna'];
    $maslo = $_POST['maslo'];
    $sahar = $_POST['sahar'];
    $kaka = $_POST['kaka'];
    $targett = $_POST['targett'];
    
    /*if(isset($_FILES['file'])){
        $photo = file_get_contents($_FILES['picture']['tmp_name']);
    }*/
    if( $id_type==4){
        $sebestoimost= $zerna/1000*150 + $maslo/1000*120 + $sahar/1000*50 + $kaka;  
        mysqli_query($DataBaseHandle, "INSERT INTO `tovar`(`name`, `price`, `description`, `picture`, `id_type`, `sebestoimost`) VALUES ('$name',' $cost','$description','$picture','$id_type',' $sebestoimost')");

    }
    elseif( $id_type==6){
        $sebestoimost= $zerna/1000*160 + $maslo/1000*120 + $sahar/100*300 + $targett/1000*90;  
        mysqli_query($DataBaseHandle, "INSERT INTO `tovar`(`name`, `price`, `description`, `picture`, `id_type`, `sebestoimost`) VALUES ('$name',' $cost','$description','$picture','$id_type',' $sebestoimost')");

    }
    else{
        mysqli_query($DataBaseHandle, "INSERT INTO `tovar`(`name`, `price`, `description`, `picture`, `id_type`) VALUES ('$name',' $cost','$description','$picture','$id_type')");
        echo ("INSERT INTO `tovar`(`name`, `price`, `description`, `picture`, `id_type`) VALUES ('$name',' $cost','$description','$picture','$id_type')");
    }
 }
$surname = $_POST['surname'];
$name = $_POST['name'];
$patronymic = $_POST['patronymic'];
$phone = $_POST['phone'];
$id_position = $_POST['id_position'];
$err = [];

// проверям логин
if (!preg_match("/^[a-zA-Z0-9]+$/", $_POST['login'])) {
    $err[] = "Логин может состоять только из букв английского алфавита и цифр";
}

if (strlen($_POST['login']) < 3 or strlen($_POST['login']) > 30) {
    $err[] = "Логин должен быть не меньше 3-х символов и не больше 30";
}

// проверяем, не сущестует ли пользователя с таким именем
$query = mysqli_query($DataBaseHandle, "SELECT id_employee FROM employee WHERE `login`='" . mysqli_real_escape_string($DataBaseHandle, $_POST['login']) . "'");
if (mysqli_num_rows($query) > 0) {
    $err[] = "Пользователь с таким логином уже существует в базе данных";
}

// Если нет ошибок, то добавляем в БД нового пользователя
if (count($err) == 0) {
    $login = $_POST['login'];
    // Убираем лишние пробелы и делаем двойное хеширование
    $password = md5(md5(trim($_POST['password'])));
    mysqli_query($DataBaseHandle, "INSERT INTO `employee`(`surname`, `name`, `patronymic`, `phone`, `id_position`, `login`, `password`) VALUES ('$surname', '$name', '$patronymic', '$phone', '$id_position', '$login', '$password')");
} else {
    print "<b>При регистрации произошли следующие ошибки:</b><br>";
    foreach ($err as $error) {
        print $error . "<br>";
    }
}
