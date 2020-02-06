<!doctype html>
<html lang="ru">
<head>
  <title>Редактирование</title>
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

    //Если переменная Name передана
    if (isset($_POST["Name"])) {
      //Если это запрос на обновление, то обновляем
      if (isset($_GET['red_id'])) {
          $sql = mysqli_query($link, "UPDATE `pacient` SET `Name` = '{$_POST['Name']}',`Surname` = '{$_POST['Surname']}', `Height` = '{$_POST['Height']}', `Weight` = '{$_POST['Weight']}', `Blood` = '{$_POST['Blood']}', `Date` = '{$_POST['Date']}' WHERE `ID`={$_GET['red_id']}");
      } else {
          //Иначе вставляем данные, подставляя их в запрос
          $sql = mysqli_query($link, "INSERT INTO `pacient` (`Name`, `Surname`, `Height`, `Weight`, `Blood`, `Date`) VALUES ('{$_POST['Name']}', '{$_POST['Surname']}', '{$_POST['Height']}', '{$_POST['Weight']}', '{$_POST['Blood']}', '{$_POST['Date']}')");
      }

      //Если вставка прошла успешно
      if ($sql) {
        
      } else {
        echo '<p>Произошла ошибка: ' . mysqli_error($link) . '</p>';
      }
    }

    if (isset($_GET['del_id'])) { //проверяем, есть ли переменная
      //удаляем строку из таблицы
      $sql = mysqli_query($link, "DELETE FROM `pacient` WHERE `ID` = {$_GET['del_id']}");
      if ($sql) {
        echo "<p>Пациент удален.</p>";
      } else {
        echo '<p>Произошла ошибка: ' . mysqli_error($link) . '</p>';
      }
    }

    //Если передана переменная red_id, то надо обновлять данные. Для начала достанем их из БД
    if (isset($_GET['red_id'])) {
      $sql = mysqli_query($link, "SELECT `ID`, `Name`, `Surname`, `Height`, `Weight`, `Blood`, `Date`  FROM `pacient` WHERE `ID`={$_GET['red_id']}");
      $pacient = mysqli_fetch_array($sql);
    }
  ?>
  <h2 class="text-center pt-3">Редактирование</h2>
  <form action="" method="post">
    <div class="container">
      <ul>
<li>Пациенты отсортированы по их ID;</li>
<li>Редактирование осуществляется следующим образом:</li>
<ol>
<li>В таблице ниже выбирается пациент, данные которого надо отредактировать;</li>
<li>Напротив его ID нажмите кнопку "Изменить";</li>
<li>Автоматически заполнится форма с текущими данными - их можно изменить;</li>
<li>Нажмите кнопку Сохранить изменения.</li>
</ol>
<li>Для удаления данных о пациенте:</li>
<ol>
<li>В таблице ниже выбирается пациент, информацию о котором надо удалить;</li>
<li>Напротив его ID нажмите кнопку "Удалить";</li>
<li>Данные пациента успешно удалены</li>
</ol>
</ul>

      <div class="mb-3">

        <label>Имя</label>

        <input type="text" class="form-control" name="Name" value="<?= isset($_GET['red_id']) ? $pacient['Name'] : ''; ?>">

      </div>

      <div class="mb-3">

        <label>Фамилия</label>

        <input type="text" class="form-control" name="Surname" value="<?= isset($_GET['red_id']) ? $pacient['Surname'] : ''; ?>">

      </div>

      <div class="mb-3">

        <label>Рост</label>

        <input type="text" class="form-control" name="Height" value="<?= isset($_GET['red_id']) ? $pacient['Height'] : ''; ?>">

      </div>

      <div class="mb-3">

        <label>Вес</label>

        <input type="text" class="form-control" name="Weight" value="<?= isset($_GET['red_id']) ? $pacient['Weight'] : ''; ?>">

        </div>

      <div class="mb-3">

        <label>Группа крови (Требуется ввести вручную пример: [IV+, III-])</label>

        <input type="text" class="form-control" name="Blood" value="<?= isset($_GET['red_id']) ? $pacient['Blood'] : ''; ?>">

      </div>  

      <div class="mt-3 mb-3">

        <label>Дата</label>

        <input type="date" class="form-control" name="Date" value="<?= isset($_GET['red_id']) ? $pacient['Date'] : ''; ?>">

      </div>

      <button class="btn btn-primary btn-lg btn-block" type="submit">Сохранить</button>
      
  </form>
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
      <td>Удаление</td>
      <td>Редактирование</td>
    </tr>
    <?php
      $sql = mysqli_query($link, "SELECT `ID`, `Name`, `Surname`,  `Height`, `Weight`, `Blood`, `Date` FROM `pacient` ORDER BY `ID`");
      while ($result = mysqli_fetch_array($sql)) {
        echo '<tr>' .
             "<td>{$result['ID']}</td>" .
             "<td>{$result['Name']}</td>" .
             "<td>{$result['Surname']}</td>" .
             "<td>{$result['Height']}</td>" .
             "<td>{$result['Weight']}</td>" .
             "<td>{$result['Blood']}</td>" .
             "<td>{$result['Date']}</td>" .
             "<td><a href='?del_id={$result['ID']}'>Удалить</a></td>" .
             "<td><a href='?red_id={$result['ID']}'>Изменить</a></td>" .
             '</tr>';
      }
    ?>
  </table>
</div>
<p><a href="MainForm.html" class="btn btn-primary btn-lg btn-block"">Добавить нового пациента</a></p>
<p><a href="MainMenu.html" class="btn btn-primary btn-lg btn-block"">Вернуться на главную</a></p>
</div> 
</body>
</html>