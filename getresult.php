<?php
session_start();
require_once("conection.php");
require_once("pagination.class.php");
$db_handle = new DBController();
/*условие для вывода товаров*/
if ($_GET["type"] == "lego" || $_GET["type"] == "dolls" || $_GET["type"] == "road" || $_GET["type"] == "bear" || $_GET["type"] == "toys"|| $_GET["type"] == "car"|| $_GET["type"] == "pazzle") {
  if ($_GET["type"] == "lego") { 
    $sql = "select * from `tovar` INNER JOIN `type tovar` ON tovar.id_type = `type tovar`.id_type where `type tovar`.type = 'Конструкторы лего'";
    $paginationlink = "getresult.php?type=lego&page=";
    $perPage = new PerPage(6);
  } elseif ($_GET["type"] == "dolls") { 
    $sql = "select * from `tovar` INNER JOIN `type tovar` ON tovar.id_type = `type tovar`.id_type where `type tovar`.type = 'Куклы барби'";
    $paginationlink = "getresult.php?type=dolls&page=";
    $perPage = new PerPage(6);
  } elseif ($_GET["type"] == "road") { 
    $sql = "select * from `tovar` INNER JOIN `type tovar` ON tovar.id_type = `type tovar`.id_type where `type tovar`.type = 'Железная дорога'";
    $paginationlink = "getresult.php?type=road&page=";
    $perPage = new PerPage(6);
  } elseif ($_GET["type"] == "bear") { 
    $sql = "select * from `tovar` INNER JOIN `type tovar` ON tovar.id_type = `type tovar`.id_type where `type tovar`.type = 'Большие медведи'";
    $paginationlink = "getresult.php?type=bear&page=";
    $perPage = new PerPage(6);
  } elseif ($_GET["type"] == "toys") { 
    $sql = "select * from `tovar` INNER JOIN `type tovar` ON tovar.id_type = `type tovar`.id_type where `type tovar`.type = 'Мягкие игрушки'";
    $paginationlink = "getresult.php?type=toys&page=";
    $perPage = new PerPage(6);
  } elseif ($_GET["type"] == "pazzle") { 
  $sql = "select * from `tovar` INNER JOIN `type tovar` ON tovar.id_type = `type tovar`.id_type where `type tovar`.type = 'Пазлы'";
  $paginationlink = "getresult.php?type=pazzle&page=";
  $perPage = new PerPage(6);
} elseif ($_GET["type"] == "car") { 
  $sql = "select * from `tovar` INNER JOIN `type tovar` ON tovar.id_type = `type tovar`.id_type where `type tovar`.type = 'Машинки'";
  $paginationlink = "getresult.php?type=car&page=";
  $perPage = new PerPage(6);
}
  $page = 1;
  if (!empty($_GET["page"])) {
    $page = $_GET["page"];
  }

  $start = ($page - 1) * $perPage->perpage;
  if ($start < 0) $start = 0;

  $query =  $sql . " limit " . $start . "," . $perPage->perpage;
  $faq = $db_handle->runQuery($query);

  if (empty($_GET["rowcount"])) {
    $_GET["rowcount"] = $db_handle->numRows($sql);
  }
  $perpageresult = $perPage->getAllPageLinks($_GET["rowcount"], $paginationlink);
  $output = '';
  $output .= '
  <div class="col-md-12 products">
    <div class="row">
    ';
  foreach ($faq as $k => $v) {
    $output .= '
        <div class="col-sm-4">
          <div class="product">
            <div class="product-img">
              <a href="#picture_in_cart">
              <img src=" data:image/png;base64,' . base64_encode($faq[$k]['picture']) . '"/>
              </a>
            </div>
            <p class="product-title">
              <a id="#picture_in_cart" href="#picture_in_cart">' . $faq[$k]["name"] . '</a>
            </p>
            <p class="product-desc">' . $faq[$k]["description"] . '</p>
            <p class="product-price">Цена: ' . $faq[$k]["price"] . 'р</p>
            <a href="#" class="add_item" 
                        data-id="' . $faq[$k]["id_tovar"] . '" 
                        data-img="' . $faq[$k]["type"] . '"
                        data-title="' . $faq[$k]["name"] . '" 
                        data-price="' . $faq[$k]["price"] . '" 
                        >Добавить в корзину</a>
          </div>
        </div>';
  }
  $output .= '</div>
  </div>';

  if (!empty($perpageresult)) {
    $output .= '<div id="pagination">' . $perpageresult . '</div>';
  }
  print $output;
} elseif ($_GET["type"] == "spisok") {
  $sql = "SELECT id_employee, surname,`name`, patronymic, phone, position FROM employee INNER JOIN position ON employee.id_position = position.id_position";
  $paginationlink = "getresult.php?type=spisok&page=";
  $perPage = new PerPage(12);
  $page = 1;
  if (!empty($_GET["page"])) {
    $page = $_GET["page"];
  }

  $start = ($page - 1) * $perPage->perpage;
  if ($start < 0) $start = 0;

  $query =  $sql . " limit " . $start . "," . $perPage->perpage;
  $faq = $db_handle->runQuery($query);

  if (empty($_GET["rowcount"])) {
    $_GET["rowcount"] = $db_handle->numRows($sql);
  }
  $perpageresult = $perPage->getAllPageLinks($_GET["rowcount"], $paginationlink);
  $output = '';
  $output .= '
    <div class="form_style">
    <div id="comment-list-box">
  
    ';
  foreach ($faq as $k => $v) {
    $output .= '
        <div class="message-box" id="message_' . $faq[$k]["id_employee"] . '">
        <div class="message-content"><table>
        <tr><td>' . $faq[$k]["id_employee"] . '</td><td>' . $faq[$k]["surname"] . '</td><td>' . $faq[$k]["name"] . '</td>
        <td>' . $faq[$k]["patronymic"] . '</td><td>' . $faq[$k]["phone"] . '</td><td>' . $faq[$k]["position"] . '</td>
           <td><button class="btnDeleteAction" name="delete" onClick="callCrudAction(\'delete\',' . $faq[$k]["id_employee"] . ')">Удалить</button></td>
           </tr>     </table>
           </div> </div>      ';
  }
  $output .= '</div></div>';

  if (!empty($perpageresult)) {
    $output .= '<div id="pagination">' . $perpageresult . '</div>';
  }
  print $output;
} elseif ($_GET["type"] == "cart") {
  $sql = "SELECT cart.id_cart,
    CONCAT_WS(' ',surname,employee.`name`, patronymic) as `fio`,
    tovar.`name`,
    cart.quantity,
    cart.amount,
    cart.date
    FROM
    cart
    INNER JOIN employee ON cart.id_employee = employee.id_employee
    INNER JOIN tovar ON cart.id_tovar = tovar.id_tovar";
  $paginationlink = "getresult.php?type=cart&page=";
  $perPage = new PerPage(19);
  $page = 1;
  if (!empty($_GET["page"])) {
    $page = $_GET["page"];
  }

  $start = ($page - 1) * $perPage->perpage;
  if ($start < 0) $start = 0;

  $query =  $sql . " limit " . $start . "," . $perPage->perpage;
  $faq = $db_handle->runQuery($query);

  if (empty($_GET["rowcount"])) {
    $_GET["rowcount"] = $db_handle->numRows($sql);
  }
  $perpageresult = $perPage->getAllPageLinks($_GET["rowcount"], $paginationlink);
  $output = '';
  $output .= '
    <div class="message-content"><table><tr>
                  <td>ID</td><td>Сотрудник</td><td>Товар</td>
                  <td>Количество</td><td>Цена</td><td>Дата продажи</td></tr>
  
    ';
  foreach ($faq as $k => $v) {
    $output .= '
        <tr>
        <td>' . $faq[$k]["id_cart"] . '</td><td>' . $faq[$k]["fio"] . '</td><td>' . $faq[$k]["name"] . '</td>
        <td>' . $faq[$k]["quantity"] . '</td><td>' . $faq[$k]["amount"] . '</td><td>' . $faq[$k]["date"] . '</td></tr>';
  }
  $output .= '</table>
    </div>
</div>
</div>';

  if (!empty($perpageresult)) {
    $output .= '<div id="pagination">' . $perpageresult . '</div>';
  }
  print $output;
} elseif ($_GET["type"] == "cart_employee") {
  $sql = "SELECT 
  tovar.`name`,
  cart.quantity,
  cart.amount,
  cart.date
  FROM
  cart
  INNER JOIN employee ON cart.id_employee = employee.id_employee
  INNER JOIN tovar ON cart.id_tovar = tovar.id_tovar
WHERE
cart.id_employee = {$_SESSION['user_id']} 
AND `date` >= CURDATE( )";
  $paginationlink = "getresult.php?type=cart_employee&page=";
  $perPage = new PerPage(9);
  $page = 1;
  if (!empty($_GET["page"])) {
    $page = $_GET["page"];
  }

  $start = ($page - 1) * $perPage->perpage;
  if ($start < 0) $start = 0;

  $query =  $sql . " limit " . $start . "," . $perPage->perpage;
  $faq = $db_handle->runQuery($query);

  if (empty($_GET["rowcountt"])) {
    $_GET["rowcountt"] = $db_handle->numRows($sql);
  }
  $perpageresult = $perPage->getAllPageLinks($_GET["rowcountt"], $paginationlink);
  $output = '';
  $output .= '
    <div class="message-content"><table><tr>
                  <td>Товар</td>
                  <td>Количество</td><td>Цена</td><td>Дата продажи</td></tr>
  
    ';
  foreach ($faq as $k => $v) {
    $output .= '
        <tr>
        <td>' . $faq[$k]["name"] . '</td><td>' . $faq[$k]["quantity"] . '</td>
        <td>' . $faq[$k]["amount"] . '</td><td>' . $faq[$k]["date"] . '</td></tr>';
  }
  $output .= '</table>
    </div>
</div>
</div>';

  if (!empty($perpageresult)) {
    $output .= '<div id="pagination">' . $perpageresult . '</div>';
  }
  print $output;
}
