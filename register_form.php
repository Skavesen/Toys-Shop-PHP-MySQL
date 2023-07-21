<form method="POST">
    <div>
        <label class="form-label" for=""><b>Фамилия</b></label>
        <input type="text" class="form-control" placeholder="Введите фамилию" name="surname" id="surname" required>
        <p></p>
        <label class="form-label" for=""><b>Имя</b></label>
        <input type="text" class="form-control" placeholder="Введите имя" name="name" id="name" required>
        <p></p>
        <label class="form-label" for=""><b>Отчество</b></label>
        <input type="text" class="form-control" placeholder="Введите отчество" name="patronymic" id="patronymic" required>
        <p></p>
        <label class="form-label" for=""><b>Телефон</b></label>
        <input type="phone" class="form-control" placeholder="Введите телефон" name="phone" id="phone" required>
        <p></p>
        <label class="form-label" for=""><b>Должность</b></label>
        <div id="employee"></div>
        <script>
            $.ajax({
                url: "employee.php?type=position",
                cache: false,
                success: function(html) {
                    $("#employee").html(html);
                },
            });
        </script>
        <div class="id_employee"></div>
        <p></p>
        <label class="form-label" for=""><b>Логин</b></label>
        <input type="text" class="form-control" placeholder="Введите логин" name="login" id="login" required>
        <p></p>
        <label class="form-label" for=""><b>Пароль</b></label>
        <input type="password" class="form-control" placeholder="Введите пароль" name="paswword" id="paswword" required>
        <p></p>
        <a href="#" class="btn btn-primary btn-block" onclick="registration()">Добавить работника</a>
    </div>
</form>
