<?php
    include_once '../db.php';
    if($_SERVER["REQUEST_METHOD"] === "POST")
    {
        $message = $_POST['message'];
        $model = $_POST['model'];
        $equipment = $_POST['equipment'];

        $sql = "INSERT INTO reviews (id, message, model, equipment)
            VALUES (:id, :message, :model, :equipment)";
            
        try 
        {
            pdo()->prepare($sql)->execute( 
                [
                    ":id" => $_POST['id'], 
                    ":message" => $message, 
                    ":model" => $model, 
                    ":equipment" => $equipment, 
                ]
            );

            echo "Заказ Сделан<br>";
        }
        catch(PDOException $e) {
            print "Statement Error!: " . $e->getMessage();
        }

    }
?>
<button class="review-exit-button"><a href="../../">.....</a></button>
