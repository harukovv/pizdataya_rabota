<?php
    include_once __DIR__.'/db/db.php';

    $user = null;
    
    if (check_auth() ) 
    {
        $stmt = pdo()->prepare("SELECT * FROM `accounts` WHERE `id` = :id");
        $stmt->execute(['id' => $_SESSION['usr_id']]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    }
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Главная</title>
		<link rel="stylesheet" href="css/main.css">
	</head>
	<body>
        <header>
            <?php 
                if ($user != null) 
                { 
            ?>
            <div class="header-wrapper">
                <div class="current-user">
                    <p><?=$user['login']?></p>
                </div>

                <button class="loginbutton"><a href="login.html">выйти</a></button>
            <?php 
                } 
                else 
                { 
                    header("Location: ../login.html");
                }
            ?>
            </div>
        </header>
        <div class="main-container">
            <form action="db/reviews/handler.php" method="post">
                <p>Заказ</p>
                <input type="hidden" name="usr_id" value="<?=$_SESSION['usr_id']?>">
                <input type="text" name="message" placeholder="Цвет лодки">
                <input type="text" name="model" placeholder="Модель Лодки">
                <input type="text" name="equipment" placeholder="комплектации">
                <input type="submit" value="Отправить Заказ">
            </form>
        </div>
	</body>
</html>