<?php
require_once "conection.php";
require_once "index.php";
require_once "script.js";

$id = $_POST['id'];
$quantity = $_POST['quantity'];
$amount = $_POST['amount'];
//$id_employee = $_POST['target'];
$id_employee = $_SESSION['user_id'];
$date_time = $_POST['time'];
$count = $_POST['countt'];

mysqli_select_db($DataBaseHandle, DB_NAME) or die(mysqli_error($DataBaseHandle));

$last_id="SELECT `id_cart` FROM `cart` order by `id_cart` DESC limit 1";
$result = mysqli_query($DataBaseHandle,$last_id);
$row = $result->fetch_assoc();

$last_date="SELECT `date` FROM `cart` order by `id_cart` DESC limit 1";
$result2 = mysqli_query($DataBaseHandle,$last_date);
$row2 = $result2->fetch_assoc();
if($date_time==$row2['date'])
{
  $perem_id = $row['id_cart'];
}
else
{
  $perem_id = $row['id_cart']+1;
}

$query = "INSERT INTO `cart` (`id_cart`, `id_employee`, `id_tovar`, `quantity`, `amount`, `date`) VALUES ('$perem_id', '$id_employee', '$id', '$quantity', '$amount', '$date_time')";

if (mysqli_query($DataBaseHandle, $query)) {
  echo "Успешно создана новая запись";
} else {
  echo "Ошибка: " . $query . "<br>" . mysqli_error($DataBaseHandle);
}
?> 