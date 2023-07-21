<form method="POST">
    <div class="col-md-12">
        <label class="form-label" for="typeproduct">Тип товара</label>
        <select class="form-control" id="typeproduct" name="typeproduct">
                            <option>Выберите тип товара</option>
                            <option value="1">Конструкторы лего</option>
                            <option value="2">Куклы барби</option>
                            <option value="3">Железная дорога</option>
                            <option value="4">Большие медведи</option>
                            <option value="5">Мягкие игрушки</option>
                            <option value="6">Пазлы</option>
                            <option value="7">Машинки</option>
                    </select>
        <script>
            /*  $.ajax({
                url: "employee.php?type=type_tovar",
                cache: false,
                success: function(html) {
                    $("#employee").html(html);
                },
            });*/
            $(document).ready(function() {
                $('#typeproduct').change(function() {
                    var select = document.getElementById("typeproduct");
                    var value = select.value;
                    $(".id_employee").html(
                        '<input  id="target" name="target" value="" />' /*type="hidden" */
                    );

                    input = document.getElementById("target");
                    target.value = value;
                });
            });
        </script>
        <div class="id_employee"></div>
        <div class="form-group">
            <label for="name">Название</label>
            <input class="form-control" type="text" size="3" id="name">
        </div>
        <div class="form-group">
            <label for="cost">Цена</label>
            <input class="form-control" type="number" size="3" min="1" value="1" id="cost">
        </div>
        <div class="form-group">
            <label for="description">Описание</label>
            <textarea class="form-control" id="description" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="photo">Выберите фото</label>
            <input type="file" class="form-control-file" id="photo" name="photo" multiple accept=".jpg,.jpeg,.png">
        </div>
        <div class="userfile_name"></div>
        <script type="text/javascript">
            $('#photo').change(function(e) {
                $(".userfile_name").html(
                    '<input  id="file_name" name="file_name" value="" />' /*type="hidden" */
                );
                input = document.getElementById("file_name");
                file_name.value = this.files[0].name;
            })
        </script>
        <style>
            .text-justify {
                text-align: justify;
            }
        </style>       
        
        <a href="#" class="btn btn-primary btn-block" onclick="addtovar()">Добавить товар</a>
    </div>
</form>