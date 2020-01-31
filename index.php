
<?php 

    include("config/db_connect.php");

    // write query for all pizza
    $sql = "SELECT  title, ingredienten, id FROM pizza ORDER BY post_tijd";

    //make quwey & get result
    $result = mysqli_query($conn, $sql);

    // fetch the resulting rows as an array
    $pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    // free result
    mysqli_free_result($result);

    // close connection
    mysqli_close($conn);
   
?>




<!DOCTYPE html>
<html lang="en">



    <?php include("templates/header.php"); ?>

    <div class="container">
        <div class="row">

            <?php foreach ($pizzas as $pizza) { ?>
            
               
                <div class="card col" style="width: 18rem;">
                    <!-- <div class="card-header"></div> -->
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item text-center"> <?php echo htmlspecialchars($pizza["title"]) ?> </li>      
                
                            <?php foreach(explode(",", $pizzas[0]["ingredienten"]) as $ing) { ?>
                            <li class="list-group-item text-center"> <?php echo htmlspecialchars($ing) ?> </li>      
                        <?php } ?>
                        <!-- <li class="list-group-item"> <?php echo htmlspecialchars($pizza["id"]) ?> </li> -->
                    </ul>
                    <a href="details.php?id= <?php echo $pizza["id"] ?>" class="btn btn-outline-success my-2 my-sm-0" type="">Details</a>
                </div>

            <?php } ?>

            <?php if (count($pizza) >= 3) { ?>
                <p>there are 3 or more pizzas </p> 
            <?php } else { ?>
                <p>there are less then 3 pizzas </p> 
            <?php } ?>

        </div>
    </div>



    <?php include("templates/footer.php"); ?>

    

</html>