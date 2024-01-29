<?php
    include_once '../db.php';
    
    if(isset($_POST) )
    {
        try
        {
            $name       = $_POST['reg_name'];
            $surname    = $_POST['reg_surname'];
            $patronymic = $_POST['reg_patronymic'];
            $phone      = $_POST['reg_phone'];
            $email      = $_POST['reg_email'];
            $login      = $_POST['reg_login'];
            $password   = $_POST['reg_password'];

            $sql = "INSERT INTO accounts (name, surname, patronymic, phone, email, login, password)
            VALUES (:name, :surname, :patronymic, :phone, :email, :login, :password)";
            
            try 
            {
                pdo()->prepare($sql)->execute( 
                    array(
                        ":name" => $name, 
                        ":surname" => $surname, 
                        ":patronymic" => $patronymic, 
                        ":phone" => $phone, 
                        ":email" => $email, 
                        ":login" => $login, 
                        ":password" => $password
                    ) 
                );

                echo "data has been sended to database!";
            }
            catch(PDOException $e) {
                print "Statement Error!: " . $e->getMessage();
            }
        }
        catch (PDOException $e) {
            print "Database error: " . $e->getMessage();
        }
    }
?>