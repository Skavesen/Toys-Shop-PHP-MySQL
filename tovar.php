<?php session_start(); ?>

<?php
if ($_GET["type"] == "lego") {
?>
  <script>
    getresult("getresult.php?type=lego");
  </script>
<?php } elseif ($_GET["type"] == "dolls") { 
?>
  <script>
    getresult("getresult.php?type=dolls");
  </script>
<?php } elseif ($_GET["type"] == "road") { 
?>
  <script>
    getresult("getresult.php?type=road");
  </script>
<?php } elseif ($_GET["type"] == "bear") { 
?>
  <script>
    getresult("getresult.php?type=bear");
  </script>
<?php } elseif ($_GET["type"] == "pazzle") { 
?>
  <script>
    getresult("getresult.php?type=pazzle");
  </script>
<?php }  elseif ($_GET["type"] == "toys") { 
?>
  <script>
    getresult("getresult.php?type=toys");
  </script>
<?php } elseif ($_GET["type"] == "car") { 
?>
  <script>
    getresult("getresult.php?type=car");
  </script>
<?php } elseif ($_GET["type"] == "about_employee") { // Если GET-параметр равен выводу информации о сотруднике сотруднику
  require_once "conection.php";
  $query = "SELECT
	SUM( amount )  as summa,
	CONCAT_WS(' ',surname,employee.name,patronymic) as fio,
  employee.phone,
  position.position
FROM
	cart
	INNER JOIN employee ON cart.id_employee = employee.id_employee
	INNER JOIN tovar ON cart.id_tovar = tovar.id_tovar 
  INNER JOIN position ON employee.id_position = position.id_position
WHERE
	cart.id_employee = {$_SESSION['user_id']}
	AND `date` >= CURDATE( )";

  $sql = mysqli_query($DataBaseHandle, $query) or die(mysqli_error($DataBaseHandle));
  if (mysqli_num_rows($sql) == 1) {
    $row = mysqli_fetch_assoc($sql);
  } else {
    $query = "SELECT
      CONCAT_WS(' ',surname,name,patronymic) as fio,
      employee.phone,
      position.position
      FROM
      employee
      INNER JOIN position ON employee.id_position = position.id_position
      WHERE
      id_employee = {$_SESSION['user_id']}";

    $sql = mysqli_query($DataBaseHandle, $query) or die(mysqli_error($DataBaseHandle));
    $row = mysqli_fetch_assoc($sql);
  }
?>
  <div class="card">
    <!-- Изображение -->
    <style>
      .pic,
      .card-body {
        text-align: center;
        /* Выравнивания картинки по центру в html */
      }
      table {
         font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
         font-size: 14px;
         border-collapse: collapse;
         text-align: center;
         width: 100%;
      }

      th,
      td:first-child {
         background: #AFCDE7;
         color: white;
         padding: 10px 20px;
      }

      th,
      td {
         border-style: solid;
         border-width: 0 1px 1px 0;
         border-color: white;
      }

      td {
         background: #D8E6F3;
      }

      th:first-child,
      td:first-child {
         text-align: left;
      }
    </style>
    <p class="pic"><img class="card-img-top" src="img\img_avatar.png" width="250" height="150" alt="...">
      <!-- Текстовый контент -->
    <div class="card-body">
      <h4 class="card-title"><?php echo  $row['fio'] ?></h4>
      <p class="card-text"><?php echo $row['phone'] ?></p>
      <p class="card-text"><?php echo $row['position'] ?></p>
    </div>
    <!-- Список List groups -->
    <ul class="list-group list-group-flush">
      <li class="list-group-item">Заработано за день: <?php if ($row['summa']) {
                                                        echo $row['summa'];
                                                      } else {
                                                        echo 0;
                                                      } ?> рублей</li>
      <script>
        getresult("getresult.php?type=cart_employee");
      </script>
      <!-- <li class="list-group-item">2...</li>
      <li class="list-group-item">3...</li>-->
    </ul>
  </div><!-- Конец карточки -->
<?php }
?>
<div class="page-content">
  <div id="pagination-result">
    <input type="hidden" name="rowcount" id="rowcount" />
  </div>
</div>