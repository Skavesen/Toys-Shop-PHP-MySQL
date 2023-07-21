<?session_start();?>
  <title>Авторизация</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="shortcut icon" href="https://www.rudebox.org.ua/favicon.ico"/>
  <style>
.login-page
{
  background-color:#e5e7ed
}
.login-page main
{
  width:100%;
  max-width:460px;
  margin:8% auto 5%
}
.login-block
{
  background-color:#fff;
  padding:60px;
  -webkit-box-shadow:0 3px 50px 0 rgba(0,0,0,.1);
  box-shadow:0 3px 50px 0 rgba(0,0,0,.1);
  text-align:center;
  border-radius:5px
}
.login-block h1,.login-block h6
{
  font-family:Open Sans,sans-serif;
  color:#96a2b2;
  letter-spacing:1px
}
.login-block h1
{
  font-size:22px;
  margin-bottom:60px;
  margin-top:40px
}
.login-block h6
{
  font-size:11px;
  text-transform:uppercase;
  margin-top:0
}
.login-block .form-group
{
  margin-top:15px;
  margin-bottom:15px;
}
.login-block .form-control,.login-block .form-control:focus,.login-block .input-group-addon,.login-block .input-group-addon:focus
{
  background-color:transparent;
  border:none;
}
.login-block .form-control
{
  font-size:17px;
  border-radius:0px;
}
.login-block input:-webkit-autofill
{
  /*-webkit-box-shadow:0 0 0 1000px #fff inset;*/
  -webkit-text-fill-color:#818a91;
  -webkit-transition:none;
  -o-transition:none;
  transition:none;
}
.login-block .input-group-addon
{
  color:#29aafe;
  font-size:19px;
  opacity:.5
}
.login-block .btn-block
{
  margin-top:30px;
  padding:15px;
  background:#99b4ff;
  border-color:#29aafe;
}
.login-block .hr-xs
{
  margin-top:5px;
  margin-bottom:5px
}
.login-footer
{
  margin-top:60px;
  opacity:.5;
  -webkit-transition:opacity .3s ease-in-out;
  -o-transition:opacity .3s ease-in-out;
  transition:opacity .3s ease-in-out
}
.login-footer:hover
{
  opacity:1
}
.login-links
{
  padding:15px 5px 0;
  font-size:13px;
  color:#96a2b2
}
.login-links:after
{
  content:'';
  display:table;
  clear:both
}
.login-links a
{
  color:#96a2b2;
  opacity:.9
}
.login-links a:hover
{
  color:#29aafe;
  opacity:1
}
@media (max-width:767px)
{
  .login-page main
  {
    position:static;
    top:auto;
    left:auto;
    -webkit-transform:none;
    -o-transform:none;
    transform:none;
    padding:30px 15px
  }
  .login-block{padding:20px}}
.social-icons
{
  padding-left:0;
  margin-bottom:0;
  list-style:none
}
.social-icons li
{
  display:inline-block;
  margin-bottom:4px
}
.social-icons li.title
{
  margin-right:15px;
  text-transform:uppercase;
  color:#96a2b2;
  font-weight:700;
  font-size:13px
}
.social-icons a{
  background-color:#eceeef;
  color:#818a91;
  font-size:16px;
  display:inline-block;
  line-height:44px;
  width:44px;
  height:44px;
  text-align:center;
  margin-right:8px;
  border-radius:100%;
  -webkit-transition:all .2s linear;
  -o-transition:all .2s linear;
  transition:all .2s linear
}
.social-icons a:active,.social-icons a:focus,.social-icons a:hover
{
  color:#fff;
  background-color:#29aafe
}
.social-icons.size-sm a
{
  line-height:34px;
  height:34px;
  width:34px;
  font-size:14px
}
.social-icons a.facebook:hover
{
  background-color:#3b5998
}
.social-icons a.rss:hover
{
  background-color:#f26522
}
.social-icons a.google-plus:hover
{
  background-color:#dd4b39
}
.social-icons a.twitter:hover
{
  background-color:#00aced
}
.social-icons a.linkedin:hover
{
  background-color:#007bb6
}
</style>

<body>
  <body class="login-page">
    <main>
      <div class="login-block">
        <img src="img/1.png" alt="Scanfcode">
        <h1>Вход в систему</h1>
        <form method="POST">
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-user ti-user"></i></span>
              <input type="text" class="form-control" name="email" placeholder="Логин">
            </div>
          </div>          
          <hr class="hr-xs">
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-lock ti-unlock"></i></span>
              <input type="password" class="form-control" name="password" placeholder="Пароль">
            </div>
          </div>
          <button class="btn btn-primary btn-block" type="submit" name="dologin" >ВХОД</button>          
        </form>
      </div>
    </main>    
</body>
<?php
//$_SESSION['user_id_position'] = 0;
require_once "conection.php";
if (isset($_POST['dologin'])) {
	if (isset($_POST['email']) && isset($_POST['password'])) {

		//немного профильтруем логин
		$login = mysqli_real_escape_string($DataBaseHandle, htmlspecialchars($_POST['email']));
		//хешируем пароль т.к. в базе именно хеш
		$password = md5(md5(trim($_POST['password'])));
		// проверяем введенные данные
		$query = "SELECT * FROM employee WHERE `login`= '$login' AND `password` = '$password' LIMIT 1";
		$sql = mysqli_query($DataBaseHandle, $query) or die(mysqli_error($DataBaseHandle));
		// если такой пользователь есть
		if (mysqli_num_rows($sql) == 1) {
			$row = mysqli_fetch_assoc($sql);
			//ставим метку в сессии 
		$_SESSION['user_id_position'] = $row['id_position'];
		$_SESSION['user_id'] = $row['id_employee'];
		$_SESSION['user_login'] = $row['login'];
			//ставим куки и время их хранения 10 дней			
      setcookie("CookieMy", $row['login'], time() + 60 * 60 * 24 * 10);
			// Переадресовываем браузер на страницу проверки нашего скрипта
         ?> <script>
				window.setTimeout(function() {
					window.location = 'index2.php';
				}, 10)
			</script><?

					} else {
						//если пользователя нет, то пусть пробует еще
						
					}
				}
			}
			if (isset($_SESSION['user_id'])) {
				//echo htmlspecialchars($_SESSION['user_id_position']/*$_SESSION['user_email']*/) . " <br />" . "Вы авторизованы <br />
				//Т.е. мы проверили сессию и можем открыть доступ к определенным данным";
        
			} else {
				$login = '';
				//проверяем куку, может он уже заходил сюда
				if (isset($_COOKIE['CookieMy'])) {
					$login = htmlspecialchars($_COOKIE['CookieMy']);
				}
			}
						?>
