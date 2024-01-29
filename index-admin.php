<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style22.css">
    <title>Document</title>
</head>
<body>
  
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><h1>VIBER</h1><!--<img src="servic.jpg" style="width: 100px; height: 50px;" alt="">--></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Переключатель навигации">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="reviews.php">Заказы пользователей</a>

          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php">Заказать</a>

          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.html">Регистрация</a>

          </li>
          <li class="nav-item">
            <a class="nav-link" href="users/index.php">Cписок пользователей</a>
          </li>
          
        </ul>
      </div> 
    </div> 
   <a class="navbar-brand" href="#">
      <h1>
      <?php

session_start();
$userid=$_SESSION['usr_id'];
$conn = new mysqli("localhost", "root", "", "Poseidon");
if($conn->connect_error){
    die("Ошибка: " . $conn->connect_error);
}
$sql = "SELECT * FROM accounts WHERE id=$userid";
if($result = $conn->query($sql)){
    $rowsCount = $result->num_rows; // количество полученных строк

    foreach($result as $row){
      
            echo $row["name"] . " "; 
            echo $row["surname"]  . " ";
            echo $row["patronymic"] . " "; 
        
    }
   
    $result->free();
} else{
    echo "Ошибка: " . $conn->error;
}
$conn->close();

?>
      </h1>
   </a>
    
  </nav>
</div>



</body>
</html>