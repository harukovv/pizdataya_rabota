<?php 
    try
    {
        $db = new PDO("mysql:host=localhost; dbname=Poseidon", "root", "");
    }
    catch (PDOException $e) {
        print "Database Error!: ". $e->getMessage();
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Список пользователей Посейдона</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div class='container'>
            <table class='user-data'>
                <thead>
                    <?php
                        $sql = "SELECT * FROM `accounts`";
                        $result = $db->query($sql);

                        if($row = $result->fetch(PDO::FETCH_ASSOC) )
                        {                   
                            $encoded = json_encode($row);
                            $data    = json_decode($encoded, true);
                                
                            echo '<tr>';

                            // foreach ($data as $key => $value)
                            //     echo '<th>' . $key . " " . '</th>';
                            echo "<th>name</th>";
                                echo "<th>surname</th>";
                                echo "<th>patronymic</th>";
                                echo "<th>phone</th>";
                                echo "<th>email</th>";
                                echo "<th>login</th>";
                                echo "<th>password</th>";
                        }
                    ?>
                </thead>
                <tbody>
                    <?php
                        if(isset($_GET['delete_id']) )
                        {
                            $sql = 'DELETE FROM accounts WHERE id = :del_id';

                            try
                            {
                                $db->prepare($sql)->execute(array('del_id' => $_GET['delete_id']) );
                                
                                header("Location: index.php");
                            }
                            catch(PDOException $e) {
                                print "Error!: " . $e->getMessage();
                            }
                        } 
                        $sql = "SELECT * FROM `accounts`";
                        $result = $db->query($sql);

                        while($result->fetch(PDO::FETCH_ASSOC) )
                        {
                            echo '<tr><form action="upd/update.php" method="get">';

                            // foreach ($row as $key => $value) 
                            //     echo '<td><input type="hidden" name="' . $key . '"value="' . $value . '"> ' . $value . '</td>';

                            foreach ($result as $row){
                                echo "<tr>";
                                echo "<td>".$row['name']."</td>";
                                echo "<td>".$row['surname']."</td>";
                                echo "<td>".$row['patronymic']."</td>";
                                echo "<td>".$row['phone']."</td>";
                                echo "<td>".$row['email']."</td>";
                                echo "<td>".$row['login']."</td>";
                                echo "<td>".$row['password']."</td>";
                                
                                echo "</tr>";
                            }
                            echo "<td><input class='option-btn' type='submit' value='Изменить'>";
                            echo "</form><br><a href='?delete_id={$data['id']}'><button class='option-btn'>Удалить</button></a></tr>";
                        }
                    ?>
                </tbody>
            </table>
            <button class="back-btn"><a href="../">На главную</a></button>
        </div>
    </body>
</html>