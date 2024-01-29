<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Заказы</title>
    </head>
    <body>
        <div class='container'>
            <table class='user-data'>
                <thead>
                    <?php
                        INCLUDE_ONCE 'db.php';
                        $sql = "SELECT * FROM `reviews`";
                        $result = pdo()->query($sql);

                        if($row = $result->fetch(PDO::FETCH_ASSOC) )
                        {                   
                            $encoded = json_encode($row);
                            $data    = json_decode($encoded, true);   
                            echo '<tr>';
                            // foreach ($data as $key => $value)
                            // echo '<th>' . $key . " " . '</th>';
                            echo "<th>message</th><th>model</th><th>equipment</th>";
                        }
                    ?>
                </thead>
                <tbody>
                    <?php
                        /* Удаление записи из БД */
                        if(isset($_GET['delete_id']) )
                        {
                            $sql = 'DELETE FROM reviews WHERE id = :del_id';
                            try
                            {
                                pdo()->prepare($sql)->execute(array('del_id' => $_GET['delete_id']) );
                                
                                header("Location: OTZOVIK.RU.php");
                            }
                            catch(PDOException $e) {
                                print "Error!: " . $e->getMessage();
                            }
                        }

                        $sql = "SELECT * FROM `reviews`";
                        $result = pdo()->query($sql);

                        while($result->fetch(PDO::FETCH_ASSOC) )
                        {
                            echo '<tr><form action="upd/update.php" method="get">';

                            // foreach ($row as $key => $value) {
                            //     // echo '<td><input type="hidden" name="' . $key . '"value="' . $value . '"> ' . $value . '</td>';
                            //     echo "<tr>";
                            //     echo "<td>".$row
                            //     echo "</tr>";
                            // }
                            // $sql_2 = "SELECT * FROM accounts WHERE id=$userid";
                            // if($result_2 = $conn->query($sql_2)){
                            //     $rowsCount_2 = $result_2->num_rows; // количество полученных строк

                            //     foreach($result_2 as $row_2){
                                
                            //             echo $row_2["name"] . " "; 
                            //             echo $row_2["surname"]  . " ";
                            //             echo $row_2["patronymic"] . " "; 
                                    
                            //     }
                            // }
                                // $result->free();
                            foreach ($result as $row){
                                echo "<tr>";

                                echo "<td>".$row['message']."</td>";
                                echo "<td>".$row['model']."</td>";
                                echo "<td>".$row['equipment']."</td>";
                                echo "</tr>";
                            }
                            echo "<td>";
                            echo "</form><br><a href='?delete_id={$row['id']}'><button class='option-btn'>Удалить</button></a></tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>