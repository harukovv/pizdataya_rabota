<?php 
    try
    {
        $db = new PDO("mysql:host=localhost; dbname=Poseidon", "root", "");
    }
    catch (PDOException $e)
    {
        print "Database Error!: ". $e->getMessage();
    }
?>

<!DOCTYPE html>
    <html>
        <head>
            <title>Обновление данных</title>
            <meta charset="utf-8" />
            <link rel="stylesheet" href="css/style.css">
        </head>
    <body>
        <div class="container">
            <?php
                if($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"]) )
                   {
                    $userid = $_GET["id"];
                    $sql = "SELECT * FROM accounts WHERE id = $userid";
                    $result = $db->query($sql);
                    if($row = $result->fetch(PDO::FETCH_ASSOC) )
                    {
                        if($result->rowCount() > 0)
                        {
                            $name       = $row['name'];
                            $surname    = $row['surname'];
                            $patronymic = $row['patronymic'];
                            $phone      = $row['phone'];
                            $email      = $row['email'];
                            $login      = $row['login'];
                            $password   = $row['password'];

                            echo "<h3>Обновление пользователя</h3>
                                <form method='post'>
                                    <input type='hidden' name='id' value=\"$userid\" />
                                    <p>ИМЯ:
                                        <input type='text' name='name' value='$name' />
                                    </p>
                                    <p>ФАМИЛИЯ:
                                        <input type='text' name='surname' value='$surname' />
                                    </p>
                                    <p>ОТЧЕСТВО:
                                        <input type='text' name='patronymic' value='$patronymic' />
                                    </p>
                                    <p>НОМЕР ТЕЛЕФОНА:
                                        <input type='text' name='phone' value='$phone' />
                                    </p>
                                    <p>ЭЛ. ПОЧТА:
                                        <input type='text' name='email' value='$email' />
                                    </p>
                                    <p>ЛОГИН:
                                        <input type='text' name='login' value='$login' />
                                    </p>
                                    <p>ПАРОЛЬ:
                                        <input type='text' name='password' value='$password' />
                                    </p>
                                    <div class='submit-btn'>
                                        <input type='submit' value='Сохранить'>
                                    </div>
                            </form>";
                        }
                        else
                        {
                            echo "<div>Пользователь не найден</div>";
                        }
                    } 
                    else
                    {
                        echo "Somthin went wronk";
                    }
                }
                elseif (isset( $_POST["id"] ) && isset( $_POST["name"] ) && isset( $_POST["surname"] ) && isset( $_POST["patronymic"] ) && isset( $_POST["phone"] ) 
                    && isset( $_POST["email"] ) && isset( $_POST["login"] ) && isset( $_POST["password"] ) 
                ) 
                {
                    $data = [
                        'name' => $_POST['name'],
                        'surname' => $_POST['surname'],
                        'patronymic' => $_POST['patronymic'],
                        'phone' => $_POST['phone'],
                        'email' => $_POST['email'],
                        'login' => $_POST['login'],
                        'password' => $_POST['password'],
                        'id' => $_POST["id"],
                    ];

                    $sql = "UPDATE accounts SET name=:name, surname=:surname, patronymic=:patronymic, phone=:phone, email=:email, login=:login, password=:password WHERE id=:id";

                    try 
                    {
                        $db->prepare($sql)->execute($data);   
                        echo "<p class='data-success'>" . $_POST["id"] . " </p><br><a href='../index.php'>Вернуться к списку пользователей</a>";
                    }
                    catch(PDOException $e) {
                        print "Statement Error!: " . $e->getMessage();
                    }           
                }
                else
                {
                    echo "Некорректные данные";
                }

                $db = null;
            ?>
        </div>
    </body>
</html>