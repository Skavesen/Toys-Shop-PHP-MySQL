<?php
require_once "conection.php";
$action = $_POST["action"];
//удаление сотрудника
if (!empty($action)) {
	switch ($action) {
		case "delete":
			if (!empty($_POST["message_id"])) {
				mysqli_query($DataBaseHandle, "DELETE FROM employee WHERE id_employee=" . $_POST["message_id"]);
			}
			break;
	}
}