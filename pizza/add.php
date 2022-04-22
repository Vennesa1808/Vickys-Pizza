<?php 

include('config/db_connect.php');

$title = $email = $ingredient = '';
$errors = array('email'=> '', 'title'=> '','ingredient'=>'');
//checking the data input submit or not to the server 
//Post method is more secure because it was hidden
if(isset($_POST['submit'])){
   
    //check/validate email
    if(empty($_POST['email'])){
        $errors['email'] =  'An email is required <br/>';
    }else{
        //validating email format by using filter
        $email = $_POST['email'];
        //If the email input is not in email format
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $errors['email'] = 'Email must be a valid email address <br/>';

        }
    }

    //check/validate title
    if(empty($_POST['title'])){
        $errors['title'] = 'A title is required <br/>';
    }else{
        //validating tile format by using regular expression (regex)
        $title = $_POST['title'];
        if(!preg_match('/^[a-zA-Z\s]+$/',$title)){
            $errors['title'] = 'Title must be letter and spaces only <br/>';
        }
    }

    //check/validate ingredient
    if(empty($_POST['ingredient'])){
        $errors['ingredient']= 'At least one ingredient is required <br/>';
    }else{
         //validating ingredient format by using regular expression (regex)
         $ingredient = $_POST['ingredient'];
         if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/',$ingredient)){
            $errors['ingredient'] = 'Ingredient must be comma separated list <br/>';
         }
        
    }
    //checking form error or not
    if(array_filter($errors)){
       //echo 'errors in the form';
    }
    else{
        //the input will be store in database using the $email variable
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $ingredient = mysqli_real_escape_string($conn, $_POST['ingredient']);

        //create sql to save the database
        $sql = "INSERT INTO pizzas(title,email,ingredient) VALUES ('$title' ,'$email', '$ingredient')";

        //save to the database
        if(mysqli_query($conn, $sql)){
            //success
        }else{
            //error 
            echo 'Query error: ' .mysqli_error($conn);
        }
       // echo 'form is valid';
       //if there is no error, after submitt user will redirect to index page
       header('Location: index.php');
    }
}//end of post check

//htmlspecialchars=> turning any malicious sentences like certain  special html charactes
//like angle bracket and quotes into html entity




?>


<!DOCTYPE html>
<html lang="en">

<?php include('template/header.php');?>

<section class="container grey-text">
    <h4 class="center">Add a Pizza</h4>
    <form class="white" action="add.php" method="POST">
        <label>Your Email: </label>
        <input type="text" name="email" value = "<?php echo $email ?>">
        <div class="red-text"><?php echo $errors['email']; ?></div>

        <label>Pizza title: </label>
        <input type="text" name="title" value = "<?php echo $title ?>">
        <div class="red-text"><?php echo $errors['title']; ?></div>

        <label>Ingredients (comma separated): </label>
        <input type="text" name="ingredient" value = "<?php echo $ingredient ?>">
        <div class="red-text"><?php echo $errors['ingredient']; ?></div>

        <div class="center">
            <input type="submit" name="submit" value="submit" class="btn-brand z-depth-0">
        </div>
    </form>
</section>

<?php include('template/footer.php');?>

</html>