<?php 

    include("config/db_connect.php");




    // check GET id param
    if (isset($_GET["id"])) {

        $id = mysqli_real_escape_string($conn, $_GET["id"]);

        // make sqli
        $sql = "SELECT * FROM pizza WHERE id = $id";

        // get the query result
        $result = mysqli_query($conn, $sql);

        // fetch result in array format
        $pizza = mysqli_fetch_assoc($result);

        mysqli_free_result($result);
        mysqli_close($conn);

    }

    var_dump($_POST);

?>


<!DOCTYPE html>
<html lang="en">

<?php include("templates/header.php"); ?>

<div class="container">
    <?php if ($pizza): ?>
        <h1> <?php echo htmlspecialchars($pizza["title"]); ?> </h1>
        <p> created by: <?php echo htmlspecialchars($pizza["email"]); ?> <p>
        <p> <?php echo htmlspecialchars($pizza["post_tijd"]); ?> <p>
        <h5> <?php echo htmlspecialchars($pizza["ingredienten"]) ?> </h5>

        <!-- DELETE FORM -->
        <form action="details.php" methode="POST"> 
        
            <input type="hidden" name="id_to_delete" value=" <?php echo $pizza["id"] ?>">
            <input type="submit" name="delete" value="Delete"  class="btn btn-outline-success">
        
        </form>
    <?php else: ?>
        
        <h5>No such pizza exists!</h5>

    <?php endif; ?>
</div>

<?php include("templates/footer.php"); ?>
</html>