<?php 
 
 include('config/db_connect.php');

 //3.write query for all pizzas
 $sql = 'SELECT title,ingredient,id FROM pizzas ORDER BY created_at';

 //4.make query and get result
 $result = mysqli_query($conn, $sql);

 //5.fetch the resulting row as an array
 $pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

 //free result from memory (optional)
 mysqli_free_result($result);

 //close connection
 mysqli_close($conn);

//splitting the string
 //(explode(',', $pizzas[0]['ingredient']);

?>


<!DOCTYPE html>
<html lang="en">

<?php include('template/header.php');?>

<h4 class="center gray-text">Pizzas!</h4>

<div class="container">
    <div class="row">
        <?php foreach($pizzas as $pizza): ?>

            <div class="col s6 md3">
                <div class="card z-depth-0">
                    <img src="img/pizza.svg" class="pizza">
                    <div class="card-content center">
                        <h6><?php echo htmlspecialchars($pizza['title']);?></h6>
                        <ul>
                           <?php foreach(explode(',',$pizza['ingredient']) as $ing): ?>
                            <li><?php echo htmlspecialchars($ing)?></li>
                           <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class = "card-action left-align">
                      <a href="detail.php?id=<?php echo $pizza['id'] ?>" class="brand-text">More Info</a>  
                    </div>
                </div>
            </div>

        <?php endforeach; ?>

    </div>
</div>


<?php include('template/footer.php');?>


    

</html>