$(document).ready(function () {
  //меню сотрудника
  $("#btn1").click(function () {
    $.ajax({
      url: "tovar.php?type=lego",
      cache: false,
      success: function (html) {
        $("#content").html(html);
      },
    });
  });

  $("#btn2").click(function () {
    $.ajax({
      url: "tovar.php?type=dolls",
      cache: false,
      success: function (html) {
        $("#content").html(html);
      },
    });
  });

  $("#btn3").click(function () {
    $.ajax({
      url: "tovar.php?type=road",
      cache: false,
      success: function (html) {
        $("#content").html(html);
      },
    });
  });

  $("#btn4").click(function () {
    $.ajax({
      url: "tovar.php?type=bear",
      cache: false,
      success: function (html) {
        $("#content").html(html);
      },
    });
  });

  $("#btn5").click(function () {
    $.ajax({
      url: "tovar.php?type=toys",
      cache: false,
      success: function (html) {
        $("#content").html(html);
      },
    });
  });
  
  $("#btn6").click(function () {
    $.ajax({
      url: "tovar.php?type=pazzle",
      cache: false,
      success: function (html) {
        $("#content").html(html);
      },
    });
  });

  $("#btn7").click(function () {
    $.ajax({
      url: "tovar.php?type=car",
      cache: false,
      success: function (html) {
        $("#content").html(html);
      },
    });
  });

  $("#btn8").click(function () {
    $.ajax({
      url: "tovar.php?type=about_employee",
      cache: false,
      success: function (html) {
        $("#content").html(html);
      },
    });
  });

  /*меню директора*/
  //добавление сотрудника
  $("#btn01").click(function () {
    $.ajax({
      url: "register_form.php",
      cache: false,
      success: function (html) {
        $("#content").html(html);
      },
    });
  });
  //просмотр графика "Топ товаров"
  $("#btn02").click(function () {
    $.ajax({
      url: "employee.php?type=grapg1",
      cache: false,
      success: function (html) {
        $("#content").html(html);
      },
    });
  });
  //просмотр сотрудников
  $("#btn03").click(function () {
    $.ajax({
      url: "employee.php?type=employee_in_table",
      cache: false,
      success: function (html) {
        $("#content").html(html);
      },
    });
  });
  //просмотр корзины
  $("#btn04").click(function () {
    $.ajax({
      url: "employee.php?type=employee_delete",
      cache: false,
      success: function (html) {
        $("#content").html(html);
      },
    });
  });
  //просмотр графика "статистика сотрудников"
  $("#btn05").click(function () {
    $.ajax({
      url: "employee.php?type=grapg2&q=1",
      cache: false,
      success: function (html) {
        $("#content").html(html);
      },
    });
  });
  //добавление товара
  $("#btn06").click(function () {
    $.ajax({
      url: "add_tovar_form.php",
      cache: false,
      success: function (html) {
        $("#content").html(html);
      },
    });
  });
});
//вывод сотрудников
$(document).ready(function () {
  $("#get_employee").change(function () {
    clearlist();
    var countryvalue = $("#get_employee option:selected").val();
  });
});
//вывод в поле input id сотрудника
function getValue() {
  var select = document.getElementById("get_employee");
  var value = select.value;
  //alert(value);
  $(".id_employee").html(
    '<input type="hidden" id="target" name="target" value="" />'
  );

  input = document.getElementById("target");
  target.value = value;
  // return value;
}
//функция регистрации
function registration() {
  $.ajax({
    url: "register.php",
    type: "POST",
    data: {
      surname: $("#surname").val(),
      name: $("#name").val(),
      patronymic: $("#patronymic").val(),
      phone: $("#phone").val(),
      id_position: $("#target").val(),
      login: $("#login").val(),
      password: $("#password").val(),
    },
    success: function () {
      alert("Добавлен");
    },
  });
}
//функция добавления товара
function addtovar() {
  $.ajax({
    url: "register.php?type=add_tovar",
    type: "POST",
    data: {
      id_type: $("#target").val(),
      name: $("#name").val(),
      cost: $("#cost").val(),
      description: $("#description").val(),
      picture: $("#file_name").val(),
      zerna: $("#zerna").val(),
      maslo: $("#maslo").val(),
      sahar: $("#sahar").val(),
      kaka: $("#kaka").val(),
      targett: $("#targett").val(),
    },
    success: function () {
      alert();
    },
  });
}
//для удаления сотрудников
function callCrudAction(action, id) {
  var queryString;
  switch (action) {
    case "delete":
      queryString = "action=" + action + "&message_id=" + id;
      break;
  }
  jQuery.ajax({
    url: "crud_action.php",
    data: queryString,
    type: "POST",
    success: function (data) {
      switch (action) {
        case "delete":
          $("#message_" + id).fadeOut();
          break;
      }
    },
    error: function () {},
  });
}
//функция для пагинации
function getresult(url) {
  $.ajax({
    url: url,
    type: "GET",
    data: {
      rowcount: $("#rowcount").val(),
    },
    success: function (data) {
      $("#pagination-result").html(data);
    },
    error: function () {},
  });
}
//комбобокс для просмотра статистики сотрудников
function showPeriod(str) {
  $.ajax({
    url: "employee.php?type=grapg2&q=" + str,
    cache: false,
    success: function (html) {
      $("#content").html(html);
    },
  });
}
