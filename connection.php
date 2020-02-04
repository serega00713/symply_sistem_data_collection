<!DOCTYPE html>
<html>
<head>
	<title>Добавление в бд</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
<?php
$ID = filter_input(INPUT_POST, 'ID');
$Name = filter_input(INPUT_POST, 'Name');
$Surname = filter_input(INPUT_POST, 'Surname');
$Height = filter_input(INPUT_POST, 'Height');
$Weight = filter_input(INPUT_POST, 'Weight');
$Blood = filter_input(INPUT_POST, 'Blood');
$Date = filter_input(INPUT_POST, 'Date');

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "practica";
// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);
$sql = "INSERT INTO pacient (ID, Name, Surname, Height, Weight, Blood, Date)
values ('$ID','$Name', '$Surname', '$Height', '$Weight', '$Blood', '$Date')";
if ($conn->query($sql)){
echo '<div class="alert alert-success center" role="alert">
  Запись о пациенте успешно добавлена
</div>';
}
else{
echo '<div class="alert alert-danger" role="alert">
  Пациент с таким ID уже был на приемах, измените его данные на странице редактирования! (а так же придерживайтесь условиям в скобочках)
</div>';
}
?>
<div class="container">
<p><a href="MainForm.html" class="btn btn-primary btn-lg btn-block"">Добавить нового пациента</a></p>
<p><a href="MainMenu.html" class="btn btn-primary btn-lg btn-block"">Вернуться на главную</a></p>
</div>
</body>
</html>