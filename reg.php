<?
session_start();

if(!empty($_SESSION['login']))
{
    echo 'Hello '.$_SESSION['login'];
}
if ($_POST['reg']) {

    $login = $_POST['login'];
    $pass = $_POST['pass'];
    $pass_repeat = $_POST['pass-repeat'];
    $email = $_POST['email'];
    $name = $_POST['name'];

    if (!empty($login) and !empty($pass) and !empty($pass_repeat) and !empty($email) and !empty($name)) {
        $db = @new mysqli('localhost', 'root', '', 'shop');
        if ($db->connection_errno) {
            echo "error: " . $db->connection_errno;
        } else {
            
            if($pass == $pass_repeat) {

            $query = $db->query("INSERT INTO `Users`(`login`, `pass`, `email`, `name`) 
            VALUES ('$login','$pass','$email','$name')");

                //проверка на совпадение логинов
                if($query) {
                    header("location: /"); 
                } else {
                    echo'логин уже существует';
                }

            } else{
               echo'Пароли не совпадают';
            }

        }
    }

}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>Document</title>
    
</head>

<body>

<h1>Регистрация</h1>

<?if($_SESSION['auth'] != true){?>

    <div class="box">

    <form method="post" >

        <input type="text" class="back1" name="login" placeholder="Введите логин" required><br>
        <input type="password" class="back2" name="pass" placeholder="Введите пароль" required><br>
        <input type="password" class="back3" name="pass-repeat" placeholder="Повторите пароль" required><br>
        <input type="text" class="back4" name="email" placeholder="Введите email" required><br>
        <input type="text" class="back5" name="name" placeholder="Введите имя" required><br>
        <input type="submit" value="Войти" name="reg">
    </form>
    <?}?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>