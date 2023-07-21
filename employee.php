<?
session_start();
/*Загрузка должности в комбобокс*/
if ($_GET["type"] == "position") {
?>
   <div>
      <select onchange="getValue(this.value)" id="get_employee" name="get_employee">
         <option value="">Выберите должность</option>
         <?
         require_once "conection.php";
         $result = mysqli_query($DataBaseHandle, "SELECT id_position, position FROM position");
         while ($row = mysqli_fetch_array($result)) {
            echo "<option value='" . $row["id_position"] . "'>" . $row["position"] . "</option>";
         }
         ?>
      </select>
   </div>

<? }
/*Загрузка фамилии, имеени, отчества в комбобокс в корзине */ 
elseif ($_GET["type"] == "employee") { ?>
   <div>
      <select onchange="getValue(this.value)" id="get_employee" name="get_employee">
         <option value="">Сотрудник</option>
         <?
         require_once "conection.php";
         $result = mysqli_query($DataBaseHandle, "SELECT employee.id_employee as `id`, CONCAT_WS(' ',surname,`name`,patronymic) as `fio` FROM employee WHERE id_position = 1");
         while ($row = mysqli_fetch_array($result)) {
            echo "<option value='" . $row["id"] . "'>" . $row["fio"] . "</option>";
         }
         ?>
      </select>
   </div>
<?
}
/*Загрузка типов товаров в комбобокс в добавлении товаров */ 
elseif ($_GET["type"] == "type_tovar") { ?>
   <div>
      
      <select id="get_employee" name="get_employee">
         <?
         require_once "conection.php";
         $result = mysqli_query($DataBaseHandle, "SELECT `id_type`, `type` FROM `type tovar`");
         while ($row = mysqli_fetch_array($result)) {
            echo "<option value='" . $row["id_type"] . "'>" . $row["type"] . "</option>";
         }
         ?>
      </select>
   </div>
<?
}
/*Загрузка сотрудников в таблицы. Меню "Просмотр сотрудников"*/ elseif ($_GET["type"] == "employee_in_table") { ?>
   <style>
      .message-box {
         margin-bottom: 20px;
         border-top: #F0F0F0 2px solid;
         background: #FAF8F8;
         padding: 10px;
      }

      .btnDeleteAction {
         background-color: #d4d800;
         color: white;
         padding: 5px 20px;
         margin: 8px 0;
         border: none;
         cursor: pointer;
      }

      #btnAddAction {
         background-color: #09F;
         border: 0;
         padding: 5px 10px;
         color: #FFF;
      }

      table {
         font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
         font-size: 14px;
         border-collapse: collapse;
         text-align: center;
         width: 100%;
      }

      table td:nth-of-type(1) {
         width: 40px;
      }

      table td:nth-of-type(2) {
         width: 100px;
      }

      table td:nth-of-type(3) {
         width: 100px;
      }

      table td:nth-of-type(4) {
         width: 100px;
      }

      table td:nth-of-type(6) {
         width: 155px;
      }

      table td:nth-of-type(6) {
         width: 155px;
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

      button:hover {
         opacity: 0.8;
      }
   </style>
   <div class="page-content">

      <div id="pagination-result">
         <input type="hidden" name="rowcount" id="rowcount" />
      </div>
   </div>
   <script>
      getresult("getresult.php?type=spisok");
   </script>

<?
}
/*Загрузка сотрудников в таблицы. Меню "Просмотр сотрудников"*/ elseif ($_GET["type"] == "employee_delete") { ?>
   <style>
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
   <div class="page-content">

      <div id="pagination-result">
         <input type="hidden" name="rowcount" id="rowcount" />
      </div>
   </div>
   <script>
      getresult("getresult.php?type=cart");
   </script>
<?
} elseif ($_GET["type"] == "grapg1") {
   require_once "conection.php"; ?>
   <div class="col-md-12 products">
      <div class="row">
         <script >
            google.load("visualization", "1", {
               packages: ["corechart"]
            });
            google.setOnLoadCallback(drawChart);

            function drawChart() {
               var data = google.visualization.arrayToDataTable([

                  ['class Name', 'Students'],
                  <?php
                  $query = "SELECT CONCAT_WS('\"',`type tovar`.type, tovar.`name`,'') as tovar, Count(cart.id_cart) AS kolvo FROM cart INNER JOIN tovar ON cart.id_tovar = tovar.id_tovar INNER JOIN `type tovar` ON tovar.id_type = `type tovar`.id_type GROUP BY tovar.`name`,`type tovar`.type ORDER BY kolvo DESC LIMIT 10;";

                  $exec = mysqli_query($DataBaseHandle, $query);
                  while ($row = mysqli_fetch_array($exec)) {

                     echo "['" . $row['tovar'] . "'," . $row['kolvo'] . "],";
                  }
                  ?>

               ]);

               var options = {
                  title: 'Топ 10 популярных товаров',
                  titleTextStyle: {
                     fontName: 'Lato',
                     fontSize: 18,
                     bold: true
                  },
                  pieHole: 0,
                  pieSliceTextStyle: {
                     color: 'black',
                  },
                  chartArea: {
                     left: 30,
                     top: 70,
                     width: '100%',
                     height: '80%'
                  }
                  //legend: 'none'
               };
               var chart = new google.visualization.PieChart(document.getElementById("columnchart12"));
               chart.draw(data, options);
            }
         </script>
         <div id="columnchart12" style="width: 100%; height: 500px;"></div>
      </div>
   </div>

<?
} elseif ($_GET["type"] == "grapg2" && $_GET['q'] == 1 || $_GET['q'] == 2 || $_GET['q'] == 3) {
   require_once "conection.php"; ?>
   <script type="text/javascript">
      google.load("visualization", "1.0", {
         packages: ["corechart"]
      });
      google.setOnLoadCallback(drawChart);

      function drawChart() {
         var data = google.visualization.arrayToDataTable([

            ['class Name', 'Продано на сумму'],
            <?php
           
            $q = intval($_GET['q']);
            if ($q == 1) {
               $query = "SELECT
         CONCAT_WS(' ',employee.surname,employee.`name`,employee.patronymic) as fio,
         sum(cart.amount) as kolvo
         FROM
         cart
         INNER JOIN employee ON cart.id_employee = employee.id_employee
         WHERE `date` >= CURDATE()
         GROUP BY
         fio";
            }
            if ($q == 2) {
               $query = "SELECT
         CONCAT_WS(' ',employee.surname,employee.`name`,employee.patronymic) as fio,
         sum(cart.amount) as kolvo
         FROM
         cart
         INNER JOIN employee ON cart.id_employee = employee.id_employee
         WHERE `date` >= DATE_SUB(CURRENT_DATE, INTERVAL 7 DAY)
         GROUP BY
         fio";
            }
            if ($q == 3) {
               $query = "SELECT
         CONCAT_WS(' ',employee.surname,employee.`name`,employee.patronymic) as fio,
         sum(cart.amount) as kolvo
         FROM
         cart
         INNER JOIN employee ON cart.id_employee = employee.id_employee
         WHERE `date` >= DATE_SUB(CURRENT_DATE, INTERVAL 30 DAY)/*За месяц (За 30 дней)*/
         /*SELECT * FROM TABLE WHERE tc_date >= CURDATE() За сегодня*/
         /*>= (CURDATE()-1) AND tc_date < CURDATE() За вчера*/
         /*>= DATE_SUB(CURRENT_DATE, INTERVAL 7 DAY)За неделю*/
         GROUP BY
         fio";
            }
            $exec = mysqli_query($DataBaseHandle, $query);
            while ($row = mysqli_fetch_array($exec)) {

               echo "['" . $row['fio'] . "'," . $row['kolvo'] . "],";
            }
            ?>

         ]);
         var options = {
            title: `Продано товаров по сотрудникам за указанный период`,
            //width:900,
            // height:200,
            legend: {
               position: 'none'
            },
            titleTextStyle: {
               fontName: 'Lato',
               fontSize: 18,
               bold: true
            },
            chartArea: {
               left: 40,
               width: '97%',
               height: '80%'
            },
            bar: {
               groupWidth: '55%'
            }
         };

         var chart = new google.visualization.ColumnChart(document.getElementById("chart_div"));
         chart.draw(data, options);
      }
   </script>
   <form>
      <select name="period" onchange="showPeriod(this.value)">
         <option value="">Выберите период:</option>
         <option value="1">День</option>
         <option value="2">Неделя</option>
         <option value="3">Месяц</option>
      </select>
   </form>
   <div id="chart_div" style="width: 100%; height: 300px;"></div>
<?
}
?>