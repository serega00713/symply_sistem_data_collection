<!doctype html>
<html lang="ru">
<head>
  <title>Поиск</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
	<?php
    $host = 'localhost';  // Хост, у нас все локально
    $user = 'root';    // Имя созданного вами пользователя
    $pass = ''; // Установленный вами пароль пользователю
    $db_name = 'practica';   // Имя базы данных
    $link = mysqli_connect($host, $user, $pass, $db_name); // Соединяемся с базой

    // Ругаемся, если соединение установить не удалось
    if (!$link) {
      echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
      exit;
    }
   	?>
    <div class="container">
    <hr class="mb-4">
    <div class="table-responsive">
  	<table class="table table-striped">
    <tr>
      <td>ID</td>
      <td>Имя</td>
      <td>Фамилия</td>
      <td>Рост</td>
      <td>Вес</td>
      <td>Группа крови</td>
      <td>Дата осмотра</td>
    </tr>
    <?php
    	$sql = mysqli_query ($link, "SELECT `ID`, `Name`, `Surname`,  `Height`, `Weight`, `Blood`, `Date` FROM `pacient` ORDER BY `Date` ASC");
      	while ($result = mysqli_fetch_array($sql)) {
        echo '<tr>' .
             "<td>{$result['ID']}</td>" .
             "<td>{$result['Name']}</td>" .
             "<td>{$result['Surname']}</td>" .
             "<td>{$result['Height']}</td>" .
             "<td>{$result['Weight']}</td>" .
             "<td>{$result['Blood']}</td>" .
             "<td>{$result['Date']}</td>" .
             '</tr>';
      	}
    ?> 
 	</table>
 </div>
	<p><a href="MainMenu.html" class="btn btn-primary btn-lg btn-block">Вернуться на главную</a></p>
  </div> 
</body>