<?php

    include("config/db_connect.php");
    //check GET request id param 
    if(isset($_GET['id'])) {
        
        $id = mysqli_real_escape_string($conn, $_GET['id']);


        //make sql
        $sql = "SELECT * FROM tickets WHERE id = $id";

        // get the query result
        $result = mysqli_query($conn, $sql);

        //fetch the result in array format
        $ticket = mysqli_fetch_assoc($result);

   
    }


    if(isset($_POST['delete'])){
        
        $sql = "DELETE FROM tickets WHERE id = $id";

        //get the query result
        $delete_result = mysqli_query($conn, $sql);

        if ($delete_result) {
             
            //free the result and close the connection
            mysqli_free_result($result);
            mysqli_close($conn);
            header('Location: index.php');
        } else {
            echo 'Error: ' . $delete_result;
        }

	} // end POST check




?>


<!DOCTYPE html>

<style>
    .row {
        margin-top: 40px;
    }
</style>


<html>
    <?php include('templates/header.php'); ?>

        <div class="container center">
            <div class="row">
                <?php if($ticket): ?>
                    <h6>Ticket title</h6>
                    <?php echo htmlspecialchars($ticket['title']); ?>
                    <h6>Created by </h6>
                    <?php echo htmlspecialchars($ticket['email']); ?>
                    <h6>Details </h6>
                    <?php echo htmlspecialchars($ticket['details']); ?>
                    <h6> Created at: </h6>
                    <?php echo htmlspecialchars($ticket['created_at']);?>
                    

                    <!-- DELETE FORM -->
                    <form method="post">
                        <input type="hidden" name="id_to_delete" value="<?php echo $ticket['id']?>" />
                        <input type="submit" name="delete" value="Delete" class="btn brand z-depth-0"/>
                    </form>


                <?php else: ?>
                    <h1>No such ticket exists!</h1>
                <?php endif; ?>
            </div> 
            
        </div>


    <?php include('templates/footer.php'); ?>
</html>