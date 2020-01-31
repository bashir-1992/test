<?php 

include("config/db_connect.php");

$email = $title = $ingredienten = "";
$errors = array("email"=>"", "title"=>"", "ingredienten"=>"");

if (isset($_POST["submit"])) {

    // check email
    if  (empty($_POST["email"])) {
        $errors["email"] = "een email is verplicht! <br>";
    }
    else {
        $email = $_POST["email"];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors["email"] = "Voer een echte email in!"; 
        }
    }

        // check title
    if  (empty($_POST["title"])) {
        $errors["title"] = "een title is verplicht! <br />";
    }
    else {
        $title = $_POST["title"];
        if (!preg_match('/^[a-zA-Z\s]+$/', $title)) {
            $errors["title"] = "Title moet alleen letters en spatie <br>";
        }
    }

        // check ingredienten
    if  (empty($_POST["ingredienten"])) {
        $errors["ingredienten"] = "ingrdienten zijn verplicht!";
    }
    else {
        $ingredienten = $_POST["ingredienten"];
        if (!preg_match('/^([a-zA-Z\s])+(,\s*[a-zA-Z\s]*)*$/', $ingredienten)) {
            $errors["ingredienten"] = "tussen ingredienten comma's!";
        }
    }
    if (array_filter($errors)) {
        
    } else {

        $email = mysqli_real_escape_string($conn, $_POST["email"]);
        $title = mysqli_real_escape_string($conn, $_POST["title"]);
        $ingredienten = mysqli_real_escape_string($conn, $_POST["ingredienten"]);

        // create sql variable
        $sql = "INSERT INTO pizza(title,email,ingredienten) VALUES('$title', '$email', '$ingredienten')";

        // save to db and check
        if (mysqli_query($conn, $sql)) {
            //succes
            header("location: index.php");
        } else {
            //error
            echo "query error: " . mysqli_error($conn);
        }
    }
} // end of the post

?>


<!DOCTYPE html>
<html lang="en">


<?php include("templates/header.php"); ?>

<h1 class="text-center">Add you pizza's</h1>
<div>
    <form class="bg-light" action="add.php" method="POST">
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="text" name="email" class="form-control" value="<?php echo htmlspecialchars($email) ?>">
            <small id="emailHelp" class="form-text text-muted"><?php echo $errors["email"]; ?></small>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Pizza Title</label>
            <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($title) ?>">
            <small id="emailHelp" class="form-text text-muted"><?php echo $errors["title"]; ?></small>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Engredienten</label>
            <input type="text" name="ingredienten" class="form-control" value="<?php echo htmlspecialchars($ingredienten) ?>">
            <small id="emailHelp" class="form-text text-muted"><?php echo $errors["ingredienten"]; ?></small>
        </div>
        <button type="submit" name="submit" value="submit" class="btn btn-outline-success my-2 my-sm-0">Submit</button>
    </form>
</div>


    <?php include("templates/footer.php"); ?>

    

</html>