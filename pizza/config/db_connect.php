<?php
//connection Mysqli(MySql improve) or pdo(php data object)
 //1.connect to database (localhost,name, password,database)
 $conn = mysqli_connect('localhost','vennesa','vennesa','vicky_pizza');

 //2.check connection
 if(!$conn){
     echo 'Connection error: '. mysqli_connect_error();
 }

?>